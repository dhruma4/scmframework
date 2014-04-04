<?php
class Auth_model extends CI_Model
{
	function __construct(){
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
	}
	//login function
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

	public function security_check($sess_username){
		$this->db->select('*');
		$this->db->where('username',$sess_username);
		$query=$this->db->get('login_master');

		return $query->result_array();
	}

	public function get_sec_questions(){
		$this->db->select('*');
		$query=$this->db->get('security_ques_master');

		return $query->result_array();
	}
	public function insert_sec_ques($sess_username,$data){
		$this->db->where('username',$sess_username);
		$this->db->update('login_master',$data);
	}

	//forgot password 
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

	public function fetch_key($sess_username){
		$this->db->select('*');
		$this->db->where('username',$sess_username);
		$query=$this->db->get('login_master');

		return $query->result_array();
	}

	public function reset_pass($data){
		//$this->db->where('username',$sess_username);
		$this->db->update('login_master',$data);
	}
	public function insert_hash($hash,$time,$sess_username,$sess_role){
		$this->db->set('key',$hash);
		$this->db->set('time_session',$time);
		$this->db->where('username',$sess_username);
		$this->db->where('role',$sess_role);
		$this->db->update('login_master');
	}
	public function fetch_hash($_hash){
		$this->db->select('*');
		$this->db->where('key',$_hash);
		$query=$this->db->get('login_master');

		return $query->result_array();
	}
	public function clear_hash($sess_username,$sess){
		//$this->db->set('key',"");
		//$this->db->set('time_session',"");
		$this->db->where('username',$sess_username);
		$this->db->update('login_master',$sess);
	}
	public function fetch_email_student($_email){
		$this->db->select('*');
		$this->db->where('stu_email',$_email);
		$query=$this->db->get('student_master');

		return $query->result_array();
	}

	public function fetch_email($_email){
		$this->db->select('*');
		$this->db->where('fac_email',$_email);
		$query=$this->db->get('faculty_master');

		return $query->result_array();
	}

	public function fetch_username($_role){
		if($_role=="student"){
		$this->db->select('login_master.username,
						login_master.role,
						login_master.key,
						login_master.time_session
						student_master.stu_email');
		$this->db->from('login_master');
		$this->db->join('student_master','login_master.username=student_master.login_id');
		$query=$this->db->get();
		}
			else{
				$this->db->select('login_master.username,
						login_master.role,
						login_master.key,
						login_master.time_session
						faculty_master.fac_email');
		$this->db->from('login_master');
		$this->db->join('faculty_master','login_master.username=faculty_master.login_id');
		$query=$this->db->get();
			}

		return $query->result_array();
	}
}
?>