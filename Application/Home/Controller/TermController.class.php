<?php 
namespace Home\Controller;
/**
* 
*/
class TermController extends BaseController
{

	public function index()
	{
		$model=D('TermView');
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
		$list=$model->where($map)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();

		$this->assign('list',$list);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}

	public function incTerm()
	{
		$model=M('Term');
		$data['staffid']=session(C('ADMIN_AUTH_ID'));
		$data['timestamp']=time();
		$data['status']=1;
		$lastterm=$model->order('id desc')->getField('name');
		if($lastterm !== null){
			$model->where('name='.$lastterm)->setField('status',0);
			$data['name']=intval($lastterm)+1;
		}else{
			$data['name']=date('Y');
		}

		if(false === $id=$model->add($data)){
			$this->error('结转失败!'.$model->_sql());
		}
		session(C('TERM_ID'),$id);
		session(C('TERM_NAME'),$data['name']);
		$this->success('账期结转成功!');
	}
}
 ?>