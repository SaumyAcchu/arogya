<!DOCTYPE html>
<html lang="en">
<head>
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
            <div class="panel-heading">
              <span class="panel-title">Booking History</span>
            </div>
            <div class="panel-body">
              
              <hr>
              <?php if (!empty($bookings)): ?>
              
              <table id="table2" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>Booking Id</th>
                    <th>Total Price</th>
                    <th>Total CV</th>
                    <th>Date</th>
                    <th>Details</th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; 
                foreach ($bookings as $key => $booking) {            
               ?>
               <tr>
                 <td><?= $i ?></td>
                 <td><?= $booking['id'] ?></td>
                 <td><?= $booking['total_price'] ?></td>
                 <td><?= $booking['total_cv'] ?></td>
                 <td><?= $booking['date'] ?></td>
                 <td><a class="btn btn-warning" href="<?= base_url('user/bookingSlip/'.$booking['id']) ?>">More</a></td>
               </tr>

                <?php $i++; } ?>
                </tbody>
              </table>
              <?php endif ?>
             
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