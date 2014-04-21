<?php
class Faculty_manage extends CI_Controller{
  
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('grocery_CRUD');
    }
 
    public function list_of_assignments(){
        $this->grocery_crud->set_table('assignment_upload');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    public function _example_output($output=null){
        $this->load->view('our_template/faculty_template.php',$output);
    }

     public function list_of_classtests(){
        $this->grocery_crud->set_table('classtest_master');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    public function list_of_quizzes(){
        $this->grocery_crud->set_table('quiz_master');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }
    public function list_of_test_questions(){
        $this->grocery_crud->set_table('classtest_ques');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }
   public function list_of_assignment_questions(){
        $this->grocery_crud->set_table('assignment_ques_master');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    } 
    public function list_of_quiz_questions(){
        $this->grocery_crud->set_table('quiz_add_ques');
        $this->grocery_crud->unset_add();
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }
    
    

}