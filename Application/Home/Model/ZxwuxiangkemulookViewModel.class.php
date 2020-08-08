<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ZxwuxiangkemulookViewModel extends ViewModel
{
	protected $viewFields = array(
		'Zxwuxiangoverlook'=>array('id','pid'),
		//预算项
		'Zxwuxiangmoney'=>array('name_id'=>'kemunameid','czadd'=>'budget_caizheng','nczadd'=>'budget_ncaizheng1','dfztadd'=>'budget_ncaizheng2',
			'_on'=>'Zxwuxiangoverlook.pid=Zxwuxiangmoney.overlook_id'),
		//收入支出项
		'Zxwuxiangusemoney'=>array('_table'=>'hg_zxwuxiangmoney','czadd'=>'use_caizheng','nczadd'=>'use_ncaizheng1','dfztadd'=>'use_ncaizheng2',
			'_on'=>'Zxwuxiangoverlook.id=Zxwuxiangusemoney.overlook_id and Zxwuxiangusemoney.name_id=Zxwuxiangmoney.name_id'),
		'Zxwuxiangname'=>array('name'=>'kemuname','_on'=>'Zxwuxiangmoney.name_id=Zxwuxiangname.id'),
		);
}
 ?>