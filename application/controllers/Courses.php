<?php

include_once APPPATH . '/libraries/facebook-php-sdk/src/facebook.php';
defined('BASEPATH') or exit('No direct script access allowed');

class Courses extends CI_Controller {

    function __construct() {

        parent::__construct(); {
            date_default_timezone_set('Australia/canberra');
            $militime = round(microtime(true) * 1000);
            $datetime = date('Y-m-d h:i:s');
            define('militime', $militime);
            define('datetime', $datetime);

            $this->load->library('session');
        }
    }

    /**
     * Author: Vinod K Maurya
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    // Remap the 404 error functions

	function encrypt($string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'fe67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844';
        $secret_iv = 'fdd3345455fffgffffhkkyoife67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    function decrypt($string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'fe67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844';
        $secret_iv = 'fdd3345455fffgffffhkkyoife67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
	
	
	
    function details($id) {

		$this->load->model('User_model');
		
		
		
        $logid = $this->session->userdata('logid');
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
		$data['uname'] = $this->session->userdata('uname');
		$data['email'] = $this->session->userdata('email');
		
        
        $data['logid'] = $this->session->userdata('logid');
		$data['courseslistByid'] = $this->User_model->courseslistbyid(base64_decode($id));
		
		
		$course_price=$data['courseslistByid'][0]['course_price'];
		$course_title=$data['courseslistByid'][0]['course_title'];
		$data_session_set = array('course_price' => $course_price, 'course_title' => $course_title);
		$sessrecord = $this->session->set_userdata($data_session_set);
		 
		 
		 $data['courseid'] = $this->encrypt($id);
		 $data['course_title'] = $this->session->userdata('course_title');
		 
		
		
		
		$data['main_content'] = 'admin/details';
        $this->load->view('includes/template', $data);
		
    }
	
	
	

    /**
     * This function used to check the user is logged in or not
     */
}
