<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index($request = "")
	{
		//show_404();

		$this->load->helper('form');
    	$this->load->library('form_validation');
		$this->load->view('request/request_view');
		$this->load->view('templates/end_body');
	}


	public function requestSuccess() {

		$this->load->library('email');

		$company_name = '-';
		if($this->input->post('company_name') !== null) {
			$company_name = $this->input->post('company_name');
		}

		$fullname = '-';
		if($this->input->post('fullname') !== null) {
			$fullname = $this->input->post('fullname');
		}

		$email = '-';
		if($this->input->post('email') !== null) {
			$email = $this->input->post('email');
		}

		$this->email->from('hello@nudj.co', 'Nudj');
		$this->email->to('robyn@nudj.co');
		$this->email->cc('jamie@nudj.co'); 
		$this->email->set_mailtype("html");

		$this->email->subject('Request Access');
		$this->email->message('<html>
						      <body>
						      <br/>
						        <p>Hi Robyn,</p>
						        <p>A new user requests access.</p>
						        <br/><br/>

						        <p> 
						        	<strong>Full name:</strong> '.$fullname.'<br/>
						        	<strong>Email:</strong> '.$email.'<br/>
						        	<strong>Company Name:</strong> '.$company_name.'<br/>
						        </p>

						        <br/><br/>
						        <p>Love<br/> Team Nudj x</p>
						        <br/><br/>
						      </body>
						      </html>');

		$this->email->send();

		$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('request/request_success_view');
		$this->load->view('templates/end_body');

	}
}
