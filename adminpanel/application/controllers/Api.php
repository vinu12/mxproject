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
/*  insertuser	
	verifyOTP
	random_password
	resetpassword
	
	getemailotp
	login
	userlogin
	getuserprofile
	
	searchuser
	followerslist
	followinglist
	
	usernews
	newslist
	relatednews
	newssearch
	
	logout
	
	changepassword
	expedudelete
	updateprofile
	
	userprofilescroller
	userlist
	singleuserprofile
	newslike
	userfollow
	newsbookmark
	bookmarklist   joblist or newslist
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
														'responseCode'=>'404'
							                  			
										            );
			
            
        }
		header("content-type: application/json");
		echo json_encode($dataa_array);
    }  

	
/* Normal signup OTP  API */	
	
public function insertuser()
{
	$this->load->model('Common_model');
	$device_token = $this->input->post('device_token');
	$device_type = $this->input->post('device_type');
	$name = $this->input->post('user_name');
	$email = $this->input->post('user_email');
	$password = $this->input->post('password');
	$phoneno = $this->input->post('user_mobile');
	$tokenid  = $this->input->post('token_id'); 
	$device_id = $this->input->post('device_id'); 
	
	$siteid      ='Beyondteaching';
	$date = date("Y-m-d")." ".date("H:i:s");
    //$otp  = strtoupper(substr(md5(uniqid()), 0, 6));
	$otp = sprintf("%06d", mt_rand(1, 999999));
	$status=0;
	 
   if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
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
									
										
										$final_output['status'] = 'Failed';
										$final_output['message'] = 'User Already exist.';	
										$final_output['responseCode'] = '400';
								
								}
								else
								{ 
							
									  $insert_array = array();
									  
									  $insert_array['photo']='';
									  $insert_array['user_dob']='';
									  $insert_array['user_gender']='';
									  $insert_array['user_mobile']=$phoneno;
									  $insert_array['position']='';
									  $insert_array['country']='';
									  $insert_array['bio']='';
									  $insert_array['skills']='';
									  $insert_array['schooling']='';
									  $insert_array['university']='';
									  $insert_array['experience']='';
									  $insert_array['interest']='';
									  $insert_array['language']='';
									  $insert_array['desire']='';
									  $insert_array['maritalstatus']='';
									  $insert_array['link']='';
									  $insert_array['followers']=0;
									  $insert_array['following']=0;
									  $insert_array['comments']=0;
									  $insert_array['hire']=0;
									  $insert_array['newscount']=0;
									 
									  $insert_array['user_name']=$name;
									  $insert_array['user_email']=$email;
									  $insert_array['oauth_uid']='';
									  $insert_array['deviceid']=$device_id;
									  $insert_array['tokenid']=$device_token;
									  $insert_array['token_security']=$auth_key;
									  $insert_array['sourcemedia']=$device_type;
									  $insert_array['siteid']=$siteid;
									  $insert_array['password']=md5($password);
									  $insert_array['otp']=$otp;
									  $insert_array['created']=$date;
									  $insert_array['status']=$status;
									  $insert_array['modified']=$date;
									  $insert_array['create_at']=militime;
									  $insert_array['update_at']=militime;
								
							
					    //$insertId = $this->Common_model->common_insert('user_register', $insert_array);		
												 
						$insertId = $this->db->insert('user_register', $insert_array);
						
									   
								if($insertId)
								{		
						$message ="
								  <!DOCTYPE html>
									<html>
										<head>
											<meta charset='utf-8' />
											<title>Beyond Teaching</title>
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
													<td>&nbsp;</td>
												</tr>
												<h4>Hi $name,</h4>
												<h4>Your Login details are bellow:</h4>

												<tr>
														<th>Username:</th>
														<td> $email </td>
												</tr>
												
												<tr>
														<th>OTP:</th>
														<td> $otp </td>
												</tr>

												<tr>
												   <th><h3>Thank you</h3></th>
												</tr> 
										</table>

									</body>
									</html>
									";
						$headers = "From:no-reply@beyondteaching.com\r\n";
						$headers.= "Mime-Version: 1.0\r\n";
						$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$toEmail = $email;	
						
						$subject="Beyond Teaching Verification Alert";
						$mail_sent = mail($toEmail, $subject, $message, $headers);
											
											

						$final_output['status'] = 'success';
						$final_output['message'] = 'You have logged-in successfully Please check your email id Otp has been sent to your emailid.';	
						$final_output['responseCode'] = '200';
						
							}else
							{ 
									$final_output['status'] = 'failed';
									$final_output['message'] = 'Something went wrong! please try again.';
									$final_output['responseCode'] = '400';
									//unset($final_output['data']);
							}	
				  }	
						
				}else
				{
					$final_output['status'] = 'failed';
					$final_output['message'] = 'Required parameter not found';
					$final_output['responseCode'] = '400';
					//unset($final_output['data']);
				}
		  }	else{
					$final_output['status'] = 'Failed';
					$final_output['message'] = 'Invalid email format please check again.';
					$final_output['responseCode'] = '400';
		  }
 	header("content-type: application/json");
    echo json_encode($final_output);
}


  /* Verify OTP  API */	


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
								
								$photo        = $check_all_record->photo;
								
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
								
								
					    						'id'=>$check_all_record->id,	
					                  			'user_name'=>$check_all_record->user_name,
												'user_dob'      => $check_all_record->user_dob,
					                  			'user_email'=>$check_all_record->user_email,
						
					            				'user_mobile'=>$check_all_record->user_mobile,
					                  			'user_photo'=>$uphoto,
					                  			'sourcemedia'=>$check_all_record->deviceid,
						
												'token_security' =>$check_all_record->token_security,
												'user_position' => $check_all_record->position,
												'user_country'  => $check_all_record->country,
												'user_bio'      => $check_all_record->bio,				
												'user_skills'   => $check_all_record->skills,
												'user_schooling'=> $check_all_record->schooling,
												
												'user_university' => $check_all_record->university,
												'user_experience' => $check_all_record->experience,
												'user_interest'   => $check_all_record->interest,
												'user_language'   => $check_all_record->language,
												'user_desire'     => $check_all_record->desire,			
												'user_marital'    => $check_all_record->maritalstatus,
												
												'user_followers'  => $check_all_record->followers,			
												'user_following'  => $check_all_record->following,
												'user_news'  => $check_all_record->newscount,
												'user_comments'  => $check_all_record->comments,												
												'user_hire'       => $check_all_record->hire,
												
												
												'usercompany'     => $companyname,
												'userdesignation' => $designation,
												'userlocation'    => $location,
												
												'user_date'       => $check_all_record->modified,
												'user_create_at'       => $check_all_record->create_at,
												'user_update_at'       => $check_all_record->update_at
												
					                  			
								            );
										
					$final_output['status'] = 'Success';
					$final_output['message'] = 'Thank you';
					$final_output['data'] = $data_array;
					$final_output['responseCode'] = '200';
					
				}	

				header("content-type: application/json");
				echo json_encode($final_output);
    }	
	
	
	function random_password($length = 8) 
	{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
	}
	
	/** forgot password API ***/
	
	
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
						$final_output['responseCode'] = '400';						
						
				}
				else
				{ 	
					$otpstatus = $this->Common_model->otp_status($email, $otp);
					
					$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'password'=>md5($password)),array('user_email'=>$email));
					
					
					$final_output['status'] = 'Success';
					$final_output['message'] = 'Thank you your password reset successfully.';
					$final_output['responseCode'] = '200';
					
				}
				}	
				else{
					$final_output['status'] = 'Failed';
					$final_output['message'] = 'Invalid email format please check again.';
					$final_output['responseCode'] = '400';
				}

				header("content-type: application/json");
				echo json_encode($final_output);
    }	

	
	 public function changepassword()
	{
		
		$this->load->model('Common_model');
		
		$userid = $this->input->post('id');
		$oldpassword = $this->input->post('oldpassword');
		$newpassword = $this->input->post('newpassword');
		
		$device_token = $this->input->post('device_token');
		$device_id = $this->input->post('device_id');
		$device_type = $this->input->post('device_type');
		
		$headers = apache_request_headers();
		if($headers['Secret-Key'] !='') 
		{ 
			//$check_key = $this->checktoken($headers['Secret-Key']);  25d55ad283aa400af464c76d713c07ad
			$check_key = $this->checktoken($headers['Secret-Key'],$userid);
			if($check_key['status'] == 'true')
				{ 
		
		
		
				if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
				{ 
					$device_token = '';
				}
          //$auth_key = $this->rand_string(40);
			
		    
			   $changepassword = $this->Common_model->check_userpassword($userid, md5($oldpassword));
			   
			   if($changepassword==0)
				{
						$final_output['status'] = 'Failed';
						$final_output['message'] = 'Your password is not correct. Please check again';
						$final_output['responseCode'] = '400';						
						
				}
				else
				{ 	
					//$otpstatus = $this->Common_model->update_userpassword($userid, $oldpassword);
					
					$update_value = $this->Common_model->updateData('user_register',array('password'=>md5($newpassword)),array('id'=>$userid));
					
					
					$final_output['status'] = 'Success';
					$final_output['message'] = 'Thank you! your password has been changed successfully. ';
					$final_output['responseCode'] = '200';
					
				}
		
        }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  

		
				
				header("content-type: application/json");
				echo json_encode($final_output);
				
    }	
	
	
	
	public function getemailotp()
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
					
					
					
					$message ="
								  <!DOCTYPE html>
									<html>
										<head>
											<meta charset='utf-8' />
											<title>Beyond Teaching</title>
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
													<td>&nbsp;</td>
												</tr>
												<h4>Hi $check_all_record->user_name,</h4>
												<h4>Your Login details are bellow:</h4>

												<tr>
														<th>Username:</th>
														<td> $email </td>
												</tr>
												
												<tr>
														<th>OTP:</th>
														<td> $check_all_record->otp </td>
												</tr>

												<tr>
												   <th><h3>Thank you</h3></th>
												</tr> 
										</table>

									</body>
									</html>
									";
						$headers = "From:no-reply@beyondteaching.com\r\n";
						$headers.= "Mime-Version: 1.0\r\n";
						$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$toEmail = $email;	
						
						$subject="Beyond Teaching Verification Alert";
						$mail_sent = mail($toEmail, $subject, $message, $headers);
											
											

						$final_output['status'] = 'success';
						$final_output['message'] = 'Please check your email id Otp has been sent to your emailid.';	
						$final_output['responseCode'] = '200';
					
					
				}
				}	
				else{
					$final_output['status'] = 'Failed';
					$final_output['message'] = 'Invalid email format please check again.';
					$final_output['responseCode'] = '400';
				}

				header("content-type: application/json");
				echo json_encode($final_output);
    }	
	

/* Social login API */	
	

