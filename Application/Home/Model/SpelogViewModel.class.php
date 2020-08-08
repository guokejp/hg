<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class SpelogViewModel extends ViewModel
{
	protected $viewFields = array(
		'Spelog'=>array('id','unitid','sectionid','staffid','spebudid','money','type','logdate','billid','_type'=>'left'),
		'Bill'=>array('orderid','_on'=>'Bill.id=Spelog.billid'),
		'Unit'=>array('name'=>'unitname','_on'=>'Unit.id=Spelog.unitid'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Spelog.sectionid'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Spelog.staffid'),
		'Spebudget'=>array('specialid','_on'=>'Spebudget.id=Spelog.spebudid'),
		'Special'=>array('name'=>'specialname','_on'=>'Special.id=Spebudget.specialid'),
		);
}
 ?>