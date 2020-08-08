<?php 
namespace Home\Controller;
use Think\Controller;
/**
* 
*/
class LoginController extends Controller
{
	public function index()//登陆页面
	{
		session(null);
		$this->display();
	}

	public function login()//登陆验证
	{
		if('' === $username=I('post.username')){
			$this->error('用户名不能为空!');
		}
		if('' === $password=I('post.password')){
			$this->error('密码不能为空!');
		}
		$map['number']=$username;
		$model=D('StaffView');
		if(false == $user=$model->where($map)->find()){
			$this->error('该工号不存在!');
		}
		if ($user['locked']=='1') {
			$this->error('该人员已被管理员删除');
		}
		if($user['password'] != md5($password)){
			$this->error('密码错误!');
		}
		if ($user['locked']=='1') {
			$this->error('人员已被删除!');
		}
		session(C('ADMIN_AUTH_ID'),$user['id']);
		session(C('ADMIN_AUTH_NAME'),$user['name']);
		session(C('ADMIN_AUTH_NUMBER'),$user['number']);
		session(C('ADMIN_AUTH_SECTIONID'),$user['sectionid']);
		session(C('ADMIN_AUTH_SECTIONNAME'),$user['sectionname']);
		session(C('ADMIN_AUTH_UNITID'),$user['unitid']);
		session(C('ADMIN_AUTH_UNITNAME'),$user['unitname']);
		session(C('ADMIN_AUTH_ROLEID'),$user['roleid']);

		$this->redirect('Index/index');
	}

	public function logout()//退出登录
	{
		session(null);
		$this->success('退出成功!',U('Login/index'));
	}
}