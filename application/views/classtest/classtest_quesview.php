<html>
<head>
<style>
.error {color:red;}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>

</head>
<body>
<?php 
if($status=="" OR $status=="error"){
?>

	<form action="" method="POST">
		<h3>Select the Test to upload questions:</h3>
		<label><span class="error">'*' are required field.</span></label><br><br>

	
	<label><span class="error">*</span>Select the Test:</label>

	      	<select id="test" name="test" value="<?php echo $data_entered['test']?>">
			      <option value=""<?php if(empty($data_entered['test'])) echo 'selected';?>>Select your test</option>
			      	<?php foreach ($tests as $test):?>
			      <option value="<?php echo $test['test_id']?>" <?php if($test['test_id']==$data_entered['test']) echo 'selected';?>><?php echo $test['test_name']?></option>
			      	<?php endforeach ?><br>
	  	  	</select>

		      <?php if(isset($errors['test'])){ ?>
		      <p><span class="error"><?php echo $errors['test'] ?></span></p><br>
		      <?php } }?> <br> 


	<?php if($status=="ques_upload") { ?>
    <form action="" method="POST">
     
         <h2>Upload question for <?php echo $test_fetched[0]['test_name'] ;  ?></h2><br><br>

         <h4><?php echo $msg; ?></h4><br>

            <label>Already uploaded questions:</label><br><br>
                 <?php $i=1; ?>
                 <?php foreach($questions as $question):  ?>
             
                <label><?php echo $i; echo "  "; echo $question['t_ques_text'] ?></label><br>
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

            <label><span class="error">* </span>Option 1: </label>
		    		<input type="text" name="op1" id="op1">
		      
			    	<?php if(isset($errors['op1'])) {?>
			    	<p><span class="error"><?php echo $errors['op1'] ?></span></p>
			    	<?php } ?><br>

		    <label><span class="error">* </span>Option 2: </label>
				    <input type="text" name="op2" id="op2">
				      
				    <?php if(isset($errors['op2'])) {?>
				    <p><span class="error"><?php echo $errors['op2'] ?></span></p>
				    <?php } ?><br>


		    <label><span class="error">* </span>Option 3: </label>
				    <input type="text" name="op3" id="op3">
				      
				    <?php if(isset($errors['op3'])) {?>
				    <p><span class="error"><?php echo $errors['op3'] ?></span></p>
				    <?php } ?><br>

		    <label><span class="error">*</span>Answer:</label>
				    <input type="radio" name="answer" value="1">Option 1
				    <input type="radio" name="answer" value="2">Option 2
				    <input type="radio" name="answer" value="3">Option 3
				    <br>

              			
            
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

    $("#test").change(function(){
        
              alert("event fired");
              window.location=location.href+ "?id=" +$("#test").val();
  
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