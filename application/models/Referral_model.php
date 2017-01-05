<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Referral_model extends CI_Model {

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

        public function createReferral($referral_details) {

                $collection = "Referral";
                $createdAt = new DateTime();
                $updatedAt = new DateTime();
                $email = "";
                $relationship = "";
                $referral_id = uniqid();
                $job_id = "";
                $fullname = "";
                $referred_from = "";

                $referral_chain = [];

                if(isset($referral_details['fullname'])) {
                        $fullname = $referral_details['fullname'];
                }

                if(isset($referral_details['email'])) {
                        $email = $referral_details['email'];
                }

                if(isset($referral_details['relationship'])) {
                       $relationship = $referral_details['relationship'];
                }

                if(isset($referral_details['job_id'])) {
                        $job_id = $referral_details['job_id'];
                }

                if(isset($referral_details['referred_from'])) {
                        $referred_from = $referral_details['referred_from'];

                        $referral_details = $this->fetchReferralDetails($referred_from);

                        if(isset($referral_details['referral_chain'])) {
                            $referral_chain = json_decode($referral_details['referral_chain'],true);
                        }
                }

                $referral['name'] = $fullname;
                $referral['referral_id'] = $referral_id;
                //$encode_ref = json_encode($referral,true);
                array_unshift($referral_chain, $referral);

                //return 'fsdfdfd '. $referral_from;
                //die();

                 if(strlen($referred_from) > 0) {

                    //return 'fdfsfdfd '.$referral_from;

                    $newReferral = array(
                        'createdAt' => $createdAt,
                        'updatedAt' => $updatedAt,
                        'job_id' => $job_id,
                        'referral_id' => $referral_id,
                        'referred_from' => $referred_from,
                        "relationship" => $relationship,
                        'email' => $email,
                        'fullname' => $fullname,
                        'referral_chain' => json_encode($referral_chain)
                    );

                 } else {

                    $newReferral = array(
                        'createdAt' => $createdAt,
                        'updatedAt' => $updatedAt,
                        'job_id' => $job_id,
                        'referral_id' => $referral_id,
                        'relationship' => $relationship,
                        'email' => $email,
                        'fullname' => $fullname,
                        'referral_chain' => json_encode($referral)
                    );
                 }
                

                $this->mlabapi->insert($collection, $newReferral);

                return $newReferral;
        }

        public function fetchReferralDetails($referral_id) {

            $collection = "Referral";
            $result = [];

            if(isset($referral_id)) {

                $result = $this->mlabapi->fetchReferral($collection, array('referral_id' => $referral_id));

                if(count($result) > 0) {
                    return $result[0];
                }
            }

            return $result;
        }

        public function updateReferral($referral_details) {

                $collection = "Referral";

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