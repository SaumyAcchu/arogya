<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Pay Land Installment';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="container-fluid no-padding main-container">
            <div class="title txtcenter">
            <h4>Submit Land Installment</h4>
          </div>
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  <!-- ///=====================All Contents Start Here============= //-->
            <div class="col-sm-12">
              <?php
              $userData=$this->db_model->getWhere('land',['id'=>$get_data['land_id']]); ?>
              <table class="table table-hover table-bordered table-striped">
                <tbody>
                  <tr>
                    <td colspan="6" style="color: red;">Applicant Details</td>
                  </tr>
                  <tr>
                    <th>Land Name</th><td><?=$userData['land_name'];?> </td><th>Owner Name</th><td><?=$userData['owner_name'];?></td><th>Mobile</th><td><?=$userData['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Registration Date</th><td><?=$userData['registration_date'];?></td>
                    <th>Address</th><td colspan="3"><?=$userData['location'];?></td>
                  </tr>
                  
                  <tr>
                    <td colspan="6" style="color: red;">Installment Details</td>
                  </tr>
                  <tr>
                    <th>Installment No.</th><td><?=$get_data['inst_num']; ?></td>
                    <th>Installment Amt</th><td>&#8377; <?=number_format($get_data['emi'],2); ?>  </td>
                    <th>Trnx No</th><td><?=$get_data['trnx']; ?></td>
                  </tr>
                </tbody>
              </table>
              <?=form_open('real1/submitLandInstallment',['class'=>'form-horizontal well']);?>
            
                  <input type="hidden" name="installment_id" value="<?=$get_data['id'];?>">     
                <div class="form-group">
                  <div class="col-md-4">
                    <label>Payment Received Date</label>
                    <span id="datepairExample">
                      <input type="text" value="<?= set_value('pay_date',date('d-m-Y')); ?>" name="pay_date" class="form-control date" id="pay_date" placeholder="dd-mm-yyyy" required>
                    </span>
                  </div>
                   
                  <div class="col-md-4">
                      <label>Amount</label>
                      <input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount" id="pay_amount" value="<?=$get_data['emi'];?>" readonly>
                      <p style="color: red;" id="errAmt"></p>
                  </div>
                  
                 
                </div>
                  
                </div>
               
                </span></span>
                <div class="form-group">
                  <label class="col-md-2 control-label"></label>
                  <div class="col-md-4">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="Submit"class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
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
    $('#datepairExample .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });
    $('#pay_mode').change(function(){
      var data=$('select[name="pay_mode"] option:selected').val();
      $('#errMode').html('');
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
      if(data=='')
      {
        $('#cash').css('display','none');
        my_element_jq = $('#cheque');
        comment = document.createComment(my_element_jq.get(0).outerHTML);
        my_element_jq.replaceWith(comment);
        $('#cash').css('display','none');
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
        if($.trim(chknm)==''&& $.trim(chknm)>5)
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
      var cnf=confirm('Are you sure to Submit Installment');
      if(cnf==true)
      {
        return true;
      }else
      {
        return false;
      }
    });
    
  var room = 1;
  function education_fields() {
   
      room++;
      var objTo = document.getElementById('education_fields');
      var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass"+room);
    var rdiv = 'removeclass'+room;
      divtest.innerHTML = '<div class="col-md-4"><label>Cheque Number</label><input type="text" maxlength="6" id="cheque_num" name="cheque_num[]" placeholder="Enter Cheque Number" value="" class="form-control" required><p style="color: red;" id="errChknm"></p></div><div class="col-md-4"><label>Cheque Detail</label><input type="text" id="cheque_num" name="cheque_detail[]" placeholder="Enter Bank Detail" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-3"><label>Amount</label><input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount[]" id="pay_amount" value="" required><p style="color: red;" id="errAmt"></p></div><div class="col-md-1"><label>Remove</label><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div>';
      
      objTo.appendChild(divtest)
  }
     function remove_education_fields(rid) {
       $('.removeclass'+rid).remove();
     }


  $('#cheque_num').keypress(function(event){
               console.log(event.which);
           if(event.which != 6 && isNaN(String.fromCharCode(event.which))){
               event.preventDefault();
           }});

  </script>

</body>
</html>
