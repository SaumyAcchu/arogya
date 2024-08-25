<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends My_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$logged=$this->session->userdata('loggedUser');
		if($logged['access']!='universal')
		{ return redirect('user'); }
		$this->load->model('dbm');
		$this->load->model('comm');
		$this->load->model('Royalty_model');
		$this->load->model('monthly');
		$this->load->model('commission_model');
		$this->load->model('statics');
	}
	public function kuki()
	{
	    
// 	    $result=$this->dbm->globalSelect('users',['access'=>"limited",'status'=>1]);
//      	foreach ($result as $key => $value) {
//      	$joker=$this->dbm->globalSelect('users',['sponcer_id'=>$value['user_id'],'status'=>1]);
//      	foreach ($joker as $key => $data) {
//      	$res=$this->dbm->getWhere('users',['user_id'=>$data['sponcer_id']]);
//      	if($data){
//      	$bonus = "180"; 
// 		$comm['user_id']=$data['user_id'];
// 		$comm['pin']="";
// 		$comm['sponcer_id']=$data['sponcer_id'];
// 		$comm['date']=date('Y-m-d');
// 		$comm['type']='DIRECT';
// 				$tds=5;
// 			$comm['beneficiary']=$data['sponcer_id'];
// 			$deduction['tds']=($bonus*5)/100;
// 			$deduction['admin']=($bonus*5)/100;
// 			$deduction['user_id']=$data['user_id'];
// 			$deduction['date']=date('Y-m-d');
// 			$deduction['time']=date('H:i:s');
// 			$deduction['amount']=$bonus;
// 			$deduction['type']='DIRECT';
// 			$deduction['admin_percent']=5;
// 			$deduction['tds_percent']=$tds;
			
// 			$left=($bonus-($deduction['admin']+$deduction['tds']));
		
// 		    	if($res['status']==1)
// 			{
// 				$wall=$left+$res['wallet'];
// 				$this->dbm->globalUpdate('users',['user_id'=>$res['user_id']],['wallet'=>$wall]);
// 				$comm['status']=1;
// 				$deduction['status']=1;
// 				$comm['is_credit']=1;
// 				$deduction['is_credit']=1;
// 			}else
// 			{
// 				$comm['status']=0;
// 				$deduction['status']=0;
// 				$comm['is_credit']=0;
// 				$deduction['is_credit']=0;
// 			}
		
		
// 		    $comm['total'] = $bonus;
// 		    $comm['tds'] = $deduction['tds'];
// 		    $comm['admin'] = $deduction['admin'];
// 			$comm['amount']=($bonus-($deduction['admin']+$deduction['tds']));
// 			$comm['time']=date('H:i:s');
// 			$deduction['amount']=($bonus-($deduction['admin']+$deduction['tds']));
// 			$trncId=$this->dbm->transactionNumber();
// 			$comm['transaction']='C'.$trncId;

// 			$deduction['transaction']=$comm['transaction'];
// 			$this->db->insert('tds',$deduction);
// 			$this->db->insert('direct_comm',$comm);
//      	    }
//      	 }
//       }
	}
	
		public function paylist($param1='',$param2='')
	{
		
		if($param1=='ref')
		{
		    $result['type']="Referral Income";
			$result['referral']=$this->dbm->globalSelect('direct_comm',['amount!='=>0]);
			$this->load->view('admin/manage-history',$result);
		}
			if($param1=='mat')
		{
		    $result['type']="Matching Income";
			$result['pairMatch']=$this->dbm->globalSelect('pairmaching',['paidAmt!='=>0]);
			$this->load->view('admin/manage-history',$result);
		}
		if($param1=='lob')
		{
		    $result['type']="LOB Income";
			$result['roi']=$this->dbm->globalSelect('club_income',['amount!='=>0]);
			$this->load->view('admin/manage-history',$result);
		}
	}
	
	public function checkactive()
	{
	    return redirect('stable/countDownActive');
	}
	public function getAll()
	{
	   $this->monthly->CheckClub();
	}
	public function GStatics()
	{
	   $this->statics->getAllClub();
	}
	
// 	..........................................
    
    public function amtClosing()
    {
         $this->comm->closeNow();
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
				$this->comm->binaryClosing();
				$this->commission_model->getAllClub();
				
				$this->setMessage('1','Account Activated Successfully.');
			}else
			{
				$this->setMessage('0','Account Not Activated, Try Again!.');
			}
		}
		return redirect('auth/getAllData/'.base64_encode('pin/generate_by/admin/pin-management'));
	}


	public function paymentHistory($str='',$other='')
	{
    
		$result['pairMatch']=$this->dbm->globalSelect('pairmaching',['paidAmt!='=>0]);
// 		$result['pairMatch']=$this->dbm->globalSelect('tds',['type'=='PairMatch']);
		$result['referral']=$this->dbm->globalSelect('direct_comm',['status!='=>0]);
		$result['roi']=$this->dbm->globalSelect('club_income',['amount!='=>0]);
		$result['month']=$this->dbm->globalSelect('monthly_income',['amount!='=>0]);
		$this->load->view('admin/payout-report',$result);
	}


