<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Add Supplier';?> | <?=$this->siteInfo['name'];?></title>
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
                                    <p class="panel-title">Supplier Management</p>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <?php 

                                        $cat = $this->dbm->globalSelect('product_category');
                                        if(isset($get_data)) { ?>
                                        <center>
                                            <h4>Update Supplier Type</h4>
                                        </center>
                                        <?=form_open_multipart('auth/updateDataWithFile/supplier/'.$get_data['id'].'/add-supplier'); ?>
                                        <div class="col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Supplier Name</label>
                                                <input type="text" value="<?= $get_data['name'] ?>" name="name" id='name' class="form-control" required>
                                                <b style="color: red;" id="errName"></b>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input type="number" value="<?= $get_data['mobile'] ?>" name="mobile" id='mobile' class="form-control" required>
                                                <b style="color: red;" id="errMrp"></b>
                                            </div>
                                            </div>
                                            <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" value="<?= $get_data['email'] ?>" name="email" id='email' class="form-control" required>
                                                <b style="color: red;" id="erremail"></b>
                                            </div>
                                            <div class="form-group">
                                                <label>Registration Date</label>
                                                <span id="datepairExample">
                                                <input type="text" value="<?= $get_data['reg_date'] ?>" name="reg_date" class="form-control date" id="reg_date" placeholder="dd-mm-yyyy" required>
                                                </span>
                                            </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" value="<?= $get_data['address'] ?>" name="address" id='address' class="form-control" required>
                                                    <b style="color: red;" id="errAddress"></b>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account Number</label>
                                                   <input type="number" value="<?= $get_data['account_number'] ?>" name="account_number" id='account_number' class="form-control" required>
                                                    <b style="color: red;" id="errAccount"></b>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">                                              
                                                <div class="form-group">
                                                    <label>Bank Name</label>
                                                    <input type="text" value="<?= $get_data['bank_name'] ?>" name="bank_name" id='bank_name' class="form-control" required>
                                                    <b style="color: red;" id="errbank_name"></b>
                                                </div>
                                            </div>

                                             <div class="col-lg-4">                                              
                                                <div class="form-group">
                                                    <label>Account Name</label>
                                                    <input type="text" value="<?= $get_data['account_number'] ?>" name="account_name" id='account_name' class="form-control" required>
                                                    <b style="color: red;" id="erraccount_name"></b>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">                                                
                                                <div class="form-group">
                                                    <label>Branch Name</label>
                                                    <input type="text" value="<?= $get_data['branch_name'] ?>" name="branch_name" id='branch_name' class="form-control" required>
                                                    <b style="color: red;" id="errbatch_no"></b>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">                                                
                                               <div class="form-group">
                                               <label>Ifsc</label>
                                                    <input type="number" value="<?= $get_data['ifsc'] ?>" name="ifsc" id='ifsc' class="form-control" required>
                                                    <b style="color: red;" id="errifsc"></b>
                                            </div>
                                            </div>
                                            <div class="col-lg-4">                                                
                                               <div class="form-group">
                                               <label>Licence No.</label>
                                                    <input type="text" value="<?= $get_data['licence_no'] ?>" name="licence_no" id='licence_no' class="form-control">
                                                    <b style="color: red;" id="errlicence_no"></b>
                                            </div>
                                            </div>
                                            <div class="col-lg-4">                                                
                                               <div class="form-group">
                                               <label>GST No</label>
                                                    <input type="text" value="<?= $get_data['gst_no'] ?>" name="gst_no" id='gst_no' class="form-control" required>
                                                    <b style="color: red;" id="errifsc"></b>
                                            </div>
                                            </div>   
                                            <div class="col-lg-4">                                      
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning">Update</button> <a href="<?=base_url('auth/explore/add-supplier'); ?>" class="btn btn-info">Add New</a>
                                            </div>
                                            </div>         
                                         </div>
                                        </form>
                                        <?php } else { ?>
                                        <center>
                                            <h4>Add New Supplier</h4>
                                        </center>
                                        <?=form_open_multipart('auth/addsupplier'); ?>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Supplier Name</label>
                                            <input type="text" name="name" id='name' class="form-control" required>
                                            <b style="color: red;" id="errName"></b>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="number" name="mobile" id='mobile' class="form-control" required>
                                            <b style="color: red;" id="errMrp"></b>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" id='email' class="form-control" required>
                                            <b style="color: red;" id="erremail"></b>
                                        </div>
                                        <div class="form-group">
                                            <label>Registration Date</label>
                                            <span id="datepairExample">
                                            <input type="text" value="<?= date('d-m-Y'); ?>" name="reg_date" class="form-control date" id="reg_date" placeholder="dd-mm-yyyy" required>
                                            </span>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" id='address' class="form-control" required>
                                                <b style="color: red;" id="errAddress"></b>
                                            </div>
                                            <div class="form-group">
                                                <label>Account Number</label>
                                               <input type="number" name="account_number" id='account_number' class="form-control" required>
                                                <b style="color: red;" id="errAccount"></b>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">                                              
                                            <div class="form-group">
                                                <label>Bank Name</label>
                                                <input type="text" name="bank_name" id='bank_name' class="form-control" required>
                                                <b style="color: red;" id="errbank_name"></b>
                                            </div>
                                        </div>

                                         <div class="col-lg-4">                                              
                                            <div class="form-group">
                                                <label>Account Name</label>
                                                <input type="text" name="account_name" id='account_name' class="form-control" required>
                                                <b style="color: red;" id="erraccount_name"></b>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">                                                
                                            <div class="form-group">
                                                <label>Branch Name</label>
                                                <input type="text" name="branch_name" id='branch_name' class="form-control" required>
                                                <b style="color: red;" id="errbatch_no"></b>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">                                                
                                           <div class="form-group">
                                           <label>Ifsc</label>
                                                <input type="number" name="ifsc" id='ifsc' class="form-control" required>
                                                <b style="color: red;" id="errifsc"></b>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">                                                
                                           <div class="form-group">
                                           <label>Licence No</label>
                                                <input type="text" name="licence_no" id='licence_no' class="form-control" >
                                                <b style="color: red;" id="errlicence_no"></b>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">                                                
                                           <div class="form-group">
                                           <label>GST No</label>
                                                <input type="text" name="gst_no" id='gst_no' class="form-control">
                                                <b style="color: red;" id="errgst_no"></b>
                                        </div>
                                        </div>
                                       

                                        <div class="col-lg-4">
                                            
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" class="btn btn-primary">Add Supplier</button>
                                        </div>
                                        </div>
                                            
                                        </form>
                                        <?php } ?>
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
                                            <th>Sl.</th>
                                            <th>Supplier Name</th>
                                            <th>Supplier Id</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $spdata = $this->dbm->globalSelect('supplier');
                                           // echo "<pre>"; print_r($data); die();
                                        if(isset($spdata)) { $i=1;
                                            foreach($spdata as $list) { 
                                                ?>
                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$list['name'];?></td>
                                            <td><?=$list['supplier_id'];?></td>
                                            <td><?=$list['mobile'];?></td>
                                            <td><?=$list['email'];?></td>
                                            <td>
                                               <div class="btn-group">
                                                   <a title="Edit" href="<?=base_url('auth/getData/supplier/'.$list['id'].'/add-supplier');?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                                                   <a  title="Delete" href="<?=base_url('auth/deleteData/product/'.$list['id'].'/add-product');?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                                   
                                               </div>
                                            </td>
                                        </tr>
                                        <?php $i++; } } else { ?>
                                        <tr>
                                            <td colspan="5">No Supplier created yet</td>
                                        </tr>
                                        <?php } ?>
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
