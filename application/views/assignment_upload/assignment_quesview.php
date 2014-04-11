
<?php if($status=="" OR $status=="error"){ ?>

	<form action="" method="POST">
        <table align="center">
            <tr>
                <td><label><span class="error">'*' are required field.</span></label></td>
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
                <td><?php if(isset($errors['assign'])){ ?>
                    <p><span class="error"><?php echo $errors['assign'] ?></span></p>
                    <?php } ?> 
                </td>
            </tr>
        </table>
    <?php } ?>
</form>


    <?php if($status=="ques_upload") { ?>
    <form action="" method="POST">
        <table align="center">
            <tr>
                <td colspan=3 align="center"><h4>Upload question for <?php echo $assignment_fetched[0]['assign_name'] ;  ?></h4></td>
            </tr>
            <tr>
                <td colspan=3 align="left"> <h5><?php echo $msg; ?></h5></td>
            </tr>
            <tr>
                <td colspan=3 align="left"><label><h5>Already uploaded questions:</h5></label></td>
            </tr>
                 <?php $i=1; ?>
                 <?php foreach($questions as $question):  ?>
            <tr>
                <td colspan=2 align="left"><label><?php echo $i; echo "  "; echo $question['assign_ques_text'] ?></label></td>
                    <?php $i++; ?>
                </td>
            </tr>
                     <?php endforeach ?>
            <tr>
                <td><?php if(isset($errors['question'])) {?>
                    <p><span class="error"><?php echo $errors['question'] ?></span></p>
                    <?php }  ?>
                </td>
            </tr>
            <tr>
                <td colspan=2 align="center"><label><span class="error">* </span>New question: </label></td>
            </tr>
            <tr>
                <td><textarea name="ques" id="ques" rows="3" cols="50"></textarea></td>
            </tr>
            <tr>
                <td><?php if(isset($errors['ques'])) {?>
                    <p><span class="error"><?php echo $errors['ques'] ?></span></p>
                    <?php }  ?>
                </td>
            </tr>
            <tr>
                <td colspan=2 align="center"><input type="submit" value="Submit" name="submit"></td>
            </tr>
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
  
  
<?php 
if($status=="uploaded" AND $status!= "ques_upload"){ ?>
<h3>Question have been uploaded.</h3>
<form>
          <input type="submit" value="Go back"  name="back" id="back">&nbsp
          <input type="submit" value="Add another question"  name="add" id="add"> <br><br>
  </form>
<?php } ?>

</body>
</html>