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
			$this->db->order_by('test_id','RANDOM');
			$this->db->limit(5);
			$this->db->where('test_quesflag',"1");
			$query=$this->db->get('classtest_ques');

			return $query->result_array();
		}

		public function insertresult($data){
			$this->db->insert('classtest_result',$data);
		} //view result for student
		public function get_classtest($classtest_id){
			$this->db->select('r.stu_id,
								r.test_id,
								r.marks,
								r.t_resultflag,
								r.testresult_date,
								c.test_id,
								c.test_name,
								c.test_flag');
			$this->db->from('classtest_result as r');
			$this->db->join('classtest_master as c',"r.test_id=c.test_id");
			$this->db->where('r.test_id',$classtest_id);
			$this->db->order_by('r.stu_id',"asc");
			$query=$this->db->get();

			return $query->result_array();
		}

	}
?> 