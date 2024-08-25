<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stable extends MY_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('dbm');
		$this->load->model('comm');
	}
    
    public function countDownSearch()
	{
		$right=[]; $left=[]; $down=[]; 
		unset($_SESSION['dList']);
		$_SESSION['dList']=[];
		$id=$_POST['user_id'];
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
		$arr['down']=count($down);
		$arr['left']=count($left);
		$arr['right']=count($right);	
		//echo "<pre>"; print_r($arr);	
		echo json_encode($arr);
	}
	public function downLineUserActive($param1='',$param2='')
	{
		$id=$param1;

		$res1=$this->dbm->globalSelect('users',['parent'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][]=$value['user_id'];
				$this->downLineUserActive($value['user_id']);
			}
		}
	}
	
	public function countDownActive($param='')
	{
		$right=[]; $left=[]; $down=[]; $rightAmt = []; $leftAmt = [];
		unset($_SESSION['dList']);
		$_SESSION['dList']=[];
		$id=$_POST['user_id'];
		$this->downLineUserActive($id);
		$down=$_SESSION['dList'];
		$lu=$this->dbm->getWhere('users',['place'=>'Left','parent'=>$id]);
		if($lu)
		{
			unset($_SESSION['dList']);
			$_SESSION['dList']=[];
			$this->downLineUserActive($lu['user_id']);
			$left=$_SESSION['dList'];
			array_unshift($left, $lu['user_id']);
		}
		$ru=$this->dbm->getWhere('users',['place'=>'Right','parent'=>$id]);
		if($ru)
		{
			unset($_SESSION['dList']);
			$_SESSION['dList']=[];
			$this->downLineUserActive($ru['user_id']);
			$right=$_SESSION['dList'];
			array_unshift($right, $ru['user_id']);
		}
		 $arr['left']=$left;
         $arr['right']=$right;   
        foreach ($arr['left'] as $key => $val)
        {
            $prp=$this->db->select('user_id')->get_where('users',['user_id'=>$val,'status'=>1])->row_array();
            $leftAmt[]  = $prp['user_id'];
            
        }
        foreach ($arr['right'] as $key => $value)
        {
           $prp=$this->db->select('user_id')->get_where('users',['user_id'=>$value,'status'=>1])->row_array();
               $rightAmt[] = $prp['user_id'];
               
        }	
        $kuki['leftAc'] = count($leftAmt);
        $kuki['rightAc'] = count($rightAmt);
        $kuki['downAc'] = $kuki['rightAc']+$kuki['leftAc'];
		echo json_encode($kuki);
	}
	
	
	public function countAmt()
	{
	    $id=$_POST['user_id'];
	    $user = $this->db->get_Where('users',['user_id'=>$id])->row_array();
	    $pak = $this->db->get_Where('base_plan',['id'=>$user['product']])->row_array();
        $ru['amount'] = $pak['name'];
        $ru['cv'] = $user['cv'];
        echo json_encode($ru);
	}
	public function plotSectionche()
    {
         $grandeLeftAMT=0; $extraLeft=0; $extraRight=0; $leftAmt=0; $rightAmt=0; $pairAmt = 0; $grandeLeft = 0; $granderight= 0; $currentPairMach = 0; $grandeLeftAMT = 0; $granderightAMT =0; $previousLeft =0;  $previousRightAmt = 0; $updateRUsAmt=0;  $updateLUsAmt=0; $updateRRsAmt=0; $updateLRsAmt=0; $ReAmt=0;
        $right=[]; $left=[]; $down=[]; $DRu = 0;
        unset($_SESSION['dList']);
        $_SESSION['dList']=[];
        $id=$_POST['user_id'];
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
        $arr['left']=$left;
        $arr['right']=$right;   
        foreach ($arr['left'] as $key => $val)
        {
            $prp=$this->db->select('user_id,sum(pv) as total')->get_where('users',['user_id'=>$val])->row_array();
            $rrpurchage = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$val,'status'=>1])->row_array();
            $leftData  = $prp['total']+$rrpurchage['total'];
            $leftAmt  = $leftAmt+$leftData;
            
        }
        // $uAmt1 = $this->db->get_where('users',['user_id'=>$id,'statusMatch'=>1,'position'=>'left'])->row_array();
        //   $rAmt1 = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$id,'status'=>1,'place'=>'left'])->row_array();
        $grandeLeftAMT  = $leftAmt;
        
        
          
        foreach ($arr['right'] as $key => $value)
        {
           $prp=$this->db->select('user_id,sum(pv) as total')->get_where('users',['user_id'=>$value])->row_array();
            $rrpurchage = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$value,'status'=>1])->row_array();
           
               $rightData = $prp['total']+$rrpurchage['total'];  
               $rightAmt = $rightAmt+$rightData;
        }
        //  $uAmt = $this->db->get_where('users',['user_id'=>$id,'statusMatch'=>1,'position'=>'right'])->row_array();
        //     $rAmt = $this->db->select('user_id,sum(pv) as total')->get_where('repurchage_users',['user_id'=>$id,'status'=>1,'place'=>'right'])->row_array();
         $granderightAMT= $rightAmt;            
        
		  $ru['rightb'] = $granderightAMT;
		  $ru['leftb']  =  $grandeLeftAMT;
		  echo json_encode($ru);
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

	public function treeView($id='')
	{
		$data['userID']=base64_decode($id);
		$this->load->view('tree-view',$data);
	}
	public function treeView1($id='')
	{
		$data['userID']=base64_decode($id);
		$this->load->view('tree-view1',$data);
	}

	public function logout()
	{
		$this->session->unset_userdata('loggedUser');
		session_destroy();
		return redirect('login');
	}
}