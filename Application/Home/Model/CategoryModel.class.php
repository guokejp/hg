<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class CategoryModel extends Model
{
	protected $_validate =array(
			array('pid','require','pid不能为空!'),
			array('name','require','名称不能为空!'),
			array('once','require','类型不能为空!'),
			array('level','require','层次不能为空!'),
			array('name','','该单据号已经存在!',0,'unique',3),
		);

	protected $_auto = array(
			array('timestamp','time',3,'function'),
		);
}
 ?>