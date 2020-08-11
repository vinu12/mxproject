<?php

/*
  @Author : Vinod K Maurya
  Description:  COE functionality
  Dated :  07/03/2018
 */
error_reporting(0);


class Admin_commanlist extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    const VIEW_FOLDER = 'admin/commanlist';

    public function __construct() {
        parent::__construct();
		 $militime = round(microtime(true) * 1000);
        
        define('militime', $militime);
        $this->load->model('user_model');
    }

	
	
	
	function matrimoniallist()
	{
		
		
		if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

       
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/commanlist/matrimoniallist';
        $this->load->view('includes/template', $data);
		
		
	}
	
	
	
	
	
	
	
	
    /**
     * This function is used to load the user list*/
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 function addprofilepricture()
	 {
		 
		 
		 if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $this->load->model('Coe_model');
        //$data['coe_result_data'] = $this->Coe_model->coelist();

        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/commanlist/addprofilepricture';
        $this->load->view('includes/template', $data);
		 
	 }
	 
	 
	 function viewpicturestories()
	 {
		 
		  if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }

        $this->load->model('Picture_model');
        $data['Picture_result'] = $this->Picture_model->picturelist();
		

        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/commanlist/viewpicturestories';
        $this->load->view('includes/template', $data);
		 
	 }
	 
	 
	 
	 
	 function deletepstory()
	 {
		 
		 
		  $deleteid = base64_decode($this->input->post('id'));
		  $data['role'] = $this->session->userdata('role');
		  $this->load->model('Picture_model');
		  $result = $this->Picture_model->deletePData($deleteid);
		  $this->session->set_flashdata('success', 'Record deleted successfully.');
		  die;
		 
		 
	 }
	 
	 
    
    
    
    function addprofilepicture()
    {
        
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }
		
        $data['role'] = $this->session->userdata('role');
		$loguserid = $this->session->userdata('userId');
		$this->load->model('Picture_model');
        if($_REQUEST['Submit'])
        {
			
		
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('imagetitle', 'title', 'trim|required');
        $this->form_validation->set_rules('newsurl', 'noofcoe', 'trim|required');

       
 
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', 'Please check fill data.');
           
        } else {
			
			
			
				$this->load->library('upload');
                if (!empty($_FILES['uploadppicture']['name'])) {
                    $titlename = $this->input->post('imagetitle');
					$newsurl = $this->input->post('newsurl');
					
                    $image = $this->input->post('uploadppicture');
                    $file_name = $_FILES['uploadppicture']['name'];
                    $file_size = $_FILES['uploadppicture']['size'];
                    $file_tmp = $_FILES['uploadppicture']['tmp_name'];
                    $file_type = $_FILES['uploadppicture']['type'];

                    
                    $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $titlename));
                    $pathval = base_url();
                    $date = date("Y-m-d H:i:s", time()+16200);
					$upload_file = "images/picturestories/" . $file_name;
									

                    $config['upload_path'] = $upload_file;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    if ($file_size > 50097152) {

                        $this->session->set_flashdata('success', 'File size must be excately 3 MB.');
                    } else {
						
                        $uploadstatus = move_uploaded_file($file_tmp, "" . $upload_file);

                           if ($uploadstatus) {

                            $insertData['slug'] = $urlt;
                            $insertData['image_title'] = $titlename;
							$insertData['userid'] = $loguserid;
                            $insertData['image_url'] = $newsurl;
                            $insertData['user_photo'] = $file_name;
                            $insertData['nposition'] = 0;
                            $insertData['added_date'] = $date;
                            $insertData['status'] = '0';
							$insertData['create_at'] = militime;
							$insertData['update_at'] = militime;
                            $recordcheck = $this->Picture_model->addPicture($insertData);

                           
                        } 
                    }
					
                    $this->session->set_flashdata('success', 'Picture stories added successfully.');
                    redirect('admin_commanlist/viewpicturestories');
                }
				
				
            
           
            }
        }
          $data['main_content'] = 'admin/commanlist/addprofilepicture';
          $this->load->view('includes/template', $data);
        
    
    }
    
    
   function updateactivestatus() {
            $data['role'] = $this->session->userdata('role');
            $updateid = $this->input->post('id');
            $updateRecord = array();
            $updateRecord['status'] = $this->input->post('status');
            
            
            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('picture_stories', $updateRecord);
           
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
    
   function viewmeta()
	 {
		 
		if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        } 
		$data['role'] = $this->session->userdata('role');
		$this->load->model('Job_model');
		$data['meta_result'] = $this->Job_model->viewmeta();
		
		  
		$data['main_content'] = 'admin/commanlist/viewmeta';
        $this->load->view('includes/template', $data);
	 }
	 
	 
	 
	 function updatemetadesc()
	 {
		 
		if (!$this->session->userdata('role')) {
		redirect('User/isLoggedIn');
		}
		 $this->load->model('Job_model');
        $data['role'] = $this->session->userdata('role');
		
		
		 if($_REQUEST['Submit'])
        {
			 
		$this->load->library('form_validation');
        $this->form_validation->set_rules('pagetitle', 'title', 'trim|required');
        $this->form_validation->set_rules('seokey', 'seokey', 'trim|required');
		$this->form_validation->set_rules('seotitle', 'seotitle', 'trim|required');
		$this->form_validation->set_rules('metadescription', 'metadescription', 'trim|required');
		//$this->form_validation->set_rules('priority', 'priority', 'trim|required');
		
		
		  if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', 'Please check fill data.');
           
        } 
		else 
		{
			$updateid=$this->input->post('updateid');
			$pagetitle = $this->input->post('pagetitle');
			$status = $this->input->post('status');
			$seokey = $this->input->post('seokey');
			$seotitle = $this->input->post('seotitle');
			$url = $this->input->post('url');
			$pagename = $this->input->post('priority');
			$metadescription = strip_tags($this->input->post('metadescription'));
			$author = $this->input->post('author');
			$date = date("Y-m-d H:i:s", time()+16200);
			
			if ($_FILES['uploadppicture']['name']!="") {
				  
				
                    $image = $this->input->post('uploadppicture');
                    $file_name = $_FILES['uploadppicture']['name'];
                    $file_size = $_FILES['uploadppicture']['size'];
                    $file_tmp = $_FILES['uploadppicture']['tmp_name'];
                    $file_type = $_FILES['uploadppicture']['type'];

                    
                   
                    $pathval = base_url();
                    $date = date("Y-m-d H:i:s", time()+16200);
					$upload_file = "images/metaimages/" . $file_name;
									

                    $config['upload_path'] = $upload_file;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    if ($file_size > 50097152) {

                        $this->session->set_flashdata('success', 'File size must be excately 3 MB.');
                    } else {
						
                        $uploadstatus = move_uploaded_file($file_tmp, "" . $upload_file);

                           if ($uploadstatus) {

							$updateData['page_name'] = $pagename;
                            $updateData['page_title'] = $pagetitle;
                            $updateData['seo_title'] = $seotitle;
							$updateData['url'] = $url;
                            $updateData['seo_key'] = $seokey;
                            $updateData['images'] = $file_name;
                            $updateData['seo_desc'] = $metadescription;
                            $updateData['added_date'] = $date;
							$updateData['author'] = $author;
                            $updateData['status'] = $status;
						
							
							$this->db->where('id', $updateid);
							$resultdata = $this->db->update('meta_description', $updateData);
                          
                           
                        } 
                    }
					
							$this->session->set_flashdata('success', 'Meta updated successfully.');
                  
                }
				else
				{
				
							$updateData['page_name'] = $pagename;
                            $updateData['page_title'] = $pagetitle;
                            $updateData['seo_title'] = $seotitle;
							$updateData['url'] = $url;
                            $updateData['seo_key'] = $seokey;
                            $updateData['seo_desc'] = strip_tags($metadescription);
                            $updateData['added_date'] = $date;
							$updateData['author'] = $author;
                            $updateData['status'] = $status;
							$this->db->where('id', $updateid);
							
								
							$resultdata = $this->db->update('meta_description', $updateData);
							$this->session->set_flashdata('success', 'Meta updated successfully.');
                           
				}
				redirect('admin_commanlist/viewmeta');
			
			
		}
		}
		 
	 }
	 
	 
	 
	 function editmeta($editid)
	 {
	
	if (!$this->session->userdata('role')) {
	redirect('User/isLoggedIn');
	}

	$data['role'] = $this->session->userdata('role');
	$this->load->model('Job_model');
	$data['edit_result'] = $this->Job_model->editmetaData(base64_decode($editid));
	//print_r($data['edit_result']);
	$data['main_content'] = 'admin/commanlist/editmeta';
	$this->load->view('includes/template', $data);
		 
	 }
	 
    function addmeta()
	{
		  if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }
		 $this->load->model('Job_model');
        $data['role'] = $this->session->userdata('role');
		
		
		 if($_REQUEST['Submit'])
        {
			 
		
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pagetitle', 'title', 'trim|required');
        $this->form_validation->set_rules('seokey', 'seokey', 'trim|required');
		$this->form_validation->set_rules('seotitle', 'seotitle', 'trim|required');
		$this->form_validation->set_rules('metadescription', 'metadescription', 'trim|required');
		$this->form_validation->set_rules('priority', 'priority', 'trim|required');
		
		
		  if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', 'Please check fill data.');
           
        } else {
			
			
					$pagetitle = $this->input->post('pagetitle');
					$seokey = $this->input->post('seokey');
					$seotitle = $this->input->post('seotitle');
					$url = $this->input->post('url');
					$pagename = $this->input->post('priority');
					$metadescription = strip_tags($this->input->post('metadescription'));
					$author = $this->input->post('author');
					$status = $this->input->post('status');
					
			  if (!empty($_FILES['uploadppicture']['name'])) {
				  
				 
                    
					
					
                    $image = $this->input->post('uploadppicture');
                    $file_name = $_FILES['uploadppicture']['name'];
                    $file_size = $_FILES['uploadppicture']['size'];
                    $file_tmp = $_FILES['uploadppicture']['tmp_name'];
                    $file_type = $_FILES['uploadppicture']['type'];

                    
                   
                    $pathval = base_url();
                    $date = date("Y-m-d H:i:s", time()+16200);
					$upload_file = "images/metaimages/" . $file_name;
									

                    $config['upload_path'] = $upload_file;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    if ($file_size > 50097152) {

                        $this->session->set_flashdata('success', 'File size must be excately 3 MB.');
                    } else {
						
                        $uploadstatus = move_uploaded_file($file_tmp, "" . $upload_file);

                           if ($uploadstatus) {

							$insertData['page_name'] = $pagename;
                            $insertData['page_title'] = $pagetitle;
                            $insertData['seo_title'] = $seotitle;
							$insertData['url'] = $url;
                            $insertData['seo_key'] = $seokey;
                            $insertData['images'] = $file_name;
                            $insertData['seo_desc'] = strip_tags($metadescription);
                            $insertData['added_date'] = $date;
							$insertData['author'] = $author;
                            $insertData['status'] = $status;
							
                            $recordcheck = $this->Job_model->add_meta_description($insertData);

                           
                        } 
                    }
					
                    $this->session->set_flashdata('success', 'Meta added successfully.');
                   
                }
				else
				{
							$date = date("Y-m-d H:i:s", time()+16200);
							$insertData['page_name'] = $pagename;
                            $insertData['page_title'] = $pagetitle;
                            $insertData['seo_title'] = $seotitle;
							$insertData['url'] = $url;
                            $insertData['seo_key'] = $seokey;
                            $insertData['images'] = "";
                            $insertData['seo_desc'] = strip_tags($metadescription);
                            $insertData['added_date'] = $date;
							$insertData['author'] = $author;
                            $insertData['status'] = $status;
							
                            $recordcheck = $this->Job_model->add_meta_description($insertData);
				}
							redirect('admin_commanlist/viewmeta');
				
				
		}
			
		}
		
        $data['main_content'] = 'admin/commanlist/addmeta';
        $this->load->view('includes/template', $data);
		
	}
    
    function editpicturestories($editid)
    {
        $data['role'] = $this->session->userdata('role');
        if (!$this->session->userdata('role')) {
            redirect('User/isLoggedIn');
        }
		$loguserid = $this->session->userdata('userId');
        $this->load->model('Picture_model');
		 if($_REQUEST['Submit'])
        {
			
			
			
         $updateid=$this->input->post('updateid');
        
         $this->load->library('form_validation');

        $this->form_validation->set_rules('imagetitle', 'Title', 'trim|required');
        $this->form_validation->set_rules('newsurl', 'News Url', 'trim|required');

       
        
        
       

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', 'Please check fill data.');
           
        } else {
            
                    $titlename = $this->input->post('imagetitle');
					$newsurl = $this->input->post('newsurl');
					
                    $image = $this->input->post('uploadppicture');
                    $file_name = $_FILES['uploadppicture']['name'];
                    $file_size = $_FILES['uploadppicture']['size'];
                    $file_tmp = $_FILES['uploadppicture']['tmp_name'];
                    $file_type = $_FILES['uploadppicture']['type'];

                    
                    $urlt = strtolower(preg_replace('/[\W\s\/]+/', '-', $titlename));
                    $pathval = base_url();
                    $date = date("Y-m-d H:i:s", time()+16200);
					$upload_file = "images/picturestories/" . $file_name;
									

                    $config['upload_path'] = $upload_file;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    if ($file_size > 50097152) {

                        $this->session->set_flashdata('success', 'File size must be excately 3 MB.');
                    } else {
						
						
							if ($file_name!="") {
                            
							 $recordcheck = $this->Picture_model->edit_record($updateid);
							 $existimage=$recordcheck[0]['user_photo'];
							
							$dataRecord=unlink('images/picturestories/'.$existimage);
							
							
							$uploadstatus = move_uploaded_file($file_tmp, "" . $upload_file);

                            $updateRecord['slug'] = $urlt;
                            $updateRecord['image_title'] = $titlename;
							$updateRecord['userid'] = $loguserid;
                            $updateRecord['image_url'] = $newsurl;
                            $updateRecord['user_photo'] = $file_name;
                            $updateRecord['nposition'] = 0;
                            $updateRecord['added_date'] = $date;
                            $updateRecord['status'] = '0';
							$updateRecord['create_at'] = militime;
							$updateRecord['update_at'] = militime;
                            $this->db->where('id', $updateid);
							$resultdata = $this->db->update('picture_stories', $updateRecord);

							$this->session->set_flashdata('success', 'Record update successfully');
                           
                        }
                       else 

					   {
						   
						
						    $updateRecord['slug'] = $urlt;
                            $updateRecord['image_title'] = $titlename;
							$updateRecord['userid'] = $loguserid;
                            $updateRecord['image_url'] = $newsurl;
                            
                            $updateRecord['nposition'] = 0;
                            $updateRecord['added_date'] = $date;
                            $updateRecord['status'] = '0';
							$updateRecord['create_at'] = militime;
							$updateRecord['update_at'] = militime;
                            $this->db->where('id', $updateid);
							$resultdata = $this->db->update('picture_stories', $updateRecord);
						   
						   
					   }						   
                    }
                    $this->session->set_flashdata('success', 'Record update successfully.');
                   redirect('admin_commanlist/viewpicturestories', 'refresh');
                
           
        
        }
		}
          $data['edit_result']=$this->Picture_model->edit_record(base64_decode($editid));
		
          $data['main_content'] = 'admin/commanlist/editpicturestories';
          $this->load->view('includes/template', $data);
        
        
    }

    

}

?>