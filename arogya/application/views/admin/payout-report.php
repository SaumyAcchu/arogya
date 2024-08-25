<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title><?=$page['page']='Payment History';?> | <?=$this->siteInfo['name'];?></title>
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
		          <div class="panel panel-info" id="myPanel">
            <?php $ref=0; $bonus=0; $ind=0; $pair=0; $dir=0; $droi = 0; $droim = 0;?>
          <?php if(isset($pairMatch)){ ?>
              <div class="col-lg-12">
              <div class="panel panel-info" id="myPanel">
            <div class="panel-heading">
              <span class="panel-title">Payment History</span>
            </div>
          
            <div class="panel-body">
              <hr>
              <h4 class="txtblue">B.V. Matching Income</h4>
              <table id="table2" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Date</th>
                   
                    <th>Amount</th>
                    <th>Admin</th>
                    <td>Tds</td>
                    <th>Net Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; 
                foreach ($pairMatch as $key => $value) { ?>
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$value['user_id'];?></td>
                        <td><?=$this->dbm->getName($value['user_id']);?></td>
                        <td><?=$value['date'];?></td>
                        <td><?=$value['paidAmt'];?> </td>
                        <?php $pair = $pair+$value['paidAmt'];?>
                        <td><?=$value['admin'];?> </td>
                        <td><?=$value['tds'];?> </td>
                        <td><?=$value['total'];?></td>
                      </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
              <?php } ?>
               <hr>
               <?php if(isset($referral)){ ?>
              <h4 class="txtblue">Referral Income</h4>
              <table id="table5" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>TRXN</th>
                    <th>Beneficiary ID</th>
                    <th>User ID</th>
                    <th>Package</th>
                    <th>Date</th>
                    <th>Amount</th>
                     <th>Admin</th>
                    <td>Tds</td>
                    <th>Net Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; 
                foreach ($referral as $key => $value) { ?>
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$value['transaction'];?></td>
                         <td><?=$value['beneficiary'];?></td>
                        <td><?=$value['user_id'];?></td>
                        <?php $pack = $this->db->get_where('users',['user_id'=>$value['beneficiary']])->row_array(); 
                        $pack1 = $this->db->get_where('base_plan',['id'=>$pack['product']])->row_array();
                        ?>
                        <td>
                            
                            
                            <?=$pack1['name'];?>
                        
                        
                        </td>
                        <td><?=$this->dbm->dateFormat($value['date']);?>  <?=$value['time'];?></td>
                        <td><?=$value['amount'];
                        $dir=$dir+$value['amount']; ?></td>
                        <td><?=$value['admin'];?> </td>
                        <td><?=$value['tds'];?> </td>
                        <td><?=$value['total'];?></td>
                      </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
                <?php } ?>
                 <?php if(isset($roi)){ ?>
              <h4 class="txtblue">LeaderShip Income</h4>
              <table id="table6" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>TRXN</th>
                    <th>Level</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>GetFrom</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Admin</th>
                    <td>Tds</td>
                    <th>Net Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; 
                foreach ($roi as $key => $value) { ?>
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$value['transaction'];?></td>
                        <td><?=$value['club'];?></td>
                        <td><?=$value['user_id'];?></td>
                        
                        <td><?=$this->dbm->getName($value['user_id']);?></td>
                        <td><?=$value['getForm'];?></td>
                        <td><?=$this->dbm->dateFormat($value['date']);?>  <?=$value['time'];?></td>
                        <td><?=$value['amount'];
                        $droi=$droi+$value['amount']; ?></td>
                        <td><?=$value['admin'];?> </td>
                        <td><?=$value['tds'];?> </td>
                        <td><?=$value['total'];?></td>
                      </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
                <?php } ?>
                 <?php if(isset($month)){ ?>
              <h4 class="txtblue">travel allowance</h4>
              <table id="table6" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>TRXN</th>
                    <!--<th>Level</th>-->
                    <th>Month Business</th>
                    <th>Total Maching Business</th>
                    <th>User ID</th>
                    <th>Name</th>
                    
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Admin</th>
                    <td>Tds</td>
                    <th>Net Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; 
                foreach ($month as $key => $value) { ?>
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$value['transaction'];?></td>
                        <!--<td><?=$value['club'];?></td>-->
                        <td><?=$value['monthb'];?></td>
                        <td><?=$value['business'];?></td>
                        <td><?=$value['user_id'];?></td>
                        
                        <td><?=$this->dbm->getName($value['user_id']);?></td>
                    
                        <td><?=$this->dbm->dateFormat($value['date']);?>  <?=$value['time'];?></td>
                        <td><?=$value['amount'];
                        $droim=$droim+$value['amount']; ?></td>
                        <td><?=$value['admin'];?> </td>
                        <td><?=$value['tds'];?> </td>
                        <td><?=$value['total'];?></td>
                      </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
                <?php } ?>
            <div class="col-md-6 col-md-offset-3 well">
              <table class="table table-condensed table-hover table-bordered table-striped">
                <tr>
                  <td colspan="2"><h4 class="txtred"> Payment Summary</h4></td>
                </tr>
                <tr>
                  <td>B.V. Matching Income</td><td class="txtright"><?=$pair;?></td>
                </tr>
                 <tr>
                  <td>referral Income</td><td class="txtright"><?=$dir;?></td>
                </tr>
                 <tr>
                  <td>LeaderShip Income</td><td class="txtright"><?=$droi;?></td>
                </tr>
                 <tr>
                  <td>travel allowance</td><td class="txtright"><?=$droim;?></td>
                </tr>
                <tr style="background: lavender;">
                  <th>Total</th><th class="txtright"><?=number_format($to=$bonus+$dir+$droi+$pair,2); ?></th>
                </tr>
                <tr>
                  <th class="text-left" colspan="2">In Words: <?=$this->dbm->wordAmt($to);?></th>
                </tr>
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
  });
  $(document).ready(function() {
  $('#table2').DataTable();
  });
  $(document).ready(function() {
  $('#table3').DataTable();
  });
  $(document).ready(function() {
  $('#table4').DataTable();
  });
  $(document).ready(function() {
  $('#table5').DataTable();
  });
  $(document).ready(function() {
  $('#table6').DataTable();
  });
    $('#datepairExample .date').datepicker({
                    'format': 'yyyy-mm-dd',
                    'autoclose': true
                });
</script>
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
  table{
    font-size: 14px;
  }
</style>