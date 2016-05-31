<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('Author');
		$this->load->model('Book');
		$this->load->model('Review');
		
	}

	public function delete($id, $book_id)
	{

		$reviewData = array(

			"id"=>$id,
			"user_id"=> $this->session->userdata("id"),
			"book_id"=> $book_id
			);

			$valid = $this->Review->deleteReview($reviewData);

			if ($valid===true)
			{
				redirect('/books/show/' . $book_id );
			}
			else
			{
				//this logic doesn't work!  MY SQL always returns true.  
				//Check and find a way to return the correct resposne.
				//perhaps the person tried to change the userID or there is a bug,
				//eitherway, log them out.
				redirect('/users/logout');
			}
	}

}