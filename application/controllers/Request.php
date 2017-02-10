<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

// @Carmen - this needs tweaking so that the server sends an email to hello@nudj.co with the users first name, email address and company.

	public function index($request = "")
	{
		//show_404();

		$this->load->model('user_model');

		$this->load->helper('form');
    	$this->load->library('form_validation');

	{
		$this->load->view('request/request_view');
		$this->load->view('templates/end_body');
	}
	}
}
