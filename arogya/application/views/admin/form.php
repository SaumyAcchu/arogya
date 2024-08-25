<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Add Flat';?> | <?=$this->siteInfo['name'];?></title>
    <?php $this->load->view('include/header'); ?>
    <style type="text/css">
      .card-default {
    color: #333;
    background: linear-gradient(#fff,#ebebeb) repeat scroll 0 0 transparent;
    font-weight: 600;
    border-radius: 6px;
}

    </style>
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
                    <div class="container-fluid">
      <!--///////////////////////Flash Message///////////////////////// -->
              <!--///////////////////////Flash Message End///////////////////////// -->
        <form action="<?php echo base_url('real1/form_insert');?>" class="form-horizontal" id="cssstyle" onsubmit="return formValidation()" enctype="multipart/form-data" method="post" accept-charset="utf-8">
          
           
            
           
            <legend>Member Detail</legend>
        <div class="form-group">
              <label class="col-lg-2 control-label">SR. No.</label>
              <div class="col-lg-4">
                <input type="text" value="" name="sr" onkeyup="validatephone(this);" class="form-control" placeholder="Enter Sr No." required>
                              </div>
              <label class="col-lg-2 control-label">Registration date</label>
              <div class="col-lg-4">
              <span id="datepairExample">
                <input type="text" value="13-12-2018" name="date" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                </span>
                              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">New Booking</label>
              <div class="col-lg-4">
              <span id="datepairExample">
                <input type="text" value="" name="newBooking" class="form-control "   required>
                </span>
                              </div>
              <label class="col-lg-2 control-label">Installment</label>
              <div class="col-lg-4">
                <span id="datepairExample">
                <input type="text" value="" name="installment" class="form-control  "   required>
                </span>
                              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-2 control-label">Applicants Name</label>
              <div class="col-lg-4">
                <input type="text" value="" name="customerName" class="form-control" placeholder="Enter Applicants Name" required>
                              </div>
              <label class="col-lg-2 control-label">Father/Husband Name</label>
              <div class="col-lg-4">
                <input type="text" value="" name="fname" class="form-control" placeholder="Enter Father/Husband Name" required>
                              </div>
            </div>
            
          
            <div class="form-group">
              <label class="col-lg-2 control-label">Mobile Number</label>
              <div class="col-lg-4">
                <input type="number" value="" class="form-control" name="mobileNumber" id="" placeholder="Mobile Number" required>
                              </div>
              <label class="col-lg-2 control-label">Address</label>
              <div class="col-lg-4">
                <textarea class="form-control" value="" name="address" rows="2" id="address" placeholder="Enter Your Adderss" required></textarea>
                              </div>
            </div>
             <div class="form-group">
              <label class="col-lg-2 control-label">Email</label>
              <div class="col-lg-4">
                <input type="share" value="" class="form-control" name="email" id="" placeholder="No of Shares" required>
                              </div>
               <label class="col-lg-2 control-label">Pan Card</label>
              <div class="col-lg-4">
                <input type="text" value="" class="form-control" name="panCard" id="" placeholder="Enter Your Pan No." required>
                              </div>
            </div>
            


            <legend>Project Detail</legend>
        
           

            <div class="form-group">
              <label class="col-lg-2 control-label">Project Name</label>
              <div class="col-lg-8">
                <input type="text" value="" name="projectName" class="form-control" placeholder="Enter Project Name" required>
                              </div>
              
            </div>
            
          
            <div class="form-group">
              <label class="col-lg-2 control-label">Plot Number</label>
              <div class="col-lg-4">
                <input type="number" value="" class="form-control" name="plotNumber" id="" placeholder="Plot Number" required>
                              </div>
              <label class="col-lg-2 control-label">Size</label>
              <div class="col-lg-4">
                <input type="number" value="" class="form-control" name="size" id="" placeholder="Plot Size" required>
                              </div>
            </div>
             <div class="form-group">
              <label class="col-lg-2 control-label">Rate </label>
              <div class="col-lg-4">
                <input type="share" value="" class="form-control" onkeyup="validatephone(this);" name="rate" id=""  required>
                              </div>
               <label class="col-lg-2 control-label">Amount</label>
              <div class="col-lg-4">
                <input type="text" value="" class="form-control" name="amount" onkeyup="validatephone(this);" id="" placeholder="Enter Amount" required>
                              </div>
            </div>
            
            
            <legend>Bank Detail's</legend>
            <div class="form-group">
              <label class="col-lg-2 control-label">Bank Name</label>
              <div class="col-lg-4">
                <input type="text" value="" name="bankName" class="form-control" placeholder="Enter Bank Name" >
              </div>
              <label class="col-lg-2 control-label">Paymment Mode</label>
              <div class="col-lg-4">
                <select name="paymentMode" >
                    <option value="">Select Payment Mode</option>
                  <option value="Cash">Cash</option>
                  <option value="Cheque/D.D.">Cheque/D.D.</option>
                  <option value="RTGS/NEFT">RTGS/NEFT</option>
                  <option value="Cash Deposit in bank">Cash Deposit in bank</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Cheque/ DD/RTGS/NEFT No.</label>
              <div class="col-lg-4">
                <input type="text" value="" name="chequeNo" class="form-control" >
              </div>
               <label class="col-lg-2 control-label">Date of transaction:-</label>
              <div class="col-lg-4">
              <span id="datepairExample">
                <input type="text" value="13-12-2018" name="transactionDate" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" >
                </span>
                              </div>
            </div>
            <legend>Associate Details</legend>
            <div class="form-group">
              <label class="col-lg-2 control-label">Associate Name</label>
              <div class="col-lg-4">
               <input type="text" accept="image" name="associateName" id="image_path" class="form-control image_path">
               <span id="imageError" style="color: red;"></span>
                            </div>
              <label class="col-lg-2 control-label"></label>
              <div class="col-lg-4">
               <img src="" style="display: none;" id="blah" height="100" width="100">
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
        </form>
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
  <script type="text/javascript"> $(function () {
        $(".date").datepicker({
            autoclose: true,
            todayHighlight: true
        });
    });</script>
    <script>
    function validatephone(phone) 
{
    var maintainplus = '';
    var numval = phone.value
    if ( numval.charAt(0)=='+' )
    {
        var maintainplus = '';
    }
    curphonevar = numval.replace(/[\\A-Za-z!"£$%^&\,*+_={};:'@#~,.Š\/<>?|`¬\]\[]/g,'');
    phone.value = maintainplus + curphonevar;
    var maintainplus = '';
    phone.focus;
}
</script>
    
     <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
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
