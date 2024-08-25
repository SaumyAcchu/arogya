<!DOCTYPE html>
<html>
<head>
    <title>Login | <?=$this->siteInfo['name'];?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
  <link href="<?=base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <link href="<?=base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-datepicker.css'); ?>"> 
  <link href="<?=base_url('assets/css/flexslider.css" rel="stylesheet'); ?>">
  <link href="<?=base_url('assets/css/templatemo-style.css'); ?>" rel="stylesheet">
  <link href="<?=base_url('assets/css/mystyle.css" rel="stylesheet'); ?>">
  <link href="<?=base_url('assets/css/dashboardstyle.css" rel="stylesheet'); ?>">
  <link rel="icon" href="<?=base_url('uploads/'.$this->siteInfo['image']); ?>" type="image/gif" sizes="16x16">
  <script type="text/javascript" src="<?=base_url('assets/js/jquery-1.11.2.min.js'); ?>"></script>              <!-- jQuery -->
    <script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js'); ?>"></script>            

    <style type="text/css">
        /*
 * Specific styles of signin component
 */
/*
 * General styles
 */
body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
}

.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 150px;
    height: 140px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
#logoImage
{
    height: 150px;

}
</style>
</head>
<body>
    <!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <center><img id="logoImage" class="" src="<?=base_url('uploads/'.$this->siteInfo['image']); ?>" /></center>
            <center><h4 class="txtblue"><?=$this->siteInfo['name'];?></h4></center>
             <!--///////////////////////Flash Message///////////////////////// -->
              <?php if($alert=$this->session->flashdata('msg')): 
              $class=$this->session->flashdata('msg_class');
              ?>
              <div class="row">
              <div class="col-sm-12">
                <div class="alert alert-dismissible <?= $class; ?>">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong><?php echo $alert; ?>.</strong>
                </div>
              </div>
              </div>
              <?php endif; ?>
              <!--///////////////////////Flash Message End///////////////////////// -->
            <b id="profile-name" class="profile-name-card"></b>
            <?=form_open('login/authenticate',['class'=>'form-signin']); ?>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" name="username" class="form-control txtupper" placeholder=" User ID" required autofocus>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder=" Password" required>
                <!-- <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div> -->
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <!-- <a href="#" class="forgot-password">
                Forgot password?
            </a> -->
            <!-- <b style="float: right; color: red;">New User:- <a href="<?=base_url('welcome/registration/open'); ?>" class="forgot-password" style="color: blue;">
                Register
            </a></b><br><br>
            <b style="color: green;">To active your a/c Please:- </b><a href="<?=base_url('welcome/paymentRequest/open'); ?>"><button class="btn btn-sm btn-info">Payment</button>
            </a> -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>