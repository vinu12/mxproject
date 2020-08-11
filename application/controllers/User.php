<?php

include_once APPPATH . '/libraries/facebook-php-sdk/src/facebook.php';
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller {

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

	
	
    function index() {

		$this->load->model('User_model');
        $logid = $this->session->userdata('logid');
		$data['uname'] = $this->session->userdata('uname');
        $data['login_id'] = $this->session->userdata('login_id');
        $data['logid'] = $this->session->userdata('logid');
		$data['courseslist'] = $this->User_model->courseslist();
		
		$this->load->helper('url');
		$page_url=current_url();
	    $data['page_url'] = $page_url;
		
		
		$this->load->view('admin/index', $data);
    }
	
	
	function program()
	{
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
		$data['main_content'] = 'admin/program';
        $this->load->view('includes/template', $data);
		
	}
	
	function ielts()
	{
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
		$data['main_content'] = 'admin/ielts';
        $this->load->view('includes/template', $data);
		
	}
	
	
	function aboutus()
	{	
		$data = array();
        $data['role'] = $this->session->userdata('role');
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
        $data['main_content'] = 'admin/aboutus';
        $this->load->view('includes/template', $data);
		
	}
	
	
	
	function ourservices()
	{	
		$data = array();
        $data['role'] = $this->session->userdata('role');
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
        $data['main_content'] = 'admin/ourservices';
        $this->load->view('includes/template', $data);
		
	}
	
	function login()
	{
		
		$data = array();
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/login';
        $this->load->view('includes/template', $data);
		
	}
	
	
	
	function contactus()
	{
		$data = array();
        $data['role'] = $this->session->userdata('role');
		 $this->load->model('Users_model');
		 $this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
		
		if (isset($_REQUEST['submit'])!='') {
			
		

            if ($this->input->post("submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Firstname', 'trim|required|min_length[4]|max_length[30]|alpha');
				
				
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				
				
                $this->form_validation->set_rules('phone', 'Phone No', 'trim|required|numeric|max_length[30]');
				
			
				
				
                $this->form_validation->set_rules('course', 'Course', 'trim|required|min_length[4]|max_length[40]');
				
					

				$this->form_validation->set_rules('Location', 'Location', 'trim|required|min_length[4]|max_length[30]|alpha');
				
			
				$this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[4]|max_length[10]|alpha');
				
				
				
				$this->form_validation->set_rules('message', 'message', 'trim|required|min_length[4]|max_length[300]');
				
				

                if ($this->form_validation->run() == FALSE) {

				    //$this->load->view('form1');
                   $this->session->set_flashdata('error', 'Please check fill data.');
				   
					
				   
				   
				   
				   
                } else {
					
				
				
		
					
					
					$dataarray = array();
                    $dataarray['name'] = $this->input->post('name');
					$dataarray['Location'] = $this->input->post('Location');
					$dataarray['email'] = $this->input->post('email');
					$dataarray['phone'] = $this->input->post('phone');
					$dataarray['course'] = $this->input->post('course');
					$dataarray['country'] = $this->input->post('country');
					$dataarray['message'] = $this->input->post('message');
					//$dataarray['date_equiry'] = date('Y-m-d h:m:s');
					$insertid = $this->Users_model->ContactenquiryData($dataarray);
					
					$this->session->set_flashdata('success', 'Success! Your mesasage has sent successfully.We will reach you soon.');
					
					$name =$this->input->post('name');
					$email=$this->input->post('email');
					$tel=$this->input->post('phone');
					$location=$this->input->post('Location');
					$country=$this->input->post('country');
					$course= $this->input->post('course');
					$message=$this->input->post('message');
					
					
           $message = "
          <!DOCTYPE html>
          <html>
           <head>
            <meta charset='utf-8'/>
            <title>I will Pro</title>
            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
           </head>
           <body>
            <table>
             <tr>
              <td><h4>Hi Team,</h4></td>
             </tr>
             
			 <tr>
              <td>Please find below the New User Enquiry</td>
             </tr>
			 
			 <tr><td>Name</td><td>$name</td></tr>
			 <tr><td>Email</td><td>$email</td></tr>
			 <tr><td>Phone No</td><td>$tel</td></tr>
			 <tr><td>course</td><td>$course</td></tr>
			 <tr><td>Phone No</td><td>$tel</td></tr>
			 <tr><td>location</td><td>$location</td></tr>
			 <tr><td>country</td><td>$country</td></tr>
			 <tr><td>Message</td><td>$message</td></tr>
             </tr>
			 
			 
			 
			  <tr>
              <td>Thank you</td>
             </tr>
             
            
             
           </table>

          </body>
          </html>
         ";
			$headers = "From:no-reply@iwilpro.com\r\n";
			$headers .= "Mime-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		    $toEmail = $email; 

			$subject = "Contact us Enquiry of i wil Pro";
		    //$mail_sent = mail($toEmail, $subject, $message, $headers);

			//$this->mailsendf($subject, $message);
			redirect('User/contactus'); 
					
				}
			}
		}
		
		
        $data['main_content'] = 'admin/contactus';
        $this->load->view('includes/template', $data);
	}
	
	
	
	function redirect()
	{
		$data = array();
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'User/redirect';
        $this->load->view('includes/template', $data);
	}

    function terms_conditions() {

        $data['uname'] = $this->session->userdata('uname');
        $data['login_id'] = $this->session->userdata('login_id');
        $data['logid'] = $this->session->userdata('logid');
        $this->load->view('admin/terms_conditions', $data);
    }

    function privacy_policy() {
        $data['uname'] = $this->session->userdata('uname');
        $data['login_id'] = $this->session->userdata('login_id');
        $data['logid'] = $this->session->userdata('logid');
        $this->load->view('admin/privacy_policy', $data);
    }

	
	
	function  term_condition()
	{
		$data['uname'] = $this->session->userdata('uname');
        $data['login_id'] = $this->session->userdata('login_id');
        $data['logid'] = $this->session->userdata('logid');
        $this->load->view('admin/term_condition', $data);
	}
	
	
	
	function privacy_policy_web()
	{
		
		$data['uname'] = $this->session->userdata('uname');
        $data['login_id'] = $this->session->userdata('login_id');
        $data['logid'] = $this->session->userdata('logid');
        $this->load->view('admin/privacy_policy_web', $data);
		
	}
	
	
	function ourteam()
	{
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
		$data['uname'] = $this->session->userdata('uname');
        $data['login_id'] = $this->session->userdata('login_id');
        $data['main_content'] = 'admin/ourteam';
        $this->load->view('includes/template', $data);
	}
	
	
	function subscribe()
	{
		 $this->load->model('Users_model');
		$email=$_REQUEST['email'];
		$data=array();
		$data['email']=$email;
		$emailResult1 = $this->Users_model->subscribe_checkEmailExist($email);
		if($emailResult1!=0)
		{
			echo "Email already subscribe.";
		}
		else{
			
		$emailResult = $this->Users_model->subscribe_user_Record($data);
		if ($emailResult) {
			echo "Email id subscribe successfully.";
		}
		}
		die;
	}
	
	
	
	 function loginuser() {
		
		//$this->isLoggedIn();
		$this->load->helper('security');
        $this->load->model('Login_model');
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
		 if (isset($_REQUEST['submit'])!="") {
			 
			
			
        $this->load->library('form_validation');
        $this->form_validation->set_rules('useremail', 'Email', 'trim|required');
        $this->form_validation->set_rules('pword', 'password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please check fill data.');
        } else {
            $email =  $this->security->xss_clean($this->input->post('useremail'));
            $password =  $this->security->xss_clean($this->input->post('pword'));
			
			

            $emailResult = $this->Login_model->checkEmailExist($email);
            if ($emailResult == 0) {
                $this->session->set_flashdata('success', 'Email id not exist in our record.');
            }
            $loginDataResult = $this->Login_model->loginMe($email, $password);
			
			
			
			
			

            if (!empty($loginDataResult)) {
                $logid = $loginDataResult[0]['id'];
                $user_email = $loginDataResult[0]['user_email'];
                $user_name = $loginDataResult[0]['user_name'];

	


                $data_session_set = array('email' => $user_email, 'uname' => $user_name, 'logid' => $logid);
				
                $sessid = $this->session->set_userdata($data_session_set);


                $isLoggedIn = $this->session->userdata('logid');
				$email = $this->session->userdata('email');
				$uname = $this->session->userdata('uname');
				

                if ($isLoggedIn == TRUE) {
                    redirect('user/index');
                }
            } else {
                $this->session->set_flashdata('success', 'Email id or password not exist in our record.');
                redirect('User/login');
            }
        }
		 }
    }
	
	
	
	
    function register() {
        $this->load->model('Users_model');
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
        if (isset($_REQUEST['submit'])!="") {
			
            if ($this->input->post("submit") != false) {
					

                $this->load->library('form_validation');
                $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('pword', 'Password', 'trim|required|min_length[6]|max_length[8]');

                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {

                    $checkdataval = $this->Users_model->checkexistdata($this->input->post('email'));
                    if ($checkdataval != '') {
                        $this->session->set_flashdata('error', 'Warning! Email id already register with us, Please enter different email id.');
                        redirect('User/register');
                    }


                    $dataarray = array();
					
                    $dataarray['user_name'] = $this->input->post('username');
                    $dataarray['user_dob'] = '';
                    $dataarray['user_email'] = $this->input->post('email');
                    $dataarray['sourcemedia'] = 'Desktop';
                    $dataarray['user_mobile'] = '';
                    $dataarray['siteid'] = 'iwilpro';
                    $dataarray['password'] = md5($this->input->post('pword'));
                   
                    
                    $dataarray['oauth_uid'] = '';
                    $dataarray['token_security'] = '';
                    $dataarray['tokenid'] = '';
                    $dataarray['deviceid'] = '';
                    $dataarray['photo'] = '';
                    
                    $dataarray['latitude'] = '';
                    $dataarray['longitude'] = '';
                    $dataarray['city'] = '';
                   
                    $dataarray['user_gender'] = '';
                    $dataarray['country'] = '';
                    $dataarray['modified'] = date("Y-m-d") . " " . date("H:i:s");
                    $dataarray['notificationsetting'] = 0;
					$dataarray['created'] = date("Y-m-d") . " " . date("H:i:s");
                    $dataarray['create_at'] = militime;
                    $dataarray['update_at'] = militime;
                    $dataarray['status'] = 0;
					
				
					$insertid = $this->Users_model->RegisterUserRecord($dataarray);
                   
                    $this->session->set_flashdata('success', 'Success! You have registered successfully. Please check your email and click on the link provided to activate your account.');

                    $verifyid = base64_encode($insertid);
                    

			$name = $this->input->post('username');
			$verifyurl = base_url() . "User/Verifyaccount/" . $verifyid;
			
			$message = "
          <!DOCTYPE html>
          <html>
           <head>
            <meta charset='utf-8' />
            <title>IwilPro</title>
            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
           </head>
           <body>
            <table style='text-align:left;'>
             <tr>
              <td><h4>Dear $name,</h4></td>
             </tr>
             
             <tr>
              <td>Thank you for signing up in the i wil pro!</td>
             </tr>
             
             <tr>
              <td>This email confirms your application. To complete this process, click on the link below to verify your application:<br>
              
              <a href='$verifyurl'>Confirm Email Address</a></td>
             </tr>
             
             <tr>
               <td style='text-align:left;'><h3>Thank you<br>I Wil Pro Team</h3></td>
             </tr>
             
           </table>

          </body>
          </html>
         ";
                        $headers = "From:no-reply@iwilpro.com\r\n";
                        $headers .= "Mime-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                        //$toEmail = $email; 

                        $subject = "Thank You for Signing Up with i Will Pro";
                        //$mail_sent = mail($toEmail, $subject, $message, $headers);

                        $this->mailsendf($subject, $message);



                        redirect('User/register'); 
                    
                }
            }
        }
	    $data['main_content'] = 'admin/register';
        $this->load->view('includes/template', $data);	 
    }
	
	

    function mailsendf($subject, $body) {

        define('SENDER', 'info@beyondteaching.com');
        define('RECIPIENT', 'vinod.maurya1@gmail.com');
        define('USERNAME', 'AKIAI2CBJI3MNRHJ74ZA');
        define('PASSWORD', 'An2qK+tBF6SX5lF/BNavr3i2/D3Z8RYAL+8WfBiestqp');
        define('HOST', 'email-smtp.us-east-1.amazonaws.com');
        define('PORT', '25');
        define('SUBJECT', 'Amazon SES test (SMTP interface accessed using PHP)');



        define('BODY', 'This email was sent through the Amazon SES SMTP interface by using PHP');

        require_once 'Mail.php';

        $headers = array(
            'From' => SENDER,
            'To' => RECIPIENT,
            'Subject' => $subject,
            'MIME-Version' => 1,
            'Content-type' => 'text/html;charset=iso-8859-1'
        );

        $smtpParams = array(
            'host' => HOST,
            'port' => PORT,
            'auth' => true,
            'username' => USERNAME,
            'password' => PASSWORD
        );
        $mail = Mail::factory('smtp', $smtpParams);

        $result = $mail->send(RECIPIENT, $headers, $body);

        if (PEAR::isError($result)) {
            echo("Email not sent. " . $result->getMessage() . "\n");
        } else {
            echo("Email sent!" . "\n");
        }
    }

    function Verifyaccount($id) {
        $this->load->model('Users_model');
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
        $updateid = base64_decode($id);
        
        $updateRecord = array();
        $updateRecord['status'] = 1;
        $this->db->where('id', $updateid);
        
        $resultdata = $this->db->update('user_register', $updateRecord);
        
        $this->session->set_flashdata('success', 'Success! You have successfully registered with us and your account has been activated successfully.');
        redirect('User/register');
    }

    

    function register1() {
        $data['uname'] = $this->session->userdata('uname');
        $data['login_id'] = $this->session->userdata('login_id');
        $data['logid'] = $this->session->userdata('logid');

        $this->load->helper('security');
        $this->load->model('Users_model');

        if ($this->input->post('submit2')) {




            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
            $this->form_validation->set_rules('shortbio', 'short bio', 'trim|required');
            $this->form_validation->set_rules('visa', 'visa', 'trim|required');
            $this->form_validation->set_rules('workpreference', 'Work Preference', 'trim|required');
            $this->form_validation->set_rules('skills', 'Skills', 'trim|required');
            $this->form_validation->set_rules('college', 'College', 'trim|required');
            $this->form_validation->set_rules('education', 'Education', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please check fill data.');
            } else {


                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $contact_number = $this->input->post('contact_number');
                $shortbio = $this->input->post('shortbio');
                $visa = $this->input->post('visa');
                $workpreference = $this->input->post('workpreference');
                $skills = $this->input->post('skills');
                $college = $this->input->post('college');
                $education = $this->input->post('education');
                $password = $this->input->post('password');


                $insertData['sourcemedia'] = 'Desktop';
                $insertData['siteid'] = 'AINA';
                $insertData['User_name'] = $name;
                $insertData['User_dob'] = '';
                $insertData['User_gender'] = '';
                $insertData['user_email'] = $email;
                $insertData['user_mobile'] = $contact_number;
                $insertData['password'] = $offer;
                $insertData['otp'] = '';
                $insertData['country'] = '';
                $insertData['city'] = '';
                $insertData['link'] = '';
                $insertData['create_at'] = militime;
                $insertData['update_at'] = militime;
                $insertData['date'] = date('Y-m-d h:m:s');

                $dataRes = $this->security->xss_clean($insertData);

                $recordcheck = $this->Users_model->addregsiter($dataRes);

                if ($recordcheck) {
                    $this->session->set_flashdata('success', 'Success! Thank you for submitting deals.');
                }
            }
        }



        $this->load->view('admin/register1', $data);
    }

    function logout() {
        $datasess['uname'] = $this->session->userdata('uname');
        $datasess['login_id'] = $this->session->userdata('login_id');

        $facebook = new Facebook($config);
        $config = array();
        $config['appId'] = '223130391611745';
        $config['secret'] = '4f42c4819cb43fe93ba8c62f58ef3e1d';
        $facebook = new Facebook($config);

        $token = $facebook->getAccessToken();
        $logouturl = $facebook->getLogoutUrl();
        $this->session->userdata('');

        unset($_SESSION);
        session_destroy();
        redirect('User/index');
    }

    /**
     * This function used to check the user is logged in or not
     */
}
