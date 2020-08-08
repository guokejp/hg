<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class TrainModel extends Model
{
	protected $_auto = array(
			array('timestamp','time',3,'function'),
			array('total','staging',1,'field')
		);
}
 ?>