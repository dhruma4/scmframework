<?php
class Authorization extends CI_Controller{
  
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('myemail');
		$this->load->library('session');
	}
 
	public function login(){
		$status="";
		$security=array();
		$sec_questions=array();
		$username=$this->input->post('username');
    	$password=$this->input->post('password');
    	$role=$this->input->post('role');
    	$sec_ques=$this->input->post('sec_ques');
    	$sec_ans=$this->input->post('sec_ans');

    	


    	$prefilled=array();
    	$prefilled['username']=$username;
    	$prefilled['password']=$password;
    	$prefilled['role']=$role;
    	$prefilled['sec_ques']=$sec_ques;
    	$prefilled['sec_ans']=$sec_ans;

    	$sess_username=$this->session->userdata('username');
    	$sess_role=$this->session->userdata('role');

    	$arrayerror=array();
    	


        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
         	//$data=array('username'=>$sess_username,
			//			'role'=>$sess_role);
         	//if (empty($sess_username) OR empty($sess_role)) {
			
				$is_valid=true;
				if(empty($role)){
					$is_valid=false;
					$arrayerror['role']="Role is required";
				}

				if(empty($username)){
					$is_valid=false;
					$arrayerror['username']="Username is required";
				}

				elseif(!preg_match("/^[a-zA-Z0-9]{8}$/",$username)){
					$is_valid=false;
					$arrayerror['username']="Login id/Username must contain 8 characters including digits with no special character";
				}

				if(empty($password)){
					$is_valid=false;
					$arrayerror['password']="Password is required";
				}

				elseif(!preg_match("/^[a-zA-Z0-9]{8}$/",$password)){
					$is_valid=false;
					$arrayerror['password']="Password must contain 8 characters including digits with no special character";
				}

					if($role=="admin" OR $role=="branch moderator" OR $role=="faculty"){
						$loginid=$_POST["username"];
		                $resultlogin=array();
		                $resultlogin= $this->auth_model->get_loginexists($loginid);
	              
						if(count($resultlogin)<= 0){
							$is_valid=false;
							$arrayerror['username']="Username entered doesnot exists.Please enter correct username";
							echo "";
						}
					}
					elseif($role=="student"){
						
						$loginid=$_POST["username"];
	                	$resultlogin=array();
	                	$resultlogin= $this->auth_model->get_student_loginexists($loginid);
	              
						if(count($resultlogin)<= 0){
							$is_valid=false;
							$arrayerror['username']="Username entered doesnot exists.Please enter correct username";
							echo "";
						}
					}

					if($is_valid==true){
						$pass=md5(trim($password));
						
						$array=array('username'=>$username,
									'password'=>$pass,
									'role'=>$role);
						$verify=$this->auth_model->verify_user($array);
						echo '<pre/>';
						print_r($verify);

						if(count($verify)>0){
							
							$security=$this->auth_model->security_check($sess_username);
						
							if(empty($security[0]['security_ques']) AND empty($security[0]['security_ans'])){
								$status="ask_security_ques";
								$sec_questions=$this->auth_model->get_sec_questions();
								if($_SERVER["REQUEST_METHOD"]=="POST"){

								if(isset($_POST['sec-ques-submit']) AND !empty($_POST['sec-ques-submit'])){
										$is_valid=true;
										if(empty($sec_ques)){
											$is_valid=false;
											$arrayerror['sec_ques']="Security question must be selected";
										}
										if(empty($sec_ans)){
											$is_valid=false;
											$arrayerror['sec_ans']="Security answer is required";
										}

										if($is_valid==true){
											echo "is valid true";
											$security_question=$sec_ques;
											$security_answer=$sec_ans;
											echo '<pre/>';
											print_r($sec_ques);
											echo " sec ques & ans   ";
											$this->auth_model->insert_sec_ques($sess_username,$security_question,$security_answer);
											$status="sec_ques_inserted";
										}
									}else{
											$arrayerror['details']="Details must be filled in order to proceed";
										}
								}
							}
							else{
									$status="verified";
							}
						}else{
										$arrayerror['password']="Username and/or password entered, doesnot match.Please try again";
							}
					}	
		}
									
		$this->session->unset_userdata();
		
		$data['questions']=$sec_questions;
		$data['data_entered']=$prefilled;
		$data['errors']=$arrayerror;
		$data['status']=$status;

		$this->load->view('authorization/login_view',$data);
	
	}

	public function forgot_password(){
		$status="";
		$active="";
		$username=$this->input->post('username');
		$role=$this->input->post('role');
		$answer=$this->input->post('answer');
		
		$prefilled=array();
		$d = array();
		$prefilled['username']=$username;
		$prefilled['role']=$role;
		$prefilled['answer']=$answer;


		$ques=array();
		$questions=array();
		$recipient=array();
		$verify=array();
		$arrayerror=array();
		$sess_username = $this->session->userdata('username');
		$sess_role = $this->session->userdata('role');

		if($_SERVER["REQUEST_METHOD"]=="POST") {
			$status="";
			
			$data=array('username'=>$sess_username,
						'role'=>$sess_role);
			// echo '<pre/>';print_r($username);
			// echo $username.':'.$role;die();

	        if (empty($sess_username) OR empty($sess_role)) {
				$is_valid=true;
				if(empty($role)){
					$is_valid=false;
					$arrayerror['role']="Role is required";
				}

				if(empty($username)){
					$is_valid=false;
					$arrayerror['username']="Username is required";
				} elseif(!preg_match("/^[a-zA-Z0-9]{8}$/",$username)) {
					$is_valid=false;
					$arrayerror['username']="Login id/Username must contain 8 characters including digits with no special character";
				}

				if($role=="admin" OR $role=="branch moderator" OR $role=="faculty"){
					
					$loginid=$username;
	                $resultlogin=array();
	                $resultlogin= $this->auth_model->get_loginexists($loginid);

	              	if(count($resultlogin)> 0){

	              		$recipient=$this->auth_model->get_recipient($loginid);
	              		
	              		$to=$recipient[0]['fac_email'];

					} else {
						$is_valid=false;
						$arrayerror['username']="Username entered doesnot exists.Please enter correct username";
						echo "";
					}
				} elseif($role=="student"){
						
					$loginid=$username;
                	$resultlogin=array();
                	$resultlogin= $this->auth_model->get_student_loginexists($loginid);
              		
              		if(count($resultlogin)> 0){

						$recipient=$this->auth_model->get_recipient_student($loginid);
						$to=$recipient[0]['stu_email'];
              		} else {

						$is_valid=false;
						$arrayerror['username']="Username entered doesnot exists.Please enter correct username";
						echo "";
					}
				}

				if($is_valid==true){
					
					$newdata=array(
						'username'=>$username,
						'role'=>$role
						);
					$this->session->set_userdata($newdata);
					echo "ques";
					$status="security_question";
					
					//$questions=$this->auth_model->fetch_ques($loginid);
					$d['ques'] = $questions;	
					/*echo '<pre/>';
					print_r($questions);*/
				}		
			} else {
				$active="else";
				$status="security_question";
				$d['ques']=$this->auth_model->fetch_ques_sess($data);
								
				$is_valid=true;
				if(isset($_POST['sec-submit']) AND !empty($_POST['sec-submit'])){
					if(empty($_POST["answer"])) {
						$is_valid=false;
						$arrayerror['answer']="Answer is required";
					}

					if($is_valid==true){
						$ans=(trim($_POST["answer"]));
						$array=array('security_ans'=>$ans,
									'username'=>$username,
									'role'=>$role);
						
						$verify=$this->auth_model->verify_ans($array);
						if($sess_role=="student"){
							$recipient=$this->auth_model->get_recipient_student($sess_username);
							echo '<pre/>';
							print_r($recipient);
							$to=$recipient[0]['stu_email'];
							echo "to";
	              		echo '<pre/>';
	              		print_r($to);
						}else
						{
							$recipient=$this->auth_model->get_recipient($sess_username);
							$to=$recipient[0]['fac_email'];
							echo "to";
	              		echo '<pre/>';
	              		print_r($to);
						}
						
						
						if(count($verify)>0){
							echo "verified user";
							$status="send_email";
							$subject="Reset Password";
							$time=time();
							
							$hash=$sess_username.$time;
							$d['hash']=$hash;
							$d['email']=$to;
							$message=$this->load->view('message/message_template',$d,true);

							$this->auth_model->insert_hash($hash,$time,$sess_username);

							send_custom_mail($to,$subject,$message);
							$this->session->unset_userdata('username');
							$this->session->unset_userdata('role');

							$this->auth_model->clear_hash($hash,$time,$sess_username);
						} else{
							$arrayerror['answer']="Answer entered, doesnot match.Please try again";
						}
					}
				}
	
			}
		}
		// $d['ques']=$ques;
		//$d['hash']=$hash;
		$d['active']=$active;
		$d['verify']=$verify;
		$d['status']=$status;
		$d['errors']=$arrayerror;
		$d['data_entered']=$prefilled;
		$d['questions']=$questions;

		$this->load->view('authorization/forgotpassword_view',$d);
	}

	public function reset_password(){
		$_hash=$this->input->get('hash');
		$_email=$this->input->get('email');
		$hash=array();
		
		$hash=$this->auth_model->fetch_hash($_hash);
		$role=$hash[0]['role'];
		if($role=="student"){
			$email=$this->auth_model->fetch_email_student($_email);
		}else{
			$email=$this->auth_model->fetch_email($_email);
		}	
		
		$arrayerror=array();
		$prefilled=array();
		if($_hash==$hash AND $_email==$email){
			$pass=$this->input->post('pass');
			$confirm_pass=$this->input->post('confirm_pass');

			
			
			$prefilled['pass']=$pass;
			$prefilled['confirm_pass']=$confirm_pass;

				if($_SERVER["REQUEST_METHOD"]=="POST") {
					$is_valid=true;

					if(empty($pass)){
						$is_valid=false;
						$arrayerror['pass']="Password is required";
					}
					elseif(!preg_match("/^[a-zA-Z0-9]{8}$/",$pass)){
						$is_valid=false;
						$arrayerror['pass']="Password must contain 8 characters including digits with no special character";
					}
					if(empty($confirm_pass)){
						$is_valid=false;
						$arrayerror['confirm_pass']="Password must be confirmed";
					}elseif($pass!=$confirm_pass){
						$is_valid=false;
						$arrayerror['confirm_pass']="Passwords do not match.Please try again.";
					}

					if($is_valid==true){
						$password=md5(trim($pass));
						$data=array('username'=>$password);
						$this->auth_model->reset_pass($data,$hash[0]['username']);
					}

				}
		}else{
			echo "The link you are looking for has expired.";
		}
		$data['data_entered']=$prefilled;
		$data['errors']=$arrayerror;

		$this->load->view('authorization/resetpassword_view',$data);

	}
}
?>
