<?php
class Real1 extends MY_Controller
{
	public function __construct()
	{
		parent:: __construct();
		//$logged=$this->session->userdata('loggedUser');
		if($this->logged['access_level']!='universal')
		{ return redirect('user'); }
		$this->load->model('db_model');
		$this->load->model('commission_model');
	}
	public function explore($param1='',$param2='')
	{
		$this->load->view('admin/'.$param1);
	}
    public function form()
	{
		$this->load->view('admin/form');
	}
	public function formshow($id="")
	{
		$this->load->view('admin/formdone');
	}
	
	public function userBlock($param1='',$param2='',$param3='')
	{
		if($param2=='pay')
		{
			$success['list']=$this->db_model->globalUpdate('withdraw',['user_id'=>$param1,'date'=>$param3],['status'=>1]);
			if($success)
			{
				$this->setMessage('1','Withdraw Pay Successfully.');
			}
			else
			{
				$this->setMessage('0','Withdraw not Pay ! Try Again');
			}
				//$this->load->view('admin/withdraw',$result);
			
		}
		if($param2=='paid')
		{
			$success=$this->db_model->globalUpdate('withdraw',['id'=>$param1],['status'=>0]);
			if($success)
			{
				$this->setMessage('1','Withdraw not Pay ! Try Again.');
			}
			else
			{
				$this->setMessage('0','Withdraw Pay Successfully');
			}
		}
		return redirect('real1/exploreData/withdraw/withdraw');	
	}


