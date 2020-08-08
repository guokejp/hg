<?php 
	function autocheck($rule,$html)
	{
		if(session(C('ADMIN_AUTH_ID')) == 1){
			return $html;
		}

		$Auth = new \Think\Auth();
		if($Auth->check($rule, session(C('ADMIN_AUTH_ID')))){
			return $html;
		}
		return false;
		//return $html;
	}

	function showprocurementtype($id)
	{
		switch($id){
			case 1:
				return '市场比价';
			case 2:
				return '集中采购';
			case 3:
				return '服务合同续签';
			case 4:
				return '内外网同时征集比选';
			case 5:
				return '内外网征集比选';
			case 6:
				return '商场直购';
			case 7:
				return '公开招标';
		}
	}

	function showconferencetype($id)
	{
		switch($id){
			case 1:
				return '一类';
			case 2:
				return '二类';
			case 3:
				return '三类';
			case 4:
				return '四类';
		}
	}

	function showconferencemonth($id)
	{
		switch($id){
			case 1:
				return '一月';
			case 2:
				return '二月';
			case 3:
				return '三月';
			case 4:
				return '四月';
			case 5:
				return '五月';
			case 6:
				return '六月';
			case 7:
				return '七月';
			case 8:
				return '八月';
			case 9:
				return '九月';
			case 10:
				return '十月';
			case 11:
				return '十一月';
			case 12:
				return '十二月';
		}
	}

	function showconferencestatus($id)
	{
		switch($id){
			case 0:
				return '<span style="color:blue"><b>未报销</b></span>';
			case 1:
				return '<span style="color:red"><b>报销中</b></span>';
			case 2:
				return '<span style="color:green"><b>已报销</b></span>';
		}
	}

	function showprocurement($id)
	{
		if($id){
			return '<span><b>是</b></span>';
		}else{
			return '<span><b>否</b></span>';
		}
	}

	function showbilltype($id)
	{
		switch($id){
			case 0:
				return '包干经费';
			case 1:
				return '会议费';
			case 2:
				return '培训费';
			case 3:
				return '专项费';
			case 4:
				return '一事一申请';
			case 5:
				return '政府采购';
		}
	}

	function showcatlog($id)
	{
		switch($id){
			case '0':
				return '初始化预算';
			case '1':
				return '后台修改，增加预算';
			case '2':
				return '后台修改，减少预算';
			case '3':
				return '申请预算';
			case '4':
				return '报销';
			default:
				break;
		}
	}

	function showcatlogtype($id)
	{
		switch($id){
			case '0':
				return '+';
			case '1':
				return '+';
			case '2':
				return '-';
			case '3':
				return '+';
			case '4':
				return '-';
			default:
				break;
		}
	}
	function format_bytes($size, $delimiter = '')
	{
	    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
	    return round($size, 2) . $delimiter . $units[$i];
	}
	function categorylist($select,$pid=0,$level=0,$html='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp',$tree=array()){
		foreach ($select as $value) {
			if ($value['pid']==$pid) {
				$value['html']=str_repeat($html, $level);
				$tree[]=$value;
				$tree=categorylist($select,$value['id'],$level+1,$html='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp',$tree);
			}
		}
		return $tree;
	}
	function category_each($list,$pid=0){
		foreach ($list as $val) {
			if ($val['pid']==$pid) {
				$child=category_each($list,$val['id']);
				if (!empty($child)) {
					$val['child']=$child;
				}
				$tree[]=$val;
			}
		}
		return $tree;
	}
	function speciallist($select,$pid=0,$level=0,$html='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp',$tree=array()){
		foreach ($select as $value) {
			if ($value['pid']==$pid) {
				$value['html']=str_repeat($html, $level);
				$tree[]=$value;
				$tree=speciallist($select,$value['id'],$level+1,$html='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp',$tree);
			}
		}
		return $tree;
	}
	function special_each($list,$pid=0){
		foreach ($list as $val) {
			if ($val['pid']==$pid) {
				$child=special_each($list,$val['id']);
				if (!empty($child)) {
					$val['child']=$child;
				}
				$tree[]=$val;
			}
		}
		return $tree;
	}
	function geteqsec($inlist){//相同部门结合数组，生成包干费用报表使用
		foreach ($inlist as $key => $value) {
			$seckey=$value['sectionid'];
			if (array_key_exists($seckey, $list)) {
				$list[$seckey]['sectionname']=$value['sectionname'];
				$list[$seckey][$value['categoryid']]=$value;
			}else{
				$list[$seckey]['sectionname']=$value['sectionname'];
				$list[$seckey][$value['categoryid']]=$value;
			}
		}
		//print_r($inlist);
		return $list;
	}