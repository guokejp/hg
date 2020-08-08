<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ContractotherViewModel extends ViewModel
{
	protected $viewFields = array(
		'Contract'=>array('id','specialid','isother','name','procurement','staffid','project','goods','service','projectmoney','projectremark','goodsmoney','goodsremark','servicemoney','serviceremark','status','timestamp'),
		'SpecialOther'=>array('name'=>'specialname','sectionid','_on'=>'Contract.specialid=SpecialOther.id'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Contract.staffid'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=SpecialOther.sectionid'),
		
		);
}
 ?>