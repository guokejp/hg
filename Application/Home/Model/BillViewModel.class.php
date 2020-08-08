<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class BillViewModel extends ViewModel
{
	protected $viewFields = array(
		'Bill'=>array('id','type','projectid','orderid','instaid','sectionid','staffid','money','remark','timestamp','termid','status','chestaid','unitid','confirm','cremark','_type'=>'LEFT'),
		'Category'=>array('name'=>'categoryname','_on'=>'Category.id=Bill.projectid','_type'=>'LEFT'),
		'Conference'=>array('name'=>'conferencename','_on'=>'Conference.id=Bill.projectid','_type'=>'LEFT'),
		'Oncebudget'=>array('name'=>'oncebudgetname', '_on'=>'Oncebudget.id=Bill.projectid','_type'=>'LEFT'),
		'Special'=>array('name'=>'specialname', '_on'=>'Special.id=Bill.projectid','_type'=>'LEFT'),
		'Train'=>array('name'=>'trainname','_on'=>'Train.id=Bill.projectid','_type'=>'LEFT'),
		'Contract'=>array('name'=>'contractname','_on'=>'Contract.id=Bill.projectid','_type'=>'LEFT'),
		'Term'=>array('name'=>'termname','_on'=>'Term.id=Bill.termid'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Bill.sectionid'),
		'Staff'=>array('name'=>'staffname','_on'=>'Staff.id=Bill.staffid','_type'=>'LEFT'),
		'Instaff'=>array('_table'=>'hg_staff','name'=>'instaffname','_on'=>'Instaff.id=Bill.instaid','_type'=>'LEFT'),
		'Chestaff'=>array('_table'=>'hg_staff','name'=>'chestaffname','_on'=>'Chestaff.id=Bill.chestaid','_type'=>'LEFT'),
		);
}
 ?>