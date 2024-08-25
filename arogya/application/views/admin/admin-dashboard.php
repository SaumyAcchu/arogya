<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title><?=$page['page']='Dashboard';?> | <?=$this->siteInfo['name'];?></title>
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
		        <div class="row padding-top">
              <div class="col-lg-3 col-xs-6">
                  <div class="circle-tile ">
                      <a href="javascript:void(0);"><div class="circle-tile-heading green" id="head-tile"><i class="fa fa-check fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content green">
                            <div class="circle-tile-description text-faded">Status</div>
                            <h3 class="tile-head">Active</h3>
                          <a class="circle-tile-footer" href="<?=base_url('user/explore/my-profile'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                  </div>
              </div>

              <div class="col-lg-3 col-xs-6">
                  <div class="circle-tile ">
                      <a href="<?=base_url('auth/exploreData/users/user-management'); ?>"><div class="circle-tile-heading lightseagreen" id="head-tile"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content lightseagreen">
                            <div class="circle-tile-description text-faded"> Total Members </div>
                            <?php $dir=$this->dbm->rowCount('users',['id>'=>0]); ?>
                            <h3 class="tile-head"><?=$dir;?></h3>
                            
                             <a class="circle-tile-footer" href="<?=base_url('auth/exploreData/users/user-management'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            
                          <!--<a class="circle-tile-footer" href="<?=base_url('user/statics/'.base64_encode('directAll/1/My Referrals'));?>">More Info <i class="fa fa-chevron-circle-right"></i></a>-->
                        </div>
                  </div>
              </div>

            <div class="col-lg-3 col-xs-6">
                  <div class="circle-tile ">
                      <a href="<?=base_url('auth/exploreData/users/active-management'); ?>"><div class="circle-tile-heading mediumseagreen" id="head-tile"><i class="fa fa-check-circle-o fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content mediumseagreen">
                            <div class="circle-tile-description text-faded"> Active Members</div>
                            <?php $act=$this->dbm->rowCount('users',['status'=>1]); ?>
                            <h3 class="tile-head"><?=$act;?></h3>
                          <a class="circle-tile-footer" href="<?=base_url('auth/exploreData/users/active-management'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                  </div>
              </div>
              
              <div class="col-lg-3 col-xs-6">
                  <div class="circle-tile">
                      <a href="<?=base_url('auth/exploreData/users/diactive-management'); ?>"><div class="circle-tile-heading indianred" id="head-tile"><i class="fa fa-times-circle-o fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content indianred">
                            <div class="circle-tile-description text-faded"> Deactive Members </div>
                            <?php $act1=$this->dbm->rowCount('users',['status'=>0]); ?>
                            <h3 class="tile-head"><?=$act1;?></h3>
                          <a class="circle-tile-footer" href="<?=base_url('auth/exploreData/users/diactive-management'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                  </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                  <div class="circle-tile ">
                      <a href="<?=base_url('auth/getAllData/'.base64_encode('pin/generate_by/admin/pin-management')); ?>"><div class="circle-tile-heading orange" id="head-tile"><i class="fa fa-pinterest-p fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content orange">
                            <div class="circle-tile-description text-faded">Total PINs</div>
                            <?php $pin=$this->dbm->rowCount('pin',['id>'=>0]); ?>
                            <h3 class="tile-head"><?=$pin;?></h3>
                          <a class="circle-tile-footer" href="<?=base_url('auth/getAllData/'.base64_encode('pin/generate_by/admin/pin-management')); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                  </div>
              </div>

              <div class="col-lg-3 col-xs-6">
                  <div class="circle-tile ">
                      <a href="<?=base_url('auth/exploreData/users/today-registration'); ?>"><div class="circle-tile-heading lightseagreen" id="head-tile"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content lightseagreen">
                            <div class="circle-tile-description text-faded"> Today Registrations </div>
                            <?php $tod=$this->dbm->rowCount('users',['reg_date'=>date('Y-m-d')]); ?>
                            <h3 class="tile-head"><?=$tod;?></h3>
                          <a class="circle-tile-footer" href="<?=base_url('auth/exploreData/users/today-registration'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                  </div>
              </div>

            <div class="col-lg-3 col-xs-6">
                  <div class="circle-tile ">
                      <a href="<?=base_url('auth/exploreData/users/today-active'); ?>"><div class="circle-tile-heading mediumseagreen" id="head-tile"><i class="fa fa-check-circle-o fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content mediumseagreen">
                            <div class="circle-tile-description text-faded"> Today Active</div>
                            <?php $todact=$this->dbm->rowCount('users',['active_date'=>date('Y-m-d')]); ?>
                            <h3 class="tile-head"><?=$todact;?></h3>
                          <a class="circle-tile-footer" href="<?=base_url('auth/exploreData/users/today-active'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                  </div>
              </div>
              
              <div class="col-lg-3 col-xs-6">
                  <div class="circle-tile">
                      <a href="http://myarastustores.com/dashboard/auth/quickReply/get"><div class="circle-tile-heading blue" id="head-tile"><i class="fa fa-comments fa-fw fa-3x"></i></div></a>
                        <div class="circle-tile-content blue">
                            <div class="circle-tile-description text-faded"> User Queries </div>
                            <?php $que=$this->dbm->rowCount('query',['sender!='=>'Admin']); ?>
                            <h3 class="tile-head"><?=$que;?></h3>
                          <a class="circle-tile-footer" href="http://myarastustores.com/dashboard/auth/quickReply/get">More Info <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                  </div>
              </div>
		        </div>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-lg-8">
                <div class="panel panel-danger">
                  <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-history"></i>  Recent Joining</h3>
                  </div>
                  <div class="panel-body" id="news-panel">
                    <table class="table table-hover">
                      <tr>
                        <th>Sl.</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Sponcer</th>
                        <th>Reg. Time</th>
                        <th>Mobile</th>
                      </tr>
                      <?php if(count($recent)>0) {  $i=1;
                        foreach ($recent as $key => $value) { ?>
                          <tr>
                            <td><?=$i;?></td>
                            <td><?=$value['user_id'];?></td>
                            <td><?=$value['name'];?></td>
                            <td><?=$value['sponcer_id'];?></td>
                            <td><?=date('d-M-Y H:i:s',strtotime($value['created']));?></td>
                            <td><?=$value['mobile'];?></td>
                          </tr>
                      <?php $i++; } }else{ ?>
                          <tr><td colspan="6">No Records Found</td></tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> Latest Announcements</h3>
                  </div>
                  <div class="panel-body" id="news-panel">
                    <div class="list-group"><marquee direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" height="335">
                    <?php if($notice){ $i=1;
                    foreach ($notice as $key => $value){ ?>
                <a onclick="return noticeModal('<?=$this->dbm->dateFormat($value['date']);?>','<?=$value['message'];
                ?>');" href="javascript:void(0);" class="list-group-item"><b><?=$i;?></b> : Date :- <?=$this->dbm->dateFormat($value['date']);?><br><?=substr($value['message'],0,50);?>...</a>
                <a href="#" class="list-group-item"></a>
                    <?php $i++; } } else { ?>
                    <p>No Current Announcements.</p>
                    <?php } ?></marquee>
                      </div>
                  </div>
                </div>  
              </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <p class="panel-title">Last 15 Days Statistics</p>
                  </div>
                  <div class="panel-body">
                    <div id="line-chart"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-lg-12">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                    <p class="panel-title">Essentials</p>
                  </div>
                <div class="panel-body">
              <div class="col-lg-4 col-sm-6">
                    <div class="panel panel-info" style="border:none;margin-bottom: 20px">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-sitemap fa-5x"></i>
                              </div>
                              <div class="col-xs-8 text-right">
                                <p class="announcement-heading"></p>
                                <h3 class="announcement-text">Genealogy</h3>
                              </div>
                          </div>
                        </div>
                        <a href="<?=base_url('stable/treeView/'.base64_encode($this->logged['user_id']));?>">
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

                <div class="col-lg-4 col-sm-6">
                    <div class="panel panel-danger" style="border:none;margin-bottom: 20px;">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-cogs fa-5x"></i>
                              </div>
                              <div class="col-xs-8 text-right">
                                <p class="announcement-heading"></p>
                                <h3 class="announcement-text">User Management</h3>
                              </div>
                          </div>
                        </div>
                        <a href="<?=base_url('user/statics/'.base64_encode('selfAll/1/Self Team'));?>">
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

                <div class="col-lg-4 col-sm-6">
                    <div class="panel panel-warning" style="border:none;margin-bottom: 20px;">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-pinterest-p fa-5x"></i>
                              </div>
                              <div class="col-xs-8 text-right">
                                <p class="announcement-heading"></p>
                                <h3 class="announcement-text">Payout Management</h3>
                              </div>
                          </div>
                        </div>
                        <a href="<?=base_url('auth/paymentHistory');?>">
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

                <div class="col-lg-4 col-sm-6">
                    <div class="panel panel-info" style="border:none;margin-bottom: 20px;">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-list fa-5x"></i>
                              </div>
                              <div class="col-xs-8 text-right">
                                <p class="announcement-heading"></p>
                                <h3 class="announcement-text">Announcements</h3>
                              </div>
                          </div>
                        </div>
                        <a href="<?=base_url('user/explore/my-profile');?>">
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

               

                <div class="col-lg-4 col-sm-6">
                    <div class="panel panel-warning" style="border:none;margin-bottom: 20px;">
                        <div class="panel-heading">
                          <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-user fa-5x"></i>
                              </div>
                              <div class="col-xs-6 text-right">
                                <p class="announcement-heading"></p>
                                <h3 class="announcement-text">My Profile</h3>
                              </div>
                          </div>
                        </div>
                        <a href="<?=base_url('user/explore/my-profile');?>">
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
<style type="text/css">
  #news-panel{
    height: 335px;
  }
