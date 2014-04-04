<html>
<head>
<style>
.error {color:red;}
</style>
 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
</head>
<body>
<?php if($status=="" OR $status=="error"){?>
	<form action="" method="POST">
		<table style="width:600px" align="center">
			<tr>
				<td align="center"><h3>Enter a new password to reset</h3></td>
			</tr>
			<tr>
				<td align="center"><label>New password:</label></td>
			</tr>
			<tr>
				<td align="center"><input type="password" name="pass" id="pass"></td>
			</tr>
			<tr>
				<td align="center"><label>Confirm password:</label></td>
			</tr>
			<tr>
				<td align="center"><input type="password" name="confirm_pass" id="confirm-pass"></td>
			</tr>
			<tr>
				<td align="center"><input type="submit" value="Submit" name="submit"></td>
			</tr>

		</table>
	</form>
<?php }?>
<?php if($status=="password_reset"){?>
<h3>Your password has been reset successfully.</h3>
<?php }?>
</body>
</html>