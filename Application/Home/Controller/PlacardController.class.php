<?php 
namespace Home\Controller;
/**
* 
*/
class PlacardController extends BaseController
{
	public function index()
	{
		$model=M('Placard');
		$count=$model->where($map)->count();
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
		$list=$model->where($map)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();

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
		$model=D('Placard');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->add()){
			$this->error($model->_sql());
		}
		$this->success('添加公告成功!');
	}

	public function edit()
	{
		$model=M('Placard');
		$map['id']=I('get.id');
		$data=$model->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=D('Placard');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改公告成功!');
	}

	public function delete()
	{
		$model=M('Placard');
		$map['id']=I('get.id');
		if(false === $model->where($map)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}

	public function detail()
	{
		$model=M('Placard');
		$map['id']=I('get.id');
		$data=$model->where($map)->find();
		$data['content']=htmlspecialchars_decode($data['content']);
		$this->assign('data',$data);
		$this->display();
	}
}