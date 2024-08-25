<!DOCTYPE html>
<html>
<head>
  <title><?=$this->siteInfo['name'];?></title>
  <?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
    <div class="container-fluid no-padding display-table">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 no-padding hidden-xs display-table-cell v-align box" id="navigation">
            <?php $this->load->view('includes/sidebar.php',['page'=>'']); ?>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php $this->load->view('includes/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="container-fluid no-padding main-container">
            <div class="title txtcenter">
            <h4>Plot Status</h4>
          </div>
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  <!-- ///=====================All Contents Start Here============= //-->
            <div class="col-sm-12">
              <?=form_open('real1/paymentManagement/upd/'.$payment['id'],['class'=>'form-horizontal well']); ?>
                  <input type="hidden" name="flat_user_id" value="<?=$payment['flat_user_id'];?>">
                  <input type="hidden" name="flat_id" value="<?=$payment['flat_id'];?>">
                  <input type="hidden" name="building_id" value="<?=$payment['building_id'];?>">
                  <input type="hidden" name="grand_total" value="<?=$payment['grand_total'];?>">
                <div class="form-group">
                  <div class="col-md-4">
                    <label>Select Date</label>
                    <span id="datepairExample">
                    <?php $date=new DateTime($payment['pay_date']);
                    $newdate=$date->format('d-m-Y'); ?>
                      <input type="text" value="<?= set_value('pay_date',$newdate); ?>" name="pay_date" class="form-control date" id="pay_date" placeholder="dd-mm-yyyy" required>
                    </span>
                  </div>
                  <div class="col-md-4">
                    <label>Payment Mode</label>
                    <!-- <select name="pay_mode" class="form-control" id="pay_mode" required>
                      <option value="">Please Select</option>
                      <option value="Cash" <?=set_select('pay_mode','Cash',$payment['pay_mode']=='Cash');?>>Cash</option>
                      <option value="Cheque" <?=set_select('pay_mode','Cheque',$payment['pay_mode']=='Cheque');?>>Cheque</option>
                    </select> -->
                    <input type="text" class="form-control" name="pay_mode" value="<?=$payment['pay_mode'];?>" readonly>
                    <p style="color: red;" id="errMode"></p>
                  </div>
                </div>
                <?php $i=0;
                if($payment['pay_mode']=='Cash')
                { ?>
                  <span id="csh">
                  <span id="cash">
                    <div class="form-group">
                      <div class="col-md-4">
                        <label>Amount</label>
                        <input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount" id="pay_amount" value="<?=$payment['pay_amount'];?>">
                        <p style="color: red;" id="errAmt"></p>
                      </div>
                    </div>
                  </span>
                  </span>
                <?php }else { ?>
                  <span id="chk">
                  <span id="cheque" style=""> 
                  <?php 
                  $chqDet=explode(',',$payment['cheque_detail']);
                  $chqNum=explode(',',$payment['cheque_num']);
                  $chqAmt=explode(',',$payment['pay_amount']); 
                  foreach ($chqNum as $key => $value)
                  { ?>
                    <?php if($i>0) { ?>
                    <div class="form-group removeclass<?=$i;?>">
                    <?php } else { ?>
                    <div class="form-group">
                    <?php } ?>
                      <div class="col-md-4">
                        <label>Cheque Number</label>
                        <input type="number" id="cheque_num" name="cheque_num[]" placeholder="Enter Cheque Number" value="<?=$value;?>" class="form-control">
                        <p style="color: red;" id="errChknm"></p>
                      </div>
                      
                      <div class="col-md-4">
                        <label>Cheque Detail</label>
                        <input type="text" id="cheque_num" name="cheque_detail[]" placeholder="Enter Bank Detail" value="<?=$chqDet[$key];?>" class="form-control">
                        <p style="color: red;" id=""></p>
                      </div>
                      <div class="col-md-3">
                        <label>Amount</label>
                        <input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount[]" id="pay_amount" value="<?=$chqAmt[$key];?>">
                        <p style="color: red;" id="errAmt"></p>
                      </div>
                      <?php if($i>0)
                      { ?>
                        <div class="col-md-1"><label>Remove</label><button class="btn btn-danger" type="button" onclick="remove_education_fields(<?=$i;?>);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>
                        </div><?php
                      } else { ?>
                      <div class="col-md-1">
                        <label>Add</label>
                        <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                      </div>
                      <?php } ?>
                    </div>
         <?php  $i++;  }
                } 
                ?>
                <p id="rowCount" style="display: none;"><?=$i;?></p>
                <div id="education_fields">
                  
                </div>
                </span></span>
                <div class="form-group">
                  <label class="col-md-2 control-label"></label>
                  <div class="col-md-4">
                    <button id="goBack" class="btn btn-danger"> << Go Back</button>
                    <button type="Submit" id="" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </form>
            </div>      
          </div>
          <!-- All Content End here -->
        </div>
      </div>
    </div>
</body>
<?php $this->load->view('includes/footer.php'); ?>
<script type="text/javascript">
  $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
  $('#pay_mode').change(function(){
    var data=$('select[name="pay_mode"] option:selected').val();
    if(data=='Cheque')
    {
      $("#chk").contents().each(function(index, node){
        if (node.nodeType == 8) {
            // node is a comment
            $(node).replaceWith(node.nodeValue);
          }
      });

      $('#cheque').css('display','block');
      my_element_jq1 = $('#cash');
      comment1 = document.createComment(my_element_jq1.get(0).outerHTML);
      my_element_jq1.replaceWith(comment1);
    
    }
    if(data=='Cash')
    {
      $("#csh").contents().each(function(index, node1) {
          if (node1.nodeType == 8) {
              // node is a comment
              $(node1).replaceWith(node1.nodeValue);
          }
      });

      $('#cash').css('display','block');
      my_element_jq = $('#cheque');
      comment = document.createComment(my_element_jq.get(0).outerHTML);
      my_element_jq.replaceWith(comment);
     
    }
  });

  $('#btnSubmit').click( function(){
    var mode=$('select[name="pay_mode"] option:selected').val();
    if($.trim(mode)=='')
    {
      $('#errMode').html('This Field must be required');
      return false;
    }
    if(mode=='Cheque')
    {
      var chknm=$('#cheque_num').val();
      if($.trim(chknm)=='')
      {
        $('#errChknm').html('This Field must be required');
        return false;
      }
    }
    var amt=$('#pay_amount').val();
    if($.trim(amt)=='')
    {
      $('#errAmt').html('This Field must be required');
      return false;
    }
  });
  $('#goBack').click(function()
    {
      window.history.back();
    });
var room = $('#rowCount').html();
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields');
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-md-4"><label>Cheque Number</label><input type="number" id="cheque_num" name="cheque_num[]" placeholder="Enter Cheque Number" value="" class="form-control" required><p style="color: red;" id="errChknm"></p></div><div class="col-md-4"><label>Cheque Detail</label><input type="text" id="cheque_num" name="cheque_detail[]" placeholder="Enter Bank Detail" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-3"><label>Amount</label><input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount[]" id="pay_amount" value="" required><p style="color: red;" id="errAmt"></p></div><div class="col-md-1"><label>Remove</label><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
     $('.removeclass'+rid).remove();
   }





</script>