<?php
/*
  develop by : Tarun Kumar
 */
 
 
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliates_model extends CI_Model {

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
		

	
		$query = $this->db->query("SELECT * FROM affiliates WHERE 1  order by id desc limit $offset,$limit");
		
		$data = $query->result_array();
		
	
        return $data;
   }

    public function countData()
    {
		
		$query = $this->db->query("SELECT * FROM affiliates WHERE  1  order by id desc");

		$data = $query->num_rows();
	
        return $data;
    }
 
   public function approved($id)
   {
		$query = $this->db->query("UPDATE `affiliates` SET  `status` =  '1' WHERE  `id` ='".$id."'");
        return $query;
   }
   
  public function rejected($id)
   {
		
		$query = $this->db->query("UPDATE  `affiliates` SET  `rejected` =  '1' WHERE `id` ='".$id."'");
        return $query->result_array();
   }
 
 public function getUserData($id)
    {
		
		$query = $this->db->query("SELECT * FROM affiliates WHERE  id='".$id."'  order by id desc");

		$data = $query->result_array();
	
        return $data;
    }
 
   
}

