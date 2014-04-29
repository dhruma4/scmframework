<?php 
if($status=="" OR $status=="error" AND $status!="submit" AND $status!="quiz_answer"){ ?>
<form action="" method="POST">
	<table  align="center">
		<tr> 
			<td colspan=3 align="center"><h4>Select the Quiz to display result:</h4></td>
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
  	  	</tr>
  	  	<tr>
  	  		<td><?php if(isset($errors['quiz'])){ ?>
		      	<p><span class="error"><?php echo $errors['quiz'] ?></span></p>
				<?php } }?> 
			</td>
		</tr>
	</table>
</form> 
<?php if($status=="quiz_result"){?>
	<form action="">
    	<table align="center" border="1">
    		
    			<th colspan=4 align="center"><h4>Result of <?php echo $quiz_fetched[0]['quiz_name'] ;?></h4></th>
    		
    		<tr>
    			<td><strong>Student id</strong></td>
    			<td><strong>Marks</strong></td>
    		</tr>
    		<?php foreach ($quiz_fetched as $result): ?>
    		<tr>
    			<td><?php echo $result['stu_id'];?></td>
    			<td><?php echo $result['marks'];?></td>
    		</tr>
    		<?php endforeach ?>
    	</table>
    </form>
<?php } ?>
<script>
  $(document).ready(function(){

    $("#quiz").change(function(){
        
                            window.location=location.href+ "?id=" +$("#quiz").val();
  
    });
  });
  </script>