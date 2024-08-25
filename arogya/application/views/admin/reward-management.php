<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Reward Management';?> | <?=$this->siteInfo['name'];?></title>
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
					<div class="col-lg-6 col-lg-offset-3">
						<div class="panel panel-primary r-zero txt-14">
							<div class="panel-heading r-zero">
								<h3 class="panel-title">All India Level</h3>
							</div>
							<div class="panel-body levels">
								<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
								<button class="btn btn-primary pull-right r-zero m-b-10 addBtn" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Add New</button>
																<table class="table table-bordered table-striped table-hover">
									<tr>
										<th>Time Duration</th>
										<th>Self Team Member</th>
										<th>Rewards</th>
										<th>Action</th>
									</tr>
								<?php foreach ($data as $key => $value) {
								?> 
									<tr>
										<td><?=$value['time_duration'];?></td>
										<td><?=$value['self_team_member'];?></td>
										<td><?=$value['rewards'];?></td>
										<td>
											<a class="btn btn-primary btn-sm btn-circle" href="javascript:void(0);" onclick="return updateBtn('Update Rewards','<?=$value['id'];?>','<?=$value['time_duration'];?>','<?=$value['self_team_member'];?>','<?=$value['rewards'];?>')"> <i class="fa fa-pencil"></i> </a>
											<a class="btn btn-danger btn-sm btn-circle" onclick="return confirm('Are you Sure to Delete')" href="<?=base_url('auth/deleteData/rewards/'.$value['id'].'/reward-management');?>"> <i class="fa fa-trash"></i> </a>
										</td>
									</tr>
								<?php }  ?>
								</table>
							</div>
						</div>
					</div>        
		        </div>
	       
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>
<!-- Bootstrap Modal for Add Level -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                  	<div class="panel panel-primary" style="margin-bottom: 0px;">
		                <div class="panel-heading">
			               <p class="panel-title">Rewards
			               <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
		                </div>
		                <div class="panel-body jumbotron">
					<?=form_open('auth/insertData/rewards/reward-management',['class'=>'form-horizontal']); ?>
						<div class="col-lg-12">
						
						<div class="form-group">
							<label>Time Duration</label>
							<input type="text" name="time_duration" class="form-control" value="<?=set_value('time_duration');?>" required>
						</div>
						<div class="form-group">
							
							<label>Self Team Member</label>
							<input type="text" name="self_team_member" class="form-control" value="<?=set_value('self_team_member');?>" required>
						</div>
						<div class="form-group">
							<label>Rewards</label>
							<input type="text" name="rewards" class="form-control" value="<?=set_value('rewards');?>" required>
						</div>
						<div class="form-group">
							<button class="btn btn-primary r-zero" type="submit">Submit</button>
						</div>
					</form></div>
		                </div>
		            </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Modal End -->





       
        <!-- Bootstrap Modal for Update Level -->
          <div class="modal fade" id="updModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                  	<div class="panel panel-primary" style="margin-bottom: 0px;">
		                <div class="panel-heading">
			               <p class="panel-title">Update Level
			               <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
		                </div>
		                <div class="panel-body jumbotron">
					<form class="form-horizontal" id="updateModal" method="post">
						<div class="col-lg-12">
						<h4 class="txtcenter txtred" id="updtxt"></h4>
						<div class="form-group">
							<label>time_duration</label>
							<input type="text" name="time_duration" id="time_duration" class="form-control" value="<?=set_value('time_duration');?>" required>
						</div>
						<div class="form-group">
							<label>self_team_member</label>
							<input type="text" name="self_team_member" id="self_team_member" class="form-control" value="<?=set_value('self_team_member');?>" required>
						</div>
						<div id="updforAllIndia"></div>
						<div class="form-group">
							<label>rewards</label>
							<input type="text" name="rewards" id="rewards" class="form-control" value="<?=set_value('rewards');?>" required>
						</div>
						<div class="form-group">
							<button class="btn btn-warning r-zero" type="submit">Update</button>
						</div>
					</form></div>
		                </div>
		            </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Modal End -->
<!-- ......................Update working Plan......................................... -->





<script type="text/javascript">

function updateBtn(txt,id,time_duration,self_team_member,rewards)
{
	$('#updModal').modal('show');
	var act="<?=base_url();?>auth/updateData/rewards/"+id+"/reward-management";
	$('#updtxt').html(txt);
	$('#time_duration').val(time_duration);
	$('#self_team_member').val(self_team_member);
	$('#rewards').val(rewards);
	$('#updateModal').attr('action',act);
	if(type=='india')
	{
		$('#updforAllIndia').html('<div class="form-group"><label>time_duration</label><input type="text" name="time_duration" id="time_duration" class="form-control" value="<?=set_value('time_duration');?>" required></div><div class="form-group"><label>self_team_member </label><input type="text" name="self_team_member" id="self_team_member" class="form-control" value="<?=set_value('self_team_member');?>" required></div><div class="form-group"><label>rewards </label><input type="text" name="rewards" id="rewards" class="form-control" value="<?=set_value('rewards');?>" required></div>');
		$('#team').val(down);
		$('#direct').val(req);

	}else
	{
		$('#updforAllIndia').html('');
	}
}

 
</script>





<style type="text/css">
	.levels{
		height: 400px;
		overflow: auto;
	}
	.jumbotron{
		margin-bottom: 0px;
	}
</style>