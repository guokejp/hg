<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class BillcontractViewModel extends ViewModel
{
	protected $viewFields = array(
		'Bill'=>array('id','type','projectid','contractmoneyid','contractmoneyqishuid','orderid','sectionid','staffid','money','remark','timestamp','termid','status','unitid','confirm','cremark','_type'=>'LEFT'),
		'Contract'=>array('name'=>'contractname', '_on'=>'Contract.id=Bill.projectid','_type'=>'LEFT'),
		'contractMoney'=>array('name'=>'contract_money_name', '_on'=>'contractMoney.id=Bill.contractmoneyid','_type'=>'LEFT'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Bill.sectionid'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Bill.staffid')
		);
}
 ?>