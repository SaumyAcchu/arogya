<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/////
require_once(APPPATH."libraries/atom/TransactionRequest.php");
require_once(APPPATH."libraries/atom/TransactionResponse.php");
/////
require_once(APPPATH."libraries/lib/config_paytm.php");
require_once(APPPATH."libraries/lib/encdec_paytm.php");
// payUmony class

use CodeZero\PayUMoney\PayUMoney;
use CodeZero\PayUMoney\PurchaseResult;

// end of payUmoney class
class User extends MY_Controller {
	public function __construct()
	{
		parent:: __construct();
		if(!$logged=$this->session->userdata('loggedUser'))
		{ return redirect('login'); }
		$this->load->model('dbm');
		$this->load->model('comm');
		$this->load->model('repurchase_model');
	}
	
	public function getData1($table='',$id='',$page='')
	{
		$result['get_data']=$this->dbm->getWhere($table,['id'=>$id]);
		$this->load->view('admin/'.$page,$result);
	}
    public function allda()
	{
// 	    $date=date('Y-m-d',strtotime('previous day'));
// 	$valid=$this->dbm->rowCount('royalty_income',['date'=>$date]);
// 		 if($valid<1)
// 		 {
// 		 	$this->comm->royaltyIncome();
// 		 }
	}

    public function downLine($param1='',$param2='')
	{
		unset($_SESSION['dList']);
		$_SESSION['dList']=[];
		$arr=[];
		$id=$this->logged['user_id'];
		$str=base64_decode($param1);
		if($str=='left')
		{
			$lu=$this->dbm->getWhere('users',['place'=>'Left','parent'=>$id]);
			if($lu)
			{
				$this->comm->downListRR($lu['user_id']);
				$arr=$_SESSION['dList'];
				array_unshift($arr, $lu);
			}
		}elseif($str=='right')
		{
			$ru=$this->dbm->getWhere('users',['place'=>'Right','parent'=>$id]);
			if($ru)
			{
				$this->comm->downListRR($ru['user_id']);
				$arr=$_SESSION['dList'];
				array_unshift($arr, $ru);
			}
		}elseif($str=='all')
		{
			$this->comm->downList($id);
			$arr=$_SESSION['dList'];
		}else
		{
			$arr=[];
		}
		$data=base64_encode('downLine/1/Down Line '.strtoupper($str));
		$this->statics($data,$arr);
		//echo "<pre>"; print_r($arr);
	}
    public function lvlstatics()
    {
        $this->load->view('user/level-statics');
    }
     public function countDown()
	{
		$right=[]; $left=[]; $down=[];
		unset($_SESSION['dList']);
		$_SESSION['dList']=[];
		$id=$this->logged['user_id'];
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

    public function liveChart($value='')
	{
		$arr['level']=$this->dbm->globalSelect('level',['type'=>'india']);
		$this->load->view('user/live-chart',$arr);
	}
        
	public function getAllB()
	{
		$i=1;
		$arr=$this->dbm->globalSelect('india_b1');
		echo "<pre>"; print_r($arr);
		//foreach ($arr as $key => $value) {
			// $dir=$this->dbm->rowCount('users',['sponcer_id'=>$value['user_id'],'status'=>1]);
			// if($dir>0)
			// {
			// 	$arr1['num']=$i;
			// 	$arr1['user_id']=$value['user_id'];
			// 	echo "<pre>"; print_r($arr1); $i++;
			// }
		//}
		
	}
	public function get_team($arr='')
	{
	   
	   $arr2['data']=$this->dbm->globalSelect('club_users',['user_id'=>$arr]);
	   
	   $this->load->view('user/team-management',$arr2);
	}
	
	public function Team_management($param1='')
	{       
	        $data = [];
		    $id=$this->logged['user_id'];
		    unset($_SESSION['dList']);
		    $_SESSION['TList']=[];
		    $arr=[];
			$this->comm->TeamList($id);
			$arr=$_SESSION['TList'];
			$i=1;
			foreach ($arr as $key => $value) 
			{
	        $arr1=$this->dbm->globalSelect('club_users',['user_id'=>$value['user_id']]);
	        if($arr1){
	         $data[] = $arr1;
	         }
			}
			$result['data'] = $data;
			$this->load->view('user/team-management',$result);
			
	}
	
	public function loopNew()
	{
	    echo "<table border='1'>";
		$j=0; $k=1; $pre=2; $max=0; $jump=4;$mul=4;
		//$lvl=$this->dbm->globalSelect('level',['type'=>'india']);
		$lvl=[['team'=>6],['team'=>24],['team'=>96],['team'=>128]];
		//echo "<pre>"; print_r($lvl); exit;
		echo "<tr>";
		foreach($lvl as $key => $value)
		{
			$max=$max+$value['team'];
			$j=$j+$value['team'];
			$max=$j;
				echo "<td>";
			for ($i=1; $i <=500; $i++)
			{
				echo "".$i." = ".$k." - ".$max."</br>";
				$max=$max+$jump;
				$k=$k+$pre;
			}
				echo "</td>";
			$max=$value['team'];
			$k=$j+1;
			$pre=$pre*$mul;
			$jump=$jump*$mul;
			
		}
		echo "</tr>";
		echo "</table>";
	}

	public function loop()
	{
		$j=0; $k=1; $pre=2; $max=0; $jump=4;$mul=4;
		$lvl=$this->dbm->globalSelect('level',['type'=>'india']);
		//$leader=$this->dbm->globalSelect('users',['status'=>1,'access'=>'limited']);
		//$down=count($leader)-1;
		echo "<table border='1'>";
		echo "<tr>";
		foreach($lvl as $key => $value)
		{
			echo "<td>";
			$max=$max+$value['team'];
			$j=$j+$value['team'];
			$max=$j;
			for($h=1; $h<=50; $h++)
			{
				echo $h." - ".$max."<br>";
				// if($h>=$max)
				// {
					
				// }
				$max=$max+$jump;
				$k=$k+$pre;
			}
			$max=$value['team'];
			$k=$j+1;
			$pre=$pre*$mul;
			$jump=$jump*$mul;
			echo "</td>";
		}
		echo "</tr>";
		echo "</table>";
	}
	public function loopIndia()
	{
	    echo "<table border='1'>";
		$j=0; $k=1; $pre=3; $max=0; $jump=9;$mul=9;
		$lvl=$this->dbm->globalSelect('level',['type'=>'india']);
		echo "<tr>";
		foreach($lvl as $key => $value)
		{
			$max=$max+$value['team'];
			$j=$j+$value['team'];
			$max=$j;
				echo "<td>";
			for ($i=1; $i <=500; $i++)
			{
			echo "".$i." = ".$k." - ".$max."</br>";

				$max=$max+$jump;
				$k=$k+$pre;
			}
				echo "</td>";
			$max=$value['team'];
			$k=$j+1;
			$pre=$pre*$mul;
			$jump=$jump*$mul;
			
		}
		echo "</tr>";
		echo "</table>";
	}

	public function index()
	{
		if($this->logged['access']=='universal')
		{ return redirect('auth'); }
		$result['notice']=$this->dbm->globalSelect('notice');
		$result['catlog']=$this->dbm->globalSelect('catlog');
		$result['directs']=$this->dbm->globalSelect('users',['sponcer_id'=>$this->logged['user_id']]);
		function getLastNDays($days, $format = 'Y-m-d')
		{
		    $m = date("m"); $de= date("d"); $y= date("Y");
		    $dateArray = array();
		    for($i=0; $i<=$days-1; $i++){
		        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
		    }
		    return array_reverse($dateArray);
		}
		$arr = getLastNDays(30);
		foreach ($arr as $key => $value)
		{
			$data[]=[
				'y'=>$value,
				'a'=>$this->dbm->rowCount('users',['active_date'=>$value,'status'=>1]),
				'b'=>$this->dbm->rowCount('users',['reg_date'=>$value])
			];
		}
		$result['data']=$data;
		$bv = $this->countDownBusiness();
		$result['rbv']=$bv['rbv'];
		$result['lbv']=$bv['lbv'];
		$this->load->view('user/user-dashboard',$result);
	}

	public function explore($page='')
	{
		$this->load->view('user/'.$page);
	}
	public function KYCupdate($id='')
	{
	    $data=$_POST;
	    $e=$_FILES['image1']['name'];
		    if($e)
		    {
			$config = array(
					'upload_path' => "./uploads",
					'allowed_types' => "jpg|png|jpeg|gif",
				);
			$this->load->library('upload',$config);
			$this->upload->do_upload('image1');
			$img=$this->upload->data();
			$data['image1']=$e;
		    }
		$f=$_FILES['image2']['name'];
		    if($f)
		    {
			$config = array(
					'upload_path' => "./uploads",
					'allowed_types' => "jpg|png|jpeg|gif",
				);
			$this->load->library('upload',$config);
			$this->upload->do_upload('image2');
			$img=$this->upload->data();
			$data['image2']=$f;
		    }
		$g=$_FILES['image3']['name'];
		    if($f)
		    {
			$config = array(
					'upload_path' => "./uploads",
					'allowed_types' => "jpg|png|jpeg|gif",
				);
			$this->load->library('upload',$config);
			$this->upload->do_upload('image3');
			$img=$this->upload->data();
			$data['image3']=$g;
		    }
		    $data['kyc']=1;
		$result=$this->dbm->globalUpdate('users',['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Updating Failed ! Try Again');
		}
		return redirect('user/explore/my-profile');
		
	
	}
	public function exploreData($str='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$page=$arr[1];  //Landing Page
		$result['data']=$this->dbm->globalSelect($table);
		$this->load->view('user/'.$page,$result);
	}

	public function getData($str='',$id='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$id=$arr[1];    //Row ID
		$page=$arr[2];  //Landing Page
		$result['get_data']=$this->dbm->getWhere($table,['id'=>$id]);
		$this->load->view('user/'.$page,$result);
	}

	public function getAllData($str='',$other='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$tblField=$arr[1];  //DB Table field
		$matcher=$arr[2];  //Matching Value
		$page=$arr[3];  //Landing Page
		$result['data']=$this->dbm->globalSelect($table,[$tblField=>$matcher]);
		$this->load->view('user/'.$page,$result);
	}

	public function updateData($str='',$id='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$id=$arr[1];    //Row ID
		$page=$arr[2];  //Landing Page
		$data=$_POST;
		$result=$this->dbm->globalUpdate($table,['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Updating Failed ! Try Again');
		}
		return redirect('user/exploreData/'.$table.'/'.$page);	
	}

	public function insertData($str='',$getData='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$page=$arr[1];  //Landing Page
		if(!empty($getData))
		{
			$data=$getData;
		}else
		{
			$data=$_POST;
		}
		
		$result=$this->dbm->globalInsert($table,$data);
		if($result)
		{
			$this->setMessage('1','Data Inserted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Inserting Failed ! Try Again');
		}
		return redirect('user/exploreData/'.$str);	
	}

	public function deleteData($str='',$id='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$id=$arr[1];    //Row ID
		$page=$arr[2];  //Landing Page
		$data=$_POST;
		$result=$this->dbm->globalDelete($table,['id'=>$id]);
		if($result)
		{
			$this->setMessage('1','Data Deleted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data not Deleted ! Try Again');
		}
		return redirect('user/exploreData/'.$table.'/'.$page);	
	}

	public function insertDataWithFile($str='',$page='',$param3='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$page=$arr[1];  //Landing Page
		$data=$_POST;
		$a=$_FILES['image']['name'];
		if($a)
		{
			$config = array(
					'upload_path' => "./uploads",
					'allowed_types' => "jpg|png|jpeg",
				);
			$this->load->library('upload',$config);
			$this->upload->do_upload('image');
			$img=$this->upload->data();
			$data['image']=$img['file_name'];
		}
		else
		{
			$data['image']='red.png';
		}
		$result=$this->dbm->globalInsert($table,$data);
		if($result)
		{
			$this->setMessage('1','Data Inserted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Inserting Failed ! Try Again');
		}
		return redirect('user/exploreData/'.$table.'/'.$page);
	}

	public function updateDataWithFile($str='',$id='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$id=$arr[1];    //Row ID
		$page=$arr[2];  //Landing Page
		$data=$_POST;
		$a=$_FILES['image']['name'];
		if($a)
		{
			$config = array(
					'upload_path' => "./uploads",
					'allowed_types' => "jpg|png|jpeg",
				);
			$this->load->library('upload',$config);
			$this->upload->do_upload('image');
			$img=$this->upload->data();
			$data['image']=$img['file_name'];
		}
		else
		{
			$data=$_POST;
		}
		$result=$this->dbm->globalUpdate($table,['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Updating Failed ! Try Again');
		}
		return redirect('user/exploreData/'.base64_encode($table.'/'.$page));
	}

	public function setMessage($param1='',$param2='')
	{
		if($param1==1)
		{
			$this->session->set_flashdata('msg',$param2);
			$this->session->set_flashdata('msg_class','alert-success');
		}
		else
		{
			$this->session->set_flashdata('msg',$param2);
			$this->session->set_flashdata('msg_class','alert-danger');
		}
	}

	public function royalty($str='',$other='')
	{
		$id=$this->logged['user_id'];
		$result['royalty']=$this->dbm->globalSelect('royalty',['user_id'=>$id]);
		$result['income']=$this->dbm->globalSelect('royalty_income',['user_id'=>$id]);
		//echo "<pre>"; print_r($result); exit;
		$this->load->view('user/royalty',$result);
	}

	public function paymentHistory($str='',$other='')
	{
    	$id=$this->logged['user_id'];
		$result['pairMatch']=$this->dbm->globalSelect('pairmaching',['user_id'=>$id,'paidAmt!='=>0]);
		$result['referral']=$this->dbm->globalSelect('direct_comm',['beneficiary'=>$id]);
		$result['roi']=$this->dbm->globalSelect('club_income',['user_id'=>$id,'amount!='=>0]);
		$result['month']=$this->dbm->globalSelect('monthly_income',['user_id'=>$id,'amount!='=>0]);
		$this->load->view('user/payment-history',$result);
	}

	public function upgrade($param1='',$param2='')
	{
		$data=$_POST;
		$data['date']=date('Y-m-d');
		$data['time']=date('H:i:s');
		$data['user_id']=$this->logged['user_id'];
		$data['status']=1;
		$count=$this->dbm->rowCount('upgrade',['user_id'=>$data['user_id'],'plan_id'=>(int) $data['plan_id']]);
		if($count>0)
		{
			$this->setMessage('0','Your Account has been already upgraded for this Club.');
		}
		else
		{
			$res=$this->dbm->globalInsert('upgrade',$data);
			if($res)
			{
				$amt=$this->logged['topup']-$data['amount'];
				$this->dbm->globalUpdate('users',['user_id'=>$data['user_id']],['topup'=>$amt]);
				$ins=$this->dbm->getWhere('upgrade',['id'=>$res]);
				$this->comm->newUniversalPool($ins);
				$this->setMessage('1','Account Upgraded Successfully.');
			}else
			{
				$this->setMessage('0','Account Upgradation Failed.');
			}
		}
		return redirect('user/exploreData/'.base64_encode('plans/upgrade-account'));
	}

	public function pinRequest($param1='',$param2='')
	{
		$data=$_POST;
		$data['user_id']=$this->logged['user_id'];
		$data['req_date']=date('Y-m-d');
		$data['req_time']=date('H:i:s');
		$data['status']=0;
		$result=$this->dbm->globalInsert('pin_request',$data);
		if($result)
		{
			$this->setMessage('1','Request Sent Successfully.');
		}
		else
		{
			$this->setMessage('0','Request sending Failed ! Try Again');
		}
		return redirect('user/getAllData/'.base64_encode('pin_request/user_id/'.$this->logged['user_id'].'/generate-pin'));
	}

	public function getPin($param1='',$param2='')
	{
		$letter=str_shuffle('1ASHISH3ZX1CVB4N2M8ASD0FG5H5JKLQ3WE9RT5YUI7OP8TIWARI11');
		$str=substr($letter,0,6);
		$digit=strtoupper(uniqid());
		$digit=substr($digit,8);
		$rand=rand(100,999);
		$final=strtoupper($str.$rand.$digit);
		$row=$this->dbm->rowCount('pin',['pin'=>$final]);
		if($row>0)
		{
			$this->getPin();
		}else
		{
			return $final;
		}
	}

	public function pinGenerate($param1='',$param2='')
	{
		$data=$_POST;
		if($this->logged['wallet']>=($data['quantity']*$this->siteInfo['pin_amt']))
		{
			$data['gen_date']=date('Y-m-d');
			$data['gen_time']=date('H:i:s');
			$data['status']=0;
			$data['generate_by']='self';
			$data['user_id']=$this->logged['user_id'];
			$total=$data['quantity']*$this->siteInfo['pin_amt'];
			$data['amount']=$this->siteInfo['pin_amt'];
			$leftbalance=$this->logged['wallet']-$total;
			for($i=1; $i<=$data['quantity']; $i++)
			{
				$data['pin']=$this->getPin();
				$res=$this->dbm->globalInsert('pin',$data);
			}
			if($res)
			{
				$this->dbm->globalUpdate('users',['user_id'=>$this->logged['user_id']],['wallet'=>$leftbalance]);
				echo 1;
			}else
			{
				echo 0;
			}
		}else
		{
			echo 0;
		}
	}

	public function activateAccount($param1='',$param2='')
	{
		$pin=$_POST['pin'];
		$account=$_POST['account'];
		$res=$this->dbm->rowCount('pin',['pin'=>$pin,'status'=>0]);
		if($res>0)
		{
			$this->dbm->globalUpdate('users',['user_id'=>$account],['pin'=>$pin,'status'=>1,'active_date'=>date('Y-m-d'),'active_time'=>date('H:i:s')]);
			$this->dbm->globalUpdate('pin',['pin'=>$pin],['activated_account'=>$account,'status'=>1,'date'=>date('Y-m-d'),'time'=>date('H:i:s')]);
			$this->load->model('comm');
			$usr=$this->dbm->getWhere('users',['user_id'=>$account]);
			$this->comm->agentCommission($usr);
			//$this->comm->allIndia($usr);
			$this->setMessage('1','Account Activated Successfully.');
			echo 1;
		}else
		{
			echo 0;
		}
	}
	public function checkPin($param1='',$param2='')
	{
		$pin=$_POST['pin'];
		$res=$this->dbm->rowCount('pin',['pin'=>$pin,'status'=>0]);
		if($res>0)
		{
			echo 1;
		}else
		{
			echo 0;
		}
	}

	public function statics($param1='',$param2='')
	{
		$str=base64_decode($param1);
		$str=explode('/', $str);
		$type= $str[0];
		$status= $str[1];
		$data['title']= $str[2];
		$data['userID']=$userID=$this->logged['user_id'];
		$id=$this->logged['id'];
		if($type=='downLine')
		{
			$data['direct']='Direct';
			$data['down']=$param2;
		}
		if($type=='direct')
		{
			$data['direct']='Direct';
			$data['down']=$this->dbm->globalSelect('users',['sponcer_id'=>$userID,'status'=>$status]);
		}
		if($type=='directAll')
		{
			$data['direct']='Direct';
			$data['down']=$this->dbm->globalSelect('users',['sponcer_id'=>$userID]);
		}
		if($type=='self')
		{
			$arr=[];
			$res=$this->comm->selfTeam($this->logged['user_id']);
			foreach ($res as $key => $value)
			{
				foreach ($value as $key => $val)
				{
					foreach ($val as $key => $val1)
					{
						if($val1['status']==$status)
						{
							$arr[]=$val1;
						}
					}
				}
			}
    	 	$data['down']=$arr;
    	 	$data['self']=$this->dbm->globalSelect('level',['type'=>'self']);
		}
		if($type=='selfAll')
		{
			$arr=[];
			$res=$this->comm->selfTeam($this->logged['user_id']);
			foreach ($res as $key => $value)
			{
				foreach ($value as $key => $val)
				{
					foreach ($val as $key => $val1) {
						$arr[]=$val1;
					}
				}
			}
			
    	 	$data['down']=$arr;
    	 	$data['self']=$this->dbm->globalSelect('level',['type'=>'self']);
		}
		if($type=='india')
		{
			$data['down']=$this->dbm->globalSelect('users',['id>'=>$id,'status'=>$status]);
			$data['india']=$this->dbm->globalSelect('level',['type'=>'india']);
		}
		if($type=='indiaAll')
		{
			$data['down']=$this->dbm->globalSelect('users',['id>'=>$id]);
			$data['india']=$this->dbm->globalSelect('level',['type'=>'india']);
		}
		//echo "<pre>";  print_r($data); die;
		$this->load->view('user/statics',$data);
	}


	
	public function pairMatching($param1='',$param2='')
	{
		$data['userID']=$userID=$this->logged['user_id'];
		$data['pair']=$this->dbm->globalSelect('pair_income',['user_id'=>$userID,'status'=>1]);
		//echo "<pre>"; print_r($data); die;
		$this->load->view('user/pair-matching',$data);
	}

	public function checkBalanceTransfer($param1='')
	{
		$user_id=$_POST['user_id'];
		$res=$this->dbm->getWhere('users',['user_id'=>$user_id]);
		if($res)
		{ ?>
			<div class="col-lg-6 col-lg-offset-3">
				<?=form_open('user/balanceTransfer');?>
				<table class="table table-bordered table-striped table hover">
					<tr>
						<td class="txtblue txtcenter" colspan="4">Please Check the Details Carefully</td>
					</tr>
					<tr>
						<th>User ID</th><td colspan="3"><input type="text" name="beneficiary" value="<?=$res['user_id'];?>" class="form-control" readonly></td>
					</tr>
					<tr>
						<th>Name</th><td><?=$res['name'];?></td>
						<th>Sponcer ID</th><td><?=$res['sponcer_id'];?></td>
					</tr>
					<tr>
						<th>Mobile</th><td colspan="3"><?=$res['mobile'];?></td>
					</tr>
					<tr>
						<th>Adrress</th><td colspan="3"><?=$res['address'];?></td>
					</tr>
					<tr>
						<th>Transfer To</th>
						<td colspan="3">
							<select class="form-control" name="transfer_to" required>
								<?php if($user_id==$this->logged['user_id']) { ?>
									<option value="topup">Topup Wallet</option>
								<?php }else{ ?>
									<option value="wallet">Cash Wallet</option>
									<option value="topup">TopUp Wallet</option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<th>Enter Amount</th>
						<td colspan="3">
							<input placeholder="Enter amount to be Send" min="1" type="number" id="amount" name="amount" class="form-control" required>
							<p id="errAmt" class="txtred"></p>
						</td>
					</tr>
					<tr>
						<td></td><td class="txtcenter" colspan="3"><button type="submit" class="btn btn-primary btn-sm btn-block" onclick="return transfer()"> Send <i class="fa fa-location-arrow"></i></button></td>
					</tr>
				</table>
				<form>
			</div>
		<?php
		}else
		{
			echo '<center><p class="txtred">Oops! User ID Not Found.</p></center>';
		}
	}

	public function balanceTransfer($param1='')
	{
		$data=$_POST;
		$wall=$data['transfer_to'];
		unset($data['transfer_to']);
		$data['wallet_type']=$wall;
		$data['date']=date('Y-m-d');
		$data['time']=date('H:i:s');
		$data['user_id']=$this->logged['user_id'];
		$data['type']='transfer';
		$data['status']=1;
		$trncId=$this->dbm->transactionNumber();
		$data['transaction']='T'.$trncId;
		$que=$this->dbm->getWhere('users',['user_id'=>$data['beneficiary']]);
		$total=$que[$wall]+$data['amount'];
		$res=$this->dbm->globalInsert('commission',$data);
		if($res)
		{
			$amt=$this->logged['wallet']-$data['amount'];
			$this->dbm->globalUpdate('users',['user_id'=>$this->logged['user_id']],['wallet'=>$amt]);
			$this->dbm->globalUpdate('users',['user_id'=>$data['beneficiary']],[$wall=>$total]);
			$this->setMessage('1','Balance Transfer Successfully.');
		}else
		{
			$this->setMessage('0','Balance Transfering Failed.');
		}
		return redirect('user/explore/balance-transfer');
	}

	public function query($param1='',$param2='')
	{
		if($param1=='send')
		{
			$data=$_POST;
			$mobile = "9924919238";
			$msg = "Name :".$this->logged['name'].", Message: ".$data['message']." , Contact No: ".$this->logged['mobile'];
		
			$this->dbm->sendSms($mobile,$msg);
			$res=$this->dbm->globalInsert('query',$data);
			if($res)
			{
				$this->setMessage('1','Message Sent Successfully.');
			}
			else
			{
				$this->setMessage('0','Message sending Failed ! Try Again');
			}
			return redirect('user/query/get');
		}
		if($param1=='get')
		{
			$res['data']=$this->dbm->userQuery();
			$this->load->view('user/contact-admin',$res);
		}
	}


	public function fundWithdraw($param1='')
	{
		$data=$_POST;
		if($this->logged['account_number']=='')
		{
			$this->setMessage('0','Please update your Payment Details first');
			return redirect('user/getAllData/'.base64_encode('withdraw/user_id/'.$this->logged['user_id'].'/fund-withdraw'));
		}
		if($data['payment_mode']=='Bank' && $data['amount']<300)
		{
		    $this->setMessage('0','On Bank withdraw minimum amount will be 300');
	    	return redirect('user/getAllData/'.base64_encode('withdraw/user_id/'.$this->logged['user_id'].'/fund-withdraw'));
		}
		if($data['payment_mode']=='Paytm' && $data['amount']<100)
		{
		    $this->setMessage('0','On Paytm withdraw minimum amount will be 100');
	    	return redirect('user/getAllData/'.base64_encode('withdraw/user_id/'.$this->logged['user_id'].'/fund-withdraw'));
		}
		if($this->logged['wallet']>=$data['amount'] && $data['amount']>=100 && $this->logged['wallet']>99 && $data['payment_mode']=='Bank' || $data['payment_mode']=='Paytm')
		{
			if($data['payment_mode']=='Bank')
			{
				$data['account_number']=$this->logged['account_number'];
				$data['branch_name']=$this->logged['branch_name'];
				$data['bank_name']=$this->logged['bank_name'];
				$data['ifsc']=$this->logged['ifsc'];
			}else
			{
				$data['account_number']=$this->logged['account_number'];
			}
			$data['user_id']=$this->logged['user_id'];
			$data['date']=date('Y-m-d');
			$data['time']=date('H:i:s');
			$data['status']=0;
			$res=$this->dbm->globalInsert('withdraw',$data);
			if($res)
			{
				$amt=($this->logged['wallet']-$data['amount']);
				$this->dbm->globalUpdate('users',['user_id'=>$this->logged['user_id']],['wallet'=>$amt]);
				$this->setMessage('1','Request Send Successfully.');
			}
		}
		else
		{
			$this->setMessage('0','Sending Failed ! Try Again');
		}
		return redirect('user/getAllData/'.base64_encode('withdraw/user_id/'.$this->logged['user_id'].'/fund-withdraw'));
	}
	
	public function allIndiaLiveChart($param1='',$param2='')
	{
		$str=base64_decode($param1);
		$usr=$this->logged['user_id'];
		$data['entry']=$this->dbm->globalSelect('india_b1',['user_id'=>$usr,'type'=>'fresh']);
		//echo "<pre>"; print_r($data); die;
		$this->load->view('user/india-live-chart',$data);
	}


	public function checkUserForpinTopup($param1='')
	{
		$res=$this->dbm->getWhere('users',['user_id'=>$_POST['user_id']]);
		if($res)
		{
			if($res['status']==1)
			{
				echo "User Already Active.";
			}else
			{ ?>
				<div class="input-group">
					<input type="text" value="<?=$res['name'];?>" class="form-control" readonly>
					<span class="input-group-btn">
					    <button id="verify" class="btn btn-primary" type="submit">Topup</button>
					</span>
				</div>
			  <?php
			}
		}else
		{
			echo "User ID Not Found.";
		}
		//print_r($res);
	}

	public function checkUserForpinTransfer($param1='')
	{
		$res=$this->dbm->getWhere('users',['user_id'=>$_POST['user_id']]);
		if($res)
		{
			?>
			<th><input type="text" class="form-control" value="<?=$res['name'];?>"></th>
			<td>
				<button type="submit" class="btn btn-primary" type="submit">Transfer</button>
			</td>
			<?php
		}else
		{
			echo "User ID Not Found.";
		}
		//print_r($res);
	}

	public function activePinViaTopup($param1='',$param2='')
	{
		$data['date']=date('Y-m-d');
		$data['time']=date('H:i:s');
		$data['activated_account']=$_POST['user_id'];
		$data['status']=1;
		$user['active_time']=$data['time'];
		$user['active_date']=$data['date'];
		$user['status']=1;
		$user['pin']=$_POST['pin'];
		$valid=$this->dbm->rowCount('pin',['pin'=>$user['pin'],'status'=>1]);
		if($valid>0)
		{
			$this->setMessage('0','This PIN is Already Activated, Try Again!.');
		}else
		{
			$res=$this->dbm->globalUpdate('pin',['pin'=>$_POST['pin']],$data);
			if($res) 
			{
				$this->dbm->globalUpdate('users',['user_id'=>$_POST['user_id']],$user);
				$usr=$this->dbm->getWhere('users',['user_id'=>$_POST['user_id']]);
				$this->comm->agentCommission($usr);
				//$this->comm->allIndia($usr);
				$this->setMessage('1','Account Activated Successfully.');
			}else
			{
				$this->setMessage('0','Account Not Activated, Try Again!.');
			}
		}
		return redirect('user/explore/generate-pin');
	}

	public function transferPinViaTopup($param1='',$param2='')
	{
		$pin1=$this->dbm->globalSelect('pin',['user_id'=>$this->logged['user_id'],'status'=>0,'is_transfer!='=>1]);
		$pin2=$this->dbm->globalSelect('pin',['receiver_id'=>$this->logged['user_id'],'status'=>0]);
		$pin=array_merge($pin1,$pin2);
		$data=$_POST;
		if($data['transfer_quantity']>0 && $data['transfer_quantity']<=count($pin))
		{
			$data['receiver_id']=strtoupper($_POST['receiver_id']);
			$data['transfer_date']=date('Y-m-d');
			$data['transfer_time']=date('H:i:s');
			$data['is_transfer']=1;
			$i=1;
			foreach ($pin as $key => $value)
			{
				if($i>$data['transfer_quantity']){ break; }
				$this->dbm->pinTransfer($data,$value['pin']);
				$this->dbm->globalUpdate('pin',['pin'=>$value['pin']],$data);
				$i++;
			}
			$this->setMessage('1','PIN Transfered Successfully.');
		}else
		{
			$this->setMessage('0','Some Problem Occured!, Try Again!.');
		}
		return redirect('user/explore/transfer-pin');
	}

	public function universalLiveChart($param1='',$param2='')
	{
		$str=base64_decode($param1);
		$usr=$this->logged['user_id'];
		$data['plan']=$this->dbm->getWhere('plans',['id'=>$str]);
		$data['list']=$this->dbm->globalSelect('plan_list',['plan_id'=>$str]);
		//echo "<pre>"; print_r($data); die;
		$this->load->view('user/universal-live-chart',$data);
	}
	
	public function authenticate($param1='',$param2='')
	{
		if($param1!='')
		{
			$otp=rand(100000,999999);
			$_SESSION['otp']=$otp;
			$_SESSION['page']=$param1;
			$mobile=$this->logged['mobile'];
			$msg="Kindly use your One Time Password-OTP ".$otp." Send from ".$this->siteInfo['website'];
			$this->dbm->sendSms($mobile,$msg);
			$_SESSION['otp_start'] = time();
			redirect('user/explore/send-otp');
		}else
		{
			$this->setMessage('0','Direct Access Not Allowed.');
		   	return redirect('user');
		}
	}

	public function validateOtp($param1='',$param2='')
	{
		if($_SESSION['otp_start']!='')
		{
			if(isset($_SESSION['otp_start']))
			{
			    $secondsInactive = time() - $_SESSION['otp_start'];
			    $expireAfterSeconds = 300;
			    if($secondsInactive >= $expireAfterSeconds)
			    {
			        unset($_SESSION['otp']);
			        unset($_SESSION['otp_start']);
			        $this->setMessage('0','Times up !, Try Again!.');
			        return redirect('user/explore/send-otp');
			    }
			}
			if($_POST['otp']==$_SESSION['otp'])
			{
				$_SESSION['isValid']=1;
				redirect('user/authorisedOpen');
			}else
			{
				$this->setMessage('0','You have entered a wrong OTP !, Try Again!.');
				$this->load->view('user/send-otp');
			}
		}
		else
		{
			$this->setMessage('0','Direct Access Not Allowed.');
		   	return redirect('user');
		}
	}

	public function authorisedOpen($param1='',$param2='')
	{
		if($_SESSION['isValid']!='')
		{
			unset($_SESSION['isValid']);
			unset($_SESSION['otp']);
			$this->load->view('user/'.base64_decode($_SESSION['page']));
			unset($_SESSION['page']);
		}else
		{
			$this->setMessage('0','Direct Access Not Allowed.');
		   	return redirect('user');
		}
	}

	public function currentDown($value='')
	{
		$team=0; $sta=0; $pre=0; $j=0; $k=1; $pre=2; $max=0; $jump=4;$mul=4; $cur=0;
		$india=$this->dbm->globalSelect('level',['type'=>'india']);
		$myDown=$this->dbm->rowCount('users',['id<'=>$this->logged['id'],'status'=>1]);
		$pos=$myDown+1;
		$myDir=$this->dbm->rowCount('users',['sponcer_id'=>$this->logged['user_id'],'status'=>1,'access'=>'limited']);
		$all=$this->dbm->rowCount('users',['status'=>1,'access'=>'limited']);
		$netUser=$all-1;           
      	foreach ($india as $key => $value)
      	{
        	$check=$this->dbm->getWhere('india_income',['user_id'=>$this->logged['user_id'],'level'=>$value['level']]);
          	$max=$max+$value['team'];
            $j=$j+$value['team'];
            $max=$j;
          	if($check)
          	{
            	$cur=$value['team'];
          	}
          	else
          	{
            	for($h=1; $h<=$all; $h++)
            	{
              		if($h==$pos)
              		{
                		if(($max-$value['team'])<$netUser)
                		{
                  			$cur=$netUser;
		                }
              		}
              		$max=$max+$jump;
              		$k=$k+$pre;
            	}
          	} 
          	$max=$value['team'];
            $k=$j+1;
            $pre=$pre*$mul;
            $jump=$jump*$mul;
         	$pre=$value['team'];
      	}
      	echo $cur;
	}

	public function currentSelfDown($value='')
	{
		$res=$this->dbm->totalTeamCountReparches();
		echo $res;
	}



	public function payOrder($value='')
	{
	  $data=$_POST;
	  
	  // print_r($data); die();

		if ($data['pay_by']=='paytm') {
			$this->session->set_userdata('paytmdata',$data);
			return redirect('welcome/PaytmGateway/');

		}
		elseif ($data['pay_by']=='atom') {
			$this->session->set_userdata('atomdata',$data);
			return redirect('atom/AtomGateway/');

		}
		elseif ($data['pay_by']=='payumoney') {	
		
		$data['pay_online'] = 10;
		$data['pay_by_cash'] = 0;
		$data['skip_payableamt'] = 0;	
		$this->session->set_userdata('payudata',$data);
		 include_once APPPATH.'vendor/autoload.php';
		 
			$payumoney = new PayUMoney([
			     'merchantId' => 'ZMWPcS7z',
			    'secretKey'  => '6BFKBf1Hbl',
			    'testMode'   => false
			]);

			$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);		
			$this->session->set_userdata('txnid',$txnid);

			$params = [
			    'txnid'       => $txnid,
			     'amount'      => $this->cart->total(),
			    // 'amount'      => 1,
			    'productinfo' => 'Arastu Healthcare',
			    'firstname'   => $this->logged['name'],
			    'email'       => $this->logged['email'],
			    'phone'       => $this->logged['mobile'],
			    'surl'        => base_url().'user/afterpayu/',
			    'furl'        => base_url().'user/explore/products-payment',
			];
			// Redirects to PayUMoney
			$payumoney->initializePurchase($params)->send();

		}
		elseif($data['pay_by']=='cod') {
					$data['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

					// echo "<pre>";print_r($data); die();
					$this->productBookingPanding($data);
				}

	}




	public function afterpayu($value='')
	{
		$data = $this->session->userdata('payudata');
		$data['txnid'] = $this->session->userdata('txnid');
		unset($_SESSION['payudata']);
		unset($_SESSION['txnid']);
		$this->productBooking($data);
	}

	public function afterpaytm($value='')
	{
		$paramList = $_POST;
		 if ($paramList['STATUS']=='TXN_SUCCESS') {
			$data = $this->session->userdata('paytmdata');
			$data['txnid'] = $this->session->userdata('txnid');
			unset($_SESSION['paytmdata']);
			unset($_SESSION['txnid']);
			$this->productBooking($data); 	
		 }else{
		 	$msg = 'Payment is Failed..! Try Again..';
				$this->setMessage('0',$msg);				
				return redirect('user/explore/products-payment');
		 }
	}

	public function afteratom($value='')
	{
		$data = $this->session->userdata('atomdata');
		$data['txnid'] = $this->session->userdata('txnid');
		unset($_SESSION['atomdata']);
		unset($_SESSION['txnid']);
		$this->productBooking($data);
	}


	public function productBooking($data='')
	{
		
		foreach ($this->cart->contents() as $key => $chkqty) {
			$itemChkQty =$this->dbm->getWhere('product',['id'=>$chkqty['id']]);

			if ($chkqty['qty']>$itemChkQty['qty']) {
				$msg = $itemChkQty['name'].' is never to more then '.$itemChkQty['qty'];
				$this->setMessage('0',$msg);				
				return redirect('user/explore/products-payment');
			}
		}

		$data['user_id'] = $this->logged['user_id'];
		$data['total_price'] = $this->cart->total();
		$data['date']=date('Y-m-d');
		$data['time']=date('H:i:s');
		$data['delivery_status']=0;
		$data['status']=0;		
		$totalcv = 0;
		$totaldp = 0;

		$booking_id = $this->dbm->globalInsert('booking',$data);		
			if (isset($booking_id)) {		
				foreach ($this->cart->contents() as $items) {
					$itemDetails =$this->dbm->getWhere('product',['id'=>$items['id']]);

					$bookingItems['booking_id'] = $booking_id;
					$bookingItems['product_id'] = $items['id'];
					$bookingItems['mrp'] = $itemDetails['mrp'];
					$bookingItems['qty'] = $items['qty'];
					$bookingItems['cv'] = $items['cv'];
					$bookingItems['dp'] = $items['dp'];
					$bookingItems['total_cv'] = $items['cv']*$items['qty'];
					$bookingItems['total_dp'] = $items['dp']*$items['qty'];

					$bookingItems['totalamount'] = $items['subtotal'];
					$bookingItems['date']=date('Y-m-d');
					$bookingItems['time']=date('H:i:s');
					$bookingItems['status']=0;

					$this->dbm->globalInsert('booking_details',$bookingItems);
					$totalcv = $totalcv + $bookingItems['total_cv'];
					$totaldp = $totaldp + $bookingItems['total_dp'];
					$resltItm = intval($itemDetails['qty']) - $items['qty'];

					$this->dbm->globalUpdate('product',['id'=>$items['id']],['qty'=>$resltItm]);
				}
				
				$repurchasedata['user_id'] = $this->logged['user_id'];
				$repurchasedata['booking_id'] = $booking_id;
				$repurchasedata['totalcv'] = $totalcv;

				$this->repurchase_model->repurchaseCommission($repurchasedata);

				$this->dbm->globalUpdate('booking',['id'=>$booking_id],['total_cv'=>$totalcv,'total_dp'=>$totaldp]);
				$this->cart->destroy();

				return redirect('user/bookingSlip/'.$booking_id);

			}
	}


	public function productBookingPanding($data='')
	{
		// echo "<pre>"; print_r($data); die();
		// $data = $_POST;

		foreach ($this->cart->contents() as $key => $chkqty) {
			$itemChkQty =$this->dbm->getWhere('product',['id'=>$chkqty['id']]);

			if ($chkqty['qty']>$itemChkQty['qty']) {
				$msg = $itemChkQty['name'].' is never to more then '.$itemChkQty['qty'];
				$this->setMessage('0',$msg);				
				return redirect('user/explore/products-payment');
			}
		}

		// die();

		$data['user_id'] = $this->logged['user_id'];
		$data['total_price'] = $this->cart->total();
		$data['date']=date('Y-m-d');
		$data['time']=date('H:i:s');
		$data['delivery_status']=0;
		$data['status']=0;
		
		$totalcv = 0;
		$totaldp = 0;

		$booking_id = $this->dbm->globalInsert('booking_panding',$data);
		
			if (isset($booking_id)) {		
				foreach ($this->cart->contents() as $items) {
					$itemDetails =$this->dbm->getWhere('product',['id'=>$items['id']]);

					$bookingItems['booking_id'] = $booking_id;
					$bookingItems['product_id'] = $items['id'];
					$bookingItems['mrp'] = $itemDetails['mrp'];
					$bookingItems['qty'] = $items['qty'];
					$bookingItems['cv'] = $items['cv'];
					$bookingItems['dp'] = $items['dp'];
					$bookingItems['total_cv'] = $items['cv']*$items['qty'];
					$bookingItems['total_dp'] = $items['dp']*$items['qty'];

					$bookingItems['totalamount'] = $items['subtotal'];
					$bookingItems['date']=date('Y-m-d');
					$bookingItems['time']=date('H:i:s');
					$bookingItems['status']=0;

					$this->dbm->globalInsert('booking_details_panding',$bookingItems);
					$totalcv = $totalcv + $bookingItems['total_cv'];
					$totaldp = $totaldp + $bookingItems['total_dp'];
					$resltItm = intval($itemDetails['qty']) - $items['qty'];

					$this->dbm->globalUpdate('product',['id'=>$items['id']],['qty'=>$resltItm]);
				}
				
				// $repurchasedata['user_id'] = $this->logged['user_id'];
				// $repurchasedata['booking_id'] = $booking_id;
				// $repurchasedata['totalcv'] = $totalcv;
				// $this->repurchase_model->repurchaseCommission($repurchasedata);

				$this->dbm->globalUpdate('booking_panding',['id'=>$booking_id],['total_cv'=>$totalcv,'total_dp'=>$totaldp]);
				$this->cart->destroy();
				$this->setMessage('0','Your Booking is now in panding its will confurmd soon');
				return redirect('user/pandingBookingSlip/'.$booking_id);

			}
	}
	
	public function pandingBookingSlip($bookingId='')
	{
	   
		$bookres = $this->dbm->getWhere('booking_panding',['id'=>$bookingId,'user_id'=>$this->logged['user_id']]);
	   // echo"<pre>"; print_r($bookres);exit;
		if (!empty($bookres)) {
		$res['bookingreslt'] = $bookres;
		$res['userdtl'] = $this->dbm->getWhere('users',['user_id'=>$bookres['user_id']]);
		$res['bookingDtl'] = $this->dbm->globalSelect('booking_details_panding',['booking_id'=>$bookres['id']]);	
		$this->load->view('user/print-panding-booking',$res);
		}else{
			return redirect('user');
		}
	}

	public function bookingSlip($bookingId='')
	{
		$bookres = $this->dbm->getWhere('booking',['id'=>$bookingId,'user_id'=>$this->logged['user_id']]);
		if (!empty($bookres)) {
		$res['bookingreslt'] = $bookres;
		$res['userdtl'] = $this->dbm->getWhere('users',['user_id'=>$bookres['user_id']]);
		$res['bookingDtl'] = $this->dbm->globalSelect('booking_details',['booking_id'=>$bookres['id']]);
		
		// echo "<pre>";print_r($res); die();
		$this->load->view('user/print-booking',$res);
		}else{
			return redirect('user');
		}
	}
	public function bookingSlipgstbill($bookingId='')
	{
		$bookres = $this->dbm->getWhere('booking',['id'=>$bookingId,'user_id'=>$this->logged['user_id']]);
		if (!empty($bookres)) {
		$res['bookingreslt'] = $bookres;
		$res['userdtl'] = $this->dbm->getWhere('users',['user_id'=>$bookres['user_id']]);
		$res['bookingDtl'] = $this->dbm->globalSelect('booking_details',['booking_id'=>$bookres['id']]);
		
		// echo "<pre>";print_r($res); die();
		$this->load->view('user/print-gst-booking',$res);
		}else{
			return redirect('user');
		}
	}
	public function bookingHistory($value='')
	{
		$res['bookings'] = $this->dbm->globalSelectRev('booking',['user_id'=>$this->logged['user_id']]);		
		$this->load->view('user/booking-history',$res);
	}
	public function pandingBookings($value='')
	{
		$res['bookings'] = $this->dbm->globalSelectRev('booking_panding',['user_id'=>$this->logged['user_id']]);		
		$this->load->view('user/booking-history',$res);
	}
	
	public function countDownBusiness()
	{
		
		$grandeLeftAMT=0; $extraLeft=0; $extraRight=0; $leftAmt=0; $rightAmt=0; $pairAmt = 0; $grandeLeft = 0; $granderight= 0; $currentPairMach = 0; $grandeLeftAMT = 0; $granderightAMT =0; $previousLeft =0;  $previousRightAmt = 0; $updateRUsAmt=0;  $updateLUsAmt=0; $updateRRsAmt=0; $updateLRsAmt=0; $ReAmt=0;
        $right=[]; $left=[]; $down=[];
        unset($_SESSION['dList']);
        $_SESSION['dList']=[];
        $id=$this->logged['user_id'];
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
        // $arr['down']=$down;
        $arr['left']=$left;
        $arr['right']=$right;    
        foreach ($arr['left'] as $key => $val)
        {
            $prp=$this->db->select('user_id,sum(cv) as total')->get_where('users',['user_id'=>$val])->row_array();
            $leftData  = $prp['total'];
            $leftAmt  = $leftAmt+$leftData;
            
        }
        $grandeLeftAMT  = $leftAmt;
        foreach ($arr['right'] as $key => $value)
        {
           $prp=$this->db->select('user_id,sum(cv) as total')->get_where('users',['user_id'=>$value])->row_array();
           
               $rightData = $prp['total'];  
               $rightAmt = $rightAmt+$rightData;
        }
         $granderightAMT= $rightAmt;
            
		$arr['rbv']=$granderightAMT;
		$arr['lbv']=$grandeLeftAMT;
		return $arr;
	}
	public function selfUpgrade($param1='',$param2='')
	{
		$data=$_POST;
		$data['date']=date('Y-m-d');
		$data['time']=date('H:i:s');  
		$data['user_id']=$this->logged['user_id'];
		$data['old_pakg']=$this->logged['product'];
		$data['pendng']=0;
		$plan=$this->dbm->getWhere('base_plan',['id'=>(int) $data['plan_id']]);
		$data['type']=$plan['type'];
		$a=$_FILES['image']['name'];
		if($a)
		{
			$config = array(
					'upload_path' => "./uploads",
					'allowed_types' => "jpg|png|jpeg",
				);
			$this->load->library('upload',$config);
			$this->upload->do_upload('image');
			$img=$this->upload->data();
			$data['image']=$img['file_name'];
		}
		else
		{
			$data['image']='red.png';
		}
// 		print_r($data); die;
		 $res=$this->dbm->globalInsert('self_upgrade',$data);
		 if($res)
		 {
			$this->setMessage('1','Plan Upgraded Successfully.');
		 }else
		 {
			$this->setMessage('0','Plan Upgradation Failed.');
		 }
		return redirect('user/getAllData/'.base64_encode('base_plan/type/self/upgrate-self'));
	}
	



}