public function login()
{
	
	$this->load->model('Common_model');
	$email = $this->input->post('email');
	$name = $this->input->post('name');
	$image = $this->input->post('image');
	$contact_no = $this->input->post('contact_no');
	$oauid     = $this->input->post('oauth_uid');
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
    $type = $this->input->post('social_login_type');
	$sourcemedia = $this->input->post('sourcemedia');
	$oauth     = $this->input->post('oauth_provider');	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';

   if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }

    $version_code = $this->input->post('version_code');

     $auth_key = $this->rand_string(40);

    $final_output = array();

    if(!empty($oauid))
    {
      
					/*if($email=="")
					{
						
					$check_email = $this->Common_model->common_getRow('user_register',array('oauth_uid'=>$oauid));
					} */
					if($oauid!='')
					{
						$check_email = $this->Common_model->checkexistRecord($oauid);
						
						if($check_email){
							$emailcheck = $check_email->user_email;
						    
							if($emailcheck!=''){
								
							$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'token_security'=>$auth_key,'deviceid'=>$device_id,'tokenid'=>$device_token,'oauth_provider'=>$oauth, 'user_name'=>$name,'sourcemedia'=>$sourcemedia,'created'=>$created,'modified'=>$modified,'status'=>$status,'user_mobile'=>$contact_no),array('oauth_uid'=>$oauid));
							}
						
							else{
								
								$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'token_security'=>$auth_key,'deviceid'=>$device_id,'tokenid'=>$device_token,'oauth_provider'=>$oauth, 'user_name'=>$name,'sourcemedia'=>$sourcemedia,'created'=>$created,'modified'=>$modified,'status'=>$status,'user_mobile'=>$contact_no,'user_email'=>$email),array('oauth_uid'=>$oauid));
								
							}
						}
					}
					
					if($email!='')
					{
						$check_email = $this->Common_model->checkemailexistRecord($email);
						
						$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'token_security'=>$auth_key,'deviceid'=>$device_id,'tokenid'=>$device_token,'oauth_provider'=>$oauth, 'user_name'=>$name,'sourcemedia'=>$sourcemedia,'created'=>$created,'modified'=>$modified,'status'=>$status,'user_mobile'=>$contact_no),array('user_email'=>$email));

					}
					
					
					if($check_email!="")
					{
					    	//$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'token_security'=>$auth_key,'deviceid'=>$device_id,'tokenid'=>$device_token,'oauth_provider'=>$oauth,'photo'=>$image,'user_name'=>$name,'sourcemedia'=>$sourcemedia,'created'=>$created,'modified'=>$modified,'status'=>$status,'user_mobile'=>$contact_no,'user_email'=>$email),array('oauth_uid'=>$oauid));

					    	//$query = $this->db->query("UPDATE `user_register` SET `tokenid` = '' WHERE `deviceid` = '$device_id' AND `id` != '$register_id'");
							
							    $uids = $check_email->id;
				
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
								
								$photo        = $check_email->photo;
								
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
								
								
					    						'id'=>$check_email->id,	
					                  			'user_name'=>$check_email->user_name,
												'user_dob'      => $check_email->user_dob,
					                  			'user_email'=>$check_email->user_email,
												'user_oauth'=>$check_email->oauth_uid,
						
					            				'user_mobile'=>$check_email->user_mobile,
					                  			'user_photo'=>$uphoto,
					                  			'sourcemedia'=>$check_email->sourcemedia,
						
												'token_security' =>$auth_key,
												'user_position' => $check_email->position,
												'user_country'  => $check_email->country,
												'user_bio'      => $check_email->bio,				
												'user_skills'   => $check_email->skills,
												'user_schooling'=> $check_email->schooling,
												
												'user_university' => $check_email->university,
												'user_experience' => $check_email->experience,
												'user_interest'   => $check_email->interest,
												'user_language'   => $check_email->language,
												'user_desire'     => $check_email->desire,			
												'user_marital'    => $check_email->maritalstatus,
												
												'user_followers'  => $check_email->followers,			
												'user_following'  => $check_email->following,
												'user_news'  => $check_email->newscount,
												'user_comments'  => $check_email->comments,												
												'user_hire'       => $check_email->hire,
												
												'usercompany'     => $companyname,
												'userdesignation' => $designation,
												'userlocation'    => $location,
												
												'user_date'       => $check_email->modified,
												'user_create_at'       => $check_email->create_at,
												'user_update_at'       => $check_email->update_at
												
					                  			
								            );
											
							
					    	
							$final_output['status'] = 'success';
							$final_output['message'] = 'You have logged-in successfully.';	
							$final_output['data'] = $data_array;
							$final_output['responseCode'] = '200';
					
			    	}
			    	else
					{ 
				
				
			    	     $insert_array = array();
									
									
									 
									  
									  $insert_array['user_gender']='';
									 
									  $insert_array['position']='';
									  $insert_array['country']='';
									  $insert_array['bio']='';
									  $insert_array['skills']='';
									  $insert_array['schooling']='';
									  $insert_array['university']='';
									  $insert_array['experience']='';
									  $insert_array['interest']='';
									  $insert_array['language']='';
									  $insert_array['desire']='';
									  $insert_array['maritalstatus']='';
									  $insert_array['link']='';
									  $insert_array['followers']=0;
									  $insert_array['following']=0;
									  $insert_array['comments']=0;
									  $insert_array['hire']=0;
									  $insert_array['password']='';
									  $insert_array['newscount']=0;
						 
					                  $insert_array['user_name']=$name;
									  $insert_array['user_email']=$email;
									  $insert_array['user_mobile']=$contact_no;
									  $insert_array['photo']=$image;
									  $insert_array['user_dob']='';
									  $insert_array['siteid']=$siteid;
									  $insert_array['deviceid']=$device_id;
									  $insert_array['tokenid']=$device_token;
									  $insert_array['token_security']=$auth_key;
									  $insert_array['oauth_provider']=$oauth;
									  $insert_array['oauth_uid']=$oauid;
									  $insert_array['sourcemedia']=$sourcemedia;
									  $insert_array['created']=$created;
									  $insert_array['modified']=$modified;
									  $insert_array['status']=$status;
									  $insert_array['create_at']=militime;
									  $insert_array['update_at']=militime;
									  
									  $insert_array['otp']='';
									 
									 

			    	        $insertId = $this->Common_model->common_insert('user_register', $insert_array);
							
							$check_record = $this->Common_model->common_getRow('user_register',array('id'=>$insertId));
							
							$basepath=base_url();
					    	if($insertId)
					    	{
								
								$uids = $check_record->id;
				
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
								
								if($check_record->country==NULL)
								{
									$country="";
								}
								else
								{
									$country =$check_record->country;
								}
								
								
					    		$dataa_array  = array(
														'id'=>$insertId,	
														'user_name'=>$name,
														'user_email'=>$email,
														'user_mobile'=>$contact_no,
														'user_photo'=>$uphoto,
														'user_position'=>$check_record->position,
														'sourcemedia'=>$sourcemedia,
														'user_country'  => $country,
														'user_bio'      => $check_record->bio,				
														'user_skills'   => $check_record->skills,
														'user_schooling'=> $check_record->schooling,
														'token_security' =>$check_record->token_security,
														'user_university' => $check_record->university,
														'user_experience' => $check_record->experience,
														'user_interest'   => $check_record->interest,
														'user_language'   => $check_record->language,
														'user_desire'     => $check_record->desire,			
														'user_marital'    => $check_record->maritalstatus,

														'user_followers'  => $check_record->followers,			
														'user_following'  => $check_record->following,
														'user_news'  => $check_record->newscount,
														'user_comments'  => $check_record->comments,												
														'user_hire'       => $check_record->hire,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'user_date'       => $check_record->modified,
														'user_create_at'       => $check_record->create_at,
														'user_update_at'       => $check_record->update_at
														
										            );

					    	    $query = $this->db->query("UPDATE `user_register` SET `tokenid` = '' WHERE `deviceid` = '$device_id' AND `id` != '$insertId'");


					    		    $final_output['status'] = 'success';
									$final_output['message'] = 'You have logged-in successfully.';	
									$final_output['data'] = $dataa_array;
									$final_output['responseCode'] = '200';
							}else
							{ 
									$final_output['status'] = 'failed';
							     	$final_output['message'] = 'Something went wrong! please try again.';
									$final_output['responseCode'] = '400';
							     	unset($final_output['data']);
							}	
			    	}	
		//}    	
	}
	
	
	
	
	
	else
	{
		$final_output['status'] = 'failed';
	 	$final_output['message'] = 'Required parameters not found';
		$final_output['responseCode'] = '400';
	 	unset($final_output['data']);
	}
	
		
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	




public function userlogin()
{
	
	$this->load->model('Common_model');
	
	$email = $this->input->post('email');
	$password = $this->input->post('password');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	$oauth     = $this->input->post('oauth_provider');
	
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$otp = sprintf("%06d", mt_rand(1, 999999));
	$siteid      ='Beyondteaching';

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
				
				$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'token_security'=>$auth_key,'deviceid'=>$device_id,'tokenid'=>$device_token,'created'=>$created,'modified'=>$modified),array('user_email'=>$email));
				
				$check_recordD = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
				
				$basepath=base_url();
				$photo = $check_recordD->photo;
				$uids = $check_recordD->id;
				
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
				
				
				 $dataa_array  = array(
														'id'=>$check_recordD->id,	
														'user_name'=>$check_recordD->user_name,
														'user_email'=>$check_recordD->user_email,
														'user_mobile'=>$check_recordD->user_mobile,
														
														'user_photo'=>$uphoto,
														'user_position'=>$check_recordD->position,
														'sourcemedia'=>$device_type,
														'user_country'  => $check_recordD->country,
														'user_bio'      => $check_recordD->bio,				
														'user_skills'   => $check_recordD->skills,
														'user_schooling'=> $check_recordD->schooling,
														'token_security' =>$auth_key,
														'user_university' => $check_recordD->university,
														'user_experience' => $check_recordD->experience,
														'user_interest'   => $check_recordD->interest,
														'user_language'   => $check_recordD->language,
														'user_desire'     => $check_recordD->desire,			
														'user_marital'    => $check_recordD->maritalstatus,

														'user_followers'  => $check_recordD->followers,			
														'user_following'  => $check_recordD->following,
														'user_news'  => $check_recordD->newscount,
														'user_comments'  => $check_recordD->comments,												
														'user_hire'       => $check_recordD->hire,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'user_date'       => $check_recordD->modified,
														'user_create_at'       => $check_recordD->create_at,
														'user_update_at'       => $check_recordD->update_at
														
										            );
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'You have logged-in successfully.';	
									$final_output['data'] = $dataa_array;
									
				
			  }
		   else{
			   
			   
				$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'otp'=>$otp),array('user_email'=>$email));
				   	
					$check_recordD = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
					if($check_recordD)
					{
						
					$nameuser=$check_recordD->user_name;
						$message ="
								  <!DOCTYPE html>
									<html>
										<head>
											<meta charset='utf-8' />
											<title>Beyond Teaching</title>
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
													<td>&nbsp;</td>
												</tr>
												<h4>Hi $nameuser,</h4>
												<h4>Your Login details are bellow:</h4>

												<tr>
														<th>Username:</th>
														<td> $email </td>
												</tr>
												
												<tr>
														<th>OTP:</th>
														<td> $otp </td>
												</tr>

												<tr>
												   <th><h3>Thank you</h3></th>
												</tr> 
										</table>

									</body>
									</html>
									";
						$headers = "From:no-reply@beyondteaching.com\r\n";
						$headers.= "Mime-Version: 1.0\r\n";
						$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$toEmail = $email;	
						
						$subject="Beyond Teaching Verification Alert";
						$mail_sent = mail($toEmail, $subject, $message, $headers);
			   
			   
			   
					$final_output['status'] = 'failed';
					$final_output['message'] = 'You have not verified OTP yet. It has been sent to your email id. Please verify.';
					$final_output['responseCode'] = '405';
					unset($final_output['data']);
		      }
		   }  
		  }
		    else{
					$final_output['status'] = 'failed';
					$final_output['message'] = 'Invalid credentials';
					$final_output['responseCode'] = '400';
					unset($final_output['data']);
			   }
			   
		  }
		   
		   			  
			else{
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Invalid email format please check again.';
				$final_output['responseCode'] = '400';
			}
	       
			
	}
	else
	{
		$final_output['status'] = 'failed';
	 	$final_output['message'] = 'Required parameters not found';
		$final_output['responseCode'] = '400';
	 	unset($final_output['data']);
	}
	
		
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	



public function updateemail()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	$email = $this->input->post('email');
	
	$device_token = $this->input->post('device_token');
	$device_id   = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	$oauth       = $this->input->post('oauth_provider');
	
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$otp = sprintf("%06d", mt_rand(1, 999999));
	$siteid      ='Beyondteaching';

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
				
					if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
					  {
						
							$update_value = $this->Common_model->updateData('user_register',array('update_at'=>militime,'otp'=>$otp),array('id'=>$userid));
								
								$check_recordD = $this->Common_model->common_getRow('user_register',array('id'=>$userid));
								if($check_recordD)
								{
									
								   $nameuser=$check_recordD->user_name;
									$message ="
											  <!DOCTYPE html>
												<html>
													<head>
														<meta charset='utf-8' />
														<title>Beyond Teaching</title>
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
																<td>&nbsp;</td>
															</tr>
															<h4>Hi $nameuser,</h4>
															<h4>Your Login details are bellow:</h4>

															<tr>
																	<th>Username:</th>
																	<td> $email </td>
															</tr>
															
															<tr>
																	<th>OTP:</th>
																	<td> $otp </td>
															</tr>

															<tr>
															   <th><h3>Thank you</h3></th>
															</tr> 
													</table>

												</body>
												</html>
												";
									$headers = "From:no-reply@beyondteaching.com\r\n";
									$headers.= "Mime-Version: 1.0\r\n";
									$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

									$toEmail = $email;	
									
									$subject="Beyond Teaching Verification Alert";
									$mail_sent = mail($toEmail, $subject, $message, $headers);
						   
						   
						   
								$final_output['status'] = 'failed';
								$final_output['message'] = 'You have not verified OTP yet. It has been sent to your email id. Please verify.';
								$final_output['responseCode'] = '405';
								unset($final_output['data']);
					   }
					   
					   else
					   {
							$final_output['status'] = 'Failed';
							$final_output['message'] = 'Your Email id not registered Please signup';
							$final_output['responseCode'] = '400';
						   
					   }
					   
					   
					  }			  
						else{
							$final_output['status'] = 'Failed';
							$final_output['message'] = 'Invalid email format please check again.';
							$final_output['responseCode'] = '400';
						}
					
	        }
			
	 else
		{
			$final_output['responseCode'] = '404';
			$final_output['status'] = 'false';
			$final_output['message'] = 'Please send user name';
			
		}
			
			   
		}
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}




