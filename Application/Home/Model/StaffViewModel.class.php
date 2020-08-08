<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class StaffViewModel extends ViewModel
{
	protected $viewFields = array(
		'Staff'=>array('id','name','number','sectionid','password','level','roleid','timestamp','locked'),
		'Section'=>array('name'=>'sectionname','unitid','_on'=>'Section.id=Staff.sectionid'),
		'Unit'=>array('name'=>'unitname','_on'=>'Section.unitid=Unit.id'),
		'Role'=>array('name'=>'rolename','_on'=>'Staff.roleid=Role.id')
		);
}
 ?>