<?php 
namespace Home\Model;
use Think\Model\ViewModel;
/**
* 
*/
class ConferenceViewModel extends ViewModel
{
	protected $viewFields = array(
		'Conference'=>array('id','termid','name','type','number','month','duration','average','basemoney','sectionid','money','unitid','timestamp','status','confirm'),
		'Section'=>array('name'=>'sectionname','_on'=>'Section.id=Conference.sectionid'),
		);
}
 ?>