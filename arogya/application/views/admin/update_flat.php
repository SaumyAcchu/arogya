<!DOCTYPE html>
<html>
<head>
  <title><?=$this->siteInfo['name'];?></title>
    <?php $this->load->view('include/header'); ?>
</head>
<body class="home">
    <div class="container-fluid no-padding display-table">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 no-padding hidden-xs display-table-cell v-align box" id="navigation">
            <?php $this->load->view('include/sidebar.php',['page'=>'pay-installment']); ?>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php $this->load->view('include/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="container-fluid no-padding main-container">
            <div class="title txtcenter">
            <h4>Welcome to Dashboard</h4>
          </div>
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  <!-- ///=====================All Contents Start Here============= //-->
             <?= form_open('real1/flatMgmt/upd',['class'=>'form-horizontal']); ?>
              <input type="hidden" name="id" value="<?=$updData['id'];?>">
                <legend style="margin-top: 10px;">Flat Details</legend>
                <div class="well well-sm">
                  <?php $data=$this->db->get_where('project',['id'=>$updData['building_id']])->row_array(); ?>
                  <b>Apartment Name:- </b> <?=$data['name']; ?> , <b>Address: </b><?=$data['address']; ?>.
                  <input type="hidden" name="building_id" id="building_id" value="<?=$data['id'];?>">
                </div>
                <div class="form-group">
                  <!-- <label class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-4">
                    <input type="text" value="<?= set_value('name',$updData['name']); ?>" name="name" class="form-control" id="myName" placeholder="Enter Flat Name">
                  </div> -->
                  <label class="col-lg-2 control-label">Plot No.</label>
                  <div class="col-lg-4">
                    <input type="text" value="<?= set_value('flat_num',$updData['flat_num']); ?>" name="flat_num" class="form-control" placeholder="Enter Flat number" id="flat_num">
                    <p style="color: red;" id="errFlatnum"></p>
                  </div>
                  <label class="col-lg-2 control-label">Entry Date</label>
                  <div class="col-lg-4">
                  <span id="datepairExample">
                    <input type="text" value="<?= set_value('date',$updData['date']); ?>" name="date" class="form-control date" id="date" placeholder="dd-mm-yyyy" required>
                    </span>
                    <?= form_error('registration_date'); ?>
                  </div>
                </div>
                <!-- <div class="form-group">
                  
                  <label class="col-lg-2 control-label">Flat Type</label>
                  <div class="col-lg-4">
                    <select class="form-control" name="flat_type" id="" required>
                      <option value="">Select Flat Type</option>
                      <option value="1BHK" <?=set_select('flat_type',$updData['flat_type'],$updData['flat_type']=='1BHK',true);?>>1BHK</option>
                      <option value="2BHK" <?=set_select('flat_type',$updData['flat_type'],$updData['flat_type']=='2BHK',true);?>>2BHK</option>
                      <option value="3BHK" <?=set_select('flat_type',$updData['flat_type'],$updData['flat_type']=='3BHK',true);?>>3BHK</option>
                    </select>
                    <p style="color: red;" id="errType"></p>
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="col-lg-2 control-label">Area in Sq.Ft</label>
                  <div class="col-lg-4">
                    <input type="text" onchange="return mainCal();" value="<?= set_value('area',$updData['area']); ?>" name="area" class="form-control" id="area" placeholder="Enter Flat Area in Sq.ft">
                    <p style="color: red;" id="errArea"></p>
                  </div>
                  <label class="col-lg-2 control-label">Rate per sq.ft</label>
                  <div class="col-lg-4">
                    <input type="number" onchange="return mainCal();" value="<?= set_value('rate',$updData['rate']); ?>" name="rate" class="form-control" placeholder="Enter Flat Rate per sq.ft" id="rate">
                    <p style="color: red;" id="errRate"></p>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-lg-2 control-label">Parking</label>
                  <div class="col-lg-4">
                    <select class="form-control" name="parking" id="parking" required>
                      <option value="">Please Select</option>
                      <option value="Yes" <?=set_select('parking',$updData['parking'],$updData['parking']=='Yes',true);?>>Yes</option>
                      <option value="No" <?=set_select('parking',$updData['parking'],$updData['parking']=='No',true);?>>No</option>
                    </select>
                    <p style="color: red;" id="errParking"></p>
                  </div>
                  <label class="col-lg-2 control-label">Parking Amount</label>
                  <div class="col-lg-4">
                    <input type="number" value="<?= set_value('parking_pay',$updData['parking_pay']); ?>" name="parking_pay" class="form-control" onchange="return mainCal();" placeholder="Enter Parking Amount" id="parking_pay">
                    <p style="color: red;" id="errParking_pay"></p>
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="col-lg-2 control-label">Location</label>
                  <div class="col-lg-4">
                    <input type="text" value="<?= set_value('location',$updData['location']); ?>" name="location" class="form-control" placeholder="Enter location " id="location">
                    <p style="color: red;" id="errFloor"></p>
                  </div>
                  <label class="col-lg-2 control-label">Other Details</label>
                  <div class="col-lg-4">
                    <textarea class="form-control" value="" name="detail" rows="2" id="" placeholder="Enter Other Details" ><?= set_value('detail',$updData['detail']); ?></textarea>
                    <?= form_error('detail'); ?>
                  </div>
                </div>
                <legend>Any Additional Payment <span>(Optional)</span></legend>
                <div class="form-group">
                  <div class="col-lg-3">
                    <label>Details 1</label>
                    <input type="text" value="<?= set_value('additional_detail1',$updData['additional_detail1']); ?>" name="additional_detail1" class="form-control" placeholder="Additional Detail 1st" id="additional_detail1">
                    <p style="color: red;" id="additional_detail1"></p>
                  </div>
                  <div class="col-lg-3">
                    <label>Amount 1</label>
                    <input type="number" value="<?= set_value('additional_amount1',$updData['additional_amount1']); ?>" name="additional_amount1" onchange="return mainCal();" class="form-control" placeholder="Additional Amount 1st" id="additional_amount1">
                    <p style="color: red;" id="additional_amount1"></p>
                  </div>
                  <div class="col-lg-3">
                    <label>Detail 2</label>
                    <input type="text" value="<?= set_value('additional_detail2',$updData['additional_detail2']); ?>" name="additional_detail2" class="form-control" placeholder="Additional Detail 2nd" id="additional_detail2">
                    <p style="color: red;" id="additional_detail2"></p>
                  </div>
                  <div class="col-lg-3">
                    <label>Amount 2</label>
                    <input type="number" onchange="return mainCal();" value="<?= set_value('additional_amount2',$updData['additional_amount2']); ?>" name="additional_amount2" class="form-control" placeholder="Additional Amount 2nd" id="additional_amount2">
                    <p style="color: red;" id="additional_amount2"></p>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Max. Total Amount</label>
                  <div class="col-lg-4">
                    <input type="text" value="<?= set_value('total',$updData['total']); ?>" name="total" class="form-control" id="total">
                    <p style="color: red;" id="total"></p>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" onclick="goBack()" class="btn btn-default">Go Back</button>
                    <button type="submit" id="btnSubmit" class="btn btn-primary">Update</button>
                  </div>
                </div>
            </form>      
          </div>
          <!-- All Content End here -->
        </div>
      </div>
    </div>
</body>
<?php $this->load->view('include/footer.php'); ?>
<script type="text/javascript">
  
  $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
   $('#btnSubmit').click( function(){
    var flat_num=$('#flat_num').val();
    if($.trim(flat_num)=='')
    {
      $('#errFlatnum').html('This Field must be required');
      return false;
    }
    // var type=$('select[name="flat_type"] option:selected').val();
    // if($.trim(type)=='')
    // {
    //   $('#errType').html('This Field must be required');
    //   return false;
    // }
    var area=$('#area').val();
    if($.trim(area)=='')
    {
      $('#errArea').html('This Field must be required');
      return false;
    }
    var rate=$('#rate').val();
    if($.trim(rate)=='')
    {
      $('#errRate').html('This Field must be required');
      return false;
    }
    // var parking=$('select[name="parking"] option:selected').val();
    // if($.trim(parking)=='')
    // {
    //   $('#errParking').html('This Field must be required');
    //   return false;
    // }
    // var floor=$('#floor').val();
    // if($.trim(floor)=='')
    // {
    //   $('#errFloor').html('This Field must be required');
    //   return false;
    // }
  });
   $('#flat_num').change(function(){
    var flat_num=$('#flat_num').val();
    var building_id=$('#building_id').val();
    $.ajax({
      type:'POST',
      url:"<?=base_url('real1/ajaxSelect'); ?>",
      data:{flat_num:flat_num,building_id:building_id},
      success:function(data)
      {
        if(data>0)
        {
           $('#errFlatnum').html('This Flat Number is Already Exits.');
           $('#btnSubmit').prop('disabled',true);
        }else
        {
          $('#errFlatnum').html('');
          $('#btnSubmit').prop('disabled',false);
        }
      }
    });
   });
    
  function mainCal()
  {
    var ar=parseInt($('#area').val());
    if(isNaN(ar)){ var area=1; }else{ var area=ar; }
    var rate1=parseInt($('#rate').val());
    if(isNaN(rate1)){ var rate=1; }else{ var rate=rate1; }
    var amt1=parseInt($('#additional_amount1').val());
    if(isNaN(amt1)){ var amount1=0; }else{ var amount1=amt1; }
    var amt2=parseInt($('#additional_amount2').val());
    if(isNaN(amt2)){ var amount2=0; }else{ var amount2=amt2; }
    var parking1=parseInt($('#parking_pay').val());
    if(isNaN(parking1)){ var parking=0; }else{ var parking=parking1; }
    var total=(area*rate)+amount1+amount2+parking;
    $('#total').val(total);
  }
   
function goBack() {
    window.history.back();
}
</script>
  <style type="text/css">
    legend{
      display: block;
    width: 100%;
    padding-left: 15px;
    padding-top: 5px;
    margin-bottom: 20px;
    font-size: 21px;
    line-height: inherit;
    color: #333;
    border: 0;
    border-top: 1px solid;
    border-radius: 10px;
    }
    #contain{
    border: 1px solid;
    margin-bottom: 10px;
    margin-top: 10px;
    box-shadow: inset 0px 0px 15px 5px #4F7C92;
    background: aliceblue;
    border-radius: 20px;
    }
  </style>