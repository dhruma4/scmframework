<?php
class Classtest_model extends CI_Model
	{
		function __construct()
			{
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			}

		public function insert_test($data){
			$this->db->insert('classtest_master',$data);
		}


		public function get_testexists($testid){
			$this->db->select('test_id,test_name');
			$this->db->where('test_name',$testid);
			$query=$this->db->get('classtest_master');

			return $query->result_array(); 

		}

		public function get_subject(){
			$this->db->select('sub_id,sub_name');
			$this->db->order_by("sub_name","asc");
			$query=$this->db->get('subject_master');

			return $query->result_array();
		}
	}
?>