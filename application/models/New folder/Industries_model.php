<?php
/*
  develop by : Tarun Kumar
 */
 
 
defined('BASEPATH') or exit('No direct script access allowed');
class Industries_model extends CI_Model {

   public function __construct() {

        parent::__construct();

        $this->load->database();
    }

   public function getdata($limit, $page)
   {
		
		
		$offset = 0;
		
        if ($page > 0)
		{
            $offset = $limit * ($page - 1);
        }
		

	
		$query = $this->db->query("SELECT * FROM industries WHERE 1  order by id desc limit $offset,$limit");
		
		$data = $query->result_array();
		
	
        return $data;
   }

    public function countData()
   {
		
		$query = $this->db->query("SELECT * FROM industries WHERE  1  order by id desc");

		$data = $query->num_rows();
	
        return $data;
   }
 
  function insert_industry($data) {
        $insert = $this->db->insert('industries', $data);
        return $insert;
    }

    public function update_industry($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('industries', $data);
        return $this;
    }
   
}

