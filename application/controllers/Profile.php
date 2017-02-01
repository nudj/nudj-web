<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{

		//show_404();

		$this->load->model('user_model');

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

		if(strlen($this->session->userdata('fullname')) > 0) {
			$data['fullname'] = $this->session->userdata('fullname');
		}

		if(strlen($this->session->userdata('email')) > 0) {
			$data['email'] = $this->session->userdata('email');
		}

		if(strlen($this->session->userdata('company_name')) > 0) {
			$data['company_name'] = $this->session->userdata('company_name');
		}

		if(strlen($this->session->userdata('company_about')) > 0) {
			$data['company_about'] = $this->session->userdata('company_about');
		}
		if(strlen($this->session->userdata('company_about_header')) > 0) {
			$data['company_about_header'] = $this->session->userdata('company_about_header');
		}


		if(strlen($this->session->userdata('company_website')) > 0) {
			$data['company_website'] = $this->session->userdata('company_website');
		}

		if(strlen($this->session->userdata('company_logo')) > 0) {
			$data['company_logo'] = $this->session->userdata('company_logo');
		}

		if(strlen($this->session->userdata('company_cover')) > 0) {
			$data['company_cover'] = $this->session->userdata('company_cover');
		}

		$this->load->view('templates/header');
		$this->load->view('templates/menu_dashboard', $data);
		$this->load->view('profile/profile_view', $data);
		//$this->load->view('templates/footer_profile');
	}

	public function update()
	{
		$this->load->library('upload');

		// print_r('test');
		// print_r('saasdgasgdf');
		// print_r($_POST);
		// print_r('hghfdgfh');
		// print_r($_FILES);
		// print_r('fdfdgdfgfdgfd');
		// print_r($this->input->post('fullname'));

		$cover_name = '';
		$logo_name = '';

		if (isset($_FILES['cover'])) {
			print_r('file---');
			$file = $_FILES['cover'];
			print_r($file);

			$new_name = $this->session->userdata('user_id').'_cover.png';

			$config['upload_path'] = './uploads/';
	        $config['allowed_types'] = 'gif|jpg|jpeg|png';
	        $config['max_size'] = '9999000';
	        $config['max_width']  = '2024';
	        $config['max_height']  = '1768';
	        $config['overwrite'] = TRUE;
	        $config['file_name'] = $new_name;

	        $cover_name = $new_name;

	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('cover'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            print_r($error);

	            //$this->load->view('upload_form', $error);
	        }
	        else
	        {
	            $dataUp = array('upload_data' => $this->upload->data());
	            print_r($dataUp);

	            //$this->load->view('upload_success', $data);
	        }
		}

		if (isset($_FILES['logo'])) {
			print_r('file---');

			$file = $_FILES['logo'];

			$new_name = $this->session->userdata('user_id').'_logo.png';

			print_r($file);

			$config['upload_path'] = './uploads';
	        $config['allowed_types'] = 'gif|jpg|jpeg|png';
	        $config['max_size'] = '9999000';
	        $config['max_width']  = '2024';
	        $config['max_height']  = '1768';
	        $config['overwrite'] = TRUE;
	        $config['file_name'] = $new_name;

	        $logo_name = $new_name;

	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('logo'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            print_r($error);

	            //$this->load->view('upload_form', $error);
	        }
	        else
	        {
	            $dataUp = array('upload_data' => $this->upload->data());
	            print_r($dataUp);

	            //$this->load->view('upload_success', $data);
	        }
		}

		$this->load->model('user_model');

		if($this->input->post('fullname')) {

			$updateUser = array(
			        'fullname' => $this->input->post('fullname'),
			        'email' => $this->input->post('email'),
			        'company_name' => $this->input->post('company_name'),
			        'company_website' => $this->input->post('company_website'),
			        'company_about' => $this->input->post('company_about'),
			        'company_about_header' => $this->input->post('company_about_header'),
			        'company_cover' => $cover_name,
			        'company_logo' => $logo_name,
			    );

			// print_r($updateUser);
			// die();

			$this->user_model->updateUser($updateUser);
		}
	}




}













