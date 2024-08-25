<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	public function __construct()
	{
		parent:: __construct();
		if(!$logged=$this->session->userdata('loggedUser'))
		{ return redirect('login'); }
		$this->load->model('db_model');
		$this->load->model('Commission_model');
	}

	public function index()
	{
		if($this->logged['access_level']=='universal')
		{ return redirect('control'); }
		$result['count']=$this->db_model->rowCount('users',['sponcer_id'=>$this->logged['user_id']]);
		$result['notice']=$this->db_model->globalSelect('notice');
		//echo '<pre>'; print_r($result); die;
		$this->load->view('user/user-dashboard',$result);
	}

	public function explore($page='')
	{
		$this->load->view('user/'.$page);
	}
	
	public function exploreData($str='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$page=$arr[1];  //Landing Page
		$result['data']=$this->db_model->globalSelect($table);
		$this->load->view('user/'.$page,$result);
	}

	public function getData($str='',$id='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$id=$arr[1];    //Row ID
		$page=$arr[2];  //Landing Page
		$result['get_data']=$this->db_model->getWhere($table,['id'=>$id]);
		$this->load->view('user/'.$page,$result);
	}

	public function getAllData($str='',$other='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$tblField=$arr[1];  //DB Table field
		$matcher=$arr[2];  //Matching Value
		$page=$arr[3];  //Landing Page
		$result['data']=$this->db_model->globalSelect($table,[$tblField=>$matcher]);
		$this->load->view('user/'.$page,$result);
	}

	public function updateData($str='',$id='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$id=$arr[1];    //Row ID
		$page=$arr[2];  //Landing Page
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
		
		$result=$this->db_model->globalInsert($table,$data);
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
		$result=$this->db_model->globalDelete($table,['id'=>$id]);
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
		return redirect('user/exploreData/'.base64_encode($table.'/'.$page));
	}


