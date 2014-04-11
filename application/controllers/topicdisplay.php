<?php
class Topicdisplay extends CI_Controller{
  
	function __construct()
	{
		parent::__construct();
		$this->load->model('forum_model');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	/*public function select_topic()
	{
		$status="";
		$count=0;
		$topic=array();
		$arrayerror=array();
		$comments=array(); 

        $topic=$this->input->post('topic');
        
        $prefilled=array();
        $prefilled['topic']=$topic;

        $is_valid=true;
        $topic_id=$this->input->get('id');

        if(empty($topic_id)) {
        	$is_valid=false;
            $arrayerror['topic']="Topic must be selected";
        } 
        else {
        	$topic=$this->classtestques_model->get_test($classtest_id);
        	if(count($topic)<=0){
                $is_valid=false;
                $arrayerror['topic']="No such topic exists";
        	}
        }*/
}
        ?>



