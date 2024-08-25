<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=$page['page']='Parchase Invoice ';?> | <?=$this->siteInfo['name'];?></title>
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
                                    <span>Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span>
                                    <p>Parchase Invoice </p>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Splier Name</th><td style="text-transform: uppercase;"> <b><?= $suplierdtl['name'] ?> </b></td>
                                  
                                  <td>
                                   Invoice No : <b><?=$invoice['invoiceno'];?></b>
                                  </td>
                                  <td>
                                   Parchase Date <b> <?=$invoice['current'];?></b>
                                  </td>
                                </tr>                            
                                <tr>
                                  <th>Supplier Email Id : </th><td>  <?= $suplierdtl['email'] ?>
                                   </td><th>Mobile : </th><td> <b> <?= $suplierdtl['mobile'] ?></b></td>
                                </tr>
                                <tr>
                                  <th>Address : </th>
                                  <td colspan="3"><?= $suplierdtl['address']?></td>
                                </tr>
                                  
                              </tbody>
                            </table><br>
                            <b>Payment Description</b>
                            
                           <table class="table table-bordered" style="width: 100%;" border="1" cellpadding="5">
                              <tbody>
                                <tr class="danger">
                                  <th>Product Name</th>
                                  <th>Mrp</th>
                                  <th>IGST</th>
                                  <th>SGST</th>
                                  <th>CGST</th>
                                  <th>Qty</th>
                                  <th>Total Price</th>
                                  <th>Action</th>
                                </tr>
                                <?php $totalPrice = 0; foreach ($bookingresltd as $key => $bookingreslt)
                                    { ?>

                                  
                                  <tr>
                                   
                                    <td>
                                        <?php $result=$this->dbm->getWhere('product',['id'=>$bookingreslt['product_id']]); ?>
                                        <?=$result['name'];?>
                                    </td>
                                    <td><?= $bookingreslt['product_price'] ?></td>
                                    <td><?= $bookingreslt['product_igst'] ?></td>
                                    <td><?= $bookingreslt['product_sgst'] ?></td>
                                    <td><?= $bookingreslt['product_cgst'] ?></td>
                                    <td><?= $bookingreslt['product_qty'] ?></td>
                                    </td>
                                     <td><?= $bookingreslt['total_price'] ?>
                                        <?php $totalPrice = $totalPrice+$bookingreslt['total_price']; ?>
                                     </td>
                                       <td>
                                           
                                           <a title="Edit" href="<?=base_url('auth/invoceSlipedit/'.$suplierdtl['supplier_id'].'/'.$bookingreslt['id']);?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                                     </td>
                                    </td>
                                   
                                  </tr>
                                 
                                   <?php } ?>
                                    <tr>
                                     <td colspan="6" style="text-align: right; color:red" >Total Amount</td>
                                     <td><?=$totalPrice;?></td>
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


