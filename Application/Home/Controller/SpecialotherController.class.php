<?php 
namespace Home\Controller;
/**
* 预算申请模块
*/
class SpecialotherController extends CommonController
{
	public function index()
	{
		$model=D('SpecialOtherView');
		$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
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

	public function insert(){
		$model=D('SpecialOther');
		if (false===$model->create()) {
			$this->error('系统发生错误');
		}
		if (false===$model->add()) {
			$this->error('添加出错'.$model->getLastSql());
		}else{
			$this->success('添加成功');
		}
	}
	public function edit(){
		$id=I('get.id');
		$model=M('SpecialOther');
		$data=$model->where(array('id'=>$id))->find();
		$this->assign('data',$data);
		$this->display();
	}
	public function update(){
		$model=M('SpecialOther');
		if (I('post.confirm')==1) {
			$this->error('审核通过的不能修改');
		}
		if (false===$model->create()) {
			$this->error('修改出错');
		}
		if (false===$model->save()) {
			$this->error('修改出错'.$model->getLastSql());
		}else{
			$this->success('修改成功');
		}
	}
	public function delete(){
		$id=I('get.id');
		$model=M('SpecialOther');
		if ($model->where(array('id'=>$id))->delete()) {
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	public function audit(){
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionlist=M('Section')->where(array('unitid'=>session(C('ADMIN_AUTH_UNITID')),'selock'=>'0'))->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		$yearlist=M('SpecialOther')->distinct(true)->where($map)->field('year')->order('id asc')->select();
		$this->assign('yearlist',$yearlist);
		unset($map);

		$model=D('SpecialOtherView');
		$map['SpecialOther.unitid']=session(C('ADMIN_AUTH_UNITID'));
		if(I('post.sectionid')!==''){
			$map['sectionid']=I('post.sectionid');
		}
		if(I('post.year')!==''){
			$map['year']=I('post.year');
		}
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
	public function view()
	{
		$map['id']=I('get.id');
		$data=D('SpecialOtherView')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}
	public function check()
	{
		$map['id']=I('get.id');
		$data=D('SpecialOtherView')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}
	public function allow(){
		$model=M('SpecialOther');
		if (false===$model->create()) {
			$this->error('发生错误');
		}
		if (false===$model->save()) {
			$this->error('修改失败'.$model->getLastSql());
		}else{
			$this->success('添加成功');
		}
	}
}