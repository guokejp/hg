<?php
namespace Home\Controller;
/**
* 
*/
class CommonController extends BaseController
{
	public function _initialize()
	{
		if(false != $term=M('Term')->where('status=1')->find()){
			session(C('TERM_ID'),$term['id']);
			session(C('TERM_NAME'),$term['name']);
		}else{
			$this->error('没有账期！');
		}

		if(false===session('?'.C('ADMIN_AUTH_ID'))	){//判断是否登陆
			$this->redirect('Login/index');
		}
		if(session(C('ADMIN_AUTH_ID')) == 1){//判断是否超级管理员
			return true;
		}
	}

	function exportExcel($expTitle,$expCellName,$expTableData){//Êý¾Ýµ¼³öº¯Êý
		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//ÎÄ¼þÃû³Æ
		$fileName = $_SESSION['adminuser'].date('_YmdHis');//or $xlsTitle ÎÄ¼þÃû³Æ¿É¸ù¾Ý×Ô¼ºÇé¿öÉè¶¨
		$cellNum = count($expCellName);
		$dataNum = count($expTableData);

		import("Org.Util.PHPExcel");
				
		$objPHPExcel =new \PHPExcel();
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

		for($i=0;$i<$cellNum;$i++){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
		}
		// Miscellaneous glyphs, UTF-8
		for($i=0;$i<$dataNum;$i++){
			for($j=0;$j<$cellNum;$j++){
				$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
			}
		}

		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
		header("Content-Disposition:attachment;filename=$fileName.xls");//attachmentÐÂ´°¿Ú´òÓ¡inline±¾´°¿Ú´òÓ¡
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');

		exit;
	}
	public function get_orderid($categoryid){
		$l_bill=M('Bill')->order('id desc')->find();
		$l_orderid=$l_bill['orderid'];
		if ($categoryid=='conference') {
			$bx_ord='HY';
		}elseif ($categoryid=='train') {
			$bx_ord='PX';
		}elseif ($categoryid=='special') {
			$bx_ord='ZX';
		}elseif ($categoryid=='contract') {
			$bx_ord='CG';
		}elseif(is_numeric($categoryid)) {
			$map['id']=$categoryid;
			$bx_ord=M('Category')->where($map)->getField('bx_ord');
		}
		if (empty($l_orderid)) {
			$year=date('Y');
			$number=sprintf("%05d", 1);
		}else{
			$str=explode("_",$l_orderid);
			$l_year=$str[1];
			$l_number=$str[2];
			if ($l_year<date('Y')) {
				$year=date('Y');
				$number=sprintf("%05d", 1);
			}else{
				$year=$l_year;
				$number=sprintf("%05d", $l_number+1);
			}
		}
		$orderid=$bx_ord.'_'.$year.'_'.$number;
		return $orderid;
	}
	public function get_incomeid(){
		$l_orderid=M('Income')->order('id desc')->getField('orderid');
		if (empty($l_orderid)) {
			$year=date('Y');
			$number=sprintf("%05d", 1);
		}else{
			$l_year=substr($l_orderid, 3,4);
			$l_number=substr($l_orderid, 8,4);
			if ($l_year<date('Y')) {
				$year=date('Y');
				$number=sprintf("%05d", 1);
			}else{
				$year=$l_year;
				$number=sprintf("%05d", $l_number+1);
			}
		}
		$orderid='YS_'.$year.'_'.$number;
		return $orderid;
	}

