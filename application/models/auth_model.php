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
	public function get_loginexists($loginid,$role){
		$this->db->select('*');
		$this->db->where('username',$loginid);
		$this->db->where('role',$role);
		$query=$this->db->get('login_master');

		return $query->result_array();	
	}
	public function get_id($username,$role){
		$this->db->select('login_id');
		$this->db->where('role',$role);
		$this->db->where('username',$username);
		$query=$this->db->get('login_master');

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

	public function reset_pass($username,$_role,$data){
		//$this->db->where('username',$sess_username);
		$this->db->where('username',$username);
		$this->db->where('role',$_role);
		$this->db->update('login_master',$data);
	}
	public function insert_hash($hash,$time,$sess_username,$sess_role){
		$this->db->set('key',$hash);
		$this->db->set('time_session',$time);
		$this->db->where('username',$sess_username);
		$this->db->where('role',$sess_role);
		$this->db->update('login_master');
	}
	public function fetch_hash($_hash,$_role){
		$this->db->select('*');
		$this->db->where('key',$_hash);
		$this->db->where('role',$_role);
		$query=$this->db->get('login_master'); 

		return $query->result_array();
		echo $this->db->last_query();
	}
	public function clear_hash($sess_username,$sess){
		//$this->db->set('key',"");
		//$this->db->set('time_session',"");
		$this->db->where('username',$sess_username);
		$this->db->update('login_master',$sess);
	}
	public function fetch_email_student($_email){
		$this->db->select('stu_email');
		$this->db->where('stu_email',$_email);
		$query=$this->db->get('student_master');

		return $query->result_array();
	}

	public function fetch_email($_email){
		$this->db->select('fac_email');
		$this->db->where('fac_email',$_email);
		$query=$this->db->get('faculty_master');

		return $query->result_array();
	}

	public function fetch_username($_role,$email,$_hash){
		if($_role=="student"){
			$this->db->select('l.username,
				l.role,
				l.key,
				l.time_session,
				s.stu_email'
			);  
			$this->db->from('login_master as l');
			$this->db->join('student_master as s','l.username=s.login_id');
			$this->db->where('s.stu_email',$email);
			$this->db->where('l.key',$_hash);
			$query=$this->db->get();

		} else {
			$this->db->select('l.username,
						l.role,
						l.key,
						l.time_session
						f.fac_email');
			$this->db->from('login_master as l');
			$this->db->join('faculty_master as f','l.username=f.login_id');
			$this->db->where('f.fac_email',$email);
			$this->db->where('l.key',$_hash);
			$query=$this->db->get();
		}

		return $query->result_array();
	}
}
?>