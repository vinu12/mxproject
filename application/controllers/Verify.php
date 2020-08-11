<?php 
class Verify extends CI_Controller {
function __construct() {
		parent::__construct();

		date_default_timezone_set('Australia/canberra'); 
		$militime =round(microtime(true) * 1000);
		$datetime =date('Y-m-d h:i:s');
		define('militime', $militime);
		define('datetime', $datetime);
		
	}
/*  	
	verifyemail
	
*/
	
  /* Verify Mail  API */

  public function verifyemail($lastid)
	{
		
		$this->load->model('Common_model');
		
		$userid = $lastid;
		
		$check_mail = $this->Common_model->verify_mail($userid);
				
				
				if($check_mail==0)
				{
						$final_output['status'] = 'Failed';
						$final_output['message'] = 'Please click your confirmation link in your mail id';
						$final_output['responsecode'] = '400';						
						
				}
				else
				{ 
					$mailstatus = $this->Common_model->mail_status($userid);
					
					$userstatus = $this->Common_model->userDevice_status($userid);
					
					$check_all_record = $this->Common_model->common_getRow('user_register',array('id'=>$userid));
					
					$uids = $check_all_record->id;
				
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
						   $uphoto = $basepath."adminpanel/images/photo.png";
					  }
					  
					  $name = $check_all_record->user_name;
					  $email = $check_all_record->user_email;
					  
					  
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
												'user_country'   => $check_all_record->country,
												'user_city'      => $check_all_record->city,
												
												'usercompany'     => $companyname,
												'userdesignation' => $designation,
												'userlocation'    => $location,
					                  			
												'user_type'      => $check_all_record->usertype,
																							
												'create_at' => $check_all_record->create_at,
												'update_at' => $check_all_record->update_at
												
					                  			
								            );
					
						
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
														<td><h4>Dear $name,</h4></td>
													</tr>
													
													<tr>
														<td>Thank you for confirmation email id.</td>
													</tr>
													
													
											</table>

										</body>
										</html>
									";
						$headers = "From:no-reply@aina.today\r\n";
						$headers.= "Mime-Version: 1.0\r\n";
						$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$toEmail = $email;	
						
						$subject="Confirmation Email From AINA";
						$mail_sent = mail($toEmail, $subject, $message, $headers);
										
											
					$final_output['responsecode'] = '200';					
					$final_output['status'] = 'Success';
					$final_output['message'] = 'Thank you';
					$final_output['data'] = $data_array;
					
					
				}	

				header("content-type: application/json");
				echo json_encode($final_output);
    }	
	
	
	
	public function verifypassword($lastid)
	{
		
		$this->load->model('Common_model');		
		$userid = $lastid;
		
		$check_mail = $this->Common_model->verify_mail($userid);
				
				
				if($check_mail==0)
				{
						$final_output['status'] = 'Failed';
						$final_output['message'] = 'Please click your confirmation link in your mail id';
						$final_output['responsecode'] = '400';						
						
				}
				else
				{ 
					$mailstatus = $this->Common_model->mail_status($userid);
					
					$userstatus = $this->Common_model->userDevice_status($userid);
					
					$check_all_record = $this->Common_model->common_getRow('user_register',array('id'=>$userid));
					
					$uids = $check_all_record->id;
					$name = $check_all_record->user_name;
					$email = $check_all_record->user_email;
				
						$message ="
								  <!DOCTYPE html>
										<html>
											<head>
												<meta charset='utf-8' />
												<title>Iwilpro</title>
												<meta name='viewport' content='width=device-width, initial-scale=1.0' />
											</head>
											<body>
												<table>
													<tr>
														<td><h4>Dear $name,</h4></td>
													</tr>
													
													<tr>
														<td>Thank you for confirmation email id.</td>
													</tr>
													
													
											</table>

										</body>
										</html>
									";
						$headers = "From:no-reply@aina.today\r\n";
						$headers.= "Mime-Version: 1.0\r\n";
						$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

						$toEmail = $email;	
						
						$subject="Confirmation Email For AINA";
						$mail_sent = mail($toEmail, $subject, $message, $headers);
										
											
					$final_output['responsecode'] = '200';					
					$final_output['status'] = 'Success';
					$final_output['message'] = 'Thank you';
					//$final_output['data'] = $data_array;
					
					
				}	

				header("content-type: application/json");
				echo json_encode($final_output);
    }

	
}
