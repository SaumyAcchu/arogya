<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<title><?=$page['page']='L.O.B. Management';?> | <?=$this->siteInfo['name'];?></title>
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
		        	<div class="col-lg-12">
		            <div class="row padding-top">
		            <div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title"> Rank Achievers</span>
						</div>
						<div class="panel-body">
							<table id="table1" class="table table-bordered table-striped table-hover table-condensed table-responsive">
								<thead>
										<tr>
											<th>Sl.</th>
											<th>User ID</th>
											<th>GetFrom</th>
											<th>Name</th>
											<th>Rank</th>
											<th>Date</th>

										</tr>
									</thead>
									<tbody>
									  <?php if($data) { $i=1;
									  	foreach ($data as $key => $value)
									  	{?>
									  		<?php $pakl = $this->db->get_where('users',['user_id'=>$value['getForm'],'status'=>1])->row_array(); 
									  		if($pakl){ ?>
									  		<tr class="">
									  			<td><?=$i;?></td>
									  			<td><?=$value['user_id'];?></td>
									  				<td><?=$pakl['user_id'];?></td>
									  			<td>
									  			    <?php $pak = $this->db->get_where('users',['user_id'=>$value['user_id']])->row_array(); ?>
									  			    <?=$pak['name']; ?>
									  			</td>
									  			<td><?=$value['club'];?></td>
									  				
									  			<td><?=$value['time'];?></td>
									  			
									  		</tr>
									  	<?php $i++; } }}  else { ?>
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