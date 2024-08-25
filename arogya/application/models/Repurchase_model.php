<?php
class Repurchase_model extends CI_Model
{
	public function repurchaseCommission($data='')
	{	
	   // print_r($data); die;
		$booking_id = $data['booking_id'];
		$totalcv = $data['total_price'];
		$kuki['booking_id'] = $data['booking_id'];
		$kuki['user_id'] = $data['user_id'];
		$kuki['bv'] = $data['total_price'];
		$kuki['pv'] = $data['totalcv'];
		$kuki['date'] = date('Y-m-d');
		
				$user=$this->db->get_where('users',['user_id'=>$data['user_id']])->row_array();
				$usk=$this->db->get_where('base_plan',['id'=>$user['product']])->row_array();
				$kuki['binari'] = $totalcv*$usk['bn%']/100;
				$this->db->insert('repurchage_users',$kuki);
				$wallcvval=$totalcv+$user['re_cv'];
				$this->db->where(['user_id'=>$user['user_id']])->update('users',['re_cv'=>$wallcvval]);
				
				$this->comm->binaryClosing();

	}




}
