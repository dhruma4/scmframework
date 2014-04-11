
<form action="" method="POST">
	<table align="center">
		
		<tr>
			<td><h4 align="center"><label><?php  echo $topic_details[0]['disc_ques_topic'];?></label></td>
		</tr>
		<tr><td><p><strong>Created by:</strong><?php echo $topic_details[0]['username'];?>&nbsp &nbsp &nbsp&nbsp<strong>Created on:</strong>  <?php echo $topic_details[0]['disc_quescreated'];?></p></td>
		</tr>
		<tr>
			<td><p align="center"><strong>Brief:</strong><?php  echo $topic_details[0]['disc_ques_brief'];?></p></td>
		</tr>
		<tr>
			<td><?php if(isset($errors['topic'])){ ?>
    			<p><span class="error"><?php echo $errors['topic'] ?></span></p>
    			<?php } ?>
    		</td>
    	</tr>

		<?php foreach($comments as $comment):?>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td><label><strong>Posted by:</strong><?php echo $comment['username'];?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<strong>Posted on:</strong> <?php echo $comment['comment_posted'];?></label></td>
		</tr>
		<tr>
			<td><p align="center"><label><?php echo $comment['comment_text'];?></label></p></td>
		</tr>
		
		<?php endforeach ?>
		<tr>
			<td><?php if(isset($errors['comments'])){ ?>
    			<p><span class="error"><?php echo $errors['comments'] ?></span></p>
    			<?php } ?>
    		</td>
    	</tr>
    	<tr>
    		<td><textarea  name="new_comment" id="new_comment" rows="4" cols="50" value="<?php echo $data_entered['new_comment'];?>"></textarea></td>
    	</tr>
    	<tr>
    		<td><label><?php echo $msg;?></label></td>
    	</tr>
    	<tr>
    		<td colspan=2 align="center"><input  type="submit" value="Post" name="post"></td>
    	</tr>
    </table>

</form>
