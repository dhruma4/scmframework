<?php
class Manage extends CI_Controller{
  
	function __construct()
	{
      parent::__construct();
     
      $this->load->helper('url');
	    $this->load->helper('form');
      $this->load->library('grocery_CRUD');
	}
 
	public function list_of_student()
    {
        $this->grocery_crud->set_table('student_master');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);
    }

  public function _example_output($output=null)
    {
        $this->load->view('our_template/template.php',$output);
    }

  public function list_of_faculty()
  {
        $this->grocery_crud->set_table('faculty_master');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);
  }

  public function list_of_assignment()
  {
        $this->grocery_crud->set_table('assignment_upload');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();

 
        $this->_example_output($output);
  }

  public function list_of_quiz()
  {
        $this->grocery_crud->set_table('quiz_master');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);
  }

  public function list_of_test()
  {
        $this->grocery_crud->set_table('classtest_master');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);
  }

  public function list_of_subject()
  {
        $this->grocery_crud->set_table('subject_master');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);
  }

  public function quiz_result()
  {
        $this->grocery_crud->set_table('quiz_result');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);
  }

  public function test_result()
  {
        $this->grocery_crud->set_table('classtest_result');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();
 
        $this->_example_output($output);
  }


}
?>