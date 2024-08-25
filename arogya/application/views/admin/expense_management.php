<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Expense Management';?> | <?=$this->siteInfo['name'];?></title>
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
		             <center><button data-toggle="collapse in" class="btn btn-primary" data-target="#demo">New Expense Entry</button></center>	
					<div id="demo" class="collapse in ">
					<div class="col-lg-6 col-lg-offset-3" style="padding: 10px; box-shadow: 0px 1px 10px 1px #33A5E7; margin-top: 10px;">
						<?= form_open('auth/expenseManagement/add',['class'=>'form-horizontal']); ?>
						<legend>Insert New Expense Voucher</legend>
					    <div class="form-group">
					      <label for="select" class="col-lg-3 control-label">Select Group</label>
					      <div class="col-lg-9">
					        <select name="expense_category" class="form-control" required>
					          <option value="">Please Select Category</option>
					          <?php foreach($category as $value): ?>
					          <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
					          <?php endforeach; ?>
					        </select>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="col-lg-3 control-label">Select Date</label>
					      <div class="col-lg-9">
					        <span id="datepairExample">
					        <input type="text" value="<?=date('d-m-Y');?>" name="entry_date" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
					        </span>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="col-lg-3 control-label">Amount</label>
					      <div class="col-lg-9">
					        <input type="text" value="" name="amount" class="form-control date" id="" placeholder="Enter Amount" required>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="col-lg-3 control-label">Remark</label>
					      <div class="col-lg-9">
					        <input type="text" value="" name="remark" class="form-control date" id="datepicker" placeholder="Any Remark (Optional)" >
					      </div>
					    </div>
					    <div class="form-group">
					      <div class="col-lg-9 col-lg-offset-3">
					        <button type="reset" class="btn btn-default">Reset</button>
					        <button type="submit" class="btn btn-primary">Submit</button>
					      </div>
					    </div>
					</form>
					</div>
				</div>
					<!-- form end-->
						<!--//////////////////Expense Rport Start ////////////////////////////////////-->
					<?php if(isset($data)):  ?>
						<div class="col-lg-10 col-lg-offset-1">
							<hr>
							<table id="table1" class="table table-striped table-hover table-bordered" style="margin-top: 30px;">
							  <thead>
							    <tr>
							      <th>Sl</th>
							      <th>Group</th>
							      <th>Amount</th>
							      <th>Date</th>
							      <th>Remark</th>
							      <th>Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  <?php if(count($data)) { ?>
							  <?php $i=1; foreach($data as $expenseReport): ?>
							    <tr>
							      <td><?= $i; ?></td>
							      <?php $cate=$this->dbm->getWhere('expense_category',['id'=>$expenseReport['expense_category']]); ?>
							      <td><?= $cate['name']; ?></td>
							      <td><?= $expenseReport['amount']; ?></td>
							      <td><?=$this->dbm->dateFormat($expenseReport['entry_date']);?></td>
							      <td><?= $expenseReport['remark']; ?></td>
							      <td>
							      	<button onclick="return printVoucher('<?=$this->dbm->dateFormat($expenseReport['entry_date']);?>','<?=$cate['name']; ?>','<?= $expenseReport['remark']; ?>','<?= $expenseReport['amount']; ?>','<?= $expenseReport['id']; ?>');" class="btn btn-primary btn-sm"> <i class="fa fa-print"></i></button> 
							      	<a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete.')" href="<?= base_url('auth/deleteData/expense_entry/'.$expenseReport['id'].'/expense_management'); ?>"><span class="glyphicon glyphicon-trash"></span></a> 
							      </td>
							    </tr>
							   <?php $i++; endforeach; ?>
							   <?php } else { ?>
							    <tr><td colspan="6">No Records Found</td></tr>
								<?php } ?>
							  </tbody>
							</table> 
						</div>
						<?php endif; ?>
						<!--//////////////////Expense Rport Start ////////////////////-->
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
 <!-- Bootstrap Modal for Notice -->
          <div class="modal fade" id="noticeModal" role="dialog">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                  	<div class="panel panel-primary" style="margin-bottom: 0px;">
		                <div class="panel-heading">
			               <p class="panel-title"><button class="btn btn-default printId"> Print <i class="fa fa-print"></i></button>
			               <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
		                </div>
		                <div class="panel-body" id="myTable">
		                	<div style="border: 1px solid; padding: 15px;">
		                	<table class="table table-bordered" style="width: 100%;margin-bottom: 15px;">
								<tr>
							<td rowspan="3">
							<center><img src="<?=base_url('uploads/'.$this->siteInfo['image']); ?>" style="height: 70px;width: 70px;"/></center>
							</td>
							</tr>
							<tr align="center">
								<td colspan='5'><b><?=$this->siteInfo['name'];?></b></td>
							</tr>
							<tr align="center">
								<td colspan='5'><?=$this->siteInfo['address'];?><br>
									<b>Expense Voucher</b></td>
							</tr>
							</table>
                  			<table class="table table-bordered" width="100%">
                  				<tr>
                  					<td style="min-width: 150px;"><b>Expense Category : </b></td>
                  					<td class="expenseGroup"></td>
                  					<td style="min-width: 100px;"><b>Print Date : </b></td>
                  					<td style="min-width: 100px;"><?=date('d-M-Y');?></td>
                  				</tr>
                  				<tr>
                  					<td><b>Amount : </b></td>
                  					<td class="expenseAmount"></td>
                  					<td><b>Entry Date : </b></td>
                  					<td class="expenseDate"></td>
                  				</tr>
                  				<tr>
                  					<td><b>Description : </b></td>
                  					<td class="expenseDetail"></td>
                  					<td><b>Voucher Id : </b></td>
                  					<td class="expenseId"></td>
                  				</tr>
                  				<tr>
                  					<td colspan="2"></td>
                  					<th colspan="2"><br><b>Authorised Signature</b></th>
                  				</tr>
                  			</table>
                  			</div>
                  			<p style="margin-top: 20px; margin-bottom: 20px; border-bottom: 1px solid; width: 100%;">	</p>
                  			<div style="border: 1px solid; padding: 15px;">
		                	<table class="table table-bordered" style="width: 100%;margin-bottom: 15px;">
								<tr>
							<td rowspan="3">
							<center><img src="<?=base_url('uploads/'.$this->siteInfo['image']); ?>" style="height: 70px;width: 70px;"/></center>
							</td>
							</tr>
							<tr align="center">
								<td colspan='5'><b><?=$this->siteInfo['name'];?></b></td>
							</tr>
							<tr align="center">
								<td colspan='5'><?=$this->siteInfo['address'];?><br>
									<b>Expense Voucher (For Office Use Only)</b></td>
							</tr>
							</table>
                  			<table class="table table-bordered" width="100%">
                  				<tr>
                  					<td style="min-width: 150px;"><b>Expense Category : </b></td>
                  					<td class="expenseGroup"></td>
                  					<td style="min-width: 100px;"><b>Print Date : </b></td>
                  					<td style="min-width: 100px;"><?=date('d-M-Y');?></td>
                  				</tr>
                  				<tr>
                  					<td><b>Amount : </b></td>
                  					<td class="expenseAmount"></td>
                  					<td><b>Entry Date : </b></td>
                  					<td class="expenseDate"></td>
                  				</tr>
                  				<tr>
                  					<td><b>Description : </b></td>
                  					<td class="expenseDetail"></td>
                  					<td><b>Voucher Id : </b></td>
                  					<td class="expenseId"></td>
                  				</tr>
                  				<tr>
                  					<td colspan="2"></td>
                  					<th colspan="2"><br><b>Authorised Signature</b></th>
                  				</tr>
                  			</table>
                  			</div>
		                </div>
		                <div class="modal-footer">
		                	<button class="btn btn-primary printId"> Print </button>
		                </div>
		            </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Modal End -->
<script type="text/javascript">
	$('#table1').dataTable();
	function getAccountbill()
	{
		var x=$("#selectGroup").val();
		$.ajax({
			url:"<?= base_url('branch/getledgerData'); ?>",
			data:{group_name:x},
			type:'POST',
			success: function(data)
			{
				$("#account_bill").html(data);
			}
		});
	}
	function printVoucher(date,group,detail,amount,id){
	$('.expenseDate').html(date);
	$('.expenseGroup').html(group);
	$('.expenseDetail').html(detail);
	$('.expenseAmount').html(amount);
	$('.expenseId').html(id);
	$('#noticeModal').modal('show');
}
 $(".printId").click(function(){
        var printContents = $("#myTable").html();
         var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
	    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
	    frameDoc.document.write('<html><head><link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/mystyle.css'); ?>" /></head><body onload="window.print()">' + printContents + '</body></html>');
	    frameDoc.document.close();
    }); 
</script>
