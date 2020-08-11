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
       
		$data['heading']='404';
		$data['message']='Page not found  Please enter valid url';
		
		 //$data['main_content'] = 'admin/error_404';
         $this->load->view('admin/error_404');
		
       
    }
} 