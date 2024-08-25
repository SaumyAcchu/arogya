<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Transfer PIN';?> | <?=$this->siteInfo['name'];?></title>
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
		          <?php
        $pinCount1=$this->dbm->globalSelect('pin',['user_id'=>$this->logged['user_id'],'status'=>0,'is_transfer!='=>1]);
        $pinCount2=$this->dbm->globalSelect('pin',['receiver_id'=>$this->logged['user_id'],'status'=>0]);
        $pinCount=array_merge($pinCount1,$pinCount2);
        //echo "<pre>"; print_r($pinCount); die;
         ?>
              <div class="col-lg-4 col-xs-6 col-sm-6">
                <div class="panel panel-primary">
                              <div class="panel-heading">
                                <div class="row">
                                  <div class="col-xs-4">
                                      <i class="fa fa-pinterest-p fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                      <p class="announcement-heading">Available PIN</p>
                                      <h3 class="announcement-text"><?=count($pinCount);?></h3>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4 col-xs-6 col-sm-6">
                          <div class="form-group">
                            <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">PIN Transfer <i class="fa fa-print"></i></h3>
                    </div>
                    <div class="panel-body">
                      <div class="form-group">
                        <label>Enter Quantity</label>
                        <input type="number" id="quantity" value="1" min="1" max="<?=count($pinCount);?>" class="form-control">
                        <span id="err_txt" class="txtred"></span>
                      </div>
                      <div class="form-group">
                        <center>
                          <?php if($pinCount>0){ ?>
                          <button id="generatePin" class="btn btn-primary">Transfer PIN <i class="fa fa-send"></i></button>
                          <?php } else { ?>
                          <button id="" class="btn btn-primary" disabled="">No PINs Available <i class="fa fa-block"></i></button>
                          <?php } ?>
                        </center>
                      </div>
                    </div>
                  </div>
                          </div>
              </div>
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Transferd PIN Status</h3>
                  </div>
                  <div class="panel-body">
                    <table id="table1" class="table table-bordered table-striped table-condensed">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>PIN</th>
                          <th>Date</th>
                          <th>Transfered To</th>
                          <th>Status</th>
                          <th>Activated Account</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $res=$this->dbm->globalSelect('pin',['user_id'=>$this->logged['user_id'],'is_transfer'=>1]);
                         $i=1;
                        foreach($res as $key => $value)
                        { ?>
                        <tr>
                          <td><?=$i;?></td>
                          <td><?=$value['pin'];?></td>
                          <td><?=$this->dbm->dateFormat($value['transfer_date']);?> <?=$value['transfer_time'];?></td>

                          <?php
                          $usr=$this->dbm->getWhere('users',['user_id'=>$value['receiver_id']]);?>
                          <td><?=$usr['name'];?> (<?=$value['receiver_id'];?>)</td>
                          <td>
                            <?=($value['status']==1)?'<button class="btn btn-xs btn-success btn-block">Active</button>':'<button class="btn btn-xs btn-warning btn-block">Deactive</button>';?>
                          </td>
                          <td><?php
                            if($value['activated_account']) {
                            echo $value['activated_account'];
                           } ?> 
                          </td>
                        </tr>
                        <?php $i++; } ?>
                      </tbody>
                    </table>
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

        <!-- Bootstrap Modal fo Pin Topup -->
          <div class="modal fade" id="topUpModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" style="color: red;"></span></button>
                  <h4 class="modal-title">Enter User ID</h4>
                </div>
                <div class="modal-body">
                  <div class="">
                    <?=form_open('user/transferPinViaTopup'); ?>
                    <p class="txtred text-center" id="transferPinMsg"></p>
                      <table class="table">
                        <tr>
                          <input type="hidden" name="transfer_quantity" id="transferQuantity">
                          <th><input type="text" name="receiver_id" placeholder="Enter User ID" id="userIDTransfer" value="" class="form-control txtupper" required></th>
                          <th><button id="verifyTransfer" type="button" class="btn btn-info"> Validate </button></th>
                        </tr>
                        <tr id="transferData">
                          
                        </tr>
                      </table>
                  </div>
                </div>
                <div class="modal-footer">

                </div>
                </form>
              </div>
            </div>
          </div>
        <!-- Modal End -->

<script type="text/javascript">
    $(document).ready(function() {
$('#table1').DataTable();
} );
  $('#generatePin').click(function(){
     pinCount="<?=count($pinCount);?>";
     total=parseFloat($('#quantity').val());
     if(total<1 || pinCount<1)
    {
      $('#err_txt').html("PIN Quantity/Availability is must be greater than  0"); return false;
    }
    if(pinCount<total)
    {
      $('#err_txt').html("PIN Quantity is must be equal or less than available PINs");
    }else
    {
      $('#err_txt').html("");
      $('#transferQuantity').val(total);
      $('#topUpModal').modal('show');
    }
  });

  $('#verifyTransfer').click(function()
  {
    var uid=$.trim($('#userIDTransfer').val());
    var res = uid.toUpperCase();
    var curr="<?=$this->logged['user_id'];?>";
    var res1 = curr.toUpperCase();
    if(res==res1)
    {
      alert("You Can't Transfer PIN to self.");
      return false;
    }else
    {
      $.ajax({
        url:"<?=base_url('user/checkUserForpinTransfer');?>",
        data:{user_id:uid},
        type:'post',
        success:function(data)
        {
          $('#transferData').html(data);
        }
      });
    }
  });
  
</script>