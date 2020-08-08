<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ZxwuxiangbudgetmoneyViewModel extends ViewModel
{
	protected $viewFields = array(
		'Zxwuxiangmoney'=>array('name_id','czyunxing','czjishi','czshoufei','czother',
									'nczotherin','nczdfzx','dfdf','dfzypay'),
		'Zxwuxiangname'=>array('name','_on'=>'Zxwuxiangmoney.name_id=Zxwuxiangname.id'),
		);
}
 ?>