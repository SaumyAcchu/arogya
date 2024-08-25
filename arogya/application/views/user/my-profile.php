<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title><?=$page['page']='My Profile';?> | <?=$this->siteInfo['name'];?></title>
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
		          <div class="col-lg-12">
              <div class="well well-sm">
                      <div class="row">
                        <div class="col-sm-6 col-md-2">
                          <img title="profile image" class="img-circle img-responsive profile-image" src="<?=base_url('uploads/'.$this->logged['image']);?>">
                        </div>
                        <div class="col-sm-6 col-md-7">
                          <h4><i class="glyphicon glyphicon-user"></i> <strong><?=$this->logged['name'];?></strong></h4>
                             <i class="fa fa-vcard-o"> User ID</i> :  <?=$this->logged['user_id'];?><br><i class="fa fa-shopping-cart"> Product</i> :  <?=$this->logged['product'];?><br><br>
                              <!-- Split button -->
                              <a href="<?=base_url('user/authenticate/'.base64_encode('update-profile'));?>" class="btn btn-success"> Update Profile</a>
                               <a class="btn icon-btn btn-warning" href="<?=base_url('user/getData1/users/'.$this->logged['id'].'/id-card-generate');?>"><span class="glyphicon btn-glyphicon glyphicon-edit img-circle text-success"></span>ID CARD</a>
                               
                               <?php if($this->logged['kyc']==0) { ?>
                                   <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" ><span class="glyphicon btn-glyphicon glyphicon-edit img-circle text-success"></span>KYC Update</a>
                                   
                                   <?php } else { ?>
                                   <?php } ?>
                          </div>
                          <div class="col-sm-12 col-md-3"><br>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                  <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-inr fa-5x"></i>
                                      </div>
                                      <div class="col-xs-8 text-right">
                                        <p class="announcement-heading">Wallet Balance</p>
                                        <h3 class="announcement-text"><?=number_format($this->logged['wallet'],2);?></h3>
                                      </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </div>
                  </div>
          </div>
            <br>
          </div>
            <div class="row">
                <div class="col-sm-3">
                    <!--left col-->
                    <ul class="list-group">
                        <li class="list-group-item active text-muted" contenteditable="false">Profile</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Sponcer ID</strong></span> <?=$this->logged['sponcer_id'];?></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Password</strong></span> <?=$this->logged['password'];?></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span> <?=$this->dbm->dateFormat($this->logged['reg_date']);?></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Father</strong></span> <?=$this->logged['fname'];?>.</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">DOB</strong></span> <?=$this->logged['dob'];?>.</li>
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
                          <tr>
                            <th>Activation PIN</th><td colspan="3"><?=($this->logged['pin']!='')?$this->logged['pin']:'Not Active Yet';?></td>
                          </tr>
                          <tr>
                            <th>Mobile Number</th><td><?=$this->logged['mobile'];?></td><th>PAN Number</th><td><?=($this->logged['pan']!='')?$this->logged['pan']:'Not Added Yet';?></td>
                          </tr>
                          <tr>
                            <th>Paytm Account Number</th><td colspan="3"><?=($this->logged['paytm']!='')?$this->logged['paytm']:'Not Added Yet';?></td>
                          </tr>
                          <tr>
                            <th>Bank Account Number</th><td><?=($this->logged['account_number']!='')?$this->logged['account_number']:'Not Added Yet';?></td><th>Bank Name</th><td><?=($this->logged['bank_name']!='')?$this->logged['bank_name']:'Not Added Yet';?></td>
                          </tr>
                          <tr>
                            <th>IFSC Code</th><td><?=($this->logged['ifsc']!='')?$this->logged['ifsc']:'Not Added Yet';?></td><th>Branch Name</th><td><?=($this->logged['branch_name']!='')?$this->logged['branch_name']:'Not Added Yet';?></td>
                          </tr>
                          <tr>
                            <th>Email ID</th><td colspan="3"><?=($this->logged['email']!='')?$this->logged['email']:'Not Added Yet';?></td>
                          </tr>
                          <tr>
                            <th>Permanent Address</th><td colspan="3"><?=($this->logged['address']!='')?$this->logged['address']:'Not Added Yet';?></td>
                          </tr>
                        </table>
                        </div>
                    </div>
                </div>
                    <?php if($this->logged['kyc']==1) { ?>
                  <div class="col-sm-3">
                    <img src="<?=base_url('uploads/'.$this->logged['image1']);?>" style="height: 155px;padding: 10px;">
                </div>
                  <div class="col-sm-3">
                    <img src="<?=base_url('uploads/'.$this->logged['image2']);?>" style="height: 155px;padding: 10px;">
                </div>
                  <div class="col-sm-3">
                    <img src="<?=base_url('uploads/'.$this->logged['image3']);?>" style="height: 155px;padding: 10px;">
                </div>
                <?php  }else { ?>
                <h3>Please KYC Update </h3>
                <?php } ?>
            </div>           
		        </div>
	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
  	<style type="text/css">
    .btn-glyphicon { padding:8px; background:#ffffff; margin-right:4px; }
.icon-btn { padding: 1px 15px 3px 2px; border-radius:50px;}
</style>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">KYC Update </h4>
        </div>
        <?=form_open_multipart('user/KYCupdate/'.$this->logged['id']);?>
        <div class="modal-body">
        <div class="form-group">
    <label for="adhar">Adhar Card</label>
    <input type="file" class="form-control" id="image1" required="" name="image1">
    </div>
       
        <div class="form-group">
    <label for="adhar">Pin Card</label>
    <input type="file" class="form-control" id="image2" required="" name="image2">
    </div>
       <div class="form-group">
    <label for="adhar">Bank Passbook</label>
    <input type="file" class="form-control" required="" id="image3" name="image3">
    </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update KYC</button>  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
