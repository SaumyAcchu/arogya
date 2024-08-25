<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Print Booking';?> | <?=$this->siteInfo['name'];?></title>
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
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
          <center><h1><?=$building['name'];?></h1>
          <hr style="width: 10%;">
          <h3>Booking Form</h3>
          <h4><i>A Unit Of Beg Builder & Colonisers pvt ltd</i></h4></center>
          <br><br><br><br><br><br>
          <div class="row">
            <div class="col-lg-12">
              <table class="table" style="width:80%;" cellpadding="10">
                <tr>
                  <td>Name Mr/Mrs</td><td colspan="3"> <b> : <?=$userData['name'];?></b></td>
                </tr>
                <tr>
                  <td>Flat No.</td><td> : <b><?=$flat['flat_num'];?></b></td>
                  <td>Floor</td><td> : <b><?=$flat['floor'];?></b></td>
                </tr>
                <tr>
                  <td>Area</td><td> : <b><?=$flat['area'];?>SQ.Ft</b></td>
                  <td>Rate</td><td> : <b><?=$flat['rate'];?>/SQ.Ft</b></td>
                </tr>
              </table>
            </div>
          </div>


    </div>
    <!-- Page 1 End --><br><br>
    <!-- Page 2 Start -->
    <div id="page2" style="border: 1px solid; height: 1000px;padding: 15px; margin: 10px;">
          <br><br><br><br>
          <center><p style="font-size: 22px;">BOOKING APPLICATION FORM</p></center>
          <p class="contain-text">
          <br><br>
            Dear Sir,<br><br>
            <ul>
              <li>
                I/We request that I/We may be registered for allotment of flat in you project.
              </li>
              <li>
                I/We agree to sign & execute , as and when desired by the firm ,the requisite Agreement of the Firms Standard format.
              </li>
              <li>
                I/We have understood and agree to abide by the terms and condition of the sale as laid down herein.
              </li>
            </ul>
          </p>
          <div class="row">
            <div class="col-lg-12">
              <h4>A. First Applicant</h4>
              <table class="table" style="width: 100%;" cellpadding="8">
                <tr>
                  <td style="width:250px;">SI. No. :</td><td colspan="2"> :<b><?=$payment['id'];?></b></td>
                  <td rowspan="6">
                    <div style="height: 150px; width: 150px; border: 1px solid;">
                
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>1. Full Name Mr/Mrs</td><td colspan="2"> :<b><?=$userData['name'];?></b></td>
                </tr>
                <tr>
                  <td>2. Father/Husband’s Name</td><td colspan="2"> :<b><?=$userData['f_name'];?></b></td>
                </tr>
                <tr>
                  <td>3. Permanent address</td><td colspan="2"> :<b><?=$userData['address'];?></b></td>
                </tr>
                <tr>
                  <td>4. City</td><td colspan="2"> :<b><?=$userData['city'];?></b></td>
                </tr>
                <tr>
                  <td>5. State</td><td colspan="2"> :<b><?=$userData['state'];?></b></td>
                </tr>
                <tr>
                  <td>6. PIN</td><td> :<b><?=$userData['pin'];?></b></td>
                  <td>7. Contact</td><td> :<b><?=$userData['mobile'];?></b></td>
                </tr>
                <tr>
                  
                </tr>
              </table><br>
              <h4>B. Co/Applicant</h4>
              <table class="table" style="width: 100%;" cellpadding="8">
                <tr>
                  <td style="width:250px;">Full Name Mr/Mrs</td><td> :<b><?=$userData['name_optional'];?></b></td>
                <tr>
                  <td>Father/Husband’s Name</td><td> :<b><?=$userData['f_name_optional'];?></b></td>
                </tr>
                <tr>
                  <td>Contact No.</td><td> :<b><?=$userData['mobile_optional'];?></b></td>
                </tr>
                <tr>
                  <td>Permanent address</td><td> :<b><?=$userData['address_optional'];?></b></td>
                </tr>
              </table>
            </div>
            
          </div>
          
    </div>
    <!-- Page 2 End --><br><br>
    <!-- Page 3 Start -->
    <div id="page3" style="border: 1px solid; height: 1000px;padding: 15px; margin: 10px;">



        <div class="row">
              <div class="col-lg-12"><br><br><br>
                <b>FLAT DETAILS</b><br>
                <table class="table" style="width: 100%" cellpadding="10">
                  <tr>
                    <td>Name of Project</td><td colspan="3">: <b><?=$building['name'];?></b></td>
                  </tr>
                  <tr>
                    <td>Flat No.</td><td>: <b><?=$flat['flat_num'];?></b></td>
                    <td>Floor</td><td>: <b><?=$flat['floor'];?></b></td>
                  </tr>
                  <tr>
                    <td>Super Built-up Area of Flat</td><td>: <b><?=$flat['area'];?>Sq.ft</b></td>
                    <td>Rate</td><td>: <b><?=$flat['rate'];?>/Sq.ft</b></td>
                  </tr>
                  <tr>
                    <td>Total Rs.</td><td colspan="3">: <b><?=$flat['area']*$flat['rate'];?></b></td>
                  </tr>
                  <tr>
                    <td colspan="4"><b>PARKING SPACE DETAIL (If required)</b></td>
                  </tr>
                  <tr>
                    <td>Parking Space</td><td>: <b><?=$flat['parking'];?></b></td>
                    <td>Parking Fee</td><td>: <b><?=$flat['parking_pay'];?></b></td>
                  </tr>
                  <?php if($flat['additional_detail1']) { ?>
                  <tr>
                    <td colspan="4"><b>OTHERS</b></td>
                  </tr>
                  <tr>
                    <td><?=$flat['additional_detail1']; ?></td><td>: <b><?=$flat['additional_amount1']; ?></b></td>
                    <td><?=$flat['additional_detail2']; ?></td><td>: <b><?=$flat['additional_amount2']; ?></b></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td>Total</td><td>: <b style="border: 1px solid;padding: 5px;"><?=$flat['total'];?></b></td><td></td><td></td>
                  </tr>
                  <tr>
                    <td>Amount in words</td>
                    <td colspan="3">: <b>
                      <!-- Amount in Words -->
                        <?php
                         $number = $flat['total'];
                         $no = round($number);
                         $point = round($number - $no, 2) * 100;
                         $hundred = null;
                         $digits_1 = strlen($no);
                         $i = 0;
                         $str = array();
                         $words = array('0' => '', '1' => 'One', '2' => 'Two',
                          '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
                          '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
                          '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
                          '13' => 'Thirteen', '14' => 'Fourteen',
                          '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
                          '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
                          '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
                          '60' => 'Sixty', '70' => 'Seventy',
                          '80' => 'Eighty', '90' => 'Ninety');
                         $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                         while ($i < $digits_1) {
                           $divider = ($i == 2) ? 10 : 100;
                           $number = floor($no % $divider);
                           $no = floor($no / $divider);
                           $i += ($divider == 10) ? 1 : 2;
                           if ($number) {
                              $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                              $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                              $str [] = ($number < 21) ? $words[$number] .
                                  " " . $digits[$counter] . $plural . " " . $hundred
                                  :
                                  $words[floor($number / 10) * 10]
                                  . " " . $words[$number % 10] . " "
                                  . $digits[$counter] . $plural . " " . $hundred;
                           } else $str[] = null;
                        }
                        $str = array_reverse($str);
                        $result = implode('', $str);
                        echo $result . "Rupees";
                       ?> 
                            
                <!-- Amount in words end -->
                    </b></td>
                  </tr>
                </table>
              </div>
            </div>

            <b>Note:- service tax 3.50% extra to be paid on registry amount by the purchaser + 1% TDS.</b>
            <hr>
            <p style="line-height: 30px;">I/We remit here the sum or Rs : 
            <?php if($payment['pay_mode']=='Cheque')
            { 
              $val=0;
              $amt=explode(',',$payment['pay_amount']);
              foreach ($amt as $key => $value)
              {
                $val=$value+$val;
              }
              echo '<b style="padding:5px;border:1px solid;">'.$val.'</b>';
            }else
            {
              echo '<b style="padding:5px;border:1px solid;">'.$payment['pay_amount'].'</b>';
            }
            ?>
            <br>
            By
            <?php if($payment['pay_mode']=='Cheque')
            {
              echo '<b>Cheque</b>'; ?>
               of <b> <?=$payment['cheque_detail'];?> </b> bank . Dated : <b><?php $date=new DateTime($payment['pay_date']); echo $date->format('d-m-Y'); ?></b><br>
            Cheque No : <b><?=$payment['cheque_num'];?></b> and Details : <b><?=$payment['cheque_detail']; ?></b>
              <?php
            }else
            {
              echo '<b>Cash</b>'; ?>
              . Dated : <b><?php $date=new DateTime($payment['pay_date']); echo $date->format('d-m-Y'); ?>.</b>
      <?php } ?>
            being earnest money.<br>
            I/We Agree to pay future installment of sale price as stipulated/called by Me/our particular are given above.</p><br><br><br><br><br><br>

          <b style="float: right;">Full Signature   Date __________________________</b>
    </div>
    <!-- Page 3 End --><br><br>
    <!-- Page 4 Start -->
    <div id="page4" style="border: 1px solid; height: 1000px;padding: 15px; margin: 10px;">

        <br><br><br>
        <!-- Cheque no 045362 Rs 5,00,000. / Cheque no 045363 Rs 5,00,000 Cash 500000 -->
        <center><h3>TERMS & CONDITIONS FOR BOOKING OF FLAT</h3></center><br><br>
        <table class="table" cellpadding="10">
          <tr>
            <td>Customer Name</td><td colspan="5">: <b><?=$userData['name'];?></b></td>
          </tr>
          <tr>
            <td>Project</td><td>: <b><?=$building['name'];?></b></td><td>Flat No.</td><td>: <b><?=$flat['flat_num'];?></b></td><td>Floor</td><td>: <b><?=$flat['floor'];?></b></td>
          </tr>
        </table>
        <br>
        <h4>A. <b>MODE OF PAYMENT</b></h4>
        <!-- <h5>1. At the time of bookin 50%  rest 25% quarterly.</h5> -->
        <p>1.All  Balance should be cleared before possession and registry of the total price.</p><br>
        <ul style="padding-left: 30px; line-height: 32px; text-align: justify;">
          <li>1.That the aforesaid payment schedule should be strictly observed by the purchaser failing which the developer shall have every liberty.</li>
          <li>2.to cancel and/or rescind the booking flat with a prior Seven (7) days notice to the purchaser. In the above circumstances the booking would stand cancelled and the Developer shall have every liberty to forfeit 3% of the total Consideration Money of the Flat</li> 
          <li>3.refund the money within 90(ninety) days without any interest thereof and the Developer further shall be fully entitle to enter into a fresh booking with any intending Buyer/Purchaser after serving such notice of cancellation to the Applicant. </li>
          <li>4.The intending Allotte   has/have applied for the registration for all the allotment of a flat Full knowledge and subject to all the laws, notification and rules applicable to this area ,interest and title of the firm in the land on which the said Flat are to be constructed ,which have been explained by the firm and understood by Him/her.</li>
          <li>5.The Firm Shall have right to effect suitable and necessary alteration in the layout plan ,If and when found necessary which alteration may involve any or all the changes.</li>
          <li>6.The intending allottee shall not be entitled to get the name of his/her nominee(s) substitute in his/her place  without the prior approval of the firm who may in its sole discretion permit the same on such terms as it may deem fit.</li>
        </ul>


    </div>
    <!-- Page 4 End --><br><br>
    <!-- Page 5 Start -->
    <div id="page5" style=" height: 1000px;border: 1px solid;padding: 15px; margin: 10px;">

          <ul style="padding-left: 30px; line-height: 32px; text-align: justify;">
            <li>7.Monthly Charges for maintenance of common service of the complex per Sq.ft basis as fixed  from time to time by the promoters shall be paid by the allottee to the firm till Association/Society is formed by the allotee.</li>
            <li>8.The allotment of the flat is entirely the discretion  of the Firm and the Firm has right to reject any offer without assigning any reason thereof.</li>
            <li>9.Intending allotee have understood and agreed that the lawn and the ground floor shall be in common use of the intending Alottee(s) and the roof of the top floor will be in exclusive use of the firm.</li>
          </ul>
          <p style="line-height: 35px; text-align: justify;">The Non-Resident Indians (NRI) intending to purchase the flat shall be governed by the rules and regulations of RBI, as applicable </p>

          <p style="line-height: 35px; text-align: justify;"><b>PRICE-</b> Price of the Unit will Remain firm once blocked . No Escalation. Any additional facility that may be provided shall be charged extra.</p>

          <p style="line-height: 35px; text-align: justify;"><b>PRICES-</b> Prices can be at the sole discretion of the firm without notice (not applicable to already booked units ).</p>

          <p style="line-height: 35px; text-align: justify;"><b>DRAWING-</b> drawing are conceptual and illustrative. Areas and Dimension may change and will be adjusted in the Basic-price at the rate prevailing of the date of booking .Variations in the final layout and the floor plans can be effected without any claims from the alottee.</p>  

          <p style="line-height: 35px; text-align: justify;"><b>REGISTRATION-</b> Registration charges extra as per government norms.</p>

          <p style="line-height: 35px; text-align: justify;"><b>POSSESSION-</b> Possession of the flat shall be given as per the term of allotment after receiving final payment along with other changes and execution of sale deed . </p>
          <br><br><br><br><br>

        <b style="float: right;">Full Signature   Date _________________________________</b>
        
    </div>
    <!-- Page 5 End --><br><br>
    <!-- Page 6 Start -->
    <div id="page6" style="border: 1px solid;padding: 15px; height: 980px; margin: 10px;">
    <br><br>
                    <center><h4>MANDATORY EXTRA COST PAYABLE BY THE PURCHASER/S TO THE DEVELOPER (OTHER THAN THE PRICE)</h4></center>
                    <ul style="line-height: 35px; text-align: justify;">
                      <li>i. Before taking over the possession a sum of Rs. 25,000/- (Rupees twenty  five Thousand) only non-refundable money for installation of main meter or transformer/electrical equipments costs, deposits and others. </li>
                      <li>ii. Generator Connection Charges for  (3 Bed rooms – 600 Watts) Rs. 20,000/- (Rupees Twenty thousand) only. If required by all.</li>
                    </ul>
                    <h4>OTHER IMPORTANT INFORMATION</h4>
                    <ul style="line-height: 35px; text-align: justify;">
                      <li>i. Any extra work desire by the Purchaser shall cause to pay extra costs. </li>
                      <li>ii. Calculation of saleable area of the flat = (Covered area + Proportionate same rate) share of lobby, lift and stair) + 20% service area. For other common area amenities viz. septic tank, overhead tank reservoir, open spaces, final roof of the building, lift room, caretaker room and bathroom). </li>
                      <li>iii. It is also noted that after completion of the building, the area of the flat may be increased or decreased upto 5% against mentioned areas and the purchaser should abide by the same without raising any objection. </li>
                      <li>vi. No deduction for any removal of partition wall, window, grill and bathroom. </li>
                    </ul>

                <p style="line-height: 35px; text-align: justify;">I/We have read and understood the contents stated hereto and hereunto and spontaneously in free consent and spontaneously applied for booking of the flat described in the booking Application Form enclosed herewith duly signed by me/us. The said application shall not be treated as a final “Agreement For Sale”. </p><br><br><br>



                    
                        <b style="float: right;"> ______________________________________<br>
                     Signature of The Applicant/Purchaser and Date</b>
    </div>
    <!-- Page 6 End -->


<br>
      <center><button id="printId1" class="btn btn-primary "><span class="fa fa-print"> Click to Print</span></button></center><br><br><br>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('land/include/footer'); ?>
  <!--==========Footer End=============--> 

    <style type="text/css">
      
      .contain-text{
        text-align: justify;
      }
      .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      border-top: 0px;
  }
  .table-head{
   /* text-align: right;*/
  }
   </style>
  <script type="text/javascript">
    $("#printId").click(function(){
          var printContents = $("#myTable").html();
           var frame1 = $('<iframe />');
          frame1[0].name = "frame1";
          frame1.css({ "position": "absolute", "top": "-1000000px" });
          $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
          frameDoc.document.open();
        frameDoc.document.write('<html><head><link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/mystyle.css');?>" /></head><body onload="window.print()">' + printContents + '</body></html>');
        frameDoc.document.close();
      }); 


      $("#printId1").click(function(){
          var printContents = $("#myTable").html();
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
  <style type="text/css" media="print">
   
  </style>  
</body>
</html>
