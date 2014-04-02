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
	   <h3>Select the Assignment to upload questions:</h3>

	       <label><span class="error">'*' are required field.</span></label><br><br>

	       <label><span class="error">*</span>Select the Assignment:</label>
              <select id="assign" name="assign" value="<?php echo $data_entered['assign']?>">
                  <option value=""<?php if(empty($data_entered['assign'])) echo 'selected';?>>Select your assignment</option>
                        <?php foreach ($assignments as $assignment):?>
                  <option value="<?php echo $assignment['assign_id']?>" <?php if($assignment['assign_id']==$data_entered['assign']) echo 'selected';?>><?php echo $assignment['assign_name']?></option>
                        <?php endforeach ?><br>
          	  </select>
              
              <?php if(isset($errors['assign'])){ ?>
              <p><span class="error"><?php echo $errors['assign'] ?></span></p>
              <?php } ?> <br> 
      
      <?php } ?>
    </form>


    <?php if($status=="ques_upload") { ?>
    <form action="" method="POST">
     
         <h3>Upload question for <?php echo $assignment_fetched[0]['assign_name'] ;  ?></h3><br><br>

         <h5><?php echo $msg; ?></h5><br>

            <label>Already uploaded questions:</label><br><br>
                 <?php $i=1; ?>
                 <?php foreach($questions as $question):  ?>
             
                <label><?php echo $i; echo "  "; echo $question['assign_ques_text'] ?></label><br>
                    <?php $i++; ?>
            
                     <?php endforeach ?><br><br>
                     <?php if(isset($errors['question'])) {?>
                      <p><span class="error"><?php echo $errors['question'] ?></span></p>
                      <?php }  ?><br>


        	<label><span class="error">* </span>New question: </label><br>
                    <textarea name="ques" id="ques" rows="3" cols="50"></textarea>
                  
                      <?php if(isset($errors['ques'])) {?>
                      <p><span class="error"><?php echo $errors['ques'] ?></span></p>
                      <?php }  ?><br>

              			
            
        	<input type="submit" value="Submit" name="submit" >
          
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
        
              alert("event fired");
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