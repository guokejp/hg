<?php 
namespace Home\Controller;
/**
* 专项模块
*/
class SpecialController extends CommonController
{
	public function index()
	{
		$model=M('Special');
		$select=$model->order('id asc')->select();
		$list=speciallist($select);
		$this->assign('list',$list);
		$this->display();
	}
	public function add()
	{
		$pid=I('get.pid');
		if ($pid!=0) {
			$data=M('Special')->where('id='.$pid)->find();
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
		$model=D('Special');
		$pid=I('post.pid');
		if ($pid) {
			$pfind=$model->where('id='.$pid)->count();
			if ($pfind) {
				$post_name=I('post.name');
				foreach ($post_name as $value) {
					$data['unitid']=session(C('ADMIN_AUTH_UNITID'));
					$data['name']=$value;
					$data['pid']=$_POST['pid'];
					$data['gov']=$_POST['gov'];
					$data['year']=$_POST['year'];
					$data['level']=$_POST['level'];
					//$data['bx_ord']=str_replace('_', '-', $_POST['bx_ord']);
					$sql[]=$data;
				}
				$model->addAll($sql);
			}else{
				$this->error('没有父级项');
			}
		}else{
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
		$data=M('Special')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=M('Special');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改类目成功!');
	}
	public function delete(){
		$id=I('get.id');
		$model=M('Special');
		if ($model->where('pid='.$id)->count()) {
			$this->error('有子项目');
		}
		if (M('Spebudget')->where('specialid='.$id)->count()) {
			$this->error('本项目有预算');
		}
		if(false === $model->where('id='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');
	}
	
}
 ?>