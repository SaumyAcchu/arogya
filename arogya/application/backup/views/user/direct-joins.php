<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='My Directs';?> | <?=$this->siteInfo['name'];?></title>
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
		       <div class="container-fluid padding-top main-container">
					
<!-- ///=====================All Contents Start Here==========================================/// -->
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Associates Down List</span>
						</div>
						<div class="panel-body">
						<table class="table table-bordered" id="table1">
							<thead>
								<tr>
										<th>Sl</th>
										<th>User ID</th>
										<th>Name</th>
										<th>Sponcer ID</th>
										<th>Reg Date</th>
										<th>Placement</th>
										<th>Mobile</th>
									</tr>
							</thead>
							<tbody>
								<?php if($data){ $i=1; $act1=0; $dct1=0;
								foreach ($data as $key => $value) { ?>
									<tr>
									<?php ($value['status']==1)?$act1++:$dct1++;?>
										<td><?=$i;?></td>
										<td><?=$value['user_id'];?></td>
										<td><?=$value['name'];?>&nbsp;<?=$value['m_name'];?>&nbsp;<?=$value['l_name'];?></td>
										<td><?=$value['sponcer_id'];?></td>
										<td><?=$this->db_model->dateFormat($value['reg_date']);?></td>
										<td><?=$value['place'];?></td>
										<td><?=$value['mobile'];?></td>
									</tr>	
								<?php $i++; } ?>
									
								<?php }else{ ?>
									<tr>
										<td colspan="7">No Records Found</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
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
} );
</script>