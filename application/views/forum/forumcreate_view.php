
<?php if($status=="" OR $status=="error"){ ?>
<form action="" method="POST">
    <table align="center" >
        
        <tr>
            <td><label><span class="error">*</span>Topic:</label></td>
            <td><input style="width:350px" type="text" name="topic" value="<?php echo $data_entered['topic']?>" id="topic"></td>
            <td><?php if(isset($errors['topic'])){ ?>
                <p><span class="error"><?php echo $errors['topic'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">*</span>Brief about the topic:</label></td>
            <td><textarea name="brief" id="brief" cols="45" rows="4" value="<?php echo $data_entered['brief']?>"></textarea></td>
            <td><?php if(isset($errors['brief'])){ ?>
                <p><span class="error"><?php echo $errors['brief'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan=2 align="center"><input type="submit" name="Post Topic" id="post"></td>
        </tr>
    </table>
</form>

<?php } ?>

<?php if($status=="posted"){ ?>

        <p>Your topic has been posted </p>
   
<?php } ?>
