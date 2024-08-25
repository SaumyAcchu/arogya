<?php
class Commission_model extends CI_Model
{

	public function downLine($param1='',$param2='')
	{
		if($param1=='')
		{
			$id=$this->logged['user_id'];
		}else
		{
			$id=$param1;
		}
		$res1=$this->db_model->globalSelectRev('users',['sponcer_id'=>$id]);
		if(!empty($res1))
		{
			foreach ($res1 as $key => $value)
			{
				$_SESSION['dList'][$id][]=$value;
				//echo "<pre>"; print_r($value['user_id']);
				$this->downLine($value['user_id']);
			}
		}
	}

	public function commission($data='',$amt)
	{	
		$precomm=0;
		$start=1;
		while($start==1)
				{
					$agent=$this->db_model->selectRow('users',['user_id'=>$data['sponcer']]);
					if($agent && $agent['access_level']!='universal')
					{
						$comm['transaction']=$this->db_model->transactionNumber();						
						$comm['flat_user_id']=$data['flat_user_id'];
						$comm['flat_id']=$data['flat_id'];
						$comm['building_id']=$data['building_id'];
						$comm['installment_id']=$data['installment_id'];
						$comm['agent_id'] = $agent['user_id'];
						$comm['installment_amount'] = $data['pay_amount'];
						$comm['commission'] = $data['pay_amount'];
						$comm['deposit_date'] = $data['pay_date'];
						$rank_comm=$this->db_model->getWhere('level',['level'=>$agent['level']]);					
						$comPrc=($rank_comm['commission']-$precomm);
						$comm['commission']=round(($amt*$comPrc)/100);
						$comm['rank']=$agent['level'];
						
						$comm_new=$this->db_model->globalInsert('commission_new',$comm);
						$ex_comm_arr = $comm;
						$ex_comm_arr['commission_id'] = $comm_new;
						$this->extra_commission($ex_comm_arr);
						$total_buss=$this->dbm->getSum('commission_new','installment_amount',['agent_id'=>$agent['user_id']]);
						
						$lavel_var = $ex_comm_arr;
						$lavel_var['total_buss'] = $total_buss;
						$this->level_incr($lavel_var);
						
						$precomm=$rank_comm['commission'];
						$data['sponcer']=$agent['sponcer_id'];

					}else
					{
						$start=0;
					}
				}
				//die();
	}

	public function extra_commission($comm='')
	{
		$ex_comm['transaction']=$this->db_model->transactionNumber();
		$ex_comm['commission_id'] = $comm['commission_id'];
		$ex_comm['agent_id'] = $comm['agent_id'];
		$ex_comm['installment_amount'] = $comm['installment_amount'];		
		$ex_comm['deposit_date'] = $comm['deposit_date'];
		$ex_comm['rank'] = $comm['rank'];
		$rankExtra_comm=$this->db_model->getWhere('level_incom_type',['lavel_id'=>$comm['rank']]);
		if ($rankExtra_comm!='') {
		$extra_com =round(($comm['installment_amount']*$rankExtra_comm['incom_prct'])/100);
		$ex_comm['commission_type'] = $rankExtra_comm['id'];
		$ex_comm['commission'] = $extra_com;
		$comm_new=$this->db_model->globalInsert('commission_extra',$ex_comm);
			
		}
	}
    
