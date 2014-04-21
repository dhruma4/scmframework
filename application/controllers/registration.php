<?php
class Registration extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();
  
	function Registration()
	{
        parent::__construct();
        $this->load->model('registration_model');
        $this->load->helper('url'); 
        $this->load->helper('form');
        $this->load->library('session');
        $id=$this->session->userdata('login_id');

        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
    }
    public function insertstudent(){   
    
        $status="";
        $enroll=$this->input->post('enroll');
        $name=$this->input->post('name');
        $sem=$this->input->post('sem'); 
        $branch=$this->input->post('branch');
        $dob=$this->input->post('dob');
        $address=$this->input->post('address');
        $city=$this->input->post('city');
        $state=$this->input->post('state');
        $contact=$this->input->post('contact'); 
        $email=$this->input->post('email');
        $login_id=$this->input->post('login_id');

        $prefilled=array();
        $prefilled['enroll']=$enroll;
        $prefilled['name']=$name;
        $prefilled['sem']=$sem;
        $prefilled['branch']=$branch;
        $prefilled['dob']=$dob;
        $prefilled['address']=$address;
        $prefilled['city']=$city;
        $prefilled['state']=$state;
        $prefilled['contact']=$contact;
        $prefilled['email']=$email;
        $prefilled['login_id']=$login_id;

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        $num='/^[0-9]{4}+[a-zA-Z]{4}+[0-9]{5}$/'; 
        $name='/^[a-zA-Z ]*+[a-zA-Z]*$/'; 
            $arrayerror=array();
            if ($_SERVER["REQUEST_METHOD"]=="POST"){
                $is_valid=true;
                if(empty($_POST["enroll"])){
                    $is_valid=false;
                    $arrayerror['enroll']="Enrollment number is required";
                }
                elseif(!preg_match($num, $_POST["enroll"])){
                    $is_valid=false;
                    $arrayerror['enroll']="Enter enrollment number properly";
                }            

                if(empty($_POST["name"])){
                    $is_valid=false;
                    $arrayerror['name']="Name is required";
                }
                elseif(count($_POST["name"])>25){
                    $is_valid=false;
                    $arrayerror['name']="Name must not be larger than 25 characters";
                }
                elseif(!preg_match($name, $_POST["name"])){
                    $is_valid=false;
                    $arrayerror['name']="Enter name properly without any special characters";      
                } 
                if(empty($_POST["sem"])){
                    $is_valid=false;
                    $arrayerror['sem']="Semester is required";
                }
                if(empty($_POST["branch"])){
                    $is_valid=false;
                    $arrayerror['branch']="Branch is required";
                }
                if(empty($_POST["dob"])){
                    $is_valid=false;
                    $arrayerror['dob']="Date of birth is required";
                }
                if(empty($_POST["address"])){
                    $is_valid=false;
                    $arrayerror['address']="Address is required";
                }  
                if(empty($_POST["city"])){
                    $is_valid=false;
                    $arrayerror['city']="City is required";
                }
                if(empty($_POST["state"])){
                    $is_valid=false;
                    $arrayerror['state']="State is required";
                }
                if(empty($_POST["contact"])){
                    $is_valid=false;
                    $arrayerror['contact']="Contact number is required";
                }
                elseif(!preg_match("/^[0-9]{10}$/", $_POST["contact"])){
                    $is_valid=false;
                    $arrayerror['contact']="Enter valid contact number of 10 digits without any special characters";
                }
                if(empty($_POST["email"])){
                    $is_valid=false;
                    $arrayerror['email']="Email is required";
                }
                elseif(!preg_match($regex, $_POST["email"])){
                    $is_valid=false;
                    $arrayerror['email']="Email must be a valid email address";
                }
                if(empty($_POST["login_id"])){
                    $is_valid=false;
                    $arrayerror['login_id']="Login id/Username is required";
                }
                elseif(!preg_match("/^[0-9A-Za-z]{8}$/", $_POST["login_id"])){
                    $is_valid=false;
                    $arrayerror['login_id']="Login id/Username must contain 8 characters including digits with no special character";
                }                 
                    $enrollid=$_POST["enroll"];
                    $resultenroll=array();
                    $resultenroll= $this->registration_model->get_enrollexists($enrollid);
                  
                    if(count($resultenroll)> 0){
                        $is_valid=false;
                        $arrayerror['enroll']="Enrollment entered already exists.Please enter correct enrollment number";
                    }

                    $loginid=$_POST["login_id"];
                    $resultlogin=$this->registration_model->get_usernameexists($loginid);
                    
                    if(count($resultlogin) >0){
                        $is_valid=false;
                        $arrayerror['login_id']="Username already exists. Please choose another username";
                    }
                    
                    
                    if($is_valid==true){
                                    $data=array('stu_enroll'=>$prefilled['enroll'],
                                                'stu_name'=>$prefilled['name'],
                                                'stu_sem'=>$prefilled['sem'],
                                                'stu_branch'=>$prefilled['branch'],
                                                'stu_dob'=>$prefilled['dob'],
                                                'stu_add'=>$prefilled['address'],
                                                'stu_city'=>$prefilled['city'],
                                                'stu_state'=>$prefilled['state'],
                                                'stu_contact'=>$prefilled['contact'],
                                                'stu_email'=>$prefilled['email'],
                                                'login_id'=>$prefilled['login_id']
                                            );

                                    $this->registration_model->insertstudent($data);
                                    $this->registration_model->set_username($_POST["login_id"]);
                                    $status="success";
                    }
            }
        $data['status']=$status;
        $data['data_entered']=$prefilled;
        $data['errors']=$arrayerror;
        $data['states']=$this->registration_model->get_state();
        $data['cities']=$this->registration_model->get_city();
        $data['branches']=$this->registration_model->get_branch();
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
        $data['title']="Welcome for registration";

        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('registration/registration_view',$data);
        $this->load->view('template/footercss.php',$data);
        
    } 
    public function insertfaculty(){
    if($this->logged_in==true){

        $status="";
        
        $name=$this->input->post('name');
        $branch=$this->input->post('branch');
        $designation=$this->input->post('designation');
        $address=$this->input->post('address');
        $city=$this->input->post('city');
        $state=$this->input->post('state');
        $contact=$this->input->post('contact');
        $email=$this->input->post('email');
        $login_id=$this->input->post('login_id');

        $prefilled=array();
        
        $prefilled['name']=$name;
        $prefilled['branch']=$branch;
        $prefilled['designation']=$designation;
        $prefilled['address']=$address;
        $prefilled['city']=$city;
        $prefilled['state']=$state;
        $prefilled['contact']=$contact;
        $prefilled['email']=$email;
        $prefilled['login_id']=$login_id;
        $arrayerrorfac=array();

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        $name='/^[a-zA-Z ]*+[a-zA-Z]*$/'; 
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $isvalid=true;
            $arraydatafac=array();
            if(empty($_POST["name"])){
                    $isvalid=false;
                    $arrayerrorfac['name'] = "Name is required";
            }
            elseif(count($_POST["name"])>25){
                      $isvalid=false;
                      $arraydatafac['name']="Name must not be more than 25 characters.";
            }
            elseif(!preg_match($name,$_POST['name'])){
                      $isvalid=false;
                      $arrayerrorfac['name']="Enter valid name without any special characters and digits.";
            }
            if(empty($_POST["branch"])){
                    $isvalid=false;
                    $arrayerrorfac['branch'] = "Branch is required";
            }
            if(empty($_POST["designation"])){
                    $isvalid=false;
                    $arrayerrorfac['designation'] = "Designation is required";
            }
            if(empty($_POST["address"])){
                    $isvalid=false;
                    $arrayerrorfac['address'] = "Address is required";
            }
            if(empty($_POST["city"])){
                    $isvalid=false;
                    $arrayerrorfac['city'] = "City is required";
            }
            if(empty($_POST["state"])){
                    $isvalid=false;
                    $arrayerrorfac['state'] = "State is required";
            }
            if(empty($_POST["contact"])){
                $isvalid=false;
                $arrayerrorfac['contact'] = "Contact number is required";
            }
            elseif(!preg_match("/^[0-9]{10}$/",$_POST["contact"])){
                    $isvalid=false;
                    $arraydatafac['contact']="Enter valid contact number of 10 digits without any special characters";
            }
            if(empty($_POST["email"])){
                $is_valid=false;
                $arrayerrorfac['email']="Email is required";
            }
            elseif(!preg_match($regex, $_POST["email"])){
                    $is_valid=false;
                    $arrayerrorfac['email']="Email must be a valid email address";
            }
            if(empty($_POST["login_id"])){
                $is_valid=false;
                $arrayerrorfac['login_id']="Login id/Username is required";
            }
            elseif(!preg_match("/^[0-9A-Za-z]{8}$/", $_POST["login_id"])){
                $is_valid=false;
                $arrayerrorfac['login_id']="Login id/Username must contain 8 characters including digits with no special character";
            }

                $loginid=$_POST["login_id"];
                $resultlogin=$this->registration_model->get_usernameexists($loginid);
                
                if(count($resultlogin) >0)
                {
                $isvalid=false;
                $arrayerrorfac['login_id']="Username already exists. Please choose another username";
                }
                    
            if($isvalid==true){
                    $data=array('fac_name'=>$prefilled['name'],
                                'branch_id'=>$prefilled['branch'],
                                'fac_designation'=>$prefilled['designation'],
                                'fac_add'=>$prefilled['address'],
                                'fac_city'=>$prefilled['city'],
                                'fac_state'=>$prefilled['state'],
                                'fac_contact'=>$prefilled['contact'],
                                'fac_email'=>$prefilled['email'],
                                'login_id'=>$prefilled['login_id']
                            );

                    $this->registration_model->insertfaculty($data);
                    $this->registration_model->set_username($_POST["login_id"]);
                    $status="success";
            }
        }
        $data['status']=$status;
        $data['data_entered']=$prefilled;
        $data['errors']=$arrayerrorfac;
        $data['states']=$this->registration_model->get_state();
        $data['cities']=$this->registration_model->get_city();
        $data['branches']=$this->registration_model->get_branch();
        $data['designations']=$this->registration_model->get_designation();
        $data['logged_in_details']=$this->logged_in_details;
        $data['logged_in']=$this->logged_in;
        $data['title']="Welcome for registration";

        $this->load->view('template/headercss.php',$data);
        $this->load->view('template/contentcss.php',$data);
        $this->load->view('registration/registrationfac_view',$data);
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
