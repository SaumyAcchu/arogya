<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Plot Registration';?> | <?=$this->siteInfo['name'];?></title>
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
                    <div class="col-sm-12 jumbotron">
                      <?= form_open('real1/flatReg/regsub',['class'=>'form-horizontal']); ?>
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                          <tbody>
                            <tr>
                              <td colspan="6"><b style="color: green;"><center>Plot Details</center></b></td>
                            </tr>
                            <tr>
                              <th>Property Type</th>
                              <?php $pro=$this->db->get_where('project',array('id'=>$flat['building_id']))->row_array(); ?>
                              <td colspan="3"><?=$pro['name'];?></td>
                              <th>Plot No.</th><td><?=$flat['flat_num'];?></td>
                            </tr>
                            <tr>
                              <th>Area</th><td><?=$flat['area'];?> Sq.ft</td><th>Rate</th><td><?=$flat['rate'];?>/Sq.ft</td><th>Payable Amount</th><td class="txtred"><?=$flat['total'];?></td>
                            </tr>
                            <tr>
                              <th>Location</th><td colspan="5"><?=$flat['location'];?></td>
                            </tr>
                            <!-- <tr>
                              <th>Payable Amount</th><td colspan="2"><?=$flat['total'];?></td><th>Parking Space</th><td colspan="2"><?=$flat['parking'];?></td>
                            </tr> -->
                          </tbody>
                        </table>
                        </div>
                        <input type="hidden" name="building_id" value="<?=$pro['id'];?>">
                        <input type="hidden" name="flat_id" value="<?=$flat['id'];?>">
                        <b>Note:</b> <span class="req">*</span> Fields Are Required.
                        <legend>Introducer Detail</legend>
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label>Introducer Id<span class="req">*</span></label>
                            <input type="text" value="<?= set_value('introducer'); ?>" name="introducer" class="form-control txtupper" id="introducer" onchange="return getIntroducer(this.value)" placeholder="Enter Introducer Id" required>
                            <p style="color: red;" id="errIntroducer"></p>
                          </div>
                          <div class="col-sm-6">
                           <label>Introducer Name</label>
                            <input type="text" id="sponcer_name" class="form-control" readonly="">
                          </div>
                        </div>
                        <legend style="margin-top: 10px;">Applicant Details</legend>
                        <div class="form-group">
                          <div class="col-sm-2">
                            <label>Name<span class="req">*</span></label>
                            <input type="text" value="<?= set_value('name'); ?>" name="name" class="form-control" id="name" placeholder="First Name" required>
                            <p style="color: red;" id="errname"></p>
                          </div>
                          <div class="col-sm-2">
                            <label>&nbsp;<span class="req"></span></label>
                            <input type="text" value="<?= set_value('m_name'); ?>" name="m_name" class="form-control" id="m_name" placeholder="Middle Name" >
                            <p style="color: red;" id="errm_name"></p>
                          </div>
                          <div class="col-sm-2">
                            <label>&nbsp;<span class="req"></span></label>
                            <input type="text" value="<?= set_value('l_name'); ?>" name="l_name" class="form-control" id="l_name" placeholder="Last Name" >
                            <p style="color: red;" id="errl_name"></p>
                          </div>
                          <div class="col-sm-6">
                           <label>Father's/Husband Name<span class="req">*</span></label>
                            <input type="text" value="<?= set_value('f_name'); ?>" name="f_name" class="form-control" id="f_name" placeholder="Enter Fathers's/Husband Name" required>
                            <p style="color: red;" id="errf_name"></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label>Registration Date<span class="req">*</span></label>
                            <span id="datepairExample">
                              <input type="text" value="<?= set_value('registration_date',date('Y-m-d')); ?>" name="registration_date" class="form-control date" id="registration_date" placeholder="dd-mm-yyyy" required>
                            </span>
                          </div>
                          <div class="col-sm-6">
                           <label>Mobile Number<span class="req">*</span></label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value="<?= set_value('mobile'); ?>" maxlength="10" placeholder="Applicant's Contact Number" required>
                            <p style="color: red;" id="errmobile"></p>
                          </div>
                        </div>
                         
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label>Permanent Address<span class="req">*</span></label>
                            <textarea class="form-control" value="" name="address" rows="2" id="address" placeholder="Enter Your Adderss" required><?= set_value('address'); ?></textarea>
                            <p style="color: red;" id="erraddress"></p>
                          </div>
                          <div class="col-sm-6">
                           <label>City<span class="req">*</span></label>
                            <input type="text" value="<?= set_value('city'); ?>" name="city" id="city" class="form-control" placeholder="Enter your city" required>
                            <p style="color: red;" id="errcity"></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label>State<span class="req">*</span></label>
                            <input type="text" value="<?= set_value('state'); ?>" name="state" class="form-control" id="state" placeholder="Enter your state" required>
                            <p style="color: red;" id="errstate"></p>
                          </div>
                          <div class="col-sm-6">
                           <label>PIN Code<span class="req">*</span></label>
                            <input type="text" value="<?= set_value('pin'); ?>" name="pin" id="pin" class="form-control" placeholder="Enter yor PIN Code Number" maxlength="6" required>
                            <p style="color: red;" id="errpin"></p>
                          </div>
                        </div>


                        <div class="form-group">
                          <div class="col-sm-6">
                            <label>Booking Amount<span class="req">*</span></label>
                            <input type="text" value="<?= set_value('state'); ?>" name="booking_amount" class="form-control" id="booking_amount" placeholder="Enter your Booking Amount" required>
                            <p style="color: red;" id="errstate"></p>
                          </div>
                          
                        </div>

                         <script type="text/javascript">
                          $('#mobile').keypress(function(event){
                                     console.log(event.which);
                                 if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                                     event.preventDefault();
                                 }});
                          $('#pin').keypress(function(event){
                                     console.log(event.which);
                                 if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                                     event.preventDefault();
                                 }});

                          $('#booking_amount').keypress(function(event){
                                     console.log(event.which);
                                 if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                                     event.preventDefault();
                                 }});
                        </script>

                        <!-- <legend>Co/Applicant (Optional)</legend>
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label>Name Mr/Mrs</label>
                            <input type="text" value="<?= set_value('name_optional'); ?>" name="name_optional" class="form-control" placeholder="Enter Applicant Name">
                            <?= form_error('name_optional'); ?>
                          </div>
                          <div class="col-sm-6">
                           <label>Father's/Husband Name</label>
                            <input type="text" value="<?= set_value('f_name_optional'); ?>" name="f_name_optional" class="form-control" placeholder="Enter Fathers's/Husband Name">
                            <?= form_error('f_name_optional'); ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-6">
                           <label>Mobile Number</label>
                            <input type="number" class="form-control" name="mobile_optional" id="mobile_optional" value="<?= set_value('mobile_optional'); ?>" placeholder="Applicant's Contact Number">
                          </div>
                          <div class="col-sm-6">
                            <label>Permanent Address</label>
                            <textarea class="form-control" value="" name="address_optional" rows="2" id="address_optional" placeholder="Enter Your Adderss"><?= set_value('address_optional'); ?></textarea>
                          </div>
                        </div> -->
                        <div class="form-group">
                          <div class="col-sm-10 col-sm-offset-2">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" id="btnSubmit" class="btn btn-primary">Register</button>
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
</body>
<script type="text/javascript">
  
  $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
  $('#btnSubmit').click( function(){
    var intro=$('#introducer').val();
    if($.trim(intro)=='')
    {
      $('#errIntroducer').html('This Field must be required');
      return false;
    }
    var name=$('#name').val();
    if($.trim(name)=='')
    {
      $('#errname').html('This Field must be required');
      return false;
    }
    var f_name=$('#f_name').val();
    if($.trim(f_name)=='')
    {
      $('#errf_name').html('This Field must be required');
      return false;
    }
    var mobile=$('#mobile').val();
    if($.trim(mobile)=='')
    {
      $('#errmobile').html('This Field must be required');
      return false;
    }
    // var type=$('select[name="flat_type"] option:selected').val();
    // if($.trim(type)=='')
    // {
    //   $('#errType').html('This Field must be required');
    //   return false;
    // }
    var address=$('#address').val();
    if($.trim(address)=='')
    {
      $('#erraddress').html('This Field must be required');
      return false;
    }
    var city=$('#city').val();
    if($.trim(city)=='')
    {
      $('#errcity').html('This Field must be required');
      return false;
    }
    var state=$('#state').val();
    if($.trim(state)=='')
    {
      $('#errstate').html('This Field must be required');
      return false;
    }
    var pin=$('#pin').val();
    if($.trim(pin)=='')
    {
      $('#pin').html('This Field must be required');
      return false;
    }
  });

  function getIntroducer(id)
  {
    $.ajax({
      url:"<?=base_url('control/getSponcer');?>",
      type:'post',
      data:{id:id},
      success:function(data)
      {
        if(data==0)
        {
          $('#btnSubmit').prop('disabled',true);
          $('#errIntroducer').html('Sponcer ID is Not Exist/Active');
          $('#sponcer_name').val('');
        }else
        {
          $('#btnSubmit').prop('disabled',false);
          $('#errIntroducer').html('');
          $('#sponcer_name').val(data);
        }
        //alert(data);
      }
    });
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
    .req{
      color: red;
      font-weight: bolder;
    font-size: 16px;
    }
  </style>
</html>
