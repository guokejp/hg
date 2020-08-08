<?php 
namespace Home\Controller;
/**
* 包干项目模块
*/
class CatbudgetController extends CommonController
{
	public function index()
	{
		$model=M('Category');
		$categoryselect=$model->order('id asc')->select();
		$categorylist=category_each($categoryselect);
		$this->assign('categorylist',$categorylist);
		$categoryid=I('get.categoryid');
		if(empty($categoryid)){
			$this->display();
			exit();
		}
		unset($model);
		
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		if(I('get.once')==1){
			$model=D('CatbudgetView');
			$map['categoryid']=$categoryid;
			$map['termid']=session(C('TERM_ID'));
			$list=$model->where($map)->order('id asc')->select();
			$this->assign('list',$list);
			$this->display();
		}else{
			$model=D('OncebudgetView');
			$map['categoryid']=$categoryid;
			$map['termid']=session(C('TERM_ID'));
			$list=$model->where($map)->order('id asc')->select();
			$this->assign('list',$list);
			$this->display('index1');
		}


	}

	public function add()
	{
		$categoryid=I('get.categoryid');
		if(empty($categoryid)){
			$this->error('未选择类目，请选择类目！');
		}
		$map['categoryid']=$categoryid;//获取已有预算的部门id
		$map['termid']=session(C('TERM_ID'));
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionids=M('Catbudget')->where($map)->getField('sectionid',true);
		unset($map);
		$model=M('Section');//枚举所有部门
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		if(null !== $sectionids){
			$map['id']=array('not in',$sectionids);
		}
		$sectionlist=$model->where($map)->order('id asc')->select();
		if(null === $sectionlist){
			$this->error('该预算项目所有部门已经初始化，请使用调整功能！');
		}
		$this->assign('sectionlist',$sectionlist);
		$this->display();
	}

	public function insert()
	{
		$termid_arr=I('post.termid');
		$unitid_arr=I('post.unitid');
		$sectionid_arr=I('post.sectionid');
		$staffid_arr=I('post.staffid');
		$categoryid_arr=I('post.categoryid');
		$money_arr=I('post.money');
		$init_money_arr=I('post.money');

		$model=D('Catbudget');
		foreach($termid_arr as $key=>$val){
			$res=array(
				'termid'=>$termid_arr[$key],
				'unitid'=>$unitid_arr[$key],
				'sectionid'=>$sectionid_arr[$key],
				'staffid'=>$staffid_arr[$key],
				'categoryid'=>$categoryid_arr[$key],
				'money'=>$money_arr[$key],
				'init_money'=>$money_arr[$key],
				);
				if(empty($res['money'])){
					continue;
				}
				if(false === $res=$model->create($res)){
					$this->error($model->getError());
				}
			$data[]=$res;
		}
		foreach ($data as $value) {
			$model->create($value);
			$model->add();
		}
		/*if(false === $model->addAll($data)){
			$this->error($model->_sql());
		}*/
		M('Catlog')->addALL($data);
		$this->success('初始化预算成功!');
	}

	public function edit()
	{
		$map['id']=I('get.id');
		$data=D('CatbudgetView')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$model=D('Catbudget');
		$post=I('post.');
		$map['id']=$post['id'];
		$data=$model->where($map)->find();
		$data['money']=$post['money'];
		unset($data['id']);
		if($post['operate'] == '1'){
			$model->where($map)->setInc('money',$post['money']);
			$model->where($map)->setInc('init_money',$post['money']);
			$data['type']=1;
			M('Catlog')->add($data);
		}else{
			$model->where($map)->setDec('money',$post['money']);
			$model->where($map)->setDec('init_money',$post['money']);
			$data['type']=2;
			M('Catlog')->add($data);
		}
		$this->success('预算调整成功!');
	}

