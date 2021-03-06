<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo session(C('ADMIN_AUTH_UNITNAME'));?>-成都海关财务预算系统</title>

<link href="/hg/Public/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/hg/Public/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/hg/Public/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="/hg/Public/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<!--[if IE]>
<link href="/hg/Public/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->

<!--[if lte IE 9]>
<script src="/hg/Public/js/speedup.js" type="text/javascript"></script>
<![endif]-->

<script src="/hg/Public/js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="/hg/Public/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/hg/Public/js/jquery.validate.js" type="text/javascript"></script>
<script src="/hg/Public/js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="/hg/Public/xheditor/xheditor-1.2.1.min.js" type="text/javascript"></script>
<script src="/hg/Public/xheditor/xheditor_lang/zh-cn.js" type="text/javascript"></script>
<script src="/hg/Public/uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>

<!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
<script type="text/javascript" src="/hg/Public/chart/raphael.js"></script>
<script type="text/javascript" src="/hg/Public/chart/g.raphael.js"></script>
<script type="text/javascript" src="/hg/Public/chart/g.bar.js"></script>
<script type="text/javascript" src="/hg/Public/chart/g.line.js"></script>
<script type="text/javascript" src="/hg/Public/chart/g.pie.js"></script>
<script type="text/javascript" src="/hg/Public/chart/g.dot.js"></script>

<script src="/hg/Public/js/dwz.core.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.util.date.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.validate.method.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.barDrag.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.drag.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.tree.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.accordion.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.ui.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.theme.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.switchEnv.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.alertMsg.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.contextmenu.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.navTab.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.tab.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.resize.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.dialog.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.dialogDrag.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.sortDrag.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.cssTable.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.stable.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.taskBar.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.ajax.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.pagination.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.database.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.datepicker.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.effects.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.panel.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.checkbox.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.history.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.combox.js" type="text/javascript"></script>
<script src="/hg/Public/js/dwz.print.js" type="text/javascript"></script>

<!-- 可以用dwz.min.js替换前面全部dwz.*.js (注意：替换是下面dwz.regional.zh.js还需要引入)
<script src="bin/dwz.min.js" type="text/javascript"></script>
-->
<script src="/hg/Public/js/dwz.regional.zh.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	DWZ.init("/hg/Public/dwz.frag.xml", {
		loginUrl:"<?php echo U('Login/login_dialog');?>", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ok:1, error:0, timeout:301}, //【可选】
		pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
		keys: {statusCode:"status", message:"info"}, //【可选】
		ui:{hideMode:'offsets'}, //【可选】hideMode:navTab组件切换的隐藏方式，支持的值有’display’，’offsets’负数偏移位置的值，默认值为’display’
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({themeBase:"/hg/Public/themes"}); // themeBase 相对于index页面的主题base路径
		}
	});
	for (var i = 0; i <= 5; i++) {
		if ( $('#null'+i).children().length==0 ) {
			$('#null'+i).parent().hide()
		};
	};
	for (var i = 0; i <= 2; i++) {
		if ( $('#nullk'+i).children().length==0 ) {
			$('#nullk'+i).parent().hide()
		};
	};
	if ($('#nullkk').find('a:[target=navtab]').length==0) {
		$('#nullkk').parent().hide();
	};
	if ($('#nullkkk').find('a:[target=navtab]').length==0) {
		$('#nullkkk').parent().hide();
	};
	
});
setInterval(function(){
	$timestamp=Math.round(new Date().getTime()/1000);
    $('#timer').attr('src','/hg/index.php?s=/Home/Index/timer/'+$timestamp);
}, 60000);
</script>
</head>

