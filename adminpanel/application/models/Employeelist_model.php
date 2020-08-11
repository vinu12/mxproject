<?php

class Employeelist_model extends CI_Model {


	function deleteallrecord()
	{
		
		$this->db->truncate('tbl_employeelist');
		
		
	}
	
	function checkEmployeelistData()
	{
		$this->db->select("COUNT(*) as record");
		$this->db->from("tbl_employeelist");
		$query = $this->db->get();
		$row = $query->row();
		return $row->record;
	
	}

	
	function store_information_excel($data) {
        $insert = $this->db->insert('tbl_employeelist', $data);
        return $insert;
    }

	
	
	

    public function employeelist() {


        $this->db->select('*');

        $this->db->from('tbl_employeelist');

        $this->db->order_by("id", "ASC");
		
		$query = $this->db->get();
       
        return $query->result_array();
    }
	
	
	
	function  employeelistedit($editid)
	{
		
		$this->db->select('*');
		$this->db->from('tbl_employeelist');
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
	
	
	
	function employeeunique($emailid="")
	{
		$this->db->select('*');
		$this->db->from('tbl_employeelist');
		$this->db->where('email', $emailid);
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
	
	function manageremplist($name="")
	{
		
		$this->db->select('*');
		$this->db->from('tbl_employeelist');
		$this->db->where('reporting_to', $name);
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
	
	
	function manageremplistadmin($depname="",$manageid="",$empname="")
	{
		
		
		$this->db->select('*');
		$this->db->from('tbl_employeelist');
		$this->db->order_by("id", "asc");
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
	
	
	function searchManagerlist()
	{
		
		$this->db->distinct();
		$this->db->select('reporting_to,department,division');
		$this->db->from('tbl_employeelist');
		$this->db->group_by('reporting_to');
		
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
	
	function searchdepartlist()
	{
		$this->db->distinct();
		$this->db->select('reporting_to,department,division');
		$this->db->from('tbl_employeelist');
		$this->db->group_by('department');
		
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
	
	
	
	function searchManagerbydepartment($depname)
	{
		
		$this->db->distinct();
		$this->db->select('id,reporting_to,department,division');
		$this->db->from('tbl_employeelist');
		$this->db->where('department', $depname);
		$this->db->group_by('reporting_to');
		
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
	
	
	function searchmname($mid)
	{
		$this->db->distinct();
		$this->db->select('name,reporting_to,department,division');
		$this->db->from('tbl_employeelist');
		$this->db->where('id', $mid);
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
	
	
	function searchempname($mid)
	{
		$this->db->distinct();
		$this->db->select('id,name,reporting_to,department,division');
		$this->db->from('tbl_employeelist');
		$this->db->where('reporting_to', $mid);
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
	
	function managerCheckrecord($depname,$divisionname)
	{
		$this->db->distinct();
		$this->db->select('reporting_to,department,division');
		$this->db->from('tbl_employeelist');
		$this->db->where('department', $depname);
		$this->db->where('division', $divisionname);
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
	

	
	
	
	
	 public function DetailempRecord() {


        $this->db->select("count(*) as id ,CardNo,EmpCode,DateTrn,name");

        $this->db->from('members_invoice');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
        $this->db->order_by("id", "ASC");
		
		$query = $this->db->get();
       
        return $query->result_array();
    }
	
	
	function Employeeeditinvoice($editid)
	{
		$this->db->select('*');
		$this->db->from('members_invoice');
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
	
	
	
	function detailssearchData($startdate,$enddate,$empcode)
	{
		//echo $val='select * from members_attendance_new where DateTrn BETWEEN "'. $startdate. '" and "'.$enddate.'" and EmpCode="'.$empcode.'"';
		//die;
		$this->db->select('*');

        $this->db->from('members_attendance_new');
		
		$this->db->where('DateTrn BETWEEN "'. $startdate. '" and "'.$enddate.'"');
		
		$this->db->where('EmpCode', $empcode);
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
	
	
	
	
	function bonussearchData($starttime,$endtime)
	{
		
		//echo $val='select * from members_attendance_new where ArrTim >'. $starttime. ' and DepTim >'.$endtime.'';
		//die;
		
		
		$this->db->select('*');

        $this->db->from('members_attendance_new');
		
		$this->db->where('ArrTim ="'. $starttime.'"  and DepTim >"'.$endtime.'"');
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
	
	
	function latesearchData($starttime,$endtime)
	{
		
		//echo $val='select * from members_attendance_new where ArrTim >'. $starttime. ' and ArrTim!=0 and DepTim <'.$endtime.' and DepTim !=0';
		//die;
		
		$this->db->select('*');

        $this->db->from('members_attendance_new');
		
		$this->db->where('ArrTim >"'. $starttime.'"  and ArrTim!=0  and DepTim <"'.$endtime.'" and DepTim !=0');
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
	
	
	

    public function member_total() {

        $this->db->select("COUNT('id') as num");

        $this->db->from("members_attendance_new");

        $query = $this->db->get();

        $row = $query->row();

        return $row->num;
    }

    
	
	
	
	 public function member_total_days_present($empcode) {

        $this->db->select("COUNT('presAbs') as num");

        $this->db->from("members_attendance_new");
		
		$this->db->where('PresAbs', 'P');
		$this->db->where('EmpCode', $empcode);
        $query = $this->db->get();

        $row = $query->row();

        return $row->num;
    }
	
	
	
	
	
	 public function member_total_days_absent($empcode) {

        $this->db->select("COUNT('presAbs') as num");

        $this->db->from("members_attendance_new");
		
		$this->db->where('presAbs', 'A');
		$this->db->where('EmpCode', $empcode);
        $query = $this->db->get();

        $row = $query->row();
		$rowdata = $query->num_rows();
		if($rowdata>0)
		{

        return $row->num;
		}
		else
		{
			
			return 0;
		}
    }
	
	
	function calculatelatecoiming($empcode="")
	{
		$this->db->select("LateHrs,EmpCode");
		$this->db->from("members_attendance_new");
		$this->db->where('EmpCode', $empcode);
		$query = $this->db->get();
		$row = $query->row();
		return $query->result_array();
			
	}
	
	
	
    function checkrecordbeforinsert($dateval)
	
	{
		
		//echo $d="select DateTrn from members_attendance_new where Month(`DateTrn`) = LPAD(MONTH('".$dateval."'), 2, '0')";
		//die;
		//select * from members_attendance_new where Month(`DateTrn`) = LPAD(MONTH(CURRENT_DATE()), 2, '0')
	    $this->db->select("DateTrn from members_attendance_new where Month(`DateTrn`) = LPAD(MONTH('".$dateval."'), 2, '0')");
		$query = $this->db->get();
		$num = $query->num_rows();
		
		if($num>0)
		{
			
			return 1;
			
		}
		else
		{
			return 0;
		}
		
			
	}
	
	

	
	
	
	
	






function Employeeinvoice()
	{
	$this->db->select("*");
	$this->db->from('members_invoice');
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





function calculateemaployeedata()

	{
		$this->db->select("count(*) as id ,CardNo,EmpCode,DateTrn,name");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
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






function totalemployeeworked()
{
		
		$this->db->select("TIMEDIFF(ArrTim, DepTim) as duration");

        $this->db->from('members_attendance_new');
		
        $this->db->order_by("id", "ASC");

        
        $query = $this->db->get();
		$row = $query->row();

        return $row['duration'];
	
}
    
	
	
	
function totweekoff($empcode="")
{
		
		$this->db->select("count(*) as PresAbs from members_attendance_new where PresAbs='WO' and EmpCode='".$empcode."'");
		//$this->db->from("members_attendance_new");
		//$this->db->where('EmpCode', $empcode,'shift','WO');
		
		$query = $this->db->get();
		$rows = $query->row();

        return $rows->PresAbs;
	
}

function totalabsentday($empcode="")
{
   
		$this->db->select("count(*) as PresAbs from members_attendance_new where PresAbs='A' and EmpCode='".$empcode."'");
		//$this->db->from("members_attendance_new");
		//$this->db->where('EmpCode', $empcode,'shift','WO');
		
		$query = $this->db->get();
		$rows = $query->row();
		
		$datacnt=$query->num_rows();
		
		if($datacnt>0)
		{
        return $rows->PresAbs; 
		}
		else
		{
			return "";
		}
    
    

}

function totalmonthday($empcode="")
{
   
		$this->db->select("count(*) as ArrTim from members_attendance_new where ArrTim!=0 and presAbs!='A' and EmpCode='".$empcode."'");
		
		
		$query = $this->db->get();
		$rows = $query->row();

        return $rows->ArrTim; 
    
    

}


function totalmonthdaycount($empcode="")
{
	
		$this->db->select("count(*) as id");

        $this->db->from("members_attendance_new");
		$this->db->where('EmpCode', $empcode);
		//$this->db->group_by('EmpCode'); 
		
        $query = $this->db->get();

        $row = $query->row();

        return $row->id; 
	
	
}



function allattendenceData($empid="")
{
	
		$this->db->select("*");

        $this->db->from('members_attendance_new');
		$this->db->where('EmpCode', $empid);
        $query = $this->db->get();

        return $query->result_array();

	
}


function editEmployeeData($editid)
{
	
		$this->db->select("*");

        $this->db->from('members_attendance_new');
		$this->db->where('id', $editid);
        $query = $this->db->get();
		
		return $query->result_array();

	
	
	
}


function  editEmployeeDataEmail($empid)
{
	
		$this->db->select("*");

        $this->db->from('members_attendance_new');
		$this->db->where('EmpCode', $empid);
        $query = $this->db->get();
		
		return $query->result_array();
	
	
}


/*** new summary calculation ****/



function  checklatecoimingEmployee($empCode="")

{
		$this->db->select("count(*) as id ,ShiftTime,EmpCode");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
		 $query = $this->db->get();
		$dataResult=$query->result_array();
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=$datamain[0];
		$shiftremzero = ltrim($shiftmainData, '0');
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
			
			$shiftdata = strtotime($shiftremzero);
			$bufferstarttime= date("H.i",strtotime('+10 minutes',$shiftdata));
			$mainsearchData=ltrim($bufferstarttime, '0');
			//echo $val='select * from members_attendance_new where ArrTim >'. $mainsearchData. ' and ArrTim!=0 and EmpCode=183';
			//die;
			
			//$data="select * from members_attendance_new where ArrTim >". $mainsearchData." and ArrTim!=0 and EmpCode='".$empCode."'";
			$query = $this->db->query("select * from members_attendance_new where ArrTim >". $mainsearchData." and ArrTim!=0 and EmpCode='".$empCode."'");
			//$this->db->select("ArrTim,DepTim,EmpCode,DateTrn,Name");
			//$this->db->from('members_attendance_new');
			//$this->db->where('ArrTim >', $mainsearchData);
			//$this->db->where('ArrTim > '.mysqli_real_escape_string($mainsearchData).' and  ArrTim!=0  and EmpCode='.$empCode.'' );
			//$this->db->where('EmpCode', $empCode);
			//$query = $this->db->get();
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
	
	
	function checktenMinute($empCode="")
	{
		
		$this->db->select("count(*) as id ,ShiftTime,EmpCode");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
		 $query = $this->db->get();
		$dataResult=$query->result_array();
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=$datamain[0];
		$shiftremzero = ltrim($shiftmainData, '0');
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
			
			$shiftdata = strtotime($shiftremzero);
			$bufferstarttime= date("H.i",strtotime('+10 minutes',$shiftdata));
			$mainsearchData=ltrim($bufferstarttime, '0');
			
			$endbufftertime= date("H.i",strtotime('+30 minutes',$shiftdata));
			$endbufftertimeData=ltrim($endbufftertime, '0');
			
			
			//echo $val='select * from members_attendance_new where ArrTim >'. $mainsearchData. ' and ArrTim!=0  and ArrTim < '.$endbufftertimeData.'';
			//die;
			
			$query = $this->db->query("select * from members_attendance_new where ArrTim >". $mainsearchData." and ArrTim!=0 and EmpCode='".$empCode."' and ArrTim < '".$endbufftertimeData."'");
			
			//$this->db->select("ArrTim,DepTim,EmpCode,DateTrn,name");
			//$this->db->from('members_attendance_new');
			//$this->db->where('ArrTim >"'. $mainsearchData.'"  and  ArrTim!=0 and ArrTim < "'.$endbufftertimeData.'"');
			//$this->db->where('EmpCode', $empCode);
			//$query = $this->db->get();
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
	
	
	function checkthirtyminute($empCode="")
	
	{
		$this->db->select("count(*) as id ,ShiftTime,EmpCode");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
		 $query = $this->db->get();
		$dataResult=$query->result_array();
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=$datamain[0];
		$shiftremzero = ltrim($shiftmainData, '0');
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
			
			$shiftdata = strtotime($shiftremzero);
			$bufferstarttime= date("H.i",strtotime('+30 minutes',$shiftdata));
			$mainsearchData=ltrim($bufferstarttime, '0');
			
			//$endbufftertime= date("H.i",strtotime('+30 minutes',$shiftdata));
			//$endbufftertimeData=ltrim($endbufftertime, '0');
			
			
			//echo $val='select * from members_attendance_new where ArrTim >'. $mainsearchData. ' and ArrTim!=0  and ArrTim < '.$endbufftertimeData.'';
			//die;
			//$this->db->select("ArrTim,DepTim,EmpCode,DateTrn,name");
			//$this->db->from('members_attendance_new');
			//$this->db->where('ArrTim >"'. $mainsearchData.'"  and  ArrTim!=0');
			//$this->db->where('EmpCode', $empCode);
			//$query = $this->db->get();
			
			
			$query = $this->db->query("select * from members_attendance_new where ArrTim >". $mainsearchData." and ArrTim!=0 and EmpCode='".$empCode."'");
			
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
	
	
	function checkemployeeleave($empCode="")
	{
		
		
		$this->db->select("count(*) as id ,ShiftTime,EmpCode");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
		 $query = $this->db->get();
		$dataResult=$query->result_array();
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=$datamain[0];
		$shiftremzero = ltrim($shiftmainData, '0');
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
			
			$shiftdata = strtotime($shiftremzero);
			$bufferstarttime= date("H.i",strtotime('+30 minutes',$shiftdata));
			$mainsearchData=ltrim($bufferstarttime, '0');
			
			//echo $val='select * from members_attendance_new where ArrTim =0 and DepTim=0  and PresAbs ="A"';
			//die;
			$this->db->select("ArrTim,DepTim,EmpCode,DateTrn,name,PresAbs");
			$this->db->from('members_attendance_new');
			$this->db->where('ArrTim =0  and  DepTim=0 and PresAbs ="A"');
			$this->db->where('EmpCode', $empCode);
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
	
	function totalpresentemployeeDay($empCode="")
	{
		
		$this->db->select("count(*) as id ,ShiftTime,EmpCode");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
		$query = $this->db->get();
		$dataResult=$query->result_array();
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=$datamain[0];
		$shiftremzero = ltrim($shiftmainData, '0');
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
			$shiftdata = strtotime($shiftremzero);
			$bufferstarttime= date("H.i",strtotime('+30 minutes',$shiftdata));
			$mainsearchData=ltrim($bufferstarttime, '0');
			$query = $this->db->query("select count(*)  as presentday,DateTrn from members_attendance_new where ArrTim !=0  and EmpCode='".$empCode."' and PresAbs='P'");
			//$this->db->select("ArrTim,DepTim,EmpCode,DateTrn,name,PresAbs");
			//$this->db->from('members_attendance_new');
			//$this->db->where('ArrTim =0  and  DepTim=0 and PresAbs ="A"');
			//$this->db->where('EmpCode', $empCode);
			//$query = $this->db->get();
			$querycount =$query->num_rows();
			$row = $query->row();
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
	
	function totaldayfindworking($empCode="")
	{
		
		$this->db->select("count(*) as id ,ShiftTime,EmpCode");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
		$query = $this->db->get();
		$dataResult=$query->result_array();
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=$datamain[0];
		$shiftmaindepartData=$datamain[1];
		$shiftremzero = ltrim($shiftmainData, '0');
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
		$shiftdata = strtotime($shiftremzero);
	    $shiftstartdata= date("H.i",strtotime('+0 minutes',$shiftdata));
		
			$firsttime=strtotime($shiftmainData);
			$secondtime=strtotime($shiftmaindepartData);
			$hours = ($secondtime - $firsttime)/3600; 
			$shifttimediff= floor($hours) . ':' . ( ($hours-floor($hours)) * 60 ); 
			
			
			
			$difftime=strtotime($shifttimediff);
			$minutetime=strtotime('00:30');
			$hoursnew = ($difftime - $minutetime)/3600; 
			$shifttimediffnew= floor($hoursnew) . '.' . ( ($hoursnew-floor($hoursnew)) * 60 ); 
			
			
			
			
			
			$query = $this->db->query("select * from  members_attendance_new where ArrTim !=0  and EmpCode='".$empCode."' and PresAbs='P'");
			$querycount =$query->num_rows();
			if($querycount>0)
			{
				$datarecord=$query->result_array();
				
				return $datarecord;
				
				
				$working_hour_data = array();
					 $i=0;
				foreach($datarecord as $val)
				{
					
					
					$arrTime=$val['ArrTim'];
					$DepTime=$val['DepTim'];
				
				   /*$firstarrtime=strtotime($arrTime);
			       $secondarrtime=strtotime($DepTime);
			       $hoursdata = (($secondarrtime - $firstarrtime)/3600); 
			       $workingtime= floor($hoursdata) . '.' . ( ($hoursdata-floor($hoursdata)) * 60 ); 
					
					
					if($workingtime > $shifttimediffnew){
						$dataresult=$workingtime;
					}else{
					      $working_hour_data[$i]=$workingtime;
					}
					
						return  $working_hour_data; */
						 
					
					
					 
					  
					
				}
			
			}
				else
				{
						return 0;
				}
			
			
			
		}
		
	}
	
   public function shiftedtimeData($empCode="")
    {
        
		
		$this->db->select("count(*) as id ,ShiftTime,EmpCode");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
		$query = $this->db->get();
		$dataResult=$query->result_array();
	
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=$datamain[0];
		$shiftmaindepartData=$datamain[1];
		$shiftremzero = ltrim($shiftmainData, '0');
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
		$shiftdata = strtotime($shiftremzero);
	    $shiftstartdata= date("H.i",strtotime('+0 minutes',$shiftdata));
		
			$firsttime=strtotime($shiftmainData);
			$secondtime=strtotime($shiftmaindepartData);
			$hours = ($secondtime - $firsttime)/3600; 
			$shifttimediff= floor($hours) . ':' . ( ($hours-floor($hours)) * 60 ); 
			
			
			$difftime=strtotime($shifttimediff);
			$minutetime=strtotime('00:30');
			$hoursnew = ($difftime - $minutetime)/3600; 
			$shifttimediffnew= floor($hoursnew) . '.' . ( ($hoursnew-floor($hoursnew)) * 60 ); 
			
			return $shifttimediffnew;
		}
		
		
    }
	
	
	function checkmainshifttime($empCode="")
	{
		
		$this->db->select("count(*) as id ,ShiftTime,EmpCode");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
        $this->db->order_by("id", "ASC");
		$query = $this->db->get();
		$dataResult=$query->result_array();
	
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=$datamain[0];
		$shiftmaindepartData=$datamain[1];
		$shiftremzero = ltrim($shiftmainData, '0');
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
		
	    return $shiftremzero;
		}
	}
	
	  function  getEmployeeName($empCode="")
	  {

			
			$this->db->select("count(*) as id ,EmpCode,Name");
			$this->db->from('members_attendance_new');
			$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
			$this->db->where('EmpCode', $empCode);
			
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
	  
	  
	  
	  function bonusEmployeeSearching($empCode="")
	  {
		  
		$this->db->select("count(*) as id ,ShiftTime,EmpCode,DateTrn");
		$this->db->from('members_attendance_new');
		$this->db->group_by('EmpCode HAVING COUNT(*) > 1'); 
		$this->db->where('EmpCode', $empCode);
		$this->db->order_by("id", "ASC");
		$query = $this->db->get();
		$dataResult=$query->result_array();
	
		$shifttime=$dataResult[0]['ShiftTime'];
		$datamain=explode("-",$shifttime);
		$shiftmainData=@$datamain[0];
		$shiftmaindepartData=@$datamain[1];
		$shiftremzero = ltrim($shiftmainData, '0');
		
		 $maincurdate=explode("-",$dataResult[0]['DateTrn']);
		 $finaldatemonth=$maincurdate[1];
		 $finaldateyear=$maincurdate[2];
		 $monthnumber = cal_days_in_month(CAL_GREGORIAN,  $finaldatemonth, $finaldateyear); // 31

		
		if($shiftremzero!="" || $shiftremzero!=0 )
		{
			
			//echo $vvv="select  count(*) as weeklyoff from  members_attendance_new where Shift ='WO' and EmpCode='".$empCode."'";
			//die;
			$queryweekfetch = $this->db->query("select  count(*) as weeklyoff from  members_attendance_new where Shift ='WO' and EmpCode='".$empCode."'");
			$queryweekcheck =$queryweekfetch->num_rows();
			
			if($queryweekcheck>0)
			{
				$dataResult=$queryweekfetch->result_array();
				$weekofftotal=$dataResult[0]['weeklyoff'];
			
			}
			else
			{
				$weekofftotal=0;
			}
			
			 //echo $queryval="select  count(*) as totalcorrecttime,EmpCode,Name,ShiftTime,ArrTim,DepTim from  members_attendance_new where ArrTim ='".$shiftremzero."' and DepTim >='".$shiftmaindepartData."'  and ArrTim!=0 and PresAbs!='A' and EmpCode='".$empCode."'";
			 //die;
		    $query = $this->db->query("select  count(*) as totalcorrecttime,EmpCode,Name,ShiftTime,ArrTim,DepTim from  members_attendance_new where ArrTim ='".$shiftremzero."' and DepTim >='".$shiftmaindepartData."'  and ArrTim!=0 and DepTim!=0 and PresAbs!='A' and EmpCode='".$empCode."'");
			$querycountbouns =$query->num_rows();
			if($querycountbouns>0)
			{
				$dataResultval=$query->result_array();
				$totalcorrecttime=$dataResultval[0]['totalcorrecttime'];
				
			}
			else
			{
				 $totalcorrecttime=0;
			}
			
			$totalcal=$weekofftotal+$totalcorrecttime;
			
			if($totalcal==$monthnumber  ||  $totalcal > $monthnumber)
			{
				return "<p style='color:green;'>Bonus Applicable</p>";
			}
			else
			{
				return "<p style='color:red;'>No Bouns Applicable<p>";
			}
		}
	  }
	
	
	
	


}
