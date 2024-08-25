<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('dbm');
		$this->load->model('comm');
	}

	public function index()
	{
		if($this->session->userdata('loggedUser'))
		return redirect('auth');
		$this->load->view('login');
	}

	public function auth()
	{
		$this->load->view('login');
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

	public function authenticate()
	{
		$condition=['user_id'=>$_POST['user_id'],'password'=>$_POST['password'],'block!='=>1];
		$rowCount=$this->dbm->rowCount('users',$condition);
		if($rowCount>0)
		{
			$result=$this->dbm->getWhere('users',$condition);
			$this->session->set_userdata('loggedUser',$result);
			return redirect('auth');
		}
		else
		{
			$this->setMessage('0','UserID/Password is wrong');
			return redirect('login/auth');
		}
		//echo '<pre>'; print_r($result); exit;
	}

	public function getData($str='',$id='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		$table=$arr[0]; //DB Table
		$id=$arr[1];    //Row ID
		$page=$arr[2];  //Landing Page
		$result['data']=$this->dbm->getWhere($table,['id'=>$id]);
		$this->load->view('user/'.$page,$result);
	}

	public function registration($param1='',$param2='')
	{
// 		if($this->logged['access']!='universal')
// 		{
// 			redirect('login');
// 		}
		$this->load->model('comm');
		if($param1=='sub')
		{
			$data=$_POST;
// 			print_r($data); 
			$data['sponcer_id']=strtoupper($data['sponcer_id']);
			$data['sponcer_id']=trim($data['sponcer_id']);
			if(trim($data['name'])=='' || trim($data['sponcer_id'])=='' || trim($data['place'])=='' || trim($data['password'])=='' || $data['mobile']=='')
			{
				$this->setMessage('0','Required fields must not be empty, Please fill the essential details.');
				return redirect('login/registration');
			}
			$checkSponcer=$this->dbm->rowCount('users',['user_id'=>$data['sponcer_id']]);
			if($checkSponcer>0)
			{
				$countSpon=$this->dbm->rowCount('users',['sponcer_id'=>$data['sponcer_id']]);
				
				if($data['place']=="Right")
				{
			     $rg = $this->comm->countDownR($data['sponcer_id']);
			     	if(!empty($rg)){
			     	     $data['parent'] = $rg;
			     	}else{
			     	     $data['parent'] =$data['sponcer_id'];
			     	}
			   
					
				}if($data['place']=="Left")
				{
			 	$lg =  $this->comm->countDownL($data['sponcer_id']);
			  	if(!empty($lg)){
			     	     $data['parent'] = $lg;
			     	}else{
			     	     $data['parent'] =$data['sponcer_id'];
			     	}
				
				}
			}else
			{
				$this->setMessage('0',"This Sponcer ID does'nt Exist.");
				return redirect('login/registration');
				
			}
			$pin=trim($data['pin']);
			if($pin!='')
			{
				$count=$this->dbm->rowCount('pin',['pin'=>$pin,'status'=>0]);
				if($count<1)
				{
					$this->setMessage('0','PIN is wrong or used');
					return redirect('login/registration');
				}else
				{
					$data['status']=1;
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
				$data['image']='blue.png';
			}
			$data['wallet']=0;
			$data['block']=0;
			$data['reg_time']=date('H:i:s');
			//echo "<pre>"; print_r($data); die;
			$res=$this->dbm->registration($data);
			if($res)
			{
				$usr=$this->dbm->getWhere('users',['id'=>$res]);
				$msg="Congratulations, Dear ".$usr['name']." Registration Successful, Your UserID is : ".$usr['user_id']." and Password is : ".$usr['password']." Visit us on ".$this->siteInfo['website'];
				$this->dbm->sendSms($usr['mobile'],$msg);
				$this->setMessage('1','Congratulation, Registration Successful.');
				$str='users/'.$res.'/success-message';
				$str=base64_encode($str);
				return redirect('login/getData/'.$str);
			}
			else
			{
				$this->setMessage('0','Registration Failed, Try Again.');
				return redirect('login/registration');
			}
		}else
		{
			$this->load->view('user/user-registration');
		}
	}

	public function getSponcer($param1='')
	{
		$user_id=trim(strtoupper($_POST['id']));
		$res=$this->dbm->getWhere('users',['user_id'=>$user_id]);
		if($res)
		{
			echo $res['name'];
		}else
		{
			echo 0;
		}
	}

	public function getProduct($param1='')
	{
		$user_id=trim(strtoupper($_POST['id']));
		$res=$this->dbm->getWhere('product',['product_id'=>$user_id]);
		if($res)
		{
			echo $res['name'];
		}else
		{
			echo 0;
		}
	}
	public function getSupplier($param1='')
	{
		$user_id=trim(strtoupper($_POST['id']));
		$res=$this->dbm->getWhere('supplier',['supplier_id'=>$user_id]);
		if($res)
		{
			echo $res['name'];
		}else
		{
			echo 0;
		}
	}

	public function checkPin($param1='',$param2='')
	{
		$pin=$_POST['pin'];
		$res=$this->dbm->rowCount('pin',['pin'=>$pin,'status'=>0]);
		if($res>0)
		{
			echo 1;
		}else
		{
			echo 0;
		}
	}

	public function checkPan($param1='',$param2='')
	{
		$pan=$_POST['pan'];
		$res=$this->dbm->rowCount('users',['pan'=>$pan,'status'=>0]);
		if($res>0)
		{
			echo 1;
		}else
		{
			echo 0;
		}
	}

	public function changePassword($param1='')
	{
		if($param1=='change')
		{
			$data=$_POST;
			if($data['old_password']==$this->logged['password'])
			{
				$res=$this->dbm->globalUpdate('users',['user_id'=>$this->logged['user_id']],['password'=>$data['new_password']]);
				if($res)
				{
					$this->setMessage('1','Password Changed Successfully. Please Login with New Password');
					return redirect('login/auth');
				}else
				{
					$this->setMessage('0','Action Failed try Again');
					return redirect('login/changePassword');
				}

			}else
			{
				$this->setMessage('0','Your Old Password not Matched.');
				return redirect('login/changePassword');
			}
		}else
		{
			$this->load->view('change-password');
		}
	}

function checkForgetPassword()
	{
		$mobile=$_POST['mobile'];
		$user=$_POST['user_id'];
		$check=$this->dbm->rowCount('users',['user_id'=>$user,'mobile'=>$mobile]);
		if($check>0)
		{
			return redirect('login/forgetPasswordVerification');
		}else
		{
			echo 0;
		}
	}

	function forgetPassword()
	{
		$mobile=trim($_POST['mobile']);
		$user=trim($_POST['user_id']);
		$check=$this->dbm->rowCount('users',['user_id'=>$user,'mobile'=>$mobile]);
		if($check>0)
		{
			$this->authenticateUser('forget-change-password',$mobile,$user);
		}else
		{
			$this->setMessage('0','Your User ID or Mobile Number not Matched.,Try with right details');
			return redirect('login/auth');
		}
	}

	public function forgetPasswordVerification($param1='')
	{
		$data=$_POST;
		$res=$this->dbm->globalUpdate('users',['user_id'=>$_SESSION['user_id']],['password'=>$data['new_password']]);
		if($res)
		{
			unset($_SESSION['page']);
			unset($_SESSION['user_id']);
			$this->setMessage('1','Password Changed Successfully. Please Login with New Password');
			return redirect('login/auth');
		}else
		{
			$this->setMessage('0','Action Failed try Again');
			return redirect('login/auth');
		}
	}

	public function authenticateUser($param1='',$param2='',$param3='')
	{
		if($param1!='')
		{
			$otp=rand(100000,999999);
			$_SESSION['otp']=$otp;
			$_SESSION['page']=$param1;
			$_SESSION['user_id']=$param3;
			$mobile=$param2;
			$msg="Kindly use your One Time Password-OTP ".$otp." Send from ".$this->siteInfo['website'];
			$this->dbm->sendSms($mobile,$msg);
			$_SESSION['otp_start'] = time();
			$data['mobile']=$param2;
			$_SESSION['mobile']=$param2;
			$this->load->view('send-otp',$data);
		}else
		{
			$this->setMessage('0','Direct Access Not Allowed.');
		   	return redirect('login/auth');
		}
	}

public function validateOtp($param1='',$param2='')
	{
		if($_SESSION['otp_start']!='')
		{
			if(isset($_SESSION['otp_start']))
			{
			    $secondsInactive = time() - $_SESSION['otp_start'];
			    $expireAfterSeconds = 300;
			    if($secondsInactive >= $expireAfterSeconds)
			    {
			        unset($_SESSION['otp']);
			        unset($_SESSION['otp_start']);
			        $this->setMessage('0','Times up !, Try Again!.');
			        return redirect('login/auth');
			    }
			}
			if($_POST['otp']==$_SESSION['otp'])
			{
				$_SESSION['isValid']=1;
				return redirect('login/authorisedOpen');
			}else
			{
				$this->setMessage('0','You have entered a wrong OTP !, Try Again!.');
				$data['mobile']=$_SESSION['mobile'];
				$this->load->view('send-otp',$data);
			}
		}
		else
		{
			$this->setMessage('0','Direct Access Not Allowed.');
		   	return redirect('login/auth');
		}
	}

	public function authorisedOpen($param1='',$param2='')
	{
		if($_SESSION['isValid']!='')
		{
			unset($_SESSION['isValid']);
			unset($_SESSION['otp']);
			unset($_SESSION['mobile']);
			$this->load->view($_SESSION['page']);
		}else
		{
			$this->setMessage('0','Direct Access Not Allowed.');
		   	return redirect('user');
		}
	}

}