<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Upgrade Status';?> | <?=$this->siteInfo['name'];?></title>
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
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Upgrade Status</h3>
                  </div>
                  <div class="panel-body">
                    <table id="table1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Old Package</th>
                          <th>New Package</th>
                          <th>User Id</th>
                          <th>Uploaded Image</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                        <tr>
                          <td><?=$this->dbm->dateFormat($get_data['date']);?></td>
                        <?php  $name=$this->db->select('name')->where(['id'=>$get_data['old_pakg']])->get('product_plan')->row_array(); ?>
                          <td><?=$name['name'];?></td>
                          <?php  $name2=$this->db->select('name')->where(['id'=>$get_data['plan_id']])->get('product_plan')->row_array(); ?>
                           <td><?=$name2['name'];?></td>
                            <td><?=$get_data['user_id'];?></td>
                            <td>  <img class="profile-user-img  img-fluid mx-auto d-block" src="<?=base_url('uploads/'.$get_data['image']);?>" alt="User profile picture" style="width: 110px; border: 2px solid;"></td>
                         <td>
                             <?php if($get_data['status']==1)
								{ ?>
								<a href="#" class="btn btn-sm btn-success">Confirm</a> <?php
								 }else { ?>
								<a href="#" class="btn btn-sm btn-warning">Pending</a>
								<?php	} ?>
                             
                         </td>
                         
                        </tr>
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

       