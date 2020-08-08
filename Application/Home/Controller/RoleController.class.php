<?php 
namespace Home\Controller;
/**
* 
*/
class RoleController extends BaseController
{
	public function index()
	{
		$model=M('Role');
		$count=$model->count();
		if(I('post.numPerPage')!==''){
			$listRows=I('post.numPerPage');
		}else{
			$listRows=50;
		}
		if(I('post.pageNum') !=='') {
			$nowPage=I('post.pageNum');
		}else{
			$nowPage=1;
		}
		$_GET['p']=$nowPage;
		$p=new \Think\Page($count,$listRows);
		$list=$model->where($map)->order('id asc')->limit($p->firstRow.','.$p->listRows)->select();

		$this->assign('list',$list);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}

	public function add()
	{
		$this->display();
	}

	public function insert()
	{
		$model=D('Role');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->add()){
			$this->error($model->_sql());
		}
		$this->success('添加角色成功!');
	}

	public function edit()
	{
		$map['id']=I('get.id');
		$data=M('Role')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		if (I('post.id')<7) {
			$this->error('系统默认，不能修改');
		}
		$model=D('Role');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改角色成功!');
	}

	public function delete()
	{
		if (I('get.id')<7) {
			$this->error('系统默认，不能删除');
		}
		$model=M('Role');
		$id=I('get.id');
		if(M('Staff')->where('roleid='.$id)->count()>0){
			$this->error('该角色下存在员工，无法删除！');
		}
		$this->error('111');
		if(false === $model->where('id='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}

	public function confirm()
	{
		$id=I('get.id');
		$model=M('Role');
		$map['id']=$id;
		$data=$model->where($map)->find();
		$this->assign('data',$data);
		$rulelist=M('Rule')->order('id asc')->select();
		$this->assign('rulelist',$rulelist);
		$this->display();
	}

	public function updaterule()
	{
		$id=I('post.id');
		$rules_arr=I('post.rules');
		if(empty($rules_arr)){
			$this->error('没有赋予任何权限！');
		}
		$data['id']=$id;
		$data['rules']=implode(',', $rules_arr);
		$model=D('Role');
		if(false === $model->create($data)){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('权限配置成功!');
	}
}