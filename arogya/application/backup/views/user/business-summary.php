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
				<?php $this->load->view('includes/sidebar.php',['page'=>'business-summary']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Business Summary</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
			
<div class="col-lg-12" id="treeDiv" style="">
	<legend>Level 1</legend>
	<div class="tree" style="position: static; display: none;">
	    <ul>
			<li>
				<?php if($this->logged['status']==1)
				{ $cls='activate'; } else { $cls='inactive'; } ?>
				<a href="#" class="<?=$cls;?>" onmouseover="myfunction('<?=$this->logged['user_id']; ?>','<?=$this->logged['name']; ?>')" onmouseout="myfunction1()"><?=$this->logged['user_id'];?></a>
				<?php $parent=$this->db_model->globalSelect('users',['sponcer_id'=>$this->logged['user_id']]);
					if($parent){ ?>
				<ul>
					<?php $p=0;
					foreach ($parent as $key => $value) { ?>
					<li>
						<?php if($value['status']==1)
						{ $cls='activate'; } else { $cls='inactive'; } ?>
						<a class="<?=$cls;?>" href="#" onmouseover="myfunction('<?=$value['user_id']; ?>','<?=$value['name']; ?>')" onmouseout="myfunction1()"><?=$value['user_id'];?>
						</a>
						<ul>
						<?php
						$child=$this->db_model->globalSelect('users',['sponcer_id'=>$value['user_id']]);
						if($child) {
						 foreach ($child as $key1 => $val) { ?>
							<li>
								<?php if($val['status']==1)
								{ $cls='activate'; } else { $cls='inactive'; } ?>
								<a class="<?=$cls;?>" href="#" onmouseover="myfunction('<?=$val['user_id']; ?>','<?=$val['name']; ?>')" onmouseout="myfunction1()"><?=$val['user_id'];?>
								</a>
							</li>
						<?php $p++; } } ?>
						</ul>
					</li>
					<?php $p++; } } ?>
				</ul>
			</li>
		</ul>
	</div>
</div>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<b>Parent ID : <?=$this->logged['user_id'];?> (<?=$this->logged['name'];?>)</b>
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Level 1 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$p;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$p*400;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($this->logged['lvl1']==1)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($this->logged['lvl1']==1){ ?>
				<tr>
					<th>Direct Bouns</th><td>1000</td>
				</tr>
				<tr>
					<th>2nd Level Joining Amount</th><td>1400</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
<?php 
$find=$this->db_model->getWhere('activated',['user_id'=>$this->logged['user_id']]);
if($find)
{
	$lvl=$this->db_model->globalSelect('activated',['id>'=>$find['id']]);
	$count=count($lvl);
	$a=1;
	if($count>0)
	{  ?><br><br>
		<legend>Level 2</legend>
		
		<table class="table table-bordered table-hover table-condensed table-striped" style="display: none;">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $l2=0;
			foreach ($lvl as $key => $value) {
			if($a>0 && $a<7){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns2=600;?></td>
				</tr>
			<?php $a++; $l2++; } } ?>
		</table>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<b>Parent ID : <?=$this->logged['user_id'];?> (<?=$this->logged['name'];?>)</b>
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Level 2 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$l2;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$l2*600;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($l2>5)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($l2>5){ ?>
				<tr>
					<th>Direct Bouns</th><td>1500</td>
				</tr>
				<tr>
					<th>2nd Level Joining Amount</th><td>2100</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
		<?php
	}
	if($count>6)
	{ ?><br><br>
		<legend>Level 3</legend>
		<table class="table table-bordered" style="display: none;">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr> 
			<?php $l3=0;
			foreach ($lvl as $key => $value) {
			if($count-6>$l3){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns3=900;?></td>
				</tr>
			<?php $a++; $l3++; } } ?>
		</table>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<b>Parent ID : <?=$this->logged['user_id'];?> (<?=$this->logged['name'];?>)</b>
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Level 3 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$l3;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$l3*900;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($l3>5)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($l3>5){ ?>
				<tr>
					<th>Direct Bouns</th><td>2000</td>
				</tr>
				<tr>
					<th>2nd Level Joining Amount</th><td>3400</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
		<?php
	}
	if($count>12)
	{  ?><br><br>
		<legend>Level 4</legend>
		<table class="table table-bordered" style="display: none;">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $l4=0;
			foreach ($lvl as $key => $value) {
			if($count-12>$l4){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns4=1100;?></td>
				</tr>
			<?php $a++; $l4++; } } ?>
		</table>
		<div class="row">
		<b>Parent ID : <?=$this->logged['user_id'];?> (<?=$this->logged['name'];?>)</b>
		<div class="col-lg-6 col-lg-offset-3 well">
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Level 4 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$l4;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$l4*1100;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($l4>5)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($l4>5){ ?>
				<tr>
					<th>Direct Bouns</th><td>4100</td>
				</tr>
				<tr>
					<th>2nd Level Joining Amount</th><td>2500</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
		<?php
	}
	if($count>18)
	{  ?><br><br>
		<legend>Level 5</legend>
		<table class="table table-bordered" style="display: none;">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $l5=0;
			foreach ($lvl as $key => $value) {
			if($count-18>$l5){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns5=1400;?></td>
				</tr>
			<?php $a++; $l5++; } } ?>
		</table>
		<div class="row">
		<b>Parent ID : <?=$this->logged['user_id'];?> (<?=$this->logged['name'];?>)</b>
		<div class="col-lg-6 col-lg-offset-3 well">
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Level 5 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$l5;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$l5*1400;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($l5>5)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($l5>5){ ?>
				<tr>
					<th>Direct Bouns</th><td>3000</td>
				</tr>
				<tr>
					<th>2nd Level Joining Amount</th><td>5400</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
		<?php
	}
	if($count>24)
	{  ?><br><br>
		<legend>Level 6</legend>
		<table class="table table-bordered" style="display: none;">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $l6=0;
			foreach ($lvl as $key => $value) {
			if($count-24>$l6){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns6=2100;?></td>
				</tr>
			<?php $a++; $l6++; } } ?>
		</table>
		<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<b>Parent ID : <?=$this->logged['user_id'];?> (<?=$this->logged['name'];?>)</b>
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Level 6 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$l6;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$l6*2100;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($l6>5)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($l6>5){ ?>
				<tr>
					<th>Direct Bouns</th><td>4000</td>
				</tr>
				<tr>
					<th>2nd Level Joining Amount</th><td>8600</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
		<?php
	}
	if($count>30)
	{  ?><br><br>
		<legend>Level 7</legend>
		<table class="table table-bordered" style="display: none;">
			<tr>
				<th>Sl</th>
				<th>User ID</th>
				<th>Name</th>
				<th>Sponcer ID</th>
				<th>Bonus</th>
			</tr>
			<?php $l7=0;
			foreach ($lvl as $key => $value) {
			if($count-30>$l7){  ?>
				<tr>
					<td><?=$a;?></td>
					<td><?=$value['user_id'];?></td>
					<?php $name=$this->db_model->getWhere('users',['user_id'=>$value['user_id']]); ?>
					<td><?=$name['name'];?></td>
					<td><?=$value['sponcer_id'];?></td>
					<td><?=$bns7=3500;?></td>
				</tr>
			<?php $a++; $l7++; } } ?>
		</table>
		<div class="row">
		<div class="col-lg-6 col-lg-offset-3 well">
			<b>Parent ID : <?=$this->logged['user_id'];?> (<?=$this->logged['name'];?>)</b>
			<table class="table table-bordered table-hover table-condensed table-striped">
				<tr>
					<th colspan="2" class="text-center">Level 7 Summary</th>
				</tr>
				<tr>
					<th>Total Member</th><td><?=$l7;?></td>
				</tr>
				<tr>
					<th>Total Bonus</th><td><?=$l7*3500;?></td>
				</tr>
				<tr>
					<th>Level Status</th><td class="txtred"><?=($l7>5)?'Completed':'Pending'; ?></td>
				</tr>
				<?php if($l7>5){ ?>
				<tr>
					<th>Direct Bouns</th><td>11000</td>
				</tr>
				<tr>
					<th>2nd Level Joining Amount</th><td>10000</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
		<?php
	}
}else
{
	$count=0;
}
?>
<br><br><br>

<!-- ///=====================All Contents End Here============================================/// -->
				</div>
				<?php $this->load->view('includes/footer.php'); ?>
			</div>
		</div>
	</div>
</body>
</html>

<div id="Details" style="margin-top: 20px; width: 300px;background: white; display: none;">
	<table class="table table-bordered">
		<tr>
			<th>User Id</th><td id="u_id"></td>
		</tr>
		<tr>
			<th>Name</th><td id="u_name"></td>
		</tr>
	</table>
</div>


<script type="text/javascript">
	
	$('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
	function myfunction(id,name)
	{
		//alert(a); 
		$('#u_id').html(id);
		$('#u_name').html(name);
		$('#Details').css('display','block');
    var $someElement = $("#Details");
    $(document).mousemove(function (e) {
        $someElement.offset({ top: e.pageY, left: e.pageX+15 });
    }).mouseout(function () {
        $(this).unbind("mousemove");
    });
	}
	function myfunction1()
	{
		$('#Details').css('display','none');
	}

</script>
<style type="text/css">
.activate{
	background-color: forestgreen;
}
.inactive{
	background-color: darkred;
}
.tree ul {
    padding-top: 20px; position: relative;
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
	display: flex;
}

.tree li {
	float: left;
	text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
	border: 1px solid #ccc;
	padding: 5px 10px;
	text-decoration: none;
	color: #fff;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}

/*Thats all. I hope you enjoyed it.
Thanks :)*/
</style>