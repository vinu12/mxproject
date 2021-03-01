<?php 
class Error_pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
       
    }
    
    public function index()
    {
		
		
        $this->output->set_status_header(404);
        $this->load->model('User_model');
		
		$val=$this->uri->segment_array();
		$params= end($val);
		$data['pageseco_detail'] = $this->User_model->Checkpageurl($params);
		$data['title']='Page not found';
		$data['meta_description']='Page not found';
		$data['meta_keywords']='Page not found';
		
		$data['courseslist'] = $this->User_model->courseslist();
		$data['heading']='404';
		$data['message']='Page not found  Please enter valid url';
		$data['main_content'] = 'admin/error_404';
        $this->load->view('includes/template', $data);
		
       
    }
} 