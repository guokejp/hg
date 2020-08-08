<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Special/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/hg/index.php?s=/Home/Special/add/pid/0" target="dialog" rel="Specialadd"><span>添加顶级类目</span></a></li>
			<li><a class="delete" href="/hg/index.php?s=/Home/Special/delete/id/{item_id}/navTabId/Specialindex" target="ajaxTodo" title="确定要删除吗?"><span>删除类目</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Special/edit/id/{item_id}" target="dialog" rel="Specialedit"><span>修改类目名称</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="50">
		<thead>
			<tr>
				<th width="80">ID</th>
				<th>类目名称</th>
				<!-- <th width="80">报销单前缀</th> -->
				<th width="100">政府预算</th>
				<th width="100">年份</th>
				<th width="150">添加下级类目</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["html"]); echo ($vo["name"]); ?></td>
				<!-- <td><?php echo ($vo["bx_ord"]); ?></td> -->
				<td><?php if(($vo["gov"]) == "1"): ?><b>政府预算</b><?php else: endif; ?></td>
				<td><?php echo ($vo["year"]); ?></td>
				<td>
					<?php if(($vo["pid"]) == "0"): ?><a href="/hg/index.php?s=/Home/Special/add/pid/<?php echo ($vo["id"]); ?>" target="dialog" rel="Specialadd" height="500"><span>添加下级类目</span></a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
</div>