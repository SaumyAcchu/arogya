<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Withdraw Requests';?> | <?=$this->siteInfo['name'];?></title>
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
		        <?php $paytmAmt=0; $bankAmt=0; $i=1; ?>
		        <div class="row padding-top">
		            <div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Fund Withdraw Request (BANK Account)</span>
						</div>
						<div class="panel-body">
							<table id="table1" class="table table-bordered table-striped table-hover table-condensed table-responsive">
								<thead>
									<tr>
										<th>Sl</th>
										<?=($type=='paid')?'<th>Payment Trnx</th>':'';?>
										<th>Name</th>
										<th>User ID</th>
										<!--<th>Payment Mode</th>-->
										<th>A/C Number</th>
										<th>Bank</th>
										<th>Branch</th>
										<th>IFSC</th>
										<th>Req Date</th>
										<?=($type=='paid')?'<th>Paid Date</th>':'';?>
										<th>Amount</th>
										<th>Status</th>
										<th>Act</th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1;
								foreach ($bank as $key => $value) {
									$usr=$this->dbm->getWhere('users',['user_id'=>$value['user_id']]); ?>
									<tr class="<?php if($usr['block']==1) { echo 'bg-danger'; } ?>">
										<td><?=$i;?></td>
										<?=($type=='paid')?"<td>".$value['trnx_num']."</td>":"";?>
										<td><?=$usr['name'];?></td>
										<td><?=$value['user_id'];?></td>
										<!--<td><?=ucfirst($value['payment_mode']);?></td>-->
										<td><?=$value['account_number'];?></td>
										<td><?=$value['bank_name'];?></td>
										<td><?=$value['branch_name'];?></td>
										<td><?=$value['ifsc'];?></td>
										<td><?=$this->dbm->dateFormat($value['date']);?> <?=$value['time'];?></td>
										<?php if($type=='paid'){ echo "<td>";
											echo $this->dbm->dateFormat($value['paid_date'])." ".$value['paid_time'];
										echo "</td>"; } ?>
										<td><?=$value['amount']; $bankAmt=$bankAmt+$value['amount']; ?></td>
										<td>
											<?php if($value['status']==1) { ?>
											<button class="btn btn-success btn-xs" disabled>Paid</button>
											<?php }else{ ?>
											<button onclick="return exploreData('<?=$value['user_id'];?>','<?=$value['amount'];?>','<?=$value['payment_mode'];?>','<?=$value['id'];?>')" class="btn btn-warning btn-xs">Pending</button>
											<?php } ?>
										</td>
										<td>
											<a href="<?=base_url('auth/deleteData/withdraw/'.$value['id'].'/withdraw-request');?>" onclick="return confirm('Are you sure to delete')"> <i class="fa fa-trash txtred"> </i></a>
										</td>
									</tr>	
								<?php $i++;  }	?>
								</tbody>
							</table>
						</div>
						<div class="panel-footer txtcenter well">
							<b class="txtred"> Bank Withdraw Summary</b><br>
							<?php if($type=='paid'){ ?>
							<b>Total Paid Users : </b> <?=$i-1; ?><br>
							<b>Total Paid Amount : </b> <?=number_format($bankAmt,2); ?>
							<?php } else { ?>
							<b>Total Unpaid Users : </b> <?=$i-1; ?><br>
							<b>Total Unpaid Amount : </b> <?=number_format($bankAmt,2); ?>
							<?php } ?>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Fund Withdraw Request (PAYTM Account)</span>
						</div>
						<div class="panel-body">
							<table id="table2" class="table table-bordered table-condensed table-responsive">
								<thead>
									<tr>
										<th>Sl</th>
										<?=($type=='paid')?'<th>Payment Trnx</th>':'';?>
										<th>User ID</th>
										<th>Name</th>
										<th>Payment Mode</th>
										<th>A/C Number</th>
										<th>Req Date</th>
										<?=($type=='paid')?'<th>Paid Date</th>':'';?>
										<th>Amount</th>
										<th>Status</th>
										<th>Act</th>
									</tr>
								</thead>
								<tbody>
								<?php  $i=1;
								foreach ($paytm as $key => $value) { 
									$usr=$this->dbm->getWhere('users',['user_id'=>$value['user_id']]); ?>
									<tr class="<?php if($usr['block']==1) { echo 'bg-danger'; } ?>">
										<td><?=$i;?></td>
										<?php if($type=='paid'){ echo "<td>".$value['trnx_num']."</td>"; } ?>
										<td><?=$value['user_id'];?></td>
										<td><?=$usr['name'];?></td>
										<td><?=ucfirst($value['payment_mode']);?> </td>
										<td><?=$value['account_number'];?></td>
										<td><?=$this->dbm->dateFormat($value['date']);?> <?=$value['time'];?></td>
										<?php if($type=='paid'){ echo "<td>";
											echo $this->dbm->dateFormat($value['paid_date'])." ".$value['paid_time'];
											echo "</td>";
											 } ?>
										<td><?=$value['amount'];
										$paytmAmt=$paytmAmt+$value['amount'];
										?></td>
										<td>
											<?php if($value['status']==1) { ?>
											<button class="btn btn-success btn-xs" disabled>Paid</button>
											<?php }else{ ?>
											<button onclick="return exploreData('<?=$value['user_id'];?>','<?=$value['amount'];?>','<?=$value['payment_mode'];?>','<?=$value['id'];?>')" class="btn btn-warning btn-xs">Pending</button>
											<?php } ?>
										</td>
										<td>
											<a href="<?=base_url('auth/deleteData/withdraw/'.$value['id'].'/withdraw-request');?>" onclick="return confirm('Are you sure to delete')"> <i class="fa fa-trash txtred"> </i></a>
										</td>
									</tr>	
								<?php $i++; } ?>
								</tbody>
							</table>
						</div>
						<div class="panel-footer txtcenter well">
							<b class="txtred"> Paytm Withdraw Summary</b><br>
							<?php if($type=='paid'){ ?>
							<b>Total Paid Users : </b> <?=$i-1; ?><br>
							<b>Total Paid Amount : </b> <?=number_format($paytmAmt,2); ?>
							<?php } else { ?>
							<b>Total Unpaid Users : </b> <?=$i-1; ?><br>
							<b>Total Unpaid Amount : </b> <?=number_format($paytmAmt,2); ?>
							<?php } ?>
						</div>
					</div>         
		        </div>
	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <?php $this->load->view('include/data-table.php'); ?>
  <!--==========Footer End=============-->   
