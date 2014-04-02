<html>
<head>
	<style>
	.error{color:red;}
	</style>
</head>
<body>
      <?php 
if($status=="" OR $status=="error"){
  ?>
	<form action="" method="POST" enctype="multipart/form-data">
            <h3>Please submit your assignment here.</h3>

	<label><span class="error">*</span>Assignment Name: </label>
      <input type="text" name="assign_name" value="<?php echo $data_entered['assign_name']?>">
      <?php if(isset($errors['assign_name'])){?>
      <label><span class="error"><p><?php echo $errors['assign_name'] ?></p></span>
      <?php } ?>
      <br>

      <label><span class="error">*</span>Select a file: </label>
      <input type="file" name="assign_file" value="<?php echo $data_entered['assign_file']?>">
      <?php if(isset($errors['assign_file'])){?>
      <label><span class="error"><p><?php echo $errors['assign_file'] ?></p></span>
      <?php } ?>
      <br>

      
      <br><br>

      <input type="Submit" value="Submit">
      <br><br>
	</form>

      <?php } ?>

<?php 
if ($status=="uploaded") {
?>
<h3> Assignmnet uploaded. </h3>
<?php } ?>

</body>

</html>