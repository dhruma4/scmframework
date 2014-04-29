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
	}//subject-faculty mapping
	public function getsubject_bybranch_bysem($branchid,$semid){
		$this->db->select('*');
		$this->db->order_by('sub_name',"asc");
		$this->db->where("branch_id",$branchid);
		$this->db->where("semester",$semid);
		$query=$this->db->get("subject_master");

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
	//for faculty
	public function getsubject_bysem_forfaculty($semid,$faculty_logged){
		$this->db->select('m.fac_id,
							m.subject_id,
							m.branch_id,
							m.branch_name,
							m.semester,
							s.sub_id,
							s.sub_name,
							s.semester');
		$this->db->from("faculty_subject_master as m");
		$this->db->join("subject_master as s","m.subject_id=s.sub_id");
		//$this->db->order_by("branch_name","asc");
		$this->db->where("m.semester",$semid);
		$this->db->where("m.fac_id",$faculty_logged);
		$query=$this->db->get();

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

	}//assignment upload
	public function getfaculty_bysubject($subjectid,$semid){
		$this->db->select('m.fac_id,
						m.sub_id,
						m.semester,
						f.fac_id,
						f.fac_name'
					);
		$this->db->from("faculty_subject_master as m");
		$this->db->join("faculty_master as f","f.fac_id=m.fac_id");
		$this->db->where("m.sub_id",$subjectid);
		$this->db->where("m.semester",$semid);
		$query=$this->db->get();

		return $query->result_array();
	}
	//assignment view for students
	public function getassignment_bysubject($subjectid){
		$this->db->select('assign_id,assign_name,sem,sub_id');
		$this->db->where("sub_id",$subjectid);
		
		$query=$this->db->get("assignment_upload");

		return $query->result_array();
	}


}
?>