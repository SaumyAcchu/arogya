<nav class="navbar navbar-inverse top-bar navbar-fixed-top" style="background-color: #FE0000;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> <span class="menu-icon" id="menu-icon"><i class="fa fa-times" aria-hidden="true" id="chang-menu-icon"></i></span>
        <a id="navLogo" class="navbar-brand" href="#" style="font-size:12px;"><!-- <img src="" width="90%"> --> <?=$this->siteInfo['name']; ?> </a>
      </div>
      <div class="collapse navbar-collapse navbar-right" id="myNavbar">
        <!-- <form class="navbar-form navbar-left">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i> </button>
            </div>
          </div>
        </form> -->
        <ul class="nav navbar-nav">
          <!-- <li class=""><a href="#"><i class="fa fa-refresh"></i> Start Tour</a> </li>
          <li class=""><a href="#"><i class="fa fa-volume-up"></i></a> </li>
          <li class=""><a href="#"><i class="fa fa-envelope"></i> <span class="badge">5</span></a> </li>
          <li class=""><a href="#"><i class="fa fa-bell"></i> <span class="badge">9</span></a> </li> -->
          <li class="">
            <a href="#" class="user-profile"> <span class=""><img class="img-responsive" src="<?=base_url('uploads/'.$this->logged['image']);?>"></span> </a>
          </li>
          <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$this->logged['name'];?>          
           <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="txtcenter"><?=$this->logged['user_id'];?></li>
             <!--  <li class="txtcenter"> <a href="<?=base_url('user/explore/my-profile');?>"><i class="fa fa-user"></i> Profile</a> </li> -->
              <li class="txtcenter"> <a href="<?=base_url('login/logout');?>"><i class="fa fa-power-off"></i> Logout</a> </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>