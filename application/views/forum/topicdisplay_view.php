
<?php ?>
	 
		
		
		<table  align="center">
			<tr>
				<td><label><b>Name of Topic</b> </label></td>
				<td><label><b>Created by </b></label></td>
				<td><label><b>Created on </b></label></td>
			</tr>

			 
			<?php foreach($topics as $topic): ?>
			<tr>
				<td><a href="<?php echo site_url()."/forum/topic_details/".$topic['disc_ques_id']; ?>"><?php echo $topic['disc_ques_topic'];?></a></td>
				<td><?php echo $topic['username']; ?></td>
				<td><?php echo $topic['disc_quescreated']; ?></td>
			</tr>
			
			<?php endforeach ?>
		</table>
