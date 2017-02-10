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

		if($this->session->userdata('previewJob') !== null) {
			$data['preview_job'] = $this->session->userdata('previewJob');
		}
 
		$this->load->view('templates/header');
		$this->load->view('templates/menu_dashboard', $data);
		$this->load->view('addjob/addjob_view', $data);
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

			$jobCreatedID = $this->job_model->createJob($newJob);

			if($jobCreatedID) {
				
				echo $jobCreatedID;
			} 
		}

		if($this->session->userdata('previewJob') !== null) {
			
			$this->session->unset_userdata('previewJob');
		}
	}

	public function goToPreview() {

		//print_r($this->input->post('title'));
		//die();

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

			
			if($newJob) {

				$previewJob = array("previewJob" => $newJob);

				$this->session->set_userdata($previewJob);
				//redirect('addjob','refresh');
				//redirect(base_url('job/preview'));
			}
		}
	}

	public function askForReferral() {

		$this->load->model('job_model');
		$this->load->model('user_model');

		$jobID =  $this->uri->segment(3);

		$data = array();

		// print_r($jobID);
		// die();

		if(!isset($jobID)) {
    		show_404();
    	}

    	$jobDetails = $this->job_model->fetchJobDetails($jobID);

    	$createdByUser = $this->user_model->fetchUserById($jobDetails['user_id']);
    	if(isset($createdByUser['fullname'])) {
    		$data['createdByUser'] = $createdByUser;
    	}

    	if(isset($jobDetails['title_job'])) {

    		$data['job'] = $jobDetails;

    	} else {
    		show_404();
    	}

		$this->load->view('templates/header');
		$this->load->view('addjob/ask_for_referral_view', $data);
		$this->load->view('templates/end_body.php');
	}

	public function askForReferralEntireNetwork() {

		$this->load->library('email');

            $this->email->from('hello@nudj.co', 'Nudj');
            $this->email->to('robyn@nudj.co');//carmenelena.albu@gmail.com
            $this->email->set_mailtype("html");

            $this->email->subject('Entire Network Referral');
            $this->email->message('<html>
                                  <body>
                                  <br/>
                                    <p>Hey Robyn,</p>
                                    <p>Someone is asking for network referral. Please help them out: </p>
                                    <br/>
                                    <br/>'.$this->input->post('job_url').'<br/>
                                    <p>Love<br/> Team Nudj x</p>
                                    <br/><br/>
                                  </body>
                                  </html>');

            $this->email->send();
	}

}



