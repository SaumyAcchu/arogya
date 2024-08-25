<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends My_controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('dbm');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function explore($page='')
	{
		$this->load->view('common/'.base64_decode($page));
	}

	public function exploreData($str='')
	{
		$data=explode('/', base64_decode($str));
		$table=$data[0]; //DB Table
		$page=$data[1]; //Landing Page
		$arr['data']=$this->dbm->getData($table);
		$this->load->view('common/'.$page,$arr);
	}

	public function getData($str='')
	{
		$data=explode('/', base64_decode($str));
		$table=$data[0]; //DB Table
		$field=$data[1]; //DB Field
		$matcher=$data[2]; //Matcher
		$page=$data[3]; //Landing Page
		$arr['data']=$this->dbm->getData($table,[$field=>$matcher]);
		$this->load->view('common/'.$page,$arr);
	}

	public function getLogData($str='')
	{
		$data=explode('/', base64_decode($str));
		$table=$data[0]; //DB Table
		$field=$data[1]; //DB Field
		$matcher=$this->logged; //Matcher
		$page=$data[3]; //Landing Page
		$arr['data']=$this->dbm->getData($table,[$field=>$matcher]);
		$this->load->view('common/'.$page,$arr);
	}

    public function insertData($table='',$field='',$matcher='',$page='')
    {
        $res=$this->dbm->insertData($table,$_POST);
        if($res)
        {
            $this->setMsg('1','Data Added Succesfully');
        }else
        {
            $this->setMsg('0','Data Inserting Failed ! Try Again');
        }
        return redirect('control/getData/'.base64_encode($table.'/'.$field.'/'.$matcher.'/'.$page));
    }

    public function insertAndReturn($table='',$return='')
    {
        $res=$this->dbm->insertData($table,$_POST);
        if($res)
        {
            $this->setMsg('1','Data Added Succesfully');
        }else
        {
            $this->setMsg('0','Data Inserting Failed ! Try Again');
        }
        return redirect(base64_decode($return));
    }

    public function updateAndReturn($table='',$return='')
    {
        $res=$this->dbm->updateData($table,['id'=>$_POST['id']],$_POST);
        if($res)
        {
            $this->setMsg('1','Data Updated Succesfully');
        }else
        {
            $this->setMsg('0','Data Updating Failed ! Try Again');
        }
        return redirect(base64_decode($return));
    }

    public function updateData($str='')
    {
        $arr=explode('/', base64_decode($str));
        $table=$arr[0];
        $field=$arr[1];
        $matcher=$arr[2];
        $page=$arr[3];
        $data=$_POST;
        $res=$this->dbm->updateData($table,[key($_POST)=>reset($_POST)],$data);
        if($res)
        {
            $this->setMsg('1','Data Updated Succesfully');
        }else
        {
            $this->setMsg('0','Data Updating Failed ! Try Again');
        }
        return redirect('control/getData/'.base64_encode($table.'/'.$field.'/'.$matcher.'/'.$page));
    }

	public function updateByJs($str='')
	{
		$arr=explode('/', base64_decode($str));
		$table=$arr[0];
		$page=$arr[1];
		$data=$_POST;
		$res=$this->dbm->updateData($table,['id'=>$data['id']],$data);
		if($res)
		{
			$this->fee->updateFeeStatus($data);
			$this->setMsg('1','Data Updated Succesfully');
		}else
		{
			$this->setMsg('0','Data Updating Failed ! Try Again');
		}
		return redirect('control/explore/'.base64_encode($page));
	}

	public function deleteDataSwal($table='')
	{
		$res=$this->dbm->updateData($table,$_POST,['is_delete'=>1]);
		return $res;
	}

	public function deleteDataSwalFee($table='')
	{
		$res=$this->dbm->updateData($table,$_POST,['is_delete'=>1]);
		$this->dbm->updateData('fee_status',['fee_id'=>$_POST['id']],['is_delete'=>1]);
		return $res;
	}

	public function deleteBySwal($table = '')
	{
        $this->db->where($_POST);
        $this->db->delete($table);
    }

    public function deleteFee($table = '') {
        $this->db->where($_POST);
        $this->db->delete($table);
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

	public function isExists($table='')
	{
		$check=$this->dbm->rowCount($table,$_POST);
		if($check>0){ echo 1; }else{ echo 0; }
	}

	public function fetchData($table='') //through AJAX
	{
		$get=$this->dbm->getWhere($table,$_POST);
		echo json_encode($get);
	}

	public function updateDataAndReturn($table='',$return='')
    {
        $data=$_POST;
        $res=$this->dbm->updateData($table,[key($_POST)=>reset($_POST)],$data);
        if($res)
        {
            $this->setMsg('1','Data Updated Succesfully');
        }else
        {
            $this->setMsg('0','Data Updating Failed ! Try Again');
        }
        return redirect(base64_decode($return));
    }
}