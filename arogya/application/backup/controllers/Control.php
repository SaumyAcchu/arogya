<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends MY_Controller {

	public function __construct()
	{
		parent:: __construct();
		$logged=$this->session->userdata('loggedUser');
		if($logged['access_level']!='universal')
		{ return redirect('user'); }
		$this->load->model('db_model');
		$this->load->model('Commission_model');
	}

	public function index()
	{
		$result['notice']=$this->db_model->globalSelect('notice');
		$row=$this->db_model->getWhere('direct_reward',['id'=>3]);
		$date1=date_create('2017-08-01');
		$date2=date_create(date('Y-m-d'));
		$diff=date_diff($date1,$date2);
		$days=$diff->format("%a days");
		$totalslot=floor($days/$row['days']);
		$dateFrom='2017-08-01';
		date_add($date1,date_interval_create_from_date_string("+ ".($row['days']-1)." Days"));
		$dateTo= date_format($date1,"Y-m-d");
		$count=0;
		for ($i=1; $i <=$totalslot ; $i++)
		{ 
			//echo $dateFrom." To ".$dateTo."<br>";
			$date1=date_create($dateTo);
			date_add($date1,date_interval_create_from_date_string("1 Day"));
			$dateFrom= date_format($date1,"Y-m-d");
			date_add($date1,date_interval_create_from_date_string("+ ".($row['days']-1)." Days"));
			$dateTo= date_format($date1,"Y-m-d");
		}
		//echo $dateFrom." To ".$dateTo."<br>";
		$result['time_slot']=['dateFrom'=>$dateFrom,'dateTo'=>$dateTo,'status'=>1];
		$res=$this->db_model->globalSelect('users',['status'=>1]);
		foreach ($res as $key => $value)
		{
			$data[$value['user_id']][]=$this->db_model->rowCount('users',['reg_date>='=>$dateFrom,'reg_date<='=>$dateTo,'status'=>1,'sponcer_id'=>$value['user_id']]);
		}
		arsort($data);
		$result['top']=array_slice($data,0,7);
		$result['selfTeam']=$this->Commission_model->selfTeamBusiness();
		//echo '<pre>'; print_r($this->siteInfo['start_from']); die;
		$this->load->view('admin/admin-dashboard',$result);
	}
	
	public function explore($page='')
	{
		$this->load->view('admin/'.$page);
	}
	
	public function exploreData($table='',$page='')
	{
		$result['data']=$this->db_model->globalSelect($table);
		$this->load->view('admin/'.$page,$result);
	}

	public function getData($table='',$id='',$page='')
	{
		$result['get_data']=$this->db_model->getWhere($table,['id'=>$id]);
		$this->load->view('admin/'.$page,$result);
	}

	public function updateData($table='',$id='',$page='')
	{
		$data=$_POST;
		$result=$this->db_model->globalUpdate($table,['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Updating Failed ! Try Again');
		}
		return redirect('control/exploreData/'.$table.'/'.$page);	
	}

	public function insertData($table='',$page='')
	{
		$data=$_POST;
		$result=$this->db_model->globalInsert($table,$data);
		if($result)
		{
			$this->setMessage('1','Data Inserted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Inserting Failed ! Try Again');
		}
		return redirect('control/exploreData/'.$table.'/'.$page);	
	}

	public function deleteData($table='',$id='',$page='')
	{
		$result=$this->db_model->globalDelete($table,['id'=>$id]);
		if($result)
		{
			$this->setMessage('1','Data Deleted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data not Deleted ! Try Again');
		}
		return redirect('control/exploreData/'.$table.'/'.$page);	
	}

	public function getAllData($str='',$other='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$tblField=$arr[1];  //DB Table field
		$matcher=$arr[2];  //Matching Value
		$page=$arr[3];  //Landing Page
		$result['data']=$this->db_model->globalSelect($table,[$tblField=>$matcher]);
		$this->load->view('admin/'.$page,$result);
	}

	public function insertDataWithFile($table='',$page='',$param3='')
	{
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
		//echo '<pre>'; print_r($myres); exit;
		$result=$this->db_model->globalInsert($table,$data);
		if($result)
		{
			$this->setMessage('1','Data Inserted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Inserting Failed ! Try Again');
		}
		return redirect('control/exploreData/'.$table.'/'.$page);
	}

	public function updateDataWithFile($table='',$id='',$page='')
	{
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
		//echo '<pre>'; print_r($data); exit;
		$result=$this->db_model->globalUpdate($table,['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Updating Failed ! Try Again');
		}
		return redirect('control/exploreData/'.$table.'/'.$page);
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

	public function getSponcer($param1='')
	{
		$user_id=$_POST['id'];
		$res=$this->db_model->getWhere('users',['user_id'=>$user_id]);
		if($res)
		{
			echo $res['name'];
		}else
		{
			echo 0;
		}
	}

	public function countSponcer($param1='')
	{
		$user_id=$_POST['id'];
		$res=$this->db_model->getWhere('users',['user_id'=>$user_id]);
		if($res)
		{
			$row=$this->db_model->rowCount('users',['sponcer_id'=>$user_id]);
			if($row>10000)
			{
				$data['msg']="This Sponcer ID Already Used for 2 Associates.";
				$data['status']=0;
			}else
			{
				if($row>0)
				{
					$data['place']="<option value='Right'>Right</option>";
					$data['status']=1;
					$data['name']=$res['name'];
				}else
				{
					$data['place']="<option value='Left'>Left</option>";
					$data['status']=1;
					$data['name']=$res['name'];
				}
			}
		}else
		{
			$data['msg']="This Sponcer ID does'nt Exist.";
			$data['status']=0;
		}
		echo json_encode($data);
	}



	//=============================//==========================================//




	public function pinGenerate($param1='',$param2='')
	{
		$letter=str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNM');
		$str=substr($letter,0,3);
		$digit=time();
		$digit=$digit+rand(1000,9999);
		$final=$str.$digit;
		$row=$this->db_model->rowCount('pin',['pin'=>$final]);
		if($row>0)
		{
			$this->getPin();
		}else
		{
			return $final;
		}
	}

	public function checkPin($param1='',$param2='')
	{
		$pin=$_POST['pin'];
		$res=$this->db_model->rowCount('pin',['pin'=>$pin]);
		if($res>0)
		{
			echo 1;
		}else
		{
			echo 0;
		}
	}

	public function sendPin($param1='',$param2='')
	{
		$data=$_POST;
		$id=$data['req_id'];
		$data['gen_date']=date('Y-m-d');
		$data['gen_time']=date('h:i:s A');
		$data['status']=0;
		$data['generate_by']='admin';
		for($i=1;$i<=$data['quantity'];$i++)
		{
			$data['pin']=$this->pinGenerate();
			$this->db_model->globalInsert('pin',$data);
		}
		//echo '<pre>'; print_r($data); exit;
		unset($data['req_id']);
		unset($data['generate_by']);
		$data['status']=1;
		$result=$this->db_model->globalUpdate('pin_request',['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','PIN Sent Successfully.');
		}
		else
		{
			$this->setMessage('0','PIN sending Failed ! Try Again');
		}
		return redirect('control/exploreData/pin_request/pin-management');
	}

	public function sendPinDirectUser($param1='',$param2='')
	{
		$data=$_POST;
		$data['gen_date']=date('Y-m-d');
		$data['gen_time']=date('h:i:s A');
		$data['status']=0;
		$data['generate_by']='admin';
		//print_r($data); exit;
		for($i=1;$i<=$data['quantity'];$i++)
		{
			$data['pin']=$this->pinGenerate();
			$result=$this->db_model->globalInsert('pin',$data);
		}
		if($result)
		{
			$this->setMessage('1','PIN Sent Successfully.');
		}
		else
		{
			$this->setMessage('0','PIN sending Failed ! Try Again');
		}
		return redirect('control/exploreData/pin_request/pin-management');
	}

	public function quickReply($param1='',$param2='')
	{
		if($param1=='get')
		{
			$res['data']=$this->db_model->globalSelect('query',['sender!='=>'Admin']);
			//echo '<pre>'; print_r($res); exit();
			$this->load->view('admin/user-query',$res);
		}else
		{
			$data=$_POST;
			$result=$this->db_model->globalInsert('query',$data);
			if($result)
			{
				$this->setMessage('1','Replied Successfully.');
			}
			else
			{
				$this->setMessage('0','Replying Failed ! Try Again');
			}
			return redirect('control/quickReply/get');
		}
	}

	public function queryDelete($table='',$id='',$page='')
	{
		$this->db_model->globalDelete($table,['query_id'=>$id]);
		$result=$this->db_model->globalDelete($table,['id'=>$id]);
		if($result)
		{
			$this->setMessage('1','Mesage Deleted Successfully.');
		}
		else
		{
			$this->setMessage('0','Message not Deleted ! Try Again');
		}
		return redirect('control/quickReply/get');	
	}

	public function getDataAjax($str='',$id='',$page='')
	{
		$result=$this->db_model->getWhere($_POST['table'],['user_id'=>$_POST['user_id']]);
		echo json_encode($result);
	}

	public function withdrawPayment($param1='',$param2='')
	{
		$data=$_POST;
		$data['status']=1;
		$data['paid_date']=date('Y-m-d');
		$data['paid_time']=date('h:i:s A');
		$trncId=$this->db_model->transactionNumber();
		$comm['data']='W'.$trncId;
		$data['transaction']=$comm['data'];
		$res=$this->db_model->globalUpdate('withdraw',['id'=>$data['id']],$data);
		if($res)
		{
			$row=$this->db_model->getWhere('users',['user_id'=>$data['user_id']]);
			$amt=$row['wallet']-$data['amount'];
			$this->db_model->globalUpdate('users',['user_id'=>$data['user_id']],['wallet'=>$amt]);
			$this->setMessage('1','Paid Successfully.');
		}
		else
		{
			$this->setMessage('0','Action Failed ! Try Again');
		}
		return redirect('control/exploreData/withdraw/withdraw-request');
	}

	public function payoutReport($param1='',$param2='')
	{
		$data=$_POST;
		$result['date']= array('from'=>$data['dateFrom'],'to'=>$data['dateTo']);
		$dateFrom=$data['dateFrom'];
		$dateTo=$data['dateTo'];
		$dateFrom1=new DateTime($dateFrom);
		$new_dateFrom=$dateFrom1->format('Y-m-d');
		$dateTo1=new DateTime($dateTo);
		$new_dateTo=$dateTo1->format('Y-m-d');
		$condition= array('date>='=>$new_dateFrom,'date<='=>$new_dateTo);
		$condition1= array('paid_date>='=>$new_dateFrom,'paid_date<='=>$new_dateTo,'status'=>1);
		$result['commission']=$this->db_model->globalSelect('commission',$condition);
		$result['mega_bonus']=$this->db_model->globalSelect('mega_bonus_redeem',$condition);
		$result['withdraw']=$this->db_model->globalSelect('withdraw',$condition1);
		$result['direct_bonus']=$this->db_model->globalSelect('bonus_redeem',$condition);
		$this->load->view('admin/payout-report',$result);
		//echo '<pre>'; print_r($result); exit;
	}

	public function deletePin($param1='',$param2='')
	{
		$result=$this->db_model->globalDelete('pin',['id'=>$param1]);
		if($result)
		{
			$this->db_model->globalUpdate('users',['pin'=>$param2],['pin'=>'','status'=>'']);
			$this->db_model->globalUpdate('pin_request',['pin'=>$param2],['pin'=>'','status'=>'']);
			$this->setMessage('1','PIN Deleted Successfully.');
		}
		else
		{
			$this->setMessage('0','PIN not Deleted ! Try Again');
		}
		return redirect('control/exploreData/pin_request/pin-management');
	}

	public function updateTenPlusDays($param1='',$param2='')
	{
		$data=$_POST;
		$result=$this->db_model->globalUpdate('direct_reward',['type'=>'ten_plus'],$data);
		if($result)
		{
			$this->setMessage('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Updating Failed ! Try Again');
		}
		return redirect('control/exploreData/direct_reward/direct-reward');

	}

	public function topDirects($param1='',$param2='')
	{
		$row=$this->db_model->getWhere('direct_reward',['id'=>3]);
		$result['tenPlus']=$this->db_model->globalSelect('direct_reward',['type'=>'ten_plus']);
		$date1=date_create('2017-08-01');
		$date2=date_create(date('Y-m-d'));
		$diff=date_diff($date1,$date2);
		$days=$diff->format("%a days");
		$totalslot=floor($days/$row['days']);
		$dateFrom='2017-08-01';
		date_add($date1,date_interval_create_from_date_string("+ ".($row['days']-1)." Days"));
		$dateTo= date_format($date1,"Y-m-d");
		$count=0;
		for ($i=1; $i <=$totalslot ; $i++)
		{ 
			//echo $dateFrom." To ".$dateTo."<br>";
			$date1=date_create($dateTo);
			date_add($date1,date_interval_create_from_date_string("1 Day"));
			$dateFrom= date_format($date1,"Y-m-d");
			date_add($date1,date_interval_create_from_date_string("+ ".($row['days']-1)." Days"));
			$dateTo= date_format($date1,"Y-m-d");
		}
		//echo $dateFrom." To ".$dateTo."<br>";
		$result['time_slot']=['dateFrom'=>$dateFrom,'dateTo'=>$dateTo,'status'=>1];
		$res=$this->db_model->globalSelect('users',['status'=>1]);
		foreach ($res as $key => $value)
		{
			$data[$value['user_id']]=$this->db_model->globalSelect('users',['reg_date>='=>$dateFrom,'reg_date<='=>$dateTo,'status'=>1,'sponcer_id'=>$value['user_id']]);
		}
		arsort($data);
		$result['top']=array_slice($data,0,7);
		//echo '<pre>'; print_r($result); die;
		$this->load->view('admin/top-directs',$result);
	}

	public function topDirectsAdd($param1='',$param2='')
	{
		$ids=$_POST['user_id'];
		//echo '<pre>';
		foreach ($ids as $key => $value)
		{
			$wallet=$this->db_model->getWhere('users',['user_id'=>$value]);
			$amt=$wallet['wallet']+$_POST['amount'][$key];
			$data['user_id']=$value;
			$data['rank']=$_POST['rank'][$key];
			$data['date_from']=$_POST['date_from'][$key];
			$data['date_to']=$_POST['date_to'][$key];
			$data['amount']=$_POST['amount'][$key];
			$data['directs']=$_POST['directs'][$key];
			$data['date']=$_POST['date'][$key];
			$data['type']=$_POST['type'][$key];
			$data['status']=1;
			$trncId=$this->db_model->transactionNumber();
			$data['transaction']='B'.$trncId;
			$this->db_model->globalUpdate('users',['user_id'=>$value],['wallet'=>$amt]);
			$res=$this->db_model->globalInsert('bonus_redeem',$data);
		}
		if($res)
		{
			$this->setMessage('1','Bonus Distrubuted Successfully.');
		}
		else
		{
			$this->setMessage('0','Bonus Distrubuting Failed ! Try Again');
		}
		return redirect('control/topDirects');
	}

	public function timeSlot($param1='',$param2='')
	{
		if($param1=='selfBusiness')
		{
			$data=$_POST;
			$max=$this->db_model->getMaxId('time_slot',['type'=>'self_business','status'=>'prev']);
			if($max)
			{
				$max['date_to']=$max['date_to'];
			}else
			{
				$max['date_to']=$this->siteInfo['start_from'];
			}
			//print_r($max['date_to']); exit;
			if($data['date_from']<$max['date_to'])
			{
					$this->setMessage('0','Start Date Must be Greater than Previous Closed date ( '.$max['date_to'].' ) ! Try Again');
					return redirect('control/exploreData/reward/self-team-reward-management');
			}
			$data['status']='current';
			$data['type']='self_business';
			$data['date']=date('Y-m-d');
			$date1=date_create($data['date_from']);
			$date2=date_create($data['date_to']);
			$diff=date_diff($date1,$date2);
			$days=$diff->format("%a days");
			$data['days']=$days+1;
			$next=$data;
			$next['status']='next';
			date_add($date2,date_interval_create_from_date_string("1 Day"));
			$next['date_from']= date_format($date2,"Y-m-d");
			date_add($date2,date_interval_create_from_date_string($days." Days"));
			$next['date_to']= date_format($date2,"Y-m-d");
			$res=$this->db_model->globalUpdate('time_slot',['type'=>'self_business','status'=>'current'] ,$data);
			//echo '<pre>'; print_r($max); 
			if($res)
			{
				$this->db_model->globalUpdate('time_slot',['type'=>'self_business','status'=>'next'],$next);
				$this->setMessage('1','Date Updated Successfully.');
			}
			else
			{
				$this->setMessage('0','Updating Failed ! Try Again');
			}
			return redirect('control/exploreData/reward/self-team-reward-management');
		}
	}

	public function topSelfBusiness($param1='',$param2='')
	{
		$ids=$_POST['user_id'];
		//echo '<pre>'; print_r($_POST); exit;
		$i=5;
		foreach ($ids as $key => $value)
		{
			$data['user_id']=$value;
			$data['rank']=$i;
			$data['date_from']=$_POST['date_from'][$key];
			$data['date_to']=$_POST['date_to'][$key];
			$data['amount']=$_POST['amount'][$key];
			$data['date']=date('Y-m-d');
			$data['type']='self_business';
			$data['status']=1;
			$data['business']=$_POST['business'][$key];
			$data['target']=$_POST['target'][$key];
			$i--;
			$trncId=$this->db_model->transactionNumber();
			$data['transaction']='S'.$trncId;

			$user=$this->db->get_where('users',['user_id'=>$value])->row_array();
				if($user['pan']=='')
				{
					$tds=10;
				}else
				{
					$tds=5;
				}
				$deduction['tds']=($data['amount']*$tds)/100;
				$deduction['admin']=($data['amount']*10)/100;
				$deduction['user_id']=$user['user_id'];
				$deduction['date']=date('Y-m-d');
				$deduction['time']=date('h:i:s A');
				$deduction['amount']=$data['amount'];
				$deduction['type']='self_business';
				$deduction['admin_percent']=10;
				$deduction['tds_percent']=$tds;
				$deduction['transaction']=$data['transaction'];
				$data['amount']=(($data['amount'])-($deduction['admin']+$deduction['tds']));

			$wall=$user['wallet'];
			$amt=$wall+$data['amount'];
			//echo '<pre>'; print_r($data); exit;
			$this->db_model->globalInsert('tds',$deduction);

			$this->db_model->globalUpdate('users',['user_id'=>$value],['wallet'=>$amt]);
			$res=$this->db_model->globalInsert('bonus_redeem',$data);
			//echo '<pre>'; print_r($data);
		}
		if($res)
		{
			$get=$this->db_model->getWhere('time_slot',['type'=>'self_business','status'=>'next']);
			$data1['status']='current';
			$data1['type']='self_business';
			$data1['date']=date('Y-m-d');
			$date1=date_create($get['date_from']);
			$date2=date_create($get['date_to']);
			$diff=date_diff($date1,$date2);
			$days=$diff->format("%a days");
			$data1['days']=$days+1;
			$next=$data1;
			$next['status']='next';
			date_add($date2,date_interval_create_from_date_string("1 Day"));
			$next['date_from']= date_format($date2,"Y-m-d");
			date_add($date2,date_interval_create_from_date_string($days." Days"));
			$next['date_to']= date_format($date2,"Y-m-d");
			$this->db_model->globalUpdate('time_slot',['type'=>'self_business','status'=>'current'],['status'=>'prev']);
			$this->db_model->globalUpdate('time_slot',['type'=>'self_business','status'=>'next'],['status'=>'current']);
			$success=$this->db_model->globalInsert('time_slot',$next);
		}
		if($success)
		{
			$this->setMessage('1','Bonus Distrubuted Successfully.');
		}
		else
		{
			$this->setMessage('0','Bonus Distrubuting Failed ! Try Again');
		}
		return redirect('control/explore/self-team-reward-list');
	}

	public function userBlock($param1='',$param2='')
	{
		if($param2=='block')
		{
			$success=$this->db_model->globalUpdate('users',['user_id'=>$param1],['block'=>1]);
			if($success)
			{
				$this->setMessage('1','User Blocked Successfully.');
			}
			else
			{
				$this->setMessage('0','User not Blocked ! Try Again');
			}
			
		}
		if($param2=='unblock')
		{
			$success=$this->db_model->globalUpdate('users',['user_id'=>$param1],['block'=>0]);
			if($success)
			{
				$this->setMessage('1','User unblocked Successfully.');
			}
			else
			{
				$this->setMessage('0','User not Unblocked ! Try Again');
			}
		}
		return redirect('control/exploreData/users/user-management');
	}

	public function changeWallet($param1='')
	{
		$success=$this->db_model->globalUpdate('users',['user_id'=>$_POST['user_id']],$_POST);
		if($success)
		{
			$this->setMessage('1','User Wallet updated Successfully.');
		}
		else
		{
			$this->setMessage('0','User wallet not updated ! Try Again');
		}
		return redirect('control/exploreData/users/wallet-management');
	}
	public function userData($param1='',$param2='')
	{
		if(isset($_POST['user_id'])) { $id=$_POST['user_id']; }else{ $id=$param1; } 
		if($id){
		$data['user']=$this->db_model->getWhere('users',['user_id'=>$id]);
		if($data['user'])
		{
			$condition1=['user_id'=>$id];
			$conditionA=['user_id'=>$id,'is_credit'=>1,'group_name'=>'A'];
			$condition2=['user_id'=>$id,'is_credit'=>1];
			$data['self']=$this->db_model->selectSumglovel('commission_new',['agent_id'=>$id],'commission');
			$data['selfUp']=$this->db_model->selectSumglovel('commission_extra',['agent_id'=>$id/*,'is_credit'=>1*/],'commission');
			$data['directs']=$this->db_model->globalSelect('users',['sponcer_id'=>$id/*,'status'=>1*/]);
		}else
		{
			$data['user']=0;
		}
		$user=$this->db_model->getWhere('users',['user_id'=>$id]);
		$tree = ['user_id'=>$id];
		$tree2 = ['user_id'=>$id,'sponcer_id'=>$user['sponcer_id']];
		$data['treeman'] = $this->commission_model->mytree($tree);
		$this->load->view('admin/user-data',$data);
		}else{
			return redirect('control'); 
		}
	}
	
	public function quickLogin($param1='',$param2='')
	{
		// echo "<pre>";
			$logged=$this->session->userdata('loggedUser');  //print_r($logged);die();
		if(isset($_POST['user_id']) && $logged['access_level']=='universal') 
		{ $id=$_POST['user_id']; }else{ $id=$param1; } 
		
		if($id){
		$data['user']=$this->db_model->getWhere('users',['user_id'=>$id]);
		if($data['user'])
		{
			$condition=array('user_id'=>$id);
			$result=$this->db_model->selectRow('users',$condition);
			if(count($result)>0)
			{				 
				$result['logAs'] = $logged['user_id'];
				$this->session->set_userdata('loggedUser',$result);
				return redirect('real1');
			}else
			{
				$this->session->set_flashdata('msg','Username/Password is not Matched');
				$this->session->set_flashdata('msg_class','alert-danger');
				return redirect('login');
			}
		}
		else{
			return redirect('login'); 
		}		
		}else{
			return redirect('control'); 
		}
	}
}