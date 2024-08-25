<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Land Management';?> | <?=$this->siteInfo['name'];?></title>
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
		                 
		        <!-- ///=====================All Contents Start Here============= //-->
		        <!-- <?php print_r($data); ?> -->

		      

		                    <div class="col-lg-12">
		                      <table id="example" class="table table-striped table-hover table-bordered display" style="width:100%">
		                        <thead>
		                          <tr>
		                            <th>Sl.</th>
		                            <th>Reg No.</th>
		                            <th>Password</th>
		                            <th>Name</th>
		                            <th>Owner</th>
		                            <th>Mobile</th>
		                            <th>Amount</th>
		                            <th>Reg. Date</th>
		                            <th>Action</th>
		                            <!-- <th>Booking Form</th> -->
		                          </tr>
		                        </thead>
		                        <tbody>
		                        <?php if($data) { $i=1;
		                         foreach($data as $list) { ?>
		                          <tr>
		                            <td><?=$i;?></td>
		                            <td><?=$list['registration'];?></td>
		                            <td><?=$list['password'];?></td>
		                            <td>
		                            <?=$list['land_name'];?>
		                              <!-- <a href="<?=base_url('real1/printLandInvoice/'.$list['id']);?>"></a> -->
		                            </td>
		                            <td class="txtupper"><?=$list['owner_name'];?></td>
		                            <td>
		                              <?=$list['mobile'];?>
		                            </td>
		                            
		                            <td><?=$list['total'];?></td>
		                            <td><?=$list['registration_date'];?></td>
		                            <td><div class="btn-group">
		                                <a title="Edit" onclick="return conDel('real1/payLandInstallment/<?=$list['id'];?>');" href="#" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span>PayInstallment</a>
		                              <!-- <?php $minId=$this->db->select_min('id')->where(['flat_user_id'=>$list['id']])->get('payment')->row_array(); ?>
		                              <?php if($this->logged['access_level']=='universal'){ ?>
		                                <a onclick="return conDel('real1/userManagement/del/<?=$list['id'];?>');" title="Delete" href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
		                              <?php } ?> -->
		                              </div>
		                            </td>
		                          </tr>
		                        <?php $i++; } } else { ?>
		                          <tr>
		                            <td colspan="10">No Data Found.</td>
		                          </tr>
		                        <?php } ?>
		                        </tbody>
		                      </table>
		                    </div>
		                  </div>
		                </div>
	        <!--//===============Main Container End=============//-->
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
	                    <input type="password" id="password" class="form-control" style="margin-bottom: 5px;" placeholder="Enter Your Password" required>
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
  </script>  
</body>
</html>
