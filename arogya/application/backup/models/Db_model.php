<?php
class Db_model extends CI_Model
{
	public function searchCheque($data='', $condition='')
	{
		$q = $this->db->select('*')
                  ->from('payment')
                  ->like('cheque_num', $data)
                  ->get()
                  ->row_array();
    return $q;
	}
	
	public function selectAll($table)
	{
		$query=$this->db->select('*')->get($table)->result_array();
		return $query;
	}
	public function globalSelect_condition($table,$condition)
	{
		$query=$this->db->select('*')->where($condition)->get($table)->result_array();
		return $query;
	}
	public function getFlats($table,$condition)
	{
    // 	$this->db->ORDER_BY('flat_num','ASC');
		$this->db->ORDER_BY('id','ASC');
		$query=$this->db->select('*')->where($condition)->get($table)->result_array();
		//echo '<pre>'; print_r($query); exit;
		return $query;
	}
	public function selectRow($table,$condition)
	{
		$query=$this->db->get_where($table,$condition)->row_array();
		return $query;
	}
	public function userLogin($data)
	{
		$query=$this->db->get_where('user_registration',array('user_id'=>$data['userid'],'password'=>$data['password']))->row_array();
		return $query;
	}
	
	public function userTreeview($table,$condition)
	{
		$query['direct']=$this->db->select('*')->where($condition)->get($table)->result_array();
		$a=count($query['direct']);
		if($a>=2)
		{    $i=1;
			foreach($query['direct'] as $key => $que)
			{
				if($i==2)
				{
					$num= $que['id'];
					$query['down']=$this->db->select('*')->where('sponcer_id!=',$condition['sponcer_id'])->where('id>',$num)->get($table)->result_array();
				}
			$i++;
			}
		}else
		{
			$query['down']=array();
		}
		//$xxx=array_merge($query['down'],$query['direct']);
		//echo "<pre>"; print_r($xxx); exit;
		return $query;
	}
	
	public function globalSelect($table='',$condition='')
	{
		if($condition!='')
		{
			$query=$this->db->where($condition)->select('*')->get($table)->result_array();
		}else
		{
			$query=$this->db->select('*')->get($table)->result_array();
		}
		return $query;
	}

	public function globalSelectRev($table='',$condition='')
	{
		if($condition!='')
		{
			$query=$this->db->where($condition)->select('*')->order_by('id','DESC')->get($table)->result_array();
		}else
		{
			$query=$this->db->select('*')->order_by('id','ASC')->get($table)->result_array();
		}
		return $query;
	}

	public function getWhere($table='',$condition='')
	{
		$query=$this->db->get_where($table,$condition)->row_array();
		return $query;
	}

	public function rowCount($table='',$condition='')
	{
		$query=$this->db->get_where($table,$condition)->num_rows();
		return $query;
	}