public function getuserprofile()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
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
			$check_edu = $this->Common_model->getusereducation($userid);
			$check_exp = $this->Common_model->getuserexperience($userid);
			
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
				$description = $valdata->description;
				
				$edu[]= array('eduid'=>$eduid, 'qualification'=>$quali, 'collegename'=>$cname, 'fromyear'=>$fromyear, 'toyear'=>$toyear,'location'=>$location,'description'=>$description); 
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
				$description = $valexp->description;
				$address     = $valexp->location;
				$fromyear    = $valexp->fromdate;
				$toyear      = $valexp->todate;
				
				
				$exp[]= array('expid'=>$expid, 'designation'=>$designation, 'companyname'=>$companyname, 'description'=>$description, 'location'=>$address, 'fromyear'=>$fromyear, 'toyear'=>$toyear); 
			}
			}
			else
			{
				$exp= array(); 
			}
			
			
			//$check_exp = $this->Common_model->getuserexperience($userid);
			
			if($check_record!=''){
				
				
				$uids = $check_record->id;
				
				$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids, 'todate'=>'Present'));
				
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
					   $uphoto = $basepath."assets/images/nophoto.png";
				  }
				
				 $dataa_array  = array(
														'id'=>$check_record->id,	
														'user_name'=>$check_record->user_name,
														'user_email'=>$check_record->user_email,
														'user_mobile'=>$check_record->user_mobile,
														
														'user_photo'=>$uphoto,
														'user_position'=>$check_record->position,
														'sourcemedia'=>$device_type,
														'user_country'  => $check_record->country,
														'user_bio'      => $check_record->bio,				
														'user_skills'   => $check_record->skills,
														'token_security' =>$check_record->token_security,
														
														'user_interest'   => $check_record->interest,
														'user_language'   => $check_record->language,
														'user_desire'     => $check_record->desire,			
														'user_marital'    => $check_record->maritalstatus,

														'user_followers'  => $check_record->followers,			
														'user_following'  => $check_record->following,
														'user_news'  => $check_record->newscount,
														'user_comments'  => $check_record->comments,												
														'user_hire'       => $check_record->hire,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'user_date'       => $check_record->modified,
														'user_create_at'       => $check_record->create_at,
														'user_update_at'       => $check_record->update_at,
														'education'  =>$edu,
														'experience' =>$exp,
														
										            );
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get user details';	
									$final_output['data'] = $dataa_array;
									
				
			  }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Invalid user id please check again.';
				
			}
	       
			
	   }
	
	 else
	    {
			$final_output['responseCode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send user id';
			
	    }
	}
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
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
	$type = $this->input->post('type');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
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
								 $images = $this->input->post('image');
								
								
								if($images!='')
									{
										//$foldername = '../../adminpanel/images/' . $images;
										$data  = trim($images);
										$data = str_replace('data:image/png;base64,', '', $data);
										$data = str_replace(' ', '+', $data);
										
										$data1 = base64_decode($data); // base64 decoded image data
										
										$imgname = uniqid().'.png';
										$file_paths = "images/profile/".$imgname;
										$file = 'adminpanel/images/profile/'.$imgname;
										$success = file_put_contents($file, $data1);	
								
								
								$check_records = $this->Common_model->updateuserimage($userid, $file_paths);
								
								$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								
								
								$uids = $check_record->id;
				
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
										   $uphoto = $basepath."assets/images/nophoto.png";
									  }
								  
								  $dataa_array  = array(
														'id'=>$check_record->id,	
														'user_name'=>$check_record->user_name,
														'user_email'=>$check_record->user_email,
														'user_mobile'=>$check_record->user_mobile,
														
														'user_photo'=>$uphoto,
														'user_position'=>$check_record->position,
														'sourcemedia'=>$device_type,
														'user_country'  => $check_record->country,
														'user_bio'      => $check_record->bio,				
														'user_skills'   => $check_record->skills,
														'token_security' =>$check_record->token_security,
														
														'user_interest'   => $check_record->interest,
														'user_language'   => $check_record->language,
														'user_desire'     => $check_record->desire,			
														'user_marital'    => $check_record->maritalstatus,

														'user_followers'  => $check_record->followers,			
														'user_following'  => $check_record->following,
														'user_news'  => $check_record->newscount,
														'user_comments'  => $check_record->comments,												
														'user_hire'       => $check_record->hire,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'user_date'       => $check_record->modified,
														'user_create_at'       => $check_record->create_at,
														'user_update_at'       => $check_record->update_at,
														
										            );
								  
								  if($check_record){
									
									  $code = '200';
									  $msg = "Your profile has been updated successfully.";
								  }else{
									  $code = '200';
									  $msg = "Your updation is not sussessfully.";
								  }
								  
								  
							   }else{
								    $code = '400';	
									$msg = "Select profile image!";
							   }
							}
							
							elseif($type=='userinfo'){
							    
								
								$oauid = $this->input->post('oauth_provider');								
								if($oauid=='facebook'){
									
									$email       = $this->input->post('email');
									$user_name   = $this->input->post('name');
									$user_mobile = $this->input->post('contact');
									$otp = sprintf("%06d", mt_rand(1, 999999));
								
									if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 
										   if(!empty($email))
											{
											  
												$check_email = $this->Common_model->common_getRow('user_register',array('user_email'=>$email));
												
												//print_r($check_email);
												
												if($check_email!="")
												{
														/*$final_output['status'] = 'Failed';
														$final_output['message'] = 'Email Already exist.';	
														$final_output['responseCode'] = '400';*/
														$code = '400';
									                    $msg = "Email already exist";
														$dataa_array =array('message' => $msg);
												}
												else
												{ 
													 $data = array(
															'user_name' => $user_name,
															'user_email' => $email,
															'user_mobile' => $user_mobile,
															'otp' => $otp
														 ); 
														 
													$check_records = $this->Common_model->updateuserotp($userid, $data);	
													if($check_records)
														{		
															$message ="
																	  <!DOCTYPE html>
																		<html>
																			<head>
																				<meta charset='utf-8' />
																				<title>Beyond Teaching</title>
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
																						<td>&nbsp;</td>
																					</tr>
																					<h4>Hi $user_name,</h4>
																					<h4>Your Login details are bellow:</h4>

																					<tr>
																							<th>Username:</th>
																							<td> $email </td>
																					</tr>
																					
																					<tr>
																							<th>OTP:</th>
																							<td> $otp </td>
																					</tr>

																					<tr>
																					   <th><h3>Thank you</h3></th>
																					</tr> 
																			</table>

																		</body>
																		</html>
																		";
															$headers = "From:no-reply@beyondteaching.com\r\n";
															$headers.= "Mime-Version: 1.0\r\n";
															$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

															$toEmail = $email;	
															
															$subject="Email Verification Alert";
															$mail_sent = mail($toEmail, $subject, $message, $headers);
															
															if($mail_sent){
																  $code = '405'; 
																  $msg = "Please check your email id Otp has been sent to your emailid.";
																  $dataa_array =array('message' => $msg);
																  
															  }else{
																  $code = '405';
																  $msg = "Sorry! mail not sent";
																 $dataa_array =array('message' => $msg);
															  }	
																				
															/*$final_output['responseCode'] = '200';		
															$final_output['status'] = 'success11';
															$final_output['message'] = 'Please check your email OTP has been sent to your emailid.';*/	
														
															
												
												}else
												{ 
											
											          $code = '400';
													  $msg = "Something went wrong! please try again.";
													  $dataa_array =array('message' => $msg);	
														
												}
													
												  //$code = '405'; 
												 // $msg = "Please check your email OTP has been sent to your emailid.";
												  //$dataa_array[] =array('message' => $msg);
																 
											
												}	
													
											}else
											{
												$code = '400';
												$msg = "Required parameter not found";
											    $dataa_array =array('message' => $msg);
												
											}
									  }	else{
										  
										        $code = '400';
												$msg = "Invalid email format please check again.";
											    $dataa_array =array('message' => $msg);
									  }
									  
								}else{
											$data = array(
													'user_name' => $this->input->post('name'),
													'user_mobile' => $this->input->post('contact'),
												 ); 
												 
											$check_records = $this->Common_model->updateuserinfo($userid, $data);
											
											$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								  
											  $uids = $check_record->id;
							
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
												   $uphoto = $basepath."assets/images/nophoto.png";
											  }
											
											$dataa_array  = array(
														'id'=>$check_record->id,	
														'user_name'=>$check_record->user_name,
														'user_email'=>$check_record->user_email,
														'user_mobile'=>$check_record->user_mobile,
														
														'user_photo'=>$uphoto,
														'user_position'=>$check_record->position,
														'sourcemedia'=>$device_type,
														'user_country'  => $check_record->country,
														'user_bio'      => $check_record->bio,				
														'user_skills'   => $check_record->skills,
														'token_security' =>$check_record->token_security,
														
														'user_interest'   => $check_record->interest,
														'user_language'   => $check_record->language,
														'user_desire'     => $check_record->desire,			
														'user_marital'    => $check_record->maritalstatus,

														'user_followers'  => $check_record->followers,			
														'user_following'  => $check_record->following,
														'user_news'  => $check_record->newscount,
														'user_comments'  => $check_record->comments,												
														'user_hire'       => $check_record->hire,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'user_date'       => $check_record->modified,
														'user_create_at'       => $check_record->create_at,
														'user_update_at'       => $check_record->update_at,
													
														
										            );
													
												  if($check_record){
												      $msg = "Your profile has been updated successfully.";
													  $code = '200';
												  }else{
													  $msg = "Your updation is not sussessfully.";
													  $code = '400';
												  }
											
									  }	  
							}
							
							
							
							
							
							elseif($type=='about'){
								
								$about = $this->input->post('about');								
								$check_records = $this->Common_model->updateuserabout($userid, $about);
								
								$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid));
								
								$uids = $check_record->id;
				
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
										   $uphoto = $basepath."assets/images/nophoto.png";
									  }
								  
								  $dataa_array  = array(
														'id'=>$check_record->id,	
														'user_name'=>$check_record->user_name,
														'user_email'=>$check_record->user_email,
														'user_mobile'=>$check_record->user_mobile,
														
														'user_photo'=>$uphoto,
														'user_position'=>$check_record->position,
														'sourcemedia'=>$device_type,
														'user_country'  => $check_record->country,
														'user_bio'      => $check_record->bio,				
														'user_skills'   => $check_record->skills,
														'token_security' =>$check_record->token_security,
														
														'user_interest'   => $check_record->interest,
														'user_language'   => $check_record->language,
														'user_desire'     => $check_record->desire,			
														'user_marital'    => $check_record->maritalstatus,

														'user_followers'  => $check_record->followers,			
														'user_following'  => $check_record->following,
														'user_news'  => $check_record->newscount,
														'user_comments'  => $check_record->comments,												
														'user_hire'       => $check_record->hire,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'user_date'       => $check_record->modified,
														'user_create_at'       => $check_record->create_at,
														'user_update_at'       => $check_record->update_at,
													
														
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
									'description' => $this->input->post('description'),
									'location'    => $this->input->post('location'),
									'fromdate'    => $this->input->post('fromyear'),
									'todate'      => $this->input->post('toyear')
									
								    );

							        $updateexp = $this->Common_model->updateuserexp($userid, $expid, $data);
									
									$getexp = $this->Common_model->common_getRow('experience', array('userid'=>$userid, 'id'=>$expid));
									
									
									$dataa_array  = array(
														'expid'         =>$getexp->id,
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
									  
									  $insert_array['userid']   =$userid;
									  $insert_array['designation']=$this->input->post('designation');
									  $insert_array['companyname']=$this->input->post('companyname');
									  $insert_array['description']=$this->input->post('description');
									  $insert_array['location']   =$this->input->post('location');
									  $insert_array['fromdate']   =$this->input->post('fromyear');
									  $insert_array['todate']     =$this->input->post('toyear');
									  $insert_array['status']     =1;
									  
						               $insertexp = $this->db->insert('experience', $insert_array);
									   
									   $insert_id = $this->db->insert_id();
									   
									   $insert_record = $this->Common_model->lastinsertexp($insert_id); 
									  
										  $dataa_array  = array(
														'expid'      =>$insert_record[0]->id,
														'userid'     =>$insert_record[0]->userid,
														'designation' =>$insert_record[0]->designation, 
														'companyname'=>$insert_record[0]->companyname, 
														'description'=>$insert_record[0]->description, 
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
										'description' => $this->input->post('description'),
										'location'    => $this->input->post('location'),
										'fromyear'    => $this->input->post('fromyear'),
										'toyear'      => $this->input->post('toyear')									
								    );

							        $updateedu = $this->Common_model->updateuseredu($userid, $eduid, $data);
									$getedu = $this->Common_model->common_getRow('education', array('userid'=>$userid, 'id'=>$eduid));
									
									
									$dataa_array  = array(
														'eduid'         =>$getedu->id,
														'userid'     =>$getedu->userid,
														'qualification' =>$getedu->qualification, 
														'collegename'=>$getedu->collegename, 
														'description'=>$getedu->description, 
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
									  $insert_array['description']  =$this->input->post('description');
									  $insert_array['location']     =$this->input->post('location');
									  $insert_array['fromyear']     =$this->input->post('fromyear');
									  $insert_array['toyear']       =$this->input->post('toyear');
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
						
						$final_output['responseCode'] = $code;	
						$final_output['status'] = 'success';
						$final_output['message'] =  $msg;
                        $final_output['data'] = $dataa_array;						
							
						
				   }
	
			 else
				{
					$final_output['responseCode'] = '404';
					$final_output['status'] = 'false';
					$final_output['message'] = 'Please send username';
					
				}
			}
	 
	 
		  else
			{
				$final_output['responseCode'] = '403';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Invalid token';
				
			} 
		
		 }
		 
		 
		  else
			{
				$final_output['responseCode'] = '502';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Unauthorised Access';
				
			}  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	




public function expedudelete()
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
				
				
			}else{
				
				$typedelete = $this->Common_model->deleteData('education', array('id' => $typeid, 'userid' => $userid));
				
			}
           
			  	
					$final_output['status'] = 'Success';
					$final_output['message'] = 'Record successfully delete.';
					$final_output['responseCode'] = '200';
				
  
	     }
		  else
			{
				$final_output['responseCode'] = '403';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Invalid token';
				
			} 
	
	 }
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}




public function userlist()
{
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id    = $this->input->post('device_id');
	$device_type   = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
	  if($check_key['status'] == 'true')
        { 

			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}


    $auth_key = $this->rand_string(40);

    $final_output = array();
	$dataa_array = array();

    if(!empty($userid))
    {  
		 
				     $create_at = $this->input->post('create_at');  
					 /*$check_canceluser = $this->Common_model->getcanceluser($userid);		 
					 if($check_canceluser!=''){*/
						
						//foreach($check_canceluser as $canceldata)
						//{
						        $userfollowcount = $this->Common_model->common_getRow('user_register',array('id'=>$userid));
								$ufollowers = $userfollowcount->followers;
								$ufollowing = $userfollowcount->following;
								$unewscount = $userfollowcount->newscount;
								
								if($create_at==0)
								{
									$create_at1= "WHERE user_register.id not in (select user_register.id from user_register, userfollow where user_register.id=userfollow.followerid AND userfollow.userid=$userid) AND  user_register.id not in (select user_register.id from user_register, userlistcancel where user_register.id=userlistcancel.otheruserid AND userlistcancel.userid=$userid) AND user_register.id!=$userid AND user_register.status='1'";
									
									
								}else
								{
									
									$create_at1= "WHERE user_register.id not in (select user_register.id from user_register, userfollow where user_register.id=userfollow.followerid AND userfollow.userid=$userid) AND  user_register.id not in (select user_register.id from user_register, userlistcancel where user_register.id=userlistcancel.otheruserid AND userlistcancel.userid=$userid) AND user_register.id!=$userid AND user_register.create_at < $create_at AND user_register.status='1'";
									
									
								}
								
						//}	
					  /*}else{
								
								if($create_at==0)
								{
									$create_at1= "WHERE id!=$userid AND status='1'";
								}else
								{
									$create_at1= "WHERE id!=$userid AND create_at < $create_at AND status='1'";
								}
								
							}*/
				
					//echo "SELECT * FROM `user_register` ".$create_at1." ORDER BY id DESC LIMIT 10";
					 $query = $this->db->query("SELECT * FROM `user_register` ".$create_at1." ORDER BY id DESC LIMIT 10");
					 
					
					$getlist = $query->result();
					$count = $query->num_rows();
					if($count>0){
						foreach($getlist as $check_record)
							{

								
							      $uids = $check_record->id;
								   
								  $followstatus=0;
								  
								 
									$querys = $this->db->query("SELECT * FROM `userfollow` where `userid`!=$userid");					
									$check_followssss = $querys->result_array();
									
									$counts = $querys->num_rows();
									foreach($check_followssss as $data)
									{
								 
										$fid = $data['followerid'];
										if($fid!=$uids)
										{ 
										   $followstatus = 0;
										}
									}
								  
								$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids, 'todate'=>'Present'));
								
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
									   $uphoto = $basepath."assets/images/nophoto.png";
								  }
								
							$dataa_array[]  = array(	
											'id'            =>$check_record->id,	
											'user_name'     =>$check_record->user_name,
											'user_email'    =>$check_record->user_email,
											'user_mobile'   =>$check_record->user_mobile,
											
											'user_photo'    =>$uphoto,
											
											'sourcemedia'   =>$device_type,
											
											'user_bio'      => $check_record->bio,				
											'user_skills'   => $check_record->skills,
											'token_security' =>$check_record->token_security,
											
											'user_interest'   => $check_record->interest,
											'user_language'   => $check_record->language,
											'user_desire'     => $check_record->desire,			
											'user_marital'    => $check_record->maritalstatus,

											'user_followers'  => $check_record->followers,			
											'user_following'  => $check_record->following,
											'user_news'       => $check_record->newscount,
											'user_comments'   => $check_record->comments,												
											'user_hire'       => $check_record->hire,
											'user_date'       => $check_record->modified,
											
											'status'          => $followstatus,
											
											'usercompany'     => $companyname,
											'userdesignation' => $designation,
											'userlocation'    => $location,
											
											'create_at'       => $check_record->create_at,
											'update_at'       => $check_record->update_at,
										);
								
											
						
							}
		        $final_output['responseCode'] = '200';				
				$final_output['status'] = 'success';
				$final_output['message'] = 'User List';
                $final_output['totalcount'] = $count;
                
                $final_output['followers'] = $ufollowers;
				$final_output['following'] = $ufollowing;
				$final_output['totalnews'] = $unewscount;
				$final_output['data'] = $dataa_array;
			} 
			 else{
				  $final_output['responseCode'] = '402';
				  $final_output['status'] = 'false';
				  $final_output['message'] = 'Not Found Records';
			    }					
			 
	   }
	
	 else
	    {
			$final_output['responseCode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send username';
			
	    }
	}
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}




