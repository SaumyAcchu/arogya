<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stable1 extends MY_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('dbm');
		$this->load->model('comm');
	}

    public function totalEarn()
	{
		$param1=$_POST['user_id'];
		$level=$this->db->select_sum('amount')->where(['beneficiary'=>$param1,'status'=>1])->get('commission')->row_array();
		$club=$this->db->select_sum('amount')->where(['user_id'=>$param1])->get('monthly_club')->row_array();
		$india=$this->db->select_sum('amount')->where(['user_id'=>$param1])->get('india_income')->row_array();
		$comm=$this->db->select_sum('amount')->where(['user_id'=>$param1])->get('banus_income')->row_array();
		$comm1=$this->db->select_sum('amount')->where(['user_id'=>$param1])->get('club_income')->row_array();
		$pair=$this->db->select_sum('paidAmt')->where(['user_id'=>$param1])->get('pairmaching')->row_array();
		$total['earn']=($pair['paidAmt']+$comm['amount']+$comm1['amount']+$level['amount']+$club['amount']+$india['amount'])/.9;
		$total['directA'] = $this->dbm->rowCount('users',['sponcer_id'=>$param1,'status'=>1]);
		echo json_encode($total);
	}
	
    public function explore($page='')
	{
		$this->load->view($page);
	}
	public function join($param1='',$param2='')
	{
		$id=base64_decode($param1);
		$row['sponcer_data']=$this->dbm->getWhere('users',['user_id'=>$id]);
		if($row['sponcer_data'])
		{
			$this->load->view('user/user-registration',$row);
		}else
		{
			$join['joinLink']='This Link Seems to be expire or not activated.';
			$this->load->view('user/success-message',$join);
		}
		//$this->load->view('user/user-registration');
	}

	public function joinWithPin($param1='',$param2='')
	{
		$str=base64_decode($param1);
		$arr=explode('/',$str);
		$row['sponcer_data']=$this->dbm->getWhere('users',['user_id'=>$arr[0]]);
		$row['pin']=$arr[1];
		if($row['sponcer_data'])
		{
			$this->load->view('user/user-registration',$row);
		}else
		{
			$join['joinLink']='This Link Seems to be expire or not activated.';
			$this->load->view('user/success-message',$join);
		}
		//$this->load->view('user/user-registration');
	}

	public function treeView($id='')
	{
		$data['userID']=base64_decode($id);
		$this->load->view('tree-view',$data);
	}

	public function logout()
	{
		$this->session->unset_userdata('loggedUser');
		session_destroy();
		return redirect('login');
	}
		public function UsNamevedidation()
	{
	      $email=$_POST['email1'];
         $result=$this->dbm->rowC('users',['user_id'=>$email]);
	}
	
	
	public function emailvedidation()
	{
	     $email=$_POST['email1'];
         $result=$this->dbm->rowC('users',['email'=>$email]);
	}
	
		public function panvedidation()
	{
	     $email=$_POST['email1'];
         $result=$this->dbm->rowC('users',['pan'=>$email]);
	}
		public function mobilevedidation()
	{
	     $email=$_POST['email1'];
         $result=$this->dbm->rowC('users',['mobile'=>$email]);
	}
	

