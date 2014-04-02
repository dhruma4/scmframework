<?php
class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}

	public function index()
	{
		

	$data['news'] = $this->news_model->get_news();
	$data['title'] = 'News archive';

	// $this->load->view('template/header', $data);
	// $this->load->view('news/index', $data);
	// $this->load->view('template/footer');
	$this->template->set($data);
	$this->template->render();

	}

	public function view($param=FALSE)
	{
		$slug = isset($param)?$param:false;
		//$data-['news']=$this->news_model->get_news($slug);
		$data['news_item'] = $this->news_model->get_news($slug);
		
		if (empty($data['news_item']))
	{
		echo 'not found';
		show_404();
	}

	$data['title'] = "My news";


	$this->load->view('template/header', $data);
	$this->load->view('news/view', $data);
	$this->load->view('template/footer',$data);
	}
}