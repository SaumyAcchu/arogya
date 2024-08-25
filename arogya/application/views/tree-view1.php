<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?php $this->load->view('include/header'); ?>
    <link rel="stylesheet" href="<?=base_url();?>tree/css/hierarchy-view.css">
    <link rel="stylesheet" href="<?=base_url();?>tree/css/main.css">
      <link rel="stylesheet" href="<?=base_url();?>tree/css/hierarchy-view.css">
    <link rel="stylesheet" href="<?=base_url();?>tree/css/main.css">
    <title><?=$page['page']='Tree View';?> | <?=$this->siteInfo['name'];?></title>
    
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
              
             <section class="management-hierarchy"> 
        <div class="col-lg-12">
        <h4 style="color: black;" class="pull-left"> Member Tree Views</h4><br>
        <hr style="border-top: 2px solid black;">
        </div>
        <div class="col-lg-12">
        <div class="col-lg-5">
        </div>
        <div class="col-lg-2">
        <input type="" id="user_id" class="form-control">
        </div>
        <div class="col-lg-3">
        <button type="submit" onclick="getTreeStructure()" class="btn btn-warning">Show Tree</button>
        </div>
        
        </div>
          <?php
                $d11=$d12=$d21=$d22=$d23=$d24=$d31=$d32=$d33=$d34=$d35=$d36=$d37=$d38=null;
                $arr1 = $this->db->get_where('users',['sponcer_id'=> $this->logged['user_id']])->result_array();
                
                if(isset($arr1[0])){
                    $d11 = $arr1[0];
                    $arr21 = $this->db->get_where('users',['sponcer_id'=> $d11['user_id']], 2)->result_array();
                    
                    if(isset($arr21[0])){
                        $d21 = $arr21[0];
                        
                        $arr31 = $this->db->get_where('users',['sponcer_id'=> $d21['user_id']], 2)->result_array();

                        if(isset($arr31[0])){
                            $d31 = $arr31[0];
                        }
                        if(isset($arr31[1])){
                            $d32 = $arr31[1];
                        }
                    }
                    if(isset($arr21[1])){
                        $d22 = $arr21[1];
                        
                        $arr32 = $this->db->get_where('users',['sponcer_id'=> $d22['user_id']], 2)->result_array();

                        if(isset($arr32[0])){
                            $d33 = $arr32[0];
                        }
                        if(isset($arr32[1])){
                            $d34 = $arr32[1];
                        }
                    }
                }
                if(isset($arr1[1])){
                    $d12 = $arr1[1];
                    $arr22 = $this->db->get_where('users',['sponcer_id'=> $d12['user_id']], 2)->result_array();
                    
                    if(isset($arr22[0])){
                        $d23 = $arr22[0];
                        
                        $arr33 = $this->db->get_where('users',['sponcer_id'=> $d23['user_id']], 2)->result_array();

                        if(isset($arr33[0])){
                            $d35 = $arr33[0];
                        }
                        if(isset($arr33[1])){
                            $d36 = $arr33[1];
                        }
                    }
                    if(isset($arr22[1])){
                        $d24 = $arr22[1];
                        
                        $arr34 = $this->db->get_where('users',['sponcer_id'=> $d24['user_id']], 2)->result_array();

                        if(isset($arr34[0])){
                            $d37 = $arr34[0];
                        }
                        if(isset($arr34[1])){
                            $d38 = $arr34[1];
                        }
                    }
                }
//echo "<pre>"; print_r($d11);
                ?>
  <div class="tree">
	<ul>
		<li>
			<a href="#"><img src="<?=base_url();?>tree/images/CORS.png" alt=""><br> <?= $this->logged['name']." (".$this->logged['user_id'].")"; ?></a>
			 <?php if($d11) { ?>
			<ul>
				<li>
					<a href="#"><img src="<?=base_url();?>tree/images/CORS.png" alt=""><br><?= $d11['name']." (".$d11['user_id'].")"; ?></a>
					 <?php if($d21){ ?>
					<ul>
                   <li>
							<a href="#"><img src="<?=base_url();?>tree/images/CORS.png" alt=""><br><?= $d21['name']." (".$d21['user_id'].")"; ?></a>
              
						</li>
						  <li>
							<a href="#"><img src="<?=base_url();?>tree/images/CORS.png" alt=""><br><?= $d21['name']." (".$d21['user_id'].")"; ?></a>
              
						</li>
					
					</ul>
					<?php } ?>
				</li>
				<li>
					<a href="#">3</a>
					<ul>
						<ul>
            <li>
							<a href="#">3.1</a>
              <ul>
            <li>
							<a href="#">3.1.1</a>
						</li>
						<li>
							<a href="#">3.1.2</a>
						</li>
					</ul>
						</li>
						<li>
							<a href="#">3.2</a>
						</li>
					</ul>
					</ul>
				</li>
			</ul>
			<?php } else { ?>
			 <li>
							<a href="#"><img src="<?=base_url();?>tree/images/CORS.png" alt=""><br><?= $d21['name']." (".$d21['user_id'].")"; ?></a>
              
						</li>
			<?php } ?>
			
		
			 <?php if($d12) { ?>
				<ul>
				<li>
					<a href="#"><img src="<?=base_url();?>tree/images/CORS.png" alt=""><br><?= $d11['name']." (".$d11['user_id'].")"; ?></a>
					 <?php if($d21){ ?>
					<ul>
                   <li>
							<a href="#"><img src="<?=base_url();?>tree/images/CORS.png" alt=""><br><?= $d21['name']." (".$d21['user_id'].")"; ?></a>
              
						</li>
						  <li>
							<a href="#"><img src="<?=base_url();?>tree/images/CORS.png" alt=""><br><?= $d21['name']." (".$d21['user_id'].")"; ?></a>
              
						</li>
					
					</ul>
					<?php } ?>
				</li>
				<li>
					<a href="#">3</a>
					<ul>
						<ul>
            <li>
							<a href="#">3.1</a>
              <ul>
            <li>
							<a href="#">3.1.1</a>
						</li>
						<li>
							<a href="#">3.1.2</a>
						</li>
					</ul>
						</li>
						<li>
							<a href="#">3.2</a>
						</li>
					</ul>
					</ul>
				</li>
			</ul>
			<?php } ?>
		</li>
	</ul>
