<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ZxwuxiangdanweilookViewModel extends ViewModel
{
	protected $viewFields = array(
		'Zxwuxiangmoney'=>array('overlook_id'=>'useoverlookid','name_id','czadd'=>'use_caizheng','nczadd'=>'use_ncaizheng1','dfztadd'=>'use_ncaizheng2'),
		'Zxwuxiangoverlook'=>array('pid'=>'budgetoverlookid','unitid','_on'=>'Zxwuxiangoverlook.id=Zxwuxiangmoney.overlook_id'),
		'Zxwuxiangbudgetmoney'=>array('_table'=>'hg_zxwuxiangmoney','czadd'=>'budget_caizheng','nczadd'=>'budget_ncaizheng1','dfztadd'=>'budget_ncaizheng2',
										'_on'=>'Zxwuxiangoverlook.pid=Zxwuxiangbudgetmoney.overlook_id 
												and Zxwuxiangmoney.name_id=Zxwuxiangbudgetmoney.name_id'),
		'Unit'=>array('name'=>'unitname','_on'=>'Zxwuxiangoverlook.unitid=Unit.id'),

		);
}
 ?>