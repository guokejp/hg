<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Conference/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" action="/hg/index.php?s=/Home/Conference/index" onsubmit="return navTabSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					会议名称：<input autocomplete="off" type="text" name="name" value="<?php echo ($_POST['name']); ?>"/>
				</td>
				<td>部门：</td>
				<td>
					<select class="combox" name="sectionid">
						<option value="">所有部门</option>
						<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['sectionid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td>财务账期：</td>
				<td>
					<select class="combox" name="termid">
						<?php if(is_array($termlist)): foreach($termlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(empty($_POST['termid'])): if(($vo["id"]) == $_SESSION['c143a55a53523bd3d3b85d5ab0bd92c4']): ?>selected="selected"<?php endif; else: if(($vo["id"]) == $_POST['termid']): ?>selected="selected"<?php endif; endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
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
			<li><a class="add" href="/hg/index.php?s=/Home/Conference/add/pid/0" target="dialog" height="500" rel="Conferenceadd"><span>录入计划</span></a></li>
			<li><a class="delete" href="/hg/index.php?s=/Home/Conference/delete/id/{item_id}/navTabId/Conferenceindex" target="ajaxTodo" title="确定要删除吗?"><span>删除计划</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Conference/edit/id/{item_id}" target="dialog" height="500" rel="Conferenceedit"><span>修改计划</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="114">
		<thead>
			<tr>
				<th width="40">序号</th>
				<th>会议名称</th>
				<th width="60">会议类别</th>
				<th width="60">参会人数</th>
				<th width="60">会议时间</th>
				<th width="60">会议时长</th>
				<th width="60">人均预算</th>
				<th width="60">基础预算</th>
				<th width="80">合计金额</th>
				<th width="80">状态</th>
				<th width="80">核批金额</th>
				<th width="100">主办部门</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo (showconferencetype($vo["type"])); ?></td>
				<td><?php echo ($vo["number"]); ?></td>
				<td><?php echo (showconferencemonth($vo["month"])); ?></td>
				<td><?php echo ($vo["duration"]); ?></td>
				<td><?php echo ($vo["average"]); ?></td>
				<td><?php echo ($vo["basemoney"]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
				<td><?php echo (showconferencestatus($vo["status"])); ?></td>
				<td><?php if(($vo["status"]) == "2"): echo ($vo["confirm"]); endif; ?></td>
				<td><?php echo ($vo["sectionname"]); ?></td>
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