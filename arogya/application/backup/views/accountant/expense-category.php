<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Expense Categories';?> | <?=$this->siteInfo['name'];?></title>
  	<?php $this->load->view('accountant/include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
    	<?php $this->load->view('accountant/include/topbar'); ?>
  <!--===========top nav end===========-->
  	<div class="wrapper" id="wrapper">
    	<div class="left-container" id="left-container">
      	<!--========== Sidebar Start =============-->
      		<?php $this->load->view('accountant/include/sidebar',$page); ?>
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
	      		<?php $this->load->view('accountant/include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
		        <div class="row padding-top">
		            <?php if(isset($get_data)) { ?>
					<div class="col-lg-6 col-lg-offset-3" style="padding: 10px; box-shadow: 0px 1px 10px 1px #33A5E7; margin-top: 10px;">
						<?= form_open('accountant/updateData/expense_category/'.$get_data['id'].'/expense-category',['class'=>'form-horizontal']); ?>
							<legend>Update Category</legend>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Category Name</label>
						      <div class="col-lg-9">
						        <input type="text" value="<?=$get_data['name'];?>" name="name" class="form-control" id="account" placeholder="Enter Expense Category" required>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-lg-9 col-lg-offset-3">
						        <button type="reset" class="btn btn-default">Reset</button>
						        <button type="submit" class="btn btn-primary">Update</button>
						      </div>
						    </div>
						</form>
					</div>
				<?php } else { ?>
				<center><button data-toggle="collapse" class="btn btn-primary" data-target="#demo"><i class="fa fa-plus"></i> Add New Category</button></center>	
				<?php if(validation_errors()){ ?>
				<div id="demo" class="collapse in ">
				<?php } else { ?>
				<div id="demo" class="collapse">
				<?php } ?>
				<div class="col-lg-6 col-lg-offset-3" style="padding: 10px; box-shadow: 0px 1px 10px 1px #33A5E7; margin-top: 10px;">
					<?= form_open('accountant/insertData/expense_category/expense-category',['class'=>'form-horizontal']); ?>
					<legend>Insert New Category</legend>
				    <div class="form-group">
				      <label class="col-lg-3 control-label">Category Name</label>
				      <div class="col-lg-9">
				        <input type="text" value="" name="name" class="form-control" id="account" placeholder="Enter Expense Category" required>
				      </div>
				    </div>
				    <div class="form-group">
				      <div class="col-lg-9 col-lg-offset-3">
				        <button type="reset" class="btn btn-default">Reset</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				      </div>
				    </div>
				</form>
				</div>
				</div>
				<!-- form end-->
					  <div class="col-lg-6 col-lg-offset-3">
					  	<center><h3>Expense Category List</h3></center>
						<table class="table table-striped table-hover table-bordered">
						  <thead>
						    <tr>
						      <th>Sl. No.</th>
						      <th>Account</th>
						      <th>Action</th>
						    </tr>
						  </thead>
						   <tbody>
						  <?php if(count($data)): ?>
						  <?php $i=1; foreach($data as $value): ?>
						    <tr>
						      <td><?= $i; ?></td>
						      <td><?= $value['name']; ?></td>
						      <td>
						      	<div class="btn-group">
						      		<a href="<?= base_url('accountant/getData/expense_category/'.$value['id'].'/expense-category'); ?>" class="btn btn-info btn-sm"> Edit </a>
						     		<a onclick="return confirm('Are you sure to Delete.')" href="<?= base_url('accountant/deleteData/expense_category/'.$value['id'].'/expense-category'); ?>" class="btn btn-danger btn-sm">Delete</a>
						     	</div>
						      </td>
						    </tr>
						  <?php $i++; endforeach; ?>
						  <?php else: ?>
						  	<tr><td colspan="4">No Records Found</td></tr>
						  <?php endif; ?>
						  </tbody>
						</table>
					  </div> 
				<?php } ?>         
		        </div>
	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('accountant/include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>