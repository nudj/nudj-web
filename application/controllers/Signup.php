<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->load->model('user_model');

		$this->load->helper('form');
    	$this->load->library('form_validation');

    	$isLoggedIn = $this->user_model->userLoggedIn();


    	//echo("<script>console.log('PHP: WORKS');</script>");

    	if($isLoggedIn)
		{
			redirect(base_url('dashboard'));
		}

		if($this->input->post('submit')) {

			$errors = array();
			//array_push($stack, "apple", "raspberry");

			$fullname = $this->input->post('fullname');
			$location = $this->input->post('location');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$repassword = $this->input->post('repassword');

			if(strlen($fullname) <= 0 || strlen($email) <= 0 || strlen($location) <= 0 || strlen($password) <= 0 || strlen($repassword) <= 0) {

				array_push($errors, "All fields are required.");
			} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				array_push($errors, "Invalid email address.");
			} else if (strcmp($password, $repassword) !== 0) {
				array_push($errors, "Passwords do not match.");
			} else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/', $password)) {
				array_push($errors, "Password must contain 6 characters of letters, numbers and at least one special character.");
			} else {


				$newUser = array(
			        'fullname' => $this->input->post('fullname'),
			        'email' => $this->input->post('email'),
			        'location' => $this->input->post('location'),
			        'password_input' => $this->input->post('password')
			    );

				$userCreated = $this->user_model->signup($newUser);
				if($userCreated) {
					redirect(base_url('dashboard'));
				} else {
					array_push($errors, "Email address already in use.");
				}
			}

			$data['errors'] = $errors; 
		} 

		$data['fullname'] = $this->input->post('fullname');
		$data['location'] = $this->input->post('location');
		$data['email'] = $this->input->post('email');


		//$this->load->view('templates/header_with_google');
		$this->load->view('signup/signup_view',$data);
		$this->load->view('templates/end_body');
	}

	public function google_auth() {

		$user['fullname'] = $this->input->post('name');
		$user['profile_url'] = $this->input->post('profile_url');
		$user['email'] = $this->input->post('google_email');
		$user['google_auth'] = $this->input->post('google_auth');

		$this->load->model('user_model');

		$this->user_model->google_auth($user);

		//redirect(base_url('dashboard'));
	}

	public function linkedin_auth() {

		$user['fullname'] = $this->input->post('name');
		$user['firstname'] = $this->input->post('firstname');
		$user['lastname'] = $this->input->post('lastname');
		$user['linkedin_profile'] = $this->input->post('profile_url');
		$user['photo_url'] = $this->input->post('photo_url');
		$user['email'] = $this->input->post('linkedin_email');
		$user['linkedin_auth'] = $this->input->post('linkedin_auth');
		$user['description'] = $this->input->post('headline');

		$this->load->model('user_model');

		$this->user_model->linkedin_auth($user);

		//redirect(base_url('dashboard'));
	}

	public function actionSignup() 
	{
    	$this->load->model('user_model');

    	echo '<br/><br/><br/>You sent: First: [' .$this->input->post('fullname'). ']<br/>Last: [' .$this->input->post('email'). '] etc';

		$newUser = array(
	        'fullname' => $this->input->post('fullname'),
	        'email' => $this->input->post('email'),
	        'location' => $this->input->post('location'),
	        'password_input' => $this->input->post('password')
	    );

		$this->user_model->signup($newUser);

		redirect(base_url('dashboard'));
	}

	public function goToDashboard() {
		redirect(base_url('dashboard'));
	}
	

}