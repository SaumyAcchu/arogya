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
				<?php $this->load->view('includes/sidebar.php',['page'=>'reward']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Self Team Reward</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
				<?php
					unset($_SESSION['dList']);
					$res=$this->Commission_model->downLine($this->logged['user_id']);
					$arr=$_SESSION['dList'];
					//krsort($arr);
					//echo '<pre>'; print_r($arr); exit();
					 if($arr)
					 { $i=1; $total=0; 
						foreach ($arr as $key1 => $val)
						{
							foreach ($val as $key2 => $value)
							{
								if($value['status']==1)
								{
									$total=$total+$this->siteInfo['business'];
									$i++;
								}
							}
						}
					}else
					{
						$total=0;
					}
				?>
				<?php $target=0; $prev=0;
				foreach ($data as $key => $value)
				{  ?>
					<div class="panel panel-info">
						<div class="panel-heading">
							<p class="panel-title">Reward : <?=$value['level'];?></p>
						</div>
						<div class="panel-body">
							<div class="col-lg-12">
							  <button class="btn btn-info"> Current Business <span class="badge">₹ <?php $curr=$total-$prev; if($curr<0){ echo 0; $i=0; } else { echo number_format($curr); } ?></span></button>
							  <div class=" btn-group pull-right">
								<button class="btn btn-info">Reward Target : <span class="badge"> ₹ <?=number_format($value['target']);?></span></button>
							  </div>
							</div>
							<center>
								<h5> Rewards</h5>
								<div class="btn-group">
								<button class="btn btn-primary">Bonus : <span class="badge"> ₹ <?= number_format($value['bonus']); ?></span></button>
								<button class="btn"> OR </button>
								<button class="btn btn-primary"> Gift : <span class="badge">  <?=$value['optional'];?></span></button>
							  </div></center>
							<?php
								$target=$target+$value['target'];
								$per=($curr*100)/$target;
								$per=round($per, 2);
								if($per>=100)
								{
									$per= 100;
								}
								if($per<0){ $per=0; }
							?>
							<hr>
							<div class="col-lg-12">
							  <div class="row">
							    <div class="col-sm-2">
									<p class="txtblue">Business Status <?=$per;?>%</p>
								</div>
								<div class="col-sm-10">
								  <div class="progress">
									<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?=$per;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$per;?>%">
								    <?=$per;?>% Complete
									</div>
								  </div>
								</div>
							  </div>
							</div>
						</div>
						<!-- <?php if($total>$target) { ?>
						<div class="panel-footer">
							<center>
							<?php $que=$this->db_model->rowCount('mega_bonus_redeem',['user_id'=>$this->logged['user_id'],'reward_level'=>$value['level']]);
							if($que>0){ ?>
							<button class="btn btn-primary" disabled>Bonus Redeemed <i class="fa fa-check-square-o" aria-hidden="true"></i></button></center>
							<?php } else { ?>
							<button onclick="return redeemBonus('<?=$value['bonus'];?>','<?=$value['level'];?>')" class="btn btn-primary">Redeem Bonus <i class="fa fa-download"></i></button>
							<?php } ?>
							</center>
						</div>
						<?php } ?> -->
					</div>
				<?php $prev=$value['target']; } ?>
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
	var cnf=confirm(' On Redeem Bonus, Amount will be Credited in your Wallet. If you want to price in place of Amount Contact Administrator.');
	if(cnf)
	{ 
		$.ajax({
			url:"<?=base_url('user/megaBonusRedeem/reward');?>",
			type:'post',
			data:{amount:bonus,reward_level:level},
			success:function(data)
			{
				//alert(data);
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