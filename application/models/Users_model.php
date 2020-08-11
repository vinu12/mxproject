<?php

class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
	
	
	function thousandsCurrencyFormat($num) {

  if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;

  }

  return $num;
}
	
	
	 function subscribe_checkEmailExist($email)
    {
        $this->db->select('*');
		$this->db->from('subscribe_user');
        $this->db->where('email', $email);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return 1;
        } else {
            return 0;
        }
    }
	
	  function getprofileid($id) {
        $this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('oauth_uid ', $id);
        $this->db->where('status', '1');
        $query = $this->db->get();
        $data = $query->result_array();
        $updatedid = $data[0]['id'];
        return $updatedid;
    }
	
	
	function googlecheckuser($email) {

        $this->db->select('*');
		$this->db->from('user_register');
        $this->db->where('user_email', $email);
        
        $query = $this->db->get();
        $result = $query->num_rows();
        if ($result > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
	
	
	
 function subscribe_user_Record($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('subscribe_user', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

 function RegisterUserRecord($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('user_register', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    
    
    function RegisterenquiryData($UserRecord)
    {
        
        $this->db->trans_start();
        $this->db->insert('user_register_inquiry', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    
    }
	
	
	
	function ContactenquiryData($UserRecord)
    {
        
        $this->db->trans_start();
        $this->db->insert('contactus', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    
    }
    
    function RegisterUserskills($UserRecord)
    {
    
         $this->db->trans_start();
        $this->db->insert('userskills', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
        
    }
    
    
    function RegisterUserseducation($UserRecord)
    {
         $this->db->trans_start();
        $this->db->insert('education', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    
    }
	
    
    
    function fetchallworkplace()
	{
		$this->db->select('*');
		$this->db->from('workplace_category');
                $this->db->where('status','1');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		$querycount =$query->num_rows();
		
		if($querycount>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
		
	}
        
        
        function fetchallvisa()
        {
        
                $this->db->select('*');
		$this->db->from('visatype');
                $this->db->where('status','active');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		$querycount =$query->num_rows();
		
		if($querycount>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
            
            
        }
	
        
        
         function checkexistdata($email)
	{
		$this->db->select('*');
		$this->db->from('user_register');
                $this->db->where('user_email',$email);
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		$querycount =$query->num_rows();
		
		if($querycount>0)
		{
		return $query->result_array();
		}
		else
		{
		return 0;
		}
		
	}
        
        
        
	
	
	 function adddeals($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('dealsenquiry', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	

}
