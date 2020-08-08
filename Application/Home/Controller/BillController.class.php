<?php 
namespace Home\Controller;
/**
* 报销模块
*/
class BillController extends CommonController
{
	public function index()
	{
		$model=D('BillView');
		$map['Bill.sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
		$map['Bill.termid']=session(C('TERM_ID'));
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
		$isother=I('get.isother');
		if(empty($categoryid)){
			$map['pid']=0;
			$categorylist=M('Category')->where($map)->order('id asc')->select();
			$this->assign('categorylist',$categorylist);
			unset($map);//获取该部门可报销的会议计划
			$this->display();
			exit();
		}
		$sectionlist=M('Section')->where(array('unitid'=>session(C('ADMIN_AUTH_UNITID')),'selock'=>'0'))->select();
		$this->assign('sectionlist',$sectionlist);

		if($categoryid=='conference'){//会议费报销条件  部门 账期 未报销
			$model=D('ConferenceView');
			$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
			$map['termid']=session(C('TERM_ID'));
			$map['status']=0;
			$conferencelist=$model->where($map)->order('id asc')->select();
			if(empty($conferencelist)){
				$this->error('没有可供报销的会议计划！');
			}
			$this->assign('conferencelist',$conferencelist);
			$this->orderid=$this->get_orderid($categoryid);
			$this->display('addconference');
		}elseif($categoryid=='train'){//培训报销条件  部门 账期  未报销
			$model=D('TrainView');
			$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
			$map['termid']=session(C('TERM_ID'));
			//$map['status']=array('NEQ', 2);//未报销 和 报销了一部分
			$map['staging']=array('GT',0);//剩余期数不大于0
			$trainlist=$model->where($map)->order('id asc')->select();
			foreach($trainlist as $key => $val){
				//获取总金额减去已经报销的金额
				$trainlist[$key]['money']-=$val['confirm'];
				//获取该预算正在报销中的金额
				$map['status']=0;
				$map['type']=2;
				$map['projectid']=$val['id'];
				$usemoney=M('bill')->where($map)->sum("money");
				$trainlist[$key]['money']-=$usemoney;
				if($trainlist[$key]['money'] ==0){
					unset($trainlist[$key]);
				}
			}
			if(empty($trainlist)){
				$this->error('没有可供报销的培训计划！');
			}
			$this->assign('trainlist',$trainlist);
			$this->orderid=$this->get_orderid($categoryid);
			$this->display('addtrain');
		}elseif($categoryid=='special'){//专项   部门  账期
			$model=M('Spebudget');
			$year=M('Special')->distinct(true)->field('year')->select();
			$this->assign('year',$year);
			/*其它信息为ajax获取  get_c_special() get_p_special()  */
			$this->orderid=$this->get_orderid($categoryid);
			$this->display('addspecial');
		}elseif($categoryid=='contract'){
			if ($isother==0) {
				$model=D('ContractView');
				$where['isother']=0;
			}elseif ($isother==1) {
				$model=D('ContractotherView');
				$where['isother']=1;
			}
			$where['status']=1;
			$where['isover']=0;
			//关保处报销？？
			/*if (session(C('ADMIN_AUTH_ROLEID'))==3||session(C('ADMIN_AUTH_ROLEID'))==5) {
				$where['sectionid']="";
			}*/
			$where['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
			$contractlist=$model->where($where)->order('id desc')->select();
			$this->orderid=$this->get_orderid($categoryid);
			$this->assign('contractlist',$contractlist);
			//print_r($contractlist);
			$this->display('addcontract');

		}else{//包干预算
			//获取该预算是多次使用还是单次使用
			$categoryInfo=M('Category')->where('id='.$categoryid)->find();

			$categroup=M('Category')->where('id='.$categoryid.' or pid='.$categoryid)->getField('id',true);
			if($categoryInfo['once'] == 1){
				//包干预算 可以多次使用   获取该预算剩余金额
				unset($map);
				$map['termid']=session(C('TERM_ID'));
				$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
				
				/*是否有子包干*/
				$childcat=M('Category')->where('pid='.$categoryid)->select();
				if (!$childcat) {//没有子包干,获取剩余金额
					$map['categoryid']=$categoryid;
					$data=D('CatbudgetView')->where($map)->find();
					if(null === $data){
						$this->error("本部门无该科目预算，无法报销！");
					}
					unset($map['categoryid']);
					$map['status']=0;
					$map['type']=0;
					$map['projectid']=$categoryid;
					//获取该预算正在报销中的金额
					$usemoney=M('bill')->where($map)->sum("money");
					$data['money']-=$usemoney;
					if($data['money'] <= 0){
						$this->error('该科目预算可用金额为0，无法报销');
					}
					$this->assign('data',$data);
				}else{//有子包干，剩余金额通过ajax获取
					$map['categoryid']=array('in',$categroup);
					$categroupmoney=M('Catbudget')->where($map)->sum('money');
					if(!$categroupmoney){
						$this->error("本部门子科目无预算，无法报销！");
					}
					unset($map);
					$map['id']=$categoryid;
					$data=D('Category')->where($map)->field('name')->find();
					$this->assign('data',$data);
					$childcat=M('Category')->where('pid='.$categoryid)->select();
					$this->assign('childcat',$childcat);
				}
				$orderid=M('Bill')->max('id')+1;
				$this->orderid=$this->get_orderid($categoryid);
				$this->display('addcatbudget');
			}else{
				unset($map);
				$map['termid']=session(C('TERM_ID'));
				$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
				$oncecate=M('Category')->where('id='.$categoryid.' or pid='.$categoryid)->getField('id',true);
				$map['categoryid']=array('in',$oncecate);
				$map['status']=0;
				$oncebudgetlist=D('OncebudgetView')->where($map)->select();
				if(null ===$oncebudgetlist){
					$this->error('本部门无该科目预算，无法报销！');
				}
				$this->assign('oncebudgetlist',$oncebudgetlist);
				$this->orderid=$this->get_orderid($categoryid);
				$this->display('addoncebudget');
			}

		}
	}

	public function insert()
	{	
		$post=I('post.');
		$type=$post['type'];
		$model=D('Bill');
		if($type == 1){//会议费
			$map['id']=I('post.projectid');
			M('Conference')->where($map)->setField('status',1);
		}elseif($type==2){//培训费
			$map['id']=$post['projectid'];
			M('Train')->where($map)->setDec('staging',1);
			//M('Train')->where($map)->setField('status',1);
		}elseif($type==3){
			if (!empty($post['cspe'])) {
				$map['id']=$post['cspe'];
			}elseif (!empty($post['pspe'])&&empty($post['cspe'])) {
				$map['id']=$post['pspe'];
			}
			$specialid=M('Spebudget')->where($map)->getField('specialid');
			unset($map['id']);
			//total字段值减少
			$map['specialid']=$specialid;
			$map['unitid']=$post['unitid'];
			$map['sectionid']=$post['sectionid'];
			M('Spebudget')->where($map)->setDec('total',$post['money']);

			if (!empty($post['cspe'])) {
				$spebuid=$post['cspe'];
				$post['projectid']=M('Spebudget')->where('id='.$spebuid)->getField('specialid');
			}elseif (!empty($_POST['pspe'])&&empty($post['cspe'])) {
				$spebuid=I('post.pspe');
				$post['projectid']=M('Spebudget')->where('id='.$spebuid)->getField('specialid');
			}
			if(false === $model->create($post)){
				$this->error($model->getError());
			}
			if(false === $model->add()){
				$this->error($model->_sql());
			}
			$this->success('报销单提交成功!');
			exit();
		}elseif($type==4){
			$map['id']=$post['projectid'];
			M('Oncebudget')->where($map)->setField('status',1);
		}elseif ($type==5) {
			//判断同合同有没有已经报销
			$checkdata['projectid']=$post['projectid'];
			$checkdata['contractmoneyid']=$post['contractmoneyid'];
			$checkdata['contractmoneyqishuid']=$post['contractmoneyqishuid'];
			if ($model->checkdata($checkdata)) {
				$this->error('已经有此合同报销');
			}
		}
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if (!$in_bill_id=$model->add()) {
			$this->error($model->_sql());
		}		
		//定制，差旅费将详细信息存储;
		if ($type==0) {
			if ($post['cailv']==1) {
				$mod_cl=M('BillCailv');

				$info_cl['billid']=$in_bill_id;
				$info_cl['place']=$post['cailv_place'];
				$info_cl['day']=$post['cailv_daymon'];
				$info_cl['type']=$post['cailv_type'];
				$info_cl['people']=$post['cailv_peop'];
				$info_cl['date']=date('Y-m-d');

				$mod_cl->create($info_cl);
				$mod_cl->add();
				unset($mod_cl);
			}
		}
		$this->success('报销单提交成功!');
	}

	public function edit()
	{
		$id=I('get.id');
		$model=D('BillView');
		$map['id']=$id;
		$data=$model->where($map)->find();
		if ($data['status']!=0) {
			$this->error('只允许修改未审核单据');
		}
		if ($data['instaid']!=session(C('ADMIN_AUTH_ID')) && $data['staffid']!=session(C('ADMIN_AUTH_ID'))) {
			$this->error('只能修改与本人有关的报销单');
		}
		if (!in_array($data['type'], array('0','3','4'))) {
			$this->error('只允许修改包干、专项，其他请删单重新申请');
		}
		$this->assign('data',$data);
		$this->display();
	}

	public function adminedit(){//管理员权限可更改所有单据
		$id=I('get.id');
		$bill_info=D('BillView')->where('Bill.id='.$id)->find();
		//只允许已经通过审核的单据使用
		if ($bill_info['status']!='1') {
			$this->error('该功能只用于已通过审核的单据');
		}
		if ($bill_info['type']!='0' && $bill_info['type']!='3') {
			$this->error('目前只能用于包干和专项');
		}
		$this->assign('data',$bill_info);
		$this->display('edit_admin');
	}
	public function adminedit_che(){//管理员权限可更改所有单据
		$post=I('post.');
		if ($post['confirm']>$post['oldconfirm']) {
			$this->error('不能大于原审核数');
		}
		$decmoney=$post['oldconfirm']-$post['confirm'];
		$model=M('Bill');
		$billinfo=$model->where('id='.$post['id'])->find();
		switch($billinfo['type']){
			case '0'://包干
				if(false === $model->create($post)){
					$this->error($model->getError());
				}
				if(false === $model->save()){
					$this->error($model->_sql());
				}
				
				$map['termid']=$billinfo['termid'];
				$map['sectionid']=$billinfo['sectionid'];
				$map['categoryid']=$billinfo['projectid'];

				M('Catbudget')->where($map)->setInc('money',$decmoney);
				//操作日志
				$logid=M('Catlog')->where('billid='.$post['id'])->getField('id');
				$logdata['id']=$logid;
				$logdata['money']=$post['confirm'];
				M('Catlog')->save($logdata);
				
				unset($map);
				unset($logdata);

				break;
			case '3'://专项
				$sectionid=$model->where('id='.$post['id'])->getField('sectionid');
				if(false === $model->create($post)){
					$this->error($model->getError());
				}
				if(false === $model->save()){
					$this->error($model->_sql());
				}
				$passmap['specialid']=$billinfo['projectid'];
				$passmap['sectionid']=$sectionid;
				M('Spebudget')->where($passmap)->setInc('total',$decmoney);
				M('Spebudget')->where($passmap)->setInc('money',$decmoney);
				
				//存储到专项报销日志
				$logid=M('Spelog')->where('billid='.$post['id'])->getField('id');
				$logdata['id']=$logid;
				$logdata['money']=$post['confirm'];
				M('Spelog')->save($logdata);

				unset($passmap);

				break;
		}
		$this->success('修改成功');
	}


	public function update()
	{
		$post=I('post.');
		$map['id']=$post['id'];
		$data=M('Bill')->where($map)->find();
		switch($data['type']) {
			case '0':
				$where['categoryid']=$data['projectid'];
				$where['sectionid']=$data['sectionid'];
				$where['termid']=$data['termid'];
				$havemoney=M('Catbudget')->where($where)->getField('money');
				if ($post['money']>$havemoney) {
					$this->error('不能大于预算数');
				}
				break;
			case '3':
				$where['specialid']=$data['projectid'];
				$where['sectionid']=$data['sectionid'];
				$havemoney=M('Spebudget')->where($where)->getField('total');
				$addedmon=$post['money']-$post['oldmoney'];
				if ($addedmon>$havemoney) {
					$this->error('不能大于预算数');
				}

				M('Spebudget')->where($where)->setDec('total',$addedmon);
				break;
			case '4':
				$where['id']=$data['projectid'];
				$havemoney=M('Oncebudget')->where($where)->getField('confirm');
				if ($post['money']>$havemoney) {
					$this->error('不能大于预算数');
				}
				break;
			default:
				$this->error('类型错误');
				break;
		}
		$model=D('Bill');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false === $model->save()){
			$this->error($model->_sql());
		}
		$this->success('报销单修改成功!');
	}

	public function delete()
	{
		$model=M('Bill');
		$map['id']=I('get.id');
		$data=$model->where($map)->find();
		switch($data['type']) {
			case '1':
				$where['id']=$data['projectid'];
				M('Conference')->where($where)->setField('status',0);
				break;
			case '2':
				$where['id']=$data['projectid'];
				M('Train')->where($where)->setInc('staging',1);
				break;
			case '3':
				$where['specialid']=$data['projectid'];
				$where['sectionid']=$data['sectionid'];
				M('Spebudget')->where($where)->setInc('total',$data['money']);
				break;
			case '4':
				$where['id']=$data['projectid'];
				M('Oncebudget')->where($where)->setDec('status',1);
				break;
		}
		if(false === $model->where($map)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}

	public function audit()
	{
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$sectionlist=M('Section')->where(array('unitid'=>session(C('ADMIN_AUTH_UNITID')),'selock'=>'0'))->order('id asc')->select();
		$this->assign('sectionlist',$sectionlist);
		$termlist=M('Term')->order('id asc')->select();
		$this->assign('termlist',$termlist);
		unset($map);

		$catlist=M('Category')->select();
		$this->assign('catlist',categorylist($catlist));
		
		if (I('post.termid')!=='') {
			$termyear=M('Term')->where('id='.$_POST['termid'])->getField('name');
			$spelist=M('Special')->where(array('year'=>$termyear))->select();
		}else{
			$spelist=M('Special')->where(array('year'=>session(C('TERM_NAME'))))->select();
		}
		$this->assign('spelist',speciallist($spelist));

		$model=D('BillView');
		$map['Bill.unitid']=session(C('ADMIN_AUTH_UNITID'));
		$map['Bill.termid']=session(C('TERM_ID'));
		
		if(I('post.sectionid')!==''){
			$map['sectionid']=I('post.sectionid');
		}
		$_POST['statu']!='' && $map['status']=$_POST['statu'];
		$_POST['type']!='' && $map['type']=$_POST['type'];
		if ($_POST['type']==='0') {
			$_POST['cat_catid'] && $map['projectid']=I('post.cat_catid');
		}elseif ($_POST['type']==='3') {
			$_POST['spe_proid'] && $map['projectid']=I('post.spe_proid');
		}
		if(I('post.orderid')!==''){
			$map['orderid']=array('LIKE','%'.trim(I('post.orderid')).'%');
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
		$find=M('Bill')->where(array('id'=>I('get.id')))->field('type')->find();
		if ($find['type']==5) {//采购
			$data=D('BillcontractView')->where($map)->find();
			$this->assign('data',$data);
			$this->display('contractcheck');
		}elseif($find['type']==0){//包干，多次使用
			$pcat=M('Category')->where('pid=0')->select();
			$this->assign('pcat',$pcat);

			$data=D('BillView')->where($map)->find();
			//差旅费详情
			$cailv=M('BillCailv')->where('billid='.$data['id'])->find();
			if ($cailv) {
				$data['is_cailv']=1;
				$data['cailv_info']=$cailv;
			}
			$this->assign('data',$data);
			$this->display('check_catgroy');
		}elseif ($find['type']==3) {//专项
			$year=M('Special')->distinct(true)->field('year')->select();
			$this->assign('year',$year);
			$data=D('BillView')->where($map)->find();
			$this->assign('data',$data);
			$this->display('check_special');
		}elseif ($find['type']==4) {//包干，一次一申请
			$data=D('BillView')->where($map)->find();
			$this->assign('data',$data);
			$this->display('check_oncecatgroy');
		}elseif ($find['type']==1||$find['type']==2) {//会议、培训计划
			$data=D('BillView')->where($map)->find();
			$this->assign('data',$data);
			$this->display('check_tra_conf');
		}
	}

	public function allow()
	{	
		$post=I('post.');
		$status=M('Bill')->where('id='.$post['id'])->getField('status');
		if ($status!='0') {
			$this->error('不要重复审核');
		}
		//函数在commoncontroller中
		$this->checkallow($post);
		$this->success('报销成功!');
	}


	public function view()
	{
		$map['id']=I('get.id');
		$find=M('Bill')->where(array('id'=>I('get.id')))->field('type')->find();
		if ($find['type']==5) {
			$data=D('BillcontractView')->where($map)->find();
			$this->assign('data',$data);
			$this->display('contractview');
		}else{
			$data=D('BillView')->where($map)->find();
			$this->assign('data',$data);
			$this->display();
		}
	}
	public function allcheck(){
		$idpost=I('post.billallcheck');
		foreach ($idpost as $value) {
			$b_info=M('Bill')->where('id='.$value)->find();
			if ($b_info['status']!='0') {
				continue;
			}
			$post['id']=$value;
			$post['chestaid']=session(C('ADMIN_AUTH_ID'));
			$post['billmoney']=$b_info['money'];
			$post['confirm']=$b_info['money'];
			$post['remark']=$b_info['remark'];
			$post['status']='1';
			$post['cremark']='集中通过审批';
			if ($b_info['type']=='3') {
				$post['oldprojectid']=$b_info['projectid'];
			}
			//函数在commoncontroller中
			$this->checkallow($post);
			unset($post['oldrojectid']);
		}
		$this->success('统一报销成功!');
	}

	public function get_c_lastmoney(){//前端ajax获取包干剩余预算金额
		$id=I('post.ccat');
		$map['termid']=session(C('TERM_ID'));
		$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
		$map['categoryid']=$id;
		$budgetmoney=M('Catbudget')->where($map)->getField('money');
		//扣不扣除报销未审核金额存在争议，
		/*unset($map['categoryid']);
		$map['status']=0;
		$map['type']=0;
		$map['projectid']=$id;
		$usemoney=M('bill')->where($map)->sum("money");
		$money=$budgetmoney-$usemoney;*/
		$money=$budgetmoney;
		$this->ajaxReturn($money);
	}
	public function get_c_catgroy(){//前端ajax选子包干
		$pcat=I('post.pcat');
		$ccatlist=M('Category')->where('pid='.$pcat)->select();
		if ($ccatlist) {
			$this->ajaxReturn($ccatlist);
		}
		
	}
	public function get_p_special(){//前端ajax根据年份选母专项
		$model=M('Spebudget');
		$year=I('post.year');
		$map['year']=$year;
		$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
		$map['money']=array('gt',0);
		$speciallist=$model->where($map)->order('id asc')->getField('specialid',true);

		foreach ($speciallist as $value) {
			$pid=M('Special')->where('id='.$value)->find();
			if ($pid['pid']) {
				$pidmap['id']=$pid['pid'];
				//$pidmap['gov']=0; 用户需求，政府专项也列其中
				$pspe=M('Special')->where($pidmap)->find();
				unset($pidmap);
				if ($pspe) {
					$pspelist[$pspe['id']]=$pspe;
				}
			}else{
				$ma['specialid']=$pid['id'];
				$ma['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
				$ma['unitid']=session(C('ADMIN_AUTH_UNITID'));
				//$ma['gov']='0'; 用户需求，政府专项也列其中
				$cfind=D('SpebudgetView')->where($ma)->find();
				if ($cfind) {
					$pspe=$cfind;
					$pspe['name']=$pspe['specialname'];

					$pspelist[$pspe['id']]=$pspe;
				}
			}
		}
		foreach ($pspelist as $value) {
			$list[]=$value;
		}
		if ($list) {
			$this->ajaxReturn($list);
		}
		
	}
	public function get_c_special(){//前端ajax选子专项
		$pid=I('post.pspe');
		$specialid=M('Special')->where('pid='.$pid)->getField('id',true);
		$map['sectionid']=session(C('ADMIN_AUTH_SECTIONID'));
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		if ($specialid) {//有子专项
			$map['specialid']=array('in',$specialid);
			$map['money']=array('gt',0);
			$spe=D('SpebudgetView')->where($map)->select();
			$list['child']='1';

			$list['list']=$spe;
		}else{//无子专项
			$map['specialid']=$pid;
			$map['money']=array('gt',0);
			$spe=D('SpebudgetView')->where($map)->find();
			$list['child']='0';

			$list['list']=$spe;
		}
		if ($list) {
			$this->ajaxReturn($list);
		}
		
	}
	public function contractsub(){//前端ajax选合同
		$contractid=I('post.contractid');
		$isother=M('ContractMoney')->where(array("contractid"=>$contractid))->select();
		//过滤掉已经报销完结的合同
		foreach ($isother as $key => $value) {
			if ($value['first']==0) {
				$value['firststatus']=1;
			}
			if ($value['second']==0) {
				$value['secondstatus']=1;
			}
			if ($value['third']==0) {
				$value['thirdstatus']=1;
			}
			if ($value['fourth']==0) {
				$value['fourthstatus']=1;
			}
			if ($value['fifth']==0) {
				$value['fifthstatus']=1;
			}
			if ($value['warranty']==0) {
				$value['warrantystatus']=1;
			}
			$isover=$value['firststatus']&&$value['secondstatus']&&$value['thirdstatus']&&$value['fourthstatus']&&$value['fifthstatus']&&$value['warrantystatus'];
			if ($isover==0) {
				$isoverkk[]=$isother[$key];
			}
		}
		if ($isoverkk) {
			$this->ajaxReturn($isoverkk);
		}
		
	}
	public function contractqishusub(){//前端ajax选期数
		$contractmoneyid=I('post.contractmoneyid');
		$find=M('ContractMoney')->where(array("id"=>$contractmoneyid))->find();
		$array['contractid']=$find['contractid'];
		$array['id']=$find['id'];
		$array['name']=$find['name'];

		$array['ht'][1]['money']=$find['first'];
		$array['ht'][1]['status']=$find['firststatus'];
		$array['ht'][1]['name']="第一期";

		$array['ht'][2]['money']=$find['second'];
		$array['ht'][2]['status']=$find['secondstatus'];
		$array['ht'][2]['name']="第二期";

		$array['ht'][3]['money']=$find['third'];
		$array['ht'][3]['status']=$find['thirdstatus'];
		$array['ht'][3]['name']="第三期";

		$array['ht'][4]['money']=$find['fourth'];
		$array['ht'][4]['status']=$find['fourthstatus'];
		$array['ht'][4]['name']="第四期";

		$array['ht'][5]['money']=$find['fifth'];
		$array['ht'][5]['status']=$find['fifthstatus'];
		$array['ht'][5]['name']="第五期";

		$array['ht'][6]['money']=$find['warranty'];
		$array['ht'][6]['status']=$find['warrantystatus'];
		$array['ht'][6]['name']="质保金";

		$this->ajaxReturn($array);
	}

	public function getstaff(){
		$sectionid=I('post.sectionid');
		$map['sectionid']=$sectionid;
		$map['locked']='0';
		$sectionlist=M('Staff')->where($map)->select();
		if ($sectionlist) {
			$this->ajaxReturn($sectionlist);
		}
		
	}

	public function ajax_getspecial(){//ajax按年份选专项
		$post=I('post.');
		$map['year']=$post['year'];
		$spelist=M('Special')->where($map)->select();
		if ($spelist) {
			$this->ajaxReturn(speciallist($spelist));
		}
	}
}
 ?>