<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='id-card-generate';?> | <?=$this->siteInfo['name'];?></title>
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
              <!-- .........................date wize filter data................. -->
            <div class="col-sm-12">
              <button class="btn btn-primary pull-right" id="printId"> Print <i class="fa fa-print"></i></button>
              <hr>
            </div>
            <div class="col-sm-6 col-lg-offset-3" id="myDiv">
              <table class="table table-bordered" cellpadding="4" style="width: 40%; margin-bottom: 0px; " border="1" >
                <tbody>
                  <tr rowspan="2">
                    <td><center><img src="<?=base_url('uploads/idlogo.png');?>" height="120" width="120"></center></td>
                    <td class="txtcenter" colspan="5">
                      <h3 style="margin-top: -3px; font-size: 19px;"><?=$this->siteInfo['name'];?></h3>
                      <b><?=$this->siteInfo['address'];?></b><br>
                      <span style="font-size:12px;">Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span>
                      <p>ID CARD</p>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size:12px;">Registration No.</td><td style="font-size:12px;">  <b> <?=$get_data['user_id'];?></b></td>
                    <td style="font-size:12px;">
                     Sponcer Id
                    </td>
                    <td style="font-size:12px;"><b> <?=$get_data['sponcer_id'];?></b></td>
                  </tr>

                  <tr>
                    <td style="font-size:12px;">Name</td><td style="font-size:12px;"><b><?=$get_data['name'];?>  </b>
                       <td rowspan="5" colspan="2">
                      <center><img src="<?=base_url('uploads/'.$get_data['image']);?>" style="height: 100px; width: 100px;"></center>
                    </td>
                  </tr>
                   <tr>
                    <td style="font-size:12px;">Father Name</td><td style="font-size:12px;"> <b> <?=$get_data['fname'];?></b></td>
                  </tr>
                  <tr>
                    <td style="font-size:12px;">DOJ</td><td style="font-size:12px;"> <b> <?=$get_data['reg_date'];?></b></td>
                  </tr>
                  <tr>
                    <td style="font-size:12px;">Mobile</td><td style="font-size:12px;"><b>  <?=$get_data['mobile'];?></b></td>
                  </tr>
                  
                  <tr><td style="font-size:12px;">Address</td><td style="font-size:12px;"><b> <?=$get_data['address'];?></b> </td>
                  </tr>

                </tbody>
              </table>
              <br>
              <p style="margin-left: 153px;"><b style=" ">________________________<br>Authorised Sign with Stamp</b></p>
              <!-- <br><br><br> -->
              <!-- <center><p>This is a Computer Generated ID Card</p></center> -->
            </div>      
          </div>
          <!-- All Content End here -->
        </div>
      </div>
    </div>
</body> 
<?php $this->load->view('include/footer.php'); ?>
<script type="text/javascript">
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