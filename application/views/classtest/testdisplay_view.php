<html>
<head>
<style>
.error {color:red;}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
 
</head>
<body>
<?php 
if($status=="" OR $status=="error"){
?>

	<form action="" method="POST">
		<h3>Select the Test to answer questions:</h3>
		<label><span class="error">'*' are required field.</span></label><br><br>

	
	<label><span class="error">*</span>Select the Test:</label>

	      	<select id="test" name="test" value="<?php echo $data_entered['test']?>">
			      <option value=""<?php if(empty($data_entered['test'])) echo 'selected';?>>Select your test</option>
			      	<?php foreach ($tests as $test):?>
			      <option value="<?php echo $test['test_id']?>" <?php if($test['test_id']==$data_entered['test']) echo 'selected';?>><?php echo $test['test_name']?></option>
			      	<?php endforeach ?><br>
	  	  	</select>

			      <?php if(isset($errors['test'])){ ?>
			      <p><span class="error"><?php echo $errors['test'] ?></span></p><br>
			      <?php } }?> <br> 

		      
		      <?php if($status=="test_answer") { ?>
				    <form action="" method="POST">
				     
				         <h2>Answer questions for <?php echo $test_fetched[0]['test_name'] ;  ?></h2><br><br>

				         <?php $i=1; ?>
		                 <?php foreach($questions as $question):  ?>
		             
		                <label><?php echo $i; echo "  "; echo $question['t_ques_text'] ?></label><br>
		                <label><span class="error">* </span>Answer: </label>
		                <input type="radio" name="answer_<?php echo $question['t_ques_id'];?>" value="1" checked><?php echo $question['op_1'];?>
				    	<input type="radio" name="answer_<?php echo $question['t_ques_id'];?>" value="2"><?php echo $question['op_2'];?>
				    	<input type="radio" name="answer_<?php echo $question['t_ques_id'];?>" value="3"><?php echo $question['op_3'];?>
		                    <?php $i++; ?><br>

		                    <?php if(isset($errors['answer'])) {?>
				   			 <p><span class="error"><?php echo $errors['answer'] ?></span></p>
				   			 <?php } ?><br>
		            		
		                     <?php endforeach ?><br><br>

		                     

		                     <input type="submit" value="Submit Test" id="submit_test"><br>
		                 </form>
		                 <?php } ?>
</form>
<script>
  $(document).ready(function(){

    

    $("#test").change(function(){
        
              alert("event fired");
              window.location=location.href+ "?id=" +$("#test").val();
  
    });
  });
  </script>
 <?php  if($status=="submit" AND $status!="" AND $status!="test_answer" AND $status!="error"){ ?>
 	<h3>Test has been submitted.</h3>
<?php } ?>
</body>
</html>



		                     