<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Zhixingadmin/budgetggoverlook">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="edit" href="/hg/index.php?s=/Home/Zhixingadmin/budgetedit/id/{item_id}" target="navTab" rel="Placardedit"><span>修改</span></a></li>
		</ul>
	</div>
	<table class="list" width="100%" layoutH="56">
		<thead>
			<tr>
				<th width="30">ID</th>
				<th width="50">年份</th>
				<th width="50">单位</th>
				<th width="50">填报时间</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
			<tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["year"]); ?></td>
				<td><?php echo session(C('ADMIN_AUTH_UNITNAME'));?></td>
				<td><?php echo (date("Y-m-d",$vo["time"])); ?></td>
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