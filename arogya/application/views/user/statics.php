<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title><?=$page['page']=$title;?> | <?=$this->siteInfo['name'];?></title>
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
		          <?php if(isset($self))
              { ?>
                <div class="col-lg-8 col-lg-offset-2">
                  <div class="panel panel-primary" id="myPanel">
                    <div class="panel-heading">
                      <span class="panel-title txtupper"><center>Incentive Live Chart For Self Team</center></span>
                    </div>
                    <?php  $slf=$this->comm->selfTeam($userID); 
                    //echo "<pre>"; print_r($slf); die; ?>
                    <div class="panel-body">
                      <table class="table table-hover table-condensed table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Serial No.</th>
                            <th>Team</th>
                            <th>Active</th>
                            <th class="txtright">Income</th>
                            <!-- <th>Bonus</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php $amt=0; $j=1; $tot=0; $tact=0; $tdact=0;$act=0;$all=0;
                          foreach ($self as $kk => $val) { ?>
                          <tr>
                            <td><?=$j;?></td>
                            <td class="bg-info">
                              <?php if(!empty($slf)){
                                $all=0; $act=0;
                              foreach ($slf[$j] as $key => $value1)
                              {
                                $all=$all+count($value1);
                                
                                foreach ($value1 as $key => $value2) {
                                  if($value2['status']==1)
                                  {
                                    $act++;
                                  }
                                }
                              }
                              echo $all;
                              $tot=$tot+$all;
                              } else {
                                echo "-";
                              }
                              ?>
                            </td>
                            <td class="bg-success"><?=$act; $tact=$tact+$act; ?></td>
                            <td class="bg-warning txtright">
                              <?php $inc=$this->dbm->selfEarn($userID,$val['level']);
                              echo number_format($inc,2);
                              $amt=$amt+$inc;
                            ?></td>
                            <!-- <td><?=$val['bonus'];?></td> -->
                          </tr>
                          <?php $j++; } ?>
                          <tr style="background-color: lavender;">
                            <th>Summary</th>
                            <th><?=$tot;?></th>
                            <th><?=$tact;?></th>
                            <th class="txtright"><?=$amt;?></th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              <?php }  ?>
              <?php if(isset($india))
              { $sta=0; $pre=0;
                $myDown=$this->dbm->rowCount('users',['id>'=>$this->logged['id'],'status'=>1]);
                $myDir=$this->dbm->rowCount('users',['sponcer_id'=>$this->logged['id'],'status'=>1]);
               ?>
                <div class="col-lg-10 col-lg-offset-1">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <span class="panel-title txtupper"><center>Incentive Live Chart For All India Team</center></span>
                    </div>
                    <div class="panel-body">
                      <table class="table table-hover table-condensed table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Level</th>
                            <th>Req Team</th>
                            <th>Req Direct</th>
                            <th>Curr Team</th>
                            <th>Curr Directs</th>
                            <th>Level Status</th>
                            <th>Payment Status</th>
                          </tr>
                          <?php $team=0;
                          foreach ($india as $key => $value) { ?>
                           <tr>
                            <td><?=$value['level'];?></td>
                            <td><?=$value['team'];?></td>
                            <td><?=$value['direct'];?></td>
                            <td>
                              <?php if($value['team']<=$myDown)
                              {
                                echo $value['team']."  <i class='fa fa-check txtgreen'></i>";
                              }else
                              {
                                echo (($dw=$myDown-$pre)<1)?'-':$dw;
                              }
                              ?>
                            </td>
                            <td><?=$myDir;?></td>
                            <?php $ind=$this->dbm->getWhere('all_india_income',['user_id'=>$userID,'level'=>$value['level']]); ?>
                            <td><?=($ind)?'Completed':'-';?></td>
                            <td><?=($ind['is_credit']==1)?'Recieved':'-';?></td>
                          </tr>
                          <?php 
                          $pre=$value['team'];
                          } ?>
                          <tr>
                            <th colspan="7">Note: All India Scheme closing on last day of month.</th>
                          </tr>
                      </table>
                    </div>
                  </div>
                </div>
              <?php }  ?>
                <div class="col-lg-12">
                <?php $i=1; $total=0; ?>
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <span class="panel-title">Statistics show For - <b><?=$userID;?></b></span>
                  </div>
                  <div class="panel-body">
                      <div style="overflow-x:auto;">
                    <table id="table1" class="table table-bordered table-condensed table-responsive">
                      <thead>
                        <tr>
                          <th>Sl</th>
                          <th>User ID</th>
                          <th>Name</th>
                          <td>Package</td>
                          <td>Place</td>
                          <th>Parent ID</th>
                          <th>Parent Name</th>
                          <th>Reg Date</th>
                          <th>Activation Date</th>
                          <th>Status</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(count($down)>0){ $i=1; $total=0; $act=0;
                      foreach ($down as $key1 => $value) { ?>
                            <tr class="<?=($value['status']==1)?"bg-success":"bg-danger";?>">
                              <td><?=$i;?></td>
                              <td><?=$value['user_id'];?></td>
                              <td><?=$value['name'];?></td>
                              <td><?=$value['product'];?></td>
                              <td><?=$value['place'];?></td>
                              <td><?=$value['parent'];?></td>
                              <?php $pN = $this->db->get_where('users',['user_id'=>$value['parent']])->row_array(); ?> 
                              <td><?=$pN['name'];?></td>
                              <td><?=$this->dbm->dateFormat($value['reg_date']);?> <?=$value['reg_time'];?></td>
                              <td><?=$value['active_date'];?> <?=$value['active_time'];?></td>
                              <td>
                                  <?php if($value['status']==1)
													{ ?>
														<a href="#"  class="btn btn-xs btn-success">Active</a> <?php
													}else
													{ ?>
														<a href="#" class="btn btn-xs btn-danger">De-Active</a>
													<?php } ?>
                              </td>
                            </tr><?php
                        $i++; } ?>
                          
                      <?php  }  else{ ?>
                        <tr>
                          <td colspan="5">No Records Found</td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                   </div>
                </div>
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
  .btn-circle{
    border-radius: 50%;
  }
</style>