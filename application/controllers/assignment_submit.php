<?php
class Assignment_submit extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();
  
	function __construct() 
	{
        parent::__construct(); 
        $this->load->model('assignmentsubmit_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $id=$this->session->userdata('login_id');
  
        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
    }

    public function submit_assignment(){
        
        if ($this->logged_in==true)
        {
        $status="";
        
        $assign_name=$this->input->post('assign_name');
        $assign_file=$this->input->post('assign_file');
    
        $arrayerror=array();
        $prefilled=array();
        
        $prefilled['assign_name']=$assign_name;
        $prefilled['assign_file']=$assign_file;
        
            if ($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $is_valid=true;
                
                        if(empty($_POST["assign_name"])) {
                            $is_valid=false;
                            $arrayerror['assign_name'] = "Assignment name is required";
                            }
            
                        if($_FILES['assign_file']['error']!= 0) {
                                $is_valid=false;
                                $arrayerror['assign_file'] = "Select an appropriate file";
                            }

                            $config['allowed_types']='doc|docx';
                            $config['upload_path']=BASEPATH.'../uploads/';
                            $config['max_size'] = '3000';

                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
                            if( ! $this->upload->do_upload('assign_file'))
                            {
                                $is_valid=false;
                                $arrayerror['assign_file']="Only files with doc and docx extension are allowed";
                            }
                            
                            if($is_valid==true){
                                    $data=array('assign_name'=>$prefilled['assign_name'],
                                              'assign_ans_path'=>$prefilled['assign_file']);

      
                                    $this->assignmentsubmit_model->insertassignment($data);
                                    $status="uploaded";
                            }


    	   }    $data['assignments']=$this->assignmentsubmit_model->fetch_assignments();
                
                $data['data_entered']=$prefilled;
                $data['errors']=$arrayerror;
                $data['status']=$status;
                $data['logged_in_details']=$this->logged_in_details;
                $data['logged_in']=$this->logged_in;
                $data['title']="Submit your assignment here";

                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('assignment_submit/assignmentsubmit_view',$data);
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