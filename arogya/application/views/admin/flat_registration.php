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
                              <td ><?=$pro['name'];?></td>
                              <th>Block Name</th><td><?=$flat['block_name'];?></td>
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
                              <input type="text" value="<?= set_value('registration_date',date('Y-m-d')); ?>" name="registration_date" class="form-control date"  placeholder="dd-mm-yyyy" required>
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
                  



                  <div class="col-md-4">
                    <label>Select Payment Mode</label>
                    <select name="pay_mode" class="form-control" id="pay_mode" required>
                      <option value="">Please Select</option>
                      <option value="Cash">Cash</option>
                      <option value="Cheque">Cheque</option>
                      <option value="Neft">NEFT</option>
                      <option value="Rtgs">RTGS</option>
                      <option value="Imps">IMPS</option>
                    </select>
                    <p style="color: red;" id="errMode"></p>
                  </div>
                  
             
                </div><span id="csh">
             
                  <div class="form-group">
                    <div class="col-md-4">
                      <label>Booking Amount</label>
                      <input type="number" class="form-control" placeholder="Enter Amount in Rs."
                       name="booking_amount"value="">
                      <p style="color: red;" id="errAmt"></p>
                    </div>
                  </div>
                </span></span><span id="chk">
                <span id="cheque" style="display: none;">
                <div class="form-group">
                    <div class="col-md-4">
                      <label>Cheque Number</label>
                      <input type="text" maxlength="6" id="cheque_num" name="cheque_num" placeholder="Enter Cheque Number" value="" class="form-control chqnum">
                      <p style="color: red;" id="errChknm"></p>
                    </div>
                    
                    <div class="col-md-4">
                      <label>Bank Detail</label>
                      <input type="text" id="cheque_num" name="cheque_detail" placeholder="Enter Bank Detail" value="" class="form-control">
                      <p style="color: red;" id=""></p>
                    </div>
                <!--     <div class="col-md-3">
                      <label>Down Payment</label>
                      <input type="number" class="form-control" placeholder="Enter Amount in Rs."
                       name="booking_amount" id="pay_amount" value="">
                      <p style="color: red;" id="errAmt"></p>
                    </div> -->
                    <div class="col-md-4">
                      <label>Cheque Dated</label>
                      <span id="chkpairExample">
                        <input type="text" value="" name="trns_date" class="form-control date" id="trns_date" placeholder="dd-mm-yyyy" >
                      </span>
                    </div>

                  
                </div>
                <div id="education_fields">
                  
                </div>
                </span></span>

                <span id="rtg">
                  <span id="rtgs" style="display: none;">
                    <div class="form-group">
                      <div class="col-md-4">
                        <label>Transaction Id</label>
                        <input type="text"   name="rtgs_num" placeholder="Enter Rtgs Number" value="" class="form-control">
                        <p style="color: red;" id="errChknm"></p>
                      </div>                    
                      <div class="col-md-4">
                        <label>Bank Detail</label>
                        <input type="text" id="rtgs_detail" name="rtgs_detail" placeholder="Enter Bank Detail" value="" class="form-control">
                        <p style="color: red;" id=""></p>
                      </div>
                      <div class="col-md-4">
                        <label>Transaction Date</label>
                        <span id="trnsdateExample">
                          <input type="text" name="rtgs_trns_date" class="form-control date" id="trns_date1" placeholder="dd-mm-yyyy" >
                        </span>  
                        <p style="color: red;" id=""></p>
                      </div>
                     <!--  <div class="col-md-3">
                        <label>Down Payment</label>
                        <input type="number" class="form-control" placeholder="Enter Amount in Rs."
                         name="booking_amount" id="rtgs_pay_amount" value="">
                        <p style="color: red;" id="errAmt"></p>
                      </div> -->
                  </div>
                  </span>
                </span>

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
                    'format': 'yyyy-mm-dd',
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
   $('#pay_mode').change(function(){
      var data=$('select[name="pay_mode"] option:selected').val();
      if(data=='Cheque')
      {
        $("#chk").contents().each(function(index, node){
          if (node.nodeType == 8) {
              // node is a comment
              $(node).replaceWith(node.nodeValue);
            }
        });

        $('#cheque').css('display','block');
        if($("#cash").is(":visible"))
        {
        my_element_jq1 = $('#cash');
        comment1 = document.createComment(my_element_jq1.get(0).outerHTML);
        my_element_jq1.replaceWith(comment1);
        }
        if($("#rtgs").is(":visible"))
        {
        my_element_jq1 = $('#rtgs');
        comment1 = document.createComment(my_element_jq1.get(0).outerHTML);
        my_element_jq1.replaceWith(comment1);
        }
      }
      if(data=='Cash')
      {
        $("#csh").contents().each(function(index, node1) {
            if (node1.nodeType == 8) {
                // node is a comment
                $(node1).replaceWith(node1.nodeValue);
            }
        });

        $('#cash').css('display','block');
        if($("#cheque").is(":visible"))
        {
        my_element_jq = $('#cheque');
        comment = document.createComment(my_element_jq.get(0).outerHTML);
        my_element_jq.replaceWith(comment);
        }
        if($("#rtgs").is(":visible"))
        {
        my_element_jq1 = $('#rtgs');
        comment1 = document.createComment(my_element_jq1.get(0).outerHTML);
        my_element_jq1.replaceWith(comment1);
        }
      }
      if(data=='Rtgs')
      {
        $("#rtg").contents().each(function(index, node1) {
            if (node1.nodeType == 8) {
                // node is a comment
                $(node1).replaceWith(node1.nodeValue);
            }
        });

        $('#rtgs').css('display','block');
        if($("#cheque").is(":visible"))
        {
        my_element_jq = $('#cheque');
        comment = document.createComment(my_element_jq.get(0).outerHTML);
        my_element_jq.replaceWith(comment);
        }
        if($("#cash").is(":visible"))
        {
        my_element_jq1 = $('#cash');
        comment1 = document.createComment(my_element_jq1.get(0).outerHTML);
        my_element_jq1.replaceWith(comment1);
        }
      }
      if(data=='Neft')
      {
        $("#rtg").contents().each(function(index, node1) {
            if (node1.nodeType == 8) {
                // node is a comment
                $(node1).replaceWith(node1.nodeValue);
            }
        });

        $('#rtgs').css('display','block');
        if($("#cheque").is(":visible"))
        {
        my_element_jq = $('#cheque');
        comment = document.createComment(my_element_jq.get(0).outerHTML);
        my_element_jq.replaceWith(comment);
        }
        if($("#cash").is(":visible"))
        {
        my_element_jq1 = $('#cash');
        comment1 = document.createComment(my_element_jq1.get(0).outerHTML);
        my_element_jq1.replaceWith(comment1);
        }
      }
      if(data=='Imps')
      {
        $("#rtg").contents().each(function(index, node1) {
            if (node1.nodeType == 8) {
                // node is a comment
                $(node1).replaceWith(node1.nodeValue);
            }
        });

        $('#rtgs').css('display','block');
        if($("#cheque").is(":visible"))
        {
        my_element_jq = $('#cheque');
        comment = document.createComment(my_element_jq.get(0).outerHTML);
        my_element_jq.replaceWith(comment);
        }
        if($("#cash").is(":visible"))
        {
        my_element_jq1 = $('#cash');
        comment1 = document.createComment(my_element_jq1.get(0).outerHTML);
        my_element_jq1.replaceWith(comment1);
        }
      }
    });

    // $('#btnSubmit').click( function(){
    //   var mode=$('select[name="pay_mode"] option:selected').val();
    //   if($.trim(mode)=='')
    //   {
    //     $('#errMode').html('This Field must be required');
    //     return false;
    //   }
    //   if(mode=='Cheque')
    //   {
    //     var chknm=$('#cheque_num').val();
    //     if($.trim(chknm)=='')
    //     {
    //       $('#errChknm').html('This Field must be required');
    //       return false;
    //     }
    //   }
    //   var amt=$('#pay_amount').val();
    //   if($.trim(amt)=='')
    //   {
    //     $('#errAmt').html('This Field must be required');
    //     return false;
    //   }
    // });
    
  var room = 1;
  function education_fields() {
   
      room++;
      var objTo = document.getElementById('education_fields');
      var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass"+room);
    var rdiv = 'removeclass'+room;
      divtest.innerHTML = '<div class="col-md-4"><label>Cheque Number</label><input type="text" id="cheque_num" name="cheque_num[]" placeholder="Enter Cheque Number" value="" class="chqnum form-control" maxlength="6" required><p style="color: red;" id="errChknm"></p></div><div class="col-md-4"><label>Cheque Detail</label><input type="text" id="cheque_num" name="cheque_detail[]" placeholder="Enter Bank Detail" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-3"><label>Amount</label><input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount[]" id="pay_amount" value="" required><p style="color: red;" id="errAmt"></p></div><div class="col-md-4"><label>Select Date</label><input type="text" value="" name="trns_date[]" class="form-control date" id="trns_date" placeholder="dd-mm-yyyy" ></div><div class="col-md-1"><label>Remove</label><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div>';
      
      objTo.appendChild(divtest)
  }
     function remove_education_fields(rid) {
       $('.removeclass'+rid).remove();
     }

  $('#myonoffswitch1').change(function(){
    var chkd=$('#myonoffswitch1:checked').val();
    if(chkd=='yes')
    {
      $('#emiMonth').html('<label>Months</label><input type="number" value="" name="emi_month" class="form-control" placeholder="No. of Months" required min="1" max="156">');
    }else
    {
      $('#emiMonth').html('');
    }
  });



  </script>

  <script type="text/javascript">
    $('.chqnum').keypress(function(event){
               console.log(event.which);
           if(event.which != 6 && isNaN(String.fromCharCode(event.which))){
               event.preventDefault();
           }});
  </script>


 

