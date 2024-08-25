<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountant extends MY_Controller {
	public function __construct()
	{
		parent:: __construct();
		if($this->loggedEmp['access_level']!='accountant')
		{ return redirect('employee'); }
		$this->load->model('db_model');
		$this->load->model('commission_model');
	}

	public function index()
	{
		$this->load->view('accountant/accountant-dashboard');
	}

	public function profile($value='')
	{

		$this->load->view('employee/employee-profile');
	}


	public function explore($param1='',$param2='')
	{
		$this->load->view('accountant/'.$param1);
	}
	public function exploreData($table='',$viewpage='')
	{
		$result['data']=$this->db_model->selectAll($table);
		$this->load->view('accountant/'.$viewpage,$result);
	}
	public function exploreDataWith($table='',$viewpage='')
	{
		if (isset($_POST['project_id'])) {
		$result['data']=$this->db_model->globalSelect($table,['building_id'=>$_POST['project_id']]);
		}else{
		$result['data']=$this->db_model->selectAll($table);
		}
		$this->load->view('accountant/'.$viewpage,$result);
	}


	public function getData($table='',$id='',$page='')
	{
		$result['get_data']=$this->db_model->getWhere($table,['id'=>$id]);
		$this->load->view('accountant/'.$page,$result);
	}

	public function updateData($table='',$id='',$page='')
	{
		$data=$_POST;
		$result=$this->db_model->globalUpdate($table,['id'=>$id],$data);
		if($result)
		{
			$this->setMsg('1','Data Updated Successfully.');
		}
		else
		{
			$this->setMsg('0','Data Updating Failed ! Try Again');
		}
		return redirect('accountant/exploreData/'.$table.'/'.$page);	
	}

    public function insertData($table='',$page='')
	{
		$data=$_POST;
		$result=$this->db_model->globalInsert($table,$data);
		if($result)
		{
			$this->setMsg('1','Data Inserted Successfully.');
		}
		else
		{
			$this->setMsg('0','Data Inserting Failed ! Try Again');
		}
		return redirect('accountant/exploreData/'.$table.'/'.$page);	
	}


    public function deleteData($table='',$id='',$page='')
	{
		$result=$this->db_model->globalDelete($table,['id'=>$id]);
		if($result)
		{
			$this->setMsg('1','Data Deleted Successfully.');
		}
		else
		{
			$this->setMsg('0','Data not Deleted ! Try Again');
		}
		return redirect('accountant/exploreData/'.$table.'/'.$page);	
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
			return redirect('accountant/expenseManagement');
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
			$this->load->view('accountant/expense_management',$result);
		}else
		{
			$result['data']=$this->db_model->globalSelect('expense_entry');
			$result['category']=$this->db_model->globalSelect('expense_category');
			$this->load->view('accountant/expense_management',$result);
		}
	}

	public function dailyReport($param1='',$param2='')
	{
		if($param1=='today')
		{
			$condition=array('entry_date'=>date('Y-m-d'));
			$result['data']=$this->db_model->globalSelect('expense_entry',$condition);
			$this->load->view('accountant/daily-report',$result);
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
			$this->load->view('accountant/daily-report',$result);
		}
	}


	public function incomeManagement($param1='',$param2='')
	{
		if($param1=='add')
		{
			$data=$this->input->post();
			$mdate=$this->input->post('entry_date');
			$myDateTime = new DateTime($mdate);
			$newDateString = $myDateTime->format('Y-m-d');
			$data['entry_date']=$newDateString;
			$result=$this->db_model->globalInsert('income_entry',$data);
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
			return redirect('accountant/incomeManagement');
		}
		if($param1=='incomeReport')
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
			$result['category']=$this->db_model->globalSelect('income_category');
			$result['income_report']=$this->db_model->globalSelect('income_entry',$condition);
			//echo '<pre>'; print_r($result); die;
			$result['data']=$this->db_model->globalSelect('income_entry');
			$this->load->view('accountant/income_management',$result);
		}else
		{
			$result['data']=$this->db_model->globalSelect('income_entry');
			$result['category']=$this->db_model->globalSelect('income_category');
			$this->load->view('accountant/income_management',$result);
		}
	}


	public function dailyIncomeReport($param1='',$param2='')
	{
		if($param1=='today')
		{
			$condition=array('entry_date'=>date('Y-m-d'));
			$result['data']=$this->db_model->globalSelect('income_entry',$condition);
			$this->load->view('accountant/daily-income-report',$result);
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
			$result['data']=$this->db_model->globalSelect('income_entry',$condition);
			$this->load->view('accountant/daily-income-report',$result);
		}
	}
	public function paymentReport($param1='',$param2='')
	{
		$dateFrom=new DateTime($_POST['dateFrom']);
		$newdateFrom=$dateFrom->format('Y-m-d');
		$dateTo=new DateTime($_POST['dateTo']);
		$newdateTo=$dateTo->format('Y-m-d');
		$result['searchFor']=$_POST;
		
		$condition=array('pay_date>='=>$newdateFrom,'pay_date<='=>$newdateTo);
		$condition1=array('entry_date>='=>$newdateFrom,'entry_date<='=>$newdateTo);

		$result['expense']=$this->db_model->globalSelect('expense_entry',$condition1);
		$result['income']=$this->db_model->globalSelect('income_entry',$condition1);
		
		$result['payReport']=$this->db_model->globalSelect('payment',$condition);
		$result['data']=$this->db_model->selectAll('project');
		// echo '<pre>'; print_r($result['expense']); exit;
		$this->load->view('accountant/payment_report',$result);
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
					
					return redirect('accountant');
				}else
				{
					$this->setMsg('0','Action Failed try Again');
					return redirect('accountant/changePassword');
				}

			}else
			{
				$this->setMsg('0','Your Old Password not Matched.');
				return redirect('accountant/changePassword');
			}
		}else
		{
			$this->load->view('accountant/change-password');
		}
	}




    public function setMsg($status='',$msg='')
	{
		$this->session->set_flashdata('msg',$msg);
		if($status==1)
		{
			$this->session->set_flashdata('msg_class','alert-success');
		}else
		{
			$this->session->set_flashdata('msg_class','alert-danger');
		}
	}

	
}