</style>
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
        <a href="#" class="list-group-item"><small>Issue Date : <span class="txtred" id="noticeDate"></span></small></a>
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
  $(document).ready(function() {
    //barChart();
    lineChart();
    // areaChart();
    // donutChart();

    $(window).resize(function() {
      //window.barChart.redraw();
      window.lineChart.redraw();
      //window.areaChart.redraw();
      //window.donutChart.redraw();
    });
  });
  function lineChart() {
    window.lineChart = Morris.Line({
      element: 'line-chart',
      data: <?php echo json_encode($data); ?>,
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Active', 'Register'],
      lineColors: ['#1e88e5','#ff3321'],
      lineWidth: '3px',
      resize: true,
      redraw: true
    });
  }
</script>
<style type="text/css">
  .morris-hover {
  position:absolute;
  z-index:1000;
}

.morris-hover.morris-default-style {     border-radius:10px;
  padding:6px;
  color:#666;
  background:rgba(255, 255, 255, 0.8);
  border:solid 2px rgba(230, 230, 230, 0.8);
  font-family:sans-serif;
  font-size:12px;
  text-align:center;
}

.morris-hover.morris-default-style .morris-hover-row-label {
  font-weight:bold;
  margin:0.25em 0;
}

.morris-hover.morris-default-style .morris-hover-point {
  white-space:nowrap;
  margin:0.1em 0;
}

svg { width: 100%; }
</style>