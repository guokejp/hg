<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class SpecialOtherViewModel extends ViewModel
{
	protected $viewFields = array(
		'SpecialOther'=>array('id','name','year','money','unitid','sectionid','staffid','remark','timestamp','confirm','confirmmoney','cremark','used'),
		'Staff'=>array('name'=>'staffname','_on'=>'SpecialOther.staffid=Staff.id'),
		'Unit'=>array('name'=>'unitname','_on'=>'SpecialOther.unitid=Unit.id'),
		'Section'=>array('name'=>'sectionname','_on'=>'SpecialOther.sectionid=Section.id'),
		);
}
 ?>