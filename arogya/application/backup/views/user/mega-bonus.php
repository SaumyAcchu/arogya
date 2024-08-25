<!DOCTYPE html>
<html>
<head>
	<title><?=$this->siteInfo['name'];?></title>
	<?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
	<div class="container-fluid no-padding display-table">
		<div class="row no-padding display-table-row">
			<div class="col-lg-2 no-padding col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
				<?php $this->load->view('includes/sidebar.php',['page'=>'mega-bonus']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Mega Bonus Status</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
	<?php
	$find=$this->db_model->getWhere('activated',['user_id'=>$this->logged['user_id']]);
	$lvl=$this->db_model->globalSelect('activated',['id>'=>$find['id']]);
	$count=count($lvl);
	$a=1;
	if($count>36)
	{ if($count>50){ $mx=14; }else{ $mx=$count-36; } ?><br><br>
		<legend>Mega Level 1</legend>
		<table class="table table-bordered">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $ml1=0;
			foreach ($lvl as $key => $value) {
			if($mx>$ml1){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns1=3000;?></td>
				</tr>
			<?php $a++; $ml1++;  } } ?>
		</table>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Mega Level 1 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$ml1;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$ml1*3000;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($ml1>13)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($ml1>13){ ?>
				<tr>
					<th>TDS 5% & Admin Charge 10%</th><td><?=$ded=((10000*15)/100);?></td>
				</tr>
				<tr>
					<th>Net Received Bouns</th><td><?=10000-$ded;?></td>
				</tr>
				<tr>
					<th>1st Mega Level Rejoining Amount</th><td>10000</td>
				</tr>
				<tr>
					<th>2nd Mega Level Joining Amount</th><td>32000</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
<?php } ?>
<?php
$a=1;
	if($count>50)
	{ if($count>64){ $mx=14; }else{ $mx=$count-50; } ?><br><br>
		<legend>Mega Level 2</legend>
		<table class="table table-bordered">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $ml2=0;
			foreach ($lvl as $key => $value) {
			if($mx>$ml2){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns1=6000;?></td>
				</tr>
			<?php $a++; $ml2++;  } } ?>
		</table>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Mega Level 2 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$ml2;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$ml2*6000;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($ml2>13)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($ml2>13){ ?>
				<tr>
					<th>TDS 5% & Admin Charge 10%</th><td><?=$ded=((34000*15)/100);?></td>
				</tr>
				<tr>
					<th>Net Received Bouns</th><td><?=34000-$ded;?></td>
				</tr>
				<tr>
					<th>1st Mega Level Rejoining Amount</th><td>10000</td>
				</tr>
				<tr>
					<th>3rd Mega Level Joining Amount</th><td>40000</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
<?php } ?>
<?php
$a=1;
	if($count>64)
	{ if($count>78){ $mx=14; }else{ $mx=$count-64; } ?><br><br>
		<legend>Mega Level 3</legend>
		<table class="table table-bordered">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $ml2=0;
			foreach ($lvl as $key => $value) {
			if($mx>$ml2){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns1=12000;?></td>
				</tr>
			<?php $a++; $ml2++;  } } ?>
		</table>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Mega Level 3 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$ml2;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$ml2*12000;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($ml2>13)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($ml2>13){ ?>
				<tr>
					<th>TDS 5% & Admin Charge 10%</th><td><?=$ded=((100000*15)/100);?></td>
				</tr>
				<tr>
					<th>Net Received Bouns</th><td><?=100000-$ded;?></td>
				</tr>
				<tr>
					<th>1st Mega Level Rejoining Amount</th><td>10000</td>
				</tr>
				<tr>
					<th>4th Mega Level Joining Amount</th><td>58000</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
<?php } ?>
<?php
$a=1;
	if($count>78)
	{ if($count>92){ $mx=14; }else{ $mx=$count-78; } ?><br><br>
		<legend>Mega Level 4</legend>
		<table class="table table-bordered">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $ml2=0;
			foreach ($lvl as $key => $value) {
			if($mx>$ml2){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns1=18000;?></td>
				</tr>
			<?php $a++; $ml2++;  } } ?>
		</table>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Mega Level 4 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$ml2;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$ml2*18000;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($ml2>13)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($ml2>13){ ?>
				<tr>
					<th>TDS 5% & Admin Charge 10%</th><td><?=$ded=((152000*15)/100);?></td>
				</tr>
				<tr>
					<th>Net Received Bouns</th><td><?=152000-$ded;?></td>
				</tr>
				<tr>
					<th>1st Mega Level Rejoining Amount</th><td>10000</td>
				</tr>
				<tr>
					<th>5th Mega Level Joining Amount</th><td>90000</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
<?php } ?>
<?php
$a=1;
	if($count>92)
	{ if($count>106){ $mx=14; }else{ $mx=$count-92; } ?><br><br>
		<legend>Mega Level 5</legend>
		<table class="table table-bordered">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $ml2=0;
			foreach ($lvl as $key => $value) {
			if($mx>$ml2){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns1=25000;?></td>
				</tr>
			<?php $a++; $ml2++;  } } ?>
		</table>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Mega Level 5 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$ml2;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$ml2*25000;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($ml2>13)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($ml2>13){ ?>
				<tr>
					<th>TDS 5% & Admin Charge 10%</th><td><?=$ded=((350000*15)/100);?></td>
				</tr>
				<tr>
					<th>Net Received Bouns</th><td><?=350000-$ded;?></td>
				</tr>
				<tr>
					<th>1st Mega Level Rejoining Amount</th><td>10000</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
<?php } ?>
<!-- ///=====================All Contents End Here============================================/// -->
				</div>
				<?php $this->load->view('includes/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
function redeemBonus(bonus,level)
{
	var cnf=confirm('Are you sure to Redeem Your Bonus');
	if(cnf)
	{ 
		$.ajax({
			url:"<?=base_url('user/megaBonusRedeem');?>",
			type:'post',
			data:{amount:bonus,mega_bonus_level:level},
			success:function(data)
			{
				location.reload();
			}
		});
	}else
	{ 
		return false;
	}
}
</script>
<style type="text/css">
	
</style>