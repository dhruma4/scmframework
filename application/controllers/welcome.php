<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$msg= "Welcome to Student Component Manager";
                $page='homepage';
                $data['page']=$page;
                $data['title']=$msg;
                $data['logged_in']=false;
                
                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('welcome_message',$data);
                $this->load->view('template/footercss.php',$data);
            
				
	}
	public function about(){
				
				$data['title']="";
				$data['logged_in']=false;
                //$data['logged_in_details']=$this->logged_in_details;
                //$data['logged_in']=$this->logged_in;

                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('scm_common/about_view',$data);
                $this->load->view('template/footercss.php',$data);
            
		
	}
	public function contact(){
				$data['title']="";
				$data['logged_in']=false;
               // $data['logged_in_details']=$this->logged_in_details;
                //$data['logged_in']=$this->logged_in;

                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('scm_common/contact_view',$data);
                $this->load->view('template/footercss.php',$data);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */