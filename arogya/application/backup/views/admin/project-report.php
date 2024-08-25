<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Project Report';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="row">
              <div class="col-lg-10 col-lg-offset-1" id="myTable">
                <table cellpadding="3" class="table table-striped table-hover table-bordered"  border="1" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>Project</th><td colspan="8"><?=$project['name'];?></td>
                    </tr>
                    <tr>
                      <th>Address</th><td colspan="8"><?=$project['address'];?></td>
                    </tr>
                    <tr>
                      <th>Sl.</th>
                      <th>Flat No.</th>
                      <th>Type</th>
                      <th>Floor</th>
                      <th>Status</th>
                      <th>Alloted To</th>
                      <th>Amount</th>
                      <th>Paid</th>
                      <th>Balance</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if($data) { $i=1; $paid=0;$max=0;
                   foreach($data as $list) { ?>
                    <tr>
                      <td><?=$i;?></td>
                      <th><?=$list['flat_num'];?></th>
                      <td><?=$list['flat_type'];?></td>
                      <td><?=$list['floor'];?></td>
                      <td style="text-align: center;">
                        <?php if($list['status']==1)
                          { ?>
                            <a href="<?=base_url('real1/flats/get-flat-information/'.$project['id'].'/'.$list['id']);?>"><button class="btn-block btn-btn-sm btn-danger">Booked</button></a>
                          <?php } else { ?>
                          <a href="<?=base_url('/real1/flatReg/regopn/'.$list['id']);?>"><button class="btn-block btn-btn-sm btn-success"> Vacant </button></a>
                          <?php } ?>
                      </td>
                      <td>
                      <?php
                        $condition=array('building_id'=>$project['id'],'flat_id'=>$list['id']);
                        $user=$this->db->get_where('flat_registration',$condition)->row_array();
                        if($user)
                        {
                          echo $user['name'];
                        }else
                        {
                          echo "Not Booked";
                        } ?>
                      </td>
                      <td style="text-align: right;">&#8377;&nbsp;<?=$list['total'];
                        $max=$max+$list['total'];?>
                      </td>
                      <td style="text-align: right;">
                        <?php $current=0; if($list['status']==1)
                        {
                          $detail=$this->db->get_where('payment',['flat_id'=>$list['id'],'building_id'=>$project['id']])->result_array();
                          
                          foreach($detail as $key=> $amt)
                          {
                            if($amt['pay_mode']=='Cheque')
                            {
                              $arr=explode(',',$amt['pay_amount']);
                              foreach($arr as $key1=>$val)
                              {
                                $paid=$paid+$val;
                                $current=$val+$current;
                              }
                            }else
                            {
                              $current=$current+intval($amt['pay_amount']);
                              $paid=$paid+intval($amt['pay_amount']);
                            }
                          }
                          echo "&#8377; ".$current;
                        }else
                        {
                          echo "-";
                        } ?>
                      </td>
                      <td style="text-align: right;">&#8377;&nbsp;<?=$list['total']-$current;?></td>
                    </tr>
                  <?php $i++; } ?>
                  <tr>
                    <td colspan="6">Total</td>
                    <th style="text-align: right;">&#8377;&nbsp;<?=$max;?></th>
                    <th style="text-align: right;">&#8377;&nbsp;<?=$paid;?></th>
                    <th style="text-align: right;">&#8377;&nbsp;<?=$balance=$max-$paid;?></th>
                  </tr>
                  <?php } else { $max=0; $paid=0; $balance=0; ?>
                    <tr>
                      <td colspan="9">No Report Found</td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
                <table class="table table-bordered" cellpadding="3" border="1" style="width: 100%;">
                  <tr>
                    <th>Max. Total</th>
                    <td>
                      <!-- Amount in Words -->
                        <?php
                         $number =$max;
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
                            Only
                <!-- Amount in words end -->
                    </td>
                  </tr>
                  <tr>
                    <th>Total Paid</th>
                    <td>
                      <!-- Amount in Words -->
                        <?php
                         $number = $paid;
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
                            Only
                <!-- Amount in words end -->
                    </td>
                  </tr>
                  <tr>
                    <th>Balance Left</th>
                    <td>
                      <!-- Amount in Words -->
                        <?php
                         $number = $balance;
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
                            Only
                <!-- Amount in words end -->
                    </td>
                  </tr>
                </table>
              </div>
            </div>      
          </div><br><br>
          <center><button id="printId" class="btn btn-primary "><span class="fa fa-print"> Click to Print</span></button></center><br><br><br>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============--> 
  <script type="text/javascript">
    
    $('#datepairExample .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });

    $("#printId").click(function(){
          var printContents = $("#myTable").html();
           var frame1 = $('<iframe />');
          frame1[0].name = "frame1";
          frame1.css({ "position": "absolute", "top": "-1000000px"});
          $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
          frameDoc.document.open();
        frameDoc.document.write('<html><head><link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/mystyle.css');?>" /></head><body onload="window.print()">' + printContents + '</body></html>');
        frameDoc.document.close();
      });                          

  </script>
  <style type="text/css">
    th{
      text-align: center;
    }
  </style>
</body>
</html>
