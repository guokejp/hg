<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class ZxshetuanModel extends Model
{
	public function check($data)//预算重复检查
	{
		$condition['year']=$data['year'];
		$condition['month']=$data['month'];
		$condition['sectionname']=$data['sectionname'];
		return $this->where($condition)->Field('id')->find();
	}
	
}
 ?>