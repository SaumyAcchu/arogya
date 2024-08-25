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
                $arr1 = $this->db->get_where('users',['parent'=> $this->logged['user_id']])->result_array();
                
                if(isset($arr1[0])){
                    $d11 = $arr1[0];
                    $arr21 = $this->db->get_where('users',['parent'=> $d11['user_id']], 2)->result_array();
                    
                    if(isset($arr21[0])){
                        $d21 = $arr21[0];
                        
                        $arr31 = $this->db->get_where('users',['parent'=> $d21['user_id']], 2)->result_array();

                        if(isset($arr31[0])){
                            $d31 = $arr31[0];
                        }
                        if(isset($arr31[1])){
                            $d32 = $arr31[1];
                        }
                    }
                    if(isset($arr21[1])){
                        $d22 = $arr21[1];
                        
                        $arr32 = $this->db->get_where('users',['parent'=> $d22['user_id']], 2)->result_array();

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
                    $arr22 = $this->db->get_where('users',['parent'=> $d12['user_id']], 2)->result_array();
                    
                    if(isset($arr22[0])){
                        $d23 = $arr22[0];
                        
                        $arr33 = $this->db->get_where('users',['parent'=> $d23['user_id']], 2)->result_array();

                        if(isset($arr33[0])){
                            $d35 = $arr33[0];
                        }
                        if(isset($arr33[1])){
                            $d36 = $arr33[1];
                        }
                    }
                    if(isset($arr22[1])){
                        $d24 = $arr22[1];
                        
                        $arr34 = $this->db->get_where('users',['parent'=> $d24['user_id']], 2)->result_array();

                        if(isset($arr34[0])){
                            $d37 = $arr34[0];
                        }
                        if(isset($arr34[1])){
                            $d38 = $arr34[1];
                        }
                    }
                }   ?>
                
      
     
       
      
                <!-- Key component -->
             <table align="center" style="width: 98%; text-align: center; font-size: 13px; font-family:Tahoma">
                                <tbody>

                                <tr>
                                    <td colspan="18">

                                        <img id="ctl00_ContentPlaceHolder1_Image1" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        
                                        <br>
<b><?=$this->logged['user_id']; ?>,<?=$this->logged['name']; ?></b>

                                    </td>
                                </tr>
                                <tr>
                                    
                                        
                                    <td colspan="18">
                                        <img id="ctl00_ContentPlaceHolder1_Image2" src="<?=base_url('assets/');?>tree1.gif" style="height:50px;width:500px;border-width:0px;">
                                       
                                    </td>
                               
                                </tr>
      

                              <tr>
                                    <td colspan="2">&nbsp;</td>
                                   
                                    <td colspan="5">
                                        <?php  $arr1 = $this->db->get_where('users',['parent'=> $this->logged['user_id']],2)->result_array();  foreach ($arr1 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>
                                          <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                          <br>  <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                       <?php } } else { ?>
                                        <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">

                                        <br><b>Join Now</b>
                                    <?php }  } ?>
                                   </td>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="5">
                                          <?php  $arr1 = $this->db->get_where('users',['parent'=> $this->logged['user_id']],2)->result_array();  foreach ($arr1 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                          <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                          <br>  <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                       <?php } } else { ?>
                                        <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">

                                        <br><b>Join Now</b>
                                    <?php  } } ?></td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                
                                
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td colspan="5">
                                        <img id="ctl00_ContentPlaceHolder1_Image5" src="<?=base_url('assets/');?>tree1.gif" style="height:50px;width:230px;border-width:0px;">
                                    </td>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="5">
                                        <img id="ctl00_ContentPlaceHolder1_Image6" src="<?=base_url('assets/');?>tree2.gif" style="height:50px;width:230px;border-width:0px;">
                                    </td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="4">
                                      <?php  $arr21 = $this->db->get_where('users',['parent'=> $d11['user_id']],2)->result_array();  foreach ($arr21 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>
                                     
                                        <img id="ctl00_ContentPlaceHolder1_img3L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>
                                      <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                  <?php } } else { ?>
                                     <img id="ctl00_ContentPlaceHolder1_img3R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                  <?php } } ?>

                                    </td>
                                    <td colspan="3">

 <?php  $arr21 = $this->db->get_where('users',['parent'=> $d11['user_id']],2)->result_array();  foreach ($arr21 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
      <img id="ctl00_ContentPlaceHolder1_img3L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">   <br>
                                     <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
<?php } } else { ?> 
                                        <img id="ctl00_ContentPlaceHolder1_img3R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                    <?php } } ?>

                                    </td>
                                    <td colspan="2">&nbsp;</td>
                                    <td colspan="3">
                                      <?php    $arr22 = $this->db->get_where('users',['parent'=> $d12['user_id']], 2)->result_array(); foreach ($arr22 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>
                                          
                                        <img id="ctl00_ContentPlaceHolder1_Img2L2" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>
                                        <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                      <?php } } else { ?>
                                       <img id="ctl00_ContentPlaceHolder1_img3R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                      <?php  } } ?>

                                    </td>
                                    <td colspan="4">
                                       <?php    $arr22 = $this->db->get_where('users',['parent'=> $d12['user_id']], 2)->result_array(); foreach ($arr22 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                         
                                        <img id="ctl00_ContentPlaceHolder1_Img2R2" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;"><br>  <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                    <?php } } else { ?>
                                          <img id="ctl00_ContentPlaceHolder1_img3R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                    <?php } } ?>
                                      </td>
                             
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="4">
                                        <img id="ctl00_ContentPlaceHolder1_Image11" src="<?=base_url('assets/');?>tree2.gif" style="height:50px;width:120px;border-width:0px;">
                                    </td>
                                    <td colspan="3">
                                        <img id="ctl00_ContentPlaceHolder1_Image12" src="<?=base_url('assets/');?>tree2.gif" style="height:50px;width:120px;border-width:0px;">
                                    </td>
                                    <td colspan="2">&nbsp;</td>
                                    <td colspan="3">
                                        <img id="ctl00_ContentPlaceHolder1_Image13" src="<?=base_url('assets/');?>tree2.gif" style="height:50px;width:120px;border-width:0px;">
                                    </td>
                                    <td colspan="4">
                                        <img id="ctl00_ContentPlaceHolder1_Image14" src="<?=base_url('assets/');?>tree2.gif" style="height:50px;width:120px;border-width:0px;">
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        
                                       <?php  $arr31 = $this->db->get_where('users',['parent'=> $d21['user_id']], 2)->result_array();
                                        foreach ($arr31 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>
                                        
                                        <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>

                                     <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
<?php } } else { ?>
      <img id="ctl00_ContentPlaceHolder1_imgL5R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now<b>
<?php } } ?>
                             </td>
                                    <td style="width: 15px">&nbsp;</td>
                                    <td colspan="2">
                                     <?php 
                                     $arr31 = $this->db->get_where('users',['parent'=> $d21['user_id']], 2)->result_array();
                                        foreach ($arr31 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                                <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>

                                       <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                        <?php } } else { ?>
                                     <img id="ctl00_ContentPlaceHolder1_imgL5R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now<b>
                                        <?php } } ?>

                                  
                                    </td>
                                    <td>
                                       <?php $arr32 = $this->db->get_where('users',['parent'=> $d22['user_id']], 2)->result_array();
                                        foreach ($arr32 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>
                                              <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>
  <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                        <?php } } else { ?>
                                        <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                      <?php } } ?>

                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                       <?php $arr32 = $this->db->get_where('users',['parent'=> $d22['user_id']], 2)->result_array();
                                        foreach ($arr32 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                          
                                            <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>

                                       <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                      <?php }  } else { ?>
                                        <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                    <?php } } ?>

                                    </td>
                                    <td colspan="2">&nbsp;</td>
                                    <td>
                                         <?php $arr33 = $this->db->get_where('users',['parent'=> $d23['user_id']], 2)->result_array();
                                         foreach ($arr33 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>
                                           
                                            <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>
                                      <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                      <?php } } else { ?>
                                       <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                    <?php } } ?>
                                    </td>

                                    <td>&nbsp;</td>
                                    <td>
                                       <?php $arr33 = $this->db->get_where('users',['parent'=> $d23['user_id']], 2)->result_array();
                                         foreach ($arr33 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                           
                                       <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>
                                    <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                      <?php } } else { ?>
                                           <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                      <?php } } ?>
                                      </td>
                                    <td colspan="2">
                                        <?php  $arr34 = $this->db->get_where('users',['parent'=> $d24['user_id']], 2)->result_array(); foreach ($arr33 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>

                                       
                                        <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>
                                       <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                      <?php } } else { ?>
                                         <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
<?php } } ?>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                  <?php  $arr34 = $this->db->get_where('users',['parent'=> $d24['user_id']], 2)->result_array(); foreach ($arr33 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>

                                          <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;">
                                        <br>
                                     <b class="name"><?=$value['user_id'];?> <?=$value['name'];?><b>
                                      <?php } } else { ?>
                                           <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                    <?php } } ?>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody></table>

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