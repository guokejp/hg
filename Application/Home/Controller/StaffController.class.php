<?php 
namespace Home\Controller;
/**
* 
*/
class StaffController extends BaseController
{
	public function index()
	{
		$model=M('Unit');
		$unitlist=$model->where(array('unitlock'=>'0'))->order('id asc')->select();
		$this->assign('unitlist',$unitlist);
		$unitid=I('request.unitid');
		if(empty($unitid)){
			$this->display();
			exit();
		}
		unset($model);
		$model=M('Section');
		$map['unitid']=$unitid;
		$sectionlist=$model->where($map)->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);

		$model=D('StaffView');
		if(I('post.name')!==''){
			$map['name']=array('LIKE','%'.trim(I('post.name')).'%');
		}
		if(I('post.sectionid')!==''){
			$map['sectionid']=I('post.sectionid');
		}
		$map['locked']='0';
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
		$list=$model->where($map)->order('Staff.id asc')->limit($p->firstRow.','.$p->listRows)->select();

		$this->assign('list',$list);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}

	public function add()
	{
		$unitid=I('get.unitid');
		if(empty($unitid)){
			$this->error('未选择单位，请选择单位！');
		}
		$map['unitid']=$unitid;
		$model=M('Section');
		$sectionlist=$model->where($map)->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		$rolelist=M('Role')->order('id asc')->select();
		$this->assign('rolelist',$rolelist);
		$this->display();
	}

	public function insert()
	{
		$model=D('Staff');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->add()){
			$this->error($model->_sql());
		}
		$this->success('添加员工成功!');
	}

	public function edit()
	{
		$map['id']=I('get.id');
		$data=D('StaffView')->where($map)->find();
		$this->assign('data',$data);

		unset($map);
		$map['unitid']=$data['unitid'];
		$model=M('Section');
		$sectionlist=$model->where($map)->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		$rolelist=M('Role')->order('id asc')->select();
		$this->assign('rolelist',$rolelist);
		$this->display();
	}

	public function editpass()
	{
		$getid=I('get.id');
		if ($getid) {
			$map['id']=I('get.id');
		}else{
			$map['id']=session(C('ADMIN_AUTH_ID'));
		}
		
		$data=M('Staff')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=D('Staff');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改员工资料成功!');
	}

	public function delete()
	{
		$model=M('Staff');
		$id=I('get.id');
		//$this->error('基础数据删除维护中！');
		if (M('Bill')->where(array('staffid'=>$id,'status'=>'0'))->count()>0) {
			$this->error('员工有未完成的报销数据');
		}
		if(false === $model->where('id='.$id)->setField('locked',1)){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}
}
