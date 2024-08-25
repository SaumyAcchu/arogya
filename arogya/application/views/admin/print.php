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
		        
					<div class="col-lg-6 col-lg-offset-3 jumbotron">
						<center><h4>Update Details</h4></center>
					  
							<div class="form-group">
								<label>Name : </label>
								<input type="text" name="name" class="form-control" value="<?=$get_data['sr'];?>" required>
							</div>
							<div class="form-group">
								<label>Address :</label>
								<input type="text" name="address" class="form-control" value="" required>
							</div>
							<div class="form-group">
								<label>Detail :</label>
								<input type="text" name="detail" class="form-control" value="" required>
							</div>
							<div class="form-group">
								<label>Phone Number :</label>
								<input type="number" name="mobile" class="form-control" value="" required>
							</div>
							<div class="form-group">
								<label>Email :</label>
								<input type="email" name="email" class="form-control" value="<?=$get_data['email'];?>" >
							</div>
							<div class="form-group">
								<label>Website :</label>
								<input type="text" name="website" class="form-control" value="" >
							</div>
							<div class="form-group">
								<label>Owner :</label>
								<input type="text" name="owner" class="form-control" value="" required>
							</div>
							
							
						
						</form>
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
