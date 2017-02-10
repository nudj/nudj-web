<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
    }

    public function index() {
    	
        //show_404();

    	$this->load->model('job_model');

    	$jobID =  $this->uri->segment(3);
        $referralIDFrom =  $this->uri->segment(5);

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

        $logo_filename = $jobDetails['user_id'].'_logo.png';
        $url_logo = "./uploads/".$logo_filename;
        if(file_exists($url_logo)) {
            $data['logo_filename'] = $logo_filename;
        }

    	$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('apply/template_apply_view', $data);
		$this->load->view('templates/footer');
    }

    public function applyJobEmail() {

        $this->load->model('application_model');

        $refer = $this->input->post('referred_from');

        //echo $refer."   ---  dffgd";
        $filename = $_FILES['file']['name'];

        //print_r($this->input->post('job_id') . " uuuu");

        if($this->input->post('job_id')) {
            
            $newApplication = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'linkedin' => $this->input->post('linkedin'),
                    'job_id' => $this->input->post('job_id'),
                    'referred_from' => $refer
                );

            $applicationCreated = $this->application_model->createApplication($newApplication);

            if($applicationCreated) {

                if(isset($applicationCreated['email']) && isset($applicationCreated['name']) ) {

                    $wasReferred = (strlen($refer) > 0) ? "Yes" : "No" ;
                    $applicationCreated['wasReferred'] = $wasReferred;
                    
                    $this->customSendMail($applicationCreated);
                }
            }
        }

    }

    public function customSendMail($applicationCreated) {
    

          $messageC = '
          <html>
          <head>
            <title>Mail from '. $applicationCreated['name'] .'</title>
          </head>
          <body>
          <br/>
            <table style="width: 600px; font-family: arial; font-size: 14px;border:1px solid #999;" border="0">
            <tr style="height: 50px;">
              <th align="right" style="width:150px; padding-right:15px;border:1px solid #999;">Name:</th>
              <td align="left" style="padding-left:15px; line-height: 20px;border:1px solid #999;">'. $applicationCreated['name'] .'</td>
            </tr>
            <tr style="height: 50px;">
              <th align="right" style="width:150px; padding-right:15px;border:1px solid #999;">E-mail:</th>
              <td align="left" style="padding-left:15px; line-height: 20px;border:1px solid #999;">'. $applicationCreated['email'] .'</td>
            </tr>
            <tr style="height: 50px;">
              <th align="right" style="width:150px; padding-right:15px;border:1px solid #999;">Linkedin:</th>
              <td align="left" style="padding-left:15px; line-height: 20px;border:1px solid #999;">'. $applicationCreated['linkedin'] .'</td>
            </tr>
            <tr style="height: 50px;">
              <th align="right" style="width:150px; padding-right:15px;border:1px solid #999;">Job URL:</th>
              <td align="left" style="padding-left:15px; line-height: 20px;border:1px solid #999;">'.base_url().'job/'.$applicationCreated['job_id'] .'</td>
            </tr>
            <tr style="height: 50px;">
              <th align="right" style="width:150px; padding-right:15px;border:1px solid #999;">Was referred:</th>
              <td align="left" style="padding-left:15px; line-height: 20px;border:1px solid #999;">'.$applicationCreated['wasReferred'] .'</td>
            </tr>
            </table>
            <br/><br/><br/>
          </body>
          </html>
          ';

            //Deal with the email
            $to = 'robyn@nudj.co';//'carmenelena.albu@gmail.com';//
            $subject = 'Application - Nudj';

            $message = $messageC;
            $content = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
            $filename = $_FILES['file']['name'];

            $separator = md5(time());
            $eol = "\r\n";

            // main header (multipart mandatory)
            $headers = "From: Nudj <hello@nudj.co>" . $eol;
            $headers .= "MIME-Version: 1.0" . $eol;
            $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
            $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
            $headers .= "This is a MIME encoded message." . $eol;

            // message
            $body = "--" . $separator . $eol;
            $body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
            $body .= "Content-Transfer-Encoding: 8bit" . $eol;
            $body .= $message . $eol;

            // attachment
            $body .= "--" . $separator . $eol;
            $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
            $body .= "Content-Transfer-Encoding: base64" . $eol;
            $body .= "Content-Disposition: attachment" . $eol;
            $body .= $content . $eol;
            $body .= "--" . $separator . "--";

            mail($to, $subject, $body, $headers);

            //CUSTOM EMAIL TO CANDIDATE


            $this->load->library('email');

            $this->email->from('hello@nudj.co', 'Nudj');
            $this->email->to($this->input->post('email'));
            $this->email->set_mailtype("html");

            $this->email->subject('Application received');
            $this->email->message('<html>
                                  <body>
                                  <br/>
                                    <p>Hey '.ucfirst($applicationCreated['name']).',</p>
                                    <p>Your application has been received. The hirer will be in touch shortly to tell you more about the role. </p>
                                    <br/>
                                    <p>Best of luck</p>
                                    <p>Love<br/> Team Nudj x</p>
                                    <br/><br/>
                                  </body>
                                  </html>');

            $this->email->send();


    }


	public function cef_man()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/powered_by');
		$this->load->view('apply/apply_cef_man');
		$this->load->view('templates/footer');
	}

    public function cef_fin()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/powered_by');
        $this->load->view('apply/apply_cef_fin');
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