<?php

class Category_model extends CI_Model {

    /**
     * Validate the login's data with the database
     * @param string $user_name
     * @param string $password
     * @return void
     */
    function cumulativelist() {

        $this->db->select("*");
        $this->db->from("category");

        $this->db->where('Level', '0');
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    
    
    function check_record_advertise($updateid) {


        $this->db->select('*');
        $this->db->from('advertise');
        $this->db->where('id', $updateid);
        $query = $this->db->get();
        $querycount = $query->num_rows();
        if ($querycount > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    function getadvertise($editid)
    {
    
        $this->db->select("*");
        $this->db->from("advertise");

        $this->db->where('id', $editid);
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
        
    }

	
	
	function Addcategory($insertdata)
	{
		$result = $this->db->insert('Category', $insertdata);
		$this->db->where('Level', '0');
		$query = $this->db->get();
		$cnt=$query->num_rows();
		if($query->num_rows > 0)
		{
			return $query->result_array();
		}
		else
		{
			return 0;
		}	
	}
	
	
	


    function subcategory($levelid) {

        $this->db->select("*");
        $this->db->from("category");
        $this->db->where('Level', $levelid);
         $this->db->where('status', 'active');
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }
    
    
    
    function addadvertiseData($UserRecord)
    {
    
        $this->db->trans_start();
        $this->db->insert('advertise', $UserRecord);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
        
    }
    
    
    function childcategory($levelid) {

        $this->db->select("*");
        $this->db->from("category");
        $this->db->where('Level', $levelid);
         $this->db->where('status', 'active');
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

   

    function deletecategory($deleteid) {

        $this->db->where('cat_id', $deleteid);
        $this->db->delete('category');
    }

    function deleteworkcategory($deleteid) {
        $this->db->where('id', $deleteid);
        $this->db->delete('workplace_category');
    }

    function alltopcategory() {

        $this->db->select("*");
        $this->db->from("category");
        $this->db->where('Level', 0);
        $this->db->order_by('cat_id', 'ASC');
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    function subcat_Details($subcatid) {

        $this->db->select("*");
        $this->db->from("category");
        $this->db->where('cat_id', $subcatid);
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    function check_subcat($subcat) {

        $this->db->select("*");
        $this->db->from("category");
        $this->db->where('Level', $subcat);
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    function check_childsubcat($childsubid) {
        $this->db->select("*");
        $this->db->from("category");
        $this->db->where('Level', $childsubid);
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    function cumulativeeditData($editid) {


        $this->db->select("*");
        $this->db->from("category");
        $this->db->where('cat_id', $editid);
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    function punlishfeedlist() {
        $this->db->select("*");
        $this->db->from("news");
        $this->db->where('priority <', 9);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        $cnt = $query->num_rows();
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	
		 public function Newslist($limit, $page) {
        $offset = 0;
        if ($page > 0) {
            $offset = $limit * ($page - 1);
        }
        $query = $this->db->query("SELECT * FROM news  WHERE priority < 9 order by id desc limit $offset,$limit");
        $data = $query->result_array();
        return $data;
    }

    public function countNewsData() {

        $query = $this->db->query("SELECT * FROM news  WHERE  priority < 9  order by id desc");
        $data = $query->num_rows();

        return $data;
    }
	
	
	
	
	
	
	
	

}
