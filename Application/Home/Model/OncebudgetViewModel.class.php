<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class OncebudgetViewModel extends ViewModel
{
	protected $viewFields = array(
		'Oncebudget'=>array('id','termid','unitid','sectionid','staffid','categoryid','money','timestamp','name','status','confirm'),
		'Category'=>array('name'=>'categoryname','_on'=>'Category.id=Oncebudget.categoryid'),
		'Term'=>array('name'=>'termname','_on'=>'Term.id=Oncebudget.termid'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Oncebudget.sectionid'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Oncebudget.staffid')
		);
}
 ?>