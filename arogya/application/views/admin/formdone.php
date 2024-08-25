<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$qage['page']='Booking Successfully';?> | <?=$this->siteInfo['name'];?></title>
    <?php $this->load->view('include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
      <?php $this->load->view('include/topbar'); ?>
  <!--===========top nav end===========-->
    <div class="wrapper" id="wrapper">
      <div class="left-container" id="left-container">
        <!--========== Sidebar Start =============-->
          <?php $this->load->view('include/sidebar',$qage); ?>
        <!--========== Sidebar End ===============-->
      </div>
      <div class="right-container" id="right-container">
          <div class="container-fluid">
            <?php $this->load->view('include/page-top',$qage); ?>
            <!--//===============Main Container Start=============//-->
            <div class="container-fluid padding-top main-container">
           
  <!-- ///=====================All Contents Start Here============= //-->
            <div class="col-sm-12" id="myDiv">
             
          
              <b><span class="text-success">SR No.  : </span><?=$q['sr'];?> <span class="text-success"> & Registration Date is :</span><span class="text-primary"> <?=$q['date'];?> </span></b> 
              <table class="table table-hover table-bordered table-striped" style="width: 100%;height:50%"  border="1">
                <thead>
                  <tr><td><center>
                        <a href="#"> <img class="logo-default" alt="logo" src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" style="height: 102px;"> </a>
                        </center></td>
                    <td class="txtcenter" colspan="5">
                        <center>
                      <h3 style="color: red;">PRAYAS INFRA ESTATE</h3>
                     
                      <b style="color: red;">Register Office:&nbsp 301 ,3rd Floor Eldeco Corporate Tower Vibhuti Khand, Gomati Nagar, Lucknow-226010</b><br>
                      <!--<span style="color: red;">Email : JAYP10006@GMAIL.COM, Website : ..</span>-->
                      <!--<p>Booking Invoice</p>-->
                      </center>
                    </td></tr>
                </thead>
                <tbody>
                  <tr>
                    <center>
                    <th>New Booking</th><td style="color: blue;"><?=$q['newBooking'];?></td><th>Installment</th><td><?=$q['installment']; ?></td></center>
                  </tr>
                  <tr>
                    <td colspan="6" style="color: red;">Applicant Details</td>
                  </tr>
                  <tr>
                    <th>Customer Name</th><td><?=$q['customerName'];?></td><th>Father/Husband</th><td><?=$q['fname'];?></td>
                  </tr>
                  <tr>
                    <th>Mobile</th><td><?=$q['mobileNumber'];?></td>
                    <th>Registration Date</th><td><?=$q['date'];?></td>
                  </tr>
                  <tr>
                    <th>City</th><td><?=$q['address'];?></td>
                    <th>PAN</th><td><?=$q['panCard'];?></td>
                  </tr>
                  <tr><th>Email</th><td colspan="3"><?=$q['email'];?></td></tr>
                  <tr>
                    <td colspan="6" style="color: red;">Plot Details</td>
                  </tr>
                  <tr>
                    <th>Project Name</th><td><?=$q['projectName'];?></td><th>Amount</th><td><?=$q['amount'];?></td>
                  </tr>
                  <tr>
                    <th>Bank Name</th><td><?=$q['bankName'];?></td>
                    <th>Payment Mode</th><td><?=$q['paymentMode'];?></td>
                  </tr>
                  <tr>
                    <th>Cheque No.</th><td><?=$q['chequeNo'];?></td>
                    <th>Date Of Transaction</th><td><?=$q['transactionDate'];?></td>
                  </tr>
                  <tr>
                    <th>Associate Name</th><td><?=$q['associateName'];?></td>
                    <th>Plot No.</th><td><?=$q['plotNumber']; ?></td>
                   
                  </tr>
                 <tr> <th>Area</th><td><?=$q['size']; ?>Sq.ft</td>
                    <th>Rate</th><td><?=$q['rate']; ?>/Sq.ft</td></tr>
                 
                  
                
                </tbody>
              </table>
              <br><br><br><br><br><br>
              <b style="float: right;">________________________<br>Authorised Sign with Stamp</b>
              <br><br><br><br><br><br>
              <center><p>This is a Computer Generated Invoice</p></center>
            </div> 
            <div class="col-sm-12">
              <button class="btn btn-primary pull-left" id="printId"> Print <i class="fa fa-print"></i></button>
          
              <hr>
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
    $("#printId").click(function(){
          var printContents = $("#myDiv").html();
           var frame1 = $('<iframe />');
          frame1[0].name = "frame1";
          frame1.css({ "position": "absolute", "top": "-1000000px" });
          $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
          frameDoc.document.open();
        frameDoc.document.write('<html><head><link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/mystyle.css');?>" /></head><body onload="window.print()">' + printContents + '</body></html>');
        frameDoc.document.close();
      });                          
  </script>
  
</body>

</html>
