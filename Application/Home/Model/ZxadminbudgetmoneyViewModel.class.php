<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ZxadminbudgetmoneyViewModel extends ViewModel
{
	protected $viewFields = array(
		'Zxadminbudgetmoney'=>array('name_id','inlastadd','intwolastadd','inthiserxia','inthistiaozheng',
									'outjiezhuanadd','outjiezhuantwolast','outthisinoutbudget'),
		'Zxadminname'=>array('name','_on'=>'Zxadminbudgetmoney.name_id=Zxadminname.id'),
		);
}
 ?>