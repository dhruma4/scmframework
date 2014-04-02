<?php
class Forum_model extends CI_Model
{
	function __construct()
		{
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->database();
		}
	public function insert_topic($data){
		$this->db->set('ask_id',"");
		$this->db->insert('discussion_board_topic',$data);

	}

	public function get_topics(){
		$this->db->select('*');
		$this->db->order_by("disc_quescreated","desc");
		$query=$this->db->get('discussion_board_topic');

		return $query->result_array();
	}

	public function get_topic($topic_id){
		$this->db->select('*');
		$this->db->where('disc_ques_id',$topic_id);
		$query=$this->db->get('discussion_board_topic');

		return $query->result_array();
	}

	public function get_comments($topic_id){
		$this->db->select('*');
		$this->db->where('disc_ques_id',$topic_id);
		$query=$this->db->get('discussion_board_comment');

		return $query->result_array();
	}
}
?>
