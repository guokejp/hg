<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class SpecialOtherModel extends Model
{
	protected $_validate =array(
			array('name','require','采购名称不能为空!'),
			array('name','','单位名称已经存在!',0,'unique',3),
		);

	protected $_auto = array (
		array('timestamp','time',3,'function'),
		);
}
 ?>