</body>
</html>
 <!-- Bootstrap Modal for Replied Query -->
          <div class="modal fade" id="withdrawModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                  	<div class="panel panel-primary" style="margin-bottom: 0px;">
		                <div class="panel-heading">
			               <p class="panel-title">Withdraw Request
			               <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
		                </div>
		                <div class="panel-body">
		                	<?=form_open('auth/withdrawPayment'); ?>
		                		<input type="hidden" name="id" value="" id="req_id">
		                		<input type="hidden" name="user_id" value="" id="userId">
		                		<input type="hidden" name="amount" value="" id="payAmount">
                  			<table class="table">
                  				<tr>
                  					<td>Requested Amount</td><th class="amount"></th>
                  					<td>Payment Mode</td><th id="payment_mode"></th>
                  				</tr>
                  				<tr>
                  					<td>User ID</td><th id="user_id"></th>
                  					<td>Sponcer ID</td><td id="sponcer_id"></td>
                  				</tr>
                  				<tr>
                  					<td>Name</td><td id="name"></td>
                  					<td>Wallet Balance</td><th id="wallet" colspan="txtred"></th>
                  				</tr>
                  				<tr>
                  					<th style="padding-top: 20px;">Transaction No.</th>
                  					<td colspan="2"><input type="text" name="trnx_num" class="form-control" placeholder="Enter payment Transaction Number"></td><td><button type="submit" class="btn form-control btn-primary btn-sm" id="paid"> Pay </button></td>
                  				</tr>
                  			</table>
                  			</form>
		                </div>
		            </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Modal End -->

        <div id="overlay" onclick="off()"></div>
 		<div class="loader">
		   <center>
		       <img class="loading-image" src="<?=base_url('assets/images/loader.gif');?>" alt="loading..">
		   </center>
		</div>
<style type="text/css">

.loader
{
    display: none;
    width:200px;
    height: 200px;
    position: fixed;
    top: 30%;
    left: 40%;
    text-align:center;
    margin-left: -50px;
    margin-top: -100px;
    z-index:2;
   
}
	
#overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5);
    z-index: 2;
    cursor: pointer;
}
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