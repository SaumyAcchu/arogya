      <div class="left-sidebar" id="show-nav">
        <ul id="side" class="side-nav">
          <li class="panel">
            <a href="<?=base_url('land');?>"> <i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li class="panel">
            <a href="<?=base_url('land/profile');?>"> <i class="fa fa-user"></i> My Profile</a>
          </li>

          <li class="panel">
            <a href="<?=base_url('land/installmentStatus');?>"> <i class="fa fa-money"></i> Installment Status</a>
          </li>
          <!-- <li class="panel">
            <a href="<?=base_url('land/customerInformation');?>"> <i class="fa fa-cc-mastercard"></i> Payment History</a>
          </li> -->
    
          <!-- <li class="panel">
            <a id="" href="<?=base_url('stable/treeView/'.base64_encode($this->logged['user_id']));?>">
              <i class="fa fa-sitemap"></i> Tree View</a>
          </li> -->
          <li class="panel">
            <a id="" href="<?=base_url('land/changePassword');?>">
              <i class="fa fa-user-secret"></i> Change Password</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('login/logoutLand'); ?>" >
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