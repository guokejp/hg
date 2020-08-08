<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class SpecialModel extends Model
{

	protected $_auto = array (
		array('timestamp','time',3,'function'),
		array('total','money','1','field'),
		array('firstallmoney','money','1','field'),
		);
}
 ?>