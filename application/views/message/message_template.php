<html>
<head>
	<?php if($called=="password_reset"){?>
<h2>Reset your password at the below given link.</h2>
</head>
<body>
	<p>The reset password link expires in 24 hours.So make sure you do it before that.</p>
	<a href="<?php echo site_url()."/authorization/reset_password?hash=".$hash."&email=".$email."&role=".$role ;?>">Reset password here.</a>


<?php }?>
<?php if($called="assignment_status") {?>
	<?php if($copy_found==true) {?>
<p>Your <?php echo $data_entered['assign_name'];?>assignment has been rejected.Please submit it before the deadline.</p>
<?php } ?>
	<?php if($copy_found==false){?>
	<p>Your <?php echo $data_entered['assign_name'];?>assignment has been accepted.</p>
	<?php }?>
<?php } ?>
</body>
</html> 