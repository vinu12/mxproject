<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api extends CI_Controller {
function __construct() {
		parent::__construct();

		date_default_timezone_set('Australia/canberra'); 
		$militime =round(microtime(true) * 1000);
		$datetime =date('Y-m-d h:i:s');
		define('militime', $militime);
		define('datetime', $datetime);
		
	}
	
function mailsendf($subject,$body)
{

define('SENDER', 'info@beyondteaching.com');
define('RECIPIENT', 'vinod.maurya1@gmail.com,yjoshi@atmc.edu.au,mmittal@atmc.edu.au,atiwari@atmc.edu.au,sgupta@atmc.edu.au');
define('USERNAME','AKIAI2CBJI3MNRHJ74ZA');
define('PASSWORD','An2qK+tBF6SX5lF/BNavr3i2/D3Z8RYAL+8WfBiestqp');
define('HOST', 'email-smtp.us-east-1.amazonaws.com');
define('PORT', '25');
define('SUBJECT','Amazon SES test (SMTP interface accessed using PHP)');



define('BODY','This email was sent through the Amazon SES SMTP interface by using PHP');

require_once 'Mail.php';

$headers = array (
  'From' => SENDER,
  'To' => RECIPIENT,
  'Subject' =>$subject,
  'MIME-Version' => 1,
  'Content-type' => 'text/html;charset=iso-8859-1'
  
  );

$smtpParams = array (
  'host' => HOST,
  'port' => PORT,
  'auth' => true,
  'username' => USERNAME,
  'password' => PASSWORD
);
$mail = Mail::factory('smtp', $smtpParams);

$result = $mail->send(RECIPIENT, $headers, $body);

if (PEAR::isError($result)) {
  //echo("Email not sent. " .$result->getMessage() ."\n");
} else {
 // echo("Email sent!"."\n");
}
}	
	
	
/*  insertuser	
    //////verify->verifyemail
    verifyOTP 
    forgotpassword	 ======> verifyOTP
	///////verify->verifypassword
	resendOTP       ========> verifyOTP  
	resetpassword
	
	changepassword
	sociallogin
	userlogin
	getuserprofile
	updateprofile
		
	profiledatadelete
	
	logout
	newslist
	newsdetail
	
	newsbookmark
	bookmarklist
	
	visatypelist
	workplacelist
	
*/
	
	
	function _remap($method)
    {
        if(method_exists($this,$method))
        {
            call_user_func(array($this, $method));
            return false;
        }
        else
        {
			
			$dataa_array['methdodcheck'][]  = array(
					    			 					'status'=>'failed',	
							                  			'message'=>'Method not found',
														'responsecode'=>'404'
							                  			
										            );
			
            
        }
		header("content-type: application/json");
		echo json_encode($dataa_array);
    }



	
function random_password($length = 8) 
{
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
$password = substr( str_shuffle( $chars ), 0, $length );
return $password;
}	 



public function visatypelist()
{
	
	$this->load->model('Common_model');
	
	$visatype       = $this->db->query("SELECT * FROM visatype WHERE status='active'");				   
	$visarecord     = $visatype->result();
	$totalvisatype  = $visatype->num_rows();	
	
	if($totalvisatype>0)
	 {
		foreach($visarecord as $visalist){
			
			$id        = $visalist->id;
			$visaname  = $visalist->visatype;
			
			$dataa_array[]=array( 
			              'visaid'  =>$id,
						  'visatype'=>$visaname
						  );
	
		}
		
			$final_output['responsecode'] = '200';				
			$final_output['status'] = 'success';
			$final_output['data'] = $dataa_array;
		
	 }else{
		    $final_output['responsecode'] = '402';
			$final_output['status'] = 'failed';
			$final_output['message'] = 'Record not found';	
		 
	 }
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}

public function workplacelist()
{
	
	$this->load->model('Common_model');
	
	$worktype       = $this->db->query("SELECT * FROM workplace_category WHERE status='1'");				   
	$workrecord     = $worktype->result();
	$totalworktype  = $worktype->num_rows();	
	
	if($totalworktype>0)
	 {
		foreach($workrecord as $worklist){
			
			$id             = $worklist->id;
			$workplacename  = $worklist->workcategory;
			
			$dataa_array[]=array( 
			              'workplaceid'  =>$id,
						  'workplacetype'=>$workplacename
						  );
	
		}
		
			$final_output['responsecode'] = '200';				
			$final_output['status'] = 'success';
			$final_output['data'] = $dataa_array;
		
	 }else{
		    $final_output['responsecode'] = '402';
			$final_output['status'] = 'failed';
			$final_output['message'] = 'Record not found';	
		 
	 }
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}


	
/* Normal signup OTP  API */	
	
public function insertuser()
{
	$this->load->model('Common_model');
	$device_token = $this->input->post('device_token');
	$device_type  = $this->input->post('device_type');
	//$tokenid  = $this->input->post('token_id'); 
	$device_id = $this->input->post('device_id');
	
	$name     = $this->input->post('user_name');
	$email    = $this->input->post('user_email');
	$password = $this->input->post('password');
	$phoneno  = $this->input->post('user_mobile');
	//$usertype = $this->input->post('usertype');
	
	 
	
	$siteid      ='AINA';
	$date = date("Y-m-d")." ".date("H:i:s");
    //$otp  = strtoupper(substr(md5(uniqid()), 0, 6));
	$otp = sprintf("%06d", mt_rand(1, 999999));
	$status=0;
	 
   if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = $device_token;
    }


    $auth_key = $this->rand_string(40);

    $final_output = array();
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      //$emailErr = "Invalid email format"; 
  
			   if(!empty($email))
				{
				  
								$check_email = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
								
								if($check_email!="")
								{
									  
										$final_output['status'] = 'success';
										$final_output['message'] = 'User already registered.';	
										$final_output['responsecode'] = '400';
								
								}
								else
								{ 
							
									  $insert_array = array();
									  									  
									  $insert_array['oauth_provider']='';	
									  $insert_array['oauth_uid']='';
									  
									  $insert_array['token_security']=$auth_key;
									  $insert_array['sourcemedia']=$device_type;
									  
									  $insert_array['siteid']=$siteid;
									  $insert_array['tokenid']=$device_token;
									  $insert_array['deviceid']=$device_id;
									  
									  $insert_array['photo']='';
									  $insert_array['user_name']=$name;
									  $insert_array['user_dob']='';
									  $insert_array['user_gender']='';
									  $insert_array['user_email']=$email;
									  $insert_array['user_mobile']=$phoneno;
									  $insert_array['password']=md5($password);
									  $insert_array['bio']='';
									  $insert_array['otp']=$otp;
									  $insert_array['workplace']='';
									  $insert_array['country']='';
									  
									  $insert_array['latitude']='';									  
									  $insert_array['longitude']='';									  
									  $insert_array['city']='';		
									  
									  $insert_array['visatype']='';									  
									  $insert_array['visacountry']='';		

									  
									  $insert_array['link']='';
									  $insert_array['usertype']='';
									  $insert_array['newscount']=0;
									  
									  $insert_array['created']=$date;
									  $insert_array['modified']=$date;
									  $insert_array['create_at']=militime;
									  $insert_array['update_at']=militime;
									  
									  $insert_array['status']=$status;
									  
									  $insert_array['notificationsetting']='';
								
								
												 
						 $insertId = $this->db->insert('user_register', $insert_array);
						
						 $last_id = $this->db->insert_id();
						 //$lastid = base64_encode($last_id);
						 						 
						 $user_device['userid']=$last_id;
						 $user_device['sourcemedia']=$device_type;						 
						 $user_device['tokenid']=$device_token;
						 $user_device['deviceid']=$device_id;
						 $user_device['status']=$status;
						 
						 $userDevice = $this->db->insert('userdevice', $user_device);

						 //$verifyurl=base_url().'Verify/verifyemail/'.$last_id;
						  
						if($insertId)
						{		
						
                       /*
						$message ="
								  <!DOCTYPE html>
								  <html>
								   <head>
									<meta charset='utf-8' />
									<title>AINA</title>
									<meta name='viewport' content='width=device-width, initial-scale=1.0' />
								   </head>
								   <body>
									<table>
									 <tr>
									  <td><h4>Dear '".$name."',</h4></td>
									 </tr>
									 
									 <tr>
									  <td>Thank you for signing up in the AINA!</td>
									 </tr>
									 
									 <tr>
									  <td>This email confirms your application. To complete this process, click on the link below to verify your application:<br>
									  
									  <a href='".$verifyurl."'>Confirm Email Address</a></td>
									 </tr>
									 
									 <tr>
									   <td><h3>Thank you<br>AINA Team</h3></td>
									 </tr>
									 
								   </table>

								  </body>
								  </html>
								 ";
							  $headers = "From:no-reply@aina.today\r\n";
							  $headers.= "Mime-Version: 1.0\r\n";
							  $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

							  //$toEmail = $email; 
							  
							  $subject="Thank You for Signing Up with AINA";
							  //$mail_sent = mail($toEmail, $subject, $message, $headers);
							  
							   $this->mailsendf($subject,$message);*/
							   
							   
						$message ="
								  <!DOCTYPE html>
									<html>
										<head>
											<meta charset='utf-8' />
											<title>AINA</title>
											<meta name='viewport' content='width=device-width, initial-scale=1.0' />
									   
								   <style>
									table, th, td {
										border: 0px solid black;
										border-collapse: collapse;
									}
									th, td {
										padding: 5px;
										text-align: left;
									}
									</style>
									
									 </head>
										<body>
											<table>
												<tr>
													<td><h4>Dear '".$name."',</h4></td>
												</tr>
												
												<tr>
													<td><p>You have initiated account creation on AINA. Here is your OTP <b>'".$otp."'</b>.</p></td>
												</tr>
												
												<tr>
													<td><p>Never share your OTP, User ID or Password with anyone. Sharing these details can lead to unauthorised access to your account.<br>
													Looking forward to more opportunities to be of service to you.</p></td>
												</tr>
												
												
												<tr>
												   <th><h4>Sincerely, <br> AINA Team</h4></th>
												</tr> 
										</table>

									</body>
									</html>
									";
						$headers = "From:no-reply@aina.today\r\n";
						$headers.= "Mime-Version: 1.0\r\n";
						$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$toEmail = $email;	
						
						$subject="Thank You for Signing Up with AINA";
						$mail_sent = mail($toEmail, $subject, $message, $headers);	   
							   
					    $this->mailsendf($subject,$message);	  
								
						
						
						$final_output['responsecode'] = '200';
						$final_output['status'] = 'success';
						$final_output['message'] = 'Thank you for registration. We have sent OTP to your email id for verification. Please confirm your email id to login into the app.';	
						
						
							}else
							{ 
									$final_output['status'] = 'failed';
									$final_output['message'] = 'Something went wrong! please try again.';
									$final_output['responsecode'] = '400';
									//unset($final_output['data']);
							}	
				  }	
						
				}else
				{
					$final_output['status'] = 'failed';
					$final_output['message'] = 'Required parameter not found';
					$final_output['responsecode'] = '400';
					//unset($final_output['data']);
				}
		  }	else{
					$final_output['status'] = 'failed';
					$final_output['message'] = 'Invalid email format please check again.';
					$final_output['responsecode'] = '400';
		  }
 	header("content-type: application/json");
    echo json_encode($final_output);
}



  public function verifyOTP()
	{
		$this->load->model('Common_model');
		
		$email = $this->input->post('user_email');
		$otp   = $this->input->post('otp');
				
		$check_otp = $this->Common_model->verify_otp($email, $otp);
				
				
				if($check_otp==0)
				{
						$final_output['status'] = 'Failed';
						$final_output['message'] = 'Please enter valid OTP.';
						$final_output['responseCode'] = '400';						
						
				}
				else
				{ 
					$otpstatus = $this->Common_model->otp_status($email, $otp);
					$check_all_record = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
					
					$uids = $check_all_record->id;
				
					$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids));
					
					if($check_exp){
						$designation = $check_exp->designation;
						$companyname = $check_exp->companyname;
						$location = $check_exp->location;
					}else{
						$designation = '';
						$companyname = '';
						$location = '';
					}

					
				 $basepath=base_url();
								
				 $photo = $check_all_record->photo;

				 $data=parse_url($photo, PHP_URL_SCHEME);
				  if($data=='http' || $data=='https')
				  {
					  $uphoto = $photo;
				  }
				  else if($data!='http' || $data!='https'){
					   $uphoto = $basepath.'adminpanel/'.$photo;
				  }
				  else
				  {
				   
				  }
				  if($photo=='')
				  {
					   $uphoto = $basepath."adminpanel/images/photo.png";
				  }
				
					$data_array = array(
								
								'id'             => $check_all_record->id,
								'token_security' => $check_all_record->token_security,
								'user_photo'     => $uphoto,
								'user_name'      => $check_all_record->user_name,
								'user_dob'       => $check_all_record->user_dob,
								'user_gender'    => $check_all_record->user_gender,
								'user_email'     => $check_all_record->user_email,
		
								'user_mobile'    => $check_all_record->user_mobile,
								'user_bio'       => $check_all_record->bio,
								'user_address'   => $check_all_record->country,
								'user_workplace' => $check_all_record->workplace,
								
								'user_latitude'   => $check_all_record->latitude,
								'user_longitude'  => $check_all_record->longitude,
								
								'user_city'       => $check_all_record->city,
								
								'user_visatype'    => $check_all_record->visatype,
								'user_visacountry' => $check_all_record->visacountry,
								
								'usercompany'     => $companyname,
								'userdesignation' => $designation,
								'companylocation' => $location,
								
								'user_type'      => $check_all_record->usertype,
																			
								'create_at'      => $check_all_record->create_at,
								'update_at'      => $check_all_record->update_at,
							);
							
					$final_output['responsecode'] = '200';					
					$final_output['status'] = 'success';
					$final_output['message'] = 'Thank you';
					$final_output['data'] = $data_array;
					
					
				}	

				header("content-type: application/json");
				echo json_encode($final_output);
    }
	
	
	public function forgotpassword()
	{
		
		$this->load->model('Common_model');
		$email = $this->input->post('user_email');
		
			
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {		   
				      
			 $otp = sprintf("%06d", mt_rand(1, 999999));	
			 
					    $check_email = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
						if($check_email!=''){
							
						
							$update_value = $this->Common_model->updateData('user_register',array('otp'=>$otp),array('user_email'=>$email));
							
							$userid = $check_email->id;
							$name   = $check_email->user_name;
							
							//$verifyurl=base_url().'Verify/verifypassword/'.$userid;
							
								$message ="
								  <!DOCTYPE html>
									<html>
										<head>
											<meta charset='utf-8' />
											<title>AINA</title>
											<meta name='viewport' content='width=device-width, initial-scale=1.0' />
									   
								   <style>
									table, th, td {
										border: 0px solid black;
										border-collapse: collapse;
									}
									th, td {
										padding: 5px;
										text-align: left;
									}
									</style>
									
									 </head>
										<body>
											<table>
												<tr>
													<td><h4>Dear '".$name."',</h4></td>
												</tr>
												
												<tr>
													<td><p>To update your password, Please use the OTP <b>'".$otp."'</b>.</p></td>
												</tr>
												
												<tr>
													<td><p>Never share your OTP, User ID or Password with anyone. Sharing these details can lead to unauthorised access to your account.<br>
													Looking forward to more opportunities to be of service to you.</p></td>
												</tr>
												
												
												<tr>
												   <th><h4>Sincerely, <br> AINA Team</h4></th>
												</tr> 
										</table>

									</body>
									</html>
									";
									$headers = "From:no-reply@aina.today\r\n";
									$headers.= "Mime-Version: 1.0\r\n";
									$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

									$toEmail = $email;	
									
									$subject="Forgot Password";
									$mail_sent = mail($toEmail, $subject, $message, $headers);	   
										   
									$this->mailsendf($subject,$message);
														
														
									$final_output['responsecode'] = '200';					
									$final_output['status'] = 'success';
									$final_output['message'] = 'Otp has been sent to your email id. Please use that otp to reset your pasword.';	
									
							
						}else{
							        $final_output['responsecode'] = '400';					
									$final_output['status'] = 'Failed';
									$final_output['message'] = 'Your email is not register.';	
						}
						
				}	
			else{
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Invalid email format please check again.';
				$final_output['responsecode'] = '400';
			 }

				header("content-type: application/json");
				echo json_encode($final_output);
    }	

	
	public function resetpassword()
	{
		
		$this->load->model('Common_model');
		$email = $this->input->post('user_email');
		$otp   = $this->input->post('otp');
		$password = $this->input->post('password');
			
			   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			   $check_otp = $this->Common_model->verify_otp($email,$otp);
			   if($check_otp==0)
				{
						$final_output['status'] = 'Failed';
						$final_output['message'] = 'Please enter valid OTP.';
						$final_output['responsecode'] = '400';						
						
				}
				else
				{ 	
					$otpstatus = $this->Common_model->otp_status($email, $otp);
					
					$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'password'=>md5($password)),array('user_email'=>$email));
					
					
					$final_output['status'] = 'success';
					$final_output['message'] = 'Your password has been reset successfully. Please login with new password.';
					$final_output['responsecode'] = '200';
					
				}
				}	
				else{
					$final_output['status'] = 'Failed';
					$final_output['message'] = 'Invalid email format please check again.';
					$final_output['responsecode'] = '400';
				}

				header("content-type: application/json");
				echo json_encode($final_output);
    }
	
	
	
	public function changepassword()
	{
		
		$this->load->model('Common_model');
		
		$userid      = $this->input->post('id');
		$oldpassword = $this->input->post('oldpassword');
		$newpassword = $this->input->post('password');
		
		$device_token = $this->input->post('device_token');
		$device_id    = $this->input->post('device_id');
		$device_type  = $this->input->post('device_type');
		
		$headers = apache_request_headers();
		if($headers['Secret-Key'] !='') 
		{ 
			$check_key = $this->checktoken($headers['Secret-Key'],$userid);
			if($check_key['status'] == 'true')
				{ 
		
					if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
					{ 
						$device_token = '';
					}
					
					
				  if($oldpassword!=$newpassword){
					  
					  
					  $check_password = $this->Common_model->common_getRow('user_register',array('id'=>$userid, 'password'=>md5($oldpassword)));
					  if($check_password){
						$chkpassword = $check_password->password;
						
						if($chkpassword==md5($oldpassword)){
							
							$update_value = $this->Common_model->updateData('user_register',array('password'=>md5($newpassword)),array('id'=>$userid));
							
							$final_output['responsecode'] = '200';
							$final_output['status'] = 'success';
							$final_output['message'] = 'Thank you! your password has been changed successfully. ';
							
							
							
						}else{
							$final_output['responsecode'] = '400';
							$final_output['status'] = 'failed';
							$final_output['message'] = 'Sorry! your old password do not match.';
							
							
						}
						
					}else{
						$final_output['responsecode'] = '400';
						$final_output['status'] = 'failed';
						$final_output['message'] = 'Old Password is not correct. If you have forgot your password. Please use forgot password option.';
						
					}


				  }else{
						$final_output['responsecode'] = '400';
						$final_output['status'] = 'failed';
						$final_output['message'] = 'Old password and new password can not be same.';
				  }				  
					
					
					
				
        }
	 
	 
	  else
	    {
			$final_output['responsecode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responsecode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  

		
				
				header("content-type: application/json");
				echo json_encode($final_output);
				
    }



    public function resendOTP()
	{
		
		$this->load->model('Common_model');
		$email = $this->input->post('user_email');
		$otp = sprintf("%06d", mt_rand(1, 999999));
		
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
			   $check_otp = $this->Common_model->Email_otp($email);
			   if($check_otp==0)
				{
						$final_output['status'] = 'Failed';
						$final_output['message'] = 'Email not exist in our record.';
						$final_output['responseCode'] = '400';						
						
				} 
				else 
				{ 	
					
					$otpstatus = $this->Common_model->Updateotp($email, $otp);
					
					$check_all_record = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
					
					$userid = $check_all_record->id;
					$name   = $check_all_record->user_name;
							
							//$verifyurl=base_url().'Verify/verifypassword/'.$userid;
							
								$message ="
								  <!DOCTYPE html>
									<html>
										<head>
											<meta charset='utf-8' />
											<title>AINA</title>
											<meta name='viewport' content='width=device-width, initial-scale=1.0' />
									   
								   <style>
									table, th, td {
										border: 0px solid black;
										border-collapse: collapse;
									}
									th, td {
										padding: 5px;
										text-align: left;
									}
									</style>
									
									 </head>
										<body>
											<table>
												<tr>
													<td><h4>Dear '".$name."',</h4></td>
												</tr>
												
												<tr>
													<td><p>Here is your new OTP <b>'".$otp."'</b>.</p></td>
												</tr>
												
												<tr>
													<td><p>Never share your OTP, User ID or Password with anyone. Sharing these details can lead to unauthorised access to your account.<br>
													Looking forward to more opportunities to be of service to you.</p></td>
												</tr>
												
												
												<tr>
												   <th><h4>Sincerely, <br> AINA Team</h4></th>
												</tr> 
										</table>

									</body>
									</html>
									";
									$headers = "From:no-reply@aina.today\r\n";
									$headers.= "Mime-Version: 1.0\r\n";
									$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

									$toEmail = $email;	
									
									$subject="OTP";
									$mail_sent = mail($toEmail, $subject, $message, $headers);	   
										   
									$this->mailsendf($subject,$message);
											
											
						$final_output['responsecode'] = '200';
						$final_output['status'] = 'success';
						$final_output['message'] = 'OTP has been sent to your email id successfully.';	
						
					
					
				   }
				}	
				else{
					$final_output['status'] = 'Failed';
					$final_output['message'] = 'Invalid email format please check again.';
					$final_output['responsecode'] = '400';
				}

				header("content-type: application/json");
				echo json_encode($final_output);
    }
	
	

public function userlogin()
{
	
	$this->load->model('Common_model');
	
	$email       = $this->input->post('user_email');
	$password    = $this->input->post('password');
	
	$device_token = $this->input->post('device_token');
	$device_id    = $this->input->post('device_id');
	$device_type  = $this->input->post('device_type');
	//$oauth     = $this->input->post('oauth_provider');
	
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$otp = sprintf("%06d", mt_rand(1, 999999));
	$siteid      ='AINA';

    if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }

    $auth_key = $this->rand_string(40);

    $final_output = array();

    if(!empty($email && $password))
    {  
   
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
		  {
     		
		 	$check_record = $this->Common_model->checkuserlogin($email, md5($password));
			
		  if($check_record!=''){
			
			$status=$check_record[0]['status'];
		
			if($status==1)
			{
				
				$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'token_security'=>$auth_key,'deviceid'=>$device_id,'tokenid'=>$device_token,'modified'=>$modified),array('user_email'=>$email));
				
				$check_recordD = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
				
				$basepath=base_url();
				$photo = $check_recordD->photo;
				$uids = $check_recordD->id;
				
				$data=parse_url($photo, PHP_URL_SCHEME);
				if($data=='http' || $data=='https')
				  {
					  $uphoto = $photo;
				  }
				  else if($data!='http' || $data!='https'){
					   $uphoto = $basepath.'adminpanel/'.$photo;
				  }
				  else
				  {
				   
				  }
				  if($photo=='')
				  {
					   $uphoto = $basepath."adminpanel/images/photo.png";
				  }
				  
				  
				    $check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids));				
					if($check_exp){
						$designation = $check_exp->designation;
						$companyname = $check_exp->companyname;
						$location    = $check_exp->location;
					}else{
						$designation = '';
						$companyname = '';
						$location = '';
					}
				
				
				 $dataa_array  = array(	
											'id'             => $check_recordD->id,
											'token_security' => $auth_key,
											'user_photo'     => $uphoto,
											'sourcemedia'     =>$device_type,
											'user_name'      => $check_recordD->user_name,
											'user_dob'       => $check_recordD->user_dob,
											'user_gender'    => $check_recordD->user_gender,
											'user_email'     => $check_recordD->user_email,
					
											'user_mobile'    => $check_recordD->user_mobile,
											'user_bio'       => $check_recordD->bio,
											'user_address'   => $check_recordD->country,
											'user_city'      => $check_recordD->city,
											'user_workplace' => $check_recordD->workplace,
											
											'usercompany'     => $companyname,
											'userdesignation' => $designation,
											'companylocation'    => $location,
											
											'user_type'     => $check_recordD->usertype,
											'user_date'     => $check_recordD->modified,
											'create_at'     => $check_recordD->create_at,
											'update_at'     => $check_recordD->update_at
											
										);
									$final_output['responsecode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'You have logged-in successfully.';	
									$final_output['data'] = $dataa_array;
									
				
			  }
		   else{
				$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'otp'=>$otp),array('user_email'=>$email));
				   	
					$check_recordD = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
					if($check_recordD)
					{
						
					    $userid=$check_recordD->id;
						$name=$check_recordD->user_name;
						//$verifyurl=base_url().'Verify/verifyemail/'.$userid;
							
								$message ="
								  <!DOCTYPE html>
									<html>
										<head>
											<meta charset='utf-8' />
											<title>AINA</title>
											<meta name='viewport' content='width=device-width, initial-scale=1.0' />
									   
								   <style>
									table, th, td {
										border: 0px solid black;
										border-collapse: collapse;
									}
									th, td {
										padding: 5px;
										text-align: left;
									}
									</style>
									
									 </head>
										<body>
											<table>
												<tr>
													<td><h4>Dear '".$name."',</h4></td>
												</tr>
												
												<tr>
													<td><p>You have initiated account creation on AINA. Here is your OTP <b>'".$otp."'</b>.</p></td>
												</tr>
												
												<tr>
													<td><p>Never share your OTP, User ID or Password with anyone. Sharing these details can lead to unauthorised access to your account.<br>
													Looking forward to more opportunities to be of service to you.</p></td>
												</tr>
												
												
												<tr>
												   <th><h4>Sincerely, <br> AINA Team</h4></th>
												</tr> 
										</table>

									</body>
									</html>
									";
									$headers = "From:no-reply@aina.today\r\n";
									$headers.= "Mime-Version: 1.0\r\n";
									$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

									$toEmail = $email;	
									
									$subject="OTP";
									$mail_sent = mail($toEmail, $subject, $message, $headers);	   
										   
									$this->mailsendf($subject,$message);
			   
			   
			   
					$final_output['status'] = 'Warning';
					$final_output['message'] = 'Your emailid is not verify yet. It has been sent to your email id. Please verify.';
					$final_output['responsecode'] = '405';
					unset($final_output['data']);
		      }
		   }  
		  }
		    else{
					$final_output['status'] = 'failed';
					$final_output['message'] = 'Invalid credentials';
					$final_output['responsecode'] = '400';
					unset($final_output['data']);
			   }
			   
		  }
		   
		   			  
			else{
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Invalid email format please check again.';
				$final_output['responsecode'] = '400';
			}
	       
			
	}
	else
	{
		$final_output['status'] = 'failed';
	 	$final_output['message'] = 'Required parameters not found';
		$final_output['responsecode'] = '400';
	 	unset($final_output['data']);
	}
	
		
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	



