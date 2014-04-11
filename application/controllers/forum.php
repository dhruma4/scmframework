<?php
class Forum extends CI_Controller{
	public $logged_in=false;
	public $logged_in_details=array();
  
	function __construct()
	{
		parent::__construct();
		$this->load->model('forum_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
        $id=$this->session->userdata('login_id');

        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
	}

	public function forum_create(){
	if($this->logged_in==true){
		$status="";
		$prefilled=array();
		$arrayerror=array();

		$topic=$this->input->post('topic');
    	$brief=$this->input->post('brief');
    	
    	$prefilled['topic']=$topic;
    	$prefilled['brief']=$brief;
    	
    	if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
        		$is_valid=true;
				if(empty($topic)){
					$is_valid=false;
					$arrayerror['topic']="Topic is required";
				}

				if(empty($brief)){
					$is_valid=false;
					$arrayerror['brief']="Brief on the topic is required";
				}
				if($is_valid==true){
					$user_id=$this->logged_in_details['login_id'];
					$data=array('disc_ques_topic'=>$topic,
								'disc_ques_brief'=>$brief,
								'ask_id'=>$user_id);
					$this->forum_model->insert_topic($data);
					$status="posted";
				}
		}
		$data['data_entered']=$prefilled;
		$data['status']=$status;
		$data['errors']=$arrayerror;
		$data['title']="Create your discussion topic here";
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
                
        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('forum/forumcreate_view',$data);
        $this->load->view('template/footercss.php',$data);
		
	} 
		else{
			$msg= "You are not logged in.You must be logged in to access the function.";
                
                $data['title']=$msg;
                $data['logged_in_details']=$this->logged_in_details;
                $data['logged_in']=$this->logged_in;
                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('template/footercss.php',$data);
            }

		
	}
	public function topic_list(){
	if($this->logged_in==true){
		$topics=array();
		$topics=$this->forum_model->get_topics();
		
		$data['topics']=$topics;
		$data['logged_in_details']=$this->logged_in_details;
		$data['logged_in']=$this->logged_in;
		$data['title']="List of Topics";

		$this->load->view('template/headercss.php',$data);
 		$this->load->view('template/contentcss.php',$data);
 		$this->load->view('forum/topicdisplay_view',$data);
 		$this->load->view('template/footercss.php',$data);
 	}
 			else{
 				$msg= "You are not logged in.You must be logged in to access the function.";
                
                $data['title']=$msg;
                $data['logged_in_details']=$this->logged_in_details;
                $data['logged_in']=$this->logged_in;
                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('template/footercss.php',$data);
 			}
		

	}
	public function topic_details(){
	if($this->logged_in==true){
		$topic=array();
		$arrayerror=array();
		$msg="";
		$new_comment=$this->input->post('new_comment');
		$prefilled=array();
		$prefilled['new_comment']=$new_comment;

		$topic_id=$this->uri->segment(3,0);
		$topic=$this->forum_model->get_topic($topic_id);
		$comments=$this->forum_model->get_comments($topic_id);
		
		if(count($comments)<=0){
			$arrayerror['comments']="There are no comments to display";
		}
		if(count($topic)<=0){
			$arrayerror['topic']="No such topic exist";
		}
		if(isset($_POST['new_comment']) AND !empty($_POST['new_comment'])){
			if ($_SERVER["REQUEST_METHOD"]=="POST"){
				$is_valid=true;
				$comment=trim($new_comment);
				if(empty($comment)){
					$is_valid=false;
					$arrayerror['new_comment']="Comment is required";
				}
				if($is_valid==true){
					$user_id=$this->logged_in_details['login_id'];
					
					$data=array('comment_text'=>$new_comment,
								'disc_ques_id'=>$topic_id,
								'commentator_id'=>$user_id);
					$this->forum_model->insert_comment($topic_id,$data);
					$msg="Comment has been posted";
				}

			}
		} 
		$data['errors']=$arrayerror;
		$data['msg']=$msg;
		$data['comments']=$comments;
		$data['topic_details']=$topic;
		$data['data_entered']=$prefilled;
		$data['title']="Upload your assignment here";
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
                
        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('forum/topicdetails_view',$data);
        $this->load->view('template/footercss.php',$data);
	}
		else{
				$msg= "You are not logged in.You must be logged in to access the function.";
                
                $data['title']=$msg;
                $data['logged_in_details']=$this->logged_in_details;
                $data['logged_in']=$this->logged_in;
                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('template/footercss.php',$data);
            
		}
	}
}
?>