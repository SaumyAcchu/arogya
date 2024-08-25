<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
          <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/front-dashboard.css'); ?>">
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
		        <?php $this->load->view('include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
		        <div class="row padding-top">
              <?php if($this->logged['status']==1){
                $color='green'; $fa='fa-check-square-o';
                $status='Active';
              }else {
                $color='red'; $fa='fa-user-times';
                $status='Deactive'; ?>
                <hr>
                <center>Do You Have Pin : <button type="button" id="opnModal" class="btn btn-primary"> Activate Now </button></center><hr><?php
              } 
               ?>
              <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="javascript:void(0);"><div class="circle-tile-heading <?=$color;?>" id="head-tile"><i class="fa <?=$fa;?> fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content <?=$color;?>">
                              <div class="circle-tile-description text-faded">Status</div>
                              <h3 class="tile-head"><?=$status;?></h3>
                            <a class="circle-tile-footer" href="<?=base_url('user/explore/my-profile'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="<?=base_url('user/statics/'.base64_encode('directAll/1/My Referrals'));?>"><div class="circle-tile-heading purple" id="head-tile"><i class="fa fa-line-chart fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content purple">
                              <div class="circle-tile-description text-faded"> Level </div>
                              <?php $query=$this->db->where(['user_id'=>$this->logged['user_id']])->select('*')->order_by('id','DESC')->get('level_statics')->row_array(); ?>
                              <h3 class="tile-head"><?=$query['club'];?></h3>
                            <a class="circle-tile-footer" href="<?=base_url('user/statics/'.base64_encode('directAll/1/My Referrals'));?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>

              <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="<?=base_url('user/paymentHistory'); ?>"><div class="circle-tile-heading dark-blue" id="head-tile"><i class="fa fa-google-wallet fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content dark-blue">
                              <div class="circle-tile-description text-faded"> Total Earnings</div>
                              <h3 class="tile-head"><?=number_format($this->dbm->totalEarn($this->logged['user_id']),2);?></h3>
                            <a class="circle-tile-footer" href="<?=base_url('user/paymentHistory'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>

                
                
                <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile">
                        <a href="javascript:void(0);"><div class="circle-tile-heading blue" id="head-tile"><i class="fa fa-inr fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content blue">
                              <div class="circle-tile-description text-faded"> Wallet</div>
                              <h3 class="tile-head"><?=number_format($this->logged['wallet'],2);?></h3>
                            <a class="circle-tile-footer" href="javascript:void(0);">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                
            </div>
    <!--..........Self And Repurchage......................................-->
    <div class="row">
        <?php $level = $this->db->get_where('club_users',['user_id'=>$this->logged['user_id']])->row_array(); ?>
        <?php 
        if($level['level']=="1")
        {
             $levels = "STAR";
        }
        
        if($level['level']=="2")
        {
           $levels = "SUPERSTAR";
        }
        if($level['level']=="3")
        {
             $levels = "GOLD";
        }
        ?>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="javascript:void(0);"><div class="circle-tile-heading blue" id="head-tile"><i class="fa <?=$fa;?> fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content blue">
                              <div class="circle-tile-description text-faded">Total LOB</div>
                              <?php $LOB = $this->db->select('*,sum(amount) as total')->get_where('club_income',['user_id'=>$this->logged['user_id']])->row_array(); ?>
                              
                              <h3 class="tile-head">
                                   <?=number_format($LOB['total'],2);?></h3>
                            <a class="circle-tile-footer" href="<?=base_url('user/explore/my-profile'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                
                
                   <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="javascript:void(0);"><div class="circle-tile-heading blue" id="head-tile"><i class="fa <?=$fa;?> fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content blue">
                              <div class="circle-tile-description text-faded">Travel Funds</div>
                              <?php $travl = $this->db->select('*,sum(amount) as total')->get_where('monthly_income',['user_id'=>$this->logged['user_id']])->row_array(); ?>
                              
                              <h3 class="tile-head">
                                  <?=number_format($travl['total'],2);?>
                                  
                                </h3>
                            <a class="circle-tile-footer" href="<?=base_url('user/explore/my-profile'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                 <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="<?=base_url('user/paymentHistory'); ?>"><div class="circle-tile-heading red" style="        background-image: linear-gradient(to right,#02fff3,#2e078e);
    background-repeat: repeat-x;
    border: 3px solid rgb(247, 233, 253);" id="head-tile"><i class="fa fa-google-wallet fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content red" style="        background-image: linear-gradient(to right,#02fff3,#2e078e);
    background-repeat: repeat-x;">
                              <div class="circle-tile-description text-faded"> Total Paid Amount</div>
                                      <?php 
                                $paid=$this->db->select('sum(amount) as total')->get_where('withdraw',['user_id'=>$this->logged['user_id'],'status'=>1])->row_array();
                              ?>
                              <h3 class="tile-head"> <?=number_format($paid['total'],2);?>
                              </h3>                            <a class="circle-tile-footer" href="<?=base_url('user/paymentHistory'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                   <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile ">
                        <a href="<?=base_url('user/paymentHistory'); ?>"><div class="circle-tile-heading red" style="        background-image: linear-gradient(to right,#02fff3,#2e078e);
    background-repeat: repeat-x;
    border: 3px solid rgb(247, 233, 253);" id="head-tile"><i class="fa fa-google-wallet fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content red" style="        background-image: linear-gradient(to right,#02fff3,#2e078e);
    background-repeat: repeat-x;">
                              <div class="circle-tile-description text-faded"> Total Unpaid Amount</div>
                                      <?php 
                                $paid=$this->db->select('sum(amount) as total')->get_where('withdraw',['user_id'=>$this->logged['user_id'],'status'=>0])->row_array();
                              ?>
                              <h3 class="tile-head"> <?=number_format($paid['total'],2);?>
                              </h3>                            <a class="circle-tile-footer" href="<?=base_url('user/paymentHistory'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                </div>
                <?php $selfpur = $this->db->select('*,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$this->logged['user_id'],'status'=>1])->row_array(); ?>

                <div class="col-lg-4 col-xs-6">
                    <div class="circle-tile ">
                        <a href="<?=base_url('user/statics/'.base64_encode('directAll/1/My Referrals'));?>"><div class="circle-tile-heading orange" id="head-tile"><i class="fa fa-line-chart fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content orange">
                              <div class="circle-tile-description text-faded">Total Self Repurchage(BV)  </div>
                              <h3 class="tile-head"  style="margin-bottom: 0px;"><?=$selfpur['total'];?></h3>
                        
                          </div>
                            <?php
         		$previous_week = strtotime("-1 week +1 day");
		 		$start_week = strtotime("last thursday");
		 		$end_week = strtotime("next thursday",$start_week);
		 		$start_week = date("Y-m-d",$start_week);
		 		$end_week = date("Y-m-d",$end_week);
              $go = $this->db->select('*,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$this->logged['user_id'],'status'=>1,'date>='=>$start_week,'date<='=>$end_week])->row_array();
                        ?>
                              <div class="circle-tile-content orange">
                              <div class="circle-tile-description text-faded">Weekly Self Repurchage(BV)  </div>
                              <h3 class="tile-head" ><?=number_format($go['total'],2);?></h3>
                           
                          </div>
                    </div>
                </div>
               

              <div class="col-lg-4 col-xs-6">
            <?PHP $bv = $this->dbm->countDownBusiness(); ?>
                    <div class="circle-tile ">
                        <a href="<?=base_url('user/paymentHistory'); ?>"><div class="circle-tile-heading dark-blue" id="head-tile"><i class="fa fa-google-wallet fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content dark-blue">
                              <div class="circle-tile-description text-faded">Total Left Repurchage (BV)</div>
                              <h3 class="tile-head" style="margin-bottom: 0px;"><?=$bv['lbv'];?></h3>
                          
                          </div>
                             <?PHP $week = $this->dbm->countDownBusinessWeek(); ?>
                              <div class="circle-tile-content dark-blue">
                              <div class="circle-tile-description text-faded">Weekly Left Repurchage (BV)</div>
                              <h3 class="tile-head"><?=$week['lbv'];?></h3>
                         
                          </div>
                    </div>
                </div>
    
                
                
                <div class="col-lg-4 col-xs-6">
                    <div class="circle-tile">
                        <a href="javascript:void(0);"><div class="circle-tile-heading blue" id="head-tile"><i class="fa fa-inr fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content blue">
                              <div class="circle-tile-description text-faded">Total Right Repurchage (BV)</div>
                              <h3 class="tile-head" style="margin-bottom: 0px;"><?=$bv['rbv'];?></h3>
                           
                          </div>
                              <div class="circle-tile-content blue">
                              <div class="circle-tile-description text-faded">Weekly Right Repurchage (BV)</div>
                              <h3 class="tile-head"><?=$week['rbv'];?></h3>
                          
                          </div>
                    </div>
                </div>
               

    </div>
    
    <!--.........................................-->
            <div class="row">
                
               


               <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile">
                        <a href="<?=base_url('user/downLine/'.base64_encode('left'));?>"><div class="circle-tile-heading coral" id="head-tile"><i class="fa fa-chevron-circle-left fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content coral">
                              <div class="circle-tile-description text-faded"> Left Users</div>
                              <h3 class="tile-head" id="left"><img src="<?=base_url('assets/images/loading.gif');?>" class="load" style="height:20px;"></h3>
                            <a class="circle-tile-footer"  href="<?=base_url('user/downLine/'.base64_encode('left'));?>">Explore Left Users <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile">
                        <a href="<?=base_url('user/downLine/'.base64_encode('right'));?>"><div class="circle-tile-heading coral" id="head-tile"><i class="fa fa-chevron-circle-right fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content coral">
                              <div class="circle-tile- text-faded"> Right Users</div>
                              <h3 class="tile-head" id="right"><img src="<?=base_url('assets/images/loading.gif');?>" class="load" style="height:20px;"></h3>
                            <a class="circle-tile-footer" href="<?=base_url('user/downLine/'.base64_encode('right'));?>">Explore Right Users<i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile">
                        <a href="<?=base_url('user/downLine/'.base64_encode('all'));?>"><div class="circle-tile-heading orange" id="head-tile"><i class="fa fa-sitemap fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content orange">
                              <div class="circle-tile-description text-faded">Groups</div>
                              <h3 class="tile-head" id="down"><img src="<?=base_url('assets/images/loading.gif');?>" class="load" style="height:20px;"></h3>
                            <a class="circle-tile-footer" href="<?=base_url('user/downLine/'.base64_encode('all'));?>">Explore Down Line <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="circle-tile">
                        <a href="<?=base_url('user/explore/my-profile'); ?>"><div class="circle-tile-heading  dark-blue" id="head-tile"><i class="fa fa-user fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content dark-blue">
                              <div class="circle-tile-description text-faded"><?=$this->logged['name'];?></div>
                              <h3 class="tile-head"><?=$this->logged['user_id'];?></h3>
                            <a class="circle-tile-footer" href="<?=base_url('user/explore/my-profile'); ?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                    </div>
                </div>
                <span style="display: none;" id="p1"><?=base_url('stable/join/'.base64_encode($this->logged['user_id']));?></span> 
            </div>
            <div class="row">
            <div class="col-lg-8">
              <div class="row">
                  <div class="col-lg-6 col-sm-6">
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

                    <div class="col-lg-6 col-sm-6">
                        <div class="panel panel-danger" style="border:none;margin-bottom: 20px;">
                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-snowflake-o fa-5x"></i>
                                  </div>
                                  <div class="col-xs-8 text-right">
                                    <p class="announcement-heading"></p>
                                    <h3 class="announcement-text">Total Groups</h3>
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
                                    <i class="fa fa-btc fa-5x"></i>
                                  </div>
                                  <div class="col-xs-8 text-right">
                                    <p class="announcement-heading"></p>
                                    <h3 class="announcement-text">Self BV</h3>
                                     <h3 class="tile-head" id="left" style="color:black;">
                                         <?=$this->logged['cv'];?>
                                     </h3>
                                  </div>
                              </div>
                            </div>
                            <a href="<?=base_url('user/paymentHistory');?>">
                              <div class="panel-footer announcement-bottom">
                                  
                              </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="panel panel-warning" style="border:none;margin-bottom: 20px;">
                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-btc fa-5x"></i>
                                  </div>
                                  <div class="col-xs-8 text-right">
                                    <p class="announcement-heading"></p>
                                    <h3 class="announcement-text" style="font-size: 16px;">Left Team BV</h3>
                                     <h3 class="tile-head" id="left" style="color:black;">
                                         <?=$lbv;?>
                                     </h3>
                                  </div>
                              </div>
                            </div>
                            <a href="<?=base_url('user/paymentHistory');?>">
                              <div class="panel-footer announcement-bottom">
                                  
                              </div>
                            </a>
                        </div>
                    </div>
    
                    <div class="col-lg-4 col-sm-6">
                        <div class="panel panel-success" style="border:none;margin-bottom: 20px;">
                            <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-btc fa-5x"></i>
                                  </div>
                                  <div class="col-xs-6 text-right">
                                    <p class="announcement-heading"></p>
                                    <h3 class="announcement-text" style="font-size: 16px;">Right Team BV</h3>
                                    <h3 class="tile-head" id="left" style="color:black;">
                                         <?=$rbv;?>
                                     </h3>
                                  </div>
                              </div>
                            </div>
                            <a href="<?=base_url('user/explore/my-profile');?>">
                              <div class="panel-footer announcement-bottom">
                                  
                              </div>
                            </a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Latest Announcements</h3>
                  </div>
                  <div class="panel-body" id="news-panel">
                    <div class="list-group"><marquee direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" height="200">
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
            <div class="row">
            <div class="col-lg-10">
                 <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Repurchage List</h3>
                  </div>
                  <div class="panel-body" id="news-panel">
               <table id="table1" class="table table-bordered table-striped table-hover table-condensed table-responsive">
								<thead>
										<tr>
											<th>Sl.</th>
											<th>User ID</th>
											<th>BV</th>
											<th>Place</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
									  <?php if($data) { $i=1;
									  $per = $this->db->get_where('repurchage_users',['user_id'=>$this->logged['user_id']])->result_array(); 
									  	foreach ($per as $key => $value)
									  	{ ?>
									  		<tr class="<?=($value['status']==1)?"bg-success":"bg-danger";?>">
									  			<td><?=$i;?></td>
									  			<td><?=$value['user_id'];?></td>
									  			<td><?=$value['bv'];?></td>
									  			<td><?=$value['place'];?></td>
									  			<td><?=$this->dbm->dateFormat($value['date']);?> </td>
									  			
									  			
									  		</tr>
									  	<?php $i++; } } else { ?>
										<tr><td colspan="7">No Records Found.</td></tr>
										<?php } ?>
									</tbody>
								</table> 
								</div>
                
            </div>
            <hr>
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
$(window).on('load',function(){
  $.ajax({
    url:"<?=base_url('user/currentSelfDown');?>",
    type:'post',
    success:function(data)
    {
      $('#current').html(data);
    }
  });
});
  $(window).on('load',function(){
    $.ajax({
      url:"<?=base_url('user/countDown');?>",
      type:'post',
      dataType:'json',
      success:function(data)
      {
        $('#down').html(data['down']);
        $('#left').html(data['left']);
        $('#right').html(data['right']);
      }
    });
  });
</script>