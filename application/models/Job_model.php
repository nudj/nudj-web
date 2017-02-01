<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Job_model extends CI_Model {

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

        public function createJob($job_details) {

                $skills = "";
                $preferences = "";
                $referral_bonus = "";
                $collection = "Job";
                $createdAt = new DateTime();
                $updatedAt = new DateTime();
                $description = $job_details['description_job'];
                $title = $job_details['title_job'];
                $job_code = uniqid();
                $job_id = $job_code;
                $brief = "";

                if(isset($job_details['preferences'])) {
                        $preferences = $job_details['preferences'];
                }

                if(isset($job_details['brief'])) {
                        $brief = $job_details['brief'];
                }

                if(isset($job_details['skills'])) {
                       $skills = $job_details['skills'];
                }

                $salary = $job_details['salary'];
                $user_id = $this->session->userdata('user_id');

                if(isset($job_details['referral_bonus'])) {
                        $referral_bonus = $job_details['referral_bonus'];
                }

                $location = $job_details['location_job'];

                $company_name = 'Company';
                if($this->session->userdata('firstname') !== null) {
                    $company_name = $this->session->userdata('firstname');
                } else if($this->session->userdata('fullname') !== null) {
                    $arr = explode(' ',trim($this->session->userdata('fullname')));
                    $company_name = $arr[0];
                }

                $newJob = array(
                        'createdAt' => $createdAt,
                        'updatedAt' => $updatedAt,
                        'description_job' => $description,
                        'title_job' => $title,
                        'job_code' => $job_code,
                        'job_id' => $job_id,
                        "preferences" => $preferences,
                        'skills' => $skills,
                        'brief' => $brief,
                        'user_id' => $user_id,
                        'salary' => $salary,
                        'referral_bonus' => $referral_bonus,
                        'location' => $location,
                        'company_name' => $company_name
                    );

                $this->mlabapi->insert($collection, $newJob);

                return $job_id;
        }

        public function updateJob($job_details) {

                $collection = "Job";

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