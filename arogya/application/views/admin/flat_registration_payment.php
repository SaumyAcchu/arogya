<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Payment Option';?> | <?=$this->siteInfo['name'];?></title>
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
              <?php $building=$this->db->get_where('project',array('id'=>$get_data['building_id']))->row_array();
              $flat=$this->db->get_where('flat',array('id'=>$get_data['flat_id']))->row_array(); ?>
              <b><span class="text-success">Registration No.  : </span><?=$get_data['registration'];?> <span class="text-success"> & Passwerd is :</span><span class="text-primary"> <?=$get_data['password'];?> </span></b> 
              <table class="table table-hover table-bordered table-striped">
                <tbody>
                 <tr>
                    <th>Property Type</th><td style="color: blue;"><?=$building['name'];?></td><th>City</th><td><?=$building['address']; ?></td><th>Block Name</th><td><?=$flat['block_name']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="color: red;">Applicant Details</td>
                  </tr>
                  <tr>
                    <th>Name</th><td><?=$get_data['name'];?>&nbsp;<?=$get_data['m_name'];?>&nbsp;<?=$get_data['l_name'];?></td><th>Father/Husband</th><td><?=$get_data['f_name'];?></td><th>Mobile</th><td><?=$get_data['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Registration Date</th><td><?=$get_data['registration_date'];?></td><th>City</th><td><?=$get_data['city'];?></td><th>State</th><td><?=$get_data['state'];?></td>
                  </tr>
                  <tr>
                    <th>PIN</th><td><?=$get_data['pin'];?></td><th>Address</th><td colspan="3"><?=$get_data['address'];?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="color: red;">Plot Details</td>
                  </tr>
                  <tr>
                    <th>Plot No.</th><td><?=$flat['flat_num']; ?></td>
                    <th>Area</th><td><?=$flat['area']; ?>Sq.ft</td>
                    <th>Rate</th><td><?=$flat['rate']; ?>/Sq.ft</td>
                  </tr>
                  <?php if($flat['additional_amount1']!='')
                  { ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail1'];?></td><td><?=$flat['additional_amount1'];?></td>
                  </tr>
                  <?php } ?>
                  <?php if($flat['additional_amount2']!='')
                  { ?>
                  <tr>
                    <td colspan="5" style="text-align: right;"><?=$flat['additional_detail2'];?></td><td><?=$flat['additional_amount2'];?></td>
                  </tr>
                  <?php } ?>
                 <tr  class="danger text-danger">
                   <th colspan="5" style="text-align: right;">Grand Total</th><td style="color: red;"><?=$flat['total'];?>/-</td>
                 </tr>
                 <tr class="info text-info">
                   <th colspan="5" style="text-align: right;">Payed Booking Amount</th><td><?=$get_data['booking_amount'];?>/-</td>
                 </tr>
                 <tr class="success text-success">
                   <th colspan="5" style="text-align: right;">Payable Amount</th><td><b><?= $payforInstal = (intval($flat['total'])-intval($get_data['booking_amount']));?>/-</b></td>
                 </tr>
                </tbody>
              </table>
              <?=form_open('real1/flatReg/pay',['class'=>'form-horizontal well']); ?>
                  <input type="hidden" name="registration" value="<?=$get_data['registration'];?>">
                  <input type="hidden" name="flat_user_id" value="<?=$get_data['id'];?>">
                  <input type="hidden" name="flat_id" value="<?=$get_data['flat_id'];?>">
                  <input type="hidden" name="building_id" value="<?=$get_data['building_id'];?>">
                  <input type="hidden" name="grand_total" value="<?=$payforInstal;?>">
                  <input type="hidden" name="sponcer" value="<?=$get_data['introducer'];?>">
                <div class="form-group">
                  <div class="col-md-4">
                    <label>Payment Received Date</label>
                    <span id="datepairExample">
                      <input type="text" value="<?= set_value('pay_date',date('d-m-Y')); ?>" name="pay_date" class="form-control date" id="pay_date" placeholder="dd-mm-yyyy" required>
                    </span>
                  </div>
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
                  <div class="col-md-2">
                    <label> EMI Mode</label>
                    <div class="onoffswitch1">
                      <input type="checkbox" value="yes" name="emi" class="onoffswitch1-checkbox" id="myonoffswitch1">
                      <label class="onoffswitch1-label" for="myonoffswitch1">
                          <span class="onoffswitch1-inner"></span>
                          <span class="onoffswitch1-switch"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-2" id="emiMonth">
                    
                  </div>
                </div><span id="csh">
                <span id="cash" style="display: none;">
                  <div class="form-group">
                    <div class="col-md-4">
                      <label>Down Payment</label>
                      <input type="number" class="form-control" placeholder="Enter Amount in Rs." name="pay_amount_down" id="pay_amount" value="">
                      <p style="color: red;" id="errAmt"></p>
                    </div>
                  </div>
                </span></span><span id="chk">
                <span id="cheque" style="display: none;">
                <div class="form-group">
                    <div class="col-md-4">
                      <label>Cheque Number</label>
                      <input type="text" maxlength="6" id="cheque_num" name="cheque_num[]" placeholder="Enter Cheque Number" value="" class="form-control chqnum">
                      <p style="color: red;" id="errChknm"></p>
                    </div>
                    
                    <div class="col-md-4">
                      <label>Bank Detail</label>
                      <input type="text" id="cheque_num" name="cheque_detail[]" placeholder="Enter Bank Detail" value="" class="form-control">
                      <p style="color: red;" id=""></p>
                    </div>
                    <div class="col-md-3">
                      <label>Down Payment</label>
                      <input type="number" class="form-control" placeholder="Enter Amount in Rs." name="pay_amount[]" id="pay_amount" value="">
                      <p style="color: red;" id="errAmt"></p>
                    </div>
                    <div class="col-md-4">
                      <label>Cheque Dated</label>
                      <span id="chkpairExample">
                        <input type="text" value="" name="trns_date[]" class="form-control date" id="trns_date" placeholder="dd-mm-yyyy" >
                      </span>
                    </div>

                    <div class="col-md-1">
                      <label>Add</label>
                      <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
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
                      <div class="col-md-3">
                        <label>Down Payment</label>
                        <input type="number" class="form-control" placeholder="Enter Amount in Rs." name="rtgs_pay_amount" id="rtgs_pay_amount" value="">
                        <p style="color: red;" id="errAmt"></p>
                      </div>
                  </div>
                  </span>
                </span>


                <div class="form-group">
                    <div class="col-md-4">
                      <label>PLC Charg</label>
                      <input type="number" class="form-control" placeholder="PLC Charg in Rs. " name="plc" id="" value="">
                    </div>

                    <div class="col-md-4">
                      <label>Development Charg</label>
                      <input type="number" class="form-control" placeholder="Development Charg in Rs." name="dev_charg" id="" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                      <label>Discount</label>
                      <input type="number" class="form-control" placeholder="Any Discount in Rs." name="discount" id="" value="">
                    </div>
               
                    <div class="col-md-4">
                      <label>Spacal Discount</label>
                      <input type="number" class="form-control" placeholder="Any Spacal Discount in Rs." name="specialdiscount" id="" value="">
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label"></label>
                  <div class="col-md-4">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="Submit" id="btnSubmit" class="btn btn-primary">Submit</button>
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
    $('#trnsdateExample .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });
    $('#chkpairExample .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });
    $('#chkpair1Example .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });

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

    /*$('#btnSubmit').click( function(){
      var mode=$('select[name="pay_mode"] option:selected').val();
      if($.trim(mode)=='')
      {
        $('#errMode').html('This Field must be required');
        return false;
      }
      if(mode=='Cheque')
      {
        var chknm=$('#cheque_num').val();
        if($.trim(chknm)=='')
        {
          $('#errChknm').html('This Field must be required');
          return false;
        }
      }
      var amt=$('#pay_amount').val();
      if($.trim(amt)=='')
      {
        $('#errAmt').html('This Field must be required');
        return false;
      }
    });*/
    
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

  <style type="text/css">
    .onoffswitch {
      position: relative; width: 90px;
      -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
  }

  .onoffswitch-checkbox {
      display: none;
  }

  .onoffswitch-label {
      display: block; overflow: hidden; cursor: pointer;
      border: 2px solid #999999; border-radius: 20px;
  }

  .onoffswitch-inner {
      display: block; width: 200%; margin-left: -100%;
      -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
      -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
  }

  .onoffswitch-inner:before, .onoffswitch-inner:after {
      display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
      font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
      -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
  }

  .onoffswitch-inner:before {
      content: "YES";
      padding-left: 10px;
      background-color: #2FCCFF; color: #FFFFFF;
  }

  .onoffswitch-inner:after {
      content: "NO";
      padding-right: 10px;
      background-color: #EEEEEE; color: #999999;
      text-align: right;
  }

  .onoffswitch-switch {
      display: block; width: 18px; margin: 6px;
      background: #FFFFFF;
      border: 2px solid #999999; border-radius: 20px;
      position: absolute; top: 0; bottom: 0; right: 56px;
      -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
      -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s; 
  }

  .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
      margin-left: 0;
  }

  .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
      right: 0px; 
  }


   .onoffswitch1 {
      position: relative; width: 130px;
      -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
  }

  .onoffswitch1-checkbox {
      display: none;
  }

  .onoffswitch1-label {
      display: block; overflow: hidden; cursor: pointer;
      border: 2px solid #999999; border-radius: 30px;
  }

  .onoffswitch1-inner {
      display: block; width: 200%; margin-left: -100%;
      -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
      -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
  }

  .onoffswitch1-inner:before, .onoffswitch1-inner:after {
      display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
      font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
      -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
      border-radius: 30px;
      box-shadow: 0px 15px 0px rgba(0,0,0,0.08) inset;
  }

  .onoffswitch1-inner:before {
      content: "Yes";
      padding-left: 10px;
      background-color: darkgreen; color: #FFFFFF;
      border-radius: 30px 0 0 30px;
  }

  .onoffswitch1-inner:after {
      content: "No";
      padding-right: 10px;
      background-color: darkred; color: #fff;
      text-align: right;
      border-radius: 0 30px 30px 0;
  }

  .onoffswitch1-switch {
      display: block; width: 90px; margin: 0px;
      background: #FFFFFF;
      border: 2px solid #999999; border-radius: 30px;
      position: absolute; top: 0; bottom: 0; right: 40px;
      -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
      -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s; 
      background-image: -moz-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 80%); 
      background-image: -webkit-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 80%); 
      background-image: -o-linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 80%); 
      background-image: linear-gradient(center top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 80%);
      box-shadow: 0 1px 1px white inset;
  }

  .onoffswitch1-checkbox:checked + .onoffswitch1-label .onoffswitch1-inner {
      margin-left: 0;
  }

  .onoffswitch1-checkbox:checked + .onoffswitch1-label .onoffswitch1-switch {
      right: 0px; 
  }



  .cmn-toggle 
  {
    position: absolute;
    margin-left: -9999px;
    visibility: hidden;
  }

  .cmn-toggle + label 
  {
    display: block;
    position: relative;
    cursor: pointer;
    outline: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  input.cmn-toggle-round-flat + label 
  {
    padding: 2px;
    width: 75px;
    height: 30px;
    background-color: #dddddd;
    -webkit-border-radius: 60px;
    -moz-border-radius: 60px;
    -ms-border-radius: 60px;
    -o-border-radius: 60px;
    border-radius: 60px;
    -webkit-transition: background 0.4s;
    -moz-transition: background 0.4s;
    -o-transition: background 0.4s;
    transition: background 0.4s;
  }

  input.cmn-toggle-round-flat + label:before, input.cmn-toggle-round-flat + label:after 
  {
    display: block;
    position: absolute;
    content: "";
  }

  input.cmn-toggle-round-flat + label:before 
  {
    top: 2px;
    left: 2px;
    bottom: 2px;
    right: 2px;
    background-color: #fff;
    -webkit-border-radius: 60px;
    -moz-border-radius: 60px;
    -ms-border-radius: 60px;
    -o-border-radius: 60px;
    border-radius: 60px;
    -webkit-transition: background 0.4s;
    -moz-transition: background 0.4s;
    -o-transition: background 0.4s;
    transition: background 0.4s;
  }

  input.cmn-toggle-round-flat + label:after 
  {
    top: 4px;
    left: 4px;
    bottom: 4px;
    width: 22px;
    background-color: #dddddd;
    -webkit-border-radius: 52px;
    -moz-border-radius: 52px;
    -ms-border-radius: 52px;
    -o-border-radius: 52px;
    border-radius: 52px;
    -webkit-transition: margin 0.4s, background 0.4s;
    -moz-transition: margin 0.4s, background 0.4s;
    -o-transition: margin 0.4s, background 0.4s;
    transition: margin 0.4s, background 0.4s;
  }

  input.cmn-toggle-round-flat:checked + label 
  {
    background-color: #27A1CA;
  }

  input.cmn-toggle-round-flat:checked + label:after 
  {
    margin-left: 45px;
    background-color: #27A1CA;
  }

  div.switch5 { clear: both; margin: 0px 0px; }
  div.switch5 > input.switch:empty { margin-left: -999px; }
  div.switch5 > input.switch:empty ~ label { position: relative; float: left; line-height: 1.6em; text-indent: 4em; margin: 0.2em 0px; cursor: pointer; -moz-user-select: none; }
  div.switch5 > input.switch:empty ~ label:before, input.switch:empty ~ label:after { position: absolute; display: block; top: 0px; bottom: 0px; left: 0px; content: "off"; width: 3.6em; height: 1.5em; text-indent: 2.4em; color: rgb(153, 0, 0); background-color: rgb(204, 51, 51); border-radius: 0.3em; box-shadow: 0px 0.2em 0px rgba(0, 0, 0, 0.3) inset; }
  div.switch5 > input.switch:empty ~ label:after { content: " "; width: 1.4em; height: 1.5em; top: 0.1em; bottom: 0.1em; text-align: center; text-indent: 0px; margin-left: 0.1em; color: rgb(255, 136, 136); background-color: rgb(255, 255, 255); border-radius: 0.15em; box-shadow: 0px -0.2em 0px rgba(0, 0, 0, 0.2) inset; transition: all 100ms ease-in 0s; }
  div.switch5 > input.switch:checked ~ label:before { content: "on"; text-indent: 0.5em; color: rgb(102, 255, 102); background-color: rgb(51, 153, 51); }
  div.switch5 > input.switch:checked ~ label:after { margin-left: 2.1em; color: rgb(102, 204, 102); }
  div.switch5 > input.switch:focus ~ label { color: rgb(0, 0, 0); }
  div.switch5 > input.switch:focus ~ label:before { box-shadow: 0px 0px 0px 3px rgb(153, 153, 153); }







  .switch6 {  max-width: 17em;  margin: 0 auto; }
  .switch6-light > span, .switch-toggle > span {  color: #000000; }
  .switch6-light span span, .switch6-light label, .switch-toggle span span, .switch-toggle label {  color: #2b2b2b; }

  .switch-toggle a, 
  .switch6-light span span { display: none; }

  .switch6-light { display: block; height: 30px; position: relative; overflow: visible; padding: 0px; margin-left:0px; }
  .switch6-light * { box-sizing: border-box; }
  .switch6-light a { display: block; transition: all 0.3s ease-out 0s; }

  .switch6-light label, 
  .switch6-light > span { line-height: 30px; vertical-align: middle;}

  .switch6-light label {font-weight: 700; margin-bottom: px; max-width: 100%;}

  .switch6-light input:focus ~ a, .switch6-light input:focus + label { outline: 1px dotted rgb(136, 136, 136); }
  .switch6-light input { position: absolute; opacity: 0; z-index: 5; }
  .switch6-light input:checked ~ a { right: 0%; }
  .switch6-light > span { position: absolute; left: -100px; width: 100%; margin: 0px; padding-right: 100px; text-align: left; }
  .switch6-light > span span { position: absolute; top: 0px; left: 0px; z-index: 5; display: block; width: 50%; margin-left: 100px; text-align: center; }
  .switch6-light > span span:last-child { left: 50%; }
  .switch6-light a { position: absolute; right: 50%; top: 0px; z-index: 4; display: block; width: 50%; height: 100%; padding: 0px; }





  </style>
</body>

</html>
