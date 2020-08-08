<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Contract/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="/hg/index.php?s=/Home/Contract/index" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					是否专项:
				</td>
				<td>
					<select class="combox" name="isother">
						<option value="aa">请选择</option>
						<option value="0" <?php if(($_POST['isother']) == "0"): ?>selected="selected"<?php endif; ?>>专项</option>
						<option value="1" <?php if(($_POST['isother']) == "1"): ?>selected="selected"<?php endif; ?>>其它</option>
					</select>
				</td>
				<td>
					合同名称:<input type="text" name="name" value="<?php echo ($_POST['name']); ?>"/>
				</td>
				<td>
					开始日期：<input type="text" name="starttime" class="date" value="<?php echo ($_POST['starttime']); ?>" readonly="true" />
				</td>
				<td>
					结束日期：<input type="text" name="endtime" class="date" value="<?php echo ($_POST['endtime']); ?>" readonly="true" />
				</td>
				<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/hg/index.php?s=/Home/Contract/add" height="500" rel="Contractadd" target="navtab"><span>添加计划</span></a></li>
			<li><a class="delete" href="/hg/index.php?s=/Home/Contract/delete/id/{item_id}/navTabId/Contractindex" target="ajaxTodo" title="确定要删除吗?"><span>删除计划</span></a></li>
<!-- 			<li><a class="edit" href="/hg/index.php?s=/Home/Contract/edit/id/{item_id}" rel="Contractedit" target="navtab"><span>修改计划</span></a></li> -->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="80">ID</th>
				<th width="120">专项 / 其它计划名称</th>
				<th>合同名称</th>
				<th width="100">部门</th>
				<th width="100">申请人</th>
				<th width="100">工程金额</th>
				<th width="100">货物金额</th>
				<th width="100">服务金额</th>
				<th width="100">添加时间</th>
				<th width="80">状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["specialname"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["sectionname"]); ?></td>
				<td><?php echo ($vo["staffname"]); ?></td>
				<td><?php if(($vo["project"]) == "1"): echo ($vo["projectmoney"]); endif; ?></td>
				<td><?php if(($vo["goods"]) == "1"): echo ($vo["goodsmoney"]); endif; ?></td>
				<td><?php if(($vo["service"]) == "1"): echo ($vo["servicemoney"]); endif; ?></td>
				<td><?php echo (date("Y-m-d",$vo["timestamp"])); ?></td>
				<td><?php if(($vo["status"]) == "0"): ?><span style="color:red;"><b>未执行</b></span><?php else: ?><span style="color:green;"><b>已执行</b></span><?php endif; ?></td>
				<td><?php if(($vo["status"]) == "0"): ?><a href="/hg/index.php?s=/Home/Contract/execution/id/<?php echo ($vo["id"]); ?>/isother/<?php echo ($vo["isother"]); ?>" target="dialog" height="600" width="1024" rel="Contractexecution"><span><b>[执行]</b></span></a><?php else: ?><a href="/hg/index.php?s=/Home/Contract/detail/id/<?php echo ($vo["id"]); ?>/isother/<?php echo ($vo["isother"]); ?>" target="dialog" height="600" width="1024" rel="Contractdetail"><span><b>[详情]</b></span></a><?php endif; ?></td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
		<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option <?php if(($numPerPage) == "10"): ?>selected="selected"<?php endif; ?> value="10">10</option>
				<option <?php if(($numPerPage) == "20"): ?>selected="selected"<?php endif; ?> value="20">20</option>
				<option <?php if(($numPerPage) == "50"): ?>selected="selected"<?php endif; ?> value="50">50</option>
				<option <?php if(($numPerPage) == "100"): ?>selected="selected"<?php endif; ?> value="100">100</option>
			</select>
			<span>条，共<?php echo ($totalCount); ?>条</span>
		</div>
		
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>

	</div>
</div>