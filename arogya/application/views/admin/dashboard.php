<!DOCTYPE html>
<head>
  <title>Real Estate | Dashboard</title>
  <?php $this->load->view('includes/header'); ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
  <script type="text/javascript">
  $(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});

  
</script>
<style type="text/css">

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
.circle-tile-heading  :hover{
    -webkit-transform: scale(1.1);
        -ms-transform: scale(1.1);
        transform: scale(1.1);
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
    background-color: #138F77;
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
    background-color: #7F3D9B;
}
.tile-img {
    text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
}

.dark-blue {
    background-color: #34495E;
}
.green {
    background-color: #16A085;
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
    background-color: #8E44AD;
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

   

</style>
</head>
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
          <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation" style="height: 100vh;">
            <?php $page='home'; 
            $logged=$this->session->userdata('loggedUser'); ?>
            <?php $this->load->view('includes/sidebar'); ?> 
          </div>
          <div class="col-md-10 col-sm-11 display-table-cell v-align backbg">
            <?php include('includes/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="user-dashboard">
            <div class="row well" style="padding-top: 40px;">
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
                  <!-- Add this css in head tag -->
 

                <div class="row">
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="circle-tile ">
                          <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-building-o fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content dark-blue">
                            <div class="circle-tile-description text-faded"> Projects</div>
                            <?php $proNum=$this->db->get('project')->num_rows(); ?>
                            <div class="circle-tile-number text-faded "><?=$proNum;?></div>
                            <a class="circle-tile-footer" href="<?=base_url('real1/buildingMgmt/opn');?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                        </div>
                      </div>
                     
                      <div class="col-sm-6">
                        <div class="circle-tile ">
                          <a href="#"><div class="circle-tile-heading red"><i class="fa fa-home fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content red">
                            <div class="circle-tile-description text-faded"> Flats </div>
                            <?php $flt=$this->db->get('flat')->num_rows(); ?>
                            <div class="circle-tile-number text-faded "><?=$flt;?></div>
                            <a class="circle-tile-footer" href="<?=base_url('real1/exploreData/project/select-project-for-report');?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="circle-tile ">
                          <a href="#"><div class="circle-tile-heading blue"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content blue">
                            <div class="circle-tile-description text-faded"> Alloted Flats </div>
                            <?php $reg=$this->db->get('flat_registration')->num_rows(); ?>
                            <div class="circle-tile-number text-faded "><?=$reg;?></div>
                            <a class="circle-tile-footer" href="<?=base_url('real1/exploreData/project/user-management');?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="circle-tile ">
                          <a href="#"><div class="circle-tile-heading green"><i class="fa fa-university fa-fw fa-3x"></i></div></a>
                          <div class="circle-tile-content green">
                            <div class="circle-tile-description text-faded"> Vacant Flats </div>
                            <?php $reg=$this->db->get('flat_registration')->num_rows(); ?>
                            <div class="circle-tile-number text-faded "><?=$flt-$reg;?></div>
                            <a class="circle-tile-footer" href="<?=base_url('real1/exploreData/project/user-management');?>">More Info <i class="fa fa-chevron-circle-right"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        Recent Flat Allotment
                      </div>
                      <div class="panel-body">
                        <table class="table table-fixed">
                          <thead>
                            <tr>
                              <th>Project</th>
                              <th>Flat No.</th>
                              <th>Name</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $res=$this->db->select('*')->LIMIT(6)->get('flat_registration')->result_array(); $i=1;
                          if($res) { foreach ($res as $key => $value)
                          { ?>
                            <tr>
                              <td>
                                <?php $pro=$this->db->get_where('project',['id'=>$value['building_id']])->row_array();
                                echo $pro['name']; ?>
                              </td>
                              <td>
                                <?php $flat=$this->db->get_where('flat',['id'=>$value['flat_id']])->row_array();
                                echo $flat['flat_num']; ?>
                              </td>
                              <td><?=$value['name']; ?></td>
                              <td><a href="<?=base_url('real1/flats/get-flat-information/'.$pro['id'].'/'.$flat['id']);?>" class="btn btn-info btn-sm">Check</a></td>
                            </tr>
                          <?php $i++; } } else { echo '<tr><th colspan="4">No Records Found.</th><tr>'; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div> 
                </div> 
                <!-- <div class="row">
                  <div class="col-lg-4">
                    <div class="panel panel-success">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-xs-4">
                            <i class="fa fa-search fa-5x"></i>
                          </div>
                          <div class="col-xs-8 text-right">
                            <p class="announcement-heading"></p>
                              <h4 style="color: navy;">Search</h4>
                              <p>By Cheque Number</p>
                          </div>
                        </div>
                      </div>
                      <a href="<?=base_url('real1/explore/search_by_cheque'); ?>">
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
                  <div class="col-lg-4">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-xs-4">
                            <i class="fa fa-cogs fa-5x"></i>
                          </div>
                          <div class="col-xs-8 text-right">
                            <p class="announcement-heading"></p>
                              <h4 style="color: navy;">Flat Management</h4>
                              <p>Click to Manage</p>
                          </div>
                        </div>
                      </div>
                      <a href="<?=base_url('real1/exploreData/project/flat_mgmt'); ?>">
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
                  <div class="col-lg-4">
                    <div class="panel panel-warning">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-xs-4">
                            <i class="fa fa-search fa-5x"></i>
                          </div>
                          <div class="col-xs-8 text-right">
                            <p class="announcement-heading"></p>
                              <h4 style="color: navy;">Search Flat</h4>
                              <p>Click to Open</p>
                          </div>
                        </div>
                      </div>
                      <a href="<?=base_url('real1/exploreData/project/search-flat'); ?>">
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
                <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-xs-4">
                            <i class="fa fa-list fa-5x"></i>
                          </div>
                          <div class="col-xs-8 text-right">
                            <p class="announcement-heading"></p>
                              <h4 style="color: navy;">Project Management</h4>
                              <p>Click to open</p>
                          </div>
                        </div>
                      </div>
                      <a href="<?=base_url('real1/buildingMgmt/opn'); ?>">
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
                  <div class="col-lg-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-xs-4">
                            <i class="fa fa-plus fa-5x"></i>
                          </div>
                          <div class="col-xs-8 text-right">
                            <p class="announcement-heading"></p>
                              <h4 style="color: navy;">Add New Flat</h4>
                              <p>Click to Add</p>
                          </div>
                        </div>
                      </div>
                      <a href="<?=base_url('real1/flatMgmt/sel'); ?>">
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
                  <div class="col-lg-4">
                    <div class="panel panel-danger">
                      <div class="panel-heading">
                        <div class="row">
                          <div class="col-xs-4">
                            <i class="fa fa-trash fa-5x"></i>
                          </div>
                          <div class="col-xs-8 text-right">
                            <p class="announcement-heading"></p>
                              <h4 style="color: navy;">Logout</h4>
                              <p>Click to Exit</p>
                          </div>
                        </div>
                      </div>
                      <a href="<?=base_url('login/logout'); ?>">
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
                </div> -->
              </div>  
          </div>
          <!-- All Content End here -->
      </div>
    </div>
</body>
<?php include('includes/footer.php'); ?>
<script type="text/javascript">
   $('.statistic-counter_two, .statistic-counter, .count-number').counterUp({
                delay: 100,
                time: 20000
            });
</script>
