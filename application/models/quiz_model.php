<?php
class Quiz_model extends CI_Model
	{
		function __construct()
			{
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			}

		public function insert_quiz($data)
		{
			$this->db->insert('quiz_master',$data);
		}


		public function get_nameexists($nameid)
		{
			$this->db->select('quiz_id,quiz_name');
			$this->db->where('quiz_name',$nameid);
			$query=$this->db->get('quiz_master');

			return $query->result_array(); 

		}

		public function get_subject()
		{
			$this->db->select('sub_id,sub_name');
			$this->db->order_by("sub_name","asc");
			$query=$this->db->get('subject_master');

			return $query->result_array();
		}
	}
?>