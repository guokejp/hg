<?php
namespace Home\Controller;
/**
* 
*/
class IndexController extends BaseController
{
	public function index()
	{
		$model=M('Placard');
		$list=$model->order('id desc')->limit(10)->select();
		$this->assign('list',$list);
		$this->display();
	}

	public function timer()
	{
		echo time();
	}
}
