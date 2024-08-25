<?php
class dbm extends CI_Model
{
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

    public function ymd($date='')
	{
		$date1=date_create($date);
		return date_format($date1,'Y-m-d');
	}

	
public function lasinsert($table='',$data='')
	{
		 $this->db->insert($table,$data);
		   return $this->db->insert_id();
	}
		public function comlast($table='',$data='')
	{
		 $this->db->insert($table,$data);
		     return;
	}
	public function selectSum($table='',$condition='')
	{
		$que=$this->db->select_sum('amount')->get_where($table,$condition)->row_array();
		return $que['amount'];
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
	    $dir=$this->dbm->rowCount('users',['id>'=>0]); 
		$data['status']=0;
		$data['access']='limited';
		$data['reg_date']=date('Y-m-d');
		//$char='99009100';

		$user=990091001+$dir;
		//print_r($user);exit;
		$data['user_id']=$user;
		$this->db->insert('users',$data);
		$id=$this->db->insert_id();
		return $id;
		    
	}
	public function userId()
	{
		$char='99009100';
		$query = $this->db->select('id')
							->order_by('id','desc')
							->limit(1)
							->get('users')->result_array();
							print_r($query);exit;

		$final=$chars+printf('%03d', $id);

		return $final;
	}

	public function randomNumber()
	{
		$char='VM';
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

	public function suplierregistration($data='',$param2='')
	{
		$data['status']=1;
		$data['reg_date']=date('Y-m-d');
		$supplier=$this->suprandomNumber();
		$data['supplier_id']=$supplier;
		$this->db->insert('supplier',$data);
		$id=$this->db->insert_id();
		return $id;
	}
	public function suprandomNumber()
	{
		$char='SP';
		$num=rand(100000,999999);
		$final=$char.$num;
		$query=$this->db->get_where('supplier',['supplier_id'=>$final])->num_rows();
		if($query>0)
		{
			$this->suprandomNumber();
		}else
		{
			return $final;
		}
	}
	public function productregistration($data='',$param2='')
	{
		
		$product=$this->prorandomNumber();
		$data['product_id']=$product;
		$this->db->insert('product',$data);
		$id=$this->db->insert_id();
		return $id;
	}
	
	public function prorandomNumber()
	{
		$char='PRO';
		$num=rand(100000,999999);
		$final=$char.$num;
		$query=$this->db->get_where('product',['product_id'=>$final])->num_rows();
		if($query>0)
		{
			$this->prorandomNumber();
		}else
		{
			return $final;
		}
	}
	

	public function dateFormat($date='')
	{
		$date1=date_create($date);
		echo date_format($date1,'d-M-Y');
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
		$query=$this->dbm->getWhere($table,['id'=>$que->id]);
		return $query;
	} 

	public function transactionNumber()
	{
		$letter=str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNM');
		$last=str_shuffle('ABCDEFGHIJKLMNOPQRESTUVWXYZ');
		$str=substr($letter,0,2);
		$strlast=substr($last,0,2);
		$digit=rand(10000,99999);
		return $str.$digit.$strlast;
	}

	public function getName($user='',$lvl='')
	{
		$name=$this->db->select('name')->where(['user_id'=>$user])->get('users')->row_array();
		return $name['name'];
	}

	public function selfEarn($user='',$lvl='')
	{
		$comm=$this->db->select_sum('amount')->where(['beneficiary'=>$user,'type'=>'bonus','level'=>$lvl])->get('commission')->row_array();
		return $total=$comm['amount'];
	}

	public function totalEarn($param1='',$param2='')
	{
		$ref=$this->db->select_sum('total')->where(['sponcer_id'=>$param1])->get('direct_comm')->row_array();
		$pair=$this->db->select_sum('total')->where(['user_id'=>$param1])->get('pairmaching')->row_array();
		return $total=$ref['total']+$pair['total'];
	}

	public function totalTeamReparches($param1='',$param2='')
	{
		$res=$this->comm->selfTeam($this->logged['user_id']);
		foreach ($res as $key => $value)
			{
				foreach ($value as $key => $val)
				{
					foreach ($val as $key => $val1) {
						$arr[]=$val1;
					}
				}
			}
		
		$total =0;
		if (isset($arr)) {
		foreach ($arr as $key => $value) {
			$total = $total + $value['cv'];
		}
		}
		return $total;
	}

	public function totalTeamCountReparches($value='')
	{
		$res=$this->comm->selfTeam($this->logged['user_id']);
		foreach ($res as $key => $value)
			{
				foreach ($value as $key => $val)
				{
					foreach ($val as $key => $val1) {
						$arr[]=$val1;
					}
				}
			}
		if (isset($arr)) {
		return count($arr);
		}else{
			return 0;
		}
		
	}

	public function wordAmt($amt='')
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
        return $result . "Rupees";
	}

