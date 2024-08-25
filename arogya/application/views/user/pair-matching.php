<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Pair Matching'; ?> | <?=$this->siteInfo['name'];?></title>
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
                <div class="col-lg-12">
                <?php $i=1; $total=0; ?>
                <div class="panel panel-info" id="pair">
                  <div class="panel-heading">
                    <span class="panel-title">Pair Matching Statistics show For - <b><?=$userID;?></b></span>
                    <a href="<?=base_url('stable/treeView/'.base64_encode($this->logged['user_id']));?>" class="btn btn-sm pull-right btn-primary"><i class="fa fa-sitemap"></i> View Tree Structure</a>
                  </div>
                  <div class="panel-body">
                    <table id="table1" class="table table-bordered table-condensed">
                      <thead>
                        <tr>
                          <th>Sl</th>
                          <th>TRNX</th>
                          <th>Left</th>
                          <th>Right</th>
                          <th>Matching Pair</th>
                          <th>Amount</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; $total=0;
                        foreach ($pair as $key1 => $value) { ?>
                        <tr>
                          <td><?=$i;?></td>
                          <td><?=$value['transaction'];?></td>
                          <td><?=($value['ratio']=='Left')?'2':'1';?></td>
                          <td><?=($value['ratio']=='Right')?'2':'1';?></td>
                          <td><?=($value['pair']=='21')?($value['ratio']=='Right')?'1:2':'2:1':'1:1';?></td>
                          <td><?=$value['amount'];?></td>
                          <td><?=$this->dbm->dateFormat($value['date']);?>  <?=$value['time'];?></td>
                        </tr>
                        <?php $i++; } ?>
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
  #pair a{
    color:white;
  }
  #pair a:hover{
    color:black;
  }
</style>