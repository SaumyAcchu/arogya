<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Payment Report';?> | <?=$this->siteInfo['name'];?></title>
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
                <?= form_open('real1/paymentReport',['class'=>'form-horizontal']); ?>
                  <table class="table table-striped table-hover table-bordered" >
                     <tbody>
                      <tr>
                        <td>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"> Project</span>
                            <select name="building_id" class="form-control" id="branchID" required>
                              <option value="">Select Project</option>
                              <?php foreach($data as $list) { ?>
                              <option value="<?=$list['id'];?>" <?=set_select('building_id',$list['id']);?>><?=$list['name'];?></option>
                              <?php } ?>
                              <option value="All" <?=set_select('building_id','All');?>>All</option>
                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">From</span>
                             <input type="text" value="<?=set_value('dateFrom',date('d-m-Y'));?>" name="dateFrom" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                          </div>
                        </td>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">To</span>
                             <input type="text" value="<?=set_value('dateTo',date('d-m-Y'));?>" name="dateTo" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
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
            <?php if(isset($payReport))
            {
            if($searchFor['building_id']=='All')
            { ?>
              <b style="color:red;"> Search Result For </b>: <b style="color:green;">All</b> &nbsp;&nbsp;&nbsp;
            <?php }else
            { ?>
              <?php $project1=$this->db->get_where('project',['id'=>$searchFor['building_id']])->row_array(); ?>
              <b style="color:red;"> Search Result For </b>: <b style="color:green;"><?=$project1['name'];?></b> &nbsp;&nbsp;&nbsp;
            <?php } ?>
            <b style="color:red;"> From </b>: <b style="color:green;"><?=$searchFor['dateFrom'];?></b> &nbsp;&nbsp;&nbsp;
            <b style="color:red;"> To </b>: <b style="color:green;"><?=$searchFor['dateTo'];?></b> &nbsp;&nbsp;&nbsp;
            <table id="example" class="table table-striped table-hover table-bordered display" style="width:100%">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Project</th>
                  <th>Flat No.</th>
                  <th>User</th>
                  <th>Pay Mode</th>
                  <th>Cheque No.</th>
                  <th>Cheque Detail</th>
                  <th>Pay Date</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=1; $total=0; if(count($payReport)>0){ foreach($payReport as $list){ ?>
                <tr>
                  <td><?=$i;?></td>
                  <td>
                    <?php $project=$this->db->get_where('project',['id'=>$list['building_id']])->row_array(); ?>
                    <?=$project['name'];?>
                  </td>
                  <td>
                    <?php $flat=$this->db->get_where('flat',['id'=>$list['flat_id']])->row_array(); ?>
                    <?=$flat['flat_num'];?>
                  </td>
                  <td>
                    <?php $user=$this->db->get_where('flat_registration',['id'=>$list['flat_user_id']])->row_array(); ?>
                    <?=$user['name'];?>
                  </td>
                  <td><?=$list['pay_mode'];?></td>
                  <td><?=$list['cheque_num'];?></td>
                  <td><?=$list['cheque_detail'];?></td>
                  <td>
                    <?php $date=new DateTime($list['pay_date']);
                    echo $date->format('d-m-Y');?>
                  </td>
                  <td><?=$list['pay_amount'];?></td>
                    <?php $amt=explode(',',$list['pay_amount']);
                    foreach($amt as $key=>$amount)
                    {
                      $total=$total+$amount;
                    } ?>        
                </tr>
                <?php $i++; } ?>
                <tr>
                  <th colspan="8">Total</th><th>&#8377; <?=$total;?></th>
                </tr>
                <tr>
                  <th>In words</th>
                  <td colspan="8">
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
                        echo "Rupees " . $result ;
                       ?> 
                            Only
                <!-- Amount in words end -->
                  </td>
                </tr>
                <?php } else { ?>
                <tr>
                  <th colspan="9">Sorry, No Records Found. Try Another Date or Another Project!</th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
           <?php }  ?>
           </div>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->  
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
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'csv', 'excel', 'pdf'
          ]
      } );
  } );
  </script> 
</body>
</html>
