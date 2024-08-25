<?php
class Commission_model extends CI_Model
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

        $sp1 = $this->db->get_where('users',['sponcer_id'=>$id])->result_array();
        foreach ($sp1 as $key => $vk)
        {

          if($granderight>=1000 && $grandeLeft>=1000)
          {
              $valid1=$this->dbm->rowCount('club_users',['level'=>1,'user_id'=>$id,'getForm'=>$vk['user_id']]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 1;
                $leader['getForm'] = $vk['user_id'];
                $leader['comm'] =20;
                $leader['club'] = "1 Generation";
                $leader['date']= date('Y-m-d');
                $this->dbm->globalInsert('club_users',$leader);
             }
              
          }
          
    
    $sp2 = $this->db->get_where('users',['sponcer_id'=>$vk['user_id']])->result_array();
    foreach ($sp2 as $key => $vk1)
    {
          if($DRu>=2)
          {
             $valid1=$this->dbm->rowCount('club_users',['level'=>2,'user_id'=>$id,'getForm'=>$vk1['user_id']]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 2;
                $leader['getForm'] = $vk1['user_id'];
                $leader['comm'] =5;
                $leader['club'] = "2 Generation";
                $leader['date']= date('Y-m-d');
                $this->dbm->globalInsert('club_users',$leader);
            } 
          }
         $sp3 = $this->db->get_where('users',['sponcer_id'=>$vk1['user_id']])->result_array();  
         foreach ($sp3 as $key => $vk2){
         if($DRu>=3)
          {
              $valid1=$this->dbm->rowCount('club_users',['level'=>3,'user_id'=>$id,'getForm'=>$vk2['user_id']]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 3;
                $leader['getForm'] = $vk2['user_id'];
                $leader['comm'] =5;
                $leader['club'] = "3 Generation";
                $leader['date']= date('Y-m-d');
                $this->dbm->globalInsert('club_users',$leader);
            }
           
          }
           $sp4 = $this->db->get_where('users',['sponcer_id'=>$vk2['user_id']])->result_array(); 
          foreach ($sp4 as $key => $vk3){
          if($DRu>=5)
          {
              $valid1=$this->dbm->rowCount('club_users',['level'=>4,'user_id'=>$id,'getForm'=>$vk3['user_id']]);
			  if($valid1<1)
			  {
                $leader['user_id'] = $id;
                $leader['level'] = 4;
                $leader['getForm'] = $vk3['user_id'];
                $leader['comm'] =5;
                $leader['club'] = "4 Generation";
                $leader['date']= date('Y-m-d');
                $this->dbm->globalInsert('club_users',$leader);
            }
          }
        }
       }  
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