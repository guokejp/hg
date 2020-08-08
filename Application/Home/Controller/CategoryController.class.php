<?php 
namespace Home\Controller;
/**
* 
*/
class CategoryController extends BaseController
{
	public function index()
	{
		$model=M('Category');
		$select=$model->order('id asc')->select();
		$list=categorylist($select);
		$this->assign('list',$list);
		$this->display();
	}

	public function add()
	{
		$pid=I('get.pid');
		if ($pid!=0) {
			$data=M('Category')->where('id='.$pid)->find();
			if (!$data){
				$this->error('参数错误');
			}
			$data['level']+=1;
			$this->assign('data',$data); 
		}
		$this->display();
	}

	public function insert()
	{
		$model=D('Category');
		$pid=I('post.pid');
		if ($pid) {
			$pfind=$model->where('id='.$pid)->count();
			if ($pfind) {
				$post_name=I('post.name');
				foreach ($post_name as $value) {
					$data['name']=$value;
					$data['pid']=$_POST['pid'];
					$data['once']=$_POST['once'];
					$data['level']=$_POST['level'];
					$data['bx_ord']= str_replace('_', '-', $_POST['bx_ord']);
					$sql[]=$data;
				}
				$model->addAll($sql);
			}else{
				$this->error('没有父级项');
			}
		}else{
			$_POST['bx_ord']= str_replace('_', '-', $_POST['bx_ord']);
			if(false === $model->create()){
				$this->error($model->getError());
			}
			if(false === $model->add()){
				$this->error($model->_sql());
			}
		}
		$this->success('添加类目成功!');
	}

	public function edit()
	{
		$map['id']=I('get.id');
		$data=M('Category')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=D('Category');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改类目成功!');
	}

	public function delete()
	{
		$model=M('Category');
		$id=I('get.id');
		if (M('Category')->where('pid='.$id)->count()) {
			$this->error('有子集项目');
		}
		if (M('Catbudget')->where('categoryid='.$id)->count()) {
			$this->error('本项目有预算');
		}
		if(false === $model->where('id='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}
}