<?php

class Picture_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function picturelist()
	{
		$this->db->select("*");
        $this->db->from("picture_stories");
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
	
		function deletePData($deleteid)
	{
		$this->db->where('id', $deleteid);
        $this->db->delete('picture_stories');
		//print_r($this->db->last_query()); exit;
	}
	

	
	function edit_record($editid)
	{
		
		$this->db->select('*');
		$this->db->from('picture_stories');
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
	
	
	
	 function addPicture($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('picture_stories', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
}

