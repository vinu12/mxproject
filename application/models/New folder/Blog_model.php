<?php
class Blog_model extends CI_Model {


	public function blogData() {

	
        $this->db->select('*');
		$this->db->from('btnews');
		$this->db->where('status','active');
		$this->db->where('priority','1');
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
	
	
	public function getBlogdata($limit, $page)
	{
		$offset = 0;
		if ($page > 0)
		{
		$offset = $limit * ($page - 1);
		}
		
		$query = $this->db->query("SELECT * FROM btnews WHERE 1 AND status='active' AND userid!='admin'  order by id desc limit $offset,$limit");
		$data = $query->result_array();
		return $data;
	}
	
	public function countblogData()
    {
		
		$query = $this->db->query("SELECT * FROM btnews WHERE  1 AND status='active' AND userid!='admin'  order by id desc");
		$data = $query->num_rows();
	
        return $data;
    }
	
	
	
	
	
	
	
	
	
}
	
	?>