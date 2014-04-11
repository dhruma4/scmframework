 <?php
class Assignmentques extends CI_Controller{
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

	public function select_assignment()
  { 
        if($this->logged_in==true)
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
 
        if(!empty($assign_id)){
            $assignment=$this->assignmentques_model->get_assign($assign_id);
            if(count($assignment)<=0){
                                    $is_valid=false;
                                    $arrayerror['assign']="No such assignment exists";
            } else{
                            $assignment=$this->assignmentques_model->get_assign($assign_id);
                            $data['assignment_fetched']=$assignment;
                            $questions=$this->assignmentques_model->get_questions($assign_id);

                            if(count($questions)<=0){
                                                    $arrayerror['question']="No questions are uploaded";
                            }
                            
                            
                    }  
                        if($is_valid==true){
                                            $status="ques_upload";
                                            $ques=$this->input->post('ques');
                                            $prefilled['ques']=$ques;
                                            $questions=$this->assignmentques_model->get_questions($assign_id);

                                            if(count($questions)<=0){
                                                                    $arrayerror['question']="No questions are uploaded";
                                            }

                                            if ($_SERVER["REQUEST_METHOD"]=="POST"){
                                                if(empty($_POST["ques"])){
                                                    $is_valid=false;
                                                    $arrayerror['ques']="Question is required";
                                                }
                                                if($is_valid==true){
                                                    $data=array('assign_id'=>$this->input->get('id'),
                                                                'assign_ques_text'=>$prefilled['ques']
                                                    );

                                                    $this->assignmentques_model->insertques($data);
                                                    $msg="Your Question has been uploaded";
                                                }
                                            }
                        }
        }  
            $data['msg']=$msg;
            $data['questions']=$questions;
            $data['assignment_fetched']=$assignment;
            $data['data_entered']=$prefilled;
            $data['assignments']=$this->assignmentques_model->get_assignment();
            $data['errors']=$arrayerror;
            $data['status']=$status;
            $data['title']="Assignment upload";
            $data['logged_in_details']=$this->logged_in_details;
            $data['logged_in']=$this->logged_in;

                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('assignment_upload/assignment_quesview',$data);
                $this->load->view('template/footercss.php',$data);
            
        }   else{
                $msg= "You are not logged in.You must be logged in to access the function.";
                
                $data['title']=$msg;
                $data['logged_in_details']=$this->logged_in_details;
                $data['logged_in']=$this->logged_in;
                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('template/footercss.php',$data);
             }
    }

	/*public function upload_ques(){
    if($this->logged_in==true){

        $status="ques_upload";
        $assign=$this->input->post('assign');
    
        $prefilled=array();
        $prefilled['assign']=$assign;
        
    	$arrayerror=array();
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $is_valid=true;
            if(empty($_POST["assign"])){
                $is_valid=false;
                $arrayerror['assign']="Assignment must be selected";
            }

            if(empty($_POST["ques"])){
                $is_valid=false;
                $arrayerror['ques']="Question is required";
            }

            if($is_valid==true){
                $data=array('assign_id'=>$prefilled['assign'],
                            'assign_ques_text'=>$prefilled['ques']
                            );
                $this->assignmentques_model->insertques($data);
                $status="uploaded";
            }
        }
        $data['status']=$status;
        $data['data_entered']=$prefilled;
        $data['errors']=$arrayerror;
        $data['assignments']=$this->assignmentques_model->get_assignment();
        $data['title']="Upload questions here";
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
        $data['title']="Upload questions";
                
        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('assignment_upload/assignment_quesview',$data);
        $this->load->view('template/footercss.php',$data);
        
        }   else{
                $msg= "You are not logged in.You must be logged in to access the function.";
                
                $data['title']=$msg;
                $data['logged_in_details']=$this->logged_in_details;
                $data['logged_in']=$this->logged_in;
                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('template/footercss.php',$data);
               
            }
    } */

    

}
?>