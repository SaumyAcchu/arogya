<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<?php $this->load->view('include/header');?>
</head>
<body>
	<div class="container-fluid" id="contain">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="jumbotron" id="jumbo">
				<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
				<!-- ///Flash Message End/// -->
				<?php
				if(isset($joinLink)) { ?>
				<center><p class="txtblue"><?=$joinLink;?></p><br>
				<a href="<?=base_url();?>">Home</a></center>
				<?php }else { ?>
				<center><h3 class="txtgreen">Registration Successful</h3></center>
				<table class="table table-bordered table-hover table-striped" id="myTable">
					<tr>
						<td>Name</td><td><?=$data['name'];?></td>
						<td rowspan="3" colspan="2">
							<center><img src="<?=base_url('uploads/'.$data['image']);?>" height="120" width="120"></center>
						</td>
					</tr>
					<tr>
						<td>User ID</td><th><?=$data['user_id'];?></th>
					</tr>
					<tr>
						<td>Password</td><th><?=$data['password'];?></th>
					</tr>
					<tr>
						<td>Email</td><td><?=$data['email'];?></td>
						<td>Mobile</td><td><?=$data['mobile'];?></td>
					</tr>
					<tr>
						<td colspan="2" class="txtred">Please Note Your User ID and Password.</td>
						<td><a class="btn btn-sm btn-primary r-zero" href="<?=base_url('login');?>">Login</a></td><td><a class="btn btn-sm btn-info r-zero" href="<?=base_url('login/registration');?>">Registration</a></td>
					</tr>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<?php $this->load->view('include/footer.php'); ?>
	</div>
</body>
</html>
<style type="text/css">
	
	#jumbo{
		border-radius: 0px;
    	box-shadow: 0px 0px 40px 3px;
    	margin-top: 100px;
	}
	body{
		background-color: #eeeeee;
		background-image: url("https://www.transparenttextures.com/patterns/dimension.png");
		background-attachment: fixed;
		/*background-size: cover;*/
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
<script type = "text/javascript" >
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
history.pushState(null, null, '');
});
</script>