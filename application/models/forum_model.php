<?php
class Forum_model extends CI_Model
{
	function __construct()
		{
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->database();
		}
		//forum create function
	public function insert_topic($data){
		$this->db->set('ask_id',"");
		$this->db->insert('discussion_board_topic',$data);

	} 
 	//topic display function
	public function get_topics(){
		$this->db->select('t.ask_id,
						   t.disc_ques_id,
						   t.disc_ques_topic,
						   t.disc_ques_brief,
						   t.disc_quescreated,
						   l.username,
						   l.login_id'
						   );
		$this->db->from('discussion_board_topic as t');
		$this->db->join('login_master as l', 'l.login_id=t.ask_id');
		//$this->db->where()
		//$this->db->order_by("disc_quescreated","desc");
		$query=$this->db->get();

		return $query->result_array();
	}
	
	//topic details function
	public function get_topic($topic_id){
		$this->db->select('t.ask_id,
						   t.disc_ques_id,
						   t.disc_ques_topic,
						   t.disc_ques_brief,
						   t.disc_quescreated,
						   l.login_id,
						   l.username'
						);
		$this->db->from('discussion_board_topic as t');
		$this->db->join('login_master as l', 'l.login_id=t.ask_id');
		$this->db->where('t.disc_ques_id',$topic_id);
		$query=$this->db->get();

		return $query->result_array();
	}

	public function get_comments($topic_id){
		$this->db->select('c.comment_id,
						   c.comment_text,
						   c.disc_ques_id,
						   c.commentator_id,
						   c.comment_posted,
						   l.login_id,
						   l.username');
		$this->db->from('discussion_board_comment as c');
		$this->db->join('login_master as l','l.login_id=c.commentator_id');
		$this->db->where('c.disc_ques_id',$topic_id);
		$query=$this->db->get();

		return $query->result_array();
	}
	public function insert_comment($topic_id,$data){
		$this->db->where('disc_ques_id',$topic_id);
		$this->db->insert('discussion_board_comment',$data);
	}
}

?>