/* Social login API */	
	
public function sociallogin()
{
	$this->load->model('Common_model');
	
	$device_type  = $this->input->post('device_type');
	$oauth        = $this->input->post('oauth_provider');	
	$oauid        = $this->input->post('oauth_uid');
	//$sourcemedia  = $this->input->post('sourcemedia');
	$device_token = $this->input->post('device_token');
	$device_id    = $this->input->post('device_id');
	$image        = $this->input->post('user_photo');
	$name         = $this->input->post('user_name');
	$email        = $this->input->post('user_email');
	$contact_no   = $this->input->post('user_mobile');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='AINA';

   if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }

    $version_code = $this->input->post('version_code');
    $auth_key = $this->rand_string(40);
    $final_output = array();
	
	if($oauid!='')
	{
		 
		   $check_email = $this->Common_model->checkexistRecord($oauid);		
		
		   //print_r($check_email);
						    
			if($check_email!=''){
				       $emailcheck = $check_email->user_email;
			   
				       if($emailcheck==$email){
						 
						   $update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'token_security'=>$auth_key,'deviceid'=>$device_id,'tokenid'=>$device_token,'oauth_provider'=>$oauth, 'oauth_uid'=>$oauid, 'photo'=>$image, 'user_name'=>$name,'sourcemedia'=>$device_type,'modified'=>$modified,'status'=>$status,'user_mobile'=>$contact_no),array('user_email'=>$email));	
						   
						 }else{
							 
							 
							  $update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'token_security'=>$auth_key,'deviceid'=>$device_id,'tokenid'=>$device_token,'oauth_provider'=>$oauth, 'photo'=>$image, 'user_name'=>$name,'sourcemedia'=>$device_type,'created'=>$created,'modified'=>$modified,'status'=>$status,'user_mobile'=>$contact_no,'user_email'=>$email),array('oauth_uid'=>$oauid));
							 
							 
						 }
						 
						$uids = $check_email->id;
		
						$basepath=base_url();
						
						$photo        = $check_email->photo;
						
						$data=parse_url($photo, PHP_URL_SCHEME);
						if($data=='http' || $data=='https')
						  {
							  $uphoto = $image;
						  }
						  else if($data!='http' || $data!='https'){
							   $uphoto = $basepath.'adminpanel/'.$photo;
						  }
						  else
						  {
						   
						  }
						  if($photo=='')
						  {
							   $uphoto = $basepath."adminpanel/images/photo.png";
						  }
						  
						   $check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids));				
							if($check_exp){
								$designation = $check_exp->designation;
								$companyname = $check_exp->companyname;
								$location = $check_exp->location;
							}else{
								$designation = '';
								$companyname = '';
								$location = '';
							}
						
						
						$dataa_array = array(
						
										'id'             => $check_email->id,
										'token_security' => $auth_key,
										'user_photo'     => $uphoto,
										'user_name'      => $check_email->user_name,
										'user_dob'       => $check_email->user_dob,
										'user_gender'    => $check_email->user_gender,
										'user_email'     => $email,
				
										'user_mobile'    => $check_email->user_mobile,
										'user_bio'       => $check_email->bio,
										'user_address'   => $check_email->country,
										'user_city'      => $check_email->city,
										'user_workplace' => $check_email->workplace,
										
										'usercompany'     => $companyname,
										'userdesignation' => $designation,
										'companylocation' => $location,
										
										'usertype'       => '',
																					
										'create_at' => $check_email->create_at,
										'update_at' => $check_email->update_at
									);
									$final_output['responsecode'] = '200';
									$final_output['status'] = 'success';
									$final_output['message'] = 'You have logged-in successfully.';	
									$final_output['data'] = $dataa_array;
				
			            }
			    else{
				
							  $insert_array = array();
									
							  $insert_array['oauth_provider']=$oauth;	
							  $insert_array['oauth_uid']=$oauid;
							  
							  $insert_array['token_security']=$auth_key;
							  $insert_array['sourcemedia']=$device_type;
							  
							  $insert_array['siteid']=$siteid;
							  $insert_array['tokenid']=$device_token;
							  $insert_array['deviceid']=$device_id;
							  
							  $insert_array['photo']=$image;
							  $insert_array['user_name']=$name;
							  $insert_array['user_dob']='';
							  $insert_array['user_gender']='';
							  $insert_array['user_email']=$email;
							  $insert_array['user_mobile']=$contact_no;
							  $insert_array['password']='';
							  $insert_array['bio']='';
							  $insert_array['otp']='';
							  $insert_array['workplace']='';
							  $insert_array['country']='';
							  
							  $insert_array['latitude']='';									  
							  $insert_array['longitude']='';									  
							  $insert_array['city']='';		
							  
							  $insert_array['visatype']='';									  
							  $insert_array['visacountry']='';
							  
							  
							  $insert_array['city']='';									  
							  $insert_array['link']='';
							  $insert_array['usertype']='';
							  $insert_array['newscount']=0;
							  
							  $insert_array['created']=$created;
							  $insert_array['modified']=$modified;
							  $insert_array['create_at']=militime;
							  $insert_array['update_at']=militime;
							  
							  $insert_array['status']=$status;
							  $insert_array['notificationsetting']='1,14';
							  
									 
								$insertId = $this->Common_model->common_insert('user_register', $insert_array);
								
								//$insertId = $this->db->insert('user_register', $insert_array);
						
								 $last_id = $this->db->insert_id();
														 
								 $user_device['userid']=$last_id;
								 $user_device['sourcemedia']=$device_type;						 
								 $user_device['tokenid']=$device_token;
								 $user_device['deviceid']=$device_id;
								 $user_device['status']=$status;
								 
								 $userDevice = $this->db->insert('userdevice', $user_device);
								
								
								$check_record = $this->Common_model->common_getRow('user_register',array('id'=>$insertId));
							
								$basepath=base_url();
								if($insertId)
								{
								
									$uids  = $check_record->id;							
									$photo = $check_record->photo;

									$data=parse_url($photo, PHP_URL_SCHEME);
									
									if($data=='http' || $data=='https')
									  {
										  $uphoto = $photo;
									  }
									  else if($data!='http' || $data!='https'){
										   $uphoto = $basepath.'adminpanel/'.$photo;
									  }
									  else
									  {
									   
									  }
									  if($photo=='')
									  {
										   $uphoto = $basepath."adminpanel/images/photo.png";
									  }
									
										if($check_record->country==NULL)
										{
											$country="";
										}
										else
										{
											$country =$check_record->country;
										}
										
										
									$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids));				
									if($check_exp){
										$designation = $check_exp->designation;
										$companyname = $check_exp->companyname;
										$location = $check_exp->location;
									}else{
										$designation = '';
										$companyname = '';
										$location = '';
									}	
										
										
								  $dataa_array  = array(
													'id'             => $insertId,
													'sourcemedia'    => $device_type,
													'token_security' => $check_record->token_security,
													'user_photo'     => $uphoto,
													'user_name'      => $name,
													'user_dob'       => $check_record->user_dob,
													'user_gender'    => $check_record->user_gender,
													'user_email'     => $email,
							
													'user_mobile'    => $contact_no,
													'user_bio'       => $check_record->bio,
													'user_address'   => $country,
													'user_city'      => $check_record->city,
													'user_workplace' => $check_record->workplace,
													
													'usercompany'     => $companyname,
													'userdesignation' => $designation,
													'companylocation'    => $location,
													
													'user_type'      => '',
																								
													'create_at'      => $check_record->create_at,
													'update_at'      => $check_record->update_at
													
												);

					    	   
					    		    $final_output['responsecode'] = '200';
					    		    $final_output['status'] = 'success';
									$final_output['message'] = 'You have logged-in successfully.';	
									$final_output['data'] = $dataa_array;
							}else
							{    

   						            $final_output['responsecode'] = '400';
									$final_output['status'] = 'failed';
							     	$final_output['message'] = 'Something went wrong! please try again.';
									
							     	unset($final_output['data']);
							}		
				 }
				
				
	}else
	{
		$final_output['status'] = 'failed';
	 	$final_output['message'] = 'Required parameters not found';
		$final_output['responsecode'] = '400';
	 	unset($final_output['data']);
	}
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}


