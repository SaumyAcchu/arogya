<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Upgrade';?> | <?=$this->siteInfo['name'];?></title>
  	
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
		        
		        <section class="content"> 
    <div class="row">
	<?php $i=1;
	foreach ($data as $key => $value) {
	if($value['id']>$this->logged['product']){?>
	<?php 
             $dis='';
             $curr=$this->dbm->rowCount('self_upgrade',['user_id'=>$this->logged['user_id'],'plan_id'=>$value['id']]);
             if($this->logged['wallet']>$value['amount']){ $up=1; }else{ $up=0; } ?>
	<div class="col-lg-6">
		<div class="jumbotron txtwhite <?php if($dis=='disabled'){ echo "disabledbutton"; } ?>" id="plan<?=$i;?>">
				<center>
				<?php if($curr>0){ 
					echo "<i class='fa fa-check-square-o fa-3x txtgreen'></i>";
				}
				else
				{
					
				} ?>
             <h3 class="text-center"><?=$value['name'];?></h3>
            <center>
             	<?php if($curr>0){  ?>

	             	<!--<a href="javascript:void(0);" class="btn transAct r-zero stats txtcenter">-->
	             		<!--<i class="fa fa-thumbs-o-up"></i><br>-->
	             		<!--	Congratulations!-->
	             	</a>
	             	 <a href="<?=base_url('user/getDataStatus/'.$value['id'].'/self-upgrade-status');?>" class="btn r-zero transAct stats txtcenter">
	             		<i class="fa fa-bar-chart" aria-hidden="true"></i><br> Check Live Status
	             	</a> 
             	<?php } else { ?>
             		<a href="javascript:void(0);" class="btn r-zero trans stats txtcenter">Upgrate Amount<br>
	             	<i class="fa fa-inr"></i> <?=number_format($value['amount'],2);?></a> <br><br>
	             	<a href="javascript:void(0);" class="btn r-zero trans stats txtcenter">Wallet Amount<br>
	             	<i class="fa fa-inr"></i> <?=number_format($this->logged['wallet'],2);?>
	             	</a>
             	<?php } ?>
            </center>
             <hr>
             <?php
             
             if($curr>0){ ?>
             <a class="txtupper r-zero btn btn-success" href="#"><i class="fa fa-check"></i> Already Purchase</a>
             <?php }else{?>
             
             	<a class="txtupper r-zero btn btn-primary" href="javascript:void(0);" onclick="upgrade('<?=$up;?>','<?=$value['id'];?>','<?=$value['amount'];?>')" <?=$dis;?>>Purchase Now</a>
             	<?php } ?>

             
         </center>
		</div>
	</div>
	<?php $i++; } } ?>
</div>
</section>

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
  <div class="modal fade" id="upgradeModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <div class="panel panel-primary" style="margin-bottom: 0px;">
            <div class="panel-heading">
             <p class="panel-title">Notice
             <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
            </div>
            <div class="panel-body">
                <div class="list-group">

                <?=form_open_multipart('user/selfUpgrade');?>
          			<label class="control-label">Upload Transaction Slip:</label>	
          			<input type="file" name="image" class="form-control image_path" required>
				    <div id="head"></div>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
        
        
        
        
 <script type="text/javascript">
	function upgrade(up,plan_id,amt)
	{
		$('#head').html('<p class="text-center text-primary">Are you sure to Purchase this Plan.</p><input type="hidden" name="plan_id" id="plan_id"><input type="hidden" name="amount" id="amount"><center><button type="button" class="btn btn-danger" data-dismiss="modal"> NO </button> <button type="submit" class="btn btn-success"> YES </button></center>');
		$('#amount').val(amt);
		$('#plan_id').val(plan_id);
		$('#upgradeModal').modal('show');
	}
</script>
<style type="text/css">
.nav-stacked li a{
	/*padding:25px;*/
}
.stats{
	/*border-radius: 50%;*/
}
.trans{
	border: 1px solid;
	background-color: none;
	font-size: 17px;
	color: white;
}
.transAct{
	border: 1px solid darkgreen;
	background-color: darkgreen;
	font-size: 17px;
	color: white;
}
.transAct:hover{
	color: white;
}
.panel-heading:hover{
		color: yellow;
		transition: .5s;
		font-size: 17px; 
		text-decoration: none;
		cursor: pointer;
	}
	.panel-title a{
		color: #fff;
		text-decoration: none;
		cursor: pointer;
	}
#plan1{
	background-color: coral;
}
#plan2{
	background-color: goldenrod;
}
#plan3{
	background-color: sandybrown;
}
#plan4{
	background-color: skyblue;
}
#plan5{
	background-color: coral;
}

.disabledbutton {
    pointer-events: none;
    opacity: 0.6;
}
</style>
