<?php 
namespace Home\Controller;
/**
* 
*/
class ContractController extends CommonController
{
	public function index()
	{
		//判断来自专项或其它
		if (I('post.isother')=='0') {
			$model=D('ContractView');
			$map['isother']=I('post.isother');
		}elseif(I('post.isother')=='1'){
			$model=D('ContractotherView');
			$map['isother']=I('post.isother');
		}else{
			$this->display();
			exit();
		}

		if(I('post.name')!==''){
			$map['name']=array('LIKE','%'.trim(I('post.name')).'%');
		}
		if(I('post.starttime')!==''){
			$map['timestamp']=array('gt',strtotime(trim(I('post.starttime'))));
		}
		if(I('post.endtime')!==''){
			$map['timestamp']=array('lt',strtotime(trim(I('post.endtime'))));
		}
		$count=$model->where($map)->count();
		if(I('post.numPerPage')!==''){
			$listRows=I('post.numPerPage');
		}else{
			$listRows=20;
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
		//年初专项，其余信息ajax获取
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$map['gov']=1;
		$year=M('Special')->where($map)->field('year')->distinct(true)->select();
		$this->assign('year',$year);
		unset($map);
		//一次一审请专项
		$map['confirm']=1;
		$map['used']=0;
		$map['SpecialOther.unitid']=session(C('ADMIN_AUTH_UNITID'));
		$specialotherlist=D('SpecialOtherView')->where($map)->order('id desc')->select();
		$this->assign('specialotherlist',$specialotherlist);

		$this->display();
	}

	public function insert()
	{

		// $this->error('debug');
		$data=I('post.');
		if(!isset($data['project']) && !isset($data['goods']) && !isset($data['service'])){
			$this->error('工程，货物，服务，请至少选择一项！');
		}
		//预算数与总数累计超出判断
		if ($data['isother']==0) {//走专项
			$data['specialid']=$data['sp-specialid'];//这里存spebudget表的id，便于index页面输出
			$sp_total=$data['projectmoney']+$data['goodsmoney']+$data['servicemoney'];
			if ($data['sp-total']<$sp_total) {
				$this->error('总数不可超越预算数');
			}
			//专项金额减少
			$map['id']=$data['sp-specialid'];
			M('Spebudget')->where($map)->setDec('total',$sp_total);
		}elseif ($data['isother']==1) {//走一次一申请
			$data['specialid']=$data['ot-specialid'];
			$ot_total=$data['projectmoney']+$data['goodsmoney']+$data['servicemoney'];
			if ($data['ot-total']<$ot_total) {
				$this->error('总数不可超越预算数');
			}
			//标记使用的其它采购项
			$map['id']=$data['ot-specialid'];
			$map['used']=1;
			$map['usedmoney']=$ot_total;
			if (false===M('SpecialOther')->create($map)) {
				$this->error('出错');
			}
			if (false===M('SpecialOther')->save()) {
				$this->error('错误');
			}
		}
		
		$model=D('Contract');
		if(false === $model->create($data)){
			$this->error($model->getError());
		}
		if(false ===$contractid=$model->add()){
			$this->error($model->_sql());
		}else{
			$this->success('添加政府采购合同成功!');
		}
	}

	public function execution()
	{
		if (I('get.isother')==0) {
			$model=D('ContractView');
		}elseif (I('get.isother')==1) {
			$model=D('ContractotherView');
		}
		$map['id']=I('get.id');
		$data=$model->where($map)->find();
		//print_r($data);
		$this->assign('data',$data);
		$this->display();
	}

	public function execsave()
	{

		$contractid=I('post.contractid');
		$name_arr=I('post.name');
		$type_arr=I('post.type');
		$first_arr=I('post.first');
		$second_arr=I('post.second');
		$third_arr=I('post.third');
		$fourth_arr=I('post.fourth');
		$fifth_arr=I('post.fifth');
		$warranty_arr=I('post.warranty');
		$projectmoney=I('post.projectmoney');
		$goodsmoney=I('post.goodsmoney');
		$servicemoney=I('post.servicemoney');
		$project_count=0;
		$goods_count=0;
		$service_count=0;
		foreach ($type_arr as $key=>$val){
			$arr=array(
				'contractid'=>$contractid,
				'name'=>$name_arr[$key],
				'type'=>$type_arr[$key],
				'first'=>$first_arr[$key],
				'second'=>$second_arr[$key],
				'third'=>$third_arr[$key],
				'fourth'=>$fourth_arr[$key],
				'fifth'=>$fifth_arr[$key],
				'warranty'=>$warranty_arr[$key],
				);
			$data[]=$arr;
			unset($arr['contractid']);
			unset($arr['name']);
			switch($arr['type']){
				case '1':
					unset($arr['type']);
					$project_count+=array_sum($arr);
					break;
				case '2':
					unset($arr['type']);
					$goods_count+=array_sum($arr);
					break;
				case '3':
					unset($arr['type']);
					$service_count+=array_sum($arr);
					break;
			}
		}
		if($projectmoney < $project_count){
			$this->error('实际工程金额应小于预算工程金额，请检查输入！');
		}
		if($goodsmoney < $goods_count){
			$this->error('实际货物金额应小于预算货物金额，请检查输入！');
		}
		if($servicemoney < $service_count){
			$this->error('实际服务金额应小于预算服务金额，请检查输入！');
		}
		$model=D('Contract_money');
		$model->addAll($data);
		M('Contract')->where('id='.$contractid)->setField('status','1');

		foreach ($data as $value) {
			$addvalue['first'] +=$value['first'];
			$addvalue['second'] +=$value['second'];
			$addvalue['third'] +=$value['third'];
			$addvalue['fourth'] +=$value['fourth'];
			$addvalue['fifth'] +=$value['fifth'];
			$addvalue['warranty'] +=$value['warranty'];
		}
		//合同金额
		$contractmoney=$addvalue['first']+$addvalue['second']+$addvalue['third']+
						$addvalue['fourth']+$addvalue['fifth']+$addvalue['warranty'];
		//预算金额
		$budgetmoney=$projectmoney+$goodsmoney+$servicemoney;
		//应该往专项预算中加的钱
		$shouldadd=$budgetmoney-$contractmoney;
		unset($model);
		$modeldata=M('Contract')->where(array('id'=>$contractid))->field('specialid,isother')->find();
		if ($modeldata['isother']==0) {
			$model=M('Spebudget');
			$model->where(array('specialid'=>$modeldata['specialid']))->setInc('total',$shouldadd);
		}
		$this->success('计划执行成功!');
	}

	public function edit()
	{
		$model=D('ContractView');
		$id=I('get.id');
		$map['id']=$id;
		$data=$model->where($map)->find();
		$this->assign('data',$data);
		$list=M('Contract_money')->where('contractid='.$id)->select();
		$this->assign('list',$list);
		//print_r($list);
		$this->display();
	}

	public function update()
	{
		//print_r($_POST);
		//$this->error('aaa');
		$model=D('Contract');
		if(false === $model->create()){
			$this->error($model->getError());
		}
		if(false ===$contractid=$model->save()){
			$this->error($model->_sql());
		}
		unset($model);
		$model=M('Contract_money');
		$id=I('post.id');
		$map['contractid']=$id;
		$model->where($map)->delete();
		$name_arr=I('post.name');
		$type_arr=I('post.type');
		$first_arr=I('post.first');
		$second_arr=I('post.second');
		$third_arr=I('post.third');
		$fourth_arr=I('post.fourth');
		$fifth_arr=I('post.fifth');
		$warranty_arr=I('post.warranty');
		foreach ($first_arr as $key=>$val){
			if(empty($name_arr[$key]) || empty($first_arr[$key])){
				continue;
			}
			$data[]=array(
				'contractid'=>$id,
				'name'=>$name_arr[$key],
				'type'=>$type_arr[$key],
				'first'=>$first_arr[$key],
				'second'=>$second_arr[$key],
				'third'=>$third_arr[$key],
				'fourth'=>$fourth_arr[$key],
				'fifth'=>$fifth_arr[$key],
				'warranty'=>$warranty_arr[$key],
				);
		}
		foreach ($data as $value) {
			$model->create($value);
			$model->add();
		}
		//$model->addAll($data);
		$this->success('修改政府采购合同成功!');
	}

	public function delete()
	{
		$model=M('Contract');
		$id=I('get.id');
		$status=$model->where(array('id'=>$id))->find();
		if ($status['status']==1) {
			$this->error('已有合同，不能删除');
		}
		if ($status['isother']==0) {
			$addmoney=$status['projectmoney']+$status['goodsmoney']+$status['servicemoney'];
			unset($model);
			$model=M('Spebudget');
			$model->where(array('specialid'=>$status['specialid']))->setInc('total',$addmoney);

		}elseif ($status['isother']==1) {
			unset($model);
			$model=M('SpecialOther');
			$model->where(array('id'=>$status['specialid']))->setField(array('used'=>0,'usedmoney'=>0));
		}
		unset($model);
		$model=M('Contract');
		if(false === $model->where('id='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		if(false === M('Contract_money')->where('contractid='.$id)->delete()){
			$this->error('删除发生错误!');
		}
		$this->success('删除成功!');

	}

	public function detail()
	{
		if (I('get.isother')=='0') {
			$model=D('ContractView');
		}elseif(I('get.isother')=='1'){
			$model=D('ContractotherView');
		}
		$id=I('get.id');
		$map['id']=$id;
		$data=$model->where($map)->find();
		$this->assign('data',$data);
		$list=M('Contract_money')->where('contractid='.$id)->select();
		$this->assign('list',$list);
		//print_r($data);
		//print_r($list);
		$this->display();
	}
	public function look()
	{
		//判断来自专项或其它
		if (I('post.isother')=='0') {
			$model=D('ContractView');
			$map['isother']=I('post.isother');
		}elseif(I('post.isother')=='1'){
			$model=D('ContractotherView');
			$map['isother']=I('post.isother');
		}else{
			$this->display();
			exit();
		}
		$map['status']=1;
		if(I('post.name')!==''){
			$map['name']=array('LIKE','%'.trim(I('post.name')).'%');
		}
		if(I('post.starttime')!==''){
			$map['timestamp']=array('gt',strtotime(trim(I('post.starttime'))));
		}
		if(I('post.endtime')!==''){
			$map['timestamp']=array('lt',strtotime(trim(I('post.endtime'))));
		}
		$count=$model->where($map)->count();
		if(I('post.numPerPage')!==''){
			$listRows=I('post.numPerPage');
		}else{
			$listRows=20;
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
	public function get_spe_bud(){
		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$map['gov']=1;
		$map['year']=I('post.year');
		$specialid=M('Special')->where($map)->getField('id',true);
		if ($specialid) {
			$spebud=D('SpebudgetView')->where(array('specialid'=>array('in',$specialid)))->order('sectionid')->select();
			$this->ajaxReturn($spebud);
		}
		
	}

}
 ?>