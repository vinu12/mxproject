<?php

class User extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
		 $this->isLoggedIn();
	}
	
	
	
	
	
	function forgotPassword()
	{
		$this->load->view('admin/forgotPassword');	
	}
	
	
	function resetPasswordUser()
    {
        $status = '';
        $this->load->model('login_model');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');
                
      
            $email = $this->input->post('login_email');
			
          
            if($this->login_model->checkEmailExist($email))
            {
			
				
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "User/resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);
					

                   if(!empty($userInfo)){
                        $data1["name"] = $userInfo[0]->name;
                        $data1["email"] = $userInfo[0]->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    /*$sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
					*/
                }
                else
                {
                   $status = 'unable';
					$this->session->set_flashdata($status, 'It seems an error while sending your details, try again.');
                }
            }
            else
            {
                $status = 'invalid';
               
				$this->session->set_flashdata($status, 'It seems an error while sending your details, try again.');
            }
            redirect('User/forgotPassword');
        
    }
	
	 function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('/login');
        }
    }
	
	 function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password changed successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password changed failed';
            }
            
            setFlashData($status, $message);

            redirect("/login");
        }
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
		$role = $this->session->userdata('role');
		
		//$this->session->set_userdata($sessionArray);
		
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
           $this->load->view('admin/login');	
        }
        else
        {
            redirect('admin/adminusers/dashboard');
        }
    }
	
	
	
	public function loginMe()
    {
         $this->load->library('form_validation');
         $this->load->model('user_model');
		 $this->load->model('login_model');
		 $this->load->library('user_agent');
		 $this->load->library('user_agent'); 
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $email = $this->security->xss_clean($this->input->post('email'));
            
			$password = $this->__encrip_password($this->input->post('password'));
            
            $result = $this->login_model->loginMe($email, $password);
		
			
            if(!empty($result))
            {
                $lastLogin = $this->login_model->lastLoginInfo($result[0]['userId']);
			

                $sessionArray = array('userId'=>$result[0]['userId'],                    
                                        'role'=>$result[0]['roleId'],
                                        'roleText'=>$result[0]['role'],
                                        'name'=>$result[0]['name'],
                                        'lastLogin'=> $lastLogin->createdDtm,
                                        'isLoggedIn' => TRUE
                                );
					
                $this->session->set_userdata($sessionArray);

                unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                $loginInfo = array("userId"=>$result[0]['userId'],"userAgent"=>"","agentString"=>"","platform"=>"","sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR']);

                $this->login_model->lastLogin($loginInfo);
				
				
				$data['role']=$result[0]['roleId'];
				$data['name']=$result[0]['name'];
				$data['email']=$result[0]['email'];
				$maincheck=explode(" ",$lastLogin->createdDtm);
				$finaldate=explode("-",$maincheck[0]);
				$finaldataval=$finaldate[2]."-".$finaldate[1]."-".$finaldate[0];
				
				
				$data['lastlogin']=$finaldataval." ".$maincheck[1];
			
                
				$data =array();
				$data['role']=$result[0]['roleId'];
				
				
                redirect('admin_adminusers/dashboard',$data);
            }
            else
            {
				
                $this->session->set_flashdata('error', 'Email or password mismatch');
                
                redirect('admin/login');
            }
        }
    }
	
    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

	
	

	
	
	
	
	
	
	
	
	
	
	
    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{	

		$this->load->model('Users_model');

		$emp_code = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate($emp_code, $password);
         
        
		 
		 
		if($is_valid)
		{
			$data = array(
				'user_name' => $emp_code,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			 redirect('admin/adminusers/dashboard');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('admin/login', $data);	
		}
	}	

    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/signup_form');	
	}
	
	
	
	
	

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}
		
		else
		{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member())
			{
				$this->load->view('admin/signup_successful');			
			}
			else
			{
				$this->load->view('admin/signup_form');			
			}
		}
		
	}
	
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}

}