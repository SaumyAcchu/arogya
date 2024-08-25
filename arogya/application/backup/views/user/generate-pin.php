<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
	<div class="container-fluid no-padding display-table">
		<div class="row no-padding display-table-row">
			<div class="col-lg-2 no-padding bx-shdw col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
				<?php $this->load->view('includes/sidebar.php',['page'=>'pin-generate']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>PIN Generate</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
					<div class="row">
						<div class="col-lg-9">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Generated PIN Status</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered table-striped">
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
										  $res=$this->db_model->globalSelect('pin',['user_id'=>$this->logged['user_id']]);
										  	if($res) { 
										   $i=1;
										  foreach($res as $key => $value)
										  { ?>
											<tr>
												<td><?=$i;?></td>
												<td><?=$value['pin'];?></td>
												<td><?=$value['gen_date'];?></td>
												<td><?=ucfirst($value['generate_by']);?></td>
												<td>
													<?=($value['status']==1)?'<button class="btn btn-sm btn-success btn-block">Active</button>':'<button class="btn btn-sm btn-warning btn-block">Deactive</button>';?>
												</td>
												<td><?php
													if($value['activated_account']) {
													echo $value['activated_account'];
												}else { ?>
												<a href="#" onclick="return pinTopup('<?=$value['pin'];?>')" class="btn btn-sm btn-info btn-block">Topup Pin</a>
													<?php } ?>	
												</td>
												<td>
													<?php if($value['status']!=1){ ?>
														<a href="<?=base_url("direct/joinWithPin/".base64_encode($this->logged["user_id"].'/'.$value['pin']));?>" class="btn btn-sm btn-success btn-block">Join</a>
													<?php }else{ ?>
														<a href="#" class="btn btn-sm btn-info btn-block">Joined</a>
													<?php } ?>
												</td>
											</tr>
										  <?php $i++; } }else { ?>
											<tr>
												<td colspan="5">No PIN Generated Yet.</td>
											</tr>
										  <?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">PIN Requests to Administrator</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Sl No</th>
												<th>Quantity</th>
												<th>Payment Detail</th>
												<th>Message</th>
												<th>Date</th>
												<th>PIN</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										  <?php
										  	if($data) { 
										   $i=1;
										  foreach($data as $key => $value)
										  { ?>
											<tr>
												<td><?=$i;?></td>
												<td><?=$value['quantity'];?></td>
												<td><?=$value['payment_detail'];?></td>
												<td><?=$value['message'];?></td>
												<td><?=($value['status']==1)?$value['gen_date']:$value['req_date'];?></td>
												<td><?=$value['pin'];?></td>
												<td>
													<?=($value['status']==1)?'<button class="btn btn-sm btn-success">Generated</button>':'<button class="btn btn-sm btn-warning">Pending</button>';?>
												</td>
											</tr>
										  <?php } }else { ?>
											<tr>
												<td colspan="7">No Requests Found Yet.</td>
											</tr>
										  <?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel panel-primary">
		                        <div class="panel-heading">
			                        <div class="row">
			                        	<div class="col-xs-4">
			                            	<i class="fa fa-inr fa-5x"></i>
			                          	</div>
			                          	<div class="col-xs-8 text-right">
			                            	<p class="announcement-heading">Wallet Balanace</p>
			                            	<h3 class="announcement-text"><?=$this->logged['wallet'];?></h3>
			                          	</div>
			                        </div>
		                        </div>
		                    </div>
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
		                    <h4 class="txtcenter">OR</h4>
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Request to Administrator</h3>
								</div>
								<div class="panel-body">
								  <?=form_open('user/pinRequest'); ?>
									<div class="form-group">
										<label>No. of PINs</label>
										<input type="text" name="quantity" placeholder="quantity" id="" value="1" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Payment Detail</label>
										<input type="text" name="payment_detail" placeholder="Payment Details" id="" value="" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Message</label>
										<textarea name="message" class="form-control" required></textarea>
									</div>
									<div class="form-group">
										<button id="" class="btn btn-info btn-block">Send Request <i class="fa fa-location-arrow"></i></button>
									</div>
								  </form>
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
                	<div class="col-sm-12">
                		<?=form_open('user/activePinViaTopup'); ?>
                		<div class="input-group">
                		  <span class="input-group-btn">
                		  	<button class="btn btn-secondry" type="button" style="margin-top: 5px;">PIN</button>
                		  </span>
					      <input type="text" id="topupPin" name="pin" class="form-control" readonly>
					    </div>
                		<div class="input-group">

					      <input type="text" id="userID" name="user_id" class="form-control" placeholder="Search for...">
					      <span class="input-group-btn">
					        <button id="verify" class="btn btn-warning" type="button" style="margin-top: 5px;">Verify!</button>
					      </span>
					    </div>
					    <div class="input-group">
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

<script type="text/javascript">
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