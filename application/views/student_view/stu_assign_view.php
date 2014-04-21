<?php if($status=="" OR $status=="error"){ ?>
<form action="" method="POST">
    <table align="center">
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
  });
  </script>