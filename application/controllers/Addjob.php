<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addjob extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{

		$this->load->model('user_model');
		$this->load->model('job_model');
		$this->load->helper('form');

    	$isLoggedIn = $this->user_model->userLoggedIn();

    	if(!$isLoggedIn)
		{
			redirect(base_url('signin'));
		}

		$data = array();

		if(strlen($this->session->userdata('photo_url')) > 0 ) {
			
			$data['photo_url'] = $this->session->userdata('photo_url');
		} else {
			if(strlen($this->session->userdata('acronym')) > 0) {
				$data['acronym'] = $this->session->userdata('acronym');
			}
		}

		if(strlen($this->session->userdata('firstname')) > 0) {
			$data['firstname'] = $this->session->userdata('firstname');
		}


		// if($this->input->post('submit')) {

		// 	$errors = array();
		// 	//array_push($stack, "apple", "raspberry");

		// 	$title = $this->input->post('title');
		// 	$location = $this->input->post('location');
		// 	$description = $this->input->post('description');
		// 	$salary = $this->input->post('salary');
		// 	$referral_bonus = $this->input->post('referral_bonus');

		// 	$jobCreated = $this->job_model->createJob($newJob);

		// 	if($jobCreated) {
		// 		redirect(base_url('dashboard'));
		// 	} else {
		// 		array_push($errors, "An error has occured, try again later.");
		// 	}

		// 	$data['errors'] = $errors; 
		// }
 
		$this->load->view('templates/header');
		$this->load->view('templates/menu_dashboard', $data);
		$this->load->view('addjob/addjob_view', $data);
		//$this->load->view('templates/footer_addjob', $data);
	}

	public function createJob() {

		$this->load->model('job_model');

		if($this->input->post('title')) {

			$newJob = array(
			        'title_job' => $this->input->post('title'),
			        'location_job' => $this->input->post('location'),
			        'description_job' => $this->input->post('description'),
			        'skills' => $this->input->post('skills'),
			        'brief' => $this->input->post('brief'),
			        'preferences' => $this->input->post('preferences'),
			        'referral_bonus' => $this->input->post('referral_bonus'),
			        'salary' => $this->input->post('salary')
			    );

			$jobCreated = $this->job_model->createJob($newJob);

			if($jobCreated) {
				
				//redirect('addjob','refresh');
			} 
		}
	}



}



