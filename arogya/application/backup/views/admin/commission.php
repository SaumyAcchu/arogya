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
		<div class="panel panel-primary">
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
                      20000
                    <?php $dirAmt=$dirAmt+20000;
                     } else {  $dirAmt=$dirAmt+30000; ?>
                      30000
                    <?php } ?>
                  </td>
                </tr>
                <?php $i++; } ?>
                <?php } ?>
              </tbody>
            </table>
        </div>
    </div>
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
<!-- <div class="col-lg-6">
	<div class="panel panel-success txtSize">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-sitemap"></i> Down Line Customers (Left) </h3>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover table-striped" border="1" cellpadding="5" width="100%">
	            <thead>
	                <tr style="background-color: lavender;">
	                  	<th>Sl No.</th>
	                  	<th>User Reg No.</th>
	                  	<th>Plot No.</th>
	                  	<th>Date</th>
	                  	<th>Sponcer ID</th>
	                  	<th>Area Sqft</th>
	                </tr>
	            </thead>
	            <tbody>
	            <?php 
	            	$downLeft=[];
	            	$leftUser=[];
				    $ass=$this->db_model->getWhere('users',['sponcer_id'=>$this->logged['user_id'],'place'=>'Left']);
				    if($ass)
				    {
						unset($_SESSION['dList']);
						$_SESSION['dList']=[];
						$res=$this->Commission_model->downLine($ass['user_id']);
						$arr=$_SESSION['dList'];
						if(!empty($arr))
						{
							sort($arr);
							foreach ($arr as $key => $value)
							{
								foreach ($value as $key => $val)
								{
									$downLeft[]=$val['user_id'];
								}
							}
						}
						array_push($downLeft, $ass['user_id']);
					}
					krsort($downLeft);
					foreach ($downLeft as $key => $value)
		            {
		              	$left=$this->db_model->globalSelect('flat_registration',['introducer'=>$value]);
		              	if($left)
		              	{
		              		foreach($left as $list)
		              		{
		              			$leftUser[]=$list;
			            	}
		              	}
		            }
		            if($even)
		            {
		            	foreach ($even as $key => $value)
		            	{
		            		array_unshift($leftUser, $value);
		            	}
		            }
	              	if($leftUser)
	              	{
	              		$i=1;
	              		foreach($leftUser as $list)
	              		{ ?>
			                <tr>
			                  	<td><?=$i;?></td>
			                  	<td><?=$list['registration'];?></td>
			                  	<?php $flat=$this->db_model->getWhere('flat',['id'=>$list['flat_id']]); ?>
			                  	<td><?=$flat['flat_num'];?></td>
			                  	<td><?=$this->db_model->dateFormat($list['registration_date']);?></td>
			                  	<td class="txtupper"><?=$list['introducer'];?></td>
			                  	<td><?=$flat['area'];
			                  	$areaLeft=$areaLeft+$flat['area'];
			                  	?></td>
			                </tr><?php  $i++;
		            	}
	              	}else
		            {
		            	echo "<tr><td colspan='6'>No Records Found</td></tr>";
		            }
			        ?>
	            </tbody>
        	</table>
        </div>
    </div>
</div>

<div class="col-lg-6">
	<div class="panel panel-info txtSize">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-sitemap"></i> Down Line Customers (Right) </h3>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover table-striped" border="1" cellpadding="5" width="100%">
	            <thead>
	                <tr style="background-color: lavender;">
	                  	<th>Sl No.</th>
	                  	<th>User Reg No.</th>
	                  	<th>Plot No.</th>
	                  	<th>Date</th>
	                  	<th>Sponcer ID</th>
	                  	<th>Area Sqft</th>
	                </tr>
	            </thead>
	            <tbody>
	            <?php 
	            	$downRight=[];
	            	$rightUser=[];
				    $ass=$this->db_model->getWhere('users',['sponcer_id'=>$this->logged['user_id'],'place'=>'Right']);
				    if($ass)
				    {
						unset($_SESSION['dList']);
						$_SESSION['dList']=[];
						$res=$this->Commission_model->downLine($ass['user_id']);
						$arr=$_SESSION['dList'];
						if(!empty($arr))
						{
							sort($arr);
							foreach ($arr as $key => $value)
							{
								foreach ($value as $key => $val)
								{
									$downRight[]=$val['user_id'];
								}
							}
						}
						array_push($downRight, $ass['user_id']);
					}
					krsort($downRight);
					foreach ($downRight as $key => $value)
		            {
		              	$right=$this->db_model->globalSelect('flat_registration',['introducer'=>$value]);
		              	if($right)
		              	{
		              		foreach($right as $list)
		              		{
		              			$rightUser[]=$list;
			            	}
		              	}
		            }
		           	if($odd)
		            {
		            	foreach ($odd as $key => $value)
		            	{
		            		array_unshift($rightUser, $value);
		            	}
		            }
	              	if($rightUser)
	              	{
	              		$i=1;
	              		foreach($rightUser as $list)
	              		{ ?>
			                <tr>
			                  	<td><?=$i;?></td>
			                  	<td><?=$list['registration'];?></td>
			                  	<?php $flat=$this->db_model->getWhere('flat',['id'=>$list['flat_id']]); ?>
			                  	<td><?=$flat['flat_num'];?></td>
			                  	<td><?=$this->db_model->dateFormat($list['registration_date']);?></td>
			                  	<td class="txtupper"><?=$list['introducer'];?></td>
			                  	<td><?=$flat['area'];
			                  	$areaRight=$areaRight+$flat['area'];
			                  	?></td>
			                </tr><?php  $i++;
		            	}
	              	}else
		            {
		            	echo "<tr><td colspan='6'>No Records Found</td></tr>";
		            } 
			        ?>
	            </tbody>
        	</table>
        </div>
    </div>
</div> -->
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
			        		<td><?=$value['installment_amount']; ?></td>
			        		<td><?=$value['commission']; ?></td>
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
				    $ex_com=$this->db_model->globalSelect('commission_extra',['agent_id'=>$this->logged['user_id']]);
				   
			        ?>
			        <?php foreach ($ex_com as $key => $value): ?>
			        	<tr>
			        		<td><?=$i; ?></td>
			        		<td><?=$value['transaction']; ?></td>
			        		<?php $flat= $this->db_model->getWhere('flat',['id'=>$value['flat_id']]);
			        		//print_r($flat);
			        		 ?>
			        		<td><?=$flat['flat_num']; ?></td>
			        		<td><?=$value['installment_amount']; ?></td>
			        		<td><?=$value['commission']; ?></td>
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
		                	
		                </tr>
		                <tr>
		                  	<th colspan="3">Commission Amount</th><td><?=$comm_total;?></td>
		                </tr>
		                <tr>
		                  	<th colspan="3">Commission Amount (Direct Sell) </th><td><?=$dirAmt;?></td>
		                </tr>
		                <tr class="bg-danger">
		                  	<th colspan="3">Net Commission</th><th><?=$net=$comm_total+$dirAmt;?></th>
		                </tr>
		                <tr>
		                  	<th colspan="4">In Words : <?=$this->db_model->amount($net);?></th>
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
  <style type="text/css">
  	.txtSize{
  		font-size: 13px;
  	}
  </style>
</body>
</html>
