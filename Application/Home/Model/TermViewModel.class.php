<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class TermViewModel extends ViewModel
{
	protected $viewFields = array(
		'Term'=>array('id','name','status','staffid','timestamp'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Term.staffid'),
		);
}
 ?>