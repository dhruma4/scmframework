<?php
class Assignmentsubmit_model extends CI_Model{
	function __construct()
	{
      
      $this->load->helper('form');
      $this->load->helper('url');
	  $this->load->database();
	}

	public function insertassignment($data)
	{
		$this->db->insert('assignment_submit',$data);
	} 

	
}
?>
