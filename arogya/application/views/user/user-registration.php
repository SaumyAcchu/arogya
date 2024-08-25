<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<?php $this->load->view('include/header');?>
</head>
<body>
	<div class="container-fluid">
		<div class="col-sm-10 col-sm-offset-1" style="margin-top: 30px;">
			<div class="jumbotron" id="jumbo">
			<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
			<!-- ///Flash Message End/// -->
			<div class="row">
				<div class="col-sm-2">
					<center><img src="<?=base_url('uploads/'.$this->siteInfo['image']); ?>" class="img-responsive logo"></center>
				</div>
				<div class="col-sm-10">
					<center>
					<h3><?=$this->siteInfo['name'];?></h3>
		          	<button class="btn btn-primary btn-xs" id="backbtn"><i class="fa fa-home"></i> Back to Home</button><br><br>
		          	<label class="txtblue">New User Rgistration</label>
		          	</center>
				</div>
			</div>
			<?= form_open_multipart('login/registration/sub',['class'=>'form-horizontal']); ?>
			    
			    	<div class="form-group">
				    <div class="col-sm-4">
				    <p style="text-align:center; border-style: groove;"> Sponcer Details</p>
				    </div>
				    <div class="col-sm-8">
				      <hr style="border-top: 1px solid;">
				    </div>
				</div>
		
				<!--<legend>Sponcer Details</legend>-->
				<b>Note: </b><label class="txtblue"><span>*</span> Fields are required.</label>
				<?php if(isset($sponcer_data)) { ?>
				<div class="form-group">
				    <label class="col-sm-2 control-label">Sponcer ID<span>*</span></label>
				    <div class="col-sm-4">
				        <input type="text" value="<?=$sponcer_data['user_id']; ?>" name="sponcer_id" class="form-control txtupper noSpace" id="sponcer_id" placeholder="Enter Sponcer ID" required>
				        <span id="err_sponcer"></span>
				    </div>
				    <label class="col-sm-2 control-label">Sponcer Name</label>
				    <div class="col-sm-4">
				        <input type="text" value="<?=$sponcer_data['name']; ?>" id="sponcer_name" class="form-control" readonly="">
				    </div>
				</div>
				<?php }else{ ?>
				<div class="form-group">
				    <label class="col-sm-2 control-label">Sponcer ID<span>*</span></label>
				    <div class="col-sm-4">
				        <input type="text" value="<?= set_value('sponcer_id'); ?>" name="sponcer_id" class="form-control txtupper noSpace" id="sponcer_id" placeholder="Enter Sponcer ID" required>
				        <span id="err_sponcer"></span>
				    </div>
				    <label class="col-sm-2 control-label">Sponcer Name</label>
				    <div class="col-sm-4">
				        <input type="text" value="" id="sponcer_name" class="form-control" readonly="">
				    </div>
				</div>
				<?php } ?>
				
				<div class="form-group">
				    <label class="col-sm-2 control-label">Select Product</label>
				    <div class="col-sm-4">
				        <select class="form-control" name="product" id="product" required>
				        	<option value="">Please Select Product</option>
				        	<?php $product = $this->db->get_where('base_plan')->result_array(); ?>
				        	<?php foreach ($product as $key => $value) { ?>
				        		<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
				        	<?php } ?>
				        </select>
					</div>
					<label class="col-sm-2 control-label">ID Placement</label>
				    <div class="col-sm-4">
				        <select class="form-control" name="place"  required>
				        	<option value="">Please Select Position</option>
				        	<option value="Left">Left</option>
				        	<option value="Right">Right</option>
				        </select>
					</div>
				</div>
				
				<div class="form-group">
				    <div class="col-sm-4">
				    <p style="text-align:center; border-style: groove;"> Member Detail</p>
				    </div>
				    <div class="col-sm-8">
				      <hr style="border-top: 1px solid;">
				    </div>
				</div>

				<!--<legend style="margin-top: 10px;">Member Detail</legend>-->
				<div class="form-group">
				    <label class="col-sm-2 control-label">Full Name<span>*</span></label>
				    <div class="col-sm-4">
				        <input type="text" value="<?= set_value('name'); ?>" name="name" class="form-control" id="name" placeholder="Enter Applicants Name" required>
				        <span id="err_name"></span>
				    </div>
				    <label class="col-sm-2 control-label">Father/Husband Name<span>*</span></label>
				    <div class="col-sm-4">
				        <input type="text" value="<?= set_value('fname'); ?>" name="fname" class="form-control" id="fname" placeholder="Enter Father/Husband Name">
				        <span id="err_fname"></span>
				    </div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Date of Birth</label>
				    <div class="col-sm-4">
				        <span id="datepairExample">
				        	<input type="text" value="<?= set_value('dob'); ?>" name="dob" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy">
				        </span>
				    </div>
				    <label class="col-sm-2 control-label">Mobile Number<span>*</span></label>
				    <div class="col-sm-4">
				        <input type="number" value="<?= set_value('mobile'); ?>" class="form-control noSpace" name="mobile" id="mobile" placeholder="Mobile Number" required>
				        <span id="err_mobile"></span>
				    </div>
				</div>

				<div class="form-group">
				    <label class="col-sm-2 control-label">Password<span>*</span></label>
				    <div class="col-sm-4">
				        <input type="password" value="<?= set_value('password'); ?>" class="form-control noSpace" name="password" id="pass1" placeholder="Please Enter Password">
				        <span id="err_password"></span>
				    </div>
				    <label class="col-sm-2 control-label">Repeat Password<span>*</span></label>
				    <div class="col-sm-4">
				        <input type="password" onKeyUp="checkPass(); return false;" value="<?= set_value('password'); ?>" class="form-control noSpace" name="" id="pass2" placeholder="Please Enter Password">
				        <span id="confirmMessage"></span>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Email Id<span>*</span></label>
				    <div class="col-sm-4">
				        <input type="email" value="<?= set_value('email'); ?>" class="form-control noSpace" name="email" id="email" placeholder="Email ID">
				        <span id="err_email"></span>
				    </div>
				    <label class="col-sm-2 control-label">Address</label>
				    <div class="col-sm-4">
				        <textarea class="form-control" value="" name="address" rows="2" id="address" placeholder="Enter Your Adderss"><?= set_value('address'); ?></textarea>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">PAN Number</label>
				    <div class="col-sm-4">
				    	<input type="text" name="pan" value="<?= set_value('pan'); ?>" class="form-control noSpace" id="pan" placeholder="PAN Number">
				    	<span id="err_pan"></span>
				    </div>
				    <label class="col-sm-2 control-label">Nominee Name</label>
				    <div class="col-sm-4">
				    	<input type="text" value="<?= set_value('nomini_name'); ?>" name="nomini_name" class="form-control" placeholder="Enter Nomini Name">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">Nominee Relation</label>
				    <div class="col-sm-4">
				    	<input type="text" name="nomini_rel" value="<?= set_value('nomini_rel'); ?>" class="form-control" id="" placeholder="Nomini Relation">
				    </div>
				    <label class="col-sm-2 control-label">Nominee DOB </label>
				    <div class="col-sm-4">
				    	<span id="datepairExample">
				        	<input type="text" value="<?= set_value('nomini_dob'); ?>" name="nomini_dob" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy">
				        </span>
				    </div>
				</div>
					<div class="form-group">
				    <label class="col-sm-2 control-label">Nominee Mobile</label>
				    <div class="col-sm-4">
				    	<input type="number" name="nomini_mob" value="<?= set_value('nomini_mob'); ?>" class="form-control" id="" placeholder="Nomini Mobile">
				    </div>
				</div>
				
					<div class="form-group">
				    <div class="col-sm-4">
				    <p style="text-align:center; border-style: groove;"> Bank Detail's</p>
				    </div>
				    <div class="col-sm-8">
				      <hr style="border-top: 1px solid;">
				    </div>
				</div>
		
				
				<!--<legend>Bank Detail's</legend>-->
			
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
					<div class="form-group">
				    <label class="col-sm-2 control-label">Paytm Account</label>
				    <div class="col-sm-4">
				    	<input type="text" name="paytm" value="<?= set_value('paytm'); ?>" class="form-control noSpace" id="paytm" placeholder="Paytm Account">
				    </div>
				</div>
				
					<div class="form-group">
				    <div class="col-sm-4">
				    <p style="text-align:center; border-style: groove;"> Upload Photo</p>
				    </div>
				    <div class="col-sm-8">
				      <hr style="border-top: 1px solid;">
				    </div>
				</div>
				<!--<legend>Upload Photo</legend>-->
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
		</div>
	</div>
	<?php $this->load->view('include/footer');?>
