<?php
class Assignmentupload_model extends CI_Model
	{
		function __construct()
			{
				
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			}

		public function insert_assignment($data)
		{
			$this->db->insert('assignment_upload',$data);
		}

		public function get_faculty()
		{
			$this->db->select('fac_name,fac_id');
			$this->db->order_by("fac_name","asc");
			$query=$this->db->get('faculty_master');

			return $query->result_array();
		}

		public function get_subject()
		{
			$this->db->select('sub_name,sub_id');
			$this->db->order_by("sub_name","asc");
			$query=$this->db->get('subject_master');

			return $query->result_array(); 
		}
	}
?>