public function updatePanCard($str='',$id='',$page='')
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
			$data['pan_image']=$img['file_name'];
		}
		else
		{
			$data=$_POST;
		}
		// echo '<pre>'; print_r($data); exit;
		$result=$this->db_model->globalUpdate($table,['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','Pan Card Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Pan Card Updating Failed ! Try Again');
		}
		return redirect('user/exploreData/'.base64_encode($table.'/'.$page));
	}

	public function updateCheque($str='',$id='',$page='')
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
			$data['cheque_image']=$img['file_name'];
		}
		else
		{
			$data=$_POST;
		}
		// echo '<pre>'; print_r($data); exit;
		$result=$this->db_model->globalUpdate($table,['id'=>$id],$data);
		if($result)
		{
			$this->setMessage('1','Cheque Updated Successfully.');
		}
		else
		{
			$this->setMessage('0','Cheque Updating Failed ! Try Again');
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

	public function logout()
	{
		$this->session->unset_userdata('loggedUser');
		return redirect('login');
	}

	public function pinRequest($param1='',$param2='')
	{
		$data=$_POST;
		$data['user_id']=$this->logged['user_id'];
		$data['req_date']=date('Y-m-d');
		$data['req_time']=date('h:i:s A');
		$data['status']=0;
		$result=$this->db_model->globalInsert('pin_request',$data);
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

	public function pinGenerate($param1='',$param2='')
	{
		$data=$_POST;
		$data['gen_date']=date('Y-m-d');
		$data['gen_time']=date('h:i:s A');
		$data['status']=0;
		$data['generate_by']='self';
		$data['user_id']=$this->logged['user_id'];
		$total=$data['quantity']*$this->siteInfo['pin_amt'];
		$data['amount']=$this->siteInfo['pin_amt'];
		$leftbalance=$this->logged['wallet']-$total;
		for($i=1; $i<=$data['quantity']; $i++)
		{
			$data['pin']=$this->getPin();
			$res=$this->db_model->globalInsert('pin',$data);
		}
		if($res)
		{
			$this->db_model->globalUpdate('users',['user_id'=>$this->logged['user_id']],['wallet'=>$leftbalance]);
			echo 1;
		}else
		{
			echo 0;
		}
	}

	public function activateAccount($param1='',$param2='')
	{
		$pin=$_POST['pin'];
		$account=$_POST['account'];
		$res=$this->db_model->rowCount('pin',['pin'=>$pin,'status'=>0]);
		if($res>0)
		{
			$this->db_model->globalUpdate('users',['user_id'=>$account],['pin'=>$pin,'status'=>1,'active_date'=>date('Y-m-d'),'active_time'=>date('h:i:s A')]);
			$this->db_model->globalUpdate('pin',['pin'=>$pin],['activated_account'=>$account,'status'=>1,'date'=>date('Y-m-d'),'time'=>date('h:i:s A')]);
			$this->load->model('Commission_model');
			$que=$this->db_model->getWhere('users',['user_id'=>$account]);
			$this->Commission_model->agentCommission($que);
			//print_r($one); exit;
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
		$res=$this->db_model->rowCount('pin',['pin'=>$pin,'status'=>0]);
		if($res>0)
		{
			echo 1;
		}else
		{
			echo 0;
		}
	}

	public function checkBalanceTransfer($param1='')
	{
		$user_id=$_POST['user_id'];
		$res=$this->db_model->getWhere('users',['user_id'=>$user_id]);
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
									<option value="wallet">Cash Wallet</option>
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
		$data['time']=date('h:i:s A');
		$data['user_id']=$this->logged['user_id'];
		$data['type']='transfer';
		$data['status']=1;
		$trncId=$this->db_model->transactionNumber();
		$data['transaction']='T'.$trncId;
		$que=$this->db_model->getWhere('users',['user_id'=>$data['beneficiary']]);
		$total=$que[$wall]+$data['amount'];
		$res=$this->db_model->globalInsert('commission',$data);
		if($res)
		{
			$amt=$this->logged['wallet']-$data['amount'];
			$this->db_model->globalUpdate('users',['user_id'=>$this->logged['user_id']],['wallet'=>$amt]);
			$this->db_model->globalUpdate('users',['user_id'=>$data['beneficiary']],[$wall=>$total]);
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
			$res=$this->db_model->globalInsert('query',$data);
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
			$res['data']=$this->db_model->userQuery();
			$this->load->view('user/contact-admin',$res);
		}
	}

	public function megaBonusRedeem($param1='',$param2='')
	{
		$data=[];
		print_r($param1); exit;
		if($param1=='reward')
		{
			$data['reward_level']=$_POST['reward_level'];
			$data['type']='reward';
		}else
		{
			$data['mega_bonus_level']=$_POST['mega_bonus_level'];
			$data['type']='mega_bonus';
		}
		$data['amount']=$_POST['amount'];
		$data['user_id']=$this->logged['user_id'];
		$data['date']=date('Y-m-d');
		$data['status']=1;
		$trncId=$this->db_model->transactionNumber();
		$data['transaction']='M'.$trncId;
				$user=$this->db->get_where('users',['user_id'=>$this->logged['user_id']])->row_array();
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
				$deduction['amount']=$_POST['amount'];
				$deduction['type']='mega_bonus';
				$deduction['admin_percent']=10;
				$deduction['tds_percent']=$tds;
				$deduction['transaction']=$data['transaction'];
				$data['amount']=(($data['amount'])-($deduction['admin']+$deduction['tds']));

		$wall=$this->logged['wallet'];
		$amt=$wall+$data['amount'];
		//echo '<pre>'; print_r($data); exit;
		$this->db_model->globalInsert('tds',$deduction);
		$res=$this->db_model->globalInsert('mega_bonus_redeem',$data);
		if($res)
		{
			$this->db_model->globalUpdate('users',['user_id'=>$this->logged['user_id']],['wallet'=>$amt]);
			$this->setMessage('1','Bonus Redeemed Successfully.');
		}
		else
		{
			$this->setMessage('0','Redeemption Failed ! Try Again');
		}
		echo 1;
	}

	public function fundWithdraw($param1='')
	{
		$data=$_POST;
		$data['user_id']=$this->logged['user_id'];
		$data['date']=date('Y-m-d');
		$data['status']=0;
		$res=$this->db_model->globalInsert('withdraw',$data);
		if($res)
		{
			$this->setMessage('1','Request Send Successfully.');
		}
		else
		{
			$this->setMessage('0','Sending Failed ! Try Again');
		}
		return redirect('user/getAllData/'.base64_encode('withdraw/user_id/'.$this->logged['user_id'].'/fund-withdraw'));
		//echo '<pre>'; print_r($data);
	}

	public function redeemDirectBonus($param1='',$param2='')
	{
		$data=$_POST;
		$data['date']=date('Y-m-d');
		$data['status']=1;
		$data['user_id']=$this->logged['user_id'];
		$data['amount']=$_POST['amount'];
		$user=$this->db->get_where('users',['user_id'=>$this->logged['user_id']])->row_array();
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
				$deduction['amount']=$_POST['amount'];
				$deduction['type']=$_POST['type'];
				$deduction['admin_percent']=10;
				$deduction['tds_percent']=$tds;
				$deduction['transaction']=$data['transaction'];
				$data['amount']=(($data['amount'])-($deduction['admin']+$deduction['tds']));

		$wall=$this->logged['wallet'];
		$amt=$wall+$data['amount'];
		//echo '<pre>'; print_r($data); exit;
		$this->db_model->globalInsert('tds',$deduction);


		$amt=$this->logged['wallet'];
		$amt=$amt+$_POST['amount'];
		$res=$this->db_model->globalInsert('bonus_redeem',$data);
		if($res)
		{
			$this->db_model->globalUpdate('users',['user_id'=>$this->logged['user_id']],['wallet'=>$amt]);
			$this->setMessage('1','Bonus Redeemed Successfully.');
		}
		else
		{
			$this->setMessage('0','Bonus Redeeming Failed ! Try Again');
		}
		return $res;
	}

	public function checkUserForpinTopup($param1='')
	{
		$res=$this->db_model->getWhere('users',['user_id'=>$_POST['user_id']]);
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
					    <button id="verify" class="btn btn-primary" type="submit" style="margin-top: 5px;">Topup</button>
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

	public function activePinViaTopup($param1='',$param2='')
	{
		$data['date']=date('Y-m-d');
		$data['time']=date('h:i:s A');
		$data['activated_account']=$_POST['user_id'];
		$data['status']=1;
		$user['active_time']=$data['time'];
		$user['active_date']=$data['date'];
		$user['status']=1;
		$user['pin']=$_POST['pin'];
		$res=$this->db_model->globalUpdate('pin',['pin'=>$_POST['pin']],$data);
		if($res)
		{
			$this->db_model->globalUpdate('users',['user_id'=>$_POST['user_id']],$user);
			$this->setMessage('1','Account Activated Successfully.');
		}else
		{
			$this->setMessage('0','Account Not Activated, Try Again!.');
		}
		return redirect('user/getAllData/'.base64_encode('pin_request/user_id/'.$this->logged['user_id'].'/generate-pin'));
	}
	
	public function selfJoin($param1='',$param2='')
	{
		$str=base64_decode($param1);
		$arr=explode('/',$str);
		$row['sponcer_data']=$this->dbm->getWhere('users',['user_id'=>$arr[0]]);
		if($row['sponcer_data'])
		{
			$this->load->view('user/associate-registration',$row);
		}else
		{
		
		}
		
	}
	
	public function downTree($param1='',$param2='')
	{
		$id = $this->logged['user_id'];
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
		$this->load->view('user/down-tree',$data);
		}else{
			return redirect('control'); 
		}
	}
	
	public function userManagement($uid='')
	{
			$result['userData']=$this->db_model->selectRow('flat_registration',['id'=>$uid]);
			$userData=$this->db_model->selectRow('flat_registration',['id'=>$uid]);
			$logged=$this->session->userdata('loggedUser');

		 	if ($userData['introducer']==$logged['user_id']) {			 	
					$condition=array('id'=>$result['userData']['flat_id']);
					$result['flat']=$this->db_model->selectRow('flat',$condition);
					$condition1=['flat_user_id'=>$uid];
					$result['data']=$this->db_model->globalSelect('payment',$condition1);
					$result['project']=$this->db_model->selectRow('project',array('id'=>$result['userData']['building_id']));
					$project=$this->db_model->selectRow('project',array('id'=>$result['userData']['building_id']));
					$result['site']= $this->db_model->selectRow('sites',['id'=>$project['site_id']]);
					$this->load->view('user/clientage',$result);

				}else{
					return redirect('user');
				}
	}
}
