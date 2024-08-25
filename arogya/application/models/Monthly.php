<?php
class Monthly extends CI_Model
{
    public function getAllClub()
	{
	    $res1=$this->dbm->globalSelect('users',['status'=>1,'access'=>"limited"]);

			foreach ($res1 as $key => $value)
			{
			    $this->leadership($value['user_id']);
			 
 			}
     }
    
    public function leadership($param1='')
    {
         $grandeLeftAMT=0; $extraLeft=0; $extraRight=0; $leftAmt=0; $rightAmt=0; $pairAmt = 0; $grandeLeft = 0; $granderight= 0; $currentPairMach = 0; $grandeLeftAMT = 0; $granderightAMT =0; $previousLeft =0;  $previousRightAmt = 0; $updateRUsAmt=0;  $updateLUsAmt=0; $updateRRsAmt=0; $updateLRsAmt=0; $ReAmt=0;
        $right=[]; $left=[]; $down=[]; $DRu = 0;
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
        
     $kameeni = $this->db->get_where('users',['sponcer_id'=>$id,'status'=>1])->result_array();
     foreach ($kameeni as $key => $Direct){
      $Dru=$this->db->group_by('user_id')->get_where('club_users',['user_id'=>$Direct['user_id'],'level'=>1])->num_rows();
      $DRu = $DRu+$Dru; 
      }
         
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
        
          $granderight = $granderightAMT;
          $grandeLeft  =  $grandeLeftAMT;
        

          if($granderight>=1000 && $grandeLeft>=1000)
          {
              $valid1=$this->dbm->rowCount('monthly_users',['level'=>1,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 1;
                $leader['comm'] =20;
                $leader['club'] = "Monthly Generation";
                $leader['date']= date('Y-m-d');
                $this->dbm->globalInsert('monthly_users',$leader);
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

	public function CheckClub()
	{
	    $res1=$this->dbm->globalSelect('monthly_users');

			foreach ($res1 as $key => $value)
			{
			    $this->IncomeMonthly($value['user_id']);
			 
 			}
     }
    
    public function IncomeMonthly($param1='')
    {
        $first_day_this_month = date('Y-m-01'); 
        $last_day_this_month  = date('Y-m-t');
         $grandeLeftAMT=0; $extraLeft=0; $extraRight=0; $leftAmt=0; $rightAmt=0; $pairAmt = 0; $grandeLeft = 0; $granderight= 0; $currentPairMach = 0; $grandeLeftAMT = 0; $granderightAMT =0; $previousLeft =0;  $previousRightAmt = 0; $updateRUsAmt=0;  $updateLUsAmt=0; $updateRRsAmt=0; $updateLRsAmt=0; $ReAmt=0;
        $right=[]; $left=[]; $down=[]; $DRu = 0;
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
        foreach ($arr['left'] as $key => $val)
        {
            $prp=$this->db->select('user_id,sum(pv) as total')->get_where('users',['user_id'=>$val,'reg_date>='=>$first_day_this_month,'reg_date<='=>$last_day_this_month])->row_array();
            $rrpurchage = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$val,'status'=>1,'date>='=>$first_day_this_month,'date<='=>$last_day_this_month])->row_array();
            $leftData  = $prp['total']+$rrpurchage['total'];
            $leftAmt  = $leftAmt+$leftData;
            
        }
           $rAmt1 = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$id,'status'=>1,'place'=>'left','date>='=>$first_day_this_month,'date<='=>$last_day_this_month])->row_array();
           $grandeLeftAMT  = $leftAmt+$rAmt1['total'];
        
        foreach ($arr['right'] as $key => $value)
        {
            $prp=$this->db->select('user_id,sum(pv) as total')->get_where('users',['user_id'=>$value,'reg_date>='=>$first_day_this_month,'reg_date<='=>$last_day_this_month])->row_array();
            $rrpurchage = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$value,'status'=>1,'date>='=>$first_day_this_month,'date<='=>$last_day_this_month])->row_array();
           
               $rightData = $prp['total']+$rrpurchage['total'];  
               $rightAmt = $rightAmt+$rightData;
        }
            $rAmt = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$id,'status'=>1,'place'=>'right','date>='=>$first_day_this_month,'date<='=>$last_day_this_month])->row_array();
         $granderightAMT= $rightAmt+$rAmt['total'];            
        
          $granderight = $granderightAMT;
          $grandeLeft  =  $grandeLeftAMT;
          echo "<pre>";
          print_r($granderight);
          echo "<pre>";
          print_r($grandeLeft);

          if($granderight>=1000 && $grandeLeft>=1000)
          {
            //   ..................Start user amt
                $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
                $last_day_this_month  = date('Y-m-t');
                $monthAmtALL = $this->db->select('sum(cv) as total')->get_where('users',['status'=>1,'reg_date>='=>$first_day_this_month,'reg_date<='=>$last_day_this_month])->row_array();
                $manage_club = $this->db->select('sum(amount) as total')->get_where('manage_club',['date>='=>$first_day_this_month,'date<='=>$last_day_this_month])->row_array();
                $monthAmt['total'] = $monthAmtALL['total']-$manage_club['total'];
          // .end...........................
          
                $pairMatch=$this->db->group_by('user_id')->select('sum(paidAmt) as total')->get_where('pairmaching',['user_id'=>$id,'date>='=>$first_day_this_month,'date<='=>$last_day_this_month])->row_array();
                $TotalGenrate = $this->db->group_by('user_id')->select('sum(business) as total')->get_where('monthly_income',['user_id'=>$id,'date>='=>$first_day_this_month,'date<='=>$last_day_this_month])->row_array();
			    $business = $pairMatch['total']-$TotalGenrate['total'];
			    $totalbus = ($business*100)/$monthAmt['total'];
			    
			    $bonus =($business*$totalbus)/100;
                
            // ....................    
            $res=$this->dbm->getWhere('users',['user_id'=>$id]);
		    $comm['user_id']=$id;
		    $comm['netamt']=$bonus;
		    $comm['date']=date('Y-m-d');
		    $comm['club']="MONTHLY INCOME";
		    $comm['business'] = $business;
		    $comm['monthb'] = $monthAmt['total'];
			$deduction['tds']=($bonus*5)/100;
			$deduction['admin']=($bonus*5)/100;
			$deduction['user_id']=$id;
			$deduction['date']=date('Y-m-d');
			$deduction['time']=date('H:i:s');
			$deduction['amount']=$bonus;
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
			$this->db->insert('tds',$deduction);
			$comm['total'] = $bonus;
		    $comm['tds'] = $deduction['tds'];
		    $comm['admin'] = $deduction['admin'];
			$this->db->insert('monthly_income',$comm);
            //  ....................   
                
             
      }
  }
    

}