public function singleuserprofile()
{
	
	$this->load->model('Common_model');
	
	$uid = $this->input->post('id');
	$userid = $this->input->post('otheruserid');
	
	$device_token = $this->input->post('device_token');
	$device_id    = $this->input->post('device_id');
	$device_type  = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$uid);
	  if($check_key['status'] == 'true')
        { 

			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}


    $auth_key = $this->rand_string(40);

    $auth_key = $this->rand_string(40);
    $final_output = array();

    if(!empty($userid))
    {  

            $check_usersave = $this->Common_model->common_getRow('userview',array('userid'=>$uid,'otheruserid'=>$userid));
			if(!empty($check_usersave))
			{	
				  $msg = "Already seen";
				  $flag = 1;
				  
			}
			else
			{
					  $insert_array['userid']    =$uid;
					  $insert_array['otheruserid']=$userid;	
					  $insert_array['status']='1';
					  $insert_array['create_at']=militime;
					  $insert_array['update_at']=militime;
					  
										 
					  $follow = $this->db->insert('userview', $insert_array);	
						
					
					  $msg = "Seen";
					  $flag = 1;
			} 
   
		 	$check_record = $this->Common_model->getuserprofile($userid);
			$check_edu = $this->Common_model->getusereducation($userid);
			$check_exp = $this->Common_model->getuserexperience($userid);
			
			if($check_edu!=0)
			{
			foreach($check_edu as $valdata)
			{
				$quali = $valdata->qualification;
				$cname = $valdata->collegename;
				$fromyear = $valdata->fromyear;
				$toyear = $valdata->toyear;
				$location  = $valdata->location;
				$description = $valdata->description;
				
				$edu[]= array('qualification'=>$quali, 'companyname'=>$cname, 'fromyear'=>$fromyear, 'toyear'=>$toyear,'location'=>$location,'description'=>$description); 
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
				$designation  = $valexp->designation;
				$companyname = $valexp->companyname;
				$description = $valexp->description;
				$address     = $valexp->location;
				$fromyear    = $valexp->fromdate;
				$toyear      = $valexp->todate;
				
				
				
				$exp[]= array('designation'=>$designation, 'companyname'=>$companyname, 'description'=>$description, 'location'=>$address, 'fromyear'=>$fromyear, 'toyear'=>$toyear); 
			}
			}
			else
			{
				$exp= array();
			}
			
			if($check_record!=''){
				
				
				 $uids = $check_record->id;
				
				
				
				//$querys = $this->db->query("SELECT * FROM `userfollow` where `userid`=$uids");					
				//$check_followssss = $querys->result_array();
				
				$check_followssss = $this->Common_model->common_getRow('userfollow',array('userid'=>$uid, 'followerid'=>$uids));
				//foreach($check_followssss as $data)
				//{
				if($check_followssss){	
					
					   $followstatus = 1;
					
				 }else{
					 $followstatus=0;
				 }
				//}

				$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids, 'todate'=>'Present'));
				
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
									   $uphoto = $basepath."assets/images/nophoto.png";
								  }
				
				 $dataa_array  = array(
														'id'=>$check_record->id,	
														'user_name'=>$check_record->user_name,
														'user_email'=>$check_record->user_email,
														'user_mobile'=>$check_record->user_mobile,
														
														'user_photo'=>$uphoto,
														'user_position'=>$check_record->position,
														'sourcemedia'=>$device_type,
														'user_country'  => $check_record->country,
														'user_bio'      => $check_record->bio,				
														'user_skills'   => $check_record->skills,
														'token_security' =>$check_record->token_security,
														
														'user_interest'   => $check_record->interest,
														'user_language'   => $check_record->language,
														'user_desire'     => $check_record->desire,			
														'user_marital'    => $check_record->maritalstatus,

														'user_followers'  => $check_record->followers,			
														'user_following'  => $check_record->following,
														'user_news'  => $check_record->newscount,
														'user_comments'  => $check_record->comments,												
														'user_hire'       => $check_record->hire,
														
														'status'       => $followstatus,
														
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'user_date'       => $check_record->modified,
														'user_create_at'       => $check_record->create_at,
														'user_update_at'       => $check_record->update_at,
														'education'  =>$edu,
														'experience' =>$exp,
														
										            );
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get user details';	
									$final_output['data'] = $dataa_array;
									
				
			  }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Invalid username';
				
			}
	       
			
	   }
	
	 else
	    {
			$final_output['responseCode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send username';
			
	    }
      }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	





public function searchuser()
{
	
	$this->load->model('Common_model');
	
	$username = $this->input->post('user_name');
	$userid = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
	if($check_key['status'] == 'true')
        { 
	
	
	
    if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }


    $auth_key = $this->rand_string(40);

    $final_output = array();

    if(!empty($username))
    {  
   
     		
		 	//$check_record1 = $this->Common_model->search_user($username);
			
		   $create_at = $this->input->post('create_at');
				
		   /*if($create_at==0)
			{
				$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND `page_title` LIKE '%$username%' AND status='1'";
			}else
			{
				$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND `page_title` LIKE '%$username%' AND create_at < $create_at AND status='1'";
			}*/
			
			
			
			if($create_at==0)
			{
				$create_at1= "WHERE `user_name` LIKE '%$username%' AND id!=$userid AND status='1'";
				
			}else
			{
				
				$create_at1= "WHERE `user_name` LIKE '%$username%' AND id!=$userid AND create_at < $create_at AND status='1'";
				
			}
			
			
			$query = $this->db->query("SELECT * FROM `user_register` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
			$check_record1 = $query->result();
			$count = $query->num_rows();
			
			
			if($count!=''){
				
			foreach($check_record1 as $check_record){	
				
				$uids = $check_record->id;
				
				
				 // $uids = $check_record->id;								   
				  $followstatus=0;
					$querys = $this->db->query("SELECT * FROM `userfollow` where `userid`=$userid");					
					$check_followssss = $querys->result_array();
					
					$counts = $querys->num_rows();
					foreach($check_followssss as $data)
					{
				 
						$fid = $data['followerid'];
						if($fid==$uids)
						{ 
						   $followstatus = 1;
						}
					}
				
				$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids, 'todate'=>'Present'));
				
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
									   $uphoto = $basepath."assets/images/nophoto.png";
								  }
				
				 $dataa_array[]  = array(
														'id'=>$check_record->id,	
														'user_name'=>$check_record->user_name,
														'user_email'=>$check_record->user_email,
														'user_mobile'=>$check_record->user_mobile,
														
														'user_photo'=>$uphoto,
														'user_position'=>$check_record->position,
														'sourcemedia'=>$device_type,
														'user_country'  => $check_record->country,
														'user_bio'      => $check_record->bio,				
														'user_skills'   => $check_record->skills,
														'token_security' =>$check_record->token_security,
														
														'user_interest'   => $check_record->interest,
														'user_language'   => $check_record->language,
														'user_desire'     => $check_record->desire,			
														'user_marital'    => $check_record->maritalstatus,

														'user_followers'  => $check_record->followers,			
														'user_following'  => $check_record->following,
														'user_news'  => $check_record->newscount,
														'user_comments'  => $check_record->comments,												
														'user_hire'       => $check_record->hire,
														'status'          => $followstatus,
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'user_date'       => $check_record->modified,
														'create_at'       => $check_record->create_at,
														'update_at'       => $check_record->update_at,
														
														
										            );
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get user details';	
									$final_output['data'] = $dataa_array;
									
				
			  }
		}
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Record not found';
				
			}
	       
			
	   }
	
	 else
	    {
			$final_output['responseCode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send user name';
			
	    }
	}
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	



public function followinglist()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
	if($check_key['status'] == 'true')
        { 
	
	
	
    if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }


    $auth_key = $this->rand_string(40);

    $final_output = array();
	$dataa_array = array();

    if(!empty($userid))
    {  
		 $check_records = $this->Common_model->getfollowers($userid);
		 
		 if($check_records!=''){
			
			foreach($check_records as $valdata)
			{
				$uid = $valdata->userid;
				$fid = $valdata->followerid;
				
				//$check_followerslist = $this->Common_model->getfollowerslist($fid);
				    $create_at = $this->input->post('create_at');

					if($create_at==0)
					{
						$create_at1= "WHERE id=$fid AND status='1'";
					}else
					{
						$create_at1= "WHERE id=$fid AND create_at > $create_at AND status='1'";
					}

					//echo "SELECT * FROM `user_register` ".$create_at1." ORDER BY `id` DESC LIMIT 10";
					
					$query = $this->db->query("SELECT * FROM `user_register` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
					//$query = $this->db->get();
					$check_followerslist = $query->result();
					
					 //$count = $this->Common_model->sqlcount('user_register',array('id'=>$fid, 'create_at >'=> $create_at));
					  $count = $query->num_rows();
				
		             if($count>0){			
					//print_r($check_followerslist);
				
						foreach($check_followerslist as $check_record)
							{
								
								$uids = $check_record->id;
								$check_follow = $this->Common_model->common_getRow('userfollow',array('userid'=>$uids));
								
								$followstatus = 1;
								
								$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids, 'todate'=>'Present'));
								
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
									   $uphoto = $basepath."assets/images/nophoto.png";
								  }
								
							$dataa_array[]  = array(	
								'id'            =>$check_record->id,	
								'user_name'     =>$check_record->user_name,
								'user_email'    =>$check_record->user_email,
								'user_mobile'   =>$check_record->user_mobile,
								
								'user_photo'    =>$uphoto,
								//'user_position' =>$check_record->position,
								'sourcemedia'   =>$device_type,
								//'user_country'  => $check_record->country,
								'user_bio'      => $check_record->bio,				
								'user_skills'   => $check_record->skills,
								'token_security' =>$check_record->token_security,
								
								'user_interest'   => $check_record->interest,
								'user_language'   => $check_record->language,
								'user_desire'     => $check_record->desire,			
								'user_marital'    => $check_record->maritalstatus,

								'user_followers'  => $check_record->followers,			
								'user_following'  => $check_record->following,
								'user_news'       => $check_record->newscount,
								'user_comments'   => $check_record->comments,												
								'user_hire'       => $check_record->hire,
								'user_date'       => $check_record->modified,
								
								'status'       => $followstatus,
								
								'usercompany'     => $companyname,
								'userdesignation' => $designation,
								'userlocation'    => $location,
								
								'create_at'       => $valdata->create_at,
								'update_at'       => $valdata->update_at,
							);
								
											
						}
				
		        $final_output['responseCode'] = '200';				
				$final_output['status'] = 'success';
				$final_output['message'] = 'Following List';
                $final_output['totalcount'] = $count;							
				$final_output['data'] = $dataa_array;
				
			  } 
			 else{
				  $final_output['responseCode'] = '402';
				  $final_output['status'] = 'false';
				  $final_output['message'] = 'user not found';
			    }	
				
		   }
		 
		  } 
		 else
			{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Not Found Records';
				
			}
			
	   }
	
	 else
	    {
			$final_output['responseCode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send username';
			
	    }
	}
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}



public function followerslist()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
	//$check_key = $this->checktoken($headers['Secret-Key']);
	$check_key = $this->checktoken($headers['Secret-Key'],$userid);	
	if($check_key['status'] == 'true')
        { 
	
	
	
    if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }

   

    $auth_key = $this->rand_string(40);

    $final_output = array();
    $dataa_array = array();
    if(!empty($userid))
    {  
   
     		
		$check_records = $this->Common_model->getfollowing($userid);
			
		if($check_records!=''){
			
			foreach($check_records as $valdata)
			{
				 $uid = $valdata->userid;
				
				//$check_followinglist = $this->Common_model->getfollowinglist($uid);
				    $create_at = $this->input->post('create_at');
				
				    if($create_at==0)
					{
						$create_at1= "WHERE id=$uid AND status='1'";
					}else
					{
						$create_at1= "WHERE id=$uid AND create_at > $create_at AND status='1'";
					}

					//echo "SELECT * FROM `user_register` ".$create_at1." ORDER BY `id` DESC LIMIT 10";
					
					$query = $this->db->query("SELECT * FROM `user_register` ".$create_at1." LIMIT 10");
					//$query = $this->db->get();
					$check_followinglist = $query->result();
					$count = $query->num_rows();
					
					if($count>0){
				
						  foreach($check_followinglist as $check_record)
							{
								/* $followstatus = 0;
								 
								 $check_follow = $this->Common_model->common_getRow('userfollow',array('userid'=>$uids));
								
								 if($check_follow){ 
									 $followstatus = 1;
								 }*/
								 
								   $followstatus=0;
								  
								    $uids = $check_record->id;
									$querys = $this->db->query("SELECT * FROM `userfollow` where `userid`=$userid");					
									$check_followssss = $querys->result_array();
									
									$count = $querys->num_rows();
									foreach($check_followssss as $data)
									{
								 
										$fid = $data['followerid'];
										if($fid==$uids)
										{ 
										   $followstatus = 1;
										}
									} 
								 
								$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$uids, 'todate'=>'Present'));
								
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
									   $uphoto = $basepath."assets/images/nophoto.png";
								  }
								
							$dataa_array[]  = array(	
								'id'             =>$check_record->id,	
								'user_name'      =>$check_record->user_name,
								'user_email'     =>$check_record->user_email,
								'user_mobile'    =>$check_record->user_mobile,
								
								'user_photo'     =>$uphoto,
								//'user_position'  =>$check_record->position,
								'sourcemedia'    =>$device_type,
								//'user_country'   => $check_record->country,
								'user_bio'       => $check_record->bio,				
								'user_skills'    => $check_record->skills,
								'token_security' =>$check_record->token_security,
								
								'user_interest'   => $check_record->interest,
								'user_language'   => $check_record->language,
								'user_desire'     => $check_record->desire,			
								'user_marital'    => $check_record->maritalstatus,

								'user_followers'  => $check_record->followers,			
								'user_following'  => $check_record->following,
								'user_news'       => $check_record->newscount,
								'user_comments'   => $check_record->comments,												
								'user_hire'       => $check_record->hire,
								'user_date'       => $check_record->modified,
								
								'status'       =>  $followstatus,
								
								'usercompany'     => $companyname,
								'userdesignation' => $designation,
								'userlocation'    => $location,
								
								'create_at'       => $check_record->create_at,
								'update_at'       => $check_record->update_at,
							);
								
											
						}
						$final_output['responseCode'] = '200';				
						$final_output['status'] = 'success';
						$final_output['message'] = 'Following List';
						$final_output['totalcount'] = $count;				
						$final_output['data'] = $dataa_array;
				
			         }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Not Found Records';
				
			}
		  }
		
         }
		 else
			{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Not Found Records';
				
			}
		
			
	   }
	
	 else
	    {
			$final_output['responseCode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send user id';
			
	    }
	}
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}


