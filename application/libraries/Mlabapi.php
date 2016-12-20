<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


Class Mlabapi {
		
	public function insert($collection, $data) {

		$database = 'nudjdev-db';
    	$api = 'qVYE6-toZLjN3OKwl6cP-j3hoL5DSXMH';
    	$url = 'https://api.mlab.com/api/1/databases/nudjdev-db/collections/';

		$url = $url.$collection.'?apiKey='.$api;

		$data = json_encode($data);
		$this->do_post_request($url, $data);
	}

	public function fetch($collection, $data, $optional_limit = NULL) {

		$database = 'nudjdev-db';
    	$api = 'qVYE6-toZLjN3OKwl6cP-j3hoL5DSXMH';
    	$url = 'https://api.mlab.com/api/1/databases/nudjdev-db/collections/';


    	if($optional_limit != NULL) {
    		$url = $url.$collection.'?q={"email":"'.$data['email'].'"}&l='.$optional_limit.'&apiKey='.$api;
    	} else {
    		$url = $url.$collection.'?q={"email":"'.$data['email'].'"}&apiKey='.$api;
    	}

		

		$result = json_decode(file_get_contents($url),true);
		return $result;
	}

	public function fetchJobs($collection, $data, $optional_limit = NULL) {

		$database = 'nudjdev-db';
    	$api = 'qVYE6-toZLjN3OKwl6cP-j3hoL5DSXMH';
    	$url = 'https://api.mlab.com/api/1/databases/nudjdev-db/collections/';


    	if($optional_limit != NULL) {
    		$url = $url.$collection.'?q={"user_id":"'.$data['user_id'].'"}&l='.$optional_limit.'&apiKey='.$api;
    	} else {
    		$url = $url.$collection.'?q={"user_id":"'.$data['user_id'].'"}&apiKey='.$api;
    	}

		

		$result = json_decode(file_get_contents($url),true);
		return $result;
	}

	public function fetchJob($collection, $data, $optional_limit = NULL) {

		$database = 'nudjdev-db';
    	$api = 'qVYE6-toZLjN3OKwl6cP-j3hoL5DSXMH';
    	$url = 'https://api.mlab.com/api/1/databases/nudjdev-db/collections/';


    	if($optional_limit != NULL) {
    		$url = $url.$collection.'?q={"job_code":"'.$data['job_code'].'"}&l='.$optional_limit.'&apiKey='.$api;
    	} else {
    		$url = $url.$collection.'?q={"job_code":"'.$data['job_code'].'"}&apiKey='.$api;
    	}

		$result = json_decode(file_get_contents($url),true);
		return $result;
	}

	public function update($collection, $data) {
		
	}

	private function do_post_request($url, $data, $optional_headers = null)
	{

	  $opts = array('http' =>
	      array(
	          'method'  => 'POST',
	          'header'  => 'Content-type: application/json',
	          'content' => $data
	      )
	  );

	  $context  = stream_context_create($opts);
	  $result = file_get_contents($url, false, $context);

	  //print_r($result);
	  //die();
	  //return $result;
	}
}
