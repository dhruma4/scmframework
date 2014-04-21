<?php if($status=="" OR $status=="error"){?>
	<form action="" method="POST">
		<table align="center">
			<tr>
				<td align="center"><font color=#C16C2F><h3>Enter a new password to reset</h3></font></td>
			</tr>
			<tr>
				<td align="center"><label>New password:</label></td>
			</tr>
			<tr>
				<td align="center"><input type="password" name="pass" id="pass"></td>
				<td><?php if(isset($errors['pass'])){ ?>
      				<p><span class="error"><?php echo $errors['pass'] ?></span></p>
            		<?php } ?>
            	</td>
			</tr>
			<tr>
				<td align="center"><label>Confirm password:</label></td>
			</tr>
			<tr>
				<td align="center"><input type="password" name="confirm_pass" id="confirm-pass"></td>
				<td><?php if(isset($errors['confirm_pass'])){ ?>
      				<p><span class="error"><?php echo $errors['confirm_pass'] ?></span></p>
            		<?php } ?>
            	</td>
			</tr>
			<tr>
				<td align="center"><input type="submit" value="Submit" name="submit"></td>
			</tr>
		</table>
	</form>
<?php }?>
<?php if($status=="password_reset"){?>
<h4>Your password has been reset successfully.</h4>
<?php }?>
