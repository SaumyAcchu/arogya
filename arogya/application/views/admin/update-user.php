<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?=$page['page']='Update User';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="row padding-top">
               <?= form_open_multipart('auth/updateDataWithFile/users/'.$get_data['id'].'/user-management',['class'=>'form-horizontal jumbotron','id'=>'updateForm']); ?>
			<label><span>*</span> Fields are required.</label>
				<legend>Sponcer Details</legend>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Sponcer ID<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('sponcer_id',$get_data['sponcer_id']); ?>" name="sponcer_id" class="form-control txtupper" id="sponcer_id" placeholder="Enter Sponcer ID" required>
				        <span id="err_sponcer"></span>
				    </div>
				    <label class="col-lg-2 control-label">Sponcer Name</label>
				    <div class="col-lg-4">
				    <?php $row=$this->db->select('name')->get_where('users',['user_id'=>$get_data['sponcer_id']])->row_array();?>
				        <input type="text" value="<?=$row['name'];?>" id="sponcer_name" class="form-control" readonly="">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Reg Date<span>*</span></label>
				    <div class="col-lg-4">
				        <span id="datepairExample">
				        	<input type="text" value="<?= set_value('reg_date',$get_data['reg_date']); ?>" name="reg_date" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy">
				        </span>
				    </div>
				   
				</div>
				
				<legend style="margin-top: 10px;">Member Detail</legend>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Full Name<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('name',$get_data['name']); ?>" name="name" class="form-control" id="name" placeholder="Enter Applicants Name" required>
				        <span id="err_name"></span>
				    </div>
				    <label class="col-lg-2 control-label">Mobile Number<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="number" value="<?= set_value('mobile',$get_data['mobile']); ?>" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required>
				        <span id="err_mobile"></span>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Father/Husband Name<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('fname',$get_data['fname']); ?>" name="fname" class="form-control" id="fname" placeholder="">
				        <span id="err_fname"></span>
				    </div>
				    <label class="col-lg-2 control-label">PAN Number<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('pan',$get_data['pan']); ?>" class="form-control" name="pan" id="pan" placeholder="pan Number">
				        <span id="err_pan"></span>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">DOB<span>*</span></label>
				    <div class="col-lg-4">
				        <span id="datepairExample">
				        	<input type="text" value="<?= set_value('dob',$get_data['dob']); ?>" name="dob" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy">
				        </span>
				    </div>
				    <label class="col-lg-2 control-label">Password<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="text" value="<?= set_value('password',$get_data['password']); ?>" class="form-control" name="password" id="password" placeholder="" required>
				        <span id="err_password"></span>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Email Id<span>*</span></label>
				    <div class="col-lg-4">
				        <input type="email" value="<?= set_value('email',$get_data['email']); ?>" class="form-control" name="email" id="email" placeholder="Email ID">
				        <span id="err_email"></span>
				    </div>
				    <label class="col-lg-2 control-label">Address</label>
				    <div class="col-lg-4">
				        <textarea class="form-control" value="" name="address" rows="2" id="address" placeholder="Enter Your Adderss"><?= set_value('address',$get_data['address']); ?></textarea>
				    </div>
				</div>
				<legend>Bank Detail's</legend>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Paytm Account</label>
				    <div class="col-lg-4">
				    	<input type="text" name="paytm" value="<?= set_value('paytm',$get_data['paytm']); ?>" class="form-control" id="paytm" placeholder="Paytm Account">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Account Number</label>
				    <div class="col-lg-4">
				    	<input type="text" name="account_number" value="<?= set_value('account_number',$get_data['account_number']); ?>" class="form-control" id="account_number" placeholder="A/C Number">
				    </div>
				    <label class="col-lg-2 control-label">Bank Name</label>
				    <div class="col-lg-4">
				    	<input type="text" value="<?= set_value('bank_name',$get_data['bank_name']); ?>" name="bank_name" class="form-control" placeholder="Enter Bank Name">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-lg-2 control-label">Branch Name</label>
				    <div class="col-lg-4">
				    	<input type="text" class="form-control" name="branch_name" id="branch_name" value="<?= set_value('branch_name',$get_data['branch_name']); ?>" placeholder="Branch name">
				    </div>
				    <label class="col-lg-2 control-label">IFSC Code</label>
				    <div class="col-lg-4">
				    	<input type="text" value="<?= set_value('ifsc',$get_data['ifsc']); ?>" name="ifsc" class="form-control" id="ifsc" placeholder="IFSC Code">
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
				    	
				    	<img src="<?=base_url('uploads/'.$get_data['image']);?>" style="" id="blah" height="100" width="100">
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-lg-10 col-lg-offset-2">
				        <button type="buttun" id="backBtn" class="btn btn-default">Back</button>
				        <button type="submit" onclick="return checkValid()" id="submit" class="btn btn-primary">Update</button>
				    </div>
				</div>
				</form>                 
            </div>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
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
		var validImg=imageValidation();
		if(validImg==true)
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
function imageValidation()
	{
		var img_size=$("#image_path")[0].files[0].size;
	 	if(img_size>250000)
	 	{
	 		$("#imageError").html('Image size must be less than 200KB');
	 		return false;
	 	}else {return true;}
	}
</script>