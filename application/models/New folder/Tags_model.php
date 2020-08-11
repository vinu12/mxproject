<?php
class Tags_model extends CI_Model {


	public function getschoolingnewsdata($limit, $page,$search)
	{
		$offset = 0;
		if ($page > 0)
		{
		$offset = $limit * ($page - 1);
		}
		$query = $this->db->query("SELECT * FROM btnews WHERE  page_title like '%$search%' ||  description like '%$search%' AND  status='active'  order by id desc limit $offset,$limit");
		$data = $query->result_array();
		return $data;
	}
	
	public function countschoolingnewsData($search)
    {
		
		$query = $this->db->query("SELECT * FROM btnews WHERE  page_title like '%$search%' ||  description like '%$search%'   AND status='active'  order by id desc");
		$data = $query->num_rows();
	
        return $data;
    }
	
    
    
    
	
	
	
	
	
}
	
	?>