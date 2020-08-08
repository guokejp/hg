<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 部门包干费用使用情况表View
*/
class SecCatbudViewModel extends ViewModel
{
	protected $viewFields = array(
		'Section'=>array('id'=>'sectionid','name'=>'sectionname','_type'=>'left'),
		'Catbudget'=>array('categoryid','init_money','money','_on'=>'Section.id=Catbudget.sectionid','_type'=>'left'),
		'Category'=>array('name'=>'categoryname','_on'=>'Category.id=Catbudget.categoryid'),
		);
}
 ?>