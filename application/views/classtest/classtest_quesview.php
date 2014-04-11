
<?php 
if($status=="" OR $status=="error"){
?><form action="" method="POST">
		<table align="center">
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
	  	  		<td><?php if(isset($errors['test'])){ ?>
		    		<p><span class="error"><?php echo $errors['test'] ?></span></p>
		    		<?php } }?>
		    	</td>
		    </tr>
		</table>


	<?php if($status=="ques_upload") { ?>
    <form action="" method="POST">
    	<table  align="center">
    		<tr>
    			<td colspan=4 align="center"><h4>Upload question for <?php echo $test_fetched[0]['test_name'] ;  ?></h4></td>
    		</tr>
    		<tr>
    			<td><h4><?php echo $msg; ?></h4></td>
    		</tr>
    		<tr>
    			<td><label>Already uploaded questions:</label></td>
    		</tr>
    		
                 <?php $i=1; ?>
                 <?php foreach($questions as $question):  ?>
             <tr>
                <td colspan=4 align="left"><label><?php echo $i; echo "  "; echo $question['t_ques_text'] ?></label></td>
                    <?php $i++; ?>
            		<?php endforeach ?>
                </td>
            </tr>
            <tr>
                <td><?php if(isset($errors['question'])) {?>
                    <p><span class="error"><?php echo $errors['question'] ?></span></p>
                    <?php }  ?>
                </td>
            </tr>
            <tr>
            	<td><label><span class="error">* </span>New question: </label></td>
            </tr>
            <tr>
                <td colspan=4 align="left"><textarea name="ques" id="ques" rows="3" cols="40"></textarea></td>
            </tr>
            <tr>
            	<td><?php if(isset($errors['ques'])) {?>
                      <p><span class="error"><?php echo $errors['ques'] ?></span></p>
                      <?php }  ?>
                </td>
            </tr>
            <tr>
            	<td><label><span class="error">* </span>Option 1: </label></td>
            </tr>
            <tr>
            	<td><input type="text" name="op1" id="op1"></td>
            	<td><?php if(isset($errors['op1'])) {?>
			    	<p><span class="error"><?php echo $errors['op1'] ?></span></p>
			    	<?php } ?>
			    </td>
			</tr>
			<tr>
				<td><label><span class="error">* </span>Option 2: </label></td>
			</tr>
			<tr>
				<td><input type="text" name="op2" id="op2"></td>
				<td><?php if(isset($errors['op2'])) {?>
				    <p><span class="error"><?php echo $errors['op2'] ?></span></p>
				    <?php } ?>
				</td>
			</tr>
			<tr>
				<td><label><span class="error">* </span>Option 3: </label></td>
			</tr>
			<tr>
				<td><input type="text" name="op3" id="op3"></td>
				<td><?php if(isset($errors['op3'])) {?>
				    <p><span class="error"><?php echo $errors['op3'] ?></span></p>
				    <?php } ?>
				</td>
			</tr>
			<tr>
				<td><label><span class="error">*</span>Answer:</label></td>
			</tr>
			<tr>
				<td><input type="radio" name="answer" value="1" checked>Option 1</td>
				<td><input type="radio" name="answer" value="2">Option 2</td>
				<td><input type="radio" name="answer" value="3">Option 3</td>
			</tr>
			<tr>
				<td><?php if(isset($errors['answer'])) {?>
				    <p><span class="error"><?php echo $errors['answer'] ?></span></p>
				    <?php } ?>
				</td>
			</tr>

			<tr>
				<td colspan=4 align="center"><input type="submit" value="Submit" name="submit" ></td>
			</tr>
		</table>
          
    </form>
    <?php } ?>
      
<script>
  $(document).ready(function(){

    $("#back").click(function(){

      window.history.back();
      event.preventDefault();
      return false;
      
     });

    $("#test").change(function(){
        
              alert("event fired");
              window.location=location.href+ "?id=" +$("#test").val();
  
    });
  });
  </script>

	<?php 
if($status=="uploaded" AND $status!= "ques_upload"){ ?>
<h3 align="center">Question have been uploaded.</h3>
<form>
          <input type="submit" value="Go back"  name="back" id="back">&nbsp
          <input type="submit" value="Add another question"  name="add" id="add"> <br><br>
  </form>
<?php } ?>