public function usernews()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		
	if($check_key['status'] == 'true')
        { 
	
	
	
    if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }

    $version_code = $this->input->post('version_code');

    $auth_key = $this->rand_string(40);

    $final_output = array();

    if(!empty($userid))
    {  
   
     		
		 	//$check_records = $this->Common_model->user_news($userid);
			
			$create_at = $this->input->post('create_at');
			
			if($create_at==0)
				{
					$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid) AND btnews.userid='$userid' AND status='active'";
				}else
				{
					$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid) AND btnews.userid='$userid' AND create_at < $create_at AND status='active'";
				}
				
				$query = $this->db->query("SELECT * FROM btnews ".$create_at1." ORDER BY id DESC LIMIT 10 ");				
				$check_records = $query->result();
			
			/*if($create_at==0)
			{
				$create_at1= "WHERE userid='$userid' AND status='active'";
			}else
			{
				$create_at1= "WHERE userid='$userid' AND create_at < $create_at AND status='active'";
			}

			$query = $this->db->query("SELECT * FROM `btnews` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
			$check_records = $query->result();*/
			$count = $query->num_rows();
			
			
			
			if($count>0){
				
			 foreach($check_records as $check_record)
			 {
				
				$basepath=base_url();
				
				$photo = $check_record->image;
                
				if($photo=='')  {
				     $uphoto = '';
				}else{
				     $uphoto    = $basepath."adminpanel/".$photo;
				}
				
				
				$check_like_status = $this->Common_model->common_getRow('likes',array('newsid'=>$check_record->id,'userid'=>$userid));

					if(!empty($check_like_status))
					{
						$read_status_like = 1;
					}
					else
					{
						$read_status_like = 0;
					}
					
					
					$check_bookmark_status = $this->Common_model->common_getRow('newsbookmark',array('newsid'=>$check_record->id,'userid'=>$userid));

					if(!empty($check_bookmark_status))
					{
						$bookmark_status = 1;
					}
					else
					{
						$bookmark_status = 0;
					}
						
					$nuserid = $check_record->userid;
						
					$check_follows = $this->Common_model->common_getRow('userfollow',array('userid'=>$userid, 'followerid'=>$nuserid));
					if($check_follows){	
						
						   $followstatus = 1;
						
					 }else{
						 $followstatus = 0;
					 }
						
						
                        $newsuser = $this->Common_model->common_getRow('user_register',array('id'=>$nuserid, 'status'=>1));
						if(!empty($newsuser))
						{
							$author = $newsuser->user_name;
							if(!empty($author)){
								  $authorname = $author;
							}else{
								 $authorname = $check_record->author;
							}
							
							$photo      = $newsuser->photo;
								
							$data=parse_url($photo, PHP_URL_SCHEME);
							if($data=='http' || $data=='https')
								  {
									  $uimage = $photo;
								  }
								  else if($data!='http' || $data!='https'){
									   $uimage = $basepath.'adminpanel/'.$photo;
								  }
								  else
								  {
								   
								  }
								  if($photo=='')
								  {
									   $uimage = $basepath."assets/images/nophoto.png";
								  }
						}
						else
						{
							$authorname = $check_record->author;
							$uimage = $basepath."assets/images/nophoto.png";		
						}
							
							
						$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$nuserid, 'todate'=>'Present'));
						
						if($check_exp){
							$designation = $check_exp->designation;
							$companyname = $check_exp->companyname;
							$location = $check_exp->location;
						}else{
							$designation = '';
							$companyname = '';
							$location = '';
						}
						
				
						$photo = $check_record->image;
						if($photo=='')  {
							 $image = '';
						}else{
							 $image    = $basepath."adminpanel/".$photo;
						}
						
						     $priority=$check_record->priority;
							 $uid=$check_record->userid;
							 
							if($priority==1)
							 {
							  $newsname='schooling';
							 }
							 if($priority==2)
							 {
							  $newsname='highereducation';
							 }
							 if($priority==3)
							 {
							  $newsname='research-others';
							 }
							 if($priority==4)
							 {
							  $newsname='general-news';
							 }
							 if($priority==8)
							 {
							  $newsname='inspiring-stories';
							 }
							 if($priority==7)
							 {
							  $newsname='quotes';
							 }
							 if($uid==41  || $uid=='admin' || $priority==5)
							 {
							  $newsname='blog';
							 }
						
				             $slug = $check_record->slug;
							 $newsids = $check_record->id;
							 
							 $newsid = base64_encode($newsids);
						
				             $shareurl = $basepath.$newsname."/".$slug."/".$newsid;
				             
				             
				               $shortdes = $check_record->description;
							    $str = trim($shortdes);
                                $str = utf8_decode($str);
                                $str = str_replace("&nbsp;", " ", $str);
                                $str = htmlspecialchars_decode($str, ENT_QUOTES);
                                $str = html_entity_decode($str, ENT_QUOTES);
                                
                                $str = $this->Common_model->decodeEmoticons($str);
                                $fulldesc = $str;
                                $str = strip_tags($str);
				
				 $dataa_array[]  = array(
														'id'=>$check_record->id,	
														'url'=>$check_record->slug,
														'title'=>$check_record->page_title,
														'description'=>$fulldesc,
														'shortdescription'=>$str,
														'images'=>$image,
														'authorname'=>$authorname,
														'date'  => $check_record->date,
														'totalclick'      => $check_record->click_count,				
														'readtime'   => $check_record->readtime,
														'totalcomments' =>$check_record->comments,
														
														'likestatus'   => $read_status_like,
														'totallikes'   => $check_record->likes,
														
														'bookmarkstatus'   => $bookmark_status,
														'followstatus'   => $followstatus,
														
														'userimage'   => $uimage,
														
														'userid' => $nuserid,
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'shareurl'    => $shareurl, 
														
														'create_at'=>$check_record->create_at,
														'type'   => 'blog'
														
														
										            );
													
			    }								
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get news details';	
									$final_output['totalcount'] = $count;
									$final_output['data'] = $dataa_array;
									
				
			  }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Record not found.';
				
			}
	       
			
	   }
	
	 else
	    {
			$final_output['responseCode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send user id';
			
	    }
	}
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);
}	


public function userprofilescroller()
{
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	
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
			
			
			$check_img = $this->Common_model->existuserimg($userid);			
		    $check_userimg = $check_img[0]['photo'];
			
			if($check_userimg){
				
				$status['image'] =1;
			}else{
				$status['image'] =0;
			}
			
			$check_about = $this->Common_model->existuserabout($userid);	
            $check_userbio = $check_img[0]['bio']; 
			
			if($check_userbio){
				
				$status['about'] =1;
			}else{
				$status['about'] =0;
			}
			
			
			$check_exp = $this->Common_model->existuserexp($userid);
			$check_userexp = $check_exp[0]['userid'];	
			
			if($check_userexp){
				
				$status['experience'] =1;
			}else{
				$status['experience'] =0;
			}
			
			
			$check_edu = $this->Common_model->existuseredu($userid);			
			$check_useredu = $check_edu[0]['userid'];	
			
			if($check_useredu){
				
				$status['education'] =1;
			}else{
				$status['education'] =0;
			}
								
		
				$final_output['status'] = 'Success';
				$final_output['message'] = 'Successfully.';
				$final_output['responseCode'] = '200';
				$final_output['data'] = $status;			
						

  
	     }
		  else
			{
				$final_output['responseCode'] = '403';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Invalid token';
				
			} 
	
	 }
	  else
	    {
			$final_output['responseCode'] = '502';
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
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	$basepath=base_url();
	
	
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
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
		 $create_at = $this->input->post('create_at');  
		 $check_reports = $this->Common_model->getreports($userid);		 
		 if($check_reports!=''){
			
			foreach($check_reports as $reportdata)
			{
				//$userids = $reportdata->userid;
				//if($userids==$userid){
					
					if($create_at==0)
					{
						$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND btnews.status='active'";
					}else
					{
						$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND btnews.create_at < $create_at AND btnews.status='active'";
					}
					
				//}
				
			}	
		  }else{
					
					if($create_at==0)
					{
						$create_at1= "WHERE status='active'";
					}else
					{
						$create_at1= "WHERE create_at < $create_at AND status='active'";
					}
					
				}
   
			    
			//	echo "SELECT * FROM btnews ".$create_at1." ORDER BY btnews.id DESC LIMIT 10";
				
				$query = $this->db->query("SELECT * FROM btnews ".$create_at1." ORDER BY btnews.id DESC LIMIT 10 ");				
				$check_records = $query->result();
				
				$count = $query->num_rows();
			//}
			if($count>0){
			 $j=1;	
			 foreach($check_records as $check_record)
			 {
				 
			  if(($j==3) && ($create_at==0)){
		                
			   if($userid!="")
		       {
				   //$uquery = $this->db->query('SELECT * FROM `user_register` WHERE id!="'.$userid.'" AND status="1" ORDER BY `id` DESC limit 10');
				   
				   //SELECT * FROM `user_register` WHERE user_register.id not in (select userfollow.followerid from userfollow, user_register where user_register.id!=userfollow.followerid AND userfollow.userid!=$userid AND user_register.status='1') ORDER BY user_register.id DESC LIMIT 10
				   
				   //SELECT * FROM `user_register` WHERE user_register.id not in (select userfollow.followerid from userfollow, user_register where user_register.id!=userfollow.followerid AND userfollow.userid=$userid) AND user_register.id!=$userid AND user_register.status='1' ORDER BY user_register.id DESC LIMIT 10

				   
					$uquery = $this->db->query("SELECT * FROM `user_register` WHERE user_register.id not in (select userfollow.followerid from userfollow, user_register where user_register.id!=userfollow.followerid AND userfollow.userid=$userid) AND user_register.id!=$userid AND user_register.status='1' ORDER BY user_register.id DESC LIMIT 10");
					$userrecords = $uquery->result();
					$totaluser = $uquery->num_rows();	
					
					//print_r($userrecords);
					
					if($totaluser>0)
					 {
						foreach($userrecords as $userdetails){
						
						$uid = $userdetails->id;
						$uname = $userdetails->user_name;
						$uemail = $userdetails->user_email;
						$photo = $userdetails->photo;
						
						$data=parse_url($photo, PHP_URL_SCHEME);
						if($data=='http' || $data=='https')
								  {
									  $uphotos = $photo;
								  }
								  else if($data!='http' || $data!='https'){
									   $uphotos = $basepath.'adminpanel/'.$photo;
								  }
								  else
								  {
								   
								  }
								  if($photo=='')
								  {
									   $uphotos = $basepath."assets/images/nophoto.png";
								  }
			
						
						$check_exps = $this->Common_model->common_getRow('experience',array('userid'=>$uid, 'todate'=>'Present'));
						
						if($check_exps){
							$designations = $check_exps->designation;
							$companynames = $check_exps->companyname;
							$locations = $check_exps->location;
						}else{
							$designations = '';
							$companynames = '';
							$locations = '';
						}
						
						$userlist[]= array('id'=>$uid, 'user_name'=>$uname, 'user_photo'=>$uphotos, 'user_email'=>$uemail, 'userdesignation'=>$designations, 'usercompany'=>$companynames, 'userlocation'=>$locations); 
					}
					$dataa_array[]=array('type'=>'user', 'user'=>$userlist);
				  //}
					 
				 }else{
					$uquery = $this->db->query('SELECT * FROM `user_register` WHERE status="1" ORDER BY id DESC limit 10');
					$userrecords = $uquery->result();
					foreach($userrecords as $userdetails){
						
						
						$uid = $userdetails->id;
						$uname = $userdetails->user_name;
						$uemail = $userdetails->user_email;
						$photo = $userdetails->photo;
						
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
			
						
						
						$check_exps = $this->Common_model->common_getRow('experience',array('userid'=>$uid, 'todate'=>'Present'));
						
						if($check_exps){
							$designations = $check_exps->designation;
							$companynames = $check_exps->companyname;
							$locations = $check_exps->location;
						}else{
							$designations = '';
							$companynames = '';
							$locations = '';
						}
						
						$userlist[]= array('id'=>$uid, 'user_name'=>$uname, 'user_photo'=>$uphoto, 'user_email'=>$uemail, 'designation'=>$designations, 'companyname'=>$companynames, 'location'=>$locations); 
					}
					
					 $dataa_array[]=array('type'=>'user', 'user'=>$userlist);
				 }
				}	
			 }	
				
				
		   if(($j==6) && ($create_at==0)){
		              
					$jobquery = $this->db->query('SELECT * FROM `job` WHERE status="1" ORDER BY `id` DESC limit 2');
					$jobrecords = $jobquery->result();
					
					foreach($jobrecords as $jobdetails){
						
						$jobphoto = $jobdetails->image;
						if($jobphoto=='')  {
						   $jobphoto = '';
						}else{
						   $jobphoto    = $basepath."adminpanel/images/job/".$jobphoto;
						}
						
						$jid = $jobdetails->id;
						$jcname = $jobdetails->companyname;
						$jtitle = $jobdetails->jobtitle;
						$jemail = $jobdetails->email;
						$jaddress = $jobdetails->address;
						$jdate = $jobdetails->datetime;
						$dbDate = strtotime($jdate);
						
						$companyprofile = $jobdetails->companyprofile;
					   $shortdes = $jobdetails->jobdescription;							
					   $jstr = utf8_decode($shortdes);
        				$jstr = str_replace("&nbsp;", "", $jstr);
        				$jstr = preg_replace("/\s+/", " ", $jstr);
        				$jstr = strip_tags($jstr);
        				$jstr = htmlspecialchars_decode($jstr, ENT_QUOTES); 
					   
					    $jobtype = $jobdetails->jobtype;
					    $keyskill = $jobdetails->keyskill;
						$jobview = $jobdetails->jobview;
						$juserid = $jobdetails->userid;
						
					    $check_jobapply = $this->Common_model->common_getRow('savejob',array('userid'=>$userid, 'applyjobid'=>$jid));
						if($check_jobapply){
							   $jobapplied = 1;
							
						}else{
							   $jobapplied=0;
						}		

						$check_jobsave = $this->Common_model->common_getRow('savejob',array('userid'=>$userid, 'savejobid'=>$jid));
						if($check_jobsave){
							$savejob = 1;
							
						}else{
							$savejob=0;
						}			
						
						
						$joblist[]= array('jobid'=>$jid, 'image'=>$jobphoto, 'companyname'=>$jcname, 'companyprofile'=>$companyprofile, 'jobaddress'=>$jaddress, 'jobtitle'=>$jtitle, 'email'=>$jemail, 'description'=>$shortdes, 'shortdescription'=>$jstr, 'jobtype'=>$jobtype, 'keyskill'=>$keyskill, 'jobview'=>$jobview, 'userid'=>$juserid, 'isJobApplied'=>$jobapplied, 'isBookmarked'=>$savejob, 'timestamp'=>$dbDate, 'type'=>'job'); 
					
						
					//	$joblist[]= array('jobid'=>$jid, 'companyname'=>$jcname, 'image'=>$jobphoto, 'jobtitle'=>$jtitle, 'jobaddress'=>$jaddress, 'timestamp'=>$dbDate); 
					
				  }
				  
				  $dataa_array[]=array('type'=>'job', 'job'=>$joblist);
				}
				
				
				//$newsids = $check_record->id;
				
				    $check_like_status = $this->Common_model->common_getRow('likes',array('newsid'=>$check_record->id,'userid'=>$userid));

					if(!empty($check_like_status))
					{
						$read_status_like = 1;
					}
					else
					{
						$read_status_like = 0;
					}
					
					
					$check_bookmark_status = $this->Common_model->common_getRow('newsbookmark',array('newsid'=>$check_record->id,'userid'=>$userid));

					if(!empty($check_bookmark_status))
					{
						$bookmark_status = 1;
					}
					else
					{
						$bookmark_status = 0;
					}
					
					$nuserid = $check_record->userid;
					$check_follows = $this->Common_model->common_getRow('userfollow',array('userid'=>$userid, 'followerid'=>$nuserid));
					if($check_follows){	
						
						   $followstatus = 1;
						
					 }else{
						 $followstatus = 0;
					 }
						
						
                        $newsuser = $this->Common_model->common_getRow('user_register',array('id'=>$nuserid, 'status'=>1));
						if(!empty($newsuser))
						{
							$author = $newsuser->user_name;
							if(!empty($author)){
								  $authorname = $author;
							}else{
								 $authorname = $check_record->author;
							}
							
							$photo      = $newsuser->photo;
								
							$data=parse_url($photo, PHP_URL_SCHEME);
							if($data=='http' || $data=='https')
								  {
									  $uimage = $photo;
								  }
								  else if($data!='http' || $data!='https'){
									   $uimage = $basepath.'adminpanel/'.$photo;
								  }
								  else
								  {
								   
								  }
								  if($photo=='')
								  {
									   $uimage = $basepath."assets/images/nophoto.png";
								  }
			
						}
						else
						{
							$authorname = $check_record->author;
							$uimage = $basepath."assets/images/nophoto.png";
							//$uimage = '';	
						}
									
						$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$nuserid, 'todate'=>'Present'));
						
						if($check_exp){
							$designation = $check_exp->designation;
							$companyname = $check_exp->companyname;
							$location = $check_exp->location;
						}else{
							$designation = '';
							$companyname = '';
							$location = '';
						}
						
					
				
						$photo = $check_record->image;
						if($photo=='')  {
							 //$image = $basepath."assets/images/nophoto.png";
							 $image = '';
						}else{
							 $image    = $basepath."adminpanel/".$photo;
						}
						
						     $priority=$check_record->priority;
							 $uid=$check_record->userid;
							 
							if($priority==1)
							 {
							  $newsname='schooling';
							  $type='news';
							 }
							 if($priority==2)
							 {
							  $newsname='highereducation';
							  $type='news';
							 }
							 if($priority==3)
							 {
							  $newsname='research-others';
							  $type='news';
							 }
							 if($priority==4)
							 {
							  $newsname='general-news';
							  $type='news';
							 }
							 if($priority==8)
							 {
							  $newsname='inspiring-stories';
							  $type='news';
							 }
							 if($priority==7)
							 {
							  $newsname='quotes';
							  $type='news';
							 }
							 if($uid==41  || $uid=='admin' || $priority==5)
							 {
							  $newsname='blog';
							  $type='blog';
							 }
						
				             $slug = $check_record->slug;
							 $newsids = $check_record->id;
							 
							 $newsid = base64_encode($newsids);
						
				             $shareurl = $basepath.$newsname."/".$slug."/".$newsid;
					    //}
				        		$shortdes = $check_record->description;
							    /*$short = strip_tags($shortdes);
                                $descr = substr($short,0,200);
                                
                                $shortdescription = html_entity_decode($descr);*/
                                
                                $str = trim($shortdes);
                                $str = utf8_decode($str);
                                $str = str_replace("&nbsp;", " ", $str);
                                //$str = preg_replace("/\s+/", " ", $str);
                                
                                //$str = substr($str,0,400);
                                
                                $str = htmlspecialchars_decode($str, ENT_QUOTES);
                                $str = html_entity_decode($str, ENT_QUOTES);
                                
                                $str = $this->Common_model->decodeEmoticons($str);
                                //$str = $this->decodeEmoticons($str);
                                $fulldesc = $str;
                                $str = strip_tags($str);
                                
                             $text = $check_record->page_title;    
                             $title = htmlspecialchars($text, ENT_NOQUOTES, "UTF-8");
				
				        $dataa_array[]  = array(
														'id'=>$check_record->id,	
														'url'=>$check_record->slug,
														'title'=>$title,
														'description'=>$fulldesc,
														'shortdescription'=>$str,
														'images'=>$image,
														'authorname'=>$authorname,
														'date'  => $check_record->date,
														'totalclick'      => $check_record->click_count,				
														'readtime'   => $check_record->readtime,
														'totalcomments' =>$check_record->comments,
														
														'likestatus'   => $read_status_like,
														'totallikes'   => $check_record->likes,
														
														'bookmarkstatus'   => $bookmark_status,
														'followstatus' => $followstatus,
														
														'userimage'   => $uimage,
														
														'userid' => $nuserid,
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'shareurl'    => $shareurl,
														
														'create_at'=>$check_record->create_at,
														'type'=>$type
														
														
										            );
			 
						 $j++;	
						 }
			          }
		        

                                    $final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get news details';	
									$final_output['totalcount'] = $count;
									$final_output['data'] = $dataa_array;				
			    		
				
			 // }
	    }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Invalid user id please check again.';
				
			}
	       
			
	   
	     
    }
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}



