<?php
	class Userinfo extends CI_Controller
	{
		function Userinfo()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->model('userinfo_model');
		}

		
		public function insertuser()
		{
			if (empty($_POST["name"]))
			{
				if (empty($_POST["pwd"]))
				
					 echo "Please enter your details";
            }
			
			if (!empty($_POST["name"]))
			{
				if (!empty($_POST["pwd"]))
				{
					$data=array('name'=>$_POST["name"],
				                 'pwd'=>$_POST["pwd"]);
			       
			       $this->userinfo_model->insertdata($data);
					echo "Thank you for registering";
				}
				 echo "Please enter the password";
			}
			
			
			
			 $this->load->view('userdemo/userregister');
		}
		
	}
?>
