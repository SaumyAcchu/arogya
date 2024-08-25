<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {
	public function __construct()
	{
		parent:: __construct();
		if(!$logged=$this->session->userdata('loggedCustomer'))
		{ return redirect('login/customer'); }
		$this->load->model('db_model');
		$this->load->model('Commission_model');
	}

	public function index()
	{
		$logged=$this->session->userdata('loggedCustomer');
		$param2 = $logged['building_id'];
		$param3 = $logged['flat_id'];
		$condition=array('building_id'=>$param2,'flat_id'=>$param3);
		$res['userData']=$this->db_model->selectRow('flat_registration',$condition);
		$condition1=array('building_id'=>$param2,'flat_id'=>$param3,'flat_user_id'=>$res['userData']['id']);
		$data['payment']=$this->db_model->selectSumglovel('payment',$condition1,'pay_amount');

		$this->load->view('customer/customer-dashboard',$data);
	}


	public function printInvoice($param1='',$param2='')
	{
		//echo $param1;
		$data=$this->session->userdata('loggedCustomer');

		$res['payment']=$this->db_model->selectRow('payment',['id'=>$param1,'registration'=>$data['registration']]);
		$res['flat']=$this->db_model->selectRow('flat',array('id'=>$res['payment']['flat_id']));
		$res['project']=$this->db_model->selectRow('project',array('id'=>$res['payment']['building_id']));
		$res['userData']=$this->db_model->selectRow('flat_registration',array('id'=>$res['payment']['flat_user_id']));
		if($param2=='print-booking-form')
		{
			$this->load->view('customer/print-booking',$res);
		}else
		{
			$this->load->view('customer/print-invoice',$res);
		}
		//echo '<pre>'; print_r($res); exit;
		//$this->load->view('admin/print-booking',$res);
	}

	public function customerInformation($value='')
	{	
		$logged=$this->session->userdata('loggedCustomer');

		$param2 = $logged['building_id'];
		$param3 = $logged['flat_id'];

		$condition=array('building_id'=>$param2,'flat_id'=>$param3);
		$res['userData']=$this->db_model->selectRow('flat_registration',$condition);
		$condition1=array('building_id'=>$param2,'flat_id'=>$param3,'flat_user_id'=>$res['userData']['id']);
		$res['flat']=$this->db_model->selectRow('flat',array('id'=>$param3));
		$res['project']=$this->db_model->selectRow('project',array('id'=>$param2));
		$project=$this->db_model->selectRow('project',array('id'=>$param2));
		$res['site']= $this->db_model->selectRow('sites',['id'=>$project['site_id']]);
		$res['payment']=$this->db_model->globalSelect('payment',$condition1);
		$this->load->view('customer/total_installments',$res);
	}

	public function profile($value='')
	{
		$logged=$this->session->userdata('loggedCustomer');

		$param2 = $logged['building_id'];
		$param3 = $logged['flat_id'];

		$condition=array('building_id'=>$param2,'flat_id'=>$param3);
		$res['userData']=$this->db_model->selectRow('flat_registration',$condition);
		$condition1=array('building_id'=>$param2,'flat_id'=>$param3,'flat_user_id'=>$res['userData']['id']);
		$res['flat']=$this->db_model->selectRow('flat',array('id'=>$param3));
		$res['project']=$this->db_model->selectRow('project',array('id'=>$param2));
		$project=$this->db_model->selectRow('project',array('id'=>$param2));
		$res['site']= $this->db_model->selectRow('sites',['id'=>$project['site_id']]);
		$res['payment']=$this->db_model->globalSelect('payment',$condition1);
		$this->load->view('customer/my-profile',$res);
	}


	public function installmentStatus($param1='',$param2='')
	{
		$data=$this->session->userdata('loggedCustomer');

		$condition=array('building_id'=>$data['building_id'],'registration'=>$data['registration']);
		$res=$this->db_model->selectRow('flat_registration',$condition);
		if(empty($res))
		{
			$this->session->set_flashdata('msg','Not Found! Try Again.');
			$this->session->set_flashdata('msg_class','alert-danger');
			redirect('customer');
		}else
		{
			$result['get_data']=$this->db_model->selectRow('flat_registration',$condition);
			$this->load->view('customer/installment-status',$result);
		}
	}






	public function changePassword($param1='')
	{
		if($param1=='change')
		{
			$data=$_POST;
			
			if($data['old_password']==$this->loggedCust['password'])
			{
				$res=$this->db_model->globalUpdate('flat_registration',['registration'=>$this->loggedCust['registration']],['password'=>$data['new_password']]);
				if($res)
				{
					$this->session->unset_userdata('loggedCustomer');
					$this->setMessage('1','Password Changed Successfully. Please Login with New Password');
					return redirect('customer');
				}else
				{
					$this->setMessage('0','Action Failed try Again');
					return redirect('customer/changePassword');
				}

			}else
			{
				$this->setMessage('0','Your Old Password not Matched.');
				return redirect('customer/changePassword');
			}
		}else
		{
			$this->load->view('customer/change-password');
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