<body scroll="no">
<iframe style="display:none" src="/hg/index.php?s=/Home/Index/timer" id="timer" ></iframe>
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a class="logo" href="#">标志</a>
				<ul class="nav">
					<li><a href="javascript:void(0)"><?php echo session(C('ADMIN_AUTH_NAME'));?></a></li>
					<li><a href="<?php echo U('Staff/editpass');?>" target="dialog">修改密码</a></li>
					<li><a href="<?php echo U('Login/logout');?>">退出</a></li>
				</ul>
			</div>

			<!-- navMenu -->
			
		</div>

		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar">
				<div class="toggleCollapse"><h2>财务预算系统</h2><div>收缩</div></div>

				<div class="accordion" fillSpace="sidebar">
					<div class="accordionHeader">
						<h2><span>Folder</span>控制面板</h2>
					</div>
					<div class="accordionContent">
					<ul class="tree treeFolder expand">
						<li><a>工资管理</a>
						<ul id="null0">
						<?php echo autocheck('Home/Mywages/index','<li><a href="/hg/index.php?s=/Home/Mywages/index" target="navtab" rel="Mywagesindex">个人工资</a></li>');?>
						<?php echo autocheck('Home/Wages/index','<li><a href="/hg/index.php?s=/Home/Wages/index" target="navtab" rel="Wagesindex">工资管理</a></li>');?>
						</ul>
						</li>
						<li><a>预算执行</a>
						<ul id="nullkkk">
							<li><a>数据录入</a>
								<ul id="nullk0">
									<?php echo autocheck('Home/Zhixingadmin/budgetadd','<li><a href="/hg/index.php?s=/Home/Zhixingadmin/budgetadd" target="navtab" rel="Zhixingadminbudgetadd">行政预算录入</a></li>');?>
									<?php echo autocheck('Home/Zhixingchoose/usechoose','<li><a href="/hg/index.php?s=/Home/Zhixingchoose/usechoose" target="navtab" rel="Zhixingchooseusechoose">收入支出录入</a></li>');?>
									<?php echo autocheck('Home/Zhixingchoose/wuxiangchoose','<li><a href="/hg/index.php?s=/Home/Zhixingchoose/wuxiangchoose" target="navtab" rel="Zhixingchoosewuxiangchoose">五项费用录入</a></li>');?>
								</ul>
							</li>
							<li><a>数据修改</a>
								<ul id="nullk1">
									<?php echo autocheck('Home/Zhixingadmin/budgetggoverlook','<li><a href="/hg/index.php?s=/Home/Zhixingadmin/budgetggoverlook" target="navtab" rel="Zhixingadminbudgetggoverlook">行政预算修改</a></li>');?>
									<?php echo autocheck('Home/Zhixingchoose/useggchoose','<li><a href="/hg/index.php?s=/Home/Zhixingchoose/useggchoose" target="navtab" rel="Zhixingchooseoverlookchoose">收入支出修改</a></li>');?>
									<?php echo autocheck('Home/Zhixingchoose/wuxiangggchoose','<li><a href="/hg/index.php?s=/Home/Zhixingchoose/wuxiangggchoose" target="navtab" rel="Zhixingchooseconditionlookchoose">五项费用修改</a></li>');?>
								</ul>
							</li>
							<li><a>统计查询</a>
								<ul id="nullkk">
									<li><a>类型选择</a>
										<ul id="nullk2">
											<?php echo autocheck('Home/Zhixingadmin/looktypechoose','<li><a href="/hg/index.php?s=/Home/Zhixingadmin/looktypechoose" target="navtab" rel="Zhixingadminlooktypechoose">行政</a></li>');?>
											<?php echo autocheck('Home/Zhixingshiye/look','<li><a href="/hg/index.php?s=/Home/Zhixingshiye/look" target="navtab" rel="Zhixingshiyelook">事业</a></li>');?>
											<?php echo autocheck('Home/Zhixingqiye/look','<li><a href="/hg/index.php?s=/Home/Zhixingqiye/look" target="navtab" rel="Zhixingqiyelook">企业</a></li>');?>
											<?php echo autocheck('Home/Zhixingshetuan/look','<li><a href="/hg/index.php?s=/Home/Zhixingshetuan/look" target="navtab" rel="Zhixingshetuanlook">社团</a></li>');?>
										</ul>
									</li>
									<?php echo autocheck('Home/Zhixingwuxiang/looktypechoose','<li><a href="/hg/index.php?s=/Home/Zhixingwuxiang/looktypechoose" target="navtab" rel="Zhixingchooseconditionlookchoose">五项专用查询</a></li>');?>
								</ul>
							</li>
						</ul>
						</li>
						<li><a>单位业务数据(普通用户)</a>
						<ul id="null1">
						<?php echo autocheck('Home/Bill/add','<li><a href="/hg/index.php?s=/Home/Bill/add/level/0" width="640" height="480" target="dialog" rel="Billadd">报销单录入</a></li>');?>
						<?php echo autocheck('Home/Bill/index','<li><a href="/hg/index.php?s=/Home/Bill/index" target="navtab" rel="Billindex">报销单查询</a></li>');?>
						<?php echo autocheck('Home/Income/search','<li><a href="/hg/index.php?s=/Home/Income/search" target="navtab" rel="Incomesearch">部门预算查询</a></li>');?>
						<?php echo autocheck('Home/Specialother/index','<li><a href="/hg/index.php?s=/Home/Specialother/index" target="navtab" rel="Specialotherindex">采购查询（其它）</a></li>');?>
						<?php echo autocheck('Home/Income/add','<li><a href="/hg/index.php?s=/Home/Income/add" width="640" height="480" target="dialog" rel="Incomeadd">部门预算申请</a></li>');?>
						<?php echo autocheck('Home/Income/index','<li><a href="/hg/index.php?s=/Home/Income/index" target="navtab" rel="Incomeindex">预算申请查询</a></li>');?>
						</ul>
						</li>
						<li><a>政府采购计划</a>
						<ul id="null2">
						<?php echo autocheck('Home/Contract/add','<li><a href="/hg/index.php?s=/Home/Contract/add" target="navtab" rel="Contractadd">计划录入</a></li>');?>
						<?php echo autocheck('Home/Contract/index','<li><a href="/hg/index.php?s=/Home/Contract/index" target="navtab" rel="Contractindex">合同录入</a></li>');?>
						<?php echo autocheck('Home/Contract/look','<li><a href="/hg/index.php?s=/Home/Contract/look" target="navtab" rel="Contractlook">合同查询</a></li>');?>
						</ul>
						</li>
						<li><a>单位基础数据(单位财务)</a>
						<ul id="null3">
						<?php echo autocheck('Home/Income/audit','<li><a href="/hg/index.php?s=/Home/Income/audit" target="navtab" rel="Incomeaudit">预算申请审批</a></li>');?>
						<?php echo autocheck('Home/Bill/audit','<li><a href="/hg/index.php?s=/Home/Bill/audit" target="navtab" rel="Billaudit">报销单审批</a></li>');?>
						<?php echo autocheck('Home/Specialother/audit','<li><a href="/hg/index.php?s=/Home/Specialother/audit" target="navtab" rel="Specialotheraudit">采购审批（其它）</a></li>');?>
						<?php echo autocheck('Home/Conference/index','<li><a href="/hg/index.php?s=/Home/Conference/index" target="navtab" rel="Conferenceindex">会议计划及预算</a></li>');?>
						<?php echo autocheck('Home/Train/index','<li><a href="/hg/index.php?s=/Home/Train/index" target="navtab" rel="Trainindex">教育培训计划及预算</a></li>');?>
						<?php echo autocheck('Home/Spebudget/index','<li><a href="/hg/index.php?s=/Home/Spebudget/index" target="navtab" rel="Spebudgetindex">专项预算</a></li>');?>
						<?php echo autocheck('Home/Catbudget/index','<li><a href="/hg/index.php?s=/Home/Catbudget/index" target="navtab" rel="Catbudgetindex">包干项目预算</a></li>');?>
						<?php echo autocheck('Home/Catbudget/report','<li><a href="/hg/index.php?s=/Home/Catbudget/report" target="navtab" rel="Catbudgetindex">包干项目预算汇总</a></li>');?>
						</ul>
						</li>
						<li><a>全局基础数据(管理员)</a>
						<ul id="null4">
						<?php echo autocheck('Home/Unit/index','<li><a href="/hg/index.php?s=/Home/Unit/index" target="navtab" rel="Unitindex">单位管理</a></li>');?>
						<?php echo autocheck('Home/Section/index','<li><a href="/hg/index.php?s=/Home/Section/index" target="navtab" rel="Sectionindex">部门管理</a></li>');?>
						<?php echo autocheck('Home/Role/index','<li><a href="/hg/index.php?s=/Home/Role/index" target="navtab" rel="Roleindex">角色管理</a></li>');?>
						<?php echo autocheck('Home/Staff/index','<li><a href="/hg/index.php?s=/Home/Staff/index" target="navtab" rel="Staffindex">员工管理</a></li>');?>
						<?php echo autocheck('Home/Placard/add','<li><a href="/hg/index.php?s=/Home/Placard/add" target="navtab" rel="Placardadd">发布公告</a></li>');?>
						<?php echo autocheck('Home/Placard/index','<li><a href="/hg/index.php?s=/Home/Placard/index" target="navtab" rel="Placardindex">公告列表</a></li>');?>
						<?php echo autocheck('Home/Term/index','<li><a href="/hg/index.php?s=/Home/Term/index" target="navtab" rel="Termindex">账期结转</a></li>');?>
						<?php echo autocheck('Home/Category/index','<li><a href="/hg/index.php?s=/Home/Category/index" target="navtab" rel="Categoryindex">包干项目</a></li>');?>
						<?php echo autocheck('Home/Special/index','<li><a href="/hg/index.php?s=/Home/Special/index" target="navtab" rel="Specialindex">专项项目</a></li>');?>
						</ul>
						</li>
						<li><a>数据库备份</a>
						<ul id="null5">
						<?php echo autocheck('Home/Database/index','<li><a href="/hg/index.php?s=/Home/Database/index/type/export" target="navtab" rel="Databaseindex">数据备份</a></li>');?>
						<?php echo autocheck('Home/Database/index','<li><a href="/hg/index.php?s=/Home/Database/index/type/import" target="navtab" rel="Databaseindex">备份查看</a></li>');?>
						</ul>
						</li>
					</ul>
					</div>
				</div>
			</div>
		</div>
				<div id="container">
					<div id="navTab" class="tabsPage">
						<div class="tabsPageHeader">
							<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
								<ul class="navTab-tab">
									<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
								</ul>
							</div>
							<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
							<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
							<div class="tabsMore">more</div>
						</div>
						<ul class="tabsMoreList">
							<li><a href="javascript:;">我的主页</a></li>
						</ul>
						<div class="navTab-panel tabsPageContent layoutBox">
							<div class="page unitBox">
								<div class="accountInfo">
									<p><span>成都海关财务预算系统</span></p>
									<p>当前时间：<a href="#" target=""><?php echo (date('Y-m-d g:i a',time())); ?></a></p>
								</div>
								<table class="table" width="100%" layoutH="56">
									<thead>
										<tr>
											<th width="80">发布时间</th>
											<th>公告</th>
											<th width="100">操作</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>&nbsp</td>
											<td><a href="/hg/Public/doc/shouche.doc"><b>点击这里下载使用手册</b></a></td>
											<td>&nbsp</td>
										</tr>
										<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
											<td><?php echo (date("Y-m-d",$vo["timestamp"])); ?></td>
											<td><span style="<?php if(($vo["highlight"]) == "1"): ?>color:red;<?php endif; if(($vo["bold"]) == "1"): ?>font-weight:bold;<?php endif; ?>"><?php echo ($vo["title"]); ?></span></td>
											<td><a href="/hg/index.php?s=/Home/Placard/detail/id/<?php echo ($vo["id"]); ?>" target="navtab" rel="Placarddetail"><span><b>[查看详情]</b></span></a></td>
										</tr><?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
							
						</div>
					</div>
				</div>

			</div>

	<div id="footer">Copyright &copy; 2014 成都海关</div>


</body>
</html>