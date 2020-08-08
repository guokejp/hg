<?php
namespace Home\Controller;
/*执行-行政模块*/

class ZhixingadminController extends CommonController
{
	public function budgetadd(){
		$this->display();
	}
	public function budgetaddinsert(){
		$post=I('post.');
		//存储概览信息
		if ($post['year']=="") {
			$this->error('请输入年份');
		}
		$overlook['year']=$post['year'];
		$overlook['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$overlook['pid']=0;
		$overlook['month']=0;
		$overlook['time']=time();
		$overlookmodel=D('Zxadminoverlook');
		if($overlookmodel->pcheck($overlook)){
			$this->error("已经有此记录");
		}
		if(false===$overlookmodel->create($overlook)){
			$this->error("create失败！");
		}
		if (!$overlookid=$overlookmodel->add()) {
			$this->error($overlookmodel->getLastSql());
		}
		//去掉前面几个值
		
		$qpost=array_slice($post,1,23);
		$i=1;

		$zhixingmoneymodel=M('Zxadminbudgetmoney');
		foreach ($qpost as $value) {
			//压为create数组
			$lvalue['overlook_id']=$overlookid;
			$lvalue['name_id']=$i++;

			$lvalue['inbudgetadd']=$value['0'];
			$lvalue['inlastadd']=$value['1'];
			$lvalue['intwolastadd']=$value['2'];
			$lvalue['inthisadd']=$value['3'];
			$lvalue['inthiserxia']=$value['4'];
			$lvalue['inthistiaozheng']=$value['5'];
			$lvalue['outbudgetadd']=$value['6'];
			$lvalue['outjiezhuanadd']=$value['7'];
			$lvalue['outjiezhuantwolast']=$value['8'];
			$lvalue['outthisinoutbudget']=$value['9'];
			if(false===$zhixingmoneymodel->create($lvalue)){
				$this->error("create失败！");
			}
			if (false===$zhixingmoneymodel->add()) {
				$this->error($zhixingmoneymodel->getLastSql());
			}
		}
		
		$this->success('插入成功');
	}
	public function useadd(){
		$model=M('Zxadminoverlook');
		$year=$model->where(array('pid'=>0,'unitid'=>session(C('ADMIN_AUTH_UNITID'))))->field('year')->select();
		$this->assign('year',$year);
		$this->display();
	}
	public function useaddinsert(){
		$post=I('post.');
		//存储概览信息
		if ($post['year']=="") {
			$this->error('没有预算记录！');
		}
		$overlook['year']=$post['year'];
		$overlook['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$overlook['month']=$post['month'];
		$overlook['time']=time();
		$overlookmodel=D('Zxadminoverlook');
		if($overlookmodel->ccheck($overlook)){
			$this->error("已经有此记录");
		}
		//查找预算记录id
		$pid=M('Zxadminoverlook')->where(array('year'=>$post['year'],'unitid'=>session(C('ADMIN_AUTH_UNITID'))))->field('id')->find();
		if (!$pid) {
			$this->error('参数错误');          
		}
		$overlook['pid']=$pid['id'];
		if(false===$overlookmodel->create($overlook)){
			$this->error("create失败！");
		}
		if (!$overlookid=$overlookmodel->add()) {
			$this->error($overlookmodel->getLastSql());
		}

		//去掉前面几个值
		$qpost=array_slice($post,2,23);
		$i=1;

		$zhixingmoneymodel=M('Zxadminusemoney');
		foreach ($qpost as $value) {
			//压为create数组
			$lvalue['overlook_id']=$overlookid;
			$lvalue['name_id']=$i++;

			$lvalue['inadd']=$value['0'];
			$lvalue['inlast']=$value['1'];
			$lvalue['inthisadd']=$value['2'];
			$lvalue['outadd']=$value['3'];
			$lvalue['outjzout']=$value['4'];
			$lvalue['outthisout']=$value['5'];
			if(false===$zhixingmoneymodel->create($lvalue)){
				$this->error("create失败！");
			}
			if (false===$zhixingmoneymodel->add()) {
				$this->error($zhixingmoneymodel->getLastSql());
			}
		}
		
		$this->success('插入成功');

	}
	public function looktypechoose(){
		$this->display();
	}
	public function looktype1(){
		$year=M('Zxadminoverlook')->where(array('id'=>array('neq',0)))->field('year')->distinct(true)->select();
		$unit=M('Unit')->where(array('unitlock'=>'0'))->field('id,name')->select();
		$this->assign('unit',$unit);
		$this->assign('year',$year);
		//查询开始
		$post['year']=I('post.postyear');
		$post['month']=I('post.postmonth');
		$post['unitid']=I('post.postunitid');
		$zxadminkemulookviewmodel=D('ZxadminkemulookView');
		if ($post['unitid']=='all') {
			$selectdata=$zxadminkemulookviewmodel->where(array('year'=>I('post.postyear'),'month'=>I('post.postmonth')))->order('id asc,kemunameid asc')->select();
			//不同单据的数组相加
			for ($i=0; $i <23 ; $i++) { 
				for ($j=23; $j <count($selectdata); $j++) { 
					if ($selectdata[$i]['kemunameid']==$selectdata[$j]['kemunameid']) {
						$selectdata[$i]['in_lastadd']=$selectdata[$i]['in_lastadd']+$selectdata[$j]['in_lastadd'];
						$selectdata[$i]['budget_yearin']=$selectdata[$i]['budget_yearin']+$selectdata[$j]['budget_yearin'];
						$selectdata[$i]['budget_yearout']=$selectdata[$i]['budget_yearout']+$selectdata[$j]['budget_yearout'];
						$selectdata[$i]['use_monthin']=$selectdata[$i]['use_monthin']+$selectdata[$j]['use_monthin'];
						$selectdata[$i]['use_monthout']=$selectdata[$i]['use_monthout']+$selectdata[$j]['use_monthout'];
					}
				}
			}
			$selectdataadd=array_slice($selectdata,0,23);
			//单据上需要运算的数据
			foreach ($selectdataadd as $value) {
				$value['use_monthinadd']=$value['use_monthin'];
				$value['inzhixinglv']=(number_format($value['use_monthinadd']/$value['budget_yearin'], 4)*100).'%';
				$value['outzhixinglv']=(number_format($value['use_monthout']/$value['budget_yearout'], 4)*100).'%';
				$value['qimojiezhuan']=$value['budget_yearin']-$value['use_monthout'];
				$value['dangqijiezhuan']=$value['use_monthinadd']-$value['use_monthout'];
				$data[]=$value;
			}
		}else{
			$selectdata=$zxadminkemulookviewmodel->where($post)->order('kemunameid asc')->select();
			foreach ($selectdata as $value) {
				$value['use_monthinadd']=$value['use_monthin'];
				$value['inzhixinglv']=(number_format($value['use_monthinadd']/$value['budget_yearin'], 4)*100).'%';
				$value['outzhixinglv']=(number_format($value['use_monthout']/$value['budget_yearout'], 4)*100).'%';
				$value['qimojiezhuan']=$value['budget_yearin']-$value['use_monthout'];
				$value['dangqijiezhuan']=$value['use_monthinadd']-$value['use_monthout'];
				$data[]=$value;
			}
			//print_r($data);
		}
		$this->assign('data',$data);
		$this->display();
	}
	public function looktype2(){
		$year=M('Zxadminoverlook')->where(array('id'=>array('neq',0)))->field('year')->distinct(true)->select();
		$adminname=M('zxadminname')->field('id,name')->select();
		$this->assign('adminname',$adminname);
		$this->assign('year',$year);
		$post['year']=I('post.postyear');
		$post['month']=I('post.postmonth');
		//查出属于哪个支出表
		$overlookid=M('Zxadminoverlook')->where($post)->field('id as overlook_id')->select();
		foreach ($overlookid as $value) {
			$value['Zxadminusemoney.name_id']=I('post.postnameid');
			$value['Zxadminusemoney.overlook_id']=$value['overlook_id'];
			unset($value['overlook_id']);
			$overlook[]=$value;
		}
		//查询开始，以支出表为依据依次查出预算表
		$zxadmindanweilookviewmodel=D('ZxadmindanweilookView');
		foreach ($overlook as $value) {
			$selectdata[]=$zxadmindanweilookviewmodel->where($value)->select();
		}
		//将3级数组合并为二级数组方便视图输出
		foreach ($selectdata as $value) {
			foreach ($value as $avalue) {
				$avalue['use_monthinadd']=$avalue['use_monthin'];
				$avalue['inzhixinglv']=(number_format($avalue['use_monthinadd']/$avalue['budget_yearin'], 4)*100).'%';
				$avalue['outzhixinglv']=(number_format($avalue['use_monthout']/$avalue['budget_yearout'], 4)*100).'%';
				$avalue['qimojiezhuan']=$avalue['budget_yearin']-$avalue['use_monthout'];
				$avalue['dangqijiezhuan']=$avalue['use_monthinadd']-$avalue['use_monthout'];
				$data[]=$avalue;
			}
		}
		foreach ($data as $value) {
			$addvalue['budget_yearin']+=$value['budget_yearin'];
			$addvalue['budget_yearout']+=$value['budget_yearout'];
			$addvalue['use_monthinadd']+=$value['use_monthinadd'];
			$addvalue['use_monthout']+=$value['use_monthout'];
			$addvalue['qimojiezhuan']+=$value['qimojiezhuan'];
			$addvalue['dangqijiezhuan']+=$value['dangqijiezhuan'];
			$addvalue['inzhixinglv']=(number_format($addvalue['use_monthinadd']/$addvalue['budget_yearin'], 4)*100).'%';
			$addvalue['outzhixinglv']=(number_format($addvalue['use_monthout']/$addvalue['budget_yearout'], 4)*100).'%';
			$addvalue['unitname']='总计';
		}
		$adddata[]=$addvalue;
		$this->assign('adddata',$adddata);
		$this->assign('data',$data);
		$this->display();
	}
	public function budgetggoverlook(){
		$overlookmodel=D('Zxadminoverlook');
		$section['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$section['pid']=0;
		$count=$overlookmodel->where($section)->count();
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

		$data=$overlookmodel->where($section)->field('id,year,time')->limit($p->firstRow.','.$p->listRows)->order('id desc')->select();
		$this->assign('list',$data);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}
	public function budgetedit(){
		$overlookid=I('get.id');
		//概览输出
		$overlookmodel=M('Zxadminoverlook');
		$overlookdata=$overlookmodel->where(array('id'=>$overlookid))->field('year,id')->find();
		$this->assign('overlookdata',$overlookdata);
		//金额输出
		$zhixingmoneymodel=D('ZxadminbudgetmoneyView');
		$moneydata=$zhixingmoneymodel->where(array('overlook_id'=>$overlookid))->order('name_id')->select();
		unset($moneydata['14']);
		unset($moneydata['22']);
		$this->assign('moneydata',$moneydata);
		$this->display();
	}
	public function budgetsave(){
		$post=I('post.');
		//单据上需要运算的数据
		foreach ($post['aa'] as $key=>$value) {
			$value['inthisadd']=$value['inthiserxia']+$value['inthistiaozheng'];
			$value['outbudgetadd']=$value['outjiezhuanadd']+$value['outthisinoutbudget'];
			$value['inbudgetadd']=$value['inthisadd']+$value['inlastadd'];
			$data[$key]=$value;
		}
		//前面几行数据每列合计
		for ($i=1; $i < 15; $i++) {
			$fdata['overlook_id']=$data[$i]['overlook_id'];
			$fdata['name_id']=15;
			$fdata['inlastadd']+=$data[$i]['inlastadd'];
			$fdata['intwolastadd']+=$data[$i]['intwolastadd'];
			$fdata['inthiserxia']+=$data[$i]['inthiserxia'];
			$fdata['inthistiaozheng']+=$data[$i]['inthistiaozheng'];
			$fdata['outjiezhuanadd']+=$data[$i]['outjiezhuanadd'];
			$fdata['outjiezhuantwolast']+=$data[$i]['outjiezhuantwolast'];
			$fdata['outthisinoutbudget']+=$data[$i]['outthisinoutbudget'];
			$fdata['inthisadd']+=$data[$i]['inthisadd'];
			$fdata['outbudgetadd']+=$data[$i]['outbudgetadd'];
			$fdata['inbudgetadd']+=$data[$i]['inbudgetadd'];
		}
		$data[15]=$fdata;
		//后面几行数据每列合计
		for ($i=16; $i < 23; $i++) {
			$ldata['overlook_id']=$data[$i]['overlook_id'];
			$ldata['name_id']=23;
			$ldata['inlastadd']+=$data[$i]['inlastadd'];
			$ldata['intwolastadd']+=$data[$i]['intwolastadd'];
			$ldata['inthiserxia']+=$data[$i]['inthiserxia'];
			$ldata['inthistiaozheng']+=$data[$i]['inthistiaozheng'];
			$ldata['outjiezhuanadd']+=$data[$i]['outjiezhuanadd'];
			$ldata['outjiezhuantwolast']+=$data[$i]['outjiezhuantwolast'];
			$ldata['outthisinoutbudget']+=$data[$i]['outthisinoutbudget'];
			$ldata['inthisadd']+=$data[$i]['inthisadd'];
			$ldata['outbudgetadd']+=$data[$i]['outbudgetadd'];
			$ldata['inbudgetadd']+=$data[$i]['inbudgetadd'];
		}
		$data[23]=$ldata;
		//存数据
		$model=M('Zxadminbudgetmoney');
		$model->where('overlook_id='.$post['overlook_id'])->delete();
		foreach ($data as $value) {
			if(false===$model->create($value)){
				$this->error("create失败！");
			}
			if (false===$model->add()) {
				$this->error($model->getLastSql());
			}
		}
		$this->success('修改成功');
		
	}
	public function useggoverlook(){
		$overlookmodel=D('Zxadminoverlook');
		$section['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$section['pid']=array('neq',0);
		$count=$overlookmodel->where($section)->count();
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
		$data=$overlookmodel->where($section)->field('id,year,month,time')->limit($p->firstRow.','.$p->listRows)->order('id desc')->select();
		$this->assign('list',$data);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}
	public function useedit(){
		$overlookid=I('get.id');
		//概览输出
		$overlookmodel=M('Zxadminoverlook');
		$overlookdata=$overlookmodel->where(array('id'=>$overlookid))->field('year,month,id')->find();
		$this->assign('overlookdata',$overlookdata);
		//金额输出
		$zhixingmoneymodel=D('ZxadminusemoneyView');
		$moneydata=$zhixingmoneymodel->where(array('overlook_id'=>$overlookid))->order('name_id')->select();
		unset($moneydata['14']);
		unset($moneydata['22']);
		$this->assign('moneydata',$moneydata);
		$this->display();
	}
	public function usesave(){
		$post=I('post.');
		foreach ($post['aa'] as $key=>$value) {
			$value['inadd']=$value['inlast']+$value['inthisadd'];
			$value['outadd']=$value['outjzout']+$value['outthisout'];
			$data[$key]=$value;
		}
		//前面几行数据每列合计
		for ($i=1; $i < 15; $i++) {
			$fdata['overlook_id']=$data[$i]['overlook_id'];
			$fdata['name_id']=15;
			$fdata['inlast']+=$data[$i]['inlast'];
			$fdata['inthisadd']+=$data[$i]['inthisadd'];
			$fdata['outjzout']+=$data[$i]['outjzout'];
			$fdata['outthisout']+=$data[$i]['outthisout'];
			$fdata['inadd']+=$data[$i]['inadd'];
			$fdata['outadd']+=$data[$i]['outadd'];
		}
		$data[15]=$fdata;
		//后面几行数据每列合计
		for ($i=16; $i < 23; $i++) {
			$ldata['overlook_id']=$data[$i]['overlook_id'];
			$ldata['name_id']=23;
			$ldata['inlast']+=$data[$i]['inlast'];
			$ldata['inthisadd']+=$data[$i]['inthisadd'];
			$ldata['outjzout']+=$data[$i]['outjzout'];
			$ldata['outthisout']+=$data[$i]['outthisout'];
			$ldata['inadd']+=$data[$i]['inadd'];
			$ldata['outadd']+=$data[$i]['outadd'];
		}
		$data[23]=$ldata;
		//存数据
		$model=M('Zxadminusemoney');
		$model->where('overlook_id='.$post['overlook_id'])->delete();
		foreach ($data as $value) {
			if(false===$model->create($value)){
				$this->error("create失败！");
			}
			if (false===$model->add()) {
				$this->error($model->getLastSql());
			}
		}
		$this->success('修改成功');
	}
	public function usedelete(){
		$id=I('get.id');
		$overlookdel=M('Zxadminoverlook')->where(array('id'=>$id))->delete();
		$moneydel=M('Zxadminusemoney')->where(array('overlook_id'=>$id))->delete();
		if ($moneydel) {
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
	}
	
}
?>