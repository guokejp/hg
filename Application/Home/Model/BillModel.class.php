<?php 
namespace Home\Model;
use Think\Model;
/**
* 
*/
class BillModel extends Model
{
	protected $_auto = array(
			array('timestamp','time',3,'function'),
		);


	public function checkdata($data){
		$map['projectid']=$data['projectid'];
		$map['contractmoneyid']=$data['contractmoneyid'];
		$map['contractmoneyqishuid']=$data['contractmoneyqishuid'];
		$map['type']=5;
		return $this->where($map)->count();

	}
}
 ?>