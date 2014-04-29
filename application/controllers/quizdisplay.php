<?php
class Quizdisplay extends CI_Controller{
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
		$count=0; 
		$quizzes=array();
		$arrayerror=array();
		$questions=array();

        $quiz=$this->input->post('quiz');
        
        $prefilled=array();
        $prefilled['quiz']=$quiz;
        $marks=0;
        $is_valid=true;
        $quiz_id=$this->input->get('id');

	        if(!empty($quiz_id)){
	         	$quiz=$this->quizques_model->get_quiz($quiz_id);
	            if(count($quiz)<=0){
	                $is_valid=false;
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
			$status="quiz_answer";
			$questions=$this->quizques_model->get_questions($quiz_id); 
			if(count($questions)<=0){
                $arrayerror['question']="No questions are uploaded";
            }
            if ($_SERVER["REQUEST_METHOD"]=="POST"){ 	
            foreach($questions as $question){
            	$answer=$this->input->post('answer_'.$question['q_id']);
				$prefilled['answer_'.$question['q_id']]=$answer;
				
	                                                                                           
		            if(empty($_POST['answer_'.$question['q_id']])){
						$is_valid=false;
						$arrayerror['answer']="Answer is required";
					}

					if($is_valid==true){
						if($question['q_answer']==$prefilled['answer_'.$question['q_id']]){
								$count++;
								$marks=$count;
						}
					}
				}
				if($is_valid==true){
							$id=$this->session->userdata('login_id');
							$data=array('quiz_id'=>$this->input->get('id'),
										'marks'=>$marks,
										'stu_id'=>$id,
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
		$data['logged_in_details']=$this->logged_in_details;
    	$data['logged_in']=$this->logged_in;
    	$data['title']="";

    	$this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('quiz/quizdisplay_view',$data);
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
