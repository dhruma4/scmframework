<?php 
if($status=="" OR $status=="error"){?>
<form action="" method="POST">
	<table align="center">
		<tr> 
			<td colspan=3><h4>Select the Test to display result:</h4></td>
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
<?php if ($status=="test_result"){ ?>
	<form action="">
    	<table align="center" border="1">
    		
    			<th colspan=4 align="center"><h4>Result of <?php echo $test_fetched[0]['test_name'] ;?></h4></th>
    		
    		<tr>
    			<td><strong>Student id</strong></td>
    			<td><strong>Marks</strong></td>
    		</tr>
    		<?php foreach ($test_fetched as $result): ?>
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

    

    $("#test").change(function(){
        
                            window.location=location.href+ "?id=" +$("#test").val();
  
    });
  });
  </script>