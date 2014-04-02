<?php
 class Userinfo extends CI_Model
 {
 	public function Userinfo()
 	{
 		$this->load->database();
 	}

 	public function insertuser()
 	{
 		$data=array(
 			'name'=>$_POST['uname'],
 		'password'=>$_POST['pwd']);
 		$this->db->insert('userdetails',$data);
 	}

 	/*public function fetchuser($name)
 	{

 		$query=$this->db->get_where('userdetails','name'=>$name);
 		return $query->result_array();
 	}*/
 }
?>
