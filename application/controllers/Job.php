<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
    }

    public function index() {

    	$this->load->model('job_model');
    	$this->load->model('user_model');
    	$this->load->model('referral_model');

    	$jobID =  $this->uri->segment(2);
    	$referralIDFrom =  $this->uri->segment(4);

    	$data = [];

    	if(!isset($jobID)) {
    		show_404();
    	}

    	$jobDetails = $this->job_model->fetchJobDetails($jobID);

    	$referral_name = 'Robyn';

    	if(isset($referralIDFrom)) {
    		$data['referred_from'] = $referralIDFrom;

    		$referralDetails = $this->referral_model->fetchReferralDetails($referralIDFrom);
    		$referralChain = json_decode($referralDetails['referral_chain'],true);
    		$data['referral_chain'] = $referralChain;
    		$data['fullname'] = $referralDetails['fullname'];

    		//print_r($referralChain);
			//die();
    	}

    	$createdByUser = $this->user_model->fetchUserById($jobDetails['user_id']);
    	if(isset($createdByUser['fullname'])) {
    		$data['createdByUser'] = $createdByUser;
    	}

    	$cover_filename = $jobDetails['user_id'].'_cover.png';
    	if(file_exists("./uploads/".$cover_filename)) {
    		$data['cover_filename'] = $cover_filename;
    	}

    	$logo_filename = $jobDetails['user_id'].'_logo.png';
    	if(file_exists("./uploads/".$logo_filename)) {
    		$data['logo_filename'] = $logo_filename;
    	}

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

				$this->session->set_userdata('companyName',$this->input->post('companyName'));
				$this->session->set_userdata('job_url',$this->input->post('job_url'));
				$this->session->set_userdata('referral_url', base_url().'job/'.$this->input->post('job_id').'/referral/'.$referralCreated['referral_id']);


				if(isset($referralCreated['email']) && isset($referralCreated['fullname']) ) {

					$url = base_url().'job/'.$referralCreated['job_id'].'/referral/'.$referralCreated['referral_id'];

			    	$this->load->library('email');

					$this->email->from('webmaster@nudj.co', 'Nudj');
					$this->email->to($this->input->post('email'));
					$this->email->set_mailtype("html");

					$this->email->subject('Your unique nudj link');
					$this->email->message('<html>
									      <body>
									      <br/>
									        <p>Hi '.ucfirst($referralCreated['fullname']).',</p>
									        <p>This is a copy of your unique Nudj link:</p>
									        <br/>
									        <a href="'.$url.'">'.$url.'</a>
									        <br/><br/>
									        <p>You can now share this with your friends.
									        If they get hired we will know they came from you and
									        we can send you the reward. </p>

									        <p>Don’t over think a referral. If you think your friend
									        might be interested, just ping it to them. They will
									        appreciate you thinking of them. They are in complete
									        control so can opt in if they want to and they are only
									        known to the hirer if they apply. </p>

									        <p>Love<br/> Team Nudj x</p>
									        <br/><br/>
									      </body>
									      </html>');

					$this->email->send();
		    	}

				echo $referralCreated['referral_id'];
			}
		}

    }

    public function uniqueLink() {

    	$data['unique_link'] = true;

		$this->load->view('templates/header');
		$this->load->view('addjob/ask_for_referral_view', $data);
		$this->load->view('templates/end_body.php');

    }

    public function edit() {

    }

    public function preview() {

    	$this->load->model('user_model');

    	$previewJob = $this->session->userdata('previewJob');

    	$data['createdByUser'] = $this->user_model->getCurrentUser();

    	$data['job'] = $previewJob;
    	$data['preview_mode'] = true;

    	$cover_filename = $this->session->userdata('user_id').'_cover.png';
    	if(file_exists("./uploads/".$cover_filename)) {
    		$data['cover_filename'] = $cover_filename;
    	}

    	$logo_filename = $this->session->userdata('user_id').'_logo.png';
    	if(file_exists("./uploads/".$logo_filename)) {
    		$data['logo_filename'] = $logo_filename;
    	}

    	$this->load->view('templates/header');
		$this->load->view('templates/powered_by', $data);
		$this->load->view('job/template_job_view',$data);
		$this->load->view('templates/footer');
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
