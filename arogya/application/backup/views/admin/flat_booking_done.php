<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Booking Successfully';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="container-fluid padding-top main-container">
           
  <!-- ///=====================All Contents Start Here============= //-->
            <div class="col-sm-12" id="myDiv">
              <?php $building=$this->db->get_where('project',array('id'=>$get_data['building_id']))->row_array();
              $flat=$this->db->get_where('flat',array('id'=>$get_data['flat_id']))->row_array(); ?>
              <b><span class="text-success">Registration No.  : </span><?=$get_data['registration'];?> <span class="text-success"> & Passwerd is :</span><span class="text-primary"> <?=$get_data['password'];?> </span></b> 
              <table class="table table-hover table-bordered table-striped" style="width: 100%;" border="1">
                <tbody>
                  <tr>
                    <th>Property Type</th><td colspan="2" style="color: blue;"><?=$building['name'];?></td><th>City</th><td colspan="2"><?=$building['address']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="color: red;">Applicant Details</td>
                  </tr>
                  <tr>
                    <th>Name</th><td><?=$get_data['name'];?>&nbsp;<?=$get_data['m_name'];?>&nbsp;<?=$get_data['l_name'];?></td><th>Father/Husband</th><td><?=$get_data['f_name'];?></td><th>Mobile</th><td><?=$get_data['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Registration Date</th><td><?=$get_data['registration_date'];?></td><th>City</th><td><?=$get_data['city'];?></td><th>State</th><td><?=$get_data['state'];?></td>
                  </tr>
                  <tr>
                    <th>PIN</th><td><?=$get_data['pin'];?></td><th>Address</th><td colspan="3"><?=$get_data['address'];?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="color: red;">Plot Details</td>
                  </tr>
                  <tr>
                    <th>Plot No.</th><td><?=$flat['flat_num']; ?></td>
                    <th>Area</th><td><?=$flat['area']; ?>Sq.ft</td>
                    <th>Rate</th><td><?=$flat['rate']; ?>/Sq.ft</td>
                  </tr>
                  <?php if($flat['additional_amount1']!='')
                  { ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail1'];?></td><td><?=$flat['additional_amount1'];?>/-</td>
                  </tr>
                  <?php } ?>
                  <?php if($flat['additional_amount2']!='')
                  { ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail2'];?></td><td><?=$flat['additional_amount2'];?>/-</td>
                  </tr>
                  <?php } ?>
                  <tr  class="danger text-danger">
                    <th colspan="5" style="text-align: right;">Grand Total</th><td style="color: red;"><?=$flat['total'];?>/-</td>
                  </tr>
                  <tr class="info text-info">
                    <th colspan="5" style="text-align: right;">Payed Booking Amount</th><td><?=$get_data['booking_amount'];?>/-</td>
                  </tr>
                  <tr class="success text-success">
                    <th colspan="5" style="text-align: right;">Payable Amount</th><td><b><?=intval($flat['total'])-intval($get_data['booking_amount']);?>/-</b></td>
                  </tr>
                </tbody>
              </table>
             <a href=""></a>
            </div> 
            <div class="col-sm-12">
              <button class="btn btn-primary pull-left" id="printId"> Print <i class="fa fa-print"></i></button>
              <a href="<?= base_url('control/getData/flat_registration/'.$get_data['id'].'/flat_registration_payment') ?>" class="btn btn-success pull-right"> Procide To Next Step  <i class="fa fa-angle-double-right"></i></a>
              <hr>
            </div>

          </div>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
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
