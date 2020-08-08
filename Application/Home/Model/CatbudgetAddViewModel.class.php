<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class CatbudgetAddViewModel extends ViewModel
{
	protected $viewFields = array(
		'Section'=>array('id'=>'sectionid','name'=>'sectionname','_type'=>'left'),
		'Catbudget'=>array('id','termid','unitid','sectionid','staffid','categoryid','money','_on'=>'Section.id=Catbudget.sectionid'),
		);
}
 ?>