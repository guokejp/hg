<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ZxadminkemulookViewModel extends ViewModel
{
	protected $viewFields = array(
		'Zxadminoverlook'=>array('id','pid'),
		'Zxadminbudgetmoney'=>array('name_id'=>'kemunameid','inbudgetadd'=>'budget_yearin','outbudgetadd'=>'budget_yearout','inlastadd'=>'in_lastadd','_on'=>'Zxadminoverlook.pid=Zxadminbudgetmoney.overlook_id'),
		'Zxadminusemoney'=>array('inadd'=>'use_monthin','outadd'=>'use_monthout','_on'=>'Zxadminoverlook.id=Zxadminusemoney.overlook_id and Zxadminbudgetmoney.name_id=Zxadminusemoney.name_id'),
		'Zxadminname'=>array('name'=>'kemuname','_on'=>'Zxadminbudgetmoney.name_id=Zxadminname.id'),
		);
}
 ?>