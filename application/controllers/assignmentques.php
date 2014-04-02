 <?php
class Assignmentques extends CI_Controller{
  

	function __construct()
	{
      parent::__construct();
      $this->load->model('assignmentques_model');
      $this->load->helper('url');
	    $this->load->helper('form');
	}

	public function select_assignment()
  { 
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
                    

            if(empty($assign_id)){
                                    $is_valid=false;
                                    $arrayerror['assign']="Assignment must be selected";
                                  }

            else{
                    $assignment=$this->assignmentques_model->get_assign($assign_id);

                        if(count($assignment)<=0){
                                                    $is_valid=false;
                                                    $arrayerror['assign']="No such assignment exists";
                                                  }
 
                }

                      
                  if($is_valid==true){
                                        $status="ques_upload";
                                        

                                        $ques=$this->input->post('ques');
                                        $prefilled['ques']=$ques;
                                        
                                        
                                        

                                          if ($_SERVER["REQUEST_METHOD"]=="POST"){
                                                                                
                                                                                    if(empty($_POST["ques"])){
                                                                                                              $is_valid=false;
                                                                                                              $arrayerror['ques']="Question is required";
                                                                                                              }

                                                                                 
                                                                                    if($is_valid==true){
                                                                                                        $data=array('assign_id'=>$this->input->get('id'),
                                                                                                                    'assign_ques_text'=>$prefilled['ques']);


                                                                                                        $this->assignmentques_model->insertques($data);
                                                                                                        $msg="Your Question has been uploaded";

                                                                                                        }

                                                                                    
                                                                                  }
                                            $questions=$this->assignmentques_model->get_questions($assign_id);

                                                  if(count($questions)<=0){
                                                                            $arrayerror['question']="No questions are uploaded";
                                                                          }
                                      }
      
          $data['msg']=$msg;
          $data['questions']=$questions;
          $data['assignment_fetched']=$assignment;
          $data['data_entered']=$prefilled;
          $data['assignments']=$this->assignmentques_model->get_assignment();
          $data['errors']=$arrayerror;
          $data['status']=$status;
          $this->load->view('assignment_upload/assignment_quesview',$data);

  
}

 

 

	public function upload_ques(){

    
    
    $status="ques_upload";
    $assign=$this->input->post('assign');
    
    
    
    $prefilled=array();
    $prefilled['assign']=$assign;
    
    

    	$arrayerror=array();
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
           
           
              $is_valid=true;
              if(empty($_POST["assign"]))
              {
                $is_valid=false;
                $arrayerror['assign']="Assignment must be selected";
              }

              if(empty($_POST["ques"]))
              {
                $is_valid=false;
                $arrayerror['ques']="Question is required";
              }

              	
				    if($is_valid==true){
                    $data=array('assign_id'=>$prefilled['assign'],
                      'assign_ques_text'=>$prefilled['ques']);
                      

                    	$this->assignmentques_model->insertques($data);
                    	$status="uploaded";
                  	}

        }
        $data['status']=$status;
        $data['data_entered']=$prefilled;
        $data['errors']=$arrayerror;
        $data['assignments']=$this->assignmentques_model->get_assignment();
        $this->load->view('assignment_upload/assignment_quesview',$data);
    }

    public function upload_newques(){
      $status="";
      $data['status']=$status;
      $this->load->view('assignment_upload/assignment_newquesview',$data);


    }

}
?>