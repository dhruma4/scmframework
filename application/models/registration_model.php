<?php
class Registration_model extends CI_Model
	{
		function __construct()
			{
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			}

		 
		public function get_branch()
			{
				$this->db->select('branch_name,branch_id');
				$this->db->order_by("branch_name","asc");
				$query=$this->db->get('branch_master');
				
				return $query->result_array();
			} 
 
		public function insertstudent($data)
			{

				$this->db->insert('student_master',$data);
		    }
 
		public function insertfaculty($data)
			{
				$this->db->insert('faculty_master',$data);
			}

		public function get_city()
			{
				$this->db->select('city_name,city_id');
				$this->db->order_by("city_name","asc");
				$query=$this->db->get('city_master');
								

				return $query->result_array();
			}

		public function get_state()
			{
				$this->db->select('state_name,state_id');
				$this->db->order_by("state_name","asc");
				$query=$this->db->get('state_master');
				
				return $query->result_array();
			}	

		public function get_designation()
			{
				$this->db->select('designation,designation_id');
				$this->db->order_by("designation","asc");
				$query=$this->db->get('designation_master');

				return $query->result_array();
			}

		public function get_enrollexists($enrollid)
		{
			$this->db->select('stu_enroll,stu_id');
			$this->db->where('stu_enroll',$enrollid);
			$query=$this->db->get('student_master');

			return $query->result_array();
		}	

		

		public function get_usernameexists($loginid)
		{
			$this->db->select('username,login_id');
			$this->db->where('username',$loginid);
			$query=$this->db->get('login_master');

			return $query->result_array();
		}

		public function set_username($loginid)
		{
			
			$this->db->set('username',$loginid);
			$this->db->set('password',"");
			$this->db->set('security_ques',"");
			$this->db->set('security_ans',"");
			$this->db->set('role',"");
			$query=$this->db->insert('login_master');


		}
		
		
	} 
?>	