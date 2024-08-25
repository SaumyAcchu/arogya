<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
                       <legend class="scheduler-border" style="color:red;"><u>PENDING LIST:</u></legend>
                     <hr>
                    <table id="table2" class="table table-bordered table-striped">
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
                          <?php if($data) { $i=1;
						 foreach ($data as $key => $get_data)
						    { if($get_data['status']==0){ ?>
                        <tr>
                          <td><?=$this->dbm->dateFormat($get_data['date']);?></td>
                        <?php  $name=$this->db->select('name')->where(['id'=>$get_data['old_pakg']])->get('base_plan')->row_array(); ?>
                          <td><?=$name['name'];?></td>
                          <?php  $name2=$this->db->select('name,binari')->where(['id'=>$get_data['plan_id']])->get('base_plan')->row_array(); ?>
                           <td><?=$name2['name'];?></td>
                            <td><?=$get_data['user_id'];?></td>
                             
                            <td>  <img class="profile-user-img  img-fluid mx-auto d-block" src="<?=base_url('uploads/'.$get_data['image']);?>" alt="User profile picture" style="width: 100px;  HEIGHT: 80PX;"></td>
                         <td>
                             <?php if($get_data['status']==1)
								{ ?>
								<a href="#" class="btn btn-sm btn-success">Confirm</a> <?php
								 }else { ?>
							<a onclick="return confirm('Aur You Sure To Upgrade This Package');" href="<?=base_url('auth/userUpgrade/'.$get_data['user_id'].'/'.$get_data['plan_id'].'/'.$get_data['id'].'/'.$name2['binari']);?>"  class="btn btn-sm btn-primary">Pending</a>
								<?php	} ?>
                             
                         </td>
                         
                        </tr>
                        <?php } } }?>
                      </tbody>
                    </table>
                     <legend class="scheduler-border" style="color:red;"><u>CONFIRM LIST:</u></legend>
                     <hr>
                     <table id="table1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Old Package</th>
                          <th>New Package</th>
                          <th>User Id</th>
                          <th>Upgrade Date</th>
                          <th>Uploaded Image</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php if($data) { $i=1;
						 foreach ($data as $key => $get_data)
						    { if($get_data['status']==1){ ?>
                        <tr>
                          <td><?=$this->dbm->dateFormat($get_data['date']);?></td>
                        <?php  $name=$this->db->select('name')->where(['id'=>$get_data['old_pakg']])->get('base_plan')->row_array(); ?>
                          <td><?=$name['name'];?></td>
                          <?php  $name2=$this->db->select('name')->where(['id'=>$get_data['plan_id']])->get('base_plan')->row_array(); ?>
                           <td><?=$name2['name'];?></td>
                            <td><?=$get_data['user_id'];?></td>
                            <td>
                                
                                <?=($get_data['upgrade_date']!='')?$get_data['upgrade_date']:'Not Added Yet';?>
                                </td>
                            <td>  <img class="profile-user-img  img-fluid mx-auto d-block" src="<?=base_url('uploads/'.$get_data['image']);?>" alt="User profile picture" style="width: 100px;  HEIGHT: 80PX;"></td>
                     <td>
                             <?php if($get_data['status']==1)
								{ ?>
								<a href="#" class="btn btn-sm btn-success">Confirm</a> <?php
								 }else { ?>
							<a onclick="return confirm('Aur You Sure To Upgrade This Package');" href="<?=base_url('auth/userUpgrade/'.$get_data['user_id'].'/'.$get_data['plan_id'].'/'.$get_data['id']);?>"  class="btn btn-sm btn-primary">Pending</a>
								<?php	} ?>
                             
                         </td>
                         
                        </tr>
                        <?php } } } ?>
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
$(document).ready(function() {
$('#table2').DataTable();
} );
</script>
       