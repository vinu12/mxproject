<?php

class User_model extends CI_Model {

public function __construct()
    {
	parent::__construct();
	$this->tableName = 'user_register';
	$this->primaryKey = 'id';
	$this->load->database();
			
 }
 
	public function userList() {


        $this->db->select('*');

        $this->db->from('user_register');
		$this->db->where('status',1);
        $this->db->order_by("id", "DESC");
		
		$query = $this->db->get();
       return $query->result_array();
    }
	
	
	
	
	
	
	 public function countOrderData($email,$limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM orders WHERE  email='".$email."' order by id  desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }
	
	
	
	function Checkpageurl($url)
	{
		
		  $query = $this->db->query("SELECT * FROM page_seo WHERE page_name='".$url."'");
          $data = $query->num_rows();
          $datafetch = $query->result_array();
          return $datafetch;
		
	}
	
	
	
	 public function countOrdersaveData($email) {

	   
        $query = $this->db->query("SELECT * FROM orders WHERE  email='".$email."' order by id desc");
        $data = $query->num_rows();

        return $data;
    }
	
	
	
	public function paymentdetails($email) {


        $this->db->select('*');
		$this->db->from('orders');
		$this->db->where('email',$email);
        $this->db->order_by("id", "DESC");
		
		$query = $this->db->get();
       return $query->result_array();
    }
	
	public function courseslist() {


        $this->db->select('*');
		$this->db->from('courses');
		$this->db->where('status','1');
        $this->db->order_by("id", "DESC");
		
		$query = $this->db->get();
       return $query->result_array();
    }
	
	function courseslistbyid($id)
	{
		
		$this->db->select('*');
		$this->db->from('courses');
		$this->db->where('id',$id);
        $this->db->order_by("id", "DESC");
		$query = $this->db->get();
        return $query->result_array();
		
		
	}
	
	

	
	
	public function topuserList() 
	{


        $this->db->select('*');
		$this->db->from('user_register');
		$this->db->where('status',1);
        $this->db->order_by("id", "DESC");
		$this->db->limit(10);
		$query = $this->db->get();
       return $query->result_array();
    }
	
	
	function totallikenews()
	{
		
		$this->db->select('*');

        $this->db->from('btnews');
		$this->db->where('likes >',0);
		$this->db->where('status','active');
        $this->db->order_by("likes", "DESC");
		$this->db->limit(5);
		$query = $this->db->get();
        return $query->result_array();
		
	}
	
	
	
	
	
	
	
	public function getdata($limit, $page)
	{
		$offset = 0;
		if ($page > 0)
		{
		$offset = $limit * ($page - 1);
		}
		$query = $this->db->query("SELECT * FROM user_register WHERE 1 AND status=1  order by id desc limit $offset,$limit");
		$data = $query->result_array();
		return $data;
	}
	
	public function countData()
    {
		
		$query = $this->db->query("SELECT * FROM user_register WHERE  1 AND status=1  order by id desc");
		$data = $query->num_rows();
	
        return $data;
    }
	
	
	
	
	public function getalleditorpickdata($limit, $page)
	{
		$offset = 0;
		if ($page > 0)
		{
		$offset = $limit * ($page - 1);
		}
		$query = $this->db->query("SELECT * FROM btnews WHERE likes >0 AND status='active'  order by likes desc limit $offset,$limit");
		$data = $query->result_array();
		return $data;
	}
	
	public function countalleditorpickData()
    {
		
		$query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active'  order by likes desc");
		$data = $query->num_rows();
	
        return $data;
    }
	
	
	
	
	
	
	function trendingnews()
	{
		
		$this->db->select('*');

        $this->db->from('btnews');
		$this->db->where('click_count >',0);
		$this->db->where('status','active');
        $this->db->order_by("click_count", "DESC");
		$this->db->limit(8);
		$query = $this->db->get();
        return $query->result_array();
		
	}
	
	
	function topstory()
	{
		
		$this->db->select('*');

        $this->db->from('btnews');
		$this->db->where('click_count >',0);
		$this->db->where('status','active');
        $this->db->order_by("click_count", "DESC");
		$this->db->limit(5);
		$query = $this->db->get();
        return $query->result_array();
		
	}
	
	
	
	
	function profilecheck($profileid)
	{
		$this->db->select('*');
		$this->db->from('user_register');
		$this->db->where('id ',$profileid);
		$this->db->where('status','1');
		$query = $this->db->get();
        return $query->result_array();
		
	}
	
	function userBlog($userid)
	{
		$this->db->select('*');
		$this->db->from('btnews');
		$this->db->where('priority !=','admin');
		
		$this->db->where('userid',$userid);
        $query = $this->db->get();
        return $query->result_array();
		
	}
	
	function userrecomand($userid)
	{
		$this->db->select('*');
		$this->db->from('btnews');
		$this->db->where('priority !=','admin');
		$this->db->where('click_count >','0');
		$this->db->where('userid',$userid);
		$this->db->order_by("id", "DESC");
		
        $query = $this->db->get();
        return $query->result_array();
		
	}
	
	
	function newslistthree()
	{
		
		$this->db->select('*');
		$this->db->from('btnews');
		$this->db->where('status','active');
		$this->db->order_by("id", "DESC");
		$this->db->limit(3, 0);
		$query = $this->db->get();
		return $query->result_array();
		
		
		
	}
	
	function newlistall()
	{
		$this->db->select('*');
		$this->db->from('btnews');
		$this->db->where('status','active');
		$this->db->order_by("id", "DESC");
		$this->db->limit('18446744073709551615',3);
		$query = $this->db->get();
		return $query->result_array();
	}

	
	
	public function getnewdata($limit, $page)
	{
		$offset=3;
		$offset = 0;
		if ($page > 0)
		{
		$offset = $limit * ($page - 1);
		}
		$query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active'  order by id desc limit $offset,$limit");
		$data = $query->result_array();
		return $data;
	}
	
	public function countnewsData()
    {
		
		$query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active'  order by id desc");
		$data = $query->num_rows();
	
        return $data;
    }
	
	
	
	
	public function checkUser($userData = array()){
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select($this->primaryKey);
            $this->db->from($this->tableName);
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'],'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                
                //update user data
                $userData['modified'] = date("Y-m-d H:i:s");
                $update = $this->db->update($this->tableName,$userData,array('id'=>$prevResult['id']));
                
                //get user ID
                $userID = $prevResult['id'];
            }else{
                //insert user data
                $userData['created']  = date("Y-m-d H:i:s");
                $userData['modified'] = date("Y-m-d H:i:s");
                $insert = $this->db->insert($this->tableName,$userData);
                
                //get user ID
                $userID = $this->db->insert_id();
            }
        }
        
        //return user ID
        return $userID?$userID:FALSE;
    }

	
	
	
	
	
}

