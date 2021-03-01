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
	
	
	
		function index()
	{
		
			$this->load->model('User_model');
			$data['main_content'] = 'courses/index';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);
		
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
	
	
	function diplomainit()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/diplomainit';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		function diplomainleadershipandmanagement()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/diplomainleadershipandmanagement';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		
		
		
		function bachelorinitc()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/bachelorinitc';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		
	
		function bachelorinbusiness()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/bachelorinbusiness';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		
		
			function bachelorincommerce()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/bachelorincommerce';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		function bachelorofinformationsystem()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/bachelorofinformationsystem';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		
		function masteroftechnology()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/masteroftechnology';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		
		
		function masterofprofessionalaccounting()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/masterofprofessionalaccounting';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		
		function masterofbusinessadminstrator()
		{
			
			
			$this->load->model('User_model');
			$data['main_content'] = 'courses/masterofbusinessadminstrator';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);

			
				
		}
		
		
		
		
		
		
		
		
		
	
	
	function accountingpyp()
	{
		
			$this->load->model('User_model');
			$data['main_content'] = 'courses/accountingpyp';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);
		
	}
	
		function acsprofessionalyearprogram()
	{
		
			$this->load->model('User_model');
			$data['main_content'] = 'courses/acsprofessionalyearprogram';
			$val=$this->uri->segment_array();
			$params= end($val);
			$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
			$data['title']=$data['pageseco_detail'][0]['title'];
			$data['meta_description']=$data['pageseco_detail'][0]['meta_description'];
			$data['meta_keywords']=$data['pageseco_detail'][0]['meta_keywords'];
			$this->load->view('includes/template', $data);
		
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
