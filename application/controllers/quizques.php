<?php
class Quizques extends CI_Controller{
  
	function __construct()
	{
      parent::__construct();
      $this->load->model('quizques_model');
      $this->load->helper('url');
	  $this->load->helper('form');
     }

    public function select_quiz()
    {
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

        if(empty($quiz_id)){
                                    $is_valid=false;
                                    $arrayerror['quiz']="Quiz must be selected";
                            }

            else{
                    $quiz=$this->quizques_model->get_quiz($quiz_id);

                        if(count($quiz)<=0){
                                                    $is_valid=false;
                                                    $arrayerror['quiz']="No such quiz exists";
                                            }
 
                }

                 if($is_valid==true){
                                        $status="ques_upload";
                                        

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


                                         if ($_SERVER["REQUEST_METHOD"]=="POST")
                                         {                                                                                
                                                                                    if(empty($_POST["ques"])){
                                                                                                              $is_valid=false;
                                                                                                              $arrayerror['ques']="Question is required";
                                                                                                              }

                                                                                    if(empty($_POST["op1"])){
                                                                                                              $is_valid=false;
                                                                                                              $arrayerror['op1']="Option 1 is required";
                                                                                                            }
                                                                                   
                                                                                    if(empty($_POST["op2"])) { 
                                                                                     
                                                                                                                $is_valid=false;
                                                                                                                $arrayerror['op2']="Option 2 is required";
                                                                                                              }
                                                                                      
                                                                                    if(empty($_POST["op3"])){
                                                                                                                $is_valid=false;
                                                                                                                $arrayerror['op3']="Option 3 is required";
                                                                                                            }                                                                                                           }
                                                                                        
                                                                                    
                                                                                    if(empty($_POST["answer"])){
                                                                                      
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

                                        $questions=$this->quizques_model->get_questions($quiz_id);

                                                  if(count($questions)<=0){
                                                                            $arrayerror['question']="No questions are uploaded";
                                                                          }

      $data['msg']=$msg;
      $data['questions']=$questions;
      $data['quiz_fetched']=$quiz;
      $data['data_entered']=$prefilled;
      $data['quizzes']=$this->quizques_model->get_quizzes();
      $data['errors']=$arrayerror;
      $data['status']=$status;
      $this->load->view('quiz/quizques_view',$data);

    }
}
?>