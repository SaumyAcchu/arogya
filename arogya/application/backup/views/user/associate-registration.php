<!DOCTYPE html>
<html>
<head>
  <title><?=$this->siteInfo['name'];?></title>
  <?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
    <div class="container-fluid no-padding display-table">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 no-padding hidden-xs display-table-cell v-align box" id="navigation">
            <?php $this->load->view('includes/sidebar.php',['page'=>'associate-registration']); ?>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php $this->load->view('includes/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="container-fluid no-padding main-container">
            <div class="title txtcenter">
            <h4>Associate Registration</h4>
          </div>
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  <!-- ///=====================All Contents Start Here============= //-->
    
      <div class="jumbotron">
      <?= form_open_multipart('login/registration/sub',['class'=>'form-horizontal','name'=>'myform','id'=>'regForm']); ?>
      
        <legend>Sponcer Details</legend>
        <b>Note: </b><label class="txtblue"><span>*</span> Fields are required.</label>
        <?php if(isset($sponcer_data)) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Sponcer ID<span>*</span></label>
            <div class="col-sm-4">
                <input type="text" onchange="return countSponcer()" value="<?=$sponcer_data['user_id']; ?>" name="sponcer_id" class="form-control txtupper noSpace" id="sponcer_id" placeholder="Enter Sponcer ID" required>
                <span id="err_sponcer"></span>
            </div>
            <label class="col-sm-2 control-label">Sponcer Name</label>
            <div class="col-sm-4">
                <input type="text" value="<?=$sponcer_data['name']; ?>" id="sponcer_name" class="form-control" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Select Level<span>*</span></label>
            <div class="col-sm-4">
              <?php $lvl = $this->dbm->getData('level'); ?>
                <select class="form-control" required="" name="level" id="">
                
                  <?php foreach ($lvl as $key => $value) { ?>
                    <?php if ($value['level']==1): ?>
                      
                  <option value="<?=$value['level'];?>" <?=($value['level']==$sponcer_data['level'])?'selected':'';?>><?=$value['name'];?></option>
                    <?php endif ?>
                  <?php } ?>
                </select>
            </div>
        </div>
        <?php }else{ ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Sponcer ID<span>*</span></label>
            <div class="col-sm-4">
                <input type="text" onchange="return countSponcer()" value="<?= set_value('sponcer_id'); ?>" name="sponcer_id" class="form-control txtupper noSpace" id="sponcer_id" placeholder="Enter Sponcer ID" required>
                <span id="err_sponcer"></span>
            </div>
            <label class="col-sm-2 control-label">Sponcer Name</label>
            <div class="col-sm-4">
                <input type="text" value="" id="sponcer_name" class="form-control" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Select Level</label>
            <?php $lvl = $this->dbm->getData('level'); ?>
            <div class="col-sm-4">
                <select class="form-control" required="" name="level" id="">
                 
                  <?php foreach ($lvl as $key => $value) { ?>
                    <?php if ($value['level']==1): ?>
                      
                  <option value="<?=$value['level'];?>"><?=$value['name'];?></option>
                    <?php endif ?>
                  <?php } ?>
                </select>
            </div>
        </div>
        <?php } ?>
        
        <legend style="margin-top: 10px;">Member Detail</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">Name<span>*</span></label>
            <div class="col-sm-3">
                <input type="text" value="<?= set_value('name'); ?>" name="name" class="form-control" id="name" placeholder="Enter Applicants First Name" required>
                <span id="err_name"></span>
            </div>
            <div class="col-sm-3">
                <input type="text" value="<?= set_value('m_name'); ?>" name="m_name" class="form-control" id="m_name" placeholder="Enter Applicants Middle Name">
                <span id="err_mname"></span>
            </div>
            <div class="col-sm-3">
                <input type="text" value="<?= set_value('l_name'); ?>" name="l_name" class="form-control" id="l_name" placeholder="Enter Applicants Last Name" >
                <span id="err_lname"></span>
            </div>
           
        </div>

        <div class="form-group">
           <label class="col-sm-2 control-label">Father/Husband Name</label>
            <div class="col-sm-4">
                <input type="text" value="<?= set_value('fname'); ?>" name="fname" class="form-control" id="fname" placeholder="Enter Father/Husband Name">
                <span id="err_fname"></span>
            </div>

          <label class="col-sm-2 control-label">Date of Birth</label>
            <div class="col-sm-4">
                <span id="datepairExample">
                  <input type="text" value="<?= set_value('dob'); ?>" name="dob" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                </span>
            </div>
            
        </div>

        <!-- <div class="form-group">
            <label class="col-sm-2 control-label">Password<span>*</span></label>
            <div class="col-sm-4">
                <input type="password" value="<?= set_value('password'); ?>" class="form-control noSpace" name="password" id="pass1" placeholder="Please Enter Password" readonly>
                <span id="err_password"></span>
            </div>
            <label class="col-sm-2 control-label">Repeat Password<span>*</span></label>
            <div class="col-sm-4">
                <input type="password" onKeyUp="checkPass(); return false;" value="<?= set_value('password'); ?>" class="form-control noSpace" name="password2" id="pass2" placeholder="Please Enter Password" readonly>
                <span id="confirmMessage"></span>
            </div>
        </div>
        <div class="form-group">
           <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-3"> <input type="button" class="btn btn-success" value="Generate Password" onClick="generate();" ></div>
        </div> -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Email Id</label>
            <div class="col-sm-4">
                <input type="email" value="<?= set_value('email'); ?>" class="form-control noSpace" name="email" id="email" placeholder="Email ID">
                <span id="err_email"></span>
            </div>
           <!--  <label class="col-sm-2 control-label">Address</label>
            <div class="col-sm-4">
                <textarea class="form-control" value="" name="address" rows="2" id="address" placeholder="Enter Your Adderss"><?= set_value('address'); ?></textarea>
            </div> -->
        </div>
        <div class="form-group">
         <label class="col-sm-2 control-label">Address</label>
         <div class="col-sm-4">
             <input type="text" value="" class="form-control" name="location" placeholder="Location" required>
               <span id="err_city"></span>
         </div>

          <label class="col-sm-2 control-label">City</label>
           <div class="col-sm-4">
               <input type="text" value="" class="form-control noSpace" name="city" id="city" placeholder="City Name" required>
               <span id="err_city"></span>
           </div>
        </div>

        <div class="form-group">

          <label class="col-sm-2 control-label">State</label>
          <div class="col-sm-4">
               <input type="text" value="" class="form-control" name="state" id="state" placeholder="Enter State" required>
               <span id="err_state"></span>
           </div>

          <label class="col-sm-2 control-label">Pin Number<span>*</span></label>
           <div class="col-sm-4">
               <input type="text" maxlength="6" value="" class="form-control noSpace" name="pin" id="pin" placeholder="Pin No.">
               <span id="err_city"></span>
           </div>
          
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Mobile Number<span>*</span></label>
            <div class="col-sm-4">
                <input type="number" value="<?= set_value('mobile'); ?>" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required>
                <span id="err_mobile"></span>
            </div>
        </div>

        <legend>Nomini Detail's</legend>
        <div class="form-group">
          <div class="col-sm-4">
            <label>Nomini Name</label>
            <input type="text" name="nomini_name" value="<?= set_value('nomini_name'); ?>" class="form-control" id="nomini_name" placeholder="Nomini Name">
          </div>
          <div class="col-sm-4">
            <label>Nomini Relation</label>
            <input type="text" name="nomini_rel" value="<?= set_value('nomini_rel'); ?>" class="form-control" id="nomini_rel" placeholder="Nomini Relation">
          </div>
          <div class="col-sm-4">
            <label>Nomini Age</label>
            <input type="number" name="nomini_name" value="<?= set_value('nomini_age'); ?>" class="form-control" id="nomini_age" placeholder="Nomini Age">
          </div>
        </div>

        <legend>Other Detail's</legend>
        <div class="form-group">
          <label class="col-sm-2 control-label">Adhar No.</label>
            <div class="col-sm-4">
              <input type="number" name="adhar" value="<?= set_value('adhar'); ?>" class="form-control noSpace" id="adhar" placeholder="ADHAR Number">
            </div>
          <!--   <label class="col-sm-2 control-label">PAN Number</label>
            <div class="col-sm-4">
              <input type="text" name="pan" value="<?= set_value('pan'); ?>" class="form-control noSpace" id="pan" placeholder="PAN Number">
              <span id="err_pan"></span>
            </div> -->

        </div>
 <div class="form-group">
                    <label class="col-sm-2 control-label"> PAN Number</label>
              <div class="col-sm-4">
                    <div class="onoffswitch1">
                      <input type="checkbox" value="yes" class="onoffswitch1-checkbox" id="myonoffswitch1">
                      <label class="onoffswitch1-label" for="myonoffswitch1">
                          <span class="onoffswitch1-inner"></span>
                          <span class="onoffswitch1-switch"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-6" id="emiMonth"> </div>
 </div>
        <legend>Bank Detail's</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">Account Number</label>
            <div class="col-sm-4">
              <input type="text" name="account_number" value="<?= set_value('account_number'); ?>" class="form-control" id="account_number" placeholder="A/C Number">
            </div>
            <label class="col-sm-2 control-label">Bank Name</label>
            <div class="col-sm-4">
              <input type="text" value="<?= set_value('bank_name'); ?>" name="bank_name" class="form-control" placeholder="Enter Bank Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Branch Name</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="branch_name" id="branch_name" value="<?= set_value('branch_name'); ?>" placeholder="Branch name">
            </div>
            <label class="col-sm-2 control-label">IFSC Code</label>
            <div class="col-sm-4">
              <input type="text" value="<?= set_value('ifsc'); ?>" name="ifsc" class="form-control" id="ifsc" placeholder="IFSC Code">
            </div>
        </div>
        <legend>Upload Photo</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">Choose Photo:</label>
            <div class="col-sm-4">
              <input type="file" accept="image" name="image" id="image_path" class="form-control image_path">
                <span id="imageError" style="color: red;"></span>
               <?php if(isset($file_error)) { echo $file_error; } ?>
            </div>
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
              <img src="" style="display: none;" id="blah" height="100" width="100">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" onclick="return checkValid()" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
      </div>
   
          
          <!-- All Content End here -->
          </div>
        </div>
      </div>
    </div>
