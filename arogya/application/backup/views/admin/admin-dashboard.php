<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Welcome to Dashboard';?> | <?=$this->siteInfo['name'];?></title>
  	<?php $this->load->view('include/header'); ?>
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/front-dashboard.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
		       <div class="container-fluid padding-top main-container">
         
<!-- ///=====================All Contents Start Here==========================================/// -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading green" id="head-tile"><i class="fa fa-check-square-o fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content green">
                              <div class="circle-tile-description text-faded"> Status</div>
                              <div class="circle-tile-number text-faded ">Active</div>
                            <a class="circle-tile-footer" href="#">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
        <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading dark-blue" id="head-tile"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content dark-blue">
                              <div class="circle-tile-description text-faded">Total Active Users</div>
                              <?php $num=$this->db_model->rowCount('users',['access_level'=>'limited']); ?>
                              <div class="circle-tile-number text-faded "><?=$num;?></div>
                            <a class="circle-tile-footer" href="#">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                <?php //$count=$this->db_model->rowCount('users',['sponcer_id'=>$this->logged['user_id']]); ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading purple" id="head-tile"><i class="fa fa-calendar fa-3x"></i></div></a>
                          <div class="circle-tile-content purple">
                              <div class="circle-tile-description text-faded"><?=date('h:i:s A');?></div>
                              <div class="circle-tile-number text-faded "><?=date('d-M-Y');?></div>
                            <a class="circle-tile-footer" href="#">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile">
                        <a href="#"><div class="circle-tile-heading blue" id="head-tile"><i class="fa fa-envelope-open-o fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content blue">
                              <div class="circle-tile-description text-faded"> User Query</div>
                              <?php $que=$this->db_model->rowCount('query',['sender!='=>'Admin']); ?>
                              <div class="circle-tile-number text-faded "><?=$que;?></div>
                            <a class="circle-tile-footer" href="<?=base_url('control/quickReply/get'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
            </div>

          <div class="row well">
            <legend>Property Types</legend>
            <?php if($data) { foreach($data as $building) { ?>
                  <div class="col-lg-4">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-xs-3">
                            <i class="fa fa-building-o fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                            <p class="announcement-heading"></p>
                              <span style="color: greenyellow;font-size: 18px;"><?=$building['name']; ?></span>
                              <p><?=$building['address'];?></p>
                          </div>
                        </div>
                      </div>
                      <a href="<?=base_url('real1/flats/list/'.$building['id']); ?>">
                        <div class="panel-footer announcement-bottom">
                          <div class="row">
                            <div class="col-xs-6">
                              Expand 
                            </div>
                            <div class="col-xs-6 text-right">
                              <i class="fa fa-arrow-circle-right"></i>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <?php } } else { echo '<b>No Projects Created yet.</b>'; } ?>
                </div>
          <div class="row">
            <div class="col-lg-8">
              <div class="row">
                  <div class="col-lg-6 col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-users fa-5x"></i>
                                  </div>
                                  <div class="col-xs-8 text-right">
                                    <p class="announcement-heading"></p>
                                    <h3 class="announcement-text">Manage Users</h3>
                                  </div>
                              </div>
                            </div>
                            <a href="<?=base_url('real1/exploreData/flat_registration/user-management');?>">
                              <div class="panel-footer announcement-bottom">
                                  <div class="row">
                                    <div class="col-xs-6">
                                        Expand
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </div>
                                  </div>
                              </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-outdent fa-5x"></i>
                                  </div>
                                  <div class="col-xs-8 text-right">
                                    <p class="announcement-heading"></p>
                                    <h3 class="announcement-text">Business Status</h3>
                                  </div>
                              </div>
                            </div>
                            <a href="<?=base_url('real1/exploreData/project/payment_report');?>">
                              <div class="panel-footer announcement-bottom">
                                  <div class="row">
                                    <div class="col-xs-6">
                                        Expand
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </div>
                                  </div>
                              </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-sitemap fa-5x"></i>
                                  </div>
                                  <div class="col-xs-8 text-right">
                                    <p class="announcement-heading"></p>
                                    <h3 class="announcement-text">Manage Associate</h3>
                                  </div>
                              </div>
                            </div>
                            <a href="<?=base_url('real1/exploreData/users/associate-management');?>">
                              <div class="panel-footer announcement-bottom">
                                  <div class="row">
                                    <div class="col-xs-6">
                                        Expand
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </div>
                                  </div>
                              </div>
                            </a>
                        </div>
                    </div>

                    <!-- <div class="col-lg-6 col-sm-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-user fa-5x"></i>
                                  </div>
                                  <div class="col-xs-6 text-right">
                                    <p class="announcement-heading"></p>
                                    <h3 class="announcement-text">View Profile</h3>
                                  </div>
                              </div>
                            </div>
                            <a href="<?=base_url('control/explore/my-profile');?>">
                              <div class="panel-footer announcement-bottom">
                                  <div class="row">
                                    <div class="col-xs-6">
                                        Expand
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </div>
                                  </div>
                              </div>
                            </a>
                        </div>
                    </div> -->
                </div>
              </div>
              <div class="col-lg-4">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Announcement For Associates</h3>
                  </div>
                  <div class="panel-body" id="news-panel">
                    <div class="list-group"><marquee direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" height="200">
                    <?php if($notice){ $i=1;
                    foreach ($notice as $key => $value){ ?>
                <a onclick="return noticeModal('<?=$this->db_model->dateFormat($value['date']);?>','<?=$value['message'];
                ?>');" href="#" class="list-group-item"><b><?=$i;?></b> : Date :- <?=$this->db_model->dateFormat($value['date']);?><br><?=substr($value['message'],0,50);?>...</a>
                <a href="#" class="list-group-item"></a>
                    <?php $i++; } } else { ?>
                    <p>No Current Announcements.</p>
                    <?php } ?></marquee>
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
<!-- Bootstrap Modal for Notice -->
          <div class="modal fade" id="noticeModal" role="dialog">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                    <div class="panel panel-primary" style="margin-bottom: 0px;">
                    <div class="panel-heading">
                     <p class="panel-title">Notice
                     <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                <a href="#" class="list-group-item"><b>Issue Date : </b><h5 class="txtred" id="noticeDate"></h5></a>
                <a href="#" class="list-group-item"><b>Message : </b><p id="notice"></p></a>
                      </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Modal End -->
