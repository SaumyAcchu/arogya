<!DOCTYPE html>
<html>
<head>
	<title><?=$this->siteInfo['name'];?></title>
	<?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
	<div class="container-fluid no-padding display-table">
		<div class="row no-padding display-table-row">
			<div class="col-lg-2 no-padding bx-shdw col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
				<?php $this->load->view('includes/sidebar.php',['page'=>'property-type']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Property Type</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
					<?php if(!empty($get_data)){ ?>
					<div class="col-lg-6 col-lg-offset-3 jumbotron">
					<center><h4>Update Details</h4></center>
					<?=form_open('control/updateData/property_type/'.$get_data['id'].'/property-type',['class'=>'form-horizontal']); ?>
						<div class="form-group">
							<label>Property Type : </label>
							<input type="text" name="name" class="form-control" value="<?=$get_data['name'];?>" required>
						</div>
						<div class="form-group">
							<button class="btn btn-warning" type="submit">Update</button>
						</div>
					</form>
					</div>
					<?php } else { ?>
					<div class="col-lg-8 col-lg-offset-2 jumbotron">
					<center><h4>Add New Property Type</h4></center>
					<?=form_open('control/insertData/property_type/property-type',['class'=>'form-horizontal']); ?>
						<table class="table table-bordered table-striped">
							<tr>
								<th>Property Type</th>
								<td>
									<input type="text" name="name" class="form-control" value="<?=set_value('name');?>" required>
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
							<th>SL No</th>
							<th>Property type</th>
							<th>Action</th>
						</tr>
					<?php $i=1; foreach ($data as $key => $value) { ?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$value['name'];?></td>
							<td><a class="btn btn-primary btn-sm" href="<?=base_url('control/getData/property_type/'.$value['id'].'/property-type');?>"> Edit </a>
								<a class="btn btn-danger btn-sm" href="<?=base_url('control/deleteData/property_type/'.$value['id'].'/property-type');?>"> Delete </a></td>
						</tr>
					<?php $i++; } ?>
					</table>
				</div>
			<?php } ?>
<!-- ///=====================All Contents End Here============================================/// -->
				</div>
				<?php $this->load->view('includes/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
</html>