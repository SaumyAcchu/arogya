<!DOCTYPE html>
<html>
<head>
	<title><?=$this->siteInfo['name'];?></title>
	<?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
	<div class="container-fluid no-padding display-table">
		<div class="row no-padding display-table-row">
			<div class="col-lg-2 no-padding bx-shdw col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
				<?php $this->load->view('includes/sidebar.php',['page'=>'user-update']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Update Profile</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
					<?= form_open_multipart('user/updateDataWithFile/'.base64_encode('users/'.$this->logged['id'].'/my-profile'),['class'=>'form-horizontal','id'=>'updateForm']); ?>
					<center><b>User ID : </b><span><?=$this->logged['user_id'];?></span></center>
			<label><span>*</span> Fields are required.</label>
				<legend>Sponcer Details</legend>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Sponcer ID<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('sponcer_id',$this->logged['sponcer_id']); ?>" name="sponcer_id" class="form-control txtupper" id="sponcer_id" placeholder="Enter Sponcer ID" required readonly>
				        <span id="err_sponcer"></span>
				    </div>
				    <!-- <label class="col-lg-2 control-label">Activation PIN</label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('pin',$this->logged['pin']); ?>" name="pin" class="form-control" id="pin" placeholder="Enter Activation PIN" readonly>
				        <span id="err_pin"></span>
				    </div> -->
				</div>
				<legend style="margin-top: 10px;">Member Detail</legend>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Full Name<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('name',$this->logged['name']); ?>" name="name" class="form-control" id="name" placeholder="Enter Applicants Name" required >
				        <span id="err_name"></span>
				    </div>
				    <label class="col-lg-2 control-label">Mobile Number<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="number" value="<?= set_value('mobile',$this->logged['mobile']); ?>" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required >
				        <span id="err_mobile"></span>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Email Id</label>
				    <div class="col-lg-4">
				        <input type="email" value="<?= set_value('email',$this->logged['email']); ?>" class="form-control" name="email" id="email" placeholder="Email ID">
				        <span id="err_email"></span>
				    </div>
				    <label class="col-lg-2 control-label">Address</label>
				    <div class="col-lg-4">
				        <textarea class="form-control" value="" name="address" rows="2" id="address" placeholder="Enter Your Adderss"><?= set_value('address',$this->logged['address']); ?></textarea>
				    </div>
				</div>
				<legend>Bank Detail's</legend>
				<!-- <div class="form-group">
				    <label class="col-lg-2 control-label">Paytm Account</label>
				    <div class="col-lg-4">
				    	<input type="text" name="paytm" value="<?= set_value('paytm',$this->logged['paytm']); ?>" class="form-control" id="paytm" placeholder="Paytm Account">
				    </div>
				</div> -->
				<div class="form-group">
				    <label class="col-lg-2 control-label">Account Number</label>
				    <div class="col-lg-4">
				    	<input type="text" name="account_number" value="<?= set_value('account_number',$this->logged['account_number']); ?>" class="form-control" id="account_number" placeholder="A/C Number">
				    </div>
				    <label class="col-lg-2 control-label">Bank Name</label>
				    <div class="col-lg-4">
				    	<input type="text" value="<?= set_value('bank_name',$this->logged['bank_name']); ?>" name="bank_name" class="form-control" placeholder="Enter Bank Name">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Branch Name</label>
				    <div class="col-lg-4">
				    	<input type="text" class="form-control" name="branch_name" id="branch_name" value="<?= set_value('branch_name',$this->logged['branch_name']); ?>" placeholder="Branch name">
				    </div>
				    <label class="col-lg-2 control-label">IFSC Code</label>
				    <div class="col-lg-4">
				    	<input type="text" value="<?= set_value('ifsc',$this->logged['ifsc']); ?>" name="ifsc" class="form-control" id="ifsc" placeholder="IFSC Code">
				    </div>
				</div>
				<legend>Update Photo</legend>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Choose Photo:</label>
				    <div class="col-lg-4">
				    	<input type="file" accept="image" name="image" id="image_path" class="form-control image_path">
				        <span id="imageError" style="color: red;"></span>
				       <?php if(isset($file_error)) { echo $file_error; } ?>
				    </div>
				    <label class="col-lg-2 control-label"></label>
				    <div class="col-lg-4">
				    	
				    	<img src="<?=base_url('uploads/'.$this->logged['image']);?>" style="" id="blah" height="100" width="100">
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-lg-10 col-lg-offset-2">
				        <button type="buttun" id="backBtn" class="btn btn-default">Back</button>
				        <button type="submit" onclick="return checkValid()" id="submit" class="btn btn-primary">Update</button>
				    </div>
				</div>
				</form>
<!-- ///=====================All Contents End Here============================================/// -->
				</div>
				<?php $this->load->view('includes/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
</html>
<style type="text/css">
	
	legend{
		border-bottom: 1px solid grey;
	}
	label{
		font-weight: normal;
	}
	#updateForm span{
		color: red;
	}
</style>
<script type="text/javascript">
$('#backBtn').click(function(){
	window.history.back();
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
					$('#err_sponcer').html('Sponcer ID Not Found');
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
       	var sponcer_id=$('#sponcer_id').val();
       	var name=$('#name').val();
       	var mobile=$('#mobile').val();
       	var email=$('#email').val();
       	if($.trim(sponcer_id)=='')
		{
			$('#err_sponcer').html('Sponcer ID is Required');
			return false;
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
		// if($.trim(email)=='')
		// {
		// 	$('#err_email').html('Email ID is Required');
		// 	return false;
		// }
		imageValidation();
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
</script>