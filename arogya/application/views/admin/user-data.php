<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='user data';?> | <?=$this->siteInfo['name'];?></title>
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
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
		<?php if($user==0) { echo "<h1 class='text-center'>Sorry, User ID Not Found.</h1>"; }else{ ?>
	    <div class="col-lg-12">
	    	<div class="well well-sm">
                <div class="row">
                  <div class="col-sm-6 col-md-2">
                    <img title="profile image" class="img-circle img-responsive profile-image" src="<?=base_url('uploads/'.$user['image']);?>">
                  </div>
                  <div class="col-sm-6 col-md-4">
                    <h4><i class="glyphicon glyphicon-user"></i> <strong><?=$user['name'];?></strong></h4>
                       <i class="fa fa-vcard-o"> User ID</i> :  <?=$user['user_id'];?><br><i class="fa fa-shopping-cart"> Product</i> :  <?=$user['product'];?><br><br>
                        <!-- Split button -->
                        <!-- <a href="<?=base_url('user/getData/'.base64_encode('users/'.$user['id'].'/update-profile'));?>" class="btn btn-success"> Update Profile</a> -->
                    </div>
                    <div class="col-sm-6 col-md-3"><br>
                    	<div class="panel panel-primary">
	                        <div class="panel-heading">
		                        <div class="row">
		                        	<div class="col-xs-4">
		                            	<i class="fa fa-inr fa-5x"></i>
		                          	</div>
		                          	<div class="col-xs-8 text-right">
		                            	<p class="announcement-heading">Wallet Balance</p>
		                            	<h3 class="announcement-text"><?=number_format($user['wallet'],2);?></h3>
		                          	</div>
		                        </div>
	                        </div>
	                    </div>
                    </div>
                    <div class="col-sm-6 col-md-3"><br>
                    	<div class="panel panel-primary">
	                        <div class="panel-heading">
		                        <div class="row">
		                        	<div class="col-xs-4">
		                            	<i class="fa fa-inr fa-5x"></i>
		                          	</div>
		                          	<div class="col-xs-8 text-right">
		                            	<p class="announcement-heading">Topup Balance</p>
		                            	<h3 class="announcement-text"><?=number_format($user['topup'],2);?></h3>
		                          	</div>
		                        </div>
	                        </div>
	                    </div>
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
	                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Sponcer ID</strong></span> <?=$user['sponcer_id'];?></li>
	                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Password</strong></span> <?=$user['password'];?></li>
	                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span> <?=$this->dbm->dateFormat($user['reg_date']);?></li>
	                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Mobile</strong></span> <?=$user['mobile'];?></li>
	            </ul>
	           <div class="panel panel-default">
	            	<div class="panel-heading">
	            		Account Status
	                </div>
	                <div class="panel-body">
	                	<?=($user['status']==1)?'<i style="color:green" class="fa fa-check-square"></i> Yes, Account is Active.':'<i style="color:red" class="fa fa-ban"></i> No, Account is Not Active.';?>
	                </div>
	            </div>
	        </div>
	        <!--/col-3-->
	        <div class="col-sm-9" style="" contenteditable="false">
	            <div class="panel panel-info">
	                <div class="panel-heading">
	                	Account Details
	                </div>
	                <div class="panel-body">
	                <table class="table table-bordered table-striped table-hover">
	                	<tr>
	                		<th>Activation PIN</th><td><?=$user['pin'];?></td>
	                		<th>Activate Date</th><td><?=$this->dbm->dateFormat($user['active_date']);?> <?=$user['active_time'];?></td>
	                	</tr>
	                	<tr>
	                		<th>Paytm Account Number</th><td colspan="3"><?=($user['paytm'])?$user['paytm']:'Not Added Yet';?></td>
	                	</tr>
	                	<tr>
	                		<th>Bank Account Number</th>
	                		<td><?=($user['account_number'])?$user['account_number']:'Not Added Yet';?></td>
	                		<th>Bank Name</th>
	                		<td><?=($user['bank_name'])?$user['bank_name']:'Not Added Yet';?></td>
	                	</tr>
	                	<tr>
	                		<th>IFSC Code</th>
	                		<td><?=($user['ifsc'])?$user['ifsc']:'Not Added Yet';?></td>
	                		<th>Branch Name</th>
	                		<td><?=($user['branch_name'])?$user['branch_name']:'Not Added Yet';?></td>
	                	</tr>
	                	<tr>
	                		<th>Email ID</th><td colspan="3"><?=($user['email'])?$user['email']:'Not Added Yet';?></td>
	                	</tr>
	                	<tr>
	                		<th>Permanent Address</th><td colspan="3"><?=($user['address'])?$user['address']:'Not Added Yet';?></td>
	                	</tr>
	                </table>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row">
		    <div class="col-lg-8">
		    	<div class="panel panel-primary">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><i class="fa fa-cogs"></i> Expense Amount</h3>
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-xs-6 b2">
						        <div class="label-primary" style="padding: 5px; border-radius: 6px;">
						            <button class="btn btn-info btn-lg btn-block" role="button" style="padding: 2px;">
						                <div class="fa fa-pinterest-p fa-3x"></div>
						                <div class="icon-label">Self PIN Generate</div>
						            </button> 
						            <button class="btn btn-default btn-block" style="height: 40px;">
						                <span class="badge"> <?=$pinCount;?> </span>
						            </button>
						        </div>
						    </div>
						    <div class="col-xs-6 b2">
						        <div class="label-primary" style="padding: 5px; border-radius: 6px;">
						            <button class="btn btn-info btn-lg btn-block" role="button" style="padding: 2px;">
						                <div class="fa fa-money fa-3x"></div>
						                <div class="icon-label">Withdrawal</div>
						            </button> 
						            <button class="btn btn-default btn-block" style="height: 40px;">
						                <span class="badge"> <i class="fa fa-inr"></i> <?=number_format($withdraw,2);?> </span>
						            </button>
						        </div>
						    </div>
					    	<table class="table" style="margin-bottom: 0px;">
					    		<tr>
					    			<td>PIN Generate</td><td class="min">: <?=number_format($pin=$pinCount*222,2);?></td>
					    			<td>Withdraw</td><td class="min">: <?=number_format($withdraw,2);?></td>
					    		</tr>
					    		<tr>
					    		</tr>
					    	</table>
	                    </div>
	                </div>
	            </div>
		    </div>
		</div>

	<div class="panel panel-primary">
		<div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-sitemap"></i> Direct Joins <span class="badge"><?=count($directs); ?></span></h3>
		</div>
		<div class="panel-body">
			<?php foreach ($directs as $key => $down) { ?>
		    <div class="col-lg-3 col-xs-6 b2">
                <div class="well text-center dwell">
                	<div class="dirImg">
		            	<center><img src="<?=base_url('uploads/'.$down['image']);?>" width="50" height="50" alt="<?=$down['name'];?>" class="img-circle" /></center>
		        	</div>
		        	<p><?=$down['user_id']; ?></p>
		            <a href="<?=base_url('auth/userData/'.$down['user_id']);?>" class="btn btn-success btn-block"><?=$down['name'];?></a>
		        </div>
		    </div>
		    <?php } ?>
		</div>
	</div>
	<div class="row">
	           			<div class="col-sm-4">
		                    <div class="panel panel-info">
		                        <div class="panel-heading">
			                        <div class="row">
			                        	<div class="col-xs-4">
			                            	<i class="fa fa-users fa-5x"></i>
			                          	</div>
			                          	<div class="col-xs-8 text-right">
			                            	<h3 class="announcement-text">Direct Joins</h3>
			                            	<?php $count=$this->dbm->rowCount('users',['sponcer_id'=>$user['user_id']]); ?>
			                            	<p class="announcement-heading"><?=$count;?></p>
			                          	</div>
			                        </div>
		                        </div>
		                        <a href="<?=base_url('auth/statics/'.base64_encode('directAll/1/My Referrals').'/'.$user['user_id']);?>">
			                        <div class="panel-footer announcement-bottom">
			                          	<div class="row">
			                            	<div class="col-xs-6">
			                              		Expand
			                            	</div>
			                            	<div class="col-xs-6 text-right">
			                              		<i class="fa fa-arrow-circle-right"></i>
			                            	</div>
			                          	</div>
			                        </div>
		                        </a>
		                    </div>
		                </div>


 
		                <div class="col-sm-4">
		                    <div class="panel panel-danger">
		                        <div class="panel-heading">
			                        <div class="row">
			                        	<div class="col-xs-4">
			                            	<i class="fa fa-sort-amount-asc fa-5x"></i>
			                          	</div>
			                          	<div class="col-xs-8 text-right">
			                            	<h3 class="announcement-text">Self Team</h3>
			                            	<p class="announcement-heading">
			                            		<!-- <?=count($allSelf);?> -->
			                            			
			                            		</p>
			                          	</div>
			                        </div>
		                        </div>
		                        <a href="<?=base_url('auth/statics/'.base64_encode('selfAll/1/Self Team').'/'.$user['user_id']);?>">
			                        <div class="panel-footer announcement-bottom">
			                          	<div class="row">
			                            	<div class="col-xs-6">
			                              		Expand
			                            	</div>
			                            	<div class="col-xs-6 text-right">
			                              		<i class="fa fa-arrow-circle-right"></i>
			                            	</div>
			                          	</div>
			                        </div>
		                        </a>
		                    </div>
		                </div>

		                <div class="col-sm-4">
		                    <div class="panel panel-warning">
		                        <div class="panel-heading">
			                        <div class="row">
			                        	<div class="col-xs-4">
			                            	<i class="fa fa-line-chart fa-5x"></i>
			                          	</div>
			                          	<div class="col-xs-8 text-right">
			                            	<h3 class="announcement-text">All India 
			                            	 <?php $ind=$this->dbm->rowCount('users',['id>'=>$user['id']]); ?>
			                            	( <?php echo $ind;?>)</h3>
			                            	<p class="announcement-heading">Live Chart</p>
			                          	</div>
			                        </div>
		                        </div>
		                        
		                        
		                        <a href="#">
			                        <div class="panel-footer announcement-bottom">
			                          	<div class="row">
			                            	<div class="col-xs-6">
			                              		Expand
			                            	</div>
			                            	<div class="col-xs-6 text-right">
			                              		<i class="fa fa-arrow-circle-right"></i>
			                            	</div>
			                          	</div>
			                        </div>
		                        </a>
		                    </div>
		                </div>

		            </div>

		              <div class="col-lg-12">
		              <?php $i=1; $total=0; ?>

		              <?php if(isset($down))
		              { 
		               ?>
		                <div class="col-lg-10 col-lg-offset-1">
		                  <div class="panel panel-primary" id="myPanel">
		                    <div class="panel-heading">
		                      <span class="panel-title txtupper"><center>Incentive Live Chart For Self Team of User Id - <?= $user['user_id'] ?> </center></span>
		                    </div>
		                    <div class="panel-body">
		                      <table class="table table-hover table-condensed table-striped table-bordered">
		                        <thead>
		                          <tr>
		                            <th>No</th>
		                            <th>User Id</th>
		                            <th>User Name</th>
		                            <th>Cradit Value</th>
		                            <th>Commission</th>
		                          </tr>
		                          <?php  $i=1; $totalcom = 0; $totalcvv = 0;     
		                          foreach ($down1 as $key => $value) { ?>

		                           <tr>
		                            <td><?=$i;?></td>
		                            <td><?=$value['user_id'];?></td>
		                            <td><?=$value['name'];?></td>
		                            <td><?=$value['cv'];?></td>
		                     <?php 
		                    $commRepuches=$this->db->select_sum('amount')->where(['user_id'=>$value['user_id'],'beneficiary'=>$user['user_id'],'type'=>'repurchase','status'=>1])->get('commission_repurchase')->row_array();
		                     ?>   <td><?= number_format($commRepuches['amount'],2) ?></td>
		                          </tr>
		                          <?php 
		                          $totalcvv = $totalcvv + $value['cv'];
		                          $totalcom=$totalcom + $commRepuches['amount'];
		                         $i++; } ?> 
		                           <td>1</td>
		                         <tr>
		                           <td></td>
		                           <td></td>
		                           <td></td>
		                           <td><?= $totalcvv ?>/-</td>
		                           <td><?= number_format($totalcom,2) ?>/-</td>
		                         </tr>
		                          <tr>
		                            <th colspan="7">Note: All India Scheme closing on last day of month.</th>
		                          </tr>
		                      </table>
		                    </div>
		                  </div>
		                </div>
		              <?php }  ?>
		             
		            </div>
        <?php } ?>
<!-- ///=====================All Contents End Here============================================/// -->
				</div>
				<?php $this->load->view('include/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
</body>
</html>
<style type="text/css">
	.profile-image{
  height: 140px;
  width: 140px;
}
.min{
	min-width: 60px;
}
.badge{
	font-size: 17px;
}
.b2{
	padding-bottom: 15px;
}
.dirImg{
	height: 60px;
	padding-bottom: 10px;
}
.mq-friends{
    width:31.3%;
    height:100px;
    padding:0;
    position:relative;
    display:table;
    float:left;
    margin:0px 10px 10px 0px;
}

.mq-friends:hover{
    transition:.6s;
    transform:scale(.9);
}

.mq-friend-img{
    padding-top:10px;
}

.mq-friends-footer{
    width:100%;
    background-color:#3399ff;
    position:absolute;
    bottom:0;
    text-align:center;
    color:#fff;
}
.dwell{
	min-height: 165px;
}
</style>