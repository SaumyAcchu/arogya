<!DOCTYPE html>
<html>
<head>
  <title>Beg Builders | Password Confirmation</title>
  <?php include('includes/header.php'); ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});
</script>
</head>
<body class="home">
    <div class="container-fluid display-table">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
            <?php $page='home'; ?>
            <?php include('includes/sidebar.php'); ?> 
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php include('includes/topbar.php'); ?> 
          <!-- All Content Start here -->
          <div class="user-dashboard">
            <center><h4 style="color: red;">This action needed Password Confirmation.</h4></center>
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
            <div class="col-lg-6 col-lg-offset-3">
              <div class="well well-sm">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h5>Please Confirm Your Password</h5>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <label>Enter Your Password</label>
                      <input type="password" placeholder="Password" name="password" value="" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="pull-right btn-info btn">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>       
          
          <!-- All Content End here -->
          </div>
        </div>
      </div>
    </div>
</body>
<?php include('includes/footer.php'); ?>