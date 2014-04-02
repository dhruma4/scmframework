<?php
class Registrationstu extends CI_Model
	{
		function __construct()
			{
				$this->load->helper('url');
				$this->load->helper('form');
			}

			function insertfaculty()
				{
					 //$this->db->insert($data);
					 $this->db->insert('faculty_master',$data);
                     return $this->db->last_insert_id();
				}
					function insertstudent()
						{
							$stu=array(
								'stu_enroll'='',
								'stu_name'='',
								'stu_sem'='',
								'stu_branch'='',
								'stu_dob'='',
								'stu_add'='',
								'stu_city'='',
								'stu_state'='',
								'stu_contact'='',
								'student_registered'='',
								'login_id'='');
							$this->db->insert('student_master',$stu);
						}
							function get_branch_master($branch_name)
							{
                             	$this->db->select('branch_name');
                             	$query=$this->db->get('branch_master');
                             	return $query->result_array();
							}
	} 
?>	