<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {

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
                // Call the CI_Model constructor
                parent::__construct();
                
        }

        public function signUp($newUser) {

                $emailExists = $this->checkIfEmailExists($newUser['email']);

                if($emailExists){
                        return false;
                }

                $collection = 'User';

                $password_input = $newUser['password_input'];

                $password_hash = $this->createPassword($password_input);
                $createdAt = new DateTime();
                $updatedAt = new DateTime();


                $fullname = $newUser['fullname'];
                $fullnameWithoutSpaces = preg_replace('/\s+/', '', $newUser['fullname']);
                $username = $fullnameWithoutSpaces.uniqid();

                $newUser = array(
                        'fullname' => $fullname,
                        'email' => $newUser['email'],
                        'username' => $username,
                        'location' => $newUser['location'],
                        'password_hash' => $password_hash,
                        "user_id" => uniqid(),
                        'google_auth' => false,
                        'linkedin_auth' => false
                    );

                $this->mlabapi->insert($collection, $newUser);
                //$this->saveSession($newUser);
                $this->saveSessionUser($newUser);

                return true;
        }


        // GOOGLE AUTHENTICATION
        public function google_auth($user) {

            $email = $user['email'];

            $emailExists = $this->checkIfEmailExists($user['email']);

            if($emailExists){

                $collection = 'User';

                $result = $this->mlabapi->fetch($collection, array('email' => $user['email']));
                $user_result = $result[0];

                $user_result['linkedin_auth'] = false;
                $user_result['google_auth'] = true;

                //$this->saveSession($user_result);
                $this->saveSessionUser($user_result);

                return true;

            } else {

                $collection = 'User';

                $fullname = $user['fullname'];
                $fullnameWithoutSpaces = preg_replace('/\s+/', '', $user['fullname']);
                $username = $fullnameWithoutSpaces.uniqid();

                $newUser = array(
                        'fullname' => $fullname,
                        'email' => $user['email'],
                        'username' => $username,
                        'photo_url' => $user['photo_url'],
                        'google_auth' => true,
                        "user_id" => uniqid(),
                        'linkedin_auth' => false
                    );

                $this->mlabapi->insert($collection, $newUser);
                //$this->saveSession($newUser);
                $this->saveSessionUser($newUser);

                return true;
            }
        }


        // LINKEDIN AUTHENTICATION
        public function linkedin_auth($user) {

            $email = $user['email'];

            $emailExists = $this->checkIfEmailExists($user['email']);

            if($emailExists){

                $collection = 'User';

                $result = $this->mlabapi->fetch($collection, array('email' => $user['email']));
                $user_result = $result[0];
                $user_result['linkedin_auth'] = true;
                $user_result['google_auth'] = false;
                $this->saveSessionUser($user_result);

                return true;

            } else {

                $collection = 'User';

                $newUser = array(
                        'fullname' => $user['fullname'],
                        'email' => $user['email'],
                        'photo_url' => $user['photo_url'],
                        'lastname' => $user['lastname'],
                        'firstname' => $user['firstname'],
                        'location' => $user['location'],
                        'linkedin_profile' => $user['linkedin_profile'],
                        'description' => $user['description'],
                        "user_id" => uniqid(),
                        'linkedin_auth' => true,
                        'google_auth' => false
                    );

                $this->mlabapi->insert($collection, $newUser);
                //$this->saveSession($newUser);
                $this->saveSessionUser($newUser);

                return true;
            }

        }

        public function signIn($user) {

                $collection = 'User';

                $result = $this->mlabapi->fetch($collection, array('email' => $user['email']));

                if(count($result) > 0) {

                        $user_result = $result[0];

                        $password_input = $user['password_input'];
                        $password_user = $user_result['password_hash'];

                        if(password_verify($password_input, $password_user)) {
                                
                                $this->saveSessionUser($user_result);

                                return true;
                        } else {
                                return false;
                        }
                } else {
                        return false;
                }
        }

        public function userLoggedIn() {

                if($this->session->has_userdata('username')) {
                        return true;
                }
                return false;
        }

        public function saveSessionUser($userdata) {

            $fullname = $userdata['fullname'];
            $email = $userdata['email'];
            $location = "";
            $firstname = "";
            $lastname = "";
            $photo_url = "";
            $description = "";
            $acronym = "";
            $job_position = "";
            $linkedin_profile = "";
            $linkedin_auth = false;
            $google_auth = false;

            //echo("<script>console.log('PHP:".$email."');</script>");
            

            $fullnameWithoutSpaces = preg_replace('/\s+/', '', $fullname);
            $username = $fullnameWithoutSpaces.uniqid();

            if(isset($userdata['firstname'])) {
                $firstname = $userdata['firstname'];
            }

            if(isset($userdata['lastname'])) {
                $lastname = $userdata['lastname'];
            }

            if(isset($userdata['location'])) {
                $location = $userdata['location'];
            }

            if(isset($userdata['photo_url'])) {
                $photo_url = $userdata['photo_url'];
            }

            if(isset($userdata['linkedin_profile'])) {
                $linkedin_profile = $userdata['linkedin_profile'];
            }

            if(isset($userdata['description'])) {
                $description = $userdata['description'];
            }

            if(isset($userdata['job_position'])) {
                $job_position = $userdata['job_position'];
            }

            if(isset($userdata['linkedin_auth'])) {
                $linkedin_auth = $userdata['linkedin_auth'];
            }

            if(isset($userdata['google_auth'])) {
                $google_auth = $userdata['google_auth'];
            }

            if(strlen($photo_url) <= 0) {

                $names = explode(" ", $fullname);

                for($i = 0; $i < count($names); $i++) {

                    if($i == 0) {
                        
                        if(strlen($firstname) <= 0) {
                            $firstname = $names[0];
                        }
                        $acronym = $firstname[0];
                    } else if($i == 1) {
                        
                        if(strlen($lastname) <= 0) {
                            $lastname = $names[1];
                        }
                        $acronym = $acronym.$lastname[0];
                        break;
                    }
                }
            } else if (strlen($firstname) <= 0 || strlen($lastname) <= 0) {

                $names = explode(" ", $fullname);

                for($i = 0; $i < count($names); $i++) {

                    if($i == 0) {
                        
                        if(strlen($firstname) <= 0) {
                            $firstname = $names[0];
                        }
                    } else if($i == 1) {
                        
                        if(strlen($lastname) <= 0) {
                            $lastname = $names[1];
                        }
                        break;
                    }
                }
            }

            $user = array(
                        'fullname' => $fullname,
                        'email' => $email,
                        'username' => $username,
                        'photo_url' => $photo_url,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'linkedin_profile' => $linkedin_profile,
                        'description' => $description,
                        'location' => $location,
                        'acronym' => $acronym,
                        'job_position' => $job_position,
                        'user_id' => $userdata['user_id'],
                        'linkedin_auth' => $linkedin_auth,
                        'google_auth' => $google_auth
                    );

            $this->session->set_userdata($user);

            //return $user;
        }

        public function getCurrentUser () {
                //return session user


                $user = array(
                        'fullname' => $this->session->userdata('fullname'),
                        'email' => $this->session->userdata('email'),
                        'username' => $this->session->userdata('username'),
                        'photo_url' => $this->session->userdata('photo_url'),
                        'firstname' => $this->session->userdata('firstname'),
                        'lastname' => $this->session->userdata('lastname'),
                        'linkedin_profile' => $this->session->userdata('linkedin_profile'),
                        'description' => $this->session->userdata('description'),
                        'location' => $this->session->userdata('location'),
                        'acronym' => $this->session->userdata('acronym'),
                        'linkedin_auth' => $this->session->userdata('linkedin_auth'),
                        'user_id' => $this->session->userdata('user_id'),
                        'google_auth' => $this->session->userdata('google_auth')
                    );

                return $user;
        }

        public function checkIfEmailExists($email) {

                $collection = 'User';

                $result = $this->mlabapi->fetch($collection, array('email' => $email), 1);

                if(count($result) > 0) {
                        return true;
                } 

                return false;
        }

        public function updateUser() {

                //
        }

        public function logout() {

                $this->session->sess_destroy();
        }

        public function createPassword($password_input) {

                $password_hash = password_hash($password_input, PASSWORD_BCRYPT);

                return $password_hash;
        }

}