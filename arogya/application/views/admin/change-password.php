<!DOCTYPE html>
<html lang="en">
<head>
  <title>Beg Builder's | Change Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= base_url('assets/images/logo.png'); ?>" type="image/gif" sizes="16x16">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <center><img src="<?= base_url('assets/img/logo.png'); ?>" height="150" ></center><br>
          <center><h4 class="modal-title" style="color: red;">Change Password</h4></center>
        </div>
        <div class="modal-body">
              <?php if($error=$this->session->flashdata('msg')): ?>
                  <div class="form-group">
                    <div class="alert alert-dismissible alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Sorry!</strong> <?php echo $error; ?>
                    </div>
                  </div>              
              <?php endif; ?>
            <?= form_open('real1/changePassword',['class'=>'form-horizontal','onsubmit'=>'return checkPass();']); ?>
            <?php $logged=$this->session->userdata('loggedBranch'); ?>
                <div class="form-group">
                  <div class="col-lg-12">
                    <span style="color: red;" class="glyphicon glyphicon-lock"> </span> <label>Old Password</label>
                    <input type="password" name="old_password" class="form-control" id="inputPassword" placeholder="Enter Your Password" required>
                    <?= form_error('password'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <label for="password"><span style="color: green;" class="glyphicon glyphicon-lock"></span> New Password: </label>
                    <input required name="new_password" type="password" class="form-control inputpass" placeholder="Enter new password" minlength="6" maxlength="50"  id="pass1" /> </p>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <label for="password"><span  style="color: green;"  class="glyphicon glyphicon-lock"></span> Password Confirm: </label>
                    <input required type="password" class="form-control inputpass" minlength="6" maxlength="50" placeholder="Enter again to validate"  id="pass2" onKeyUp="checkPass(); return false;" />
                        <span id="confirmMessage" class="confirmMessage"></span>
                  </div>
                </div>
        </div>
        <div class="modal-footer">
                <div class="form-group">
                <a href="<?=base_url(''); ?>" class="pull-left"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-home"></span> Back To Home</button></a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
        $("#myModal").modal('show');
});

            function checkPass() {
                //Store the password field objects into variables ...
                var pass1 = document.getElementById('pass1');
                var pass2 = document.getElementById('pass2');
                //Store the Confimation Message Object ...
                var message = document.getElementById('confirmMessage');
                //Set the colors we will be using ...
                var goodColor = "#66cc66";
                var badColor = "#ff6666";
                //Compare the values in the password field 
                //and the confirmation field
                if (pass1.value == pass2.value) {
                    //The passwords match. 
                    //Set the color to the good color and inform
                    //the user that they have entered the correct password 
                    pass2.style.backgroundColor = goodColor;
                    message.style.color = goodColor;
                    message.innerHTML = "Passwords Match"
                    return true;
                } else {
                    //The passwords do not match.
                    //Set the color to the bad color and
                    //notify the user.
                    pass2.style.backgroundColor = badColor;
                    message.style.color = badColor;
                    message.innerHTML = "Passwords Do Not Match!"
                    return false;
                }
            }
</script>

</body>
</html>
