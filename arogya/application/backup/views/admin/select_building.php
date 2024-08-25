<!DOCTYPE html>
<html>
<head>
  <title><?=$this->siteInfo['name'];?></title>
  <?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
    <div class="container-fluid no-padding display-table">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 no-padding hidden-xs display-table-cell v-align box" id="navigation">
            <?php $this->load->view('includes/sidebar.php',['page'=>'add-property']); ?>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php $this->load->view('includes/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="container-fluid no-padding main-container">
            <div class="title txtcenter">
            <h4>Select Property Type</h4>
          </div>
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
                      <h4>Property Type: <span style="color: red;"><?=$building['name']; ?></span></h4>
                      <h5>Address: <b><?=$building['address']; ?></b></h5>
                      <h6>Created Date: <span><?=$building['date']; ?></span></h6>
                      <a href="<?=base_url('real1/flatMgmt/opn/'.$building['id']); ?>" class="btn btn-primary btn-sm"> Select</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php } } else { ?>
              <div class="col-lg-12">
                <div class="well">
                  <h2>There is no building added yet.</h2>
                </div>
              </div>
              <?php } ?>
            </div>       
          </div>
          <!-- All Content End here -->
        </div>
      </div>
    </div>
</body>
<?php $this->load->view('includes/footer');?>