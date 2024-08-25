<!DOCTYPE html>
<html lang="en">
<head>
 	<title><?=$page['page']='PIN History';?> | <?=$this->siteInfo['name'];?></title>
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
  		        <div class="col-xs-6 col-xs-offset-3 jumbotron">
                <table class="table table-bordered">
                  <tr class="bg-primary">
                    <th colspan="2" class="txtcenter">PIN Summary Generate By- <?=$genBy;?></th>
                  </tr>
                  <tr class="bg-info">
                    <th>Total Generated </th><td><?=count($active)+count($deactive);?></td>
                  </tr>
                  <tr class="bg-success">
                    <th>Active </th><td><?=count($active);?></td>
                  </tr>
                  <tr class="bg-danger">
                    <th>Non-Active </th><td><?=count($deactive);?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-danger">
                  <div class="panel-heading">
                    <h3 class="panel-title">Generated PIN by <?=$genBy;?> (Non-Active)</h3>
                  </div>
                  <div class="panel-body">
                    <table id="table1" class="table table-condensed table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>PIN</th>
                          <th>User ID</th>
                          <th>Name</th>
                          <th>Generate Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($deactive){ $i=1;
                      foreach ($deactive as $key => $value) { ?>
                        <tr>
                          <td><?=$i;?></td>
                          <td><?=$value['pin'];?></td>
                          <td><?=ucfirst($value['user_id']);?></td>
                          <td><?=ucwords($this->dbm->getName($value['user_id']));?></td>
                          <td><?=$this->dbm->dateFormat($value['gen_date']);?> <?=$value['gen_time'];?></td>
                          <td><?=($value['status']==1)?"<button class='btn btn-xs btn-success'>Active</button>":"<button class='btn btn-xs btn-danger'>Deactive</button>";?>
                          </td>
                        </tr>
                      <?php $i++; } } else{ ?>
                        <tr>
                          <td colspan="6">No Records Found Yet.</td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h3 class="panel-title">Generated PIN by <?=$genBy;?> (Active)</h3>
                  </div>
                  <div class="panel-body">
                    <table id="table2" class="table table-condensed table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>PIN</th>
                          <th>User ID</th>
                          <th>Name</th>
                          <th>Gen. Date</th>
                          <th>Acive Date</th>
                          <th>Active A/c</th>
                          <th>Name</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($active){
                        $i=1;
                      foreach ($active as $key => $value) { ?>
                        <tr>
                          <td><?=$i;?></td>
                          <td><?=$value['pin'];?></td>
                          <td><?=ucfirst($value['user_id']);?></td>
                          <td><?=ucwords($this->dbm->getName($value['user_id']));?></td>
                          <td><?=$this->dbm->dateFormat($value['gen_date']);?> <?=$value['gen_time'];?></td>
                          <td><?=$this->dbm->dateFormat($value['date']);?> <?=$value['time'];?></td>
                          <td><?=ucfirst($value['activated_account']);?></td>
                          <td><?=ucwords($this->dbm->getName($value['activated_account']));?></td>
                        </tr>
                      <?php $i++; } } else{ ?>
                        <tr>
                          <td colspan="8">No Records Found Yet.</td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
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