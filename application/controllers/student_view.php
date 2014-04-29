<?php
class Student_view extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();
  
	function __construct() 
	{
        parent::__construct(); 
        $this->load->model('assignmentques_model');
        $this->load->model('classtestques_model');
        $this->load->model('quizques_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $id=$this->session->userdata('login_id');
        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
    }
    public function view_assignment_ques(){
    if($this->logged_in==true){
        $status="";
        $msg="";
        $assignment=array();
        $arrayerror=array();
        $questions=array(); 
        
        $assign=$this->input->post('assign');
        $sem=$this->input->post('sem');
        $subject=$this->input->post('subject');

        $prefilled=array();
        $prefilled['assign']=$assign;
        $prefilled['sem']=$sem;
        $prefilled['subject']=$subject;
      
        $is_valid=true;
        $assign_id=$this->input->get('id');
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $is_valid=true;
            if(empty($_POST["sem"])){
                $is_valid=false;
                $arrayerror['sem'] = "Semester is required";
            }
            if(empty($_POST["subject"])){
                $is_valid=false;
                $arrayerror['subject'] = "Subject is required";
            }
        }

        if(!empty($assign_id)){
        $assignment=$this->assignmentques_model->get_assign($assign_id);
        
            if(count($assignment)<=0){
                $is_valid=false;
                $arrayerror['assign']="No such assignment exists";
            }   
            else{
                $assignment=$this->assignmentques_model->get_assign($assign_id);
                $data['assignment_fetched']=$assignment;
                $questions=$this->assignmentques_model->get_stu_questions($assign_id);
                $status="ques_view";
                if(count($questions)<=0){
                    $arrayerror['question']="No questions are uploaded";
                }
            }
            if($is_valid==true){
                            $status="ques_view";
                            $questions=$this->assignmentques_model->get_stu_questions($assign_id);
                            
                            if(count($questions)<=0){
                                                    $arrayerror['question']="No questions are uploaded";
                            }
            } 
        }
        
        $data['questions']=$questions;
        $data['subjects']=$this->assignmentques_model->get_subject();
        $data['assignment_fetched']=$assignment;
        $data['data_entered']=$prefilled;
        $data['assignments']=$this->assignmentques_model->get_assignment();
        $data['errors']=$arrayerror;
        $data['status']=$status;
        $data['title']="";
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;

        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('student_view/stu_assign_view',$data);
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
    public function view_classtest_result(){
        if($this->logged_in==true){
        $status="";
        $result=array();
        $classtest=array();
        $arrayerror=array();
        $test=$this->input->post('test');
        
        $prefilled=array();
        $prefilled['test']=$test;

        $is_valid=true;
        $classtest_id=$this->input->get('id');

        if(!empty($classtest_id)) {
            $classtest=$this->classtestques_model->get_classtest($classtest_id);
           
            if(count($classtest)<=0){
                $is_valid=false;
                $arrayerror['test']="No test data exists";
            }
            else{
                $classtest=$this->classtestques_model->get_classtest($classtest_id);
              
                $data['test_fetched']=$classtest;
                $status="test_result";
            }
        }
        $data['test_fetched']=$classtest;
        $data['data_entered']=$prefilled;
        $data['tests']=$this->classtestques_model->get_tests();
        $data['errors']=$arrayerror;
        $data['status']=$status;
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
        $data['title']="";

        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('result/classtestresult_view',$data);
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
    public function view_quiz_result(){
    if($this->logged_in==true){
        $status="";
        $quizzes=array();
        $arrayerror=array();
        $quiz=$this->input->post('quiz');
        
        $prefilled=array();
        $prefilled['quiz']=$quiz;
        $is_valid=true;
        $quiz_id=$this->input->get('id');

            if(!empty($quiz_id)){
                $quiz=$this->quizques_model->get_quiz_result($quiz_id);
                if(count($quiz)<=0){
                    $is_valid=false;
                    $arrayerror['quiz']="No quiz data exists";
                }
            else{
                $quiz=$this->quizques_model->get_quiz_result($quiz_id);
                $data['quiz_fetched']=$quiz;
                $status="quiz_result";
                
            }
            }
        $data['quiz_fetched']=$quiz;
        $data['data_entered']=$prefilled;
        $data['quizzes']=$this->quizques_model->get_quizzes();
        $data['errors']=$arrayerror;
        $data['status']=$status;
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
        $data['title']="";

        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('result/quizresult_view',$data);
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
