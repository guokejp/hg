<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ContractViewModel extends ViewModel
{
	protected $viewFields = array(
		'Contract'=>array('id','specialid','isother','name','procurement','staffid','project','goods','service','projectmoney','projectremark','goodsmoney','goodsremark','servicemoney','serviceremark','status','timestamp'),
		'Spebudget'=>array('specialid'=>'specialname_id','sectionid','_on'=>'Contract.specialid=Spebudget.id'),
		'Special'=>array('name'=>'specialname','_on'=>'Spebudget.specialid=Special.id'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Contract.staffid'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Spebudget.sectionid'),
		
		);
}
 ?>