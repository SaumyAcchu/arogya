      <div class="left-sidebar" id="show-nav">
        <ul id="side" class="side-nav">
          <li class="panel">
            <a href="<?=base_url('real1');?>"> <i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <!-- <li class="panel">
            <a href="<?=base_url('user/explore/my-profile');?>"> <i class="fa fa-user"></i> My Profile</a>
          </li> -->
    <?php if($this->logged['access_level']=='universal') { ?>
          <li class="panel">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#userModal" title="Get User Data"><i class="fa fa-user"></i> Get User Data</a>
          </li>

          <li class="panel">
             <a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" title="Get User Data"><i class="fa fa-users" aria-hidden="true"></i><span class="">Quick Login</span></a>
          </li>

          <li class="panel">
            <a id="panel1" href="javascript:;" data-toggle="collapse" data-target="#basic"> <i class="fa fa-users"></i> Basic Management
              <i class="fa fa fa-chevron-left pull-right" id="arow1"></i> </a>
            <ul class="collapse nav" id="basic">
              <li class="panel">
                  <a href="<?=base_url('control/exploreData/company/company-management'); ?>"> <i class="fa fa-cogs"></i> Company Management</a>
              </li>
              <li class="panel">
                <a id="" href="<?=base_url('control/exploreData/notice/notice-management'); ?>">
                  <i class="fa fa-map-signs"></i>Notice Management</a>
              </li>
               <li> <a href="<?=base_url('control/quickReply/get'); ?>"><i class="fa fa-weixin"></i> User Queries</a> </li>
               <li class="panel">
                 <a id="" href="<?=base_url('login/changePassword');?>">
                   <i class="fa fa-user-secret"></i> Change Password</a>
               </li>
              
            </ul>
          </li>


          <li class="panel">
            <a id="panel2" href="javascript:;" data-toggle="collapse" data-target="#land"> <i class="fa fa-globe"></i> Land Management
              <i class="fa fa fa-chevron-left pull-right" id="arow2"></i>
            </a>
            <ul class="collapse nav" id="land">
              <li> <a href="<?=base_url('real1/landMgmt/opn'); ?>"><i class="fa fa-angle-double-right"></i> Add Land</a> </li>
              <li> <a href="<?=base_url('control/exploreData/land/land_mgmt'); ?>"><i class="fa fa-angle-double-right"></i>View Land</a> </li>
            </ul>
          </li>          
          



          <li class="panel">
            <a id="panel5" href="javascript:;" data-toggle="collapse" data-target="#property"> <i class="fa fa-building"></i> Property Management
              <i class="fa fa fa-chevron-left pull-right" id="arow5"></i>
            </a>
            <ul class="collapse nav" id="property">
              <li> <a href="<?=base_url('real1/explore/add-site'); ?>"><i class="fa fa-angle-double-right"></i> Add Project</a> </li>
              <li> <a href="<?=base_url('real1/buildingMgmt/opn');?>"><i class="fa fa-angle-double-right"></i> Add Site</a> </li>
              <li> <a href="<?=base_url('real1/flatMgmt/sel'); ?>"><i class="fa fa-angle-double-right"></i>Add Property</a> </li>
              <li> <a href="<?=base_url('control/exploreData/project/flat_mgmt'); ?>"><i class="fa fa-angle-double-right"></i>View Property</a> </li>
              <li> <a href="<?=base_url('control/exploreData/project/flat_mgmt'); ?>"><i class="fa fa-angle-double-right"></i>Plot Booking</a> </li>
              <li> <a href="<?=base_url('real1/exploreData/flat/plot-management'); ?>"><i class="fa fa-angle-double-right"></i>Plot Remove</a> </li>
            </ul>
          </li>
          <li class="panel">
            <a id="panel7" href="javascript:;" data-toggle="collapse" data-target="#associate"> <i class="fa fa-users"></i> Associate Management
              <i class="fa fa fa-chevron-left pull-right" id="arow7"></i> </a>
            <ul class="collapse nav" id="associate">
              <li> <a href="<?=base_url('control/explore/user-registration '); ?>"><i class="fa fa-angle-double-right"></i> Add Associate</a> </li>
              <li> <a href="<?=base_url('real1/exploreData/users/associate-management'); ?>"><i class="fa fa-angle-double-right"></i> Associate List</a> </li>
            </ul>
          </li>

          <li class="panel">
            <a id="panel3" href="javascript:;" data-toggle="collapse" data-target="#calendar"> <i class="fa fa-calendar"></i> Expense
             <i class="fa fa fa-chevron-left pull-right" id="arow3"></i> </a>
            <ul class="collapse nav" id="calendar">
              <li> <a href="<?=base_url('real1/exploreData/expense_category/expense-category'); ?>"><i class="fa fa-angle-double-right"></i> Expense Category</a> </li>
              <li> <a href="<?=base_url('real1/expenseManagement'); ?>"><i class="fa fa-angle-double-right"></i> Expense Entry</a> </li>
              <li> <a href="<?= base_url('real1/dailyReport/today'); ?>"><i class="fa fa-angle-double-right"></i> Expense Report</a> </li>
            </ul>
          </li>
          <li class="panel">
            <a id="panel4" href="javascript:;" data-toggle="collapse" data-target="#clipboard"> <i class="fa fa-bar-chart"></i> Commission Management
              <i class="fa fa fa-chevron-left pull-right" id="arow4"></i> </a>
            <ul class="collapse nav" id="clipboard">
              <li> <a href="<?=base_url('control/exploreData/level/level-management'); ?>"><i class="fa fa-angle-double-right"></i> Asociate Commission </a> </li>
            </ul>
          </li>
          
          <li class="panel">
            <a id="panel8" href="javascript:;" data-toggle="collapse" data-target="#users"> <i class="fa fa-users"></i> Customer Management
              <i class="fa fa fa-chevron-left pull-right" id="arow8"></i> </a>
            <ul class="collapse nav" id="users">              
              <li> <a href="<?=base_url('real1/exploreData/flat_registration/user-management'); ?>"><i class="fa fa-angle-double-right"></i> Customer List</a> </li>
            </ul>
          </li>
          <!-- <li class="panel">
            <a id="panel7" href="javascript:;" data-toggle="collapse" data-target="#search"> <i class="fa fa-search"></i> Search
              <i class="fa fa fa-chevron-left pull-right" id="arow7"></i> </a>
            <ul class="collapse nav" id="search">
              <li> <a href="<?=base_url('real1/explore/search_by_cheque'); ?>"><i class="fa fa-angle-double-right"></i> Search By Cheque</a> </li>
              <li> <a href="<?=base_url('real1/exploreData/project/search-flat'); ?>"><i class="fa fa-angle-double-right"></i> Search Plot</a> </li>
            </ul>
          </li> -->
          <li class="panel">
            <a id="" href="<?=base_url('real1/payInstallment'); ?>">
              <i class="fa fa-money"></i> Pay Installment</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('control/explore/commission-status'); ?>">
              <i class="fa fa-cc-mastercard"></i>Commission Status</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('control/explore/commission'); ?>">
              <i class="fa fa-inr"></i>Commission</a>
          </li> 
          <li class="panel">
            <a id="" href="<?=base_url('real1/exploreData/project/payment_report'); ?>">
              <i class="fa fa-line-chart"></i>Business Report</a>
          </li> 
          <li class="panel">
            <a id="" href="<?=base_url('real1/exploreData/project/select-project-for-report'); ?>">
              <i class="fa fa-list-alt"></i>Project Report</a>
          </li>
           
         
          
    <?php } else { ?>

          <li class="panel">
            <a href="<?=base_url('user/getAllData/'.base64_encode('flat_registration/introducer/'.$this->logged['user_id'].'/direct-customers'));?>"> <i class="fa fa-user"></i> My Customers</a>
          </li>

          <li class="panel">
            <a id="" href="<?=base_url('user/getAllData/'.base64_encode('users/sponcer_id/'.$this->logged['user_id'].'/direct-joins'));?>">
              <i class="fa fa-snowflake-o"></i>Down List </a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('user/downTree/');?>">
              <i class="fa fa-sitemap"></i> Genealogy </a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('user/getAllData/'.base64_encode('commission_new/agent_id/'.$this->logged['user_id'].'/commission-status'));?>">
              <i class="fa fa-inr"></i>Commission Status</a>
          </li>
           <li class="panel">
            <a id="" href="<?=base_url('user/explore/my-profile'); ?>">
              <i class="fa fa-user-circle-o"></i>My Profile</a>
          </li>
           <li class="panel">
            <a id="" href="<?=base_url('user/query/get'); ?>">
              <i class="fa fa-envelope"></i>Contact Admin</a>
          </li>
         
         
    <?php } ?>
         
          <!-- <li class="panel">
            <a id="" href="<?=base_url('stable/treeView/'.base64_encode($this->logged['user_id']));?>">
              <i class="fa fa-sitemap"></i> Tree View</a>
          </li> -->
          
          <li class="panel">
            <a id="" href="<?=base_url('login/logout'); ?>" >
              <i class="fa fa-sign-out"></i> Signout</a>
          </li>
        </ul>
      </div>
      <script type="text/javascript">
    $(document).ready(function() {
      $("#panel1").click(function() {
        $("#arow1").toggleClass("fa-chevron-left");
        $("#arow1").toggleClass("fa-chevron-down");
      });
        
      $("#panel2").click(function() {
        $("#arow2").toggleClass("fa-chevron-left");
        $("#arow2").toggleClass("fa-chevron-down");
      });
        
      $("#panel3").click(function() {
        $("#arow3").toggleClass("fa-chevron-left");
        $("#arow3").toggleClass("fa-chevron-down");
      });
        
      $("#panel4").click(function() {
        $("#arow4").toggleClass("fa-chevron-left");
          $("#arow4").toggleClass("fa-chevron-down");
      });
        
      $("#panel5").click(function() {
        $("#arow5").toggleClass("fa-chevron-left");
        $("#arow5").toggleClass("fa-chevron-down");
      });
        
      $("#panel6").click(function() {
        $("#arow6").toggleClass("fa-chevron-left");
        $("#arow6").toggleClass("fa-chevron-down");
      });
        
      $("#panel7").click(function() {
        $("#arow7").toggleClass("fa-chevron-left");
        $("#arow7").toggleClass("fa-chevron-down");
      });
        
      $("#panel8").click(function() {
        $("#arow8").toggleClass("fa-chevron-left");
        $("#arow8").toggleClass("fa-chevron-down");
      });
        
      $("#panel9").click(function() {
        $("#arow9").toggleClass("fa-chevron-left");
        $("#arow9").toggleClass("fa-chevron-down");
      });
        
      $("#panel10").click(function() {
        $("#arow10").toggleClass("fa-chevron-left");
        $("#arow10").toggleClass("fa-chevron-down");
      });
        
      $("#panel11").click(function() {
        $("#arow11").toggleClass("fa-chevron-left");
        $("#arow11").toggleClass("fa-chevron-down");
      });
        
      $("#menu-icon").click(function() {
        $("#chang-menu-icon").toggleClass("fa-bars");
        $("#chang-menu-icon").toggleClass("fa-times");
        $("#show-nav").toggleClass("hide-sidebar");
        $("#show-nav").toggleClass("left-sidebar");
          
        $("#left-container").toggleClass("less-width");
        $("#right-container").toggleClass("full-width");
      });

      
      // $(document).ready(function() {
      // $("#menu-icon").click();
      // });
        
     
        
    });
  </script>





 <div class="modal fade" id="userModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Enter User ID</h5>
                <button type="button" class="close txtred" data-dismiss="modal" aria-label="Close" style="margin-top:-21px;">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?=form_open('control/userData'); ?>
            <div class="modal-body">
                <input type="text" placeholder="User Id..." name="user_id" class="form-control txtupper" required="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Get Detail</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="loginModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please Enter User ID For Quick Login</h5>
        <button type="button" class="close txtred" data-dismiss="modal" aria-label="Close" style="margin-top:-21px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open('control/quickLogin'); ?>
      <div class="modal-body">
        <input type="text" placeholder="User Id for Login..." name="user_id" class="form-control txtupper" required="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>