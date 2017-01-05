<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
    }

    public function index() {

    	$this->load->model('job_model');

    	$jobID =  $this->uri->segment(2);
    	$referralIDFrom =  $this->uri->segment(4);

    	$data = [];

    	if(isset($referralIDFrom)) {
    		$data['referred_from'] = $referralIDFrom;
    	}

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
		$this->load->view('job/template_job_view',$data);
		$this->load->view('templates/footer');

    }

    public function create_referral() {

    	$this->load->model('referral_model');

    	$refer = $this->input->post('referred_from');

    	//echo $refer."   ---  dffgd";

    	//print_r($refer. " OR?");

    	

		if($this->input->post('job_id')) {
    		
    		$newReferral = array(
			        'fullname' => $this->input->post('name'),
			        'email' => $this->input->post('email'),
			        'relationship' => $this->input->post('relationship'),
			        'job_id' => $this->input->post('job_id'),
			        'referred_from' => $refer
			    );

			$referralCreated = $this->referral_model->createReferral($newReferral);

			//print_r('<br/>');
			//print_r($referralCreated . "  WJFKJSHDF");
			//die();

			if($referralCreated) {


				// if(isset($referralCreated['email']) && isset($referralCreated['fullname']) ) {

				// 	$url = base_url().'job/'.$referralCreated['job_id'].'/referral/'.$referralCreated['referral_id'];

			 //    	$this->load->library('email');

				// 	$this->email->from('webmaster@nudj.co', 'Nudj');
				// 	$this->email->to($this->input->post('email'));
				// 	$this->email->set_mailtype("html");

				// 	$this->email->subject('Referral - Nudj');
				// 	$this->email->message('<html>
				// 					      <body>
				// 					      <br/>
				// 					        <p>Hi '.ucfirst($referralCreated['fullname']).',</p>
				// 					        <p>You have just been Nudjed, go to link bellow to discover the recommendation:</p>
				// 					        <br/>
				// 					        <a href="'.$url.'">'.$url.'</a>
				// 					        <br/><br/>
				// 					        <p>Love,<br/>Nudj</p>
				// 					        <br/><br/>
				// 					      </body>
				// 					      </html>');

				// 	$this->email->send();
		  //   	}

				echo $referralCreated['referral_id'];
			}
		}

    }

    public function cefinn_ecom()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/powered_by2');
		$this->load->view('job/cefinn_ecommerce_view');
		//$this->load->view('templates/footer');
	}

	public function cefinn_finan()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/powered_by2');
		$this->load->view('job/cefinn_finance_view');
		//$this->load->view('templates/footer');
	}

	public function ct()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('job/charlotte_tilbury_view');
		$this->load->view('templates/footer');
	}

	public function mr()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('job/mr_smith_view');
		$this->load->view('templates/footer');
	}
}
