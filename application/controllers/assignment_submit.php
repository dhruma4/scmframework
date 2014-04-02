<?php
class Assignment_submit extends CI_Controller{
	function Assignment_submit()
	{
      parent::__construct();
      $this->load->model('assignmentsubmit_model');
      $this->load->helper('url');
	    $this->load->helper('form');

	}


    
	public function submit_assginment()
	{
    $status="";
    
    $assign_name=$this->input->post('assign_name');
    $assign_file=$this->input->post('assign_file');
    

    $prefilled=array();
    
    $prefilled['assign_name']=$assign_name;
    $prefilled['assign_file']=$assign_file;
    
    
		$arrayerror=array();


        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            echo "<pre>";
            print_r($_FILES); 

            $is_valid=true;
            $arraydata=array();
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
                        echo '<pre/>';
                        print_r($this->upload->data());
            
                        if($is_valid==true){
                              $data=array('assign_name'=>$prefilled['assign_name'],
                                          'assign_ans_path'=>$prefilled['assign_file']);

  
                            $this->assignmentsubmit_model->insertassignment($data);
                            $status="uploaded";
                        }


	   }

            $data['data_entered']=$prefilled;
            $data['errors']=$arrayerror;
            $data['status']=$status;
            $this->load->view('assignment_submit/assignmentsubmit_view',$data);
            
    }

   
}
?>


<?php
/*function index()
  {
    $this->load->view('userdemo/upload_form', array('error' => ' ' ));
  }

  function do_upload()
  {
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '100';
    $config['max_width']  = '1024';
    $config['max_height']  = '768';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
    {
      $error = array('error' => $this->upload->display_errors());

      $this->load->view('userdemo/upload_form', $error);
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());

      $this->load->view('userdemo/upload_success', $data);
    }
  }
  */
  ?>