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
			$this->db->where('quiz_flag',"1");
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
			$this->db->where('quiz_flag',"1");
			$query=$this->db->get('quiz_add_ques');

			return $query->result_array();
		}

		public function insertresult($data){
			$this->db->insert('quiz_result',$data);
		} // view result for student
		public function get_quiz_result($quiz_id){
			$this->db->select('r.stu_id,
							r.quiz_id,
							r.marks,
							r.result_date,
							q.quiz_id,
							q.quiz_name,
							q.quiz_flag');
			$this->db->from('quiz_result as r');
			$this->db->join('quiz_master as q',"r.quiz_id=q.quiz_id");
			$this->db->where('r.quiz_id',$quiz_id);
			$this->db->order_by('r.stu_id',"asc");
			$query=$this->db->get();

			return $query->result_array();

		}
	}
?> 