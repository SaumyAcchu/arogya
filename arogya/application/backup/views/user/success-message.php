<!DOCTYPE html>
<html>
<head>
  <title><?=$this->siteInfo['name'];?></title>
  <?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
    <div class="container-fluid no-padding display-table">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 no-padding hidden-xs display-table-cell v-align box" id="navigation">
            <?php $this->load->view('includes/sidebar.php',['page'=>'pay-installment']); ?>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php $this->load->view('includes/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="container-fluid no-padding main-container">
            <div class="title txtcenter">
            <h4>Registration Successful</h4>
          </div>
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  <!-- ///=====================All Contents Start Here============= //-->
          <?php
          if(isset($joinLink)) { ?>
          <center><p class="txtblue"><?=$joinLink;?></p><br>
          <a href="<?=base_url();?>">Home</a></center>
          <?php }else { ?>
          <a href="#" id="printId" class="btn btn-primary pull-right" style="margin-bottom: 10px;"> Print <i class="fa fa-print"></i></a>
          <div id="myDiv">
          <table class="table table-bordered table-hover table-striped" border="1" cellpadding="5" width="100%">
            <tr rowspan="2">
                        <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="80" width="80"></center></th>
                        <th class="txtcenter" colspan="5">
                          <p style="margin-bottom: 2px;"><?=$this->siteInfo['name'];?></p>
                          <?=$this->siteInfo['address'];?><br>
                          <span>Associate Registration</span>
                        </th>
                      </tr>
            <tr>
              <td>Name</td><td><?=$data['name'];?></td>
              <td rowspan="4" colspan="2">
                <center><img src="<?=base_url('uploads/'.$data['image']);?>" height="120" width="120"></center>
              </td>
            </tr>
            <tr>
              <td>User ID</td><td><b><?=$data['user_id'];?></b></td>
            </tr>
            <tr>
              <td>Password</td><td><b>********<?php $data['password'];?></b></td>
            </tr>
            <tr>
              <td>Registration Date</td><td><?=$this->db_model->dateFormat($data['reg_date']);?></td>
            </tr>
            <tr>
              <td>Email</td><td><?=$data['email'];?></td>
              <td>Mobile</td><td><?=$data['mobile'];?></td>
            </tr>
            <tr>
              <th colspan="2" class="txtblack">Please Note Your User ID and Password for login to your Account.</th>
              <td>Introducer ID</td><td><?=$data['sponcer_id'];?></td>
            </tr>
          </table>
          </div>
          <?php } ?>       
          
          <!-- All Content End here -->
          </div>
        </div>
      </div>
    </div>
</body>
<?php $this->load->view('includes/footer.php'); ?>
<style type="text/css">
  
  #contain{
    height: 100vh;
  }
  legend{
    border-bottom: 1px solid grey;
  }
  label{
    font-weight: normal;
  }

</style>
<script type = "text/javascript" >
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
history.pushState(null, null, '');
});


$("#printId").click(function(){
        var printContents = $("#myDiv").html();
         var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
      var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
      frameDoc.document.write('<html><head><link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/mystyle.css');?>" /></head><body onload="window.print()">' + printContents + '</body></html>');
      frameDoc.document.close();
    });
</script>