</body>
<?php $this->load->view('includes/footer.php'); ?>
<style type="text/css">
  body{
    /*background-image: url(<?=base_url('assets/images/texturebg.jpg');?>);*/
    background-attachment: fixed;
    background-color: #00612e;
background-image: url("https://www.transparenttextures.com/patterns/paven.png");
/* This is mostly intended for prototyping; please download the pattern and re-host for production environments. Thank you! */
  }
  .jumbotron{
    margin-top: 30px;
  }
  legend{
    border-bottom: 1px solid grey;
  }
  label{
    font-weight: normal;
  }
  #regForm span{
    color: red;
  }
  #regForm label{
    font-size: 14px;
  }
</style>

<script type="text/javascript">
  $('#mobile').keypress(function(event){
             console.log(event.which);
         if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
             event.preventDefault();
         }});

  $('#adhar').keypress(function(event){
             console.log(event.which);
         if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
             event.preventDefault();
         }});
  $('#account_number').keypress(function(event){
             console.log(event.which);
         if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
             event.preventDefault();
         }});

  $('#pin').keypress(function(event){
             console.log(event.which);
         if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
             event.preventDefault();
         }});

  
</script>

<script type="text/javascript">

  $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });

  function countSponcer(){
    var sponcerID=$('#sponcer_id').val();
    $.ajax({
      url:"<?=base_url('login/countSponcer');?>",
      type:'post',
      data:{id:sponcerID},
      success:function(data)
      {
          var arr=JSON.parse(data);
          if(arr['status']==0)
          {
            $('#submit').prop('disabled',true);
            $('#err_sponcer').html(arr['msg']);
            return false;
          }else
          {
              $('#submit').prop('disabled',false);
              $('#err_sponcer').html('');
              $('#place').html(arr['place']);
              $('#sponcer_name').val(arr['name']);
              return true;
          }
      }
    });
  }
  $('.noSpace').keyup(function(){
    str = $(this).val()
    str = str.replace(/\s/g,'')
    $(this).val(str)
});

  function checkValid()
  {
    var pass1 = document.getElementById('pass1');
        var pass2 = document.getElementById('pass2');
        var name=$('#name').val();
        var pass=$('#pass1').val();
        var sponcer_id=$('#sponcer_id').val();
        var mobile=$('#mobile').val();
        //var email=$('#email').val();
        var pin=$('#pin').val();
        var pan=$('#pan').val();
        if($.trim(sponcer_id)=='')
    {
      $('#err_sponcer').html('Sponcer ID is Required');
      return false;
    }
    if($.trim(pin)!='')
    {
      checkPin(pin);
    }
    if($.trim(name)=='')
    {
      $('#err_name').html('Name is Required');
      return false;
    }
    if($.trim(mobile)=='')
    {
      $('#err_mobile').html('Mobile Number is Required');
      return false;
    }
    if((pass.length)<6)
    {
      $('#err_password').html('Password Must be Equal or Greater than 6 Characters');
      return false;
    }
    if(pass1.value != pass2.value)
    {
      $('#confirmMessage').html('Password Not Matched');
      return false;
    }
    // if($.trim(email)=='')
    // {
    //  $('#err_email').html('Email ID is Required');
    //  return false;
    // }
    if($.trim(pan)!='')
    {
      checkPan(pan);
    }

    countSponcer();

    var img=imageValidation();
    if(img)
    {
      return true;
    }else 
    {
      return false;
    }
  }
  function checkPan(pan)
  {
    var pan=$('#pan').val();
    $.ajax({
      url:"<?=base_url('login/checkPan');?>",
      data:{pan:pan},
      type:'post',
      success:function(data)
      {
        if(data>0)
        {
          $('#err_pan').html('');
          return true;
        }else
        {
          $('#err_pan').html('This PAN Is Already userd');
          return false;
        }
      }
    });
  }
  function checkPin(pin)
  {
    var pin=$('#pin').val();
    if($.trim(pin)!='')
    {
      $.ajax({
        url:"<?=base_url('login/checkPin');?>",
        data:{pin:pin},
        type:'post',
        success:function(data){
          if(data>0)
          {
            $('#submit').prop('disabled',false);
            $('#err_pin').html('');
            return true;
          }else
          {
            $('#err_pin').html('You have entered a wrong Pin');
            $('#submit').prop('disabled',true);
            return false;
          }
        }
      });
    }else
    {
      $('#submit').prop('disabled',false);
      $('#err_pin').html('');
    }
  }
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
    function readURL(input) {
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#blah').css('display','block');
        $('#blah').attr('src', e.target.result);
    }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".image_path").change(function(){
    readURL(this);
});
function imageValidation()
  {
    var img_size=$("#image_path")[0].files[0].size;
    //alert(img_size); return false;
    if(img_size>250000)
    {
      $("#imageError").html('Image size must be less than 200KB');
      return false;
    }else {return true;}
  }
  $('#backbtn').click(function(){
    window.history.back();
  });

  $('#product').change(function(){
    var pro=$('#product').val();
    if(pro=='T-Shirt')
    {
      $('#proSize').html('<select class="form-control" name="size" id="size" required><option value="">Please Select Size</option><option value="Small">Small</option><option value="Medium">Medium</option><option value="Large">Large</option><option value="X-Large">X-Large</option></select>');
      $('#t-name').html('Select Size');
    }else
    {
      $('#proSize').html('');
      $('#t-name').html('');
    }

  });

  $('#pan').change(function(){
  var pan=$("#pan").val();
  var chkpan = /^([A-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
  if(pan=='')
  {
    $("#err_pan").html("");
  }else
  {
    if(chkpan.test(pan)==false)
    { 
      $("#err_pan").html("PAN Number format is wrong");
      return false;
    }else
    {
      return true;
    }
  }
  
});

</script>

<script type="text/javascript">
  function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function generate() {
  var p_pass = randomPassword(8);
    myform.password.value = p_pass;
    myform.password2.value = p_pass;
}
</script>




<script type="text/javascript">

  $('#myonoffswitch1').change(function(){
  var chkd=$('#myonoffswitch1:checked').val();
  if(chkd=='yes')
  {
    $('#emiMonth').html('<label class="col-sm-4 control-label">PAN Number</label><div class="col-sm-8"><input type="text" name="pan" value="<?= set_value('pan'); ?>" class="form-control noSpace" id="pan" placeholder="PAN Number" required><span id="err_pan"></span></div>');
  }else
  {
    $('#emiMonth').html('');
  }
});
</script>

<style type="text/css">
  .onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}

.onoffswitch-checkbox {
    display: none;
}

.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}

