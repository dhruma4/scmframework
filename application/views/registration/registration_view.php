<?php 
if($status=="" OR $status=="error"){?>
<form action="" method="POST">
    <table  align="center">
        <tr> 
            <td colspan=2 align="center"><label><span class="error">'*' are required field.</span></label></td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Enrollment: </label></td>
            <td><input type="text" name="enroll" value="<?php echo $data_entered['enroll']?>"></td>
            <td><?php if(isset($errors['enroll'])) {?>
                <p><span class="error"><?php echo $errors['enroll'] ?></span></p>
                <?php } ?>
            </td>      
        </tr>
        <tr>
            <td><label><span class="error">* </span>Full Name: </label></td>
            <td><input type="text" name="name" value="<?php echo $data_entered['name']?>"></td>
            <td><?php if(isset($errors['name'])){?>
                <p><span class="error"><?php echo $errors['name'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr> 
            <td><label><span class="error">* </span>Semester: </label></td>
            <td><select name="sem" value="<?php echo $data_entered['sem']?>">
                <option value="" <?php if(empty($data_entered['sem'])) echo 'selected';?>>Select your semester</option>
                <?php
                for( $i=1; $i<=8; $i++)
                { ?>
                <option value="<?php echo $i; ?>" <?php if($data_entered['sem']==$i) echo 'selected'; ?>><?php echo $i; ?></option>
                <?php } ?>
                </select>
            </td>
            <td><?php if(isset($errors['sem'])){ ?>
                <p><span class="error"><?php echo $errors['sem'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Branch Name: </label></td>
            <td><select id="branch" name="branch" value="<?php echo $data_entered['branch']?>">
                <option value=""<?php if(empty($data_entered['branch'])) echo 'selected';?>>Select your branch</option>
                <?php foreach ($branches as $branch):?>
                <option value="<?php echo $branch['branch_name']?>" <?php if($branch['branch_name']==$data_entered['branch']) echo 'selected';?>><?php echo $branch['branch_name']?></option>
                <?php endforeach ?><br>
  	             </select>
            </td>
            <td><?php if(isset($errors['branch'])){ ?>
                <p><span class="error"><?php echo $errors['branch'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Date of Birth: </label></td>
            <td><input type="date" name="dob" value="<?php echo $data_entered['dob']?>"></td>
            <td><?php if(isset($errors['dob'])){ ?>
                <p><span class="error"><?php echo $errors['dob'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Address: </label></td>
            <td><textarea name="address" value="<?php echo $data_entered['address']?>" rows="3" cols="20"></textarea></td>
            <td><?php if(isset($errors['address'])){ ?>
                <p><span class="error"><?php echo $errors['address'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>State: </label></td>
            <td><select id="state" name="state" value="<?php echo $data_entered['state']?>">
                <option value="">Select your State</option>
                <?php foreach($states as $state): ?>
                <option value="<?php echo $state['state_id']?>" <?php if($state['state_id']==$data_entered['state']) echo 'selected';?>><?php echo $state['state_name']?></option>
                <?php endforeach ?>
                </select>
            </td>
            <td><?php if(isset($errors['state'])) {?>
                <p><span class="error"><?php echo $errors['state'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>City: </label></td>
            <td><select id="city" name="city" value="<?php echo $data_entered['city']?>">
                <option value="">Select your City</option>
                <?php foreach ($cities as $city): ?>
                <option value="<?php echo $city['city_id'] ?>" <?php if($city['city_id']==$data_entered['city']) echo 'selected';?>><?php echo $city['city_name'] ?></option>
                <?php endforeach ?> 
                </select>
            </td>
            <td><?php if(isset($errors['city'])){ ?>
                <p><span class="error"><?php echo $errors['city'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Contact number: </label></td>
            <td><input type="text" name="contact" value="<?php echo $data_entered['contact']?>"></td>
            <td><?php if(isset($errors['contact'])){?>
                <p><span class="error"><?php echo $errors['contact'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Email: </label></td>
            <td><input type="text" name="email" value="<?php echo $data_entered['email']?>"></td>
            <td><?php if(isset($errors['email'])){?>
                <p><span class="error"><?php echo $errors['email'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><label><span class="error">* </span>Login_id or Username:</label></td>
            <td><input type="text" name="login_id" value="<?php echo $data_entered['login_id'] ?>"></td>
            <td><?php if(isset($errors['login_id'])){ ?>
                <p><span class="error"><?php echo $errors['login_id'] ?></span></p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan=2 align="center"><input type="Submit" value="Submit"></td>
        </tr>
    </table>
</form>
    <script>
$(document).ready(function(){

      $("#state").change(function(){

       
        $.ajax({url:base_url+"index.php/ajax/get_city",
                data:{
                      'stateid':$('#state').val()
                      },
                type:'post',
                dataType:'json',
                success:function(result){
                console.log(result);
                      if(result.length>0){
                        $("#city").empty();
                        
                        }

                        for(i in result){
                          var cities=result[i];
                          $("#city").append('<option value="'+cities.city_id+'"">'+cities.city_name+'</option>')
                        }
    
                },
                error:function(data) {
                  console.log(data)
                }

              });
      });
  });
</script>
<?php } ?>
<?php 
if ($status=="success") {
?>
<h4 align="center"> Congratulations! You have registered successfully </h4>
<?php } ?>