	public function sendSms($mobile='',$msg='')
	{
		  // $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL,"http://zapsms.co.in/vendorsms/pushsms.aspx");
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS,"user=vitanm&password=vitanm12345&msisdn=".$mobile."&sid=VITANM&msg=".$msg."&fl=0&gwid=2");
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         $response = curl_exec ($ch);
    //         curl_close ($ch);
    //         return $response;
	}

	public function pinTransfer($data,$pin='')
	{
		$arr['date']=date('Y-m-d');
		$arr['time']=date('H:i:s');
		$arr['user_id']=$this->logged['user_id'];
		$arr['receiver_id']=$data['receiver_id'];
		$arr['quantity']=$data['transfer_quantity'];
		$arr['pin']=$pin;
		$this->db->insert('pin_transfer',$arr);
	}

	public function pinTransferByAdmin($data,$pin='')
	{
		$arr['date']=date('Y-m-d');
		$arr['time']=date('H:i:s');
		$arr['user_id']=$this->logged['user_id'];
		$arr['receiver_id']=$data['user_id'];
		$arr['quantity']=$data['quantity'];
		$arr['pin']=$data['pin'];
		$this->db->insert('pin_transfer',$arr);
	}

	public function selectLimit($table='',$condition='',$lim='')
	{
		$que=$this->db->limit($lim)->order_by('id','DESC')->get_where($table,$condition)->result_array();
		return $que;
	}

	public function autoDelete()
	{
		$day2=date('Y-m-d H:i:s');
		$arr=$this->globalSelect('users',['status'=>0,'access'=>'limited']);
		foreach ($arr as $key => $value)
		{
			$day1=date($value['created']);
			$time= floor((strtotime($day2) - strtotime($day1))/(60*60));
			if($time>=48)
			{
				$ar['hour']=$time;
				$ar['user_id']=$value['user_id'];
				$ar['created']=$value['created'];
				$this->globalDelete('users',['id'=>$value['id']]);
				//echo "<pre>"; print_r($ar);
			}
		}
	}
// ....................................


  public function allBusiness()
	{
		$grandeLeftAMT=0; $extraLeft=0; $extraRight=0; $leftAmt=0; $rightAmt=0; $pairAmt = 0; $grandeLeft = 0; $granderight= 0; $currentPairMach = 0; $grandeLeftAMT = 0; $granderightAMT =0; $previousLeft =0;  $previousRightAmt = 0; $updateRUsAmt=0;  $updateLUsAmt=0; $updateRRsAmt=0; $updateLRsAmt=0; $ReAmt=0;
        $right=[]; $left=[]; $down=[];
        unset($_SESSION['dList']);
        $_SESSION['dList']=[];
        $id=$this->logged['user_id'];
        $this->comm->downLineUserMatch($id);
		$down=$_SESSION['dList'];
        $lu=$this->dbm->getWhere('users',['place'=>'Left','parent'=>$id]);
        if($lu)
        {
            unset($_SESSION['dList']);
            $_SESSION['dList']=[];
            $this->comm->downLineUserMatch($lu['user_id']);
            $left=$_SESSION['dList'];
            array_unshift($left, $lu['user_id']);
        }
        $ru=$this->dbm->getWhere('users',['place'=>'Right','parent'=>$id]);
        if($ru)
        {
            unset($_SESSION['dList']);
            $_SESSION['dList']=[];
            $this->comm->downLineUserMatch($ru['user_id']);
            $right=$_SESSION['dList'];
            array_unshift($right, $ru['user_id']);
        }
        // $arr['down']=$down;
        $arr['left']=$left;
        $arr['right']=$right;    
        foreach ($arr['left'] as $key => $val)
        {
            $prp=$this->db->select('user_id,sum(pv) as total')->get_where('users',['user_id'=>$val])->row_array();
            $rrpurchage = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$val,'status'=>1])->row_array();
            $leftData  = $prp['total']+$rrpurchage['total'];
            $leftAmt  = $leftAmt+$leftData;
            
        }
        $uAmt1 = $this->db->get_where('users',['user_id'=>$id,'statusMatch'=>1,'position'=>'left'])->row_array();
           $rAmt1 = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$id,'status'=>1,'place'=>'left'])->row_array();
        $grandeLeftAMT  = $leftAmt+$uAmt1['pv']+$rAmt1['total'];
        
        
          
        foreach ($arr['right'] as $key => $value)
        {
           $prp=$this->db->select('user_id,sum(pv) as total')->get_where('users',['user_id'=>$value])->row_array();
            $rrpurchage = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$value,'status'=>1])->row_array();
           
               $rightData = $prp['total']+$rrpurchage['total'];  
               $rightAmt = $rightAmt+$rightData;
        }
         $uAmt = $this->db->get_where('users',['user_id'=>$id,'statusMatch'=>1,'position'=>'right'])->row_array();
            $rAmt = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$id,'status'=>1,'place'=>'right'])->row_array();
         $granderightAMT= $rightAmt+$uAmt['pv']+$rAmt['total'];
            
		$arr['rbv']=$granderightAMT;
		$arr['lbv']=$grandeLeftAMT;
		return $arr;
	}
	


