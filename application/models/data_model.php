<?php
class Data_model extends CI_Model{

	function Data_model()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function getcity_bystate($stateid){
		$this->db->select('city_name,city_id');
		$this->db->order_by("city_name","asc");
		$this->db->where("state_id",$stateid);
		$query=$this->db->get("city_master");

		return $query->result_array();
	}

	public function getsubject_bybranch($branchid){
		$this->db->select('sub_name,sub_id');
		$this->db->order_by("sub_name","asc");
		$this->db->where("branch_id",$branchid);
		$query=$this->db->get("subject_master");

		return $query->result_array();
	}

	public function getsubject_bysem($semid){
		$this->db->select('sub_name,sub_id');
		$this->db->order_by("sub_name","asc");
		$this->db->where("semester",$semid);
		$query=$this->db->get("subject_master");

		return $query->result_array();
	}

	public function getques_number($assignid){
		$this->db->select('assign_id,assign_ques_id');
		$this->db->where("assign_id",$assignid);
		$query=$this->db->get("assignment_ques_master");

		return $query->result_array();
	}


	public function getassignid($assign){
		$this->db->select('assign_id,assign_name');
		$this->db->where("assign_id",$assign);
		$query=$this->db->get("assignment_upload");

		return $query->result_array();

	}


}
?>