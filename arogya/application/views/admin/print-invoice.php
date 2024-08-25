<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Booking Payment Invoice';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="col-sm-12">
              <button class="btn btn-primary pull-right" id="printId"> Print <i class="fa fa-print"></i></button>
              <hr>
            </div>
            <div class="col-sm-12" id="myDiv">
              <table class="table table-bordered" cellpadding="4" style="width: 100%;    margin-bottom: 5px;" border="1">
                <tbody>
                  <tr rowspan="2">
                    <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="90" width="90"></center></th>
                    <td class="txtcenter" colspan="5">
                      <h3 style="margin-top: 0px;    margin-bottom: 0px;"><?=$this->siteInfo['name'];?></h3>
                      <b><?=$this->siteInfo['address'];?></b><br>
                      <span>Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span>
                      <p style="    margin: 0 0 0px;">Booking Invoice</p>
                    </td>
                  </tr>
                  <?php $sitesd=$this->db->get_where('sites',array('id'=>$project['site_id']))->row_array(); ?>
                  <tr>
                    <th>Property Type</th><td>  <?=$project['name'];?></td>
                    <td>Invoice No.  <b><?=(100000 + $payment['id']);?></b>
                    </td>
                    <td>
                      Dated  <b><?=$this->db_model->dateFormat($payment['pay_date']);?></b>
                    </td>
                  </tr>
                  <tr>
                    <th>Project Name</th><td>  <?=$sitesd['name'];?></td>
                    <th>Block Name</th><td><?=$flat['block_name']; ?>
                  </tr>
                  <tr>
                    <th>Registration No.</th><td>  <b><?=$userData['registration']; ?></b></td>
                    <td>
                      Plot No.
                    </td>
                    <td><b><?=$flat['flat_num']; ?></b></td>
                  </tr>
                  <tr>
                    <th>Name</th><td>  <b><?=$userData['name'];?>&nbsp;<?=$userData['m_name'];?>&nbsp;<?=$userData['l_name'];?></b>
                     <th>Mobile</th><td>  <?=$userData['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Address</th>
                    <td colspan="3"><?=$userData['address'];?> <?=$userData['city'];?> <?=$userData['state'];?></td>
                  </tr>
                  <tr>
                    <th> Area :</th><td><b><?=$flat['area']; ?>Sq.ft</b></td>
                    <td>Rate </td>
                    <td class="txtright"><b><?=$flat['rate']; ?>/Sq.ft</b></td>
                  </tr>
                  <?php if($flat['additional_amount1']!=''){ ?>
                  <tr>
                    <td>
                      <?php if($flat['additional_amount1']!='')
                      { ?>
                          <?=$flat['additional_detail1'];?></td><td>
                          <b><?=$flat['additional_amount1'];?></b>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($flat['additional_amount2']!='')
                      { ?>
                          <?=$flat['additional_detail2'];?></td><td class="txtright">
                          <b><?=$flat['additional_amount2'];?></b>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <th colspan="2" class="txtright">Grand Total</th>
                    <td class="txtright"><b style="color: red;"> &#8377; <?php $digit=number_format($flat['total']);?> <?= (($digit!='')?$digit.".00":"0.00") ?></b></td>
                  </tr>
                  <tr>
                    <th colspan="3" style="text-align: right;">PLC Charg</th><th style="color: red; text-align: right;">&#8377; <?=(($userData['plc']!='')?$userData['plc'].".00":"0.00")?></th>
                  </tr>
                  <tr>
                    <th colspan="3" style="text-align: right;">Development Charg</th><th style="color: red; text-align: right;">&#8377; <?=($userData['dev_charg']!='')?$userData['dev_charg'].".00":"0.00";?></th>
                  </tr>
                 <!-- <?php if($userData['discount']>=0) { ?>-->
                  <tr>
                    <td colspan="3" class="txtright">Discount</td>
                    <th class="txtright"><?php $disco = intval($userData['discount']);?> &#8377;  <?= ($disco!='')?$disco.".00":"0.00" ?></th>
                  </tr>
                  <tr>
                    <td colspan="3" class="txtright">Spacel Discount</td>
                    <th class="txtright"><?php $spldisco = intval($userData['specialdiscount']);?> &#8377;  <?= ($spldisco!='')?$spldisco.".00":"0.00" ?></th>
                  </tr>
                  <tr>
                    <th colspan="3" class="txtright">Net Payable Amount</th>

                    <?php $plccharg = ($userData['plc']!='')?$userData['plc']:0;?>
                    <?php $devcharg = ($userData['dev_charg']!='')?$userData['dev_charg']:0;?>

                    <td class="txtright"><b style="color: red;"><?php $netpay = number_format($digit=intval($flat['total'])+intval($plccharg)+intval($devcharg)-intval($userData['discount'])-intval($userData['specialdiscount']));?> &#8377; <?=($netpay!='')?$netpay.".00":"0.00"; ?></b></td>
                  </tr>
                 <!-- <?php } ?>-->
                  <tr>
                    <th>Amount In words:</th>
                    <td colspan="3"><?=$this->db_model->amount(str_replace(',','',$digit));?></td>
                  </tr>
                </tbody>
              </table>
              <b>Payment Description</b>
              <table class="table table-bordered" style="width: 100%;    margin-bottom: 0px;" border="1" cellpadding="5">
                <tbody>
                  <tr>
                    <th>TRNX</th><th>Inst No</th><th>Payment Date</th><th>Mode</th><th>No</th><th>Detils</th><th>Amount</th><th>TRNX Date</th>
                  </tr>
                  <?php $paid=0; $amt=$flat['total']; $i=1; ?>
                  
                    <?php 
                         $va = 0;
                         $makarray = explode(',',$payment['cheque_num']);
                          
                         ?>
                         <?php foreach ($makarray as $key => $value): ?>
                           
                         
                  <tr>
                    <td><?=$payment['trnx'];?></td>
                    <td><?=($payment['inst_num']=='down')?'Down Payment':$payment['inst_num'];?></td>
                    <td><?=$this->db_model->dateFormat($payment['pay_date']);?></td>
                    <td><?=$payment['pay_mode'];?></td>
                    <td>



                      <?php  
                         
                        if ($payment['cheque_num']!='') {
                           echo $makarray[$va];
                        }

                      ?></td>
                    <td>
                        <?php if ($payment['cheque_detail']!=''): 
                                  $chkDtlArray = explode(',',$payment['cheque_detail']);
                                  echo $chkDtlArray[$va];
                                endif ?>
                       <!-- <?=$payment['cheque_detail'];?> -->
                    </td>
                    <td>
                      <?php 
                      if($payment['pay_mode']=='Cheque')
                      {
                        $amt1=explode(',',$payment['pay_amount']);
                          $cal=0;
                          foreach($amt1 as $key=>$amount)
                          {
                            $cal=$cal+$amount;
                          }
                      }else
                      {
                        $cal=$payment['pay_amount'];
                      } ?>

                       <?php if ($payment['pay_amount']!=''): 
                                  $payAmtArray = explode(',',$payment['pay_amount']);
                                  echo "&#8377; ". $payAmtArray[$va].".00";
                                endif ?>
                      <!-- &#8377; <?=($payment['pay_amount']!='')?$payment['pay_amount'].".00":"0.00";?> -->
                    </td>

                    <td>
                        <?php if ($payment['trns_date']!=''): 
                            // var_dump($payment['trns_date']);
                              // print_r($payment['trns_date']); 
                                  $chkDateArray = explode(',',$payment['trns_date']);
                                  echo $chkDateArray[$va];
                                endif ?>
                                <?php if ($payment['trns_date']==''): ?>
                                  <?=$this->db_model->dateFormat($payment['pay_date']);?>
                                <?php endif ?>
                       <!-- <?=$payment['cheque_detail'];?> -->
                    </td>
                  </tr>
                  <?php $va++; endforeach ?>
            <?php
            $backPayd =0;  
            $payval = $this->db_model->globalSelect('payment',['registration'=>$userData['registration'],'id!='=>$payment['id']]);
             foreach ($payval as $key => $value): 
              $alredy_pay = explode(',',$value['pay_amount']);
              foreach ($alredy_pay as $key => $pay) {
                $backPayd += $pay;
                
              }
             endforeach; 
             echo $backPayd;
             ?>
                 
                  <?php if ($backPayd > 0): ?>
                    <tr style="max-height: 100px;max-width: 100px;">
                    <th colspan="7">Alredy Paid Amount </th><th style="color: #000;">&#8377; <?=(($backPayd!='')?$backPayd.".00":"0.00");?></th>
                  </tr>
                  <tr>
                    <th>Amount(In words)</th><td colspan="7"> : <?=$this->db_model->amount($backPayd);?> </td>
                  </tr>
                  <?php $cal += $backPayd; ?>
                  <?php endif ?>
                  <tr style="max-height: 100px;max-width: 100px;">
                    <th colspan="7">Total Paid Amount </th><th style="color: #000;">&#8377; <?=(($cal!='')?$cal.".00":"0.00");?></th>
                  </tr>
                  <tr>
                    <th>Amount(In words)</th><td colspan="7"> : <?=$this->db_model->amount($cal);?> </td>
                  </tr>
                  <tr>
                    <th colspan="7">Total Balance Amount </th><th style="color: #000;">&#8377; 
                      
                      <?php $rest=$digit-(int)$cal; ?><?=(($rest!='')?$rest.".00":"0.00");?> </th>
                  </tr>
                  <tr>
                    <th>Amount(In words)</th><td colspan="7"> : <?=$this->db_model->amount($rest);?> </td>
                  </tr>
                </tbody>
              </table>
              <br><br><br>
              <b style="float: right;">________________________<br>Authorised Sign with Stamp</b>
              <br>
              <center><p>This is a Computer Generated Invoice</p></center>
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
