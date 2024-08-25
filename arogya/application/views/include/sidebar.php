      <div class="left-sidebar" id="show-nav">
        <ul id="side" class="side-nav">
          <li class="panel">
            <a href="<?=base_url('auth');?>"> <i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li class="panel">
            <a href="<?=base_url('user/explore/my-profile');?>"> <i class="fa fa-user"></i> My Profile</a>
          </li>
    <?php if($this->logged['access']=='universal') { ?>
          <li class="panel">
            <a href="<?=base_url('auth/exploreData/company/company-management'); ?>"> <i class="fa fa-cogs"></i> Company Management</a>
          </li>
          <li class="panel">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#userModal" title="Get User Data"> Get User Data</a>
          </li>
            
          <li class="panel">
            <a id="panel3" href="javascript:;" data-toggle="collapse" data-target="#calendar"> <i class="fa fa-calendar"></i> Expense
              <span class="label label-danger">new</span> <i class="fa fa-chevron-left pull-right" id="arow3"></i> </a>
            <ul class="collapse nav" id="calendar">
              <li> <a href="<?=base_url('auth/exploreData/expense_category/expense-category'); ?>"><i class="fa fa-angle-double-right"></i> Expense Category</a> </li>
              <li> <a href="<?=base_url('auth/expenseManagement'); ?>"><i class="fa fa-angle-double-right"></i> Expense Entry</a> </li>
              <li> <a href="<?= base_url('auth/dailyReport/today'); ?>"><i class="fa fa-angle-double-right"></i> Expense Report</a> </li>
            </ul>
          </li>
         <!--  <li class="panel">
            <a id="panel4" href="javascript:;" data-toggle="collapse" data-target="#clipboard"> <i class="fa fa-bar-chart"></i> Plan Management
              <i class="fa fa fa-chevron-left pull-right" id="arow4"></i> </a>
            <ul class="collapse nav" id="clipboard">
              <li> <a href="<?=base_url('auth/exploreData1/level-management'); ?>"><i class="fa fa-angle-double-right"></i> Manage Levels </a> </li>
            </ul>
          </li> -->
          <!-- <li class="panel">
            <a href="<?=base_url('auth/exploreData/rewards/reward-management'); ?>"> <i class="fa fa-free-code-camp"></i>Rewards And Awards</a>
          </li> -->
           <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/self_upgrade/upgrade-users'); ?>">
              <i class="fa fa-ravelry" aria-hidden="true"></i> Upgrade Request</a>
          </li>
           <li class="panel">
            <a id="panel5" href="javascript:;" data-toggle="collapse" data-target="#edit"> <i class="fa fa-pinterest-p"></i> PIN Management
              <i class="fa fa fa-chevron-left pull-right" id="arow5"></i>
            </a>
            <ul class="collapse nav" id="edit">
              <li> <a href="<?=base_url('auth/getAllData/'.base64_encode('pin/generate_by/admin/pin-management')); ?>"><i class="fa fa-angle-double-right"></i> Generate PIN</a> </li>
              <li> <a href="<?=base_url('auth/pinHistory/admin'); ?>"><i class="fa fa-angle-double-right"></i> Admin Generated</a> </li>
              <li> <a href="<?=base_url('auth/pinHistory/self'); ?>"><i class="fa fa-angle-double-right"></i> Self Generated</a> </li>
            </ul>
          </li>

          <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/users/user-management'); ?>">
              <i class="fa fa-users"></i> User Management</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/users/payout-management'); ?>">
              <i class="fa fa-users"></i> Payout Management</a>
          </li>
           <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/club_users/rank-list'); ?>">
              <i class="fa fa-users"></i> L.O.B Management</a>
          </li>
           <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/monthly_users/monthly-list'); ?>">
              <i class="fa fa-users"></i> Travel Allowance</a>
          </li>

          <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/notice/notice-management'); ?>">
              <i class="fa fa-list"></i> Notice Management</a>
          </li>

          <li class="panel">
            <a id="panel7" href="javascript:;" data-toggle="collapse" data-target="#cogs"> <i class="fa fa-inr"></i> Withdrawal Requests
              <i class="fa fa fa-chevron-left pull-right" id="arow7"></i> </a>
            <ul class="collapse nav" id="cogs">
              <li> <a href="<?=base_url('auth/withdrawRequest/paid'); ?>"><i class="fa fa-angle-double-right"></i> Paid</a> </li>
              <li> <a href="<?=base_url('auth/withdrawRequest/unpaid'); ?>"><i class="fa fa-angle-double-right"></i> Unpaid</a> </li>
            </ul>
          </li>

         

          <li class="panel">
            <a id="" href="<?=base_url('auth/paymentHistory'); ?>">
              <i class="fa fa-history"></i> Payout History</a>
          </li>

          <li class="panel">
            <a id="panel6" href="javascript:;" data-toggle="collapse" data-target="#inbox"> <i class="fa fa-inbox"></i> Inbox
               <i class="fa fa fa-chevron-left pull-right" id="arow6"></i> </a>
            <ul class="collapse nav" id="inbox">
              <li> <a href="<?=base_url('auth/quickReply/get'); ?>"><i class="fa fa-angle-double-right"></i> User Queries</a> </li>
            </ul>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('auth/explore/add-supplier');?>">
              <i class="fa fa-hand-o-right"></i>Add Supplier</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('auth/explore/add-category');?>">
              <i class="fa fa-hand-o-right"></i> Product Category</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('auth/explore/add-product');?>">
              <i class="fa fa-hand-o-right"></i>Add Product</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('auth/explore/parchase-product');?>">
              <i class="fa fa-hand-o-right"></i>Parchase Product</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/product_parchase/parchase-details');?>">
              <i class="fa fa-history"></i>Parchase History</a>
          </li>

          <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/booking/booking-details');?>">
              <i class="fa fa-history"></i>Booking History</a>
          </li>

          <li class="panel">
            <a id="" href="<?=base_url('auth/exploreData/booking_panding/panding-booking-details');?>">
              <i class="fa fa-history"></i>Panding Bookings  <span class="label label-danger"><?= $this->db->get('booking_panding')->num_rows(); ?></span></a>
          </li>
          <!-- <li class="panel">-->
          <!--  <a id="" href="<?=base_url('auth/exploreData/booking_panding/cancel-booking-detail');?>">-->
          <!--    <i class="fa fa-history"></i>Panding Bookings  <span class="label label-danger"><?= $this->db->get('booking_panding')->num_rows(); ?></span></a>-->
          <!--</li>-->

          <li class="panel">
            <a id="" href="<?= base_url('auth/purchaseHistory/today'); ?>">
              <i class="fa fa-history"></i>Asociate Purchase History</a>
          </li>

          <li class="panel">
            <a id="" href="<?= base_url('auth/salesHistory/today'); ?>">
              <i class="fa fa-history"></i>All Sales History</a>
          </li>
          <!--<li class="panel">-->
          <!--  <a id="" href="<?=base_url('auth/exploreData/tds/tds-details');?>">-->
          <!--    <i class="fa fa-history"></i>TDS Histry</a>-->
          <!--</li>-->

    <?php } else { ?>
          <li class="panel">
            <a id="" href="<?=base_url('user/statics/'.base64_encode('directAll/1/My Referrals'));?>">
              <i class="fa fa-line-chart"></i> My Referrals </a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('user/lvlstatics');?>">
              <i class="fa fa-snowflake-o"></i> Level Statics </a>
          </li>
          
           <li class="panel">
            <a id="" href="<?=base_url('user/getAllData/'.base64_encode('base_plan/type/self/upgrate-self'));?>">
              <i class="fa fa-line-chart"></i>Self Upgrade </a>
          </li>
          <li class="panel">
            <a id="panel8" href="javascript:;" data-toggle="collapse" data-target="#paper"> <i class="fa fa-paper-plane"></i> PIN Management
              <i class="fa fa fa-chevron-left pull-right" id="arow8"></i> </a>
            <ul class="collapse nav" id="paper">
              <li> <a href="<?=base_url('user/authenticate/'.base64_encode('generate-pin')); ?>"><i class="fa fa-angle-double-right"></i> PIN Generate</a> </li>
              <li> <a href="<?=base_url('user/getAllData/'.base64_encode('pin_request/user_id/'.$this->logged['user_id'].'/receive-pin')); ?>"><i class="fa fa-angle-double-right"></i> Receive PIN </a> </li>
              <li> <a href="<?=base_url('user/getAllData/'.base64_encode('pin_request/user_id/'.$this->logged['user_id'].'/transfer-pin')); ?>"><i class="fa fa-angle-double-right"></i> Transfer PIN </a> </li>
            </ul>
          </li> 
          <li class="panel">
            <a id="" href="<?=base_url('user/getAllData/'.base64_encode('withdraw/user_id/'.$this->logged['user_id'].'/fund-withdraw')); ?>">
              <i class="fa fa-inr"></i> Withdraw Amount</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('user/paymentHistory');?>" >
              <i class="fa fa-history"></i> Payment History</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('user/query/get'); ?>">
              <i class="fa fa-comments"></i> Contact Admin</a>
          </li>
          <li class="panel">
            <a id="panel9" href="javascript:;" data-toggle="collapse" data-target="#trash"> <i class="fa fa-cart-arrow-down"></i> Products
              <i class="fa fa fa-chevron-left pull-right" id="arow9"></i>
            </a>
            <ul class="collapse nav" id="trash">
              <?php $pro = $this->dbm->globalSelect('product_category'); 
                    foreach ($pro as $key => $value) {
                     ?>
                    <li> <a href="<?=base_url('user/getAllData/'.base64_encode('product/cat_id/'.$value['id'].'/products')); ?>"><i class="fa fa-angle-double-right"></i> <?= $value['name'] ?></a> </li>
                   <?php   }    ?>
            </ul>
          </li>
     <li class="panel">
         <a id="" href="<?=base_url('user/Team_management'); ?>">
            <i class="fa fa-upload"></i> L.O.B Management</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('user/bookingHistory');?>" >
              <i class="fa fa-history"></i>Booking History</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('user/pandingBookings');?>" >
              <i class="fa fa-history"></i>Panding Bookings <span class="label label-danger"><?= $this->db->get_where('booking_panding',['user_id'=>$this->logged['user_id']])->num_rows(); ?></span></a>
          </li>

    <?php } ?>
          <!-- <li class="panel">
            <a id="panel7" href="javascript:;" data-toggle="collapse" data-target="#cogs"> <i class="fa fa-cogs"></i> cogs
              <span class="label label-warning">Warning</span> <i class="fa fa fa-chevron-left pull-right" id="arow7"></i> </a>
            <ul class="collapse nav" id="cogs">
              <li> <a href="#"><i class="fa fa-angle-double-right"></i> Flot Charts</a> </li>
              <li> <a href="#"><i class="fa fa-angle-double-right"></i> Morris.js</a> </li>
            </ul>
          </li>
           -->
          <!--<li class="panel">-->
          <!--  <a id="" href="<?=base_url('stable/treeView/'.base64_encode($this->logged['user_id']));?>">-->
          <!--    <i class="fa fa-sitemap"></i> Genealogy</a>-->
          <!--</li>-->
          <!-- <li class="panel">-->
          <!--  <a id="" href="<?=base_url('stable/treeView1/'.base64_encode($this->logged['user_id']));?>">-->
          <!--    <i class="fa fa-sitemap"></i> Genealogy1</a>-->
          <!--</li>-->
          <!--  <li class="panel">-->
          <!--  <a id="" href="<?=base_url('stable1/explore/down-tree');?>">-->
          <!--    <i class="fa fa-sitemap"></i> Genealogy New</a>-->
          <!--</li>-->
           <li class="panel">
            <a id="" href="<?=base_url('stable1/explore/down-tree1');?>">
              <i class="fa fa-sitemap"></i> Genealogy </a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('login/changePassword');?>">
              <i class="fa fa-user-secret"></i> Change Password</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('stable/logout');?>" >
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
            <?=form_open('auth/userData'); ?>
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