<?php

class Rating_model extends CI_Model {


	function deleteallrecord()
	{
		
		$this->db->truncate('tbl_master_rating');
		
		
	}
	
	function checkEmployeelistData()
	{
		$this->db->select("COUNT(*) as record");
		$this->db->from("tbl_master_rating");
		$query = $this->db->get();
		$row = $query->row();
		return $row->record;
	
	}

	
	function store_information_excel($data) {
        $insert = $this->db->insert('tbl_master_rating', $data);
        return $insert;
    }

	
	
	

    public function ratinglist() {


        $this->db->select('*');

        $this->db->from('tbl_master_rating');

        $this->db->order_by("id", "ASC");
		
		$query = $this->db->get();
       
        return $query->result_array();
    }
	
	function editrecord($editid)
	{
		
		$this->db->select('*');

        $this->db->from('tbl_master_rating');
		 $this->db->where('id', $editid);
		 $query = $this->db->get();
		 return $query->result_array();
		
		
	}
	
	
	
	
	
	
	
	


}
