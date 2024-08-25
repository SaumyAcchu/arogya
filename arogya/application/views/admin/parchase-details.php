<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Parchase History';?> | <?=$this->siteInfo['name'];?></title>
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
              <span class="panel-title">Parchase History</span>
            </div>
            <div class="panel-body">
              
              <hr>
              <?php if (!empty($data)): ?>
              
              <table id="table2" class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl No.</th>
                    <th>Supplier Id</th>
                    <th>Sponcer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Details</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php  $datal=$this->db->group_by('invoiceno')->select('*')->get_where('product_parchase')->result_array();?>
                <?php $i=1; 
                foreach ($datal as $key => $parchase) {            
               ?>
               <tr>
                 <td><?= $i ?></td>
                 <td><?= $parchase['supplier_id'] ?></td>
                 <td>
                     <?php $lists = $this->db->get_where('supplier',['supplier_id'=>$parchase['supplier_id']])->row_array(); ?>
                     <?=$lists['name'];?>
                 </td>
                 <td><?= $parchase['invoiceno'] ?></td>
                 <td><?= $parchase['current'] ?></td>
                 <td><a class="btn btn-warning" href="<?= base_url('auth/invoceSlip/'.$parchase['id'].'/'.$parchase['supplier_id'].'/'.$parchase['invoiceno']) ?>">More</a></td>
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