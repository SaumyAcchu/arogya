<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr extends MY_Controller {
	public function __construct()
	{
		parent:: __construct();
		if($this->loggedEmp['access_level']!='hr')
		{ return redirect('employee'); }
		$this->load->model('db_model');
		$this->load->model('commission_model');
	}

	public function index()
	{
		$this->load->view('hr/hr-dashboard');
	}

	public function profile($value='')
	{
		$this->load->view('hr/hr-profile');
	}

	public function attendance($value='')
	{
		$this->load->view('hr/attendance');
	}

	public function attendanceDate($param1='')
	{
		if($param1!='')
		{ $acc=$param1; }else{ $acc=$_POST['employee_id']; }
		$res['user']=$this->db_model->getWhere('employee',['employee_id'=>$acc]);
		$atDate =	$this->db_model->dbDateFormat($_POST['date']);
		$res['attendance']=$this->db_model->getWhere('employee_attendences',['employee_id'=>$acc,'date'=>$atDate]);
		if($res['user'])
		{	
			$res['date']=$_POST['date'];
		    if ($res['attendance']) {
		    	$this->session->set_flashdata('msg','Attendance on this Date is alrady submited');
		    	$this->session->set_flashdata('msg_class','alert-danger');		    	
		    }
			$res['attendanceType'] = $this->db_model->selectAll('attendence_type');
			$this->load->view('hr/attendance',$res);
		}else
		{
			$this->session->set_flashdata('msg','Employee Id Not Found Try Another.');
			$this->session->set_flashdata('msg_class','alert-success');
			return redirect('hr/attendance');
		}
	}

	public function attendanceSubmit($value='')
	{	
		$data = $_POST;
		$data['date'] = $this->db_model->dbDateFormat($_POST['date']);
		

		$result=$this->db_model->getWhere('employee',['employee_id'=>$_POST['employee_id']]);


		if (($result['salary']) > 0) {
				$data['salary'] = intval($result['salary'])/28;
			  }else{
				$data['salary'] = 0;	
			}

		// echo "<pre>";print_r($data['daySalary']); die();

		$result=$this->db_model->globalInsert('employee_attendences',$data);
		$msgatd = 'Employee Id '.$data["employee_id"].' Attendance is submit on date '.$_POST['date'];
		
		$this->session->set_flashdata('msg',$msgatd);
		$this->session->set_flashdata('msg_class','alert-success');
		return redirect('hr/attendance');	
		
	}

	public function attendanceUpdate($id='')
	{	
		$data = $_POST;
		$result=$this->db_model->globalUpdate('employee_attendences',['id'=>$id],$data);
		
		$msgatd = 'Attendance is Updated Successfully';
		$this->session->set_flashdata('msg',$msgatd);
		$this->session->set_flashdata('msg_class','alert-success');
		return redirect('hr/attendance');	

	}


	public function salaryDetails($value='')
	{
		$this->load->view('hr/salaryDetails');
	}

	public function paySalary($value='')
	{
		$this->load->view('hr/paySalary');
	}

	public function salaryReport($param1='',$param2='')
	{
		$dateFrom=new DateTime($_POST['dateFrom']);
		$newdateFrom=$dateFrom->format('Y-m-d');
		$dateTo=new DateTime($_POST['dateTo']);
		$newdateTo=$dateTo->format('Y-m-d');
		$result['searchFor']=$_POST;
		
		$condition=array('date>='=>$newdateFrom,'date<='=>$newdateTo,'employee_id'=>$_POST['employee_id']);

		$result['salaryReport']=$this->db_model->globalSelect('employee_attendences',$condition);
		$this->load->view('hr/salaryDetails',$result);
		// echo '<pre>'; print_r($result); exit;
	}

	public function salaryPayed($value='')
	{	



		$dateFrom=new DateTime($_POST['dateFrom']);
		$newdateFrom=$dateFrom->format('Y-m-d');
		$newdateTo = date("Y-m-t", strtotime($_POST['dateFrom']));
		
		$result['searchFor']=$_POST;
		
		$condition=array('date>='=>$newdateFrom,'date<='=>$newdateTo,'employee_id'=>$_POST['employee_id']);

		$result['salaryReport']=$this->db_model->globalSelect('employee_attendences',$condition);
		// echo "<pre>";print_r($result['salaryReport']); die();
		$this->load->view('hr/paySalary',$result);

	}

	public function ganrateSalry($value='')
	{	
		$data = $_POST;
		$data['date'] = date('Y-m-d');

		$dateFrom=new DateTime($data['generat_date']);
		$data['generat_date']=$dateFrom->format('Y-m-d');
		// echo "<pre>";
		//print_r($data);
		// die();

		$salry_id = $this->db_model->globalInsert('salary',$data);
		
		if (isset($salry_id)) {
			return redirect('hr/salerySlip/'.$salry_id);
		}
		

	}

	public function salerySlip($id='')
	{
			$salaryDtl=$this->db_model->selectRow('salary',['id'=>$id]);
			$result['employeeDtl']=$this->db_model->getWhere('employee',['employee_id'=>$salaryDtl['emp_id']]);
			$result['salaryDtl'] = $salaryDtl;
			// echo "<pre>";print_r($result);
			$this->load->view('hr/payslip',$result);
		// die();
	}

	public function chkAttendance($value='')
	{
		$this->load->view('hr/chkAttendance');
	}

	public function attendanceList($param1='',$param2='')
	{
		$dateFrom=new DateTime($_POST['dateFrom']);
		$newdateFrom=$dateFrom->format('Y-m-d');
		$dateTo=new DateTime($_POST['dateTo']);
		$newdateTo=$dateTo->format('Y-m-d');
		$result['searchFor']=$_POST;		
		$condition=array('date>='=>$newdateFrom,'date<='=>$newdateTo,'employee_id'=>$_POST['employee_id']);

		$result['salaryReport']=$this->db_model->globalSelect('employee_attendences',$condition);
		$this->load->view('hr/chkAttendance',$result);
		//echo '<pre>'; print_r($result); exit;
	}

	public function explore($param1='',$param2='')
	{
		$this->load->view('hr/'.$param1);
	}
	public function exploreData($table='',$viewpage='')
	{
		$result['data']=$this->db_model->selectAll($table);
		$this->load->view('hr/'.$viewpage,$result);
	}
	public function exploreDataWith($table='',$viewpage='')
	{
		if (isset($_POST['project_id'])) {
		$result['data']=$this->db_model->globalSelect($table,['building_id'=>$_POST['project_id']]);
		}else{
		$result['data']=$this->db_model->selectAll($table);
		}
		$this->load->view('hr/'.$viewpage,$result);
	}

	public function registration($param1='',$param2='')
	{
		if($param1=='sub')
		{
		    if (isset($_POST['password2'])) {
			unset($_POST['password2']);
			}
			
			$data=$_POST;
			
			// echo "<pre>"; print_r($data); die();
			
			$data['address'] = $data['location'].', '.$data['city'].', State -'.$data['state'].', Pin No.'.$data['pin'];			
			if(trim($data['name'])=='' || trim($data['password'])=='')
			{
				$this->setMessage('0','Required fields must not be empty, Please fill the essential details.');
				return redirect('hr/registration');
			}

		    if (isset($_POST['mobile'])) {				
				$result=$this->db_model->getWhere('employee',['mobile'=>$data['mobile']]);
				if (!empty($result)) {
					$this->setMessage('0','Mobile Number is allready registrad..! Try Again ..');
					return redirect('hr/registration');
				}
			}

			if (isset($_POST['adhar'])) {
				$result=$this->db_model->getWhere('employee',['adhar'=>$data['adhar']]);
				if (!empty($result)) {
					$this->setMessage('0','Adhar Number is allready registrad..! Try Again ..');
					return redirect('hr/registration');	
				}
			}

			
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
			$data['wallet']=0;
			$data['reg_time']=date('h:i:s A');
			
			$res=$this->db_model->employeeRegistration($data);
			
			if($res)
			{
				$que=$this->db_model->getWhere('employee',['id'=>$res]);
				$tomail=$this->db_model->getWhere('employee',['id'=>$res]);
				if($tomail['mobile']=='')
					{
						
					}else
					{
						 	$msg="Dear ".$tomail['name']." Registration Successful, Your Emp ID ".$tomail['employee_id']." and Password is : ".$tomail['password']." http://srgroup.org.in/";
						//$this->db_model->sendSms($tomail['mobile'],$msg);
						
					}
				$this->setMessage('1','Congratulation, Registration Successful.');
				$str='employee-registration';
				return redirect('hr/explore/'.$str);
			}
			else
			{
				$this->setMessage('0','Registration Failed, Try Again.');
				return redirect('hr/explore/employee-registration');
			}
		}else
		{
			$this->load->view('hr/employee-registration');
		}
	}



	

	public function getData($table='',$id='',$page='')
	{
		$result['get_data']=$this->db_model->getWhere($table,['id'=>$id]);
		$this->load->view('hr/'.$page,$result);
	}

	public function departMgmt($param1='',$param2='')
	{
		
		if($param1=='del')
		{
			$condition=array('id'=>$param2);
			$result=$this->db_model->globalDelete('departments',$condition);
			if($result)
			{
				$this->session->set_flashdata('msg','Departments Deleted Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('hr/explore/department_management');
		}
		
	}


	public function passwordConfirmation($param1='',$param2='')
	{
		$log=$this->session->userdata('loggedEmp');
		if($this->loggedEmp['password']==$_POST['password'])
		{
			echo 1;
		}else
		{
			echo 0;
		}
		//$this->load->view('admin/password-confirmation');
	}


	public function empManagement($param1='',$param2='',$param3='')
	{
		if($param1=='edt')
		{
			$result['user']=$this->db_model->selectRow('employee',['id'=>$param2]);
			$this->load->view('hr/update-employee-data',$result);
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
			$result=$this->db_model->globalUpdate('employee',$condition,$data);
			if($result)
			{
				$this->session->set_flashdata('msg','Associate Data Updated Successfully');
				$this->session->set_flashdata('msg_class','alert-success');
			}else
			{
				$this->session->set_flashdata('msg','Action Failed! try Again');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('hr/exploreData/employee/employee-management');
		}
	}

	public function changePassword($param1='')
	{
		if($param1=='change')
		{
			$data=$_POST;
			
			if($data['old_password']==$this->loggedEmp['password'])
			{
				$res=$this->db_model->globalUpdate('employee',['employee_id'=>$this->loggedEmp['employee_id']],['password'=>$data['new_password']]);
				if($res)
				{
					$this->session->unset_userdata('loggedEmployee');
					$this->setMessage('1','Password Changed Successfully. Please Login with New Password');
					return redirect('hr');
				}else
				{
					$this->setMessage('0','Action Failed try Again');
					return redirect('hr/changePassword');
				}

			}else
			{
				$this->setMessage('0','Your Old Password not Matched.');
				return redirect('hr/changePassword');
			}
		}else
		{
			$this->load->view('hr/change-password');
		}
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
