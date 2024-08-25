<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Flat List';?> | <?=$this->siteInfo['name'];?></title>
    <?php $this->load->view('include/header'); ?>
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
      <link href="<?=base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="<?=base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-datepicker.css'); ?>"> 
      <link href="<?=base_url('assets/css/templatemo-style.css'); ?>" rel="stylesheet">
      <link href="<?=base_url('assets/css/mystyle.css" rel="stylesheet'); ?>">
      <link href="<?=base_url('assets/css/dashboardstyle.css" rel="stylesheet'); ?>">
      <link rel="icon" href="<?=base_url('assets/img/dummy_building.png'); ?>" type="image/gif" sizes="16x16">


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       <style type="text/css">
    .hide-bullets {
        list-style:none;
        margin-left: -40px;
        margin-top:20px;
    }

    .thumbnail {
        padding: 0;
    }

    .carousel-inner>.item>img, .carousel-inner>.item>a>img {
        width: 100%;
    }
      </style>
      <script type="text/javascript">
       jQuery(document).ready(function($) {
     
            $('#myCarousel').carousel({
                    interval: false
            });
     
            //Handles the carousel thumbnails
            $('[id^=carousel-selector-]').click(function () {
            var id_selector = $(this).attr("id");
            try {
                var id = /-(\d+)$/.exec(id_selector)[1];
                console.log(id_selector, id);
                jQuery('#myCarousel').carousel(parseInt(id));
            } catch (e) {
                console.log('Regex failed!', e);
            }
        });
            // When the carousel slides, auto update the text
            $('#myCarousel').on('slid.bs.carousel', function (e) {
                     var id = $('.item.active').data('slide-number');
                    $('#carousel-text').html($('#slide-content-'+id).html());
            });
    });
      </script>
      <script type="text/javascript">
      $(document).ready(function(){
       $('[data-toggle="offcanvas"]').click(function(){
           $("#navigation").toggleClass("hidden-xs");
       });
    });
    </script>
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
           
                <div class="user-dashboard">
                  <center><h4 style="color: red;"></h4></center>
                  <!--///////////////////////Flash Message///////////////////////// -->
                  <?php if($alert=$this->session->flashdata('msg')): 
                  $class=$this->session->flashdata('msg_class');
                  ?>
                  <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                    <div class="alert alert-dismissible <?= $class; ?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo $alert; ?>.</strong>
                  </div>
                  </div>
                  </div>
                  <?php endif; ?>
                  <!--///////////////////////Flash Message End///////////////////////// -->
                  <div class="row">
                    <div class="col-lg-5">
                      <div class="well">
                        <div class="row">
                          <div class="col-md-4">
                            <img src="<?=base_url('assets/img/dummy_building.png'); ?>" class="img-responsive">
                          </div>
                          <div class="col-md-8">
                            <h4>Property Type: <span style="color: red;"><?=$project['name']; ?></span></h4>
                            <h5>Site : <b><?=$this->dbm->getIndex('sites','name',['id'=>$project['site_id']]); ?></b></h5>
                            <h5>Address: <b><?=$project['address']; ?></b></h5>
                            <h6>Created Date: <span><?=$project['date']; ?></span></h6>
                            <a href="<?=base_url('real1/flatMgmt/opn/'.$project['id']); ?>" class="btn btn-primary btn-sm"> Add New Plot</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-7">
                      <div class="col-xs-12" id="slider">
                        <!-- Top part of the slider -->
                        <div class="row">
                          <div class="col-sm-12" id="carousel-bounding-box">
                            <div class="carousel slide" id="myCarousel" data-interval="false">
                              <!-- Carousel items -->
                              <div class="carousel-inner">
                                <?php $i=0; foreach($flat as $flatDetail){ 
                                if($i==0) { ?>
                                <div class="active item" data-slide-number="<?=$i;?>">
                                  <div class="well" style="margin-bottom: 5px;">
                                    <table class="table table-condensed table-striped" style="margin-bottom: 0px;">
                                      <tr>
                                        <th>Plot No.</th><td colspan="5"><?=$flatDetail['flat_num']; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Area </th><td><?=$flatDetail['area']; ?></td>
                                        <th>Rate </th><td><?=$flatDetail['rate']; ?></td>
                                        <th>Price</th><td><?=$flatDetail['total']; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Location </th><td colspan="5"><b><?=$flatDetail['location']; ?></b></td>
                                      </tr>
                                      <tr>
                                        <?php if($flatDetail['status']!=1) { ?>
                                          <th>Status</th><td><b style="color: green;">Vacent</b></td>
                                          <td colspan="2"><a href="<?=base_url('real1/flatReg/regopn/'.$flatDetail['id']);?>" class="btn btn-sm btn-block btn-success">Register</a></td>
                                        <?php } else { ?>
                                          <th>Status</th><td><b style="color: red;">Booked</b></td>
                                          <td colspan="2"><a href="<?=base_url('real1/flats/get-flat-information/'.$project['id'].'/'.$flatDetail['id']);?>" class="btn btn-sm btn-block btn-danger">Explore</a></td>
                                        <?php } ?>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <?php } else { ?>
                                <div class="item" data-slide-number="<?=$i;?>">
                                  <div class="well" style="margin-bottom: 5px;">
                                    <table class="table table-striped table-condensed" style="margin-bottom: 0px;">
                                      <tr>
                                        <th>Plot No.</th><td colspan="5"><?=$flatDetail['flat_num']; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Area </th><td><?=$flatDetail['area']; ?></td>
                                        <th>Rate </th><td><?=$flatDetail['rate']; ?></td>
                                        <th>Price</th><td><?=$flatDetail['total']; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Location </th><td colspan="5"><b><?=$flatDetail['location']; ?></b></td>
                                      </tr>
                                      <tr>
                                        <?php if($flatDetail['status']!=1) { ?>
                                          <th>Status</th><td><b style="color: green;">Vacent</b></td>
                                          <td colspan="2"><a href="<?=base_url('real1/flatReg/regopn/'.$flatDetail['id']);?>" class="btn btn-sm btn-block btn-success">Register</a></td>
                                        <?php } else { ?>
                                          <th>Status</th><td><b style="color: red;">Booked</b></td>
                                          <td colspan="2"><a href="<?=base_url('real1/flats/get-flat-information/'.$project['id'].'/'.$flatDetail['id']);?>" class="btn btn-sm btn-block btn-danger">Explore</a></td>
                                        <?php } ?>
                                      </tr>
                                    </table>                 
                                  </div>
                                </div>

                                <?php  } $i++; } ?>

                                                  
                                              </div>
                                              <!-- Carousel nav -->
                                              <a class="my-left my-carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                  <span id="caro-btn" class="glyphicon glyphicon-arrow-left"></span>
                                              </a>
                                              <a class="my-right my-carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                  <span id="caro-btn" class="glyphicon glyphicon-arrow-right"></span>
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                    </div>
                  </div>
                              
                  </div>
                  <div id="main_area">
                      <!-- Slider -->
                      <div class="row">
                          <div class="col-lg-11 col-lg-offset-1" id="slider-thumbs">
                              <!-- Bottom switcher of slider -->
                            <ul class="nav nav-tabs">
                              <?php $i=1; foreach ($flatTypes as $key => $flatType): ?>                
                              <li class="<?= ($i==1)?'active':'' ?>"><a data-toggle="tab" href="#flatId<?= $flatType['flat_type']; ?>"><?= $flatType['flat_type']; ?></a></li>
                              <?php $i++; endforeach ?>
                              
                            </ul>

                      <div class="tab-content">
                        <?php $j=1; foreach ($flatTypes as $key => $flatType): ?>
                        <div id="flatId<?= $flatType['flat_type']; ?>" class="tab-pane fade in <?= ($j==1)?'active':'' ?>">
                                
                              <ul class="hide-bullets">
                                <?php $i=0; foreach($flat as $flatDetail){
                                if ($flatDetail['flat_type']== $flatType['flat_type']) {
                                 
                                if($flatDetail['status']!=1) { 
                                  if ($flatDetail['booking_status']==1) {
                                    ?>
                                     <li class="col-sm-2 col-xs-6">
                                       <div class="well" id="carousel-selector-<?=$i;?>" style="color: forestgreen; background: #FFB300;">
                                       <center>
                                   <?php if($this->logged['access_level']=='universal'){ ?>
                                       <a onclick="return conDel('real1/flatMgmt/edt/<?=$project['id'].'/'.$flatDetail['id'];?>');" href="javascript:" class="flat-edit fa fa-pencil" title="Edit"></a>
                                       <a onclick="return conDel('real1/flatMgmt/del/<?=$project['id'].'/'.$flatDetail['id'];?>');" href="javascript:" class="flat-del fa fa-trash" title="Delete"></a>
                                   <?php }
                                   $ragisterdflat=$this->db->get_where('flat_registration',array('flat_id'=>$flatDetail['id']))->row_array();

                                    ?>
                                         <center><b>Plot No.</b>
                                         <h5><?=$flatDetail['flat_num']; ?></h5>
                                           <a href="<?= base_url('control/getData/flat_registration/'.$ragisterdflat['id'].'/flat_registration_payment') ?>" class="btn btn-success btn-sm">It's Booked</a></center>
                                         </div>
                                     </li> 

                                  <?php
                                  }else{
                                  ?>

                                  <li class="col-sm-2 col-xs-6">
                                    <div class="well" id="carousel-selector-<?=$i;?>" style="color: #FFF;background: forestgreen;">
                                    <center>
                                <?php if($this->logged['access_level']=='universal'){ ?>
                                    <a onclick="return conDel('real1/flatMgmt/edt/<?=$project['id'].'/'.$flatDetail['id'];?>');" href="javascript:" class="flat-edit fa fa-pencil" title="Edit"></a>
                                    <a onclick="return conDel('real1/flatMgmt/del/<?=$project['id'].'/'.$flatDetail['id'];?>');" href="javascript:" class="flat-del fa fa-trash" title="Delete"></a>
                                <?php } ?>
                                      <center><b>Plot No.</b>
                                      <h5><?=$flatDetail['flat_num']; ?></h5>
                                        <a href="<?=base_url('real1/flatReg/regopn/'.$flatDetail['id']);?>" class="btn btn-info btn-sm">Vacent</a></center>
                                      </div>
                                  </li>
                                <?php } }else { ?>

                                  <li class="col-sm-2 col-xs-6">
                                    <div class="well" id="carousel-selector-<?=$i;?>" style="color: #FFF;background: #B31B1A;">
                                <?php if($this->logged['access_level']=='universal'){ ?>
                                    <a onclick="return conDel('real1/flatMgmt/edt/<?=$project['id'].'/'.$flatDetail['id'];?>');" href="javascript:" class="flat-edit fa fa-pencil" title="Edit"></a>
                                    <a onclick="return conDel('real1/flatMgmt/del/<?=$project['id'].'/'.$flatDetail['id'];?>');" href="javascript:" class="flat-del fa fa-trash" title="Delete"></a>
                                <?php } ?>
                                      <center><b>Plot No.</b>
                                      <h5><?=$flatDetail['flat_num']; ?></h5>
                                       <a href="<?=base_url('real1/flats/get-flat-information/'.$project['id'].'/'.$flatDetail['id']);?>" class="btn btn-warning btn-sm">Booked</a> </center>
                                    </div>
                                  </li>

                                <?php }  
                                } $i++; } ?>
                                  
                              </ul>
                              </div>
                               <?php $j++; endforeach ?>
                          </div>
                          
                          <!--/Slider-->
                      </div>

                  </div>      
                
                <!-- All Content End here -->
              <!-- Bootstrap Modal fo confirmation -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" style="color: red;"></span></button>
                        <h4 class="modal-title">Please Cofirm Your Password</h4>
                      </div>
                      <div class="modal-body">
                        <p style="color: red;" id="msg"></p>
                        <div class="input-group">
                          <input type="password" id="password" class="form-control" style="margin-bottom: 5px;" placeholder="Enter Your Password" required>
                          <input type="hidden" name="action" value="" id="action">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" id="conPass" type="button">Go!</button>
                          </span>
                        </div><!-- /input-group -->
                      </div>
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                      </div>
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