.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}

.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}

.onoffswitch-inner:before {
    content: "YES";
    padding-left: 10px;
    background-color: #2FCCFF; color: #FFFFFF;
}

.onoffswitch-inner:after {
    content: "NO";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}

.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    border: 2px solid #999999; border-radius: 20px;
    position: absolute; top: 0; bottom: 0; right: 56px;
    -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
    -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s; 
}

.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}

.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}


 .onoffswitch1 {
    position: relative; width: 130px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}

.onoffswitch1-checkbox {
    display: none;
}

.onoffswitch1-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 30px;
}

.onoffswitch1-inner {
    display: block; width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}

.onoffswitch1-inner:before, .onoffswitch1-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
    border-radius: 30px;
    box-shadow: 0px 15px 0px rgba(0,0,0,0.08) inset;
}

.onoffswitch1-inner:before {
    content: "Yes";
    padding-left: 10px;
    background-color: darkgreen; color: #FFFFFF;
    border-radius: 30px 0 0 30px;
}

.onoffswitch1-inner:after {
    content: "No";
    padding-right: 10px;
    background-color: darkred; color: #fff;
    text-align: right;
    border-radius: 0 30px 30px 0;
}

.onoffswitch1-switch {
    display: block; width: 90px; margin: 0px;
    background: #FFFFFF;
    border: 2px solid #999999; border-radius: 30px;
    position: absolute; top: 0; bottom: 0; right: 40px;
    -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
    -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s; 
    background-image: -moz-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 80%); 
    background-image: -webkit-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 80%); 
    background-image: -o-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 80%); 
    background-image: linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 80%);
    box-shadow: 0 1px 1px white inset;
}

