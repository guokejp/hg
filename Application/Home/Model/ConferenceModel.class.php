<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class ConferenceModel extends Model
{
	protected $_auto = array(
			array('timestamp','time',3,'function'),
		);
}
 ?>