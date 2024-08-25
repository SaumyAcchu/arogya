<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Land extends MY_Controller {
	public function __construct()
	{
		parent:: __construct();
		if(!$logged=$this->session->userdata('loggedLandOwner'))
		{ return redirect('login/landOwner'); }
		$this->load->model('db_model');
		$this->load->model('Commission_model');
	}

	public function index()
	{
		$logged=$this->session->userdata('loggedLandOwner');
		$param2 = $logged['id'];
		$param3 = $logged['registration'];
		$condition=array('id'=>$param2,'registration'=>$param3);
		$res['userData']=$this->db_model->selectRow('land',$condition);
		$condition1=array('land_id'=>$param2,'land_registration'=>$param3);
		$data['payment']=$this->db_model->selectSumglovel('land_payment',$condition1,'pay_amount');

		$this->load->view('land/landOwner-dashboard',$data);
	}


	public function printInvoice($param1='',$param2='')
	{
		//echo $param1;
		$data=$this->session->userdata('loggedLandOwner');
		// print_r($data);die();
		$res['payment']=$this->db_model->selectRow('land_payment',['installment_id'=>$param1,'land_registration'=>$data['registration']]);		
		$res['userData']=$this->db_model->selectRow('land',array('id'=>$res['payment']['land_id']));
		if($param2=='print-booking-form')
		{
			$this->load->view('land/print-booking',$res);
		}else
		{
			$this->load->view('land/print-invoice',$res);
		}
		//echo '<pre>'; print_r($res); exit;
		//$this->load->view('admin/print-booking',$res);
	}

	public function customerInformation($value='')
	{	
		$logged=$this->session->userdata('loggedLandOwner');

		$param2 = $logged['id'];
		$param3 = $logged['registration'];

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
		$logged=$this->session->userdata('loggedLandOwner');

		$param2 = $logged['id'];
		$param3 = $logged['registration'];

		$condition=array('id'=>$param2,'registration'=>$param3);
		$condition1=array('id'=>$param2,'land_registration'=>$param3);
		// print_r($condition); die();
		$res['userData']=$this->db_model->selectRow('land',$condition);
		$res['payment']=$this->db_model->globalSelect('land_payment',$condition1);
		$this->load->view('land/my-profile',$res);
	}


	public function installmentStatus($param1='',$param2='')
	{
		$data=$this->session->userdata('loggedLandOwner');

		$param2 = $data['id'];
		$param3 = $data['registration'];

		$condition=array('id'=>$param2,'registration'=>$param3);
		$res=$this->db_model->selectRow('land',$condition);
		if(empty($res))
		{
			$this->session->set_flashdata('msg','Not Found! Try Again.');
			$this->session->set_flashdata('msg_class','alert-danger');
			redirect('land');
		}else
		{
			$result['get_data']=$this->db_model->selectRow('land',$condition);
			$this->load->view('land/installment-status',$result);
		}
	}






	public function changePassword($param1='')
	{
		if($param1=='change')
		{
			$data=$_POST;
			
			if($data['old_password']==$this->loggedLand['password'])
			{
				$res=$this->db_model->globalUpdate('land',['registration'=>$this->loggedLand['registration']],['password'=>$data['new_password']]);
				if($res)
				{
					$this->session->unset_userdata('loggedLandOwner');
					$this->setMessage('1','Password Changed Successfully. Please Login with New Password');
					return redirect('land');
				}else
				{
					$this->setMessage('0','Action Failed try Again');
					return redirect('land/changePassword');
				}

			}else
			{
				$this->setMessage('0','Your Old Password not Matched.');
				return redirect('land/changePassword');
			}
		}else
		{
			$this->load->view('land/change-password');
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
