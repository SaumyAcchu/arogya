<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title><?=$page['page']='Level Statics';?> | <?=$this->siteInfo['name'];?></title>
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
						
						<div class="col-lg-12">
                 <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Level Statics</h3>
                  </div>
                  <div class="panel-body" id="news-panel">
               <table id="table1" class="table table-bordered table-striped table-hover table-condensed table-responsive">
								<thead>
								    <?PHP $bv = $this->dbm->allBusiness(); ?>
											<tr class="danger">
										
											<td colspan="3"><b>Current Left PV: <?=$bv['lbv'];?></b></td>
											<td colspan="3"><b>Current Right PV: <?=$bv['rbv'];?></b></td>
										<tr>
											<th>Sl.</th>
											<th>Level</th>
											<th>Left PV</th>
											<th>Right PV</th>
											<th>Qualified Date</th>
											<th>Status</th>
										</tr>
											
										
										</tr>
									</thead>
									<tbody>
									  <?php
									  $per = $this->db->get_where('club_plan')->result_array();
									  if($per) { $i=1; $myDown = 0;
									  	foreach ($per as $key => $value)
									  	{ ?>
									  		<tr>
									  		    <?php $lvl = $this->db->get_where('level_statics',['level'=>$value['plan'],'user_id'=>$this->logged['user_id']])->row_array(); ?>
									  				<?PHP $bv = $this->dbm->allBusiness(); ?>
									  			<td><?=$i;?></td>
									  			<td><?=$value['name'];?></td>
									  			<td><?=$value['PV'];?> :<b><?=$lvl['lefta'];?>
									  			
									  			</b></td>
									  			<td><?=$value['PV'];?> :<b><?=$lvl['righta'];?>
									  			
									  			
									  			</b></td>
									  			
									  			<td><?=$lvl['date'];?> </td>
									  			
									  		
									  		 <td>
                                         <?php if($value['PV']<=$bv['rbv'] && $value['PV']<=$bv['lbv'])
                                          {
                                           echo "<i class='fa fa-check txtgreen'></i>";
                                           }elseif($value['PV']>$bv['rbv'] && $value['PV']>$bv['lbv'])
                                           {
                                            echo "<h5 class='txtred'>Running</h5>";
                                            }else{
                                               echo "<i class='fa fa-times txtred'></i>"; 
                                            }
                                          ?>
                                          </td>
									  			
									  		</tr>
									  	<?php $i++; } } else { ?>
										<tr><td colspan="7">No Records Found.</td></tr>
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