	public function globalInsert($table='',$data='')
	{
		$query=$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	
	public function globalUpdate($table='',$condition='',$data='')
	{
		//print_r($data); exit;
		$query= $this->db->where($condition)->update($table,$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function globalDelete($table='',$condition='')
	{
		$query=$this->db->delete($table,$condition);
		if($query){ return true; }else { return false; }
	}

	public function registration($data='',$param2='')
	{
		$data['status']=0;
		$data['access_level']='limited';
		$data['reg_date']=date('Y-m-d');
		$user=$this->randomNumber();
		//echo $user; exit;
		$data['user_id']=$user;
		$this->db->insert('users',$data);
		$id=$this->db->insert_id();
		return $id;
	}

	public function employeeRegistration($data='',$param2='')
	{
		$data['status']=0;
		$data['access_level']='limited';
		$data['reg_date']=date('Y-m-d');
		$user=$this->empRgdNumber();
		//echo $user; exit;
		$data['employee_id']=$user;
		$this->db->insert('employee',$data);
		$id=$this->db->insert_id();
		return $id;
	}

	public function dateFormat($date='')
	{
		$date1=date_create($date);
		echo date_format($date1,'d-M-Y');
	}

	public function dbDateFormat($date='')
	{
		$date1=strtotime($date);
		$dbData = date('Y-m-d',$date1);
		return $dbData;
	}

	public function userQuery($param1='',$param2='')
	{
		$condition="user_id='".$this->logged['user_id']."' OR receiver_id='".$this->logged['user_id']."'";
		$result=$this->db->get_where('query',$condition)->result_array();
		return $result;
	}

	public function getMaxId($table='',$condition='')
	{
		$que=$this->db->select_max('id')->get_where($table,$condition)->row();
		$query=$this->db_model->getWhere($table,['id'=>$que->id]);
		return $query;
	}

	public function transactionNumber()
	{
		$letter=str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNM');
		$str=substr($letter,0,3);
		$digit=rand(1000,9999);
		return $str.$digit;
	}

	public function passwordsuful()
	{
		$letter=str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNM');
		$str=substr($letter,0,5);
		$digit=rand(100,999);
		return $str.$digit;
	}

	public function megaBonus($level='',$amount='',$business_type='')
	{
		$data=[];
		$data['business_type']=$business_type;
		$data['mega_bonus_level']=$level;
		$data['type']='mega_bonus';
		$data['amount']=$amount;
		$data['user_id']=$this->logged['user_id'];
		$data['date']=date('Y-m-d');
		$data['time']=date('h:i:s A');
		$data['status']=1;
		$trncId=$this->db_model->transactionNumber();
		$data['transaction']='M'.$trncId;

		$user=$this->db->get_where('users',['user_id'=>$res['user_id']])->row_array();
		if($user['pan']=='')
		{
			$tds=10;
		}else
		{
			$tds=5;
		}
		$deduction['tds']=($amount*$tds)/100;
		$deduction['admin']=($amount*10)/100;
		$deduction['user_id']=$user['user_id'];
		$deduction['date']=date('Y-m-d');
		$deduction['time']=date('h:i:s A');
		$deduction['amount']=$amount;
		$deduction['type']='Mega Bonus';
		$deduction['admin_percent']=10;
		$deduction['tds_percent']=$tds;
		$amt=($amount-($deduction['admin']+$deduction['tds']))+$user['wallet'];
		$this->db->where(['user_id'=>$this->logged['user_id']])->update('users',['wallet'=>$amt]);
		$deduction['transaction']=$data['transaction'];
		$this->db->insert('tds',$deduction);

		//echo '<pre>'; print_r($data); exit;
		$res=$this->db_model->globalInsert('mega_bonus_redeem',$data);
	}

	public function randomNumber()
	{
		$char='SRG';
		$num=rand(100000,999999);
		$final=$char.$num;
		$query=$this->db->get_where('users',['user_id'=>$final])->num_rows();
		if($query>0)
		{
			$this->randomNumber();
		}else
		{
			return $final;
		}
	}

	public function empRgdNumber()
	{
		$char='EMP';
		$num=rand(100000,999999);
		$final=$char.$num;
		$query=$this->db->get_where('users',['user_id'=>$final])->num_rows();
		if($query>0)
		{
			$this->empRgdNumber();
		}else
		{
			return $final;
		}
	}

	public function registrationNumber()
	{
		$num=rand(100000,999999);
		$query=$this->db->get_where('flat_registration',['registration'=>$num])->num_rows();
		if($query>0)
		{
			$this->registrationNumber();
		}else
		{
			return $num;
		}
	}

	public function landRegistrationNumber()
	{
		$num=rand(100000,999999);
		$query=$this->db->get_where('land',['registration'=>$num])->num_rows();
		if($query>0)
		{
			$this->registrationNumber();
		}else
		{
			return $num;
		}
	}

	public function dmy($date='')
	{
		$date1=date_create($date);
		return date_format($date1,'d-m-Y');
	}

	public function ymd($date='')
	{
		$date1=date_create($date);
		return date_format($date1,'Y-m-d');
	}

	public function amount($amt='')
	{
		$number = $amt;
         $no = round($number);
         $point = round($number - $no, 2) * 100;
         $hundred = null;
         $digits_1 = strlen($no);
         $i = 0;
         $str = array();
         $words = array('0' => '', '1' => 'One', '2' => 'Two',
          '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
          '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
          '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
          '13' => 'Thirteen', '14' => 'Fourteen',
          '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
          '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
          '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
          '60' => 'Sixty', '70' => 'Seventy',
          '80' => 'Eighty', '90' => 'Ninety');
         $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
         while ($i < $digits_1) {
           $divider = ($i == 2) ? 10 : 100;
           $number = floor($no % $divider);
           $no = floor($no / $divider);
           $i += ($divider == 10) ? 1 : 2;
           if ($number) {
              $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
              $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
              $str [] = ($number < 21) ? $words[$number] .
                  " " . $digits[$counter] . $plural . " " . $hundred
                  :
                  $words[floor($number / 10) * 10]
                  . " " . $words[$number % 10] . " "
                  . $digits[$counter] . $plural . " " . $hundred;
           } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
         echo "Rupees " . $result ."Only";
	}
	public function selectSumglovel($table='',$condition='',$row)
	{
		$que=$this->db->select_sum($row)->get_where($table,$condition)->row_array();
		return $que[$row];
	}

	public function flatType($id='')
	{	
	   $this->db->select('flat_type')
				->from('flat')
				->where($id)
				->distinct('flat_type');
	    
	    $query = $this->db->get();
	    return $query->result_array();

	}

	public function sendSms($mobile='',$msg='')
	{
		 $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"http://zapsms.co.in/vendorsms/pushsms.aspx");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,"user=prayas&password=prayas12345&msisdn=".$mobile."&sid=PRAYAS&msg=".$msg."&fl=0&gwid=2");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec ($ch);
            curl_close ($ch);
           return $response;
	}

}