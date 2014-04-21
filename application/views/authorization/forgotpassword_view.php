<?php if($status=="" OR $status=="error"){ ?>
<form action="" method="POST">
	<h3 align="center"> <font color=#C16C2F>Find your account:</font></h3>
	<table  align="center">
		<tr>
			<td>Select your role:</td>
			<td><select name="role" value="<?php echo $data_entered['role']?>" id="role">
		        <option value="" <?php if(empty($data_entered['role'])) echo 'selected';?>>Select your role</option>
		      	<option value="admin" <?php if($data_entered['role']=="admin") echo 'selected'; ?>>Admin</option>
				<option value="branch moderator" <?php if($data_entered['role']=="branch moderator") echo 'selected'; ?>>Branch moderator</option>
				<option value="faculty" <?php if($data_entered['role']=="faculty") echo 'selected'; ?>>Faculty</option>
				<option value="student" <?php if($data_entered['role']=="student") echo 'selected'; ?>>Student</option>
			</td>
			<td><?php if(isset($errors['role'])){ ?>
      			<p><span class="error"><?php echo $errors['role'] ?></span></p>
            	<?php } ?>
			</td>
		</tr>
		<tr>
			<td><label>Username:</label></td>
			<td><input type="text" value="<?php echo $data_entered['username'];?>" name="username" id="username"></td>
			<td><?php if(isset($errors['username'])){ ?>
      			<p><span class="error"><?php echo $errors['username'] ?></span></p>
            	<?php } ?>
            </td>
		</tr>
		<tr>
			<td colspan=2 align="center"><input type="submit" value="Submit" id="submit" name="role-submit"></td>
		</tr>
	</table>
</form>
<?php } ?>
<?php if($status=="security_question"){?>
<form action="" method="POST">
<table align="center">
	<tr>
		<td><label>Security question:</label></td>
		<?php if($active=="else"){?>
		<td><?php echo $ques[0]['security_ques'];?></td>
		<?php } ?>
		<?php if($active==""){?>
		<td><?php echo $ques[0]['security_ques'];?></td>
		<?php } ?>
	</tr>
	<tr>
		<td><label>Answer:</label></td>
		<td><input type="text" value="<?php echo $data_entered['answer'];?>" name="answer"></td>
		<td><?php if(isset($errors['answer'])){ ?>
      			<p><span class="error"><?php echo $errors['answer'] ?></span></p>
            	<?php } ?>
		</td>
	</tr>
	<tr><td><input type="submit" value="Submit" name="sec-submit" id="submit"></td>
	</tr>
</table>

</form>
<?php }?>
<?php if($status=="send_email"){?>
<h4>Check your email for password reset.</h4>
<?php }?>


