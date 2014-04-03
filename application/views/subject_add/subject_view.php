<html>
<head>
	<style >
.error{color: red;}
	</style>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
  </script>

</head>
<body>
<?php
  if($status=="" OR $status=="error"){
?>
<form action="" method="POST">

<table style="width:600px">
    <tr>
        <td colspan=2 align="center"><h3> Insert subject here: </h3></td>
    </tr>
    <tr>
        <td><label><span class="error">* </span>Branch Name: </label></td>
        <td><select name="branch" id="branch" value="<?php echo $data_entered['branch']?>">
            <option value=""<?php if(empty($data_entered['branch'])) echo 'selected';?>>Select your branch</option>
            <?php foreach ($branches as $branch):?>
            <option value="<?php echo $branch['branch_id']?>" <?php if($branch['branch_id']==$data_entered['branch']) echo 'selected';?>><?php echo $branch['branch_name']?></option>
            <?php endforeach ?>
            </select>
        </td>
        <td><?php if(isset($errors['branch'])){ ?>
            <p><span class="error"><?php echo $errors['branch'] ?></span></p>
            <?php } ?>
        </td>
    </tr>
    <tr>
    	<td><label><span class="error">* </span>Subject name:</label></td>
        <td><input type="text" name="subject" id="subject" value="<?php echo $data_entered['subject']?>"></td>
        <td><?php if(isset($errors['subject'])){ ?>
            <p><span class="error"><?php echo $errors['subject'] ?></span></p>
            <?php } ?>
        </td>
    </tr>
    <tr>
    	<td><label><span class="error">* </span>Semester: </label></td>
        <td><select name="sem" value="<?php echo $data_entered['sem']?>" id="sem">
            <option value="" <?php if(empty($data_entered['sem'])) echo 'selected';?>>Select your semester</option>
            <?php
                for( $i=1; $i<=8; $i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($data_entered['sem']==$i) echo 'selected'; ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </td>
        <td><?php if(isset($errors['sem'])){ ?>
            <p><span class="error"><?php echo $errors['sem'] ?></span></p>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td colspan=2 align="center"><input type="Submit" value="Insert"> <input type="Reset" value="Cancel"></td>
	</tr>
</form> 
  


 <?php /* <script>
$(document).ready(function(){

      $("#branch").change(function(){

       //alert($(this).val());
        $.ajax({url:"http://localhost/scmframework/index.php/ajax/get_subject",
                data:{
                      'branchid':$('#branch').val()
                      },
                type:'post',
                dataType:'json',
                success:function(result){
                console.log(result);
                      if(result.length>0){
                        $("#subject").empty();
                        //alert("The list is emptied");
                        }

                        for(i in result){
                          var subjects=result[i];
                          $("#subject").append('<option value="'+subjects.sub_id+'"">'+subjects.sub_name+'</option>')
                        }
    
                },
                error:function(data) {
                  console.log(data)
                }

              });
      });
  });
</script> */ ?>
<?php } ?>

<?php 
if($status=="added"){ ?>
<h3> Subject has been added </h3>
<?php } ?>

</body>
</html>