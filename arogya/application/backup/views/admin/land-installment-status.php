<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Land Installment Status';?> | <?=$this->siteInfo['name'];?></title>
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
                <th>Land Name</th><td>  <?=$get_data['land_name'];?></td>
                </td>
                <td>
                  Dated  <b><?=$this->db_model->dateFormat($get_data['registration_date']);?></b>
                </td>
              </tr>
              <tr>
                <th>Owner Name</th><td> <?= $get_data['owner_name']  ?> </td>
               
                <th>Registration No.</th><td>  <b><?=$get_data['registration']; ?></b></td>
              </tr>
              
              <tr>
                <th>Father Name</th><td>  <b><?= $get_data['f_name']  ?></b>
                 <th>Mobile</th><td>  <?=$get_data['mobile'];?></td>
              </tr>
              <tr>
                <th>Address</th>
                <td colspan="3"><?=$get_data['location'];?></td>
              </tr>
              <tr>
                <th> Area :</th><td><b><?=$get_data['area']; ?>Sq.ft</b></td>
                <td>Rate </td>
                <td class="txtright"><b><?=$get_data['rate']; ?>/Sq.ft</b></td>
              </tr>
              <tr>
                <th colspan="3" class="txtright">Grand Total</th>
                <td class="txtright"><b style="color: red;"> &#8377; <?php $digit=number_format($get_data['total']);?> <?= (($digit!='')?$digit.".00":"0.00") ?></b></td>
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
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  <?php $data=$this->db_model->globalSelect('land_installment',['land_id'=>$get_data['id']]);
                  $i=1; foreach($data as $payData) { ?>
                  <tr>
                    <td><?=($payData['status']!=0)?$payData['trnx']:'';?></td>
                    <td><?=$payData['inst_num'];?></td>
                    <td><?=$this->db_model->dateFormat($payData['due_date']);?></td>
                    <td><?=($payData['pay_date']!='')?$this->db_model->dateFormat($payData['pay_date']):'';?></td>
                    <td>&#8377; <?=number_format($payData['emi']);?></td>
                    <td>
                      <div class="btn-group">
                      <?php if($payData['status']==0){ ?>
                        <a href="<?=base_url('control/getData/land_installment/'.$payData['id'].'/pay-land-installment');?>" class="btn btn-sm btn-primary"> Pay </a>
                        <button href="#" class="btn btn-sm btn-warning" disabled> Print </button>
                      <?php } else {
                        $pay_id=$this->db_model->getWhere('payment',['installment_id'=>$payData['id']]);?>
                        <button href="#" class="btn btn-sm btn-primary" disabled> Paid </button>
                        <a href="<?=base_url('real1/printLandInvoice/'.$payData['id']);?>" class="btn btn-sm btn-warning"> Print <i class="fa fa-print"></i></a>
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
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>
