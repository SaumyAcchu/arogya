<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Dashboard';?> | <?=$this->siteInfo['name'];?></title>
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
		       <div class="container-fluid no-padding main-container">
            <div class="sponcer_id txtcenter">
            <h4>Associate Data</h4>
          </div>
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  			<!-- ///=====================All Contents Start Here============= //-->
              		<?php if($user==0) { echo "<h1 class='text-center'>Sorry, User ID Not Found.</h1>"; }else{ ?>
              	    <div class="col-lg-12">
              	    	<div class="well well-sm">
                              <div class="row">
                                <div class="col-sm-6 col-md-2">
                                  <img sponcer_id="profile image" class="img-circle img-responsive profile-image" src="<?=base_url('uploads/'.$user['image']);?>">
                                </div>
                                <div class="col-sm-6 col-md-4">
                                  <h4><i class="glyphicon glyphicon-user"></i> <strong><?=$user['name'];?></strong></h4>
                                     
                                  </div>
                                  <div class="col-sm-6 col-md-3"><br>
                                  	<div class="panel panel-primary">
              	                        <div class="panel-heading">
              		                        <div class="row">
              		                        	<div class="col-xs-4">
              		                            	<i class="fa fa-inr fa-5x"></i>
              		                          	</div>
              		                          	<div class="col-xs-8 text-right">
              		                            	<p class="announcement-heading">Commision</p>
              		                            	<h3 class="announcement-text"><?=number_format($self,2);?></h3>
              		                          	</div>
              		                        </div>
              	                        </div>
              	                    </div>
                                  </div>
                                  <div class="col-sm-6 col-md-3"><br>
                                  	<div class="panel panel-primary">
              	                        <div class="panel-heading">
              		                        <div class="row">
              		                        	<div class="col-xs-4">
              		                            	<i class="fa fa-inr fa-5x"></i>
              		                          	</div>
              		                          	<div class="col-xs-8 text-right">
              		                            	<p class="announcement-heading">Extra Commision</p>
              		                            	<h3 class="announcement-text"><?=number_format($selfUp,2);?></h3>
              		                          	</div>
              		                        </div>
              	                        </div>
              	                    </div>
                                  </div>
                              </div>
                          </div>
              		</div>
              	    <br>

              	    <div class="row">
              	    	<div class="col-sm-3">
              	    	    <!--left col-->
              	    	    <ul class="list-group">
              	    	        <li class="list-group-item active text-muted" contenteditable="false">Profile</li>
              	    	        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Sponcer ID</strong></span> <?=$user['sponcer_id'];?></li>
              	    	        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Password</strong></span> <?=$user['password'];?></li>
              	    	        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span> <?=$this->db_model->dateFormat($user['reg_date']);?></li>
              	    	        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Mobile</strong></span> <?=$user['mobile'];?></li>
              	    	    </ul>
              	    	   
              	    	</div>
              	    	<div class="col-sm-9" style="" contenteditable="false">
              	    	    <div class="panel panel-info">
              	    	        <div class="panel-heading">
              	    	        	Outher Details
              	    	        </div>
              	    	        <div class="panel-body">
              	    	        <table class="table table-bordered table-striped table-hover">              	    	        	
              	    	        	<tr>
              	    	        		<th>Bank Account Number</th>
              	    	        		<td><?=($user['account_number'])?$user['account_number']:'Not Added Yet';?></td>
              	    	        		<th>Bank Name</th>
              	    	        		<td><?=($user['bank_name'])?$user['bank_name']:'Not Added Yet';?></td>
              	    	        	</tr>
              	    	        	<tr>
              	    	        		<th>IFSC Code</th>
              	    	        		<td><?=($user['ifsc'])?$user['ifsc']:'Not Added Yet';?></td>
              	    	        		<th>Branch Name</th>
              	    	        		<td><?=($user['branch_name'])?$user['branch_name']:'Not Added Yet';?></td>
              	    	        	</tr>
              	    	        	<tr>
              	    	        		<th>Email ID</th><td colspan="3"><?=($user['email'])?$user['email']:'Not Added Yet';?></td>
              	    	        	</tr>
              	    	        	<tr>
              	    	        		<th>Permanent Address</th><td colspan="3"><?=($user['address'])?$user['address']:'Not Added Yet';?></td>
              	    	        	</tr>
              	    	        </table>
              	    	        </div>
              	    	    </div>
              	    	</div>
              	    </div>
<!-- <?php echo "<pre>"; print_r($treeman); ?> -->

	    	<div class="panel panel-primary">
	    		<div class="panel-heading">
	    		    <h3 class="panel-sponcer_id"><i class="fa fa-sitemap"></i> Direct Team Joins <span class="badge"><?=count($treeman); ?></span></h3>
	    		</div>
              	    		<div class="panel-body" style="max-width: 1100px;">


                          <div id="chart-container"></div>
              	    		
    <link rel="stylesheet" href="<?=base_url('assets/test');?>/css/jquery.orgchart.css">
    <link rel="stylesheet" href="<?=base_url('assets/test');?>/css/style.css">
    <link rel="stylesheet" href="<?=base_url('assets/test');?>/css/style2.css">


                            <div class="demo-container" id="pan-zoom" ></div>

                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                    <script type="text/javascript" src="<?=base_url('assets/test');?>/js/html2canvas.min.js"></script>
                    <script type="text/javascript" src="<?=base_url('assets/test');?>/js/jspdf.min.js"></script>
                    <script type="text/javascript" src="<?=base_url('assets/test');?>/js/jquery.orgchart.js"></script>
                    
          <script type="text/javascript">
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
                      var secondMenu = '<div class="second-menu"><img class="avatar" src="<?= base_url('uploads/') ?>' + data.image + '"> Name : <span style="font-size: 10px;">'+data.username +'</span><br> Sponcer Id:<span style="font-size: 10px;">' + data.sponcer_id+'</span><br> mobile:<span style="font-size: 10px;">' + data.mobile+'</span><br> Join Date:<span style="font-size: 10px;">' + data.reg_date+'</span><br> Direct:<span style="font-size: 10px;">' + data.direct+'</span></div>';
                      $node.append(secondMenuIcon).append(secondMenu);
                    }
                  });

                });
              </script>
              	    		</div>
              	    	</div>
              	<?php } ?>
            </div>
            <!-- <table>
              <tr><td>Name</td><td>+data.username +</td></tr>
              <tr><td>Sponcer Id</td><td>+ data.sponcer_id+</td></tr>
              <tr><td>Mobile</td><td>+ data.mobile+</td></tr>
            </table> -->
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
