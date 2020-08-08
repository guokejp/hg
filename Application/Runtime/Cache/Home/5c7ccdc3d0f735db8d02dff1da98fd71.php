<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Catbudget/getcheck">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" action="/hg/index.php?s=/Home/Catbudget/getcheck" onsubmit="return dialogSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="spebudid" value="<?php echo ($spebudid); ?>">
	<!-- <div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>采购报销：</td>
				<td>
					<select class="combox" name="type">
						<option value="">请选择</option>
						<option value="1" <?php if(($_POST['type']) == "1"): ?>selected="selected"<?php endif; ?>>一般专项</option>
						<option value="2" <?php if(($_POST['type']) == "2"): ?>selected="selected"<?php endif; ?>>采购报销</option>
					</select>
				</td>
				<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
				</td>
			</tr>
		</table>
	</div> -->
	</form>
</div>
<div class="pageContent">
	<table class="table" width="100%" layoutH="35">
		<thead>
			<tr>
				<th width="30">ID</th>
				<th width="120">报销单号</th>
				<th width="80">报销部门</th>
				<th width="80">报销人</th>
				<th>内容摘要</th>
				<th width="90">报销日期</th>
				<th width="80">报销金额</th>
				<th width="80">审核金额</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["orderid"]); ?></td>
				<td><?php echo ($vo["sectionname"]); ?></td>
				<td><?php echo ($vo["staffname"]); ?></td>
				<td><?php echo ($vo["remark"]); ?></td>
				<td><?php echo date("Y-m-d ", $vo['timestamp']);?></td>
				<td><?php echo ($vo["money"]); ?></td>
				<td>
					<?php if($vo['status'] == 0): ?><a href="/hg/index.php?s=/Home/Bill/check/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Billcheck" width="640" height="480"><span><b>[点击审核]</b></span></a>
					<?php elseif($vo['status'] == 1): echo ($vo["confirm"]); ?>
					<?php elseif($vo['status'] == 2): ?>审核拒绝<?php endif; ?>
				</td>
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