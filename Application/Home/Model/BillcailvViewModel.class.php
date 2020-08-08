<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class BillcailvViewModel extends ViewModel
{
	protected $viewFields = array(
		'Bill'=>array('id','remark','confirm'),
		'BillCailv'=>array('place','day','type','people','date','_on'=>'BillCailv.billid=Bill.id'),
		);
}
 ?>