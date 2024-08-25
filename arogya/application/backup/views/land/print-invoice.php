<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Land Payment Invoice';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="col-sm-12">
              <button class="btn btn-primary pull-right" id="printId"> Print <i class="fa fa-print"></i></button>
              <hr>
            </div>
            <div class="col-sm-12" id="myDiv">
              <table class="table table-bordered" cellpadding="4" style="width: 100%;" border="1">
                <tbody>
                  <tr rowspan="2">
                    <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="120" width="120"></center></th>
                    <td class="txtcenter" colspan="5">
                      <h3><?=$this->siteInfo['name'];?></h3>
                      <b><?=$this->siteInfo['address'];?></b><br>
                      <span>Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span>
                      <p>Booking Invoice</p>
                    </td>
                  </tr>
                 
                  <tr>
                    <th>Land Name</th><td>  <?=$userData['land_name'];?></td>
                    <td>Invoice No.  <b><?=(100000 + $payment['id']);?></b>
                    </td>
                    <td>
                      Dated  <b><?=$this->db_model->dateFormat($payment['pay_date']);?></b>
                    </td>
                  </tr>
                  <tr>
                    <th>Owner Name</th><td> <?= $userData['owner_name']  ?> </td>
                   
                    <th>Registration No.</th><td>  <b><?=$userData['registration']; ?></b></td>
                  </tr>
                  
                  <tr>
                    <th>Father Name</th><td>  <b><?= $userData['f_name']  ?></b>
                     <th>Mobile</th><td>  <?=$userData['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Address</th>
                    <td colspan="3"><?=$userData['location'];?></td>
                  </tr>
                  <tr>
                    <th> Area :</th><td><b><?=$userData['area']; ?>Sq.ft</b></td>
                    <td>Rate </td>
                    <td class="txtright"><b><?=$userData['rate']; ?>/Sq.ft</b></td>
                  </tr>
                  <tr>
                    <th colspan="3" class="txtright">Grand Total</th>
                    <td class="txtright"><b style="color: red;"> &#8377; <?php $digit=number_format($userData['total']);?> <?= (($digit!='')?$digit.".00":"0.00") ?></b></td>
                  </tr>
                  
                </tbody>
              </table><br>
              <b>Payment Description</b>
              <table class="table table-bordered" style="width: 100%;" border="1" cellpadding="5">
                <tbody>
                  <tr>
                    <th>No</th> <th>TRNX</th><th>Registration ID</th><th>Inst No</th><th>Payment Date</th><th>Amount</th>
                  </tr>
                  <?php $paid=0; $amt=$userData['total']; $i=1; ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $payment['trnx'] ?></td>
                        <td><?= $payment['land_registration'] ?></td>
                        <td><?= $payment['inst_num'] ?></td>
                        <td><?= $payment['pay_date'] ?></td>
                        <td><?= number_format($payment['inst_amt']) ?></td>
                    </tr>
                 
                   <tr>
                    <th colspan="6"><br><br><br></th>
                  </tr>

                  <?php
                  $backPayd =0;  $cal=$payment['inst_amt'];
                  $payval = $this->db_model->globalSelect('land_payment',['land_registration'=>$userData['registration'],'id!='=>$payment['id']]);
                   foreach ($payval as $key => $value): 
                   
                      $backPayd += $value['pay_amount'];
                   endforeach; 
                   // echo $backPayd;
                   ?>

                  <?php if ($backPayd > 0): ?>
                    <tr style="max-height: 100px;max-width: 100px;">
                    <th colspan="5">Alredy Paid Amount </th><th style="color: #000;">&#8377; <?=(($backPayd!='')?$backPayd.".00":"0.00");?></th>
                  </tr>
                  <tr>
                    <th>Amount(In words)</th><td colspan="5"> : <?=$this->db_model->amount($backPayd);?> </td>
                  </tr>
                  <?php $cal += $backPayd; ?>
                  <?php endif ?>
                  <tr style="max-height: 100px;max-width: 100px;">
                    <th colspan="5">Total Paid Amount </th><th style="color: #000;">&#8377; <?=(($cal!='')?number_format($cal).".00":"0.00");?></th>
                  </tr>
                  <tr>
                    <th>Amount(In words)</th><td colspan="5"> : <?=$this->db_model->amount($cal);?> </td>
                  </tr>
                  <tr>
                    <th colspan="5">Total Balance Amount </th><th style="color: #000;">&#8377; 
                      
                      <?php $rest=$userData['total']-(int)$cal; ?><?=(($rest!='')?number_format($rest).".00":"0.00");?> </th>
                  </tr>
                  <tr>
                    <th>Amount(In words)</th><td colspan="7"> : <?=$this->db_model->amount($rest);?> </td>
                  </tr>
                </tbody>
              </table>
              <br><br><br><br><br><br>
              <b style="float: right;">________________________<br>Authorised Sign with Stamp</b>
              <br><br><br><br><br><br>
              <center><p>This is a Computer Generated Invoice</p></center>
            </div>      
          </div>
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
