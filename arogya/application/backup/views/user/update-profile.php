<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Update Profile';?> | <?=$this->siteInfo['name'];?></title>
  	<?php $this->load->view('include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
    	<?php $this->load->view('include/topbar'); ?>
  <!--===========top nav end===========-->
  	<div class="wrapper" id="wrapper">
    	<div class="left-container" id="left-container">
      	<!--========== Sidebar Start =============-->
      		<?php $this->load->view('include/sidebar',$page); ?>
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
		        <?php $this->load->view('include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
		        <div class="container-fluid padding-top main-container">
					
<!-- ///=====================All Contents Start Here==========================================/// -->
					<?= form_open_multipart('user/updateDataWithFile/'.base64_encode('users/'.$this->logged['id'].'/my-profile'),['class'=>'form-horizontal jumbotron','id'=>'updateForm']); ?>
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
				        <input type="text" value="<?= set_value('name',$this->logged['name']); ?>" name="name" class="form-control" id="name" placeholder="Enter Applicants Name" required readonly>
				        <span id="err_name"></span>
				    </div>
				    <label class="col-lg-2 control-label">Mobile Number<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="number" value="<?= set_value('mobile',$this->logged['mobile']); ?>" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required readonly>
				        <span id="err_mobile"></span>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Father/Husband Name<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('fname',$this->logged['fname']); ?>" name="fname" class="form-control" id="fname" placeholder="" required readonly>
				        <span id="err_fname"></span>
				    </div>
				    <label class="col-lg-2 control-label">PAN Number<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('pan',$this->logged['pan']); ?>" class="form-control" name="pan" id="pan" placeholder="pan Number">
				        <span id="err_pan"></span>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">DOB<span>*</span></label>
				    <div class="col-lg-4">
				        <span id="datepairExample">
				        	<input type="text" value="<?= set_value('dob',$this->logged['dob']); ?>" name="dob" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy">
				        </span>
				    </div>
				    <label class="col-lg-2 control-label">Password<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('password',$this->logged['password']); ?>" class="form-control" name="password" id="password" placeholder="" required>
				        <span id="err_password"></span>
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
				<div class="form-group">
				    <label class="col-lg-2 control-label">Adhar Number</label>
				    <div class="col-lg-4">
				        <input type="number" value="<?= set_value('adhar',$this->logged['adhar']); ?>" name="adhar" class="form-control" id="adhar" placeholder="">
				    </div>
				    <label class="col-lg-2 control-label">Nomini Name</label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('nomini_name',$this->logged['nomini_name']); ?>" class="form-control" name="nomini_name" id="nomini_name" placeholder="Nomini Name">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Nomini Age</label>
				    <div class="col-lg-4">
				        <input type="number" value="<?= set_value('nomini_age',$this->logged['nomini_age']); ?>" name="nomini_age" class="form-control" id="nomini_age" placeholder="">
				    </div>
				    <label class="col-lg-2 control-label">Nomini Relation</label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('nomini_rel',$this->logged['nomini_rel']); ?>" class="form-control" name="nomini_rel" id="nomini_rel" placeholder="Nomini Relation">
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
				<legend>Upload Pan</legend>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Choose Pan:</label>
				    <div class="col-lg-4">
				    	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#panModal">Click Here</button>
				    </div>
				    <label class="col-lg-2 control-label"></label>
				    <div class="col-lg-4">
				    	
				    	<img src="<?=base_url('uploads/'.$this->logged['pan_image']);?>" style="" height="100" width="100">
				    </div>
				</div>
				<legend>Upload cheque</legend>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Choose cheque:</label>
				    <div class="col-lg-4">
				    	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#chequeModal">Click Here</button>
				    </div>
				    <label class="col-lg-2 control-label"></label>
				    <div class="col-lg-4">
				    	
				    	<img src="<?=base_url('uploads/'.$this->logged['cheque_image']);?>" style="" height="100" width="100">
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-lg-10 col-lg-offset-2">
				        <button type="buttun" id="backBtn" class="btn btn-default">Back</button>
				        <button type="submit" onclick="return checkValid()" id="submit" class="btn btn-primary">Update</button>
				    </div>
				</div>
				</form>
	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>


<div class="modal fade" id="panModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Choose Pan:</h4>
        </div>
        <div class="modal-body">
         <?= form_open_multipart('user/updatePanCard/'.base64_encode('users/'.$this->logged['id'].'/my-profile'),['class'=>'form-horizontal jumbotron','id'=>'updateForm']); ?>
         		<div class="form-group">
				    <label class="col-lg-2 control-label">Choose Pan:</label>
				    <div class="col-lg-4">
				    	<input type="file" accept="image" name="image" id="pan_image_path" class="form-control pan_image_path">
				        <span id="imageError" style="color: red;"></span>
				       <?php if(isset($file_error)) { echo $file_error; } ?>
				    </div>
				    <label class="col-lg-2 control-label"></label>
				    <div class="col-lg-4">
				    	
				    	<img src="<?=base_url('uploads/'.$this->logged['pan_image']);?>" style="" id="blahpan" height="100" width="100">
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-lg-10 col-lg-offset-2">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cansel</button>
				        <button type="submit"  class="btn btn-primary">Update</button>
				    </div>
				</div>

     </form>
        </div>
       
      </div>
      
    </div>
  </div>

<div class="modal fade" id="chequeModal" role="dialog">
    <div class="modal-dialog">
    
     <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Choose Cheque</h4>
        </div>
        <div class="modal-body">
         <?= form_open_multipart('user/updateCheque/'.base64_encode('users/'.$this->logged['id'].'/my-profile'),['class'=>'form-horizontal jumbotron','id'=>'updateForm']); ?>
         		<div class="form-group">
				    <label class="col-lg-2 control-label">Choose Cheque:</label>
				    <div class="col-lg-4">
				    	<input type="file" accept="image" name="image" id="cheque_image_path" class="form-control cheque_image_path">
				        <span id="imageError" style="color: red;"></span>
				       <?php if(isset($file_error)) { echo $file_error; } ?>
				    </div>
				    <label class="col-lg-2 control-label"></label>
				    <div class="col-lg-4">
				    	
				    	<img src="<?=base_url('uploads/'.$this->logged['cheque_image']);?>" style="" id="blahcheque" height="100" width="100">
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-lg-10 col-lg-offset-2">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cansel</button>
				        <button type="submit"  class="btn btn-primary">Update</button>
				    </div>
				</div>

     </form>
        </div>
       
      </div>
      
    </div>
  </div>

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
$('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
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
		var img=imageValidation();
		if(img)
		{
			return true;
		}else
		{
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

 function readURLpan(input) {
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#blahpan').css('display','block');
        $('#blahpan').attr('src', e.target.result);
    }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".pan_image_path").change(function(){
    readURLpan(this);
});

function readURLcheque(input) { 
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#blahcheque').css('display','block');
        $('#blahcheque').attr('src', e.target.result);
    }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".cheque_image_path").change(function(){
    readURLcheque(this);
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
