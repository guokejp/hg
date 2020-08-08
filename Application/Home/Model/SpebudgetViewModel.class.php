<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class SpebudgetViewModel extends ViewModel
{
	protected $viewFields = array(
		'Spebudget'=>array('id','specialid','firstallmoney','money','sectionid','unitid','timestamp','total'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Spebudget.sectionid'),
		'Special'=>array('year','gov','name'=>'specialname','_on'=>'Special.id=Spebudget.specialid'),

		);
}
 ?>