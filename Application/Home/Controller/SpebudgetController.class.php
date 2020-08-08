<?php 
namespace Home\Controller;
/**
* 专项模块
*/
class SpebudgetController extends CommonController
{
	public function index()
	{
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionlist=M('Section')->where(array('unitid'=>$map['unitid'],'selock'=>'0'))->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		if (I('post.year')!=='') {
			$termyear=I('post.year');
			$pspe=M('Special')->where(array('pid'=>'0','year'=>$termyear))->select();
		}else{
			$termyear=session(C('TERM_NAME'));
			$pspe=M('Special')->where(array('pid'=>'0','year'=>$termyear))->select();
		}
		$this->assign('pspe',$pspe);
		$pyear=M('Special')->where('pid=0')->distinct(true)->order('year desc')->field('year')->select();
		$this->assign('pyear',$pyear);
		// $termlist=M('Term')->order('id asc')->select();
		// $this->assign('termlist',$termlist);

		$model=D('SpebudgetView');
		if(I('post.name')!==''){
			$map['Special.name']=array('LIKE','%'.trim(I('post.name')).'%');
		}
		if(I('post.sectionid')!==''){
			$map['sectionid']=I('post.sectionid');
		}
		if (I('post.year')!=='') {
			$map['year']=I('post.year');
		}else{
			$map['year']=session(C('TERM_NAME'));
		}
		//子集包干类目
		if (!empty($_POST['pspe'])&&empty($_POST['cspe'])) {
			$spe=M('Special')->where('pid='.I('post.pspe'))->getField('id',true);
			$spe[]=I('post.pspe');
			$map['specialid']=array('in',$spe);
		}elseif (I('post.cspe')) {
			$map['specialid']=I('post.cspe');
		}
		// if(I('post.termid')!==''){
		// 	$map['termid']=I('post.termid');
		// }else{
		// 	$map['termid']=session(C('TERM_ID'));
		// }
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
		$selectlist=$model->where($map)->order('id asc')->limit($p->firstRow.','.$p->listRows)->select();
		/*统计审核和未审核报销单*/
		foreach ($selectlist as $value) {
			/*已审批*/
			//一般专项
			$ye_map['unitid']=$value['unitid'];
			$ye_map['sectionid']=$value['sectionid'];
			$ye_map['projectid']=$value['specialid'];
			$ye_map['type']='3';
			$ye_map['status']=array('in','1,2');
			$ched_amon_s=M('Bill')->where($ye_map)->count();
			unset($ye_map['projectid']);
			unset($ye_map['type']);
			//采购
			$contra_id=M('Contract')->where(array('specialid'=>$value['id'],'sectionid'=>$value['sectionid']))->getField('id');
			$ye_map['projectid']=$contra_id;
			$ye_map['type']='5';
			$ched_amon_c=M('Bill')->where($ye_map)->count();
			$value['ched_amon']=$ched_amon_s+$ched_amon_c;
			unset($ye_map);
			/*已审批*/
			//一般专项
			$ye_map['unitid']=$value['unitid'];
			$ye_map['sectionid']=$value['sectionid'];
			$ye_map['projectid']=$value['specialid'];
			$ye_map['type']='3';
			$ye_map['status']='0';
			$noched_amon_s=M('Bill')->where($ye_map)->count();
			unset($ye_map['projectid']);
			unset($ye_map['type']);
			//采购
			$contra_id=M('Contract')->where(array('specialid'=>$value['id'],'sectionid'=>$value['sectionid']))->getField('id');
			$ye_map['projectid']=$contra_id;
			$ye_map['type']='5';
			$noched_amon_c=M('Bill')->where($ye_map)->count();
			$value['noched_amon']=$noched_amon_s+$noched_amon_c;
			unset($ye_map);

			$list[]=$value;
		}

		$this->assign('list',$list);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}

	public function add()
	{
		$unitid=session(C('ADMIN_AUTH_UNITID'));
		$pyear=M('Special')->where('pid=0')->distinct(true)->order('year desc')->field('year')->select();
		$this->assign('pyear',$pyear);

		$year=$pyear[0]['year'];
		$pspe=M('Special')->where(array('pid'=>'0','year'=>$year))->select();
		$this->assign('pspe',$pspe);
		
		$sectionlist=M('Section')->where(array('unitid'=>$unitid,'selock'=>'0'))->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);

