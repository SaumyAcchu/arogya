<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Select Project';?> | <?=$this->siteInfo['name'];?></title>
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
                          
                        <!-- ///Flash Message Start/// -->
                        <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
                          <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
                          <?php endif; ?>
                        <!-- ///Flash Message End/// -->
                <!-- ///=====================All Contents Start Here============= //-->
                          <div class="">
                            <?php if(isset($data)) {
                            foreach($data as $building) { ?>
                            <div class="col-lg-6">
                              <div class="well">
                                <div class="row">
                                  <div class="col-md-4">
                                    <img src="<?=base_url('assets/img/dummy_building.png'); ?>" class="img-responsive">
                                  </div>
                                  <div class="col-md-8">
                                    <h4>Project : <span style="color: red;"><?=$building['name']; ?></span></h4>
                                    <h5>Site : <b><?=$this->dbm->getIndex('sites','name',['id'=>$building['site_id']]); ?></b></h5>
                                    <h5>Address : <b><?=$building['address']; ?></b></h5>
                                    <h6>Created Date : <span><?=$building['date']; ?></span></h6>
                                    <a href="<?=base_url('real1/flatMgmt/opn/'.$building['id']); ?>" class="btn btn-primary btn-sm"> Add New Plots </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php } } else { ?>
                            <div class="col-lg-12">
                              <div class="well">
                                <h2>There is no Projects added yet.</h2>
                              </div>
                            </div>
                            <?php } ?>
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
