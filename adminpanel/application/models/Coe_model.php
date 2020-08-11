<?php

class Coe_model extends CI_Model {

    function CoeList() {
        $this->db->select('*');
        $this->db->from('tbl_coe');

        $query = $this->db->get();
        $querycount = $query->num_rows();
        if ($querycount > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
    
    function editcoedata($editid)
    {
        $this->db->select('*');
        $this->db->from('tbl_coe');
        $this->db->where('id', $editid);
        $query = $this->db->get();
        $querycount = $query->num_rows();
        if ($querycount > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
    
    function deletecoe($deletid)
    {
    
        $this->db->where('id', $deletid);
        $this->db->delete('tbl_coe');
    }
    
    function addcoedata($budgetRecord)
	{
	$this->db->trans_start();
        $this->db->insert('tbl_coe', $budgetRecord);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	}

}
