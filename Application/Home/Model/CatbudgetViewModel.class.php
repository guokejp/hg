<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class CatbudgetViewModel extends ViewModel
{
	protected $viewFields = array(
		'Catbudget'=>array('id','termid','unitid','sectionid','staffid','categoryid','money','timestamp'),
		'Category'=>array('name'=>'categoryname','_on'=>'Category.id=Catbudget.categoryid'),
		'Term'=>array('name'=>'termname','_on'=>'Term.id=Catbudget.termid'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Catbudget.sectionid'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Catbudget.staffid')
		);
}
 ?>