	public function delete()
	{
		$model=M('Catbudget');
		$id=I('get.id');
		$catebudgt=M('Catbudget')->where('id='.$id)->find();
		$where['termid']=$catebudgt['termid'];
		$where['projectid']=$catebudgt['categoryid'];
		$where['sectionid']=$catebudgt['sectionid'];
		$count=M('Bill')->where($where)->count();
		if($count){
			$this->error('有报销数据，不能删除!');
		}
		if(false === $model->where('id='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}

	public function view()
	{
		$model=D('CatbudgetView');
		$map['id']=I('get.id');
		$data=$model->where($map)->find();
		$this->assign('data',$data);
		unset($map);
		$map['termid']=session(C('TERM_ID'));
		$map['sectionid']=$data['sectionid'];
		$map['categoryid']=$data['categoryid'];
		$list=D('CatlogView')->where($map)->order('id asc')->select();
		$this->assign('list',$list);
		$this->display();
	}

	public function report()
	{
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionlist=M('Section')->where(array('unitid'=>$map['unitid'],'selock'=>'0'))->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		$termlist=M('Term')->order('id desc')->select();
		$this->assign('termlist',$termlist);
		$pcat=M('Category')->where(array('pid'=>'0','once'=>'1'))->select();
		$this->assign('pcat',$pcat);

		$model=D('CatbudgetView');
		if(I('post.sectionid')!==''){
			$map['sectionid']=I('post.sectionid');
		}
		if(I('post.termid')!==''){
			$map['termid']=I('post.termid');
		}else{
			$map['termid']=session(C('TERM_ID'));
		}
		//子集包干类目
		if (!empty($_POST['pcat'])&&empty($_POST['ccat'])) {

			$cat=M('Category')->where('pid='.I('post.pcat'))->getField('id',true);
			$cat[]=I('post.pcat');
			$map['categoryid']=array('in',$cat);
		}elseif (I('post.ccat')) {
			$map['categoryid']=I('post.ccat');
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
		foreach($list as $key => $val){
			$list[$key]['first']=0;
			$list[$key]['adjustment']=0;
			$list[$key]['used']=0;
			$map['sectionid']=$val['sectionid'];
			$map['categoryid']=$val['categoryid'];
			$sublist=M('Catlog')->where($map)->select();

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
			/*统计审核和未审核报销单*/
			$ye_map['termid']=$val['termid'];
			$ye_map['unitid']=$val['unitid'];
			$ye_map['sectionid']=$val['sectionid'];
			$ye_map['projectid']=$val['categoryid'];
			$ye_map['type']='0';
			$ye_map['status']=array('in','1,2');
			$list[$key]['ched_amon']=M('Bill')->where($ye_map)->count();
			unset($ye_map);

			$ye_map['termid']=$val['termid'];
			$ye_map['unitid']=$val['unitid'];
			$ye_map['sectionid']=$val['sectionid'];
			$ye_map['projectid']=$val['categoryid'];
			$ye_map['type']='0';
			$ye_map['status']='0';
			$list[$key]['noched_amon']=M('Bill')->where($ye_map)->count();
			unset($ye_map);

		}

		$this->assign('list',$list);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}
	public function getcheck(){
		$get=I('get.');
		switch ($get['way']) {
			case 'be_cvheck'://已审核
				$map['status']=array('in','1,2');
				break;
			case 'no_cvheck'://未审核
				$map['status']='0';
				break;
			default:
				$this->error('参数错误') ;
				break;
		}
		$catbud=M('Catbudget')->where('id='.$get['id'])->find();
		$map['termid']=$catbud['termid'];
		$map['unitid']=$catbud['unitid'];
		$map['sectionid']=$catbud['sectionid'];
		$map['projectid']=$catbud['categoryid'];
		$map['type']='0';

		$model=D('BillView');
		$list=$model->where($map)->order('id desc')->select();
		$this->assign('list',$list);
		$this->display();
	}
	public function get_cailv(){
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionlist=M('Section')->where($map)->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);

		$model=D('BillcailvView');
		if(I('post.sectionid')!==''){
			$map['sectionid']=I('post.sectionid');
		}
		$map['bill.type']='0';
		$map['termid']=session(C('TERM_ID'));
		$map['status']='1';

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
	public function catbud_look(){
		/***************************一级包干*******************************/
		//表头
		$pcatgroy=M('Category')->where(array('pid'=>0,'once'=>1))->order('id')->field('id,name')->select();
		//滤掉有子包干项
		foreach ($pcatgroy as $value) {
			if (!M('Category')->where(array('pid'=>$value['id']))->count()) {
				$p_catgroy[]=$value;
			}
		}
		$this->assign('p_catgroy',$p_catgroy);
		//表数据
		$p_cate_list=parent::appli_cate_p();
		$this->assign('p_cate_list',$p_cate_list);
		/***************************二级包干************************/
		$c_cate_list=parent::appli_cate_c();
		$this->assign('c_cate_list',$c_cate_list);
		/***********************专项*****************************/
		/*$c_spe_list=parent::appli_spe_c();
		$this->assign('c_spe_list',$c_spe_list);
		*/
		$this->display();
	}
	//前端ajax
	public function get_c_cat(){
		$pid=I('post.pid');
		if (empty($pid)) {
			exit();
		}
		$data=M('Category')->where('pid='.$pid)->field('id,name')->select();
		$this->AjaxReturn($data);
	}
}