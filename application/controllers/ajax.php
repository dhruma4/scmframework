<?php 
class Ajax extends CI_Controller{
	public $logged_in=false;
    public $logged_in_details=array();

	function Ajax(){
		parent::__construct();
		$this->load->model('data_model');
		$this->load->model('assignmentupload_model');
		$this->load->library('session');
        $id=$this->session->userdata('login_id');
        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        } 
	} 

	public function get_city()
	{
		$stateid = $_POST["stateid"];
		$city=$this->data_model->getcity_bystate($stateid);
		echo json_encode($city);

	}
 
 	public function get_subject()
 	{
 		$branchid=$_POST["branchid"];
 		$subject=$this->data_model->getsubject_bybranch($branchid);

 		echo json_encode($subject);
 	}

 	public function get_subject_bysem()
 	{	$role=$this->session->userdata('role');

 		if($role=="faculty"){
 			$username=$this->session->userdata('username');
            $faculty=$this->assignmentupload_model->get_faculty($username);
            $faculty_logged=$faculty[0]['fac_id'];
       
	 		$semid=$_POST["semid"];
	 		$subject=$this->data_model->getsubject_bysem_forfaculty($semid,$faculty_logged);

	 		echo json_encode($subject);
 		} 
 		else{
	 		$semid=$_POST["semid"];
	 		$subject=$this->data_model->getsubject_bysem($semid);

	 		echo json_encode($subject);
 		}
 	}
	
	public function get_ques_number(){
		$assignid=$_POST["assignid"];
		$subject=$this->data_model->getques_number($assignid);

		echo json_encode($subject);
	}//subject-faculty-mapping
	public function getsub_bybranch_bysem(){
		$branchid=$_POST["branchid"];
		$semid=$_POST["semid"];
		$subject=$this->data_model->getsubject_bybranch_bysem($branchid,$semid);

		echo json_encode($subject);
	}
	
	public function get_assign(){
		$assign=$_POST["assign"];
		$subject=$this->data_model->getassignid($assign);

		echo json_encode($subject);
	}//assignment upload
	public function getfac_bysub(){
		$subjectid=$_POST["subjectid"];
		$semid=$_POST["semid"];
		$subject=$this->data_model->getfaculty_bysubject($subjectid,$semid);

		echo json_encode($subject);
	}
	//assignment view for students
	public function getassign_bysub(){

		$subjectid=$_POST["subjectid"];
		
		$subject=$this->data_model->getassignment_bysubject($subjectid);
		
		echo json_encode($subject);

	}
 	




}
?>

