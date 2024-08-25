<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=$page['page']='Dashboard';?> | <?=$this->siteInfo['name'];?></title>
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
              <?php if (empty($this->cart->contents())): ?>
                <center><h1>Cart is Empty....</h1> </center>
                <?php else: ?>
              
              <div class="table-responsive">
              <table cellpadding="6" cellspacing="1" style="width:100%" border="0" class="table table-bordered">

             <tr class="info" style="color: black;">
                     <th>QTY</th>
                     <th>Item Description</th>
                     <th style="text-align:right">MRP</th>
                     <th style="text-align:right">Product BV</th>
                     <th style="text-align:right">Sub Total BV</th>
                     <th style="text-align:right">PV</th>
                     <th style="text-align:right">PV Total</th>
                     <th>Actiopn</th>
             </tr>

             <?php $i = 1; $tcv = 0; ?>

             <?php foreach ($this->cart->contents() as $items): ?>
            
                     <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                     <tr>
                             <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5','readonly'=>'true')); ?></td>
                             <td>
                                <?php echo $items['name']; ?>
                             </td>
                             <td style="text-align:right"><?php echo $this->cart->format_number($items['mrp']); ?></td>
                             <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                             <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                             <td style="text-align:right"><?php echo $this->cart->format_number($items['cv']); ?></td>
                             <td style="text-align:right"><?php echo $this->cart->format_number($items['qty']*$items['cv']);  $tcv = $tcv + ($items['qty']*$items['cv']); ?></td>
                             <td> 

                               <a type="button" href="<?=base_url('user/explore/products-payment');?>" class="btn btn-warning" onclick="addToCartRemove('<?php echo $items['rowid']; ?>')" style="background-color:  #f34235;"> <i class="fa fa-remove"> </i></a>
                             </td>
                     </tr>

             <?php $i++; ?>

             <?php endforeach; ?>

             <tr> <td style="text-align: right;" colspan="4"><strong>Total</strong></td>         <td style="text-align:right;"><?php echo
             $this->cart->format_number($this->cart->total()); ?></td>         <td
             style="text-align:right;"><strong>Total CV:</strong></td> <td style="text-align: right;color:red;"><b> <?= $this->cart->format_number($tcv); ?></b></td> </tr>

             </table>
             </div>


             <div class="row form-horizontal">
                <?= form_open('user/payOrder'); ?>

              <div class="form-group">

                <label class="col-lg-3 control-label">Pay with : </label>
                <div class="col-lg-4">
               
                 <label class="radio-inline">
                      <input type="radio" name="pay_by" value="cod" checked>Cod
                 </label>
                  
                </div>
          
          
               
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Delivery Methode : </label>
                <div class="col-lg-4">
                  <select id="delivery_status" class="form-control" name="delivery_status" required>
                    <option value="">Select Delivery Methode</option>
                    <option value="office">Office</option>
                    <option value="courier">Courier</option>
                  </select>
                  <span id="errMode" class="txtred"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">Remark : </label>
                <div class="col-lg-4">
                 <textarea name="remark" class="form-control" required></textarea>
                  <span id="errMode" class="txtred"></span>
                </div>
              </div>

                <div class="form-group">
                  <div class="col-lg-3"></div>
                  <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary"> Submit </button>
                  
                  </div>
                </div>
              </form>

            </div>




             <?php endif ?>
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


<?php $current_page="astroshop"; ?>
<script type="text/javascript">
    
    function addToCartWithQty(item_id,name,price,dp,cv){
        
        /*alert(id);*/


        var input_id = "input_quantity_"+item_id;
        /*var inputQty = document.getElementById(input_id).value;
        alert(inputQty);*/

        // alert(input_id);
        $.ajax({
              
              type: 'post',
              data: {
                'item_id':item_id,
                'price':price,
                'name':name,
                'dp':dp,
                'cv':cv,
                'add_qty':1
              },

              url: '<?php echo base_url('product/addtocart'); ?>',
              

              success: function(data){
                 // alert(data);
                 alert("successfully added item into cart.");
                  $('#cart_details').html(data);
                 
              } 
            });     
    }

    function addToCartRemove(item_id){
        
        var currentPage = '<?php echo $current_page;?>' ;
        //alert(currentPage);
        if(currentPage == 'order_view'){
            $.ajax({
              type: 'post',
              data: {
                'item_id':item_id,
                'add_qty':0
              },
              url: '<?php echo base_url('product/remove'); ?>',
              success: function(data){
                  
                  alert("successfully delete item into cart.");
                  $('#cart_details').html(data);
                 
              } 
            });
        }else{
            $.ajax({
              type: 'post',
              data: {
                'item_id':item_id,
                'add_qty':0
              },
               url: '<?php echo base_url('product/remove'); ?>',
              success: function(data){
                  
                  alert("successfully delete item into cart.");
                  $('#cart_details').html(data);
                 
              } 
            });
        }
        
    }
</script>


<div class="modal fade" id="mymodal" role="dialog" style="z-index: 9999; top: 20%">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add To Cart</h4>
      </div>
      <div class="modal-body">
            <div id="cart_details">
              <?php $this->load->view('user/cart_div'); ?>
            <!-- <h3 align="center">Cart is Empty</h3> -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
