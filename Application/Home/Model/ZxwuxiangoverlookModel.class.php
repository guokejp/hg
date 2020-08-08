<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class ZxwuxiangoverlookModel extends Model
{
	public function pcheck($data)//预算重复检查
	{
		$condition['year']=$data['year'];
		$condition['unitid']=$data['unitid'];
		return $this->where($condition)->Field('id')->find();
	}
	public function ccheck($data)//收支重复检查
	{
		$condition['year']=$data['year'];
		$condition['unitid']=$data['unitid'];
		$condition['month']=$data['month'];
		return $this->where($condition)->Field('id')->find();
	}
}
 ?>