<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Withdraw Management';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="container-fluid padding-top main-container">
           <?php $paytmAmt=0; $bankAmt=0; $i=1; ?>
  <!-- ///=====================All Contents Start Here============= //-->
    <a href="<?=base_url('real1/commClosing');?>" class="btn btn-success pull-right" onclick="return confirm('Are You Sure To Closing');">New Closing</a><br><br>
              <div class="col-lg-12">
                  <h4 style="color:red;">Unpaid List</h4>
                <table id="example" class="table table-striped table-hover table-bordered display" style="width:100%">
                  <thead>
                    <tr>
                      <th>Sl.</th>
                      <th>Name</th>
                      <th>User id</th>
                      <th>Bank Name</th>
                      <th>Account No</th>
                      <th>Amount</th>
                      <th>Closing Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
               <?php $query=$this->db->group_by('user_id,date')->select('*,sum(amount) as total')->get_where('withdraw',['status'=>0])->result_array();
                ?>
                  <?php  if($query) { $i=1; $bankun =0;
                   foreach($query as $list) {
                   ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$this->dbm->getIndex('users','name',['user_id'=>$list['user_id']]);?></td>
                      <td><?=$list['user_id'];?></td>
                      <td><?=$list['bank_name'];?></td>
                      <td><?=$list['account_number'];?></td>
                      <td><?=$list['total'];$bankun=$bankun+$list['total']; ?> </td>
                      <td><?php $date = date_create($list['date']);
                      echo date_format($date,'d-M-Y'); ?>
                      </td>
                      <td><div class="btn-group">
                       <?php if($list['status']==1)
                          { ?>
                            <a href="#" class="btn btn-sm btn-warning">Paid</a> <?php
                          }else
                          { ?>
                            <a href="<?=base_url('real1/userBlock/'.$list['user_id'].'/pay/'.$list['date']);?>" onclick="alert('Pay Withdraw Amount')" class="btn btn-sm btn-primary">Pay</a>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php $i++; }}  else { ?>
                    <tr>
                      <td colspan="10">No Data Found.</td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
                
              </div>
              	<div class="panel-footer txtcenter well">
							<b class="txtred"> Payment Withdraw Summary</b><br>
						
							<b>Total unpaid Users : </b> <?=$i-1; ?><br>
              
							<b>Total unpaid Amount : </b> <?=number_format($bankun,2); ?>
							
						</div>
            </div>
          </div>
          <br>
        
          <div class="col-lg-12">
                <h4 style="color:red">Paid List</h4>
                <table id="example1" class="table table-striped table-hover table-bordered display" style="width:100%">
                  <thead>
                    <tr>
                      <th>Sl.</th>
                      <th>Name</th>
                      <th>User id</th>
                      <th>Bank Name</th>
                      <th>Account No</th>
                      <th>Amount</th>
                      <th>Closing Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
               <?php $query=$this->db->group_by('user_id,date')->select('*,sum(amount) as total')->get_where('withdraw',['status'=>1])->result_array();
                ?>
                  <?php  if($query) { $i=1;
                   foreach($query as $list) {
                   ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$this->dbm->getIndex('users','name',['user_id'=>$list['user_id']]);?></td>
                      <td><?=$list['user_id'];?></td>
                      <td><?=$list['bank_name'];?></td>
                      <td><?=$list['account_number'];?></td>
                      <td><?=$list['total'];$bankAmt=$bankAmt+$list['total']; ?> </td>
                      <td><?php $date = date_create($list['date']);
                      echo date_format($date,'d-M-Y'); ?>
                      </td>
                      <td><div class="btn-group">
                       <?php if($list['status']==1)
                          { ?>
                             <a href="#" class="btn btn-sm btn-warning">Paid</a> <?php
                          }else
                          { ?>
                            <a href="<?=base_url('real1/userBlock/'.$list['id'].'/pay');?>" onclick="alert('Pay Withdraw Amount')" class="btn btn-sm btn-primary">Pay</a>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php $i++; }}  else { ?>
                    <tr>
                      <td colspan="10">No Data Found.</td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
                
              </div>
              	<div class="panel-footer txtcenter well">
							<b class="txtred"> Payment Withdraw Summary</b><br>
						
							<b>Total Paid Users : </b> <?=$i-1; ?><br>
							<b>Total Paid Amount : </b> <?=number_format($bankAmt,2); ?>
							
						</div>
            </div>
          </div>
          
          
          
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
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
                <input type="password" id="password" class="form-control" style="margin-bottom: 5px;" placeholder="Enter Your Password" autofocus="autofocus" required>
                <input type="hidden" name="action" value="" id="action">
                <span class="input-group-btn">
                  <button class="btn btn-primary" id="conPass" type="button">Go!</button>
                </span>
              </div><!-- /input-group -->
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
          </div>
        </div>
    <!-- Modal End -->
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <script>
$(document).ready(function(){
  $("button").click(function(){
    $("p").click();
  });
});
</script>
  <!--==========Footer End=============-->   
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
    $(document).ready(function() {
      $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'csv', 'excel', 'pdf'
          ]
      } );
  } );
  $(document).ready(function() {
      $('#example1').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'csv', 'excel', 'pdf'
          ]
      } );
  } );
  </script>
</body>
</html>
