<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Commission Status';?> | <?=$this->siteInfo['name'];?></title>
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
              <div class="row">
              <div class="col-lg-10 col-lg-offset-1">
                <?= form_open('real1/commissionStatus',['class'=>'form-horizontal']); ?>
                  <table class="table table-striped table-hover table-bordered">
                     <tbody>
                      <tr>
                        <td>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"> Associate ID</span>
                            <input type="text" name="user_id" value="<?=set_value('user_id');?>" placeholder="Associate ID" class="form-control txtupper">
                          </div>
                        </td>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">From</span>
                             <input type="text" value="<?=set_value('dateFrom');?>" name="dateFrom" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                          </div>
                        </td>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">To</span>
                             <input type="text" value="<?=set_value('dateTo');?>" name="dateTo" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                          </div>
                        </td>
                        <td style="padding-top: 12px;">
                          <button type="submit" class="btn btn-danger btn-block btn-sm"> Details</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
              </div> 
            </div>
            <div class="col-sm-12">
            <?php if(isset($data))
            { ?>
             <!--  <div class="btn-group pull-right">
                <button type="submit" class="btn btn-info fa fa-inr" id="payBtn" style="margin-bottom: 5px;"> Pay </button>
              </div> -->
              <div id="">
              <b style="color:red;"> Commission Status For </b>: <b style="color:green;"><?=$searchData['user_id'];?></b> &nbsp;&nbsp;&nbsp;
            <b style="color:red;"> From </b>: <b style="color:green;"><?=$searchData['dateFrom'];?></b> &nbsp;&nbsp;&nbsp;
            <b style="color:red;"> To </b>: <b style="color:green;"><?=$searchData['dateTo'];?></b> &nbsp;&nbsp;&nbsp;
            <form id="myForm">
              <input type="hidden" name="user_id" value="<?=$searchData['user_id'];?>">
              <input type="hidden" name="from" value="<?=$searchData['dateFrom'];?>">
              <input type="hidden" name="to" value="<?=$searchData['dateTo'];?>">
            <table class="table table-bordered table-hover table-striped" border="1" cellpadding="5" width="100%">
              <thead>
                <tr style="background-color: lavender;">
                  <th>Sl No.</th>
                  <th>TRNX</th>
                  <th>User Reg No.</th>
                  <th>Plot No.</th>
                  <th>Level</th>
                  <th>Inst Amt.</th>
                  <th>Date</th>
                  <th>Commission</th>
                  <!-- <th>Status</th>
                  <th class="checkbox" style="margin: 0px;">
                      <label><input type="checkbox" id="checkAll"><b> All </b></label>
                  </th> -->
                </tr>
              </thead>
              <tbody>
              <?php 
              

              $i=1; $total=0; if(count($data)>0){ foreach($data as $list){ ?>
                <tr>
                  <td><?=$i;?></td>
                  <td><?=$list['transaction'];?></td>
                  <td><?=$list['flat_user_id'];?></td>
                  <?php $flat=$this->db_model->getWhere('flat',['id'=>$list['flat_id']]); ?>
                  <td><?=$flat['flat_num'];?></td>
                  <td><?=$list['rank'];?></td>
                  <td><?=$list['installment_amount'];?></td>
                  <td><?=$this->db_model->dateFormat($list['deposit_date']);?></td>
                  <td class="txtright"><?=number_format($list['commission']); $total=$total+$list['commission'];?></td>
                 <!--  <td>
                    <?php if($list['status']==0){ ?>
                      <button type="button" class="btn btn-xs btn-success">Unpaid</button>
                    <?php } else { ?>
                      <button type="button" class="btn btn-xs btn-danger">Paid</button>
                    <?php } ?>
                  </td> -->
                  <!-- <td>
                    <?php if($list['status']==0){ ?>
                    <input type="checkbox" class="" name="payId[]" value="<?=$list['id'];?>">
                    <?php } ?>
                  </td> -->
                </tr>
                <?php $i++; } ?>
                <tr style="background-color: lavender;">
                  <th colspan="7">Total</th><td class="txtright"><b><?=number_format($total);?></b></td><td colspan="2"></td>
                </tr>
                <tr>
                  <th>In words</th>
                  <td colspan="9">
                    <!-- Amount in Words -->
                        <?php
                         $number =$total;
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
                <?php } else { ?>
                <tr>
                  <th colspan="9">Sorry, No Records Found. Try Another Date or Another User ID!</th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </form>
          </div>
           <?php }  ?>
           </div>
           <div class="loader">
             <center>
                 <img class="loading-image" src="<?=base_url('assets/images/loading.gif');?>" alt="loading.." height="120" width="120">
             </center>
            </div>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
   <!-- Bootstrap Modal for Notice -->
            <div class="modal fade" id="noticeModal" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body" style="padding: 0px;">
                      <div class="panel panel-primary" style="margin-bottom: 0px;">
                      <div class="panel-heading">
                       <p class="panel-title">Notice
                       <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
                      </div>
                      <div class="panel-body" id="resContent">
                          
                      </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- Modal End -->


  <script>            
   function confirmDelete()
   {
    var con=confirm('Do you want to really delete it.');
    if(con)
      {return true;}else {return false;}
   }
   $('#datepairExample .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });


      $("#checkAll").click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
  });                

  //============form===============//
          $('#payBtn').on('click', function (e) {
            $('.loader').show();
            e.preventDefault();
            $.ajax({
              type: 'post',
              url: "<?=base_url('real1/payCommission');?>",
              data: $('#myForm').serialize(),
              success: function (data) {
                $('.loader').fadeOut(3000);
                $('#resContent').html(data);
                $('#noticeModal').modal('show');
              }
            });
          });


    </script>
    <style type="text/css">
      .loading-image {
    position: absolute;
    top: 22%;
    left: -25%;
    z-index: 10;
  }
  .loader
  {
      display: none;
      width:200px;
      height: 200px;
      position: fixed;
      top: 50%;
      left: 60%;
      text-align:center;
      margin-left: -50px;
      margin-top: -100px;
      z-index:2;
  }
    </style>
</body>
</html>