public function statics($param1='',$param2='')
	{
		$str=base64_decode($param1);
// 		print_r($param2); die();
		$str=explode('/', $str);
		$type= $str[0];
		$status= $str[1];
		$data['title']= $str[2];
		$data['userID']=$param2;
		$id=$param2;
		if($type=='direct')
		{
			$data['direct']='Direct';
			$data['down']=$this->dbm->globalSelect('users',['sponcer_id'=>$param2,'status'=>$status]);
		}
		if($type=='directAll')
		{
			$data['direct']='Direct';
			$data['down']=$this->dbm->globalSelect('users',['sponcer_id'=>$param2]);
		}
		if($type=='self')
		{
			$arr=[];
			$res=$this->comm->selfTeam($param2);
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
			$res=$this->comm->selfTeam($param2);
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
			$data['down']=$this->dbm->globalSelect('users',['id>'=>$param2]);
			$data['india']=$this->dbm->globalSelect('level',['type'=>'india']);
// 			echo "<pre>"; print_r($data['down']); die();
		}
		//echo "<pre>";  print_r($data); die;
		$this->load->view('user/statics',$data);
	}


// ......................................
	public function chechpo(){
	   $result=$this->dbm->selectLimit('users',['access'=>'limited']);
	   foreach ($result as $key => $val)
		{
		  $result=$this->dbm->globalUpdate('users',['place'=>"L"],['place'=>"Left"]);		    
		}
				
	}
	
	
	
	public function DateWiseData($param1='',$param2='')
	{
		$result['searchData']=$_POST;
		$data=$_POST;
		$to= $this->dbm->ymd($data['dateTo']);
		$from= $this->dbm->ymd($data['dateFrom']);
		$condition= array('reg_date>='=>$from,'reg_date<='=>$to);
		$result['data']=$this->dbm->globalSelect('users',$condition);
		//echo "<pre>"; print_r($result); die;
		$this->load->view('admin/user-management',$result);
	}

	public function userData($param1='',$param2='')
	{
		if(isset($_POST['user_id'])) { $id=$_POST['user_id']; }else{ $id=$param1; } 
		if($id)
		{
			$data['user']=$this->dbm->getWhere('users',['user_id'=>$id]);
			if($data['user'])
			{
				$condition1=['user_id'=>$id];
				$conditionA=['user_id'=>$id,'is_credit'=>1,'group_name'=>'A'];
				$condition2=['user_id'=>$id,'is_credit'=>1];
				$data['self_amt']=$this->dbm->selectSum('commission',['beneficiary'=>$id,'type'=>'bonus']);
				//$data['indiaA_amt']=$this->dbm->selectSum('all_india_bonus',$conditionA);
				// $data['indiaB_amt']=$this->dbm->selectSum('all_india_income',$condition2);
				//$data['royalty_amt']=$this->dbm->totalRoyalty($id);
				//$data['universal_amt']=$this->dbm->selectSum('club_commission',$condition1);
				//$data['leader_amt']=$this->dbm->selectSum('leader_income',$condition1);
				$data['total']=$this->dbm->totalEarn($id);
				$data['withdraw']=$this->dbm->selectSum('withdraw',['user_id'=>$id]);
				$data['directs']=$this->dbm->globalSelect('users',['sponcer_id'=>$id,'status'=>1]);
				$data['pinCount']=$this->dbm->rowCount('pin',['user_id'=>$id,'generate_by'=>'self']);

				$arr=[];
			$res=$this->comm->selfTeam($id);
			foreach ($res as $key => $value)
			{
				foreach ($value as $key => $val)
				{
					foreach ($val as $key => $val1) {
						$arr[]=$val1;
					}
				}
			}
			
    	 	$data['down1']=$arr;
    	 	$data['self']=$this->dbm->globalSelect('level',['type'=>'self']);


			}else
			{
				$data['user']=0;
			}
    	 	// echo "<pre>";print_r($data['down1']); die();
			$this->load->view('admin/user-data',$data);
		}else{
			return redirect('control'); 
		}
	}


	
	public function index()
	{
		$result['notice']=$this->dbm->globalSelect('notice');
		$result['recent']=$this->dbm->selectLimit('users',['access'=>'limited'],10);
		function getLastNDays($days, $format = 'Y-m-d')
		{
		    $m = date("m"); $de= date("d"); $y= date("Y");
		    $dateArray = array();
		    for($i=0; $i<=$days-1; $i++){
		        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
		    }
		    return array_reverse($dateArray);
		}
		$arr = getLastNDays(15);

		foreach ($arr as $key => $value)
		{
			$data[]=[
				'y'=>$value,
				'a'=>$this->dbm->rowCount('users',['active_date'=>$value,'status'=>1]),
				'b'=>$this->dbm->rowCount('users',['reg_date'=>$value])
			];
		}
		$result['data']=$data;
		//echo "<pre>"; print_r($result); die;
		$this->load->view('admin/admin-dashboard',$result);
	}

	public function explore($page='')
	{
		$this->load->view('admin/'.$page);
	}
	
	public function exploreData($table='',$page='')
	{

		$result['data']=$this->dbm->globalSelect($table);
		$result['workingPlan']=$this->dbm->globalSelect('working_plan');
		$this->load->view('admin/'.$page,$result);
	}
	public function exploreData1($page='')
	{

		$result['data']=$this->dbm->globalSelect('level');
		$result['workingPlan']=$this->dbm->globalSelect('working_plan');
		$this->load->view('admin/level-management',$result);
	}

	public function getData($table='',$id='',$page='')
	{
		$result['get_data']=$this->dbm->getWhere($table,['id'=>$id]);
		$this->load->view('admin/'.$page,$result);
	}

	public function updateData($table='',$id='',$page='')
	{
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
		return redirect('auth/exploreData/'.$table.'/'.$page);	
	}

	public function updateData1($table='',$id='',$page='')
	{
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
		return redirect('auth/exploreData1/'.$page);	
	}

	public function insertData($table='',$page='')
	{
		$data=$_POST;
		// print_r($data); die();
		$result=$this->dbm->globalInsert($table,$data);
		if($result)
		{
			$this->setMessage('1','Data Inserted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Inserting Failed ! Try Again');
		}
		return redirect('auth/exploreData/'.$table.'/'.$page);	
	}

	public function deleteData($table='',$id='',$page='')
	{
		$result=$this->dbm->globalDelete($table,['id'=>$id]);
		if($result)
		{
			$this->setMessage('1','Data Deleted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data not Deleted ! Try Again');
		}
		return redirect('auth/exploreData/'.$table.'/'.$page);	
	}

	public function getAllData($str='',$other='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$tblField=$arr[1];  //DB Table field
		$matcher=$arr[2];  //Matching Value
		$page=$arr[3];  //Landing Page
		$result['data']=$this->dbm->globalSelect($table,[$tblField=>$matcher]);
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
					'allowed_types' => "jpg|png|jpeg|pdf",
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
		$result=$this->dbm->globalInsert($table,$data);
		if($result)
		{
			$this->setMessage('1','Data Inserted Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Inserting Failed ! Try Again');
		}
		return redirect('auth/exploreData/'.$table.'/'.$page);
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
		$result=$this->dbm->globalUpdate($table,['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Updating Failed ! Try Again');
		}
		return redirect('auth/exploreData/'.$table.'/'.$page);
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

	public function pinGenerate($param1='',$param2='')
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
			$this->pinGenerate();
		}else
		{
			return $final;
		}
	}

	public function checkPin($param1='',$param2='')
	{
		$pin=$_POST['pin'];
		$res=$this->dbm->rowCount('pin',['pin'=>$pin]);
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
		$user=$this->dbm->rowCount('users',['user_id'=>$data['user_id']]);
		if($user>0)
		{
			$id=$data['req_id'];
			$data['gen_date']=date('Y-m-d');
			$data['gen_time']=date('H:i:s');
			$data['status']=0;
			$data['generate_by']='admin';
			for($i=1;$i<=$data['quantity'];$i++)
			{
				$data['pin']=$this->pinGenerate();
				$this->dbm->pinTransferByAdmin($data,$data['pin']);
				$this->dbm->globalInsert('pin',$data);
			}
			unset($data['req_id']);
			unset($data['generate_by']);
			$data['status']=1;
			$result=$this->dbm->globalUpdate('pin_request',['id'=>$id],$data);
			if($result)
			{
				$this->setMessage('1','PIN Sent Successfully.');
			}
			else
			{
				$this->setMessage('0','PIN sending Failed ! Try Again');
			}
		}else
		{
			$this->setMessage('0','User ID Not Found.');
		}
		return redirect('auth/exploreData/pin_request/pin-management');
	}

	public function deletePin($param1='',$param2='')
	{
		$result=$this->dbm->globalDelete('pin',['id'=>$param1]);
		if($result)
		{
			$this->dbm->globalUpdate('users',['pin'=>$param2],['pin'=>'','status'=>'']);
			$this->dbm->globalUpdate('pin_request',['pin'=>$param2],['pin'=>'','status'=>'']);
			$this->setMessage('1','PIN Deleted Successfully.');
		}
		else
		{
			$this->setMessage('0','PIN not Deleted ! Try Again');
		}
		return redirect('auth/exploreData/pin_request/pin-management');
	}

	public function sendPinDirectUser($param1='',$param2='')
	{
		$data=$_POST;
		$user=$this->dbm->rowCount('users',['user_id'=>$data['user_id']]);
		if($user>0)
		{
			$data['user_id']=strtoupper($data['user_id']);
			$data['gen_date']=date('Y-m-d');
			$data['gen_time']=date('H:i:s');
			$data['status']=0;
			$data['generate_by']='admin';
			for($i=1;$i<=$data['quantity'];$i++)
			{
				$data['pin']=$this->pinGenerate();
				$this->dbm->pinTransferByAdmin($data,$data['pin']);
				$result=$this->dbm->globalInsert('pin',$data);
			}
			if($result)
			{
				$this->setMessage('1','PIN Sent Successfully.');
			}
			else
			{
				$this->setMessage('0','PIN sending Failed ! Try Again');
			}
		}else
		{
			$this->setMessage('0','User ID Not Found.');
		}
		return redirect('auth/exploreData/pin_request/pin-management');
	}

	public function dailyReport($param1='',$param2='')
	{
		if($param1=='today')
		{
			$condition=array('entry_date'=>date('Y-m-d'));
			$result['data']=$this->dbm->globalSelect('expense_entry',$condition);
			$this->load->view('admin/daily-report',$result);
			//echo '<pre>'; print_r($result); exit;
		}else
		{
			$data=$_POST;
			$result['date']= array('from'=>$data['dateFrom'],'to'=>$data['dateTo']);
			$dateFrom=$data['dateFrom'];
			$dateTo=$data['dateTo'];
			$dateFrom1=new DateTime($dateFrom);
			$new_dateFrom=$dateFrom1->format('Y-m-d');
			$dateTo1=new DateTime($dateTo);
			$new_dateTo=$dateTo1->format('Y-m-d');
			$condition= array('entry_date>='=>$new_dateFrom,'entry_date<='=>$new_dateTo);
			$result['data']=$this->dbm->globalSelect('expense_entry',$condition);
			$this->load->view('admin/daily-report',$result);
		}
	}


	public function purchaseHistory($param1='',$param2='')
	{
		if($param1=='today')
		{
			$condition=array('date'=>date('Y-m-d'));
			$result['data']=$this->dbm->globalSelect('booking',$condition);
			$this->load->view('admin/purchase-history',$result);
			//echo '<pre>'; print_r($result); exit;
		}else
		{
			$data=$_POST;
			$result['date']= array('user_id'=>$data['user_id'],'from'=>$data['dateFrom'],'to'=>$data['dateTo']);
			$dateFrom=$data['dateFrom'];
			$dateTo=$data['dateTo'];
			$dateFrom1=new DateTime($dateFrom);
			$new_dateFrom=$dateFrom1->format('Y-m-d');
			$dateTo1=new DateTime($dateTo);
			$new_dateTo=$dateTo1->format('Y-m-d');
			$condition= array('user_id'=>$data['user_id'],'date>='=>$new_dateFrom,'date<='=>$new_dateTo);
			$result['data']=$this->dbm->globalSelect('booking',$condition);
			// echo "<pre>";print_r($result);die();
			$this->load->view('admin/purchase-history',$result);
		}
	}

	public function salesHistory($param1='',$param2='')
	{
		if($param1=='today')
		{
			$condition=array('date'=>date('Y-m-d'));
			$result['data']=$this->dbm->globalSelect('booking',$condition);
			$this->load->view('admin/sales-history',$result);
			//echo '<pre>'; print_r($result); exit;
		}else
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
			$result['data']=$this->dbm->globalSelect('booking',$condition);
			// echo "<pre>";print_r($result);die();
			$this->load->view('admin/sales-history',$result);
		}
	}


	public function expenseManagement($param1='',$param2='')
	{
		if($param1=='add')
		{
			$data=$this->input->post();
			$mdate=$this->input->post('entry_date');
			$myDateTime = new DateTime($mdate);
			$newDateString = $myDateTime->format('Y-m-d');
			$data['entry_date']=$newDateString;
			$result=$this->dbm->globalInsert('expense_entry',$data);
			if($result)
			{
				$this->session->set_flashdata('msg','Data Added Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			else
			{
				$this->session->set_flashdata('msg','Data Inserting Failed ! Try Again');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			return redirect('auth/expenseManagement');
		}
		if($param1=='expenseReport')
		{
			$data=$_POST;
			$result['date']= array('from'=>$data['dateFrom'],'to'=>$data['dateTo']);
			$dateFrom=$data['dateFrom'];
			$dateTo=$data['dateTo'];
			$branchId=$data['branch_id'];
			$dateFrom1=new DateTime($dateFrom);
			$new_dateFrom=$dateFrom1->format('Y-m-d');
			$dateTo1=new DateTime($dateTo);
			$new_dateTo=$dateTo1->format('Y-m-d');
			$condition= array('entry_date>='=>$new_dateFrom,'entry_date<='=>$new_dateTo);
			$result['branchList']=$this->dbm->globalSelect('branch');
			$result['category']=$this->dbm->globalSelect('expense_category');
			$result['expense_report']=$this->dbm->globalSelect('expense_entry',$condition);
			$result['data']=$this->dbm->globalSelect('expense_entry');
			$this->load->view('admin/expense_management',$result);
		}else
		{
			$result['data']=$this->dbm->globalSelect('expense_entry');
			$result['category']=$this->dbm->globalSelect('expense_category');
			//echo '<pre>'; print_r($result); die;
			$this->load->view('admin/expense_management',$result);
		}
	}

	public function getName($param1='')
	{
		$res=$this->dbm->getName($_POST['user_id']);
		if($res)
		{
			echo $res;
		}else
		{
			echo 0;
		}
	}

	public function pinHistory($param1='',$param2='')
	{
		$data['genBy']=strtoupper($param1);
		$data['active']=$this->dbm->globalSelect('pin',['generate_by'=>$param1,'status'=>1]);
		$data['deactive']=$this->dbm->globalSelect('pin',['generate_by'=>$param1,'status'=>0]);
		$this->load->view('admin/pin-history',$data);
	}

	public function quickReply($param1='',$param2='')
	{
		if($param1=='get')
		{
			$res['data']=$this->dbm->globalSelect('query',['sender!='=>'Admin']);
			$this->load->view('admin/user-query',$res);
		}else
		{
			$data=$_POST;
			$result=$this->dbm->globalInsert('query',$data);
			if($result)
			{
				$this->setMessage('1','Replied Successfully.');
			}
			else
			{
				$this->setMessage('0','Replying Failed ! Try Again');
			}
			return redirect('auth/quickReply/get');
		}
	}

	public function queryDelete($table='',$id='',$page='')
	{
		$this->dbm->globalDelete($table,['query_id'=>$id]);
		$result=$this->dbm->globalDelete($table,['id'=>$id]);
		if($result)
		{
			$this->setMessage('1','Mesage Deleted Successfully.');
		}
		else
		{
			$this->setMessage('0','Message not Deleted ! Try Again');
		}
		return redirect('auth/quickReply/get');	
	}

	public function userBlock($param1='',$param2='')
	{
		if($param2=='block')
		{
			$success=$this->dbm->globalUpdate('users',['user_id'=>$param1],['block'=>1]);
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
			$success=$this->dbm->globalUpdate('users',['user_id'=>$param1],['block'=>0]);
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
		$condition= array('date>='=>$new_dateFrom,'date<='=>$new_dateTo,'status'=>1,'is_credit'=>1);
		$result['self']=$this->dbm->globalSelect('commission',$condition);
		$result['pairMatch']=$this->dbm->globalSelect('pair_income',$condition);
		$result['india']=$this->dbm->globalSelect('all_india_income',$condition);
		$result['referral']=$this->dbm->globalSelect('referral',$condition);
		$this->load->view('admin/payout-report',$result);
		//echo '<pre>'; print_r($result); exit;
	}

	public function getDataAjax($str='',$id='',$page='')
	{
		$result=$this->dbm->getWhere($_POST['table'],['user_id'=>$_POST['user_id']]);
		echo json_encode($result);
	}

	public function withdrawRequest($param1='',$param2='')
	{
		$result['type']=$param1;
		if($param1=='paid')
		{
			$result['bank']=$this->dbm->globalSelect('withdraw',['payment_mode'=>'Bank','status'=>1]);
			$result['paytm']=$this->dbm->globalSelect('withdraw',['payment_mode'=>'Paytm','status'=>1]);
			$this->load->view('admin/withdraw-request',$result);
		}
		if($param1=='unpaid')
		{
			$result['bank']=$this->dbm->globalSelect('withdraw',['payment_mode'=>'Bank','status'=>0]);
			$result['paytm']=$this->dbm->globalSelect('withdraw',['payment_mode'=>'Paytm','status'=>0]);
			$this->load->view('admin/withdraw-request',$result);
		}
	}

	public function withdrawPayment($param1='',$param2='')
	{
		$data=$_POST;
		$data['status']=1;
		$data['paid_date']=date('Y-m-d');
		$data['paid_time']=date('H:i:s');
		$trncId=$this->dbm->transactionNumber();
		$comm['data']='W'.$trncId;
		$data['transaction']=$comm['data'];
		$res=$this->dbm->globalUpdate('withdraw',['id'=>$data['id']],$data);
		if($res)
		{
			$this->setMessage('1','Paid Successfully.');
		}
		else
		{
			$this->setMessage('0','Action Failed ! Try Again');
		}
		return redirect('control/withdrawRequest/unpaid');
	}


	public function bookingSlip($bookingId='')
	{
		$bookres = $this->dbm->getWhere('booking',['id'=>$bookingId]);
		if (!empty($bookres)) {
		$res['bookingreslt'] = $bookres;
		$res['userdtl'] = $this->dbm->getWhere('users',['user_id'=>$bookres['user_id']]);
		$res['bookingDtl'] = $this->dbm->globalSelect('booking_details',['booking_id'=>$bookres['id']]);
		
		// echo "<pre>";print_r($res); die();
		$this->load->view('admin/print-booking',$res);
		}else{
			return redirect('auth');
		}
	}


	public function pandingBookingSlip($bookingId='')
	{
		$bookres = $this->dbm->getWhere('booking_panding',['id'=>$bookingId]);
		if (!empty($bookres)) {
		$res['bookingId'] = $bookingId;
		$res['bookingreslt'] = $bookres;
		$res['userdtl'] = $this->dbm->getWhere('users',['user_id'=>$bookres['user_id']]);
		$res['bookingDtl'] = $this->dbm->globalSelect('booking_details_panding',['booking_id'=>$bookres['id']]);
		$this->load->view('admin/print-panding-booking',$res);
		}
		else
		{
		return redirect('auth');
		}
	}
    public function BookingSlipcencelled($param1='',$param2='')
    {
      $date = date('d-m-Y');
      $bookres = $this->dbm->getWhere('booking_panding',['id'=>$param1]);
      $res = $this->dbm->getWhere('users',['user_id'=>$bookres['user_id']]);
      $result = $this->dbm->getwhere('booking_details_panding',['id'=>$param2]);
      $totalcv=$bookres['total_cv']-$result['total_cv'];
      $totalcvamt=$bookres['total_price']-$result['total_dp'];
      $booking_panding = $this->dbm->globalUpdate('booking_panding',['id'=>$param1['id']],['total_cv'=>$totalcv,'total_price'=>$totalcvamt]);
      $update = $this->dbm->globalUpdate('booking_details_panding',['id'=>$param2],['is_cancelled'=>1,'canclled_date'=>$date]);
      $product = $this->dbm->getwhere('product',['id'=>$result['product_id']]);
      $quan = $product['qty']+$result['qty'];
      $update = $this->dbm->globalUpdate('product',['id'=>$product['id']],['qty'=>$quan]);
       if($update)
                {
                    $this->session->set_flashdata('msg','Cancelled Item Sussessfully');
                    $this->session->set_flashdata('msg_class','alert-success');
                }
                else
                {
                    $this->session->set_flashdata('msg','Action Faild! try Again');
                    $this->session->set_flashdata('msg_class','alert-danger');
                }
      $msg ="Dear ".$res['name']." Your Order ".$product['name']." has been cancelled on :".$date.  "http://myarastustores.com";
      $mobile = $res['mobile'];
      // $this->db_model->sendSms($mobile,$msg);
      redirect('auth/pandingBookingSlip/'.$param1);
    }
	public function pandingBookingSlipcencelled($bookingId='')
	{
		$bookres = $this->dbm->getWhere('booking_panding',['id'=>$bookingId]);
		if (!empty($bookres)) {
		$res['bookingId'] = $bookingId;
		$res['bookingreslt'] = $bookres;
		$res['userdtl'] = $this->dbm->getWhere('users',['user_id'=>$bookres['user_id']]);
		$res['bookingDtl'] = $this->dbm->globalSelect('booking_details_panding',['booking_id'=>$bookres['id']]);
		
		$this->load->view('admin/print-panding-booking-ca',$res);
		}else{
			return redirect('auth');
		}
	}

	public function aprovedOrder($data='')
	{
		$this->load->model('repurchase_model');
		$data = $_POST;
		$bookingdata = $this->dbm->getWhere('booking_panding',['id'=>$data['bookingId']]);
		$pandingBookingid = $bookingdata['id'];
		unset($bookingdata['id']);
		unset($bookingdata['current']);
		$booking_id = $this->dbm->globalInsert('booking',$bookingdata);	
		if (isset($booking_id)) {
		$pandingBookingDtl = $this->dbm->globalSelect('booking_details_panding',['booking_id'=>$pandingBookingid],['is_cancelled'=>'0']);
			foreach ($pandingBookingDtl as $items) 
			{
				unset($items['id']);
				unset($items['booking_id']);
				$items['booking_id'] = $booking_id;
				$this->dbm->globalInsert('booking_details',$items);					
			}
			// die();
			
			$repurchasedata['user_id'] = $bookingdata['user_id'];
			$repurchasedata['booking_id'] = $booking_id;
			$repurchasedata['totalcv'] = $bookingdata['total_cv'];
			$repurchasedata['total_price'] = $bookingdata['total_price'];
			$this->repurchase_model->repurchaseCommission($repurchasedata);
			$this->dbm->globalDelete('booking_panding',['id'=>$pandingBookingid]);

			$this->setMessage('1','Booking updated Successfully.');
			return redirect('auth/bookingSlip/'.$booking_id);
		}
	}


	public function addsupplier($value='')
	{
		$data = $_POST;		
		$res=$this->dbm->suplierregistration($data);
		if ($res) {
			$usr=$this->dbm->getWhere('supplier',['id'=>$res]);	
			$this->setMessage('1','Supplier Create Successfully.');
			return redirect('auth/explore/add-supplier');	
		}else{
			return redirect('auth');
		}
	}

	public function addproduct($value='')
	{
		$data = $_POST;
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
			$data['image']='blue.png';
		}
		$res=$this->dbm->productregistration($data);
		if ($res) {
			$usr=$this->dbm->getWhere('product',['id'=>$res]);	
			$this->setMessage('1','Product Create Successfully.');
			return redirect('auth/explore/add-product');	
		}else{
			return redirect('auth');
		}
	}

	public function Shipping_insert()
	{
	
		$data=$_POST;
		
		//print_r($data); exit();
		$b['supplier_id']=$this->input->post('supplier_id');
			$_SESSION['id']=$b;

		$b['date']=$this->input->post('date');
		$b['invoiceno']=$this->input->post('invoiceno');
		
		$this->load->model('dbm');
		$invoice_id=$this->dbm->lasinsert('product_parchase',$b);
		if($invoice_id)
         {
	         	$i =0;
		    	foreach ($data['product_id'] as $key => $value)
		    	 {
					$product_id =$value."<br>";
					
					 $product_id =$data['product_id'][$i];
				     $product_hsn =$data['product_hsn'][$i];
				      $batch_no =$data['batch_no'][$i];
				       $product_qty =$data['product_qty'][$i];
				       $product_price =$data['product_price'][$i];
				       $product_igst =$data['product_igst'][$i];
				       $product_sgst =$data['product_sgst'][$i];
				       $product_cgst =$data['product_cgst'][$i];

		$data1 = array('suplier_id	'=>$invoice_id,'product_id'=>$product_id,'product_hsn'=>$product_hsn,'batch_no'=>$batch_no,'product_qty'=>$product_qty,'product_price'=>$product_price,'product_igst'=>$product_igst,'product_sgst'=>$product_sgst,'product_cgst'=>$product_cgst);
				    $this->load->model('dbm');
					$aaaa=$this->dbm->comlast('purchase_data',$data1);
				   	$i++; 
		          }

		         	return redirect('auth/invoceSlip');
		         }
            }

	public function parchaseProduct($value='')
	{
		$data = $_POST;

// 		echo "<pre>";print_r($data); die();

// 		foreach ($data['product_id'] as $key => $value) {
// 			$prod = $this->dbm->getWhere('product',['product_id'=>$value]);
// 			if (!isset($prod)) {
// 				$this->setMessage('1','Product Id '.$value.' Not Exist');
// 				return redirect('auth');
// 			}
// 		}

		$i =  0;
		foreach ($data['product_id'] as $key => $value) {
			$datapro['supplier_id'] = $data['supplier_id'];
			$datapro['product_id'] = $data['product_id'][$i];
			$datapro['product_hsn'] = $data['product_hsn'][$i];
			$datapro['batch_no'] = $data['batch_no'][$i];
			$datapro['product_qty'] = $data['product_qty'][$i];
			$datapro['product_price'] = $data['product_price'][$i];
			$datapro['product_igst'] = $data['product_igst'][$i];
			$datapro['product_sgst'] = $data['product_sgst'][$i];
			$datapro['product_cgst'] = $data['product_cgst'][$i];
			$datapro['invoiceno'] = $data['invoiceno'];
			$datapro['date'] = date('Y-m-d');
			$i++;
			 print_r($datapro);

				if ($datapro['product_qty']>0 && $datapro['product_price']!='') 
				{
					$datapro['total_price'] = ($datapro['product_price']*$datapro['product_qty'])+($datapro['product_price']*$datapro['product_qty']*($datapro['product_igst']+$datapro['product_sgst']+$datapro['product_cgst']))/100;
				$parchase_id = $this->dbm->globalInsert('product_parchase',$datapro);
				
				$pro = $this->dbm->getWhere('product',['id'=>$datapro['product_id']]);
			$proqty = $pro['qty']+$datapro['product_qty'];
			
			$this->dbm->globalUpdate('product',['id'=>$datapro['product_id']],['qty'=>$proqty]);
			  }


		}

		if (isset($parchase_id)) {

			
		
			return redirect('auth/invoceSlip/'.$parchase_id.'/'.$data['supplier_id'].'/'.$data['invoiceno']);

		}else{
			echo "Not Inserted! Try Again";
		}


		die();



		
	}
	public function invoceSlip($parchaseId='',$param='',$pam='')
	{
	    $res['product']=$this->dbm->globalSelect('product_parchase');
	  $res['bookingresltd'] = $this->dbm->globalSelect('product_parchase',['invoiceno'=>$pam]);
		$res['suplierdtl'] = $this->dbm->getWhere('supplier',['supplier_id'=>$param]);
		$res['invoice'] = $this->dbm->getWhere('product_parchase',['invoiceno'=>$pam]);
		$this->load->view('admin/parchase-invoic',$res);
	}
	public function invoceSlipedit($parchaseId='',$param='',$pam='')
	{
	    $res['result']=$this->dbm->getWhere('product_parchase',['id'=>$param]);
		$res['suplierdtl'] = $this->dbm->getWhere('supplier',['supplier_id'=>$parchaseId]);
		$res['invoice'] = $this->dbm->getWhere('product_parchase',['invoiceno'=>$pam]);
		$this->load->view('admin/parchase-invoic-edit',$res);
	}   


	public function invoceSlipeditupdate($parchaseId='',$param='')
	{
		$data=$_POST;
	    $result=$this->dbm->globalUpdate('product_parchase',['id'=>$parchaseId],$data);
		if($result)
		{
			$this->setMessage('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Data Updating Failed ! Try Again');
		}
		return redirect('auth/exploreData/product_parchase/parchase-details');
	} 
    
    public function ParchageInvoice()
    {
        
        $res['product']=$this->dbm->globalSelect('product_parchase');
	    $res['bookingresltd'] = $this->dbm->globalSelect('product_parchase',['supplier_id'=>$param]);
		$res['suplierdtl'] = $this->dbm->getWhere('supplier',['supplier_id'=>$param]);
		$this->load->view('admin/parchase-invoic-report',$res);
    }
    
	public function Report()
    {    
    	$a=$_SESSION['id'];
      $res['suplierdtl'] = $this->dbm->getWhere('supplier',['name'=>$a]);
    	$this->load->view('admin/parchase-invoic');
    }
    	public function userUpgrade($param1='',$param2='',$param3='',$binary='')
	{
	    $productAmt = $this->db->get_where('base_plan',['id'=>$param2])->row_array();
	    
	    $data = $this->db->get_where('users',['user_id'=>$param1])->row_array();
	    $KUKIC = $productAmt['amountbv'];
	    $KUKIp = $productAmt['amountpv'];
	    $KUKIt = $productAmt['binari'];
	    
	        $this->db->where(['user_id'=>$param1])->update('users',['topup'=>$KUKIt,'product'=>$productAmt['id'],'cv'=>$KUKIC,'pv'=>$KUKIp]);
	        
// 			$success=$this->dbm->globalUpdate('users',['user_id'=>$param1],['product'=>$param2,'topup'=>$binary]);

			$success=$this->dbm->globalUpdate('self_upgrade',['id'=>$param3],['status'=>1,'upgrade_date'=>date('Y-m-d')]);
			if($success)
			{
			
			 //   ...............Start Comm.......................
			$data = $this->db->get_where('users',['user_id'=>$param1])->row_array();
			$beforeUp = $this->db->get_where('self_upgrade',['id'=>$param3])->row_array();
			$afterUp = $this->db->get_where('base_plan',['id'=>$beforeUp['old_pakg']])->row_array();
			$bonusComm = $beforeUp['amount']-$afterUp['amount'];
			$bonus = (($bonusComm*18)/100);
		    $res=$this->dbm->getWhere('users',['user_id'=>$data['sponcer_id']]);
		    $comm['user_id']=$data['user_id'];
		    $comm['pin']=$data['pin'];
		    $comm['sponcer_id']=$data['sponcer_id'];
		    $comm['date']=date('Y-m-d');
		    $comm['type']='UPGRADE';
		    $tds=5;
			$comm['beneficiary']=$data['sponcer_id'];
			$deduction['tds']=($bonus*5)/100;
			$deduction['admin']=($bonus*5)/100;
			$deduction['user_id']=$data['user_id'];
			$deduction['date']=date('Y-m-d');
			$deduction['time']=date('H:i:s');
			$deduction['amount']=$bonus;
			$deduction['type']='UPGRADE';
			$deduction['admin_percent']=10;
			$deduction['tds_percent']=$tds;
			$left=($bonus-($deduction['admin']+$deduction['tds']));
				if($res['status']==1)
			{
				$wall=$left+$res['wallet'];
				// $this->dbm->globalUpdate('users',['user_id'=>$res['user_id']],['wallet'=>$wall]);
				$comm['status']=1;
				$deduction['status']=1;
				$comm['is_credit']=1;
				$deduction['is_credit']=1;
			}else
			{
				$comm['status']=0;
				$deduction['status']=0;
				$comm['is_credit']=0;
				$deduction['is_credit']=0;
			}
			$comm['amount']=($bonus-($deduction['admin']+$deduction['tds']));
			$comm['time']=date('H:i:s');
			$trncId=$this->dbm->transactionNumber();
			$comm['transaction']='C'.$trncId;
            $deduction['amount']=($bonus-($deduction['admin']+$deduction['tds']));
			$deduction['transaction']=$comm['transaction'];
// 			$this->db->insert('tds',$deduction);
// 			$this->db->insert('upgrade_comm',$comm);
// 			.............End Commission.................
			$this->setMessage('1','User Upgrade Successfully.');
			}
			else
			{
				$this->setMessage('0','User not Upgrade ! Try Again');
			}
			
		   return redirect('auth/exploreData/self_upgrade/upgrade-users');
	}
}
