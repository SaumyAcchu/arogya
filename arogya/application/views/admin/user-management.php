<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title><?=$page['page']='User Management';?> | <?=$this->siteInfo['name'];?></title>
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
		        	<!-- .........................date wize filter data................. -->
              <div class="col-lg-8 col-lg-offset-2">
                <?= form_open('auth/DateWiseData',['class'=>'form-horizontal']); ?>
                  <table class="table table-striped table-hover table-bordered">
                     <tbody>
                      <tr>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">From</span>
                             <input type="text" value="<?=set_value('dateFrom',date('d-m-Y'));?>" name="dateFrom" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                          </div>
                        </td>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">To</span>
                             <input type="text" value="<?=set_value('dateTo',date('d-m-Y'));?>" name="dateTo" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                          </div>
                        </td>
                        <td style="padding-top: 12px;">
                          <button type="submit" class="btn btn-danger btn-block btn-sm"> Details</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
              </div> 
           

		        	<!-- ....................................................end date wise filter..... -->



		            <div class="row padding-top">
		            <div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title"> USER LIST</span>
						</div>
						<div class="panel-body">
							<table id="table1" class="table table-bordered table-striped table-hover table-condensed table-responsive">
								<thead>
										<tr>
											<th>Sl.</th>
											<th>User ID</th>
											<th>Package Name</th>
											<th>Name</th>
											<th>Email</th>
											<th>Sponcer ID</th>
											<th>DOJ</th>
											<th>Mobile</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									  <?php if($data) { $i=1;
									  	foreach ($data as $key => $value)
									  	{
									  		if($value['access']!='universal') { ?>
									  		<tr class="<?=($value['status']==1)?"bg-success":"bg-danger";?>">
									  			<td><?=$i;?></td>
									  			<td><?=$value['user_id'];?></td>
									  			<td>
									  			    <?php $pak = $this->db->get_where('base_plan',['id'=>$value['product']])->row_array(); ?>
									  			    <?=$pak['name']; ?>
									  			</td>
									  			<td><?=$value['name'];?></td>
									  				<td><?=$value['email'];?></td>
									  			<td><?=$value['sponcer_id'];?></td>
									  			<td><?=$this->dbm->dateFormat($value['reg_date']);?> <?=$value['reg_time'];?></td>
									  			<td><?=$value['mobile'];?></td>
									  			<td>
									  				<div class="btn-group">
									  				<?php if($value['status']==1)
													{ ?>
														<a href="#" class="btn btn-sm btn-warning">Active</a> <?php
													}else
													{ ?>
														 <a href="#" class="btn btn-sm btn-warning">In-active</a> 
														<?php
													} ?></td>
													<td>
													<!-- <a class="btn icon-btn btn-success" href="<?=base_url('auth/getData/users/'.$value['id'].'/id-card-generate');?>" target="_blank"><span class="glyphicon btn-glyphicon glyphicon-edit img-circle text-success"></span>ID Card Generate</a> -->
													<a class="btn btn-sm btn-info" href="<?=base_url('auth/getData/users/'.$value['id'].'/update-user');?>"> Edit </a>
													<!--<a onclick="return condelUser()" class="btn btn-sm btn-danger" href="<?=base_url('auth/deleteData/users/'.$value['id'].'/user-management');?>"> Delete </a>-->
													<?php if($value['block']==1)
													{ ?>
														<a href="<?=base_url('auth/userBlock/'.$value['user_id'].'/unblock');?>" onclick="return unblock()" class="btn btn-sm btn-warning">Blocked</a> <?php
													}else
													{ ?>
														<a href="<?=base_url('auth/userBlock/'.$value['user_id'].'/block');?>" onclick="return block()" class="btn btn-sm btn-primary">Block</a>
													<?php } ?>
													</div>
									  			</td>
									  		</tr>
									  	<?php $i++; } } } else { ?>
										<tr><td colspan="7">No Records Found.</td></tr>
										<?php } ?>
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

<script type="text/javascript">
function sendPin(req_id,user_id)
{
	$('#req_id').val(req_id);
	$('#user_id').val(user_id);
}


	$('#pinGen').click(function(){
		$.ajax({
			url:"<?=base_url('auth/pinGenerate');?>",
			
			success:function(data)
			{
				$('#pin').val(data);
			}
		});
	});



	function condelUser()
	{
		var cnf =confirm('Are you Sure to Delete this User');
		if(cnf)
		{
			return true;
		}else
		{
			return false;
		}
	}
	function block()
	{
		var cnf =confirm('Are you Sure to Block this User');
		if(cnf)
		{
			return true;
		}else
		{
			return false;
		}
	}
	function unblock()
	{
		var cnf =confirm('Are you Sure to Unblock this User');
		if(cnf)
		{
			return true;
		}else
		{
			return false;
		}
	}
	function walletChange(user,cash,topup)
	{
		$('#userId').val(user);
		$('#cashWallet').val(cash);
		$('#topupWallet').val(topup);
		$('#walletModal').modal('show');
	}
</script>
<style type="text/css">
	.btn-circle{
		border-radius: 50%;
	}
	.Udeactive{
		background: darkred;
		color: #fff;
	}
	.Uactive{
		background: darkgreen;
		color: #fff;
	}
</style>

<script>            
 $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
</script>


<style type="text/css">
    .btn-glyphicon { padding:8px; background:#ffffff; margin-right:4px; }
.icon-btn { padding: 1px 15px 3px 2px; border-radius:50px;}
</style>

<script type="text/javascript">
	$('.loader').hide();
	function exploreData(id,amount,mode,req_id)
	{
		$('.loader').show();
		$("#overlay").css('display','block');
		var table='users';
		$.ajax({
			url:"<?=base_url('auth/getDataAjax');?>",
			type:'post',
			data:{table:table,user_id:id},
			success:function(data)
			{
				$('.loader').fadeOut(3000);
				$("#overlay").fadeOut(3000).css('display','none');
				$('#withdrawModal').modal('show');
    			var arr = $.parseJSON(data);
    			$('#name').html(arr['name']);
    			$('.amount').html(amount);
    			$('#payment_mode').html(mode);
    			$('#wallet').html(arr['wallet']);
    			$('#user_id').html(arr['user_id']);
    			$('#sponcer_id').html(arr['sponcer_id']);
    			$('#req_id').val(req_id);
    			$('#userId').val(id);
    			$('#payAmount').val(amount);
			}
		});
	}

	function quickReply(repid,userid)
	{
		$('#receiver_id').val(userid);
		$('#query_id').val(repid);
	}
$(document).ready(function() {
$('#table1').DataTable({
	dom: 'Bfrtip',
        buttons: [
        	'pageLength',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ]
	});
} );
$(document).ready(function() {
$('#table2').DataTable({
	dom: 'Bfrtip',
        buttons: [
        	'pageLength',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ]
	});
} );

function repliedModal(date,message)
	{
		$('#noticeModal').modal('show');
		$('#noticeDate').html(date);
		$('#notice').html(message);
	}
	function conDel()
	{
		var cnf=confirm('Are you sure to delete this message');
		if(cnf)
		{
			return true;
		}else
		{
			return false;
		}
	}

	$('#paid').click(function(){
		var cnf=confirm('Are you sure to Pay');
		if(cnf)
		{
			return true;
		}else
		{
			return false;
		}
	});
</script>