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
	
	public function getAll()
	{

	}
	
	public function allIndiaList($param1='',$param2='')
	{
		$data['paid']=$this->db_model->globalSelect('all_india_bonus',['level!='=>"A"]);
		$data['list']=$this->db_model->globalSelect('all_india_b');
		echo '<pre>'; print_r($data);
		//$this->load->view('admin/all-india-list',$data);
	}
	

	public function index()
	{
		$result['notice']=$this->db_model->globalSelect('notice');
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
		$user=$this->db_model->rowCount('users',['user_id'=>$data['user_id']]);
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
				$this->db_model->pinTransferByAdmin($data,$data['pin']);
				$this->db_model->globalInsert('pin',$data);
			}
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
		}else
		{
			$this->setMessage('0','User ID Not Found.');
		}
		return redirect('control/exploreData/pin_request/pin-management');
	}

	public function sendPinDirectUser($param1='',$param2='')
	{
		$data=$_POST;
		$user=$this->db_model->rowCount('users',['user_id'=>$data['user_id']]);
		if($user>0)
		{
			$data['gen_date']=date('Y-m-d');
			$data['gen_time']=date('H:i:s');
			$data['status']=0;
			$data['generate_by']='admin';
			for($i=1;$i<=$data['quantity'];$i++)
			{
				$data['pin']=$this->pinGenerate();
				$this->db_model->pinTransferByAdmin($data,$data['pin']);
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
		}else
		{
			$this->setMessage('0','User ID Not Found.');
		}
		return redirect('control/exploreData/pin_request/pin-management');
	}

	public function universalPools($param1='',$param2='')
	{
		$data['plan']=$this->db_model->getWhere('plans',['id'=>$param1]);
		$data['list']=$this->db_model->globalSelect('upgrade',['plan_id'=>$param1]);
		//echo '<pre>'; print_r($data);
		$this->load->view('admin/upgrade-list',$data);
	}

	public function pinHistory($param1='',$param2='')
	{
		$data['genBy']=strtoupper($param1);
		$data['active']=$this->db_model->globalSelect('pin',['generate_by'=>$param1,'status'=>1]);
		$data['deactive']=$this->db_model->globalSelect('pin',['generate_by'=>$param1,'status'=>0]);
		$this->load->view('admin/pin-history',$data);
	}

	public function quickReply($param1='',$param2='')
	{
		if($param1=='get')
		{
			$res['data']=$this->db_model->globalSelect('query',['sender!='=>'Admin']);
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
		$data['paid_time']=date('H:i:s');
		$trncId=$this->db_model->transactionNumber();
		$comm['data']='W'.$trncId;
		$data['transaction']=$comm['data'];
		$res=$this->db_model->globalUpdate('withdraw',['id'=>$data['id']],$data);
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
		$result['all_india']=$this->db_model->globalSelect('all_india_bonus',$condition);
		$result['withdraw']=$this->db_model->globalSelect('withdraw',$condition1);
		$result['royalty']=$this->db_model->globalSelect('royalty_income',$condition);
		$result['club']=$this->db_model->globalSelect('club_commission',$condition);
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

	public function getName($param1='')
	{
		$res=$this->db_model->getName($_POST['user_id']);
		if($res)
		{
			echo $res;
		}else
		{
			echo "User Not Found";
		}
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
		$user=$this->db_model->getWhere('users',['user_id'=>$_POST['user_id']]);
		$data['topup_old']=$user['topup'];
		$data['topup_new']=$_POST['topup'];
		$data['wallet_old']=$user['wallet'];
		$data['wallet_new']=$_POST['wallet'];
		$data['date']=date('Y-m-d');
		$data['time']=date('H:i:s');
		$data['user_id']=$_POST['user_id'];
		$success=$this->db_model->globalInsert('change_wallet',$data);
		if($success)
		{
			$this->db_model->globalUpdate('users',['user_id'=>$_POST['user_id']],$_POST);
			$this->setMessage('1','User Wallet updated Successfully.');
		}
		else
		{
			$this->setMessage('0','User wallet not updated ! Try Again');
		}
		return redirect('control/exploreData/users/wallet-management');
	}

	public function statics($param1='',$param2='')
	{
		$str=base64_decode($param1);
		$str=explode('/', $str);
		$type= $str[0];
		$status= $str[1];
		$data['title']= $str[2];
		$userID=$param2;
		$data['userID']=$param2;
		$id=$this->logged['id'];
		if($type=='direct')
		{
			$data['direct']='Direct';
			$data['down']=$this->db_model->globalSelect('users',['sponcer_id'=>$userID,'status'=>$status]);
		}
		if($type=='directAll')
		{
			$data['direct']='Direct';
			$data['down']=$this->db_model->globalSelect('users',['sponcer_id'=>$userID]);
		}
		if($type=='self')
		{
			$arr=[];
			$res=$this->commission_model->selfTeam($userID);
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
    	 	$data['self']=$this->db_model->globalSelect('level',['type'=>'self']);
		}
		if($type=='selfAll')
		{
			$arr=[];
			$res=$this->commission_model->selfTeam($userID);
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
    	 	$data['self']=$this->db_model->globalSelect('level',['type'=>'self']);
		}
		if($type=='india')
		{
			//$data['down']=$this->db_model->globalSelect('users',['id>'=>$id,'status'=>$status]);
			$data['india']=$this->db_model->globalSelect('level',['type'=>'india']);
		}
		if($type=='indiaAll')
		{
			//$data['down']=$this->db_model->globalSelect('users',['id>'=>$id]);
			$data['india']=$this->db_model->globalSelect('level',['type'=>'india']);
		}
		//echo "<pre>"; print_r($data); die;
		$this->load->view('admin/team-business',$data);
	}

	public function franchaise($param1='',$param2='', $param3='')
	{
		if($param1 == 'opn')
		{
			$result['f_list'] = $this->db_model->globalSelect('franchaise');
			$this->load->view('admin/franchaise', $result);
		}

		if($param1=='del')
		{
			$condition=array('id'=>$param2);
			$result=$this->db_model->globalDelete('franchaise',$condition);
			if($result)
			{
				$this->session->set_flashdata('msg','Franchaise Deleted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('control/franchaise/opn');
		}

		if($param1=='upd')
		{
			$condition=array('id'=>$param2);
			$result['updData']=$this->db_model->getWhere('franchaise',$condition);
			$result['f_list']=$this->db_model->globalSelect('franchaise');
			$this->load->view('admin/franchaise',$result);
		}

		if($param1=='update')
		{
			

			$data=$_POST;

			$data['date']= date('Y-m-d');

			$condition=array('id'=>$param2);


			$result=$this->db_model->globalUpdate('franchaise',$condition,$data);
			if($result)
			{
				$this->session->set_flashdata('msg','Franchaise Updated Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('control/Franchaise/opn');
		}

		if($param1 == 'add')
		{
			$data = $_POST;

			$condition['f_id'] = $this->input->post('f_id');

			$result = $this->db_model->getWhere('franchaise', $condition);
			
			if(!isset($result))
			{
				$data['f_id'] = $condition['f_id'];
				$data['date'] = date('Y-m-d');

				$result = $this->db_model->globalInsert('franchaise',$data);

				if($result)
				{
				$this->session->set_flashdata('msg','Post Send Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
				}else
				{
					$this->session->set_flashdata('msg','Action Failed! try Again');
					$this->session->set_flashdata('msg_class','alert-danger');
				}
				return redirect('control/franchaise/opn');
			}else
			{
				$this->session->set_flashdata('msgg','ID are already exist.');
			}
			return redirect('control/franchaise/opn');
			
		}
	}
	
	public function withdrawRequest($param1='',$param2='')
	{
		$result['type']=$param1;
		if($param1=='paid')
		{
			$result['bank']=$this->db_model->globalSelect('withdraw',['payment_mode'=>'Bank','status'=>1]);
			$result['paytm']=$this->db_model->globalSelect('withdraw',['payment_mode'=>'Paytm','status'=>1]);
			$this->load->view('admin/withdraw-request',$result);
		}
		if($param1=='unpaid')
		{
			$result['bank']=$this->db_model->globalSelect('withdraw',['payment_mode'=>'Bank','status'=>0]);
			$result['paytm']=$this->db_model->globalSelect('withdraw',['payment_mode'=>'Paytm','status'=>0]);
			$this->load->view('admin/withdraw-request',$result);
		}
	}
	
	public function todayReport($param1='',$param2='')
	{
		$data['date']= array('from'=>date('d-M-Y'),'to'=>date('d-M-Y'));
		$data['page']=$param1;
		if($param1=='business-report')
		{
			$arr=['active_date'=>date('Y-m-d'),'status'=>1];
			$data['report']=$this->db_model->globalSelect('users',$arr);
		}
		if($param1=='self-team-report')
		{
			$arr=['date'=>date('Y-m-d'),'type'=>'bonus'];
			$data['report']=$this->db_model->globalSelect('commission',$arr);
		}
		if($param1=='all-india-report')
		{
			$arr=['date'=>date('Y-m-d'),'level'=>'A'];
			$arr1=['date'=>date('Y-m-d'),'type'=>'All India B'];
			$data['reportA']=$this->db_model->globalSelect('all_india_bonus',$arr);
			$data['reportB']=$this->db_model->globalSelect('all_india_bonus',$arr1);
		}
		if($param1=='universal-club-report')
		{
			$arr=['date'=>date('Y-m-d')];
			$data['report']=$this->db_model->globalSelect('club_commission',$arr);
		}
		if($param1=='royalty-income-report')
		{
			$arr=['date'=>date('Y-m-d')];
			$data['report']=$this->db_model->globalSelect('royalty_income',$arr);
		}
		if($param1=='tds-report')
		{
			$data['type']='TDS';
			$arr=['date'=>date('Y-m-d'),'is_credit'=>1];
			$data['report']=$this->db_model->tdsAndAdmin('tds',$arr);
			$param1='tds-and-admin-charge-report';
		}
		if($param1=='admin-charge-report')
		{
			$data['type']='Admin';
			$arr=['date'=>date('Y-m-d'),'is_credit'=>1];
			$data['report']=$this->db_model->tdsAndAdmin('tds',$arr);
			$param1='tds-and-admin-charge-report';
		}
		$this->load->view('admin/'.$param1,$data);
	}

	public function filterReport($param1='',$param2='')
	{
		$data=$_POST;
		$data['page']=$param1;
		$data['date']= array('from'=>$data['dateFrom'],'to'=>$data['dateTo']);
		$dateFrom1=new DateTime($data['dateFrom']);
		$from=$dateFrom1->format('Y-m-d');
		$dateTo1=new DateTime($data['dateTo']);
		$to=$dateTo1->format('Y-m-d');
		if($param1=='business-report')
		{
			$arr= array('active_date>='=>$from,'active_date<='=>$to,'status'=>1);
			$data['report']=$this->db_model->globalSelect('users',$arr);
		}
		if($param1=='self-team-report')
		{
			$arr=['date>='=>$from,'date<='=>$to,'type'=>'bonus'];
			$data['report']=$this->db_model->globalSelect('commission',$arr);
		}
		if($param1=='all-india-report')
		{
			$arr=['date>='=>$from,'date<='=>$to,'level'=>'A'];
			$arr1=['date>='=>$from,'date<='=>$to,'type'=>'All India B'];
			$data['reportA']=$this->db_model->globalSelect('all_india_bonus',$arr);
			$data['reportB']=$this->db_model->globalSelect('all_india_bonus',$arr1);
		}
		if($param1=='universal-club-report')
		{
			$arr=['date>='=>$from,'date<='=>$to];
			$data['report']=$this->db_model->globalSelect('club_commission',$arr);
		}
		if($param1=='royalty-income-report')
		{
			$arr=['date>='=>$from,'date<='=>$to];
			$data['report']=$this->db_model->globalSelect('royalty_income',$arr);
		}
		if($param1=='tds-report')
		{
			$data['type']='TDS';
			$arr=['date>='=>$from,'date<='=>$to,'is_credit'=>1];
			$data['report']=$this->db_model->tdsAndAdmin('tds',$arr);
			$param1='tds-and-admin-charge-report';
		}
		if($param1=='admin-charge-report')
		{
			$data['type']='Admin';
			$arr=['date>='=>$from,'date<='=>$to,'is_credit'=>1];
			$data['report']=$this->db_model->tdsAndAdmin('tds',$arr);
			$param1='tds-and-admin-charge-report';
		}
		$this->load->view('admin/'.$param1,$data);
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
			$data['self_amt']=$this->db_model->selectSum('commission',['beneficiary'=>$id,'type'=>'bonus']);
			$data['indiaA_amt']=$this->db_model->selectSum('all_india_bonus',$conditionA);
			$data['indiaB_amt']=$this->db_model->selectSum('india_income',$condition2);
			$data['royalty_amt']=$this->db_model->totalRoyalty($id);
			$data['universal_amt']=$this->db_model->selectSum('club_commission',$condition1);
			$data['leader_amt']=$this->db_model->selectSum('leader_income',$condition1);
			$data['total']=$this->db_model->totalEarn($id);
			$data['withdraw']=$this->db_model->selectSum('withdraw',['user_id'=>$id]);
			$data['directs']=$this->db_model->globalSelect('users',['sponcer_id'=>$id,'status'=>1]);
			$data['pinCount']=$this->db_model->rowCount('pin',['user_id'=>$id,'generate_by'=>'self']);
		}else
		{
			$data['user']=0;
		}
		$this->load->view('admin/user-data',$data);
		}else{
			return redirect('control'); 
		}
	}

	public function allIndiaLiveChart($param1='',$param2='')
	{
		$usr=$param1;
		$data['userID']=$param1;
		$data['entry']=$this->db_model->globalSelect('india_b1',['user_id'=>$usr,'type'=>'fresh']);
		//echo "<pre>"; print_r($data); die;
		$this->load->view('admin/india-live-chart',$data);
	}

	public function paymentHistory($userid='',$other='')
	{
    	$id=$userid;
		$result['self']=$this->db_model->globalSelect('commission',['beneficiary'=>$id,'type'=>'bonus']);
		$result['transfer']=$this->db_model->globalSelect('commission',['user_id'=>$id,'type'=>'transfer']);
		$result['india']=$this->db_model->globalSelect('all_india_bonus',['user_id'=>$id,'status!='=>0,'is_credit'=>1]);
		$result['indiaB']=$this->db_model->globalSelect('india_income',['user_id'=>$id,'status!='=>0,'is_credit'=>1]);
		$result['club']=$this->db_model->globalSelect('club_commission',['user_id'=>$id]);
		$result['royalty']=$this->db_model->globalSelect('royalty_income',['user_id'=>$id]);
		$result['leader']=$this->db_model->globalSelect('leader_income',['user_id'=>$id,'is_credit'=>1]);
		$this->load->view('user/payment-history',$result);
	}
}