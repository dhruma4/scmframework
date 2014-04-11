<?php
class Testdisplay extends CI_Controller{
	public $logged_in=false;
    public $logged_in_details=array();
  
	function __construct()
	{
		parent::__construct();
		$this->load->model('classtestques_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$id=$this->session->userdata('login_id');

        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
    }

	public function select_test(){
	if($this->logged_in==true){
		$status=""; 
		$count=0;
		$classtest=array();
		$arrayerror=array();
		$questions=array();
		$marks=0;

        $test=$this->input->post('test');
        
        $prefilled=array();
        $prefilled['test']=$test;

        $is_valid=true;
        $classtest_id=$this->input->get('id');

        if(empty($classtest_id)) {
        	$is_valid=false;
            $arrayerror['test']="Class test must be selected";
        } 
        else {
        	$classtest=$this->classtestques_model->get_test($classtest_id);
        	if(count($classtest)<=0){
                $is_valid=false;
                $arrayerror['test']="No such test exists";
        	}
        }

        if($is_valid==true) {
			$status="test_answer";
			

			$questions=$this->classtestques_model->get_questions($classtest_id);
			if(count($questions)<=0){
                $arrayerror['question']="No questions are uploaded";
            }
            if ($_SERVER["REQUEST_METHOD"]=="POST"){   
	            foreach($questions as $question){
					$answer=$this->input->post('answer_'.$question['t_ques_id']);
					$prefilled['answer_'.$question['t_ques_id']]=$answer;
	                                                                        
		            if(empty($_POST['answer_'.$question['t_ques_id']])){
						$is_valid=false;
						$arrayerror['answer']="Answer is required";
					}  
					if($is_valid==true){
						if($question['t_answer']==$prefilled['answer_'.$question['t_ques_id']]){
							$count++;
							$marks=$count;
						}
					}
				}          
				 if($is_valid==true){
							$id=$this->session->userdata('login_id');

							$data=array('test_id'=>$this->input->get('id'),
										'marks'=>$count,
										'stu_id'=>$id,
										);
				
							$this->classtestques_model->insertresult($data);
							$status="submit";
				}
			}
					
		}
		$data['questions']=$questions;
		$data['test_fetched']=$classtest;
		$data['data_entered']=$prefilled;
		$data['tests']=$this->classtestques_model->get_tests();
		$data['errors']=$arrayerror;
		$data['status']=$status;
		$data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
        $data['title']="Select test to answer";

		$this->load->view('template/headercss.php',$data);
		$this->load->view('template/contentcss.php',$data);
		$this->load->view('classtest/testdisplay_view',$data);
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
