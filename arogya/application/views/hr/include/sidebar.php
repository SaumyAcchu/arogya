      <div class="left-sidebar" id="show-nav">
        <ul id="side" class="side-nav">
          <li class="panel">
            <a href="<?=base_url('hr');?>"> <i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
         <!--  <li class="panel">
            <a href="<?=base_url('hr/profile');?>"> <i class="fa fa-user"></i> My Profile</a>
          </li> -->
          <li class="panel">
            <a href="<?=base_url('hr/explore/department_management');?>"> <i class="fa fa-user"></i> Add Departments</a>
          </li>

          <li class="panel">
            <a href="<?=base_url('hr/explore/employee-registration');?>"> <i class="fa fa-registered"></i> Employee Registration</a>
          </li>

          <li class="panel">
            <a href="<?=base_url('hr/exploreData/employee/employee-management');?>"> <i class="fa fa-empire"></i> Employee Management</a>
          </li>

          <li class="panel">
            <a href="<?=base_url('hr/salaryDetails');?>"> <i class="fa fa-cc-mastercard"></i> Salary Details</a>
          </li>

          <li class="panel">
            <a href="<?=base_url('hr/paySalary');?>"> <i class="fa fa-cc-mastercard"></i>Pay Salary</a>
          </li>

           <li class="panel">
            <a id="panel3" href="javascript:;" data-toggle="collapse" data-target="#calendar"> <i class="fa fa-calendar"></i> Attendance
              <i class="fa fa-chevron-left pull-right" id="arow3"></i> </a>
            <ul class="collapse nav" id="calendar">
              <li> <a href="<?=base_url('hr/attendance'); ?>"><i class="fa fa-angle-double-right"></i> Employee Attendance</a> </li>
              <li> <a href="<?=base_url('hr/chkAttendance'); ?>"><i class="fa fa-angle-double-right"></i> Chek Attendance</a> </li>
             
            </ul>
          </li>

          <li class="panel">
            <a id="" href="<?=base_url('hr/changePassword');?>">
              <i class="fa fa-user-secret"></i> Change Password</a>
          </li>
          <li class="panel">
            <a id="" href="<?=base_url('login/logoutEmp'); ?>" >
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