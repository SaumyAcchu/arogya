<!DOCTYPE html>
<html>
<head>
	<title><?=$this->siteInfo['name'];?></title>
	<?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
	<div class="container-fluid no-padding display-table">
		<div class="row no-padding display-table-row">
			<div class="col-lg-2 no-padding bx-shdw col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
				<?php $this->load->view('includes/sidebar.php',['page'=>'team-business']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Team Business</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
					<?php


					unset($_SESSION['dList']);
					$_SESSION['dList']=[];
					$res=$this->Commission_model->downLineSelfBusiness();
					$arr=$_SESSION['dList'];
					//krsort($arr);
					//echo '<pre>'; print_r($arr); exit();
					//  if($res)
					//  { $i=1; $total=0; 
					// 	foreach ($res as $key1 => $value)
					// 	{
					// 		if($value['status']==1)
					// 		{
					// 			$total=$total+$this->siteInfo['business'];
					// 			$i++;
					// 		}
						
					// 	}
					// }else
					// {
					// 	$total=0;
					// }
					$bus=$this->db->select_sum('pay_amount')->where(['sponcer'=>$this->logged['user_id']])->get('payment')->row_array();
								$total=$bus['pay_amount'];
				?>
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Total Team Business For - <b><?=$this->logged['user_id'];?></b> | My Business : <?=$total;?></span>
						</div>
						<div class="panel-body">
							<div class="col-lg-8 col-lg-offset-2">
							    <form method="post" class="form-horizontal">
								<table class="table table-striped table-hover table-bordered">
								    <tr>
								      <td>
								        <div class="input-group" id="datepairExample">
								           <span class="input-group-addon" id="basic-addon1">From</span>
								           <input type="text" value="<?=set_value('dateFrom');?>" name="dateFrom" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
								           <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
								        </div>
								      </td>
								      <td>
								      	<div class="input-group" id="datepairExample">
								           <span class="input-group-addon" id="basic-addon1">To</span>
								           <input type="text" value="<?=set_value('dateTo');?>" name="dateTo" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
								           <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
								        </div>
								      </td>
								      <td style="padding-top: 12px;">
								     	<button type="submit" name="report" class="btn btn-danger btn-sm"> Get Report</button>
								      </td>
								    </tr>
								</table>
								</form>
						  	</div>
							<table id="table1" class="table table-bordered">
								<thead>
									<tr>
										<th>Sl</th>
										<th>User ID</th>
										<th>Name</th>
										<th>Sponcer ID</th>
										<th>Reg Date</th>
										<th>Current Business</th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1; $act=0;
								if($arr){
								foreach($arr as $key2 => $val2){
								foreach ($val2 as $key1 => $value) {
										if(isset($_POST['report']))
										{
											$from=$_POST['dateFrom']; $to=$_POST['dateTo'];
											if($value['reg_date']>=$from && $value['reg_date']<=$to)
											{ ?>
												<tr>
													<td><?=$i;?></td>
												<td><?=$value['user_id'];?></td>
												<td><?=$value['name'];?></td>
												<td><?=$value['sponcer_id'];?></td>
												<td><?=$this->db_model->dateFormat($value['reg_date']);?></td>
												<td class="txtright">
												<?php
												$bus=$this->db->select_sum('pay_amount')->where(['sponcer'=>$value['user_id']])->get('payment')->row_array();
												echo number_format($bus['pay_amount']);
												$total=$total+$bus['pay_amount'];
												?>
												</td>
												</tr><?php
										$i++;	}
										}else
										{ ?>
											<tr>
												<td><?=$i;?></td>
												<td><?=$value['user_id'];?></td>
												<td><?=$value['name'];?></td>
												<td><?=$value['sponcer_id'];?></td>
												<td><?=$this->db_model->dateFormat($value['reg_date']);?></td>
												<td class="txtright">
												<?php
												$bus=$this->db->select_sum('pay_amount')->where(['sponcer'=>$value['user_id']])->get('payment')->row_array();
												echo $bus['pay_amount'];
												$total=$total+$bus['pay_amount'];
												?>
												</td>
											</tr><?php
									$i++; }	} ?>
										
								<?php  }	}else{ ?>
									<tr>
										<td colspan="7">No Records Found</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-lg-6 col-lg-offset-3 well">
						<table class="table table-striped table-hover table-bordered">
							<tr>
								<td colspan="2"><center><h4>Business Summary</h4></center></td>
							</tr>
							<tr>
								<th>Total Members</th><td><?=$i-1;?></td>
							</tr>
							<tr>
								<th>Total Business</th><td><?=number_format($total);?></td>
							</tr>
							<tr>
								<th>Amount in Words</th><td>
						
						<!--code for digit to string -->
        <?php
        $number = $total;
         $no = round($number);
         $point = round($number - $no, 2) * 100;
         $hundred = null;
         $digits_1 = strlen($no);
         $i = 0;
         $str = array();
         $words = array('0' => '', '1' => 'One', '2' => 'Two',
          '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
          '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
          '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
          '13' => 'Thirteen', '14' => 'Fourteen',
          '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
          '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
          '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
          '60' => 'Sixty', '70' => 'Seventy',
          '80' => 'Eighty', '90' => 'Ninety');
         $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
         while ($i < $digits_1) {
           $divider = ($i == 2) ? 10 : 100;
           $number = floor($no % $divider);
           $no = floor($no / $divider);
           $i += ($divider == 10) ? 1 : 2;
           if ($number) {
              $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
              $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
              $str [] = ($number < 21) ? $words[$number] .
                  " " . $digits[$counter] . $plural . " " . $hundred
                  :
                  $words[floor($number / 10) * 10]
                  . " " . $words[$number % 10] . " "
                  . $digits[$counter] . $plural . " " . $hundred;
           } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        echo $result . "Rupees";
       ?> 
								</td>
							</tr>
						</table>					
					</div>
<!-- ///=====================All Contents End Here============================================/// -->
				</div>
				<?php $this->load->view('includes/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
$('#table1').DataTable();
} );

	$('#datepairExample .date').datepicker({
                    'format': 'yyyy-mm-dd',
                    'autoclose': true
                });
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