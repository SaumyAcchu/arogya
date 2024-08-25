<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Payment Summary';?> | <?=$this->siteInfo['name'];?></title>
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
                <?php if($userData['emi']=='yes'){ ?>
                <a href="<?=base_url('land/installmentStatus');?>" class="btn btn-success" id="">View Installment Status <i class="fa fa-money"></i></a>
                <?php } ?>
                <button class="btn btn-primary" id="printId">Print <i class="fa fa-print"></i></button>
              </div>
            </div>
            <div class=" col-lg-12" id="myDiv">
              <table class="table table-hover table-bordered table-striped" border="1" cellpadding="5" style="width:100%;">
                <tbody>
                  <tr rowspan="2">
                    <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="120" width="120"></center></th>
                    <td class="txtcenter" colspan="5">
                      <h3><?=$this->siteInfo['name'];?></h3>
                      <b><?=$this->siteInfo['address'];?></b><br>
                      <span>Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span>
                      <p>Payment Summary</p>
                    </td>
                  </tr>
                  <tr>
                    <th>Property Type</th><td colspan="3" style="color: blue;"><?=$project['name'];?></td><th>Registration No.</th><td colspan="3"><?=$userData['registration'];?></td>
                  </tr>
                  <tr>
                    <th>Name</th><td colspan="3"><?=$userData['name'];?>&nbsp;<?=$userData['m_name'];?>&nbsp;<?=$userData['l_name'];?></td><th>Mobile</th><td><?=$userData['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Address</th><td colspan="5"><?=$userData['address'];?></td>
                  </tr>
                  <tr>
                    <th>Associate Id</th><td colspan="5"><?=$userData['introducer'];?></td>
                  </tr>
                 
                  <tr>
                    <td colspan="6" style="color: red;">Plot Details</td>
                  </tr>
                  <tr>
                    <!-- <th>Project Name</th><td colspan="2"><?=$site['name']; ?></td> -->
                    <th>Project Address</th><td colspan="2" style="text-align: left;"><?=$project['address']; ?></td>
                  </tr>
                  <tr>
                    <th>Plot No.</th><td colspan="2"><?=$flat['flat_num']; ?></td>
                    <th>Area</th><td colspan="2" style="text-align: right;"><?=$flat['area']; ?>Sq.ft</td>
                  </tr>
                  <tr>
                    <th>Location</th><td colspan="2"><?=$flat['location']; ?></td>
                    <th>Rate</th><td style="text-align: right;" colspan="2"><?=$flat['rate']; ?>/Sq.ft</td>
                  </tr>
                  <?php 

                  $add_chrg1=0;
                  $add_chrg2=0;

                  if($flat['additional_amount1']!='')
                  { 
                   $add_chrg1 = $flat['additional_amount1'];
                    ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail1'];?></td><td style="text-align: right;"><?=$flat['additional_amount1'];?></td>
                  </tr>
                  <?php } ?>
                  <?php if($flat['additional_amount2']!='')
                  { 
                    $add_chrg2 = $flat['additional_amount2'];
                    ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail2'];?></td><td style="text-align: right;"><?=$flat['additional_amount2'];?></td>
                  </tr>
                  <?php } 


                  $g_total = intval($add_chrg1)+intval($add_chrg2)+intval($flat['total']);
                  ?>
                  <tr>
                    <th colspan="5" style="text-align: right;">Grand Total</th><th style="color: red; text-align: right;">&#8377; <?=number_format($g_total);?> </th>
                  </tr>
                  <tr>
                    <th colspan="5" style="text-align: right;">PLC Charg</th><th style="color: red; text-align: right;">&#8377; <?=$userData['plc'];?> </th>
                  </tr>
                  <tr>
                    <th colspan="5" style="text-align: right;">Development Charg</th><th style="color: red; text-align: right;">&#8377; <?=$userData['dev_charg'];?> </th>
                  </tr>
                  
                  <?php if($userData['discount']>0) { ?>
                  <tr>
                    <td colspan="5" class="txtright">Discount</td>
                    <th class="txtright">&#8377; <?=number_format($userData['discount']);?> </th>
                  </tr>
                  <tr>
                    <th colspan="5" class="txtright">Net Payable Amount</th>
                    <td class="txtright"><b style="color: red;">&#8377; <?=number_format($digit=$g_total+$userData['dev_charg']+$userData['plc']-$userData['discount']);?> </b></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <th>Amount In words:</th>
                    <td colspan="5"><?=$this->db_model->amount($digit);?> </td>
                  </tr>
                </tbody>
              </table>
              <h4>PAYMENT SUMMARY</h4>
              <table class="table table-hover table-bordered table-striped" border="1" cellpadding="5" style="width:100%;">
                <tbody>
                  <tr>
                    <th>Trnx</th><th>Payment Date</th><th>Mode</th><th>Cheque No</th><th>Cheque Detils</th><th>Property Value</th><th>Balance</th>
                  </tr>
                  <?php $paid=0; $amt=$digit; $i=1; foreach($payment as $payData) { ?>
                  <tr>
                    <td><?=$payData['trnx'];?></td>
                    <td><?=$this->db_model->dateFormat($payData['pay_date']);?></td>
                    <td><?=$payData['pay_mode'];?></td>
                    <td><?php 
                          if(isset($cheque))
                          {
                            $num=explode(',',$payData['cheque_num']);
                            foreach($num as $key=>$chknum)
                            {
                              if($cheque==$chknum)
                              {
                                echo '<u><b style="color:red;">'.$chknum.'&nbsp;&nbsp;</b></u>';
                              }else
                              {
                                echo $chknum.'&nbsp;&nbsp;';
                              }
                            }
                            
                          }else
                          { 
                            echo $payData['cheque_num'];
                          } ?></td>
                    <td><?=$payData['cheque_detail'];?></td>
                    <td style="text-align: right;">
                          <?php $amt1=explode(',',$payData['pay_amount']);
                          $cal=0;
                          foreach($amt1 as $key=>$amount)
                          {
                            $paid=$paid+$amount;
                            $cal=$cal+$amount;
                          } ?>
                         &#8377; <?=$payData['pay_amount'];?> 
                    </td>
                    <td style="text-align: right;">&#8377; <?=number_format($amt=$amt-$cal);?> </td>
                  </tr>
                  <?php
                   $i++; } ?>
                  <tr>
                    <th colspan="5">Total Paid amount till Now</th><th style="color: green;text-align: right;">&#8377; <?=number_format($paid);?> </th><td></td>
                  </tr>
                  <tr>
                    <th>In words</th><td colspan="6"><?=$this->db_model->amount($paid);?> </td>
                  </tr>
                </tbody>
              </table>
              <br><br><br>
              <b style="float: right;">__________________<br>
              Signature with Stamp</b>
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