public function getuserprofile()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	
	$device_token   = $this->input->post('device_token');
	$device_id      = $this->input->post('device_id');
	$device_type    = $this->input->post('device_type');
	
	$created  = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='AINA';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		
	$check_key = $this->checktoken($headers['Secret-Key'],$userid);
	if($check_key['status'] == 'true')
        { 
	
			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}


    $auth_key = $this->rand_string(40);

    $final_output = array();

    if(!empty($userid))
    {  
   
     		
		 	$check_record = $this->Common_model->getuserprofile($userid);
			$check_edu    = $this->Common_model->getusereducation($userid);
			$check_exp    = $this->Common_model->getuserexperience($userid);
			$check_skills = $this->Common_model->getuserskill($userid);
			
			if($check_edu!=0)
			{
				foreach($check_edu as $valdata)
				{
					$eduid = $valdata->id; 
					$quali = $valdata->qualification;
					$cname = $valdata->collegename;
					$fromyear = $valdata->fromyear;
					$toyear = $valdata->toyear;
					$location  = $valdata->location;
					
					$edu[]= array('eduid'=>$eduid, 'qualification'=>$quali, 'collegename'=>$cname, 'fromyear'=>$fromyear, 'toyear'=>$toyear,'location'=>$location); 
				}
			}
			else
			{
				$edu= array(); 
			}
			
			if($check_exp!=0)
			{
				foreach($check_exp as $valexp)
				{
					$expid = $valexp->id; 
					$designation  = $valexp->designation;
					$companyname = $valexp->companyname;
					$address     = $valexp->location;
					$fromyear    = $valexp->fromdate;
					$toyear      = $valexp->todate;
					
					
					$exp[]= array('expid'=>$expid, 'designation'=>$designation, 'companyname'=>$companyname, 'location'=>$address, 'fromyear'=>$fromyear, 'toyear'=>$toyear); 
				}
			}
			else
			{
				$exp= array(); 
			}
			
			
			if($check_skills!=0)
			{
				foreach($check_skills as $valskill)
				{
					$skillid   = $valskill->id; 
					$skillname = $valskill->skillname;
					$expyear   = $valskill->expyear;
					
					
					$skill[]= array('skillid'=>$skillid, 'skillname'=>$skillname, 'year'=>$expyear); 
				}
			}
			else
			{
				$skill= array(); 
			}
			
			
			if($check_record!=''){
				
				$uids = $check_record->id;
				
				$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids, 'todate'=>'Present'));
				
				if($check_exp){
					$designation = $check_exp->designation;
					$companyname = $check_exp->companyname;
					$location    = $check_exp->location;
				}else{
					$designation = '';
					$companyname = '';
					$location = '';
				}
				
				$basepath=base_url();
				
				$photo = $check_record->photo;

				$data=parse_url($photo, PHP_URL_SCHEME);
				  if($data=='http' || $data=='https')
				  {
					  $uphoto = $photo;
				  }
				  else if($data!='http' || $data!='https'){
					   $uphoto = $basepath.'adminpanel/'.$photo;
				  }
				  else
				  {
				   
				  }
				  if($photo=='')
				  {
					   $uphoto = $basepath."adminpanel/images/photo.png";
				  }
				
				 $dataa_array  = array(
														'id'             => $check_record->id,
														'token_security' => $check_record->token_security,
														'user_photo'     => $uphoto,
														'user_name'      => $check_record->user_name,
														'user_dob'       => $check_record->user_dob,
														'user_gender'    => $check_record->user_gender,
														'user_email'     => $check_record->user_email,
								
														'user_mobile'    => $check_record->user_mobile,
														'user_bio'       => $check_record->bio,
														'user_address'   => $check_record->country,
														'user_workplace' => $check_record->workplace,
														
														'user_latitude'   => $check_record->latitude,
														'user_longitude'  => $check_record->longitude,
														
														'user_city'       => $check_record->city,
														
														'user_visatype'    => $check_record->visatype,
														'user_visacountry' => $check_record->visacountry,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'companylocation'    => $location,
														
														'user_type'      => $check_record->usertype,
																									
														'create_at'      => $check_record->create_at,
														'update_at'      => $check_record->update_at,

														'education'          => $edu,
														'experience'         => $exp,
														'skill'              => $skill,
														
										            );
									$final_output['responsecode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get user details';	
									$final_output['data'] = $dataa_array;
									
				
			  }
			  
			else{
				$final_output['responsecode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Invalid user id please check again.';
				
			}
	       
			
	   }
	
	 else
	    {
			$final_output['responsecode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send user id';
			
	    }
	}
	 
	 
	  else
	    {
			$final_output['responsecode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'You have logged in to some other device';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responsecode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	



/*
public function updateprofile()
{
	
	$this->load->model('Common_model');	
	$userid = $this->input->post('id');	
	
	$username = $this->input->post('user_name');
	$images   = $this->input->post('user_photo');
	 

		$data  = trim($images);
		$data  = str_replace('data:image/png;base64,', '', $data);
		$data  = str_replace(' ', '+', $data);
		
		$data1 = base64_decode($data); // base64 decoded image data
		
		$imgname = uniqid().'.png';
		$file_paths = "images/userimg/".$imgname;
		$file    = 'adminpanel/images/userimg/'.$imgname;
		$success = file_put_contents($file, $data1);

	$about          = $this->input->post('about');				 
	$workplace      = $this->input->post('workplace');
    $visatype       = $this->input->post('visatype');
    $visacountry    = $this->input->post('visacountry');
    $usermobile     = $this->input->post('user_mobile');	
	
	$address        = $this->input->post('user_address');
    $latitude       = $this->input->post('latitude');
    $longitude      = $this->input->post('longitude');	

    
    $address        = $this->input->post('user_address');
    $latitude       = $this->input->post('latitude');
    $longitude      = $this->input->post('longitude');
	
	
	$device_token   = $this->input->post('device_token');
	$device_id      = $this->input->post('device_id');
	$device_type    = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='AINA';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
	$check_key = $this->checktoken($headers['Secret-Key'],$userid);
	if($check_key['status'] == 'true')
        { 
	
			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}


			$auth_key = $this->rand_string(40);

			$final_output = array();

				if(!empty($userid))
				{  
						   
						$update_value = $this->Common_model->updateData('user_register',array('photo'=>$file_paths, 'user_name'=>$username, 'user_mobile'=>$usermobile, 'bio'=>$about, 'workplace'=>$workplace, 'country'=>$address, 'latitude'=>$latitude, 'longitude'=>$longitude, 'visatype'=>$visatype, 'visacountry'=>$visacountry, 'modified'=>$modified, 'update_at'=>militime),array('id'=>$userid));

						$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$userid));
						
						if($check_exp){
							$designation = $check_exp->designation;
							$companyname = $check_exp->companyname;
							$location    = $check_exp->location;
						}else{
							$designation = '';
							$companyname = '';
							$location    = '';
						}

						$basepath=base_url();	
                        $check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));						
						$photo        = $check_record->photo;
						
						$data=parse_url($photo, PHP_URL_SCHEME);
						if($data=='http' || $data=='https')
						  {
							  $uphoto = $photo;
						  }
						  else if($data!='http' || $data!='https'){
							   $uphoto = $basepath.'adminpanel/'.$photo;
						  }
						  else
						  {
						   
						  }
						  if($photo=='')
						  {
							   $uphoto = $basepath."assets/images/nophoto.png";
						  }

								
								
								$data_array = array(
					    						        'id'             => $check_record->id,
														'token_security' => $check_record->token_security,
														'user_photo'     => $uphoto,
														'user_name'      => $check_record->user_name,
														'user_dob'       => $check_record->user_dob,
														'user_gender'    => $check_record->user_gender,
														'user_email'     => $check_record->user_email,
								
														'user_mobile'    => $check_record->user_mobile,
														'user_bio'       => $check_record->bio,
														'user_address'   => $check_record->country,
														'user_workplace' => $check_record->workplace,
														
														'user_latitude'   => $check_record->latitude,
														'user_longitude'  => $check_record->longitude,
														
														'user_city'       => $check_record->city,
														
														'user_visatype'    => $check_record->visatype,
														'user_nativecountry' => $check_record->visacountry,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'companylocation'    => $location,
														
														'user_type'      => $check_record->usertype,
																									
														'create_at'      => $check_record->create_at,
														'update_at'      => $check_record->update_at,
												
								            );
						
							
						$final_output['responsecode'] = 200;	
						$final_output['status'] = 'success';
						$final_output['message'] =  'Your profile has been updated successfully.';
                        $final_output['data'] = $data_array;						
							
						
				   }
	
			 else
				{
					$final_output['responsecode'] = '404';
					$final_output['status'] = 'false';
					$final_output['message'] = 'Please send username';
					
				}
			}
	 
	 
		  else
			{
				$final_output['responsecode'] = '403';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Invalid token';
				
			} 
		
		 }
		 
		  else
			{
				$final_output['responsecode'] = '502';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Unauthorised Access';
				
			}  
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	
*/


public function logout()
{
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 

		$userid = $this->input->post('id');
		
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);

		if($check_key['status'] == 'true')
	    {
			
		            $final_output = array();
					$query = $this->db->query("Update user_register set tokenid='' where id='$userid'");
				
					if(!empty($query))
					{
							$message='User logged out successfully.';
							$final_output['responsecode'] = '200';
							$final_output['status'] = 'success';
						    
				            $final_output['message'] = $message;
			        }
			        else
			        {
			       	    $final_output['status'] = 'failed';
						$final_output['message'] = 'Data Not Found.';
				        unset($final_output['data']);
			        }	

   				
                 
	    }
	    else
	    {	
			$final_output['responsecode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid Token';
	    }	
	}
	else
	{
	   $final_output['status'] = 'false';
	   $final_output['message'] = 'Unauthorised Access';
	}	

   header("content-type: application/json");
   echo json_encode($final_output);	


}





public function updateprofile()
{
	
	$this->load->model('Common_model');	
	
	
		$userid = $this->input->post('id');	
		$type   = $this->input->post('type');
	
		/*$username = $this->input->post('user_name');
		$images   = $this->input->post('user_photo');
	 

		$data  = trim($images);
		$data  = str_replace('data:image/png;base64,', '', $data);
		$data  = str_replace(' ', '+', $data);
		
		$data1 = base64_decode($data); // base64 decoded image data
		
		$imgname = uniqid().'.png';
		$file_paths = "images/userimg/".$imgname;
		$file    = 'adminpanel/images/userimg/'.$imgname;
		$success = file_put_contents($file, $data1);

		$about          = $this->input->post('about');				 
		$workplace      = $this->input->post('workplace');
		$visatype       = $this->input->post('visatype');
		$visacountry    = $this->input->post('visacountry');
		$usermobile     = $this->input->post('user_mobile');	
		
		$address        = $this->input->post('user_address');
		$latitude       = $this->input->post('latitude');
		$longitude      = $this->input->post('longitude');	

		
		$address        = $this->input->post('user_address');
		$latitude       = $this->input->post('latitude');
		$longitude      = $this->input->post('longitude');*/
		
		
		$device_token   = $this->input->post('device_token');
		$device_id      = $this->input->post('device_id');
		$device_type    = $this->input->post('device_type');
	
	
	
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='AINA';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
	$check_key = $this->checktoken($headers['Secret-Key'],$userid);
	if($check_key['status'] == 'true')
        { 
	
			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}


			$auth_key = $this->rand_string(40);

			$final_output = array();

				if(!empty($userid))
				{  
						    if($type=='image'){
								 $images   = $this->input->post('image');
								 $username = $this->input->post('user_name');
								
								  if($images!='')
									{
										//$foldername = '../../adminpanel/images/' . $images;
										$data  = trim($images);
										$data = str_replace('data:image/png;base64,', '', $data);
										$data = str_replace(' ', '+', $data);
										
										$data1 = base64_decode($data); // base64 decoded image data
										
										$imgname = uniqid().'.png';
										$file_paths = "images/userimg/".$imgname;
										$file = 'adminpanel/images/userimg/'.$imgname;
										$success = file_put_contents($file, $data1);
										
								        $data = array(
													'user_name' => $username,
													'photo' => $file_paths,
												 ); 
								
								       $check_records = $this->Common_model->updateuserimage($userid, $data);
									}else{
										
										$data = $username;
										$check_records = $this->Common_model->updateusername($userid, $data);
									}
								
								
								    $check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								
								
								    $uids = $check_record->id;
								
									$basepath=base_url();				
									$photo = $check_record->photo;

									
									$data=parse_url($photo, PHP_URL_SCHEME);
									if($data=='http' || $data=='https')
									  {
										  $uphoto = $photo;
									  }
									  else if($data!='http' || $data!='https'){
										   $uphoto = $basepath.'adminpanel/'.$photo;
									  }
									  else
									  {
									   
									  }
									  if($photo=='')
									  {
										   $uphoto = $basepath."adminpanel/images/photo.png";
									  }
								  
								  $dataa_array  = array(
														'id'             => $check_record->id,
														'user_photo'     => $uphoto,
														'user_name'      => $check_record->user_name
														
										            );
								  
								  if($check_record){
									
									  $code = '200';
									  $msg = "Your profile has been updated successfully.";
								  }else{
									  $code = '200';
									  $msg = "Your updation is not sussessfully.";
								  }
								  
								  
							   }
							
							elseif($type=='about'){
								
								$about = $this->input->post('about');								
								$check_records = $this->Common_model->updateuserabout($userid, $about);
								
								$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								
								$uids = $check_record->id;
				
								  
								  $dataa_array  = array(
														'id'             => $check_record->id,
														'user_bio'       => $check_record->bio
														
										            );
													
								if($check_record){
									  $msg = "Your profile has been updated successfully.";
									  $code = '200';
								  }else{
									  $msg = "Your updation is not sussessfully.";
									  $code = '200';
								  }				
							}
							
							
							elseif($type=='workplace'){
								
								$workplace = $this->input->post('workplace');								
								$check_records = $this->Common_model->updateuserwork($userid, $workplace);
								
								$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								
								$uids = $check_record->id;
				
								  
								  $dataa_array  = array(
														'id'             => $check_record->id,
														'user_workplace' => $check_record->workplace
														
										            );
													
								if($check_record){
									  $msg = "Your profile has been updated successfully.";
									  $code = '200';
								  }else{
									  $msg = "Your updation is not sussessfully.";
									  $code = '200';
								  }				
							}
							
							
							
							elseif($type=='visatype'){
								
								$visatype = $this->input->post('visatype');
							    //$visacountry = $this->input->post('visacountry');	

								$check_records = $this->Common_model->updatevisatype($userid, $visatype);
								
								$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								
								$uids = $check_record->id;
				
								  
								  $dataa_array  = array(
														'id'             => $check_record->id,
														'user_visatype'    => $check_record->visatype
														
										            );
													
								if($check_record){
									  $msg = "Your profile has been updated successfully.";
									  $code = '200';
								  }else{
									  $msg = "Your updation is not sussessfully.";
									  $code = '200';
								  }				
							}
							
							
							
							
							elseif($type=='visacountry'){
								
							    $visacountry = $this->input->post('visacountry');	 
								
								$check_records = $this->Common_model->updatevisacountry($userid, $visacountry);
								
								$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								
								$uids = $check_record->id;
				
								  
								  $dataa_array  = array(
														'id'             => $check_record->id,
														'user_visacountry' => $check_record->visacountry
														
										            );
													
								if($check_record){
									  $msg = "Your profile has been updated successfully.";
									  $code = '200';
								  }else{
									  $msg = "Your updation is not sussessfully.";
									  $code = '200';
								  }				
							}
							
							
							
							elseif($type=='experience'){
								
								$expid = $this->input->post('expid');
								
								$check_record = $this->Common_model->checkuserexp($userid, $expid);
								
								
			                    if($check_record!=''){
									
									$data = array(
									
									'designation' => $this->input->post('designation'),
									'companyname' => $this->input->post('companyname'),
									'location'    => $this->input->post('location'),
									'fromdate'    => $this->input->post('fromdate'),
									'todate'      => $this->input->post('todate')
									
								    );

							        $updateexp = $this->Common_model->updateuserexp($userid, $expid, $data);
									
									$getexp = $this->Common_model->common_getRow('experience', array('userid'=>$userid, 'id'=>$expid));
									
									
									$dataa_array  = array(
														'expid'      =>$getexp->id,
														'userid'     =>$getexp->userid,
														'designation'=>$getexp->designation,
														'companyname' =>$getexp->companyname, 
														'description'=>$getexp->description, 
														'location'   =>$getexp->location, 
														'fromyear'   =>$getexp->fromdate, 
														'toyear'     =>$getexp->todate 
														
										            );
									
									if($updateexp){
									  $msg = "Your profile has been updated successfully.";
									  $code = '200';
									  }else{
										$msg = "Your updation is not sussessfully.";
										$code = '200';
									  }
									
										
									}else{
										
										
									  $insert_array = array();
									  
									  $insert_array['userid']     =$userid;
									  $insert_array['designation']=$this->input->post('designation');
									  $insert_array['companyname']=$this->input->post('companyname');
									  $insert_array['description']='';
									  $insert_array['location']   =$this->input->post('location');
									  $insert_array['fromdate']   =$this->input->post('fromdate');
									  $insert_array['todate']     =$this->input->post('todate');
									  $insert_array['status']     =1;
									  
						               $insertexp = $this->db->insert('experience', $insert_array);
									   
									   $insert_id = $this->db->insert_id();
									   
									   $insert_record = $this->Common_model->lastinsertexp($insert_id); 
									  
										  $dataa_array  = array(
														'expid'      =>$insert_record[0]->id,
														'userid'     =>$insert_record[0]->userid,
														'designation' =>$insert_record[0]->designation, 
														'description' =>'', 
														'companyname'=>$insert_record[0]->companyname, 
														'location'   =>$insert_record[0]->location, 
														'fromyear'   =>$insert_record[0]->fromdate, 
														'toyear'     =>$insert_record[0]->todate 
														
										            );
									   
									   
									     if($insertexp){
									          $msg = "Your profile has been updated successfully.";
											  $code = '200';
										  }else{
											  $msg = "Your profile is not update.";
											  $code = '200';
										  }
										
									}
								 
							}
							
							
							
							elseif($type=='education'){
								
								$eduid = $this->input->post('eduid');
								
								$check_record = $this->Common_model->checkuseredu($userid, $eduid);
								
								
			                    if($check_record!=''){
									
									$data = array(	
									
										'qualification' => $this->input->post('qualification'),
										'collegename' => $this->input->post('collegename'),
										'description'    => '',
										'location'    => $this->input->post('location'),
										'fromyear'    => $this->input->post('fromdate'),
										'toyear'      => $this->input->post('todate')									
								    );

							        $updateedu = $this->Common_model->updateuseredu($userid, $eduid, $data);
									$getedu = $this->Common_model->common_getRow('education', array('userid'=>$userid, 'id'=>$eduid));
									
									
									$dataa_array  = array(
														'eduid'         =>$getedu->id,
														'userid'     =>$getedu->userid,
														'qualification' =>$getedu->qualification, 
														'collegename'=>$getedu->collegename, 
														'location'   =>$getedu->location, 
														'fromyear'   =>$getedu->fromyear, 
														'toyear'     =>$getedu->toyear 
														
										            );
									  
									if($updateedu){
									    $msg = "Your updation is sussessfully.";
										$code = '200';
									  }else{
										$msg = "Your updation is not sussessfully.";
										$code = '200';
									  }
									}else{
										
										
									  $insert_array = array();
									  
									  $insert_array['userid']       =$userid;
									  $insert_array['qualification']=$this->input->post('qualification');
									  $insert_array['collegename']  =$this->input->post('collegename');
									  $insert_array['description']  ='';
									  $insert_array['location']     =$this->input->post('location');
									  $insert_array['fromyear']     =$this->input->post('fromdate');
									  $insert_array['toyear']       =$this->input->post('todate');
									  $insert_array['status']       =1;
									  
						               $insertedu = $this->db->insert('education', $insert_array);									   
									   $insert_id = $this->db->insert_id();
									   
									   $insert_record = $this->Common_model->lastinsertedu($insert_id); 
									  
										  $dataa_array  = array(
														'eduid'         =>$insert_record[0]->id,
														'userid'     =>$insert_record[0]->userid,
														'qualification' =>$insert_record[0]->qualification, 
														'collegename'=>$insert_record[0]->collegename, 
														'description'=>$insert_record[0]->description, 
														'location'   =>$insert_record[0]->location, 
														'fromyear'   =>$insert_record[0]->fromyear, 
														'toyear'     =>$insert_record[0]->toyear 
														
										            );
													
										if($insertedu){
									          $msg = "Your profile has been updated successfully.";
											  $code = '200';
										  }else{
											  $msg = "Your profile is not update.";
											  $code = '200';
										  }			
										
									}
									
								
							}
							
							
							elseif($type=='skill'){
								
								$skillid = $this->input->post('skillid');
								
								$check_record = $this->Common_model->checkuserskill($userid, $skillid);								
			                    if($check_record!=''){
									
									$data = array(	
									
										'skillname' => $this->input->post('skillname'),
										'year'      => $this->input->post('year')									
								    );

							        $updateskill = $this->Common_model->updateuserskill($userid, $skillid, $data);
									$getskill = $this->Common_model->common_getRow('userskills', array('userid'=>$userid, 'id'=>$skillid));
									
									
									$dataa_array  = array(
														'skillid'     =>$getskill->id,
														'userid'    =>$getskill->userid,
														'skillname' =>$getskill->skillname,
														'skillexperience'   =>$getskill->expyear
														
										            );
									  
									if($updateskill){
									    $msg = "Your updation is sussessfully.";
										$code = '200';
									  }else{
										$msg = "Your updation is not sussessfully.";
										$code = '200';
									  }
									  
									}else{
										
										
									  $insert_array = array();
									  
									  $insert_array['userid']       = $userid;
									  $insert_array['skillname']    = $this->input->post('skillname');
									  $insert_array['expyear']      = $this->input->post('year');
									  
						               $insertskill = $this->db->insert('userskills', $insert_array);
									   $insert_id = $this->db->insert_id();
									   
									   $insert_record = $this->Common_model->lastinsertskill($insert_id); 
									  
										  $dataa_array  = array(
														'skillid'       =>$insert_record[0]->id,
														'userid'      =>$insert_record[0]->userid,
														'skillname'   =>$insert_record[0]->skillname, 
														'skillexperience'     =>$insert_record[0]->expyear 
														
										            );
													
										if($insertskill){
									          $msg = "Your profile has been updated successfully.";
											  $code = '200';
										  }else{
											  $msg = "Your profile is not update.";
											  $code = '200';
										  }			
										
									}
									
								
							}
							
							
							
							elseif($type=='userinfo'){
							    
									$user_address   = $this->input->post('user_address');
									$user_mobile = $this->input->post('user_mobile');
									
											$data = array(
													
													'user_mobile' => $user_mobile,
													'country'     => $user_address,
												 ); 
												 
											$check_records = $this->Common_model->updateuserinfo($userid, $data);
											
											$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								  
											$uids = $check_record->id;
							
											
											
											$dataa_array  = array(
														'id'             => $check_record->id,
														'user_mobile'    => $check_record->user_mobile,
														'user_address'   => $check_record->country
													
														
										            );
													
												  if($check_record){
												      $msg = "Your profile has been updated successfully.";
													  $code = '200';
												  }else{
													  $msg = "Your updation is not sussessfully.";
													  $code = '400';
												  }
											
							}
							
							
							
							
						$final_output['responsecode'] = $code;	
						$final_output['status'] = 'success';
						$final_output['message'] =  $msg;
                        $final_output['data'] = $dataa_array;						
							
						
				   }
	
			 else
				{
					$final_output['responsecode'] = '404';
					$final_output['status'] = 'false';
					$final_output['message'] = 'Please send username';
					
				}
			}
	 
	 
		  else
			{
				$final_output['responsecode'] = '403';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Invalid token';
				
			} 
		
		 }
		 
		 
		  else
			{
				$final_output['responsecode'] = '502';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Unauthorised Access';
				
			}  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}



