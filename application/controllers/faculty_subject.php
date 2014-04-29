<?php
class Faculty_subject extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();
  
	function __construct(){
        parent::__construct(); 
        $this->load->model('fac_subject_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('myemail');
        $this->load->library('session');
        $id=$this->session->userdata('login_id');
        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
    }
    public function fac_sub_assign(){
        if($this->logged_in==true){
            $status="";

            $arrayerror=array();
            $branch=$this->input->post('branch');
            $sem=$this->input->post('sem');
            $subject=$this->input->post('subject');
            $faculty=$this->input->post('faculty');
            
            $prefilled=array();
            $prefilled['branch']=$branch;
            $prefilled['sem']=$sem;
            $prefilled['subject']=$subject;
            $prefilled['faculty']=$faculty;

            if ($_SERVER["REQUEST_METHOD"]=="POST"){
                $is_valid=true;
                if(empty($_POST["branch"])){
                    $is_valid=false;
                    $arrayerror['branch']="Branch name is required";
                }
                if(empty($_POST["sem"])){
                    $is_valid=false;
                    $arrayerror['sem']="Semester is required";
                }
                if(empty($_POST["subject"])){
                    $is_valid=false;
                    $arrayerror['subject']="Subject is required";
                }
                if(empty($_POST["faculty"])){
                    $is_valid=false;
                    $arrayerror['faculty']="Faculty name must be selected";
                }
                if($is_valid==true){
                    $branch_names=$this->fac_subject_model->get_branch_name($branch);
                    $branch_name=$branch_names[0]['branch_name'];
                    $data=array('fac_id'=>$faculty,
                                'subject_id'=>$subject,
                                'semester'=>$sem,
                                'branch_id'=>$branch,
                                'branch_name'=>$branch_name
                            );
                    $this->fac_subject_model->insertfac_subject($data);
                    $status="mapped";
                }
            }
            
            $data['branches']=$this->fac_subject_model->get_branches();
            $data['faculties']=$this->fac_subject_model->get_faculties();
            $data['subjects']=$this->fac_subject_model->get_subjects();
            $data['data_entered']=$prefilled;
            $data['status']=$status;
            $data['title']="";
            $data['logged_in_details']=$this->logged_in_details;
            $data['logged_in']=$this->logged_in;

            $this->load->view('template/headercss.php',$data);
            $this->load->view('template/contentcss.php',$data);
            $this->load->view('fac_subject/facultysubject_mappingview',$data);
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