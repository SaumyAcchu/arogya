<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Catlog Management';?> | <?=$this->siteInfo['name'];?></title>
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
		             
					<div class="col-lg-6 col-lg-offset-3 jumbotron">
						<center><h4>Update Catlog</h4></center>
						<?=form_open_multipart('auth/insertDataWithFile/catlog/catlog-management',['class'=>'form-horizontal']); ?>
							<div class="form-group">
								<label>Catlog Name : </label>
								<input type="text" name="name" class="form-control" value="" required>
							</div>
							
							<div class="form-group">
								<div class="col-lg-8">
									<div class="form-group">
										<label>Date : </label>
										<input type="text" name="date" class="form-control" value="<?=date('Y-m-d');?>" required readonly>
										
									</div>
									<div class="form-group">
									<label>Catlog ( pdf | jpg ) :</label>
									<input type='file' name="image" id="imgInp"  class="form-control" value="" />
									<input type="hidden" name="image" value="">
									<span id="imageError" style="color: red;"></span>
									</div>
									<div class="form-group">
									
									<button id="updbtn" type="submit" class="btn btn-primary btn-sm"> Update </button>
									</div>

								</div>
								
								
							</div>
						</form>
					</div>




					            <div class="col-lg-12">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<p class="panel-title"><i class="fa fa-list"></i> Users List</p>
										</div>
										<div class="panel-body">
											<table id="table1" class="table table-condensed table-hover table-bordered">
												<thead>
													<tr>
														<th>Sl.</th>
														<th>User ID</th>
														<th>Name</th>
														<th>Name</th>
														
													</tr>
												</thead>
												<tbody>
												  <?php if($data) { $i=1;
												  	foreach ($data as $key => $value)
												  	{
												  		?>
												  		<tr class="">
												  			<td><?=$i;?></td>
												  			<td><?=$value['name'];?></td>
												  			<td><a href="<?=base_url('uploads/'.$value['image']);?>" style="color: black;"><?=$value['image'];?></a></td>
												  			
												  			<td>
												  				<div class="btn-group">
												  				
																
																<a onclick="return condelUser()" class="btn btn-sm btn-danger" href="<?=base_url('auth/deleteData/catlog/'.$value['id'].'/catlog-management');?>"> Delete </a>
																
																</div>
												  			</td>
												  		</tr>
												  	<?php $i++; } } else { ?>
													<tr><td colspan="7">No Records Found.</td></tr>
													<?php } ?>
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
