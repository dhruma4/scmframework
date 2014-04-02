<?php
class Quizdisplay extends CI_Controller{
  
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
		$count=0; 
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

        if($is_valid==true) {
			$status="quiz_answer";


			$questions=$this->quizques_model->get_questions($quiz_id);

          	if(count($questions)<=0){
                $arrayerror['question']="No questions are uploaded";
            }
            	
            foreach($questions as $question){
            	$answer=$this->input->post('answer_'.$question['q_id']);
				$prefilled['answer_'.$question['q_id']]=$answer;
				
	            if ($_SERVER["REQUEST_METHOD"]=="POST"){                                                                                
		            if(empty($_POST['answer_'.$question['q_id']])){
						$is_valid=false;
						$arrayerror['answer']="Answer is required";
					}

					if($is_valid==true){
						if($question['q_answer']==$prefilled['answer_'.$question['q_id']]){
								$count++;
						}

						$data=array('quiz_id'=>$this->input->get('id'),
									'marks'=>$count,
									);
						
						$this->quizques_model->insertresult($data);
						$status="submit";
					}
				}
			}
		}
			$data['questions']=$questions;
			$data['quiz_fetched']=$quiz;
			$data['data_entered']=$prefilled;
			$data['quizzes']=$this->quizques_model->get_quizzes();
			$data['errors']=$arrayerror;
			$data['status']=$status;
			$this->load->view('quiz/quizdisplay_view',$data);


	}

}
?>