public function getUserTree(){
	?>
<div class="hv-wrapper">
                <?php
                $d11=$d12=$d21=$d22=$d23=$d24=$d31=$d32=$d33=$d34=$d35=$d36=$d37=$d38=null;
                
                $user_id = $_POST['id'];
                
                if($user_id == ''){
                    echo "Please enter user id";
                    die;
                }
                // .............................................
                
                
                
        unset($_SESSION['dList']);
		$_SESSION['dList']=[];
		$list=[];
		$id=$this->logged['user_id'];
		$this->comm->downList($id);
		$list=$_SESSION['dList'];
        foreach ($list as $key => $value)
			{
                if($value['user_id']==$user_id){
                   
                $arr = $this->db->get_where('users',['user_id'=> $user_id], 1)->row_array();
                $arr1 = $this->db->get_where('users',['parent'=> $user_id], 2)->result_array();
                
                // .................................................
               
        
                
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
                }
                // echo "<pre>"; print_r($d11);
                ?>
                <!-- Key component -->
                
                  <table align="center" style="width: 98%; text-align: center; font-size: 13px; font-family:Tahoma">
                                <tbody>

                                <tr>
                                    <td colspan="18">

                                        <img id="ctl00_ContentPlaceHolder1_Image1" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$arr['user_id']; ?>','<?=$arr['reg_date']; ?>','<?=$arr['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        
                                        <br>
<b><?=$arr['user_id']; ?>,<?=$arr['name']; ?></b>

                                    </td>
                                </tr>
                                <tr>
                                    
                                        
                                    <td colspan="18">
                                        <img id="ctl00_ContentPlaceHolder1_Image2" src="<?=base_url('assets/');?>tree1.gif" style="height:50px;width:500px;border-width:0px;">
                                       
                                    </td>
                               
                                </tr>
<?php for ($i=1; $i<=1; $i++)	{ ?>

                              <tr>
                                    <td colspan="2">&nbsp;</td>
                                   
                                    <td colspan="5">
                                        <?php  $arr1 = $this->db->get_where('users',['parent'=> $this->logged['user_id']],2)->result_array();  foreach ($arr1 as $key => $value) { 
                                              if(isset($value)) {
                                         if($value['place']=='Left') {  
                                         ?>
                                          <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;"  onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                          <br>  <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                       <?php } } else { ?>
                                        <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('Add New Member')" >

                                        <br><b>Join Now</b>
                                    <?php }  } ?>
                                   </td>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="5">
                                          <?php  $arr1 = $this->db->get_where('users',['parent'=> $this->logged['user_id']],2)->result_array();  foreach ($arr1 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                          <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                          <br>  
                                                <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                       <?php } } else { ?>
                                        <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">

                                        <br><b>Join Now</b>
                                    <?php  } } ?></td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                
                                <?php } ?>
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
                                     
                                        <img id="ctl00_ContentPlaceHolder1_img3L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                    <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                  <?php } } else { ?>
                                     <img id="ctl00_ContentPlaceHolder1_img3R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                  <?php } } ?>

                                    </td>
                                    <td colspan="3">

 <?php  $arr21 = $this->db->get_where('users',['parent'=> $d11['user_id']],2)->result_array();  foreach ($arr21 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
      <img id="ctl00_ContentPlaceHolder1_img3L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">   <br>
                                   <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                          
                                        <img id="ctl00_ContentPlaceHolder1_Img2L2" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                       <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                      <?php } } else { ?>
                                       <img id="ctl00_ContentPlaceHolder1_img3R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                      <?php  } } ?>

                                    </td>
                                    <td colspan="4">
                                       <?php    $arr22 = $this->db->get_where('users',['parent'=> $d12['user_id']], 2)->result_array(); foreach ($arr22 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                         
                                        <img id="ctl00_ContentPlaceHolder1_Img2R2" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()"><br>  <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                        
                                        <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>

                                    <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                                <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
<b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                              <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
  <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                          
                                            <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>

                                    <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                           
                                            <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                     <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                           
                                       <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                   <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                      <?php } } else { ?>
                                           <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                      <?php } } ?>
                                      </td>
                                    <td colspan="2">
                                        <?php  $arr34 = $this->db->get_where('users',['parent'=> $d24['user_id']], 2)->result_array(); foreach ($arr33 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>

                                       
                                        <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                     <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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

                                          <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                  <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                      <?php } } else { ?>
                                           <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                    <?php } } ?>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody></table>
                




                
                
                
                
                
                
                
                
                
                
                
 <!--               <div class="hv-item">-->

 <!--                   <div class="hv-item-parent">-->
 <!--                       <div class="person">-->
 <!--                           <?php if($arr['status']==1){ ?>-->
 <!--                            <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$arr['user_id']; ?>','<?=$arr['reg_date']; ?>','<?=$arr['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$arr['user_id']; ?>','<?=$arr['reg_date']; ?>','<?=$arr['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                           <p class="name" style="border:1px solid;">-->
 <!--                               <?= $arr['name']." (".$arr['user_id'].")"; ?>-->
 <!--                               <br>-->
                            
                               
 <!--                           </p>-->
                             
 <!--                       </div>-->
 <!--                   </div>-->

 <!--                   <?php if($d11) { ?>-->
 <!--                   <div class="hv-item-children">-->

 <!--                       <div class="hv-item-child">-->
                            <!-- Key component -->
 <!--                           <div class="hv-item">-->

 <!--                               <div class="hv-item-parent">-->
 <!--                                   <div class="person">-->
 <!--                                       <?php if($d11['status']==1){ ?>-->
 <!--                          <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d11['user_id']; ?>','<?=$d11['reg_date']; ?>','<?=$d11['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d11['user_id']; ?>','<?=$d11['reg_date']; ?>','<?=$d11['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                       <p class="name" style="border:1px solid;">-->
 <!--                                             <a href="#" onclick="getTree('<?= $d11['user_id'];?>')"><?= $d11['name']." (".$d11['user_id'].")"; ?></a>-->
                                          
 <!--                                       </p>-->
 <!--                                   </div>-->
 <!--                               </div>-->
                                
 <!--                               <?php if($d21){ ?>-->
 <!--                               <div class="hv-item-children">-->

 <!--                                   <div class="hv-item-child">-->
                                        <!-- Key component -->
 <!--                                       <div class="hv-item">-->
            
 <!--                                           <div class="hv-item-parent">-->
 <!--                                               <div class="person">-->
 <!--                                                   <?php if($d21['status']==1){ ?>-->
 <!--                          <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d21['user_id']; ?>','<?=$d21['reg_date']; ?>','<?=$d21['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d11['user_id']; ?>','<?=$d21['reg_date']; ?>','<?=$d21['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                   <p class="name" style="border:1px solid;">-->
 <!--                                                       <a href="#" onclick="getTree('<?= $d21['user_id'];?>')"><?= $d21['name']." (".$d21['user_id'].")"; ?></a>-->
                                                   
 <!--                                                   </p>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
 <!--                                           <?php if($d31) { ?>-->
 <!--                                           <div class="hv-item-children">-->
            
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                      <?php if($d31['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d31['user_id']; ?>','<?=$d31['reg_date']; ?>','<?=$d31['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d31['user_id']; ?>','<?=$d31['reg_date']; ?>','<?=$d31['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                          <a href="#" onclick="getTree('<?= $d31['user_id'];?>')"><?= $d31['name']." (".$d31['user_id'].")"; ?></a>-->
 <!--                                                           <br>-->
 <!--                               <?= $d31['place'];?>-->
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                               <?php if($d32){ ?>    -->
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                       <?php if($d32['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d32['user_id']; ?>','<?=$d32['reg_date']; ?>','<?=$d32['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d32['user_id']; ?>','<?=$d32['reg_date']; ?>','<?=$d32['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                          <a href="#" onclick="getTree('<?= $d32['user_id'];?>')"><?= $d32['name']." (".$d32['user_id'].")"; ?></a>-->
                                                         
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                               <?php } else { ?>-->
                                                
 <!--                                                  <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--<img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                            
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                         Join Now</a>-->
 <!--                                                           <br>-->
                              
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                               <?php } ?>-->
 <!--                                           </div>-->
 <!--                                           <?php } else { ?>-->
 <!--                                            <div class="hv-item-children">-->
            
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                      <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                            
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                     Join Now-->
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                                 </div>-->
 <!--                                           <?php } ?>-->
 <!--                                       </div>-->
 <!--                                   </div>-->
                    
 <!--                                   <?php if($d22){ ?>-->
 <!--                                   <div class="hv-item-child">-->
                                        <!-- Key component -->
 <!--                                       <div class="hv-item">-->
            
 <!--                                           <div class="hv-item-parent">-->
 <!--                                               <div class="person">-->
 <!--                                                   <?php if($d22['status']==1){ ?>-->
 <!--                            <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d22['user_id']; ?>','<?=$d22['reg_date']; ?>','<?=$d22['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d22['user_id']; ?>','<?=$d22['reg_date']; ?>','<?=$d22['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                   <p class="name" style="border:1px solid;">-->
 <!--                                                       <a href="#" onclick="getTree('<?= $d22['user_id'];?>')"><?= $d22['name']." (".$d22['user_id'].")"; ?></a>-->
                                                        
                                                    
 <!--                                                   </p>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
                                            
 <!--                                           <?php if($d33){ ?>-->
 <!--                                           <div class="hv-item-children">-->
            
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                       <?php if($d33['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d33['user_id']; ?>','<?=$d33['reg_date']; ?>','<?=$d33['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d33['user_id']; ?>','<?=$d33['reg_date']; ?>','<?=$d33['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                           <a href="#" onclick="getTree('<?= $d33['user_id'];?>')"><?= $d33['name']." (".$d33['user_id'].")"; ?></a>-->
                                                       
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
            
 <!--                                               <?php if($d34) { ?>-->
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                        <?php if($d34['status']==1){ ?>-->
 <!--                          <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d34['user_id']; ?>','<?=$d34['reg_date']; ?>','<?=$d34['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d34['user_id']; ?>','<?=$d34['reg_date']; ?>','<?=$d34['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                          <a href="#" onclick="getTree('<?= $d34['user_id'];?>')"><?= $d34['name']." (".$d34['user_id'].")"; ?></a>-->
                                                    
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                               <?php } else { ?>-->
 <!--                                                   <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
                                                    
 <!--                          <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                           
                            
                           
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                  Join Now-->
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                               <?php } ?>-->
 <!--                                           </div>-->
 <!--                                           <?php } else { ?>-->
 <!--                                               <div class="hv-item-children">-->
            
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
                                                       
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                           
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                 Join Now-->
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div></div>-->
 <!--                                           <?php } ?>-->
 <!--                                       </div>-->
 <!--                                   </div>-->
 <!--                                   <?php } else { ?>-->
 <!--                                    <div class="hv-item-child">-->
                                        <!-- Key component -->
 <!--                                       <div class="hv-item">-->
            
 <!--                                           <div class="hv-item-parent">-->
 <!--                                               <div class="person">-->
                                               
 <!--                            <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                           
 <!--                                                   <p class="name" style="border:1px solid;">-->
 <!--                                                   Join Now-->
 <!--                                                   </p>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
 <!--                                             </div>-->
 <!--                                           </div>-->
 <!--                                   <?php } ?>-->
 <!--                               </div>-->
 <!--                               <?php } else { ?>-->
 <!--                                    <div class="hv-item-children">-->

 <!--                                   <div class="hv-item-child">-->
                                        <!-- Key component -->
 <!--                                       <div class="hv-item">-->
            
 <!--                                           <div class="hv-item-parent">-->
 <!--                                               <div class="person">-->
                                                  
 <!--                          <img src="<?=base_url();?>tree/images/CORS.png" alt="" >-->
 <!--                                      <p class="name" style="border:1px solid;">-->
 <!--                                           Join Now  -->
 <!--                                                   </p>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
 <!--                                            </div>-->
 <!--                                           </div>  </div>-->
 <!--                               <?php } ?>-->
 <!--                           </div>-->
 <!--                       </div>-->

 <!--                       <?php if($d12) { ?>-->
 <!--                       <div class="hv-item-child">-->
                            <!-- Key component -->
 <!--                           <div class="hv-item">-->

 <!--                               <div class="hv-item-parent">-->
 <!--                                   <div class="person">-->
 <!--                                        <?php if($d12['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d12['user_id']; ?>','<?=$d12['reg_date']; ?>','<?=$d12['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d22['user_id']; ?>','<?=$d12['reg_date']; ?>','<?=$d12['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                       <p class="name" style="border:1px solid;">-->
 <!--                                          <a href="#" onclick="getTree('<?= $d12['user_id'];?>')"><?= $d12['name']." (".$d12['user_id'].")"; ?></a>-->
                                         
 <!--                                       </p>-->
 <!--                                   </div>-->
 <!--                               </div>-->
                                
 <!--                               <?php if($d23) { ?>-->
 <!--                               <div class="hv-item-children">-->

 <!--                                   <div class="hv-item-child">-->
                                        <!-- Key component -->
 <!--                                       <div class="hv-item">-->
            
 <!--                                           <div class="hv-item-parent">-->
 <!--                                               <div class="person">-->
 <!--                                                   <?php if($d23['status']==1){ ?>-->
 <!--                         <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d23['user_id']; ?>','<?=$d23['reg_date']; ?>','<?=$d23['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d23['user_id']; ?>','<?=$d23['reg_date']; ?>','<?=$d23['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                   <p class="name" style="border:1px solid;">-->
 <!--                                                      <a href="#" onclick="getTree('<?= $d23['user_id'];?>')"><?= $d23['name']." (".$d23['user_id'].")"; ?></a>-->
                                                        
                                                    
 <!--                                                   </p>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
            
 <!--                                           <?php if($d35) { ?>-->
 <!--                                           <div class="hv-item-children">-->
            
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                       <?php if($d35['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d35['user_id']; ?>','<?=$d35['reg_date']; ?>','<?=$d35['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d35['user_id']; ?>','<?=$d35['reg_date']; ?>','<?=$d35['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                          <a href="#" onclick="getTree('<?= $d35['user_id'];?>')"><?= $d35['name']." (".$d35['user_id'].")"; ?></a>-->
                                                            
                                                     
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
                                                
 <!--                                               <?php if($d36) { ?>-->
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                       <?php if($d36['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d36['user_id']; ?>','<?=$d36['reg_date']; ?>','<?=$d36['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d36['user_id']; ?>','<?=$d36['reg_date']; ?>','<?=$d36['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                         <a href="#" onclick="getTree('<?= $d36['user_id'];?>')"><?= $d36['name']." (".$d36['user_id'].")"; ?></a>-->
                                                     
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                               <?php } else { ?>-->
                                                
 <!--                                                 <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
                                                        
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;">-->
                           
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                   Join Now-->
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
                                                
 <!--                                               <?php } ?>-->
 <!--                                           </div>-->
 <!--                                           <?php } else { ?>-->
 <!--                                               <div class="hv-item-children">-->
            
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
                                                     
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                           
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                        Join Now-->
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                                </div>-->
 <!--                                           <?php } ?>-->
 <!--                                       </div>-->
 <!--                                   </div>-->

 <!--                                   <?php if($d24) { ?>-->
 <!--                                   <div class="hv-item-child">-->
                                        <!-- Key component -->
 <!--                                       <div class="hv-item">-->
            
 <!--                                           <div class="hv-item-parent">-->
 <!--                                               <div class="person">-->
 <!--                                                   <?php if($d24['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d24['user_id']; ?>','<?=$d24['reg_date']; ?>','<?=$d24['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d24['user_id']; ?>','<?=$d24['reg_date']; ?>','<?=$d24['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                   <p class="name" style="border:1px solid;">-->
 <!--                                                       <a href="#" onclick="getTree('<?= $d24['user_id'];?>')"><?= $d24['name']." (".$d24['user_id'].")"; ?></a>-->
                                                 
 <!--                                                   </p>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
                                            
 <!--                                           <?php if($d37) { ?>-->
 <!--                                           <div class="hv-item-children">-->
            
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                        <?php if($d37['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d37['user_id']; ?>','<?=$d37['reg_date']; ?>','<?=$d37['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d37['user_id']; ?>','<?=$d37['reg_date']; ?>','<?=$d37['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                           <a href="#" onclick="getTree('<?= $d37['user_id'];?>')"><?= $d37['name']." (".$d37['user_id'].")"; ?></a>-->
                                                       
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
            
 <!--                                               <?php if($d38) { ?>-->
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
 <!--                                                       <?php if($d38['status']==1){ ?>-->
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" onmouseover="mykkfunction('<?=$d38['user_id']; ?>','<?=$d38['reg_date']; ?>','<?=$d38['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } else{ ?>-->
                            
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: red;" onmouseover="mykkfunction('<?=$d38['user_id']; ?>','<?=$d38['reg_date']; ?>','<?=$d38['sponcer_id']; ?>','00')" onmouseout="myfunction1()">-->
 <!--                           <?php } ?>-->
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                         <a href="#" onclick="getTree('<?= $d38['user_id'];?>')"><?= $d38['name']." (".$d38['user_id'].")"; ?></a>-->
                                                       
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                               <?php } else { ?>-->
 <!--                                                  <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
                                                      
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                          
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                         Join Now-->
                                                        
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                               <?php } ?>-->
 <!--                                           </div>-->
 <!--                                           <?php }  else { ?>-->
 <!--                                            <div class="hv-item-children">-->
            
 <!--                                               <div class="hv-item-child">-->
 <!--                                                   <div class="person">-->
                                                       
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                           
 <!--                                                       <p class="name" style="border:1px solid;">-->
 <!--                                                    Join Now-->
 <!--                                                       </p>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                           <?php } ?>-->
 <!--                                       </div>-->
 <!--                                   </div>-->
 <!--                                   <?php } else { ?>-->
                                    
 <!--                                       <div class="hv-item-child">-->
                                        <!-- Key component -->
 <!--                                       <div class="hv-item">-->
            
 <!--                                           <div class="hv-item-parent">-->
 <!--                                               <div class="person">-->
                                                 
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                            
 <!--                                                   <p class="name" style="border:1px solid;">-->
 <!--                                                     Join Now-->
 <!--                                                   </p>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
 <!--                                    </div>-->
 <!--                                           </div>-->
                                    
                                    
 <!--                                   <?php } ?>-->
 <!--                               </div>-->
 <!--                               <?php } else { ?>-->
                                
 <!--                                 <div class="hv-item-children">-->

 <!--                                   <div class="hv-item-child">-->
                                        <!-- Key component -->
 <!--                                       <div class="hv-item">-->
            
 <!--                                           <div class="hv-item-parent">-->
 <!--                                               <div class="person">-->
                                                
 <!--                         <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
 <!--                                      <p class="name" style="border:1px solid;">-->
 <!--                                                   Join Now-->
 <!--                                                   </p>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
 <!--                                </div>-->
 <!--                                           </div>-->
 <!--                               </div>-->
 <!--                               <?php } ?>-->
 <!--                           </div>-->
 <!--                       </div>-->
 <!--                       <?php } else { ?>-->
 <!--                        <div class="hv-item-child">-->
                            <!-- Key component -->
 <!--                           <div class="hv-item">-->

 <!--                               <div class="hv-item-parent">-->
 <!--                                   <div class="person">-->
                                       
 <!--                           <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;" >-->
                          
                            
                            
 <!--                                       <p class="name" style="border:1px solid;">-->
 <!--                                        Jion Now-->
                                            
 <!--                                       </p>-->
 <!--                                   </div>-->
 <!--                               </div>-->
 <!--                               </div>-->
 <!--                               </div>-->
 <!--                       <?php } ?>-->
                        
 <!--                   </div>-->
 <!--                   <?php } else { ?>-->
 <!--                    <div class="hv-item-children">-->

 <!--                       <div class="hv-item-child">-->
                            <!-- Key component -->
 <!--                           <div class="hv-item">-->

 <!--                               <div class="hv-item-parent">-->
 <!--                                   <div class="person">-->
                                       
 <!--                          <img src="<?=base_url();?>tree/images/CORS.png" alt="" style="background-color: green;">-->
                           
 <!--                                       <p class="name" style="border:1px solid;">-->
 <!--                                       Join Now-->
                             
 <!--                                       </p>-->
 <!--                                   </div>-->
 <!--                               </div>-->
 <!--                                 </div>-->
 <!--                               </div>-->
 <!--                               </div>-->
 <!--                   <?php } ?>-->
 <!--               </div>-->

 <!--           </div>-->
	<?php
	}
	else  "This User_id Not Exits In Your Tree";
    }
               
 }
   public function getUserTreeTree(){
	?>
		<div class="hv-wrapper">
                <?php
                $d11=$d12=$d21=$d22=$d23=$d24=$d31=$d32=$d33=$d34=$d35=$d36=$d37=$d38=null;
                
                $user_id = $_POST['id'];
                
                if($user_id == ''){
                    echo "Please enter user id";
                    die;
                }
                // .............................................
                
                $arr = $this->db->get_where('users',['user_id'=> $user_id], 1)->row_array();
                $arr1 = $this->db->get_where('users',['parent'=> $user_id], 2)->result_array();
                
                // .................................................
               
        
                
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
                }
                // echo "<pre>"; print_r($d11);
                ?>
                   <table align="center" style="width: 98%; text-align: center; font-size: 13px; font-family:Tahoma">
                                <tbody>

                                <tr>
                                    <td colspan="18">

                                        <img id="ctl00_ContentPlaceHolder1_Image1" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$arr['user_id']; ?>','<?=$arr['reg_date']; ?>','<?=$arr['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        
                                        <br>
<b><?=$arr['user_id']; ?>,<?=$arr['name']; ?></b>

                                    </td>
                                </tr>
                                <tr>
                                    
                                        
                                    <td colspan="18">
                                        <img id="ctl00_ContentPlaceHolder1_Image2" src="<?=base_url('assets/');?>tree1.gif" style="height:50px;width:500px;border-width:0px;">
                                       
                                    </td>
                               
                                </tr>
<?php for ($i=1; $i<=1; $i++)	{ ?>

                              <tr>
                                    <td colspan="2">&nbsp;</td>
                                   
                                    <td colspan="5">
                                        <?php  $arr1 = $this->db->get_where('users',['parent'=> $this->logged['user_id']],2)->result_array();  foreach ($arr1 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>
                                          <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;"  onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                          <br>  <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                       <?php } } else { ?>
                                        <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('Add New Member')" >

                                        <br><b>Join Now</b>
                                    <?php }  } ?>
                                   </td>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="5">
                                          <?php  $arr1 = $this->db->get_where('users',['parent'=> $this->logged['user_id']],2)->result_array();  foreach ($arr1 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                          <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                          <br>  
                                                <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                       <?php } } else { ?>
                                        <img id="ctl00_ContentPlaceHolder1_imgFL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">

                                        <br><b>Join Now</b>
                                    <?php  } } ?></td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                
                                <?php } ?>
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
                                     
                                        <img id="ctl00_ContentPlaceHolder1_img3L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                    <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                  <?php } } else { ?>
                                     <img id="ctl00_ContentPlaceHolder1_img3R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                  <?php } } ?>

                                    </td>
                                    <td colspan="3">

 <?php  $arr21 = $this->db->get_where('users',['parent'=> $d11['user_id']],2)->result_array();  foreach ($arr21 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
      <img id="ctl00_ContentPlaceHolder1_img3L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">   <br>
                                   <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                          
                                        <img id="ctl00_ContentPlaceHolder1_Img2L2" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                       <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                      <?php } } else { ?>
                                       <img id="ctl00_ContentPlaceHolder1_img3R" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                      <?php  } } ?>

                                    </td>
                                    <td colspan="4">
                                       <?php    $arr22 = $this->db->get_where('users',['parent'=> $d12['user_id']], 2)->result_array(); foreach ($arr22 as $key => $value) {  
                                         if($value['place']=='Right') {  
                                          if(isset($value)) { ?>
                                         
                                        <img id="ctl00_ContentPlaceHolder1_Img2R2" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()"><br>  <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                        
                                        <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>

                                    <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                                <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
<b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                              <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
  <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                          
                                            <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>

                                    <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                           
                                            <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                     <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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
                                           
                                       <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                   <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                      <?php } } else { ?>
                                           <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                      <?php } } ?>
                                      </td>
                                    <td colspan="2">
                                        <?php  $arr34 = $this->db->get_where('users',['parent'=> $d24['user_id']], 2)->result_array(); foreach ($arr33 as $key => $value) {  
                                         if($value['place']=='Left') {  
                                          if(isset($value)) { ?>

                                       
                                        <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                     <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
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

                                          <img id="ctl00_ContentPlaceHolder1_imgL5L" src="<?=base_url('assets/');?>blue.png" style="height:40px;width:40px;border-width:0px;" onmouseover="mykkfunction('<?=$value['user_id']; ?>','<?=$value['reg_date']; ?>','<?=$value['sponcer_id']; ?>','00')" onmouseout="myfunction1()">
                                        <br>
                                  <b class="name" style="border:1px solid;">
                                              <a href="#" onclick="getTree('<?= $value['user_id'];?>')"><?= $value['name']." (".$value['user_id'].")"; ?></a></b>
                                      <?php } } else { ?>
                                           <img id="ctl00_ContentPlaceHolder1_img5LL" src="<?=base_url('assets/');?>black.png" style="height:40px;width:40px;border-width:0px;">
                                        <br><b>Join Now</b>
                                    <?php } } ?>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody></table>
                
	<?php
               
 }
 
  public function countDownSearch()
	{
		$right=[]; $left=[]; $down=[]; 
		unset($_SESSION['dList']);
		$_SESSION['dList']=[];
		$id=$_POST['user_id'];
		$this->comm->downLineUserMatch($id);
		$down=$_SESSION['dList'];
		$lu=$this->dbm->getWhere('users',['place'=>'Left','parent'=>$id]);
		if($lu)
		{
			unset($_SESSION['dList']);
			$_SESSION['dList']=[];
			$this->comm->downLineUserMatch($lu['user_id']);
			$left=$_SESSION['dList'];
			array_unshift($left, $lu['user_id']);
		}
		$ru=$this->dbm->getWhere('users',['place'=>'Right','parent'=>$id]);
		if($ru)
		{
			unset($_SESSION['dList']);
			$_SESSION['dList']=[];
			$this->comm->downLineUserMatch($ru['user_id']);
			$right=$_SESSION['dList'];
			array_unshift($right, $ru['user_id']);
		}
		$arr['down']=count($down);
		$arr['left']=count($left);
		$arr['right']=count($right);	
		//echo "<pre>"; print_r($arr);	
		echo json_encode($arr);
	}
	public function countAmt()
	{
	    $id=$_POST['user_id'];
	    $user = $this->db->get_Where('users',['user_id'=>$id])->row_array();
        $ru['amount'] = $user['package'];
        $ru['bv'] = $user['bv'];
        echo json_encode($ru);
	}
	public function downLineUserMatch($param1 = '', $param2 = '') {
        $id = $param1;
        $res1 = $this->dbm->globalSelect('users', ['parent' => $id]);
        if (!empty($res1)) {
            foreach ($res1 as $key => $value) {
                $_SESSION['dList'][] = $value['user_id'];
                $this->downLineUserMatch($value['user_id']);
            }
        }
    }
	public function plotSectionche()
    {
        $grandeLeftAMT = 0;
        $extraLeft = 0;
        $extraRight = 0;
        $leftAmt = 0;
        $rightAmt = 0;
        $pairAmt = 0;
        $grandeLeft = 0;
        $granderight = 0;
        $currentPairMach = 0;
        $grandeLeftAMT = 0;
        $granderightAMT = 0;
        $previousLeft = 0;
        $previousRightAmt = 0;
        $right = [];
        $left = [];
        $down = [];
        $bonus = 0;
        $rightComm = 0;
        $leftComm = 0;
        unset($_SESSION['dList']);
        $_SESSION['dList'] = [];
        $id=$_POST['user_id'];
        $lu = $this->dbm->getWhere('users', ['place' => 'Left', 'parent' => $id]);
        if ($lu) {
            unset($_SESSION['dList']);
            $_SESSION['dList'] = [];
            $this->downLineUserMatch($lu['user_id']);
            $left = $_SESSION['dList'];
            array_unshift($left, $lu['user_id']);
        }
        $ru = $this->dbm->getWhere('users', ['place' => 'Right', 'parent' => $id]);
        if ($ru) {
            unset($_SESSION['dList']);
            $_SESSION['dList'] = [];
            $this->downLineUserMatch($ru['user_id']);
            $right = $_SESSION['dList'];
            array_unshift($right, $ru['user_id']);
        }
        $arr['left'] = $left;
        $arr['right'] = $right;
        foreach ($arr['left'] as $key => $val) {
            $prp = $this->db->select('user_id,sum(bv) as total')->get_where('users', ['user_id' => $val, 'status' => 1])->row_array();
            $leftAmt = $prp['total'];
            $grandeLeftAMT = $grandeLeftAMT + $leftAmt;
        }
        foreach ($arr['right'] as $key => $value) {
            $prp = $this->db->select('user_id,sum(bv) as total')->get_where('users', ['user_id' => $value, 'status' => 1])->row_array();
            $rightAmt = $prp['total'];
            $granderightAMT = $granderightAMT + $rightAmt;
        }
		  $ru['rightb'] = $granderightAMT;
		  $ru['leftb']  =  $grandeLeftAMT;
		  echo json_encode($ru);
    }
	
}
