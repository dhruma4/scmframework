<?php
class Pages extends CI_Controller
{
	public function view($page='about')
	{
		//echo 'hello';
		if(!file_exists('application/views/pages/'.$page.'.php'))
		{
			echo 'not found';
			show_404();
		}
		$data['title']=ucfirst($page);
		$this->load->view('template/header.php',$data);
		$this->load->view('pages/'.$page.'.php',$data);
		$this->load->view('template/footer.php',$data);
	}
}
?>