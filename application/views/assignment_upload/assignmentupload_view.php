<html>
<head>
	<style>
	.error{color:red;}
	</style>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>

</head>
<body>
  <?php 
if($status=="" OR $status=="error"){
  ?>
	<form action="" method="POST">

    <h3> Upload the assignment here:</h3>
		<span class="error">*</span><label>Assignment name:</label>
		<input type="text" name="assign_name">
    <?php if(isset($errors['assign_name'])){ ?>
      <p><span class="error"><?php echo $errors['assign_name'] ?></span></p>
      <?php } ?>
      </br>

	  <span class="error">*</span><label>Faculty name:</label>
	  <select name="faculty_name">
    <option value="">Select faculty</option>
      <?php foreach ($faculties as $faculty):?>
      <option value="<?php echo $faculty['fac_id']?>"><?php echo $faculty['fac_name']?></option>
      <?php endforeach ?><br>
  	  </select>
      <?php if(isset($errors['faculty_name'])){ ?>
      <p><span class="error"><?php echo $errors['faculty_name'] ?></span></p>
      <?php } ?>
      </br>

       <label><span class="error">* </span>Semester: </label>
      <select name="sem" value="<?php echo $data_entered['sem']?>" id="sem">
        <option value="" <?php if(empty($data_entered['sem'])) echo 'selected';?>>Select your semester</option>
        <?php
        for( $i=1; $i<=8; $i++)
        { ?>
          <option value="<?php echo $i; ?>" <?php if($data_entered['sem']==$i) echo 'selected'; ?>><?php echo $i; ?></option>
        <?php } ?>

      </select>
      <?php if(isset($errors['sem'])){ ?>
      <p><span class="error"><?php echo $errors['sem'] ?></span></p>
      <?php } ?> <br> <br>


      <label><span class="error">* </span>Subject: </label>
      <select id="subject" name="subject" value="<?php echo $data_entered['subject']?>">
      <option value=""<?php if(empty($data_entered['subject'])) echo 'selected';?>>Select your subject</option>
      
      <?php foreach ($subjects as $subject):?>
      <option value="<?php echo $subject['sub_id']?>" <?php if($subject['sub_id']==$data_entered['subject']) echo 'selected';?>><?php echo $subject['sub_name']?></option>
      <?php endforeach ?><br>
      </select>

      <?php if(isset($errors['subject'])){ ?>
      <p><span class="error"><?php echo $errors['subject'] ?></span></p>
      <?php } ?> </br>


      <span class="error">*</span><label>Assignment deadline:</label>
		  <input type="date" name="assign_deadline"><br>
      <?php if(isset($errors['assign_deadline'])){ ?>
      <p><span class="error"><?php echo $errors['assign_deadline'] ?></span></p>
      <?php } ?>
      </br>

		<input type="Submit" value="Upload Assignment">
		<input type="Reset" value="Cancel">
		<br>

	</form>

   <script>
$(document).ready(function(){

      $("#sem").change(function(){
        //alert("fired");

       //alert($(this).val());
        $.ajax({url:"http://localhost/scmframework/index.php/ajax/get_subject_bysem",
                data:{
                      'semid':$('#sem').val()
                      },
                type:'post',
                dataType:'json',
                success:function(result){
                console.log(result);
                      
                        $("#subject").empty();
                        //alert("The list is emptied");
                        

                        for(i in result){
                          var subject=result[i];
                          $("#subject").append('<option value="'+subject.sub_id+'"">'+subject.sub_name+'</option>')
                        }
    
                },
                error:function(data) {
                  console.log(data)
                }

              });
      });
  });
</script>

<?php }?>
<?php 
if ($status=="uploaded") {
?>
<h3> Assignment uploaded. </h3>
<?php } ?>
   
</body>
</html>