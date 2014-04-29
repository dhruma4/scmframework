<?php if($logged_in==true){
if($status=="" OR $status=="error"){?>
	<form action="" method="POST">
        <table align="center">
            <tr>
                <td><label><span class="error">* </span>Branch Name: </label></td>
                <td><select id="branch" name="branch" value="<?php echo $data_entered['branch']?>">
                    <option value=""<?php if(empty($data_entered['branch'])) echo 'selected';?>>Select your branch</option>
                    <?php foreach ($branches as $branch):?>
                    <option value="<?php echo $branch['branch_id']?>" <?php if($branch['branch_id']==$data_entered['branch']) echo 'selected';?>><?php echo $branch['branch_name']?></option>
                    <?php endforeach ?>
                     </select>
                </td>
            </tr>
            <tr>
                <td><?php if(isset($errors['branch'])){ ?>
                    <p><span class="error"><?php echo $errors['branch'] ?></span></p>
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
                <td><label><span class="error">* </span>Faculty: </label></td>
                <td><select id="faculty" name="faculty" value="<?php echo $data_entered['faculty']?>">
                    <option value=""<?php if(empty($data_entered['faculty'])) echo 'selected';?>>Select faculty</option>
                    <?php foreach ($faculties as $faculty):?>
                    <option value="<?php echo $faculty['fac_id']?>" <?php if($faculty['fac_id']==$data_entered['faculty']) echo 'selected';?>><?php echo $faculty['fac_name']?></option>
                    <?php endforeach ?> 
                    </select>
                </td>
                <td><?php if(isset($errors['faculty'])){ ?>
                    <p><span class="error"><?php echo $errors['faculty'] ?></span></p>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td colspan=2 align="center"><input type="Submit" value="Submit"></td>
            </tr>
        </table>
    </form>
<script>
$(document).ready(function(){

      $("#sem").change(function(){
        
        $.ajax({url:base_url+"index.php/ajax/getsub_bybranch_bysem",
                data:{
                      'semid':$('#sem').val(),
                      'branchid':$('#branch').val()
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
<?php if($status=="mapped") {?>
<h4 align="center">Subject has been assigned to the faculty</h4>
<?php } } ?>

            