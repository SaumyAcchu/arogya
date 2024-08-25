<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=$page['page']='Panding Booking Slip';?> | <?=$this->siteInfo['name'];?></title>
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

              <div class="col-sm-12">
                <button class="btn btn-primary pull-right" id="printId"> Print <i class="fa fa-print"></i></button>
                <hr>
              </div>

              <div class="col-sm-12" id="myDiv">
                            <table class="table table-bordered" cellpadding="4" style="width: 100%;" border="1">
                              <tbody>
                                <tr rowspan="2">
                                  <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="120" width="120"></center></th>
                                  <td class="txtcenter" colspan="5">
                                    <h3><?=$this->siteInfo['name'];?></h3>
                                    <b><?=$this->siteInfo['address'];?></b><br>
                                    <span>Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span><br>
                                    <b>GST Number : <?=$this->siteInfo['gstNo'];?></b>

                                    <p>Booking Slip</p>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Name</th><td style="text-transform: uppercase;"> <b><?= $userdtl['name'] ?> </b></td>
                                  <td>Booking No.  <b>Panding</b>
                                  </td>
                                  <td>
                                   Booking Dated : <b><?= $bookingreslt['date'] ?></b>
                                  </td>
                                </tr>
                               
                                <tr>
                                  <th>Email Id : </th><td>  <?= $userdtl['email'] ?>
                                   </td><th>Mobile : </th><td> <b> <?= $userdtl['mobile'] ?></b></td>
                                </tr>
                                <tr>
                                  <th>Address : </th>
                                  <td colspan="3"><?= $userdtl['address']?></td>
                                </tr>
                                <tr>
                                  <th> Total Price :</th><td><b><?= $bookingreslt['total_price'] ?></b></td>
                                  <td>Total PV : </td>
                                  <td><b><?= $bookingreslt['total_cv'] ?></b></td>
                                </tr>
                                  
                              </tbody>
                            </table><br>
                            <b>Panding Booking Payment Description</b>
                            
                           <table class="table table-bordered" style="width: 100%;" border="1" cellpadding="5">
                              <tbody>
                                <tr class="danger">
                                  <th>Product Name</th><th>MRP</th><th>BV</th><th>Qty</th><th>PV</th><th>Total PV</th><th>Total BV</th>
                                </tr>
                                <?php foreach ($bookingDtl as $key => $value): 

                                  $product = $this->dbm->getWhere('product',['id'=>$value['product_id']]);
                                  ?>
                                  
                                  <tr>
                                    <td><?= $product['name']; ?></td>
                                    <td><?= $product['mrp'] ?> &#8377; </td>
                                    <td><?= $product['dp'] ?> &#8377; </td>
                                    <td><?= $value['qty'] ?></td>
                                    <td><?= $value['cv'] ?></td>
                                    <td><?= $value['total_cv'] ?></td>
                                    <td> <b><?= $value['totalamount'] ?> &#8377;</b></td>
                                  </tr>

                                <?php endforeach ?>

                                <tr class="success">
                                  <th colspan="6">Total</th><th><?= $bookingreslt['total_price'] ?> /- &#8377; </th>
                                </tr>

                                       
                                
                              </tbody>
                            </table>
                            <br><br><br><br><br><br>
                            <b style="float: right;">________________________<br>Authorised Sign with Stamp</b>
                            <br><br><br><br><br><br>
                            <center><p>This is a Computer Generated Invoice</p></center>
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
</html>


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


