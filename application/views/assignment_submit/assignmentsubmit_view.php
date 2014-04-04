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
            <table align="center" style="width:700px">
                <tr>
                    <td colspan=2 align="center"><h3>Please submit your assignment here.</h3></td>
                </tr>
                <tr>
                    <td><label><span class="error">*</span>Assignment Name: </label></td>
                    <td><input type="text" name="assign_name" value="<?php echo $data_entered['assign_name']?>"></td>
                    <td><?php if(isset($errors['assign_name'])){?>
                        <label><span class="error"><p><?php echo $errors['assign_name'] ?></p></span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td><label><span class="error">*</span>Select a file: </label></td>
                    <td><input type="file" name="assign_file" value="<?php echo $data_entered['assign_file']?>"></td>
                    <td><?php if(isset($errors['assign_file'])){?>
                        <label><span class="error"><p><?php echo $errors['assign_file'] ?></p></span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 align="center"><input type="Submit" value="Submit"></td>
                </tr>
            </table>
    	</form>
    <?php } ?>

<?php 
if ($status=="uploaded") {
?>
<h3 align="center"> Assignmnet uploaded. </h3>
<?php } ?>

</body>

</html>