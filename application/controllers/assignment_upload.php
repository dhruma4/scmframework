<?php
class Assignment_upload extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('assignmentupload_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $id=$this->session->userdata('login_id');

        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
    }
 
	public function upload_assignment(){
    if ($this->logged_in==true){
        $status="";
        $assign_name=$this->input->post('assign_name');
        $faculty_name=$this->input->post('faculty_name');
        $sem=$this->input->post('sem');
        $subject=$this->input->post('subject');
        $assign_deadline=$this->input->post('assign_deadline');
       
        $arrayerror=array();
        $prefilled=array(); 
        $prefilled['assign_name']=$assign_name;
        $prefilled['faculty_name']=$faculty_name;
        $prefilled['sem']=$sem;
        $prefilled['subject']=$subject;
        $prefilled['assign_deadline']=$assign_deadline;
    
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $is_valid=true;
            if(empty($_POST["assign_name"])){
                $is_valid=false;
                $arrayerror['assign_name'] = "Assignment name is required";
            }
            if(empty($_POST["faculty_name"])){
                $is_valid=false;
                $arrayerror['faculty_name'] = "Faculty name is required";
            }
            if(empty($_POST["sem"])){
                $is_valid=false;
                $arrayerror['sem'] = "Semester must be selected";
            }
            if(empty($_POST["subject"])){
                $is_valid=false;
                $arrayerror['subject'] = "Subject name is required";
            }
            if(empty($_POST["assign_deadline"])){
                $is_valid=false;
                $arrayerror['assign_deadline'] = "Last date for assignment submission is required";
            }
            if($is_valid==true){

                $data=array('assign_name'=>$prefilled['assign_name'],
            	  		   'fac_id'=>$prefilled['faculty_name'],
            	  		   'sub_id'=>$prefilled['subject'],
            	  		   'assign_submit_date'=>$prefilled['assign_deadline'],
            	  		   'assign_flag'=>"1"
                        );
                $this->assignmentupload_model->insert_assignment($data);
                $status="uploaded";
            }
        }
		$data['errors']=$arrayerror;
        $data['status']=$status; 
        $data['data_entered']=$prefilled;
        $data['faculties']=$this->assignmentupload_model->get_faculty();
        $data['subjects']=$this->assignmentupload_model->get_subject();
        $data['title']="Upload your assignment here";
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
                
        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('assignment_upload/assignmentupload_view',$data);
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
}
?>