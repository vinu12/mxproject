<?php

class Job_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function joblist()
	{
		$this->db->select("*");
        $this->db->from("job");
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
	
	
	function deletejobData($deleteid)
	{
		$this->db->where('id', $deleteid);
        $this->db->delete('job');
		
	}
	
	function addjob($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('job', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	
	function deleteUserData($deleteid)
	{
		$this->db->where('userId', $deleteid);
        $this->db->delete('tbl_users');
	}
	
	
	
	function viewmeta($UserRecord) {
        $this->db->select('*');
		$this->db->from('meta_description');
		
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
	
	
	function editmetaData($editid)
	{
		
		$this->db->select('*');
		$this->db->from('meta_description');
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
	
	
		function add_meta_description($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('meta_description', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	function edit_record_job($editid)
	{
		
		$this->db->select('*');
		$this->db->from('job');
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
	
	
	function job_record_news($updateid)
	{
		
		
		$this->db->select('*');
		$this->db->from('job');
		$this->db->where('id', $updateid);
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
	
	
	
	