    public function commClosing()
	{
	    $arr=$this->db_model->globalSelect('commission_new',['net>='=>10]);
	    foreach ($arr as $key => $value)
	    {
	    	$usr = $this->db_model->getWhere('users',['user_id'=>$value['agent_id']]);
	    	$data['amount']=floor($value['net']);
	    	$data['payment_mode']='Bank';
			$data['account_number']=($usr['account_number'])?$usr['account_number']:'Not Added';
			$data['branch_name']=($usr['branch_name'])?$usr['branch_name']:'Not Added';
			$data['bank_name']=($usr['bank_name'])?$usr['bank_name']:'Not Added';
			$data['ifsc']=($usr['ifsc'])?$usr['ifsc']:'Not Added';
			$data['user_id']=$value['agent_id'];
			$data['date']=date('Y-m-d');
			$data['time']=date('H:i:s');
			$data['status']=0;
			//echo "<pre>"; print_r($data);
			$res=$this->db_model->globalInsert('withdraw',$data);
			if($res)
			{
				$msg="Dear ".$value['agent_id']." your payout for Rs.".$data['amount']." is released. The amount will reflect in your bank in next 4 days. Thanks and Regards. prayasinfra.com "; 
				// $this->db_model->sendSms($usr['mobile'],$msg);
			    $amt=($value['net']-$data['amount']);
				$this->db_model->globalUpdate('commission_new',['agent_id'=>$value['agent_id']],['net'=>$amt]);
				// $this->setMessage('1','Request Send Successfully.');
			}
	    }
	    echo "Request Successfully Placed";
	}
	
		
public function form_insert($data='')
	{	
		$data=$_POST;
		$res=$this->db_model->globalInsert('form',$data);
           $condition=array('id'=>$res);


           $data['q']=$this->db_model->booked_print($condition);
 
     $this->load->view('admin/formdone',$data);
	
	}
	public function exploreData($table='',$viewpage='')
	{
		$result['data']=$this->db_model->selectAll($table);
		// echo"<pre>";print_r($result);exit;
		$this->load->view('admin/'.$viewpage,$result);
	}
	public function exploreDataWith($table='',$viewpage='')
	{
		if (isset($_POST['project_id'])) {
		$result['data']=$this->db_model->globalSelect($table,['building_id'=>$_POST['project_id']]);
		}else{
		$result['data']=$this->db_model->selectAll($table);
		}
		$this->load->view('admin/'.$viewpage,$result);
	}
	public function associatManagement($param1='',$param2='',$param3='')
	{
		if($param1=='edt')
		{
			$result['user']=$this->db_model->selectRow('users',['id'=>$param2]);
			$this->load->view('admin/update-associate-data',$result);
		}
		if($param1=='upd')
		{	

			$data=$_POST; //echo "<pre>";print_r($data);die();
			
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

			$condition=array('id'=>$param2);
			$result=$this->db_model->globalUpdate('users',$condition,$data);
			if($result)
			{
				$this->session->set_flashdata('msg','Associate Data Updated Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/exploreData/users/associate-management');
		}
	}
	public function userManagement($param1='',$param2='',$param3='')
	{
		if($param1=='get-detail')
		{
			if(isset($_POST['building_id'])){$condition=$_POST['building_id'];}else{$condition=$param2;}
			if($condition=='All')
			{
				$result['userData']=$this->db_model->selectAll('flat_registration');
			}else
			{
				$result['userData']=$this->db_model->globalSelect('flat_registration',['building_id'=>$condition]);
			}
			//echo '<pre>'; print_r($result);
			$result['dataFor']=$condition;
			$result['data']=$this->db_model->selectAll('project');
			$this->load->view('admin/user-management',$result);
		}
		if($param1=='edt')
		{
			$result['user']=$this->db_model->selectRow('flat_registration',['id'=>$param2]);
			$condition=array('id'=>$result['user']['flat_id']);
			$result['flat']=$this->db_model->selectRow('flat',$condition);
			$result['dataFor']=$param3;
			$this->load->view('admin/update-user-data',$result);
		}
		if($param1=='upd')
		{
			$data=$_POST;
			$condition=array('id'=>$param2);
			$result=$this->db_model->globalUpdate('flat_registration',$condition,$data);
			if($result)
			{
				$this->session->set_flashdata('msg','User Data Updated Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/exploreData/flat_registration/user-management');
		}
		if($param1=='del')
		{
			$res=$this->db_model->selectRow('flat_registration',['id'=>$param2]);
			$condition=['id'=>$param2];
			$this->db_model->globalDelete('payment',['flat_user_id'=>$param2]);
			$this->db_model->globalDelete('installment',['flat_user_id'=>$param2]);
			$result=$this->db_model->globalDelete('flat_registration',$condition);
			if($result)
			{
				$condition1=array('id'=>$res['flat_id']);
				$this->db_model->globalUpdate('flat',$condition1,['status'=>0]);
				$this->session->set_flashdata('msg','Data Deleted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/exploreData/flat_registration/user-management');
		}
		if($param1=='user-payments')
		{
			$result['userData']=$this->db_model->selectRow('flat_registration',['id'=>$param2]);
			$condition=array('id'=>$result['userData']['flat_id']);
			$result['flat']=$this->db_model->selectRow('flat',$condition);
			$condition1=['flat_user_id'=>$param2];
			$result['data']=$this->db_model->globalSelect('payment',$condition1);
			$result['project']=$this->db_model->selectRow('project',array('id'=>$result['userData']['building_id']));
			$project=$this->db_model->selectRow('project',array('id'=>$result['userData']['building_id']));
			$result['site']= $this->db_model->selectRow('sites',['id'=>$project['site_id']]);
	    	//	echo '<pre>'; print_r($result); exit;
			$this->load->view('admin/user-payments',$result);
		}
		if($param1=='delete-user-payments')
		{
			$condition=['id'=>$param2];
			$result=$this->db_model->globalDelete('payment',$condition);
			if($result)
			{
				$this->session->set_flashdata('msg','Data Deleted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/userManagement/user-payments/'.$param3);
		}
	}
	public function index()
	{
		$result['data']=$this->db_model->selectAll('project');
		$result['notice']=$this->db_model->globalSelect('notice');
		$result['due_Installment_Notify'] = $this->db_model->due_Installment_Notify();
		$result['cancellation_Notify'] = $this->db_model->cancellation_Notify();
		// print_r($result['cancellation_Notify']);die();
		$this->load->view('admin/admin-dashboard',$result);
	}

	public function installmentNotification()
	{

		$result['data'] = $this->db_model->due_Installment_Notify();
		$this->load->view('admin/notification-installment',$result);
	}
	public function cancellationNotification($value='')
	{
		$result['data'] = $this->db_model->cancellation_Notify();
		$this->load->view('admin/cancellation-installment',$result);
	}
	public function buildingMgmt($param1='',$param2='')
	{
		if($param1=='opn')
		{
			$result['data']=$this->db_model->selectAll('project');
			$this->load->view('admin/add-project',$result);
		}
		if($param1=='add')
		{
			$data=$_POST;
			$result=$this->db_model->globalInsert('project',$data);
			//echo '<pre>'; print_r($data); exit;
			if($result)
			{
				$this->session->set_flashdata('msg','Building Inserted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			else
			{
				$this->session->set_flashdata('msg','Form Not Submitted ! Try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			return redirect('real1/buildingMgmt/opn');
		}
		if($param1=='del')
		{
			$condition=array('id'=>$param2);
			$result=$this->db_model->globalDelete('project',$condition);
			if($result)
			{
				$this->db_model->globalDelete('flat',['building_id'=>$param2]);
				$this->session->set_flashdata('msg','Building Deleted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/buildingMgmt/opn');
		}
		if($param1=='edt')
		{
			$condition=array('id'=>$param2);
			$result['updData']=$this->db_model->selectRow('project',$condition);
			$result['data']=$this->db_model->selectAll('project');
			$this->load->view('admin/add-project',$result);
		}
		if($param1=='upd')
		{
			$data=$_POST;
			$condition=array('id'=>$param2);
			$result=$this->db_model->globalUpdate('project',$condition,$data);
			if($result)
			{
				$this->session->set_flashdata('msg','Building Updated Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/buildingMgmt/opn');
		}
	}
	public function siteMgmt($param1='',$param2='')
	{
		
		if($param1=='del')
		{
			$condition=array('id'=>$param2);
			$result=$this->db_model->globalDelete('sites',$condition);
			if($result)
			{
				$this->db_model->globalDelete('flat',['building_id'=>$param2]);
				$this->session->set_flashdata('msg','Site Deleted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/explore/add-site');
		}
		
	}
	public function ajaxSelect($param1='',$param2='')
	{
		$data=$_POST;
		$res=$this->db->get_where('flat',array('building_id'=>$data['building_id'],'flat_num'=>$data['flat_num']))->result_array();
		echo count($res);
	}
		public function flatMgmt($param1='',$param2='',$param3='')
	{
		if($param1=='opn')
		{
			$condition=array('id'=>$param2);
			$result['data']=$this->db_model->selectRow('project',$condition);
			$this->load->view('admin/add_flat',$result);
		}
		
		if($param1=='sel')
		{
			$result['data']=$this->db_model->selectAll('project');
			$this->load->view('admin/select-project',$result);
		}

		if($param1=='add')
		{
			$data=$_POST;
			$data['status']=0;
			$date=$data['date'];
			$dateForm=new DateTime($date);
			$data['date']=$dateForm->format('Y-m-d');
			$pre=strtoupper($data['prefix']);
			$data['flat_type'] = strtoupper($data['prefix']);
			unset($data['prefix']);
			$data['f_num']=$data['flat_num'];
			for ($i=1; $i <= $data['same_flat']; $i++)
			{
				$check=$pre.$data['f_num'];
				$valid=$this->db_model->rowCount('flat',['building_id'=>$data['building_id'],'flat_type'=>$data['flat_type']]);
				if($valid>0)
				{
					$row=$this->db->select_max('f_num')->get('flat')->row_array();
					
					$rowNum=$this->db_model->rowCount('flat',['building_id'=>$data['building_id'],'flat_type'=>$data['flat_type']]);

					$n=$rowNum+1;
					$data['flat_num']=$pre.$n;
					$data['f_num']=$n;
				}else
				{
					$data['flat_num']=$check;
				}
				$result=$this->db_model->globalInsert('flat',$data);
				$data['f_num']++;
			}
			if($result)
			{
				$this->session->set_flashdata('msg','Flat Inserted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			else
			{
				$this->session->set_flashdata('msg','Flat Not Submitted ! Try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			return redirect('real1/flats/list/'.$data['building_id']);
		}

		if($param1=='del')
		{
			$condition=array('id'=>$param3,'building_id'=>$param2);
			$result=$this->db_model->globalDelete('flat',$condition);
			$this->db_model->globalDelete('payment',['flat_id'=>$param3]);
			$this->db_model->globalDelete('flat_registration',['flat_id'=>$param3]);
			$this->db_model->globalDelete('commission',['flat_id'=>$param3]);
			if($result)
			{
				$this->session->set_flashdata('msg','Flat Deleted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/flats/list/'.$param2);
		}
		if($param1=='edt')
		{
			$condition=array('id'=>$param3,'building_id'=>$param2);
			$result['updData']=$this->db_model->selectRow('flat',$condition);
			//echo"<pre>";print_r($result);exit;
			$this->load->view('admin/update_flat',$result);
		}
		if($param1=='upd')
		{
			$data=$_POST;
			//echo '<pre>'; print_r($data); exit;
			$condition=array('id'=>$data['id'],'building_id'=>$data['building_id']);
			$result=$this->db_model->globalUpdate('flat',$condition,$data);
			if($result)
			{
				$this->session->set_flashdata('msg','Flat Updated Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/flats/list/'.$data['building_id']);
		}
	}
	public function flatReg($param1='',$param2='',$param3='')
	{
		if($param1=='regopn')
		{
			$condition=array('id'=>$param2);
			$result['flat']=$this->db_model->selectRow('flat',$condition);
			$this->load->view('admin/flat_registration',$result);
		}
		if($param1=='regsub')
		{
			$condition=array('flat_id'=>$_POST['flat_id'],'building_id'=>$_POST['building_id'],'status'=>1);
			$dltCon=array('flat_id'=>$_POST['flat_id'],'building_id'=>$_POST['building_id'],'status'=>0);
			$condition1=array('id'=>$_POST['flat_id']);
			$this->db_model->globalDelete('flat_registration',$dltCon);
			$res=$this->db_model->globalSelect('flat_registration',$condition);
			
			//echo '<pre>'; print_r($res); exit;
			if(count($res)>0)
			{
				$this->session->set_flashdata('msg','This Flat is already Alloted ! Try Another');
				$this->session->set_flashdata('msg_class','alert-danger');
				redirect('real1/flats/list/'.$_POST['building_id']);
			}else
			{
				$_POST['registration']=$this->db_model->registrationNumber();
				$_POST['password']= $this->db_model->passwordsuful();
				$_POST['status']=0;
				$_POST['booking_status']=0;
				$_POST['registration_date']=$this->input->post('registration_date');
				//print_r($_POST['registration_date']);exit();
				$_POST['next_due_date']= date('Y-m-d',strtotime('+180 days',strtotime(date('Y-m-d'))));
				$insertid=$this->db_model->globalInsert('flat_registration',$_POST);
				if($insertid)
				{
					$condition=array('id'=>$insertid);
					$result['userData']=$this->db_model->selectRow('flat_registration',$condition);
					$customer = $result['userData'];

					$data['building_id'] = $customer['building_id'];
					$data['flat_id'] = $customer['flat_id'];
					$data['flat_user_id'] = $insertid;
					$data['pay_mode'] = 'Cash';
					$data['pay_date'] = $_POST['registration_date'];
					$data['pay_amount'] = $customer['booking_amount'];
					$data['trnx']=$this->db_model->transactionNumber();
					$data['sponcer'] = $customer['introducer'];
					$data['registration'] = $customer['registration'];
					$data['inst_num'] = 'bookingAmt';
					$data['inst_amt'] = $customer['booking_amount'];
					
					$amt = $customer['booking_amount'];

					$condition1=array('id'=>$data['flat_id']);
					$this->db_model->globalUpdate('flat',$condition1,array('booking_status'=>1));
					
					$insertpayid=$this->db_model->globalInsert('payment',$data);
					if($insertpayid)
					{
					    $data['installment_id'] = '';
						$this->commission_model->commission($data,$amt);						
					}


					// $msg="Dear ".$customer['name']." Booking Confirmed, Your Login ID ".$customer['registration']." and Password is : ".$customer['password']." http://prayasinfra.com/";
					// $this->db_model->sendSms($customer['mobile'],$msg);

					redirect('control/getData/flat_registration/'.$insertid.'/flat_booking_done');
				}else
				{
					$this->session->set_flashdata('msg','Action Failed! try Again');
					$this->session->set_flashdata('msg_class','alert-danger');
					redirect('real1/buildingMgmt/opn/'.$_POST['flat_id']);
				}
			}
		}
		if($param1=='pay')
		{
			$data=$_POST;
			
			if($data['pay_mode']=='Cash')
			{
				$amt=$data['pay_amount_down'];
				$data['pay_amount']=$data['pay_amount_down'];
				
				unset($data['rtgs_num']);
				unset($data['rtgs_detail']);
				unset($data['rtgs_trns_date']);
				unset($data['rtgs_pay_amount']);
				unset($data['pay_amount_down']);

				// unset($data['pay_amount']);
				unset($data['cheque_num']);
				unset($data['cheque_detail']);
				unset($data['trns_date']);
			}
			elseif ($data['pay_mode']=='Cheque') 
			{
				unset($data['rtgs_num']);
				unset($data['pay_amount_down']);
				unset($data['rtgs_detail']);
				unset($data['rtgs_trns_date']);
				unset($data['rtgs_pay_amount']);

				$amt=0;
				foreach ($data['pay_amount'] as $key => $value)
				{
					$amt=$amt+$value;
				}
				$data['cheque_num']=implode(',',$data['cheque_num']);
				$data['cheque_detail']=implode(',',$data['cheque_detail']);
				$data['pay_amount']=implode(',',$data['pay_amount']);
				$data['trns_date']=implode(',',$data['trns_date']);
			}
			else
			{

				unset($data['pay_amount']);
				unset($data['pay_amount_down']);
				unset($data['cheque_num']);
				unset($data['cheque_detail']);

				$data['cheque_num']=$data['rtgs_num'];
				$data['cheque_detail']=$data['rtgs_detail'];
				$data['trns_date']=$data['rtgs_trns_date'];
				$data['pay_amount']=$data['rtgs_pay_amount'];

				$amt=$data['rtgs_pay_amount'];

				unset($data['rtgs_num']);
				unset($data['rtgs_detail']);
				unset($data['rtgs_trns_date']);
				unset($data['rtgs_pay_amount']);

			}
			// echo "<pre>"; print_r($data); die;
			$data['trnx']=$this->db_model->transactionNumber();
			if(isset($data['emi']) && $data['emi']=='yes')
			{
				$left=($data['grand_total']-$data['discount']-$data['specialdiscount']+$data['plc']+$data['dev_charg'])-$amt;
				$curDate=date_create($data['pay_date']);
				date_add($curDate,date_interval_create_from_date_string("1 Month"));
				$inst['due_date']= date_format($curDate,"Y-m-d");
				for ($i=1; $i <= $data['emi_month']; $i++)
				{
					$due=date_create($inst['due_date']);
					date_add($due,date_interval_create_from_date_string("1 Month"));
					$inst['next_due_date']= date_format($due,"Y-m-d");
					$inst['inst_num']=$i;
					$inst['flat_user_id']=$data['flat_user_id'];
					$inst['flat_id']=$data['flat_id'];
					$inst['grand_total']=$data['grand_total'];
					$inst['registration']=$data['registration'];
					$inst['sponcer']=$data['sponcer'];
					$inst['status']=0;
					$inst['trnx']=$this->db_model->transactionNumber();
					$inst['emi']=round($left/$data['emi_month']);
					$this->db_model->globalInsert('installment',$inst);
					//echo '<pre>'; print_r($inst);
					$inst['due_date']=$inst['next_due_date'];
				}
			}
			//echo '<pre>'; print_r($data); exit;
			$date=$data['pay_date'];
			$dateForm=new DateTime($date);
			$data['pay_date']=$dateForm->format('Y-m-d');
			$condition1=array('id'=>$_POST['flat_id']);
			$this->db_model->globalUpdate('flat',$condition1,array('status'=>1));
			$this->db_model->globalUpdate('flat_registration',['id'=>$data['flat_user_id']],array('emi'=>'yes','discount'=>$data['discount'],'specialdiscount'=>$data['specialdiscount'],'plc'=>$data['plc'],'dev_charg'=>$data['dev_charg'],'status'=>1,'booking_status'=>1));
			$data['inst_amt']=$amt;
			$data['inst_num']='down';
			// echo "<pre>"; print_r($data); die;
			$insertid=$this->db_model->globalInsert('payment',$data);
			if($insertid)
			{
			    $data['installment_id'] = '';
				$this->commission_model->commission($data,$amt);
				return redirect('real1/printInvoice/'.$insertid);
			}else
			{
				return redirect('real1/flatReg/regopn/'.$data['flat_id']);
			}
		}
		if($param1=='search-by-cheque')
		{
			$res['pay']=$this->db_model->searchCheque(trim($_POST['cheque_num']));
			//echo '<pre>'; print_r($res); exit;
			if(count($res['pay'])>0)
			{
				$res['cheque']=trim($_POST['cheque_num']);
				$condition=array('id'=>$res['pay']['flat_user_id']);
				$res['userData']=$this->db_model->selectRow('flat_registration',$condition);
				$res['flat']=$this->db_model->selectRow('flat',array('id'=>$res['pay']['flat_id']));
				$res['project']=$this->db_model->selectRow('project',array('id'=>$res['pay']['building_id']));
				$condition1=array('building_id'=>$res['pay']['building_id'],'flat_id'=>$res['pay']['flat_id'],'flat_user_id'=>$res['pay']['flat_user_id']);
				$res['payment']=$this->db_model->globalSelect('payment',$condition1);
				//echo '<pre>'; print_r($res); exit;
				$this->load->view('admin/total_installments',$res);
			}else
			{
				$this->session->set_flashdata('msg','<u>'.$_POST['cheque_num'].'</u>'.' ' .'This Cheque Number Not Found, Try Another Cheque Number!');
				$this->session->set_flashdata('msg_class','alert-danger');
				redirect('real1/explore/search_by_cheque');
			}
		}
	}

	public function submitInstallment($param1='',$param2='')
	{
			$data=$_POST;
			echo "<pre>"; //print_r($data);die();
			$amt=$data['pay_amount'];
			$date=$data['pay_date'];
			$dateForm=new DateTime($date);
			$data['pay_date']=$dateForm->format('Y-m-d');
			$installment=$this->db_model->getWhere('installment',['id'=>$data['installment_id']]);

			if ($installment['emi']>$data['pay_amount']) {

				$this->db_model->installmentManageLow($installment,$data['pay_amount']);
				$inst['emi'] = $data['pay_amount'];
			}elseif ($installment['emi']<$data['pay_amount']) {
				$this->db_model->installmentManageHigh($installment,$data['pay_amount']);
				$inst['emi'] = $data['pay_amount'];
			}

			//echo "<pre>";print_r($data);
			 // die();

			$inst['pay_mode']= $data['pay_mode'];
			$inst['pay_date']=$data['pay_date'];
			$inst['time']=date('h:i:s A');
			$inst['status']=1;
			$this->db_model->globalUpdate('installment',['id'=>$data['installment_id']],$inst);
			$data['inst_amt']=$amt;
			$data['inst_num']=$installment['inst_num'];
			$data['trnx']=$installment['trnx'];
			$data['registration']=$installment['registration'];
			//echo '<pre>'; print_r($data); exit;
			$insertid=$this->db_model->globalInsert('payment',$data);
			

			if($insertid)
			{
			$this->db_model->globalUpdate('flat_registration',['id'=>$data['flat_user_id']],['next_due_date'=>date('Y-m-d',strtotime('+180 days',strtotime(date('Y-m-d'))))]);

			$customer=$this->db_model->getWhere('flat_registration',['id'=>$data['flat_user_id']]);
			$msg="Dear ".$customer['name']." Your installment No ".$data['inst_num']." has been submitted Successfully On date : ".$data['pay_date'];
			$this->db_model->sendSms($customer['mobile'],$msg);


			$this->commission_model->commission($data,$amt);
				return redirect('real1/printInvoice/'.$insertid);
			}else
			{
				return redirect('real1/flatReg/regopn/'.$data['flat_id']);
			}
	}

	public function printInvoice($param1='',$param2='')
	{
		//echo $param1;
		$res['payment']=$this->db_model->selectRow('payment',['id'=>$param1]);
		$res['flat']=$this->db_model->selectRow('flat',array('id'=>$res['payment']['flat_id']));
		$res['project']=$this->db_model->selectRow('project',array('id'=>$res['payment']['building_id']));
		$res['userData']=$this->db_model->selectRow('flat_registration',array('id'=>$res['payment']['flat_user_id']));
		if($param2=='print-booking-form')
		{
			$this->load->view('admin/print-booking',$res);
		}else
		{
			$this->load->view('admin/print-invoice',$res);
		}
		//echo '<pre>'; print_r($res); exit;
		//$this->load->view('admin/print-booking',$res);
	}
	public function paymentReport($param1='',$param2='')
	{
		$dateFrom=new DateTime($_POST['dateFrom']);
		$newdateFrom=$dateFrom->format('Y-m-d');
		$dateTo=new DateTime($_POST['dateTo']);
		$newdateTo=$dateTo->format('Y-m-d');
		$result['searchFor']=$_POST;
		if($_POST['building_id']=='All')
		{
			$condition=array('pay_date>='=>$newdateFrom,'pay_date<='=>$newdateTo);
		}else
		{
			$condition=array('pay_date>='=>$newdateFrom,'pay_date<='=>$newdateTo,'building_id'=>$_POST['building_id']);
		}
		$result['payReport']=$this->db_model->globalSelect('payment',$condition);
		$result['data']=$this->db_model->selectAll('project');
		$this->load->view('admin/payment_report',$result);
		//echo '<pre>'; print_r($result); exit;
	}

	public function totalpaymentReport($param1='',$param2='')
	{
		$dateFrom=new DateTime($_POST['dateFrom']);
		$newdateFrom=$dateFrom->format('Y-m-d');
		$dateTo=new DateTime($_POST['dateTo']);
		$newdateTo=$dateTo->format('Y-m-d');
		$result['searchFor']=$_POST;
		if($_POST['building_id']=='All')
		{
			$condition=array('pay_date>='=>$newdateFrom,'pay_date<='=>$newdateTo);
		}else
		{
			$condition=array('pay_date>='=>$newdateFrom,'pay_date<='=>$newdateTo,'building_id'=>$_POST['building_id']);
		}
		$result['payReport']=$this->db_model->globalSelect('payment',$condition);
		$result['data']=$this->db_model->selectAll('project');
		$this->load->view('admin/total_sell_report',$result);
		//echo '<pre>'; print_r($result); exit;
	}

	public function payInstallment($param1='',$param2='')
	{
		if($param1=='select-data')
		{
			$data=$_POST;
			
			$condition=array('building_id'=>$data['building_id'],'registration'=>$data['registration']);
			$res=$this->db_model->selectRow('flat_registration',$condition);
			if(empty($res))
			{
				$this->session->set_flashdata('msg','This Registration Number Not Found! Try Another User Registration No.');
				$this->session->set_flashdata('msg_class','alert-danger');
				redirect('real1/payInstallment');
			}else
			{
				$result['get_data']=$this->db_model->selectRow('flat_registration',$condition);
			
				$this->load->view('admin/installment-status',$result);
			}
		}else
		{
			$result['project']=$this->db_model->selectAll('project');
			//echo"<pre>";print_r($result); die;
			$this->load->view('admin/select_flat_for_installment',$result);
		}
	}

	public function notifydInstallment($installmentId='')
	{
		$condition=array('id'=>$installmentId);
		$result['get_data']=$this->db_model->selectRow('flat_registration',$condition);
		$this->load->view('admin/installment-status',$result);		
	}

	public function changeCancellation($installmentId='')
	{
		$condition=array('id'=>$installmentId);
		$result['get_data']=$this->db_model->selectRow('flat_registration',$condition);
		$this->load->view('admin/change-cancellation',$result);		
	}

	public function newcancelled_date($value='')
	{
		$data = $_POST;
		$data['next_due_date'] = $this->db_model->ymd($data['next_due_date']);

		$result=$this->db_model->globalUpdate('flat_registration',['id'=>$data['id']],['next_due_date'=>$data['next_due_date']]);
		if($result)
		{
			$this->session->set_flashdata('msg','Cancellation Date has been chang Successfully');
			$this->session->set_flashdata('msg_class','alert-success');
		}else
		{
			$this->session->set_flashdata('msg','Action Failed! try Again');
			$this->session->set_flashdata('msg_class','alert-danger');
		}

		redirect('real1');

	}



	public function cansalPlot($param1='',$param2='')
	{
		if($param1=='select-data')
		{
			$data=$_POST;
			//print_r($data); die;
			$condition=array('building_id'=>$data['building_id'],'registration'=>$data['registration']);
			$res=$this->db_model->selectRow('flat_registration',$condition);
			if(empty($res))
			{
				$this->session->set_flashdata('msg','This Registration Number Not Found! Try Another User Registration No.');
				$this->session->set_flashdata('msg_class','alert-danger');
				redirect('real1');
			}else
			{
				$res['userData']=$this->db_model->selectRow('flat_registration',$condition);
				$condition1=array('building_id'=>$data['building_id'],'flat_id'=>$res['userData']['flat_id'],'flat_user_id'=>$res['userData']['id']);
				
				$res['flat']=$this->db_model->selectRow('flat',array('id'=>$res['userData']['flat_id']));
				$res['project']=$this->db_model->selectRow('project',array('id'=>$data['building_id']));
				$project=$this->db_model->selectRow('project',array('id'=>$data['building_id']));
				$res['site']= $this->db_model->selectRow('sites',['id'=>$project['site_id']]);
				$res['payment']=$this->db_model->globalSelect('payment',$condition1);
				$this->load->view('admin/final-cancel-page',$res);
				
				// $this->load->view('admin/installment-status',$result);
			}
		}else
		{
			$this->session->set_flashdata('msg','This Registration Number Not Found! Try Again....');
			$this->session->set_flashdata('msg_class','alert-danger');
			redirect('real1');
		}
	}
	// if($param1=='get-flat-information')
	// {
	// 	$condition=array('building_id'=>$param2,'flat_id'=>$param3);
	// 	$res['userData']=$this->db_model->selectRow('flat_registration',$condition);
	// 	$condition1=array('building_id'=>$param2,'flat_id'=>$param3,'flat_user_id'=>$res['userData']['id']);
	// 	$res['flat']=$this->db_model->selectRow('flat',array('id'=>$param3));
	// 	$res['project']=$this->db_model->selectRow('project',array('id'=>$param2));
	// 	$project=$this->db_model->selectRow('project',array('id'=>$param2));
	// 	$res['site']= $this->db_model->selectRow('sites',['id'=>$project['site_id']]);
	// 	$res['payment']=$this->db_model->globalSelect('payment',$condition1);
	// 	$this->load->view('admin/total_installments',$res);
	// 	//echo '<pre>'; print_r($res['payment']); exit;
	// }

	public function paymentManagement($param1='',$param2='',$param3='')
	{
		if($param1=='edt')
		{
			//$condition=array('id'=>$param2);
			//$result['userData']=$this->db_model->selectRow('flat_registration',$condition);
			$result['payment']=$this->db_model->selectRow('payment',['id'=>$param2]);
			//echo '<pre>'; print_r($result); exit;
			$this->load->view('admin/payment-update',$result);
		}
		if($param1=='upd')
		{
			$data=$_POST;
			if($data['pay_mode']=='Cash')
			{

			}else
			{
				$data['cheque_num']=implode(',',$data['cheque_num']);
				$data['cheque_detail']=implode(',',$data['cheque_detail']);
				$data['pay_amount']=implode(',',$data['pay_amount']);
			}
			$condition=array('id'=>$param2);
			$result=$this->db_model->globalUpdate('payment',$condition,$data);
			if($result)
			{
				$this->session->set_flashdata('msg','Data Updated Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('real1/userManagement/user-payments/'.$data['flat_user_id']);
		}
	}
	public function flats($param1='',$param2='',$param3='')
	{
		if($param1=='list')
		{
			$result['project']=$this->db_model->selectRow('project',array('id'=>$param2));
			$result['flat']=$this->db_model->getFlats('flat',array('building_id'=>$param2));
			$result['flatTypes']=$this->db_model->flatType(['building_id'=>$param2]);

			//echo '<pre>'; print_r($result); exit;
			$this->load->view('admin/flat_list',$result);
		}
		if($param1=='get-flat-information')
		{
			$condition=array('building_id'=>$param2,'flat_id'=>$param3);
			$res['userData']=$this->db_model->selectRow('flat_registration',$condition);
			$condition1=array('building_id'=>$param2,'flat_id'=>$param3,'flat_user_id'=>$res['userData']['id']);
			$res['flat']=$this->db_model->selectRow('flat',array('id'=>$param3));
			$res['project']=$this->db_model->selectRow('project',array('id'=>$param2));
			$project=$this->db_model->selectRow('project',array('id'=>$param2));
			$res['site']= $this->db_model->selectRow('sites',['id'=>$project['site_id']]);
			$res['payment']=$this->db_model->globalSelect('payment',$condition1);
		//	echo '<pre>'; print_r($res); exit;
			$this->load->view('admin/total_installments',$res);
			//echo '<pre>'; print_r($res['payment']); exit;
		}
	}
	public function searchFlat($param1='',$param2='')
	{
		$data=$_POST;
		$condition=array('building_id'=>$data['building_id'],'flat_num'=>$data['flat_num']);
		$res['flat']=$this->db_model->selectRow('flat',$condition);
		if(empty($res['flat']))
		{
			$this->session->set_flashdata('msg','Flat Number does not exits! Try Another Flat No.');
			$this->session->set_flashdata('msg_class','alert-danger');
			redirect('real1/exploreData/project/search-flat');
		}else
		{
			$this->load->view('admin/flat-details',$res);
		}
	}
	public function projectReport($param1='',$param2='')
	{
		$res['data']=$this->db_model->getFlats('flat',['building_id'=>$param1]);
		$res['project']=$this->db_model->selectRow('project',['id'=>$param1]);
		$this->load->view('admin/project-report',$res);
		//echo '<pre>'; print_r($res);
	}
	public function passwordConfirmation($param1='',$param2='')
	{
		$log=$this->session->userdata('loggedUser');
		if($log['password']==$_POST['password'])
		{
			echo 1;
		}else
		{
			echo 0;
		}
		//$this->load->view('admin/password-confirmation');
	}

	public function changePassword($param1='',$param2='')
	{
		$log=$this->session->userdata('loggedUser');
		if($log['password']==$_POST['old_password'])
		{
			$data=array('password'=>$_POST['new_password']);
			$condition=array('id'=>$log['id']);
			$result=$this->db_model->globalUpdate('user',$condition,$data);
			if($result)
			{
				$log['password']=$_POST['new_password'];
				$this->session->set_userdata('loggedUser',$log);
				$this->session->set_flashdata('msg','Your Password Successfully Updated');
				$this->session->set_flashdata('msg_class','alert-success');
				return redirect('real');
			}
		}else
		{
			$this->session->set_flashdata('msg','Your Old Password do not Match! Try Again');
			$this->session->set_flashdata('msg_class','alert-danger');
			redirect('real1/explore/change-password/');
		}
	}

	public function dailyReport($param1='',$param2='')
	{
		if($param1=='today')
		{
			$condition=array('entry_date'=>date('Y-m-d'));
			$result['data']=$this->db_model->globalSelect('expense_entry',$condition);
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
			$result['data']=$this->db_model->globalSelect('expense_entry',$condition);
			$this->load->view('admin/daily-report',$result);
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
			$result=$this->db_model->globalInsert('expense_entry',$data);
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
			return redirect('real1/expenseManagement');
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
			$result['branchList']=$this->db_model->globalSelect('branch');
			$result['category']=$this->db_model->globalSelect('expense_category');
			$result['expense_report']=$this->db_model->globalSelect('expense_entry',$condition);
			//echo '<pre>'; print_r($result); die;
			$result['data']=$this->db_model->globalSelect('expense_entry');
			$this->load->view('admin/expense_management',$result);
		}else
		{
			$result['data']=$this->db_model->globalSelect('expense_entry');
			$result['category']=$this->db_model->globalSelect('expense_category');
			$this->load->view('admin/expense_management',$result);
		}
	}

	public function commissionStatus($param1='',$param2='')
	{
		$result['searchData']=$_POST;
		$data=$_POST;
		$uid=strtoupper($data['user_id']);
		$to= $this->db_model->ymd($data['dateTo']);
		$from= $this->db_model->ymd($data['dateFrom']);
		$condition= array('deposit_date>='=>$from,'deposit_date<='=>$to,'agent_id'=>$uid);
		$result['data']=$this->db_model->globalSelect('commission_new',$condition);
		//echo "<pre>"; print_r($result); die;
		$this->load->view('admin/commission-status',$result);
	}

	/*public function commissionStatus($param1='',$param2='')
	{
		$result['searchData']=$_POST;
		$data=$_POST;
		$uid=strtoupper($data['user_id']);
		$to= $this->db_model->ymd($data['dateTo']);
		$from= $this->db_model->ymd($data['dateFrom']);
		$condition= array('date>='=>$from,'date<='=>$to,'user_id'=>$uid);
		$result['data']=$this->db_model->globalSelect('commission',$condition);
		$this->load->view('admin/commission-status',$result);
	}*/

	public function payCommission($param1='',$param2='')
	{
		if(!empty($_POST['payId']))
		{
			$data=$_POST;
			//echo "<pre>"; print_r($_POST);
			$amt=0;
			foreach ($_POST['payId'] as $key => $value)
			{
				$res=$this->db_model->getWhere('commission',['id'=>$value]);
				$amt=$amt+$res['net'];
			}
			$commId=implode(',',$data['payId']);
			echo form_open('real1/payout'); ?>
			<table class="table table-bordered">
				<input type="hidden" name="commission_id" value="<?=$commId;?>">
				<input type="hidden" name="date_from" value="<?=$this->db_model->ymd($data['from']);?>">
				<input type="hidden" name="date_to" value="<?=$this->db_model->ymd($data['to']);?>">
				<input type="hidden" name="user_id" value="<?=$data['user_id'];?>">
				<input type="hidden" name="amount" value="<?=$amt;?>">
				<tr style="background-color: lavender;">
					<th class="text-center" colspan="2">Payment Summary</th>
				</tr>
				<tr>
					<td><b> From : </b><?=$data['from'];?></td>
					<td><b> To : </b><?=$data['to'];?></td>
				</tr>
				<tr>
					<td><b> User ID : </b><?=$data['user_id'];?></td>
					<td><b> Transactions : </b><?=count($data['payId']);?></td>
				</tr>
				<tr style="background-color: lavender;">
					<td><b>Max Total : </b></td>
					<td><b> <?=$amt; ?></b></td>
				</tr>
			</table>
				<button type="submit" onclick="return confirm('Are you Sure to Pay')" class="btn btn-primary pull-right"> Submit </button>
			</form>
			<?php
		}else
		{
			echo "No Data Seleted";
		}
		
	}

	public function payout($param1='',$param2='')
	{
		$data=$_POST;
		$data['date']=date('Y-m-d');
		$data['time']=date('h:i:s A');
		$data['trnx']=$this->db_model->transactionNumber();
		//echo "<pre>"; print_r($data);
		$res=$this->db_model->globalInsert('paid_commission',$data);
		if($res)
		{
			$commId=explode(',',$data['commission_id']);
			foreach ($commId as $key => $value)
			{
				$this->db_model->globalUpdate('commission',['id'=>$value],['status'=>1]);
			}
			$this->session->set_flashdata('msg','Commission Paid Successfully');
			$this->session->set_flashdata('msg_class','alert-success');
			return redirect('control/getData/paid_commission/'.$res.'/print-pay-commission');
		}
		else
		{
			$this->session->set_flashdata('msg','Data Inserting Failed ! Try Again');
			$this->session->set_flashdata('msg_class','alert-success');
			return redirect('control/explore/commission-status');
		}
	}


	public function landMgmt($param1='',$param2='',$param3='')
	{
		if($param1=='opn')
		{
			$this->load->view('admin/add_land');
		}
		if($param1=='add')
		{


			$data=$_POST;
			$data['registration']=$this->db_model->landRegistrationNumber();
		    $data['password']= $this->db_model->passwordsuful();

			$data['status']=1;
			$date=$data['registration_date'];
			$dateForm=new DateTime($date);
			$data['registration_date']=$dateForm->format('Y-m-d');
			// echo "<pre>";print_r($data); die();
			$insertid=$this->db_model->globalInsert('land',$data);

			if($insertid)
			{
				$condition=array('id'=>$insertid);
				$result['userData']=$this->db_model->selectRow('land',$condition);

				$customer = $result['userData'];
				$msg="Dear ".$customer['name']." Booking Confirmed, Your Login ID ".$customer['registration']." and Password is : ".$customer['password']." http://prayasinfra.com/";
				$this->db_model->sendSms($customer['mobile'],$msg);

				redirect('control/getData/land/'.$insertid.'/land_registration_payment');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
				redirect('real1/landMgmt/opn/');
			}
		
		}
		if ($param1=='pay') {
			$data = $_POST;

			$left=($data['grand_total']-$data['pay_amount']);
			$curDate=date_create($data['pay_date']);
			date_add($curDate,date_interval_create_from_date_string("1 Month"));
			$inst['due_date']= date_format($curDate,"Y-m-d");
			for ($i=1; $i <= $data['emi_month']; $i++)
			{
				$due=date_create($inst['due_date']);
				date_add($due,date_interval_create_from_date_string("1 Month"));
				$inst['next_due_date']= date_format($due,"Y-m-d");
				$inst['inst_num']=$i;
				$inst['grand_total']=$data['grand_total'];
				$inst['land_id']=$data['land_id'];
				$inst['registration']=$data['land_registration'];
				$inst['status']=0;
				$inst['trnx']=$this->db_model->transactionNumber();
				$inst['emi']=round($left/$data['emi_month']);
				$this->db_model->globalInsert('land_installment',$inst);
				// echo '<pre>'; print_r($inst);
				$inst['due_date']=$inst['next_due_date'];
			}

			$data['trnx']=$this->db_model->transactionNumber();
			$date=$data['pay_date'];
			$dateForm=new DateTime($date);
			$data['pay_date']=$dateForm->format('Y-m-d');			
			$data['inst_amt']=$data['pay_amount'];
			$data['grand_total']=$data['grand_total'];
			$data['inst_num']='down';
			// echo "<pre>"; print_r($data); die;
			$insertid=$this->db_model->globalInsert('land_payment',$data);
			if($insertid)
			{
			    $data['installment_id'] = '';
				return redirect('real1/printLandInvoice/'.$insertid);
			}



			//  echo "<pre>";print_r($data);die();
			// die();
			
		}

	}


	public function printLandInvoice($param1='',$param2='')
	{
		//echo $param1;
		$res['payment']=$this->db_model->selectRow('land_payment',['id'=>$param1]);		
		$res['userData']=$this->db_model->selectRow('land',array('id'=>$res['payment']['land_id']));
		// echo "<pre>";print_r($res); die();
		if($param2=='print-booking-form')
		{
			$this->load->view('admin/print-land-invoice',$res);
		}else
		{
			$this->load->view('admin/print-land-invoice',$res);
		}
	}


	public function payLandInstallment($param1='',$param2='')
	{
			//$data=$_POST;
		// print_r($param1); die;
		$condition=array('id'=>$param1);
		$res=$this->db_model->selectRow('land',$condition);
		if(empty($res))
		{
			$this->session->set_flashdata('msg','This Registration Number Not Found! Try Another User Registration No.');
			$this->session->set_flashdata('msg_class','alert-danger');
			redirect('control/exploreData/land/land_mgmt');
		}else
		{
			$result['get_data']=$this->db_model->selectRow('land',$condition);
			$this->load->view('admin/land-installment-status',$result);
		}
	}


	public function submitLandInstallment($param1='',$param2='')
	{
			$data=$_POST;
			// echo "<pre>";print_r($data);die();
			$amt=$data['pay_amount'];
			$date=$data['pay_date'];
			$dateForm=new DateTime($date);
			$data['pay_date']=$dateForm->format('Y-m-d');
			$installment=$this->db_model->getWhere('land_installment',['id'=>$data['installment_id']]);
			$inst['pay_date']=$data['pay_date'];
			$inst['time']=date('h:i:s A');
			$inst['status']=1;
			$this->db_model->globalUpdate('land_installment',['id'=>$data['installment_id']],$inst);
			$data['inst_amt']=$amt;
			$data['inst_num']=$installment['inst_num'];
			$data['trnx']=$installment['trnx'];
			$data['land_registration']=$installment['registration'];
			$data['land_id']=$installment['land_id'];
			$data['grand_total']=$installment['grand_total'];
			$data['trnx']=$installment['trnx'];
			// echo '<pre>'; print_r($data); exit;
			$insertid=$this->db_model->globalInsert('land_payment',$data);
			if($insertid)
			{
				return redirect('real1/printLandInvoice/'.$insertid);
			}else
			{
				return redirect('real1');
			}
	}



	public function flat_cancelled($value='')
	{
		$this->load->model('Cancelation_model');
		$data = $_POST;
		$this->Cancelation_model->flat_cancelled($data);
		return redirect('real1');
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
		return redirect('real1/explore/'.$table.'/'.$page);	
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
}