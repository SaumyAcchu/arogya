<?php 
class Dbm extends CI_Model
{
	private $perPage = 5;
	public function getData($table='',$condition='')
	{
		if(!empty($condition))
		{
			$query=$this->db->get_where($table,$condition)->result_array();
		}else
		{
			$query=$this->db->select('*')->get($table)->result_array();
		}
		return $query;
	}

	public function getDataWithOr($table='',$condition='',$orCon='')
	{
		$query=$this->db->where($condition)->or_where($orCon)->get($table)->result_array();
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

	public function insertData($table='',$data='')
	{
		$query=$this->db->insert($table,$data);
		return $this->db->insert_id();
	}

	public function deleteData($table='',$condition='')
	{
		$query=$this->db->delete($table,$condition);
		return $query;
	}

	public function updateData($table='',$condition='',$data='')
	{
		$query=$this->db->where($condition)->update($table,$data);
		return $query;
	}

	public function uniJoin($table='',$condition='',$joinTable='', $jtField1='', $jtField2='',$t2Get='')
	{
		$query=$this->db->select("t1.*,t2.$t2Get as new_data")->join($joinTable." as t2","t1.$jtField1=t2.$jtField2")->get_where("$table as t1",$condition)->result_array();
		return $query;
	}

	public function randomNumber($table='')
	{
		$num=rand(10000,99999);
		$valid=$this->rowCount($table,['reg_num'=>$num]);
		if($valid>0)
		{
			$this->randomNumber($table);
		}else
		{
			return $num;
		}
	}

	public function getGroupedData($table='',$condition='',$field='',$fun='')
	{
		$query=$this->db->group_by($field)->get_where($table,$condition)->$fun();
		return $query;
	}

	public function getGroupedIndex($table='',$condition='',$field='')
	{
		$query=$this->db->select($field)->group_by($field)->get_where($table,$condition)->result_array();
		return $query;
	}

	public function getSearchData($table='',$condition='',$like='')
	{
		$query=$this->db->where($condition)->or_like($like)->get($table)->result_array();
		return $query;
		
	}

	public function getName($table='',$condition='')
	{
		$res=$this->db->select('name')->get_where($table,$condition)->row_array();
		return $res['name'];
	}

	public function trnx()
	{
		$str=str_shuffle("QWERTYUIOPASDFGHJKLZXCVBNM");
		$pre=substr($str, 0,3);
		$num=rand(10000,99999);
		return $pre.$num;
	}

	public function getSum($table='',$field='',$condition='')
	{
		$res=$this->db->select_sum($field)->get_where($table,$condition)->row_array();
		return $res[$field];
	}

	public function getSumWhere($table='',$field='',$condition='',$where)
	{
		$res=$this->db->select_sum($field)->where($where)->get_where($table,$condition)->row_array();
		return $res[$field];
	}

	public function getGroupedSum($table='',$field='',$condition='',$group_by='')
	{
		$res=$this->db->group_by($group_by)->select('*')->select_sum($field)->get_where($table,$condition)->result_array();
		return $res;
	}

	public function getIndex($table='',$index='',$condition='')
	{
		$res=$this->db->select($index)->get_where($table,$condition)->row_array();
		return $res[$index];
	}

	public function getColumn($table='',$index='',$condition='')
	{
		$res=$this->db->select($index)->get_where($table,$condition)->row_array();
		return $res;
	}

	public function whereIn($table='',$field='',$data='')
	{
		$res=$this->db->where_in($field,$data)->get($table)->result_array();
		return $res;
	}

	public function getDataWithOrder($table='',$condition='',$order_by='')
	{
		if(!empty($condition))
		{
			$query=$this->db->order_by($order_by,'asc')->get_where($table,$condition)->result_array();
		}else
		{
			$query=$this->db->order_by($order_by,'asc')->select('*')->get($table)->result_array();
		}
		return $query;
	}

   	public function smsLog($mobile='',$msg='')
   	{
   		$arr['mobile']=$mobile;
   		$arr['message']=$msg;
   		$arr['date']=date('Y-m-d H:i:s A');
   		$this->insertData('sms_log',$arr);
   	}
}