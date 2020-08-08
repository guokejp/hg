<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class SpebudgetModel extends Model
{
	protected $_auto = array(
			array('timestamp','time',3,'function'),
		);


	public function checkdata($data){
		$map['sectionid']=$data['sectionid'];
		$map['unitid']=$data['unitid'];
		$map['specialid']=$data['specialid'];
		return $this->where($map)->count();

	}
}
 ?>