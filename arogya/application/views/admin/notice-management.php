<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Notice Management';?> | <?=$this->siteInfo['name'];?></title>
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
		           <?php if(isset($get_data)) { ?>
						<div class="col-lg-6 col-lg-offset-3 jumbotron">
							<center><h4>Update Notice</h4></center>
							<?=form_open('auth/updateData/notice/'.$get_data['id'].'/notice-management',['class'=>'form-horizontal']); ?>
								<div class="form-group">
									<label>Date : </label>
									<input type="text" name="date" class="form-control" value="<?=$get_data['date'];?>" required readonly>
								</div>
								<div class="form-group">
									<label>Notice :</label>
									<textarea rows="10" name="message" class="form-control" required><?=$get_data['message'];?></textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info"> Update </button>
								</div>
							</form>
						</div>
					  <?php } else { ?>
						<div class="col-lg-6 col-lg-offset-3 jumbotron">
							<center><h4>Issue Notice</h4></center>
							<?=form_open('auth/insertData/notice/notice-management',['class'=>'form-horizontal']); ?>
								<div class="form-group">
									<label>Date : </label>
									<input type="text" name="date" class="form-control" value="<?=date('Y-m-d');?>" required readonly>
									<input type="hidden" name="status" value="0">
								</div>
								<div class="form-group">
									<label>Notice :</label>
									<textarea rows="5" name="message" class="form-control" required placeholder="Type Notice here"></textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary"> Submit </button>
								</div>
							</form>
						</div>
						<div class="col-lg-12">
							<div class="panel panel-info">
			            		<div class="panel-heading">
			            			<h3 class="panel-title"> Recent Notices </h3>
			            		</div>
			            		<div class="panel-body">
			            			<table id="table1" class="table table-bordered table-striped table-hover">
			            				<thead>
			            					<tr>
			            						<th>Sl</th>
			            						<th>Date</th>
			            						<th>Date</th>
			            						<th>Action</th>
			            					</tr>
			            				</thead>
			            				<tbody>
			            				  <?php if($data){ $i=1;
			            				  	foreach ($data as $key => $value) { ?>
			            					<tr>
			            						<td><?=$i;?></td>
			            						<td><?=$this->dbm->dateFormat($value['date']);?></td>
			            						<td><?=$value['message'];?></td>
			            						<td>
		            								<a href="<?=base_url('auth/getData/notice/'.$value['id'].'/notice-management');?>" class="btn btn-sm btn-primary btn-circle"> <i class="fa fa-pencil"></i> </a>
		            								<a onclick="return conDel()" href="<?=base_url('auth/deleteData/notice/'.$value['id'].'/notice-management');?>" class="btn btn-sm btn-danger  btn-circle"> <i class="fa fa-trash-o"></i> </a>
			            						</td>
			            					</tr>
			            				  <?php $i++; } } else { ?>
			            				  	<tr>
			            				  		<td colspan="4">No Current Notice Found.</td>
			            				  	</tr>
			            				  <?php } ?>
			            				</tbody>
			            			</table>
			            		</div>
			            	</div>
						</div>
					  <?php } ?>          
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
	function conDel()
	{
		var cnf=confirm('Are you sure to Delete this Notice');
		if(cnf)
		{
			return true;
		}else
		{
			return false;
		}
	}
</script>