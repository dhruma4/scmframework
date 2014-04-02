<?php
class Assignment_upload extends CI_Controller{
	
	function __construct()
	{
	 	parent::__construct();
	  $this->load->model('assignmentupload_model');
      $this->load->helper('url');
	  $this->load->helper('form');
	}

	public function upload_assignment()
	{

        $status="";

        $assign_name=$this->input->post('assign_name');
        $faculty_name=$this->input->post('faculty_name');
        $sem=$this->input->post('sem');
        $subject=$this->input->post('subject');
        $assign_deadline=$this->input->post('assign_deadline');
       
     
        $prefilled=array();
        
        $prefilled['assign_name']=$assign_name;
        $prefilled['faculty_name']=$faculty_name;
        $prefilled['sem']=$sem;
        $prefilled['subject']=$subject;
        $prefilled['assign_deadline']=$assign_deadline;
    
    
        $arrayerrorfac=array();
        
    	$arrayerror=array();
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $is_valid=true;
            $arraydata=array();
            if(empty($_POST["assign_name"])) {
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

            if(empty($_POST["subject"])) {
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
            	  		'assign_flag'=>"y");

                $this->assignmentupload_model->insert_assignment($data);
                $status="uploaded";
            }
        }
		$data['errors']=$arrayerror;
        $data['status']=$status; 
        $data['data_entered']=$prefilled;

        //echo '<pre/>';
        //print_r($this->assignmentupload_model);
        $data['faculties']=$this->assignmentupload_model->get_faculty();


        $data['subjects']=$this->assignmentupload_model->get_subject();

        $this->load->view('assignment_upload/assignmentupload_view',$data);
    }
}
?>