public function profiledatadelete()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	$typeid = $this->input->post('typeid');
	$type = $this->input->post('type');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
	  $check_key = $this->checktoken($headers['Secret-Key'],$userid);
	  if($check_key['status'] == 'true')
        { 
			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}
			
			if($type == 'experience'){
				
				$typedelete = $this->Common_model->deleteData('experience', array('id' => $typeid, 'userid' => $userid));
				
				
			}elseif($type == 'education'){
				
				$typedelete = $this->Common_model->deleteData('education', array('id' => $typeid, 'userid' => $userid));
				
			}else{
				$typedelete = $this->Common_model->deleteData('userskills', array('id' => $typeid, 'userid' => $userid));
			}
           
			  	
				if($typedelete){
					
					$final_output['status'] = 'success';
					$final_output['message'] = 'Record successfully delete.';
					$final_output['responsecode'] = '200';
				}else{

				    $final_output['responsecode'] = '402';
					$final_output['status'] = 'failed';
					$final_output['message'] = 'Record not delete';
				    
				}				
				
  
	     }
		  else
			{
				$final_output['responsecode'] = '403';
				$final_output['status'] = 'false';
				$final_output['message'] = 'You have logged in to some other device';
				
			} 
	
	 }
	  else
	    {
			$final_output['responsecode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}





public function newslist()
{
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');	
	
	$device_token  = $this->input->post('device_token');
	$device_id     = $this->input->post('device_id');
	$device_type   = $this->input->post('device_type');
	$basepath      = base_url();
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='AINA';
	
	date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    $curdates = date('Y-m-d H:i'); 
	
	$headers = apache_request_headers();
	if(($headers['Secret-Key'] !='') || ($headers['Secret-Key'] ==''))  
	{ 
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		
		
	   if($check_key['status'] == 'true' || $check_key['status'] == 'false')
        { 
			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}

    $auth_key = $this->rand_string(40);
    $final_output = array();
	 if((!empty($userid)) || (empty($userid)))
      {
		 $create_at     = $this->input->post('create_at');  					
		if($create_at==0)
		{
			$create_at1= "WHERE status='active'";
		}else
		{
			$create_at1= "WHERE create_at < $create_at AND status='active'";
		}
		
		
			//echo "SELECT * FROM news ".$create_at1." ORDER BY id DESC LIMIT 10 ";
			
			$query = $this->db->query("SELECT * FROM news ".$create_at1." ORDER BY id DESC LIMIT 10 ");	
			
			
			$check_records = $query->result();
			$count = $query->num_rows();
			
			if($count>0){
			 $j=1;	
			 foreach($check_records as $check_record)
			 {
				 
			  if(($j==3) && ($create_at==0)){
		                
			   if($userid!="")
		       {
				    $adverquery = $this->db->query("SELECT * FROM `advertise` WHERE status='active' ORDER BY id");				   
					$adverrecords = $adverquery->result();
					$totaladver   = $adverquery->num_rows();	
					
					if($totaladver>0)
					 {
						foreach($adverrecords as $adverdetails){
						
						$adverid        = $adverdetails->id;
						$advertisename  = $adverdetails->page_title;
						$date           = $adverdetails->date;
						$photo          = $adverdetails->image;
						
						$data=parse_url($photo, PHP_URL_SCHEME);
						if($data=='http' || $data=='https')
						  {
							  $adverimg = $photo;
						  }
						  else if($data!='http' || $data!='https'){
							   $adverimg = $basepath.'adminpanel/'.$photo;
						  }
						  else
						  {
						   
						  }
						  if($photo=='')
						  {
							   $adverimg = $basepath."adminpanel/advertise.jpg";
						  }
			
						$advertiselist[]= array('id'=>$adverid, 'advertisename'=>$advertisename, 'image'=>$adverimg); 
					}
					   $dataa_array[]=array('type'=>'advertise', 'advertise'=>$advertiselist);
				 
					 
				 }else{
					    $dataa_array=array();
				   }
				}else{
					    
						
				    $adverquery = $this->db->query("SELECT * FROM `advertise` WHERE status='active'");
				   
					$adverrecords = $adverquery->result();
					$totaladver   = $adverquery->num_rows();	
					
					if($totaladver>0)
					 {
						foreach($adverrecords as $adverdetails){
						
						$adverid        = $adverdetails->id;
						$advertisename  = $adverdetails->page_title;
						$date           = $adverdetails->date;
						$photo          = $adverdetails->image;
						
						$data=parse_url($photo, PHP_URL_SCHEME);
						if($data=='http' || $data=='https')
						  {
							  $adverimg = $photo;
						  }
						  else if($data!='http' || $data!='https'){
							   $adverimg = $basepath.'adminpanel/'.$photo;
						  }
						  else
						  {
						   
						  }
						  if($photo=='')
						  {
							   $adverimg = $basepath."adminpanel/images/advertise.jpg";
						  }
			
						$advertiselist[]= array('id'=>$adverid, 'advertisename'=>$advertisename, 'image'=>$adverimg); 
					}
					   $dataa_array[]=array('type'=>'advertise', 'advertise'=>$advertiselist);
				 
					 
				 }else{
					    $dataa_array=array();
				   }
						
						
				   }	
			 }	
				
			$newsid = $check_record->id;	
			if($userid !=''){
		        //$newsid = $check_record->id;
		        $check_bookmark_status = $this->Common_model->common_getRow('newsbookmark',array('newsid'=>$newsid,'userid'=>$userid));
        		if($check_bookmark_status!=''){		
        		    
        		     $bookmark_status = 1;
                     
        		}else{ 
        		   
                    $bookmark_status = 0;
        			 
        		}    
		        
		      }else{ 
        		   
                     $bookmark_status = 0;
        			 
        		}	
				
					$nphoto = $check_record->image;
					
					$ndata=parse_url($nphoto, PHP_URL_SCHEME);
					if($ndata=='http' || $ndata=='https')
					  {
						  $nimage = $nphoto;
					  }
					  else if($ndata!='http' || $ndata!='https'){
						   $nimage    = $basepath."adminpanel/".$nphoto;
					  }
					 
					
							 $sharedsocial='http://ainatoday.app.link/'.$newsid;
				             $slug = $check_record->slug;
							 $newsids = $check_record->id;
							 
							 $newsid = base64_encode($newsids);
						
				             $shareurl = $basepath.$slug."/".$newsid;
					    
				        		$shortdes = $check_record->description;
							   
                                $str = trim($shortdes);
                                $str = utf8_decode($str);
                                $str = str_replace("&nbsp;", " ", $str);
                                
                                $str = htmlspecialchars_decode($str, ENT_QUOTES);
                                $str = html_entity_decode($str, ENT_QUOTES);
                                
                                $str = $this->Common_model->decodeEmoticons($str);
                             
                                $fulldesc = $str;
                                $str = strip_tags($str);
                                
                             $text = $check_record->page_title;    
                             $strs = htmlspecialchars($text, ENT_NOQUOTES, "UTF-8");
							 $title = html_entity_decode($strs, ENT_QUOTES);
				
				        $dataa_array[]  = array(
														'id'             => $check_record->id,	
														'url'            => $check_record->slug,
														'title'          => $title,
														'description'    => $fulldesc,
														'shortdescription'=> $str,
														'images'         => $nimage,
														
														'authorname'     => $check_record->author,
														'date'           => $check_record->date,
														'totalclick'     => $check_record->click_count,				
														'readtime'       => $check_record->readtime,
														'newsid'         =>$newsid,
														'bookmarkstatus' => $bookmark_status,
														'sharedsocial'=>$sharedsocial,														
														'shareurl'        => $shareurl,
														'create_at'       =>$check_record->create_at,
														'type'            =>'news'
														
														
										            );
			 
						     $j++;	
						 }
			          
		        

                                    $final_output['responsecode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get news details';	
									$final_output['totalcount'] = $count;
									$final_output['data'] = $dataa_array;				
			}	
	    
		
		          else{
							$final_output['responsecode'] = '402';
							$final_output['status'] = 'failed';
							$final_output['message'] = 'Record not found';
							
						}
	       }	
			  
			else{
				$final_output['responsecode'] = '402';
				$final_output['status'] = 'failed';
				$final_output['message'] = 'Invalid user id please check again.';
				
			}
	       
	     
    }
	 
	  else
	    {
			$final_output['responsecode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'You have logged in to some other device';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responsecode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}



	
public function newsdetail()
{
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');	
	$newsid = $this->input->post('newsid');	
	
	$device_token  = $this->input->post('device_token');
	$device_id     = $this->input->post('device_id');
	$device_type   = $this->input->post('device_type');
	$basepath      = base_url();
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='AINA';
	
	date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    $curdates = date('Y-m-d H:i'); 
	
	$headers = apache_request_headers();
	if(($headers['Secret-Key'] !='') || ($headers['Secret-Key'] ==''))  
	{ 
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		
		
	   if($check_key['status'] == 'true' || $check_key['status'] == 'false')
        { 
			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}

    $auth_key = $this->rand_string(40);
    $final_output = array();
	 if((!empty($userid)) || (empty($userid)))
      {
		
		    $check_record = $this->Common_model->common_getRow('news',array('id'=>$newsid, 'status'=>'active'));
			
			if($check_record){
			  
				       
					        $nphoto = $check_record->image;
					
							$ndata=parse_url($nphoto, PHP_URL_SCHEME);
							if($ndata=='http' || $ndata=='https')
							  {
								  $nimage = $nphoto;
							  }
							  else if($ndata!='http' || $ndata!='https'){
								   $nimage    = $basepath."adminpanel/".$nphoto;
							  }
					 
					         $sharedsocial='http://ainatoday.app.link/'.$newsid;
					
				             $slug = $check_record->slug;
							 $newsids = $check_record->id;
							 
							    $newsid = base64_encode($newsids);
						
								
				                $shareurl = $basepath.$slug."/".$newsid;
					    
				        		$shortdes = $check_record->description;
							   
                                $str = trim($shortdes);
                                $str = utf8_decode($str);
                                $str = str_replace("&nbsp;", " ", $str);
                                
                                $str = htmlspecialchars_decode($str, ENT_QUOTES);
                                $str = html_entity_decode($str, ENT_QUOTES);
                                
                                $str = $this->Common_model->decodeEmoticons($str);
                             
                                $fulldesc = $str;
                                $str = strip_tags($str);
                                
                             $text = $check_record->page_title;    
                             $strs = htmlspecialchars($text, ENT_NOQUOTES, "UTF-8");
							 $title = html_entity_decode($strs, ENT_QUOTES);
					   
					   
				        $dataa_array  = array(
												'id'             => $check_record->id,	
												'url'            => $check_record->slug,
												'title'          => $title,
												'description'    => $fulldesc,
												
												'images'         => $nimage,
												'sharedsocial'	 => $sharedsocial,
												'authorname'     => $check_record->author,
												'date'           => $check_record->date,
												'totalclick'     => $check_record->click_count,				
												'readtime'       => $check_record->readtime,
												
																
												'shareurl'       => $shareurl,
												'create_at'      => $check_record->create_at,
												'type'           =>'news'
												
											);
				 
				        
					                $final_output['responsecode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'news details';
									$final_output['data'] = $dataa_array;
				          
	           }
			  
			else{
				$final_output['responsecode'] = '402';
				$final_output['status'] = 'failed';
				$final_output['message'] = 'Record not found';
				
			}
	       
        }
	 
	  else
	    {
			$final_output['responsecode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Wrong user id';
			
	    } 
	
	 }
	 
	 else
	    {
			$final_output['responsecode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'You have logged in to some other device';
			
	    } 
	}
	 
	  else
	    {
			$final_output['responsecode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}		





public function newsbookmark()
{
	
	$this->load->model('Common_model');
	
	$newsid = $this->input->post('newsid');	
	$userid = $this->input->post('id');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
		
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		    
		if($check_key['status'] == 'true')
			{ 
	
				$auth_key = $this->rand_string(40);

				$final_output = array();
				$insert_array = array();
				
			
							if(!empty($newsid))
							{  				
								$check_bookmark = $this->Common_model->common_getRow('newsbookmark',array('newsid'=>$newsid,'userid'=>$userid));
								if(!empty($check_bookmark))
								{
									
									 $unbookmark = $this->Common_model->deleteData('newsbookmark', array('newsid' => $newsid, 'userid' => $userid));
									  $query = $this->Common_model->updateunbookmark($newsid);
									  
									  if($query){
										  $msg = "News has been unbookmarked.";
										  $flag = 0;
									  }
								}
								else
								{
									      $insert_array['newsid']=$newsid;
										  $insert_array['bookmark']=1;
										  $insert_array['userid']=$userid;	
										  $insert_array['ip']='';
										  $insert_array['create_at']=militime;	
										  $insert_array['update_at']=militime;
										  
										  $insertId = $this->db->insert('newsbookmark', $insert_array);
										  $query = $this->Common_model->updatebookmark($newsid);
										
										  if($query){
											  $msg = "News has been bookmarked successfully.";
											  $flag = 1;
										  }
								}
								
								$final_output['responsecode'] = '200';				
								$final_output['status'] = 'success';
								$final_output['message'] = $msg;	
								$final_output['flag'] = $flag;
							 }
							 
							 else
								{
									$final_output['responsecode'] = '404';
									$final_output['status'] = 'false';
									$final_output['message'] = 'Please send newsid';
								}
							 
							 
						}
				  else
					{
						$final_output['responsecode'] = '403';
						$final_output['status'] = 'false';
						$final_output['message'] = 'Invalid token';
						
					} 
		
				}
	 
		  else
			{
				$final_output['responsecode'] = '502';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Unauthorised Access';
				
			}  
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}



public function bookmarklist()  //Save job or News bookmark 
{
	$this->load->model('Common_model');
	
	$userid       = $this->input->post('id');	
	
	$device_token = $this->input->post('device_token');
	$device_id    = $this->input->post('device_id');
	$device_type  = $this->input->post('device_type');
	$basepath     = base_url();
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='AINA';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		
		
	if($check_key['status'] == 'true')
        { 
	
		if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
		{ 
			$device_token = '';
		}


    $auth_key = $this->rand_string(40);

    $final_output = array();
   
			$create_at = $this->input->post('create_at');
			
			if($create_at==0)
			{
				$create_at1= "WHERE userid='".$userid."'";
			}else
			{
				$create_at1= "WHERE userid='".$userid."' AND create_at < $create_at ";
			}
				
			$query = $this->db->query("SELECT * FROM newsbookmark ".$create_at1." ORDER BY id DESC LIMIT 10");
			$check_records = $query->result();
			$count = $query->num_rows();
			
			if($count>0){
			 
			 foreach($check_records as $check_record1)
			 {
				
				        $newsid   = $check_record1->newsid;
						$createat = $check_record1->create_at;
						
						
					    $check_record = $this->Common_model->common_getRow('news',array('id'=>$newsid, 'status'=>'active'));
						if(!empty($check_record))
						{
						  
							 $slug = $check_record->slug;
							 $newsids = $check_record->id;
						
						     $newsid = base64_encode($newsids);   
				             $shareurl = $basepath.$slug."/".$newsid;
				      	 
						
						
						     $nphoto = $check_record->image;
					
				        
						        $ndata=parse_url($nphoto, PHP_URL_SCHEME);
								if($ndata=='http' || $ndata=='https')
								  {
									  $nimage = $nphoto;
								  }
								  else if($ndata!='http' || $ndata!='https'){
									   $nimage    = $basepath."adminpanel/".$nphoto;
								  }
						
						
				              $shortdes = $check_record->description;
							    $str = trim($shortdes);
                                $str = utf8_decode($str);
                                $str = str_replace("&nbsp;", " ", $str);
                                $str = htmlspecialchars_decode($str, ENT_QUOTES);
                                $str = html_entity_decode($str, ENT_QUOTES);
                                
                                $str = $this->Common_model->decodeEmoticons($str);
                                $fulldesc = $str;
                                $str = strip_tags($str);
								
								 $text = $check_record->page_title;    
								 $strs = htmlspecialchars($text, ENT_NOQUOTES, "UTF-8");
								 $title = html_entity_decode($strs, ENT_QUOTES);
				
				        $dataa_array[]  = array(
												'id'             => $check_record->id,	
												'url'            => $check_record->slug,
												'title'          => $title,
												'description'    => $fulldesc,
												'shortdescription'=> $str,
												'images'         => $nimage,
												
												'authorname'     => $check_record->author,
												'date'           => $check_record->date,
												'totalclick'     => $check_record->click_count,				
												'readtime'       => $check_record->readtime,
												
												'bookmarkstatus' => '1',				
												'shareurl'        => $shareurl,
												'create_at'       => $check_record->create_at,
												'type'            =>'news'
														
														
										      );
			 
			
			              }
			          
			        }

					$final_output['responsecode'] = '200';				
					$final_output['status'] = 'success';
					$final_output['message'] = 'Bookmark List';	
					$final_output['data'] = $dataa_array;				
			    			
				
			  }
			  
			else{
				$final_output['responsecode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Records not found.';
				
			}
	       
			
	   
	}
	 
	 
	  else
	    {
			$final_output['responsecode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responsecode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}



public function read_status()
{
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{
         $check_key = $this->checktoken($headers['Secret-Key']);

        if($check_key['status'] == 'true')
        {
        	$student_id = $check_key['data']->student_id;

        	$message_id = $this->input->post('message_id');

        	$check_status = $this->common_model->common_getRow('message_read_status',array('message_id'=>$message_id,'student_id'=>$student_id));

        	if(!empty($check_status))
        	{
        		$final_output['status'] = 'failed';
			    $final_output['message'] = 'Already exist.';
			    unset($final_output['data']);
        	}
        	else
        	{
        		$insert_array = array('student_id'=>$student_id,'message_id'=>$message_id,'read_status'=>1);

        		$insertId = $this->common_model->common_insert('message_read_status', $insert_array);

        		$final_output['status'] = 'success';
				$final_output['message'] = 'successfully.';	
        	}	
			
        }
        else
	    {
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid Token';
	    }	

	} 
	else
	{
	   $final_output['status'] = 'false';
	   $final_output['message'] = 'Unauthorised Access';
	}	

   header("content-type: application/json");
   echo json_encode($final_output);	

}


function rand_string($length) {
    $str="";
    $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for($i = 0;$i < $length;$i++) {
      $str .= $chars[rand(0,$size-1)];
    }
    return $str;
  }

    public function checktoken($token,$userid)
    {
		$this->load->model('Common_model');
	
    	$auth = $this->Common_model->common_getRow('user_register',array('token_security'=>$token,'id'=>$userid));
    
    	if(!empty($auth))
    	{
    		$abc['status'] = "true";
    		$abc['data'] =$auth;
    		return $abc;
    	}else
    	{
    		$abc['status'] = "false";
    		return $abc;
    	}
    } 
    
    //add by zubear test data start
	function save_data()
	{
		//print_r(file_get_contents('php://input'));exit;
		$json = file_get_contents('php://input');
	    $json_array = json_decode($json);
	    $final_output = array();
	    if(!empty($json_array))
	    {
	    	if($json_array->user_email!='' && $json_array->user_password!='')
	    	{
	    		$data_array = array(
				'user_name'=>$json_array->user_email,
                'password'=>$json_array->user_password,
               	);
				
				$insertId = $this->Common_model->common_insert('extention_user_password', $data_array);
	    		if(!empty($insertId))
	    		{
					
					$final_output['status'] = 'success';
	    			$final_output['message'] = 'Login Successfully';
	    			$final_output['data'] = $data_array;
	    		}else
	    		{
	    			$final_output['status'] = 'failed';
	    			$final_output['message'] = 'failed3';
	    		}
	    	}else
	    	{
	    		$final_output['status'] = 'failed';
	    		$final_output['message'] = 'failed4';
	    	}
	    }else
	    {
	    	$final_output['status'] = 'failed';
	    	$final_output['message'] = "No Request Parameter Found.";
	    }
	    header("content-type: application/json");
	    echo json_encode($final_output);
	}
	//end login (Y) //add by zubear test data end
	
}
