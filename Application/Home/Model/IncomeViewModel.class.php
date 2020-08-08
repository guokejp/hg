<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class IncomeViewModel extends ViewModel
{
	protected $viewFields = array(
		'Income'=>array('id','orderid','termid','sectionid','staffid','categoryid','money','remark','timestamp','once','name','status','confirm','cremark'),
		'Category'=>array('name'=>'categoryname','_on'=>'Category.id=Income.categoryid'),
		'Term'=>array('name'=>'termname','_on'=>'Term.id=Income.termid'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Income.sectionid'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Income.staffid')
		);
}
 ?>