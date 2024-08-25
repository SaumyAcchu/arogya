<?php
class Comm extends CI_Model
{
	public function downLineSingle($param1='',$param2='')
	{
		$id=$param1;
		$res1=$this->dbm->globalSelect('users',['place_id'=>$id,'place'=>$param2]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][$id][]=$value;
				$this->downLineSingle($value['user_id'],$param2);
			}
		}
	}

	public function downLine($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['sponcer_id'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][$id][]=$value;
				$this->downLine($value['user_id']);
			}
		}
	}
	public function downLineTree($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][$id][]=$value;
				$this->downLineTree($value['user_id']);
			}
		}
	}
	public function downLineTreeRigt($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id],['place'=>'Right']);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][$id][]=$value;
				$this->downLineTree($value['user_id']);
			}
		}
	}
	
		public function downLineTreeLeft($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id],['place'=>'Left']);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][$id][]=$value;
				$this->downLineTree($value['user_id']);
			}
		}
	}

	public function downList($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['sponcer_id'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][]=$value;
				$this->downList($value['user_id']);
			}
		}
	}
	
	public function TeamList($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{	$_SESSION['TList'][]=$value;
				$this->TeamList($value['user_id']);
			}
		}
	}
	
		public function downListRR($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][]=$value;
				$this->downList($value['user_id']);
			}
		}
	}

	public function downLineUser($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['sponcer_id'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][]=$value['user_id'];
				$this->downLineUser($value['user_id']);
			}
		}
	}
	public function downLineUserMatch($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][]=$value['user_id'];
				$this->downLineUserMatch($value['user_id']);
			}
		}
	}
		public function downLineUserL($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id,'place'=>"Left"]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][]=$value['user_id'];
				$this->downLineUserL($value['user_id']);
			}
		}
	}
	
		public function downLineUserR($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id,'place'=>"Right"]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][]=$value['user_id'];
				$this->downLineUserR($value['user_id']);
			}
		}
	}

	public function downLinePair($param1='',$param2='')
	{
		$id=$param1;
		$res1=$this->dbm->globalSelect('users',['place_id'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][]=$value;
				$this->downLinePair($value['user_id']);
			}
		}
	}



	public function pairBonusToAssociate($data='',$id='')
	{
		// $user=$this->dbm->getWhere('users',['user_id'=>$id]);
		// $value['bonus']=(700*20)/100;
		// $comm['user_id']=$data['user_id'];
		// $comm['date']=date('Y-m-d');
		// $comm['type']='Pair Matching Bonus';
		// if($user['pan']=='')
		// {
		// 	$tds=10;
		// }else
		// {
		// 	$tds=5;
		// }
		// $comm['beneficiary']=$user['user_id'];
		// $deduction['tds']=($value['bonus']*$tds)/100;
		// $deduction['admin']=($value['bonus']*10)/100;
		// $deduction['user_id']=$user['user_id'];
		// $deduction['date']=date('Y-m-d');
		// $deduction['time']=date('H:i:s');
		// $deduction['amount']=$value['bonus'];
		// $deduction['type']='Pair Matching Bonus';
		// $deduction['admin_percent']=10;
		// $deduction['tds_percent']=$tds;
		// $left=($value['bonus']-($deduction['admin']+$deduction['tds']));
		// if($user['status']==1)
		// {
		// 	$wall=$left+$user['wallet'];
		// 	$this->dbm->globalUpdate('users',['user_id'=>$user['user_id']],['wallet'=>$wall]);
		// 	$comm['status']=1;
		// 	$deduction['status']=1;
		// 	$comm['is_credit']=1;
		// 	$deduction['is_credit']=1;
		// }else
		// {
		// 	$comm['status']=0;
		// 	$deduction['status']=0;
		// 	$comm['is_credit']=0;
		// 	$deduction['is_credit']=0;
		// }
		// $comm['amount']=(($value['bonus'])-($deduction['admin']+$deduction['tds']));
		// $comm['time']=date('H:i:s');
		// $comm['transaction']=$data['transaction'];
		// $deduction['transaction']=$comm['transaction'];
		// //echo "<pre>"; print_r($comm);
		// $this->db->insert('tds',$deduction);
		// $this->db->insert('commission',$comm);
	}

	public function downLeft($param1='',$param2='')
	{
		$downLeft=[];
		$ass=$this->dbm->getWhere('users',['sponcer_id'=>$param1,'place'=>'Left']);
	    if($ass)
	    {
			unset($_SESSION['dList']);
			$_SESSION['dList']=[];
			$res=$this->downLine($ass['user_id']);
			$arr=$_SESSION['dList'];
			if(!empty($arr))
			{
				sort($arr);
				foreach ($arr as $key => $value)
				{
					foreach ($value as $key => $val)
					{
						$downLeft[]=$val;
					}
				}
			}
			array_unshift($downLeft, $ass);
		}
		return $downLeft;
	}

	public function downRight($param1='',$param2='')
	{
		$downRight=[];
		$assR=$this->dbm->getWhere('users',['sponcer_id'=>$param1,'place'=>'Right']);
		//echo "<pre>"; print_r($param1); die;
	    if($assR)
	    {
			unset($_SESSION['dList']);
			$_SESSION['dList']=[];
			$res=$this->downLine($assR['user_id']);
			$arr=$_SESSION['dList'];
			if(!empty($arr))
			{
				sort($arr);
				foreach ($arr as $key => $value)
				{
					foreach ($value as $key => $val)
					{
						$downRight[]=$val;
					}
				}
			}
			array_unshift($downRight, $assR);
		}
		return $downRight;
	}

