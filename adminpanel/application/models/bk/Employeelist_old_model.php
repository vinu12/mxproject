<?php

class Employeelist_old_model extends CI_Model {
	
	

	function store_old_record_excel($data) {
        $insert = $this->db->insert('tbl_employeelist_old', $data);
        return $insert;
    }
	
	
    public function detailsinformationRcord($page = "") {


        $this->db->select('*');

        $this->db->from('members_invoice_old');

        $this->db->order_by("id", "ASC");
		
		$query = $this->db->get();
       
        return $query->result_array();
    }
	
	 
	
	  public function member_total() {

        $this->db->select("COUNT('id') as num");

        $this->db->from("members_attendance_old");

        $query = $this->db->get();

        $row = $query->row();

        return $row->num;
    }
	
	 public function DetailempRecord() {


        $this->db->select("count(*) as id,Name");

        $this->db->from('members_invoice_old');
		$this->db->group_by('Name HAVING COUNT(*) > 1'); 
        $this->db->order_by("id", "ASC");
		$query = $this->db->get();
		$querycount =$query->num_rows();
		
		if($querycount==0)
		{
		
		$this->db->select("*");
		$this->db->from('members_invoice_old');
		$this->db->order_by("id", "ASC");
		$query = $this->db->get();	
		return $query->result_array();	
		}
		
		
	   if($querycount>0)
	   {
		 return $query->result_array();
	   }
	   else
	   {
		   return 0;
	   }
       
       
    }
	
	function monthName()
	{
			$formattedMonthArray = array(
			"1" => "January", "2" => "February", "3" => "March", "4" => "April",
			"5" => "May", "6" => "June", "7" => "July", "8" => "August",
			"9" => "September", "10" => "October", "11" => "November", "12" => "December",
			);
			return $formattedMonthArray;
			
				
		
	}
	
	
	function detailssearchData($startdate,$enddate,$empname)
	{
		//echo $val='select * from members_invoice_old where Date BETWEEN "'. $startdate. '" and "'.$enddate.'" and Name="'.$empname.'"';
		//die;
		$this->db->select('*');

        $this->db->from('members_invoice_old');
		
		$this->db->where('Date BETWEEN "'. $startdate. '" and "'.$enddate.'"');
		
		$this->db->where('Name', $empname);
        $this->db->order_by("id", "ASC");
		
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
	
	
	
	
	function Employeeinvoice()
	{
	$this->db->select("*");
	$this->db->from('members_invoice_old');
	$this->db->order_by("id", "ASC");
	$query = $this->db->get();
	$datacnt=$query->num_rows();
	if($datacnt>0)
	{
		return $query->result_array();
	}
	else
	{
		return 0;
	}

	}
	
	
	
	
	
	
	
 
}
