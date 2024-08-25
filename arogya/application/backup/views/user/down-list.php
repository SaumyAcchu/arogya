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
				<?php $this->load->view('includes/sidebar.php',['page'=>'down-list']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Down List</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
					<?php
					//unset($_SESSION['dList']);
					$res=$this->Commission_model->downLineAll($this->logged['user_id']);
					//$arr=$_SESSION['dList'];
					//arsort($arr);
					//echo '<pre>'; print_r($arr); exit();
					?>
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Down List For - <b><?=$this->logged['user_id'];?></b></span>
						</div>
						<div class="panel-body">
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
								     	<button type="submit" name="report" class="btn btn-danger btn-sm"> Get Report</button>
								      </td>
								    </tr>
								</table>
								</form>
						  	</div>
							<table id="table1" class="table table-bordered">
								<thead>
									<tr>
										<th>Sl</th>
										<th>User ID</th>
										<th>Name</th>
										<th>Sponcer ID</th>
										<th>Reg Date</th>
										<th>Time</th>
										<th>Click to Sort</th>
									</tr>
								</thead>
								<tbody>
								<?php if($res){ $i=1;
								foreach ($res as $key1 => $value) {
										if(isset($_POST['report']))
										{
											$from=$_POST['dateFrom']; $to=$_POST['dateTo'];
											if($value['reg_date']>=$from && $value['reg_date']<=$to)
											{ ?>
												<tr class="<?=($value['status']==1)?"Uactive":"Udeactive";?>">
													<td><?=$i;?></td>
													<td><?=$value['user_id'];?></td>
													<td><?=$value['name'];?></td>
													<td><?=$value['sponcer_id'];?></td>
													<td><?=$this->db_model->dateFormat($value['reg_date']);?></td>
													<td><?=$value['reg_time'];?></td>
													<td>
														<?=($value['status']==1)?"Active":"Deactive";?>
													</td>
												</tr><?php
											}
										}else
										{ ?>
											<tr class="<?=($value['status']==1)?"Uactive":"Udeactive";?>">
												<td><?=$i;?></td>
												<td><?=$value['user_id'];?></td>
												<td><?=$value['name'];?></td>
												<td><?=$value['sponcer_id'];?></td>
												<td><?=$this->db_model->dateFormat($value['reg_date']);?></td>
												<td><?=$value['reg_time'];?></td>
												<td>
													<?=($value['status']==1)?"Active":"Deactive";?>
												</td>
											</tr><?php
										}
										
								 $i++;  }	}else{ ?>
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

	$('#datepairExample .date').datepicker({
                    'format': 'yyyy-mm-dd',
                    'autoclose': true
                });
</script>
<style type="text/css">
	.Udeactive{
		background: darkred;
		color: #fff;
	}
	.Uactive{
		background: darkgreen;
		color: #fff;
	}
</style>