.onoffswitch1-checkbox:checked + .onoffswitch1-label .onoffswitch1-inner {
    margin-left: 0;
}

.onoffswitch1-checkbox:checked + .onoffswitch1-label .onoffswitch1-switch {
    right: 0px; 
}



.cmn-toggle 
{
  position: absolute;
  margin-left: -9999px;
  visibility: hidden;
}

.cmn-toggle + label 
{
  display: block;
  position: relative;
  cursor: pointer;
  outline: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

input.cmn-toggle-round-flat + label 
{
  padding: 2px;
  width: 75px;
  height: 30px;
  background-color: #dddddd;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
  -webkit-transition: background 0.4s;
  -moz-transition: background 0.4s;
  -o-transition: background 0.4s;
  transition: background 0.4s;
}

input.cmn-toggle-round-flat + label:before, input.cmn-toggle-round-flat + label:after 
{
  display: block;
  position: absolute;
  content: "";
}

input.cmn-toggle-round-flat + label:before 
{
  top: 2px;
  left: 2px;
  bottom: 2px;
  right: 2px;
  background-color: #fff;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
  -webkit-transition: background 0.4s;
  -moz-transition: background 0.4s;
  -o-transition: background 0.4s;
  transition: background 0.4s;
}

input.cmn-toggle-round-flat + label:after 
{
  top: 4px;
  left: 4px;
  bottom: 4px;
  width: 22px;
  background-color: #dddddd;
  -webkit-border-radius: 52px;
  -moz-border-radius: 52px;
  -ms-border-radius: 52px;
  -o-border-radius: 52px;
  border-radius: 52px;
  -webkit-transition: margin 0.4s, background 0.4s;
  -moz-transition: margin 0.4s, background 0.4s;
  -o-transition: margin 0.4s, background 0.4s;
  transition: margin 0.4s, background 0.4s;
}

input.cmn-toggle-round-flat:checked + label 
{
  background-color: #27A1CA;
}

input.cmn-toggle-round-flat:checked + label:after 
{
  margin-left: 45px;
  background-color: #27A1CA;
}

div.switch5 { clear: both; margin: 0px 0px; }
div.switch5 > input.switch:empty { margin-left: -999px; }
div.switch5 > input.switch:empty ~ label { position: relative; float: left; line-height: 1.6em; text-indent: 4em; margin: 0.2em 0px; cursor: pointer; -moz-user-select: none; }
div.switch5 > input.switch:empty ~ label:before, input.switch:empty ~ label:after { position: absolute; display: block; top: 0px; bottom: 0px; left: 0px; content: "off"; width: 3.6em; height: 1.5em; text-indent: 2.4em; color: rgb(153, 0, 0); background-color: rgb(204, 51, 51); border-radius: 0.3em; box-shadow: 0px 0.2em 0px rgba(0, 0, 0, 0.3) inset; }
div.switch5 > input.switch:empty ~ label:after { content: " "; width: 1.4em; height: 1.5em; top: 0.1em; bottom: 0.1em; text-align: center; text-indent: 0px; margin-left: 0.1em; color: rgb(255, 136, 136); background-color: rgb(255, 255, 255); border-radius: 0.15em; box-shadow: 0px -0.2em 0px rgba(0, 0, 0, 0.2) inset; transition: all 100ms ease-in 0s; }
div.switch5 > input.switch:checked ~ label:before { content: "on"; text-indent: 0.5em; color: rgb(102, 255, 102); background-color: rgb(51, 153, 51); }
div.switch5 > input.switch:checked ~ label:after { margin-left: 2.1em; color: rgb(102, 204, 102); }
div.switch5 > input.switch:focus ~ label { color: rgb(0, 0, 0); }
div.switch5 > input.switch:focus ~ label:before { box-shadow: 0px 0px 0px 3px rgb(153, 153, 153); }







.switch6 {  max-width: 17em;  margin: 0 auto; }
.switch6-light > span, .switch-toggle > span {  color: #000000; }
.switch6-light span span, .switch6-light label, .switch-toggle span span, .switch-toggle label {  color: #2b2b2b; }

.switch-toggle a, 
.switch6-light span span { display: none; }

.switch6-light { display: block; height: 30px; position: relative; overflow: visible; padding: 0px; margin-left:0px; }
.switch6-light * { box-sizing: border-box; }
.switch6-light a { display: block; transition: all 0.3s ease-out 0s; }

.switch6-light label, 
.switch6-light > span { line-height: 30px; vertical-align: middle;}

.switch6-light label {font-weight: 700; margin-bottom: px; max-width: 100%;}

.switch6-light input:focus ~ a, .switch6-light input:focus + label { outline: 1px dotted rgb(136, 136, 136); }
.switch6-light input { position: absolute; opacity: 0; z-index: 5; }
.switch6-light input:checked ~ a { right: 0%; }
.switch6-light > span { position: absolute; left: -100px; width: 100%; margin: 0px; padding-right: 100px; text-align: left; }
.switch6-light > span span { position: absolute; top: 0px; left: 0px; z-index: 5; display: block; width: 50%; margin-left: 100px; text-align: center; }
.switch6-light > span span:last-child { left: 50%; }
.switch6-light a { position: absolute; right: 50%; top: 0px; z-index: 4; display: block; width: 50%; height: 100%; padding: 0px; }





</style>