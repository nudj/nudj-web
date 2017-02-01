<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{

		//show_404();

		$this->load->model('user_model');
		$this->load->model('job_model');

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

		$jobs = $this->job_model->fetchJobsCurrentUser();
 
		$data['jobs'] = $jobs;

		$this->load->view('templates/header');
		$this->load->view('templates/menu_dashboard', $data);
		$this->load->view('jobs/jobs_view', $data);
		$this->load->view('templates/footer_jobs', $data);
	}
}