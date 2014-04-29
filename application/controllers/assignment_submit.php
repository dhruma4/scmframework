<?php
class Assignment_submit extends CI_Controller{
    public $logged_in=false;
    public $logged_in_details=array();
  
	function __construct(){
        parent::__construct(); 
        $this->load->model('assignmentsubmit_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('myemail');
        $this->load->library('session');
        $id=$this->session->userdata('login_id');
        if(isset($id) AND !empty($id)){
            $this->logged_in=true;
            $this->logged_in_details=$this->session->all_userdata();
        }
    }

    public function submit_assignment(){
    if ($this->logged_in==true){
        $status="";
        $copy_found=false;

        
        $assign_name=$this->input->post('assign_name');
        $assign_file=$this->input->post('assign_file');
    
        $arrayerror=array();
        $prefilled=array();
        
        $prefilled['assign_name']=$assign_name;
        $prefilled['assign_file']=$assign_file;
           
            if ($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $is_valid=true;
                
                        if(empty($_POST["assign_name"])) {
                            $is_valid=false;
                            $arrayerror['assign_name'] = "Assignment name is required";
                        }
            
                        if($_FILES['assign_file']['error']!= 0 AND $_FILES['assign_file']['size']== 0) {
                                $is_valid=false;
                                $arrayerror['assign_file'] = "Select an appropriate file";
                        }

                            $config['allowed_types']='doc|docx';
                            $config['upload_path']=BASEPATH.'../uploads/';
                            $config['max_size'] = '3000';
                            $config['remove_spaces']=FALSE;

                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
                            
                            if($is_valid==true){
                                   
                                if( ! $this->upload->do_upload('assign_file'))
                                {
                                    $is_valid=false;
                                    $arrayerror['assign_file']="Only files with doc and docx extension are allowed";
                                }
                                if($is_valid==true){
                                    $id=$this->session->userdata('login_id');
                                    
                                    $name= $_FILES['assign_file']['name'];
                                   
                                    //file compare code below ---------------------------
                                    $files=array();
                                    $all_files=$this->assignmentsubmit_model->get_all_files($assign_name);
                                    $total_files=count($all_files);
                                    //echo $total_files;
                                    for ($k=0;$k<$total_files;$k++){
                                        
                                        array_push($files,$all_files[$k]['assign_ans_path']);
                                    }  
                                                for($a=0;$a<$total_files;$a++){                        
                                                    $cluster=array();
                                                    $filename = BASEPATH.'../uploads/'.$files[$a];
                                                    
                                                    $word = new COM("word.application") or die ("Could not initialise MS Word object.");
                                                    $word->Visible=0;
                                                    if($word->Documents->Open(realpath($filename))){

                                                        $content = (string) $word->ActiveDocument->Content; 

                                                        $output = preg_replace('!\s+!', ' ', strtolower(trim($content)));
                                                        $pieces=explode(" ",$output);
                                                        
                                                        $length=count($pieces);
                                                       
                                                        for($i=0;$i<$length;){
                                                            if($i<$length AND $i+1<$length AND $i+2<$length){
                                                                array_push($cluster,$pieces[$i]." ".$pieces[$i+1]." ".$pieces[$i+2]);
                                                                $i=$i+3;
                                                            }
                                                            elseif($i<$length AND $i+1<$length){
                                                                array_push($cluster,$pieces[$i]." ".$pieces[$i+1]);
                                                                $i=$i+2;
                                                            }
                                                            else{
                                                                array_push($cluster,$pieces[$i]);
                                                                $i=$i+1;
                                                            } 
                                                        } 
                                                        
                                                        $word->ActiveDocument->Close(false);
                                                    }else{
                                                        echo "The file doesnot contain anything";
                                                    }
                                                    $word->Quit();
                                                    $word = null;
                                                    unset($word);

                                                    $cluster2=array();
                                                    $filename2 = BASEPATH.'../uploads/'.$name;
                                                    echo $filename2;
                                                    $word1 = new COM("word.application") or die ("Could not initialise MS Word object.");
                                                    $word1->Visible=0;

                                                    if($word1->Documents->Open(realpath($filename2))){
                                                       $content2 = (string) $word1->ActiveDocument->Content; 
                                                        
                                                        $output2 = preg_replace('!\s+!', ' ', strtolower(trim($content2)));
                                                        
                                                        $pieces2=explode(" ",$output2);
                                                        
                                                        $length2=count($pieces2);
                                                       
                                                        for($i=0;$i<$length2;){
                                                            if($i<$length2 AND $i+1<$length2 AND $i+2<$length2){
                                                                array_push($cluster2,$pieces2[$i]." ".$pieces2[$i+1]." ".$pieces2[$i+2]);
                                                                $i=$i+3;
                                                            }
                                                            elseif($i<$length2 AND $i+1<$length2){
                                                                array_push($cluster2,$pieces2[$i]." ".$pieces2[$i+1]);
                                                                $i=$i+2;
                                                            }
                                                            else{
                                                                array_push($cluster2,$pieces2[$i]);
                                                                $i=$i+1;
                                                               
                                                            } 
                                                        } 
                                                       
                                                        $word1->ActiveDocument->Close(false);
                                                    }else{
                                                        echo "The file doesnot contain anything";
                                                    }
                                                    $word1->Quit();
                                                    $word1 = null;
                                                    unset($word1);

                                                    $common=array_intersect($cluster, $cluster2);
                                                    
                                                    $length_of_cluster=count($cluster);
                                                    $length_of_cluster2=count($cluster2);

                                                  
                                                    if(count($common)>($length_of_cluster*0.7)){
                                                            $assign_status="copy"; 
                                                            $copy_found=true;
                                                    }   
                                                    else{
                                                        $assign_status="not copied"; 
                                                        $copy_found=false;  
                                                    }  
                                                }
                                                if($copy_found==true){
                                                                    
                                                                    $called="assignment_status";
                                                                    
                                                                    $id=$this->session->userdata('login_id');
                                                                   
                                                                    $recipient=$this->assignmentsubmit_model->get_recipient($id);
                                                                    
                                                                    $data['data_entered']=$prefilled;

                                                                    $data['called']=$called;
                                                                    $data['copy_found']=$copy_found;
                                                                    $subject="Status of Assignment";
                                                                    $to=$recipient[0]['stu_email'];

                                                                    $data['email']=$to;
                                                                    $message=$this->load->view('message/message_template',$data,true);
                                                                    send_custom_mail($to,$subject,$message);
                                                                    $status="send_email";
                                                }
                                                else{
                                                    $called="assignment_status";
                                                    $id=$this->session->userdata('login_id');
                                                    $recipient=$this->assignmentsubmit_model->get_recipient($id);
                                                    $data['data_entered']=$prefilled;
                                                    $data['called']=$called;
                                                    $data['copy_found']=$copy_found;
                                                    $subject="Status of Assignment";
                                                    $to=$recipient[0]['stu_email'];
                                                    $data['email']=$to;
                                                    $message=$this->load->view('message/message_template',$data,true);
                                                    send_custom_mail($to,$subject,$message);
                                                    $status="send_email";
                                                    $data=array('assign_name'=>$assign_name,
                                                                'assign_ans_path'=>$name,
                                                                'stu_id'=>$id
                                                            );
                                    
                                                    $this->assignmentsubmit_model->insertassignment($data);
                                                            
                                                    $data=array('assignment_status'=>"accepted");
                                                    $this->assignmentsubmit_model->update_assignment($id,$assign_name,$data);
                                                } //code ends here------------------------------
                                }
                        }
    	   }    $data['assignments']=$this->assignmentsubmit_model->fetch_assignments();
                
                $data['data_entered']=$prefilled;
                $data['errors']=$arrayerror;
                $data['status']=$status;
                $data['logged_in_details']=$this->logged_in_details;
                $data['logged_in']=$this->logged_in;
                $data['title']="Submit your assignment here";

                $this->load->view('template/headercss.php',$data);
                $this->load->view('template/contentcss.php',$data);
                $this->load->view('assignment_submit/assignmentsubmit_view',$data);
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