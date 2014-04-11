<?php
class Quizques_model extends CI_Model
	{
		function __construct()
			{
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			}

		public function insertques($data){
			$this->db->insert('quiz_add_ques',$data);
		}

		public function get_quizzes(){
			$this->db->select('quiz_id,quiz_name');
			$this->db->order_by("quiz_name","asc");
			$query=$this->db->get('quiz_master');

			return $query->result_array();
		} 

		public function get_quiz($quiz_id){ 
			$this->db->select('quiz_id,quiz_name');
			$this->db->where('quiz_id',$quiz_id);
			$query=$this->db->get('quiz_master');

			return $query->result_array();
		}

		public function get_questions($quiz_id){
			$this->db->select('quiz_id,q_id,q_text,op_1,op_2,op_3,q_answer');
			$this->db->where('quiz_id',$quiz_id);
			$query=$this->db->get('quiz_add_ques');

			return $query->result_array();
		}

		public function insertresult($data){
			$this->db->insert('quiz_result',$data);
		}
		/*public function get_student(){
			$this->db->select('');
			$this->db->from('');
			$this->db->join();
			$this->db->where();
			$query=$this->db->get();

			return $query->result_array();
		}*/
	}
?> 