		$this->display();
	}

	public function insert()
	{
		$model=D('Spebudget');
		if (I('post.cspeid')) {
			$specialid=I('post.cspeid');
		}else{
			$specialid=I('post.pspeid');
		}
		foreach ($_POST['sectionid'] as $key => $value) {
			$data['sectionid']=$value;
			$data['money']=$_POST['money'][$key];
			$data['firstallmoney']=$_POST['money'][$key];
			$data['total']=$_POST['money'][$key];
			$data['unitid']=session(C('ADMIN_AUTH_UNITID'));
			$data['specialid']=$specialid;

			if (!$model->checkdata($data)) {
				$model->create($data);
				$model->add();
			}
		}
		$this->success('添加专项成功!');
	}

	public function edit()
	{
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionlist=M('Section')->where(array('unitid'=>$map['unitid'],'selock'=>'0'))->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);

		$map['Spebudget.id']=I('get.id');
		$data=D('SpebudgetView')->where($map)->find();
		$this->assign('data',$data);
		$this->display();
	}

	public function update()
	{
		$data=I('post.');
		if ($data['moneyfirstall']>$data['firstallmoney']) {//减少预算
			$changemoney=$data['moneyfirstall']-$data['firstallmoney'];
			if ($changemoney>$data['moneytotal']) {
				$this->error('预算数不能为负数');
			}
			$data['total']=$data['moneytotal']-$changemoney;
			$data['money']=$data['moneymoney']-$changemoney;
		}elseif ($data['moneyfirstall']<$data['firstallmoney']) {
			$changemoney=$data['firstallmoney']-$data['moneyfirstall'];
			$data['total']=$data['moneytotal']+$changemoney;
			$data['money']=$data['moneymoney']+$changemoney;
		}
		
		$model=D('Spebudget');
		if(false === $model->create($data)){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('修改专项成功!');
	}

	public function delete()
	{
		$id=I('get.id');
		$data=M('Spebudget')->where('id='.$id)->find();
		$spemap['projectid']=$data['specialid'];
		$spemap['sectionid']=$data['sectionid'];
		$spemap['type']=3;
		if (M('Bill')->where($spemap)->count()) {
			$this->error('有此专项报销');
		}
		$contractcount=M('Contract')->where(array('specialid'=>$id,'isother'=>0))->count();
		if ($contractcount) {
			$this->error('已经有此专项的采购合同，不允许删除');
		}

		$model=M('Spebudget');
		$data=$model->where($map)->find();
		if(false === $model->where('id='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}
	public function spelogdata(){
		//专项日志
		$_GET['id'] ? $spebudid=$_GET['id'] : $spebudid=$_POST['spebudid'] ;
		$model=D('SpelogView');
		if ($_POST['type']!='') {
			$map['type']=$_POST['type'];
		}
		$map['spebudid']=$spebudid;


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
		$list=$model->where($map)->order('logdate desc')->limit($p->firstRow.','.$p->listRows)->select();
		foreach ($list as $value) {
			$addmoney+=$value['money'];
		}
		$add['money']=$addmoney;
		$add['unitname']='合计';
		$list[]=$add;
		$this->assign('spebudid',$spebudid);

		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->assign('list',$list);
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
		$model=D('BillView');
		//一般专项
		$spebud=M('Spebudget')->where('id='.$get['id'])->find();
		$map['unitid']=$spebud['unitid'];
		$map['sectionid']=$spebud['sectionid'];
		$map['projectid']=$spebud['specialid'];
		$map['type']='3';
		$list_s=$model->where($map)->order('id desc')->select();
		if (!is_array($list_s)) {
			$list_s=array();
		}
		unset($map);
		//采购
		$contra=M('Contract')->where(array('specialid'=>$spebud['id'],'sectionid'=>$spebud['sectionid']))->find();
		$map['sectionid']=$contra['sectionid'];
		$map['projectid']=$contra['id'];
		$map['type']='5';
		$list_c=$model->where($map)->order('id desc')->select();
		unset($map);
		if (!is_array($list_c)) {
			$list_c=array();
		}
		$list=array_merge($list_s,$list_c);
		$this->assign('list',$list);
		$this->display();
	}
	public function spebud_look(){
		/***********************专项*****************************/
		$c_spe_list=parent::appli_spe_c();
		$this->assign('c_spe_list',$c_spe_list);
		$this->display();
	}

	public function get_p_spe(){//ajax
		$year=I('post.year');
		$map['year']=$year;
		$map['pid']='0';
		if ($year) {
			$list=M('Special')->where($map)->select();
			$this->AjaxReturn($list);
		}else{
			return ;
		}
	}

	public function get_c_spe(){//ajax
		$pid=I('post.pid');
		if ($pid) {
			$list=M('Special')->where('pid='.$pid)->select();
			$this->AjaxReturn($list);
		}else{
			return ;
		}
	}
}
 ?>