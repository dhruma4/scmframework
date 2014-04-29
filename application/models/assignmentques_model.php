<?php
class Assignmentques_model extends CI_Model
	{
		function __construct()
			{
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			}

		public function insertques($data){
			$this->db->insert('assignment_ques_master',$data);
		} 

		public function get_assignment(){
			$this->db->select('assign_id,assign_name');
			$this->db->order_by("assign_name","asc");
			$query=$this->db->get('assignment_upload'); 

			return $query->result_array();
		}

		public function get_assign($assign_id){ 
			$this->db->select('assign_id,assign_name,assign_submit_date');
			$this->db->where('assign_id',$assign_id);
			$query=$this->db->get('assignment_upload');

			return $query->result_array();
		}

		public function get_questions($assign_id){
			$this->db->select('assign_id,assign_ques_id,assign_ques_text');
			$this->db->where('assign_id',$assign_id);
			$query=$this->db->get('assignment_ques_master');

			return $query->result_array();
		}
		public function get_stu_questions($assign_id){
			$this->db->select('assign_id,assign_ques_id,assign_ques_text,assign_ques_flag');
			$this->db->where('assign_id',$assign_id);
			$this->db->where('assign_ques_flag',"1");
			$query=$this->db->get('assignment_ques_master');

			return $query->result_array();
		}
		public function get_subject(){
			$this->db->select('sub_id,sub_name');
			$query=$this->db->get('subject_master');

			return $query->result_array();
		}
	}
?>