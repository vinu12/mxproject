<?php

/*
  @Auther : Vinod K Maurya
  Description: admin user
  Dated :  19/06/2017
 */

 
class Admin_industries extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
   const VIEW_FOLDER = 'admin/industries';

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'security'));
        $this->load->library(array('form_validation', 'session', 'user_agent'));
        $this->load->model(array('Industries_model'));
        $this->load->model(array('Meta_page_model'));
        $this->load->model(array('Author_model'));

        $this->load->library('pagination');
    }
	
	 public function add()
	 {
        $data['main_content'] = 'admin/industries/add';
        $this->load->view('includes/template', $data);
	 }
 
 
   public function saveadd()
   {

        $this->form_validation->set_rules('title', 'Title', 'required');
       
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
					if($_FILES['bannerImg']['name']!='')
					{
						$config['upload_path'] = '../assets/img/industies/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = '5541007';
						$config['overwrite'] = TRUE;
						$config['encrypt_name'] = FALSE;
						$config['remove_spaces'] = TRUE;
						$this->load->library('upload', $config);
							if ( ! $this->upload->do_upload('bannerImg')) 
							{
								$data['errorimg'] =  '!Sorry Please upload max 3 MB file size.';
							     redirect('admin/industries/add?erroe=er', 'refresh');
								exit;
							} 
							else
							{
								$imagePath =  ($this->upload->data('file_name'));
							}
					}
					else
					{
						$imagePath='';
					}


   
					   $data_to_store = array
					   (
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'status' => $this->input->post('status'),
							'image' => $imagePath,
							'searched_feild' => str_replace("'","",str_replace("-&-","-",str_replace(" ","-",$this->input->post('title')))),
						);

						$resultdata = $this->Industries_model->insert_industry($data_to_store);
						 if ($resultdata != "") 
						  {
								redirect('admin/industries/viewindustries', 'refresh');
						  }
						  else{
							 $data['main_content'] = 'admin/industries/add';

				             $this->load->view('includes/template', $data); 
						  }
				
			}
				$data['main_content'] = 'admin/industries/add';

				$this->load->view('includes/template', $data);
    }

   public function viewindustries()
	{
		
	
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$count_t=$this->Industries_model->countData();
			$config = array();
			$config['per_page'] = 50;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['prev_link'] = '&laquo;';
			$config['last_link'] = '';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['next_link'] = '&raquo;';
			$config['start_link'] = '';
			$config['first_link'] = '';
			$config["base_url"] = base_url() . "admin/industries/viewindustries/";
			$config["total_rows"] = $count_t;
			$config["use_page_numbers"] = TRUE;
			$this->pagination->initialize($config);	 
			$data['srchIndstryData'] = $this->Industries_model->getdata($config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			$data['main_content'] = 'admin/industries/list';
            $this->load->view('includes/template', $data);
			

         
    }

public function deleteRecord($page,$id) 
    {
	    $this->db->where('id', $id);
        $resultdata = $this->db->delete('industries');
        $this->session->set_flashdata('delmsg', 'Record Deleted successfully!');
        if ($resultdata != "") {
            redirect('admin/industries/viewindustries/'.$page, 'refresh');
        }
    }
	
	
public function editIndustries($page,$id) 
{
		
        $this->db->select("*");
        $this->db->from("industries");
        $this->db->where('id', $id);
        $query = $this->db->get();
        $data['recordindustriesData'] = $query->result_array();
        $data['main_content'] = 'admin/industries/edit';
        $this->load->view('includes/template', $data);
}
	
public function updateIndustries($page,$id)
{
	


	
	
if($_FILES['bannerImg']['name']!='')
{


$config['upload_path'] = '../assets/img/industies/';
$config['allowed_types'] = 'gif|jpg|png';
$config['max_size'] = '5541007';
$config['overwrite'] = TRUE;
$config['encrypt_name'] = FALSE;
$config['remove_spaces'] = TRUE;



// Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:

  //if (!is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('bannerImg')) 
	{
        //echo '!Sorry Please upload max 3 MB file size.';	
		$data['errorimg'] =  '!Sorry Please upload max 3 MB file size.';
							     redirect('admin/industries/edit/'.$page.'/'.$id.'?erroe=er', 'refresh');
								exit;
    } 
	else
	{
		
		$imagePath =  ($this->upload->data('file_name'));

       // return array('upload_data' => $this->upload->data());
    }
}
else{
	$imagePath=$this->input->post('oldImg');
}

if(@$this->input->post('remove')!='')
{
	$imagePath='';
}
   
               $data_to_store = array
			   (
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'status' => $this->input->post('status'),
                    'image' => $imagePath,
					'searched_feild' => str_replace("'","",str_replace("-&-","-",str_replace(" ","-",$this->input->post('title')))),
                );

				$resultdata = $this->Industries_model->update_industry($id, $data_to_store);
				  if ($resultdata != "") 
					{
						redirect('admin/industries/viewindustries/'.$page, 'refresh');
					}
				
				
}
	
	

	
	
	
	
	

    

}

?>