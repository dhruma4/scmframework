<?php
class Subject_add extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();

	function __construct()
	{
        parent::__construct();
        $this->load->model('subjectadd_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $id=$this->session->userdata('login_id');

        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
	}
 
	public function insertsubject()
	{
    if($this->logged_in==true){

    $status="";
    
    $subject=$this->input->post('subject');
    $sem=$this->input->post('sem');
    $branch=$this->input->post('branch');
    
    $prefilled=array();
    
    $prefilled['subject']=$subject;
    $prefilled['sem']=$sem;
    $prefilled['branch']=$branch;
    
	$arrayerror=array();

        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
         $is_valid=true;
         $arraydata=array();
        
            if(empty($_POST["subject"])) {
                $is_valid=false;
                $arrayerror['subject'] = "Subject is required";
             }
        
    		if(empty($_POST["sem"])) {
                $is_valid=false;
                $arrayerror['sem'] = "Semester is required";
             }
        
            if(empty($_POST["branch"])) {
                $is_valid=false;
                $arrayerror['branch'] = "Branch is required";
             }


                $subjectid=$_POST["subject"];
                $resultsubject=array();
                $resultsubject= $this->subjectadd_model->get_subjectexists($subjectid);
              
                  if(count($resultsubject)> 0)
                  {
                  $is_valid=false;
                  $arrayerror['subject']="Subject entered already exists.Please enter correct subject";//echo "Enrollment entered already exists.Please enter correct enrollment number";
                  echo "";
                  }
                    if($is_valid== true){
                            $data=array('sub_name'=>$prefilled["subject"],
                                        'semester'=>$prefilled["sem"],
                                        'branch_id'=>$prefilled["branch"]);
    
                         $this->subjectadd_model->insertsubject($data);
                         $status="added";
                         //echo "Subject added successfully";  
                    }
         


          
	}

    $data['status']=$status;
    $data['data_entered']=$prefilled;   
    $data['errors']=$arrayerror;
    $data['subjects']=$this->subjectadd_model->get_subject();
    $data['branches']=$this->subjectadd_model->get_branch();
    $data['title']="Add subject here";
    $data['logged_in_details']=$this->logged_in_details;
    $data['logged_in']=$this->logged_in;

    $this->load->view('template/headercss.php',$data);
    $this->load->view('template/contentcss.php',$data);
    $this->load->view('subject_add/subject_view',$data);
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