// 	public function commissionR()
// 	{
// 	    $result=$this->dbm->globalSelect('users',['access'=>"limited",'status'=>1]);
//      	    foreach ($result as $key => $value) {
//      	 	   $this->binaryCommission($value['user_id']);
//       	   	}
		
// 	}

	public function agentCommission($data='')
	{
	    $pinType= $this->dbm->getWhere('pin',['pin'=>$data['pin']]);
	    $productAmt = $this->dbm->getWhere('base_plan',['id'=>$pinType['product_id']]);
		$this->db->where(['pin'=>$data['pin']])->update('pin',['status'=>1,'activated_account'=>$data['user_id'],'date'=>date('Y-m-d'),'time'=>date('H:i:s')]);
		$this->db->where(['user_id'=>$data['user_id']])->update('users',['status'=>1,'active_date'=>date('Y-m-d'),'active_time'=>date('H:i:s'),'activated'=>date("Y-m-d H:i:s"),'topup'=>$productAmt['binari'],'product'=>$pinType['product_id'],'cv'=>$productAmt['amountbv'],'pv'=>$productAmt['amountpv']]);
        $bonus = $productAmt['direct'];
        $this->statics->getAllClub();
		$res=$this->dbm->getWhere('users',['user_id'=>$data['sponcer_id']]);
		$comm['user_id']=$data['user_id'];
		$comm['pin']=$data['pin'];
		$comm['sponcer_id']=$data['sponcer_id'];
		$comm['date']=date('Y-m-d');
		$comm['type']='bonus';
				$tds=5;
			$comm['beneficiary']=$data['sponcer_id'];
			$deduction['tds']=($bonus*5)/100;
			$deduction['admin']=($bonus*5)/100;
			$deduction['user_id']=$data['user_id'];
			$deduction['date']=date('Y-m-d');
			$deduction['time']=date('H:i:s');
			$deduction['amount']=$bonus;
			$deduction['type']='commission';
			$deduction['admin_percent']=10;
			$deduction['tds_percent']=$tds;
			
			$left=($bonus-($deduction['admin']+$deduction['tds']));
		
		    	if($res['status']==1)
			{
				$wall=$left+$res['wallet'];
				$this->dbm->globalUpdate('users',['user_id'=>$res['user_id']],['wallet'=>$wall]);
				$comm['status']=1;
				$deduction['status']=1;
				$comm['is_credit']=1;
				$deduction['is_credit']=1;
			}else
			{
				$comm['status']=0;
				$deduction['status']=0;
				$comm['is_credit']=0;
				$deduction['is_credit']=0;
			}
		
		
		    $comm['total'] = $bonus;
		    $comm['tds'] = $deduction['tds'];
		    $comm['admin'] = $deduction['admin'];
			$comm['amount']=($bonus-($deduction['admin']+$deduction['tds']));
			$comm['time']=date('H:i:s');
			$deduction['amount']=($bonus-($deduction['admin']+$deduction['tds']));
			$trncId=$this->dbm->transactionNumber();
			$comm['transaction']='C'.$trncId;

			$deduction['transaction']=$comm['transaction'];
			$this->db->insert('tds',$deduction);
			$this->db->insert('direct_comm',$comm);
		}

	public function referral($sponcer='',$userID='')
	{
	}

	
	public function autoPayout()
	{
			$check=$this->dbm->rowCount('direct_comm',['credited'=>date('Y-m-d')]);
			if($check<1)
			{
				$allIndiaB=$this->dbm->globalSelect('direct_comm',['status'=>0,'is_credit'=>0]);
				foreach ($allIndiaB as $key => $indiaB)
				{
					$user=$this->dbm->getWhere('users',['user_id'=>$indiaB['sponcer_id'],'status'=>1]);
					if($user){
					$arr2['wallet']=$user['wallet']+$indiaB['amount'];
					$this->dbm->globalUpdate('users',['user_id'=>$user['user_id']],$arr2);
					$this->dbm->globalUpdate('direct_comm',['id'=>$indiaB['id']],['is_credit'=>1,'status'=>1,'credited'=>date('Y-m-d')]);
					}
				}
			}
		}

	public function selfTeam($param1='',$param2='')
	{
		$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$param1]);
		$arr=[];
		if(count($rec)>0)
		{
			$data[2]=[];$data[3]=[];$data[3]=[];$data[4]=[];$data[5]=[];$data[6]=[];$data[7]=[];$data[8]=[];$data[9]=[];$data[10]=[];$data[11]=[];$data[12]=[];
			$arr[2]=[];$arr[3]=[];$arr[3]=[];$arr[4]=[];$arr[5]=[];$arr[6]=[];$arr[7]=[];$arr[8]=[];$arr[9]=[];$arr[10]=[];$arr[11]=[];$arr[12]=[];
			$data[1][]=array_column($rec, 'user_id');
			$arr[1][]=$rec;
			if(count($data[1])>0)
			{
				foreach ($data[1] as $key => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$val]);
						if(count($rec)>0)
						{
							$data[2][]=array_column($rec, 'user_id');
							$arr[2][]=$rec;
						}
					}
				}
			}
			
			if(count($data[2])>0)
			{
				foreach ($data[2] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[3][]=array_column($rec, 'user_id');
							$arr[3][]=$rec;
						}
					}					
				}
			}
			if(count($data[3])>0)
			{
				foreach ($data[3] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[4][]=array_column($rec, 'user_id');
							$arr[4][]=$rec;
						}
					}					
				}
			}
			if(count($data[4])>0)
			{
				foreach ($data[4] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[5][]=array_column($rec, 'user_id');
							$arr[5][]=$rec;
						}
					}					
				}
			}
			if(count($data[5])>0)
			{
				foreach ($data[5] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[6][]=array_column($rec, 'user_id');
							$arr[6][]=$rec;
						}
					}					
				}
			}
			if(count($data[6])>0)
			{
				foreach ($data[6] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[7][]=array_column($rec, 'user_id');
							$arr[7][]=$rec;
						}
					}					
				}
			}
			if(count($data[7])>0)
			{
				foreach ($data[7] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[8][]=array_column($rec, 'user_id');
							$arr[8][]=$rec;
						}
					}					
				}
			}
			if(count($data[8])>0)
			{
				foreach ($data[8] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[9][]=array_column($rec, 'user_id');
							$arr[9][]=$rec;
						}
					}					
				}
			}
			if(count($data[9])>0)
			{
				foreach ($data[9] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[10][]=array_column($rec, 'user_id');
							$arr[10][]=$rec;
						}
					}					
				}
			}
			if(count($data[10])>0)
			{
				foreach ($data[10] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[11][]=array_column($rec, 'user_id');
							$arr[11][]=$rec;
						}
					}					
				}
			}
			if(count($data[11])>0)
			{
				foreach ($data[11] as $key1 => $value)
				{
					foreach ($value as $key => $val)
					{
						$rec=$this->dbm->globalSelect('users',['sponcer_id'=>$value[$key]]);
						if(count($rec)>0)
						{
							$data[12][]=array_column($rec, 'user_id');
							$arr[12][]=$rec;
						}
					}					
				}
			}
		}else
		{
			$data=[];
		}
		return $arr;
	}
	
	public function countDownR($param='')
	{
		$right=[]; 
		unset($_SESSION['dList']);
		$_SESSION['dList']=[];
		$id= $param;
		$ru=$this->dbm->getWhere('users',['place'=>'Right','parent'=>$id]);
		if($ru)
		{
			unset($_SESSION['dList']);
			$_SESSION['dList']=[];
			$this->downLineUserR($ru['user_id']);
			$right=$_SESSION['dList'];
			array_unshift($right, $ru['user_id']);
		}
		$arr['right']=$right;
		
	 	$RG = end($right); 
			return $RG;
		
	
	}
	public function countDownL($param='')
	{
        $left=[]; 
		unset($_SESSION['dList']);
		$_SESSION['dList']=[];
		$id= $param;
		$lu=$this->dbm->getWhere('users',['place'=>'Left','parent'=>$id]);
		if($lu)
		{
			unset($_SESSION['dList']);
			$_SESSION['dList']=[];
			$this->downLineUserL($lu['user_id']);
			$left=$_SESSION['dList'];
			array_unshift($left, $lu['user_id']);
		}
		$arr['left']=$left;
		  $LG = end($left); 
			return $LG;
		
	
	}
	public function binaryClosing()
	{
		$result=$this->dbm->globalSelect('users',['access'=>"limited",'status'=>1]);
     	 foreach ($result as $key => $value) {
     	 	$this->binaryCommission($value['user_id']);
     	   	}

	}

           public function binaryCommission($param1='')
    {
         $grandeLeftAMT=0; $extraLeft=0; $extraRight=0; $leftAmt=0; $rightAmt=0; $pairAmt = 0; $grandeLeft = 0; $granderight= 0; $currentPairMach = 0; $grandeLeftAMT = 0; $granderightAMT =0; $previousLeft =0;  $previousRightAmt = 0; $updateRUsAmt=0;  $updateLUsAmt=0; $updateRRsAmt=0; $updateLRsAmt=0; $ReAmt=0;
        $right=[]; $left=[]; $down=[];
        unset($_SESSION['dList']);
        $_SESSION['dList']=[];
        $id=$param1;
        $lu=$this->dbm->getWhere('users',['place'=>'Left','parent'=>$id]);
        if($lu)
        {
            unset($_SESSION['dList']);
            $_SESSION['dList']=[];
            $this->downLineUserMatch($lu['user_id']);
            $left=$_SESSION['dList'];
            array_unshift($left, $lu['user_id']);
        }
        $ru=$this->dbm->getWhere('users',['place'=>'Right','parent'=>$id]);
        if($ru)
        {
            unset($_SESSION['dList']);
            $_SESSION['dList']=[];
            $this->downLineUserMatch($ru['user_id']);
            $right=$_SESSION['dList'];
            array_unshift($right, $ru['user_id']);
        }
        // $arr['down']=$down;
        $arr['left']=$left;
        $arr['right']=$right;    
          
        $check = $this->db->group_by('user_id')->select('*,sum(pairAmt) as total')->get_where('pairmaching',['user_id'=>$id])->row_array();
        if($check){
        	$previousLeft = $check['total'];
        	$previousRightAmt = $check['total'];
        
        }
        foreach ($arr['left'] as $key => $val)
        {
            $prp=$this->db->select('user_id,sum(cv) as total')->get_where('users',['user_id'=>$val])->row_array();
            $rrpurchage = $this->db->select('user_id,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$val,'status'=>1])->row_array();
            $leftData  = $prp['total']+$rrpurchage['total'];
            $leftAmt  = $leftAmt+$leftData;
            
        }
        $uAmt1 = $this->db->get_where('users',['user_id'=>$id,'statusMatch'=>1,'position'=>'left'])->row_array();
           $rAmt1 = $this->db->select('user_id,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$id,'status'=>1,'place'=>'left'])->row_array();
        $grandeLeftAMT  = $leftAmt+$uAmt1['cv']+$rAmt1['total'];
        
        
          
        foreach ($arr['right'] as $key => $value)
        {
           $prp=$this->db->select('user_id,sum(cv) as total')->get_where('users',['user_id'=>$value])->row_array();
            $rrpurchage = $this->db->select('user_id,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$value,'status'=>1])->row_array();
           
               $rightData = $prp['total']+$rrpurchage['total'];  
               $rightAmt = $rightAmt+$rightData;
        }
         $uAmt = $this->db->get_where('users',['user_id'=>$id,'statusMatch'=>1,'position'=>'right'])->row_array();
            $rAmt = $this->db->select('user_id,sum(bv) as total')->get_where('repurchage_users',['user_id'=>$id,'status'=>1,'place'=>'right'])->row_array();
         $granderightAMT= $rightAmt+$uAmt['cv']+$rAmt['total'];
            
            // echo "<pre>";
        //  print_r($grandeLeftAMT);
        // print_r($granderightAMT);   
        // die;
         $userAmt = $this->db->get_where('users',['user_id'=>$id,'statusMatch'=>0])->row_array();
         if($grandeLeftAMT>$granderightAMT){
            $updateRUsAmt = $granderightAMT+$userAmt['cv'];
            $updateLUsAmt =$grandeLeftAMT;
            $this->db->where(['user_id'=>$userAmt['user_id']])->update('users',['statusMatch'=>1,'position'=>'right']);
            
            
        }if($grandeLeftAMT<$granderightAMT){
            $updateRUsAmt = $granderightAMT;
            $updateLUsAmt =$grandeLeftAMT+$userAmt['cv'];
            $this->db->where(['user_id'=>$userAmt['user_id']])->update('users',['statusMatch'=>1,'position'=>'left']);
        }
      if($grandeLeftAMT==$granderightAMT){
            $updateRUsAmt = $granderightAMT;
            $updateLUsAmt =$grandeLeftAMT;
        }
    
    //   die;
        $reAmt = $this->db->get_where('repurchage_users',['user_id'=>$id,'status'=>0])->row_array();
        // .............update query...........
        if($updateLUsAmt>$updateRUsAmt){
            $updateRRsAmt = $updateRUsAmt+$ReAmt['bv'];
            $updateLRsAmt =$updateLUsAmt;
            $this->db->where(['id'=>$reAmt['id']])->update('repurchage_users',['status'=>1,'place'=>'right']);
            
        }if($updateLUsAmt<$updateRUsAmt){
            $updateLRsAmt =$updateLUsAmt+$ReAmt['bv'];
            $updateRRsAmt = $updateRUsAmt;
            $this->db->where(['id'=>$reAmt['id']])->update('repurchage_users',['status'=>1,'place'=>'left']);
        }
        if($updateLUsAmt==$updateRUsAmt){
            $updateLRsAmt =$updateLUsAmt;
            $updateRRsAmt = $updateRUsAmt;
        }
        
         $usePak = $this->db->get_where('users',['user_id'=>$id])->row_array();
         $pakAmt = $this->db->get_where('base_plan',['id'=>$usePak['product']])->row_array();
             $alltotalDataL = ($updateLRsAmt*$pakAmt['bn%'])/100;
             $alltotalDataR = ($updateRRsAmt*$pakAmt['bn%'])/100;
          $granderight = $alltotalDataR-$previousRightAmt;
          $grandeLeft  =  $alltotalDataL-$previousLeft;
          
         if($grandeLeft>=$granderight)
         {
             $data['date']= date('Y-m-d');
             $data['user_id'] = $id;
             $data['pairAmt'] = $granderight;
             $bonus = $granderight;
             $tdsAdm = ($bonus*10)/100;
             $data['paidAmt'] = $bonus-$tdsAdm;
             $data['extraAmtLeft'] = $grandeLeft-$granderight;
             $data['leftAmt'] = $grandeLeft;
             $data['rightAmt'] = $granderight;
             $data['type'] = "1:1";
             $data['currentPairMach'] = $check['currentPairMach']+$granderight;
         }
         if($grandeLeft<=$granderight)
         {
             $data['date']= date('Y-m-d');
             $data['user_id'] = $id;
             $data['pairAmt'] = $grandeLeft;
             $bonus = $grandeLeft;
             $tdsAdm = ($bonus*10)/100;
             $data['paidAmt'] = $bonus-$tdsAdm;
             $data['extraAmtRight'] = $granderight-$grandeLeft;
             $data['leftAmt'] = $grandeLeft;
             $data['rightAmt'] = $granderight;
             $data['type'] = "1:1";
              $data['currentPairMach'] = $check['currentPairMach']+$grandeLeft;
         }
            
             // ...........tds with comm.......................
             $data['amount'] = $bonus;
	        $deduction['tds']=($bonus*5)/100;
			$deduction['admin']=($bonus*5)/100;
			$deduction['user_id']=$id;
			$deduction['date']=date('Y-m-d');
			$deduction['time']=date('H:i:s');
			$deduction['amount']=$data['paidAmt'];
			$deduction['type']='PairMatch';
			$left=($bonus-($deduction['admin']+$deduction['tds']));
            $this->db->insert('tds',$deduction);
            $usr=$this->dbm->getWhere('users',['user_id'=>$id]);
            $wall=$left+$usr['wallet'];
		    $this->dbm->globalUpdate('users',['user_id'=>$usr['user_id']],['wallet'=>$wall]);
		    $data['total'] = $bonus;
		    $data['tds'] = $deduction['tds'];
		    $data['admin'] = $deduction['admin'];
            $this->db->insert('pairmaching',$data);    
            $this->leaderComm($data);
            // echo "<pre>";
            // print_r($data);


    }
    
     public function closeNow()
	{
	    $arr=$this->dbm->globalSelect('users',['status'=>1,'wallet>='=>20]);
	    foreach ($arr as $key => $value)
	    {
	    	$data['amount']=floor($value['wallet']);
	    	$data['payment_mode']='Bank';
			$data['account_number']=($value['account_number'])?$value['account_number']:'Not Added';
			$data['branch_name']=($value['branch_name'])?$value['branch_name']:'Not Added';
			$data['bank_name']=($value['bank_name'])?$value['bank_name']:'Not Added';
			$data['ifsc']=($value['ifsc'])?$value['ifsc']:'Not Added';
			$data['user_id']=$value['user_id'];
			$data['date']=date('Y-m-d');
			$data['time']=date('H:i:s');
			$data['status']=0;
			//echo "<pre>"; print_r($data);
			$res=$this->dbm->globalInsert('withdraw',$data);
			if($res)
			{
				$msg="Dear ".$value['user_id']." your payout for Rs.".$data['amount']." is released. The amount will reflect in your bank in next 4 days. Thanks and Regards. http://oceaninfosys.com/arogya/"; 
				// $this->dbm->sendSms($value['mobile'],$msg);
			    $amt=($value['wallet']-$data['amount']);
				$this->dbm->globalUpdate('users',['user_id'=>$value['user_id']],['wallet'=>$amt]);
				// $this->setMessage('1','Request Send Successfully.');
			}
	    }
	   // echo "Request Successfully Placed";
	}
	public function leaderComm($data='')
	{
	    
	      $kuki = $this->db->get_where('club_users',['getForm'=>$data['user_id']])->result_array();
	      foreach ($kuki as $key => $club_users) {
	      if($club_users>1)
	      {
	       $bonus = ($data['amount']*$club_users['comm'])/100;
		   $res=$this->dbm->getWhere('users',['user_id'=>$club_users['user_id']]);
		    $comm['user_id']=$club_users['user_id'];
		    $comm['getForm']=$data['user_id'];
		    $comm['date']=date('Y-m-d');
		    $comm['club']=$club_users['club'];
			$deduction['tds']=($bonus*5)/100;
			$deduction['admin']=($bonus*5)/100;
			$deduction['user_id']=$club_users['user_id'];
			$deduction['date']=date('Y-m-d');
			$deduction['time']=date('H:i:s');
			$deduction['amount']=$bonus;
			$deduction['type']=$club_users['level'];
			$deduction['admin_percent']=5;
			$deduction['tds_percent']=5;
			$left=($bonus-($deduction['admin']+$deduction['tds']));
			$wall=$left+$res['wallet'];
			$this->dbm->globalUpdate('users',['user_id'=>$res['user_id']],['wallet'=>$wall]);
			$deduction['status']=1;
			$deduction['is_credit']=1;
			$comm['amount']=($bonus-($deduction['admin']+$deduction['tds']));
			$comm['time']=date('H:i:s');
			$deduction['amount']=($bonus-($deduction['admin']+$deduction['tds']));
			$trncId=$this->dbm->transactionNumber();
			$comm['transaction']='C'.$trncId;
			$deduction['transaction']=$comm['transaction'];
			
			$comm['total'] = $bonus;
		    $comm['tds'] = $deduction['tds'];
		    $comm['admin'] = $deduction['admin'];
			$this->db->insert('tds',$deduction);
			$this->db->insert('club_income',$comm);
            // echo "<pre>";
        //   print_r($comm);
	      }
	  } 
	}
	

}