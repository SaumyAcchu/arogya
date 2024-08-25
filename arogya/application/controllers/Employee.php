<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {
	public function __construct()
	{
		parent:: __construct();
		if(!$logged=$this->session->userdata('loggedEmployee'))
		{ return redirect('login/employee'); }
		if($this->loggedEmp['access_level']=='hr')
		{ return redirect('hr'); }
		if($this->loggedEmp['access_level']=='accountant')
		{ return redirect('accountant'); }

		$this->load->model('db_model');
		$this->load->model('Commission_model');
	}

	public function index()
	{
		$this->load->view('employee/employee-dashboard');
	}

	public function profile($value='')
	{

		$this->load->view('employee/employee-profile');
	}

	public function attendance($value='')
	{
		//echo date('Y-m-1');
		// print_r($_POST); die();
		if (empty($_POST)){
			$condition1=array('dateTo'=>date('Y-m-1'),'dateFrom'=>date('Y-m-d'),'employee_id'=>$this->loggedEmp['employee_id']);
			$result['searchFor'] = $condition1;
			$condition=array('date>='=>date('Y-m-1'),'date<='=>date('Y-m-d'),'employee_id'=>$this->loggedEmp['employee_id']);
			$result['salaryReport']=$this->db_model->globalSelect('employee_attendences',$condition);
			
		}else{


			$dateFrom = new DateTime($_POST['dateFrom']);
			$newdateFrom=$dateFrom->format('Y-m-d');
			$dateTo = new DateTime($_POST['dateTo']);
			$newdateTo=$dateTo->format('Y-m-d');
			$result['searchFor']=$_POST;		
			$condition=array('date>='=>$newdateFrom,'date<='=>$newdateTo,'employee_id'=>$this->loggedEmp['employee_id']);
			$result['salaryReport']=$this->db_model->globalSelect('employee_attendences',$condition);
		}
		

		$this->load->view('employee/attendenceDetails',$result);
		
	}

	public function salary($value='')
	{
		//echo date('Y-m-1');
		//print_r($_POST); die();
		if (empty($_POST)){
			$condition1=array('dateTo'=>date('Y-m-1'),'dateFrom'=>date('Y-m-d'),'employee_id'=>$this->loggedEmp['employee_id']);
			$result['searchFor'] = $condition1;
			$condition=array('date>='=>date('Y-m-1'),'date<='=>date('Y-m-d'),'employee_id'=>$this->loggedEmp['employee_id']);
			$result['salaryReport']=$this->db_model->globalSelect('employee_attendences',$condition);
			
		}else{

			$data = $_POST;
			$dateFrom = new DateTime($_POST['dateFrom']);
			$newdateFrom=$dateFrom->format('Y-m-d');
			
			//$dateTo = new DateTime($_POST['dateTo']);
			$newdateTo=date("Y-m-t", strtotime($newdateFrom));
			$data['dateTo']= $newdateTo;
			$result['searchFor']= $data;
			// echo "<pre>";print_r($result); die();	
			$condition=array('date>='=>$newdateFrom,'date<='=>$newdateTo,'employee_id'=>$this->loggedEmp['employee_id']);
			$condition1=array('date_for'=>$newdateFrom,'emp_id'=>$this->loggedEmp['employee_id']);
			// print_r($condition); die();
			$result['salaryReport']=$this->db_model->globalSelect('employee_attendences',$condition);

			$result['salarylist']=$this->db_model->globalSelect('salary',$condition1);
			// echo "<pre>"; print_r($result); die();
		}
		

		$this->load->view('employee/salaryDetails',$result);
		
	}
	public function salerySlip($id='')
	{
			$salaryDtl=$this->db_model->selectRow('salary',['id'=>$id,'emp_id'=>$this->loggedEmp['employee_id']]);
			$result['employeeDtl']=$this->db_model->getWhere('employee',['employee_id'=>$this->loggedEmp['employee_id']]);
			$result['salaryDtl'] = $salaryDtl;
			// echo "<pre>";print_r($result);
			$this->load->view('employee/payslip',$result);
		// die();
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
					
					$this->session->set_flashdata('msg','Password Is Changed');
					$this->session->set_flashdata('msg_class','alert-success');
					
					return redirect('employee');
				}else
				{
					$this->setMessage('0','Action Failed try Again');
					return redirect('employee/changePassword');
				}

			}else
			{
				$this->setMessage('0','Your Old Password not Matched.');
				return redirect('employee/changePassword');
			}
		}else
		{
			$this->load->view('employee/change-password');
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
