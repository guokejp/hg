<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class TrainViewModel extends ViewModel
{
	protected $viewFields = array(
		'Train'=>array('id','termid','name','remark','total','staging','number','place','duration','money','origin','sectionid','unitid','timestamp','confirm'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Train.sectionid'),
		);
}
 ?>