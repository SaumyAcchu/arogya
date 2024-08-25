<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Withdraw Amount';?> | <?=$this->siteInfo['name'];?></title>
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
							<span class="panel-title">Send Withdrawal Request to Administrator</span>
						</div>
						<div class="panel-body">
							<center><h4>Available Amount To Withdraw : <b class="txtred">
								<?php echo number_format($this->logged['wallet'],2); ?>
							</b></h4>
							<h5>Fund Withdraw only Saturday 10 AM To 10 PM.</h5>
							<h6>Minimum Withdraw Amount Bank : 500, Paytm : 500</h6>
							</center>
							<hr>
							<div class="col-lg-6 col-lg-offset-3 well">
							<?php 
							if(date('D')=='Sat' && date('H:i:s')>'10:00:00' && date('H:i:s')<'22:00:00' && $this->logged['wallet']>99 && $this->logged['pan']!='')
							{
								echo form_open('user/fundWithdraw');
							}	?>
							<div class="row form-horizontal">
								<div class="form-group">
									<label class="col-lg-5 control-label">Payment Methode : </label>
									<div class="col-lg-7">
										<select id="payment_mode" class="form-control" name="payment_mode" required>
											<option value="">Select Payment Methode</option>
											<option value="Paytm">Paytm Account</option>
											<option value="Bank">Bank Account</option>
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
										<input type="number" id="amount" name="amount" class="form-control" value="" min="1" placeholder="Enter amount to Withdraw" <?=(date('D')!='Sat')?'readonly':'';?> required>
										<span id="errAmt" class="txtred"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-5"></div>
									<div class="col-lg-7">


										<?php
										if(date('D')=='Sat' && date('H:i:s')>'10:00:00' && date('H:i:s')<'22:00:00' && $this->logged['wallet']>99)
							            { 
							             if($this->logged['pan']!='')
							             {
							             	echo '<button onclick="return withdraw()" class="btn btn-primary"> Submit </button></form>';
							             }else
							             {
							             	echo '<button class="btn btn-danger" disabled=""> Please Update Your PAN Card First </button>';
							             }	?>
										<?php }else{ 
										    echo '<button class="btn btn-danger" disabled=""> Withdraw only Saturday </button>';
										} ?>
									
									</div>
								</div>
							</div>

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
										<td><?=$this->dbm->dateFormat($value['date']);?> <?=$value['time'];?></td>
										<td><?=($value['paid_date']!='')?$this->dbm->dateFormat($value['paid_date']):'';?> <?=$value['paid_time'];?></td>
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
					<?php }else { ?>
						<input type="hidden" id="availableAmt" value="0">
					<?php }  ?>          
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
		
		var avl=parseFloat($('#availableAmt').val());
		if(amt>avl)
		{
			$('#errAmt').html('Sorry, You have not enough Balance to Withdraw. You may need additional INR '+ (amt-avl)+ ' in your wallet.');
			return false;
		}
		if(amt<500)
		{
			$('#errAmt').html('Amount Must be Equal or Greater Than 100');
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
			$('#paytm').html('<table class="table"><tr><th>Paytm Number</th><td>: <?=($this->logged['paytm']!='')?$this->logged['paytm']:'Not Added Yet';?> <a class="pull-right btn btn-xs btn-primary" href="<?=base_url('user/explore/my-profile');?>">Edit</a></td></tr></table>');
			$('#bank').html('');
		}
		if(mode=='Bank')
		{
			$('#bank').html('<table class="table"><tr><th>A/c Number</th><td>: <?=($this->logged['account_number']!='')?$this->logged['account_number']:'Not Added Yet';?></td><th>Bank</th><td>: <?=($this->logged['bank_name']!='')?$this->logged['bank_name']:'Not Added Yet';?></td></tr><tr><th>Branch Number</th><td>: <?=($this->logged['branch_name']!='')?$this->logged['branch_name']:'Not Added Yet';?></td><th>IFSC</th><td>: <?=($this->logged['ifsc']!='')?$this->logged['ifsc']:'Not Added Yet';?> <a class="pull-right btn btn-xs btn-primary" href="<?=base_url('user/explore/my-profile');?>">Edit</a></td></tr></table>');
			$('#paytm').html('');
		}
		if(mode=='')
		{
			$('#paytm').html('');
			$('#bank').html('');
		}
	});
</script>