<!DOCTYPE html>
<html>
<head>
  <title>Please Login | <?=$this->siteInfo['name']; ?></title>
  <?php $this->load->view('include/header.php'); ?>
  <link href="https://fonts.googleapis.com/css?family=Oswald|Play" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-4">
        <div class="form-signin mg-btm">
        <h3 class="heading-desc">Land Owner Login to Continue...</h3>
        <div class="social-box">
            <div class="row mg-btm">
             <div class="col-md-12">
                <center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" class="img-thumbnail logo-img"></center>
            </div>
            </div>
            <h4 class="text-center">Welcome to <?=$this->siteInfo['name'];?></h4>
        </div>
        <?=form_open('login/landOwnerLogin'); ?>
        <div class="main">
          <!-- ///Flash Message Start/// -->
      <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
        <div class="row"><div class="col-sm-12"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
        <?php endif; ?>
      <!-- ///Flash Message End/// -->
        <div class="form-group">
                                  
                        <div class="dropdown" >
  <button type="button"  class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style=" width: 100%;
    margin-left: 1px;">
  Land Owner Login
  </button>
  <div class="dropdown-menu" style="
    width: 100%;">
    <a class="dropdown-item" href="http://dashboard.prayasinfra.com/index.php/login" style="padding-left: 8px;
    font-weight: 600;    text-align: justify;">Admin Login</a><br>
    <a class="dropdown-item" href="http://dashboard.prayasinfra.com/index.php/login " style="padding-left: 8px;
    font-weight: 600;    text-align: justify;">Associate Login</a><br>
    <a class="dropdown-item" href="http://dashboard.prayasinfra.com/index.php/login/customer" style="padding-left: 8px;
    font-weight: 600;    text-align: justify;">Customer Login</a><br>
     <a class="dropdown-item" href="http://dashboard.prayasinfra.com/index.php/login/employee" style="padding-left: 8px;
    font-weight: 600;    text-align: justify;">Account Login</a><br>
    <a class="dropdown-item" href="http://dashboard.prayasinfra.com/index.php/login/employee" style="padding-left: 8px;
    font-weight: 600;    text-align: justify;">HR Login</a><br>
    <a class="dropdown-item" href="http://dashboard.prayasinfra.com/index.php/login/employee" style="padding-left: 8px;
    font-weight: 600;    text-align: justify;">Employee Login</a><br>
     <a class="dropdown-item" href="http://dashboard.prayasinfra.com/index.php/login/landOwner" style="padding-left: 8px;
    font-weight: 600;    text-align: justify;">Land Owner Login</a>
  </div>
</div>
                              </div>
        <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"> <i class="fa fa-user"></i> </span>
              <input type="text" name="registration_id" class="form-control txtupper" placeholder="Registration Id" aria-label="Registration Id" value="<?=set_value('user_id');?>" aria-describedby="basic-addon1" autofocus="" required="">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-keyboard-o"></i> </span>
              <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="">
            </div>
        </div>   
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Login </button>
            <!-- <span class="pull-right" style="line-height: 30px;">New User : <a href="<?=base_url('login/registrationpage');?>"> Register</a></span> -->
        </div>         
        <span class="clearfix"></span>  
        </div>
      </form>
        <div class="login-footer">
       <!--  <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="left-section">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#forgetModal">Forgot your password?</a>
                </div>
            </div>
        </div> -->
        
        </div>
      </form>
    </div>
</div>
      
        </div><!--container-->
</body>
</html>
<!-- Modal -->
<div class="modal fade" id="forgetModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Your Registered Mobile Number</h5>
        <button type="button" class="close txtred" data-dismiss="modal" aria-label="Close" style="margin-top:-21px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=form_open('login/forgetPassword',['id'=>'ff']); ?>
        <div class="form-group">
          <input type="text" placeholder="User ID" name="user_id" id="userId" class="form-control txtupper" required="">
      </div>
        <div class="form-group">
          <input type="number" placeholder="Mobile Number" name="mobile" id="mobile" class="form-control" required="">
          <span class="txtred" id="errMsg"></span>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="forgetPassword">Send OTP</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript">
  $('#forgetPassword').click(function(e){
    e.preventDefault();
    var num=$('#mobile').val();
    var id=$('#userId').val();
    $.ajax({
      url:"<?=base_url('login/checkForgetPassword');?>",
      type:'post',
      data:{mobile:num,user_id:id},
      success:function(data)
      {
        if(data==0)
        {
          $('#errMsg').html('User Id/Mobile Not Matched');
          e.preventDefault();
          return false;
        }else
        {
          $('#ff').submit();
          return true;
        }
        
      }
    });
  });
</script>
<style type="text/css">
.form-signin {
  max-width: 400px; 
  display:block;
  background-color: #f7f7f7;
  -moz-box-shadow: 0 0 3px 3px #888;
    -webkit-box-shadow: 0 0 3px 3px #888;
    box-shadow: 0 0 40px 3px #888;
  border-radius:2px;
}
.main{
    padding: 38px;
}
.social-box{
  margin: 0 auto;
  padding: 0px 20px 20px;
  border-bottom:1px #ccc solid;
}
.social-box a{
  font-weight:bold;
  font-size:18px;
  padding:8px;
}
.social-box a i{
  font-weight:bold;
  font-size:20px;
}
.heading-desc{
    font-size:20px;
    font-weight:bold;
    padding:10px 38px 0px 22px;
    
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}

.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: 0px;
  border-radius: 5px;
  
}
.form-signin input[type="password"] {
  margin-bottom: 0px;
  border-radius: 5px;
}
.login-footer{
    background:#f0f0f0;
    margin: 0 auto;
    border-top: 1px solid #dadada;
    padding:20px;
}
.login-footer .left-section a{
    font-weight:bold;
    color:#8a8a8a;
    line-height:19px;
}
.mg-btm{
    margin-bottom:20px;
}
body{
background-color: #b8f5ed;
background-image: url("http://176.32.230.21/pcrltd.com/wp-content/uploads/2013/05/homeslider1.jpg");
background-size: cover;
background-attachment: fixed;
}
.logo-img{
  max-height: 200px;
}
</style>