</div>
    </section>
    
<style>
    /*Now the CSS*/
* {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
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
	color: #666;
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
</style>
    <!--////////////////////////////////////-->
    
    
 <div id="Details" style="margin-top: 20px; width: 400px;background: red;color:white; display: none;">
  <table class="table table-bordered">
    <tr>
      <th>User Id</th><td id="u_id"></td>
      
       <th>Sponcer ID</th><td id="userCount"></td>
    </tr>
    <tr>
         <th>DOA</th><td colspan="3" id="u_name"></td>
    </tr>
    <tr>
        <th>Left: </th><td id="left"></td> 
        <th>Right: </th><td id="right"></td>
    </tr>
     <tr>
        <th>Down: </th><td colspan="3" id="down"></td> 
    </tr>
     <tr>
        <th>Joining Amount: </th><td  id="amount"></td>
        <th>PV: </th><td  id="bv"></td>
    </tr> 
     <tr>
        <th>Left Business: </th><td id="leftb"></td> 
        <th>Right Business: </th><td id="rightb"></td>
    </tr> 
     <tr>
        <th>Total Income: </th><td id="earn"></td> 
        <th>Direct Active: </th><td id="directA"></td>
    </tr> 
    
  </table>
</div>
    

<!-- //////////////////////////////////////////// -->
  </div>

  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
    
   
    

  <script type="text/javascript">
  
  
  
  
      function getTreeStructure(){
        let res = $.trim($("#user_id").val());
	         let id = res.toUpperCase();
          if(id == ''){
              alert("Please enter userid");
              return false;
          }
          getTree(id);
      }
      
      function getTree(id){
          $.ajax({
              url: "<?=base_url('stable1/getUserTree');?>",
              type: 'post',
              data: {id: id},
              success: function(data){
                  $('#getTree').html(data);
              }
              
          });
      }
      $(() => {
          getTree("<?=$this->logged['user_id'];?>");
      })
  </script>

<script type="text/javascript">
  $('#backbtn').click(function(){
    window.history.back();
  });
</script>

<script type="text/javascript">
 
  function mykkfunction(id,name,ucount)
  {
      
    $('#u_id').html(id);
    $('#u_name').html(name);
    $('#userCount').html(ucount);
    
    
      var user_id=id;
          $.ajax({
      url:"<?=base_url('stable1/countDownSearch');?>",
      type:'post',
      dataType:'json',
       data: {
                'user_id':user_id
              },
      success:function(data)
      {
        $('#down').html(data['down']);
        $('#left').html(data['left']);
        $('#right').html(data['right']);
      }
  });
  
     var user_id=id;
      $.ajax({
      url:"<?=base_url('stable1/countAmt');?>",
      type:'post',
      dataType:'json',
       data: {
                'user_id':user_id
              },
      success:function(data)
      {
        $('#amount').html(data['amount']);
        $('#bv').html(data['bv']);
      }
  });

     // .........prp.....................
    
    var user_id=id;
     $.ajax({
      url:"<?=base_url('stable1/plotSectionche');?>",
      type:'post',
      dataType:'json',
       data: {
                'user_id':user_id
              },
      success:function(data)
      {
        $('#rightb').html(data['rightb']);
        $('#leftb').html(data['leftb']);
       
      }
    
    });
    
    // .........prp.....................
     // .........prp.....................
    
    var user_id=id;
     $.ajax({
      url:"<?=base_url('stable1/totalEarn');?>",
      type:'post',
      dataType:'json',
       data: {
                'user_id':user_id
              },
      success:function(data)
      {
        $('#earn').html(data['earn']);
        $('#directA').html(data['directA']);
       
      }
    
    });
    
    // .........prp.....................
    
    // ................end prp...............
      $('#Details').css('display','block');
    // // alert("hello--2");
    // return false;
      
    //alert(a); 

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



<script type="text/javascript">
$(document).ready(function(){
    var id="<?=$this->logged['user_id'];?>";
    // alert(id)
     $.ajax({
              url: "<?=base_url('stable1/getUserTreeTree');?>",
              type: 'post',
              data: {id: id},
              success: function(data){
                  $('#getTree').html(data);
              }
              
          });
 });
 
  function getTreeUPer(id){
          $.ajax({
              url: "<?=base_url('stable1/getUserTreeTree');?>",
              type: 'post',
              data: {id: id},
              success: function(data){
                  $('#getTree').html(data);
              }
              
          });
      }
</script>

          </div></div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>