<?php

/*
  @Author : Vinod K Maurya
  Description:
  Dated :  07/03/2018
 */
error_reporting(0);
require_once APPPATH . '/mpdf60/mpdf.php';
require_once APPPATH . '/spout-2.7.3/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

class Admin_adminusers extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    const VIEW_FOLDER = 'admin/adminusers';

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');

        $militime = round(microtime(true) * 1000);

        define('militime', $militime);
    }

    function index() {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn', 'refresh');
        }
    }

    function editadvertise($editid) {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');
        $data['recordcheck'] = $this->Category_model->getadvertise(base64_decode($editid));

        $data['main_content'] = 'admin/adminusers/editadvertise';
        $this->load->view('includes/template', $data);
    }

    function updateadvertise() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');

        if ($_REQUEST['Submit']) {

            if ($this->input->post("Submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Title', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {

                    $updateid = $this->input->post('updateid');
                    $file_name = $_FILES['news_img']['name'];
                    $file_size = $_FILES['news_img']['size'];
                    $file_tmp = $_FILES['news_img']['tmp_name'];
                    $file_type = $_FILES['news_img']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['news_img']['name'])));

                    if ($file_name != '') {


                        $target_dir = "images/advertise/";
                        $rn_file = $target_dir . "" . $file_name;
                    } else {
                        $rn_file = "";
                    }
                    $target_file = $target_dir . basename($_FILES["news_img"]["name"]);


                    $expensions = array("jpeg", "jpg", "png");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }


                    if ($file_name != '') {

                        $recordcheck = $this->Category_model->check_record_advertise($updateid);
                        $existimage = $recordcheck[0]['image'];
                        $dataRecord = unlink('images/advertise/' . $existimage);
                        $uploadstatus = move_uploaded_file($file_tmp, $rn_file);

                        $dataarray['userid'] = '41';
                        $dataarray['sourcemedia'] = 'Desktop';
                        $dataarray['sessionid'] = '';
                        $dataarray['siteid'] = 'AINA';
                        $dataarray['page_title'] = $this->input->post('name');
                        $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $dataarray['page_title']));
                        $dataarray['slug'] = $urlt;

                        if ($file_name != '') {
                            $dataarray['image'] = $rn_file;
                        } else {
                            $dataarray['image'] = '';
                        }

                        $dataarray['section'] = '';
                        $dataarray['status'] = $this->input->post('status');
                        $dataarray['author'] = $this->input->post('publisher');
                        $dataarray['price'] = $this->input->post('price');
                        $dataarray['email'] = $this->input->post('email');
                        $dataarray['contact'] = $this->input->post('contact');
                        $dataarray['address'] = $this->input->post('address');
                        $dataarray['priority'] = $this->input->post('priority');
                        $dataarray['nposition'] = $this->input->post('nposition');
                        $dataarray['fromdate'] = $this->input->post('fromdate');
                        $dataarray['todate'] = $this->input->post('todate');
                        $dataarray['date'] = date("Y-m-d") . " " . date("H:i:s");


                        $militime = round(microtime(true) * 1000);


                        $dataarray['update_at'] = $militime;

                        $this->load->model('Category_model');
                        $this->db->where('id', $updateid);

                        $recordcheck = $this->db->update('advertise', $dataarray);

                        $this->session->set_flashdata('success', 'advertise  updated successfully');
                        if ($recordcheck) {
                            redirect('admin_adminusers/advertiseview', 'refresh');
                        }
                    } else {


                        $dataarray['userid'] = '41';
                        $dataarray['sourcemedia'] = 'Desktop';
                        $dataarray['sessionid'] = '';
                        $dataarray['siteid'] = 'AINA';
                        $dataarray['page_title'] = $this->input->post('name');
                        $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $dataarray['page_title']));
                        $dataarray['slug'] = $urlt;

                        

                        $dataarray['section'] = '';
                        $dataarray['status'] = $this->input->post('status');
                        $dataarray['author'] = $this->input->post('publisher');
                        $dataarray['price'] = $this->input->post('price');
                        $dataarray['email'] = $this->input->post('email');
                        $dataarray['contact'] = $this->input->post('contact');
                        $dataarray['address'] = $this->input->post('address');
                        $dataarray['priority'] = $this->input->post('priority');
                        $dataarray['nposition'] = $this->input->post('nposition');
                        $dataarray['fromdate'] = $this->input->post('fromdate');
                        $dataarray['todate'] = $this->input->post('todate');
                        $dataarray['date'] = date("Y-m-d") . " " . date("H:i:s");


                        $militime = round(microtime(true) * 1000);


                        $dataarray['update_at'] = $militime;

                        $this->load->model('Category_model');
                        $this->db->where('id', $updateid);
                        $recordcheck = $this->db->update('advertise', $dataarray);

                        $this->session->set_flashdata('success', 'advertise  updated successfully');
                        if ($recordcheck) {
                            redirect('admin_adminusers/advertiseview', 'refresh');
                        }
                    }
                }
            }
        }
    }
	
	
	
	function unicodeString($str, $encoding=null) {
    if (is_null($encoding)) $encoding = ini_get('mbstring.internal_encoding');
    return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/u', create_function('$match', 'return mb_convert_encoding(pack("H*", $match[1]), '.var_export($encoding, true).', "UTF-16BE");'), $str);
    }
	
	function senddealnotification()
	{
		
					$id=$this->input->post('id');
					$this->load->model('Common_model');
					$checknewsData = $this->Common_model->common_getRow('deals',array('id'=>$id,'status'=>'active'));
					$title=$checknewsData->offername;
					$image=$checknewsData->image; 
					$status=$checknewsData->status;  
					$insert_id=$checknewsData->id;	
					$discount=$checknewsData->discount;
					$dealsid=$checknewsData->dealsid;
					  
					  if($status=='active')
                      {
					
					   $this->load->model('Common_model');
					
					
							
							
					       $student_data =  $this->db->query("SELECT id,sourcemedia,deviceid,tokenid,notificationsetting FROM user_register WHERE deviceid != '' AND deviceid != tokenid")->result();
							
							$gcmRegIds_android = array();
							$gcmRegIds_ios = array();
							
							$i = 0;
								foreach($student_data as $user_device_token)
								{
								  $i++;
								 /* if($user_device_token->sourcemedia == 'android')
								  {
									$gcmRegIds_android[floor($i/1000)][] = $user_device_token->tokenid;
								  }	
								  else if($user_device_token->sourcemedia == 'iOS')
								  {
									  $gcmRegIds_ios[floor($i/1000)][] = $user_device_token->tokenid;
								  }	
								   $userid_arr[] = $user_device_token->id; 
								   
								   
								   
								   
								   
								    $addData=array();
									$addData['uid']=$user_device_token->id;
									$addData['did']=0;
									$addData['nid']=$insert_id;
									$addData['notification_status']=1;
									$addData['notification_type']='news';
									$addData['catid']=$this->input->post('priority');
									$addData['added_date']=date('Y-m-d h:m:s');
									$addData['create_at']=militime;
									$addData['update_at']=militime;
									$recordcheck = $this->Deals_model->addmanage_notification($addData); */
								   
								   
								   
								}
									
									
									
							
							    /* notification setting */

								    $type='news';
									$catarr = array('news'=>'1', 'advertise'=>'13', 'deals'=>'14');

									if (array_key_exists($type, $catarr))
									{
									$catval = $catarr[$type];
									$query = $this->db->query("SELECT * FROM `user_register` where notificationsetting LIKE '%$catval%'");
									$getlist = $query->result();
								    $count = $query->num_rows();
									if($count>0)
									{
									$i=0;
									foreach($getlist as $row)
									{
											$deviceToken=array();
											$apple_identifier = $row->id;
											
											$deviceToken[$i] = $row->tokenid;
											
											

											$comma_separated[$i] = implode(" ',' ", $deviceToken);
											
											
											
											$i++;
											
											$notiflag = $row->notificationsetting;
											$explode = explode(",",$notiflag);
											
											
											if(in_array($catval, $explode)){  
											
											if($type=='news') { 
											
											$val=$comma_separated;
											
											
											if($row->sourcemedia=='AndroidApp')
											{
											$gcmRegIds_android[floor($i/1000)][] = $row->tokenid;
											}	
											else if($row->sourcemedia == 'iOS')
											{
											$gcmRegIds_ios[floor($i/1000)][] = $row->tokenid;
											}	
											$userid_arr[] = $row->id;
											
											
											
											
											
											/*$addData=array();
											$addData['uid']=$row->id;
											$addData['did']=0;
											$addData['nid']=$insert_id;
											$addData['notification_status']=1;
											$addData['notification_type']='news';
											$addData['catid']=$this->input->post('priority');
											$addData['added_date']=date('Y-m-d h:m:s');
											$addData['create_at']=militime;
											$addData['update_at']=militime;
											$recordcheck = $this->Deals_model->addmanage_notification($addData); */
											
											
											
											
											
										
										      
										}
											
											
										
									
											}
											
										}
									}
									 
									}	
								
								
								
								$basepath=base_url();
								$maining=$rn_file;
								$data=parse_url($maining, PHP_URL_SCHEME);

								if($data=='http' || $data=='https')
								{
								$image1 = $maining;
								}



								else if($data!='http' || $data!='https'){

								$image1 = $basepath.$maining;

								}
								else
								{

								}

								if($maining=='')
								{
								$image1 = $basepath."images/No_Image_Available.jpg";

								}
									
									
									
									
									$msdata='Grab the deal! ';
							        $msgdata2=$discount.'% OFF';
							
									 $pushMessage=array("title" =>$title,'message_id'=>$insert_id,'dealsid'=>$dealsid,"message" =>substr($msdata. $title.' at '. $msgdata2,0,600),'image'=>$image1,"type"=>'deals',"currenttime"=>militime);
									//$pushMessage=array("title" =>$title,'message_id'=>$insert_id,"message" =>substr($title,0,255),'image'=>$image1,"type"=>'news',"currenttime"=>militime);
							
									if(isset($gcmRegIds_android)) 
									{  
										$message = $pushMessage;
										//$message2=$this->unicodeString($message1);
										//$message = html_entity_decode($message2, ENT_QUOTES);
										$pushStatus = array();
										
										
										
										foreach($gcmRegIds_android as $val)
										{
											
										   $pushStatus[] = $this->Common_model->sendNotification($val, $message);
										   
										}
										
									}
									
									
									
									
									
									if(isset($gcmRegIds_ios))
									{ 
								
								
								
										$text = $title;
										
										$msg1 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $text);

										$msgd = str_replace('&nbsp;','',$msg1);
										
										$msdata='Grab the deal! ';
							            $msgdata2= 'at '.$discount .'% OFF';
										$msg1 =strip_tags($msdata.' '.$msgd.' '.$msgdata2);
										$msg2=$this->unicodeString($msg1);
										$msg = html_entity_decode($msg2, ENT_QUOTES);
										
										
										
										$desc='';
										$pushStatus1 = array();
										$i=0;
										foreach($gcmRegIds_ios as $val)
										{ 
										   $pushStatus1[] = $this->Common_model->iOSPushNotification($val,substr($msg,0,80),substr($desc,0,40),'deals',$insert_id);
										  
										  $i++;   			
										}
									}  
									
									
								
								
								 
								 
								 
								 
								
									$this->session->set_flashdata('success', 'Message Sent to all user Successfully.');
									
								
						}
						
							echo 1;
						    die;
		
	}
	
	
	
	

   
	
	

    function addprogram() {
        
         $this->load->model('Register_model');
		 $this->load->model('Common_model');
		 $lasturl = @end($this->uri->segment_array());
         $data['role'] = $this->session->userdata('role');


        if ($_REQUEST['Submit']) {

            if ($this->input->post("Submit") != false) {
			

                $this->load->library('form_validation');
                $this->form_validation->set_rules('program_title', 'Title', 'trim|required');

                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {

				
					
					$file_name = $_FILES['programimg']['name'];
                    $file_size = $_FILES['programimg']['size'];
                    $file_tmp = $_FILES['programimg']['tmp_name'];
                    $file_type = $_FILES['programimg']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['programimg']['name'])));
                    $target_dir = "images/courseimg/";
                    $rn_file = $target_dir . "" . $file_name;
                    $target_file = $target_dir . basename($_FILES["programimg"]["name"]);

                    move_uploaded_file($file_tmp, $rn_file);
                    $expensions = array("jpeg", "jpg", "png");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }
					
					
					
					$file_name2 = $_FILES['uploadpf']['name'];
                    $file_size2 = $_FILES['uploadpf']['size'];
                    $file_tmp2 = $_FILES['uploadpf']['tmp_name'];
                    $file_type2 = $_FILES['uploadpf']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['uploadpf']['name'])));
                    $target_dir = "images/coursepdf/";
                    $rn_file = $target_dir . "" . $file_name2;
                    $target_file = $target_dir . basename($_FILES["uploadpf"]["name"]);

                    move_uploaded_file($file_tmp2, $rn_file);
                    $expensions = array("jpeg", "pdf", "png");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }
					
					$dataarray['teacher_name'] = $this->input->post('teachername');
					$dataarray['hours'] = $this->input->post('duration');
					$dataarray['course_title'] = $this->input->post('program_title');
                    $dataarray['course_desc'] = $this->input->post('description');
					$dataarray['course_price'] = $this->input->post('price');
					$dataarray['course_image'] = $file_name;
					$dataarray['coursepdf'] = $file_name2;
                    $dataarray['coursediscount'] = $this->input->post('discount');
					$dataarray['ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $dataarray['product_adddate'] = date("Y-m-d") . " " . date("H:i:s");
                    
					 $insertarrayresult = $this->Register_model->addcourses($dataarray);
					 $insert_id=$insertarrayresult;
					 
                    $this->session->set_flashdata('success', 'Program  Added successfully');
                    if ($insert_id) {
                        redirect('admin_adminusers/publish_program', 'refresh');
                    }
                }
            }
        }

        $data['main_content'] = 'admin/adminusers/addprogram';
        $this->load->view('includes/template', $data);
    }
	
	
	 function updateactivestatusmain() {
            $data['role'] = $this->session->userdata('role');
            $updateid = $this->input->post('id');
            $updateRecord = array();
            $updateRecord['status'] = $this->input->post('status');
            
            
            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('courses', $updateRecord);
           
            if($updateRecord['status']==0)
            {
            $this->session->set_flashdata('success', 'Deactivatd  successfully');
            }
            else
            {
                $this->session->set_flashdata('success', 'Activated  successfully');
            }
             echo 1;
              die;
            }
	
	
	

    function dashboard() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data = array();
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/dashboard';
        $this->load->view('includes/template', $data);
    }

    function deleteworkcategory() {

        $lasturl = @end($this->uri->segment_array());
        $data['role'] = $this->session->userdata('role');
        $deleteid = $this->input->post('id');
        $this->load->model('Category_model');
        if ($deleteid) {
            $data['editdata'] = $this->Category_model->deleteworkcategory(base64_decode($deleteid));
            $this->session->set_flashdata('success', 'Deleted  successfully');
        }

        redirect('admin_adminusers/cumulativelist', 'refresh');
    }

    function cumulativelist() {
        $lasturl = @end($this->uri->segment_array());
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');
        if ($editid) {
            $data['editdata'] = $this->Category_model->cumulativeeditData(base64_decode($editid));
        }
        if ($lasturl == 'add') {
            $data['addcat'] = 'add';
        }



        $data['cumulativelist'] = $this->Category_model->cumulativelist();
        $data['main_content'] = 'admin/adminusers/cumulativelist';
        $this->load->view('includes/template', $data);
    }

    function updatecatstatus() {
        $data['role'] = $this->session->userdata('role');
        $updateid = $this->input->post('id');
        $updateRecord = array();
        $updateRecord['status'] = $this->input->post('status');


        $this->db->where('id', $updateid);
        $resultdata = $this->db->update('workplace_category', $updateRecord);

        if ($updateRecord['status'] == '0') {
            $this->session->set_flashdata('success', 'Deactivatd  successfully');
        } else {
            $this->session->set_flashdata('success', 'Activated  successfully');
        }
        echo 1;
        die;
    }

    function addcategory() {


        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');
        if ($_REQUEST['submit']) {

            if ($this->input->post("submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('categoryname', 'Categoryname', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {

                    $post_date = date('d/m/Y');
                    $last_update = date('d/m/Y');
                    date_default_timezone_set('Asia/Calcutta');
                    $posttime = date("h:i a");
                    $updatetime = date("h:i a");

                    $insertRecord = array();
                    $insertRecord['Category'] = $this->input->post('categoryname');
                    $insertRecord['Level'] = 0;
                    $insertRecord['posttime'] = $posttime;
                    $insertRecord['postdate'] = $post_date;
                    $insertRecord['image_path'] = '';
                    $insertRecord['extras'] = 0;
                    $insertRecord['url'] = '';
                    $insertRecord['rank'] = 1;
                    $insertRecord['status'] = 'active';

                    $adddate = $this->Category_model->Addcategory($insertRecord);


                    if ($adddate) {
                        $this->session->set_flashdata('success', 'Added  successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Not Added');
                    }
                    redirect('admin_adminusers/cumulativelist', 'refresh');
                }
            }
        }
    }

    function updateworkcategory() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');
        if ($_REQUEST['update']) {

            if ($this->input->post("update") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('categoryname', 'Categoryname', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {


                    $updateRecord = array();
                    $updateid = base64_decode($this->input->post('updateid'));
                    $updateRecord['workcategory'] = $this->input->post('categoryname');
                    $this->db->where('id', $updateid);
                    $resultdata = $this->db->update('workplace_category', $updateRecord);

                    if ($resultdata) {
                        $this->session->set_flashdata('success', 'Updated  successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Not updated');
                    }
                    $upid = $this->input->post('updateid');
                    redirect('admin_adminusers/workcategorylist', 'refresh');
                }
            }
        }
    }

    function addworkcategory() {


        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        if ($_REQUEST['submit']) {

            if ($this->input->post("submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('categoryname', 'Categoryname', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {



                    $insertRecord = array();
                    $insertRecord['workcategory'] = $this->input->post('categoryname');
                    $insertRecord['status'] = 'active';

                    $adddate = $this->Register_model->addworkcategory($insertRecord);


                    if ($adddate) {
                        $this->session->set_flashdata('success', 'Added  successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Not Added');
                    }
                    redirect('admin_adminusers/workcategorylist', 'refresh');
                }
            }
        }
        $data['main_content'] = 'admin/adminusers/addworkcategory';
        $this->load->view('includes/template', $data);
    }

    function editcategory() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');
        if ($_REQUEST['update']) {

            if ($this->input->post("update") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('categoryname', 'Categoryname', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {




                    $updateRecord = array();
                    $updateid = base64_decode($this->input->post('updateid'));
                    $updateRecord['Category'] = $this->input->post('categoryname');
                    $this->db->where('cat_id', $updateid);
                    $resultdata = $this->db->update('category', $updateRecord);

                    if ($resultdata) {
                        $this->session->set_flashdata('success', 'Updated  successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Not updated');
                    }

                    $upid = $this->input->post('updateid');
                    redirect('admin_adminusers/cumulativelist/' . $upid, 'refresh');
                }
            }
        }
    }

    function deletecategory() {
        $data['role'] = $this->session->userdata('role');
        $deleteid = base64_decode($this->input->post('id'));
        $this->load->model('Category_model');
        $deletedata = $this->Category_model->deletecategory($deleteid);
        if ($deletedata) {
            $this->session->set_flashdata('success', 'Deleted  successfully');
        }
        redirect('admin_adminusers/cumulativelist', 'refresh');
    }

    function subcatlist($catid) {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');

        $data['top_catid'] = $catid;
        $data['check_subcat'] = $this->Category_model->check_subcat(base64_decode($catid));

        $data['main_content'] = 'admin/adminusers/subcatlist';
        $this->load->view('includes/template', $data);
    }

    function editsubcat($topid, $subcatid) {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');

        $data['subcatdata'] = $this->Category_model->subcat_Details(base64_decode($subcatid));
        $data['top_cat_list'] = $this->Category_model->alltopcategory();

        $data['cat_id'] = base64_decode($topid);



        $data['main_content'] = 'admin/adminusers/editsubcat';
        $this->load->view('includes/template', $data);
    }

    function addsubcategory($topid) {
        $data['role'] = $this->session->userdata('role');
        $data['cat_id'] = base64_decode($topid);
        $this->load->model('Category_model');
        $data['top_cat_list'] = $this->Category_model->alltopcategory();


        $this->load->model('Category_model');
        if ($_REQUEST['submit']) {

            if ($this->input->post("submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('categoryname', 'Sub categoryname', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {
                    $categoryid = $this->input->post('category');


                    $post_date = date('d/m/Y');
                    $last_update = date('d/m/Y');
                    date_default_timezone_set('Asia/Calcutta');
                    $posttime = date("h:i a");
                    $updatetime = date("h:i a");

                    $insertRecord = array();
                    $insertRecord['Category'] = $this->input->post('categoryname');
                    $insertRecord['Level'] = $categoryid;
                    $insertRecord['posttime'] = $posttime;
                    $insertRecord['postdate'] = $post_date;
                    $insertRecord['image_path'] = '';
                    $insertRecord['extras'] = 0;
                    $insertRecord['url'] = '';
                    $insertRecord['metatitle'] = '';
                    $insertRecord['metaKeywords'] = '';
                    $insertRecord['metaDescription'] = '';
                    $insertRecord['last_update'] = '';
                    $insertRecord['last_update_time'] = '';
                    $insertRecord['image_path'] = '';
                    $insertRecord['notificationstatus'] = 0;


                    $insertRecord['rank'] = 1;
                    $insertRecord['status'] = 'active';

                    $adddate = $this->Category_model->Addcategory($insertRecord);


                    if ($adddate) {
                        $this->session->set_flashdata('success', 'Added  successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Not Added');
                    }

                    redirect('admin_adminusers/subcatlist/' . base64_encode($categoryid), 'refresh');
                }
            }
        }

        $data['main_content'] = 'admin/adminusers/addsubcategory';
        $this->load->view('includes/template', $data);
    }

    function updatesubcategory() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');
        $updateid = $this->input->post('updateid');
        $catid = $this->input->post('catid');

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');
        if ($_REQUEST['update']) {

            if ($this->input->post("update") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('categoryname', 'categoryname', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {

                    $updateRecord['Category'] = $this->input->post('categoryname');
                    $this->db->where('cat_id', $updateid);
                    $resultdata = $this->db->update('category', $updateRecord);

                    if ($resultdata) {
                        $this->session->set_flashdata('success', 'Sub category updated  successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Not updated');
                    }

                    redirect('admin_adminusers/subcatlist/' . base64_encode($catid), 'refresh');
                }
            }
        }
        die;
    }

    function deletesubcategory() {

        $this->load->model('Category_model');
        $deleteid = base64_decode($this->input->post('id'));
        $data['role'] = $this->session->userdata('role');

        $result = $this->Category_model->deletecategory($deleteid);
        $this->session->set_flashdata('success', 'Record deleted successfully.');
        die;
    }

    function deletespecialnews() {

        $this->load->model('Deals_model');
        $deleteid = base64_decode($this->input->post('id'));
        $data['role'] = $this->session->userdata('role');

        $result = $this->Deals_model->deletespecialoffer($deleteid);
		$result2 = $this->Deals_model->deletedealnotification($deleteid);
        $this->session->set_flashdata('success', 'Record deleted successfully.');
        die;
    }

    function editspecialoffer($editid, $pid) {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');
        $data['editdata'] = $this->Deals_model->editspecialofferData(base64_decode($editid));
        $data['pid'] = $pid;

        $data['main_content'] = 'admin/adminusers/editspecialoffer';
        $this->load->view('includes/template', $data);
    }

    function updatespecialoffer() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');

        if ($_REQUEST['Submit']) {



            if ($this->input->post("Submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Product name', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {

                    $updateid = base64_decode($this->input->post('updateid'));
                    $pid = $this->input->post('pid');

					$dealsid=base64_decode($this->input->post('dealsid'));
                    $file_name = $_FILES['news_img']['name'];
                    $file_size = $_FILES['news_img']['size'];
                    $file_tmp = $_FILES['news_img']['tmp_name'];
                    $file_type = $_FILES['news_img']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['news_img']['name'])));
                    if ($file_name != '') {
                        $target_dir = "images/news/";
                        $rn_file = $target_dir . "" . $file_name;
                    } else {
                        $rn_file = '';
                    }
                    $target_file = $target_dir . basename($_FILES["news_img"]["name"]);

                    $expensions = array("jpeg", "jpg", "png");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }
                    if ($file_name != '') {

                        $recordcheck = $this->Deals_model->check_record_deals($updateid);
                        $existimage = $recordcheck[0]['image'];
                        $dataRecord = unlink('images/news/' . $existimage);

                        $uploadstatus = move_uploaded_file($file_tmp, $rn_file);


                        $updatearray = array();
                        $updatearray['offername'] = $this->input->post('name');
                        $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $this->input->post('name')));
                        $updatearray['slug'] = $urlt;
                        //$updatearray['dealsid'] = base64_decode($this->input->post('dealsid'));
                        $updatearray['image'] = $rn_file;

                        $updatearray['actualprice'] = $this->input->post('Price');
                        $updatearray['status'] = $this->input->post('status');
                        $updatearray['fromdate'] = $this->input->post('fromdate');
                        $updatearray['todate'] = $this->input->post('todate');
                        $updatearray['discount'] = $this->input->post('discount');
                        $updatearray['update_at'] = militime;
                        $updatearray['status'] = $this->input->post('status');
						$updatearray['contactperson'] ="";

                        $updatearray['update_at'] = militime;

                        $this->db->where('id', $updateid);
                        $resultdata = $this->db->update('deals', $updatearray);
						
						
						$insert_id=$updateid;
						$title=$this->input->post('name');
					
					    $this->load->model('Common_model');
						$status=$this->input->post('status');
						if($status=='active')
						{
					       //$student_data =  $this->db->query("SELECT id,sourcemedia,deviceid,tokenid,notificationsetting FROM user_register WHERE deviceid != '' AND deviceid != tokenid")->result();
							
							$gcmRegIds_android = array();
							$gcmRegIds_ios = array();
							
								/*$i = 0;
								foreach($student_data as $user_device_token)
								{
								  $i++;
								  if($user_device_token->sourcemedia == 'android')
								  {
									$gcmRegIds_android[floor($i/1000)][] = $user_device_token->tokenid;
								  }	
								  else if($user_device_token->sourcemedia == 'iOS')
								  {
									  $gcmRegIds_ios[floor($i/1000)][] = $user_device_token->tokenid;
								  }	
								   $userid_arr[] = $user_device_token->id;
								} */
								
								
								
								    $type='deals';
									$catarr = array('news'=>'1', 'advertise'=>'13', 'deals'=>'14');

									if (array_key_exists($type, $catarr))
									{
									$catval = $catarr[$type];
									$query = $this->db->query("SELECT * FROM `user_register` where notificationsetting LIKE '%$catval%'");
									$getlist = $query->result();
								    $count = $query->num_rows();
									if($count>0)
									{
									$i=0;
									foreach($getlist as $row)
									{
											$deviceToken=array();
											$apple_identifier = $row->id;
											
											$deviceToken[$i] = $row->tokenid;
											
											

											$comma_separated[$i] = implode(" ',' ", $deviceToken);
											
											
											
											$i++;
											
											$notiflag = $row->notificationsetting;
											$explode = explode(",",$notiflag);
											
											
											if(in_array($catval, $explode)){  
											
											if($type=='deals') { 
											
											$val=$comma_separated;
											
											
											if($row->sourcemedia == 'AndroidApp')
											{
											$gcmRegIds_android[floor($i/1000)][] = $row->tokenid;
											}	
											else if($row->sourcemedia == 'iOS')
											{
											$gcmRegIds_ios[floor($i/1000)][] = $row->tokenid;
											}	
											$userid_arr[] = $row->id;
											
											
											
												
										
										      
										}
											
											
										
									
											}
											
										}
									}
									 
									}	
									
									$basepath=base_url();
									$maining=$rn_file;
									$data=parse_url($maining, PHP_URL_SCHEME);

									if($data=='http' || $data=='https')
									{
									$image1 = $maining;
									}



									else if($data!='http' || $data!='https'){

									$image1 = $basepath.$maining;

									}
									else
									{

									}

									if($maining=='')
									{
									$image1 = $basepath."images/No_Image_Available.jpg";

									}
										
									
									
									
								
							
									$pushMessage=array("title" =>$title,'message_id'=>$insert_id,'dealsid'=>$dealsid,"message" =>substr($this->input->post('name'),0,255),'image'=>$image1,"type"=>'deals',"currenttime"=>militime);
							   
									if(isset($gcmRegIds_android)) 
									{  
										$message = $pushMessage;
										$pushStatus = array();
								
										foreach($gcmRegIds_android as $val)
										{
										   $pushStatus[] = $this->Common_model->sendNotification($val, $message);
										}
									}
									
									
									if(isset($gcmRegIds_ios))
									{ 
										$text = $this->input->post('name');
										//$msg1 = preg_replace('/<[^>]*>/', '', $text);
										$msg1 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $text);

										$msg = str_replace('&nbsp;','',$msg1);
										$msg =strip_tags($msg);
										$desc='';
										$pushStatus1 = array();
										$i=0;
										foreach($gcmRegIds_ios as $val)
										{ 
										   $pushStatus1[] = $this->Common_model->iOSPushNotification($val,substr($msg,0,80),substr($desc,0,40),'deals',$dealsid);
										  $i++;   			
										}
									} 
						}
									
									/*$addData=array();
									$addData['uid']=41;
									$addData['did']=$updateid;
									$addData['nid']=0;
									$addData['notification_status']=1;
									$addData['notification_type']='deals';
									$addData['catid']=0;
									$addData['added_date']=date('Y-m-d h:m:s');
									$addData['create_at']=militime;
									
									 $this->db->where('did', $updateid);
									 $resultdata = $this->db->update('manage_notification', $addData);*/
									
									
						
                        $this->session->set_flashdata('success', 'Record updated successfully.');
                        redirect('admin_adminusers/specialofferview/' . $pid, 'refresh');
                    } else {


                        $updatearray = array();
                        $updatearray['offername'] = $this->input->post('name');
                        $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $this->input->post('name')));
                        $updatearray['slug'] = $urlt;


						$dealsid=base64_decode($this->input->post('dealsid'));
                        $updatearray['actualprice'] = $this->input->post('Price');
                        $updatearray['status'] = $this->input->post('status');
                        $updatearray['fromdate'] = $this->input->post('fromdate');
                        $updatearray['todate'] = $this->input->post('todate');
                        $updatearray['discount'] = $this->input->post('discount');
                        $updatearray['update_at'] = militime;
                        $updatearray['status'] = $this->input->post('status');
						$updatearray['contactperson'] =" ";
					   

                        $updatearray['update_at'] = militime;

                        $this->db->where('id', $updateid);
                        $resultdata = $this->db->update('deals', $updatearray);
						
						
						$insert_id=$updateid;
						$title=$this->input->post('name');
					
					    $this->load->model('Common_model');
						$status=$this->input->post('status');
						if($status=='active')
						{
					       //$student_data =  $this->db->query("SELECT id,sourcemedia,deviceid,tokenid,notificationsetting FROM user_register WHERE deviceid != '' AND deviceid != tokenid")->result();
							
							$gcmRegIds_android = array();
							$gcmRegIds_ios = array();
							
							 /*$i = 0;
								foreach($student_data as $user_device_token)
								{
								  $i++;
								  if($user_device_token->sourcemedia == 'android')
								  {
									$gcmRegIds_android[floor($i/1000)][] = $user_device_token->tokenid;
								  }	
								  else if($user_device_token->sourcemedia == 'iOS')
								  {
									  $gcmRegIds_ios[floor($i/1000)][] = $user_device_token->tokenid;
								  }	
								   $userid_arr[] = $user_device_token->id;
								} */
									
								 
								    $type='deals';
									$catarr = array('news'=>'1', 'advertise'=>'13', 'deals'=>'14');

									if (array_key_exists($type, $catarr))
									{
									$catval = $catarr[$type];
									$query = $this->db->query("SELECT * FROM `user_register` where notificationsetting LIKE '%$catval%'");
									$getlist = $query->result();
								    $count = $query->num_rows();
									if($count>0)
									{
									$i=0;
									foreach($getlist as $row)
									{
											$deviceToken=array();
											$apple_identifier = $row->id;
											
											$deviceToken[$i] = $row->tokenid;
											$sourcemedia[$i] =$row->sourcemedia;
											

											$comma_separated[$i] = implode(" ',' ", $deviceToken);
											
											
											
											$i++;
											
											$notiflag = $row->notificationsetting;
											$explode = explode(",",$notiflag);
											
											
											if(in_array($catval, $explode)){  
											
											if($type=='deals') { 
											
											 $val=$comma_separated;
											 
											
											
											if($row->sourcemedia == 'AndroidApp')
											{
											$gcmRegIds_android[floor($i/1000)][] = $row->tokenid;
											}	
											else if($row->sourcemedia == 'iOS')
											{
											$gcmRegIds_ios[floor($i/1000)][] = $row->tokenid;
											}	
											$userid_arr[] = $row->id;
											
											
											
												
										
										      
										}
											
											
										
									
											}
											
										}
									}
									 
									}	
									
									
									 $recordcheck = $this->Deals_model->check_record_deals($updateid);
									 $existimage = $recordcheck[0]['image'];
									$basepath=base_url();
									$maining=$existimage;
									$data=parse_url($maining, PHP_URL_SCHEME);

									if($data=='http' || $data=='https')
									{
									$image1 = $maining;
									}



									else if($data!='http' || $data!='https'){

									$image1 = $basepath.$maining;

									}
									else
									{

									}

									if($maining=='')
									{
									$image1 = $basepath."images/No_Image_Available.jpg";

									}
									
									
									
							
									$pushMessage=array("title" =>$title,'message_id'=>$insert_id,'dealsid'=>$dealsid,"message" =>substr($this->input->post('name'),0,255),'image'=>$image1,"type"=>'deals',"currenttime"=>militime);
							   
									if(isset($gcmRegIds_android)) 
									{  
										$message = $pushMessage;
										$pushStatus = array();
								
										foreach($gcmRegIds_android as $val)
										{
										   $pushStatus[] = $this->Common_model->sendNotification($val, $message);
										}
									}
									
									
									if(isset($gcmRegIds_ios))
									{ 
										$text = $this->input->post('name');
										//$msg1 = preg_replace('/<[^>]*>/', '', $text);
										$msg1 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $text);

										$msg = str_replace('&nbsp;','',$msg1);
										$msg =strip_tags($msg);
										$desc='';
										$pushStatus1 = array();
										$i=0;
										foreach($gcmRegIds_ios as $val)
										{ 
										   $pushStatus1[] = $this->Common_model->iOSPushNotification($val,substr($msg,0,80),substr($desc,0,40),'deals',$dealsid);
										  $i++;   			
										}
									} 
							
						}

						/*$addData=array();
										$addData['uid']=41;
										$addData['did']=$updateid;
										$addData['nid']=0;
										$addData['notification_status']=1;
										$addData['notification_type']='deals';
										$addData['catid']=0;
										$addData['added_date']=date('Y-m-d h:m:s');
										$addData['create_at']=militime;
										$this->db->where('did', $updateid);
									    $resultdata = $this->db->update('manage_notification', $addData); */
										
						
						
                        $this->session->set_flashdata('success', 'Record updated successfully.');
                        redirect('admin_adminusers/specialofferview/' . $pid, 'refresh');
                    }
                }
            }
        }
    }

    function addspecialofferData() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');


        if ($_REQUEST['Submit']) {

            if ($this->input->post("Submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Product name', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {
                    $updateid = base64_decode($this->input->post('id'));

                    $file_name = $_FILES['news_img']['name'];
                    $file_size = $_FILES['news_img']['size'];
                    $file_tmp = $_FILES['news_img']['tmp_name'];
                    $file_type = $_FILES['news_img']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['news_img']['name'])));
                    if ($file_name != '') {
                        $target_dir = "images/news/";
                        $rn_file = $target_dir . "" . $file_name;
                    } else {
                        $rn_file = '';
                    }
                    $target_file = $target_dir . basename($_FILES["news_img"]["name"]);

                    $expensions = array("jpeg", "jpg", "png");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }
                    if ($file_name != '') {

                        $uploadstatus = move_uploaded_file($file_tmp, $rn_file);


                        $addarray = array();
						$addarray['name'] = '';
						$addarray['slug'] = '';
						$addarray['contactperson'] = '';
						$addarray['email'] = '';
						$addarray['contact'] = '';
						$addarray['address'] = '';
						$addarray['about'] = '';
						$addarray['specialname'] = '';
						$addarray['ip_address'] = '';
						$addarray['latitude'] = '';
						$addarray['longitude'] = '';
						$addarray['nposition'] = 0;
						$addarray['totallikes'] = 0;
						$addarray['m_clicked'] = 0;
						
						
						
						
                        $addarray['offername'] = $this->input->post('name');
                        $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $this->input->post('name')));
                        $addarray['slug'] = $urlt;
                        $addarray['dealsid'] = base64_decode($this->input->post('dealsid'));
                        $addarray['image'] = $rn_file;

                        $addarray['actualprice'] = $this->input->post('Price');
                        $addarray['status'] = $this->input->post('status');
                        $addarray['fromdate'] = $this->input->post('fromdate');
                        $addarray['todate'] = $this->input->post('todate');
                        $addarray['discount'] = $this->input->post('discount');
                        $addarray['update_at'] = militime;
                        $addarray['status'] = 'active';
                        $addarray['date'] = date("Y-m-d") . " " . date("H:i:s");
                        $addarray['create_at'] = militime;
                        $addarray['update_at'] = militime;

                        //$this->db->where('id', $updateid);
                        $resultdata = $this->Deals_model->adddeals($addarray);
						
						
						
						$insert_id=$resultdata;
						$title=$this->input->post('name');
					
					    $this->load->model('Common_model');
						
						$status=$this->input->post('status');
						if($status=='active')
						{
					
					      // $student_data =  $this->db->query("SELECT id,sourcemedia,deviceid,tokenid,notificationsetting FROM user_register WHERE deviceid != '' AND deviceid != tokenid")->result();
							
							$gcmRegIds_android = array();
							$gcmRegIds_ios = array();
							
								/*$i = 0;
								foreach($student_data as $user_device_token)
								{
								  $i++;
								  if($user_device_token->sourcemedia == 'android')
								  {
									$gcmRegIds_android[floor($i/1000)][] = $user_device_token->tokenid;
								  }	
								  else if($user_device_token->sourcemedia == 'iOS')
								  {
									  $gcmRegIds_ios[floor($i/1000)][] = $user_device_token->tokenid;
								  }	
								   $userid_arr[] = $user_device_token->id;
								   
								 
									$addData=array();
									$addData['uid']=$user_device_token->id;
									$addData['did']=$insert_id;
									$addData['nid']=0;
									$addData['notification_status']=1;
									$addData['notification_type']='deals';
									$addData['catid']=0;
									$addData['added_date']=date('Y-m-d h:m:s');
									$addData['create_at']=militime;
									$addData['update_at']=militime;
									$recordcheck = $this->Deals_model->addmanage_notification($addData); 
								   
								   
								} */
								
								
								
								
								
								
								
								    $type='deals';
									$catarr = array('news'=>'1', 'advertise'=>'13', 'deals'=>'14');

									if (array_key_exists($type, $catarr))
									{
									$catval = $catarr[$type];
									$query = $this->db->query("SELECT * FROM `user_register` where notificationsetting LIKE '%$catval%'");
									$getlist = $query->result();
								    $count = $query->num_rows();
									if($count>0)
									{
									$i=0;
									foreach($getlist as $row)
									{
											$deviceToken=array();
											$apple_identifier = $row->id;
											
											$deviceToken[$i] = $row->tokenid;
											
											

											$comma_separated[$i] = implode(" ',' ", $deviceToken);
											
											
											
											$i++;
											
											$notiflag = $row->notificationsetting;
											$explode = explode(",",$notiflag);
											
											
											if(in_array($catval, $explode)){  
											
											if($type=='deals') { 
											
											$val=$comma_separated;
											
											
											if($row->sourcemedia == 'AndroidApp')
											{
											$gcmRegIds_android[floor($i/1000)][] = $row->tokenid;
											}	
											else if($row->sourcemedia == 'iOS')
											{
											$gcmRegIds_ios[floor($i/1000)][] = $row->tokenid;
											}	
											$userid_arr[] = $row->id;
											
											$addData=array();
											$addData['uid']=$row->id;
											$addData['did']=$insert_id;
											$addData['nid']=0;
											$addData['notification_status']=1;
											$addData['notification_type']='deals';
											$addData['catid']=0;
											$addData['added_date']=date('Y-m-d h:m:s');
											$addData['create_at']=militime;
											$addData['update_at']=militime;
											$recordcheck = $this->Deals_model->addmanage_notification($addData); 
											
												
										
										      
										}
											
											
										
									
											}
											
										}
									}
									 
									}	
									
								
								
								
								
								
								
								
								
								
								
								
								$dealsid=base64_decode($this->input->post('dealsid'));
								

								$basepath=base_url();
								$maining=$rn_file;
								$data=parse_url($maining, PHP_URL_SCHEME);

								if($data=='http' || $data=='https')
								{
								$image1 = $maining;
								}



								else if($data!='http' || $data!='https'){

								$image1 = $basepath.$maining;

								}
								else
								{

								}

								if($maining=='')
								{
								$image1 = $basepath."images/No_Image_Available.jpg";

								}


									
								
									
									
									
							
									$pushMessage=array("title" =>$title,'message_id'=>$insert_id,'dealsid'=>$dealsid,"message" =>substr($this->input->post('name'),0,255),'image'=>$image1,"type"=>'deals',"currenttime"=>militime);
							   
									if(isset($gcmRegIds_android)) 
									{  
										$message = $pushMessage;
										$pushStatus = array();
								
										foreach($gcmRegIds_android as $val)
										{
										   $pushStatus[] = $this->Common_model->sendNotification($val, $message);
										}
									}
									
									if(isset($gcmRegIds_ios))
									{ 
										$text = $this->input->post('name');
										//$msg1 = preg_replace('/<[^>]*>/', '', $text);
										$msg1 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $text);

										$msg = str_replace('&nbsp;','',$msg1);
										$msg =strip_tags($msg);
										$desc='';
										$pushStatus1 = array();
										$i=0;
										foreach($gcmRegIds_ios as $val)
										{ 
										   $pushStatus1[] = $this->Common_model->iOSPushNotification($val,substr($msg,0,80),substr($desc,0,40),'deals',$dealsid);
										  $i++;   			
										}
									}  
									
						}	

                              $this->session->set_flashdata('success', 'Record added successfully.');


                        redirect('admin_adminusers/specialofferview/' . $this->input->post('dealsid'), 'refresh');
                    }
                }
            }
        }
    }

    function specialofferview($catid) {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');
        $data['catid'] = $catid;
        $data['dealslist'] = $this->Deals_model->specialoffer(base64_decode($catid));
        $data['main_content'] = 'admin/adminusers/specialofferview';
        $this->load->view('includes/template', $data);
    }

    function updatespecialactivestatus() {
        $data['role'] = $this->session->userdata('role');
        $updateid = $this->input->post('id');
        $updateRecord = array();
        $updateRecord['status'] = $this->input->post('status');


        $this->db->where('id', $updateid);
        $resultdata = $this->db->update('deals', $updateRecord);

        if ($updateRecord['status'] == 'deactive') {
            $this->session->set_flashdata('success', 'Deactivatd  successfully');
        } else {
            $this->session->set_flashdata('success', 'Activated  successfully');
        }
        echo 1;
        die;
    }

    function updateadvertisestatus() {

        $data['role'] = $this->session->userdata('role');
        $updateid = $this->input->post('id');
        $updateRecord = array();
        $updateRecord['status'] = $this->input->post('status');


        $this->db->where('id', $updateid);
        $resultdata = $this->db->update('advertise', $updateRecord);

        if ($updateRecord['status'] == 'deactive') {
            $this->session->set_flashdata('success', 'Deactivatd  successfully');
        } else {
            $this->session->set_flashdata('success', 'Activated  successfully');
        }
        echo 1;
        die;
    }

    function updatedealsstatus() {
        $data['role'] = $this->session->userdata('role');
        $updateid = $this->input->post('id');
        $updateRecord = array();
        $updateRecord['status'] = $this->input->post('status');


        $this->db->where('id', $updateid);
        $resultdata = $this->db->update('deals', $updateRecord);

        if ($updateRecord['status'] == 'deactive') {
            $this->session->set_flashdata('success', 'Deactivatd  successfully');
        } else {
            $this->session->set_flashdata('success', 'Activated  successfully');
        }
        echo 1;
        die;
    }

    function addspecialoffer($id) {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');
        $data['id'] = $id;
        $data['main_content'] = 'admin/adminusers/addspecialoffer';
        $this->load->view('includes/template', $data);
    }

    function adddealslist() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');

        if ($_REQUEST['Submit']) {

            if ($this->input->post("Submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Name', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {






                    $file_name = $_FILES['news_img']['name'];
                    $file_size = $_FILES['news_img']['size'];
                    $file_tmp = $_FILES['news_img']['tmp_name'];
                    $file_type = $_FILES['news_img']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['news_img']['name'])));
                    if ($file_name != '') {
                        $target_dir = "images/news/";
                        $rn_file = $target_dir . "" . $file_name;
                        $target_file = $target_dir . basename($_FILES["news_img"]["name"]);
                    } else {
                        $rn_file = '';
                    }
                    move_uploaded_file($file_tmp, $rn_file);
                    $expensions = array("jpeg", "jpg", "png");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }




                    $dataarray['name'] = $this->input->post('name');
                    $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $dataarray['name']));
                    $dataarray['slug'] = $urlt;
                    $dataarray['contactperson'] = $this->input->post('author');
                    $dataarray['image'] = $rn_file;
                    if ($this->input->post('email') != '') {
                        $dataarray['email'] = $this->input->post('email');
                    } else {
                        $dataarray['email'] = '';
                    }
                    if ($this->input->post('status') != '') {
                        $dataarray['status'] = $this->input->post('status');
                    } else {
                        $dataarray['status'] = '';
                    }
                    if ($this->input->post('contact') != '') {
                        $dataarray['contact'] = $this->input->post('contact');
                    } else {
                        $dataarray['contact'] = '';
                    }
                    if ($this->input->post('address') != '') {
                        $dataarray['address'] = $this->input->post('address');
                    } else {
                        $dataarray['address'] = '';
                    }
                    if ($this->input->post('about') != '') {
                        $dataarray['about'] = $this->input->post('about');
                    } else {
                        $dataarray['about'] = '';
                    }

                    /* $address=str_replace(" ",",",$this->input->post('address'));

                      $address = $address;

                      $url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address).'&sensor=false&key=AIzaSyBUliFf2ziMMBh6wLgCwbD4Ox-bmgEIjg8';

                      $ch = curl_init();
                      curl_setopt($ch, CURLOPT_URL, $url);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                      $responseJson = curl_exec($ch);
                      usleep(200000);
                      curl_close($ch);

                      $response = json_decode($responseJson);


                      if ($response->status == 'OK') {

                      $latitude = $response->results[0]->geometry->location->lat;
                      $longitude = $response->results[0]->geometry->location->lng;

                      }
                      else
                      {
                      $latitude ="";
                      $longitude ="";
                      } */


                    $latitude = $this->input->post('latitude');
                    $longitude = $this->input->post('longitude');

                    $dataarray['latitude'] = $latitude;
                    $dataarray['longitude'] = $longitude;
                    $dataarray['offername'] = '';
                    $dataarray['discount'] = '';
                    $dataarray['actualprice'] = '';
                    $dataarray['fromdate'] = '';
                    $dataarray['todate'] = '';
                    $dataarray['dealsid'] = '';
                    $dataarray['specialname'] = '';
                    $dataarray['totallikes'] = 0;
                    $dataarray['m_clicked'] = 0;
                    $dataarray['nposition'] = 0;
                    $dataarray['date'] = date("Y-m-d") . " " . date("H:i:s");

                    $dataarray['ip_address'] = $_SERVER['REMOTE_ADDR'];
                    $militime = round(microtime(true) * 1000);

                    $dataarray['create_at'] = $militime;
                    $dataarray['update_at'] = $militime;

                    $this->load->model('Deals_model');
                    $dataarray['news_result'] = $this->Deals_model->adddeals($dataarray);
					
					
					
					
					
					


                    $this->session->set_flashdata('success', 'Deals Added successfully.');
                    redirect('admin_adminusers/dealslist', 'refresh');
                }
            }
        }
        $data['main_content'] = 'admin/adminusers/adddealslist';
        $this->load->view('includes/template', $data);
    }

    function updatedatadeal() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');

        if ($_REQUEST['Submit']) {

            if ($this->input->post("Submit") != false) {



                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Name', 'trim|required');



                if ($this->form_validation->run() == FALSE) {


                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {



                    $file_name = $_FILES['news_img']['name'];
                    $file_size = $_FILES['news_img']['size'];
                    $file_tmp = $_FILES['news_img']['tmp_name'];
                    $file_type = $_FILES['news_img']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['news_img']['name'])));
                    if ($file_name != '') {
                        $target_dir = "images/news/";
                        $rn_file = $target_dir . "" . $file_name;
                        $target_file = $target_dir . basename($_FILES["news_img"]["name"]);
                    } else {
                        $rn_file = '';
                    }
                    //move_uploaded_file($file_tmp,$rn_file);
                    $expensions = array("jpeg", "jpg", "png");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }
                    $updateid = $this->input->post('updateid');

                    if ($file_name != '') {



                        $this->load->model('Deals_model');
                        $recordcheck = $this->Deals_model->Checkdealdata($updateid);

                        $existimage = $recordcheck[0]['image'];
                        $dataRecord = unlink('images/news/' . $existimage);
                        $uploadstatus = move_uploaded_file($file_tmp, $rn_file);
                        if ($this->input->post('name') != '') {
                            $dataarray['name'] = $this->input->post('name');
                        } else {
                            $dataarray['name'] = '';
                        }
                        $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $dataarray['name']));
                        $dataarray['slug'] = $urlt;
                        if ($this->input->post('author') != '') {
                            $dataarray['contactperson'] = $this->input->post('author');
                        } else {
                            $dataarray['contactperson'] = '';
                        }
                        $dataarray['image'] = $rn_file;
                        if ($this->input->post('email') != '') {
                            $dataarray['email'] = $this->input->post('email');
                        } else {
                            $dataarray['email'] = '';
                        }
                        if ($this->input->post('status') != '') {
                            $dataarray['status'] = $this->input->post('status');
                        } else {
                            $dataarray['status'] = '';
                        }
                        if ($this->input->post('contact') != '') {
                            $dataarray['contact'] = $this->input->post('contact');
                        } else {
                            $dataarray['contact'] = '';
                        }
                        if ($this->input->post('address') != '') {
                            $dataarray['address'] = $this->input->post('address');
                        } else {
                            $dataarray['address'] = '';
                        }
                        if ($this->input->post('about')) {
                            $dataarray['about'] = $this->input->post('about');
                        } else {
                            $dataarray['about'] = '';
                        }
                        $dataarray['latitude'] = $this->input->post('latitude');
                        $dataarray['longitude'] = $this->input->post('longitude');
                        $dataarray['offername'] = '';
                        $dataarray['discount'] = '';
                        $dataarray['actualprice'] = '';
                        $dataarray['fromdate'] = '';
                        $dataarray['todate'] = '';
                        $dataarray['dealsid'] = '';
                        $dataarray['specialname'] = '';
                        $dataarray['totallikes'] = $this->input->post('totallikes');
                        $dataarray['m_clicked'] = $this->input->post('m_clicked');
                        $dataarray['nposition'] = $this->input->post('nposition');

                        $dataarray['ip_address'] = $_SERVER['REMOTE_ADDR'];
                        $militime = round(microtime(true) * 1000);


                        $dataarray['update_at'] = $militime;



                        $this->db->where('id', $updateid);
                        $resultdata = $this->db->update('deals', $dataarray);

                        $this->session->set_flashdata('success', 'Record updated successfully.');
                        redirect('admin_adminusers/dealslist', 'refresh');
                    } else {

                        if ($this->input->post('name') != '') {
                            $dataarray['name'] = $this->input->post('name');
                        } else {
                            $dataarray['name'] = '';
                        }
                        $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $dataarray['name']));
                        $dataarray['slug'] = $urlt;
                        if ($this->input->post('author') != '') {
                            $dataarray['contactperson'] = $this->input->post('author');
                        } else {
                            $dataarray['contactperson'] = '';
                        }
                        if ($this->input->post('email') != '') {
                            $dataarray['email'] = $this->input->post('email');
                        } else {
                            $dataarray['email'] = '';
                        }
                        if ($this->input->post('status') != '') {
                            $dataarray['status'] = $this->input->post('status');
                        } else {
                            $dataarray['status'] = '';
                        }
                        if ($this->input->post('contact') != '') {
                            $dataarray['contact'] = $this->input->post('contact');
                        } else {
                            $dataarray['contact'] = '';
                        }
                        if ($this->input->post('address') != '') {
                            $dataarray['address'] = $this->input->post('address');
                        }
                        if ($this->input->post('about') != '') {
                            $dataarray['about'] = $this->input->post('about');
                        } else {
                            $dataarray['about'] = '';
                        }



                        $dataarray['latitude'] = $this->input->post('latitude');
                        $dataarray['longitude'] = $this->input->post('longitude');


                        $dataarray['offername'] = '';
                        $dataarray['discount'] = '';
                        $dataarray['actualprice'] = '';
                        $dataarray['fromdate'] = '';
                        $dataarray['todate'] = '';
                        $dataarray['dealsid'] = '';
                        $dataarray['specialname'] = '';
                        $dataarray['totallikes'] = $this->input->post('totallikes');
                        $dataarray['m_clicked'] = $this->input->post('m_clicked');
                        $dataarray['nposition'] = $this->input->post('nposition');
                        $dataarray['ip_address'] = $_SERVER['REMOTE_ADDR'];
                        $militime = round(microtime(true) * 1000);
                        $dataarray['update_at'] = $militime;
                        $this->db->where('id', $updateid);
                        $resultdata = $this->db->update('deals', $dataarray);
                        $this->session->set_flashdata('success', 'Record updated successfully.');
                        redirect('admin_adminusers/dealslist', 'refresh');
                    }
                }
            }
        }
    }

    function deals_updateview($editid) {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');
        $data['dealsedit'] = $this->Deals_model->dealseditlist(base64_decode($editid));
        $data['main_content'] = 'admin/adminusers/deals_updateview';
        $this->load->view('includes/template', $data);
    }

    function deletedeals() {

        $deletedata = base64_decode($this->input->post('id'));

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');
        $delete = $this->Deals_model->deletedeals($deletedata);
        die;
    }

    function dealslist() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Deals_model');
        $data['dealslist'] = $this->Deals_model->dealslist();



        $data['main_content'] = 'admin/adminusers/dealslist';
        $this->load->view('includes/template', $data);
    }

    function childsubcat($topcatid, $childsubcat) {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Category_model');
        $data['check_childsubcat'] = $this->Category_model->check_childsubcat(base64_decode($childsubcat));
        $data['main_content'] = 'admin/adminusers/childsubcat';
        $this->load->view('includes/template', $data);
    }

    function publish_program() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
		
        $data['publishprogramlist'] = $this->Register_model->publishprogramlist();
		
        $data['main_content'] = 'admin/adminusers/publish_program';
        $this->load->view('includes/template', $data);
    }

    function deletenews() {

        $this->load->model('News_model');
		$this->load->model('Deals_model');
        $deleteid = base64_decode($this->input->post('id'));
        $data['role'] = $this->session->userdata('role');

        $result = $this->News_model->deletenews($deleteid);
		$resultmanage = $this->Deals_model->deletemanagenotification($deleteid);
		
        $this->session->set_flashdata('success', 'Record deleted successfully.');
        die;
    }

    /**
     * This function is used to load the user list
     */
    function userListing() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data['role'] = $this->session->userdata('role');
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;


        $this->load->library('pagination');

        $count = $this->user_model->userListingCount($searchText);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;


        $data['userRecords'] = $this->user_model->userListing($searchText);

        $this->global['pageTitle'] = 'CodeInsect : User Listing';
        $data['totaldata'] = $this->user_model->user_total();


        $data['main_content'] = 'admin/adminusers/users';
        $this->load->view('includes/template', $data);
    }

    function workcategorylist() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $data['cat_result'] = $this->Register_model->workcategoryData();
        $data['main_content'] = 'admin/adminusers/workcategorylist';
        $this->load->view('includes/template', $data);
    }

    function editworkcategory($editid) {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $data['cat_result'] = $this->Register_model->editworkcategoryData(base64_decode($editid));

        $data['main_content'] = 'admin/adminusers/editworkcategory';
        $this->load->view('includes/template', $data);
    }

    function updateactivestatus() {
        $data['role'] = $this->session->userdata('role');
        $updateid = $this->input->post('id');
        $updateRecord = array();
        $updateRecord['status'] = $this->input->post('status');


        $this->db->where('id', $updateid);
        $resultdata = $this->db->update('news', $updateRecord);

        if ($updateRecord['status'] == 'deactive') {
            $this->session->set_flashdata('success', 'Deactivatd  successfully');
        } else {
            $this->session->set_flashdata('success', 'Activated  successfully');
        }
        echo 1;
        die;
    }
	
	
	
	function updateimagestatus() {
		 $this->load->model('Common_model');
        $data['role'] = $this->session->userdata('role');
        $updateid = trim($this->input->post('id'));
        $updateRecord = array();
        $updateRecord['imagetype'] = $this->input->post('status');


        $this->db->where('id', $updateid);
        $resultdata = $this->db->update('news', $updateRecord);
		
		$checknewsData = $this->Common_model->common_getRow('news',array('id'=>$updateid));
		$imagetype=$checknewsData->imagetype;
		
		
		
		if($imagetype==0) 
		{ 
		$smval='selected';
		}
		if($imagetype==1) 
		{ 
		$smval1='selected';
		}
		if($imagetype==2) 
		{ 
		$smval2='selected';
		}
		
		
		
		$data="
		
	<select name='imagetype' id='imagetype' onchange='checkimgstatus(".ltrim($updateid).",this.value)'>
	<option value=''>Select Status</option>";
	$data.="<option value='0' ".$smval." >Small</option>";
	$data.="<option value='1' ".$smval1.">Big</option>";
	$data.="<option value='2' ".$smval2.">Banner</option>";
	
	$data.="</select>
	";
		
        
        echo $data;
        die;
    }
	
	
	
	function deleteprogram()
	{
	
		$this->load->model('Register_model');
        $deleteid = base64_decode($this->input->post('id'));
        $data['role'] = $this->session->userdata('role');
		$result = $this->Register_model->deleteProgramData($deleteid);
        $this->session->set_flashdata('success', 'Record deleted successfully.');
        die;	
	
		
	}
	
	
	

    function jobslisting() {


        $data['role'] = $this->session->userdata('role');
        $this->load->model('Job_model');
        $data['job_result'] = $this->Job_model->joblist();



        $data['main_content'] = 'admin/adminusers/jobslisting';
        $this->load->view('includes/template', $data);
    }

    function addjob() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Job_model');
        if ($_REQUEST['Submit']) {



            if ($this->input->post("Submit") != false) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('companyname', 'Title', 'trim|required');
                $this->form_validation->set_rules('companyprofile', 'Title', 'trim|required');
                $this->form_validation->set_rules('status', 'Title', 'trim|required');
                $this->form_validation->set_rules('jobtitle', 'Title', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                $this->form_validation->set_rules('jobdescription', 'Title', 'trim|required');
                $this->form_validation->set_rules('jobtype', 'Title', 'trim|required');



                if ($this->form_validation->run() == FALSE) {




                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {

                    $file_name = $_FILES['job_img']['name'];
                    $file_size = $_FILES['job_img']['size'];
                    $file_tmp = $_FILES['job_img']['tmp_name'];
                    $file_type = $_FILES['job_img']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['job_img']['name'])));
                    $target_dir = "images/job/";
                    $rn_file = $target_dir . "" . $file_name;
                    $target_file = $target_dir . basename($_FILES["job_img"]["name"]);


                    $expensions = array("jpeg", "jpg", "png");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }
                    $uploadstatus = move_uploaded_file($file_tmp, $rn_file);
                    $insertarray['image'] = $file_name;
                    $insertarray['companyname'] = $this->input->post('companyname');
                    $insertarray['companyprofile'] = $this->input->post('companyprofile');
                    $insertarray['status'] = $this->input->post('status');
                    $insertarray['address'] = $this->input->post('caddress');
                    $insertarray['jobtitle'] = $this->input->post('jobtitle');
                    $insertarray['email'] = $this->input->post('email');

                    $insertarray['jobdescription'] = $this->input->post('jobdescription');
                    $insertarray['jobtype'] = $this->input->post('jobtype');
                    $insertarray['desiredcandidate'] = $this->input->post('desiredcondidate');
                    $insertarray['keyskill'] = $this->input->post('keyskill');
                    $insertarray['datetime'] = date('Y-m-d h:m:s');
                    $insertarray['jobview'] = 0;
                    $militime = round(microtime(true) * 1000);
                    $insertarray['userid'] = 41;
                    $insertarray['create_at'] = $militime;
                    $insertarray['update_at'] = $militime;

					
                    $recordcheck = $this->Job_model->addjob($insertarray);
                    if ($recordcheck) {
                        redirect('admin_adminusers/jobslisting', 'refresh');
                    }
                }
            }
        }

        $data['main_content'] = 'admin/adminusers/addjob';
        $this->load->view('includes/template', $data);
    }

    function editjob($editid) {

        $this->load->model('Job_model');

        if ($this->input->post("submit") != false) {



            $this->load->library('form_validation');
            $this->form_validation->set_rules('companyname', 'Title', 'trim|required');
            $this->form_validation->set_rules('companyprofile', 'Title', 'trim|required');
            $this->form_validation->set_rules('status', 'Title', 'trim|required');
            $this->form_validation->set_rules('jobtitle', 'Title', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('jobdescription', 'Title', 'trim|required');
            $this->form_validation->set_rules('jobtype', 'Title', 'trim|required');



            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('error', 'Please check fill data.');
            } else {



                $updateid = $this->input->post('updateid');


                $file_name = $_FILES['job_img']['name'];
                $file_size = $_FILES['job_img']['size'];
                $file_tmp = $_FILES['job_img']['tmp_name'];
                $file_type = $_FILES['job_img']['type'];
                $file_ext = strtolower(end(explode('.', $_FILES['job_img']['name'])));
                $target_dir = "images/job/";
                $rn_file = $target_dir . "" . $file_name;
                $target_file = $target_dir . basename($_FILES["job_img"]["name"]);

                $expensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $expensions) === false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                }

                if ($file_size > 2097152) {
                    $errors[] = 'File size must be excately 2 MB';
                }
                if ($file_name != '') {

                    $recordcheck = $this->Job_model->job_record_news($updateid);
                    $existimage = $recordcheck[0]['image'];
                    $dataRecord = unlink('images/job/' . $existimage);
                    $uploadstatus = move_uploaded_file($file_tmp, $rn_file);

                    $updatearray['image'] = $file_name;
                    $updatearray['companyname'] = $this->input->post('companyname');
                    $updatearray['companyprofile'] = $this->input->post('companyprofile');
                    $updatearray['status'] = $this->input->post('status');
                    $updatearray['address'] = $this->input->post('caddress');
                    $updatearray['jobtitle'] = $this->input->post('jobtitle');
                    $updatearray['email'] = $this->input->post('email');
                    $updatearray['jobdescription'] = $this->input->post('jobdescription');
                    $updatearray['jobtype'] = $this->input->post('jobtype');
                    $updatearray['desiredcandidate'] = $this->input->post('desiredcondidate');
                    $updatearray['keyskill'] = $this->input->post('keyskill');
                    $updatearray['datetime'] = date('Y-m-d h:m:s');
                    $updatearray['jobview'] = 0;
                    $militime = round(microtime(true) * 1000);
                    $updatearray['userid'] = 41;
                    $updatearray['create_at'] = $militime;
                    $updatearray['update_at'] = $militime;


                    $this->db->where('id', $updateid);
                    $resultdata = $this->db->update('job', $updatearray);

                    $this->session->set_flashdata('success', 'Record updated successfully.');
                    redirect('admin_adminusers/jobslisting', 'refresh');
                } else {


                    $updatearray['companyname'] = $this->input->post('companyname');
                    $updatearray['companyprofile'] = $this->input->post('companyprofile');
                    $updatearray['status'] = $this->input->post('status');
                    $updatearray['address'] = $this->input->post('caddress');
                    $updatearray['jobtitle'] = $this->input->post('jobtitle');
                    $updatearray['email'] = $this->input->post('email');
                    $updatearray['jobdescription'] = $this->input->post('jobdescription');
                    $updatearray['jobtype'] = $this->input->post('jobtype');
                    $updatearray['desiredcandidate'] = $this->input->post('desiredcondidate');
                    $updatearray['keyskill'] = $this->input->post('keyskill');
                    $updatearray['datetime'] = date('Y-m-d h:m:s');
                    $updatearray['jobview'] = 0;

                    $militime = round(microtime(true) * 1000);
                    $updatearray['userid'] = 41;
                    $updatearray['create_at'] = $militime;
                    $updatearray['update_at'] = $militime;


                    $this->db->where('id', $updateid);
                    $resultdata = $this->db->update('job', $updatearray);
                    $this->session->set_flashdata('success', 'Record updated successfully.');
                }


                redirect('admin_adminusers/jobslisting', 'refresh');
            }
        }


        $data['edit_result'] = $this->Job_model->edit_record_job(base64_decode($editid));
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/editjob';
        $this->load->view('includes/template', $data);
    }

    function deletejob() {

        $this->load->model('Job_model');
        $deleteid = base64_decode($this->input->post('id'));
        $data['role'] = $this->session->userdata('role');

        $result = $this->Job_model->deletejobData($deleteid);
        $this->session->set_flashdata('success', 'Record deleted successfully.');
        die;
    }

   

    function editprogram($editid) {
		
		$editidval = base64_decode($editid);
        $this->load->model('Register_model');
		$data['edit_result'] = $this->Register_model->editprogram($editidval);
		$data['user_blog'] = $flag;
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/editprogram';
        $this->load->view('includes/template', $data);
    }

    function updateprogram() {
		
			
		

        $this->load->model('Register_model');
		 $this->load->model('Common_model');
        if (isset($_REQUEST['Submit'])!="") {



            if ($this->input->post("Submit") != false) 
			{
                $this->load->library('form_validation');
                $this->form_validation->set_rules('program_title', 'Title', 'trim|required');
                if ($this->form_validation->run() == FALSE) 
				{
                    $this->session->set_flashdata('error', 'Please check fill data.');
                } else {
					
					
                   $updateid = $this->input->post('updateid');

                    
					$file_name = $_FILES['programimg']['name'];
                    $file_size = $_FILES['programimg']['size'];
                    $file_tmp = $_FILES['programimg']['tmp_name'];
                    $file_type = $_FILES['programimg']['type'];
					
                     $file_extu = strtolower(end(explode('.', $_FILES['programimg']['name'])));
					
                    $target_dir = "images/courseimg/";
                    $rn_file = $target_dir . "" . $file_name;
                    $target_file = $target_dir . basename($_FILES["programimg"]["name"]);
					
					$filepathwithoutext = basename($target_file,".".$file_extu);
					
					
                    $expensions = array("jpeg", "jpg", "png");

                    if (in_array($file_extu, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }
					
					
					
					$file_namepdf = $_FILES['uploadpf']['name'];
                    $file_sizepdf = $_FILES['uploadpf']['size'];
                    $file_tmppdf = $_FILES['uploadpf']['tmp_name'];
                    $file_typepdf = $_FILES['uploadpf']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['uploadpf']['name'])));
                    $target_dirpdf = "images/coursepdf/";
                    $rn_filepdf = $target_dirpdf . "" . $file_namepdf;
                    $target_file = $target_dirpdf . basename($_FILES["uploadpf"]["name"]);
                    $expensions = array("jpeg", "jpg", "pdf");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }

                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                    }
					
                  
                 
                    if ($file_name!= "") 
					{
						
						 $rn_file = $target_dir . "" . $file_name;
					    $rand = rand(0000,9999);
						$mainfileupload=$target_dir . "" . $filepathwithoutext.$rand.'.'.$file_extu;
						
					    
                         $updatefile=$filepathwithoutext.$rand.'.'.$file_extu;
						//$mainfile=$file_tmp.$rand;
						$recordcheck = $this->Register_model->edit_record_program($updateid);
						$existimage = $recordcheck[0]['course_image'];
						
						
						
						 $dataRecord = unlink('./images/courseimg/' . $existimage);
					
						
						$uploadstatus = move_uploaded_file($file_tmp, $mainfileupload);
						
						
						
						$updatearray['course_title'] = $this->input->post('program_title');
						$updatearray['course_desc'] = $this->input->post('description');
						$updatearray['short_coursedesc'] = $this->input->post('short_coursedesc');
						$updatearray['course_price'] = $this->input->post('price');
						$updatearray['course_image'] = $updatefile;
						
						$updatearray['teacher_name'] = $this->input->post('teachername');
					    $updatearray['hours'] = $this->input->post('duration');
						
						
						$updatearray['coursediscount'] = $this->input->post('discount');
						$this->db->where('id', $updateid);
						$resultdata = $this->db->update('courses', $updatearray);
						$this->session->set_flashdata('success', 'News  update successfully');
                    }
					
					elseif($file_namepdf!="")
					{
						
						$recordcheck = $this->Register_model->edit_record_program($updateid);
                        $existimage = $recordcheck[0]['coursepdf'];
                        $dataRecord = unlink('/images/coursepdf/' . $existimage);
                        $uploadstatus = move_uploaded_file($file_tmppdf, $rn_filepdf);
						$updatearray['course_title'] = $this->input->post('program_title');
						$updatearray['course_desc'] = $this->input->post('description');
						$updatearray['short_coursedesc'] = $this->input->post('short_coursedesc');
						$updatearray['course_price'] = $this->input->post('price');
						$updatearray['teacher_name'] = $this->input->post('teachername');
					    $updatearray['hours'] = $this->input->post('duration');
						$updatearray['coursepdf'] 	 = $file_namepdf;
						$updatearray['coursediscount'] = $this->input->post('discount');
                        $this->db->where('id', $updateid);
                        $resultdata = $this->db->update('courses', $updatearray);
                        $this->session->set_flashdata('success', 'News  update successfully');
						
					}
					
					
					else
					{
						
						
						
						$updatearray['course_title'] = $this->input->post('program_title');
						$updatearray['course_desc'] = $this->input->post('description');
						$updatearray['short_coursedesc'] = $this->input->post('short_coursedesc');
						$updatearray['course_price'] = $this->input->post('price');
						$updatearray['coursediscount'] = $this->input->post('discount');
						$updatearray['teacher_name'] = $this->input->post('teachername');
					    $updatearray['hours'] = $this->input->post('duration');
                        $this->db->where('id', $updateid);
                        $resultdata = $this->db->update('courses', $updatearray);
						
					}
					    
					}
						
                       
                    }

                   
                    if ($resultdata) {
                        redirect('admin_adminusers/publish_program', 'refresh');
                    }
                }
            }
    
	
	
	

    function highereducation() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $data['news_result'] = $this->Register_model->highereducation();
        $data['main_content'] = 'admin/adminusers/highereducation';
        $this->load->view('includes/template', $data);
    }

    function research_other() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $data['news_result'] = $this->Register_model->research_other();
        $data['main_content'] = 'admin/adminusers/research_other';
        $this->load->view('includes/template', $data);
    }

    function generalnews() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $data['news_result'] = $this->Register_model->general_news();
        $data['main_content'] = 'admin/adminusers/generalnews';
        $this->load->view('includes/template', $data);
    }

    function trandingnews() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $data['news_result'] = $this->Register_model->tranding_news();
        $data['main_content'] = 'admin/adminusers/trandingnews';
        $this->load->view('includes/template', $data);
    }

    function user_blog() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $data['news_result'] = $this->Register_model->user_blog_data();
        $data['main_content'] = 'admin/adminusers/user_blog';
        $this->load->view('includes/template', $data);
    }

    function liveuser() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $data['user_result'] = $this->Register_model->Userdetails();
        $data['main_content'] = 'admin/adminusers/liveuser';
        $this->load->view('includes/template', $data);
    }

    function deleteliveuser() {

        $deleteid = base64_decode($this->input->post('id'));
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Register_model');
        $result = $this->Register_model->deleteLiveUserData($deleteid);
        $this->session->set_flashdata('success', 'Record deleted successfully.');
        die;
    }

    function deletegrading($deleteid) {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }
        $deleteid = base64_decode($deleteid);
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Grade_model');
        $result = $this->Grade_model->deletegrade($deleteidval);
        $this->session->set_flashdata('success', 'Record deleted successfully.');
        redirect('admin_adminusers/viewgradelist');
    }

    function addNew() {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data['role'] = $this->session->userdata('role');
        $this->load->model('user_model');
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'CodeInsect : Add New User';


        $data['main_content'] = 'admin/adminusers/addNew';
        $this->load->view('includes/template', $data);
    }

    function viewmasterbuget() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Masterbudget_model');
        $data['budget_records'] = $this->Masterbudget_model->Budgetlist();
        $data['main_content'] = 'admin/adminusers/viewmasterbuget';


        $this->load->view('includes/template', $data);
    }

    function viewgradelist() {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Grade_model');
        $data['display_all_data'] = $this->Grade_model->GradeList();
        $data['main_content'] = 'admin/adminusers/viewgradelist';
        $this->load->view('includes/template', $data);
    }

    function editgrading($editidval) {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $editidval = base64_decode($editidval);

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Grade_model');
        $data['division_records'] = $this->Grade_model->DivisionList();
        //$data['budget_edit'] = $this->Grade_model->Budgetlistedit($editidval);


        $data['grade_edit'] = $this->Grade_model->Gradelistedit($editidval);


        $data['main_content'] = 'admin/adminusers/editgrading';

        $this->load->view('includes/template', $data);
    }

    function updateempgrade() {


        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $updateid = $this->input->post('updateid');
        $data['role'] = $this->session->userdata('role');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('division', 'Division', 'trim|required');
        $this->form_validation->set_rules('Grade', 'Grade', 'trim|required');

        $this->form_validation->set_rules('gradename', 'gradename', 'trim|required');

        $this->form_validation->set_rules('Incentive', 'Incentive', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', 'Please check fill data.');
            redirect('admin_adminusers/editgrading');
        } else {

            $data['role'] = $this->session->userdata('role');
            $updateRecord = array();

            $updateRecord['division_id'] = $this->input->post('division');
            $updateRecord['grade'] = $this->input->post('Grade');
            $updateRecord['grade_name'] = $this->input->post('gradename');
            $updateRecord['Incentive'] = $this->input->post('Incentive');


            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('tbl_grade', $updateRecord);

            $this->session->set_flashdata('success', 'Record update successfully');

            redirect('admin_adminusers/viewgradelist', 'refresh');
        }
    }

    function addempgrade() {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Grade_model');
        $this->load->model('User_model');
        $data['division_records'] = $this->Grade_model->DivisionList();
        $data['role'] = $this->session->userdata('role');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('division', 'Division', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('Grade', 'Grade', 'trim|required');
        $this->form_validation->set_rules('gradename', 'Grade name', 'required');
        $this->form_validation->set_rules('Incentive', 'Incentive', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please check fill data.');
        } else {

            if ($this->input->post()) {
                $division = $this->input->post('division');
                $Grade = $this->input->post('Grade');
                $gradename = $this->input->post('gradename');
                $Incentive = $this->input->post('Incentive');
                $graderecord = array('division_id' => $division, 'grade' => $Grade, 'grade_name' => $gradename, 'incentive' => $Incentive);
                $this->load->model('Grade_model');
                $result = $this->Grade_model->addgrade($graderecord);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Grade added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Grade  failed');
                }
            }

            redirect('admin_adminusers/viewgradelist');
        }


        $data['main_content'] = 'admin/adminusers/addempgrade';
        $this->load->view('includes/template', $data);
    }

    function addbudget() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }
        $data['role'] = $this->session->userdata('role');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('monthname', 'Month name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('year', 'year', 'trim|required');
        $this->form_validation->set_rules('Currency', 'Currency', 'required|max_length[20]');
        $this->form_validation->set_rules('monthlybudget', 'Monthly Budget', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
        } else {

            if ($this->input->post()) {

                $monthname = $this->input->post('monthname');
                $year = $this->input->post('year');
                $Currency = $this->input->post('Currency');
                $monthlybudget = $this->input->post('monthlybudget');


                $budget = array('month_name' => $monthname, 'year' => $year, 'Currency' => $Currency, 'month_budget' => $monthlybudget);

                $this->load->model('Masterbudget_model');
                $result = $this->Masterbudget_model->addbudget($budget);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'add budget successfully');
                } else {
                    $this->session->set_flashdata('error', 'add budget  failed');
                }
            }

            redirect('admin_adminusers/viewmasterbuget');
        }





        $data['main_content'] = 'admin/adminusers/addbudget';
        $this->load->view('includes/template', $data);
    }

    function editbudget($editid) {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $editidval = base64_decode($editid);
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Masterbudget_model');
        $data['budget_edit'] = $this->Masterbudget_model->Budgetlistedit($editidval);

        $data['main_content'] = 'admin/adminusers/editbudget';

        $this->load->view('includes/template', $data);
    }

    function deletebudget($deleteid) {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $deleteidval = base64_decode($deleteid);
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Masterbudget_model');

        $result = $this->Masterbudget_model->deletebudget($deleteidval);
        $this->session->set_flashdata('success', 'Record deleted successfully.');
        redirect('admin_adminusers/viewmasterbuget');
    }

    function updatebudget() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $updateid = $this->input->post('updateid');
        $data['role'] = $this->session->userdata('role');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('monthname', 'Month Name', 'trim|required');
        $this->form_validation->set_rules('year', 'year', 'trim|required');

        $this->form_validation->set_rules('monthlybudget', 'monthlybudget', 'trim|required');

        $this->form_validation->set_rules('Currency', 'Currency', 'trim|required');







        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
            redirect('admin_adminusers/editbudget');
        } else {


            $updateRecord = array();
            $empid = $this->input->post('employeename');
            $updateRecord['month_name'] = $this->input->post('monthname');
            $updateRecord['year'] = $this->input->post('year');
            $updateRecord['month_budget'] = $this->input->post('monthlybudget');
            $updateRecord['Currency'] = $this->input->post('Currency');


            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('tbl_master_budget', $updateRecord);

            $this->session->set_flashdata('success', 'Record update successfully');

            redirect('admin_adminusers/viewmasterbuget', 'refresh');
        }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data['role'] = $this->session->userdata('role');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'User creation failed');
            redirect('admin_adminusers/addNew');
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->security->xss_clean($this->input->post('mobile'));

            $userInfo = array('email' => $email, 'password' => md5($password), 'roleId' => $roleId, 'name' => $name,
                'mobile' => $mobile, 'createdBy' => $data['role'], 'createdDtm' => date('Y-m-d H:i:s'));

            $this->load->model('user_model');
            $result = $this->user_model->addNewUser($userInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'New User created successfully');
            } else {
                $this->session->set_flashdata('error', 'User creation failed');
            }

            redirect('admin_adminusers/userListing');
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data['role'] = $this->session->userdata('role');

        $userId = $this->input->post('userId');
        $userInfo = array('isDeleted' => 1, 'updatedBy' => $data['role'], 'updatedDtm' => date('Y-m-d H:i:s'));

        $result = $this->user_model->deleteUser($userId, $userInfo);

        if ($result > 0) {
            echo(json_encode(array('status' => TRUE)));
        } else {
            echo(json_encode(array('status' => FALSE)));
        }
    }

    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL) {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data['role'] = $this->session->userdata('role');


        if ($userId == null) {
            redirect('admin_adminusers/userListing');
        }

        $data['roles'] = $this->user_model->getUserRoles();
        $data['userInfo'] = $this->user_model->getUserInfo($userId);



        $this->global['pageTitle'] = 'ATMC : Edit User';


        $data['main_content'] = 'admin/adminusers/editOld';
        $this->load->view('includes/template', $data);
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {
            echo("true");
        } else {
            echo("false");
        }
    }

    /**
     * This function is used to edit the user information
     */
    function editUser() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data['role'] = $this->session->userdata('role');
        $this->load->library('form_validation');

        $userId = $this->input->post('userId');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check data.');
            redirect('admin_adminusers/addNew');
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->security->xss_clean($this->input->post('mobile'));

            $userInfo = array();

            if (empty($password)) {
                $userInfo = array('email' => $email, 'roleId' => $roleId, 'name' => $name,
                    'mobile' => $mobile, 'updatedBy' => $data['role'], 'updatedDtm' => date('Y-m-d H:i:s'));
            } else {
                $userInfo = array('email' => $email, 'password' => md5($password), 'roleId' => $roleId,
                    'name' => ucwords($name), 'mobile' => $mobile, 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s'));
            }

            $result = $this->user_model->editUser($userInfo, $userId);

            if ($result == true) {
                $this->session->set_flashdata('success', 'User updated successfully');
            } else {
                $this->session->set_flashdata('error', 'User updation failed');
            }

            redirect('admin_adminusers/userListing');
        }
    }

    //******** import employee***/

    function importemployee() {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/importemployee';
        $this->load->view('includes/template', $data);
    }

    function importdata() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Employeelist_old_model');
        $this->load->model('Employeelist_model');
        $this->form_validation->set_rules('file', 'Please Select valid Excel File', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        if ($this->input->server('REQUEST_METHOD') === 'POST' && !empty($_FILES['file']['name'])) {

            // if ($this->form_validation->run()) {
            // Get File extension eg. 'xlsx' to check file is excel sheet
            $pathinfo = pathinfo($_FILES["file"]["name"]);

            // check file has extension xlsx, xls and also check 
            // file is not empty


            if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') && $_FILES['file']['size'] > 0) {

                // Temporary file name
                $inputFileName = $_FILES['file']['tmp_name'];

                // Read excel file by using ReadFactory object.
                $reader = ReaderFactory::create(Type::XLSX);

                // Open file
                $reader->open($inputFileName);


                $countData = $this->Employeelist_model->checkEmployeelistData();
                if ($countData > 0) {
                    $this->Employeelist_model->deleteallrecord();
                }

                $count = 1;

                // Number of sheet in excel file
                foreach ($reader->getSheetIterator() as $sheet) {

                    // Number of Rows in Excel sheet
                    foreach ($sheet->getRowIterator() as $row) {


                        if ($count > 1) {

                            /*                             * *** Data of excel sheet * */
                            if ($row[0] != "") {
                                $data['Name'] = $row[0];
                            } else {
                                $data['Name'] = "";
                            }
                            if ($row[1] != "") {
                                $data['Reporting'] = $row[1];
                            } else {
                                $data['Reporting'] = "";
                            }
                            if ($row[2] != "") {
                                $data['Division'] = $row[2];
                            } else {
                                $data['Division'] = "";
                            }
                            if ($row[3] != "") {
                                $data['Department'] = $row[3];
                            } else {
                                $data['Department'] = "";
                            }
                            if ($row[4] != "") {
                                $data['Grade'] = $row[4];
                            } else {
                                $data['Grade'] = "";
                            }
                            if ($row[5] != "") {
                                $data['rating'] = $row[5];
                            } else {
                                $data['rating'] = "";
                            }
                            if ($row[6] != "") {
                                $data['email'] = $row[6];
                            } else {
                                $data['email'] = "";
                            }
                            if ($row[7] != "") {
                                $data['empcode'] = $row[7];
                            } else {
                                $data['empcode'] = "";
                            }

                            $joiningdate = $row[8];
                            if ($joiningdate != "") {

                                foreach ($joiningdate as $key => $date) {
                                    
                                }

                                $data['joining'] = $joiningdate->format('Y-m-d');
                            }
                            if ($row[9] != "") {
                                $data['mobile'] = $row[9];
                            } else {
                                $data['mobile'] = "";
                            }




                            $data_to_store = array(
                                'name' => $data['Name'],
                                'reporting_to' => $data['Reporting'],
                                'division' => $data['Division'],
                                'department' => $data['Department'],
                                'grade' => $data['Grade'],
                                'rating' => $data['rating'],
                                'email' => $data['email'],
                                'empcode' => $data['empcode'],
                                'grading_date' => date('Y-m-d'),
                                'join_date' => $data['joining'],
                                'mobile_no' => $data['mobile'],
                                'status' => '0',
                            );


                            $this->Employeelist_model->store_information_excel($data_to_store);
                            $this->Employeelist_old_model->store_old_record_excel($data_to_store);



                            $this->session->set_flashdata('updated', 'Imported  excel data successfully!');
                        }



                        $count++;
                    }
                }

                if ($data != "") {
                    redirect('/admin_adminusers/employeelist', 'refresh', $data);
                }


                $reader->close();
            } else {


                $this->session->set_flashdata('updated', 'Please Select Valid Excel File!');
            }
        }
        //}
        else {
            
        }

        $data['main_content'] = 'admin/adminusers/importemployee';
        $this->load->view('includes/template', $data);
    }

    function editdepartemployeelist($editid) {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data['edit_id'] = $editid;
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Employeelist_model');
        $data['userId'] = $this->session->userdata('userId');
        $this->load->model('Grade_model');
        $this->load->model('User_model');
        $data['manager_records'] = $this->User_model->managerunique($data['userId']);
        $data['employee_records'] = $this->Employeelist_model->employeeunique($data['manager_records'][0]['email']);
        $data['all_employee_records'] = $this->Employeelist_model->manageremplist($data['employee_records'][0]['name']);
        $data['rating_records'] = $this->Grade_model->fetchrating();
        $data['emplist_records'] = $this->Employeelist_model->employeelist();
        $data['empedit_record'] = $this->Employeelist_model->employeelistedit($editid);

        $data['main_content'] = 'admin/adminusers/editdepartemployeelist';
        $this->load->view('includes/template', $data);
    }

    function updateratingemployee() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $updateid = $this->input->post('updateid');
        $data['role'] = $this->session->userdata('role');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('reasonrating', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('reporting', 'Reporting', 'trim|required');

        $this->form_validation->set_rules('employeename', 'Employee', 'trim|required');

        $this->form_validation->set_rules('Rating', 'Department', 'trim|required');







        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
            redirect('admin_adminusers/editdepartemployeelist');
        } else {


            $updateRecord = array();
            $empid = $this->input->post('employeename');
            $updateRecord['name'] = $this->security->xss_clean($this->input->post('reporting'));

            $Rating = $this->security->xss_clean($this->input->post('Rating'));

            $reasonrating = $this->security->xss_clean($this->input->post('reasonrating'));

            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('tbl_employeelist', $updateRecord);

            $this->session->set_flashdata('success', 'Record update successfully');

            redirect('admin_adminusers/employeelist', 'refresh');
        }


        die;
    }

    function employeelist() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data['role'] = $this->session->userdata('role');
        $this->load->model('Employeelist_model');
        $data['emplist_records'] = $this->Employeelist_model->employeelist();
        $data['main_content'] = 'admin/adminusers/employeelist';
        $this->load->view('includes/template', $data);
    }

    function editemplist($editid) {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/editemplist';
        $this->load->model('Employeelist_model');
        $this->load->model('Grade_model');
        $this->load->model('User_model');

        $data['grade_records'] = $this->Grade_model->GradeList();
        $data['division_records'] = $this->Grade_model->DivisionList();
        $data['department_records'] = $this->Grade_model->departmentlist();
        $data['manager_records'] = $this->User_model->managerlist();
        $data['editemp'] = $this->Employeelist_model->employeelistedit($editid);

        $this->load->view('includes/template', $data);
    }

    function updateemplist() {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('grade', 'Grade', 'trim|required');

        $this->form_validation->set_rules('reporting', 'Reporting Manager', 'trim|required');

        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('division', 'division', 'trim|required');


        $this->form_validation->set_rules('joindate', 'joindate', 'trim|required');
        $this->form_validation->set_rules('probation_date', 'probation date', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]');
        $this->form_validation->set_rules('Empcode', 'Empcode', 'trim|required|max_length[255]');

        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');


        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
            redirect('admin_adminusers/addstaff');
        } else {

            $this->load->model('Employeelist_model');
            $updateid = $this->input->post('updateid');
            $this->load->model('Employeelist_model');
            $jdate = explode("-", $this->input->post('joindate'));
            $jdateformat = $jdate[2] . "-" . $jdate[1] . "-" . $jdate[0];
            $provationdt = explode("-", $this->input->post('probation_date'));
            $provationdate = $provationdt[2] . "-" . $provationdt[1] . "-" . $provationdt[0];

            $updateRecord = array();
            $updateRecord['name'] = $this->input->post('fname');
            $updateRecord['grade'] = $this->input->post('grade');
            $updateRecord['reporting_to'] = $this->input->post('reporting');
            $updateRecord['department'] = $this->input->post('department');
            $updateRecord['division'] = $this->input->post('division');
            $updateRecord['join_date'] = $jdateformat;
            $updateRecord['probation_date'] = $provationdate;
            $updateRecord['email'] = $this->input->post('email');
            $updateRecord['empcode'] = $this->input->post('Empcode');
            $updateRecord['mobile_no'] = $this->input->post('mobile');
            $updateRecord['status'] = '0';


            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('tbl_employeelist', $updateRecord);

            $this->session->set_flashdata('success', 'Record update successfully');

            redirect('admin_adminusers/employeelist', 'refresh');
        }
    }

    function addgrade() {


        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data['role'] = $this->session->userdata('role');
        $data['userId'] = $this->session->userdata('userId');
        $this->load->model('Employeelist_model');
        $this->load->model('Grade_model');
        $this->load->model('User_model');

        $data['grade_records'] = $this->Grade_model->GradeList();

        $data['department_records'] = $this->Grade_model->departmentlist();
        $data['manager_records'] = $this->User_model->managerunique($data['userId']);

        $data['employee_records'] = $this->Employeelist_model->employeeunique($data['manager_records'][0]['email']);


        $data['all_employee_records'] = $this->Employeelist_model->manageremplist($data['employee_records'][0]['name']);

        $data['rating_records'] = $this->Grade_model->fetchrating();




        $data['main_content'] = 'admin/adminusers/addgrade';
        $this->load->view('includes/template', $data);
    }

    function viewdepartemployeelist() {


        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $departmentdata = $this->input->post('departmentdata');
        $managername = $this->input->post('managername');
        $empname = $this->input->post('empname');

        $data['role'] = $this->session->userdata('role');
        $data['userId'] = $this->session->userdata('userId');
        $this->load->model('Employeelist_model');
        $this->load->model('Grade_model');
        $this->load->model('User_model');

        $data['manager_records'] = $this->User_model->managerunique($data['userId']);

        $data['employee_records'] = $this->Employeelist_model->employeeunique($data['manager_records'][0]['email']);

        if ($data['role'] == 2) {
            $data['all_employee_records'] = $this->Employeelist_model->manageremplist($data['employee_records'][0]['name']);
        }
        if ($data['role'] == 1) {



            $data['search_managers'] = $this->Employeelist_model->searchManagerlist();
            $data['search_department'] = $this->Employeelist_model->searchdepartlist();


            $data['all_employee_records'] = $this->Employeelist_model->manageremplistadmin($departmentdata, $managername, $empname);
        }


        $data['main_content'] = 'admin/adminusers/viewdepartemployeelist';
        $this->load->view('includes/template', $data);
    }

    function checkmanagerlist() {


        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $this->load->model('Employeelist_model');
        $depdata = $this->input->post('depdata');
        $data['search_managers_data'] = $this->Employeelist_model->searchManagerbydepartment($depdata);
        $dataval = '<select class="form-control" id="managername" name="managername" style="width:200px;" onchange="findmanager(this.value);>
        <option value="0">Select managers</option>';

        foreach ($data['search_managers_data'] as $val) {


            $dataval .= '<option  value=' . trim($val["id"]) . ' style="color:#000;">' . $val["reporting_to"] . '</option>';
        }

        $dataval .= '</select>';
        echo $dataval;
        die;
    }

    function checkEmplist() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $this->load->model('Employeelist_model');
        $managerid = $this->input->post('managerData');

        $data['check_man_data'] = $this->Employeelist_model->searchmname($managerid);
        $recordname = $data['check_man_data'][0]['reporting_to'];

        $data['check_all_data'] = $this->Employeelist_model->searchempname($recordname);

        $dataval = '<select class="form-control" style="width:200px" id="empname" name="empname" >
       <option value="0">Select Employee</option>';
        foreach ($data['check_all_data'] as $val) {

            $dataval .= '<option  value=' . $val["id"] . ' style="color:#000;">' . $val["name"] . '</option>';
        }


        $dataval .= '</select>';
        echo $dataval;
        die;
    }

    function editrating($editid) {
        $data1['role'] = $this->session->userdata('role');
        $editid = base64_decode($editid);
        $this->load->model('Rating_model');

        $data1['record'] = $this->Rating_model->editrecord($editid);

        $data1['main_content'] = 'admin/adminusers/editrating';
        $this->load->view('includes/template', $data1);
    }

    function updaterating() {


        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data1['role'] = $this->session->userdata('role');


        $updateRecord['month_name'] = $this->input->post('monthname');
        $updateid = $this->input->post('updateid');
        $updateRecord['firstrating'] = $this->input->post('firstrating');
        $updateRecord['firstpercentage'] = $this->input->post('firstpercentage');
        $updateRecord['secondrating'] = $this->input->post('secondrating');
        $updateRecord['secondpercentage'] = $this->input->post('secondpercentage');
        $updateRecord['thirdrating'] = $this->input->post('thirdrating');
        $updateRecord['thirdpercentage'] = $this->input->post('thirdpercentage');

        $this->db->where('id', $updateid);
        $resultdata = $this->db->update('tbl_master_rating', $updateRecord);
        if ($resultdata) {

            $this->session->set_flashdata('success', 'Rating updated successfully.');
            redirect('admin_adminusers/viewratinglist');
        }
    }

    function viewratinglist() {


        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $this->load->model('Rating_model');
        $data['display_all_data'] = $this->Rating_model->ratinglist($recordname);
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/viewratinglist';
        $this->load->view('includes/template', $data);
    }

    function addratingemployee() {


        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data['role'] = $this->session->userdata('role');
        $empid = $this->input->post('employeename');
        $Rating = $this->input->post('Rating');
        $reasonrating = $this->input->post('reasonrating');
        $reporting = $this->input->post('reporting');

        $updateRecord['rating'] = $Rating;
        $updateRecord['rating_reason'] = $reasonrating;


        $this->db->where('id', $empid);
        $resultdata = $this->db->update('tbl_employeelist', $updateRecord);
        if ($resultdata) {

            $this->session->set_flashdata('success', 'Rating updated successfully.');
            redirect('admin_adminusers/viewdepartemployeelist');
        }
    }

    function checkdivision() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $depid = $this->input->post('depid');
        $this->load->model('Grade_model');
        $data['division_records'] = $this->Grade_model->DivisionListcheck($depid);
        foreach ($data['division_records'] as $val) {
            $divisionid = $val['id'];

            $dataval = '<select class="form-control required" id="division" name="division" onchange="checkmanager(' . $depid . ',' . $divisionid . ')">
                                            <option value="0">Select division</option>
                                            <option value=' . $val['id'] . '>' . $val['division_name'] . '</option>
                                        </select>';
            echo $dataval;
        }
        die;
    }

    function checkmanagerdata() {
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $departid = $this->input->post('departid');
        $divisionid = $this->input->post('divisionid');
        $this->load->model('Employeelist_model');
        $this->load->model('Grade_model');
        $data['departname_records'] = $this->Grade_model->departnameListcheck($departid);
        $departmentname = trim($data['departname_records'][0]['department_name']);


        $data['deivision_records'] = $this->Grade_model->divisionname($divisionid);
        $divisionname = $data['deivision_records'][0]['division_name'];

        $data['manager_records'] = $this->Employeelist_model->managerCheckrecord(
                $departmentname, $divisionname);
        foreach ($data['manager_records'] as $val) {

            $dataval = '<select class="form-control required" id="reporting" name="reporting">
                                            
                                             <option value=' . $val['id'] . '>' . $val['reporting_to'] . '</option>
                                           
                                        </select>';



            echo $dataval;
        }
        die;
    }

    function addstaff() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $data['role'] = $this->session->userdata('role');
        //echo CI_VERSION;
        $this->load->model('Grade_model');
        $this->load->model('User_model');

        $data['grade_records'] = $this->Grade_model->GradeList();
        $data['division_records'] = $this->Grade_model->DivisionList();
        $data['department_records'] = $this->Grade_model->departmentlist();
        $data['manager_records'] = $this->User_model->managerlist();

        $data['main_content'] = 'admin/adminusers/addstaff';
        $this->load->view('includes/template', $data);
    }

    function addstaffmember() {

        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('grade', 'Grade', 'trim|required');

        $this->form_validation->set_rules('reporting', 'Reporting Manager', 'trim|required');

        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('division', 'division', 'trim|required');


        $this->form_validation->set_rules('joindate', 'joindate', 'trim|required');
        $this->form_validation->set_rules('probation_date', 'probation date', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]');
        $this->form_validation->set_rules('Empcode', 'Empcode', 'trim|required|max_length[255]');

        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
            redirect('admin_adminusers/addstaff');
        } else {



            $this->load->model('Employeelist_model');
            $jdate = explode("-", $this->input->post('joindate'));
            $jdateformat = $jdate[2] . "-" . $jdate[1] . "-" . $jdate[0];
            $provationdt = explode("-", $this->input->post('probation_date'));
            $provationdate = $provationdt[2] . "-" . $provationdt[1] . "-" . $provationdt[0];

            $insertRecord = array();
            $insertRecord['name'] = $this->input->post('fname');
            $insertRecord['grade'] = $this->input->post('grade');
            $insertRecord['reporting_to'] = $this->input->post('reporting');
            $insertRecord['department'] = $this->input->post('department');
            $insertRecord['division'] = $this->input->post('division');
            $insertRecord['join_date'] = $jdateformat;
            $insertRecord['probation_date'] = $provationdate;
            $insertRecord['email'] = $this->input->post('email');
            $insertRecord['empcode'] = $this->input->post('Empcode');
            $insertRecord['mobile_no'] = $this->input->post('mobile');
            $insertRecord['status'] = '0';

            $data['insert_record'] = $this->Employeelist_model->store_information_excel($insertRecord);

            if ($data['insert_record']) {
                $this->session->set_flashdata('success', 'staff memeber added successfully');
                redirect('admin_adminusers/employeelist');
            }
        }
    }

    /**
     * This function used to create new password for user
     */
}

?>