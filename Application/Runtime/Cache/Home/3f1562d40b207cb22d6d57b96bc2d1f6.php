<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Unit/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/hg/index.php?s=/Home/Unit/add" target="dialog" rel="Unitadd"><span>添加单位</span></a></li>
			<li><a class="delete" href="/hg/index.php?s=/Home/Unit/delete/id/{item_id}/navTabId/Unitindex" target="ajaxTodo" title="确定要删除吗?"><span>删除单位</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Unit/edit/id/{item_id}" target="dialog" rel="Unitedit"><span>修改单位名称</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="77">
		<thead>
			<tr>
				<th width="80">ID</th>
				<th>单位名称</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
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