    public function level_incr($value='')
	{
		$levels=$this->db_model->getWhere('level',['level'=>$value['rank']]);
		if ($value['total_buss']>$levels['business']) {
			$lav = intval($value['rank']);
			$lav = $lav + 1;
			$this->db_model->globalUpdate('users',['user_id'=>$value['agent_id']],['level'=>$lav]);
		}		
	}
	public function getCommission($data='')
	{
		$dateFrom= date('Y-m-d',strtotime('first day of last month'));
		$dateTo= date('Y-m-d',strtotime('last day of last month'));
		$check=$this->db_model->rowCount('commission',['date_from'=>$dateFrom,'date_to'=>$dateTo]);
		if($check<1)
		{
			$all=$this->db->select('user_id')->get_where('users',['access_level'=>'limited'])->result_array('users');
			foreach ($all as $key => $usr)
			{
				$even=[]; $odd=[]; $downLeft=[]; 
				$leftUser=[]; $downRight=[]; $rightUser=[];
				$areaLeft=0; $areaRight=0; $dirAmt=0;
				$direct=$this->db_model->globalSelect('flat_registration',['introducer'=>$usr['user_id'],'status'=>1,'registration_date>='=>$dateFrom,'registration_date<='=>$dateTo]);
				foreach ($direct as $key => $value)
				{
					if($value['emi']=='yes')
					{
	                 	$dirAmt=$dirAmt+20000;
	                }else
	                {  
	                	$dirAmt=$dirAmt+30000;
	                } 
					if($key%2==0)
					{
						$even[]=$value;
					}else
					{
						$odd[]=$value;
					}
				}
				$ass=$this->db_model->getWhere('users',['sponcer_id'=>$usr['user_id'],'place'=>'Left']);
			    if($ass)
			    {
					unset($_SESSION['dList']);
					$_SESSION['dList']=[];
					$res=$this->commission_model->downLine($ass['user_id']);
					$arr=$_SESSION['dList'];
					if(!empty($arr))
					{
						sort($arr);
						foreach ($arr as $key => $value)
						{
							foreach ($value as $key => $val)
							{
								$downLeft[]=$val['user_id'];
							}
						}
					}
					array_push($downLeft, $ass['user_id']);
				}
				krsort($downLeft);
				foreach ($downLeft as $key => $value)
		        {
		          	$left=$this->db_model->globalSelect('flat_registration',['introducer'=>$value,'status'=>1,'registration_date>='=>$dateFrom,'registration_date<='=>$dateTo]);
		          	if($left)
		          	{
		          		foreach($left as $list)
		          		{
		          			$leftUser[]=$list;
		            	}
		          	}
		        }
		        if($even)
		        {
		        	foreach ($even as $key => $value)
		        	{
		        		array_unshift($leftUser, $value);
		        	}
		        }
		        foreach($leftUser as $list)
	      		{ 
	                $flat=$this->db_model->getWhere('flat',['id'=>$list['flat_id']]);
	                $areaLeft=$areaLeft+$flat['area'];
	        	}
		        //====================Right===============//
			    $assR=$this->db_model->getWhere('users',['sponcer_id'=>$usr['user_id'],'place'=>'Right']);
			    if($assR)
			    {
					unset($_SESSION['dList']);
					$_SESSION['dList']=[];
					$res=$this->commission_model->downLine($assR['user_id']);
					$arr=$_SESSION['dList'];
					if(!empty($arr))
					{
						sort($arr);
						foreach ($arr as $key => $value)
						{
							foreach ($value as $key => $val)
							{
								$downRight[]=$val['user_id'];
							}
						}
					}
					array_push($downRight, $assR['user_id']);
				}
				krsort($downRight);
				foreach ($downRight as $key => $value)
	            {
	              	$right=$this->db_model->globalSelect('flat_registration',['introducer'=>$value,'status'=>1,'registration_date>='=>$dateFrom,'registration_date<='=>$dateTo]);
	              	if($right)
	              	{
	              		foreach($right as $list)
	              		{
	              			$rightUser[]=$list;
		            	}
	              	}
	            }
	           	if($odd)
	            {
	            	foreach ($odd as $key => $value)
	            	{
	            		array_unshift($rightUser, $value);
	            	}
	            }
	            foreach($rightUser as $list)
	      		{ 
	                $flat=$this->db_model->getWhere('flat',['id'=>$list['flat_id']]);
	                $areaRight=$areaRight+$flat['area'];
	        	}
	        	$pre=$this->db_model->getWhere('commission',['type'=>'current','user_id'=>$usr['user_id']]);
	        	$l=floor(($areaLeft+$pre['left_carry'])/1000);
	        	$r=floor(($areaRight+$pre['left_carry'])/1000);
			    if($l>$r) {$min=$r; }else{ $min=$l; }
			    $this->db_model->globalUpdate('commission',['type'=>'current','user_id'=>$usr['user_id']],['type'=>'pre']);
	            $arr['user_id']=$usr['user_id'];
	            $arr['direct']=count($direct);
	            $arr['left_user']=count($leftUser);
	            $arr['right_user']=count($rightUser);
	            $arr['total_area']=$areaLeft+$areaRight;
	            $arr['left_area']=$areaLeft;
	            $arr['right_area']=$areaRight;
	            $arr['left_carry']=($areaLeft+$pre['left_carry'])-$min*1000;
	            $arr['right_carry']=($areaRight+$pre['right_carry'])-$min*1000;
	            $arr['left_carry_pre']=$pre['left_carry'];
	            $arr['right_carry_pre']=$pre['right_carry'];
	            $arr['matching_area']=$min*1000;
	            $arr['matching_bonus']=$min*1000;
	            $arr['direct_bonus']=$dirAmt;
	            $arr['amount']=$dirAmt+($min*1000);
	            $arr['date_from']=$dateFrom;
	            $arr['date_to']=$dateTo;
	            $arr['type']='current';
	            $arr['transaction']=$this->db_model->transactionNumber();
	            $this->db->insert('commission',$arr);
		        //echo "<pre>"; print_r($arr); //print_r($rightUser);
		        unset($even); unset($odd); unset($downLeft);
		        unset($leftUse); unset($downRight); unset($rightUser);
			}
		}
	}
	
