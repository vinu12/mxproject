<?php

class Register_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	
	
	 function addcourses($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('courses', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	
	function publishprogramlist()
	{
		$this->db->select("*");
        $this->db->from("courses");
		$this->db->order_by("id", "DESC");
		$query = $this->db->get();
		$cnt=$query->num_rows();
		if($query->num_rows > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}	
	}
	
	
	function Userdetails()
	{
		
		$this->db->select("*");
        $this->db->from("user_register");
		$this->db->order_by("id", "DESC");
		$query = $this->db->get();
		$cnt=$query->num_rows();
		if($query->num_rows > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}	
		
	}
	
	
	function editprogram($editid)
	{
		$this->db->select("*");
        $this->db->from("courses");
		$this->db->where("id", $editid);
		$query = $this->db->get();
		$cnt=$query->num_rows();
		if($query->num_rows > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}	
		
	}
	
	
	function deleteProgramData($deleteid)
	{
		
		$this->db->where('id', $deleteid);
        $this->db->delete('courses');
		
	}
	

	function edit_record_program($editid)
	{

		$this->db->select('*');
		$this->db->from('courses');
		$this->db->where('id', $editid);
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
	
	
	
	
	
}

