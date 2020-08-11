<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apideals extends CI_Controller {
function __construct() {
		parent::__construct();

		date_default_timezone_set('Australia/canberra'); 
		$militime =round(microtime(true) * 1000);
		$datetime =date('Y-m-d h:i:s');
		define('militime', $militime);
		define('datetime', $datetime);
		
	}
/*  
  getnotificationlist
  savenotificationsetting
  dealslist
  dealsdetails	
  dealsearch     //location or deals
  
  notificationlist
  deletenotification
	
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
	
	
	function unicodeString($str, $encoding=null) {
    if (is_null($encoding)) $encoding = ini_get('mbstring.internal_encoding');
    return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/u', create_function('$match', 'return mb_convert_encoding(pack("H*", $match[1]), '.var_export($encoding, true).', "UTF-16BE");'), $str);
    }

	
public function getnotificationlist()
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
            $check_records = $this->Common_model->common_getRow('user_register',array('id'=>$userid));
            	
			if($check_records!=''){
				
				    $notiflag = $check_records->notificationsetting;		
					$explode = (explode(",",$notiflag));
					
					foreach($explode as $key=>$expl){
						
						$arr[]=array($expl);
					}
					
					
					$notification = $this->db->query("SELECT * FROM category WHERE Level='0' AND status='active'");				   
					$notirecords = $notification->result();
					$totalnoti   = $notification->num_rows();	
					
					if($totalnoti>0)
					 {
						foreach($notirecords as $list){
						   
						     $catid  = $list->cat_id;
							 $catname  = $list->Category;
							 
							 if(in_array($catid, $explode)){        		 
        		                   $notistatus = '1';
							 }else{
								    $notistatus = '0';
							 
							  }
							  
						  if ($catid=='1') {
                                $dataa_array[] = array('id'=>$catid, 'title'=>$catname, 'subtitle'=>'News Notifications will be On/Off', 'status'=>$notistatus);
						    }
							
							elseif ($catid== '14') {
                                $dataa_array[] = array('id'=>$catid, 'title'=>$catname, 'subtitle'=>'Deals Notifications will be On/Off', 'status'=>$notistatus);
                             } 
                        } 
						
						//$dataa_array=array('category'=>$rowarray);
						
					 }
					 else{
							$final_output['responsecode'] = '402';
							$final_output['status'] = 'failed';
							$final_output['message'] = 'Record not found';							
						}
					 
				   }else{
					   
					        $notification = $this->db->query("SELECT * FROM category WHERE Level='0' AND status='active'");				   
							$notirecords = $notification->result();
							$totalnoti   = $notification->num_rows();	
							
							if($totalnoti>0)
							 {
								foreach($notirecords as $list){
								   
									 $catid  = $list->cat_id;
									 $catname  = $list->Category;														
									 $notistatus='1';
									  
								  if ($catid=='1') {
										$dataa_array[] = array('id'=>$catid, 'title'=>$catname, 'subtitle'=>'News Notifications will be On/Off', 'status'=>$notistatus);
									}
									
									elseif ($catid== '14') {
										$dataa_array[] = array('id'=>$catid, 'title'=>$catname, 'subtitle'=>'Deals Notifications will be On/Off', 'status'=>$notistatus);
									 } 
								} 
								
								//$dataa_array=array('category'=>$rowarray);
								
								
								
							 }
							 else{
									$final_output['responsecode'] = '402';
									$final_output['status'] = 'failed';
									$final_output['message'] = 'Record not found';							
								}
					   
					   
				   }
				   
				   
				    $final_output['responsecode'] = '200';				
					$final_output['status'] = 'success';
					$final_output['data'] = $dataa_array;
					
					
				
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




public function savenotificationsetting()
{
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');	
	$catid  = $this->input->post('catid');	
	
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
				   if($catid!=''){
													
						$updatecat = $this->Common_model->updatenotification($userid, $catid);				
						$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid, 'status'=>'1'));
						
						$uids        = $check_record->id;
						$notisetting = $check_record->notificationsetting;
						
						
						 $dataa_array  = array(
												'id'       => $check_record->id,	
												'category' => $check_record->notificationsetting
												
												);

				      }else{
						  
						    $updatecat = $this->Common_model->updatenotification($userid, $catid);				
							$check_record = $this->Common_model->common_getRow('user_register', array('id'=>$userid, 'status'=>'1'));
							
							$uids        = $check_record->id;
							$notisetting = $check_record->notificationsetting;
							
							
							 $dataa_array  = array(
												'id'       => $check_record->id,	
												'category' => $check_record->notificationsetting
												
												);
						  

					  }					  
					    $final_output['responsecode'] = '200';				
						$final_output['status'] = 'success';
						$final_output['message'] = 'Notification Settings has been saved successfully';	
						$final_output['data'] = $dataa_array;	   
							
				}
	 
			  else
				{
					$final_output['responsecode'] = '403';
					$final_output['status'] = 'false';
					$final_output['message'] = 'Send user id';
					
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
		
		   if($create_at==0){
					
			$advquery = $this->db->query("SELECT * FROM advertise WHERE status='active' ORDER BY id DESC LIMIT 2 ");
			$check_records = $advquery->result();
			$count = $advquery->num_rows();
			
			if($count>0){
			  $i=0;
			  $st=0;
			  $lt=6;
			 foreach($check_records as $check_record)
			   {
				       $fromdates = $check_record->fromdate;
					   $todates   = $check_record->todate;
					   
					   if(($fromdates <= $curdates) && ($todates >= $curdates)){
											
						        $photo          = $check_record->image;						
								$adverimg = $basepath.'adminpanel/'.$photo;
							
						}else{
							
							   $adverimg = $basepath."adminpanel/images/advertise.jpg";
						}
						
				
				        $dataa_array[]  = array(
												'id'             => $check_record->id,	
												'advertisename'  => $check_record->page_title,
												'advertisefrom'  => $check_record->fromdate,
												'advertiseto'    => $check_record->todate,
												'advertiseimg'   => $adverimg,
												'advertiseauthor'=> $check_record->author,
												'advertiseemail' => $check_record->email,
												'advertisecontact' => $check_record->contact,
												'advertiseaddress' => $check_record->address,
												'type'=>'advertise'
												
											);
				 
				        if(($i<2) && ($create_at==0)){
					                $final_output['responsecode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'advertise';
									$final_output['data'] = $dataa_array;
				               }
				             $i++;	
				 
			  if($i%2==0){
		                
			   if($userid!="" || $userid=="")
		       {
				   
				    if($create_at==0)
					{
						$create_at1= "WHERE status='active' ORDER BY `id` DESC limit 0,6";
					}else
					{
						$create_at1= "WHERE create_at < $create_at AND status='active' ORDER BY `id` DESC limit 10";
					}
				   
				    $dealsquery = $this->db->query("SELECT * FROM `deals` ".$create_at1."");
				   
					$dealsrecords = $dealsquery->result();
					$totaldeals   = $dealsquery->num_rows();	
					
					if($totaldeals>0)
					 {
						foreach($dealsrecords as $dealsdetails){
						
						$dealsid        = $dealsdetails->id;
						$dealsname      = $dealsdetails->offername;
						
						$dealsdiscount  = $dealsdetails->discount;
						$actualprice    = $dealsdetails->actualprice;
						if($dealsdiscount!=''){
							$saveprice  = ($actualprice*$dealsdiscount)/100;
                            $totalprice = $actualprice-$saveprice;
						}else{
							
							$saveprice  = '';
                            $totalprice = '';
							
						}
						
						$photo          = $dealsdetails->image;
						
						$data=parse_url($photo, PHP_URL_SCHEME);
						if($data=='http' || $data=='https')
						  {
							  $dealsimg = $photo;
						  }
						  else if($data!='http' || $data!='https'){
							   $dealsimg = $basepath.'adminpanel/'.$photo;
						  }
						  else
						  {
						   
						  }
						  if($photo=='')
						  {
							   $dealsimg = $basepath."adminpanel/images/advertise.jpg";
						  }
						  
						  $dealerid   = $dealsdetails->dealsid;
						  $todate     = $dealsdetails->todate;
						  $createat     = $dealsdetails->create_at;
						  
						$dealslist[]= array('id'=>$dealsid, 'image'=>$dealsimg, 'dealsname'=>$dealsname, 'discount'=>$dealsdiscount, 'price'=>$actualprice, 'saveprice'=>$saveprice, 'totalprice'=>$totalprice, 'dealerid'=>$dealerid, 'validdate'=>$todate, 'create_at'=>$createat);
					}
					   $dataa_array[]=array('type'=>'deals', 'deals'=>$dealslist);
				 
				    
				 }else{
					    $dataa_array=array();
				   }
				   
				     $st+=6; 
                     $lt+=6;
				   
				}else{
					    
					//echo "SELECT * FROM `deals` WHERE status='active' ORDER BY `m_clicked` DESC limit 0,6";	
						
				    $dealsquery = $this->db->query("SELECT * FROM `deals` WHERE status='active' ORDER BY `m_clicked` DESC limit 0,6");
				   
					$dealsrecords = $dealsquery->result();
					$totaldeals   = $dealsquery->num_rows();	
					
					if($totaldeals>0)
					 {
						foreach($dealsrecords as $dealsdetails){
						
						$dealsid        = $dealsdetails->id;
						$dealsname      = $dealsdetails->offername;
						$dealsdiscount  = $dealsdetails->discount;
						$actualprice    = $dealsdetails->actualprice;
						
                        $saveprice  = ($actualprice*$dealsdiscount)/100;
                        $totalprice = $actualprice-$saveprice;
						
						$photo          = $dealsdetails->image;
						
						$data=parse_url($photo, PHP_URL_SCHEME);
						if($data=='http' || $data=='https')
						  {
							  $dealsimg = $photo;
						  }
						  else if($data!='http' || $data!='https'){
							   $dealsimg = $basepath.'adminpanel/'.$photo;
						  }
						  else
						  {
						   
						  }
						  if($photo=='')
						  {
							   $dealsimg = $basepath."adminpanel/images/advertise.jpg";
						  }
						  
						  $dealerid   = $dealsdetails->dealsid;
						  $todate     = $dealsdetails->todate;
						  
						  $createat    = $dealsdetails->create_at;
						  
						$dealslist[]= array('id'=>$dealsid, 'image'=>$dealsimg, 'dealsname'=>$dealsname, 'discount'=>$dealsdiscount, 'price'=>$actualprice, 'saveprice'=>$saveprice, 'totalprice'=>$totalprice, 'dealerid'=>$dealerid, 'validdate'=>$todate, 'create_at'=>$createat);
					}
					   $dataa_array[]=array('type'=>'deals', 'deals'=>$dealslist);
				 
				       
					 
				    }else{
					    $dataa_array=array();
				        }
						
						$st+=6; 
                        $lt+=6;
						
				   }	
			    }
        


                   if(($i==2) && ($create_at==0)){
						   $i;
					   $bannerquery = $this->db->query("SELECT * FROM advertise WHERE status='active' ORDER BY id DESC LIMIT 2,$count");
			           $check_banner = $bannerquery->result();	   
					
					   foreach($check_banner as $banner_record)
			            {
							   $fromdates = $banner_record->fromdate;
							   $todates   = $banner_record->todate;
							   
							   if(($fromdates <= $curdates) && ($todates >= $curdates)){
													
										$photo          = $banner_record->image;						
										$bannerimg = $basepath.'adminpanel/'.$photo;
									
								}else{
									
									   $bannerimg = $basepath."adminpanel/images/advertise.jpg";
								}
						
								$bannerlist[]  = array('id'=>$banner_record->id, 'bannername'=>$banner_record->page_title, 'bannerfrom'=> $banner_record->fromdate, 'bannerto'=> $banner_record->todate, 'banneimg'=> $bannerimg, 'bannerauthor'=>$banner_record->author, 'banneremail'=>$banner_record->email, 'bannercontact'=> $banner_record->contact, 'banneraddress'=>$banner_record->address);
						    }
							$dataa_array[]=array('type'=>'banner', 'banner'=>$bannerlist);
							
						 
						 
						        $final_output['responsecode'] = '200';				
								$final_output['status'] = 'success';
								$final_output['message'] = 'Deal list';
								$final_output['data'] = $dataa_array;
				          }
						  
						  else{
								$final_output['responsecode'] = '402';
								$final_output['status'] = 'failed';
								$final_output['message'] = 'Record not found';
								
							}
						  
						  
						  
						 
			          }
	           }
			  
			else{
				$final_output['responsecode'] = '402';
				$final_output['status'] = 'failed';
				$final_output['message'] = 'Record not found';
				
			}
			
	    }else{

				    $create_at1= "WHERE create_at < $create_at AND status='active' ORDER BY `id` DESC limit 10";
				   
				    $dealsquery = $this->db->query("SELECT * FROM `deals` ".$create_at1."");
				   
					$dealsrecords = $dealsquery->result();
					$totaldeals   = $dealsquery->num_rows();	
					
					if($totaldeals>0)
					 {
						foreach($dealsrecords as $dealsdetails){
						
						$dealsid        = $dealsdetails->id;
						$dealsname      = $dealsdetails->offername;
						
						$dealsdiscount  = $dealsdetails->discount;
						$actualprice    = $dealsdetails->actualprice;
						if($dealsdiscount!=''){
							$saveprice  = ($actualprice*$dealsdiscount)/100;
                            $totalprice = $actualprice-$saveprice;
						}else{
							
							$saveprice  = '';
                            $totalprice = '';
							
						}
						
						$photo          = $dealsdetails->image;
						
						$data=parse_url($photo, PHP_URL_SCHEME);
						if($data=='http' || $data=='https')
						  {
							  $dealsimg = $photo;
						  }
						  else if($data!='http' || $data!='https'){
							   $dealsimg = $basepath.'adminpanel/'.$photo;
						  }
						  else
						  {
						   
						  }
						  if($photo=='')
						  {
							   $dealsimg = $basepath."adminpanel/images/advertise.jpg";
						  }
						  
						  $dealerid   = $dealsdetails->dealsid;
						  $todate     = $dealsdetails->todate;
						  $createat     = $dealsdetails->create_at;
						  
						$dealslist[]= array('id'=>$dealsid, 'image'=>$dealsimg, 'dealsname'=>$dealsname, 'discount'=>$dealsdiscount, 'price'=>$actualprice, 'saveprice'=>$saveprice, 'totalprice'=>$totalprice, 'dealerid'=>$dealerid, 'validdate'=>$todate, 'create_at'=>$createat);
					}
					   $dataa_array[]=array('type'=>'deals', 'deals'=>$dealslist);
					   
					    $final_output['responsecode'] = '200';				
						$final_output['status'] = 'success';
						$final_output['message'] = 'Deal list';
						$final_output['data'] = $dataa_array;
				 
				    
				 }else{
					    $final_output['responsecode'] = '402';
						$final_output['status'] = 'failed';
						$final_output['message'] = 'Record not found';
				   }
				   
				    
				   

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
	
	
	
public function dealsdetails()
{
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');	
	$dealerid = $this->input->post('dealerid');	
	
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
		
		    $check_record = $this->Common_model->common_getRow('deals',array('id'=>$dealerid, 'status'=>'active'));
			
			if($check_record){
			  
			           $sid = $check_record->id;
					   $slug = $check_record->slug;
				       $image = $check_record->image;
					    if($image !=''){
																	
							$shopimgnamme = $basepath.'adminpanel/'.$image;
							
						}else{
							
							 $shopimgnamme = $basepath."adminpanel/images/advertise.jpg";
						}
						
						$about = $check_record->about;
						
						$str1 = strip_tags($about);
						$str = $this->unicodeString($str1);
						$fulldesc = html_entity_decode($str, ENT_QUOTES);
						
						
				        $shareurl = $basepath.$slug."/".$sid;
				        $dataa_array  = array(
												'id'                 => $check_record->id,	
												'shopname'           => $check_record->name,
												'shopcontactperson'  => $check_record->contactperson,
												'shopemail'          => $check_record->email,
												'shopimg'            => $shopimgnamme,
												'shopcontact'        => $check_record->contact,
												'shopaddress'        => $check_record->address,
												'shopabout'          => $fulldesc,
												'shareurl'           => $shareurl
												
											);
				 
				        
					                $final_output['responsecode'] = '200';				
									$final_output['status'] = 'success';
									$final_output['message'] = 'shop details';
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
	

	
public function dealsearch()
{
	
	$this->load->model('Common_model');
	
	$userid        = $this->input->post('id');	
    $searchtype    = $this->input->post('searchtype');	//location or deals
	
	$device_token  = $this->input->post('device_token');
	$device_id     = $this->input->post('device_id');
	$device_type   = $this->input->post('device_type');
		
	
	$created  = date('Y-m-d h:m:s');
	$modified = date('Y-m-d h:m:s');
	
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
				
				if(!empty($searchtype))
				{  
   
     		       $create_at = $this->input->post('create_at');	

                   if($searchtype=='location'){
					   
					    $latitude       = trim($this->input->post('latitude'));
					    $longitude      = trim($this->input->post('longitude'));
					  // $searchlocation = $this->input->post('searchlocation');
					   //$objlocation = $this->getlatlang($locations);
					   //$latitude    = $objlocation->lat;  
                       //$longitude   = $objlocation->lng;
					   
					  if($latitude!='' && $longitude!=''){
						   $range  = 63; //earth's radius in 63 miles 101km

						   $lat_range = $range/69.172;  
						   $lon_range = abs($range/(cos($latitude) * 69.172));  
						   $min_lat = number_format($latitude - $lat_range, "7", ".", "");  
						   $max_lat = number_format($latitude + $lat_range, "7", ".", "");  
						   $min_lon = number_format($longitude - $lon_range, "7", ".", "");  
						   $max_lon = number_format($longitude + $lon_range, "7", ".", "");
				       }else{
							$searchlocation      = $this->input->post('searchlocation');
					   }					   
						 
					   
					   if($create_at==0)
						{
							//$create_at1= "WHERE `address` LIKE '%$searchlocation%' OR (`latitude`=$latitude between `longitude`=$longitude) AND status='active'";
							
							
							$create_at1= "WHERE (latitude BETWEEN '".$min_lat."' AND '".$max_lat."' AND longitude BETWEEN '".$min_lon."' AND '".$max_lon."') AND latitude!='' AND longitude!='' AND actualprice!='' AND status='active'";
							
						}else
						{
							$create_at1= "WHERE (latitude BETWEEN '".$min_lat."' AND '".$max_lat."' AND longitude BETWEEN '".$min_lon."' AND '".$max_lon."') AND latitude!='' AND longitude!='' AND create_at < $create_at AND actualprice!='' AND status='active'";
							
							//$create_at1= "WHERE `address` LIKE '%$searchlocation%' OR (`latitude`=$latitude AND `longitude`=$longitude) AND create_at < $create_at AND status='active'";
						}
					   
				   }else{
					   $searchdeal    = $this->input->post('searchdeal');
					   if($create_at==0)
						{
							$create_at1= "WHERE `offername` LIKE '%$searchdeal%' AND actualprice!='' AND status='active'";
						}else
						{
							$create_at1= "WHERE `offername` LIKE '%$searchdeal%' AND actualprice!='' AND create_at < $create_at AND status='active'";
						}
				   }

				   
				   //echo "SELECT * FROM `deals` ".$create_at1." ORDER BY `id` DESC LIMIT 10";
				
				$query = $this->db->query("SELECT * FROM `deals` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
				$check_record1 = $query->result();
				$count = $query->num_rows();
				
				if($count!=''){
					
					foreach($check_record1 as $dealsdetails){	
						        $basepath=base_url();
						
								$dealsid        = $dealsdetails->id;
								$dealsname      = $dealsdetails->offername;
								$dealsdiscount  = $dealsdetails->discount;
								$actualprice    = $dealsdetails->actualprice;
								
								$saveprice  = ($actualprice*$dealsdiscount)/100;
								$totalprice = $actualprice-$saveprice;
								
								$photo          = $dealsdetails->image;
								
								$data=parse_url($photo, PHP_URL_SCHEME);
								if($data=='http' || $data=='https')
								  {
									  $dealsimg = $photo;
								  }
								  else if($data!='http' || $data!='https'){
									   $dealsimg = $basepath.'adminpanel/'.$photo;
								  }
								  else
								  {
								   
								  }
								  if($photo=='')
								  {
									   $dealsimg = $basepath."adminpanel/images/advertise.jpg";
								  }
								  
								  $dealerid   = $dealsdetails->dealsid;
								  $todate     = $dealsdetails->todate;
								  $createat     = $dealsdetails->create_at;
								  
								$dataa_array[]= array(
								              'id'         =>$dealsid, 
											  'image'      =>$dealsimg, 
											  'dealsname'  =>$dealsname, 
											  'discount'   =>$dealsdiscount, 
											  'price'      =>$actualprice, 
											  'saveprice'  =>$saveprice, 
											  'totalprice' =>$totalprice, 
											  'dealerid'   =>$dealerid, 
											  'validdate'  =>$todate,
											  'create_at'  =>$createat,
											  'type' => 'deals'
											  );
								
					          }
								
								$final_output['responsecode'] = '200';				
								$final_output['status'] = 'success';
								$final_output['message'] = 'deal list';	
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
						$final_output['responsecode'] = '404';
						$final_output['status'] = 'false';
						$final_output['message'] = 'Please send type';
						
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



/*public function notificationlist()
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
				$create_at1= "WHERE uid='".$userid."'";
			}else
			{
				$create_at1= "WHERE uid='".$userid."' AND create_at < $create_at ";
			}
				
			$query = $this->db->query("SELECT * FROM `manage_notification` ".$create_at1." ORDER BY `id` DESC LIMIT 10");
			$check_records = $query->result();
			$count = $query->num_rows();
			
			if($count>0){
			 
				 foreach($check_records as $check_record1)
				 {
				 
				    $ntype   = $check_record1->notification_type;
					$createat = $check_record1->create_at;
					$notificationid   = $check_record1->id;
					
					if($ntype=='news'){
						$newsid   = $check_record1->nid;
						
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
								
								                'notificationid' => $notificationid, 
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
																
												'shareurl'        => $shareurl,
												'create_at'       => $createat,
												'type'            =>'news'
														
														
										      );
											  
											  
											  
										$final_output['responsecode'] = '200';				
										$final_output['status'] = 'success';
										$final_output['message'] = 'notification list';	
										$final_output['data'] = $dataa_array;		  
											  
			 
						         }else{
									    $final_output['responsecode'] = '402';
										$final_output['status'] = 'failed';
										$final_output['message'] = 'Record not found.';
									 
								 }
									 
					           }else{
									    $dealid   = $check_record1->did;
									   
									    $dealsdetails = $this->Common_model->common_getRow('deals',array('id'=>$dealid, 'status'=>'active'));
										if(!empty($dealsdetails))
										{
									   
											$dealsname      = $dealsdetails->offername;
											
											$dealsdiscount  = $dealsdetails->discount;
											$actualprice    = $dealsdetails->actualprice;
											if($dealsdiscount!=''){
												$saveprice  = ($actualprice*$dealsdiscount)/100;
												$totalprice = $actualprice-$saveprice;
											}else{
												
												$saveprice  = '';
												$totalprice = '';
												
											}
											
											$photo          = $dealsdetails->image;
											
											$data=parse_url($photo, PHP_URL_SCHEME);
											if($data=='http' || $data=='https')
											  {
												  $dealsimg = $photo;
											  }
											  else if($data!='http' || $data!='https'){
												   $dealsimg = $basepath.'adminpanel/'.$photo;
											  }
											  else
											  {
											   
											  }
											  if($photo=='')
											  {
												   $dealsimg = $basepath."adminpanel/images/advertise.jpg";
											  }
											  
											  $dealsid    = $dealsdetails->id;
											  $dealerid   = $dealsdetails->dealsid;
											  $todate     = $dealsdetails->todate;
											  //$createat   = $dealsdetails->create_at;
											  $date       = $dealsdetails->date;
											  
											$dataa_array[]= array(
											                    'notificationid' => $notificationid,
																'id'        => $dealsid, 
																'image'     => $dealsimg, 
																'dealsname' => $dealsname, 
																'discount'  => $dealsdiscount, 
																'price'     => $actualprice, 
																'saveprice' => $saveprice, 
																'totalprice'=> $totalprice, 
																'dealerid'  => $dealerid, 
																'validdate' => $todate, 
																'create_at' => $createat,
																'date' => $date,
																'type'      => 'deals'
																);
																
																
											$final_output['responsecode'] = '200';				
											$final_output['status'] = 'success';
											$final_output['message'] = 'notification list';	
											$final_output['data'] = $dataa_array;						
																
										}
										else{
											$final_output['responsecode'] = '402';
											$final_output['status'] = 'failed';
											$final_output['message'] = 'Record not found.';
									 
								        }
								 
								 }
			              }
			          
			        

								
			      }			
				
			else{
				$final_output['responsecode'] = '402';
				$final_output['status'] = 'Failed';
				$final_output['message'] = 'Record not found.';
				
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


}*/

public function notificationlist()
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
				$create_at1= "WHERE uid='".$userid."'";
			}else
			{
				$create_at1= "WHERE uid='".$userid."' AND create_at < $create_at ";
			}
				
			//echo "SELECT * FROM manage_notification ".$create_at1." ORDER BY id DESC LIMIT 10";	
			$query = $this->db->query("SELECT * FROM manage_notification ".$create_at1." ORDER BY id DESC LIMIT 10");
			$check_records = $query->result();
			//$count = $query->num_rows();
			$count = count($check_records);
			
			if($count>0){
			 
				 foreach($check_records as $check_record1)
				 {
				 
				    $ntype   = trim($check_record1->notification_type);
					$notificationid   = $check_record1->id;
					
					if($ntype == 'news'){
						 $newsid   = $check_record1->nid;
						 $createat = $check_record1->create_at;
					      
					      $query = $this->db->query("SELECT * FROM news where id=$newsid and status!='inactive'");
					      $check_recordnews = $query->result();
					     
						 if(!empty($check_recordnews))
						  {
						   foreach($check_recordnews as $check_record)
			                {
							 $slug = $check_record->slug;
							 $newsids = $check_record->id;
							 
							 $newsstatus = $check_record->status;
							
						
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
												'notificationid' => $notificationid, 
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
																
												'shareurl'        => $shareurl,
												'create_at'       => $createat,
												'type'            =>'news'
														
														
										      );
											  
			                        }		  
											  
										$final_output['responsecode'] = '200';				
										$final_output['status'] = 'success';
										$final_output['message'] = 'notification list';	
										$final_output['data'] = $dataa_array;		  
				                    
						    
						         
						  }else{
						                    $final_output['responsecode'] = '402';
											$final_output['status'] = 'failed';
											$final_output['message'] = 'Record not found.';
											
						             }
						         
						           
						         
									 
					}       
					  else if($ntype == 'deals'){
						 $dealid   = $check_record1->did;
						 $createat = $check_record1->create_at;
					      
					      $query = $this->db->query("SELECT * FROM deals where id=$dealid and status!='inactive'");
					      $deals = $query->result();
					     
						 if(!empty($deals))
						  {
						   foreach($deals as $dealsdetails)
			                {
							                $dealsname      = $dealsdetails->offername;
											
											$dealsdiscount  = $dealsdetails->discount;
											$actualprice    = $dealsdetails->actualprice;
											if($dealsdiscount!=''){
												$saveprice  = ($actualprice*$dealsdiscount)/100;
												$totalprice = $actualprice-$saveprice;
											}else{
												
												$saveprice  = '';
												$totalprice = '';
												
											}
											
											$photo          = $dealsdetails->image;
											
											$data=parse_url($photo, PHP_URL_SCHEME);
											if($data=='http' || $data=='https')
											  {
												  $dealsimg = $photo;
											  }
											  else if($data!='http' || $data!='https'){
												   $dealsimg = $basepath.'adminpanel/'.$photo;
											  }
											  else
											  {
											   
											  }
											  if($photo=='')
											  {
												   $dealsimg = $basepath."adminpanel/images/advertise.jpg";
											  }
											  
											  $dealsid    = $dealsdetails->id;
											  $dealerid   = $dealsdetails->dealsid;
											  $todate     = $dealsdetails->todate;
											  //$createat   = $dealsdetails->create_at;
											  $date       = $dealsdetails->date;
											  
											$dataa_array[]= array(
											                    'notificationid' => $notificationid,
																'id'        => $dealsid, 
																'image'     => $dealsimg, 
																'dealsname' => $dealsname, 
																'title'     => $dealsname,
																'discount'  => $dealsdiscount, 
																'price'     => $actualprice, 
																'saveprice' => $saveprice, 
																'totalprice'=> $totalprice, 
																'dealerid'  => $dealerid, 
																'validdate' => $todate, 
																'create_at' => $createat,
																'date' => $date,
																'type'      => 'deals'
																);
											  
			                        }		  
											  
										$final_output['responsecode'] = '200';				
										$final_output['status'] = 'success';
										$final_output['message'] = 'notification list';	
										$final_output['data'] = $dataa_array;		  
				                    
						    
						         
        						  }else{
        						                    $final_output['responsecode'] = '402';
        											$final_output['status'] = 'failed';
        											$final_output['message'] = 'Record not found.';
        											
        						             }
						         
						           
						         
									 
					           }
						       
					           
					         
			              }
			          
			        

								
			      }			
				
			else{
			    
			   
				$final_output['responsecode'] = '402';
				$final_output['status'] = 'failed';
				$final_output['message'] = 'Record not found.';
				
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


public function deletenotification()
{
	$this->load->model('Common_model');
	
	$userid = $this->input->post('id');	
	$notificationid  = $this->input->post('notificationid');	
	
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

			if(($device_type == 'iOS' || $device_type == 'AndroidApp') && strlen($device_id) === strlen($device_token))
			{ 
				$device_token = '';
			}

			$auth_key = $this->rand_string(40);
			$final_output = array();
			 if(!empty($userid))
			   {
				    if($notificationid!=''){
					       $typedelete = $this->Common_model->deletenotification($notificationid);				  
						   if($typedelete==1){
							   
							   $flag='1';
							   $msg ="Successfully delete";
							   
						   }else{
								$flag='0';
								$msg ="Record not found";
						   }
					   
						
					  }else{
						  
						  $typedelete = $this->Common_model->deleteusernotification($userid);
						  if($typedelete==1){
							   
							   $flag='1';
							   $msg ="Successfully delete";
							   
						   }else{
								$flag='0';
								$msg ="Record not found";
						   }
						  
					  } 
				   
					    $final_output['responsecode'] = '200';				
						$final_output['status'] = 'success';
						$final_output['message'] = $msg;	
						$final_output['flag'] = $flag;
							
				}
	 
			  else
				{
					$final_output['responsecode'] = '403';
					$final_output['status'] = 'false';
					$final_output['message'] = 'Send user id';
					
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
