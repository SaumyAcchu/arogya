<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Dashboard';?> | <?=$this->siteInfo['name'];?></title>
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
		        	<div class="col-lg-3">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
		                        <div class="row">
		                        	<div class="col-xs-4">
		                            	<i class="fa fa-inr fa-5x"></i>
		                          	</div>
		                          	<div class="col-xs-8 text-right">
		                            	<p class="announcement-heading">Wallet Balanace</p>
		                            	<h3 class="announcement-text"><?=number_format($this->logged['wallet'],2);?></h3>
		                          	</div>
		                        </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-lg-3">
	                    <div class="form-group">
	                    	<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Self Generate <i class="fa fa-print"></i></h3>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label>Enter Quantity</label>
										<input type="number" id="quantity" value="1" class="form-control">
									</div>
									<div class="form-group">
										<button id="generatePin" class="btn btn-primary btn-block">Generate PIN <i class="fa fa-bolt"></i></button>
									</div>
								</div>
							</div>
	                    </div>
					</div>
				</div>
				<div class="row padding-top">
		            <div class="col-lg-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">Generated PIN Status</h3>
							</div>
							<div class="panel-body">
								<table id="table1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Sl No</th>
											<th>PIN</th>
											<th>Date</th>
											<th>Generate By</th>
											<th>Status</th>
											<th>Activated Account</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									  <?php
									  $res=$this->dbm->globalSelect('pin',['user_id'=>$this->logged['user_id'],'generate_by'=>'self']);
									   $i=1;
									  foreach($res as $key => $value)
									  { ?>
										<tr>
											<td><?=$i;?></td>
											<td><?=$value['pin'];?></td>
											<td><?=$value['gen_date'];?> <?=$value['gen_time'];?></td>
											<td><?=ucfirst($value['generate_by']);?></td>
											<td>
												<?=($value['status']==1)?'<button class="btn btn-sm btn-success btn-block">Active</button>':'<button class="btn btn-sm btn-warning btn-block">Deactive</button>';?>
											</td>
											<td><?php

											if($value['is_transfer']!=1)
											{
												if($value['activated_account'])
												{
													echo $value['activated_account'];
												}else { ?>
													<a href="#" onclick="return pinTopup('<?=$value['pin'];?>')" class="btn btn-sm btn-info btn-block">Topup Pin</a>
												<?php }
											}else
											{ ?>
												<a href="javascript:void(0);" class="btn btn-sm btn-primary">Transfered</a>
											<?php } ?>
											</td>
											<td>
												<?php if($value['is_transfer']!=1)
												{
													if($value['status']!=1){ ?>
													<a href="<?=base_url("direct/joinWithPin/".base64_encode($this->logged["user_id"].'/'.$value['pin']));?>" class="btn btn-sm btn-success btn-block">Join</a>
													<?php }else{ ?>
													<a href="#" class="btn btn-sm btn-info btn-block">Joined</a>
													<?php }
												}else{
													echo $value['receiver_id'];
												}
												 ?>
											</td>
										</tr>
									  <?php $i++; } ?>
									</tbody>
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
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>
<!-- Bootstrap Modal fo confirmation -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" style="color: red;"></span></button>
                  <h4 class="modal-title">Generate PIN</h4>
                </div>
                <div class="modal-body">
                  <p style="color: red;" id="msg"></p>
                  <?php if($this->logged['wallet']<$this->siteInfo['pin_amt'])
                  { ?>
                  		<h4>Sorry, You don't have enough Wallet Balance to Generate PIN.</h4>
                  <?php }else{ ?>
                  		<p id="err_msg" class="txtred"></p>
                  		<table class="table">
                  			<tr>
                  				<th>PIN Quantity</th><th>Price</th><th>Total</th>
                  			</tr>
                  			<tr>
                  				<td id="totalPin"></td><td>x<?=$this->siteInfo['pin_amt'];?></td><th id="total"></th>
                  			</tr>
                  			<tr>
                  				<td colspan="3"><button onclick="return generatePin()" type="submit" class="btn pull-right btn-sm btn-primary">Generate</button></td>
                  			</tr>
                  		</table>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <!-- Modal End -->

        <!-- Bootstrap Modal fo Pin Topup -->
          <div class="modal fade" id="topUpModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" style="color: red;"></span></button>
                  <h4 class="modal-title">Enter User ID</h4>
                </div>
                <div class="modal-body">
                	<div class="jumbotron">
                		<?=form_open('user/activePinViaTopup'); ?>
                		<div class="input-group form-group">
                		  <span class="input-group-btn">
                		  	<button class="btn btn-secondry" type="button">PIN</button>
                		  </span>
					      <input type="text" id="topupPin" name="pin" class="form-control" readonly>
					    </div>
                		<div class="input-group form-group">
					      <input type="text" id="userID" name="user_id" class="form-control" placeholder="Search for...">
					      <span class="input-group-btn">
					        <button id="verify" class="btn btn-warning" type="button">Verify!</button>
					      </span>
					    </div>
					    <div class="input-group form-group">
					    	<p class="txtblue text-center" id="topupPinMsg"></p>
					    </div>
                	</div>
                </div>
                <div class="modal-footer">

                </div>
                </form>
              </div>
            </div>
          </div>
        <!-- Modal End -->
<style type="text/css">
	table{
		font-size: 14px;
	}
</style>
<script type="text/javascript">
		$(document).ready(function() {
$('#table1').DataTable();
} );
	$('#pinGen').click(function(){
		$.ajax({
			url:"<?=base_url('control/pinGenerate');?>",
			
			success:function(data)
			{
				$('#pin').val(data);
			}
		});
	});
	$('#generatePin').click(function(){
		var pinAmt="<?=$this->siteInfo['pin_amt'];?>";
		$('#err_msg').html("");
		$('#totalPin').html($('#quantity').val());
		$('#total').html(($('#quantity').val())*pinAmt);
		$('#myModal').modal('show');
	});
	function pinTopup(pin){
		$('#topupPin').val(pin);
		$('#topupPinMsg').html('');
		$('#topUpModal').modal('show');
	}
	function generatePin()
	{
		var pinAmt="<?=$this->siteInfo['pin_amt'];?>";
		var quan=$('#quantity').val();
		var wallet=parseFloat('<?=$this->logged['wallet'];?>');
		var total=parseFloat(quan*pinAmt);
		if(wallet<total)
		{
			$('#err_msg').html("Sorry, You don't have enough wallet balance to generate "+ quan+ " PIN.<br> You may need additional INR "+ (total-wallet));
			return false;
		}else
		{
			$.ajax({
				url:"<?=base_url('user/pinGenerate');?>",
				data:{quantity:quan},
				type:'post',
				success:function(data)
				{
					//alert(data);
					if(data>0)
					{
						location.reload();
					}else
					{
						$('#err_msg').html("Sorry, PIN Generation Failed, Try Again");
					}
				}
			});
		}
	}
	$('#verify').click(function()
	{
		var uid=$('#userID').val();
			$.ajax({
				url:"<?=base_url('user/checkUserForpinTopup');?>",
				data:{user_id:uid},
				type:'post',
				success:function(data)
				{
					$('#topupPinMsg').html(data);
					// if(data>0)
					// {
					// 	location.reload();
					// }else
					// {
					// 	$('#err_msg').html("Sorry, PIN Generation Failed, Try Again");
					// }
				}
			});
	});
</script>