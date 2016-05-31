<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Model{

	public function __construct(){

		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters("<p class='red'>", "</p>");

	}
	
	public function writeReview($reviewData){

		$query = "INSERT INTO REVIEWS (user_id, book_id, rating, review, created_at, updated_at) VALUES (?,?,?,?,?,?)";

		$values = array(

			"user_id"=> $reviewData['user_id'],
			"book_id"=> $reviewData['book_id'],
			"rating"=>$reviewData['rating'],
			"review"=>$reviewData['review'],
			"created_at"=> date('Y-m-d H:i:s'),
			"updated_at"=> date('Y-m-d H:i:s')
			);

		return $this->db->query($query, $values);

	}

	public function validateReview($reviewData)
	{

		$this->form_validation->set_rules("review", "review", "required|trim");
		$this->form_validation->set_rules("rating", "rating", "required|is_natural");

		if ($this->form_validation->run() ===true)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function deleteReview($reviewData)
	{
		$query = "DELETE FROM REVIEWS WHERE 
					REVIEWS.ID=? AND REVIEWS.USER_ID=?";

		$values = array("id"=>$reviewData['id'], "user_id"=>$reviewData['user_id']);

		return $this->db->query($query, $values);
	}

	public function getReviewsByUserId($id)
	{
		$query = "SELECT reviews.id, reviews.user_id, reviews.book_id, books.title FROM REVIEWS 
				LEFT JOIN books on books.id = reviews.book_id
				WHERE reviews.user_id=? 
				GROUP BY book_id";

		$reviewData = $this->db->query($query, array("user_id"=>$id))->result_array();

		return $reviewData;
	}

}