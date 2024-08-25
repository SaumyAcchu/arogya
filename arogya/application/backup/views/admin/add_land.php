<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Add Land';?> | <?=$this->siteInfo['name'];?></title>
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
                           <?= form_open('real1/landMgmt/add',['class'=>'form-horizontal jumbotron']); ?>
                            
                              <legend style="margin-top: 10px;">Land Owner Details</legend>
                              
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Land Name</label>
                                <div class="col-sm-4">
                                  <input type="text"  value="" name="land_name" class="form-control" id="land_name" placeholder="Enter Land name" required="required">
                                  <span style="color: red;" id="errLandName"></span>
                                </div>
                                <label class="col-sm-2 control-label">Owner Name</label>
                                <div class="col-sm-4">
                                  <input type="text" name="owner_name" class="form-control" placeholder="Enter Owner Full Name" required="required">
                                  <span style="color: red;" id="errOwnerName"></span>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-2 control-label">Owner Father Name</label>
                                <div class="col-sm-4">
                                  <input type="text"  value="" name="f_name" class="form-control" id="f_name" placeholder="Enter Owner's Father name" required="required">
                                  <span style="color: red;" id="errFName"></span>
                                </div>
                                <label class="col-sm-2 control-label">Owner Mobile no</label>
                                <div class="col-sm-4">
                                  <input type="number" value="" name="mobile" class="form-control" placeholder="Enter Owner Mobile Number" required="required">
                                  <span style="color: red;" id="errMobile"></span>
                                </div>
                              </div>
                              



                              <legend style="margin-top: 10px;">Land Details</legend>
                            
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Area in Sq.Ft</label>
                                <div class="col-sm-4">
                                  <input type="text" onchange="return mainCal();" value="<?= set_value('area'); ?>" name="area" class="form-control" id="area" placeholder="Enter Land Area in Sq.ft" required>
                                  <span style="color: red;" id="errArea"></span>
                                </div>
                                <label class="col-sm-2 control-label">Rate per sq.ft</label>
                                <div class="col-sm-4">
                                  <input type="number" onchange="return mainCal();" value="<?= set_value('rate'); ?>" name="rate" class="form-control" placeholder="Enter Land Rate per sq.ft" id="rate" required>
                                  <span style="color: red;" id="errRate"></span>
                                </div>
                              </div>
                             
                              <div class="form-group">
                                
                                <label class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-4">
                                  <textarea class="form-control" value="" name="location" rows="2" id="" placeholder="Enter Land Location" ><?= set_value('location'); ?></textarea>
                                  <?= form_error('location'); ?>
                                </div>
                                <label class="col-sm-2 control-label">Other Details</label>
                                <div class="col-sm-4">
                                  <textarea class="form-control" value="" name="detail" rows="2" id="" placeholder="Enter Other Details" ><?= set_value('detail'); ?></textarea>
                                  <?= form_error('detail'); ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Max. Total Amount</label>
                                <div class="col-sm-4">
                                  <input type="text" value="<?= set_value('total'); ?>" name="total" class="form-control" id="total" readonly>
                                  <span style="color: red;" id="total"></span>
                                </div>
                                  <label class="col-sm-2 control-label">Registration Date<span class="req">*</span></label>
                                  <div class="col-sm-4">
                                  <span id="datepairExample">
                                    <input type="text" name="registration_date" class="form-control date" id="registration_date" placeholder="dd-mm-yyyy" required>
                                  </span>
                                  </div>
                              </div>
                              <hr>
                             
                              
                              <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                  <button type="reset" class="btn btn-default">Reset</button>
                                  <button type="submit" id="btnSubmit1" onsubmit="return mainCal();" class="btn btn-primary">Submit</button>
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
      var total=(area*rate);
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
