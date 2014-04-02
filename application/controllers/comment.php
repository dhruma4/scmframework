<?php
class Comment extends CI_Controller{
  
	function __construct()
	{
      parent::__construct();
      	$this->load->model('comment_model');
        $this->load->helper('url');
	    $this->load->helper('form');
	    
   	}
}
?>