<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('Author');
		$this->load->model('Book');
		
	}

	public function index()
	{

		$bookData['latest_reviews'] = $this->Book->getLatest3Books_and_Reviews();
		$reviews['all_reviewed'] = $this->Book->getAllBooks_and_Reviews();

		$this->load->view('/books/books', $bookData);
		$this->load->view('/books/other_reviews', $reviews);
	}

	public function add()
	{

		$data['authors'] = $this->Author->getAllAuthors();
		$this->load->view('/books/add', $data);

	}

	public function show($id)
	{
		$bookData['reviews'] = $this->Book->getBook_and_ReviewsByID($id);
		$this->load->view('/books/show', $bookData);
	}

	public function addReviewToBook()
	{
		// var_dump($this->input->post());
		// die();

		if ($this->input->post())
		{
			$reviewData = array (
				"review" => $this->input->post('review'),
				"rating" => $this->input->post('rating'),
				"book_id"=> $this->input->post('book_id')
				);

			$valid = $this->Review->validateReview($reviewData);

			if ($valid === true)
			{
				//write the record
				$reviewData['user_id'] = $this->session->userdata('id');

				$writeSuccess = $this->Review->writeReview($reviewData);

					if ($writeSuccess !=false)
					{
						//proceed
						redirect('/books/show/' . $reviewData['book_id']);

					}
					else
					{
						//problem writing
						echo ("Problem writing to database.  Please try again later");
						$this->session->sess_destroy();
						die();
					}
			}
			else
			{
				// echo ("no no!");
				$bookData['reviews'] = $this->Book->getBook_and_ReviewsByID($reviewData['book_id']);
				$this->load->view('/books/show', $bookData );
			}
		}
	}
	public function newTitle()
	{
		//1.  get post data
		//2.  validate it for each piece of information:  Book title, author name (or ID), and review
		//3.  write each record
		//4.  if sucessful - goto the new book ID
		if ($this->input->post()!=false){
			// echo ("success");
			// var_dump($this->input->post());
			// die();
			$bookData = array(
					"book_title"=>$this->input->post('books'),
					"author_id" => $this->input->post('author_id'),
					"author_name"=> $this->input->post('author_name'),
					"review" => $this->input->post('review'),
					"rating" => $this->input->post('rating'),
					"user_id" => $this->session->userdata('id')
				);

				$validation = $this->Book->validateTitleReviewForm($bookData);

				if ($validation ===1)
				{

					// echo "1";
					// die();
					redirect('/books/add');
				}
				else if ($validation ===2)
				{
					// echo "2";
					// die();
					$this->load->view('/books/add');
					//errors are automatically passed through form_validatio

				}
				else if ($validation===true)
				{
					// echo "true";
					// die();
					//no errors continue.
					redirect('/books');
				}

		}
		else
		{
			echo("fail!");
			die();

		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */