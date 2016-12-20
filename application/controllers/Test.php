<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	
	public function __construct()
    {
    	header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        parent::__construct();
    }
    
	public function index()
	{
		//$uri = 'mongodb://carmen-nudj:Nudj2016@ds149567.mlab.com:49567/nudjdev-db';

		$database = 'nudjdev-db';
		$api = 'qVYE6-toZLjN3OKwl6cP-j3hoL5DSXMH';
		$collection = 'User';

		//$this->mongo_db->connect();

		$result = file_get_contents('https://api.mlab.com/api/1/databases/'.$database.'/collections/'.$collection.'?apiKey='.$api);
		
		$query = '';

		$data['title'] = $result;

		$this->load->view('main_view', $data);
	}

	function insert()
	{
		$data = json_decode(file_get_contents('php://input'));
		$url = 'https://api.mlab.com/api/1/databases/mbraras/collections/nilai?q={"uname":"'.$data->uname.'"}&apiKey=api';
		$result = json_decode(file_get_contents($url));
		if (count($result) == 1) {
			echo "Username sudah pernah mengirim nilai";
		} else {
			$url = 'https://api.mlab.com/api/1/databases/mbraras/collections/nilai?apiKey=api';
			$data = json_encode($data);
			$this->do_post_request($url, $data);
			echo json_encode(true);
		}
	}

	function do_post_request($url, $data, $optional_headers = null)
	{
	  $opts = array('http' =>
	      array(
	          'method'  => 'POST',
	          'header'  => 'Content-type: application/json',
	          'content' => $data
	      )
	  );
	  $context = stream_context_create($opts);
	  $result = file_get_contents($url, false, $context);
	  return $result;
	}
}
