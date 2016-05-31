<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User');
		$this->load->model('Review');

	}

	public function show($id)
	{
		$data['user_data'] = $this->User->getUserByID($id);
		$reviewData = $this->Review->getReviewsByUserId($id);

		$data['user_data']['user_reviews'] = $reviewData;

		// array_push($data['user_data'], $reviewData);

		$this->load->view('users/dashboard', $data);

	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/users');
	}
	public function index()
	{
		$this->load->view('/users/index');
	}

	public function login()
	{
		if ($this->input->post())
		{
			$userData = array(
				"email" => $this->input->post('login_email'),
				"password" => $this->input->post('login_password')
				);

			if ($this->User->validateLogin($userData)===true){
				// echo ("true");
				// die();
				$currentUser = $this->User->authenticate($userData);

				if ($currentUser !=false){

					$this->session->set_userdata('id', $currentUser['id']);
					$this->session->set_userdata('name',$currentUser['name']);
					$this->session->set_userdata('alias',$currentUser['alias']);
					$this->session->set_userdata('email',$currentUser['email']);

					redirect('/books');
				}
				else
				{
					$this->session->set_flashdata('login_error', "<p class='red'> Invalid username/password </p>");
					redirect('/users/index');
				}
			}
			else{
				// echo ("false");
				$this->session->set_flashdata('login_error', "<p class='red'> Invalid username/password </p>");
				redirect('/users/index');
			}
		}
		else
		{
			//nothing is posted.
			// return to the login screen
			$this->session->set_flashdata('login_error', "<p class='red'> Invalid username/password </p>");

			redirect('/');
		}
	}

	public function new()
	{
		//do basic validation on post data
		// $userData=$this->input->post();

		// var_dump($userData);
		// die();
		// var_dump($this->input->post());

		if($this->input->post() !=false)
		{
			$userData = array(
				"name" => $this->input->post('name'),
				"alias" => $this->input->post('alias'),
				"email" => $this->input->post('email'),
				"password" => $this->input->post('password'),
				"conf_password" => $this->input->post('conf_password')
				);

				if ($this->User->validateNewUser($userData)==false){
					$this->load->view('/users/index');

					//return to the registrations page to show
					//validation errors.

				}
				else
				{
					//validation is successful goto dashboard page
					// echo ("boo");
					//write the data to the database
					$currentUser = $this->User->createNewUser($userData);

					if ($currentUser != false)
						{
							//you have the ID of the user -
							// var_dump($currentUser);
							$this->session->set_userdata('id', $currentUser['id']);
							$this->session->set_userdata('name',$currentUser['name']);
							$this->session->set_userdata('alias',$currentUser['alias']);
							$this->session->set_userdata('email',$currentUser['email']);
							
							// $this->load->view('/books/books.php');
							redirect('/books');

						}
						else
						{
							//problem writing to db
							redirect('/users/index');
						}

				}

		}
		else
		{
			redirect('/');
			//this is an issue with not getting POST data for one reason or another.	
		}
	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */