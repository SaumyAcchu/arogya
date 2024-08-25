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
		        <?php if(!empty($get_data)){ ?>
					<div class="col-lg-6 col-lg-offset-3 jumbotron">
					<center><h4>Update Details</h4></center>
					<?=form_open('control/updateData/level/'.$get_data['id'].'/level-management',['class'=>'form-horizontal']); ?>
						<div class="form-group">
							<label>Level : </label>
							<input type="text" placeholder="ex: 1,2,3" name="level" id="level" class="form-control" value="<?=$get_data['level'];?>" readonly required>
						</div>
						<div class="form-group">
							<label>Name :</label>
							<input type="text" name="name" class="form-control" value="<?=$get_data['name'];?>" required>
						</div>
						<div class="form-group">
							<label>Business :</label>
							<input type="text" name="business" id="business" class="form-control" value="<?=$get_data['business'];?>" required>
						</div>
						<div class="form-group">
							<label>Commission %:</label>
							<input type="text" name="commission" class="form-control" id="commission" value="<?=$get_data['commission'];?>" required>
						</div>
						<div class="form-group">
							<button class="btn btn-warning" type="submit">Update</button>
						</div>
					</form>
					</div>
					<?php } else { ?>
					<div class="col-lg-10 col-lg-offset-1 jumbotron">
					<center><h4>Add New Level</h4></center>
					<?=form_open('control/insertData/level/level-management',['class'=>'form-horizontal']); ?>
						<table class="table table-bordered table-striped">
							<tr>
								<th>Level</th>
								<td>
									<input type="text" name="level" id="level" class="form-control" value="<?=set_value('level');?>" required>
								</td>
							</tr>
							<tr>
								<th>Name</th>
								<td>
									<input type="text" name="name" class="form-control" value="<?=set_value('name');?>" required>
								</td>
							</tr>
							<tr>
								<th>Business</th>
								<td>
									<input type="text" name="business" id="business" class="form-control" value="<?=set_value('business');?>" required>
								</td>
							</tr>
							<tr>
								<th>Commission %</th>
								<td>
									<input type="text" name="commission" id="commission" class="form-control" value="<?=set_value('commission');?>" required>
								</td>
							</tr>
							<tr>
								<th></th>
								<td>
									<button class="btn btn-info" type="submit">Submit</button>
								</td>
							</tr>
						</table>
					</form> 
					<table class="table table-bordered table-striped table-hover">
						<tr>
							<th>Level</th>
							<th>Name</th>
							<th>Commission%</th>
							<th>Business</th>
							<th>Action</th>
						</tr>
					<?php $prelavel = 0; foreach ($data as $key => $value) { ?>
						<tr>
							<td><?=$value['level'];?></td>
							<td><?=$value['name'];?></td>
							<td><?=$value['commission'];?>%</td>
							<td style="float: right;"><?= number_format($prelavel) ?> - <?=number_format($value['business']);?></td>
							<td><a class="btn btn-primary btn-sm" href="<?=base_url('control/getData/level/'.$value['id'].'/level-management');?>"> Edit </a></td>
						</tr>
					<?php $prelavel = $value['business']+1; } ?>
					</table>
				</div>
			<?php } ?>
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
					<?=form_open('control/insertData/level/level-management',['class'=>'form-horizontal']); ?>
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
							<input type="text" name="name" id="name" class="form-control" value="<?=set_value('name');?>" required>
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

<style type="text/css">
	.levels{
		height: 400px;
		overflow: auto;
	}
	.jumbotron{
		margin-bottom: 0px;
	}
</style>




<script type="text/javascript">
	$('#level').keypress(function(event){
	           console.log(event.which);
	       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
	           event.preventDefault();
	       }});
	$('#business').keypress(function(event){
	           console.log(event.which);
	       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
	           event.preventDefault();
	       }});
	$('#commission').keypress(function(event){
	           console.log(event.which);
	       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
	           event.preventDefault();
	       }});
</script>