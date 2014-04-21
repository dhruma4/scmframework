<?php
class Assignmentsubmit_model extends CI_Model{
	function __construct()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
	}

	public function insertassignment($data)
	{
		$this->db->insert('assignment_submit',$data);  
	} 
	public function fetch_assignments(){
		$this->db->select('assign_id,
							assign_name'
						);
		//$this->db->from('assignment_upload');
		//$this->db->join('assignment_ques_master as q');
		$this->db->where('assign_flag',"1");
		$query=$this->db->get('assignment_upload');

		return $query->result_array();
	}
	
	public function get_contents(){
		/*$crc1 = strtoupper(dechex(crc32(file_get_contents(BASEPATH.'../uploads/Hello2'))));
		$crc2 = strtoupper(dechex(crc32(file_get_contents(BASEPATH.'../uploads/Hello15'))));

		if ($crc1!=$crc2) {
		$query="original";
		} else {
		$query= "copied";
		}

		return $query->result_array(); */
		$hello2=BASEPATH.'../uploads/Hello2.docx';
		$fp = fopen($hello2, 'r');
		$content = fread($fp, filesize($hello2));
		$content= str_replace(' ','', $content);
		fclose($fp);

		$hello15=BASEPATH.'../uploads/Hello15.docx';
		$fp2 = fopen($hello15, 'r');
		$content2 = fread($fp2, filesize($hello15));
		$content2= str_replace(' ','', $content2);
		fclose($fp2);
		
		if ($content!=$content2) {
		$result="original";
		} else {
		$result= "copied";
		}
		return $result;

	}
	public function get_difference(){
			/*$cluster=array();
            $filename = BASEPATH.'../uploads/Hello2.docx';
            $word = new COM("word.application") or die ("Could not initialise MS Word object.");
            $word->Visible=0;

            if($word->Documents->Open(realpath($filename))){
               $content = (string) $word->ActiveDocument->Content; 

                $output = preg_replace('!\s+!', ' ', strtolower(trim($content)));
                $pieces=explode(" ",$output);
                //ini_set('memory_limit', '256M');
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
                       // echo memory_get_usage();
                    } 
                } 
                echo '<pre/>';
                print_r($cluster);
                $word->ActiveDocument->Close(false);
            }else{
                echo "The file doesnot contain anything";
            }
            $word->Quit();
            $word = null;
            unset($word); */

	}
	public function get_all_files($assign_name){
		$this->db->select('*');
		$this->db->where('assign_name',$assign_name);
		$query=$this->db->get("assignment_submit");

		return $query->result_array();
	}
	public function get_recipient($id){
		$this->db->select('l.login_id,
						l.username,
						s.stu_email,
						s.login_id');
		$this->db->from('login_master as l');
		$this->db->join('student_master as s',"l.username=s.login_id");
		$this->db->where('l.login_id',$id);
		$query=$this->db->get();

		return $query->result_array();

	}
	public function update_assignment($id,$assign_name,$data){
		$this->db->where('stu_id',$id);
		$this->db->where('assign_name',$assign_name);
		$this->db->update('assignment_submit',$data);
	}
	public function delete_assignment($id,$assign_name){
		$this->db->where('stu_id',$id);
		$this->db->where('assign_name',$assign_name);
		$this->db->delete('assignment_submit');

		echo $this->db->last_query(); die();
	}
}
?>
