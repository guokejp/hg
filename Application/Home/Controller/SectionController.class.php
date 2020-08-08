<?php 
namespace Home\Controller;
/**
* 
*/
class SectionController extends BaseController
{
	public function index()
	{
		$model=M('Unit');
		$map['unitlock']='0';
		$unitlist=$model->where($map)->order('id asc')->select();
		$this->assign('unitlist',$unitlist);
		$unitid=I('get.unitid');
		if(empty($unitid)){
			$this->display();
			exit();
		}
		unset($model);
		unset($map);
		$model=M('Section');
		$map['unitid']=$unitid;
		$map['selock']='0';
		$list=$model->where($map)->order('id asc')->select();
		$this->assign('list',$list);
		$this->display();
	}

	public function add()
	{
		$unitid=I('get.unitid');
		if(empty($unitid)){
			$this->error('未选择单位，请选择单位！');
		}
		$this->display();
	}

	public function insert()
	{
		$model=D('Section');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->add()){
			$this->error($model->_sql());
		}
		$this->success('添加部门成功!');
	}

	public function edit()
	{
		$map['id']=I('get.id');
		$data=M('Section')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=D('Section');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改部门成功!');
	}

	public function delete()
	{
		$model=M('Section');
		$id=I('get.id');
		$termid=session(C('TERM_ID'));

		if(M('Catbudget')->where(array('sectionid'=>$id,'termid'=>$termid))->count()>0){
			$this->error('该部门下存在包干预算，无法删除！');
		}
		if(M('Spebudget')->where('sectionid='.$id)->sum('money') >0 ){
			$this->error('该部门下存在专项预算，无法删除！');
		}
		if(M('Staff')->where(array('sectionid'=>$id,'locked'=>'0'))->count()>0){
			$this->error('该部门下存在员工，无法删除！');
		}
		if(false === $model->where('id='.$id)->setField('selock','1')){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}
}