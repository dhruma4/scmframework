 <?php
class Quiz extends CI_Controller{
  
	function __construct()
	{
      parent::__construct();
      $this->load->model('quiz_model');
      $this->load->helper('url');
	    $this->load->helper('form');
	 }

	 public function upload_quiz(){
		
	   $status="";
      $name=$this->input->post('name');
      $subject=$this->input->post('subject');
      $sem=$this->input->post('sem');
    
      $prefilled=array();
      $prefilled['name']=$name;
      $prefilled['subject']=$subject;
      $prefilled['sem']=$sem;

        $arrayerror=array();
        if ($_SERVER["REQUEST_METHOD"]=="POST")
         {
            
              $is_valid=true;
              
              if(empty($_POST["name"]))
              {
                $is_valid=false;
                $arrayerror['name']="Quiz name is required";
              }
                
              
              if(empty($_POST["subject"])) 
              {
                $is_valid=false;
                $arrayerror['subject']="Subject is required";
              }
               
                           
              if(empty($_POST["sem"]))
              {
                $is_valid=false;
                $arrayerror['sem']="Semester is required";
              }

                    $nameid=$_POST["name"];
                    $resultname=array();
                    $resultname= $this->quiz_model->get_nameexists($nameid);
              
                    if(count($resultname)> 0)
                    {
                        $is_valid=false;
                        $arrayerror['name']="Quiz name entered already exists.Please enter correct name";
                    }

                    if($is_valid==true)
                    {
                        $data=array('quiz_name'=>$prefilled['name'],
                                    'quiz_subject'=>$prefilled['subject'],
                                    'quiz_sem'=>$prefilled['sem']);
                     
                        $this->quiz_model->insert_quiz($data);
                        $status="success";
                    }

	         }

        $data['status']=$status;
        $data['data_entered']=$prefilled;
        $data['errors']=$arrayerror;
        $data['subjects']=$this->quiz_model->get_subject();
        
        
        $this->load->view('quiz/quiz_view',$data);
        
  }

}
?>