<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Send OTP';?> | <?=$this->siteInfo['name'];?></title>
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
		           <div class="panel panel-default">
						<div class="panel-heading">
							<span class="panel-title">An OTP send to your registered mobile number.</span>
						</div>
						<div class="panel-body">
							<center><h4>Please Enter OTP : <b class="txtred">
								<span id="time">05:00</span>
							</b></h4></center>
							<hr>
							<div class="col-lg-6 col-lg-offset-3 jumbotron txtcenter">
								<span>To open this page OTP Authentication is Required. <?= $_SESSION['otp'] ?></span>
								<div class="row form-horizontal" style="padding: 10px;">
									<?=form_open('auth/validateOtp'); ?>
									<div class="form-group">
										<label class="col-xs-5">
											OTP Send On : 
										</label>
										<div class="col-xs-7">
											<b><u><?=substr($this->logged['mobile'],0,4)."XXXX".substr($this->logged['mobile'],8, 10);?></u></b>
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-5">Enter OTP : </label>
										<div class="col-xs-7">
											<input type="number" id="otp" name="otp" class="form-control" placeholder="Please Enter Your OTP" required>
											<span id="err_otp" class="txtred"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-5"></div>
										<div class="col-xs-7">
											<center><button type="submit" id="" class="btn btn-primary"> Validate </button> <br><br>
												<a class="txtblue" href="<?=base_url('auth/authenticate/'.base64_encode('generate-pin')); ?>"> <u>Re-send OTP</u> </a>
											</center>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>          
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
<script type="text/javascript">
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
	var sec="<?=time()-$_SESSION['otp_start'];?>";
    var fiveMinutes = 300-parseInt(sec),
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};

</script>