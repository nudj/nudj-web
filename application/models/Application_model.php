<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Application_model extends CI_Model {

        public $password_hash;
        public $password_salt;
        public $username;
        public $fullname;
        public $email;
        public $location;
        public $createdAt;
        public $updatedAt;
        public $collection;

        public function __construct()
        {
                parent::__construct();
                
        }

        public function createApplication($application_details) {

                $this->load->model('referral_model');

                $collection = "Application";
                $createdAt = new DateTime();
                $updatedAt = new DateTime();
                $email = "";
                $application_id = uniqid();
                $job_id = "";
                $name = "";
                $linkedin = "";
                $referred_from = "";

                $referral_chain = [];

                if(isset($application_details['name'])) {
                        $name = $application_details['name'];
                }

                if(isset($application_details['email'])) {
                        $email = $application_details['email'];
                }

                if(isset($application_details['linkedin'])) {
                       $linkedin = $application_details['linkedin'];
                }

                if(isset($application_details['job_id'])) {
                        $job_id = $application_details['job_id'];
                }

                if(isset($application_details['referred_from'])) {
                        $referred_from = $application_details['referred_from'];

                        $referral_details = $this->referral_model->fetchReferralDetails($referred_from);

                        if(isset($referral_details['referral_chain'])) {
                            $referral_chain = json_decode($referral_details['referral_chain'],true);
                        }
                }


                //return 'fsdfdfd '. $referral_from;
                //die();

                 if(strlen($referred_from) > 0) {

                    //return 'fdfsfdfd '.$referral_from;

                    $newApplication = array(
                        'createdAt' => $createdAt,
                        'updatedAt' => $updatedAt,
                        'job_id' => $job_id,
                        'application_id' => $application_id,
                        'referred_from' => $referred_from,
                        "linkedin" => $linkedin,
                        'email' => $email,
                        'name' => $name,
                        'referral_chain' => json_encode($referral_chain)
                    );

                 } else {

                    $newApplication = array(
                        'createdAt' => $createdAt,
                        'updatedAt' => $updatedAt,
                        'job_id' => $job_id,
                        'application_id' => $application_id,
                        'linkedin' => $linkedin,
                        'email' => $email,
                        'name' => $name,
                        'referral_chain' => json_encode($referral_chain)
                    );
                 }
                

                $this->mlabapi->insert($collection, $newApplication);

                return $newApplication;
        }

        public function fetchCandidatesCurrentJob($job_id) {

            $collection = "Application";

            if(isset($job_id)) {

                $result = $this->mlabapi->fetchApplication($collection, array('job_id' => $job_id));

                if(count($result) > 0) {
                    return $result;
                }
            }

            return $result;
        }

        public function updateApplication($referral_details) {

                $collection = "Application";

                $newJob = array(
                        
                    );

                $this->mlabapi->insert($collection, $newJob);
        }

        public function fetchJobsCurrentUser() {

            $collection = "Job";
            $result = [];

            if($this->session->userdata('user_id')) {
                
                $user_id = $this->session->userdata('user_id');
                $result = $this->mlabapi->fetchJobs($collection, array('user_id' => $user_id));
            }

            return $result;
        }

        public function fetchJobDetails($job_id) {

            $collection = "Job";
            $result = [];

            if(isset($job_id)) {

                $result = $this->mlabapi->fetchJob($collection, array('job_code' => $job_id));

                if(count($result) > 0) {
                    return $result[0];
                }
            }

            return $result;
        }

}