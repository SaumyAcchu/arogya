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
              <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="panel-title">Products</p>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mymodal">Cart</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                          <?php foreach ($data as $key => $value): ?>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">                              
                              <div class="panel price panel-white">
                                <div class="panel-heading arrow_box text-center">
                                <h5><b><?= $value['name'] ?></b></h5>
                                </div>
                                <div class="panel-body text-center">
                                 <img class="logo-image" src="<?=base_url('uploads/'.$value['image']);?>" alt="Company Logo">
                                </div>
                                <ul class="list-group list-group-flush text-center">
                                  <li class="list-group-item"><b>MRP : </b><i class="fa fa-inr"></i> <?= $value['mrp'] ?> /-</li>
                                  <li class="list-group-item"><b>BP : </b><i class="fa fa-inr"></i> <?= $value['dp'] ?> /-</li>
                                  <li class="list-group-item"><b>PV : </b><i class="fa fa-inr"></i> <?= $value['cv'] ?> /-</li>
                                </ul>
                                <div class="panel-footer">
                                  <!-- <a class="btn btn-lg btn-block btn-default" href="<?=base_url('user/getData/'.base64_encode('product/'.$value['id'].'/products-dtl')); ?>">BUY NOW!</a> -->
                                  <button type="button" class="btn btn-lg btn-block btn-default" onclick="addToCartWithQty('<?php echo $value['id'];?>','<?php echo $value['name'];?>','<?php echo $value['mrp'];?>','<?= $value['dp'] ?>','<?= $value['cv'] ?>');">Add To Cart</button>
                                </div>
                              </div>
                            </div>
                            
                          <?php endforeach ?>
                             
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
</html>


<?php $current_page="astroshop"; ?>
<script type="text/javascript">
    
    function addToCartWithQty(item_id,name,price,dp,cv){
        
        /*alert(id);*/


        var input_id = "input_quantity_"+item_id;
        /*var inputQty = document.getElementById(input_id).value;
        alert(inputQty);*/

         alert(input_id);
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

<script type="text/javascript">
    function addToCartWithQty1(item_id,name,price,dp,cv){
        /*alert(id);*/

        var input_id = "input_quantity_"+item_id;
        var qtybutton=$('#qtybutton').val();
        /*var inputQty = document.getElementById(input_id).value;
        alert(inputQty);*/

        //   alert(qtybutton);
        $.ajax({
              
              type: 'post',
              data: {
                'item_id':item_id,
                'price':price,
                'name':name,
                'upload':upload,
                'add_qty':qtybutton,
              },
              url: '<?php echo base_url('product/addtocart'); ?>',
              success: function(data){
                 // alert(data);
                  var cart = parseInt($('#totalcart').html());
                $('#totalcart').html(cart + 1);
                swal("Congratulations!", "Product Successfully Added in Your Cart !", "success");
                  $('#cart_details').html(data);
                 
              } 
            });     
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

<style type="text/css">
  

  @import url("http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css");
@import url("http://fonts.googleapis.com/css?family=Roboto:400,300,700italic,700,500&subset=latin,latin-ext");

body {
        padding-top: 40px;
        padding-bottom: 40px;
      
      }
  
  /* COMMON PRICING STYLES */
    .panel.price,
    .panel.price>.panel-heading{
      border-radius:0px;
       -moz-transition: all .3s ease;
      -o-transition:  all .3s ease;
      -webkit-transition:  all .3s ease;
    }
    .panel.price:hover{
      box-shadow: 0px 0px 30px rgba(0,0,0, .2);
    }
    .panel.price:hover>.panel-heading{
      box-shadow: 0px 0px 30px rgba(0,0,0, .2) inset;
    }
    
        
    .panel.price>.panel-heading{
      box-shadow: 0px 5px 0px rgba(50,50,50, .2) inset;
      text-shadow:0px 3px 0px rgba(50,50,50, .6);
    }
      
    .price .list-group-item{
      border-bottom-:1px solid rgba(250,250,250, .5);
    }
    
    .panel.price .list-group-item:last-child {
      border-bottom-right-radius: 0px;
      border-bottom-left-radius: 0px;
    }
    .panel.price .list-group-item:first-child {
      border-top-right-radius: 0px;
      border-top-left-radius: 0px;
    }
    
    .price .panel-footer {
      color: #fff;
      border-bottom:0px;
      background-color:  rgba(0,0,0, .1);
      box-shadow: 0px 3px 0px rgba(0,0,0, .3);
    }
    
    
    .panel.price .btn{
      box-shadow: 0 -1px 0px rgba(50,50,50, .2) inset;
      border:0px;
    }
    
  
    
    /* white price */
    
  
    .price.panel-white>.panel-heading {
      color: #333;
      background-color: #f9f9f9;
      border-color: #ccc;
      border-bottom: 1px solid #ccc;
      text-shadow: 0px 2px 0px rgba(250,250,250, .7);
    }
    
    .panel.panel-white.price:hover>.panel-heading{
      box-shadow: 0px 0px 30px rgba(0,0,0, .05) inset;
    }
      
    .price.panel-white>.panel-body {
      color: #fff;
      background-color: #dfdfdf;
    }
        
    .price.panel-white>.panel-body .lead{
        text-shadow: 0px 2px 0px rgba(250,250,250, .8);
        color:#666;
    }
    
    .price:hover.panel-white>.panel-body .lead{
        text-shadow: 0px 2px 0px rgba(250,250,250, .9);
        color:#333;
    }
    
    .price.panel-white .list-group-item {
      color: #333;
      background-color: rgba(50,50,50, .01);
      font-weight:600;
      text-shadow: 0px 1px 0px rgba(250,250,250, .75);
    }
</style>