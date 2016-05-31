<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Model{

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters("<p class='red'>","</p?");
		$this->load->model('Review');
		$this->load->model('Author');

	}

	public function getBook_and_ReviewsByID($bookId)
	{
		$query="SELECT users.alias, users.id as user_id, reviews.id as review_id, reviews.rating, reviews.review, reviews.created_at, books.id  as book_id, authors.name, authors.id as authors_id, books.title  FROM books
			LEFT JOIN reviews on books.id = reviews.book_id 
			LEFT JOIN users on users.id = reviews.user_id
			left join authors on authors.id = books.author_id
			WHERE books.id =?";

		$values = array("id"=>$bookId);

		return $this->db->query($query, $values)->result_array();

	}
	public function getLatest3Books_and_Reviews()
	{
		$query = "
			SELECT users.alias,users.id, books.title, books.id as book_id, authors.name, reviews.rating, reviews.review, reviews.created_at from books
			left join reviews on books.id = reviews.book_id
			left join users on users.id = reviews.user_id
			left join authors on books.author_id = authors.id
			order by reviews.created_at desc;
		";
		$data = [];
		 for ($i=0; $i<3; $i++)
		 {
		 	array_push($data, $this->db->query($query)->row_array($i)); //basically to only return the 3 latest reviews
		 }

		 return $data;
	}

	public function getAllBooks_and_Reviews()
	{
		$query = "SELECT books.id as book_id, books.title FROM reviews 
					LEFT JOIN books ON books.id = reviews.book_id
					GROUP BY books.id";

		return $this->db->query($query)->result_array();

	}
	public function validateTitleReviewForm($bookData)
	{

		$authorID = intval($bookData['author_id']);
		$authorName = trim($bookData['author_name']);

		if ($authorID===0 && $authorName =="")
		{

			//we can't have this so return before checking the rest of the data
			$this->session->set_flashdata('author_error', "<p class='red'>You must select an author or enter a name in the space provided</p>");
			return 1;
		}
		// you only get here if the above passes.
			$this->form_validation->set_rules("books", "book", "required|trim");
			$this->form_validation->set_rules("review", "review", "required|trim");
			$this->form_validation->set_rules("rating", "rating", "required|greater_than[0]|less_than[6]|is_natural|trim");


			if($this->form_validation->run() === true)
			{
				 $writeAuthorSuccess = false;
				 $writeBookSuccess = false;
				 $writeReviewSuccess = false;

				
				//continue with the process
				if ($authorID==0) //this is a new author being added, so you have to write that first.
				{

					$writeAuthorSuccess= $this->Author->writeAuthor($bookData); //this needs to return the authorID, and we need to put it into $bookData before calling it.
					
					if ($writeAuthorSuccess !=false)
					{
						$bookData['author_id'] = $writeAuthorSuccess;//here we set the author's ID as it's been written and saved in the last step.
						$writeBookSuccess=$this->Book->writeBook($bookData);

						if ($writeBookSuccess !=false)
						{
							$bookData['book_id'] = $writeBookSuccess;

							$writeReviewSuccess=$this->Review->writeReview($bookData);

						}
						else
						{
							return false; // you have to write the whole record for this to return true;
						}
						

						if ($writeAuthorSuccess !=false && $writeBookSuccess !=false && $writeReviewSuccess !=false)
						{
							return true;
							//all records are written successfully and you can now redirect to wherever
						}
						else
						{
							return false;
						}

					}
					else
					{
						return false; //you can't write any other records if you can't write the author record.
					}
					
				}
				else
				{
					
					$writeBookSuccess = $this->Book->writeBook($bookData);

					if ($writeBookSuccess !=false)
					{

						$bookData['book_id'] = $writeBookSuccess;
						$writeReviewSuccess = $this->Review->writeReview($bookData);
							
							if ($writeReviewSuccess !=false && $writeBookSuccess !=false)
							{
								return true;
							}
							else
							{
								return false;
							}
					}
					else
					{
						return false;
					}
				}
				return true;
			}
			else
			{	
				return 2;
			}

	}

	public function writeBook($bookData)
	{
		$query = "INSERT INTO BOOKS (user_id, author_id, title, created_at, updated_at) VALUES (?,?,?,?,?)";

		$values = array(
			"user_id" => $bookData['user_id'],
			"author_id" => $bookData['author_id'],
			"title"=> $bookData['book_title'],
			"created_at"=> Date('Y-m-d H:i:s'),
			"updated_at"=> Date('Y-m-d H:i:s')
			);

		if($this->db->query($query, $values)===true)
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}


	}
	
}