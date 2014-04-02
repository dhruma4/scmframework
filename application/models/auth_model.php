<?php
class Auth_model extends CI_Model
{
	function __construct(){
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
	}

	public function get_student_loginexists($loginid){
		$this->db->select('*');
		$this->db->where('login_id',$loginid);
		$query=$this->db->get('student_master');

		return $query->result_array();	
	}
	public function get_loginexists($loginid){
		$this->db->select('*');
		$this->db->where('login_id',$loginid);
		$query=$this->db->get('faculty_master');

		return $query->result_array();	
	}

	public function verify_user($array){
		$this->db->select('*');
		$this->db->where($array);
		$query=$this->db->get('login_master');

		return $query->result_array();
	}

	public function fetch_ques($loginid){
		$this->db->select('*');
		$this->db->where('username',$loginid);
		$query=$this->db->get('login_master');

		return $query->result_array();
	}

	public function verify_ans($array){
		$this->db->select('*');
		$this->db->where($array);
		$query=$this->db->get('login_master');

		return $query->result_array();
	}

	public function get_recipient($sess_username){
		$this->db->select('*');
		$this->db->where('login_id',$sess_username);
		$query=$this->db->get('faculty_master');

		return $query->result_array();
	}

	public function get_recipient_student($sess_username){
		$this->db->select('*');
		$this->db->where('login_id',$sess_username);
		$query=$this->db->get('student_master');

		return $query->result_array();
	}

	public function fetch_ques_sess($data){
		$this->db->select('*');
		$this->db->where($data);
		$query=$this->db->get('login_master');

		return $query->result_array();
	}
}
?>