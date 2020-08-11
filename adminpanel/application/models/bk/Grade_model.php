<?php

class Grade_model extends CI_Model {


	
	function GradeList()
	{
		$this->db->select('*');
		$this->db->from('tbl_grade');
		
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
	
	function deletegrade($deleteid)
	{
		
		$this->db->where('id', $deleteid);
        $this->db->delete('tbl_grade');
		
	}
	
	
	function addgrade($gradeRecord)
	{
		$this->db->trans_start();
        $this->db->insert('tbl_grade', $gradeRecord);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
	}
	
	
	function DivisionList()
	{
		
		$this->db->select('*');
		$this->db->from('tbl_division');
		
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
	
	function DivisionListcheck($depid="")
	{
		$this->db->select('*');
		$this->db->from('tbl_division');
		$this->db->where('depart_id', $depid);
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
	
	
	function departnameListcheck($depid="")
	{
		$this->db->select('*');
		$this->db->from('tbl_department');
		$this->db->where('id', $depid);
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
	
	function divisionname($divisionid="")
	{
		$this->db->select('*');
		$this->db->from('tbl_division');
		$this->db->where('id', $divisionid);
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
	
	
	function fetchrating()
	{
		
		$this->db->select('*');
		$this->db->from('tbl_rating');
		$where = "status='1'";
		$this->db->where($where);
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
	
	function  Gradelistedit($editid)
	{
		
		$this->db->select('*');
		$this->db->from('tbl_grade');
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
	

	
	
	function departmentlist()
	{
		
		
		$this->db->select('*');
		$this->db->from('tbl_department');
		
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
