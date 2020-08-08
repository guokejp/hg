<?php 
namespace Home\Controller;
/**
* 
*/
class UnitController extends BaseController
{
	public function index()
	{
		$model=M('Unit');
		$map['unitlock']='0';
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
		$model=D('Unit');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->add()){
			$this->error($model->_sql());
		}
		$this->success('添加单位成功!');
	}

	public function edit()
	{
		$map['id']=I('get.id');
		$data=M('Unit')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=D('Unit');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改单位成功!');
	}

	public function delete()
	{
		$model=M('Unit');
		$id=I('get.id');
		if(M('Section')->where(array('unitid'=>$id,'selock'=>'0'))->count()>0){
			$this->error('该单位下存在部门，无法删除！');
		}
		if(false === $model->where('id='.$id)->setField('unitlock','1')){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}
}