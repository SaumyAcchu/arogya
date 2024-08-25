<?php
class Statics extends CI_Model
{
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
        
          $granderight = $granderightAMT;
          $grandeLeft  =  $grandeLeftAMT;

          if($granderight>=1000 && $grandeLeft>=1000)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>1,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 1;
                $leader['club'] = "STAR";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="1000";
                $leader['righta'] = "1000";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=3500 && $grandeLeft>=3500)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>2,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 2;
                $leader['club'] = "SUPERSTAR";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="3500";
                $leader['righta'] = "3500";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=8500 && $grandeLeft>=8500)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>3,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 3;
                $leader['club'] = "GOLD";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="8500";
                $leader['righta'] = "8500";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=20000 && $grandeLeft>=20000)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>4,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 4;
                $leader['club'] = "SUPERGOLD";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="20000";
                $leader['righta'] = "20000";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=75000 && $grandeLeft>=75000)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>5,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 5;
                $leader['club'] = "DIAMOND";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="75000";
                $leader['righta'] = "75000";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=200000 && $grandeLeft>=200000)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>6,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 6;
                $leader['club'] = "DOUBLE DIAMOND";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="200000";
                $leader['righta'] = "200000";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=750000 && $grandeLeft>=750000)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>7,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 7;
                $leader['club'] = "TRIPLE DIAMOND";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="750000";
                $leader['righta'] = "750000";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=2500000 && $grandeLeft>=2500000)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>8,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 8;
                $leader['club'] = "BLACK DIAMOND";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="2500000";
                $leader['righta'] = "2500000";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=7500000 && $grandeLeft>=7500000)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>9,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 9;
                $leader['club'] = "CROWN DIAMOND";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="7500000";
                $leader['righta'] = "7500000";
                $this->dbm->globalInsert('level_statics',$leader);
              }
         }
         if($granderight>=16000000 && $grandeLeft>=16000000)
          {
              $valid1=$this->dbm->rowCount('level_statics',['level'=>10,'user_id'=>$id]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 10;
                $leader['club'] = "ROYAL DIAMOND";
                $leader['date']= date('Y-m-d');
                $leader['lefta'] ="16000000";
                $leader['righta'] = "16000000";
                $this->dbm->globalInsert('level_statics',$leader);
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
	public function get_Spon($id='')
	{
		$res1=$this->db->get_where('users',['sponcer_id'=>$id])->result_array();
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$name = $value['user_id'];
				return $name;
			}
		}
	    
	}
	
    public function getAllClub()
	{
	    $res1=$this->dbm->globalSelect('users',['status'=>1,'access'=>"limited"]);

			foreach ($res1 as $key => $value)
			{
			    $this->leadership($value['user_id']);
			 
 			}
	
	
		
}

}