	public function checkallow($checkallowdata){//报销审批函数，防止单个审批和集中审批代码冗余
		$post=$checkallowdata;
		$model=D('Bill');
		$status=$post['status'];
		$id=$post['id'];
		$billinfo=$model->where('id='.$id)->find();
		switch($billinfo['type']){
			case '0'://包干
				if ($post['pcat']) {//父级必须存在，有子集以子集为projectid
					if ($post['ccat']) {
						$post['projectid']=$post['ccat'];      
					}else{
						$post['projectid']=$post['pcat']; 
					}
				}
				if ($post['status']==1) {//审核通过
					$map['termid']=$billinfo['termid'];
					$map['sectionid']=$billinfo['sectionid'];
					empty($post['projectid']) ? $map['categoryid']=$billinfo['projectid'] : $map['categoryid']=$post['projectid'];
					//报销后不能小于零
					$cbut_l_money=M('Catbudget')->where($map)->getField('money');
					if ($cbut_l_money>=$post['confirm']) {
						M('Catbudget')->where($map)->setDec('money',$post['confirm']);
					}else{
						$this->error('剩余预算金额'.$cbut_l_money);
					}
					
					unset($billinfo['id']);
					empty($post['projectid']) ? $billinfo['categoryid']=$billinfo['projectid'] : $billinfo['categoryid']=$post['projectid'];
					$billinfo['money']=$post['confirm'];
					$billinfo['type']=4;
					$billinfo['billid']=$id;
					M('Catlog')->add($billinfo);
				}

				if(false === $model->create($post)){
					$this->error($model->getError());
				}
				if(false === $model->save()){
					$this->error($model->_sql());
				}
				unset($map);

				break;
			case '1'://会议
				if(false === $model->create($post)){
					$this->error($model->getError());
				}
				if(false === $model->save()){
					$this->error($model->_sql());
				}

				$data['id']=$billinfo['projectid'];
				$data['status']=2;;
				$data['confirm']=$post['confirm'];
				M('Conference')->save($data);
				unset($data);

				break;
			case '2'://培训

				if(false === $model->create($post)){
					$this->error($model->getError());
				}
				if(false === $model->save()){
					$this->error($model->_sql());
				}

				unset($map);
				$map['id']=$billinfo['projectid'];
				M('Train')->where($map)->setInc('confirm',$post['confirm']);
				// $data['status']=2;
				// $data['confirm']=$billinfo['confirm'];
				// M('Train')->save($data);
				unset($map);

				break;
			case '3'://专项
				$sectionid=M('Bill')->where('id='.$post['id'])->getField('sectionid');
				if ($post['cspe']) {//使用的专项有修改
					$post['projectid']=M('Spebudget')->where('id='.$post['cspe'])->getField('specialid');
				}elseif (!empty($post['pspe'])&&empty($post['cspe'])) {
					$post['projectid']=M('Spebudget')->where('id='.$post['pspe'])->getField('specialid');
				}
				if ($post['status']==1) {//通过审核
					$post['projectid'] ? $havemomap['specialid']=$post['projectid'] : $havemomap['specialid']=$post['oldprojectid'] ;
					$havemomap['sectionid']=$sectionid;
					$havemoney=M('Spebudget')->where($havemomap)->getField('money');
					unset($havemomap);
					if ($havemoney<$post['confirm']) {
						$this->error('剩余金额'.$havemoney);
					}
					if ($post['projectid']&&$post['projectid']!=$post['oldprojectid']) {//改了报销专项
						//将报销填写的金额反冲给原报销专项total
						$passmap['specialid']=$post['oldprojectid'];
						$passmap['sectionid']=$sectionid;
						M('Spebudget')->where($passmap)->setInc('total',$post['billmoney']);
						//修改专项后，将修改后的专项的钱减下来
						$passmap['specialid']=$post['projectid'];
						M('Spebudget')->where($passmap)->setDec('money',$post['confirm']);
						M('Spebudget')->where($passmap)->setDec('total',$post['confirm']);
					}elseif (empty($post['projectid'])) {//没改报销专项
						$passmap['specialid']=$post['oldprojectid'];
						$passmap['sectionid']=$sectionid;

						$changemoney=$post['billmoney']-$post['confirm'];
						M('Spebudget')->where($passmap)->setInc('total',$changemoney);
						M('Spebudget')->where($passmap)->setDec('money',$post['confirm']);
					}

					//存储到专项报销日志
					$spebudid=M('Spebudget')->where($passmap)->getField('id');
					$spelog['unitid']=$billinfo['unitid'];
					$spelog['sectionid']=$billinfo['sectionid'];
					$spelog['staffid']=$billinfo['staffid'];
					$spelog['spebudid']=$spebudid;
					$spelog['billid']=$id;
					$spelog['money']=$post['confirm'];
					$spelog['type']='1';
					$spelog['logdate']=date('Y-m-d');
					M('Spelog')->add($spelog);
					unset($passmap);

				}elseif ($post['status']==2) {
					//将报销填写的金额反冲给不报销状态
					$unpassmap['specialid']=$post['oldprojectid'];
					$unpassmap['sectionid']=$sectionid;
					M('Spebudget')->where($unpassmap)->setInc('total',$post['billmoney']);
					unset($unpassmap);
				}
				if(false === $model->create($post)){
					$this->error($model->getError());
				}
				if(false === $model->save()){
					$this->error($model->_sql());
				}
				break;
			case '4'://一事一申请
				if(false === $model->create($post)){
					$this->error($model->getError());
				}
				if(false === $model->save()){
					$this->error($model->_sql());
				}

				$data['id']=$billinfo['projectid'];
				$data['status']=2;
				$data['confirm']=$post['confirm'];
				M('Oncebudget')->save($data);
				break;
			case '5'://政府采购
				if(false === $model->create($post)){
					$this->error($model->getError());
				}
				if(false === $model->save()){
					$this->error($model->_sql());
				}

				$data['id']=$billinfo['contractmoneyid'];
				if ($billinfo['contractmoneyqishuid']==1) {
					$data['firststatus']=1;
				}elseif ($billinfo['contractmoneyqishuid']==2) {
					$data['secondstatus']=1;
				}elseif ($billinfo['contractmoneyqishuid']==3) {
					$data['thirdstatus']=1;
				}elseif ($billinfo['contractmoneyqishuid']==4) {
					$data['fourthstatus']=1;
				}elseif ($billinfo['contractmoneyqishuid']==5) {
					$data['fifthstatus']=1;
				}elseif ($billinfo['contractmoneyqishuid']==6) {
					$data['warrantystatus']=1;
				}
				//对应合同期数状态设置成已报销
				if (false===M('ContractMoney')->create($data)) {
					$this->error('错误');
				}
				if (false===M('ContractMoney')->save($data)) {
					$this->error('失败');
				}

				$contractdata=M('Contract')->where(array('id'=>$billinfo['projectid']))->field('isother,specialid')->find();
				if ($contractdata['isother']==0) {
					//专项中剩余金额减少
					M('Spebudget')->where(array('id'=>$contractdata['specialid']))->setDec('money',$post['confirm']);

					//生成专项使用日志
					$spelog['unitid']=$billinfo['unitid'];
					$spelog['sectionid']=$billinfo['sectionid'];
					$spelog['staffid']=$billinfo['staffid'];
					$spelog['spebudid']=$contractdata['specialid'];
					$spelog['money']=$post['confirm'];
					$spelog['type']='2';
					$spelog['logdate']=date('Y-m-d');
					M('Spelog')->add($spelog);


				}
				//判断对应合同是否完成支付，便于前台过滤
				$iscontractover=M('ContractMoney')->where(array('contractid'=>$billinfo['projectid']))->select();
				foreach ($iscontractover as $value) {
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
					$isover[]=$value['firststatus']&&$value['secondstatus']&&$value['thirdstatus']&&$value['fourthstatus']&&$value['fifthstatus']&&$value['warrantystatus'];
				}
				$final=1;
				for ($i=0; $i <count($isover); $i++) { 
					$final=$final&&$isover[$i];
				}
				if ($final) {
					M('Contract')->where(array("id"=>$billinfo['projectid']))->setField('isover','1');
				}
				break;
		}
	}
	public function appli_cate_p(){//一级包干清单函数
		$catgroy=M('Category')->where(array('pid'=>0,'once'=>1))->order('id')->getField('id',true);
		//滤掉有子包干项
		foreach ($catgroy as $value) {
			if (!M('Category')->where(array('pid'=>$value))->count()) {
				$p_catgroy[]=$value;
			}
		}
		$catbumap['Catbudget.termid']=session(C('TERM_ID'));
		$catbumap['Section.unitid']=session(C('ADMIN_AUTH_UNITID'));
		if (!$p_catgroy) {
			return;
		}
		$catbumap['Catbudget.categoryid']=array('in',$p_catgroy);
		$p_catbud=D('SecCatbudView')->where($catbumap)->order('sectionid,categoryid')->select();
		//print_r($p_catbud);
		//压入结余数
		foreach ($p_catbud as $value) {
			$value['cost']=$value['init_money']-$value['money'];
			$l_list[]=$value;
		}
		$geteqseclist=geteqsec($l_list);
		//将部门清单中没有包干预算项的置0，方便双向循环输出
		foreach ($geteqseclist as $k_sec=>$val_sec) {
			foreach ($p_catgroy as $k_incat) {
				if (!array_key_exists($k_incat, $val_sec)) {
					$val_sec[$k_incat]['sectionid']=$k_sec;
					$val_sec[$k_incat]['categoryid']=$val_cat;
					$val_sec[$k_incat]['init_money']='0';
					$val_sec[$k_incat]['money']='0';
					$val_sec[$k_incat]['categoryname']='0';
					$val_sec[$k_incat]['cost']='0';
				}
			}
			ksort($val_sec);
			$list[$k_sec]=$val_sec;	
		}
		return $list;
	}
	public function appli_cate_c(){//二级包干清单函数
		$catgrory=M('Category')->where(array('once'=>1))->order('pid,id')->field('id,pid,name')->select();
		$catlist=category_each($catgrory);
		//获取使用情况值
		foreach ($catlist as $val_p) {
			$l_list['pname']=$val_p['name'];
			if (is_array($val_p['child'])) {
				unset($l_list['budget']);
				foreach ($val_p['child'] as $val_ch) {
					$catbumap['Catbudget.termid']=session(C('TERM_ID'));
					$catbumap['Section.unitid']=session(C('ADMIN_AUTH_UNITID'));
					$catbumap['Catbudget.categoryid']=$val_ch['id'];
					$p_catbud=D('SecCatbudView')->where($catbumap)->order('sectionid')->select();

					$l_list['budget'][]=$p_catbud;
				}
			}else{
				continue;
			}
			$f_list[]=$l_list;
		}
		//压入支出数，压入合计
		foreach ($f_list as $val_a) {
			$pname=$val_a['pname'];
			$add_init_money=0;
			$add_cost=0;
			$add_money=0;
			foreach ($val_a['budget'] as $val_b) {
				foreach ($val_b as $val_c) {
					//支出数
					$val_c['cost']=$val_c['init_money']-$val_c['money'];
					$list_a['name']=$pname;
					//print_r($val_c);
					$list_a[]=$val_c;
					//合计
					$add_init_money+=$val_c['init_money'];
					$add_cost+=$val_c['cost'];
					$add_money+=$val_c['money'];
					$categoryname='合计';
				}
				$add['init_money']=$add_init_money;
				$add['cost']=$add_cost;
				$add['money']=$add_money;
				$add['categoryname']=$categoryname;
			}
			$list_a[]=$add;

			$list[]=$list_a;
			unset($list_a);
		}
		return $list;
	}
	public function appli_spe_c(){//二级包干清单函数
		$spe=M('Special')->where(array('unitid'=>session(C('ADMIN_AUTH_UNITID')),'year'=>session(C('TERM_NAME'))))->order('pid,id')->getField('id',true);
		$spebumap['Spebudget.unitid']=session(C('ADMIN_AUTH_UNITID'));
		$spebumap['Spebudget.specialid']=array('in',$spe);
		if (!$spe) {
			return;
		}
		$spebud['name']='专项';
		$speselect=D('SpebudgetView')->where($spebumap)->order('sectionid,specialid')->select();
		foreach ($speselect as $value) {
			$value['cost']=$value['firstallmoney']-$value['money'];

			$spebud['budget'][]=$value;
		}
		return $spebud;
	}
}
