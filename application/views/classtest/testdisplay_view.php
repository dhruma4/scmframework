<?php 
if($status=="" OR $status=="error"){?>
<form action="" method="POST">
	<table align="center">
		<tr> 
			<td colspan=3><h4>Select the Test to answer questions:</h4></td>
		</tr>
		<tr>
			<td><label><span class="error">'*' are required field.</span></label></td>
		</tr>
		<tr>
			<td><label><span class="error">*</span>Select the Test:</label></td>

			<td><select id="test" name="test" value="<?php echo $data_entered['test']?>">
		      	<option value=""<?php if(empty($data_entered['test'])) echo 'selected';?>>Select your test</option>
		      	<?php foreach ($tests as $test):?>
		      	<option value="<?php echo $test['test_id']?>" <?php if($test['test_id']==$data_entered['test']) echo 'selected';?>><?php echo $test['test_name']?></option>
		      	<?php endforeach ?>
  	  			</select>
  	  		</td>
  	  	</tr>
		<tr>
		  	<td><?php if(isset($errors['test'])){ ?>
		      	<p><span class="error"><?php echo $errors['test'] ?></span></p>
		      	<?php } }?>
		    </td>
		</tr>
	</table>
</form>

<?php if($status=="test_answer") { ?> 
    <form action="" method="POST">
    	<table align="center">
    		<tr>
    			<td clolspan=3 align="center"><h4>Answer questions for <?php echo $test_fetched[0]['test_name'] ;?></h4></td>
    		</tr>
    			<?php $i=1; ?>
         		<?php foreach($questions as $question):  ?>
     		<tr>
     			<td colspan=3><label><?php echo $i; echo "  "; echo $question['t_ques_text'] ?></label></td>
     		</tr>
     		<tr>
     			<td><label><span class="error">* </span>Answer: </label></td>
     		</tr>
     		<tr>
     			<td><input type="radio" name="answer_<?php echo $question['t_ques_id'];?>" value="1" checked><?php echo $question['op_1'];?></td>
    			<td><input type="radio" name="answer_<?php echo $question['t_ques_id'];?>" value="2"><?php echo $question['op_2'];?></td>
    			<td><input type="radio" name="answer_<?php echo $question['t_ques_id'];?>" value="3"><?php echo $question['op_3'];?></td>
            	<?php $i++; ?>
        	</tr>
        	<tr>
        		<td><?php if(isset($errors['answer'])) {?>
   			 		<p><span class="error"><?php echo $errors['answer'] ?></span></p>
   			 		<?php } ?>
   			 	</td>
   			</tr>
   				<?php endforeach ?>
   			<tr>
   				<td colspan=2 align="center"><input type="submit" value="Submit Test" id="submit_test"></td>
			</tr>
		</table>
    </form>
<?php } ?>

<script>
  $(document).ready(function(){

    

    $("#test").change(function(){
        
              //alert("event fired");
              window.location=location.href+ "?id=" +$("#test").val();
  
    });
  });
  </script>
 <?php  if($status=="submit" AND $status!="" AND $status!="test_answer" AND $status!="error"){ ?>
 	<h4>Test has been submitted.</h4>
<?php } ?>




		                     