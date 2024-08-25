<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Add Product';?> | <?=$this->siteInfo['name'];?></title>
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
                                    <p class="panel-title">Product Management</p>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <?php 

                                        $cat = $this->dbm->globalSelect('product_category');
                                        if(isset($get_data)) { ?>
                                        <center>
                                            <h4>Update Product Type</h4>
                                        </center>
                                        <?=form_open_multipart('auth/updateDataWithFile/product/'.$get_data['id'].'/add-product'); ?>
                                        <div class="col-lg-12">
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name" value="<?=$get_data['name'];?>" id='name' class="form-control" required>
                                            <b style="color: red;" id="errName"></b>
                                        </div>
                                        <div class="form-group">
                                            <label>Entry Date</label>
                                            <span id="datepairExample">
                                            <input type="text" value="<?=$get_data['date'];?>" name="date" class="form-control date" id="registration_date" placeholder="dd-mm-yyyy" required>
                                            </span>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select class="form-control" name="cat_id">
                                                <?php foreach ($cat as $key => $value) { ?>
                                                    <option value="<?=$value['id'];?>" <?=($value['id'] == $get_data['cat_id'])?'selected':'';?>><?=$value['name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                        <label>Salect Image :</label>
                                        <input type='file' name="image" id="imgInp"  class="form-control" value="" />
                                        </div>

                                        </div>


                                        <div class="col-lg-4">
                                            <img id="blah" class="logo-image" src="<?=base_url('uploads/'.$get_data['image']);?>" alt="Product Image" />
                                        </div>

                                        <div class="col-lg-12">
                                        <div class="col-lg-4">                                            
                                            <div class="form-group">
                                                <label>Product Mrp</label>
                                                <input type="text" name="mrp" value="<?=$get_data['mrp'];?>" id='mrp' class="form-control" required>
                                                <b style="color: red;" id="errMrp"></b>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Product BV</label>
                                            <input type="text" name="dp" value="<?=$get_data['dp'];?>" id='dp' class="form-control" required>
                                            <b style="color: red;" id="errDp"></b>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Product PV</label>
                                            <input type="text" name="cv" value="<?=$get_data['cv'];?>" id='cv' class="form-control" required>
                                            <b style="color: red;" id="errDp"></b>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">                                                
                                            <div class="form-group">
                                                <label>Batch Number</label>
                                                <input type="text" value="<?=$get_data['batch_no'];?>" name="batch_no" id='batch_no' class="form-control" required>
                                                <b style="color: red;" id="errbatc_no"></b>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Expiry Date</label>
                                            <span id="datepairExample">
                                            <input type="text" value="<?=$get_data['exp_date'];?>" name="exp_date" class="form-control date" id="exp_date" placeholder="dd-mm-yyyy" required>
                                            </span>
                                        </div>
                                       
                                        </div>
                                        
                                        <div class="col-lg-8">                                      
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning">Update</button> <a href="<?=base_url('auth/explore/add-product'); ?>" class="btn btn-info">Add New</a>
                                        </div>
                                        </div>
                                    </div>
                                        </form>
                                        <?php } else { ?>
                                        <center>
                                            <h4>Add New Product</h4>
                                        </center>
                                        <?=form_open_multipart('auth/addproduct'); ?>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name" id='name' class="form-control" required>
                                            <b style="color: red;" id="errName"></b>
                                        </div>
                                        <div class="form-group">
                                            <label>Product PV</label>
                                            <input type="number" name="cv" id='cv' class="form-control" required>
                                            <b style="color: red;" id="errMrp"></b>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Product Mrp</label>
                                            <input type="number" name="mrp" id='mrp' class="form-control" required>
                                            <b style="color: red;" id="errMrp"></b>
                                        </div>
                                        <div class="form-group">
                                            <label>Entry Date</label>
                                            <span id="datepairExample">
                                            <input type="text" value="<?= date('d-m-Y'); ?>" name="date" class="form-control date" id="registration_date" placeholder="dd-mm-yyyy" required>
                                            </span>
                                        </div>
                                        </div>
                                        <div class="col-lg-4">

                                        <div class="form-group">
                                            <label>Product BV</label>
                                            <input type="number" name="dp" id='dp' class="form-control" required>
                                            <b style="color: red;" id="errMrp"></b>
                                        </div>

                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select class="form-control" name="cat_id">
                                                <?php foreach ($cat as $key => $value) { ?>
                                                    <option value="<?=$value['id'];?>"><?=$value['name'];?></option>
                                                    <!-- <option value="<?=$value['id'];?>" <?=($value['id'] == $updData['site_id'])?'selected':'';?>><?=$value['name'];?></option> -->
                                                <?php } ?>
                                            </select>
                                        </div>

                                       

                                        </div>
                                        <div class="col-lg-4">                                                
                                            <div class="form-group">
                                                <label>Batch Number</label>
                                                <input type="text" name="batch_no" id='batch_no' class="form-control" required>
                                                <b style="color: red;" id="errbatch_no"></b>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">                                                
                                            <label>Expiry Date</label>
                                            <span id="datepairExample">
                                            <input type="text" value="<?= date('d-m-Y'); ?>" name="exp_date" class="form-control date" id="exp_date" placeholder="dd-mm-yyyy" required>
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                            <label>Salect Image :</label>
                                            <input type='file' name="image" id="imgInp"  class="form-control" value="" />
                                            </div>
                                        </div>

                                        

                                        <div class="col-lg-4">
                                            
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Add</button>
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
                                        <p class="panel-title">Product Management</p>
                                    </div>
                           <div class="panel-body">

                                <center>
                                    <h4>Product Type List</h4>
                                </center>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Name</th>
                                           
                                            <th>Category</th>
                                            <th>IMG</th>
                                            <th>Qty</th>
                                            <th>Exp</th>
                                            <th>Create Date</th>
                                            <th>Batch No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $data = $this->dbm->globalSelect('product');
                                           // echo "<pre>"; print_r($data); die();
                                        if(isset($data)) { $i=1;
                                            foreach($data as $list) { 

                                                $catDtl= $this->dbm->getWhere('product_category',['id'=>$list['cat_id']]);

                                                ?>
                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$list['name'];?></td>
                                            <td><?=$catDtl['name'];?></td>
                                            <td><img id="blah" style="height: 40px;width: 40px" class="logo-image" src="<?=base_url('uploads/'.$list['image']);?>" alt="Product Image" /></td>
                                            <td><?=$list['qty'];?></td>
                                            <td><?=$list['exp_date'];?></td>
                                            <td><?=$list['date'];?></td>
                                            <td><?=$list['batch_no'];?></td>
                                            <td>
                                               <div class="btn-group">
                                                   <a title="Edit" href="<?=base_url('auth/getData/product/'.$list['id'].'/add-product');?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                                                   <a  title="Delete" href="<?=base_url('auth/deleteData/product/'.$list['id'].'/add-product');?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                                   
                                               </div>
                                            </td>
                                        </tr>
                                        <?php $i++; } } else { ?>
                                        <tr>
                                            <td colspan="5">No category created yet</td>
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
