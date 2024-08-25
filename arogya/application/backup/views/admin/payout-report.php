<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Payout Report';?> | <?=$this->siteInfo['name'];?></title>
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
		        	<div class="col-lg-10 col-lg-offset-1">
				    <?= form_open('auth/payoutReport',['class'=>'form-horizontal']); ?>
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
					     	<button type="submit" class="btn btn-danger btn-sm"> Get Report</button>
					      </td>
					    </tr>
					</table>
					</form>
			  	</div>
			  	<?php if(isset($self)){ ?>
              <div class="col-lg-12">
		          <div class="panel panel-info" id="myPanel">
            <div class="panel-heading">
              <span class="panel-title">Payment History</span>
            </div>
            <?php $ref=0; $bonus=0; $ind=0; $pair=0; ?>
            <div class="panel-body">
              <!-- <h4 class="txtblue">Referrals</h4>
              <table id="table1" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>TRXN</th>
                    <th>User ID</th>
                    <th>Get From</th>
                    <th>Date</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; 
                foreach ($referral as $key => $value) { ?>
                      <tr>
                          <td><?=$i;?></td>
                          <td><?=$value['transaction'];?></td>
                          <td><?=$value['user_id'];?></td>
                          <td><?=$value['get_from'];?></td>
                          <td><?=$this->dbm->dateFormat($value['date']);?>  <?=$value['time'];?></td>
                          <td><?=$value['amount'];
                          $ref=$ref+$value['amount']; ?></td>
                        </tr>
                <?php $i++; } ?>
                </tbody>
              </table> -->
              <hr>
              <h4 class="txtblue">Self Team Income</h4>
              <table id="table2" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>TRXN</th>
                    <th>User ID</th>
                    <th>Get From</th>
                    <th>Date</th>
                    <th>Level</th>
                    <th>Type</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; 
                foreach ($self as $key => $value) { ?>
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$value['transaction'];?></td>
                        <td><?=$value['beneficiary'];?></td>
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
                        <td><?=$this->dbm->dateFormat($value['date']);?>  <?=$value['time'];?></td>
                        <td><?=$value['level'];?></td>
                        <td><?=ucfirst($value['type']);?></td>
                        <td><?=$value['amount'];
                        $bonus=$bonus+$value['amount']; ?></td>
                      </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
              <hr>
              <h4 class="txtblue">Single Lage Income</h4>
              <table id="table3" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>TRXN</th>
                    <th>User ID</th>
                    <th>Date</th>
                    <th>Matching</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; 
                foreach ($dalyIncome as $key => $value) { ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$value['transaction'];?></td>
                      <td><?=$value['user_id'];?></td>
                      <td><?=$this->dbm->dateFormat($value['date']);?>  <?=$value['time'];?></td>
                      <td><?=$value['direct']; ?></td>
                      <td><?=number_format($value['amount'],2);
                      $ind=$ind+number_format($value['amount'],2);?></td>
                    </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
              <hr>
              <h4 class="txtblue">Matching Income</h4>
              <table id="table4" class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>TRNX</th>
                    <th>User ID</th>
                    <!-- <th>Left</th>
                    <th>Right</th> -->
                    <th>Matching Pair</th>
                    <th>Date</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; $total=0;
                  foreach ($pairMatch as $key1 => $value) {
                   ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$value['transaction'];?></td>
                    <td><?=$value['user_id'];?></td>
                   <!--  <td><?=($value['ratio']=='Left')?'2':'1';?></td>
                    <td><?=($value['ratio']=='Right')?'2':'1';?></td> -->
                    <!-- <td><?=($value['pair']=='21')?($value['ratio']=='Right')?'1:2':'2:1':'1:1';?></td> -->
                    <td><?=$value['matching'];?></td>
                    <td><?=$this->dbm->dateFormat($value['date']);?>  <?=$value['time'];?></td>
                    <td><?=$value['amount']; $pair=$pair+$value['amount'];  ?></td>
                  </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-6 col-md-offset-3 well">
              <table class="table table-condensed table-hover table-bordered table-striped">
                <tr>
                  <td colspan="2"><h4 class="txtred"> Payment Summary</h4></td>
                </tr>
               <!--  <tr>
                  <td>Referral Income</td><td class="txtright"><?=$ref;?></td>
                </tr> -->
                <tr>
                  <td>Self Team Income</td><td class="txtright"><?=$bonus;?></td>
                </tr>
                <tr>
                  <td>All India Income</td><td class="txtright"><?=$ind;?></td>
                </tr>
                <tr>
                  <td>Pair Matching Income</td><td class="txtright"><?=$pair;?></td>
                </tr>
                <tr style="background: lavender;">
                  <th>Total</th><th class="txtright"><?=number_format($to=$bonus+$ind+$pair,2); ?></th>
                </tr>
                <tr>
                  <th class="text-left" colspan="2">In Words: <?=$this->dbm->wordAmt($to);?></th>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <?php } ?>
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