<script type="text/javascript">
  
  function noticeModal(date,message)
  {
    $('#noticeModal').modal('show');
    $('#noticeDate').html(date);
    $('#notice').html(message);
  }
</script>
<style type="text/css">
#news-panel{
  height: 248px;
  overflow-y:scroll;
}
.backbg{
  background-image: url(<?=base_url('assets/img/bg1.jpg');?>);
  background-attachment: fixed;
}
.circle-tile {
    margin-bottom: 15px;
    text-align: center;
}
.circle-tile-heading {
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 100%;
    color: #fff;
    height: 80px;
    margin: 0 auto -40px;
    position: relative;
    transition: all 0.3s ease-in-out 0s;
    width: 80px;
}

.circle-tile:hover #head-tile{
    -webkit-transform: scale(1.15);
        -ms-transform: scale(1.15);
        transform: scale(1.15);
        transition: all 0.5s;
}
.circle-tile-heading .fa {
    line-height: 80px;
}
.circle-tile-content {
    padding-top: 50px;
}
.circle-tile-number {
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
    padding: 5px 0 15px;
}
.circle-tile-description {
    text-transform: uppercase;
}
.circle-tile-footer {
    background-color: rgba(0, 0, 0, 0.1);
    color: #fff;
    display: block;
    padding: 5px;
    transition: all 0.3s ease-in-out 0s;
}
.circle-tile-footer:hover {
    background-color: rgba(0, 0, 0, 0.2);
    color: #fff;
    text-decoration: none;
}
.circle-tile-heading.dark-blue:hover {
    background-color: #2E4154;
}
.circle-tile-heading.green:hover {
    background-color: forestgreen;
}
.circle-tile-heading.orange:hover {
    background-color: #DA8C10;
}
.circle-tile-heading.blue:hover {
    background-color: #2473A6;
}
.circle-tile-heading.red:hover {
    background-color: #CF4435;
}
.circle-tile-heading.purple:hover {
    background-color: teal;
}
.tile-img {
    text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
}

.dark-blue {
    background-color: #34495E;
}
.green {
    background-color: forestgreen;
}
.blue {
    background-color: #2980B9;
}
.orange {
    background-color: #F39C12;
}
.red {
    background-color: #E74C3C;
}
.purple {
    background-color: teal;
}
.dark-gray {
    background-color: #7F8C8D;
}
.gray {
    background-color: #95A5A6;
}
.light-gray {
    background-color: #BDC3C7;
}
.yellow {
    background-color: #F1C40F;
}
.text-dark-blue {
    color: #fff;
}
.text-green {
    color: #fff;
}
.text-blue {
    color: #fff;
}
.text-orange {
    color: #fff;
}
.text-red {
    color: #fff;
}
.text-purple {
    color: #fff;
}
.text-faded {
    color: #fff;
}
legend{
  border-bottom: 1px solid cadetblue;
    border-bottom-style: dashed;
}
   

</style>