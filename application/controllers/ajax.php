<?php 
class Ajax extends CI_Controller{

	function Ajax(){
		parent::__construct();
		$this->load->model('data_model');
		
	}

	public function get_city()
	{
		$stateid = $_POST["stateid"];
		$city=$this->data_model->getcity_bystate($stateid);
		echo json_encode($city);

	}
 
 	public function get_subject()
 	{
 		$branchid=$_POST["branchid"];
 		$subject=$this->data_model->getsubject_bybranch($branchid);

 		echo json_encode($subject);
 	}

 	public function get_subject_bysem()
 	{
 		$semid=$_POST["semid"];
 		$subject=$this->data_model->getsubject_bysem($semid);

 		echo json_encode($subject);
 	}
	
	public function get_ques_number(){
		$assignid=$_POST["assignid"];
		$subject=$this->data_model->getques_number($assignid);

		echo json_encode($subject);
	}
	
	public function get_assign(){
		$assign=$_POST["assign"];
		$subject=$this->data_model->getassignid($assign);

		echo json_encode($subject);
	}


	/*<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    $.ajax({url:"demo_test.txt",success:function(result){
      $("#div1").html(result);
    }});
  });
});
</script>
</head>
<body>

<div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>
<button>Get External Content</button>

</body>
</html>*/

 	public function get_cities_by_state()
 	{
 		/*$(document).ready(function(){
 			$("state").change(function(){
 				$.ajax({url:"//localhost/scmframework", success:function(result){
 					$("#").html(result);
 					}});
 				});
 			});*/
 	}	




}
?>

