
      <?php 
      if($logged_in==true){
if($status=="" OR $status=="error"){
  ?>
	<form action="" method="POST" enctype="multipart/form-data">
            <table align="center" style="width:700px">
                <tr>
                    
                    <td><label><span class="error">*</span>Assignment Name: </label></td>
                    <td><select id="assign_name" name="assign_name" value="<?php echo $data_entered['assign_name']?>">
                    <option value=""<?php if(empty($data_entered['assign_name'])) echo 'selected';?>>Select your assignment</option>
                    <?php foreach ($assignments as $assignment):?>
                    <option value="<?php echo $assignment['assign_id']?>" <?php if($assignment['assign_id']==$data_entered['assign_name']) echo 'selected';?>><?php echo $assignment['assign_name']?></option>
                    <?php endforeach ?>
                    </td> 
                    
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
<?php }?>
