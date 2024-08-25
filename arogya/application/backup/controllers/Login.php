<?php
class Login extends MY_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('db_model');
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800))
	    {
	      // last request was more than 30 minutes ago
	      session_unset();     // unset $_SESSION variable for the run-time 
	      session_destroy();   // destroy session data in storage
	    }
	      $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	}
	public function index($param1='',$param2='')
	{
		if($this->session->userdata('loggedUser'))
		{
			return redirect('real1');
		}elseif ($this->session->userdata('loggedCustomer')) {
			return redirect('customer');
		}
		$this->load->view('login');
	}

	public function admin($value='')
	{
		if($this->session->userdata('loggedUser'))
		{
			return redirect('real1');
		}
		$this->load->view('adminlogin');
	}

	public function customer($value='')
	{
		if($this->session->userdata('loggedUser'))
		{
			return redirect('real1');
		}
		$this->load->view('customerLogin');
	}

	public function landOwner($value='')
	{
		if($this->session->userdata('loggedUser'))
		{
			return redirect('real1');
		}
		$this->load->view('landOwnerLogin');
	}

	public function employee($value='')
	{
		if($this->session->userdata('loggedUser'))
		{
			return redirect('real1');
		}
		if($this->session->userdata('loggedCustomer'))
		{
			return redirect('customer');
		}
		$this->load->view('employeeLogin');
	}

	public function registrationpage($value='')
	{
		$this->load->view('registration');
	}

	public function countSponcer($param1='')
	{
		$user_id=$_POST['id'];
		$res=$this->db_model->getWhere('users',['user_id'=>$user_id]);
		if($res)
		{
			$row=$this->db_model->rowCount('users',['sponcer_id'=>$user_id]);
			if($row>10000)
			{
				$data['msg']="This Sponcer ID Already Used for 2 Associates.";
				$data['status']=0;
			}else
			{
				if($row>0)
				{
					$data['place']="<option value='Right'>Right</option>";
					$data['status']=1;
					$data['name']=$res['name'];
				}else
				{
					$data['place']="<option value='Left'>Left</option>";
					$data['status']=1;
					$data['name']=$res['name'];
				}
			}
		}else
		{
			$data['msg']="This Sponcer ID does'nt Exist.";
			$data['status']=0;
		}
		echo json_encode($data);
	}

	public function authenticate()
	{

		// print_r($_POST);die();
		$condition=array('user_id'=>$_POST['user_id'],'password'=>$_POST['password']/*,'access_level'=>$_POST['range']*/);
		$result=$this->db_model->selectRow('users',$condition);
		// print_r($result); exit;
		if(count($result)>0)
		{
			$this->session->set_userdata('loggedUser',$result);
			return redirect('real1');
		}else
		{
			$this->session->set_flashdata('msg','Username/Password is not Matched');
			$this->session->set_flashdata('msg_class','alert-danger');
			return redirect('login');
		}
	}

	public function employeeLogin($value='')
	{
		
		// print_r($_POST);die();
		$condition=array('employee_id'=>$_POST['user_id'],'password'=>$_POST['password']/*,'access_level'=>$_POST['range']*/);
		$result=$this->db_model->selectRow('employee',$condition);
		// print_r($result); exit;
		if(count($result)>0)
		{
			$this->session->set_userdata('loggedEmployee',$result);
			return redirect('employee');
		}else
		{
			$this->session->set_flashdata('msg','Registration Id/Password is not Matched');
			$this->session->set_flashdata('msg_class','alert-danger');
			return redirect('login/employee');
		}

	}

	public function customerLogin($value='')
	{
		// print_r($_POST);die();
		$condition=array('registration'=>$_POST['registration_id'],'password'=>$_POST['password']/*,'access_level'=>$_POST['range']*/);
		$result=$this->db_model->selectRow('flat_registration',$condition);
		// print_r($result); exit;
		if(count($result)>0)
		{
			$this->session->set_userdata('loggedCustomer',$result);
			return redirect('customer');
		}else
		{
			$this->session->set_flashdata('msg','Registration Id/Password is not Matched');
			$this->session->set_flashdata('msg_class','alert-danger');
			return redirect('login/customer');
		}
	}


	public function landOwnerLogin($value='')
	{
		// print_r($_POST);die();
		$condition=array('registration'=>$_POST['registration_id'],'password'=>$_POST['password']/*,'access_level'=>$_POST['range']*/);
		$result=$this->db_model->selectRow('land',$condition);
		// print_r($result); exit;
		if(count($result)>0)
		{
			$this->session->set_userdata('loggedLandOwner',$result);
			return redirect('land');
		}else
		{
			$this->session->set_flashdata('msg','Registration Id/Password is not Matched');
			$this->session->set_flashdata('msg_class','alert-danger');
			return redirect('login/landOwner');
		}
	}

	public function registration($param1='',$param2='')
	{
		//$this->load->model('commission_model');
		if($param1=='sub')
		{
		    if (isset($_POST['password2'])) {
			unset($_POST['password2']);
			}
			$data=$_POST;
			$data['password']= $this->db_model->passwordsuful();
			// echo "<pre>"; print_r($data); die();
			$data['address'] = $data['location'].', '.$data['city'].', State -'.$data['state'].', Pin No.'.$data['pin'];
			// echo "<pre>";	print_r($data); die();
			if(trim($data['name'])=='' || trim($data['sponcer_id'])=='' || trim($data['password'])=='')
			{
				$this->setMessage('0','Required fields must not be empty, Please fill the essential details.');
				return redirect('login/registration');
			}
			$data['sponcer_id']=strtoupper($data['sponcer_id']);
			
			$checkSponcer=$this->db_model->getWhere('users',['user_id'=>$data['sponcer_id']]);
			if($checkSponcer)
			{
				
			}else
			{
				$this->setMessage('0',"This Sponcer ID does'nt Exist.");
				return redirect('login/registration');				
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
			$res=$this->db_model->registration($data);
			if($res)
			{
				$que=$this->db_model->getWhere('users',['id'=>$res]);
				$tomail=$this->db_model->getWhere('users',['id'=>$res]);
			if($tomail['mobile']=='')
			{
				
			}else
			{
				 	$msg="Dear ".$tomail['name']." Registration Successful, Your User ID ".$tomail['user_id']." and Password is : ".$tomail['password']." http://srgroup.org.in/";
				$this->db_model->sendSms($tomail['mobile'],$msg);
				
			}
				$this->setMessage('1','Congratulation, Registration Successful.');
				$str='users/'.$res.'/success-message';
				$str=base64_encode($str);
				return redirect('login/getData/'.$str);
			}
			else
			{
				$this->setMessage('0','Registration Failed, Try Again.');
				return redirect('control/explore/user-registration');
			}
		}else
		{
			$this->load->view('admin/user-registration');
		}
	}

	public function getData($str='',$id='',$page='')
	{
		$arr=explode('/',base64_decode($str));
		//print_r($arr); die;
		$table=$arr[0]; //DB Table
		$id=$arr[1];    //Row ID
		$page=$arr[2];  //Landing Page
		$result['data']=$this->db_model->getWhere($table,['id'=>$id]);
		$this->load->view('admin/'.$page,$result);
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

	public function changePassword($param1='')
	{
		if($param1=='change')
		{
			$data=$_POST;
			if($data['old_password']==$this->logged['password'])
			{
				$res=$this->db_model->globalUpdate('users',['user_id'=>$this->logged['user_id']],['password'=>$data['new_password']]);
				if($res)
				{
					$this->setMessage('1','Password Changed Successfully. Please Login with New Password');
					$this->session->unset_userdata('loggedUser');
					return redirect('login');
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


		public function outherreg($value='')
	{	
			// echo "<pre>"; print_r($_POST); die();
		
		    if (isset($_POST['password2'])) {
			unset($_POST['password2']);
			}
			$data=$_POST;
			$data['password']= $this->db_model->passwordsuful();
			$data['block']=0;
			if(trim($data['name'])=='' || trim($data['sponcer_id'])=='' || trim($data['password'])=='')
			{
				$this->setMessage('0','Required fields must not be empty, Please fill the essential details.');
				return redirect('login/registrationpage');
			}
			$data['sponcer_id']=strtoupper($data['sponcer_id']);
			
			$checkSponcer=$this->db_model->getWhere('users',['user_id'=>$data['sponcer_id']]);
			if($checkSponcer)
			{
				
			}else
			{
				$this->setMessage('0',"This Sponcer ID does'nt Exist.");
				return redirect('login/registrationpage');				
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
			//echo '<pre>'; print_r($_FILES); exit;
			$res=$this->db_model->registration($data);
			if($res)
			{
				$que=$this->db_model->getWhere('users',['id'=>$res]);
				$tomail=$this->db_model->getWhere('users',['id'=>$res]);
			if($tomail['mobile']=='')
			{
				
			}else
			{
				 $msg="Dear ".$tomail['name']." Registration Successful, Your User ID ".$tomail['user_id']." and Password is : ".$tomail['password']."http://prayasinfra.com";

				 $to['mobile']=$tomail['mobile'];
				 $mobile=$to['mobile'];
				 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL,"http://zapsms.co.in/vendorsms/pushsms.aspx");
                 curl_setopt($ch, CURLOPT_POST, 1);
                 curl_setopt($ch, CURLOPT_POSTFIELDS,"user=prayas&password=prayas12345&msisdn=".$mobile."&sid=prayas&msg=".$msg."&fl=0&gwid=2");
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec ($ch);
              curl_close ($ch);
			}
				$this->setMessage('1','Congratulation, Registration Successful.');
				$str='users/'.$res.'/success-message';
				$str=base64_encode($str);
				return redirect('login');
			}
			else
			{
				$this->setMessage('0','Registration Failed, Try Again.');
				return redirect('login/outherreg');
			}
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
        redirect('login');
	}
	public function logoutEmp()
	{
		$this->session->sess_destroy();
        redirect('login/employee');
	}
	public function logoutCust()
	{
		$this->session->sess_destroy();
        redirect('login/customer');
	}
	public function logoutLand()
	{
		$this->session->sess_destroy();
        redirect('login/landOwner');
	}
}