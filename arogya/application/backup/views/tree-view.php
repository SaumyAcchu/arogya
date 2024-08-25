<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Tree View';?> | <?=$this->siteInfo['name'];?></title>
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
            <!-- <?php echo "<pre>"; print_r($treeman); ?> -->
		        <div class="row padding-top">
		         <div class="panel panel-primary">
                       <div class="panel-heading">
                           <h3 class="panel-sponcer_id"><i class="fa fa-sitemap"></i> Direct Team Joins</h3>
                       </div>
                                     <div class="panel-body" style="max-width: 1100px;">


                                       <div id="chart-container"></div>
                                     
                 <link rel="stylesheet" href="<?=base_url('assets/test');?>/css/jquery.orgchart.css">
                 <link rel="stylesheet" href="<?=base_url('assets/test');?>/css/style.css">
                 <link rel="stylesheet" href="<?=base_url('assets/test');?>/css/style2.css">


                                         <div class="demo-container" id="pan-zoom" ></div>

                                 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                                 <script type="text/javascript" src="<?=base_url('assets/test');?>/js/html2canvas.min.js"></script>
                                 <script type="text/javascript" src="<?=base_url('assets/test');?>/js/jspdf.min.js"></script>
                                 <script type="text/javascript" src="<?=base_url('assets/test');?>/js/jquery.orgchart.js"></script>
                                 
                       <script type="text/javascript">
                              $(function() {
                               var datascource = <?php echo json_encode($treeman); ?>;
                               $('#chart-container').orgchart({
                                 'data' : datascource,
                                 'visibleLevel': 2,
                                 'pan': true,
                                 'zoom': true,
                                 'exportButton': false,
                                 'exportFilename': 'Care',
                                 'nodeID': 'id',
                                 'createNode': function($node, data) {
                                   var secondMenuIcon = $('<i>', {
                                     'class': 'fa fa-info-circle second-menu-icon',
                                     mouseover: function() {
                                       $(this).siblings('.second-menu').toggle();
                                     },
                                     mouseout: function() {
                                       $(this).siblings('.second-menu').toggle();
                                     }
                                   });
                                   var secondMenu = '<div class="second-menu"><img class="avatar" src="<?= base_url('uploads/') ?>' + data.image + '"> Name : <span style="font-size: 10px;">'+data.username +'</span><br> Sponcer Id:<span style="font-size: 10px;">' + data.sponcer_id+'</span><br> mobile:<span style="font-size: 10px;">' + data.mobile+'</span><br> Join Date:<span style="font-size: 10px;">' + data.reg_date+'</span></div>';
                                   $node.append(secondMenuIcon).append(secondMenu);
                                 }
                               });

                             });
                           </script>
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
<div id="Details" style="margin-top: 20px; width: 300px;background: white; display: none;">
  <table class="table table-bordered">
    <tr>
      <th>User Id</th><td id="u_id"></td>
    </tr>
    <tr>
      <th>Name</th><td id="u_name"></td>
    </tr>
    <tr>
      <th>Customers</th><td id="userCount"></td>
    </tr>
  </table>
</div>


<script type="text/javascript">
  
  $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
  function myfunction(id,name,ucount)
  {
    //alert(a); 
    $('#u_id').html(id);
    $('#u_name').html(name);
    $('#userCount').html(ucount);
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
.tree ul {
    padding-top: 20px; position: relative;
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
  display: flex;
  padding-left: 0px;
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
  border-top: 1px solid #000;
  width: 50%; height: 20px;
}
.tree li::after{
  right: auto; left: 50%;
  border-left: 1px solid #000;
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
  border-right: 1px solid #000;
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
  border-left: 1px solid #000;
  width: 0; height: 20px;
}

.tree li a{
  border: 1px solid #ccc;
  padding: 15px 30px;
  text-decoration: none;
  color: #fff;
  font-family: arial, verdana, tahoma;
  font-size: 11px;
  display: inline-block;
  background-color: teal;
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