public function relatednews()
{
	$this->load->model('Common_model');
	
	$newsid = $this->input->post('newsid');
	$userid = $this->input->post('id');	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		
	if($check_key['status'] == 'true')
        { 
	
	
	
    if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }

   
    $auth_key = $this->rand_string(40);

    $final_output = array();

    if(!empty($newsid))
    {  
   
     		
		 	/////$check_records = $this->Common_model->news_related($newsid);
			//$check_records = $query->result();
			//$count = $query->num_rows();
			
			// "SELECT * FROM btnews WHERE id!=$newsid AND status='active' ORDER BY id DESC LIMIT 10"
			 
			 $check_reports = $this->Common_model->getreports($userid);		 
			 if($check_reports!=''){
				
				foreach($check_reports as $reportdata)
				{
					
					$query = $this->db->query("SELECT * FROM btnews WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND id!=$newsid AND status='active' ORDER BY id DESC LIMIT 10 ");
						
				}	
			  }else{
					
					$query = $this->db->query("SELECT * FROM btnews WHERE id!=$newsid AND status='active' ORDER BY id DESC LIMIT 10");
					
				}
			
			$check_records = $query->result();
			if($check_records!=''){	
			 foreach($check_records as $check_record)
			 {
				
				$basepath=base_url();
				
				$photo = $check_record->image;
                
				if($photo=='')  {
				     //$uphoto = $basepath."assets/images/photo.jpg";
					 $uphoto = '';
				}else{
				     $uphoto    = $basepath."adminpanel/".$photo;
				}
				
				
				$check_like_status = $this->Common_model->common_getRow('likes',array('newsid'=>$check_record->id,'userid'=>$userid));

					if(!empty($check_like_status))
					{
						$read_status_like = 1;
					}
					else
					{
						$read_status_like = 0;
					}
					
					
					$check_bookmark_status = $this->Common_model->common_getRow('newsbookmark',array('newsid'=>$check_record->id,'userid'=>$userid));

					if(!empty($check_bookmark_status))
					{
						$bookmark_status = 1;
					}
					else
					{
						$bookmark_status = 0;
					}
						
					$nuserid = $check_record->userid;
						
					$check_follows = $this->Common_model->common_getRow('userfollow',array('userid'=>$userid, 'followerid'=>$nuserid));
					if($check_follows){	
						
						   $followstatus = 1;
						
					 }else{
						 $followstatus = 0;
					 }
						
						
                        $newsuser = $this->Common_model->common_getRow('user_register',array('id'=>$nuserid, 'status'=>1));
						if(!empty($newsuser))
						{
							$author = $newsuser->user_name;
							if(!empty($author)){
								  $authorname = $author;
							}else{
								 $authorname = $check_record->author;
							}
							
							$photo      = $newsuser->photo;
								
							$data=parse_url($photo, PHP_URL_SCHEME);
							if($data=='http' || $data=='https')
								  {
									  $uimage = $photo;
								  }
								  else if($data!='http' || $data!='https'){
									   $uimage = $basepath.'adminpanel/'.$photo;
								  }
								  else
								  {
								   
								  }
								  if($photo=='')
								  {
									   $uimage = $basepath."assets/images/nophoto.png";
								  }
						}
						else
						{
							$authorname = $check_record->author;
							$uimage = $basepath."assets/images/nophoto.png";		
						}
									
						$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$nuserid, 'todate'=>'Present'));
						
						if($check_exp){
							$designation = $check_exp->designation;
							$companyname = $check_exp->companyname;
							$location = $check_exp->location;
						}else{
							$designation = '';
							$companyname = '';
							$location = '';
						}
						
				
						$photo = $check_record->image;
						if($photo=='')  {
							 $image = $basepath."assets/images/nophoto.png";
						}else{
							 $image    = $basepath."adminpanel/".$photo;
						}
						
						 $priority=$check_record->priority;
							 $uid=$check_record->userid;
							 
							if($priority==1)
							 {
							  $newsname='schooling';
							  $type='news';
							 }
							 if($priority==2)
							 {
							  $newsname='highereducation';
							  $type='news';
							 }
							 if($priority==3)
							 {
							  $newsname='research-others';
							  $type='news';
							 }
							 if($priority==4)
							 {
							  $newsname='general-news';
							  $type='news';
							 }
							 if($priority==8)
							 {
							  $newsname='inspiring-stories';
							  $type='news';
							 }
							 if($priority==7)
							 {
							  $newsname='quotes';
							  $type='news';
							 }
							 if($uid==41  || $uid=='admin' || $priority==5)
							 {
							  $newsname='blog';
							  $type='blog';
							 }
						
				             $slug = $check_record->slug;
							 $newsids = $check_record->id;
						
						     $newsid = base64_encode($newsids);
				             $shareurl = $basepath.$newsname."/".$slug."/".$newsid;
				
				             $shortdes = $check_record->description;
				             
							    $str = trim($shortdes);
                                $str = utf8_decode($str);
                                $str = str_replace("&nbsp;", " ", $str);
                                $str = htmlspecialchars_decode($str, ENT_QUOTES);
                                $str = html_entity_decode($str, ENT_QUOTES);
                                
                                $str = $this->Common_model->decodeEmoticons($str);
                                $fulldesc = $str;
                                $str = strip_tags($str);
				
				 $dataa_array[]  = array(
														'id'=>$check_record->id,	
														'url'=>$check_record->slug,
														'title'=>$check_record->page_title,
														'description'=>$fulldesc,
														'shortdescription'=>$str,
														'images'=>$image,
														'authorname'=>$authorname,
														'date'  => $check_record->date,
														'totalclick'      => $check_record->click_count,				
														'readtime'   => $check_record->readtime,
														'totalcomments' =>$check_record->comments,
														
														'likestatus'   => $read_status_like,
														'totallikes'   => $check_record->likes,
														
														'bookmarkstatus'   => $bookmark_status,
														'followstatus'   => $followstatus,
														
														'userimage'   => $uimage,
														
														'userid' => $nuserid,
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'shareurl'    => $shareurl,
														
														'create_at'=>$check_record->create_at,
														'type'=>$type
														
														
										            );
													
			    }								
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get related news';	
									$final_output['data'] = $dataa_array;
				 }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Invalid news id please check again.';
				
			}		
			
	   }
	
	 else
	    {
			$final_output['responseCode'] = '404';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Please send news id';
			
	    }
	}
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}


