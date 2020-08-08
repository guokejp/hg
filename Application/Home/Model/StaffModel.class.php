<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class StaffModel extends Model
{
	protected $_validate =array(
			array('name','require','姓名不能为空!'),
			array('number','require','员工工号不能为空!'),
			array('number','','该员工工号已经存在!',0,'unique',3),
			array('number','7','员工工号为7位数字!',0,'length',3),
			array('password','require','密码不能为空!'),
			array('confirm','password','确认密码不正确',0,'confirm'),
		);

	protected $_auto = array (
		array('password','',2,'ignore'),
		array('password', 'md5', 3, 'function'),
		array('password',NULL,2,'ignore'),
		array('timestamp','time',3,'function'),
		);
}
 ?>