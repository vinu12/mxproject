<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apinetwork extends CI_Controller {
function __construct() {
		parent::__construct();

		date_default_timezone_set('Australia/canberra'); 
		$militime =round(microtime(true) * 1000);
		$datetime =date('Y-m-d h:i:s');
		define('militime', $militime);
		define('datetime', $datetime);
		
	}
/*  

  dealslist
	
	
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



public function dealslist()
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
		 $create_at     = $this->input->post('create_at');  					
		if($create_at==0)
		{
			$create_at1= "WHERE status='active'";
		}else
		{
			$create_at1= "WHERE create_at < $create_at AND status='active'";
		}
		
		
			//echo "SELECT * FROM news ".$create_at1." ORDER BY id DESC LIMIT 10 ";
			
			$query = $this->db->query("SELECT * FROM advertise ".$create_at1." ORDER BY id DESC LIMIT 10 ");	
			
			
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
							   $adverimg = $basepath.'adminpanel/images/'.$photo;
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
							   $adverimg = $basepath.'adminpanel/images/'.$photo;
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
						
						
				   }	
			 }	
				
				
			if($userid !=''){
		        
		        $check_bookmark_status = $this->Common_model->common_getRow('newsbookmark',array('newsid'=>$check_record->id,'userid'=>$userid));
        		if($check_bookmark_status > 0){		
        		    
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
					  else
					  {
					   
					  }
					  if($ndata=='')
					  {
						   $nimage = '';
					  }
					
					
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
														
														'bookmarkstatus' => $bookmark_status,				
														'shareurl'        => $shareurl,
														'create_at'       =>$check_record->create_at,
														'type'            =>'News'
														
														
										            );
			 
						     $j++;	
						 }
			          }
		        

                                    $final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get news details';	
									$final_output['totalcount'] = $count;
									$final_output['data'] = $dataa_array;				
			    		
	    }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'failed';
				$final_output['message'] = 'Invalid user id please check again.';
				
			}
	       
	     
    }
	 
	  else
	    {
			$final_output['responseCode'] = '403';
            $final_output['status'] = 'false';
	        $final_output['message'] = 'You have logged in to some other device';
			
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
	


	

public function networkfollowing()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	$otherid = $this->input->post('otheruserid');
	
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
		 $check_records = $this->Common_model->getfollowers($otherid);
		 
		 if($check_records!=''){
			
			foreach($check_records as $valdata)
			{
				$uid = $valdata->userid;
				$fid = $valdata->followerid;
				
				    $create_at = $this->input->post('create_at');

					if($create_at==0)
					{
						$create_at1= "WHERE id=$fid AND status='1'";
					}else
					{
						$create_at1= "WHERE id=$fid AND create_at > $create_at AND status='1'";
					}

					//echo "SELECT * FROM `user_register` ".$create_at1." ORDER BY `id` DESC LIMIT 10";
					
					//die;
					$query = $this->db->query("SELECT * FROM `user_register` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
					//$query = $this->db->get();
					$check_followerslist = $query->result();
					$count = $query->num_rows();
					
		            if($count>0){			
					//print_r($check_followerslist);
				
						foreach($check_followerslist as $check_record)
							{
								
								 $uids = $check_record->id;
								 //$check_follow = $this->Common_model->common_getRow('userfollow',array('userid'=>$otherid));
								 
								 $followstatus = 0;
								 
								 $check_follow = $this->Common_model->common_getRow('userfollow',array('userid'=>$userid, 'followerid'=>$uids));
								
								 if($check_follow){ 
									 $followstatus = 1;
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
				  $final_output['message'] = 'Records not found';
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



public function networkfollower()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	$otherid = $this->input->post('otheruserid');
	
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
   
     		
		$check_records = $this->Common_model->getfollowing($otherid);
			
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
					
					$query = $this->db->query("SELECT * FROM `user_register` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
					//$query = $this->db->get();
					$check_followinglist = $query->result();
					 $count = $query->num_rows();
					
					if($count>0){
				
						  foreach($check_followinglist as $check_record)
							{
								
								 $uids = $check_record->id;
								 $followstatus = 0;
								 
								  $check_follow = $this->Common_model->common_getRow('userfollow',array('userid'=>$userid, 'followerid'=>$uids));
								
								 if($check_follow){ 
									 $followstatus = 1;
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
						$final_output['message'] = 'Followers List';
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


public function networkusernews()
{
	
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	$otherid = $this->input->post('otheruserid');
	
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
			
			/*$create_at = $this->input->post('create_at');
			if($create_at==0)
			{
				$create_at1= "WHERE userid='$otherid' AND status='active'";
			}else
			{
				$create_at1= "WHERE userid='$otherid' AND create_at < $create_at AND status='active'";
			}*/
			
			
	     $create_at = $this->input->post('create_at');  
		 $check_reports = $this->Common_model->getreports($userid);		 
		 if($check_reports!=''){
			
			foreach($check_reports as $reportdata)
			{
					if($create_at==0)
					{
						$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND btnews.userid='$otherid' AND status='active'";
					}else
					{
						$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND btnews.userid='$otherid' AND create_at < $create_at AND status='active'";
					}
					
				//}
				
			}	
		  }else{
			  
			        if($create_at==0)
					{
						$create_at1= "WHERE userid='$otherid' AND status='active'";
					}else
					{
						$create_at1= "WHERE userid='$otherid' AND create_at < $create_at AND status='active'";
					}
					
				}
			
			

			$query = $this->db->query("SELECT * FROM `btnews` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
			$check_records = $query->result();
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
						
						//$nuserid = $check_record->userid;
						
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
						  	   //$short = strip_tags($shortdes);                            
                               //$shortdescription = substr($short,0,200);
							   
							    $str = utf8_decode($shortdes);
                                $str = str_replace("&nbsp;", "", $str);
                                $str = preg_replace("/\s+/", " ", $str);
                                $str = strip_tags($str);
                                $str = htmlspecialchars_decode($str, ENT_QUOTES );
				
				 $dataa_array[]  = array(
														'id'=>$check_record->id,	
														'url'=>$check_record->slug,
														'title'=>$check_record->page_title,
														'description'=>$check_record->description,
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
														'type'   => 'blog'
														
														
										            );
													
			    }								
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'User Blog List';	
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





public function userviewlist()
{
	
	$this->load->model('Common_model');
	
	//$otheruserid = $this->input->post('otheruserid');	
	$userid      = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$basepath=base_url();		
	
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
							
							
							if($create_at==0)
							{
							
								$create_at1= "WHERE otheruserid = $userid AND status='1'";
								
							}else
							{
								$create_at1= "WHERE otheruserid = $userid AND create_at < $create_at AND status='1'";
								
							}
							$query = $this->db->query("SELECT * FROM userview ".$create_at1." ORDER BY id DESC LIMIT 10 ");				
							$getlist = $query->result();
							
							$count = $query->num_rows();
							
							
							
							if($count>0){
								
									foreach($getlist as $check_usersave)
										{
												
										     $otherid = $check_usersave->userid;
									
											
											$viewusers = $this->db->query("SELECT * FROM user_register WHERE id='".$otherid."' AND status=1");
											
											$view_user = $viewusers->result();
											
										    foreach($view_user as $viewuser)
										    {
												$authorname = $viewuser->user_name;
											    $useremail = $viewuser->user_email;
												$usermobile = $viewuser->user_mobile;
												
												$photo      = $viewuser->photo;
													
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
										
														
											$check_exp = $this->Common_model->common_getRow('experience',array('userid'=>$otherid, 'todate'=>'Present'));
											
											if($check_exp){
												$designation = $check_exp->designation;
												$companyname = $check_exp->companyname;
												$location = $check_exp->location;
											}else{
												$designation = '';
												$companyname = '';
												$location = '';
											}
											
											$followstatus=0;
											$querys = $this->db->query("SELECT * FROM `userfollow` where `userid`=$userid");					
											$check_followssss = $querys->result_array();
											
											$counts = $querys->num_rows();
											foreach($check_followssss as $data)
											{
										 
												$fid = $data['followerid'];
												if($fid==$otherid)
												{ 
												   $followstatus = 1;
												}
											}
											
										}
						            
											
											
											$dataa_array[]  = array(
																'id'=>$otherid,	
																'user_name'=>$authorname,
																'user_email'=>$useremail,
																'user_mobile'=>$usermobile,
																
																'user_photo'=>$uimage,
																
																'usercompany'     => $companyname,
																'userdesignation' => $designation,
																'userlocation'    => $location,
																
																'status'          => $followstatus,
																
																'date'       => $check_usersave->date,
																'create_at'  => $check_usersave->create_at,
																'update_at'  => $check_usersave->update_at,
																
															);
											
											
										}
								// }	
												
											//}
											
											$final_output['responseCode'] = '200';				
											$final_output['status'] = 'success';
											$final_output['message'] = 'Records found';	
											$final_output['data'] = $dataa_array;
									  	
							         }else{
											
											$final_output['responseCode'] = '404';
											$final_output['status'] = 'false';
											$final_output['message'] = 'Record not found';
										}
								
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



public function canceluser()
{
	
	$this->load->model('Common_model');
	
	$otheruserid = $this->input->post('otheruserid');	
	$userid      = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$basepath=base_url();		
	
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
					          $insert_array['userid']     =$userid;
							  $insert_array['otheruserid']=$otheruserid;
							  $insert_array['status']='1';
							  
							  $insertuser = $this->db->insert('userlistcancel', $insert_array);	
							  
							  if($insertuser){
								      $msg = "Cancel user";
									  $flag = '1';  
									  
							  }else{
								      $msg = "Not cancel user";
									  $flag = '0';  
							  }
							  
							$final_output['responseCode'] = '200';	
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



public function searchuserfollow()    //followers or following search
{
	
	$this->load->model('Common_model');
	
	$type = $this->input->post('type');
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
            
			        if($type=='userfollowing'){
						
						$searchkey = $this->input->post('searchkey');	    
						//$otherid = $this->input->post('otheruserid');
						
						//echo "SELECT * FROM `userfollow` where `userid`=$otherid" ;
						
						$checkquery = $this->db->query("SELECT * FROM `userfollow` where `userid`=$userid"); // following
						
					}
					if($type=='userfollower'){
						
						$searchkey = $this->input->post('searchkey');	    
						//$otherid = $this->input->post('otheruserid');
						
						//echo "SELECT * FROM `userfollow` where `followerid`=$otherid" ;
						
						$checkquery = $this->db->query("SELECT * FROM `userfollow` where `followerid`=$userid"); // follower
						
					}
			        					
					$check_otheruser = $checkquery->result();					
					$counts = $checkquery->num_rows();
					if($counts>0){
					foreach($check_otheruser as $check_records)
					{
						
						   if($type=='userfollowing'){
						
						      $uids = $check_records->followerid;
						
							}
							if($type=='userfollower'){
								
								$uids = $check_records->userid;
								
							}
				        
						
						 $check_record1 = $this->Common_model->search_networkfollow($uids, $searchkey);
						if(!empty($check_record1)){

						foreach($check_record1 as $check_record){	
				
												   
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
														'user_create_at'       => $check_record->create_at,
														'user_update_at'       => $check_record->update_at,
														
														
										            );
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get user follow';	
									$final_output['data'] = $dataa_array;
									
				
			         }	

					}	else{
						$final_output['responseCode'] = '402';
						$final_output['status'] = 'Failed';
						$final_output['message'] = 'Record not found';
						
					}				 
					 
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



public function searchnetworkfollow()    //followers or following search
{
	
	$this->load->model('Common_model');
	
	$type = $this->input->post('type');
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
            
			        if($type=='networkfollowing'){
						
						$searchkey = $this->input->post('searchkey');	    
						$otherid = $this->input->post('otheruserid');
						
						//echo "SELECT * FROM `userfollow` where `userid`=$otherid" ;
						
						$checkquery = $this->db->query("SELECT * FROM `userfollow` where `userid`=$otherid"); // following
						
					}
					if($type=='networkfollower'){
						
						$searchkey = $this->input->post('searchkey');	    
						$otherid = $this->input->post('otheruserid');
						
						//echo "SELECT * FROM `userfollow` where `followerid`=$otherid" ;
						
						$checkquery = $this->db->query("SELECT * FROM `userfollow` where `followerid`=$otherid"); // follower
						
					}
			        					
					$check_otheruser = $checkquery->result();					
					$counts = $checkquery->num_rows();
					if($counts>0){
					foreach($check_otheruser as $check_records)
					{
						
						   if($type=='networkfollowing'){
						
						      $uids = $check_records->followerid;
						
							}
							if($type=='networkfollower'){
								
								$uids = $check_records->userid;
								
							}
				        
						
						 $check_record1 = $this->Common_model->search_networkfollow($uids, $searchkey);
						if(!empty($check_record1)){

						foreach($check_record1 as $check_record){	
				
												   
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
														'user_create_at'       => $check_record->create_at,
														'user_update_at'       => $check_record->update_at,
														
														
										            );
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get network user follow';	
									$final_output['data'] = $dataa_array;
									
				
			         }	

					}	else{
						$final_output['responseCode'] = '402';
						$final_output['status'] = 'Failed';
						$final_output['message'] = 'Records not found';
						
					}				 
					 
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




public function userblog()
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
   
			/*$create_at = $this->input->post('create_at');

			if($create_at==0)
			{
				$create_at1= "WHERE (userid!='41') AND status='active'";
			}else
			{
				$create_at1= "WHERE (userid!='41') AND create_at < $create_at AND status='active'";
			}*/
			
			
			
			 $create_at = $this->input->post('create_at');  
			 $check_reports = $this->Common_model->getreports($userid);		 
			 if($check_reports!=''){
				
				foreach($check_reports as $reportdata)
				{
					//$userids = $reportdata->userid;
					//if($userids==$userid){
						
						if($create_at==0)
						{
							$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND btnews.userid!='41' AND status='active'";
						}else
						{
							$create_at1= "WHERE btnews.id not in (select btnews.id from btnews, report where btnews.id=report.newsid AND report.userid=$userid) AND btnews.userid!='41' AND create_at < $create_at AND status='active'";
						}
						
					//}
					
				}	
			  }else{
					
					if($create_at==0)
					{
						$create_at1= "WHERE userid!='41' AND status='active'";
					}else
					{
						$create_at1= "WHERE userid!='41' AND create_at < $create_at AND status='active'";
					}
					
				}
			

			$query = $this->db->query("SELECT * FROM `btnews` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
			$check_records = $query->result();
			$count = $query->num_rows();
			
			if($count!=''){
			 $j=1;	
			 foreach($check_records as $check_record)
			 {
				 
			  if($j==3 && $create_at==0){
		                
			   if($userid!="")
		       {
				   
				    /*$querys = $this->db->query("SELECT * FROM `userfollow` where `userid`=$userid");					
					$check_follows = $querys->result_array();					
					$countfollow = $querys->num_rows();
					
					if($countfollow>0){
						foreach($check_follows as $data)
						{
							$fid = $data['followerid'];
							
							$uquery = $this->db->query('SELECT * FROM `user_register` WHERE id!="'.$userid.'" AND id!="'.$fid.'" AND status="1" ORDER BY `id` DESC limit 10');
							
						}
					}else{
						$fid ='';
						
						$uquery = $this->db->query('SELECT * FROM `user_register` WHERE id!="'.$userid.'" AND id!="'.$fid.'" AND status="1" ORDER BY `id` DESC limit 10');
					}*/
					
					$uquery = $this->db->query("SELECT * FROM `user_register` WHERE user_register.id not in (select userfollow.followerid from userfollow, user_register where user_register.id!=userfollow.followerid AND userfollow.userid=$userid) AND user_register.id!=$userid AND user_register.status='1' ORDER BY user_register.id DESC LIMIT 10");
					
					$userrecords = $uquery->result();
					$totaluser = $uquery->num_rows();
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
			
						
						$check_exps = $this->Common_model->common_getRow('experience',array('userid'=>$uid));
						
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
				  }
					 
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
						
						$check_exps = $this->Common_model->common_getRow('experience',array('userid'=>$uid));
						
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
				
				
				
		    if($j==6 && $create_at==0){
		              
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
						
						
						
						//$joblist[]= array('jobid'=>$jid, 'companyname'=>$jcname, 'image'=>$jobphoto, 'jobtitle'=>$jtitle, 'jobaddress'=>$jaddress, 'timestamp'=>$dbDate); 
					
				  }
				  
				  $dataa_array[]=array('type'=>'job', 'job'=>$joblist);
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
							   //$short = strip_tags($shortdes);                            
                               //$shortdescription = substr($short,0,200);
							   
							    $str = utf8_decode($shortdes);
                                $str = str_replace("&nbsp;", "", $str);
                                $str = preg_replace("/\s+/", " ", $str);
                                $str = strip_tags($str);
                                $str = htmlspecialchars_decode($str, ENT_QUOTES );
							
				
				        $dataa_array[]  = array(
														'id'=>$check_record->id,	
														'url'=>$check_record->slug,
														'title'=>$check_record->page_title,
														'description'=>$check_record->description,
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

				$final_output['responseCode'] = '200';				
				$final_output['status'] = 'success';
				$final_output['message'] = 'Get blog list';	
				//$final_output['totalcount'] = $count;
				$final_output['data'] = $dataa_array;				
			    	
				
									
									
				
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






public function writeblog()
{
	$this->load->model('Common_model');
	
	$userid    = $this->input->post('id');	
	$username  = $this->input->post('user_name');
	$useremail = $this->input->post('user_email');
	
    $from = $username.' '.$useremail;
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	$basepath=base_url();
	
	
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$siteid      ='BT';
	
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
		   
					$title = $this->input->post('title');
					$slug  = strtolower(preg_replace('/[\W\s\/]+/', '-', $title));
					
					$description  = $this->input->post('description');
					$desc = htmlentities($description, ENT_QUOTES, "utf-8");
					
					$images = $this->input->post('image');
								
								
					if($images!='')
						{
							$data  = trim($images);
							$data = str_replace('data:image/png;base64,', '', $data);
							$data = str_replace(' ', '+', $data);
							
							$data1 = base64_decode($data); // base64 decoded image data
							
							$imgname = uniqid().'.png';
							$file_paths = "images/userimg/".$imgname;
							$file = 'adminpanel/images/userimg/'.$imgname;
							$success = file_put_contents($file, $data1);	
					    }else{
							
							$file_paths = "";
							
						}
					
					         $insert_array = array();
									  
							  $insert_array['sourcemedia']= $device_type;
							  $insert_array['siteid']     = $siteid;
							  $insert_array['sessionid']  = '';
							  $insert_array['userid']     = $userid;
							  $insert_array['slug']       = $slug;
							  $insert_array['page_title'] = $title;
							  $insert_array['description']= $desc;
							  
							  $insert_array['image']   = $file_paths;
							  $insert_array['video_link']   = '';
							  
							  $insert_array['author']  = $username;
							  $insert_array['seo_title']   = '';
							  $insert_array['seo_keywords']   = '';
							  $insert_array['seo_description']   = '';
							 
							  
							  $insert_array['priority']= '1';
							  $insert_array['nposition']   = 0;
							  
							  $insert_array['date']    = $created;
							  $insert_array['status']='inactive';
							  $insert_array['Position']   = 0;
							  $insert_array['click_count']   = 0;
							  $insert_array['readtime']   = '';
							  $insert_array['comments']   = 0;
							  $insert_array['likes']   = 0;
							  $insert_array['bookmark']   = 0;
							  $insert_array['ip_address']   = '';
							  
							  $insert_array['create_at']=militime;
							  $insert_array['update_at']=militime;
										
												 
						$insertId = $this->db->insert('btnews', $insert_array);
						
									   
						if($insertId)
						{		
						$message="Hi Team,<br><br>
								  <h4>Please Verified Story/Article.</h4><br><br>
								  <table>
									<tr>
									  <td>Website Link</td> <td><a href='http://www.beyondteaching.com/adminpanel/' target='_blank'>Beyond Teaching Dashboard</a></td>
									</tr> 
									<tr>
									  <td>Username</td> <td>admin</td>
									</tr> 
									<tr>
									  <td>Password</td> <td>admin</td>
									</tr> 						
								  </table>
								  <br><br>";
					  
									$to       = "beyondteachingglobal@gmail.com";			
									$subject  = "User's Blog";
									$headers  = "MIME-Version: 1.0" . "\r\n";
									$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
									
									$headers .= 'From: "'.$from.'" '. "\r\n";
									$headers .= 'cc: sgupta@atmc.edu.au' . "\r\n";
									
									$mail_sent = mail($to, $subject, $message, $headers);
									
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Blog post request has been sent to Beyond Teaching Team successfully. Your blog will be reviewed and posted within 24 hours.';	
													
											
						
							}else
							{ 
									$final_output['responseCode'] = '402';				
									$final_output['status'] = 'Failed';
									$final_output['message'] = 'Your Blog is not post.';
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






public function newsreport()
{
	
	$this->load->model('Common_model');
	
	$newsid = $this->input->post('newsid');	
	$userid      = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
	$basepath=base_url();		
	
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
					          $insert_array['userid'] =$userid;
							  $insert_array['newsid'] =$newsid;
							  
							  $insertuser = $this->db->insert('report', $insert_array);	
							  
							  if($insertuser){
								      $msg = "Hide news";
									  $flag = '1';  
									  
							  }else{
								      $msg = "Not hide news";
									  $flag = '0';  
							  }
							  
							$final_output['responseCode'] = '200';	
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







public function joblist()
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
   
			$create_at = $this->input->post('create_at');

			if($create_at==0)
			{
				$create_at1= "WHERE status=1";
			}else
			{
				$create_at1= "WHERE create_at < $create_at AND status=1";
			}
			
			//echo "SELECT * FROM `job` ".$create_at1." ORDER BY `id` DESC LIMIT 10";

			$query = $this->db->query("SELECT * FROM `job` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
			$check_records = $query->result();
		    $count = $query->num_rows();
			
			if($count>0){
			 $j=1;	
			 foreach($check_records as $check_record)
			 {
				 
			  if(($j==5) && ($create_at==0)){
		                
			   if($userid!="")
		       {
				   
				    /*$querys = $this->db->query("SELECT * FROM `userfollow` where `userid`=$userid");					
					$check_follows = $querys->result_array();					
					$countfollow = $querys->num_rows();
					
					if($countfollow>0){
						foreach($check_follows as $data)
						{
							$fid = $data['followerid'];
							
							$uquery = $this->db->query('SELECT * FROM `user_register` WHERE id!="'.$userid.'" AND id!="'.$fid.'" AND status="1" ORDER BY `id` DESC limit 10');
							
						}
					}else{
						$fid ='';
						
						$uquery = $this->db->query('SELECT * FROM `user_register` WHERE id!="'.$userid.'" AND id!="'.$fid.'" AND status="1" ORDER BY `id` DESC limit 10');
					}*/
				   
				   $uquery = $this->db->query("SELECT * FROM `user_register` WHERE user_register.id not in (select userfollow.followerid from userfollow, user_register where user_register.id!=userfollow.followerid AND userfollow.userid=$userid) AND user_register.id!=$userid AND user_register.status='1' ORDER BY user_register.id DESC LIMIT 10");
					
					$userrecords = $uquery->result();
					$totaluser = $uquery->num_rows();
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
			
						
						$check_exps = $this->Common_model->common_getRow('experience',array('userid'=>$uid));
						
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
				  }
					 
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
						
						
						$check_exps = $this->Common_model->common_getRow('experience',array('userid'=>$uid));
						
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
				
				
				    $jobid = $check_record->id;
				   
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
				
				   $jobphoto = $check_record->image;
					
					if($jobphoto=='')  {
					   $jobphoto = '';
					}else{
					   $jobphoto    = $basepath."adminpanel/images/job/".$jobphoto;
					}
					
					
					 $jdate = $check_record->datetime;
					 $timestampdate = strtotime($jdate);
					 
					 
					          $shortdes = $check_record->jobdescription;
							    $jstr = utf8_decode($shortdes);
                				$jstr = str_replace("&nbsp;", "", $jstr);
                				$jstr = preg_replace("/\s+/", " ", $jstr);
                				$jstr = strip_tags($jstr);
                				$jstr = htmlspecialchars_decode($jstr, ENT_QUOTES); 
				
				        $dataa_array[]  = array(
														'jobid'          => $check_record->id,
														'image'          => $jobphoto,
														'companyname'    =>$check_record->companyname,
														'companyprofile' =>$check_record->companyprofile,
														'jobaddress'     =>$check_record->address,
														'jobtitle'       =>$check_record->jobtitle,
														'email'       =>$check_record->email,
														'description'    =>$check_record->jobdescription,
														'shortdescription'=>$jstr,
														'jobtype'        =>$check_record->jobtype,
														
														'keyskill'       =>$check_record->keyskill,
														'jobview'        =>$check_record->jobview,	
														'userid'         =>$check_record->userid,	
														
														'isJobApplied' =>$jobapplied,
														'isBookmarked' =>$savejob,
														
														'timestamp'    => $timestampdate,
														'create_at'    =>$check_record->create_at,
														'type'         =>'job'
														
										            );
			 
			 $j++;	
			 }

						$final_output['responseCode'] = '200';				
						$final_output['status'] = 'success';
						$final_output['message'] = 'Get job list';	
						$final_output['totalcount'] = $count;
						$final_output['data'] = $dataa_array;				
			    	
				
			  }
			  
			else{
				$final_output['responseCode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Record not found';
				
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



public function savejob()
{
	
	$this->load->model('Common_model');
	
	$jobid = $this->input->post('jobid');	
	$userid = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
		
	
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
				$insert_array = array();
				
			
							if(!empty($jobid))
							{  				
								$check_jobsave = $this->Common_model->common_getRow('savejob',array('savejobid'=>$jobid,'userid'=>$userid));
								if(!empty($check_jobsave))
								{
									
									 $deletejob = $this->Common_model->deleteData('savejob', array('savejobid' => $jobid, 'userid' => $userid));
									  //$query = $this->Common_model->updatedeletejob($jobid);
									  
									  if($deletejob){
										  $msg = "Job has been unbookmarked successfully";
										  $flag = 0;
									  }
								}
								else
								{
									      $insert_array['savejobid']=$jobid;
										  $insert_array['userid']=$userid;	
										  $insert_array['applyjobid']='';
										  $insert_array['create_at']=militime;	
										  $insert_array['update_at']=militime;
										  
										  $insertId = $this->db->insert('savejob', $insert_array);
										  //$query = $this->Common_model->updatebookmark($jobid);
										
										  if($insertId){
											  $msg = "Job has been bookmarked successfully.";
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
									$final_output['message'] = 'Please send jobid';
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




public function applyjob()
{
	
	$this->load->model('Common_model');
	
	$jobid = $this->input->post('jobid');	
	$userid = $this->input->post('id');
	
	$device_token = $this->input->post('device_token');
	$device_id = $this->input->post('device_id');
	$device_type = $this->input->post('device_type');
	
	$created = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	$status=1;
		
	
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
				$insert_array = array();
				
				$getuser = $this->Common_model->common_getRow('user_register',array('id'=>$userid));								
				if($getuser){
					$uname = $getuser->user_name;
					$email = $getuser->user_email;
				}
			
							if(!empty($jobid))
							{  				
								$check_applyjob = $this->Common_model->common_getRow('savejob',array('applyjobid'=>$jobid,'userid'=>$userid));
								if(!empty($check_applyjob))
								{
									$msg = "Already Applied.";
									$flag = 1;
									 
								}
								else
								{
								    
								          $applyjob_title = $this->Common_model->common_getRow('job',array('id'=>$jobid));
										  $jobtitle = $applyjob_title->jobtitle;
										  
									      $insert_array['applyjobid']=$jobid;
										  $insert_array['userid']=$userid;	
										  $insert_array['savejobid']='';
										  $insert_array['create_at']=militime;	
										  $insert_array['update_at']=militime;
										  
										  $insertId = $this->db->insert('savejob', $insert_array);
										  //$query = $this->Common_model->updatebookmark($jobid);
										
										  /*if($insertId){
											  
											  $message = "Hi Beyond Teaching Team,<br><br>
												<h4>I wish to apply for the position of <b>$jobtitle</b>. Hope to hear from you soon!</h4><br><br>
												<table>
												<tr>
												<td></td>
												</tr> 

												</table>
												<br><br>";

												
											    $to = 'jobs@beyondteaching.com';
												$subject = "Applied Job";
												$headers = "MIME-Version: 1.0" . "\r\n";
												$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
												$headers .= "From: $email" . "\r\n";

												$mail_sent = mail($to, $subject, $message, $headers);
											  
											  $msg = "Thank You for applying via Beyond Teaching. We will look into your profile to continue with the application process.";
											  $flag = 1;
										  }*/
										  
										  $msg = "Thank You for applying via Beyond Teaching. We will look into your profile to continue with the application process.";
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
									$final_output['message'] = 'Please send jobid';
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





public function viewmorejob()
{

	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');
	$jobid = $this->input->post('jobid');
	$jobtitle = $this->input->post('jobtitle');
	
	
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
		$check_key = $this->checktoken($headers['Secret-Key'],$userid);
		
	if($check_key['status'] == 'true')
        { 
	
	
	
    if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
    { 
        $device_token = '';
    }

   
    $auth_key = $this->rand_string(40);

    $final_output = array();

    if(!empty($jobtitle))
    {  
   
			$create_at = $this->input->post('create_at');
			
			$aKeyword = explode(" ", $jobtitle);
              
			if($create_at==0)
			{
				 //$create_at1= "WHERE id!=$jobid AND jobtitle like '%" . $jobtitle . "%' AND status='1'";
				
				
				 $create_at1 ="WHERE id!=$jobid AND status='1' AND (jobtitle like '%" . $aKeyword[0] . "%'";
      
                 for($i = 1; $i < count($aKeyword); $i++) {
                    if(!empty($aKeyword[$i])) {
                        $create_at1 .= " OR jobtitle like '%" . $aKeyword[$i] . "%'";
                    }
                    
                  }
                   $create_at1 .= " )";
				
				
			}else
			{
				//$create_at1= "WHERE id!=$jobid AND jobtitle like '%" . $jobtitle . "%' AND create_at < $create_at AND status='1'";
				
			  	$create_at1 ="WHERE id!=$jobid AND create_at < $create_at AND status='1' AND (jobtitle like '%" . $aKeyword[0] . "%'";
      
                for($i = 1; $i < count($aKeyword); $i++) {
                    if(!empty($aKeyword[$i])) {
                        $create_at1 .= " OR jobtitle like '%" . $aKeyword[$i] . "%'";
                    }
                    
                  }
                  $create_at1 .= " )";
			}
			
		
			$query = $this->db->query("SELECT * FROM `job` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
			$check_records = $query->result();
			$count = $query->num_rows();
			
			if($count>0){
			
			//if($check_records!=''){	
			 foreach($check_records as $check_record)
			 {
				
				$basepath=base_url();
				
				$jobphoto = $check_record->image;
									
				if($jobphoto=='')  {
				   $jobphoto = '';
				}else{
				   $jobphoto    = $basepath."adminpanel/images/job/".$jobphoto;
				}
				
				 $jdate = $check_record->datetime;
				 $timestampdate = strtotime($jdate);
				
					
				$shortdes = $check_record->jobdescription;
				$jstr = utf8_decode($shortdes);
				$jstr = str_replace("&nbsp;", "", $jstr);
				$jstr = preg_replace("/\s+/", " ", $jstr);
				$jstr = strip_tags($jstr);
				$jstr = htmlspecialchars_decode($jstr, ENT_QUOTES); 	
					
				 $dataa_array[]  = array(
											'jobid'          => $check_record->id,
											'image'       => $jobphoto,
											'companyname' =>$check_record->companyname,
											'companyprofile' =>$check_record->companyprofile,
											'jobaddress'     =>$check_record->address,
											'jobtitle'       =>$check_record->jobtitle,
											'email'          =>$check_record->email,
											'description' =>$check_record->jobdescription,
											'shortdescription'=>$jstr,
											'jobtype'     =>$check_record->jobtype,
											
											'keyskill'     =>$check_record->keyskill,
											'jobview'      =>$check_record->jobview,	
											'userid'       =>$check_record->userid,	
											'timestamp' => $timestampdate,
											'create_at'    =>$check_record->create_at,
											'type'         =>'job'			
											
										);
													
			        }								
									$final_output['responseCode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'Get related job';	
									$final_output['data'] = $dataa_array;
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
	        $final_output['message'] = 'Please send job id';
			
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


	
}
