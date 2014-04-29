<?php
class Assignmentupload_model extends CI_Model
	{
		function __construct()
			{
				
				$this->load->helper('url');
				$this->load->helper('form');
				$this->load->database();
			}

		public function insert_assignment($data)
		{
			$this->db->insert('assignment_upload',$data);
		}

		 /*public function get_faculty()
		{
			$this->db->select('fac_name,fac_id'); 
			$this->db->order_by("fac_name","asc");
			$query=$this->db->get('faculty_master');

			return $query->result_array();
		} */

		public function get_subject($faculty_logged)
		{
			$this->db->select('m.subject_id,
								m.fac_id,
								m.semester,
								m.branch_id,
								m.branch_name,
								s.sub_id,
								s.sub_name');
			$this->db->from("faculty_subject_master as m");
			$this->db->join("subject_master as s","s.sub_id=m.subject_id");
			$this->db->order_by("sub_name","asc");
			$this->db->where('fac_id',$faculty_logged);
			$query=$this->db->get();

			return $query->result_array(); 
		}
		public function get_assignmentexists($assignid)
		{
			$this->db->select('assign_name,fac_id,sub_id');
			$this->db->where('assign_name',$assignid);
			$query=$this->db->get('assignment_upload');

			return $query->result_array();
		}
		public function get_faculty($username)
		{
			$this->db->select('fac_name,fac_id'); 
			$this->db->order_by("fac_name","asc");
			$this->db->where("login_id",$username);

			$query=$this->db->get('faculty_master');

			return $query->result_array();
		}
		public function verify_faculty_subject($subject,$faculty_logged,$sem){
			$this->db->select('*');
			$this->db->order_by('branch_name',"asc");
			$this->db->where("subject_id",$subject);
			$this->db->where("fac_id",$faculty_logged);
			$this->db->where("semester",$sem);
			$query=$this->db->get('faculty_subject_master');

			return $query->result_array();
		}

	}
?>