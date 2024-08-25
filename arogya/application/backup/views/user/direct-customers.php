<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Your Clientage';?> | <?=$this->siteInfo['name'];?></title>
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
							<span class="panel-title">Customers Added By Me</span>
						</div>
						<div class="panel-body">
						<table class="table table-bordered">
							<thead>
								<tr>
										<th>Sl</th>
										<th>Registration No</th>
										<th>Name</th>
										<th>Introducer ID</th>
										<th>Reg Date</th>
										<th>Mobile</th>
										<th>Plot No.</th>
										<th>Area Sqft</th>
									</tr>
							</thead>
							<tbody>
								<?php if($data){ $i=1; $act1=0; $dct1=0;
								foreach ($data as $key => $value) { ?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$value['registration'];?></td>
										<td>
											 <a href="<?=base_url('user/userManagement/'.$value['id']);?>">
											 	<?=$value['name'];?>&nbsp;<?=$value['m_name'];?>&nbsp;<?=$value['l_name'];?>
											 </a>

											</td>

										<td><?=$value['introducer'];?></td>
										<td><?=$this->db_model->dateFormat($value['registration_date']);?></td>
										<td><?=$value['mobile'];?></td>
										<?php $plot=$this->db_model->getWhere('flat',['id'=>$value['flat_id']]); ?>
										<td><?=$plot['flat_num'];?></td>
										<td><?=$plot['area'];?></td>
									</tr>	
								<?php $i++; } ?>
									
								<?php }else{ ?>
									<tr>
										<td colspan="8">No Records Found</td>
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