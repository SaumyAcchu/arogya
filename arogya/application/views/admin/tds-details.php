<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='TDS History';?> | <?=$this->siteInfo['name'];?></title>
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
              <span class="panel-title">TDS History</span>
            </div>
            
            <div class="panel-body">
              
              <hr>
              <?php if (!empty($data)): ?>
              
              <table id="example" class="table table-striped table-hover table-bordered display" style="width:100%">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>TDS Charge</th>
                    <th>Admin Charge</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Date</th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; 
                foreach ($data as $key => $tds) { 

                $userdtl=$this->db->get_where('users',['user_id'=>$tds['user_id']])->row_array();           
               ?>
               <tr>
                 <td><?= $i ?></td>
                 <td><?= $tds['user_id'] ?></td>
                 <td><?= $userdtl['name'] ?></td>

                 <td><?= $tds['tds'] ?></td>
                 <td><?= $tds['admin'] ?></td>
                 <td><?= $tds['amount'] ?></td>
                 <td><?= $tds['type'] ?></td>
                 <td><?= $tds['date'] ?></td>
                
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



<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ]
    } );
} );
</script>