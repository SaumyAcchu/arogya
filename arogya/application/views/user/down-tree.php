<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='My Tree View';?> | <?=$this->siteInfo['name'];?></title>
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

				<div class="panel panel-primary">
				<div class="panel-heading">
				<h3 class="panel-sponcer_id"><i class="fa fa-sitemap"></i> Direct Team Tree View <span class="badge"></span></h3>
				</div>
				<div class="panel-body" style="max-width: 1100px;">
				  
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.18.2/ol.css">
				<link rel="stylesheet" href="<?=base_url('assets/test');?>/css/jquery.orgchart.css">
				<link rel="stylesheet" href="<?=base_url('assets/test');?>/css/style.css">
				<link rel="stylesheet" href="<?=base_url('assets/test');?>/css/style2.css">

				<div id="chart-container"></div>

				
				<script type="text/javascript" src="<?=base_url('assets/test');?>/js/html2canvas.min.js"></script>
                    <script type="text/javascript" src="<?=base_url('assets/test');?>/js/jspdf.min.js"></script>
                    <script type="text/javascript" src="<?=base_url('assets/test');?>/js/jquery.orgchart.js"></script>
				<script type="text/javascript">
				  (function($) {

				    $(function() {

    var datascource = <?php echo json_encode($treeman); ?>;

    $('#chart-container').orgchart({
      'data' : datascource,
      'visibleLevel': 2,
      'pan': true,
      'zoom': true,
      'exportButton': true,
      'exportFilename': 'Care',
      'nodeID': 'id',
      'createNode': function($node, data) {
        var secondMenuIcon = $('<i>', {
          'class': 'fa fa-info-circle second-menu-icon',
          mouseover: function() {
            $(this).siblings('.second-menu').toggle();
          },
          mouseout: function() {
            $(this).siblings('.second-menu').toggle();
          }
        });
        var secondMenu = '<div class="second-menu"><img class="avatar" src="<?= base_url('uploads/') ?>' + data.image + '"> Name : <span style="font-size: 10px;">'+data.username +'</span><br> Sponcer Id:<span style="font-size: 10px;">' + data.sponcer_id+'</span><br> mobile:<span style="font-size: 10px;">' + data.mobile+'</span><br> Join Date:<span style="font-size: 10px;">' + data.reg_date+'</span></div>';
        $node.append(secondMenuIcon).append(secondMenu);
      }
    });

  });

				  })(jQuery);
				</script>
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