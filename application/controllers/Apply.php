<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
    }

    public function index() {
    	
    	$this->load->model('job_model');

    	$jobID =  $this->uri->segment(3);

    	$data = [];

    	if(!isset($jobID)) {
    		show_404();
    	}

    	$jobDetails = $this->job_model->fetchJobDetails($jobID);

    	if(isset($jobDetails['title_job'])) {

    		$data['job'] = $jobDetails;

    	} else {
    		show_404();
    	}

    	$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('apply/template_apply_view', $data);
		$this->load->view('templates/footer');

    }

	public function ct()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('apply/apply_ct');
		$this->load->view('templates/footer');
	}

	public function mr()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('apply/apply_mr');
		$this->load->view('templates/footer');
	}
}