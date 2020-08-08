<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ZxadminusemoneyViewModel extends ViewModel
{
	protected $viewFields = array(
		'Zxadminusemoney'=>array('name_id','inlast','inthisadd','outjzout','outthisout'),
		'Zxadminname'=>array('name','_on'=>'Zxadminusemoney.name_id=Zxadminname.id'),
		);
}
 ?>