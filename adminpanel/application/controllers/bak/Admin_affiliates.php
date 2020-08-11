<?php

/*
  @Auther : Vinod K Maurya
  Description: admin user
  Dated :  19/06/2017
 */

 
class Admin_affiliates extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
   const VIEW_FOLDER = 'admin/affiliates';

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'security'));
        $this->load->library(array('form_validation', 'session', 'user_agent'));
        $this->load->model('Affiliates_model');
        $this->load->model(array('Meta_page_model'));
        $this->load->model(array('Author_model'));

        $this->load->library('pagination');
    }
	
	

   public function viewaffiliates()
	{
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$count_t=$this->Affiliates_model->countData();
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
			$config["base_url"] = base_url() . "admin/affiliates/viewaffiliate/";
			$config["total_rows"] = $count_t;
			$config["use_page_numbers"] = TRUE;
			$this->pagination->initialize($config);	 
			$data['srchIndstryData'] = $this->Affiliates_model->getdata($config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			$data['main_content'] = 'admin/affiliates/list';
            $this->load->view('includes/template', $data);
			
         
    }


	
	
	public function reject($page, $id) 
	{
			
		$count_t=$this->Affiliates_model->rejected($id);
        $this->session->set_flashdata('delmsg', 'Record Rejected successfully!');
        if ($count_t != "") {
            redirect('admin/affiliates/viewaffiliate/'.$page, 'refresh');
        }
	}
	

	
	public function approved($page, $id) 
	{
		$qryApproved=$this->Affiliates_model->approved($id);
		
		$getData=$this->Affiliates_model->getUserData($id);
		
	
	    $to = $getData[0]['email'];
		$name = ucwords($getData[0]['firstname']);
	
        $this->session->set_flashdata('delmsg', 'Record Approved successfully!');
        if ($getData!= "")
		{
				
			$body = "
			    <html>
				<head>
				<title>DNS Associates Affiliates.</title>
				</head>
				<body>
				<p >
				<img src='https://www.dnsassociates.co.uk/assets/img/dns-logo.png' alt='DNS Associates' /></p>
				<table style='float:left;'>
				<tr>
				<td colspan='2'>Approved DNS Associates Affiliates Details Are Below:-<br><br></td>
				</tr>
				<tr>
				<td colspan='2'>Dear $name,  We have approved your request for being our partner affiliate.<br><br>

For further information, please <a href='http://35.176.179.131/dnsassociateslatest/download/affiliates.zip' > click here </a>or download from the link below and read all the documents carefully.
								<br><br></td>
				</tr>
				<tr>
				<th >Download Link </th><td>http://35.176.179.131/dnsassociateslatest/download/affiliates.zip <br> Copy and Paste in browser. <br><br></td></tr>
				
				
				</table>
				</body>
				</html>
			";
				$subject = 'Approved DNS Associates Affiliates';
				$val2 = $this->send_mail($subject, $body, $to);
				
		}	
            redirect('admin/affiliates/viewaffiliate/'.$page, 'refresh');
    }
		

	
	
		public function send_mail($subject, $body, $to)
				{
				  if ($subject != NULL) 
				  {
						$from = "DNS Associates<no-reply@dnsassociates.co.uk>";
						$reply = "DNS Associates<info@dnsassociates.co.uk>";
						$subject = $subject;
						$body = "<body>" . $body . "</body>";

						$config = array();
						$config['api_key'] = "key-90b0c3f6e5508147a055f1a30e5cad35";
						$config['api_url'] = "https://api.mailgun.net/v3/dnsassociates.co/messages";
						$message = array();
						$message['from'] = $from;
						$message['to'] = $to;
						$message['h:Reply-To'] = $reply;
						$message['subject'] = $subject;
						$message['html'] = $body;
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $config['api_url']);
						curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
						curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
						$result = curl_exec($ch);
						curl_close($ch);
						
					} else {
						redirect('404', 'location', 301);
					}
				}
	
	

    

}

?>