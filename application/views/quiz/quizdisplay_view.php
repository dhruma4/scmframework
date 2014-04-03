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
if($status=="" OR $status=="error" AND $status!="submit" AND $status!="quiz_answer"){
?>

	<form action="" method="POST">
		<table style="width:600px">
			<tr>
				<td colspan=2 align="center"><h3>Select the Quiz to answer questions:</h3></td>
			</tr>
			<tr>
				<td><label><span class="error">'*' are required field.</span></label></td>
			</tr>
			<tr>
				<td><label><span class="error">*</span>Select the Quiz:</label><td>
				<td><select id="quiz" name="quiz" value="<?php echo $data_entered['quiz']?>">
			      	<option value=""<?php if(empty($data_entered['quiz'])) echo 'selected';?>>Select your quiz</option>
			      	<?php foreach ($quizzes as $quiz):?>
			      	<option value="<?php echo $quiz['quiz_id']?>" <?php if($quiz['quiz_id']==$data_entered['quiz']) echo 'selected';?>><?php echo $quiz['quiz_name']?></option>
			      	<?php endforeach ?>
	  	  			</select>
	  	  		</td>
	  	  		<td><?php if(isset($errors['quiz'])){ ?>
			      	<p><span class="error"><?php echo $errors['quiz'] ?></span></p>
					<?php } }?> 
				</td>
			</tr>
		</table>
					
			      <?php if($status=="quiz_answer") { ?>
				    <form action="" method="POST">
				     
				         <h2>Answer questions for <?php echo $quiz_fetched[0]['quiz_name'] ;  ?></h2><br><br>

				         <?php $i=1; ?>
		                 <?php foreach($questions as $question):  ?>
		             
		                <label><?php echo $i; echo "  "; echo $question['q_text'] ?></label><br>
		                <label><span class="error">* </span>Answer: </label>
		                <input type="radio" name="answer_<?php echo $question['q_id'];?>" value="1"><?php echo $question['op_1'];?>
				    	<input type="radio" name="answer_<?php echo $question['q_id'];?>" value="2"><?php echo $question['op_2'];?>
				    	<input type="radio" name="answer_<?php echo $question['q_id'];?>" value="3"><?php echo $question['op_3'];?>
		                    <?php $i++; ?><br><br>
		            		
		                     <?php endforeach ?><br><br>

		                     <?php if(isset($errors['answer'])) {?>
				   			 <p><span class="error"><?php echo $errors['answer'] ?></span></p>
				   			 <?php } ?><br>

		                     <input type="submit" value="Submit Quiz" id="submit_quiz"><br>
		                 </form>
		                 <?php } ?>
</form>


<script>
  $(document).ready(function(){

    

    $("#quiz").change(function(){
        
              alert("event fired");
              window.location=location.href+ "?id=" +$("#quiz").val();
  
    });
  });
  </script>
 <?php  if($status=="submit" AND $status!="" AND $status!="error" AND $status!="quiz_answer"){ ?>
 	<h3>Quiz has been submitted.</h3>
<?php } ?>
</body>
</html>