<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class IncomeModel extends Model
{
	protected $_validate =array(
			array('order','require','员工工号不能为空!'),
			array('order','','该单据号已经存在!',0,'unique',3),
			array('money','require','预算金额不能为空!'),
			//array('money','currency','预算金额格式不正确!'),
		);

	protected $_auto = array(
			array('timestamp','time',3,'function'),
		);
}
 ?>