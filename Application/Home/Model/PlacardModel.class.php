<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class PlacardModel extends Model
{
	protected $_validate =array(
			array('title','require','标题不能为空!'),
			array('content','require','公告内容不能为空!'),
		);

	protected $_auto = array ( 
		array('timestamp','time',3,'function'), 
		);
}
 ?>