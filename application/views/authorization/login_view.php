<html>
<head>
<style>
 .error {color:red;}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
</head>
<body>
<?php if($status=="" OR $status=="error") {?>
<form action="" method="POST">
    <label>Select your role:</label>
    <select name="role" id="role" value="<?php echo $data_entered['role']?>">
        <option value="" <?php if(empty($data_entered['role'])) echo 'selected';?>>Select your role</option>
        <option value="admin" <?php if($data_entered['role']=="admin") echo 'selected'; ?>><?php echo "Admin" ?></option>
        <option value="branch moderator" <?php if($data_entered['role']=="branch moderator") echo 'selected'; ?>><?php echo "Branch Moderator" ?></option>
        <option value="faculty" <?php if($data_entered['role']=="faculty") echo 'selected'; ?>><?php echo "Faculty" ?></option>
        <option value="student" <?php if($data_entered['role']=="student") echo 'selected'; ?>><?php echo "Student" ?></option>
    </select>
    <br>
    <?php if(isset($errors['role'])){ ?>
      <p><span class="error"><?php echo $errors['role'] ?></span></p>
      <?php } ?><br>

	<label>Username:</label>&nbsp
	<input type="text" name="username" id="username" value="<?php echo $data_entered['username'];?>" ><br>
	<?php if(isset($errors['username'])){ ?>
      <p><span class="error"><?php echo $errors['username'] ?></span></p>
    <?php } ?><br>

    <label>Password:</label>&nbsp
	<input type="password" name="password" id="password" value="<?php echo $data_entered['password'];?>" ><br>
    <?php if(isset($errors['password'])){ ?>
      <p><span class="error"><?php echo $errors['password'] ?></span></p>
    <?php } ?>
    <br>
<input type="submit" value="Log in" name="login">&nbsp<a href="<?php echo site_url()."";?>">Forgot password?</a></br></br>
</form>
<?php } ?>
<?php if($status=="verified"){ ?>
<h3> Verified user </h3>
<?php } ?>
</body>
</html>