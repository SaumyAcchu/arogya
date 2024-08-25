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
				<?php $this->load->view('includes/sidebar.php',['page'=>'my-profile']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>My Profile</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
				    <div class="col-lg-12">
				    	<div class="well well-sm">
			                <div class="row">
			                  <div class="col-sm-8 col-md-10">
			                    <h4><i class="glyphicon glyphicon-user"></i> <strong><?=$this->logged['name'];?></strong></h4>
			                       <i class="fa fa-vcard-o"> User ID</i> :  <?=$this->logged['user_id'];?><br><!-- <i class="fa fa-shopping-cart"> Product</i> :  <?=$this->logged['product'];?> --><br><br>
			                        <!-- Split button -->
			                        <a href="<?=base_url('user/getData/'.base64_encode('users/'.$this->logged['id'].'/update-profile'));?>" class="btn btn-success"> Update Profile</a>
			                    </div>
			                    <div class="col-sm-4 col-md-2"><br>
			                    	<img title="profile image" class="img-circle img-responsive profile-image" src="<?=base_url('uploads/'.$this->logged['image']);?>">
			                    </div>
			                </div>
			            </div>
					</div>
				    <br>
				    <div class="row">
				        <div class="col-sm-3">
				            <!--left col-->
				            <ul class="list-group">
				                <li class="list-group-item active text-muted" contenteditable="false">Profile</li>
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Sponcer ID</strong></span> <?=$this->logged['sponcer_id'];?></li>
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Password</strong></span> <?=$this->logged['password'];?></li>
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span> <?=$this->db_model->dateFormat($this->logged['reg_date']);?></li>
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Mobile</strong></span> <?=$this->logged['mobile'];?></li>
				            </ul>
				           <div class="panel panel-default">
				            	<div class="panel-heading">
				            		Account Status
				                </div>
				                <div class="panel-body">
				                	<?=($this->logged['status']==1)?'<i style="color:green" class="fa fa-check-square"></i> Yes, Account is Active.':'<i style="color:red" class="fa fa-ban"></i> No, Account is Not Active.';?>
				                </div>
				            </div>
				        </div>
				        <!--/col-3-->
				        <div class="col-sm-9" style="" contenteditable="false">
				            <div class="panel panel-default">
				                <div class="panel-heading">
				                	Account Details
				                </div>
				                <div class="panel-body">
				                <table class="table table-bordered table-striped table-hover">
				                	<!-- <tr>
				                		<th>Activation PIN</th><td colspan="3"><?=$this->logged['pin'];?></td>
				                	</tr> -->
				                	<tr>
				                		<th>Paytm Account Number</th><td colspan="3"><?=$this->logged['paytm'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Bank Account Number</th><td><?=$this->logged['account_number'];?></td><th>Bank Name</th><td><?=$this->logged['bank_name'];?></td>
				                	</tr>
				                	<tr>
				                		<th>IFSC Code</th><td><?=$this->logged['ifsc'];?></td><th>Branch Name</th><td><?=$this->logged['branch_name'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Email ID</th><td colspan="3"><?=$this->logged['email'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Permanent Address</th><td colspan="3"><?=$this->logged['address'];?></td>
				                	</tr>
				                </table>
				                </div>
				            </div>
				        </div>
				    </div>
        
        
<!-- ///=====================All Contents End Here============================================/// -->
				</div>
				<?php $this->load->view('includes/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
</html>
<style type="text/css">
	.profile-image{
  height: 150px;
  width: 140px;
}
</style>