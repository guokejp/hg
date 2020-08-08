<?php
namespace Home\Controller;
/*执行-五项专用模块*/

class ZhixingwuxiangController extends CommonController
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
		$overlookmodel=D('Zxwuxiangoverlook');
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
		
		$qpost=array_slice($post,1,5);
		$i=1;
		$zhixingmoneymodel=M('Zxwuxiangmoney');
		foreach ($qpost as $value) {
			//压为create数组
			$lvalue['overlook_id']=$overlookid;
			$lvalue['name_id']=$i++;

			$lvalue['alladd']=$value['0'];
			$lvalue['jingfeiztadd']=$value['1'];
			$lvalue['czadd']=$value['2'];
			$lvalue['czyunxing']=$value['3'];
			$lvalue['czjishi']=$value['4'];
			$lvalue['czshoufei']=$value['5'];
			$lvalue['czother']=$value['6'];
			$lvalue['nczadd']=$value['7'];
			$lvalue['nczotherin']=$value['8'];
			$lvalue['nczdfzx']=$value['9'];
			$lvalue['dfztadd']=$value['10'];
			$lvalue['dfdf']=$value['11'];
			$lvalue['dfzypay']=$value['12'];
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
		$model=M('Zxwuxiangoverlook');
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
		$overlookmodel=D('Zxwuxiangoverlook');
		if($overlookmodel->ccheck($overlook)){
			$this->error("已经有此记录");
		}
		//查找预算记录id
		$pid=M('Zxwuxiangoverlook')->where(array('year'=>$post['year'],'unitid'=>session(C('ADMIN_AUTH_UNITID'))))->field('id')->find();
		$overlook['pid']=$pid['id'];
		if(false===$overlookmodel->create($overlook)){
			$this->error("create失败！");
		}
		if (!$overlookid=$overlookmodel->add()) {
			$this->error($overlookmodel->getLastSql());
		}

		//去掉前面几个值
		$qpost=array_slice($post,2,5);
		$i=1;
		$zhixingmoneymodel=M('Zxwuxiangmoney');
		foreach ($qpost as $value) {
			//压为create数组
			$lvalue['overlook_id']=$overlookid;
			$lvalue['name_id']=$i++;

			$lvalue['alladd']=$value['0'];
			$lvalue['jingfeiztadd']=$value['1'];
			$lvalue['czadd']=$value['2'];
			$lvalue['czyunxing']=$value['3'];
			$lvalue['czjishi']=$value['4'];
			$lvalue['czshoufei']=$value['5'];
			$lvalue['czother']=$value['6'];
			$lvalue['nczadd']=$value['7'];
			$lvalue['nczotherin']=$value['8'];
			$lvalue['nczdfzx']=$value['9'];
			$lvalue['dfztadd']=$value['10'];
			$lvalue['dfdf']=$value['11'];
			$lvalue['dfzypay']=$value['12'];
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
		$year=M('Zxwuxiangoverlook')->where(array('id'=>array('neq',0)))->field('year')->distinct(true)->select();
		$unit=M('Unit')->where(array('unitlock'=>'0'))->field('id,name')->select();
		$this->assign('unit',$unit);
		$this->assign('year',$year);
		//查询开始
		$post['year']=I('post.postyear');
		$post['month']=I('post.postmonth');
		$post['unitid']=I('post.postunitid');
		$zxwuxiangkemulookviewmodel=D('ZxwuxiangkemulookView');
		if ($post['unitid']=='all') {
			$selectdata=$zxwuxiangkemulookviewmodel->where(array('year'=>I('post.postyear'),'month'=>I('post.postmonth')))->order('id asc,kemunameid asc')->select();
			
			//不同单据的数组相加
			for ($i=0; $i <5 ; $i++) { 
				for ($j=5; $j <count($selectdata); $j++) { 
					if ($selectdata[$i]['kemunameid']==$selectdata[$j]['kemunameid']) {
						$selectdata[$i]['budget_caizheng']=$selectdata[$i]['budget_caizheng']+$selectdata[$j]['budget_caizheng'];
						$selectdata[$i]['budget_ncaizheng1']=$selectdata[$i]['budget_ncaizheng1']+$selectdata[$j]['budget_ncaizheng1'];
						$selectdata[$i]['budget_ncaizheng2']=$selectdata[$i]['budget_ncaizheng2']+$selectdata[$j]['budget_ncaizheng2'];
						$selectdata[$i]['use_caizheng']=$selectdata[$i]['use_caizheng']+$selectdata[$j]['use_caizheng'];
						$selectdata[$i]['use_ncaizheng1']=$selectdata[$i]['use_ncaizheng1']+$selectdata[$j]['use_ncaizheng1'];
						$selectdata[$i]['use_ncaizheng2']=$selectdata[$i]['use_ncaizheng2']+$selectdata[$j]['use_ncaizheng2'];
					}
				}
			}
			$selectdataadd=array_slice($selectdata,0,5);
			//单据上需要运算的数据
			foreach ($selectdataadd as $value) {
				$value['budget_ncaizheng']=$value['budget_ncaizheng1']+$value['budget_ncaizheng2'];
				$value['budget_add']=$value['budget_caizheng']+$value['budget_ncaizheng'];

				$value['use_ncaizheng']=$value['use_ncaizheng1']+$value['use_ncaizheng2'];
				$value['use_add']=$value['use_caizheng']+$value['use_ncaizheng'];

				$value['lv_caizheng']=(number_format($value['use_caizheng']/$value['budget_caizheng'],4)*100).'%';
				$value['lv_ncaizheng']=(number_format($value['use_ncaizheng']/$value['budget_ncaizheng'],4)*100).'%';
				$value['lv_add']=(number_format($value['use_add']/$value['budget_add'],4)*100).'%';

				$value['yu_caizheng']=$value['budget_caizheng']-$value['use_caizheng'];
				$value['yu_ncaizheng']=$value['budget_ncaizheng']-$value['use_ncaizheng'];
				$value['yu_add']=$value['budget_add']-$value['use_add'];

				$data[]=$value;
			}
		}else{
			$selectdata=$zxwuxiangkemulookviewmodel->where($post)->order('kemunameid asc')->select();
			foreach ($selectdata as $value) {
					$value['budget_ncaizheng']=$value['budget_ncaizheng1']+$value['budget_ncaizheng2'];
					$value['budget_add']=$value['budget_caizheng']+$value['budget_ncaizheng'];

					$value['use_ncaizheng']=$value['use_ncaizheng1']+$value['use_ncaizheng2'];
					$value['use_add']=$value['use_caizheng']+$value['use_ncaizheng'];

					$value['lv_caizheng']=(number_format($value['use_caizheng']/$value['budget_caizheng'],4)*100).'%';
					$value['lv_ncaizheng']=(number_format($value['use_ncaizheng']/$value['budget_ncaizheng'],4)*100).'%';
					$value['lv_add']=(number_format($value['use_add']/$value['budget_add'],4)*100).'%';

					$value['yu_caizheng']=$value['budget_caizheng']-$value['use_caizheng'];
					$value['yu_ncaizheng']=$value['budget_ncaizheng']-$value['use_ncaizheng'];
					$value['yu_add']=$value['budget_add']-$value['use_add'];

					$data[]=$value;
			}
		}
		$this->assign('data',$data);
		$this->display();
	}
	public function looktype2(){
		$year=M('Zxwuxiangoverlook')->where(array('id'=>array('neq',0)))->field('year')->distinct(true)->select();
		$adminname=M('zxwuxiangname')->field('id,name')->select();
		$this->assign('adminname',$adminname);
		$this->assign('year',$year);
		$post['year']=I('post.postyear');
		$post['month']=I('post.postmonth');
		//查出属于哪个支出表
		$overlookid=M('Zxwuxiangoverlook')->where($post)->field('id as overlook_id')->select();
		foreach ($overlookid as $value) {
			$value['Zxwuxiangmoney.name_id']=I('post.postnameid');
			$value['Zxwuxiangmoney.overlook_id']=$value['overlook_id'];
			unset($value['overlook_id']);
			$overlook[]=$value;
		}
		//查询开始，以支出表为依据依次查出预算表
		$zxwuxiangdanweilookviewmodel=D('ZxwuxiangdanweilookView');
		foreach ($overlook as $value) {
			$selectdata[]=$zxwuxiangdanweilookviewmodel->where($value)->select();
		}
		//将3级数组合并为二级数组方便视图输出
		foreach ($selectdata as $value) {
			foreach ($value as $avalue) {
				$avalue['budget_ncaizheng']=$avalue['budget_ncaizheng1']+$avalue['budget_ncaizheng1'];
				$avalue['budget_add']=$avalue['budget_caizheng']+$avalue['budget_ncaizheng'];

				$avalue['use_ncaizheng']=$avalue['use_ncaizheng1']+$avalue['use_ncaizheng2'];
				$avalue['use_add']=$avalue['use_caizheng']+$avalue['use_ncaizheng'];

				$avalue['lv_caizheng']=(number_format($avalue['use_caizheng']/$avalue['budget_caizheng'],4)*100).'%';
				$avalue['lv_ncaizheng']=(number_format($avalue['use_ncaizheng']/$avalue['budget_ncaizheng'],4)*100).'%';
				$avalue['lv_add']=(number_format($avalue['use_add']/$avalue['budget_add'],4)*100).'%';

				$avalue['yu_caizheng']=$avalue['budget_caizheng']-$avalue['use_caizheng'];
				$avalue['yu_ncaizheng']=$avalue['budget_ncaizheng']-$avalue['use_ncaizheng'];
				$avalue['yu_add']=$avalue['budget_add']-$avalue['use_add'];

				$data[]=$avalue;
			}
		}
		foreach ($data as $value) {
			$addvalue['budget_caizheng']+=$value['budget_caizheng'];
			$addvalue['budget_ncaizheng']+=$value['budget_ncaizheng'];
			$addvalue['budget_add']+=$value['budget_add'];
			$addvalue['use_caizheng']+=$value['use_caizheng'];
			$addvalue['use_ncaizheng']+=$value['use_ncaizheng'];
			$addvalue['use_add']+=$value['use_add'];
			$addvalue['lv_caizheng']=(number_format($addvalue['use_caizheng']/$addvalue['budget_caizheng'], 4)*100).'%';
			$addvalue['lv_ncaizheng']=(number_format($addvalue['use_ncaizheng']/$addvalue['budget_ncaizheng'], 4)*100).'%';
			$addvalue['lv_add']=(number_format($addvalue['use_add']/$addvalue['budget_add'],4)*100).'%';
			$addvalue['yu_caizheng']+=$value['yu_caizheng'];
			$addvalue['yu_ncaizheng']+=$value['yu_ncaizheng'];
			$addvalue['yu_add']+=$value['yu_add'];
			$addvalue['unitname']='总计';
		}
		$adddata[]=$addvalue;
		$this->assign('adddata',$adddata);
		$this->assign('data',$data);
		$this->display();

	}
	public function budgetggoverlook(){
		$overlookmodel=D('Zxwuxiangoverlook');
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
		$overlookmodel=M('Zxwuxiangoverlook');
		$overlookdata=$overlookmodel->where(array('id'=>$overlookid))->field('year,id')->find();
		$this->assign('overlookdata',$overlookdata);
		//金额输出
		$zhixingmoneymodel=D('ZxwuxiangbudgetmoneyView');
		$moneydata=$zhixingmoneymodel->where(array('overlook_id'=>$overlookid))->order('name_id')->select();
		$this->assign('moneydata',$moneydata);
		$this->display();
	}
	public function budgetsave(){
		$post=I('post.');
		//单据上需要运算的数据
		foreach ($post['aa'] as $key=>$value) {
			$value['dfztadd']=$value['dfdf']+$value['dfzypay'];
			$value['nczadd']=$value['nczotherin']+$value['nczdfzx'];
			$value['czadd']=$value['czyunxing']+$value['czjishi']+$value['czshoufei']+$value['czother'];
			$value['jingfeiztadd']=$value['czadd']+$value['nczadd'];
			$value['alladd']=$value['jingfeiztadd']+$value['dfztadd'];
			$data[$key]=$value;
		}
		
		//存数据
		$model=M('Zxwuxiangmoney');
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
		$overlookmodel=D('Zxwuxiangoverlook');
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
		$overlookmodel=M('Zxwuxiangoverlook');
		$overlookdata=$overlookmodel->where(array('id'=>$overlookid))->field('year,month,id')->find();
		$this->assign('overlookdata',$overlookdata);
		//金额输出
		$zhixingmoneymodel=D('ZxwuxiangbudgetmoneyView');
		$moneydata=$zhixingmoneymodel->where(array('overlook_id'=>$overlookid))->order('name_id')->select();
		$this->assign('moneydata',$moneydata);
		$this->display();
	}
	public function usesave(){
		$post=I('post.');
		//单据上需要运算的数据
		foreach ($post['aa'] as $key=>$value) {
			$value['dfztadd']=$value['dfdf']+$value['dfzypay'];
			$value['nczadd']=$value['nczotherin']+$value['nczdfzx'];
			$value['czadd']=$value['czyunxing']+$value['czjishi']+$value['czshoufei']+$value['czother'];
			$value['jingfeiztadd']=$value['czadd']+$value['nczadd'];
			$value['alladd']=$value['jingfeiztadd']+$value['dfztadd'];
			$data[$key]=$value;
		}
		//存数据
		$model=M('Zxwuxiangmoney');
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
		$overlookdel=M('Zxwuxiangoverlook')->where(array('id'=>$id))->delete();
		$moneydel=M('Zxwuxiangmoney')->where(array('overlook_id'=>$id))->delete();
		if ($moneydel) {
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
	}
}
?>