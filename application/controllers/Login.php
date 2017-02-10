<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index($signin = "")
	{
		//show_404();

		$this->load->model('user_model');

		$this->load->helper('form');
    	$this->load->library('form_validation');

    	$isLoggedIn = $this->user_model->userLoggedIn();

    	if($isLoggedIn)
		{
			redirect(base_url('dashboard'));
		}

		if($this->input->post('submit')){
			$user = array(
		        'email' => $this->input->post('email'),
		        'password_input' => $this->input->post('password')
		    );

		    $isLoggedIn = $this->user_model->signin($user);

			if($isLoggedIn)
			{
				$data['error'] = false;
				redirect(base_url('dashboard'));
			} else {
				$data['error'] = true;
			}
		}

		$data['email'] = $this->input->post('email');//($this->input->post('email') !== null) ? $this->input->post('email') : '';

		// $this->load->view('templates/header');
		$this->load->view('login/login_view', $data);
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

	public function actionSignIn() {

		$this->load->model('user_model');

		$user = array(
		        'email' => $this->input->post('email'),
		        'password_input' => $this->input->post('password')
		    );

		$isLoggedIn = $this->user_model->signin($user);

		if($isLoggedIn)
		{
			redirect(base_url('dashboard'));
		}
	}


}
