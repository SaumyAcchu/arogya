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
				<?php $this->load->view('includes/sidebar.php',['page'=>'balance-transfer']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Balanace Transfer</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="panel-title">Enter Beneficiary User ID	</span>
						</div>
						<div class="panel-body">
							<center><h4>Available Amount To Send : <b class="txtred"><?=$this->logged['wallet'];?></b></h4></center>
							<div class="row form-horizontal">
								<div class="form-group">
									<?php if($this->logged['status']==1){ ?>
									<div class="col-sm-2"></div>
									<label class="col-sm-2 control-label">Beneficiary User ID</label>
									<div class="col-sm-3">
										<input type="text" name="beneficiary" id="user_id" class="form-control txtupper" placeholder="Please Enter user ID" value="<?=set_value('beneficiary');?>" required>
									</div>
									<div class="col-sm-2">
										<input type="button" onclick="return validate()" class="form-control btn btn-primary" value="Validate" required>
									</div>
									<?php }else{ ?>
										<center>Sorry, You Can't Transfer balance, untill your account is active.</center>
									<?php } ?>
								</div>
							</div>
							<input type="hidden" name="" value="<?=$this->logged['user_id'];?>" id="loggedUser">
							<div class="row" id="result">
								
							</div>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<span class="panel-title">Balance Transfer Details</span>
						</div>
						<div class="panel-body">
							<table class="table table-bordered table-striped" id="table1">
							<thead>
								<tr>
									<th>Sl</th>
									<th>TRXN</th>
									<th>Receiver Id</th>
									<th>Date</th>
									<th>Time</th>
									<th>Amount</th>
									<th>Transfer Type</th>
								</tr>
								</thead>
								<tbody>
							<?php $tran=$this->db_model->globalSelect('commission',['type'=>'transfer','user_id'=>$this->logged['user_id']]);
							if(!empty($tran)){ $i=1;
							foreach ($tran as $key => $value) { ?>
								<tr>
									<td><?=$i;?></td>
									<td><?=$value['transaction'];?></td>
									<td><?=$value['beneficiary'];?></td>
									<td><?=$value['date'];?></td>
									<td><?=$value['time'];?></td>
									<td><?=$value['amount'];?></td>
									<td>
									<?php
									if($value['wallet_type']=='topup')
									{
									 	echo "TopUp Wallet";
									} else {
										echo "Cash Wallet"; 
									} ?>
									</td>
								</tr>
							<?php $i++; } }else{ ?>
								<tr>
									<td colspan="7">No Records Found</td>
								</tr>
							<?php } ?>
							</tbody> 
							</table>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<span class="panel-title">Balance Received Details</span>
						</div>
						<div class="panel-body">
							<table class="table table-bordered table-striped" id="table2">
								<thead>
								<tr>
									<th>Sl</th>
									<th>TRXN</th>
									<th>Sender Id</th>
									<th>Date</th>
									<th>Time</th>
									<th>Amount</th>
									<th>Transfer Type</th>
								</tr>
								</thead>
								<tbody>
							<?php $tran=$this->db_model->globalSelect('commission',['type'=>'transfer','beneficiary'=>$this->logged['user_id']]);
							if(!empty($tran)){ $j=1;
							foreach ($tran as $key => $value) { ?>
								<tr>
									<td><?=$j;?></td>
									<td><?=$value['transaction'];?></td>
									<td><?=$value['user_id'];?></td>
									<td><?=$value['date'];?></td>
									<td><?=$value['time'];?></td>
									<td><?=$value['amount'];?></td>
									<td>
									<?php if($value['wallet_type']=='topup')
									{
									 	echo "TopUp Wallet";
									}else{
										echo "Cash Wallet"; 
									} ?>
									</td>
								</tr>
								
							<?php $j++; } }else{ ?>
								<tr>
									<td colspan="7">No Records Found</td>
								</tr>
							<?php } ?>
							</tbody>
							</table>
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
<script type="text/javascript">
$(document).ready(function() {
$('#table1').DataTable();
} );

$(document).ready(function() {
$('#table2').DataTable();
} );
	function validate(){
		var user_id=$('#user_id').val().toUpperCase();
		var s_id=$('#loggedUser').val().toUpperCase();
		// if(s_id==user_id)
		// {
		// 	$('#result').html('<p class="txtred txtcenter">Sorry, You can not Transfer Balance to Self</p>');
		// 	return false;
		// }
		
		$.ajax({
			url:"<?=base_url('user/checkBalanceTransfer');?>",
			type:'post',
			data:{user_id:user_id},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	function transfer()
	{
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
		var avl=parseFloat(<?=$this->logged['wallet'];?>);
		if(amt>avl)
		{
			$('#errAmt').html('Sorry, You have not enough Balance to Transfer. You may need additional INR '+ (amt-avl)+ ' in your wallet.');
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
		var cnf=confirm('Are You Sure to Balance Transfer.');
		return cnf;
	}


</script>