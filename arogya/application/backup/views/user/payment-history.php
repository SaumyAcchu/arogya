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
				<?php $this->load->view('includes/sidebar.php',['page'=>'payment-history']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Payment History</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Payment History</span>
						</div>
						<?php
							$amt=0;
							$bonus=0;
							$directBonus=0;
						?>
						<div class="panel-body">
							<div class="row">
							<div class="col-lg-8 col-lg-offset-2">
							    <form method="post" class="form-horizontal">
								<table class="table table-striped table-hover table-bordered">
								    <tr>
								      <td>
								        <div class="input-group" id="datepairExample">
								           <span class="input-group-addon" id="basic-addon1">From</span>
								           <input type="text" value="<?=set_value('dateFrom');?>" name="dateFrom" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
								           <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
								        </div>
								      </td>
								      <td>
								      	<div class="input-group" id="datepairExample">
								           <span class="input-group-addon" id="basic-addon1">To</span>
								           <input type="text" value="<?=set_value('dateFrom');?>" name="dateTo" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
								           <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
								        </div>
								      </td>
								      <td style="padding-top: 12px;">
								     	<button type="submit" name="report" class="btn btn-danger btn-sm"> Filter </button>
								      </td>
								    </tr>
								</table>
								</form>
						  	</div>
						  	</div>
							<h4 class="txtblue">Payment by Bonus/Transfer-Credit</h4>
							<table id="table1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>TRXN</th>
										<th>Get From</th>
										<th>Date</th>
										<th>Level</th>
										<th>Type</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
								<?php if($data){ $i=1; 
								foreach ($data as $key => $value) {
									if(isset($_POST['report']))
										{
											$from=$_POST['dateFrom']; $to=$_POST['dateTo'];
											if($value['date']>=$from && $value['date']<=$to)
											{ ?>
												<tr>
													<td><?=$value['transaction'];?></td>
													<td>
													  <?php if($value['type']=='transfer')
														{
															echo $value['user_id'];
														}else
														{
															echo $value['sponcer_id'];
														}
													  ?>
													</td>
													<td><?=$this->db_model->dateFormat($value['date']);?></td>
													<td><?=$value['level'];?></td>
													<td><?=ucfirst($value['type']);?></td>
													<td><?=$value['amount'];
													$amt=$amt+$value['amount']; ?></td>
												</tr><?php
											}
										}
										else
										{ ?>
											<tr>
												<td><?=$value['transaction'];?></td>
												<td>
												  <?php if($value['type']=='transfer')
													{
														echo $value['user_id'];
													}else
													{
														echo $value['sponcer_id'];
													}
												  ?>
												</td>
												<td><?=$this->db_model->dateFormat($value['date']);?></td>
												<td><?=$value['level'];?></td>
												<td><?=ucfirst($value['type']);?></td>
												<td><?=$value['amount'];
												$amt=$amt+$value['amount']; ?></td>
											</tr><?php
										} ?>
										
								<?php $i++; }	}else{ ?>
									<tr>
										<td colspan="6">No Records Found</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>

							<?php $que=$this->db_model->globalSelect('mega_bonus_redeem',['user_id'=>$this->logged['user_id']]);
							if($que)
							{ ?>
							<hr>
							<h4 class="txtblue">Bonus Redeemed</h4>
							<table id="table1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>TRXN</th>
										<th>Date</th>
										<th>Level</th>
										<th>Amount</th>
										<th>Type</th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1; 
								foreach ($que as $key => $value) {
									if(isset($_POST['report']))
									{
										$from=$_POST['dateFrom']; $to=$_POST['dateTo'];
										if($value['date']>=$from && $value['date']<=$to)
										{ ?>
											<tr>
												<td><?=$value['transaction'];?></td>
												<td><?=$this->db_model->dateFormat($value['date']);?></td>
												<td>
													<?php if($value['type']=='reward')
													{
														echo $value['reward_level'];
													}else
													{
														echo $value['mega_bonus_level']." (".ucfirst($value['business_type']).")";
													} ?>
												</td>
												<td><?=$value['amount'];
												$bonus=$bonus+$value['amount'];?></td>
												<td><?=ucfirst($value['type']);?></td>
											</tr><?php
										}
									}
									else
									{ ?>
										<tr>
											<td><?=$value['transaction'];?></td>
											<td><?=$this->db_model->dateFormat($value['date']);?></td>
											<td>
												<?php if($value['type']=='reward')
												{
													echo $value['reward_level'];
												}else
												{
													echo $value['mega_bonus_level']." (".ucfirst($value['business_type']).")";
												} ?>
											</td>
											<td><?=$value['amount'];
											$bonus=$bonus+$value['amount'];?></td>
											<td><?=ucfirst($value['type']);?></td>
										</tr><?php
									}  ?>
										
								<?php $i++; } ?>
								</tbody>
							</table>
							<?php } ?>

							<?php $que1=$this->db_model->globalSelect('bonus_redeem',['user_id'=>$this->logged['user_id']]);
							if($que1)
							{ ?>
							<hr>
							<h4 class="txtblue">Direct Bonus Redeemed</h4>
							<table id="table1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>TRXN</th>
										<th>Date</th>
										<th>Date From</th>
										<th>Date To</th>
										<th>Amount</th>
										<th>Directs</th>
										<th>Type</th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1; 
								foreach ($que1 as $key => $value) {
									if(isset($_POST['report']))
									{
										$from=$_POST['dateFrom']; $to=$_POST['dateTo'];
										if($value['date']>=$from && $value['date']<=$to)
										{ ?>
											<tr>
												<td><?=$value['transaction'];?></td>
												<td><?=$this->db_model->dateFormat($value['date']);?></td>
												<td><?=$this->db_model->dateFormat($value['date_from']);?></td>
												<td><?=$this->db_model->dateFormat($value['date_to']);?></td>
												<td><?=$value['amount'];
												$directBonus=$directBonus+$value['amount'];?></td>
												<td><?=$value['directs'];?></td>
												<td><?=ucfirst($value['type']);?></td>
											</tr><?php
										}
									}
									else
									{ ?>
										<tr>
											<td><?=$value['transaction'];?></td>
											<td><?=$this->db_model->dateFormat($value['date']);?></td>
											<td><?=$this->db_model->dateFormat($value['date_from']);?></td>
											<td><?=$this->db_model->dateFormat($value['date_to']);?></td>
											<td><?=$value['amount'];
											$directBonus=$directBonus+$value['amount'];?></td>
											<td><?=$value['directs'];?></td>
											<td><?=ucfirst($value['type']);?></td>
										</tr> <?php
									}  ?>
								<?php $i++; } ?>
								</tbody>
							</table>
							<?php } ?>

							<?php  $tdsdeduction=0; $admincharge=0;
							$que2=$this->db_model->globalSelect('tds',['user_id'=>$this->logged['user_id']]);
							if($que2)
							{ ?>
							<hr>
							<h4 class="txtblue">TDS & Other Deduction</h4>
							<table id="table5" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>TRXN</th>
										<th>Date</th>
										<th>Amount</th>
										<th>TDS %</th>
										<th>TDS Amt.</th>
										<th>Admin %</th>
										<th>Admin Amt</th>
										<th>Type</th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1; 
								foreach ($que2 as $key => $value) {
									if(isset($_POST['report']))
									{
										$from=$_POST['dateFrom']; $to=$_POST['dateTo'];
										if($value['date']>=$from && $value['date']<=$to)
										{ ?>
											<tr>
												<td><?=$value['transaction'];?></td>
												<td><?=$this->db_model->dateFormat($value['date']);?></td>
												<td><?=$value['amount'];?></td>
												<td><?=$value['tds_percent'];?>%</td>
												<td><?=$value['tds'];?></td>
												<?php $tdsdeduction=$tdsdeduction+$value['tds']; ?>
												<td><?=$value['admin_percent'];?>%</td>
												<td><?=$value['admin'];?></td>
												<?php $admincharge=$admincharge+$value['admin']; ?>
												<td><?=ucfirst($value['type']);?></td>
											</tr><?php
										}
									}
									else
									{ ?>
										<tr>
											<td><?=$value['transaction'];?></td>
											<td><?=$this->db_model->dateFormat($value['date']);?></td>
											<td><?=$value['amount'];?></td>
											<td><?=$value['tds_percent'];?>%</td>
											<td><?=$value['tds'];?></td>
											<?php $tdsdeduction=$tdsdeduction+$value['tds']; ?>
											<td><?=$value['admin_percent'];?>%</td>
											<td><?=$value['admin'];?></td>
											<?php $admincharge=$admincharge+$value['admin']; ?>
											<td><?=ucfirst($value['type']);?></td>
										</tr><?php
									}  ?>
								<?php $i++; } ?>
								</tbody>
							</table>
							<?php } ?>

						</div>
						<div class="col-md-6 col-md-offset-3 well">
							<table class="table table-hover table-bordered table-striped">
								<tr>
									<td colspan="4"><h4 class="txtred"> Payment Summary</h4></td>
								</tr>
								<tr>
									<th colspan="2">Income</th><th colspan="2">Deduction</th>
								</tr>
								<tr>
									<td>Direct Payments</td><td class="txtright"><?=$amt;?></td>
									<td>TDS Deduction</td><td class="txtright"><?=$tdsdeduction;?></td>
								</tr>
								<tr>
									<td>Mega Bonus</td><td class="txtright"><?=$bonus;?></td>
									<td>Admin Charge</td><td class="txtright"><?=$admincharge;?></td>
								</tr>
								<tr>
									<td>Direct Bonus</td><td class="txtright"><?=$directBonus;?></td>
									<td></td><td></td>
								</tr>
								<tr style="background: lavender;">
									<th>Total</th><th class="txtright"><?=$amt+$bonus+$directBonus; ?></th>
									<th>Total</th><th class="txtright"><?=$tdsdeduction+$admincharge; ?></th>
								</tr>
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
<style type="text/css">
	.txtSize{
		font-size: 16px;
	}
	th{
		text-align: center;
	}
	td{
		text-align: center;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
	$('#table1').DataTable();
	});
	$(document).ready(function() {
	$('#table5').DataTable();
	});
		$('#datepairExample .date').datepicker({
                    'format': 'yyyy-mm-dd',
                    'autoclose': true
                });
</script>