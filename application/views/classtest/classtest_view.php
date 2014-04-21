<?php 
if($status=="" OR $status=="error"){?>
	<form action="" method="POST">
        <table  align="center">
            <?php /*<tr>
                <td colspan=2 align="center"><h4>Upload the Class test here:</h4></td>
            </tr> */?>
            <tr>
                <td><label><span class="error">'*' are required field.</span></label></td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>Test name: </label></td>
                <td><input type="text" name="test" id="test"></td>
                <td><?php if(isset($errors['test'])) {?>
                    <p><span class="error"><?php echo $errors['test'] ?></span></p>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>Semester: </label></td>
                <td><select name="sem" value="<?php echo $data_entered['sem']?>" id="sem">
                    <option value="" <?php if(empty($data_entered['sem'])) echo 'selected';?>>Select your semester</option>
                    <?php
                    for( $i=1; $i<=8; $i++)
                    { ?>
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
                <td><label><span class="error">* </span>Subject: </label></td>
                <td><select id="subject" name="subject" value="<?php echo $data_entered['subject']?>">
                    <option value=""<?php if(empty($data_entered['subject'])) echo 'selected';?>>Select your subject</option>
                    <?php foreach ($subjects as $subject):?>
                    <option value="<?php echo $subject['sub_id']?>" <?php if($subject['sub_id']==$data_entered['subject']) echo 'selected';?>><?php echo $subject['sub_name']?></option>
                    <?php endforeach ?>
                    </select>
                </td>
                <td><?php if(isset($errors['subject'])){ ?>
                     <p><span class="error"><?php echo $errors['subject'] ?></span></p>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td colspan=2 align="center"><input type ="submit" value= "Submit"> </td>
            </tr>
        </table>
    </form>
   <script>
$(document).ready(function(){

      $("#sem").change(function(){

       
        $.ajax({url:"http://localhost/scmframework/index.php/ajax/get_subject_bysem",
                data:{
                      'semid':$('#sem').val()
                      },
                type:'post',
                dataType:'json',
                success:function(result){
                console.log(result);
                      
                        $("#subject").empty();
                        
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
<?php } ?>
<?php 
if ($status=="success") {
?>
<h4 align="center">Test has been uploaded. </h4>
<?php } ?>
