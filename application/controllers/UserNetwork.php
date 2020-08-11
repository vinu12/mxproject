<?php

include_once APPPATH . '/libraries/gplus/http.php';
include_once APPPATH . '/libraries/gplus/oauth_client.php';
include_once APPPATH . '/config/config.php';

class UserNetwork extends CI_Controller {

    function __construct() {
		
        parent::__construct();
        {
			date_default_timezone_set('Australia/canberra');
			$militime = round(microtime(true) * 1000);
			$datetime = date('Y-m-d h:i:s');
			define('militime', $militime);
			define('datetime', $datetime);
			require_once APPPATH.'third_party/src/Google_Client.php';
			require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
            $this->load->library('session');
			
			
			
        }
    }
	
	
	
	function isLoggedIn()
	{
		if ($this->session->userdata('logid')) 
		{
		
		

		} 
		else {
		redirect('/login');
		}
	}
		
	
	
	
	



    function forgotpassword() {

		//$this->isLoggedIn();
        $this->load->model('Login_model');
		$this->load->model('User_model');
		$data['courseslist'] = $this->User_model->courseslist();
		 $this->load->model('Users_model');
        $this->load->library('form_validation');
		
	
		if ($this->input->post("submit")!= false) {
			
	
        $email = $this->input->post('email');
        $emailResult = $this->Login_model->checkEmailExist($email);
        if ($emailResult == 0) {
				$this->session->set_flashdata('error', 'Email id not exist in our record.');
				
        } else {

            $emailResult = $this->Login_model->forgotpassword($email);
				
	
            $useremail = $emailResult[0]['user_email'];
            $password = $this->rand_string(8);
            $user_name = $emailResult[0]['user_name'];
			
			
			$message ="
					<!DOCTYPE html>
					<html>
						<head>
							<meta charset='utf-8' />
							<title>Beyond Teaching</title>
							<meta name='viewport' content='width=device-width, initial-scale=1.0' />
						</head>
						<body>
							<table style='text-align:left;'>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<h4>Hi $user_name,</h4>
								<h4>Your Login Credentials details are bellow:</h4>

								<tr>
										<th style='text-align:left;'>Username:</th>
										<td style='text-align:left;'> $useremail </td>
								</tr>
								
								<tr>
										<th style='text-align:left;'>Your Requested new password:</th>
										<td style='text-align:left;'> $password </td>
								</tr>

								
								<tr>
										<th style='text-align:left;'><h3>Thank you <br>I Wil Pro Team</h3></th>
								</tr>
								
						</table>

					</body>
					</html>
					";



					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= "From:no-reply@iwilpro.com\r\n";
					$headers .= "Bcc:<iwilppro@gmail.com> \r\n";

					$toEmail = $useremail;	

					$subject="Password reset";
					//$mail_sent = mail($toEmail, $subject, $message, $headers);
					$mail_sent = $this->mailsendf($subject, $message);
			
				   if($mail_sent)
				   {
					   $updateArray=array();
					   $updateArray['password']=md5($password);
					   $this->db->where('user_email', $useremail);
					   $resultdata = $this->db->update('user_register', $updateArray);
				       
					   
				   }
				    $this->session->set_flashdata('success', 'Password sent to your email. Please check  your email.');
					redirect('User/login/');
        }
		}
        $data['main_content'] = 'usernetwork/forgotpassword';
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
	
	
	
		function rand_string( $length ) {

		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars),0,$length);

		}
		
		
		public function google_login()
	{
	    
	    $this->load->model('Common_model');
		$clientId = '81254462456-2bvguapq3ouuucm9vm0aub14jifaib9u.apps.googleusercontent.com'; //Google client ID
		$clientSecret = 'M1cc9BeHwD20NGwhjfkInMMO'; //Google client secret
		$redirectURL = base_url() . 'UserNetwork/google_login/';
		
		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		
		
		if(isset($_GET['code']))
		{
			
			
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) 
		{
			$gClient->setAccessToken($_SESSION['token']);
		}
		
		if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
			$authid= $userProfile['id'];
			$email= $userProfile['email'];
			$verified_email= $userProfile['verified_email'];
			$name= $userProfile['name'];
			$given_name= $userProfile['given_name'];
			$family_name= $userProfile['family_name'];
			$link= $userProfile['link'];
			$picture= $userProfile['picture'];
			if($userProfile['gender']!="")
			{
			$gender= $userProfile['gender'];
			}
			else
			{
				$gender='';
			}
			$locale= $userProfile['locale'];
			$this->load->model('Users_model');
			$recordCheck = $this->Users_model->googlecheckuser($email);
			
			if($recordCheck!=0)
			{
				
				
				
				$date = date("Y-m-d") . " " . date("H:i:s");
				$updateRecord = array();
				$updateRecord['oauth_uid'] = $authid;
                $updateRecord['user_name'] = $name;
                $updateRecord['user_email'] = $email;
                $updateRecord['status'] = 1;
                $updateRecord['link'] = $link;
                $updateRecord['user_gender'] = $gender;
                $updateRecord['photo'] = $picture;
                $updateRecord['modified'] = $date;
				$updateRecord['oauth_provider']='google';
				
                //$this->db->where('oauth_uid', $authid);
                $this->db->where('user_email', $email);
                $resultdata = $this->db->update('user_register', $updateRecord);
                $recordcheckid = $this->Users_model->getprofileid($authid);
                
                 $userdetails = $this->Common_model->common_getRow('user_register',array('oauth_uid'=>$authid));
                 $emailuser = $userdetails->user_email;
                
                $data_session_set = array('login_id' => $authid, 'uname' => $name, 'logid' => $recordcheckid,'email'=>$emailuser);
                $sessid = $this->session->set_userdata($data_session_set);
				redirect(base_url());
				
				
			}
			else
		    {
				/*** Insert code ***/
				$sourcemedia = 'Desktop';
                $siteid = 'iwilpro';
				$date = date("Y-m-d") . " " . date("H:i:s");
				$garray =array();
				$garray['oauth_uid']=$authid;
				$garray['user_gender']=$gender;
				$garray['photo']=$picture;
				
				$garray['oauth_provider']='google';
				$garray['siteid']=$siteid;
				$garray['user_name']=$name;
				$garray['sourcemedia']=$sourcemedia;
				$garray['user_email']=$email;
				$garray['created']=$date;
				$garray['modified']=$date;
				$garray['status']=1;
				$garray['create_at']=militime;
				$garray['update_at']=militime;
				$recordCheck = $this->Users_model->googleinsertuser($garray);
				
				if($recordCheck==1)
				{
				
				 $userdetails = $this->Common_model->common_getRow('user_register',array('oauth_uid'=>$authid));
                 $emailuser = $userdetails->user_email;
		     
				
			    $recordcheckid = $this->Users_model->getprofileid($authid);
                $data_session_set = array('login_id' => $authid, 'uname' => $name, 'logid' => $recordcheckid,'email'=>$emailuser);
                $sessid = $this->session->set_userdata($data_session_set);
				redirect('User/index');
				}
				
			}
			
			
			
        } 
		else 
		{
            $url = $gClient->createAuthUrl();
		    header("Location: $url");
            exit;
        }
	}
	
	

 
}
