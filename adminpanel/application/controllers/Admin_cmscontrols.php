<?php

/*
  @Author : Vinod K Maurya
  Description: admin user
  Dated :  19/06/2017
 */
require_once  APPPATH.'/spout-2.7.3/src/Spout/Autoloader/autoload.php';
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
 
class Admin_cmscontrols extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    const VIEW_FOLDER = 'admin/adminusers';

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'security'));
        $this->load->library(array('form_validation', 'session', 'user_agent'));
        $this->load->library('pagination');
		
    }

    function addinformation() {
			
	$this->load->model('Members_invoice_old_model');
	$this->load->model('Members_invoice_model');
	$this->form_validation->set_rules('file', 'Please Select valid Excel File', 'required');
	$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
	if ($this->input->server('REQUEST_METHOD') === 'POST' && !empty($_FILES['file']['name'])) {
	$pathinfo = pathinfo($_FILES["file"]["name"]);
    if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls')  && $_FILES['file']['size'] > 0 ) {
         
		$inputFileName = $_FILES['file']['tmp_name']; 
		$reader = ReaderFactory::create(Type::XLSX);
		$reader->open($inputFileName);
		$countData=$this->Members_invoice_model->checkRecordattendanceData();
		if($countData>0)
		{
		$this->Members_invoice_model->deleteallrecord(); 
		}
		$count = 1;
		foreach ($reader->getSheetIterator() as $sheet) {
			
			foreach ($sheet->getRowIterator() as $row) {
			
				if ($count > 1) { 
					
					
						$dataval        	 		= $row[1];
						foreach($dataval as $key => $date) {}
						$data['Date'] =$dataval->format('Y-m-d');
						
						$data['Name'] 				= $row[2];
						$data['invoice_no']     	= $row[3];
						$data['Currency']    		= $row[4];
						$data['Amount']    			= $row[5];
						$data['Country']    		= $row[6];
						$data['Approved_by']    	= $row[7];
						$data['Nature']    			= $row[8];
						$data['Account_Details']    = $row[9];
						$data['Remarks']    		= $row[10];
						$data['email_id']    		= $row[11];
						$data['pan_no']    			= $row[12];
						$data['emp_address']    	= $row[13];

						$data_to_store = array(
						'Date' => $data['Date'],
						'Name' => $data['Name'],
						'invoice_no' => $data['invoice_no'],
						'Currency' => $data['Currency'],
						'Amount' => $data['Amount'],
						'Country' => $data['Country'],
						'Approved_by' => $data['Approved_by'],
						'Nature' => $data['Nature'],
						'Account_Details' => trim($data['Account_Details']),
						'Remarks' => $data['Remarks'],
						'email_id' => $data['email_id'],
						'pan_no' => $data['pan_no'],
						'emp_address' => $data['emp_address'],
						
						
					);
					
					$this->Members_invoice_model->store_information_excel($data_to_store);
					$this->Members_invoice_old_model->store_old_record_excel($data_to_store);
					$this->session->set_flashdata('updated', 'Imported  excel data successfully!');	
                }
                $count++;

            }
			
        }
		
		if ($data != "") {
		   redirect('/admin_adminusers/employeelistinvoice', 'refresh',$data);
		}
 
        
        $reader->close();
 
    } else {
 

		$this->session->set_flashdata('updated', 'Please Select Valid Excel File!');
        //echo "Please Select Valid Excel File";
    }
 
	 } 
  //}
  
  else {
 

}

        $data['main_content'] = 'admin/cmscontrols/addinformation';
        $this->load->view('includes/template', $data);
    }

    function add() {

        $this->load->model('Meta_page_model');
        $this->form_validation->set_rules('page_slug', 'page Slug', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta description', 'required');
        $this->form_validation->set_rules('meta_type', 'Meta Type', 'required');
        $this->form_validation->set_rules('p_id', 'P ID', 'required');
        $this->form_validation->set_rules('added_on', 'Added date', 'required');
        $this->form_validation->set_rules('updated_on', 'Updated date', 'required');
        $this->form_validation->set_rules('added_by', 'Added by', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if ($this->form_validation->run()) {

                $addedon = explode("-", $this->input->post('added_on'));
                $addeddate = $addedon[2] . "-" . $addedon[1] . "-" . $addedon[0];

                $updatedon = explode(" ", $this->input->post('updated_on'));

                $updatedt = explode("-", $updatedon[0]);
                $updatedtime = $updatedon[1];
                $updateddate = $updatedt[2] . "-" . $updatedt[1] . "-" . $updatedt[0] . " " . $updatedtime;

                $data_to_store = array(
                    'page_slug' => $this->input->post('page_slug'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_type' => $this->input->post('meta_type'),
                    'p_id' => $this->input->post('p_id'),
                    'added_on' => $addeddate,
                    'updated_on' => $updateddate,
                    'added_by' => $this->input->post('added_by'),
                );

                if ($this->Meta_page_model->store_metarecord($data_to_store)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                $this->session->set_flashdata('delmsg', 'Record added successfully!');
                if ($data != "") {

                    redirect('/admin_cmscontrols/view', 'refresh');
                }
            }
        }
        $data['main_content'] = 'admin/cmscontrols/add';

        $this->load->view('includes/template', $data);
    }

    function viewinformation() {


        $this->load->model(array('Information_model'));
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $resultdata['recordinfo'] = $this->Information_model->detailsinformationRcord($page);
        $resultdata['totaldata'] = $this->Information_model->information_total();
        $resultdata['main_content'] = 'admin/cmscontrols/viewinformation';
        $this->load->view("includes/template", $resultdata);
    }

    function viewauthors() {

        $this->load->model(array('Author_model'));
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $resultdata['dataauthorsinfo'] = $this->Author_model->detailsauthorRecord($page);
        $resultdata['totaldata'] = $this->Author_model->author_total();
        $resultdata['main_content'] = 'admin/cmscontrols/viewauthors';
        $this->load->view("includes/template", $resultdata);
    }

    function deleteauthorrecord($id) {
        $this->db->where('author_id', $id);
        $resultdata = $this->db->delete('author');
        $this->session->set_flashdata('delmsg', 'Record Deleted successfully!');
        if ($resultdata != "") {
            redirect('/admin_cmscontrols/viewauthors', 'refresh');
        }
    }

    function updateauthordrecord($id) {

        $this->load->model('Author_model');
        $this->db->select("*");
        $this->db->from("author");
        $this->db->where('author_id', $id);
        $query = $this->db->get();
        $data['recordauthorData'] = $query->result_array();
        $data['main_content'] = 'admin/cmscontrols/updateauthordrecord';
        $this->load->view('includes/template', $data);
    }

    function updaterecord($id) {

        $this->load->model('Information_model');
        $this->db->select("*");
        $this->db->from("information_page");
        $this->db->where('id', $id);
        $query = $this->db->get();
        $data['recordUserData'] = $query->result_array();
        $data['main_content'] = 'admin/cmscontrols/updaterecord';
        $this->load->view('includes/template', $data);
    }

    public function updatemetarecord($id) {

        $this->load->model('Meta_page_model');
        $this->db->select("*");
        $this->db->from("meta_page");
        $this->db->where('meta_id', $id);
        $query = $this->db->get();
        $data['recordUserData'] = $query->result_array();

        $data['main_content'] = 'admin/cmscontrols/updatemetarecord';
        $this->load->view('includes/template', $data);
    }

    function updatemetainformation() {
		
		

        $this->form_validation->set_rules('page_slug', 'page slug', 'required');
        $this->form_validation->set_rules('meta_title', 'meta title', 'required');
        $this->form_validation->set_rules('meta_description', 'meta description', 'required');
        $this->form_validation->set_rules('meta_type', 'meta type', 'required');
        $this->form_validation->set_rules('p_id', 'P ID', 'required');
        $this->form_validation->set_rules('added_on', 'Added date', 'required');
        $this->form_validation->set_rules('updated_on', 'Updated date', 'required');
		

        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        if ($this->input->post('submit')) {
			
			
			
            $this->load->model('Meta_page_model');
            $updateid = $this->input->post('updateid');
            $dataupdate['page_slug'] = $this->input->post('page_slug');
            $dataupdate['meta_title'] = $this->input->post('meta_title');
            $dataupdate['meta_description'] = $this->input->post('meta_description');
            $dataupdate['meta_type'] = $this->input->post('meta_type');
            $dataupdate['p_id'] = $this->input->post('p_id');
            $addeddt = explode("-", $this->input->post('added_on'));
            $addeddaterecord = $addeddt[2] . "-" . $addeddt[1] . "-" . $addeddt[0];

            $updatedon = explode(" ", $this->input->post('updated_on'));

            $updatedt = explode("-", $updatedon[0]);
            $updatedtime = $updatedon[1];
            $updateddate = $updatedt[2] . "-" . $updatedt[1] . "-" . $updatedt[0] . " " . $updatedtime;
            $dataupdate['added_on'] = $addeddaterecord;

            $dataupdate['updated_on'] = $updateddate;
            $dataupdate['added_by'] = $this->input->post('added_by');
            $this->db->where('meta_id', $updateid);
            $resultdata = $this->db->update('meta_page', $dataupdate);
            $this->session->set_flashdata('delmsg', 'Record updated successfully!');
            redirect('/admin_cmscontrols/view', 'refresh');
        }
    }

    function updateinfo() {


        $this->form_validation->set_rules('page_name', 'page name', 'required');
        $this->form_validation->set_rules('page_url', 'page url', 'required');
        $this->form_validation->set_rules('page_description', 'page description', 'required');
        $this->form_validation->set_rules('page_link', 'page link', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        if ($this->input->post('submit')) {
            $this->load->model('Information_model');
            $updateid = $this->input->post('updateid');
            $dataupdate['page_name'] = $this->input->post('page_name');
            $dataupdate['page_url'] = $this->input->post('page_url');
            $dataupdate['page_description'] = $this->input->post('page_description');
            $dataupdate['page_link'] = $this->input->post('page_link');
            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('information_page', $dataupdate);
            $this->session->set_flashdata('delmsg', 'Record updated successfully!');
            if ($resultdata != "") {
                redirect('/admin_cmscontrols/viewinformation', 'refresh');
            }
        }
    }

    function deleterecord($id) {
        $this->db->where('id', $id);
        $resultdata = $this->db->delete('information_page');
        $this->session->set_flashdata('delmsg', 'Record Deleted successfully!');
        if ($resultdata != "") {
            redirect('/admin_cmscontrols/viewinformation', 'refresh');
        }
    }

    function deletemetarecord($id) {

        $this->db->where('meta_id', $id);
        $resultdata = $this->db->delete('meta_page');
        $this->session->set_flashdata('delmsg', 'Record Deleted successfully!');
        if ($resultdata != "") {
            redirect('/admin_cmscontrols/view', 'refresh');
        }
    }

    function view() {

        //load the view

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;

        $resultdata['dataauthorsinfo'] = $this->Meta_page_model->detailsinforecord1($page);
        $resultdata['totaldata'] = $this->Meta_page_model->meta_total();

        $resultdata['main_content'] = 'admin/cmscontrols/view';
        $this->load->view('includes/template', $resultdata);
    }

    function create_member() {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->form_validation->run() == FALSE) {
                $data['main_content'] = 'admin/signup_form';
                $this->load->view('includes/template', $data);
            } else {
                $this->load->model('Users_model');
                if ($query = $this->Users_model->create_member()) {

                    $data['main_content'] = 'admin/signup_successful';
                    $this->load->view('includes/template', $data);
                } else {
                    $data['main_content'] = 'admin/signup_form';
                    $this->load->view('includes/template', $data);
                }
            }
        }
    }

    public function updateauthorinfo() {
       $id = $this->input->post('updateid');
        $basepath = ASSET_PATH;
        $output_dir = "../assets/img/team/";
        $oldimg = $this->input->post('oldimg');
        $fileName = $_FILES["files"]["name"];
        if ($fileName != null) {
             $data = array(
                'author_name' => $this->input->post('author_name'),
                'author_slug' => $this->input->post('author_slug'),
                'auther_title' => $this->input->post('auther_title'),
                'author_email' => $this->input->post('author_email'),
                'author_desc' => $this->input->post('author_desc'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'author_img' => $fileName
            );
            unlink($output_dir . $oldimg);
            move_uploaded_file($_FILES["files"]["tmp_name"], $output_dir . $fileName);
        } else {
            $data = array(
                'author_name' => $this->input->post('author_name'),
                'author_slug' => $this->input->post('author_slug'),
                'auther_title' => $this->input->post('auther_title'),
                'author_email' => $this->input->post('author_email'),
                'author_desc' => $this->input->post('author_desc'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description')
            );
        }
        $resultdata = $this->Author_model->update_Author_model($id, $data);

        $this->session->set_flashdata('delmsg', 'Record updated successfully!');
        if ($resultdata != "") {
            redirect('/admin_cmscontrols/viewauthors', 'refresh');
        }
    }

    public function addauthors() {
        $this->load->model('Author_model');
        $this->form_validation->set_rules('author_name', 'Author name', 'required');
        $this->form_validation->set_rules('author_slug', 'Author slug', 'required');
        $this->form_validation->set_rules('auther_title', 'Auther title', 'required');
        $this->form_validation->set_rules('author_email', 'Author email', 'required');
        $this->form_validation->set_rules('author_description', 'Author description', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta description', 'required');
        //$this->form_validation->set_rules('files', 'Author image', 'required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if ($this->form_validation->run()) {

                $output_dir = "../assets/img/team/";
                $fileName = $_FILES["files"]["name"];
                move_uploaded_file($_FILES["files"]["tmp_name"], $output_dir . $fileName);
                $data_to_store = array(
                    'author_name' => $this->input->post('author_name'),
                    'author_slug' => $this->input->post('author_slug'),
                    'auther_title' => $this->input->post('auther_title'),
                    'author_email' => $this->input->post('author_email'),
                    'author_desc' => $this->input->post('author_description'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'author_img' => $fileName,
                );


                if ($this->Author_model->store_authorrecord($data_to_store)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
                $this->session->set_flashdata('delmsg', 'Record added successfully!');
                if ($data != "") {

                    redirect('/admin_cmscontrols/viewauthors', 'refresh');
                }
            }
        }
        $data['main_content'] = 'admin/cmscontrols/addauthors';
        $this->load->view('includes/template', $data);
    }

}

?>