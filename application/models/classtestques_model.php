<?php
class Classtestques_model extends CI_Model
	{
		function __construct()
			{
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			} 

		public function insertques($data){
			$this->db->insert('classtest_ques',$data);
		}

		public function get_tests(){
			$this->db->select('test_id,test_name');
			$this->db->order_by("test_name","asc");
			$this->db->where('test_flag',"1");
			$query=$this->db->get('classtest_master');

			return $query->result_array();
		} 
 
		public function get_test($classtest_id){ 
			$this->db->select('test_id,test_name');
			$this->db->where('test_id',$classtest_id);
			$query=$this->db->get('classtest_master');

			return $query->result_array();
		}

		public function get_questions($classtest_id){
			$this->db->select('test_id,t_ques_id,t_ques_text,op_1,op_2,op_3,t_answer');
			$this->db->where('test_id',$classtest_id);
			$this->db->where('test_quesflag',"1");
			$query=$this->db->get('classtest_ques');

			return $query->result_array();
		}

		public function insertresult($data){
			$this->db->insert('classtest_result',$data);
		}
	}
?> 