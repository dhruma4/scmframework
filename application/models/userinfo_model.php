<?php
 class Userinfo_model extends CI_Model
 {
 	public function Userinfo_model()
 	{
 		parent::__construct();
 		$this->load->database();
 	}

 	public function insertdata($data)
 	{
 		// echo '<pre/>';print_r($this->db);die();
 		$this->db->insert('userdetails',$data);
 	}

  }
?>
