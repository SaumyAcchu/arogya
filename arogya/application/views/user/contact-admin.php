<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Contact Admin';?> | <?=$this->siteInfo['name'];?></title>
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
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
		        <?php $this->load->view('include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
		        <div class="row padding-top">
		          <div class="col-lg-6">
                <div class="panel panel-primary" style="margin-bottom: 0px;">
                  <div class="panel-heading">
                     <p class="panel-title">Have any query? : (Contact Administrator)</p>
                  </div>
                  <div class="panel-body well">
                    <?=form_open('user/query/send',['class'=>'form-horizontal']); ?>
                    <div class="form-group">
                      <label>User ID : </label>
                      <input type="text" name="user_id" class="form-control" value="<?=$this->logged['user_id'];?>" required readonly>
                      <?php date_default_timezone_set('Asia/Kolkata'); ?>
                      <input type="hidden" name="date" value="<?=date('Y-m-d');?>">
                      <input type="hidden" name="time" value="<?=date('H:i:s');?>">
                    </div>
                    <div class="form-group">
                      <label>Name : </label>
                      <input type="text" name="name" class="form-control" value="<?=$this->logged['name'];?>" required readonly>
                    </div>
                    <div class="form-group">
                      <label>Phone Number :</label>
                      <input type="number" name="mobile" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                      <label>Subject :</label>
                      <input type="text" name="subject" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                      <label>Message :</label>
                      <textarea name="message" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-8">
                        <button class="btn btn-warning btn-sm" id="back"> << Back </button>
                        <button id="updbtn" type="submit" class="btn btn-primary btn-sm"> Send >> </button>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="panel panel-primary" style="margin-bottom: 0px;">
                  <div class="panel-heading">
                    <p class="panel-title">Conversations</p>
                  </div>
                  <div class="panel-body">
                        <?php if(!empty($data)) { ?>
                      <div class="row" id="Conversations">
                        <div class="chat">   
                          <div class="chat-history">
                            <ul class="chat-ul">
                              <?php foreach($data as $msg) { ?>
                              <?php if($msg['user_id']!=$this->logged['user_id']) { ?>
                              <li>
                                <div class="message-data">
                                  <span class="message-data-name"><i class="fa fa-circle you"></i> <?=$msg['sender']; ?></span>
                                </div>
                                <div class="message you-message">
                                <?=$msg['message']; ?>
                                <br><i style="font-size: 12px;color: black;"><?=$this->dbm->dateFormat($msg['date']); ?> <?=$msg['time']; ?></i>
                                </div>
                              </li>
                              <li class="clearfix"></li>
                              <?php }else{ ?>
                              <li class="clearfix">
                                <div class="message-data align-right">
                                  <span class="message-data-name">You</span> <i class="fa fa-circle me"></i>
                                </div>
                                <div class="message me-message float-right"><?=$msg['message']; ?>
                                  <br><i style="font-size: 12px;color: black;"><?=$this->dbm->dateFormat($msg['date']); ?> <?=$msg['time']; ?></i>
                                </div>
                              </li>
                              <?php } } ?>
                            </ul>
                          </div> <!-- end chat-history -->
                        </div> <!-- end chat -->
                      </div>
                        <?php } else { ?>
                            <center><b style="color: red;">No Notifications Found</b></center><br><br>
                        <?php } ?>
                    </div>
                </div>
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

<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Lato:400,700);
*, *:before, *:after {
  box-sizing: border-box;
}
.chat .chat-history {
  padding: 30px 30px 20px;
  border-bottom: 2px solid white;
}
.chat .chat-history .message-data {
  margin-bottom: 15px;
}
.chat .chat-history .message-data-time {
  color: #a8aab1;
  padding-left: 6px;
}
.chat .chat-history .message {
  color: white;
  padding: 6px 16px;
  line-height: 26px;
  font-size: 16px;
  border-radius: 5px;
  margin-bottom: 30px;
  width: 90%;
  position: relative;
}
.chat .chat-history .message:after {
content: "";
    position: absolute;
    top: -15px;
    left: 20px;
    border-width: 0 15px 15px;
    border-style: solid;
    border-color: #CCDBDC transparent;
    display: block;
    width: 0;
}
.chat .chat-history .you-message {
  background: #CCDBDC;
  color:#003366;
}
.chat .chat-history .me-message {
  background: #E9724C;
}
.chat .chat-history .me-message:after {
  border-color: #E9724C transparent;
    right: 20px;
    top: -15px;
    left: auto;
    bottom:auto;
}
.chat .chat-message {
  padding: 30px;
}
.chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
  font-size: 16px;
  color: gray;
  cursor: pointer;
}

.chat-ul li{
    list-style-type: none;
}

.align-left {
  text-align: left;
}

.align-right {
  text-align: right;
}

.float-right {
  float: right;
}

.clearfix:after {
  visibility: hidden;
  display: block;
  font-size: 0;
  content: " ";
  clear: both;
  height: 0;
}
.you {
  color: #CCDBDC;
}

.me {
  color: #E9724C;
}

h1, h2, h3, h4, h5, h6 {
    font-family: "Raleway",sans-serif;
    color: #003366;
}

    #Conversations{
      float:left;
    overflow-y: auto;
    height: 466px;
    width: 100%;
    }
  table tr th{
    text-align: center;
  }
  table tr td{
    text-align: center;
  }
    </style>