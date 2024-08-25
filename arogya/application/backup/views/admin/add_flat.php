<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Add Flat';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="row padding-top">
                      <div class="container-fluid padding-top main-container">
                <!-- ///=====================All Contents Start Here============= //-->
                           <?= form_open('real1/flatMgmt/add',['class'=>'form-horizontal jumbotron']); ?>
                              <legend style="margin-top: 10px;">Flat Details</legend>
                              <div class="well well-sm">
                                <b>Property Type:- </b> <?=$data['name']; ?> , <b>Address: </b><?=$data['address']; ?>.
                                <input type="hidden" name="building_id" id="building_id" value="<?=$data['id'];?>">
                              </div>
                              <div class="form-group">
                                <!-- <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-4">
                                  <input type="text" value="<?= set_value('name'); ?>" name="name" class="form-control" id="myName" placeholder="Enter Flat Name">
                                </div> -->
                                <label class="col-sm-2 control-label">Plot No.</label>
                                <div class="col-sm-2">
                                  <input type="text" pattern="[A-Z]{0,5}" value="<?=set_value('prefix'); ?>" name="prefix" class="form-control" placeholder="eg.A,B,C..." id="">
                                </div>
                                <div class="col-sm-2">
                                  <input type="number" value="<?= set_value('flat_num'); ?>" name="flat_num" class="form-control" placeholder="Enter Plot number" id="flat_num">
                                  <small style="color: red;" id="errFlatnum"></small>
                                </div>
                                <label class="col-sm-2 control-label">Entry Date</label>
                                <div class="col-sm-4">
                                <span id="datepairExample">
                                  <input type="text" value="<?= set_value('date',date('d-m-Y')); ?>" name="date" class="form-control date" id="date" placeholder="dd-mm-yyyy" required>
                                  </span>
                                  <?= form_error('registration_date'); ?>
                                </div>
                              </div>
                              <!-- <div class="form-group">
                                <label class="col-sm-2 control-label">Flat Type</label>
                                <div class="col-sm-4">
                                  <select class="form-control" name="flat_type" id="" required>
                                    <option value="">Select Flat Type</option>
                                    <option value="1BHK">1BHK</option>
                                    <option value="2BHK">2BHK</option>
                                    <option value="3BHK">3BHK</option>
                                  </select>
                                  <span style="color: red;" id="errType"></span>
                                </div>
                              </div> -->
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Area in Sq.Ft</label>
                                <div class="col-sm-4">
                                  <input type="text" onchange="return mainCal();" value="<?= set_value('area'); ?>" name="area" class="form-control" id="area" placeholder="Enter Flat Area in Sq.ft">
                                  <span style="color: red;" id="errArea"></span>
                                </div>
                                <label class="col-sm-2 control-label">Rate per sq.ft</label>
                                <div class="col-sm-4">
                                  <input type="number" onchange="return mainCal();" value="<?= set_value('rate'); ?>" name="rate" class="form-control" placeholder="Enter Flat Rate per sq.ft" id="rate">
                                  <span style="color: red;" id="errRate"></span>
                                </div>
                              </div>
                              <!-- <div class="form-group">
                                <label class="col-sm-2 control-label">Parking</label>
                                <div class="col-sm-4">
                                  <select class="form-control" name="parking" id="parking" required>
                                    <option value="">Please Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                  </select>
                                  <span style="color: red;" id="errParking"></span>
                                </div>
                                <label class="col-sm-2 control-label">Parking Amount</label>
                                <div class="col-sm-4">
                                  <input type="number" value="<?= set_value('parking_pay'); ?>" name="parking_pay" class="form-control" onchange="return mainCal();" placeholder="Enter Parking Amount" id="parking_pay">
                                  <span style="color: red;" id="errParking_pay"></span>
                                </div>
                              </div> -->
                              <div class="form-group">
                                <!-- <label class="col-sm-2 control-label">Floor</label>
                                <div class="col-sm-4">
                                  <input type="text" value="<?= set_value('floor'); ?>" name="floor" class="form-control" placeholder="Enter floor number" id="floor">
                                  <span style="color: red;" id="errFloor"></span>
                                </div> -->
                                <label class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-4">
                                  <textarea class="form-control" value="" name="location" rows="2" id="" placeholder="Enter Plot Location" ><?= set_value('location'); ?></textarea>
                                  <?= form_error('location'); ?>
                                </div>
                                <label class="col-sm-2 control-label">Other Details</label>
                                <div class="col-sm-4">
                                  <textarea class="form-control" value="" name="detail" rows="2" id="" placeholder="Enter Other Details" ><?= set_value('detail'); ?></textarea>
                                  <?= form_error('detail'); ?>
                                </div>
                              </div>
                              <legend>Any Additional Payment <span>(Optional)</span></legend>
                              <div class="form-group">
                                <div class="col-sm-3">
                                  <label>Details 1</label>
                                  <input type="text" value="<?= set_value('additional_detail1'); ?>" name="additional_detail1" class="form-control" placeholder="Additional Detail 1st" id="additional_detail1">
                                  <span style="color: red;" id="additional_detail1"></span>
                                </div>
                                <div class="col-sm-3">
                                  <label>Amount 1</label>
                                  <input type="number" value="<?= set_value('additional_amount1'); ?>" name="additional_amount1" onchange="return mainCal();" class="form-control" placeholder="Additional Amount 1st" id="additional_amount1">
                                  <span style="color: red;" id="additional_amount1"></span>
                                </div>
                                <div class="col-sm-3">
                                  <label>Detail 2</label>
                                  <input type="text" value="<?= set_value('additional_detail2'); ?>" name="additional_detail2" class="form-control" placeholder="Additional Detail 2nd" id="additional_detail2">
                                  <span style="color: red;" id="additional_detail2"></span>
                                </div>
                                <div class="col-sm-3">
                                  <label>Amount 2</label>
                                  <input type="number" onchange="return mainCal();" value="<?= set_value('additional_amount2'); ?>" name="additional_amount2" class="form-control" placeholder="Additional Amount 2nd" id="additional_amount2">
                                  <span style="color: red;" id="additional_amount2"></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Max. Total Amount</label>
                                <div class="col-sm-4">
                                  <input type="text" value="<?= set_value('total'); ?>" name="total" class="form-control" id="total" readonly>
                                  <span style="color: red;" id="total"></span>
                                </div>
                              </div>
                              <hr>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Enter Total Plots</label>
                                <div class="col-sm-4">
                                  <input type="number" class="form-control" name="same_flat" value="1" min="1" required="">
                                </div>
                                <div class="col-sm-6">
                                  <i class="txtred">Note: Enter the Number of Plots Containing same Property.</i>
                                </div>
                              </div>
                              <hr>
                              <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                  <button type="reset" class="btn btn-default">Reset</button>
                                  <button type="submit" id="btnSubmit" onsubmit="return mainCal();" class="btn btn-primary">Submit</button>
                                </div>
                              </div>
                          </form>      
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
             $('#errFlatnum').html('This Plot Number is Already Exits.');
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
      var ar=parseFloat($('#area').val());
      if(isNaN(ar)){ var area=1; }else{ var area=ar; }
      var rate1=parseFloat($('#rate').val());
      if(isNaN(rate1)){ var rate=1; }else{ var rate=rate1; }
      var amt1=parseFloat($('#additional_amount1').val());
      if(isNaN(amt1)){ var amount1=0; }else{ var amount1=amt1; }
      var amt2=parseFloat($('#additional_amount2').val());
      if(isNaN(amt2)){ var amount2=0; }else{ var amount2=amt2; }
      var parking1=parseFloat($('#parking_pay').val());
      if(isNaN(parking1)){ var parking=0; }else{ var parking=parking1; }
      var total=(area*rate)+amount1+amount2+parking;
      $('#total').val(total);
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
</body>
</html>
