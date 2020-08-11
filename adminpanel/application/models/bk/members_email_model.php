<?php

/**** Author:  Vinod K Maurya
      Description:  member email model
	  Dated:    19/02/2018
*/

class Members_email_model extends CI_Model {


    public function member_total() {

        $this->db->select("COUNT('id') as num");

        $this->db->from("members_attendance");

        $query = $this->db->get();

        $row = $query->row();

        return $row->num;
    }

    function store_member($data) {
        $insert = $this->db->insert('members_email', $data);
        return $insert;
    }
	
	
function  editEmployeeDataEmail($empid)
{
	
		$this->db->select("*");

        $this->db->from('members_email');
		$this->db->where('EmpCode', $empid);
        $query = $this->db->get();
		$datacnt=$query->num_rows();
		if($datacnt>0)
		{
		return $query->result_array();
		}
		else
		{
			return "0";
		}
	
}


function checkrecordEmp($empCode ="")

	{
		$this->db->select("count(*) as record ,EmpCode,name");
		$this->db->from('members_email');
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
        $query = $this->db->get();
		$row = $query->row();
		return $row->record;
    }
	
	function fetchemailRecord($empCode ="")
	{
		
		$this->db->select("email,name,EmpCode");
		$this->db->from('members_email');
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
        $query = $this->db->get();
		$datacountdata=$query->num_rows();
		if($datacountdata>0)
		{
		return $query->result_array();
		}
		else
		{
			return "0";
		}
		
	}
	
	function checkEmailofemaployee($empcode="")
	
	{
		//echo $dd="select count(*) as emaildata,emp.EmpCode,m.EmpCode,m.email from  members_attendance_new as emp INNER JOIN members_email as m on .emp.EmpCode=m.EmpCode group by emp.EmpCode HAVING COUNT(*) > 1";
		//die;
		$query = $this->db->query("select count(*) as emaildata,emp.EmpCode,m.EmpCode,m.email from  members_attendance_new as emp INNER JOIN members_email as m on .emp.EmpCode=m.EmpCode where emp.EmpCode=".$empcode." group by emp.EmpCode HAVING COUNT(*) > 1");
	    $querycount =$query->num_rows();
		if($querycount)
		{
			return $query->result_array();
		}
		else
		{
			return "0";
		}
	}
    
	
   
    

}
