<?php 
namespace Home\Controller;
/**
* 预算申请模块
*/
class IncomeController extends CommonController
{
	public function index()
	{
		$model=D('IncomeView');
		$map['Income.sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
		$map['Income.termid']=session(C('TERM_ID'));
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
		$categoryid=I('get.categoryid');
		if(empty($categoryid)){
			$categorylist=M('Category')->where('pid=0')->order('id asc')->select();
			$this->assign('categorylist',$categorylist);
			$this->display();
			exit();
		}
		$getid=$categoryid;
		$once=M('Category')->where('id='.$getid)->getField('once');
		$child=M('Category')->where('pid='.$getid)->select();
		if ($child) {
			$data['once']=$once;
			$data['have_child']=1;
			$data['child']=$child;
			$this->assign('data',$data);
		}else{
			$data['once']=$once;
			$nochild=M('Category')->where('id='.$getid)->find();
			$data['have_child']=0;
			$data['child']=$nochild;
		}
		$this->assign('data',$data);
		$this->orderid=$this->get_incomeid();
		if($data['once']== 1){
			$this->display('add1');
		}else{
			$this->display('add2');
		}
	}

	public function insert()
	{
		$once=I('post.once');
		$money=I('post.money');
		if ($once==0&&$money<0) {
			$this->error('一次性包干金额不能小于零');
		}
		$model=D('Income');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->add()){
			$this->error($model->_sql());
		}
		$this->success('申请预算成功!');
	}

	public function edit()
	{
		$map['id']=I('get.id');
		$data=D('IncomeView')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=D('Income');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改预算申请成功!');
	}

	public function delete()
	{
		$model=M('Income');
		$id=I('get.id');
		if(false === $model->where('id='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}

	public function audit()
	{
		$categorylist=M('Category')->order('id asc')->select();
		$this->assign('categorylist',$categorylist);
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionlist=M('Section')->where(array('unitid'=>session(C('ADMIN_AUTH_UNITID')),'selock'=>'0'))->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		$termlist=M('Term')->order('id asc')->select();
		$this->assign('termlist',$termlist);
		unset($map);

		$model=D('IncomeView');
		$map['Income.unitid']=session(C('ADMIN_AUTH_UNITID'));
		$map['Income.termid']=session(C('TERM_ID'));
		if(I('post.categoryid')!==''){
			$map['categoryid']=I('post.categoryid');
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
		$list=$model->where($map)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('list',$list);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}

	public function check()
	{
		$map['id']=I('get.id');
		$data=D('IncomeView')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function allow()
	{
		$model=D('Income');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$map['id']=I('post.id');//获取预算单据信息
		$data=$model->where($map)->find();
		unset($data['id']);
		if ($_POST['status']==1) {//审核通过
			if($data['once']==1){//包干预算
				unset($map);
				$map['termid']=$data['termid'];
				$map['sectionid']=$data['sectionid'];
				$map['categoryid']=$data['categoryid'];
				if(null === D('Catbudget')->where($map)->find()){
					if ($data['confirm']<0) {
						$this->error('没有初始预算，不能调减');
					}
					$data['money']=$data['confirm'];
					$data['init_money']=$data['confirm'];
					D('Catbudget')->add($data);
					$data['type']=3;
					M('Catlog')->add($data);
				}else{
					//原基础增加
					$catbud=D('Catbudget')->where($map)->getField('money');
					if ($catbud+$data['confirm']<0) {
						$this->error('调整后不能小于零');
					}
					D('Catbudget')->where($map)->setInc('money',$data['confirm']);
					D('Catbudget')->where($map)->setInc('init_money',$data['confirm']);
					$data['money']=$data['confirm'];
					$data['type']=3;
					M('Catlog')->add($data);
				}
			}else{
				if ($data['confirm']<0) {
					$this->error('一次性包干不能小于零');
				}
				$data['status']=0;
				D('Oncebudget')->add($data);
			}
		}
		$this->success('审核成功!');
	}

	public function view()
	{
		$map['id']=I('get.id');
		$data=D('IncomeView')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function search()
	{

		$model=D('CatbudgetView');
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$map['termid']=session(C('TERM_ID'));
		$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
		$list=$model->where($map)->order('id asc')->select();
		foreach($list as $key => $val){
			$list[$key]['first']=0;
			$list[$key]['adjustment']=0;
			$list[$key]['used']=0;
			$map['sectionid']=$val['sectionid'];
			$map['categoryid']=$val['categoryid'];
			$sublist=M('Catlog')->where($map)->select();
			//print_r($sublist);
			// print_r($sublist);
			// print_r('<hr />');
			foreach($sublist as $subval){
				switch($subval['type']){
					case "0":
						$list[$key]['first']+=$subval['money'];
						break;
					case "1":
						$list[$key]['adjustment']+=$subval['money'];
						break;
					case "2":
						$list[$key]['adjustment']-=$subval['money'];
						break;
					case "3":
						$list[$key]['adjustment']+=$subval['money'];
						break;
					case "4":
						$list[$key]['used']+=$subval['money'];
						break;
				}
			}
		}
		$this->assign('list',$list);
		$this->display();
	}
}