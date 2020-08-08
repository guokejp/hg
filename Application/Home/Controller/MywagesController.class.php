<?php 
namespace Home\Controller;
	/**
	* 员工查询工资控制器
	*/
	class MywagesController extends CommonController
	{
		public function index()
		{	
			//根据用户工号过滤工资
			$user=session(C('ADMIN_AUTH_NUMBER'));
			$condition['num']=$user;
			//判断属于哪个类型工资表
			$num=$user;
			$select1=M('Wagesgq')->where(array('num'=>$num))->count();
			$select2=M('Wageshg')->where(array('num'=>$num))->count();
			$select3=M('Wagesjsj')->where(array('num'=>$num))->count();
			$select4=M('Wagestx')->where(array('num'=>$num))->count();
			if ($select1!=0) {
				$model=M('Wagesgq');
				$this->_list($model,$condition);
				$this->display('gq');
			}elseif ($select2!=0) {
				$model=M('Wageshg');
				$this->_list($model,$condition);
				$this->display('hg');
			}elseif ($select3!=0) {
				$model=M('Wagesjsj');
				$this->_list($model,$condition);
				$this->display('jsj');
			}elseif ($select4!=0) {
				$model=M('Wagestx');
				$this->_list($model,$condition);
				$this->display('tx');
			}
		}
		protected function _list($model,$map=array())
		{

			//if(I('post.invoiceid')!==''){
			//	$map['invoiceid']=array('LIKE','%'.I('post.invoiceid').'%');
			//}

			//获取总数
			$count=$model->where($map)->count();

			//获取每页显示数量
			if(I('post.numPerPage')!==""){
				$listRows=I('post.numPerPage');
			}else{
				$listRows=20;
			}

			//获取当前页码
			if(I('post.pageNum') !=="") {
				$nowPage=I('post.pageNum');
			}else{
				$nowPage=1;
			}
			$_GET['p']=$nowPage;
			$p = new \Think\Page($count,$listRows);

			$list = $model->where($map)->order('year desc')->limit($p->firstRow.','.$p->listRows)->select();
			
			//分页显示
			$page = $p->show();

			$this->assign('section',$section);
			$this->assign('list',$list);
			$this->assign("totalCount",$count);
			$this->assign("numPerPage",$p->listRows);
			$this->assign("currentPage",$nowPage);
		}
		
	}
 ?>