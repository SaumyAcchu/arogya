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
				<?php $this->load->view('includes/sidebar.php',['page'=>'fund-withdraw']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Fund Withdraw</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="panel-title">Send Request to Administrator</span>
						</div>
						<div class="panel-body">
							<center><h4>Available Amount To Withdraw : <b class="txtred">
								<?php if($this->logged['status']==1)
								{ 
									echo number_format($this->logged['wallet'],2);
								 }else {
									echo number_format((($this->logged['wallet']*50)/100),2); 
								 }  ?>
							</b></h4></center>
							<hr>
							<div class="col-lg-6 col-lg-offset-3 jumbotron">
							<?=form_open('user/fundWithdraw');?>
							<div class="row form-horizontal">
								<div class="form-group">
									<label class="col-lg-5 control-label">Payment Methode : </label>
									<div class="col-lg-7">
										<select id="payment_mode" class="form-control" name="payment_mode" required>
											<option value="">Select Payment Methode</option>
											<option value="Paytm">Paytm Account</option>
											<option value="Bank">Bank Account</option>
											<option value="DC Withdrawal">DC Withdrawal</option>
										</select>
										<span id="errMode" class="txtred"></span>
									</div>
								</div>
							<div id="paytm">
								
							</div>
							<div id="bank">
								
							</div>
								<div class="form-group">
									<label class="col-lg-5 control-label">Amount : </label>
									<div class="col-lg-7">
										<input type="text" id="amount" name="amount" class="form-control" value="" min="1" placeholder="Enter amount to Withdraw" required>
										<span id="errAmt" class="txtred"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-5"></div>
									<div class="col-lg-7">
										<button onclick="return withdraw()" class="btn btn-primary"> Submit </button>
									</div>
								</div>
							</div>
							</form>
							</div>
							<div class="col-lg-12">
								<?php if($data){ ?>
								<table class="table">
									<tr>
										<th>Sl</th>
										<th>Payment Trnx</th>
										<th>Payment Mode</th>
										<th>Account Number</th>
										<th>Bank</th>
										<th>Branch</th>
										<th>IFSC</th>
										<th>Req Date</th>
										<th>Paid Date</th>
										<th>Amount</th>
										<th>Status</th>
									</tr>
									<?php $i=1; foreach ($data as $key => $value){ ?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$value['trnx_num'];?></td>
										<td><?=ucfirst($value['payment_mode']);?></td>
										<td><?=$value['account_number'];?></td>
										<td><?=$value['bank_name'];?></td>
										<td><?=$value['branch_name'];?></td>
										<td><?=$value['ifsc'];?></td>
										<td><?=$this->db_model->dateFormat($value['date']);?></td>
										<td><?=$this->db_model->dateFormat($value['paid_date']);?> <?=$value['paid_time'];?></td>
										<td><?=$value['amount'];?></td>
										<td>
											<?php if($value['status']==1) { ?>
											<button class="btn btn-success btn-sm" disabled>Paid</button>
											<?php }else{ ?>
											<button class="btn btn-warning btn-sm">Pending</button>
											<?php } ?>
										</td>
									</tr>
									<?php $i++; } ?>
								</table>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php if($this->logged['status']==1)
					{ ?>
						<input type="hidden" id="availableAmt" value="<?=$this->logged['wallet'];?>">
					<?php }else {
						$wal=(($this->logged['wallet']*50)/100); ?>
						<input type="hidden" id="availableAmt" value="<?=$wal;?>">
					<?php }  ?>
<!-- ///=====================All Contents End Here============================================/// -->
				</div>
				<?php $this->load->view('includes/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$('#validate').click(function(){
		var user_id=$('#user_id').val();
		var s_id="<?=$this->logged['user_id'];?>";
		if(s_id==user_id)
		{
			$('#result').html('<span class="txtred txtcenter">Sorry, You can not Transfer Balance to Self</span>');
			return false;
		}
		//alert(user_id);
		$.ajax({
			url:"<?=base_url('user/checkBalanceTransfer');?>",
			type:'post',
			data:{user_id:user_id},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	});
	function withdraw()
	{
		var mode = $('#payment_mode :selected').val();
		if(($.trim(mode))=='')
		{
			$('#errMode').html('Please Select Payment Mode');
			return false;
		}
		var amt=$('#amount').val();
		if(($.trim(amt))=='')
		{
			$('#errAmt').html('Amount is Required');
			return false;
		}
		if(amt<1)
		{
			$('#errAmt').html('Amount Must be Greater Than 0');
			return false;
		}
		var avl=parseFloat($('#availableAmt').val());
		if(amt>avl)
		{
			$('#errAmt').html('Sorry, You have not enough Balance to Withdraw. You may need additional INR '+ (amt-avl)+ ' in your wallet.');
			return false;
		}
		var cnf=sendConfirm();
		if(cnf)
		{
			return true;
		}else
		{
			return false;
		}
	}
	function sendConfirm()
	{
		var cnf=confirm('Are You Sure to Withdraw Amount.');
		return cnf;
	}
	$('#payment_mode').change(function(){
		$('#errMode').html('');
		var mode=this.value;
		if(mode=='Paytm')
		{
			$('#paytm').html('<div class="form-group"><label class="col-lg-5 control-label">Paytm Account : </label><div class="col-lg-7"><input type="text" name="account_number" class="form-control" value="<?=$this->logged['paytm'];?>" required></div></div>');
			$('#bank').html('');
		}
		if(mode=='Bank')
		{
			$('#bank').html('<div class="form-group"><label class="col-lg-5 control-label">Account Number: </label><div class="col-lg-7"><input type="text" name="account_number" class="form-control" value="<?=$this->logged['account_number'];?>" required></div></div><div class="form-group"><label class="col-lg-5 control-label">Bank Name : </label><div class="col-lg-7"><input type="text" name="bank_name" class="form-control" value="<?=$this->logged['bank_name'];?>" required></div></div><div class="form-group"><label class="col-lg-5 control-label">Branch Name : </label><div class="col-lg-7"><input type="text" name="branch_name" class="form-control" value="<?=$this->logged['branch_name'];?>" required></div></div><div class="form-group"><label class="col-lg-5 control-label">IFSC Code : </label><div class="col-lg-7"><input type="text" name="ifsc" class="form-control" value="<?=$this->logged['ifsc'];?>" required></div></div>');
			$('#paytm').html('');
		}
		if(mode=='')
		{
			$('#paytm').html('');
			$('#bank').html('');
		}
		if(mode=='DC Withdrawal')
		{
			$('#paytm').html('');
			$('#bank').html('');
		}

	});
</script>