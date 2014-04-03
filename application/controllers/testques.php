<?php
class Testques extends CI_Controller{
  
	function __construct()
	{
      parent::__construct();
      $this->load->model('classtestques_model');
      $this->load->helper('url');
	  $this->load->helper('form');
     }

    public function select_test()
    {
        $status="";
        $msg="";
        $classtest=array();
        $arrayerror=array();
        $questions=array();

        $test=$this->input->post('test');
        
        $prefilled=array();
        $prefilled['test']=$test;

        $is_valid=true;
        $classtest_id=$this->input->get('id');
        
        
        if(empty($classtest_id)){
                                    $is_valid=false;
                                    $arrayerror['test']="Class test must be selected";
                                }

            else{
                    $classtest=$this->classtestques_model->get_test($classtest_id);

                        if(count($classtest)<=0){
                                                    $is_valid=false;
                                                    $arrayerror['test']="No such test exists";
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
                                       // echo '</pre>';
                                        //print_r($prefilled);
                                        


                                        if ($_SERVER["REQUEST_METHOD"]=="POST"){                                                                                
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
                                                                                                        $data=array('test_id'=>$this->input->get('id'),
                                                                                                                    't_ques_text'=>$prefilled['ques'],
                                                                                                                    'op_1'=>$prefilled['op1'],
                                                                                                                    'op_2'=>$prefilled['op2'],
                                                                                                                    'op_3'=>$prefilled['op3'],
                                                                                                                    't_answer'=>$prefilled['answer']);


                                                                                                        $this->classtestques_model->insertques($data);
                                                                                                        $msg="Your Question has been uploaded";

                                                                                                        }

                                                                                    
                                                                                }
                                            
                                                $questions=$this->classtestques_model->get_questions($classtest_id);

                                                  if(count($questions)<=0){
                                                                            $arrayerror['question']="No questions are uploaded";
                                                                          }
    
                                    

      $data['msg']=$msg;
      $data['questions']=$questions;
      $data['test_fetched']=$classtest;
      $data['data_entered']=$prefilled;
      $data['tests']=$this->classtestques_model->get_tests();
      $data['errors']=$arrayerror;
      $data['status']=$status;
      $this->load->view('classtest/classtest_quesview',$data);

        
    }
}
?>