<?php

class Masterbudget_model extends CI_Model {



    public function Budgetlist() {


        $this->db->select('*');

        $this->db->from('tbl_master_budget');

        $this->db->order_by("id", "ASC");
		
		$query = $this->db->get();
       
        return $query->result_array();
    }
	
	
	
	function  Budgetlistedit($editid)
	{
		
		$this->db->select('*');
		$this->db->from('tbl_master_budget');
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
	
	function deletebudget($deleteid)
	{
		$this->db->where('id', $deleteid);
        $this->db->delete('tbl_master_budget');
        
        
	}
	
	function addbudget($budgetRecord)
	{
		$this->db->trans_start();
        $this->db->insert('tbl_master_budget', $budgetRecord);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	}
	


}
