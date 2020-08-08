<?php
namespace Home\Controller;
use Think\Controller;
/**
* 
*/
class BaseController extends Controller
{
	public function _initialize()
	{	
		if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0')){
	    	session(null);
			$this->error('请升级ie浏览器!',U('Login/index'));
		}
		if(false===session('?'.C('ADMIN_AUTH_ID'))	){//判断是否登陆
			$this->redirect('Login/index');
		}
		if(session(C('ADMIN_AUTH_ID')) == 1){//判断是否超级管理员
			return true;
		}
		// //if(in_array(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME, C('AUTH_ACCESS'))){//判断是否在权限判断列表
		// 	$Auth = new \Think\Auth();
		// 	if(!$Auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME, session(C('ADMIN_AUTH_ID')))){//判断权限
		// 		$this->error('没有权限');
		// 	}
		// //}
	}
}
