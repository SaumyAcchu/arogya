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
				<?php $this->load->view('includes/sidebar.php',['page'=>'tree-view']); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-11 display-table-cell v-align">
				<?php $this->load->view('includes/topbar.php'); ?>
				<div class="container-fluid no-padding main-container">
					<div class="title txtcenter">
						<h4>Tree View</h4>
					</div>
					<!-- ///Flash Message Start/// -->
					<?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
					  <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
					  <?php endif; ?>
					<!-- ///Flash Message End/// -->
<!-- ///=====================All Contents Start Here==========================================/// -->
			<div class="col-lg-12" id="treeDiv" style="width:100%;height:500px;overflow:scroll;">
				<div class="tree" style="position: static;">
					<ul>
						<li>
							<a style="background-color: forestgreen;" href="#" onmouseover="myfunction('<?=$this->logged['user_id']; ?>','<?=$this->logged['name']; ?>')" onmouseout="myfunction1()"><?=$key=$this->logged['user_id'];?></a>
								
					<?php
					unset($_SESSION['dList']);
					$res=$this->Commission_model->downLine($this->logged['user_id']);
					$arr=$_SESSION['dList'];
					//krsort($arr);
					//echo '<pre>'; print_r($arr); exit();
					$aa='';
					theNew($arr,$key);
					function theNew($arr,$key)
					{
						global $aa;
						$data=myFunction($arr,$key);
						if($data)

						{ $i=1; krsort($data);
							echo '<ul>';
							foreach ($data as $key1 => $value)
							{ ?>
								<li>
									<?php if($value['status']==1)
									{ $cls='activate'; } else { $cls='inactive'; } ?>
									<a href="#" class="<?=$cls;?>" onmouseover="myfunction('<?=$value['user_id']; ?>','<?=$value['name']; ?>')" onmouseout="myfunction1()"><?=$value['user_id'];?></a><?php
								theNew($arr,$value['user_id']);
								$aa=$aa.'</li>';
							$i++; }
							echo '</li></ul>';
						}else
						{
							echo $aa;
							$aa='';
						} 
					}
					?>			</ul>
							</li>
						</ul>
					</div>
				</div>

<br><br><br>

<?php 
		function myFunction($arr,$key)
		{
		 	//$num=(count($arr)-1);
			foreach ($arr as $key1 => $value)
			{
				if($key1==$key)
				{
					return $arr[$key];
					
				}
				//$num--;
			}
		}
		?>


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