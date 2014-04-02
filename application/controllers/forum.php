<?php
class Topicdisplay extends CI_Controller{
  
	function __construct()
	{
		parent::__construct();
		$this->load->model('forum_model');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function forum_create(){
		
	}
}
?>