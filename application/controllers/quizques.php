<?php
class Quizques extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();
 
	function __construct()
	{
        parent::__construct();
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

    public function select_quiz(){
    if($this->logged_in==true){
    	$status="";
        $msg="";
        $quizzes=array();
        $arrayerror=array();
        $questions=array();

        $quiz=$this->input->post('quiz');
        
        $prefilled=array();
        $prefilled['quiz']=$quiz;

        $is_valid=true;
        $quiz_id=$this->input->get('id');
        if(!empty($quiz_id)){
            $quiz=$this->quizques_model->get_quiz($quiz_id);

            if(count($quiz)<=0){$is_valid=false;
                                $arrayerror['quiz']="No such quiz exists";
            }  
                else{ 
                    $quiz=$this->quizques_model->get_quiz($quiz_id);
                    $data['quiz_fetched']=$quiz;
                    $questions=$this->quizques_model->get_questions($quiz_id);

                        if(count($questions)<=0){
                                                $arrayerror['question']="No questions are uploaded";
                        }
                }

                    if($is_valid==true){
                                        $status="ques_upload";
                                        $questions=$this->quizques_model->get_questions($quiz_id);
                                            if(count($questions)<=0){
                                                                    $arrayerror['question']="No questions are uploaded";
                                            }
                                        
                                        $ques=$this->input->post('ques');
                                        $op1=$this->input->post('op1');
                                        $op2=$this->input->post('op2');
                                        $op3=$this->input->post('op3');
                                        $answer=$this->input->post('answer');

                                        $prefilled['ques']=$ques;
                                        $prefilled['op1']=$op1;
                                        $prefilled['op2']=$op2;
                                        $prefilled['op3']=$op3;
                                        $prefilled['answer']=$answer;

                                        if ($_SERVER["REQUEST_METHOD"]=="POST"){                                                                                
                                                                                if(empty($_POST["ques"])){
                                                                                                          $is_valid=false;
                                                                                                          $arrayerror['ques']="Question is required";
                                                                                }if(empty($_POST["op1"])){
                                                                                                          $is_valid=false;
                                                                                                          $arrayerror['op1']="Option 1 is required";
                                                                                }if(empty($_POST["op2"])){ 
                                                                                                            $is_valid=false;
                                                                                                            $arrayerror['op2']="Option 2 is required";
                                                                                }if(empty($_POST["op3"])){
                                                                                                            $is_valid=false;
                                                                                                            $arrayerror['op3']="Option 3 is required";
                                                                                } if(empty($_POST["answer"])){
                                                                                                            $is_valid=false;
                                                                                                            $arrayerror['answer']="Answer is required";
                                                                                }
                                                                                if($is_valid==true){
                                                                                                $data=array('quiz_id'=>$this->input->get('id'),
                                                                                                            'q_text'=>$prefilled['ques'],
                                                                                                            'op_1'=>$prefilled['op1'],
                                                                                                            'op_2'=>$prefilled['op2'],
                                                                                                            'op_3'=>$prefilled['op3'],
                                                                                                            'q_answer'=>$prefilled['answer']);
                                                                                                $this->quizques_model->insertques($data);
                                                                                                $msg="Your Question has been uploaded";
                                                                                }
                                                
                                        }
                    }
        }

                                        

        $data['msg']=$msg;
        $data['questions']=$questions;
        $data['quiz_fetched']=$quiz;
        $data['data_entered']=$prefilled;
        $data['quizzes']=$this->quizques_model->get_quizzes();
        $data['errors']=$arrayerror;
        $data['status']=$status;
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
        $data['title']="Select your quiz here";

        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('quiz/quizques_view',$data);
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