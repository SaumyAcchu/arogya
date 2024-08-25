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
				<?php $this->load->view('includes/sidebar.php',['page'=>'direct-reward']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Direct Reward</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
				<div class="col-lg-12">
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">1x6 Direct Reward</span>
						</div>
						<div class="panel-body">
							<table id="table1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Time Slot</th>
										<th>Date From</th>
										<th>Date To</th>
										<th>Directs</th>
										<th>Bonus</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
				
				<?php
					// unset($_SESSION['dList']);
					// $res=$this->Commission_model->downLine($this->logged['user_id']);
					// $arr=$_SESSION['dList'];
					//krsort($arr);
					//echo '<pre>'; print_r($data); exit();
					$date1=date_create($this->logged['reg_date']);
					$date2=date_create(date('Y-m-d'));
			        $diff=date_diff($date1,$date2);
			        $days=$diff->format("%a days");
			        $totalslot=round($days/$data[0]['days']);
			        $dateFrom=$this->logged['reg_date'];
					date_add($date1,date_interval_create_from_date_string("+ ".($data[0]['days']-1)." Days"));
					$dateTo= date_format($date1,"Y-m-d");
					$count=0;
			        for ($i=1; $i <=$totalslot ; $i++)
			        { 
			        	//echo $dateFrom." To ".$dateTo."<br>";
			        	$condition=['reg_date>='=>$dateFrom,'reg_date<='=>$dateTo,'sponcer_id'=>$this->logged['user_id'],'status'=>1];
			        	$rec=$this->db_model->globalSelect('users',$condition);
			        	if(count($rec)>5)
			        	{
			        		$num=count($rec);
			        		$multi=floor(count($rec)/6); ?>
			        			<tr>
			        				<td><?=$i;?></td>
			        				<td><?=$this->db_model->dateFormat($dateFrom);?></td>
			        				<td><?=$this->db_model->dateFormat($dateTo);?></td>
			        				<td><?=count($rec);?></td>
			        				<td><?=$netAmt=($data[0]['amount']*$multi);?></td>
			        				<td>
			        				<?php 
			        				  $condition=['date_from'=>$dateFrom,'date_to<='=>$dateTo,'user_id'=>$this->logged['user_id'],'status'=>1];
			        				  $red=$this->db_model->rowCount('bonus_redeem',$condition);
			        				  if($red>0)
			        				  {
			        				  	?><button class="btn btn-primary btn-sm" disabled>Redeemed</button><?php
			        				  }else
			        				  {
			        				  	?><button class="btn btn-primary btn-sm" onclick="redeemBonus6('<?=$dateFrom;?>','<?=$dateTo;?>','<?=$netAmt;?>','<?=$i;?>','<?=$num;?>','1x6')">Redeem</button><?php
			        				  }
			        				 ?>
			        				</td>
			        			</tr>
			        		<?php $count++;
			        	}
			        	$date1=date_create($dateTo);
			        	date_add($date1,date_interval_create_from_date_string("1 Day"));
						$dateFrom= date_format($date1,"Y-m-d");
			        	date_add($date1,date_interval_create_from_date_string("+ ".($data[0]['days']-1)." Days"));
						$dateTo= date_format($date1,"Y-m-d");
			        }
			        if($count<1)
			        {
			        	echo "<td colspan='6'>You did not get any 1x6 Direct Reward till now.</td>";
					}
				?>
								</tbody>
							</table>
						</div>
					</div>
				</div>



				<div class="col-lg-12">
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">6x6 Direct Reward</span>
						</div>
						<div class="panel-body">
							<table id="table1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Time Slot</th>
										<th>Date From</th>
										<th>Date To</th>
										<th>Directs</th>
										<th>Bonus</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
				
				<?php
					//echo '<pre>'; print_r($data); exit();
					$date1=date_create($this->logged['reg_date']);
					$date2=date_create(date('Y-m-d'));
			        $diff=date_diff($date1,$date2);
			        $days=$diff->format("%a days");
			        $totalslot=round($days/$data[1]['days']);
			        $dateFrom=$this->logged['reg_date'];
					date_add($date1,date_interval_create_from_date_string("+ ".($data[1]['days']-1)." Days"));
					$dateTo= date_format($date1,"Y-m-d");
					$count=0;
			        for ($i=1; $i <=$totalslot ; $i++)
			        { 
			        	//echo $dateFrom." To ".$dateTo."<br>";
			        	$condition=['reg_date>='=>$dateFrom,'reg_date<='=>$dateTo,'sponcer_id'=>$this->logged['user_id'],'status'=>1];
			        	$rec=$this->db_model->globalSelect('users',$condition);
			        	$dir=0;
			        	if(count($rec)>5)
			        	{

			        		foreach($rec as $key => $value)
			        		{
			        			$condition1=['reg_date>='=>$dateFrom,'reg_date<='=>$dateTo,'sponcer_id'=>$value['user_id'],'status'=>1];
					        	$rec1=$this->db_model->globalSelect('users',$condition1);
					        	if(count($rec1)>5)
					        	{
					        		$dir++;
					        	}
			        		}
			        		if($dir>5)
			        		{
			        			$multi1=floor($dir/6); ?>
			        			<tr>
			        				<td><?=$i;?></td>
			        				<td><?=$this->db_model->dateFormat($dateFrom);?></td>
			        				<td><?=$this->db_model->dateFormat($dateTo);?></td>
			        				<td><?=$dir;?>x6</td>
			        				<td><?=$netAmt1=($data[1]['amount']*$multi1);?></td>
			        				<td>
			        				<?php 
			        				  $condition=['date_from'=>$dateFrom,'date_to<='=>$dateTo,'user_id'=>$this->logged['user_id'],'status'=>1];
			        				  $red=$this->db_model->rowCount('bonus_redeem',$condition);
			        				  if($red>0)
			        				  {
			        				  	?><button class="btn btn-primary btn-sm" disabled>Redeemed</button><?php
			        				  }else
			        				  {
			        				  	?><button class="btn btn-primary btn-sm" onclick="redeemBonus6('<?=$dateFrom;?>','<?=$dateTo;?>','<?=$netAmt;?>','<?=$i;?>','<?=$dir;?>','6x6')">Redeem</button><?php
			        				  }
			        				 ?>
			        				</td>
			        			</tr><?php
			        		}
			        	}
			        	$date1=date_create($dateTo);
			        	date_add($date1,date_interval_create_from_date_string("1 Day"));
						$dateFrom= date_format($date1,"Y-m-d");
			        	date_add($date1,date_interval_create_from_date_string("+ ".($data[0]['days']-1)." Days"));
						$dateTo= date_format($date1,"Y-m-d");
			        }
			        if($dir<5)
			        {
			        	echo "<td colspan='6'>You did not get any 6x6 Direct Reward till now.</td>";
					}
				?>
								</tbody>
							</table>
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
<script type="text/javascript">
	function redeemBonus6(from,to,amt,t_slot,dir,type)
	{
		//alert(from+to+amt+t_slot+dir+type);
		$.ajax({
			url:"<?=base_url('user/redeemDirectBonus');?>",
			type:'post',
			data:{date_from:from,date_to:to,amount:amt,directs:dir,time_slot:t_slot,type:type},
			success:function(data)
			{
				location.reload();
			}
		});
	}
</script>
<style type="text/css">
	
</style>