<?php
class Testdisplay extends CI_Controller{
  
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
		$count=0;
		$classtest=array();
		$arrayerror=array();
		$questions=array();

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
            
            foreach($questions as $question){
				$answer=$this->input->post('answer_'.$question['t_ques_id']);
				$prefilled['answer_'.$question['t_ques_id']]=$answer;

				if ($_SERVER["REQUEST_METHOD"]=="POST"){                                                                                
		            if(empty($_POST['answer_'.$question['t_ques_id']])){
						$is_valid=false;
						$arrayerror['answer']="Answer is required";
					}
                             
					if($is_valid==true){

						if($question['t_answer']==$prefilled['answer_'.$question['t_ques_id']]){
							$count++;
						}

						$data=array('test_id'=>$this->input->get('id'),
								'marks'=>$count,
								'stu_id'=>""
					);
			
					$this->classtestques_model->insertresult($data);
					$status="submit";
					}
				}

			}
					/*$data=array('test_id'=>$this->input->get('id'),
								'marks'=>$count,
								'stu_id'=>""
					);
			
					$this->classtestques_model->insertresult($data);
					$status="submit";*/
		}
		$data['questions']=$questions;
		$data['test_fetched']=$classtest;
		$data['data_entered']=$prefilled;
		$data['tests']=$this->classtestques_model->get_tests();
		$data['errors']=$arrayerror;
		$data['status']=$status;
		$this->load->view('classtest/testdisplay_view',$data);
		
	}
}
?>
