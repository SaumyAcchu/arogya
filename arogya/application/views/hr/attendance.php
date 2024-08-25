<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Attendance';?> | <?=$this->siteInfo['name'];?></title>
  	<?php $this->load->view('hr/include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
    	<?php $this->load->view('hr/include/topbar'); ?>
  <!--===========top nav end===========-->
  	<div class="wrapper" id="wrapper">
    	<div class="left-container" id="left-container">
      	<!--========== Sidebar Start =============-->
      		<?php $this->load->view('hr/include/sidebar',$page); ?>
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
		        <?php $this->load->view('hr/include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
		        <div class="row padding-top">
		            
                 <div class="col-lg-10 col-lg-offset-1">
                <?= form_open('hr/attendanceDate',['class'=>'form-horizontal']); ?>
                  <div class="table-responsive">
                  <table class="table table-striped table-hover table-bordered">
                     <tbody>
                      <tr>
                        <td>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"> Employee ID</span>
                            <input type="text"  name="employee_id" value="<?=isset($user['employee_id'])?$user['employee_id']:'';?>" placeholder="Employee ID" class="form-control txtupper" required>
                          </div>
                        </td>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">Date</span>
                             <input type="text" value="<?=isset($date)?$date:'';?>" name="date" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                          </div>
                        </td>
                        
                        <td style="padding-top: 12px;">
                          <button type="submit" class="btn btn-danger btn-block btn-sm"> Details</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
                
                </form>
              </div>

		        </div>


            <?php if(!isset($user)) {
            // echo "<h1 class='text-center'>Sorry, Employee ID Not Found.</h1>";
             }else{ ?>
              <div class="row">
                <div class="col-sm-12 col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item active text-muted" contenteditable="false">Profile</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Name</strong></span> <i class="glyphicon glyphicon-user"></i> <strong><?=$user['name'];?></strong></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Emp Id</strong></span>  <strong><?=$user['employee_id'];?></strong></li>
                        <!-- <li class="list-group-item text-right"><span class="pull-left"><strong class="">Sponcer ID</strong></span> <?=$user['sponcer_id'];?></li> -->
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span> <?=$this->db_model->dateFormat($user['reg_date']);?></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong class="">Mobile</strong></span> <?=$user['mobile'];?></li>
                    </ul>                         
                </div>
                <div class="col-sm-12 col-md-3">
                   <center> <img sponcer_id="profile image" class="img-circle img-responsive profile-image" src="<?=base_url('uploads/'.$user['image']);?>"> </center>                    
                </div>

                <div class="col-sm-12 col-md-3">
                  <?php if (isset($attendance)){ ?>
                    <!-- <?= print_r($attendance); ?> -->
                      <?= form_open('hr/attendanceUpdate/'.$attendance['id'],['class'=>'form-horizontal']); ?>
                            <!-- <input type="hidden" name="id" value="<?= $attendance['attendence_type_id'] ?>"> -->
                            <!-- <input type="hidden" name="date" value="<?= $date ?>"> -->
                                <table class="table table-striped table-hover table-bordered">
                                  <thead>
                                    <td colspan="2"><center><b><?= $date ?></b></center></td>
                                  </thead>
                                <tbody> 
                                <?php foreach ($attendanceType as $key => $atType): ?>
                                  <tr>
                                       <td><input type="radio" name="attendence_type_id" <?= ($atType['id']==$attendance['attendence_type_id'])?'checked':'' ?> value="<?= $atType['id'] ?>" ></td> <td><?php print_r($atType['type']); ?></td>
                                  </tr>
                                <?php endforeach ?>
                              </tbody>
                                </table>
                                
                                <td style="padding-top: 12px;">
                                  <button type="submit" class="btn btn-danger btn-block btn-sm">Update</button>
                                 </td>
                          </form>

                    <?php }else{ ?>
                          <?= form_open('hr/attendanceSubmit',['class'=>'form-horizontal']); ?>
                            <input type="hidden" name="employee_id" value="<?= $user['employee_id'] ?>">
                            <input type="hidden" name="date" value="<?= $date ?>">
                                <table class="table table-striped table-hover table-bordered">
                                 <thead>
                                    <td colspan="2"><center><b><?= $date ?></b></center></td>
                                  </thead>
                                 <tbody>  
                                <?php foreach ($attendanceType as $key => $atType): ?>
                                  <tr>
                                       <td><input type="radio" name="attendence_type_id" <?= ($atType['id']==1)?'checked':'' ?> value="<?= $atType['id'] ?>" ></td> <td><?php print_r($atType['type']); ?></td>
                                  </tr>
                                <?php endforeach ?>
                                </tbody>
                                </table>
                                
                                <td style="padding-top: 12px;">
                                  <button type="submit" class="btn btn-danger btn-block btn-sm">Submit</button>
                                 </td>
                          </form>
                    <?php } ?>

                  
                   <?php } ?>              
                </div>                     
              </div>
         
	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
   
  <!--==========Footer Start=============-->
  <?php $this->load->view('hr/include/footer'); ?>
  <!--==========Footer End=============-->   

   <script type="text/javascript">
       $('#datepairExample .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });

    </script>
</body>
</html>
