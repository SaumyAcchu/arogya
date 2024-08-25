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
            <?php $this->load->view('includes/sidebar.php',['page'=>'search-plot']); ?>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php $this->load->view('includes/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="container-fluid no-padding main-container">
            <div class="title txtcenter">
            <h4>Plot Status</h4>
          </div>
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  <!-- ///=====================All Contents Start Here============= //-->
            <div class=" col-lg-10 col-lg-offset-1 well">
              <table class="table table-hover table-bordered table-striped">
                <tbody>
                  <?php $building=$this->db->get_where('project',['id'=>$flat['building_id']])->row_array(); ?>
                  <tr>
                    <th>Property Type</th><td style="color: blue;"><?=$building['name'];?></td>
                    <th> Address</th><td><?=$building['address']; ?></td>
                  </tr>
                  <tr>
                    <th>Plot No.</th><td colspan="3"><?=$flat['flat_num']; ?></td>
                  </tr>
                  <tr>
                    <th>Location</th><td colspan="3"><?=$flat['location']; ?></td>
                  </tr>
                  <tr>
                    <th>Area</th><td><?=$flat['area']; ?>Sq.ft</td>
                    <th>Rate</th><td><?=$flat['rate']; ?>/Sq.ft</td>
                  </tr>
                  <?php if($flat['parking_pay']>0)
                  { ?>
                  <tr>
                    <td colspan="3" style="text-align: right;">Parking Amount</td><td><?=$flat['parking_pay'];?></td>
                  </tr>
                  <?php } ?>
                  <?php if($flat['additional_amount1']!='')
                  { ?>
                  <tr>
                    <td colspan="3" style="text-align: right;"><?=$flat['additional_detail1'];?></td><td><?=$flat['additional_amount1'];?></td>
                  </tr>
                  <?php } ?>
                  <?php if($flat['additional_amount2']!='')
                  { ?>
                  <tr>
                    <td colspan="3" style="text-align: right;"><?=$flat['additional_detail2'];?></td><td><?=$flat['additional_amount2'];?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <th colspan="3" style="text-align: right;">Grand Total</th><th style="color: red;"><?=$flat['total'];?></th>
                  </tr>
                  <tr>
                    <?php if($flat['status']==0)
                     { ?>
                      <th>Status</th>
                      <th style="color:green"> Vacent</th>
                      <th>Action</th><td><a href="<?=base_url('real1/flatReg/regopn/'.$flat['id']);?>" class="btn btn-success btn-block btn-sm">Register</a></td>
                      <?php }else { ?>
                      <th>Status</th>
                      <th style="color:red"> Booked</th>
                      <th>Action</th><td><a href="<?=base_url('real1/flats/get-flat-information/'.$building['id'].'/'.$flat['id']);?>" class="btn btn-danger btn-block btn-sm">Details</a>
                      <?php } ?> 
                  </tr>
                </tbody>
              </table>
            </div>      
          </div>
          <!-- All Content End here -->
        </div>
      </div>
    </div>
</body>
<?php $this->load->view('includes/footer.php'); ?>