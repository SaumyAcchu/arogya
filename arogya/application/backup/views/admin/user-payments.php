<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Customer Payment';?> | <?=$this->siteInfo['name'];?></title>
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
            
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  <!-- ///=====================All Contents Start Here============= //-->


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
                    <th>Project Name</th><td colspan="2"><?=$site['name']; ?></td>
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

                  $add_amt1 =0;
                  $add_amt2 =0;

                  if($flat['additional_amount1']!='')
                  {

                    $add_amt1 =$flat['additional_amount1'];

                   ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail1'];?></td><td style="text-align: right;">&#8377; <?=$flat['additional_amount1'];?></td>
                  </tr>
                  <?php } ?>
                  <?php if($flat['additional_amount2']!='')
                  { 
                     $add_amt2 =$flat['additional_amount2'];
                    ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail2'];?></td><td style="text-align: right;">&#8377; <?=$flat['additional_amount2'];?></td>
                  </tr>
                  <?php } 

                    $flat['total'] =$flat['total']+$add_amt1+$add_amt2;

                  ?>

                  <tr>
                    <th colspan="5" style="text-align: right;">Grand Total</th><th style="color: red; text-align: right;">&#8377; <?=number_format($flat['total']);?></th>
                  </tr>

                  <tr>
                    <th colspan="5" style="text-align: right;">PLC Charg</th><th style="color: red; text-align: right;">&#8377;<?=$userData['plc'];?></th>
                  </tr>
                  <tr>
                    <th colspan="5" style="text-align: right;">Development Charg</th><th style="color: red; text-align: right;">&#8377; <?=$userData['dev_charg'];?></th>
                  </tr>
                 
                  
                  <?php if($userData['discount']>0) { ?>
                  <tr>
                    <td colspan="5" class="txtright">Discount</td>
                    <th class="txtright">&#8377; <?=number_format($userData['discount']);?></th>
                  </tr>
                  <tr>
                    <th colspan="5" class="txtright">Net Payable Amount</th>
                    <td class="txtright"><b style="color: red;">&#8377; <?=number_format($digit=$flat['total']+$userData['dev_charg']+$userData['plc']-$userData['discount']);?></b></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <th>Amount In words:</th>
                    <td colspan="5"><!-- <?=$this->db_model->amount($digit);?> --></td>
                  </tr>
                </tbody>
              </table>
              
            </div> 


            <div class="row">
              <div class="col-lg-12">
                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>Sl.</th>
                      <th>Pay Mode</th>
                      <th>Pay Date</th>
                      <th>Cheque No.</th>
                      <th>Cheque Details</th>
                      <th>Pay Amount</th>
                      <th>Total Amount</th>
                      <th>Action</th>
                      <th>Invoice</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $totalpay=0; $totalleft=0; if($data) { $i=1;
                   foreach($data as $list) { ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$list['pay_mode'];?></td>
                      <td>
                      <?php $date=new DateTime($list['pay_date']);
                            $newDate=$date->format('d-m-Y'); ?>
                      <?=$newDate;?></td>
                      <td><?=$list['cheque_num'];?></td>
                      <td><?=$list['cheque_detail'];?></td>
                      <td>&#8377; <?=$list['pay_amount'];?></td>
                      <td>&#8377; <?=$list['grand_total'];?></td>
                      <td><div class="btn-group">
                          <!-- <a title="Edit" href="<?=base_url('real1/buildingMgmt/edt/'.$list['id']);?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a> -->
                        <?php if($this->logged['access_level']=='universal'){ ?>
                          <a title="Edit" onclick="return conDel('real1/paymentManagement/edt/<?=$list['id'];?>');" href="#" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                          <a onclick="return conDel('real1/userManagement/delete-user-payments/<?=$list['id'].'/'.$list['flat_user_id'];?>');" title="Delete" href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                          
                        <?php } ?>
                        </div>
                      </td>
                      <td>
                        <a href="<?=base_url('real1/printInvoice/'.$list['id']);?>" title="Print Payment Invoice" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-print"> Print</span></a>
                      </td>
                    </tr>
                    <?php $totalpay=$totalpay+$list['pay_amount']; $totalleft=$list['grand_total']; ?>
                  <?php $i++; } } else { ?>
                    <tr>
                      <td colspan="11">No Record Found</td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
                <!-- <b>Total Payment till Now : <?=$totalpay; ?></b><br>
                <b>Total Balance till Now : <?=$totalleft-$totalpay; ?></b> -->
              </div>
            </div>      
          </div>
          <!--//===============Main Container End=============//-->
            <!-- Bootstrap Modal fo confirmation -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" style="color: red;"></span></button>
                    <h4 class="modal-title">Please Cofirm Your Password</h4>
                  </div>
                  <div class="modal-body">
                    <p style="color: red;" id="msg"></p>
                    <div class="input-group">
                      <input type="password" id="password" class="form-control" style="margin-bottom: 5px;" placeholder="Enter Your Password" required>
                      <input type="hidden" name="action" value="" id="action">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" id="conPass" type="button">Go!</button>
                      </span>
                    </div><!-- /input-group -->
                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                  </div>
                </div>
              </div>
            </div>
          <!-- Modal End -->
          </div>
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

    $('#btnSubmit').click( function(){
      var name=$('#name').val();
      if($.trim(name)=='')
      {
        $('#errName').html('This Field must be required');
        return false;
      }
      var add=$('#address').val();
      if($.trim(add)=='')
      {
        $('#errAdd').html('This Field must be required');
        return false;
      }
    });
    function conDel(a)
    {
      $('#action').val(a);
      $('#myModal').modal('show');
      $('#msg').html(' ');
      var pass=$('#password').val("");
      return false;
    }
    $('#conPass').click(function()
      {
        var pass=$('#password').val();
        var act=$('#action').val();
        var base="<?=base_url();?>";
        $.ajax({
          url:"<?=base_url('real1/passwordConfirmation');?>",
          data:{password:pass,action:act},
          type:'post',
          success:function(data)
          {
            if(data==1)
            {
              location.href=base+act;
            }else
            {
              var sms='Password not Match.';
              $('#msg').html(sms);
            }
          }
        });
      });
  </script>
</body>
</html>
