<?php 
namespace Home\Controller;
/**
* 会议计划模块
*/
class ConferenceController extends CommonController
{
	public function index()
	{
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionlist=M('Section')->where(array('unitid'=>$map['unitid'],'selock'=>'0'))->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		$termlist=M('Term')->order('id asc')->select();
		$this->assign('termlist',$termlist);
		$model=D('ConferenceView');
		if(I('post.name')!==''){
			$map['name']=array('LIKE','%'.trim(I('post.name')).'%');
		}
		if(I('post.sectionid')!==''){
			$map['sectionid']=I('post.sectionid');
		}
		if(I('post.termid')!==''){
			$map['termid']=I('post.termid');
		}else{
			$map['termid']=session(C('TERM_ID'));
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
		$list=$model->where($map)->order('id asc')->limit($p->firstRow.','.$p->listRows)->select();

		$this->assign('list',$list);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}

	public function add()
	{
		$model=M('Section');
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$map['selock']='0';
		$sectionlist=$model->where($map)->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		$this->display();
	}

	public function insert()
	{
		$model=D('Conference');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->add()){
			$this->error($model->_sql());
		}
		$this->success('添加会议计划成功!');
	}

	public function edit()
	{
		$model=M('Section');
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$map['selock']='0';
		$sectionlist=$model->where($map)->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		unset($map);
		$map['id']=I('get.id');
		$data=M('Conference')->where($map)->find();
		if($data['termid'] !=session(C('TERM_ID'))){
			$this->error('不是本年度计划，无法修改！');
		}
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=D('Conference');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改会议计划成功!');
	}

	public function delete()
	{
		$model=M('Conference');
		$id=I('get.id');
		$data=$model->where($map)->find();
		if($data['termid'] !=session(C('TERM_ID'))){
			$this->error('不是本年度计划，无法删除！');
		}
		$where['type']=1;
		$where['projectid']=$id;
		if (M('Bill')->where($where)->count()) {
			$this->error('有报销数据，不能删除');
		}
		if(false === $model->where('id='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}
}