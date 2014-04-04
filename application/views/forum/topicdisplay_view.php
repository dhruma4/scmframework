<html>
<head>
<style>
.error {color:red;}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
  
</head>
<body>
<?php ?>
	 
		<h2 align="center"> List of Topics:</h2>
		<hr>
		<table  border="2" style="width:1000px" align="center">
			<tr>
				<td><label><b>Name of Topic</b> </label></td>
				<td><label><b>Created by </b></label></td>
				<td><label><b>Created on </b></label></td>
			</tr>

			
			<?php foreach($topics as $topic): ?>
			<tr>
				<td><a href="<?php echo site_url()."/forum/topic_details/".$topic['disc_ques_id']; ?>"><?php echo $topic['disc_ques_topic'];?></a></td>
				<td><?php echo $topic['ask_id']; ?></td>
				<td><?php echo $topic['disc_quescreated']; ?></td>
			</tr>
			
			<?php endforeach ?>
		</table>

	

<?php /* 
<?php if($status=="topic_details"){?>
	<form action="" method="POST">
		<h2 align="center">Topic Details:</h2>
		<h3 align="center"><label><?php  echo $topic_details['disc_ques_topic'];?></label></h3>&nbsp<h4 align="left">Time:<?php echo $topic_details['disc_quescreated'];?></h4>
		<p align="center"><?php  echo $topic_details['disc_ques_brief'];?></p>
		<hr>

		<?php foreach($comments as $comment):?>
		<label align="left">Posted on: <?php echo $comment['comment_posted'];?></label>
		<p align="center"><?php echo $comment['comment_text'];?></p>
		<hr>
		<?php endforeach ?>

	</form>
<?php } ?>

*/ ?>
</body>
</html>