<html>
<head>
<style>
.error {color:red;}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>

</head>
<body>
<?php if($status=="" OR $status=="error"){ ?>
<form action="" method="POST">
	<h3>Create your discussion topic here: </h3><br><br/>

	<?php   
  if((count($errors))>0){
    echo "'*' are required fields.";
    echo "";
    }
   ?>
	<br><br><label><span class="error">*</span>Topic:</label><br>
	<input style="width:350px" type="text" name="topic" value="<?php echo $data_entered['topic']?>" id="topic"><br><br>
	<?php if(isset($errors['topic'])){ ?>
    <p><span class="error"><?php echo $errors['topic'] ?></span></p>
    <?php } ?>
    <br></br>

	<label><span class="error">*</span>Brief about the topic:</label><br> 
	<textarea name="brief" id="brief" cols="45" rows="4" value="<?php echo $data_entered['brief']?>"></textarea>
	<?php if(isset($errors['brief'])){ ?>
    <p><span class="error"><?php echo $errors['brief'] ?></span></p>
    <?php } ?>
    <br>

    <input type="submit" name="Post Topic" id="post"><br><br/>
<?php } ?>

<?php if($status=="posted"){ ?>
<h3> Your topic has been posted </hr>
<?php } ?>



</form>
</body>
</html>