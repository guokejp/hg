<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Staff/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div>
	<div layoutH="0" style="float:left; display:block; overflow:auto; width:20%; border:solid 1px #CCC; line-height:21px">
	    <ul class="tree treeFolder">
			<li><a href="#">成都海关</a>
				<ul>
					<?php if(is_array($unitlist)): foreach($unitlist as $key=>$vo): ?><li><a href="/hg/index.php?s=/Home/Staff/index/unitid/<?php echo ($vo["id"]); ?>"  target="navtab" rel="Staffindex"><?php if(($vo["id"]) == $_REQUEST['unitid']): ?><b><?php echo ($vo["name"]); ?></b><?php else: echo ($vo["name"]); endif; ?></a></li><?php endforeach; endif; ?>
				</ul>
			</li>
	     </ul>
	</div>
</div>
<div class="pageHeader">
	<form rel="pagerForm" action="/hg/index.php?s=/Home/Staff/index" onsubmit="return navTabSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="unitid" value="<?php echo ($_REQUEST['unitid']); ?>">
	<div class="searchBar">
		<table class="searchContent">
			<tr>
			<?php if(empty($_REQUEST['unitid'])): else: ?>
				<td>
					姓名:<input type="text" name="name" value="<?php echo ($_POST['name']); ?>"/>
				</td>
				<td>
					<select class="combox" name="sectionid">
						<option value="">所有部门</option>
						<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['sectionid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
				</td><?php endif; ?>
			<td></td>
			</tr>
		</table>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<?php if(empty($_REQUEST['unitid'])): else: ?>
			<li><a class="add" href="/hg/index.php?s=/Home/Staff/add/unitid/<?php echo ($_REQUEST['unitid']); ?>" height="400" target="dialog" rel="Staffadd"><span>添加员工</span></a></li>
			<li><a class="delete" href="/hg/index.php?s=/Home/Staff/delete/id/{item_id}/navTabId/Staffindex" target="ajaxTodo" title="确定要删除吗?"><span>删除员工</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Staff/edit/id/{item_id}" height="400" target="dialog" rel="Staffedit"><span>修改员工</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Staff/editpass/id/{item_id}" target="dialog"><span>重置密码</span></a></li><?php endif; ?>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="114">
		<thead>
			<tr>
				<th width="80">ID</th>
				<th width="200">姓名</th>
				<th width="100">工号</th>
				<th width="100">等级</th>
				<th width="100">部门</th>
				<th width="100">单位</th>
				<th>角色</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["number"]); ?></td>
				<td><?php if(($vo["level"]) == "1"): ?>处以下<?php else: ?>处级以上<?php endif; ?></td>
				<td><?php echo ($vo["sectionname"]); ?></td>
				<td><?php echo ($vo["unitname"]); ?></td>
				<td><?php echo ($vo["rolename"]); ?></td>
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