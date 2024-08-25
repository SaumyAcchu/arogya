<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=$page['page']='Dashboard';?> | <?=$this->siteInfo['name'];?></title>
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
              <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="panel-title">Products Name : <?= $get_data['name'] ?></p>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-6">
                          <img src="<?=base_url('uploads/'.$get_data['image']);?>" alt="Company Logo">
                        </div>
                        <div class="col-sm-6">                          
                              <label>Mobile Number<span class="req">*</span></label>
                               <input type="text" class="form-control" name="mobile" id="mobile" value="<?= set_value('mobile'); ?>" maxlength="10" placeholder="Applicant's Contact Number" required>
                               <p style="color: red;" id="errmobile"></p>
                         </div>
        
                            <script type="text/javascript">
                             $('#mobile').keypress(function(event){
                                        console.log(event.which);
                                    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                                        event.preventDefault();
                                    }});
                           </script>
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



