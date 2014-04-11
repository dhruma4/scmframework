<?php
class Classtest extends CI_Controller{
  public $logged_in=false;
  public $logged_in_details=array();
  
	function __construct()
	{
        parent::__construct();
        $this->load->model('classtest_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('session');
        $id=$this->session->userdata('login_id');
  
        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
        //$this->load->library('calendar');
        // echo $this->calendar->generate();
	}

	public function upload_test(){
    if($this->logged_in==true){
		
        $status="";
        $test=$this->input->post('test');
        $subject=$this->input->post('subject');
        $sem=$this->input->post('sem');

        $prefilled=array(); 
        $prefilled['test']=$test;
        $prefilled['subject']=$subject;
        $prefilled['sem']=$sem;

        $arrayerror=array();
        if ($_SERVER["REQUEST_METHOD"]=="POST"){

            $is_valid=true;

            if(empty($_POST["test"])){
                $is_valid=false;
                $arrayerror['test']="Test name is required";
            }
            if(empty($_POST["subject"])){
                $is_valid=false;
                $arrayerror['subject']="Subject is required";
            }
            if(empty($_POST["sem"])){
                $is_valid=false;
                $arrayerror['sem']="Semester is required";
            }
                $testid=$_POST["test"];
                $resulttest=array(); 
                $resulttest= $this->classtest_model->get_testexists($testid);

                if(count($resulttest)> 0){
                    $is_valid=false;
                    $arrayerror['test']="Test name entered already exists.Please enter correct name";
                }

            if($is_valid==true){
                $data=array('test_name'=>$prefilled['test'],
                            'test_subject'=>$prefilled['subject'],
                            'test_sem'=>$prefilled['sem']
                            );

                $this->classtest_model->insert_test($data);
                $status="success";
            }
        }

        $data['status']=$status;
        $data['data_entered']=$prefilled;
        $data['errors']=$arrayerror;
        $data['subjects']=$this->classtest_model->get_subject();
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
        $data['title']="Upload classtest here";

        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('classtest/classtest_view',$data);
        $this->load->view('template/footercss.php',$data);
    }
    else{       $msg= "You are not logged in.You must be logged in to access the function.";
                
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