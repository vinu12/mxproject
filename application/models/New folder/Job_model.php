<?php

class Job_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*public function joblist() {


        $this->db->select('*');

        $this->db->from('job');
        $this->db->where('status', 1);
		 $this->db->limit(10);
        $this->db->order_by("id", "DESC");

        $query = $this->db->get();
        return $query->result_array();
    } */
	
	
	
	 public function joblist($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM job WHERE status='1' order by jobtitle  REGEXP '^[international]'  desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countJobData() {

        $query = $this->db->query("SELECT * FROM job WHERE   status='1' order by jobtitle  REGEXP '^[international]'  desc");
        $data = $query->num_rows();

        return $data;
    }
	
	
	
	 public function countsaveData($userid) {

	   
        $query = $this->db->query("SELECT * FROM savejob WHERE  userid=$userid And savejobid!='0' order by id desc");
        $data = $query->num_rows();

        return $data;
    }
	
	
	
	 public function countapplayData($userid) {

	   
        $query = $this->db->query("SELECT * FROM savejob WHERE  userid=$userid And applyjobid!='0' order by id desc");
        $data = $query->num_rows();

        return $data;
    }
	
	
	
	
	function insertRecord($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('savejob', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	
	
	

    public function latestjobList() {


        $this->db->select('*');
        $this->db->from('job');
        $this->db->where('status', 1);
        $this->db->order_by("id", "DESC");
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	
	function savejoblistData($userid,$limit,$page)
	{
		
		$offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
       
		 $this->db->select("job.id, job.image,job.companyname,job.companyprofile,job.address,job.jobtitle,job.jobdescription,job.jobtype,job.desiredcandidate, job.keyskill, job.datetime, job.jobview,savejob.savejobid,savejob.userid,savejob.id from job INNER JOIN savejob on job.id=savejob.savejobid AND savejob.userid = '".$userid."'  order by job.id desc limit $offset,$limit");
		 $query = $this->db->get();
		
		if($query)
		{
        return $query->result_array();
		}
		else
		{
			return 0;
		}
		
		
			
       
	}
	
	 public function countsaveJobData($userid) {

        $this->db->select('job.id,job.image,job.companyname,job.companyprofile,job.address,job.jobtitle,job.jobdescription,job.jobtype,job.desiredcandidate,job.keyskill,job.datetime,job.jobview,savejob.savejobid,savejob.savejobid,savejob.userid,savejob.id')
			->from('job')
			->join('savejob', 'job.id = savejob.savejobid  AND savejob.userid = "'.$userid.'"');
			 $query = $this->db->get();
        $data = $query->num_rows();

        return $data;
    }
	
	
	 public function countapplysaveJobData($userid) {

        $this->db->select('job.id as jobid,job.image,job.companyname,job.companyprofile,job.address,job.jobtitle,job.jobdescription,job.jobtype,job.desiredcandidate,job.keyskill,job.datetime,job.jobview,savejob.applyjobid')
			->from('job')
			->join('savejob', 'job.id = savejob.applyjobid  AND savejob.userid = "'.$userid.'"');
			 $query = $this->db->get();
        $data = $query->num_rows();

        return $data;
    }
	
	
	
	
	
	
	function applyjoblistData($userid,$limit,$page)
	{
		
		$offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
       
		 $this->db->select(" job.image,job.companyname,job.companyprofile,job.address,job.jobtitle,job.jobdescription,job.jobtype,job.desiredcandidate, job.keyskill, job.datetime, job.jobview,savejob.applyjobid,savejob.id from job INNER JOIN savejob on job.id=savejob.applyjobid AND savejob.userid = '".$userid."'  order by job.id desc limit $offset,$limit");
		 $query = $this->db->get();
		
		if($query)
		{
        return $query->result_array();
		}
		else
		{
			return 0;
		}
		
		
			
       
	}
	
	
	
	
	
	
	function searchjoblist($searchData)
	
	{
		
		$this->db->select('*');
        $this->db->from('job');
        $this->db->like('jobtitle',$searchData);
		$this->db->or_like('companyname',$searchData);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
		if($query)
		{
        return $query->result_array();
		}
		else
		{
			return 0;
		}
		
		
		
	}
	
	
	function checkjobappaystatus($userid,$applyid)
	{
		$this->db->select('*');
        $this->db->from('savejob');
        $this->db->where('applyjobid',$applyid);
		
		$this->db->order_by("id", "DESC");
        $query = $this->db->get();
		if($query)
		{
        return $query->result_array();
		}
		else
		{
			return 0;
		}
	}
	
	
	
	function deleteSavejobData($delid)
	{
		
		$this->db->where('id',$delid);
		
        $data=$this->db->delete('savejob');
		//print_r($this->db->last_query()); exit;
		if($data)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	
	
	function checkjobstatus($userid,$jobid)
	{
		
		$this->db->select('*');
        $this->db->from('savejob');
        $this->db->where('savejobid',$jobid);
		
		$this->db->order_by("id", "DESC");
        $query = $this->db->get();
		if($query)
		{
        return $query->result_array();
		}
		else
		{
			return 0;
		}
		
	}
	
	function profilejob($jobid)
	{
		
		$this->db->select('*');
        $this->db->from('job');
        $this->db->where('id',$jobid);
		$this->db->order_by("id", "DESC");
        $query = $this->db->get();
		if($query)
		{
        return $query->result_array();
		}
		else
		{
			return 0;
		}
		
		
	}
	
	
	
	function relatedjob($title)
	{
		
		$this->db->select('*');
        $this->db->from('job');
        $this->db->like('jobtitle',$title);
		$this->db->order_by("id", "DESC");
        $query = $this->db->get();
		if($query)
		{
        return $query->result_array();
		}
		else
		{
			return 0;
		}
		
		
	}

    

}
