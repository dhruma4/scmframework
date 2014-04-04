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
        <table style="width:700px" align="center">
            <tr>
                <td colspan=2 align="center"><h3>Select the Quiz to upload questions:</h3></td>
            </tr>
            <tr>
                <td><label><span class="error">'*' are required field.</span></label></td>
            </tr>
            <tr>
                <td><label><span class="error">*</span>Select the Quiz:</label></td>
                <td><select id="quiz" name="quiz" value="<?php echo $data_entered['quiz']?>">
                    <option value=""<?php if(empty($data_entered['quiz'])) echo 'selected';?>>Select your quiz</option>
                    <?php foreach ($quizzes as $quiz):?>
                    <option value="<?php echo $quiz['quiz_id']?>" <?php if($quiz['quiz_id']==$data_entered['quiz']) echo 'selected';?>><?php echo $quiz['quiz_name']?></option>
                    <?php endforeach ?>
                    </select>
                </td>
                <td><?php if(isset($errors['quiz'])){ ?>
                    <p><span class="error"><?php echo $errors['quiz'] ?></span></p>
                    <?php } }?>
                </td>
            </tr>
        </table> 
      
      <?php if($status=="ques_upload") { ?>
    <form action="" method="POST">
        <table style="width:1200px" align="center">
            <tr>
                <td colspan=3 align="center"><h2>Upload question for <?php echo $quiz_fetched[0]['quiz_name'] ;  ?></h2></td>
            </tr>
            <tr>
                <td><h4><?php echo $msg; ?></h4></td>
            </tr>
            <tr>
                <td align="center"><label><b>Already uploaded questions:</b></label></td>
            </tr>
            <tr>
                    <?php $i=1; ?>
                    <?php foreach($questions as $question):  ?>
             
                <td colspan=2 align="left"><label><?php echo $i; echo "  "; echo $question['q_text'] ?></label>
                    <?php $i++; ?>
                    <?php endforeach ?>
                </td>
            </tr>
            <tr>
                <td><?php if(isset($errors['question'])) {?>
                    <p><span class="error"><?php echo $errors['question'] ?></span></p>
                    <?php }  ?>
                </td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>New question: </label></td>
            </tr>
            <tr>
                <td colspan=2 align="left"><textarea name="ques" id="ques" rows="3" cols="50"></textarea></td>
                <td><?php if(isset($errors['ques'])) {?>
                    <p><span class="error"><?php echo $errors['ques'] ?></span></p>
                    <?php }  ?>
                </td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>Option 1: </label></td>
                <td><input type="text" name="op1" id="op1"></td>
                <td><?php if(isset($errors['op1'])) {?>
                    <p><span class="error"><?php echo $errors['op1'] ?></span></p>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>Option 2: </label></td>
                <td><input type="text" name="op2" id="op2"></td>
                <td><?php if(isset($errors['op2'])) {?>
                    <p><span class="error"><?php echo $errors['op2'] ?></span></p>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>Option 3: </label></td>
                <td><input type="text" name="op3" id="op3"></td>
                <td><?php if(isset($errors['op3'])) {?>
                    <p><span class="error"><?php echo $errors['op3'] ?></span></p>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><label><span class="error">*</span>Answer:</label></td>
                <td><input type="radio" name="answer" value="1">Option 1</td>
                <td><input type="radio" name="answer" value="2">Option 2</td>
                <td><input type="radio" name="answer" value="3">Option 3</td>
                <td><?php if(isset($errors['answer'])) {?>
                    <p><span class="error"><?php echo $errors['answer'] ?></span></p>
                    <?php } ?>
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
   $("#quiz").change(function(){
        
              alert("event fired");
              window.location=location.href+ "?id=" +$("#quiz").val();
  
    });
  });
  </script>
</body>
</html>