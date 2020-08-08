<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class CatlogViewModel extends ViewModel
{
	protected $viewFields = array(
		'Catlog'=>array('id','termid','unitid','sectionid','staffid','categoryid','money','timestamp','type','billid','_type'=>'left'),
		'Bill'=>array('orderid','_on'=>'Bill.id=Catlog.billid'),
		'Category'=>array('name'=>'categoryname','_on'=>'Category.id=Catlog.categoryid'),
		'Term'=>array('name'=>'termname','_on'=>'Term.id=Catlog.termid'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Catlog.sectionid'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Catlog.staffid'),
		);
}
 ?>