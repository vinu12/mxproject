<?php

class News_model extends CI_Model {

    public function SchoolingNews() {


        $this->db->select('*');
        $this->db->from('btnews');
        $this->db->where('status', 'active');
        $this->db->where('priority', '1');
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        if ($query) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
    
    

    function Newscomments($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('comments', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    
    
     function UserBlog($UserRecord) {
        $this->db->trans_start();
        $this->db->insert('btnews', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
	
	
	
	function Addnewlike($UserRecord)
	{
		$this->db->trans_start();
        $this->db->insert('likes', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
		
	}
	
	function deletenewsunlike($delid,$userid)
	{

		$this->db->where('newsid',$delid);
		$this->db->where('userid',$userid);
        $data=$this->db->delete('likes');
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
	
	
	
	public function checklikeDetails($newsid,$userid) {


        $this->db->select('*');
        $this->db->from('likes');
        $this->db->where('newsid', $newsid);
        $this->db->where('userid', $userid);
       
        $query = $this->db->get();
		
        if ($query) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
	
	
	
	
	
	
	public function checknewviews($newsid,$ipaddress) {


        $this->db->select('*');
        $this->db->from('btnewsview');
        $this->db->where('nid', $newsid);
        $this->db->where('ip_device', $ipaddress);
       
        $query = $this->db->get();
		
        if ($query) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
	
	 
	
	public function Updatenewsviewcount($click_count,$ip,$newsid)
	{ 
	    $this->db->where('id', $newsid);
		$this->db->set('click_count', $click_count, FALSE);
		$this->db->set('ip_address', $ip);
		$query = $this->db->update('btnews');

		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	
	
	
	
	public function CheckNewsResultData($newsid)
	{ 
		$this->db->select('*');
		$this->db->from('btnews');
	    $this->db->where('id', $newsid);
		$query = $this->db->get();
		if($query){
			return $query->result_array();
		}
		else{
			return false;
		}
	}
	
	
	
	
	
	 function newsview($UserRecord) {


        $this->db->trans_start();
        $this->db->insert('btnewsview', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    
    

    public function newscommentedlist($loginid,$newsid) {


        $this->db->select('*');
        $this->db->from('comments');
        $this->db->where('replyid',0);
        //$this->db->where('loginid',$loginid);
        $this->db->where('newsid',$newsid);
        //$this->db->order_by("CommentID", "DESC");
        $query = $this->db->get();
        if ($query) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
        public function newscommentereply($loginid,$newsid) {


        $this->db->select('*');
        $this->db->from('comments');
        $this->db->where('loginid!=',$loginid);
          $this->db->where('replyid!=',0);
        
        $this->db->where('newsid',$newsid);
        //$this->db->order_by("CommentID", "DESC");
        $query = $this->db->get();
        if ($query) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
    

    public function getschoolingdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active' AND priority=1  order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countschoolingData() {

        $query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active' AND priority=1  order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    public function getsearchdata($limit, $page, $search) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews where page_title like '%$search%' OR author like '%$search%' AND status='active'  order by id desc limit $offset,$limit");
        $data = $query->result_array();
        if ($data) {
            return $data;
        } else {
            return 0;
        }
    }
	
	
	 public function getsearchdatanew($search) {
       
	    if($search!="")
		{
		$query = $this->db->query("SELECT * FROM btnews where page_title like '%$search%' AND status='active'");
	    $data = $query->num_rows();
		}
		else if($search=="")
		{
		$query = $this->db->query("SELECT * FROM btnews where 1 =1 AND status='active' order by id desc ");
	    $data = $query->num_rows();
		}
		if($data==0)
		{
		
		$query = $this->db->query("SELECT * FROM btnews where author like '%$search%' AND status='active'");
		}
        
        $data = $query->result_array();
        if ($data) {
            return $data;
        } else {
            return 0;
        }
    }

    public function countsearchData($search) {

        $query = $this->db->query("SELECT * FROM btnews where page_title like '%$search%' OR author like '%$search%' AND status='active'");
        $data = $query->num_rows();
        if ($data > 0) {
            return $data;
        } else {
            return 0;
        }
    }

    public function gethighereducationdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active' AND priority=2  order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function counthighereducationData() {

        $query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active' AND priority=2  order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    public function getresearchdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active' AND priority=2  order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countresearchData() {

        $query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active' AND priority=2  order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    public function getquotesdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active' AND priority='7'  order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countquotesData() {

        $query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active' AND priority='7'  order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    public function getstoriesdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active' AND priority='8'  order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countstoriesData() {

        $query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active' AND priority='8'  order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    public function getgeneralnewdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active' AND priority='4'  order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countgeneralnewData() {

        $query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active' AND priority='4'  order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    public function gettrandingdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active'  order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function counttrandingData() {

        $query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active'   order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    public function getuserarticlesdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active' AND userid!='41' AND userid!='admin' order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countuserarticlesData() {

        $query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active'  AND userid!='41' AND userid!='admin'  order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    public function getpictruestoriesdata($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM picture_stories WHERE  status='1' order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countpictruestoriesData() {

        $query = $this->db->query("SELECT * FROM picture_stories WHERE  status='1'  order by id desc");
        $data = $query->num_rows();

        return $data;
    }

    function quotesnews() {

        $this->db->select('*');

        $this->db->from('btnews');
        $this->db->where('priority', 7);
        $this->db->where('status', 'active');
        $this->db->order_by("id", "DESC");
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }

    function findnews($newsid) {

        $this->db->select('*');

        $this->db->from('btnews');
        $this->db->where('id', $newsid);
        $this->db->where('status', 'active');
        $this->db->order_by("id", "DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    function Subscribeemail($UserRecord) {

        $this->db->trans_start();


        $this->db->insert('subscribe', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function checkrecord($email) {
        $this->db->select('*');
        $this->db->from('subscribe');
        $this->db->where('status', '1');
        $this->db->where('stu_email', $email);

        $query = $this->db->get();
        $record = $query->num_rows();
        if ($record == 0) {
            return "success";
        } else {
            return "error";
        }
    }

}

?>