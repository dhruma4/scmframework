<?php
class Student_view extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();
  
	function __construct() 
	{
        parent::__construct(); 
        $this->load->model('assignmentques_model');
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

        $prefilled=array();
        $prefilled['assign']=$assign;
      
        $is_valid=true;
        $assign_id=$this->input->get('id');

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



}
?>
