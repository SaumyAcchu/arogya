<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='My Profile';?> | <?=$this->siteInfo['name'];?></title>
  	<?php $this->load->view('hr/include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
    	<?php $this->load->view('hr/include/topbar'); ?>
  <!--===========top nav end===========-->
  	<div class="wrapper" id="wrapper">
    	<div class="left-container" id="left-container">
      	<!--========== Sidebar Start =============-->
      		<?php $this->load->view('hr/include/sidebar',$page); ?>
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
		        <?php $this->load->view('hr/include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
		       <div class="container-fluid padding-top main-container">
<!-- ///=====================All Contents Start Here==========================================/// -->
				    <div class="col-lg-12">
				    	<div class="well well-sm">
			                <div class="row">
			                  <div class="col-sm-8 col-md-10">
			                    <h4><i class="glyphicon glyphicon-user"></i> <strong><?=$this->loggedEmp['name'];?></strong></h4>
			                       <i class="fa fa-vcard-o"> User ID</i> :  <?=$this->loggedEmp['employee_id'];?><br><!-- <i class="fa fa-shopping-cart"> Product</i> :  <?=$this->loggedEmp['product'];?> --><br><br>
			                        <!-- Split button -->
			                        <a href="<?=base_url('user/getData/'.base64_encode('users/'.$this->loggedEmp['id'].'/update-profile'));?>" class="btn btn-success"> Update Profile</a>
			                    </div>
			                    <div class="col-sm-4 col-md-2"><br>
			                    	<img title="profile image" class="img-circle img-responsive profile-image" src="<?=base_url('uploads/'.$this->loggedEmp['image']);?>">
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
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Sponcer ID</strong></span> <?=$this->loggedEmp['sponcer_id'];?></li>
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Password</strong></span> <?=$this->loggedEmp['password'];?></li>
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span> <?=$this->db_model->dateFormat($this->loggedEmp['reg_date']);?></li>
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Father</strong></span> <?=$this->loggedEmp['fname'];?>.</li>
				                <li class="list-group-item text-right"><span class="pull-left"><strong class="">DOB</strong></span> <?=$this->loggedEmp['dob'];?>.</li>
				            </ul>
				           <div class="panel panel-default">
				            	<div class="panel-heading">
				            		Account Status
				                </div>
				                <div class="panel-body">
				                	<?=($this->loggedEmp['status']==1)?'<i style="color:green" class="fa fa-check-square"></i> Yes, Account is Active.':'<i style="color:red" class="fa fa-ban"></i> No, Account is Not Active.';?>
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
				                		<th>Activation PIN</th><td colspan="3"><?=$this->loggedEmp['pin'];?></td>
				                	</tr> -->
				                	<tr>
				                		<th>Mobile Number</th><td><?=$this->loggedEmp['mobile'];?></td><th>PAN Number</th><td><?=$this->loggedEmp['pan'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Adhar Number</th><td><?=$this->loggedEmp['adhar'];?></td><th>Nomini Name</th><td><?=$this->loggedEmp['nomini_name'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Nomini Age</th><td><?=$this->loggedEmp['nomini_age'];?></td><th>Nomini Relation</th><td><?=$this->loggedEmp['nomini_rel'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Paytm Account Number</th><td colspan="3"><?=$this->loggedEmp['paytm'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Bank Account Number</th><td><?=$this->loggedEmp['account_number'];?></td><th>Bank Name</th><td><?=$this->loggedEmp['bank_name'];?></td>
				                	</tr>
				                	<tr>
				                		<th>IFSC Code</th><td><?=$this->loggedEmp['ifsc'];?></td><th>Branch Name</th><td><?=$this->loggedEmp['branch_name'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Email ID</th><td colspan="3"><?=$this->loggedEmp['email'];?></td>
				                	</tr>
				                	<tr>
				                		<th>Permanent Address</th><td colspan="3"><?=$this->loggedEmp['address'];?></td>
				                	</tr>
				                </table>
				                </div>
				            </div>
				        </div>
				    </div>
        
	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('hr/include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>
<style type="text/css">
	.profile-image{
  height: 150px;
  width: 140px;
}
</style>