
<?php if($status=="" OR $status=="error") {?>
<form action="" method="POST">
    <table align="center">
        <tr>
            <td><label><span class="error">* </span>Select your role:</label></td>
            <td><select name="role" id="role" value="<?php echo $data_entered['role']?>">
                <option value="" <?php if(empty($data_entered['role'])) echo 'selected';?>>Select your role</option>
                <option value="admin" <?php if($data_entered['role']=="admin") echo 'selected'; ?>><?php echo "Admin" ?></option>
                <option value="branch moderator" <?php if($data_entered['role']=="branch moderator") echo 'selected'; ?>><?php echo "Branch Moderator" ?></option>
                <option value="faculty" <?php if($data_entered['role']=="faculty") echo 'selected'; ?>><?php echo "Faculty" ?></option>
                <option value="student" <?php if($data_entered['role']=="student") echo 'selected'; ?>><?php echo "Student" ?></option>
                </select>
            </td>
            <td><?php if(isset($errors['role'])){ ?>
                <p><span class="error"><?php echo $errors['role'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Username:</label></td>
            <td><input type="text" name="username" id="username" value="<?php echo $data_entered['username'];?>" ></td>
            <td><?php if(isset($errors['username'])){ ?>
                <p><span class="error"><?php echo $errors['username'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Password:</label></td>
            <td><input type="password" name="password" id="password" value="<?php echo $data_entered['password'];?>" ></td>
            <td><?php if(isset($errors['password'])){ ?>
                <p><span class="error"><?php echo $errors['password'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan=2 align="center"><input type="submit" value="login" name="log_in">&nbsp &nbsp<a href="<?php echo site_url()."/authorization/forgot_password";?>">Forgot password?</a></td>
        </tr> 
    </table>       
</form>
<?php } ?>
<?php if($logged_in==true){?>
<?php if($status=="ask_security_ques"){?>
<form action="" method="POST">
    <table  align="center">
        <tr>
            <td colspan=2 align="center"><h3>Select a security question for security purpose:</h3></td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Security question:</label></td>
        </tr>
        <tr>
            <td><select id="sec_ques" name="sec_ques" value="<?php echo $data_entered['sec_ques']?>">
                    <option value=""<?php if(empty($data_entered['sec_ques'])) echo 'selected';?>>Select your question</option>
                    <?php foreach ($questions as $question):?>
                    <option value="<?php echo $question['security_ques']?>" <?php if($question['sec_ques_id']==$data_entered['sec_ques']) echo 'selected';?>><?php echo $question['security_ques']?></option>
                    <?php endforeach ?>
            </td>
            <td><?php if(isset($errors['sec_ques'])){ ?>
                    <p><span class="error"><?php echo $errors['sec_ques'] ?></span></p>
                    <?php } ?>
            </td>
        </tr> 
        <tr>
            <td><label><span class="error">* </span>Security answer:</label></td>
        </tr>
        <tr>
            <td><input type="text" name="sec_ans" id="sec_ans" value="<?php echo $data_entered['sec_ans'];?>"></td>
            <td align="left"><?php if(isset($errors['sec_ans'])){ ?>
                    <p><span class="error"><?php echo $errors['sec_ans'] ?></span></p>
                    <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan=2 align="center"><input type="submit" value="Submit" name="sec-ques-submit"></td>
        </tr>

    </table>
</form>
<?php } ?>
<?php } ?>
<?php if($status=="sec_ques_inserted"){?>
<p>You have successfuly completed the security step.</p>
<?php }?>
<?php if($status=="verified"){ ?>
<p> Verified user </p>
<?php } ?>
