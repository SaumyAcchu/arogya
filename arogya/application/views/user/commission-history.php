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
				<?php $this->load->view('includes/sidebar.php',['page'=>'history']); ?>
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
							<span class="panel-title">Commission History</span>
						</div>
						<?php $amt=0; ?>
						<div class="panel-body">
							<h4 class="txtblue">Commission by Area Matching</h4>
							<table id="table1" class="table table-condensed table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>TRNX</th>
										<th>Direct Sell</th>
										<td>Left (Sell)</td>
										<td>Right (Sell)</td>
										<th>Matching</th>
										<th>Date From</th>
										<th>Date To</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1;
								foreach ($data as $key => $value)
								{ ?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$value['transaction'];?></td>
										<td><?=$value['direct'];?></td>
										<td><?=$value['left_area'];?> Sqft</td>
										<td><?=$value['right_area'];?> Sqft</td>
										<td><?=$value['matching_area'];?> Sqft</td>
										<td><?=$this->db_model->dateFormat($value['date_from']);?></td>
										<td><?=$this->db_model->dateFormat($value['date_to']);?></td>
										<td><?=$value['amount']; $amt=$amt+$value['amount']; ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-6 col-md-offset-3 well">
							<table class="table table-hover table-bordered table-striped">
								<tr>
									<td colspan="4"><h4 class="txtred"> Payment Summary</h4></td>
								</tr>
								<tr>
									<th colspan="2">Income</th><th colspan="2"><?=$amt;?></th>
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