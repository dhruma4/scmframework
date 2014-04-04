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
	<p><h2>Welcome for registration.</h2></p><br>
  <?php  /*
  if((count($errors))>0){
    echo "Please fill up the following";
    echo "";
    }
*/?>
        <table style="width:600px" align="center">
            <tr>
                <td colspan=2 align="center"><label><span class="error">'*' are required field.</span></label></td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>Name: </label></td>
                <td><input type="text" name="name" value="<?php echo $data_entered['name']?>"></td>
                <td><?php if(isset($errors['name'])){?>
                    <label><span class="error"><p><?php echo $errors['name'] ?></p></span>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>Branch Name: </label></td>
                <td><select name="branch" id="branch">
                    <option value="">Select your branch</option>
                    <?php foreach ($branches as $branch):?>
                    <option value="<?php echo $branch['branch_id']?>"<?php if($branch['branch_id']==$data_entered['branch']) echo 'selected';?>><?php echo $branch['branch_name']?></option>
                    <?php endforeach ?>
                    </select>
                </td>
                <td><?php if(isset($errors['branch'])){ ?>
                    <label><span class="error"><p><?php echo $errors['branch'] ?></p></span>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><label><span class="error">* </span>Designation: </label></td>
                <td><select name="designation" id="designation">
                    <option value="">Select your designation</option>
                    <?php foreach($designations as $designation): ?>
                    <option value="<?php echo $designation['designation_id']?>" <?php if($designation['designation_id']==$data_entered['designation']) echo 'selected';?>><?php echo $designation['designation']?></option>
                    <?php endforeach ?> 
                    </select>
                </td>
                <td><?php if(isset($errors['designation'])){ ?>
                    <p> <span class="error"><?php echo $errors['designation'] ?> </span></p>
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
                <td><select name="state" id="state">
                    <option value="">Select your state</option>
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
                <td><select name="city" id="city">
                    <option value="">Select your city</option>
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
                <td><input type="text" name="login_id" value="<?php echo $data_entered['login_id']?>"></td>
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

       //alert($(this).val());
        $.ajax({url:"http://localhost/scmframework/index.php/ajax/get_city",
                data:{
                      'stateid':$('#state').val()
                      },
                type:'post',
                dataType:'json',
                success:function(result){
                console.log(result);
                      if(result.length>0){
                        $("#city").empty();
                        //alert("The list is emptied");
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
<h3 align="center"> Congratulations! You have registered successfully </h3>
<?php } ?>
</body>
</html>