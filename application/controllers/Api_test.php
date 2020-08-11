<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_test extends CI_Controller {
function __construct() {
		parent::__construct();

		date_default_timezone_set('Australia/canberra'); 
		$militime =round(microtime(true) * 1000);
		$datetime =date('Y-m-d h:i:s');
		define('militime', $militime);
		define('datetime', $datetime);

		$this->load->model('common_model1');
		
	}
	
public function test()
{
    $pushStatus1 = $this->common_model->iOSPushNotification1('29D41F7DEC536F71DCF81B7FA7813156B134D0C283BFC021AE75FB42ADBE4BA9','fhgghghgh','jashdjsdsd','1',1);
}

public function login()
{
	$email = $this->input->post('email');
	$name = $this->input->post('name');
	$image = $this->input->post('image');
	$contact_no = $this->input->post('contact_no');
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
    $type = $this->input->post('social_login_type');
   
    $version_code = $this->input->post('version_code');


    if($device_type == 'iOS' && strlen($device_id) == strlen($device_token))
    { 
        $device_token = 'abcdef';
    }	
   
    $auth_key = $this->rand_string(40);

    $final_output = array();

    if(!empty($email))
    {
       $get_version = $this->common_model->common_getRow('app_version',array('version_id'=>1));
	   	
	    if(($version_code < $get_version->android_min_version && $device_type == 'android') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
	    {
	    	if($device_type == 'android')
	    	{
	    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version'; 
	    	}
	    	else
	    	{
	    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Play Store to download the latest version';
	    	}	

	        $final_output['status'] = '1001';
			$final_output['message'] = $msg;	
			header("content-type: application/json");
		    echo json_encode($final_output);exit;	
	    }
	    else
	    { 
					$check_email = $this->common_model->common_getRow('students',array('email'=>$email));
					if(!empty($check_email))
					{
					    	$update_value = $this->common_model->updateData('students',array('update_at'=>militime,'token'=>$auth_key,'device_token'=>$device_token,'device_id'=>$device_id,'device_type'=>$device_type,'image'=>$image,'name'=>$name,'social_login_type'=>$type,'contact_no'=>$contact_no,),array('email'=>$email));

					    	$student_id = $check_email->student_id;

					    	$query = $this->db->query("UPDATE `students` SET `device_token` = '' WHERE `device_id` = '$device_id' AND `student_id` != '$student_id'");


					    	$data_array = array(
					    						'student_id'=>$check_email->student_id,	
					                  			'name'=>$name,
					                  			'email'=>$check_email->email,
					            				'contact_no'=>$contact_no,
					                  			'image'=>$image,
					                  			'social_login_type'=>$type,
					                  			'token'=>$auth_key,
					                  			
								            );

					    	
							$final_output['status'] = 'success';
							$final_output['message'] = 'You have logged-in successfully.';	
							$final_output['data'] = $data_array;
					
			    	}
			    	else
					{ 
			    	     $insert_array = array(
					                  'name'=>$name,
					                  'email'=>$email,
					                  'contact_no'=>$contact_no,
					                  'image'=>$image,
					                  'device_id'=>$device_id,
					                  'device_token'=>$device_token,
					                  'device_type'=>$device_type,
					                  'token'=>$auth_key,
					                  'social_login_type'=>$type,
					                  'create_at'=>militime,
					                  'update_at'=>militime,
							          );

			    	       $insertId = $this->common_model->common_insert('students', $insert_array);

					    	if($insertId)
					    	{
					    		$dataa_array  = array(
					    			 					'student_id'=>$insertId,	
							                  			'name'=>$name,
							                  			'email'=>$email,
							            				'contact_no'=>$contact_no,
							                  			'image'=>$image,
							                  			'social_login_type'=>$type,
							                  			'token'=>$auth_key
										            );


					    	    $query = $this->db->query("UPDATE `students` SET `device_token` = '' WHERE `device_id` = '$device_id' AND `student_id` != '$insertId'");


					    		    $final_output['status'] = 'success';
									$final_output['message'] = 'You have logged-in successfully.';	
									$final_output['data'] = $dataa_array;
							}else
							{ 
									$final_output['status'] = 'failed';
							     	$final_output['message'] = 'Something went wrong! please try again.';
							     	unset($final_output['data']);
							}	
			    	}	
		}    	
	}else
	{
		$final_output['status'] = 'failed';
	 	$final_output['message'] = 'Required parameter not found';
	 	unset($final_output['data']);
	}
 	header("content-type: application/json");
    echo json_encode($final_output);
}


function messagelike()
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

	        if(($version_code < $get_version->android_min_version && $device_type == 'android') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	    {
		    	if($device_type == 'android')
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version;'; 
		    	}
		    	else
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Play Store to download the latest version;';
		    	}	

			        $final_output['status'] = '1001';
					$final_output['message'] = $msg;	
					header("content-type: application/json");
				    echo json_encode($final_output);exit;	
   			}
   			else
   			{
				$news_id=$this->input->post('news_id');
				$userid=$this->input->post('userid');
				
				$query = $this->db->query('SELECT * FROM massage_like_user where message_id='.$news_id.' AND user_id='.$userid.' AND message_like=1');
				$messagelist = $query->result();
				$totaldata=$query->num_rows();
				if($totaldata>0)
				{
				    
                        $this->db->where('message_id', $news_id);
                        $this->db->where('user_id', $userid);
                         $this->db->delete('massage_like_user');
				    
				    
				    
				     $query = $this->db->query('SELECT * FROM massage_like_user where message_id='.$news_id.' AND message_like=1');
                        $messagelist = $query->result();
                        $totaldataupdate=$query->num_rows();
				    
				    
					//$updatetotal=$totaldata-1;
					 $query = $this->db->query("UPDATE message_details SET message_like_total = '".$totaldataupdate."' WHERE message_id = '".$news_id."'");
					
					$message_arr[] = array('flag'=>0,'totallike'=>$totaldataupdate);
						    		 				 
				}
				else
				{
					
					
						$data = array( 
					'message_id'=>  $news_id , 
					'user_id'=>  $userid,
					'message_like'	=> '1'
					);
					$this->db->insert('massage_like_user', $data);
					
				
						
					
                        $query = $this->db->query('SELECT * FROM massage_like_user where message_id='.$news_id.' AND message_like=1');
                        $messagelist = $query->result();
                        $totaldata=$query->num_rows();
                       // $updatetotal=$totaldata+1;
						
						$query = $this->db->query("UPDATE message_details SET message_like_total = '".$totaldata."' WHERE message_id = '".$news_id."'");
					
					
					
						$message_arr[] = array('flag'=>1,'totallike'=>$totaldata);
						
				
				   }
				

        		  $final_output['status'] = 'success';
				  $final_output['message'] = 'successfully.';	
				  $final_output['data'] = $message_arr;
				
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



function messagebookmark()
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

	        if(($version_code < $get_version->android_min_version && $device_type == 'android') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	    {
		    	if($device_type == 'android')
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version;'; 
		    	}
		    	else
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Play Store to download the latest version;';
		    	}	

			        $final_output['status'] = '1001';
					$final_output['message'] = $msg;	
					header("content-type: application/json");
				    echo json_encode($final_output);exit;	
   			}
   			else
   			{
				$news_id=$this->input->post('news_id');
				$userid=$this->input->post('userid');
				
				$query = $this->db->query('SELECT * FROM message_bookmark_users where message_id='.$news_id.' AND user_id='.$userid.' AND message_bookmark=1');
				$messagelist = $query->result();
				$totaldata=$query->num_rows();
				if($totaldata>0)
				{
				    
                        $this->db->where('message_id', $news_id);
                        $this->db->where('user_id', $userid);
                        $this->db->delete('message_bookmark_users');
				    
				    
				    
				     $query = $this->db->query('SELECT * FROM message_bookmark_users where message_id='.$news_id.' AND message_bookmark=1');
                        $messagelist = $query->result();
                        $totaldataupdate=$query->num_rows();
				    
				    
					//$updatetotal=$totaldata-1;
					 $query = $this->db->query("UPDATE message_details1 SET message_bookmark_total = '".$totaldataupdate."' WHERE message_id = '".$news_id."'");
					
					$message_arr[] = array('bookmarkflag'=>0,'totalbookmark'=>$totaldataupdate);
						    		 				 
				}
				else
				{
					
					$ipaddress=$_SERVER['REMOTE_ADDR'];
					$data = array( 
					'message_id'=>  $news_id , 
					'user_id'=>  $userid,
					'ip_address'=> $ipaddress,
					'message_bookmark'	=> '1'
					
					);
					$this->db->insert('message_bookmark_users', $data);
					
				
						
					
                        $query = $this->db->query('SELECT * FROM message_bookmark_users where message_id='.$news_id.' AND message_bookmark=1');
                        $messagelist = $query->result();
                        $totaldata=$query->num_rows();
                       // $updatetotal=$totaldata+1;
						
						$query = $this->db->query("UPDATE message_details1 SET message_bookmark
						= '".$totaldata."' WHERE message_id ='".$news_id."'");
					
					
					
						$message_arr[] = array('bookmarkflag'=>1,'totalbookmark'=>$totaldata);
						
				
				   }
				

        		  $final_output['status'] = 'success';
				  $final_output['message'] = 'successfully.';	
				  $final_output['data'] = $message_arr;
				
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





function studyMesssage()
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

	        if(($version_code < $get_version->android_min_version && $device_type == 'android') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	    {
		    	if($device_type == 'android')
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version;'; 
		    	}
		    	else
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Play Store to download the latest version;';
		    	}	

			        $final_output['status'] = '1001';
					$final_output['message'] = $msg;	
					header("content-type: application/json");
				    echo json_encode($final_output);exit;	
   			}
   			else
   			{
				
				$name=mysql_real_escape_string($this->input->post('name'));
				$Email=mysql_real_escape_string($this->input->post('Email'));
				$Country=mysql_real_escape_string($this->input->post('Country'));
				$Phone =mysql_real_escape_string($this->input->post('Phone'));
				$education=mysql_real_escape_string($this->input->post('education'));
				$userid=mysql_real_escape_string($this->input->post('userid'));
				
				if($name=="")
				{
					$errormessage="Name can not blank!;";
				}
				if($Email=="")
				{
					$errormessage="Email can not blank!;";
				}
				if($Country=="")
				{
					$errormessage="country can not blank!;";
				}
				if($Phone=="")
				{
					$errormessage="phone can not blank!;";
				}
				if($education=="")
				{
					$errormessage="Highest education can not blank!;";
				}
				
				
				if($errormessage)
				{
				    
                        
					$message_arr[] = array('error_message'=>$errormessage);
						    		 				 
				}
				else
				{
					
					$ipaddress=$_SERVER['REMOTE_ADDR'];
					$data = array( 
					'userid'=> $userid , 
					'name'=> $name,
					'ip_address'=> $ipaddress,
					'email'	=> $Email,
					'country'=>$country,
					 'phone'=>$phone,
					 'education_desc'=>$education,
					 'create_at'=>militime,
					 'update_at'=>militime
					);
					$this->db->insert('message_study_users', $data);
					
					
					
						$message_arr[] = array('successmessage'=>'success');
						
				
				   }
				

        		  $final_output['status'] = 'success';
				  $final_output['message'] = 'successfully.';	
				  $final_output['data'] = $message_arr;
				
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

	        if(($version_code < $get_version->android_min_version && $device_type == 'android') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	    {
		    	if($device_type == 'android')
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version;'; 
		    	}
		    	else
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Play Store to download the latest version;';
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
							
							
							$check_like_status = $this->common_model->common_getRow('massage_like_user',array('message_id'=>$message->message_id,'user_id'=>$student_id));

				    		if(!empty($check_like_status))
				    		{
				    			$read_status_like = $check_like_status->message_like;
				    		}
				    		else
				    		{
				    			$read_status_like = 0;
				    		}
							
							$check_bookmark_status = $this->common_model->common_getRow('message_bookmark_users',array('message_id'=>$message->message_id,'user_id'=>$student_id));

				    		if(!empty($check_bookmark_status))
				    		{
				    			$bookmark_status = $check_bookmark_status->message_bookmark;
				    		}
				    		else
				    		{
				    			$bookmark_status = 0;
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
													 'like_status'=>$read_status_like,
													 'bookmark_status'=>$bookmark_status,
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







public function profilebookmarklist()
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

	        if(($version_code < $get_version->android_min_version && $device_type == 'android') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	    {
		    	if($device_type == 'android')
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
   					$student_id=$this->input->post('user_id');
   					//$student_id = $check_key['data']->student_id;

		            $final_output = array();

		            
					if($create_at==0)
					{
						$create_at1= '';
					}else
					{
						$create_at1= "AND ms.create_at < $create_at";
					}

					//$query = $this->db->query('SELECT * FROM message_details '.$create_at1.' ORDER BY message_id DESC LIMIT 10');
					
					
				   $query = $this->db->query('SELECT ms.message_id,ms.title,ms.image,ms.message,ms.student_id,ms.message_type,ms.message_like_total,ms.message_bookmark_total,ms.create_at,ms.update_at,mb.message_bookmark FROM message_details as ms INNER JOIN message_bookmark_users as mb on ms.message_id=mb.message_id  where mb.user_id='.$student_id.' '.$create_at1.'  ORDER BY ms.message_id DESC LIMIT 10');
					
				
					/*$this->db->select('*');    
					$this->db->from('message_details');
					$this->db->join('message_bookmark_users', 'message_details.message_id = message_bookmark_users.message_id');
					$this->db->where('message_bookmark_users.user_id',$student_id);
					$this->db->where('message_details.create_at',$create_at1);
					$this->db->order_by('message_id','DESC');
					$this->db->limit(10);*/
					//$query = $this->db->get();
				
					$messagelist = $query->result();

					if(!empty($messagelist))
					{

						$message_arr = array();

						foreach($messagelist as $message)
						{
							
							/*$messsagebookmark=$message->message_bookmark;
							
							if(!empty($messsagebookmark))
				    		{
				    			$bookmark_status=$messsagebookmark;
				    		}
				    		else
				    		{
				    			$bookmark_status = 0;
				    		} */
				    		
				    		
                            $check_bookmark = $this->common_model->common_getRow('message_bookmark_users',array('message_id'=>$message->message_id,'user_id'=>$student_id));
                            
                            if(!empty($check_bookmark))
                            {
                            $bookmark_status = $check_bookmark->message_bookmark;
                            }
                            else
                            {
                            $bookmark_status = 0;
                            }
				    		
				    		
				    		

							$check_message_status = $this->common_model->common_getRow('message_read_status',array('message_id'=>$message->message_id,'student_id'=>$student_id));

				    		if(!empty($check_message_status))
				    		{
				    			$read_status = $check_message_status->read_status;
				    		}
				    		else
				    		{
				    			$read_status = 0;
				    		}
				    		
				    		
				    	   $check_like_status = $this->common_model->common_getRow('massage_like_user',array('message_id'=>$message->message_id,'user_id'=>$student_id));

				    		if(!empty($check_like_status))
				    		{
				    			$read_status_like = $check_like_status->message_like;
				    		}
				    		else
				    		{
				    			$read_status_like = 0;
				    		}
							
						/*	$check_bookmark_status = $this->common_model->common_getRow('message_bookmark_users',array('message_id'=>$message->message_id,'user_id'=>$student_id));

				    		if(!empty($check_bookmark_status))
				    		{
				    			$bookmark_status = $check_bookmark_status->message_bookmark;
				    		}
				    		else
				    		{
				    			$bookmark_status = 0;
				    		} */
				    		
				    		
						    
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
						    		 				  'message_like_total'=>$message->message_like_total,
						    		 				 'message_bookmark_total'=>$message->message_bookmark_total,
						    		 				  'like_status'=>$read_status_like,
													 
													 'bookmark_status'=>$bookmark_status,
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


					$check_like_status = $this->common_model->common_getRow('massage_like_user',array('message_id'=>$message->message_id,'user_id'=>$student_id));

					if(!empty($check_like_status))
					{
						$read_status_like = $check_like_status->message_like;
					}
					else
					{
						$read_status_like = 0;
					}
					
					$check_bookmark_status = $this->common_model->common_getRow('message_bookmark_users',array('message_id'=>$message->message_id,'user_id'=>$student_id));

					if(!empty($check_bookmark_status))
					{
						$bookmark_status = $check_bookmark_status->message_bookmark;
					}
					else
					{
						$bookmark_status = 0;
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
											 'like_status'=>$read_status_like,
											 'bookmark_status'=>$bookmark_status,
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
        	$device_type = $this->input->post('device_type');
  
            $version_code = $this->input->post('version_code');	

            $get_version = $this->common_model->common_getRow('app_version',array('version_id'=>1));

	       if(($version_code < $get_version->android_min_version && $device_type == 'android') || ($version_code < $get_version->ios_min_version && $device_type == 'iOS'))
    	   {
		    	if($device_type == 'android')
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Google Play to download the latest version;'; 
		    	}
		    	else
		    	{
		    		$msg = 'This version of <b>ATMC</b> is became to obsolete. Please go to Play Store to download the latest version;';
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

	        		$message_arr = array(
			    						 'message_id'=>$description->message_id,
			    		                 'title'=>$description->title,
			    						 'message'=>$description->message,
			    						 'image'=>$image1,
			    						 'read_status'=>'0',
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

public function checktoken($token)
{
	$auth = $this->common_model->common_getRow('students',array('token'=>$token));

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

public function iOSPushNotification()
{
	$this->common_model1->iOSPushNotification1('8CD9AFEA09DADC6A987DEE57BAFF9B75E3DE61FA55BAF22C4B8A4C3A93EEA376','test','Testing','1','55');
}    

public function test_notification()
{
        $title = 'Testing';

       $d_type = 'device_';
       //$student_data = $this->common_model->getDataField('device_token,student_id,device_type,device_id','students',array('device_token !='=>$d_type,'device_token !='=>' ','device_type'=>'iOS'));

       $student_data =  $this->db->query("SELECT device_token,student_id,device_type,device_id FROM students WHERE device_token != device_id AND device_token != '' AND student_id IN('39','37',47)")->result();

        //$student_data =  $this->db->query("SELECT device_token,student_id,device_type FROM students WHERE device_token != '' AND device_id != device_token")->result();

        //echo '<pre>';
       // print_r($student_data);exit;

       // print_r($this->db->last_query());exit;


       //$student_data =  $this->db->query("SELECT device_token,student_id,device_type FROM students WHERE student_id IN('3','52')")->result();

    	$gcmRegIds = array();
    	$device_type = array();
    	$userid_arr = array();
		$i = 0;

		foreach($student_data as $user_device_token)
		{
		  $i++;

		  if($user_device_token->device_type == 'android')
		  {
		  	  $gcmRegIds_android[floor($i/1000)][] = $user_device_token->device_token;
		  }	
		  else if($user_device_token->device_type == 'iOS')
		  {
		  	  $gcmRegIds_ios[floor($i/1000)][] = $user_device_token->device_token;
		  }	
            $userid_arr[] = $user_device_token->student_id;
		}



          $pushMessage=array("title" =>$title,'message_id'=>1,"message" =>'Hii chandan this is testing','image'=>'',"type"=>'1',"currenttime"=>militime);

			/*if(isset($gcmRegIds_android)) 
			{ 
            	$message = $pushMessage;
            	$pushStatus = array();

            	$i=0;
            	foreach($gcmRegIds_android as $val)
            	{
            		$pushStatus[] = $this->common_model->sendNotification($val, $message);
                    $i++;   			
                }
 			}*/
 			//print_r($gcmRegIds_ios);exit;
 			

 		    	$msg = 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum';

 		    	//echo substr($msg, 0,150);exit;
 		    	//print_r($gcmRegIds_ios);exit;	
 		    	
 		    	if(isset($gcmRegIds_ios))
 		        { 
	 		    	$pushStatus1 = array();
	 		    	$i=0;
	 		    	foreach($gcmRegIds_ios as $val)
	            	{ 
	            	   $pushStatus1[] = $this->common_model->iOSPushNotification($val,substr($msg,0,100),$title,'1','1');
	                  $i++;   			
	                }
 		    	}
 		   	

 		     $user_id_in_comma = implode(",",$userid_arr);	

 		     print_r($user_id_in_comma); exit;	

	}

	
}
