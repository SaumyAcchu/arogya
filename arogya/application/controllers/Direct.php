<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Direct extends MY_Controller {

	public function __construct()
	{
		parent:: __construct();
		
		//$this->load->model('dbm');
	}

	public function join($param1='',$param2='')
	{
		$id=base64_decode($param1);
		$row['sponcer_data']=$this->dbm->getWhere('users',['user_id'=>$id]);
		if($row['sponcer_data'])
		{
			$this->load->view('user/user-registration',$row);
		}else
		{
			$join['joinLink']='This Link Seems to be expire or not activated.';
			$this->load->view('user/success-message',$join);
		}
		//$this->load->view('user/user-registration');
	}

	public function joinWithPin($param1='',$param2='')
	{
		$str=base64_decode($param1);
		$arr=explode('/',$str);
		$row['sponcer_data']=$this->dbm->getWhere('users',['user_id'=>$arr[0]]);
		$row['pin']=$arr[1];
		if($row['sponcer_data'])
		{
			$this->load->view('user/user-registration',$row);
		}else
		{
			$join['joinLink']='This Link Seems to be expire or not activated.';
			$this->load->view('user/success-message',$join);
		}
		//$this->load->view('user/user-registration');
	}
}