public function newssearch()
{
	
	$this->load->model('Common_model');
	
	$searchnews = $this->input->post('searchnews');	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	$userid = $this->input->post('id');	
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		
	if($check_key['status'] == 'true')
        { 
	
			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}

   
    $auth_key = $this->rand_string(40);

    $final_output = array();
				
				$final_output = array();
				if(!empty($searchnews))
				{  
   
     		    $create_at = $this->input->post('create_at');
				//$check_record1 = $this->Common_model->search_news($searchnews);
				
				   if($create_at==0)
					{
						$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND `page_title` LIKE '%$searchnews%' AND status='active'";
					}else
					{
						$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND `page_title` LIKE '%$searchnews%' AND create_at < $create_at AND status='active'";
					}
				
				//echo "SELECT * FROM `btnews` ".$create_at1." ORDER BY `id` DESC LIMIT 10";
				$query = $this->db->query("SELECT * FROM `btnews` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
				$check_record1 = $query->result();
				$count = $query->num_rows();
				
				if($count!=''){
					
					foreach($check_record1 as $check_record){	
						$basepath=base_url();
							
						$nuserid = $check_record->userid;
						
                        $newsuser = $this->Common_model->common_getRow('user_register',array('id'=>$nuserid, 'status'=>1));
						if(!empty($newsuser))
						{
							$author = $newsuser->user_name;
							if(!empty($author)){
								  $authorname = $author;
							}else{
								 $authorname = $check_record->author;
							}
							
							$photo      = $newsuser->photo;
								
							$data=parse_url($photo, PHP_URL_SCHEME);
							if($data=='http' || $data=='https')
								  {
									  $uimage = $photo;
								  }
								  else if($data!='http' || $data!='https'){
									   $uimage = $basepath.'adminpanel/'.$photo;
								  }
								  else
								  {
								   
								  }
								  if($photo=='')
								  {
									   $uimage = $basepath."assets/images/nophoto.png";
								  }
						}
						else
						{
							$authorname = $check_record->author;
							$uimage = $basepath."assets/images/nophoto.png";		
						}
						
						
						//$nuserid = $check_record->userid;
						
						$check_follows = $this->Common_model->common_getRow('userfollow',array('userid'=>$userid, 'followerid'=>$nuserid));
						if($check_follows){	
							
							   $followstatus = 1;
							
						 }else{
							 $followstatus = 0;
						 }
									
						$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$nuserid, 'todate'=>'Present'));
						
						if($check_exp){
							$designation = $check_exp->designation;
							$companyname = $check_exp->companyname;
							$location = $check_exp->location;
						}else{
							$designation = '';
							$companyname = '';
							$location = '';
						}
						
				
						$photo = $check_record->image;
						if($photo=='')  {
							 $uphoto = '';
						}else{
							 $uphoto    = $basepath."adminpanel/".$photo;
						}
						
						
							$priority=$check_record->priority;
							 $uid=$check_record->userid;
							 
							if($priority==1)
							 {
							  $newsname='schooling';
							  $type='news';
							 }
							 if($priority==2)
							 {
							  $newsname='highereducation';
							  $type='news';
							 }
							 if($priority==3)
							 {
							  $newsname='research-others';
							  $type='news';
							 }
							 if($priority==4)
							 {
							  $newsname='general-news';
							  $type='news';
							 }
							 if($priority==8)
							 {
							  $newsname='inspiring-stories';
							  $type='news';
							 }
							 if($priority==7)
							 {
							  $newsname='quotes';
							  $type='news';
							 }
							 if($uid==41  || $uid=='admin' || $priority==5)
							 {
							  $newsname='blog';
							  $type='blog';
							 }
						
				             $slug = $check_record->slug;
							 $newsids = $check_record->id;
						
						     $newsid = base64_encode($newsids);
				             $shareurl = $basepath.$newsname."/".$slug."/".$newsid;
							
							
							$check_like_status = $this->Common_model->common_getRow('likes',array('newsid'=>$check_record->id,'userid'=>$userid));

							if(!empty($check_like_status))
							{
								$read_status_like = 1;
							}
							else
							{
								$read_status_like = 0;
							}
							
							
							$check_bookmark_status = $this->Common_model->common_getRow('newsbookmark',array('newsid'=>$check_record->id,'userid'=>$userid));

							if(!empty($check_bookmark_status))
							{
								$bookmark_status = 1;
							}
							else
							{
								$bookmark_status = 0;
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
							
							 $dataa_array[]  = array(												
														
														'id'=>$check_record->id,	
														'url'=>$check_record->slug,
														'title'=>$check_record->page_title,
														'description'=>$fulldesc,
														'shortdescription'=>$str,
														'images'=>$uphoto,
														'authorname'=>$authorname,
														'date'  => $check_record->date,
														'totalclick'      => $check_record->click_count,				
														'readtime'   => $check_record->readtime,
														'totalcomments' =>$check_record->comments,
														
														'likestatus'   => $read_status_like,
														'totallikes'   => $check_record->likes,
														
														'bookmarkstatus'   => $bookmark_status,
														'followstatus' => $followstatus,
														
														'userimage'   => $uimage,
														
														'userid' => $nuserid,
														'usercompany'     => $companyname,
														'userdesignation' => $designation,
														'userlocation'    => $location,
														
														'shareurl'    => $shareurl,
														
														'create_at'=>$check_record->create_at,
														'type'=>$type,
														
														
													);
													
												$final_output['responseCode'] = '200';				
												$final_output['status'] = 'success';
												$final_output['message'] = 'Get news list';	
												$final_output['data'] = $dataa_array;
												
							
						  }
					}
						  
						else{
							$final_output['responseCode'] = '402';
							$final_output['status'] = 'Failed';
							$final_output['message'] = 'Record not found';
							
						}
					   
						
				   }
		
				 else
					{
						$final_output['responseCode'] = '404';
						$final_output['status'] = 'false';
						$final_output['message'] = 'Please send news name';
						
					}
		
	     }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    } 
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}



public function newslike()
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
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		    
		if($check_key['status'] == 'true')
			{ 
	
				$auth_key = $this->rand_string(40);

				$final_output = array();
				$insert_array = array();
				
			
							if(!empty($newsid))
							{  				
								$check_like_status = $this->Common_model->common_getRow('likes',array('newsid'=>$newsid,'userid'=>$userid));
								if(!empty($check_like_status))
								{
									//$read_status = $check_message_status->read_status;
									
									 $unlike = $this->Common_model->deleteData('likes', array('newsid' => $newsid, 'userid' => $userid));
									  $query = $this->Common_model->updatenewsunlike($newsid);
									  
									  if($query){
										  $msg = "Unlikes";
										  $flag = 0;
									  }
								}
								else
								{
									      $insert_array['newsid']=$newsid;
										  $insert_array['likes']=1;
										  $insert_array['userid']=$userid;	
										  $insert_array['ip']='';
															 
										  $insertId = $this->db->insert('likes', $insert_array);										  
										  $query = $this->Common_model->updatenewslike($newsid);
										
										  if($query){
											  $msg = "Likes";
											  $flag = 1;
										  }
								}
								
								$final_output['responseCode'] = '200';				
								$final_output['status'] = 'success';
								$final_output['message'] = $msg;	
								$final_output['flag'] = $flag;
							 }
							 
							 else
								{
									$final_output['responseCode'] = '404';
									$final_output['status'] = 'false';
									$final_output['message'] = 'Please send newsid';
								}
							 
							 
						}
				  else
					{
						$final_output['responseCode'] = '403';
						$final_output['status'] = 'false';
						$final_output['message'] = 'Invalid token';
						
					} 
		
				}
	 
		  else
			{
				$final_output['responseCode'] = '502';
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
		//$check_key = $this->checktoken($headers['Secret-Key']);
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
										  $msg = "Unbookmark";
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
											  $msg = "Bookmark";
											  $flag = 1;
										  }
								}
								
								$final_output['responseCode'] = '200';				
								$final_output['status'] = 'success';
								$final_output['message'] = $msg;	
								$final_output['flag'] = $flag;
							 }
							 
							 else
								{
									$final_output['responseCode'] = '404';
									$final_output['status'] = 'false';
									$final_output['message'] = 'Please send newsid';
								}
							 
							 
						}
				  else
					{
						$final_output['responseCode'] = '403';
						$final_output['status'] = 'false';
						$final_output['message'] = 'Invalid token';
						
					} 
		
				}
	 
		  else
			{
				$final_output['responseCode'] = '502';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Unauthorised Access';
				
			}  
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}



public function bookmarklist()  //Save job or News bookmark 
{
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');	
	
	$bookmarktype = $this->input->post('type');	
	/*if($bookmarktype=='job'){                //type = 'job'/'newsbookmark'
		$tablename="savejob";
	}else{
		$tablename="newsbookmark";
	}*/
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	$basepath=base_url();
	
	
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='Beyondteaching';
	
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

			
			if($bookmarktype=='job'){                //type = 'job'/'newsbookmark'
				$tablename="savejob";
				
				if($create_at==0)
				{
					$create_at1= "WHERE userid='$userid'";
				}else
				{
					$create_at1= "WHERE userid='$userid' AND create_at < $create_at";
				}
				
				$query = $this->db->query("SELECT * FROM $tablename ".$create_at1." ORDER BY `id` DESC LIMIT 10");
				$check_records = $query->result();
				$count = $query->num_rows();
				
			}else{
				$tablename="newsbookmark";
				
				
				 $check_reports = $this->Common_model->getreports($userid);		 
				 if($check_reports!=''){
					
					foreach($check_reports as $reportdata)
					{
							
							if($create_at==0)
							{
								$create_at1= "WHERE $tablename.newsid not in (select $tablename.newsid from $tablename, report where $tablename.newsid=report.newsid AND report.userid=$userid) AND $tablename.userid='$userid'";
							}else
							{
								$create_at1= "WHERE $tablename.newsid not in (select $tablename.newsid from $tablename, report where $tablename.newsid=report.newsid AND report.userid=$userid) AND $tablename.userid='$userid' AND $tablename.create_at < $create_at";
							}
						
					}	
				  }else{
						
						if($create_at==0)
						{
							$create_at1= "WHERE userid='$userid'";
						}else
						{
							$create_at1= "WHERE userid='$userid' AND create_at < $create_at";
						}
						
					}
					
					
			    $query = $this->db->query("SELECT * FROM $tablename ".$create_at1." ORDER BY `id` DESC LIMIT 10");
				$check_records = $query->result();
				$count = $query->num_rows();
				
				
			}
			
			
			/* $create_at = $this->input->post('create_at');  
			 $check_reports = $this->Common_model->getreports($userid);		 
			 if($check_reports!=''){
				
				foreach($check_reports as $reportdata)
				{
					//$userids = $reportdata->userid;
					//if($userids==$userid){
						
						if($create_at==0)
						{
							$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND btnews.userid='$userid' AND status='active'";
						}else
						{
							$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND btnews.userid='$userid' AND create_at < $create_at AND status='active'";
						}
						
					//}
					
				}	
			  }else{
					
					if($create_at==0)
					{
						$create_at1= "WHERE userid='$userid' AND status='active'";
					}else
					{
						$create_at1= "WHERE userid='$userid' AND create_at < $create_at AND status='active'";
					}
					
				}*/
			
			

			//$query = $this->db->query("SELECT * FROM $tablename ".$create_at1." ORDER BY `id` DESC LIMIT 10");
			//$check_records = $query->result();
			//$count = $query->num_rows();
			
			if($count>0){
			 
			 foreach($check_records as $check_record1)
			 {
				 if($bookmarktype=='job'){
					 
						    $jobid = $check_record1->savejobid;
							
							//$jobids = $check_record1->id;
				   
							$check_jobapply = $this->Common_model->common_getRow('savejob',array('userid'=>$userid, 'applyjobid'=>$jobid));
							if($check_jobapply){
								   $jobapplied = 1;
								
							}else{
								   $jobapplied=0;
							}		

							$check_jobsave = $this->Common_model->common_getRow('savejob',array('userid'=>$userid, 'savejobid'=>$jobid));
							if($check_jobsave){
								$savejob = 1;
								
							}else{
								$savejob=0;
							}
							
							$jobdetails = $this->Common_model->common_getRow('job',array('id'=>$jobid));
							if($jobdetails){
							
							//print_r($jobrecords);
							
							//foreach($jobrecords as $jobdetails){
						
									//$jobphoto = $jobdetails['image'];
									$jobphoto = $jobdetails->image;
									
									if($jobphoto=='')  {
									   $jobphoto = '';
									}else{
									   $jobphoto    = $basepath."adminpanel/images/job/".$jobphoto;
									}
									
									 $jdate = $jobdetails->datetime;
									 $timestampdate = strtotime($jdate);
							  //}
							  
							  $shortdes = $jobdetails->jobdescription;
							$jstr = utf8_decode($shortdes);
            				$jstr = str_replace("&nbsp;", "", $jstr);
            				$jstr = preg_replace("/\s+/", " ", $jstr);
            				$jstr = strip_tags($jstr);
            				$jstr = htmlspecialchars_decode($jstr, ENT_QUOTES); 
							  
							  
							  $dataa_array[]  = array(
														'jobid'          => $jobdetails->id,
														'image'          => $jobphoto,
														'companyname'    =>$jobdetails->companyname,
														'companyprofile' =>$jobdetails->companyprofile,
														'jobaddress'     =>$jobdetails->address,
														'jobtitle'       =>$jobdetails->jobtitle,
														'description'    =>$jobdetails->jobdescription,
														'shortdescription'=>$jstr,
														'jobtype'        =>$jobdetails->jobtype,
														
														'keyskill'       =>$jobdetails->keyskill,
														'jobview'        =>$jobdetails->jobview,	
														'userid'         =>$jobdetails->userid,	
														
														'isJobApplied' =>$jobapplied,
														'isBookmarked' =>$savejob,
														
														'timestamp'    => $timestampdate,
														'create_at'    =>$check_record1->create_at,
														'type'         =>'job'
														
														
										            );
							
							
							}
					 
				 }else{
				 
				        $newsid = $check_record1->newsid;
						$createat = $check_record1->create_at;
				        //$nuserid = $check_record->userid;
						
					    $check_like_status = $this->Common_model->common_getRow('likes',array('newsid'=>$newsid,'userid'=>$userid));

						if(!empty($check_like_status))
						{
							$read_status_like = 1;
						}
						else
						{
							$read_status_like = 0;
						}
						
						
						$check_bookmark_status = $this->Common_model->common_getRow('newsbookmark',array('newsid'=>$newsid,'userid'=>$userid));

						if(!empty($check_bookmark_status))
						{
							$bookmark_status = 1;
						}
						else
						{
							$bookmark_status = 0;
						}
						
					    $check_record = $this->Common_model->common_getRow('btnews',array('id'=>$newsid, 'status'=>'active'));
						if(!empty($check_record))
						{
						   $nuserid = $check_record->userid;
						   
						    //$nuserid = $check_record->userid;
							$check_follows = $this->Common_model->common_getRow('userfollow',array('userid'=>$userid, 'followerid'=>$nuserid));
							if($check_follows){	
								
								   $followstatus = 1;
								
							 }else{
								 $followstatus = 0;
							 }
						
						
                        $newsuser = $this->Common_model->common_getRow('user_register',array('id'=>$nuserid, 'status'=>1));
						if(!empty($newsuser))
						{
							$author = $newsuser->user_name;
							if(!empty($author)){
								  $authorname = $author;
							}else{
								 $authorname = $check_record->author;
							}
							
						     $photo      = $newsuser->photo;
							 
							  $data=parse_url($photo, PHP_URL_SCHEME);
  
							  if($data=='http' || $data=='https')
							  {
							      $uimage = $photo;
							  }
							  else if($data!='http' || $data!='https'){
							       $uimage = $basepath.'adminpanel/'.$photo;
							  }
							  else
							  {
							   
							  }
							  if($photo=='')
							  {
							       $uimage = $basepath."assets/images/nophoto.png";
							  }
								
						}
						else
						{
							$authorname = $check_record->author;
							$uimage = $basepath."assets/images/nophoto.png";		
						}
			        //}	
									
						$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$nuserid, 'todate'=>'Present'));
						
						if($check_exp){
							$designation = $check_exp->designation;
							$companyname = $check_exp->companyname;
							$location = $check_exp->location;
						}else{
							$designation = '';
							$companyname = '';
							$location = '';
						}
						
				
						$photo = $check_record->image;
						if($photo=='')  {
							 $image = $basepath."assets/images/nophoto.png";
						}else{
							 $image    = $basepath."adminpanel/".$photo;
						}
						
						
							$priority=$check_record->priority;
							 $uid=$check_record->userid;
							if($priority==1)
							 {
							  $newsname='schooling';
							  $type='news';
							 }
							 if($priority==2)
							 {
							  $newsname='highereducation';
							  $type='news';
							 }
							 if($priority==3)
							 {
							  $newsname='research-others';
							  $type='news';
							 }
							 if($priority==4)
							 {
							  $newsname='general-news';
							  $type='news';
							 }
							 if($priority==8)
							 {
							  $newsname='inspiring-stories';
							  $type='news';
							 }
							 if($priority==7)
							 {
							  $newsname='quotes';
							  $type='news';
							 }
							 if($uid==41  || $uid=='admin' || $priority==5)
							 {
							  $newsname='blog';
							  $type='blog';
							 }
							
							$slug = $check_record->slug;
							 $newsids = $check_record->id;
						
						     $newsid = base64_encode($newsids);   
				             $shareurl = $basepath.$newsname."/".$slug."/".$newsid;
				        //}	 
				        
				              $shortdes = $check_record->description;
							    $str = trim($shortdes);
                                $str = utf8_decode($str);
                                $str = str_replace("&nbsp;", " ", $str);
                                $str = htmlspecialchars_decode($str, ENT_QUOTES);
                                $str = html_entity_decode($str, ENT_QUOTES);
                                
                                $str = $this->Common_model->decodeEmoticons($str);
                                $fulldesc = $str;
                                $str = strip_tags($str);
				
				        $dataa_array[]  = array(
												'id'=>$check_record->id,	
												'url'=>$check_record->slug,
												'title'=>$check_record->page_title,
												'description'=>$fulldesc,
												'shortdescription'=>$str,
												'images'=>$image,
												'authorname'=>$authorname,
												'date'  => $check_record->date,
												'totalclick'      => $check_record->click_count,				
												'readtime'   => $check_record->readtime,
												'totalcomments' =>$check_record->comments,
												
												'likestatus'   => $read_status_like,
												'totallikes'   => $check_record->likes,
												
												'bookmarkstatus'   => $bookmark_status,
												'followstatus' => $followstatus,
												'userimage'   => $uimage,
												
												
												'userid' => $nuserid,
												'usercompany'     => $companyname,
												'userdesignation' => $designation,
												'userlocation'    => $location,
												
												'shareurl'    => $shareurl,
												
												'create_at'=>$createat,
												'type'=>$type
														
														
										            );
			 
			
			              }
			          } 
			        }

					$final_output['responseCode'] = '200';				
					$final_output['status'] = 'success';
					$final_output['message'] = 'Get list';	
					//$final_output['totalcount'] = $count;
					$final_output['data'] = $dataa_array;				
			    			
				
			  }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Records not found.';
				
			}
	       
			
	   
	}
	 
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Invalid token';
			
	    } 
	
	 }
	 
	 
	  else
	    {
			$final_output['responseCode'] = '502';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'Unauthorised Access';
			
	    }  
	
		
	
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}



