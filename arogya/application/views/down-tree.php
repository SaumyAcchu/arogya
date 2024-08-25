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
        <div class="hv-container"  id="getTree">
            <div class="hv-wrapper">
                <?php
                $d11=$d12=$d13=$d21=$d22=$d23=$d24=$d31=$d32=$d33=$d34=$d35=$d36=$d37=$d38=null;
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
                }   ?>
                <!-- Key component -->
                <div class="hv-item">

                    <div class="hv-item-parent">
                        <div class="person">
                            <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                            <p class="name">
                                <?= $this->logged['name']." (".$this->logged['user_id'].")"; ?>
                            </p>
                            <h6><?= $this->logged['place'];?></h6>
                        </div>
                    </div>

                    <?php if($d11) { ?>
                    <div class="hv-item-children">

                        <div class="hv-item-child">
                            <!-- Key component -->
                            <div class="hv-item">

                                <div class="hv-item-parent">
                                    <div class="person">
                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                        <p class="name">
                                            <?= $d11['name']." (".$d11['user_id'].")"; ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <?php if($d21){ ?>
                                <div class="hv-item-children">

                                    <div class="hv-item-child">
                                        <!-- Key component -->
                                        <div class="hv-item">
            
                                            <div class="hv-item-parent">
                                                <div class="person">
                                                    <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                    <p class="name">
                                                        <?= $d21['name']." (".$d21['user_id'].")"; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php if($d31) { ?>
                                            <div class="hv-item-children">
            
                                                <div class="hv-item-child">
                                                    <div class="person">
                                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                        <p class="name">
                                                            <?= $d31['name']." (".$d31['user_id'].")"; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php if($d32){ ?>    
                                                <div class="hv-item-child">
                                                    <div class="person">
                                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                        <p class="name">
                                                            <?= $d32['name']." (".$d32['user_id'].")"; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                    
                                    <?php if($d22){ ?>
                                    <div class="hv-item-child">
                                        <!-- Key component -->
                                        <div class="hv-item">
            
                                            <div class="hv-item-parent">
                                                <div class="person">
                                                    <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                    <p class="name">
                                                        <?= $d22['name']." (".$d22['user_id'].")"; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <?php if($d33){ ?>
                                            <div class="hv-item-children">
            
                                                <div class="hv-item-child">
                                                    <div class="person">
                                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                        <p class="name">
                                                            <?= $d33['name']." (".$d33['user_id'].")"; ?>>
                                                        </p>
                                                    </div>
                                                </div>
            
                                                <?php if($d34) { ?>
                                                <div class="hv-item-child">
                                                    <div class="person">
                                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                        <p class="name">
                                                           <?= $d34['name']." (".$d34['user_id'].")"; ?>>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <?php if($d12) { ?>
                        <div class="hv-item-child">
                            <!-- Key component -->
                            <div class="hv-item">

                                <div class="hv-item-parent">
                                    <div class="person">
                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                        <p class="name">
                                            <?= $d12['name']." (".$d12['user_id'].")"; ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <?php if($d23) { ?>
                                <div class="hv-item-children">

                                    <div class="hv-item-child">
                                        <!-- Key component -->
                                        <div class="hv-item">
            
                                            <div class="hv-item-parent">
                                                <div class="person">
                                                    <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                    <p class="name">
                                                        <?= $d23['name']." (".$d23['user_id'].")"; ?>
                                                    </p>
                                                </div>
                                            </div>
            
                                            <?php if($d35) { ?>
                                            <div class="hv-item-children">
            
                                                <div class="hv-item-child">
                                                    <div class="person">
                                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                        <p class="name">
                                                            <?= $d35['name']." (".$d35['user_id'].")"; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <?php if($d36) { ?>
                                                <div class="hv-item-child">
                                                    <div class="person">
                                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                        <p class="name">
                                                            <?= $d36['name']." (".$d36['user_id'].")"; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <?php if($d24) { ?>
                                    <div class="hv-item-child">
                                        <!-- Key component -->
                                        <div class="hv-item">
            
                                            <div class="hv-item-parent">
                                                <div class="person">
                                                    <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                    <p class="name">
                                                        <?= $d24['name']." (".$d24['user_id'].")"; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <?php if($d37) { ?>
                                            <div class="hv-item-children">
            
                                                <div class="hv-item-child">
                                                    <div class="person">
                                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                        <p class="name">
                                                            <?= $d37['name']." (".$d37['user_id'].")"; ?>
                                                        </p>
                                                    </div>
                                                </div>
            
                                                <?php if($d38) { ?>
                                                <div class="hv-item-child">
                                                    <div class="person">
                                                        <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                        <p class="name">
                                                           <?= $d38['name']." (".$d38['user_id'].")"; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } else { ?>
                          <div class="hv-item-parent">
                                                <div class="person">
                                                    <img src="<?=base_url();?>tree/images/CORS.png" alt="">
                                                    <p class="name">
                                                        User Web
                                                    </p>
                                                </div>
                                            </div>
                        <?php } ?>
                        
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </section>
    
    
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