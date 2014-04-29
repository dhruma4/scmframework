<?php
class Fac_subject_model extends CI_Model
{
	function __construct(){
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
	} 

	public function insertfac_subject($data){
		$this->db->insert('faculty_subject_master',$data);
	}

	public function get_tests(){
		$this->db->select('test_id,test_name');
		$this->db->order_by("test_name","asc");
		$this->db->where('test_flag',"1");
		$query=$this->db->get('classtest_master');

		return $query->result_array();
	} 
	public function get_branches(){
		$this->db->select('branch_id,branch_name');
		$this->db->order_by("branch_name","asc");
		$query=$this->db->get('branch_master');

		return $query->result_array();
	}
	public function get_faculties(){
		$this->db->select('fac_id,fac_name');
		$this->db->order_by("fac_name","asc");
		$query=$this->db->get('faculty_master');

		return $query->result_array();
	}
	public function get_subjects(){
		$this->db->select('sub_id,sub_name');
		$this->db->order_by("sub_name","asc");
		$query=$this->db->get('subject_master');

		return $query->result_array();
	}
	public function get_branch_name($branch){
		$this->db->select('branch_id,branch_name');
		$this->db->order_by("branch_name","asc");
		$this->db->where("branch_id",$branch);
		$query=$this->db->get('branch_master');

		return $query->result_array();
	}
}
?>