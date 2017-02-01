<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidates extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{

		//show_404();

		$this->load->model('user_model');
		$this->load->model('application_model');
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

		$job_id =  $this->uri->segment(2);

		if(!isset($job_id)) {
    		show_404();
    	}

		$jobDetails = $this->job_model->fetchJobDetails($job_id);

		$data['job_title'] = $jobDetails['title_job'];
		$data['job_id'] = $job_id;

		$candidates = $this->application_model->fetchCandidatesCurrentJob($job_id);

		$data['candidates'] = $candidates;

		$this->load->view('templates/header');
		$this->load->view('templates/menu_dashboard', $data);
		$this->load->view('candidates/candidates_view', $data);
		$this->load->view('templates/footer_candidates', $data);
	}
}