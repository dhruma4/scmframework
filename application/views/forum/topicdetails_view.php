<html>
<head>
<style>
 .error {color:red;}
</style>
 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
</head>
<body>
<form action="" method="POST">
		<h2 align="center">Topic Details:</h2>
		<h3 align="center"><label><?php  echo $topic_details[0]['disc_ques_topic'];?></label></h3>&nbsp<h4 align="left">Created on: <?php echo $topic_details[0]['disc_quescreated'];?></h4>
		<p align="center"><?php  echo $topic_details[0]['disc_ques_brief'];?></p>
		<?php if(isset($errors['topic'])){ ?>
    	<p><span class="error"><?php echo $errors['topic'] ?></span></p>
    	<?php } ?>
   		<br></br>
		<hr>

		<?php foreach($comments as $comment):?>
		<label align="left">Posted on: <?php echo $comment['comment_posted'];?></label>
		<p align="center"><?php echo $comment['comment_text'];?></p>
		<hr>
		<?php endforeach ?>
		<?php if(isset($errors['comments'])){ ?>
    	<p><span class="error"><?php echo $errors['comments'] ?></span></p>
    	<?php } ?>

    	<textarea  name="comment" id="comment" rows="4" cols="50" value="<?php echo $data_entered['comment'];?>"></textarea><br>
    	<input  type="submit" value="Post" name="post"><br><br>

</form>
</body>
</html>