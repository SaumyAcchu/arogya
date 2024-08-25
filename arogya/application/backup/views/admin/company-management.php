<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Comapny Management';?> | <?=$this->siteInfo['name'];?></title>
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
		             <?php if(!empty($get_data)){ ?>
					<div class="col-lg-6 col-lg-offset-3 jumbotron">
						<center><h4>Update Details</h4></center>
						<?=form_open_multipart('control/updateDataWithFile/company/'.$get_data['id'].'/company-management',['class'=>'form-horizontal']); ?>
							<div class="form-group">
								<label>Name : </label>
								<input type="text" name="name" class="form-control" value="<?=$get_data['name'];?>" required>
							</div>
							<div class="form-group">
								<label>Address :</label>
								<input type="text" name="address" class="form-control" value="<?=$get_data['address'];?>" required>
							</div>
							<div class="form-group">
								<label>Detail :</label>
								<input type="text" name="detail" class="form-control" value="<?=$get_data['detail'];?>" required>
							</div>
							<div class="form-group">
								<label>Phone Number :</label>
								<input type="number" name="mobile" class="form-control" value="<?=$get_data['mobile'];?>" required>
							</div>
							<div class="form-group">
								<label>Email :</label>
								<input type="email" name="email" class="form-control" value="<?=$get_data['email'];?>" >
							</div>
							<div class="form-group">
								<label>Website :</label>
								<input type="text" name="website" class="form-control" value="<?=$get_data['website'];?>" >
							</div>
							<div class="form-group">
								<label>Owner :</label>
								<input type="text" name="owner" class="form-control" value="<?=$get_data['owner'];?>" required>
							</div>
							
							
							<div class="form-group">
								<div class="col-lg-8">
									<div class="form-group">
									<label>Change Logo :</label>
									<input type='file' name="image" id="imgInp"  class="form-control" value="" />
									<input type="hidden" name="image" value="<?=$get_data['image'];?>">
									<span id="imageError" style="color: red;"></span>
									</div>
									<div class="form-group">
									<button class="btn btn-warning btn-sm" id="back"> << Back </button>
									<button id="updbtn" type="submit" class="btn btn-primary btn-sm"> Update </button>
									</div>

								</div>
								<div class="col-lg-4">
									<img id="blah" class="logo-image" src="<?=base_url('uploads/'.$get_data['image']);?>" alt="Company Logo" />
								</div>
								
							</div>
						</form>
					</div>
					<?php } else { ?>
					<div class="col-lg-8 col-lg-offset-2 jumbotron">
						<table class="table table-bordered table-striped table-hover">
							<?php foreach ($data as $key => $value) { ?>
							<tr>
								<th>Company Details</th>
								<td><a href="<?=base_url('control/getData/company/'.$value['id'].'/company-management');?>" class="btn btn-sm btn-primary">Edit</a></td>
							</tr>
							<tr>
								<th>Logo</th><td style="background: lavender;"><center><img class="logo-image" src="<?=base_url('uploads/'.$value['image']);?>"></center></td>
							</tr>
							<tr>
								<th>Name</th><td><?=$value['name'];?></td>
							</tr>
							<tr>
								<th>Address</th><td><?=$value['address'];?></td>
							</tr>
							<tr>
								<th>Detail</th><td><?=$value['detail'];?></td>
							</tr>
							<tr>
								<th>Phone</th><td><?=$value['mobile'];?></td>
							</tr>
							<tr>
								<th>Email</th><td><?=$value['email'];?></td>
							</tr>
							<tr>
								<th>Website</th><td><?=$value['website'];?></td>
							</tr>
							<tr>
								<th>Owner</th><td><?=$value['owner'];?></td>
							</tr>
							
							<?php } ?>
						</table>
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