</body>
</html>
<style type="text/css">
	.logo{
		max-height: 120px;
	}
	#jumbo{
		border-radius: 0px;
    	box-shadow: 0px 0px 40px 3px;
	}
	body{
		background-color: #eeeeee;
		background-image: url("https://www.transparenttextures.com/patterns/dimension.png");
		background-attachment: fixed;
		/*background-size: cover;*/
	}
	#contain{
	}
	legend{
		border-bottom: 1px solid grey;
	}
	label{
		font-weight: normal;
	}
	span{
		color: red;
	}
</style>
<script type="text/javascript">
$('.noSpace').keyup(function(){
    str = $(this).val()
    str = str.replace(/\s/g,'')
    $(this).val(str)
});
	$('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });

	$('#sponcer_id').change(function(){
		var sponcerID=$('#sponcer_id').val();
		$.ajax({
			url:"<?=base_url('login/getSponcer');?>",
			type:'post',
			data:{id:sponcerID},
			success:function(data)
			{
				if(data==0)
				{
					$('#submit').prop('disabled',true);
					$('#err_sponcer').html('Sponcer ID is Not Exist/Active');
				}else
				{
					$('#submit').prop('disabled',false);
					$('#err_sponcer').html('');
					$('#sponcer_name').val(data);
				}
				//alert(data);
			}
		});
	});

	function checkValid()
	{
		var pass1 = document.getElementById('pass1');
       	var pass2 = document.getElementById('pass2');
       	var name=$('#name').val();
       	var pass=$('#pass1').val();
       	var sponcer_id=$('#sponcer_id').val();
       	var mobile=$('#mobile').val();
       	var email=$('#email').val();
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
		// 	$('#err_email').html('Email ID is Required');
		// 	return false;
		// }
		if($.trim(pan)!='')
		{
			checkPan(pan);
		}
		if(imageValidation()==false)
		{
			$("#imageError").html('Image size must be less than 200KB');
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

	$('#pan').keyup(function(){
 	var pan=$.trim($("#pan").val());
 	var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/;
 	//alert(pan);
 	if(pan=='')
 	{
 		$("#err_pan").html("");
 		$('#submit').prop('disabled',false);
 	}else
 	{
 		if(pan.match(regExp))
		{ 
			//alert('Right');
			$("#err_pan").html('');
			$('#submit').prop('disabled',false);
			return true;
		}else
		{
			$("#err_pan").html("PAN Number format is wrong");
			$('#submit').prop('disabled',true);
			return false;
		}
 	}
 	
});

</script>

<script type="text/javascript">
// email
function UserNameFun()
{
    var email=$.trim($('#user_id').val());
    // alert(email);
    if(email=='')
    {
      alert('User Name is Required');
      return false;
    }else
    {
      $.ajax({
        url: "<?=base_url('stable/UsNamevedidation');?>",
        data: {email1:email},
       
        type: "POST",
        success: function(data)
        {
            if(data==1)
            {
                $('#err_user_id').html("User Name Already Exist.");
                $('#submit').attr('disabled',true);
                return false;
            }else
            {
                $('#err_user_id').html("");
                $('#submit').attr('disabled',false);
                return true;
            }
        }
    });
 }
}

 
</script>