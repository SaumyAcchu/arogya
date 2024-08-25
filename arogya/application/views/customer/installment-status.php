<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Installment Status';?> | <?=$this->siteInfo['name'];?></title>
    <?php $this->load->view('customer/include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
      <?php $this->load->view('customer/include/topbar'); ?>
  <!--===========top nav end===========-->
    <div class="wrapper" id="wrapper">
      <div class="left-container" id="left-container">
        <!--========== Sidebar Start =============-->
          <?php $this->load->view('customer/include/sidebar',$page); ?>
        <!--========== Sidebar End ===============-->
      </div>
      <div class="right-container" id="right-container">
          <div class="container-fluid">
            <?php $this->load->view('customer/include/page-top',$page); ?>
            <!--//===============Main Container Start=============//-->
            <div class="container-fluid padding-top main-container">
            
  <!-- ///=====================All Contents Start Here============= //-->
        <div class="col-sm-12">
          <table class="table table-hover table-bordered table-striped table-condensed">
                <tbody>
                  <tr rowspan="2">
                    <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="80" width="80"></center></th>
                    <td class="txtcenter" colspan="5">
                      <b><?=$this->siteInfo['name'];?></b><br>
                      <?=$this->siteInfo['address'];?><br>
                      <p>Installment Status</p>
                    </td>
                  </tr>
                  <?php $flat=$this->db_model->getWhere('flat',['id'=>$get_data['flat_id']]); ?>
                  <tr>
                    <th>Property Type</th><td colspan="3" style="color: blue;">Plot</td>
                    <th>Registration No</th><td class="txtred"><?=$get_data['registration'];?></td>
                  </tr>
                  <tr>
                    <th>Name</th><td colspan="3"><?=$get_data['name'];?></td><th>Mobile</th><td><?=$get_data['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Address</th><td colspan="5"><?=$get_data['address'];?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="color: red;">Plot Details</td>
                  </tr>
                  <tr>
                    <th>Plot No.</th><td colspan="2"><?=$flat['flat_num']; ?></td>
                    <th>Area</th><td colspan="2" style="text-align: right;"><?=$flat['area']; ?>Sq.ft</td>
                  </tr>
                  <tr>
                    <th>Location</th><td colspan="2"><?=$flat['location']; ?></td>
                    <th>Rate</th><td style="text-align: right;" colspan="2"><?=$flat['rate']; ?>/Sq.ft</td>
                  </tr>
                  <?php if($flat['additional_amount1']!='')
                  { ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail1'];?></td><td style="text-align: right;">&#8377; <?=$flat['additional_amount1'];?></td>
                  </tr>
                  <?php } ?>
                  <?php if($flat['additional_amount2']!='')
                  { ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail2'];?></td><td style="text-align: right;">&#8377; <?=$flat['additional_amount2'];?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <th colspan="5" style="text-align: right;">Grand Total</th><th style="color: red; text-align: right;">&#8377; <?=number_format($digit=$flat['total']);?></th>
                  </tr>
                  <tr>
                    <th colspan="5" style="text-align: right;">PLC</th><th style="color: red; text-align: right;">&#8377; <?=number_format($plcchar=$get_data['plc']);?></th>
                  </tr>
                  <tr>
                    <th colspan="5" style="text-align: right;">Dev</th><th style="color: red; text-align: right;">&#8377; <?=number_format($devcharg=$get_data['dev_charg']);?></th>
                  </tr>
                  <tr>
                    <th colspan="5" style="text-align: right;">Discount</th><th style="color: red; text-align: right;">&#8377; <?=$get_data['discount'];?></th>
                  </tr>
                  <tr>
                    <th colspan="5" style="text-align: right;">Net Payable Amount</th><th style="color: red; text-align: right;">&#8377; <?=$digit=$flat['total']+$plcchar+$devcharg-$get_data['discount'];?></th>
                  </tr>

                 <!--  <?php if($get_data['discount']>0) { ?> -->
                 <!--  <tr>
                    <td colspan="5" class="txtright">Discount</td>
                    <th class="txtright"><?=$get_data['discount'];?></th>
                  </tr> -->
                 <!--  <tr>
                    <th colspan="5" class="txtright">Net Payable Amount</th>
                    <td class="txtright"><b style="color: red;"><?=$digit=$flat['total']+$plcchar+$devcharg-$get_data['discount'];?></b></td>
                  </tr> -->
                 <!--  <?php } ?> -->
                  <tr>
                    <th>Amount In words:</th>
                    <td colspan="5"><?=$this->db_model->amount($digit);?></td>
                  </tr>
                </tbody>
              </table>
          <h4>INSTALLMENT SUMMARY</h4>
          <table class="table table-hover table-bordered table-striped table-condensed">
                <tbody>
                  <tr>
                    <th>Trnx</th>
                    <th>Inst. No</th>
                    <th>Due Date</th>
                    <th>Pay Date</th>
                    <th>Pay Mode</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  <?php $data=$this->db_model->globalSelect('installment',['flat_user_id'=>$get_data['id'],'flat_id'=>$flat['id'],'is_cancelled'=>0]);
                  $i=1; foreach($data as $payData) { ?>
                  <tr>
                    <td><?=($payData['status']!=0)?$payData['trnx']:'';?></td>
                    <td><?=$payData['inst_num'];?></td>
                    <td><?=$this->db_model->dateFormat($payData['due_date']);?></td>
                    <td><?=($payData['pay_date']!='')?$this->db_model->dateFormat($payData['pay_date']):'';?></td>
                    <td><?=$payData['pay_mode'];?></td>
                    <td>&#8377; <?=number_format($payData['emi']);?></td>
                    <td>
                      <div class="btn-group">
                      <?php if($payData['status']==0){ ?>
                        <button href="#" class="btn btn-sm btn-primary"> Not Paid </button>
                        <button href="#" class="btn btn-sm btn-warning" disabled> Print </button>
                      <?php } else {
                        $pay_id=$this->db_model->getWhere('payment',['installment_id'=>$payData['id']]);?>
                        <button href="#" class="btn btn-sm btn-primary" disabled> Paid </button>
                        <a href="<?=base_url('customer/printInvoice/'.$pay_id['id']);?>" class="btn btn-sm btn-warning"> Print <i class="fa fa-print"></i></a>
                      <?php } ?>
                      </div>
                    </td>
                  </tr>
                  <?php
                   $i++; } ?>
                </tbody>
              </table>
            </div>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('customer/include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>
