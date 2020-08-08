<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ZxadmindanweilookViewModel extends ViewModel
{
	protected $viewFields = array(
		'Zxadminusemoney'=>array('overlook_id'=>'useoverlookid','name_id','inadd'=>'use_monthin','outadd'=>'use_monthout'),
		'Zxadminoverlook'=>array('pid'=>'budgetoverlookid','unitid','_on'=>'Zxadminoverlook.id=Zxadminusemoney.overlook_id'),
		'Zxadminbudgetmoney'=>array('inbudgetadd'=>'budget_yearin','outbudgetadd'=>'budget_yearout','inlastadd'=>'in_lastadd',
										'_on'=>'Zxadminoverlook.pid=Zxadminbudgetmoney.overlook_id 
												and Zxadminbudgetmoney.name_id=Zxadminusemoney.name_id'),
		'Unit'=>array('name'=>'unitname','_on'=>'Zxadminoverlook.unitid=Unit.id'),

		);
}
 ?>