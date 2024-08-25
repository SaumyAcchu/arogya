<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Panding Booking Edit';?> | <?=$this->siteInfo['name'];?></title>
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
                        <!-- ///Flash Message End/// -->
                        <!-- ///=====================All Contents Start Here============= //-->
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p class="panel-title">Panding Booking Edit</p>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                       <table class="table table-bordered" cellpadding="4" style="width: 100%;" border="1">
                              <tbody>
                                <tr rowspan="2">
                                  <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="120" width="120"></center></th>
                                  <td class="txtcenter" colspan="5">
                                    <h3><?=$this->siteInfo['name'];?></h3>
                                    <b><?=$this->siteInfo['address'];?></b><br>
                                    <span>Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span>
                                    <p>Booking Slip</p>
                                  </td>

                                </tr>
                                <tr>
                                  <th>Name</th><td style="text-transform: uppercase;"> <b><?= $userdtl['name'] ?> </b></td>
                                  <td>Booking No.  <b>Panding Booking</b>
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
                                  <td>Total CV : </td>
                                  <td><b><?= $bookingreslt['total_cv'] ?></b></td>
                                </tr>
                                  
                              </tbody>
                            </table>
                                       
                                    
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid padding-top main-container">
                            <div class="col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <p class="panel-title">Supplier Management</p>
                                    </div>
                           <div class="panel-body">

                                <center>
                                    <h4>Supplier List</h4>
                                </center>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Mrp</th>
                                            <th>Qty </th>
                                            <th>CV</th>
                                            <th>Total CV</th>
                                            <th>Total DP </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php foreach ($bookingDtl as $key => $value): 

                                  $product = $this->dbm->getWhere('product',['id'=>$value['product_id']]);
                                  ?>
                                        <tr>
                                    <td><?= $product['name']; ?></td>
                                    <td><?= $value['mrp'] ?> &#8377; </td>
                                    <td><?= $value['qty'] ?></td>
                                    <td><?= $value['cv'] ?></td>
                                    <td><?= $value['total_cv'] ?></td>
                                    <td> <b><?= $value['totalamount'] ?> &#8377;</b></td>
                                            <td>
                                               <div class="btn-group">
                                                   <a title="Edit" href="<?=base_url('auth/pandingBooking_Slip_edit1/'.$bookingreslt['id'].'/'.$value['id']);?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                                             
                                                   
                                               </div>
                                            </td>
                                        </tr>
                                   <?php endforeach ?>
                                        <tr class="success">
                                  <th colspan="5">Total</th><th><?= $bookingreslt['total_price'] ?> /- &#8377; </th>
                                </tr>
                                     
                                    </tbody>
                                </table>
                                 </div>
                            </div>
                        </div>
                    </div>
                        <!-- All Content End here -->
                        <!-- Bootstrap Modal fo confirmation -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" style="color: red;"></span></button>
                                        <h4 class="modal-title">Please Cofirm Your Password</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color: red;" id="msg"></p>
                                        <div class="input-group">
                                            <input type="password" id="password" autofocus="autofocus" class="form-control" style="margin-bottom: 5px;" placeholder="Enter Your Password" required>
                                            <input type="hidden" name="action" value="" id="action">
                                            <span class="input-group-btn">
                                            <button class="btn btn-primary" id="conPass" type="button">Go!</button>
                                            </span>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
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
      var name=$('#name').val();
      if($.trim(name)=='')
      {
        $('#errName').html('This Field must be required');
        return false;
      }
      var add=$('#address').val();
      if($.trim(add)=='')
      {
        $('#errAdd').html('This Field must be required');
        return false;
      }
    });
    function conDel(a)
    {
      $('#action').val(a);
      $('#myModal').modal('show');
      $('#msg').html(' ');
      var pass=$('#password').val("");
      return false;
    }
    $('#conPass').click(function()
      {
        var pass=$('#password').val();
        var act=$('#action').val();
        var base="<?=base_url();?>";
        $.ajax({
          url:"<?=base_url('real1/passwordConfirmation');?>",
          data:{password:pass,action:act},
          type:'post',
          success:function(data)
          {
            if(data==1)
            {
              location.href=base+act;
            }else
            {
              var sms='Password not Match.';
              $('#msg').html(sms);
            }
          }
        });
      });
</script>


 <script type="text/javascript">
  $('#qty').keypress(function(event){
             console.log(event.which);
         if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
             event.preventDefault();
         }});
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
    box-shadow: inset 0px 0px 15px 5px #4F7C92;
    background: aliceblue;
    border-radius: 20px;
    margin-top: 10px;
    margin-bottom: 10px;
    }
</style>
</html>



