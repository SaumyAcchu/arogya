<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Level Management';?> | <?=$this->siteInfo['name'];?></title>
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
		            <div class="col-lg-6">
						<div class="panel panel-primary r-zero txt-14">
							<div class="panel-heading r-zero">
								<h3 class="panel-title">Self Team Level</h3>
							</div>
							<div class="panel-body levels">
								<button class="btn btn-primary pull-right r-zero m-b-10 addBtn" onclick="return addBtn('Self Team Level','self')"> <i class="fa fa-plus"></i> Add New</button>
								<table class="table table-bordered table-striped table-hover">
									<tr>
										<th>Level</th>
										<th>Level Bonus</th>
										<th>Action</th>
									</tr>
								<?php foreach ($data as $key => $value) {
									if($value['type']=='self'){ ?>
									<tr>
										<td><?=$value['level'];?></td>
										<td><?=$value['bonus'];?></td>
										<td>
											<a class="btn btn-primary btn-sm btn-circle" href="javascript:void(0);" onclick="return updateBtn('Update Self Team Level','self','<?=$value['id'];?>','<?=$value['level'];?>','<?=$value['bonus'];?>')"> <i class="fa fa-pencil"></i> </a>
											<a class="btn btn-danger btn-sm btn-circle" onclick="return confirm('Are you Sure to Delete')" href="<?=base_url('auth/deleteData/level/'.$value['id'].'/level-management');?>"> <i class="fa fa-trash"></i> </a>
										</td>
									</tr>
								<?php } } ?>
								</table>
							</div>
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
<!-- Bootstrap Modal for Add Level -->
          <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                  	<div class="panel panel-primary" style="margin-bottom: 0px;">
		                <div class="panel-heading">
			               <p class="panel-title">Add New Level
			               <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
		                </div>
		                <div class="panel-body jumbotron">
					<?=form_open('auth/insertData/level/level-management',['class'=>'form-horizontal']); ?>
						<div class="col-lg-12">
						<h3 class="txtcenter" id="txt"></h3>
						<div class="form-group">
							<input type="hidden" name="type" value="" id="type">
							<label>Level</label>
							<input type="text" name="level" class="form-control" value="<?=set_value('level');?>" required>
						</div>
						<div id="forAllIndia"></div>
						<div class="form-group">
							<label>Level Bonus</label>
							<input type="text" name="bonus" class="form-control" value="<?=set_value('bonus');?>" required>
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
							<label>Level</label>
							<input type="text" name="level" id="level" class="form-control" value="<?=set_value('level');?>" required>
						</div>
						<div id="updforAllIndia"></div>
						<div class="form-group">
							<label>Level Bonus</label>
							<input type="text" name="bonus" id="bonus" class="form-control" value="<?=set_value('bonus');?>" required>
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
<script type="text/javascript">
function addBtn(txt,type)
{
	$('#txt').html(txt);
	$('#type').val(type);
	if(type=='india')
	{
		$('#forAllIndia').html('<div class="form-group"><label>Team</label><input type="text" name="team" class="form-control" value="<?=set_value('team');?>" required></div><div class="form-group"><label>Minimum Required IDs (Direct)</label><input type="text" name="direct" class="form-control" value="<?=set_value('direct');?>" required></div>');
	}else
	{
		$('#forAllIndia').html('');
	}
	$('#addModal').modal('show');
}

function updateBtn(txt,type,id,level,bonus,down,req)
{
	$('#updModal').modal('show');
	var act="<?=base_url();?>auth/updateData/level/"+id+"/level-management";
	$('#updtxt').html(txt);
	$('#level').val(level);
	$('#bonus').val(bonus);
	$('#updateModal').attr('action',act);
	if(type=='india')
	{
		$('#updforAllIndia').html('<div class="form-group"><label>Team</label><input type="text" name="team" id="team" class="form-control" value="<?=set_value('team');?>" required></div><div class="form-group"><label>Minimum Required IDs (Direct)</label><input type="text" name="direct" id="direct" class="form-control" value="<?=set_value('direct');?>" required></div>');
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