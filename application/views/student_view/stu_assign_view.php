<?php if($status=="" OR $status=="error"){ ?>
<form action="" method="POST">
    <table align="center">
    <h3 align="center"> <font color=#C16C2F>Select assignment to view questions</font></h3><br>
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
        <td><label><span class="error">*</span>Select the Assignment:</label></td>
        <td><select id="assign" name="assign" value="<?php echo $data_entered['assign']?>">
            <option value=""<?php if(empty($data_entered['assign'])) echo 'selected';?>>Select your assignment</option>
            <?php foreach ($assignments as $assignment):?>
            <option value="<?php echo $assignment['assign_id']?>" <?php if($assignment['assign_id']==$data_entered['assign']) echo 'selected';?>><?php echo $assignment['assign_name']?></option>
            <?php endforeach ?> 
            </select>
        </td>
    </tr>
    <tr>
        <td><?php if(isset($errors['assign'])){ ?>
            <p><span class="error"><?php echo $errors['assign'] ?></span></p>
            <?php } ?> 
        </td>
    </tr> 
    </table>
    <?php } ?>
</form>
 <?php if($status=="ques_view") { ?>
    <form action="">
        <table align="center">
            <tr>
                <td colspan=3 align="center"><h4>Questions for <?php echo $assignment_fetched[0]['assign_name'] ;  ?></h4></td>
            </tr>
            <tr>
                <td><p><strong>Assignment submit date:</strong>&nbsp<?php echo $assignment_fetched[0]['assign_submit_date'];?></p></td>
            </tr>
            <tr>
                <td><?php if(isset($errors['question'])){ ?>
                <p><span class="error"><?php echo $errors['question'] ?></span></p>
                <?php } ?> 
                </td>
            </tr>
                 <?php $i=1; ?>
                 <?php foreach($questions as $question):  ?>
            <tr>

                <td colspan=2 align="left"><label><?php echo $i; echo "  "; echo $question['assign_ques_text'] ?></label>
                </td>
                    <?php $i++; ?>
            </tr>
                    <?php endforeach ?>
        </table>
    </form>
    <?php } ?>


    <script>
  $(document).ready(function(){

    $("#back").click(function(){

      window.history.back();
      event.preventDefault();
      return false;
      
     });

    $("#assign").change(function(){
        
              //alert("event fired");
              window.location=location.href+ "?id=" +$("#assign").val();
  
    });
    $("#sem").change(function(){
        
        $.ajax({url:base_url+"index.php/ajax/get_subject_bysem",
                data:{
                      'semid':$('#sem').val()
                      },
                type:'post',
                dataType:'json',
                success:function(result){
                console.log(result);
                      
                        $("#subject").empty();
                       $("#subject").append('<option value="0">Select subject </option>')
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

       $("#subject").change(function(){
        
        $.ajax({url:base_url+"/index.php/ajax/getassign_bysub",
                data:{
                      'subjectid':$('#subject').val()
                      },
                type:'post',
                dataType:'json',
                success:function(result){
                console.log(result);
                       
                        $("#assign").empty();
                       $("#assign").append('<option value="0">Select assignment </option>')
                        for(i in result){
                          var assign=result[i];
                          $("#assign").append('<option value="'+assign.assign_id+'"">'+assign.assign_name+'</option>')
                        }
                },
                error:function(data) {
                  console.log(data)
                }

              });
      });
  });
  </script>