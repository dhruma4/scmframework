<?php
class Assignmentsubmit_model extends CI_Model{
	function __construct()
	{
      
      $this->load->helper('form');
      $this->load->helper('url');
	  $this->load->database();
	}

	public function insertassignment($data)
	{
		$this->db->insert('assignment_submit',$data);
	} 
	public function fetch_assignments(){
		$this->db->select('assign_id,
							assign_name'
						);
		//$this->db->from('assignment_upload');
		//$this->db->join('assignment_ques_master as q');
		//$this->db->where('a.assign_id','q.assign_id');
		$query=$this->db->get('assignment_upload');

		return $query->result_array();
	}

	
}
?>