// ...............................
	
	
	
	public function countDownBusiness()
	{
		
		$grandeLeftAMT=0; $extraLeft=0; $extraRight=0; $leftAmt=0; $rightAmt=0; $pairAmt = 0; $grandeLeft = 0; $granderight= 0; $currentPairMach = 0; $grandeLeftAMT = 0; $granderightAMT =0; $previousLeft =0;  $previousRightAmt = 0; $updateRUsAmt=0;  $updateLUsAmt=0; $updateRRsAmt=0; $updateLRsAmt=0; $ReAmt=0;
        $right=[]; $left=[]; $down=[];
        unset($_SESSION['dList']);
        $_SESSION['dList']=[];
        $id=$this->logged['user_id'];
        $this->comm->downLineUserMatch($id);
		$down=$_SESSION['dList'];
        $lu=$this->dbm->getWhere('users',['place'=>'Left','parent'=>$id]);
        if($lu)
        {
            unset($_SESSION['dList']);
            $_SESSION['dList']=[];
            $this->comm->downLineUserMatch($lu['user_id']);
            $left=$_SESSION['dList'];
            array_unshift($left, $lu['user_id']);
        }
        $ru=$this->dbm->getWhere('users',['place'=>'Right','parent'=>$id]);
        if($ru)
        {
            unset($_SESSION['dList']);
            $_SESSION['dList']=[];
            $this->comm->downLineUserMatch($ru['user_id']);
            $right=$_SESSION['dList'];
            array_unshift($right, $ru['user_id']);
        }
        // $arr['down']=$down;
        $arr['left']=$left;
        $arr['right']=$right;    
        foreach ($arr['left'] as $key => $val)
        {
            
            $rrpurchage = $this->db->select('user_id,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$val,'status'=>1])->row_array();
            $leftData  = $rrpurchage['total'];
            $leftAmt  = $leftAmt+$leftData;
            
        }
        $grandeLeftAMT  = $leftAmt;
    
        foreach ($arr['right'] as $key => $value)
        {
            $rrpurchage = $this->db->select('user_id,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$value,'status'=>1])->row_array();
           
               $rightData = $rrpurchage['total'];  
               $rightAmt = $rightAmt+$rightData;
        }
         $granderightAMT= $rightAmt;
            
		$arr['rbv']=$granderightAMT;
		$arr['lbv']=$grandeLeftAMT;
		return $arr;
	}
	public function countDownBusinessWeek()
	{
		$previous_week = strtotime("-1 week +1 day");
		 		$start_week = strtotime("last thursday");
		 		$end_week = strtotime("next thursday",$start_week);
		 		$start_week = date("Y-m-d",$start_week);
		 		$end_week = date("Y-m-d",$end_week);
		$grandeLeftAMT=0; $extraLeft=0; $extraRight=0; $leftAmt=0; $rightAmt=0; $pairAmt = 0; $grandeLeft = 0; $granderight= 0; $currentPairMach = 0; $grandeLeftAMT = 0; $granderightAMT =0; $previousLeft =0;  $previousRightAmt = 0; $updateRUsAmt=0;  $updateLUsAmt=0; $updateRRsAmt=0; $updateLRsAmt=0; $ReAmt=0;
        $right=[]; $left=[]; $down=[];
        unset($_SESSION['dList']);
        $_SESSION['dList']=[];
        $id=$this->logged['user_id'];
        $this->comm->downLineUserMatch($id);
		$down=$_SESSION['dList'];
        $lu=$this->dbm->getWhere('users',['place'=>'Left','parent'=>$id]);
        if($lu)
        {
            unset($_SESSION['dList']);
            $_SESSION['dList']=[];
            $this->comm->downLineUserMatch($lu['user_id']);
            $left=$_SESSION['dList'];
            array_unshift($left, $lu['user_id']);
        }
        $ru=$this->dbm->getWhere('users',['place'=>'Right','parent'=>$id]);
        if($ru)
        {
            unset($_SESSION['dList']);
            $_SESSION['dList']=[];
            $this->comm->downLineUserMatch($ru['user_id']);
            $right=$_SESSION['dList'];
            array_unshift($right, $ru['user_id']);
        }
        // $arr['down']=$down;
        $arr['left']=$left;
        $arr['right']=$right;    
        foreach ($arr['left'] as $key => $val)
        {
            
            $rrpurchage = $this->db->select('user_id,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$val,'status'=>1,'date>='=>$start_week,'date<='=>$end_week])->row_array();
            $leftData  = $rrpurchage['total'];
            $leftAmt  = $leftAmt+$leftData;
            
        }
        $grandeLeftAMT  = $leftAmt;
    
        foreach ($arr['right'] as $key => $value)
        {
            $rrpurchage = $this->db->select('user_id,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$value,'status'=>1,'date>='=>$start_week,'date<='=>$end_week])->row_array();
           
               $rightData = $rrpurchage['total'];  
               $rightAmt = $rightAmt+$rightData;
        }
         $granderightAMT= $rightAmt;
            
		$arr['rbv']=$granderightAMT;
		$arr['lbv']=$grandeLeftAMT;
		return $arr;
	}
	
}