	public function mytree($value='')
	{
		$agent = $this->db->where(['user_id'=>$value['user_id']])->select('user_id as name, sponcer_id as sponcer_id, concat(name ," " , l_name) as username ,mobile,reg_date,image, (select COUNT(sponcer_id) AS NumberOfProducts from users where sponcer_id ="'.$value['user_id'].'") as direct')->get('users')->row_array();
		if ($agent) {
		 $agent['children'] = $this->get_categories($agent['name']);
		 return $agent;
		}
	}

	public function get_categories($name){
	        $this->db->select('users.user_id as name, users.sponcer_id as sponcer_id, concat(users.name ," " , users.l_name," (",level.name,")") as username,mobile,reg_date,image, (select COUNT(sponcer_id) AS NumberOfProducts from users where sponcer_id ="'.$name.'") as direct');
	        $this->db->from('users');
	        $this->db->join('level','users.level=level.level','Left');
	        $this->db->where(['sponcer_id' =>$name]);
	        $parent = $this->db->get();
	        
	        $categories = $parent->result();
	        $i=0;
	        foreach($categories as $p_cat){

	            $categories[$i]->children = $this->sub_categories($p_cat->name);
	            $categories[$i]->collapsed = 'true';
	            $i++;
	        }
	        return $categories;
	    }

	    public function sub_categories($id){

	         $this->db->select('users.user_id as name, users.sponcer_id as sponcer_id, concat(users.name ," " , users.l_name," (",level.name,")") as username,mobile,reg_date,image, (select COUNT(sponcer_id) AS NumberOfProducts from users where sponcer_id ="'.$id.'") as direct');
	        $this->db->from('users');
	        $this->db->join('level','users.level=level.level','Left');
	        $this->db->where('sponcer_id', $id);

	        $child = $this->db->get();
	        $categories = $child->result();
	        $i=0;
	        foreach($categories as $p_cat){

	            $categories[$i]->children = $this->sub_categories($p_cat->name);
	            $categories[$i]->collapsed = 'true';
	            $i++;
	        }
	        return $categories;       
	    }
}