public function userfollow()
{
	
	$this->load->model('Common_model');
	
	$otheruserid = $this->input->post('otheruserid');	
	$userid      = $this->input->post('id');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
		
	
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		//$check_key = $this->checktoken($headers['Secret-Key']);
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		    
		if($check_key['status'] == 'true')
			{ 
	
				$auth_key = $this->rand_string(40);

				$final_output = array();
				$insert_array = array();
				
							if(!empty($userid))
							{  				
								$check_follow_status = $this->Common_model->common_getRow('userfollow',array('userid'=>$userid,'followerid'=>$otheruserid));
								if(!empty($check_follow_status))
								{									
									 $unfollow = $this->Common_model->deleteData('userfollow', array('userid'=>$userid,'followerid'=>$otheruserid));
									 
									 $notification = $this->Common_model->deleteData('manage_notification', array('uid'=>$userid,'fid'=>$otheruserid));
									 
									 $query = $this->Common_model->updateunfollow($userid);
									 $querys = $this->Common_model->update_unfollow_other($otheruserid);
									  
									  $msg = "Unfollow";
									  $flag = 0;
									  
								}
								else
								{
									      $insert_array['userid']    =$userid;
										  $insert_array['followerid']=$otheruserid;	
										  $insert_array['ip_address']='';
										  $insert_array['tokenid']='';
										  $insert_array['deviceid']='';
										  $insert_array['followers']='1';
										  $insert_array['following']='0';
										  $insert_array['hire']='0';
										  $insert_array['create_at']=militime;
										  $insert_array['update_at']=militime;
										  
															 
										  $follow = $this->db->insert('userfollow', $insert_array);	
										  
										  $notification = $this->db->insert('manage_notification', array('nid'=>'0', 'uid'=>$userid,'fid'=>$otheruserid, 'notification_status'=>'1', 'notification_type'=>'following', 'create_at'=>militime, 'update_at'=>militime));	
										  
										  $query = $this->Common_model->updatefollow($userid);
									      $querys = $this->Common_model->update_follow_other($otheruserid);
										
										  $msg = "follow";
									      $flag = 1;
								}
								
								$final_output['responseCode'] = '200';				
								$final_output['status'] = 'success';
								$final_output['message'] = $msg;	
								$final_output['flag'] = $flag;
							 }
							 
							 else
								{
									$final_output['responseCode'] = '404';
									$final_output['status'] = 'false';
									$final_output['message'] = 'Please send userid';
								}
							 
							 
						}
				  else
					{
						$final_output['responseCode'] = '403';
						$final_output['status'] = 'false';
						$final_output['message'] = 'Invalid token';
						
					} 
		
				}
	 
		  else
			{
				$final_output['responseCode'] = '502';
				$final_output['status'] = 'false';
				$final_output['message'] = 'Unauthorised Access';
				
			}  
	
 	header("content-type: application/json");
    echo json_encode($final_output);


}



public function logout()
{
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 

		 $userid = $this->input->post('id');
		
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);

		if($check_key['status'] == 'true')
	    {
   					//$create_at = $this->input->post('create_at');
					$userid = $this->input->post('id');
		            $final_output = array();

					$query = $this->db->query("Update user_register set deviceid= '' where id='$userid'");
				
					

					if(!empty($query))
					{
							$message='User logged out successfully.';
							$final_output['responseCode'] = '200';
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
			$final_output['responseCode'] = '403';
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




public function message_list_search_more()
{
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		$check_key = $this->checktoken($headers['Secret-Key']);

		if($check_key['status'] == 'true')
	    {
	        $device_type = $this->input->post('device_type');
  
            $version_code = $this->input->post('version_code');	

            $get_version = $this->common_model->common_getRow('app_version',array('version_id'=>1));

	        if(($version_code < $get_version->android_min_version && $device_type == 'AndroidApp') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	    {
		    	if($device_type == 'AndroidApp')
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version;'; 
		    	}
		    	else
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to App Store to download the latest version;';
		    	}	

			        $final_output['status'] = '1001';
					$final_output['message'] = $msg;	
					header("content-type: application/json");
				    echo json_encode($final_output);exit;	
   			}
   			else
   			{

   					//$create_at = $this->input->post('create_at');
					$searchVal = $this->input->post('searchVal');
   					
   					$student_id = $check_key['data']->student_id;

		            $final_output = array();

		            
					if($searchVal==0)
					{
						$searchVal= '';
					}else
					{
						$searchVal= "WHERE title like'%$searchVal%'";
					}

					$query = $this->db->query('SELECT * FROM message_details '.$searchVal.' ORDER BY message_id DESC LIMIT 10');
				
					$messagelist = $query->result();

					if(!empty($messagelist))
					{

						$message_arr = array();

						foreach($messagelist as $message)
						{

							$check_message_status = $this->common_model->common_getRow('message_read_status',array('message_id'=>$message->message_id,'student_id'=>$student_id));

				    		if(!empty($check_message_status))
				    		{
				    			$read_status = $check_message_status->read_status;
				    		}
				    		else
				    		{
				    			$read_status = 0;
				    		}	
						    
				   	    		$create_at = $message->create_at;
								$seconds = $create_at / 1000;

								$date = date('d-M-Y H:i:s',$seconds);

								if($message->image == '')
								{
									$image1 = '';
								}
								else
								{
									$image1 = base_url().'uploads/image/'.$message->image;
								}	

						    	$message_arr[] = array(
						    		 				 'message_id'=>$message->message_id,	
						    		                 'title'=>$message->title,
						    						 'message'=>$message->message,
						    						 'image'=>$image1,
						    						 'read_status'=>$read_status,
						    						 'date'=>$date,
						    						 'create_at'=>$message->create_at
						    						 );


						}	
							$final_output['status'] = 'success';
						    $final_output['message'] = 'successfully.';
				            $final_output['data'] = $message_arr;
			        }
			        else
			        {
			       	    $final_output['status'] = 'failed';
						$final_output['message'] = 'Data Not Found.';
				        unset($final_output['data']);
			        }	

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





public function message_list_load_more()
{
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		$check_key = $this->checktoken($headers['Secret-Key']);

		if($check_key['status'] == 'true')
	    {
	        $device_type = $this->input->post('device_type');
  
            $version_code = $this->input->post('version_code');	

            $get_version = $this->common_model->common_getRow('app_version',array('version_id'=>1));

	        if(($version_code < $get_version->android_min_version && $device_type == 'AndroidApp') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	    {
		    	if($device_type == 'AndroidApp')
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version;'; 
		    	}
		    	else
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to App Store to download the latest version;';
		    	}	

			        $final_output['status'] = '1001';
					$final_output['message'] = $msg;	
					header("content-type: application/json");
				    echo json_encode($final_output);exit;	
   			}
   			else
   			{

   					$create_at = $this->input->post('create_at');
   					
   					$student_id = $check_key['data']->student_id;

		            $final_output = array();

		            
					if($create_at==0)
					{
						$create_at1= '';
					}else
					{
						$create_at1= "WHERE create_at < $create_at";
					}

					$query = $this->db->query('SELECT * FROM message_details '.$create_at1.' ORDER BY message_id DESC LIMIT 10');
				
					$messagelist = $query->result();

					if(!empty($messagelist))
					{

						$message_arr = array();

						foreach($messagelist as $message)
						{

							$check_message_status = $this->common_model->common_getRow('message_read_status',array('message_id'=>$message->message_id,'student_id'=>$student_id));

				    		if(!empty($check_message_status))
				    		{
				    			$read_status = $check_message_status->read_status;
				    		}
				    		else
				    		{
				    			$read_status = 0;
				    		}	
						    
				   	    		$create_at = $message->create_at;
								$seconds = $create_at / 1000;

								$date = date('d-M-Y H:i:s',$seconds);

								if($message->image == '')
								{
									$image1 = '';
								}
								else
								{
									$image1 = base_url().'uploads/image/'.$message->image;
								}	

						    	$message_arr[] = array(
						    		 				 'message_id'=>$message->message_id,	
						    		                 'title'=>$message->title,
						    						 'message'=>$message->message,
						    						 'image'=>$image1,
						    						 'read_status'=>$read_status,
						    						 'date'=>$date,
						    						 'create_at'=>$message->create_at
						    						 );


						}	
							$final_output['status'] = 'success';
						    $final_output['message'] = 'successfully.';
				            $final_output['data'] = $message_arr;
			        }
			        else
			        {
			       	    $final_output['status'] = 'failed';
						$final_output['message'] = 'Data Not Found.';
				        unset($final_output['data']);
			        }	

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




public function message_list_pool_to_refresh()
{
	$headers = apache_request_headers();
	if($headers['Secret-Key'] !='') 
	{ 
		$check_key = $this->checktoken($headers['Secret-Key']);

		if($check_key['status'] == 'true')
	    {
            $student_id = $check_key['data']->student_id;

            $final_output = array();

            $create_at = $this->input->post('create_at');

			if($create_at==0)
			{
				$create_at1= '';
			}else
			{
				$create_at1= "WHERE create_at > $create_at";
			}

			$query = $this->db->query('SELECT * FROM `message_details` '.$create_at1.' ORDER BY `message_id` DESC LIMIT 10');

			$messagelist = $query->result();

			if(!empty($messagelist))
			{

				$message_arr = array();

				foreach($messagelist as $message)
				{
				    $check_message_status = $this->common_model->common_getRow('message_read_status',array('message_id'=>$message->message_id,'student_id'=>$student_id));

				    if(!empty($check_message_status))
				    {
				    	$read_status = $check_message_status->read_status;
				    }
				    else
				    {
				    	$read_status = 0;
				    }	

		   	    		$create_at = $message->create_at;
						$seconds = $create_at / 1000;

						$date = date('d-M-Y H:i:s',$seconds);

						if($message->image == '')
						{
							$image1 = '';
						}
						else
						{
							$image1 = base_url().'uploads/image/'.$message->image;
						}	

				    	$message_arr[] = array(
				    						 'message_id'=>$message->message_id,
				    		                 'title'=>$message->title,
				    						 'message'=>$message->message,
				    						 'image'=>$image1,
				    						 'read_status'=>$read_status,
				    						 'date'=>$date,
				    						 'create_at'=>$message->create_at
				    						 );


				}	
					$final_output['status'] = 'success';
				    $final_output['message'] = 'successfully.';
		            $final_output['data'] = $message_arr;
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

public function message_description()
{
	$headers = apache_request_headers();

	if($headers['Secret-Key'] !='') 
	{
		$check_key = $this->checktoken($headers['Secret-Key']);

        if($check_key['status'] == 'true')
        { 
			$student_id = $check_key['data']->student_id;
			
        	$device_type = $this->input->post('device_type');
  
            $version_code = $this->input->post('version_code');	

            $get_version = $this->common_model->common_getRow('app_version',array('version_id'=>1));

	       if(($version_code < $get_version->android_min_version && $device_type == 'AndroidApp') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	   {
		    	if($device_type == 'AndroidApp')
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version;'; 
		    	}
		    	else
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to App Store to download the latest version;';
		    	}	

			        $final_output['status'] = '1001';
					$final_output['message'] = $msg;	
					header("content-type: application/json");
				    echo json_encode($final_output);exit;	
   			}
   			else
   			{

				$message_id = $this->input->post('message_id');

    			$description = $this->common_model->common_getRow('message_details',array('message_id'=>$message_id));

	        	if(!empty($description))
	        	{
	        		$create_at = $description->create_at;
					$seconds = $create_at / 1000;

					$date = date('d-M-Y H:i:s',$seconds);

					if($description->image == '')
					{
						$image1 = '';
					}
					else
					{
						$image1 = base_url().'uploads/image/'.$description->image;
					}

					$check_bookmark_status = $this->common_model->common_getRow('message_bookmark_users',array('message_id'=>$description->message_id,'user_id'=>$student_id));

					if(!empty($check_bookmark_status))
					{
						$bookmark_status = $check_bookmark_status->message_bookmark;
					}
					else
					{
						$bookmark_status = 0;
					}
					  $check_like_status = $this->common_model->common_getRow('massage_like_user',array('message_id'=>$description->message_id,'user_id'=>$student_id));

					if(!empty($check_like_status))
					{
						$read_status_like = $check_like_status->message_like;
					}
					else
					{
						$read_status_like = 0;
					}
					

	        		$message_arr = array(
			    						 'message_id'=>$description->message_id,
			    		                 'title'=>$description->title,
			    						 'message'=>$description->message,
			    						 'image'=>$image1,
										 'message_bookmark_total'=>$description->message_bookmark_total,
										 'message_like_total'=>$description->message_like_total,
			    						 'read_status'=>'0',
										 'bookmark_status'=>$bookmark_status,
			    						 'date'=>$date,
			    						 'create_at'=>$description->create_at
					    				);

	        			$final_output['status'] = 'success';
					    $final_output['message'] = 'successfully.';
			            $final_output['data'] = $message_arr;
	        	}
	        	else
	        	{
	        		$final_output['status'] = 'failed';
					$final_output['message'] = 'Data Not Found';
			        unset($final_output['data']);
	        	}

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
