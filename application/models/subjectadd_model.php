<?php
class Subjectadd_model extends CI_Model{
	function __construct()
			{
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			}

			public function get_branch()
			{
				$this->db->select('branch_name,branch_id');
				$this->db->order_by("branch_name","asc");
				$query=$this->db->get('branch_master');
				
				return $query->result_array();
			}

			public function insertsubject($data) 
			{
				$this->db->insert('subject_master',$data);
			}

			public function get_subject(){
				$this->db->select('sub_id,sub_name');
				$this->db->order_by("sub_name","asc");
				$query=$this->db->get("subject_master");

				return $query->result_array();
			}

			public function get_subjectexists($subjectid){
				$this->db->select('sub_id,sub_name');
				$this->db->where('sub_name',$subjectid);
				$query=$this->db->get('subject_master');

				return $query->result_array();

			}
}

?>