<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Commission';?> | <?=$this->siteInfo['name'];?></title>
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
<!-- ///=====================All Contents Start Here==========================================/// -->
<div class="col-lg-12">
	<?php $dir=$this->db_model->globalSelect('flat_registration',['introducer'=>$this->logged['user_id']]);
	$areaLeft=0;
	$areaRight=0;
	$dirAmt=0;
	 ?>
		<!-- <div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-sitemap"></i> Commission on Direct Users </h3>
			</div>
			<div class="panel-body">
			<table class="table table-bordered table-hover table-striped" border="1" cellpadding="5" width="100%">
              <thead>
                <tr style="background-color: lavender;">
                  <th>Sl No.</th>
                  <th>User Reg No.</th>
                  <th>Plot No.</th>
                  <th>Date</th>
                  <th>Mode</th>
                  <th>Commission</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=1; $total=0; if(count($dir)>0){ foreach($dir as $list){ ?>
                <tr>
                  <td><?=$i;?></td>
                  <td><?=$list['registration'];?></td>
                  <?php $flat=$this->db_model->getWhere('flat',['id'=>$list['flat_id']]); ?>
                  <td><?=$flat['flat_num'];?></td>
                  <td><?=$this->db_model->dateFormat($list['registration_date']);?></td>
                  <td>
                    <?php if($list['emi']=='yes'){ ?>
                      <button type="button" class="btn btn-xs btn-primary">Installment</button>
                    <?php } else { ?>
                      <button type="button" class="btn btn-xs btn-primary">Cash</button>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($list['emi']=='yes'){ ?>
                      20000 &#8377;
                    <?php $dirAmt=$dirAmt+20000;
                     } else {  $dirAmt=$dirAmt+30000; ?>
                      30000 &#8377;
                    <?php } ?>
                  </td>
                </tr>
                <?php $i++; } ?>
                <?php } ?>
              </tbody>
            </table>
        </div>
    </div> -->
</div>
<?php
	$direct=$this->db_model->globalSelect('flat_registration',['introducer'=>$this->logged['user_id']]);
	$even=[];
	$odd=[];
	foreach ($direct as $key => $value)
	{
		if($key%2==0)
		{
			$even[]=$value;
		}else
		{
			$odd[]=$value;
		}
	}
?>


<div class="col-lg-12">
	<div class="panel panel-info txtSize">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-sitemap"></i> Commison On SelfBussiness </h3>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover table-striped" border="1" cellpadding="5" width="100%">
	            <thead>
	                <tr style="background-color: lavender;">
	                  	<th>Sl No.</th>
	                  	<th>Tr. No.</th>
	                  	<th>Flat No.</th>
	                  	<th>Inst Amt</th>
	                  	<th>Inst Comm</th>
	                  	<th>Rank</th>
	                  	<th>Date</th>
	                  
	                </tr>
	            </thead>
	            <tbody>
	            <?php $i=1;
				   	$comm_total =0;
				    $ass=$this->db_model->globalSelect('commission_new',['agent_id'=>$this->logged['user_id']]);
				 // print_r($ass);
				   
			        ?>
			        <?php foreach ($ass as $key => $value): ?>
			        	<tr>
			        		<td><?=$i; ?></td>
			        		<td><?=$value['transaction']; ?></td>
			        		<?php $flat= $this->db_model->getWhere('flat',['id'=>$value['flat_id']]);
			        		//print_r($flat);
			        		 ?>
			        		<td><?=$flat['flat_num']; ?></td>
			        		<td><?=$value['installment_amount']; ?> &#8377;</td>
			        		<td><?=$value['commission']; ?> &#8377;</td>
			        		<td><?=$value['rank']; ?></td>
			        		<td><?=$value['deposit_date']; ?></td>

			        		<?php $comm_total += $value['commission']; ?>
			        	</tr>
			        	
			        <?php $i++; endforeach ?>
	            </tbody>
        	</table>
        </div>
    </div>
</div>

<div class="col-lg-12">
	<div class="panel panel-info txtSize">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-sitemap"></i> Commison On SelfBussiness </h3>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover table-striped" border="1" cellpadding="5" width="100%">
	            <thead>
	                <tr style="background-color: lavender;">
	                  	<th>Sl No.</th>
	                  	<th>Tr. No.</th>
	                  	<th>Income Type Name</th>
	                  	<th>Inst Amt</th>
	                  	<th>Inst Comm</th>
	                  	<th>Rank</th>
	                  	<th>Date</th>
	                  
	                </tr>
	            </thead>
	            <tbody>
	            <?php $i=1;
				   	$ex_comm_total =0;
				    $ass=$this->db_model->globalSelect('commission_extra',['agent_id'=>$this->logged['user_id']]);
				  //print_r($ass);
				   
			        ?>
			        <?php foreach ($ass as $key => $value): ?>
			        	<tr>
			        		<td><?=$i; ?></td>
			        		<td><?=$value['transaction']; ?></td>
			        		<?php $ex_Ty= $this->db_model->getWhere('level_incom_type',['id'=>$value['commission_type']]);
			        		//print_r($ex_Ty);
			        		 ?>
			        		<td><?=$ex_Ty['incomeTypeName']; ?></td>
			        		<td><?=$value['installment_amount']; ?> &#8377;</td>
			        		<td><?=$value['commission']; ?> &#8377;</td>
			        		<td><?=$value['rank']; ?></td>
			        		<td><?=$value['deposit_date']; ?></td>

			        		<?php $ex_comm_total += $value['commission']; ?>
			        	</tr>
			        	
			        <?php $i++; endforeach ?>
	            </tbody>
        	</table>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-lg-8 col-lg-offset-2 well">
		<div class="panel panel-primary txtSize">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-inr"></i> Commission Summary </h3>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-hover table-striped">
		            <thead>
		                <!-- <tr>
		                  	<th colspan="2">Total Area Sell </th><td colspan="2"><?=$areaLeft+$areaRight;?></td>
		                </tr>
		                <tr>
		                  	<th class="txtcenter" colspan="2">Left </th><th class="txtcenter" colspan="2">Right</th>
		                </tr>
		                <tr>
		                  	<th>Total Area Sell (Left)</th><td><?=$areaLeft;?></td>
		                  	<th>Total Area Sell (Right)</th><td><?=$areaRight;?></td>
		                </tr>
		                <?php $l=floor($areaLeft/1000); $r=floor($areaRight/1000);
		                if($l>$r) {$min=$r; }else{ $min=$l; } ?>
		                <tr>
		                  	<th>Matching Area</th><td><?=$min*1000;?></td>
		                  	<th>Matching Area</th><td><?=$min*1000;?></td>
		                </tr>
		                <tr>
		                  	<th>Area Carry Forword (Left)</th><td><?=$areaLeft-$min*1000;?></td>
		                  	<th>Area Carry Forword (Right)</th><td><?=$areaRight-$min*1000;?></td>
		                </tr> -->
		                <tr>
		                  	<th colspan="3">Extra Commission</th><td><?=$ex_comm_total;?> &#8377;</td>
		                </tr>
		                <tr>
		                  	<th colspan="3">Commission Amount</th><td><?=$comm_total;?> &#8377;</td>
		                </tr>
		               <!--  <tr>
		                  	<th colspan="3">Commission Amount (Direct Sell) </th><td><?=$dirAmt;?></td>
		                </tr> -->
		                <tr class="bg-danger">
		                  	<th colspan="3">Net Commission</th><th><?=$net=$comm_total+$ex_comm_total;?> &#8377;</th>
		                </tr>
		                <tr>
		                  	<th colspan="4">In Words : <?=$this->db_model->amount($net);?> </th>
		                </tr>
		            </thead>
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
<style type="text/css">
	.txtSize{
		font-size: 13px;
	}
</style>