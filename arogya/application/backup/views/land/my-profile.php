<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='My Profile';?> | <?=$this->siteInfo['name'];?></title>
    <?php $this->load->view('land/include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
      <?php $this->load->view('land/include/topbar'); ?>
  <!--===========top nav end===========-->
    <div class="wrapper" id="wrapper">
      <div class="left-container" id="left-container">
        <!--========== Sidebar Start =============-->
          <?php $this->load->view('land/include/sidebar',$page); ?>
        <!--========== Sidebar End ===============-->
      </div>
      <div class="right-container" id="right-container">
          <div class="container-fluid">
            <?php $this->load->view('land/include/page-top',$page); ?>
            <!--//===============Main Container Start=============//-->
             <div class="container-fluid padding-top main-container">
            
  <!-- ///=====================All Contents Start Here============= //-->
   <?php $digit=0; ?>
            <div class="col-sm-12" style="padding-bottom: 15px;">
              <div class="btn-group pull-right">
                
                <button class="btn btn-primary" id="printId">Print <i class="fa fa-print"></i></button>
              </div>
            </div>
            <div class=" col-lg-12" id="myDiv">
              <table class="table table-hover table-bordered table-striped" border="1" cellpadding="5" style="width:100%;">
                <tbody>
                  
                  <tr>
                    <th>Land Name</th><td colspan="3" style="color: blue;"><?=$userData['land_name'];?></td><th>Registration No.</th><td colspan="3"><?=$userData['registration'];?></td>
                  </tr>
                  <tr>
                    <th>Owner Name</th><td colspan="3"><?=$userData['owner_name'];?></td><th>Mobile</th><td><?=$userData['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Address</th><td colspan="5"><?=$userData['location'];?></td>
                  </tr>
                 
                  
                  <tr>
                    <th colspan="5" style="text-align: right;">Grand Total</th><th style="color: red; text-align: right;">&#8377; <?=number_format($userData['total']);?> </th>
                  </tr>
                 
                  
                 
                  <tr>
                    <th>Amount In words:</th>
                    <td colspan="5"><?=$this->db_model->amount($userData['total']);?> </td>
                  </tr>
                </tbody>
              </table>
              
            </div>      
          </div>
          <br><br><br>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('land/include/footer'); ?>
  <!--==========Footer End=============-->   
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
</body>
</html>
