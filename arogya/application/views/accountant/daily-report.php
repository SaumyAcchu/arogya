<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Expense Report';?> | <?=$this->siteInfo['name'];?></title>
  	<?php $this->load->view('accountant/include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
    	<?php $this->load->view('accountant/include/topbar'); ?>
  <!--===========top nav end===========-->
  	<div class="wrapper" id="wrapper">
    	<div class="left-container" id="left-container">
      	<!--========== Sidebar Start =============-->
      		<?php $this->load->view('accountant/include/sidebar',$page); ?>
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
		        <?php $this->load->view('accountant/include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
		        <div class="row padding-top">
		            <div class="col-lg-8 col-lg-offset-2">
						<table class="table table-striped table-hover table-bordered">
						   <tbody>
						   <?= form_open('accountant/dailyReport'); ?>
						    <tr>
						      <td>
						        <div class="input-group" id="datepairExample">
						           <span class="input-group-addon" id="basic-addon1">From</span>
						           <input type="text" value="<?=date('d-M-Y');?>" name="dateFrom" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
						        </div>
						      </td>
						      <td>
						      	<div class="input-group" id="datepairExample">
						           <span class="input-group-addon" id="basic-addon1">To</span>
						           <input type="text" value="<?=date('d-M-Y');?>" name="dateTo" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
						        </div>
						      </td>
						      <td style="padding-top: 12px;">
						     <button class="btn btn-danger btn-sm">Get Report</button></td>
						    </tr>
						    </form>
						  </tbody>
						</table>
					</div>
					<div class="col-lg-10 col-lg-offset-1" id="myTable">
						<?php if(isset($date)) {
							echo '<b>Expense Report From : </b>'.$date['from'].' <b> To : </b>'.$date['to'];
						}else { echo '<b>Expense Report For : </b> '.date('d-M-Y'); } ?>
					  	<table class="table table-bordered table-hover" id="table1">
					  		<thead>
					  		<tr>
					  			<th>Sl.</th>
					  			<th>Expense Type</th>
					  			<th>Date</th>
					  			<th>Remark</th>
					  			<th>Amount</th>
					  		</tr>
					  		</thead>
					  		<tbody>
					  		<?php if($data){ $i=1;$total=0; foreach ($data as $key => $value)
					  		{
					  			$cate=$this->db->get_where('expense_category',['id'=>$value['expense_category']])->row_array(); ?>
					  			<tr>
					  				<td><?=$i;?></td>
					  				<td><?=$cate['name'];?></td>
					  				<?php $date1=new DateTime($value['entry_date']);
					  				$total=$total+$value['amount']; ?>
					  				<td><?=$date1->format('d-M-Y');?></td>
					  				<td><?=$value['remark'];?></td>
					  				<td style="text-align: right;"><?=$value['amount'];?></td>
					  			</tr>	
					  		<?php $i++; } ?>
					  		<tr class="bg-info">
					  			<td><?=$i;?></td><td></td><td></td><th>Total</th><td style="text-align: right;"><?=$total;?></td>
					  		</tr>
					  		<?php } else { ?>
					  		<tr>
					  			<th colspan="5"> No Records Found!</th>
					  		</tr>
					  		<?php } ?>
					  		</tbody>
					  	</table>
					</div>         
		        </div>
	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('accountant/include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>
<script type="text/javascript">
	$('#table1').dataTable();
	$("#printId").click(function(){
        var printContents = $("#myTable").html();
         var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
	    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
	    frameDoc.document.write('<html><head><link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/styleforprint.css'); ?>" /></head><body onload="window.print()">' + printContents + '</body></html>');
	    frameDoc.document.close();
    });


    $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
                            
</script>