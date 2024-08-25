<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		        <div class="row padding-top">
		          <div class="col-lg-12" id="treeDiv" style="width:100%;min-height:700px;overflow:scroll;">
        <div class="tree" style="position: static;">
          <ul>
            <li>
                  <a href="#" class="" onmouseover="myfunction('<?=$this->logged['user_id']; ?>','<?=$this->logged['sponcer_id']; ?>','<?=$this->logged['reg_date']; ?>','<?=$this->logged['pv']; ?>','<?=$this->logged['active_date']; ?>')" onmouseout="myfunction1()">
                      <?=$key=$userID;?></a>
                
          <?php
          unset($_SESSION['dList']);
          $_SESSION['dList']=[];
          $res=$this->comm->downLineTree($userID);
          $arr=$_SESSION['dList'];
          //krsort($arr);
        //  echo '<pre>'; print_r($arr); exit();
          $aa='';
          theNew($arr,$key);
          function theNew($arr,$key)
          {
            global $aa;
            $data=myFunction($arr,$key);
            if($data)

            { $i=1; 
              echo '<ul>';
              foreach ($data as $key1 => $value)
              { ?>
                <li>
                    
                  <?php
                    $data = new dbm(); ?>
                  <a href="#" class="" onmouseover="myfunction('<?=$value['user_id']; ?>','<?=$value['sponcer_id'];?>','<?=$value['reg_date']; ?>','<?=$value['pv']; ?>','<?=$value['active_date']; ?>')" onmouseout="myfunction1()">
                      <?=$value['user_id'].' PV = '.$value['pv'].'Position ='.$value['place'];?></a><?php
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
          ?>      </ul>
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
<div id="Details" style="margin-top: 20px; width: 400px;background: green;color:white; display: none;">
  <table class="table table-bordered">
    <tr>
      <th>User ID</th><td id="u_id"></td>
      
       <th>Sponcer ID</th><td id="u_name"></td>
    </tr>
    <tr>
         <th>DOJ</th><td id="userCount"></td>
         <th>DOA</th><td id="userCountj"></td>
    </tr>
    <tr>
        <th>Left Partners: </th><td id="left"></td> 
        <th>Right Partners: </th><td id="right"></td>
    </tr>
     <tr>
        <th>Total Partners: </th><td colspan="3" id="down"></td> 
    </tr>
     <tr>
        <th>Joining Package: </th><td  id="amount"></td>
        <th>PV: </th><td  id="cvid"></td>
    </tr> 
     <tr>
        <th>Left PV Business: </th><td id="leftb"></td> 
        <th>Right PV Business: </th><td id="rightb"></td>
    </tr> 
     <tr>
        <th>Left Active Partners: </th><td id="leftAc"></td> 
        <th>Right Active Partners: </th><td id="rightAc"></td>
    </tr> 
     <tr>
        <th>Total Active </th><td colspan="3" id="downAc"></td> 
    </tr> 
    
  </table>
</div>
    



<script type="text/javascript">
  
  $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
  function myfunction(id,name,ucount,cv,act)
  {
    //alert(a); 
    $('#u_id').html(id);
    $('#u_name').html(name);
    $('#userCount').html(ucount);
    $('#cvid').html(cv);
    $('#userCountj').html(act);
    
    var user_id=id;
          $.ajax({
      url:"<?=base_url('stable/countDownSearch');?>",
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
      url:"<?=base_url('stable/countDownActive');?>",
      type:'post',
      dataType:'json',
       data: {
                'user_id':user_id
              },
      success:function(data)
      {
        $('#downAc').html(data['downAc']);
        $('#leftAc').html(data['leftAc']);
        $('#rightAc').html(data['rightAc']);
      }
  });
  
     var user_id=id;
      $.ajax({
      url:"<?=base_url('stable/countAmt');?>",
      type:'post',
      dataType:'json',
       data: {
                'user_id':user_id
              },
      success:function(data)
      {
        $('#amount').html(data['amount']);
        $('#cv').html(data['cv']);
      }
  });

     // .........prp.....................
    
    var user_id=id;
     $.ajax({
      url:"<?=base_url('stable/plotSectionche');?>",
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