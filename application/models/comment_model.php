<?php
class Comment_model extends CI_Model
{
	function __construct()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
	}

	public function insert_comment($data){
		$this->db->insert('discussion_board_comment',$data);
	}
}
?>