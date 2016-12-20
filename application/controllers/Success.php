<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Success extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('success/success_view');
		$this->load->view('templates/end_body');
	}
}