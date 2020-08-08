<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Specialother/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/hg/index.php?s=/Home/Specialother/add" target="dialog" rel="Incomeadd" width="640" height="480"><span>采购申请</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="77">
		<thead>
			<tr>
				<th width="60">ID</th>
				<th width="180">采购名称</th>
				<th width="80">申请年份</th>
				<th width="80">申请金额</th>
				<th width="80">申请人</th>
				<th width="80">审核状态</th>
				<th width="100">核批金额</th>
				<th width="100">是否使用</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["year"]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
				<td><?php echo ($vo["staffname"]); ?></td>
				<td>
					<?php if(($vo["confirm"]) == "0"): ?><span style="color:red;"><b>等待审核</b></span><?php else: ?><span style="color:green;"><b>审核通过</b></span><?php endif; ?>
				</td>
				<td>
					<?php if(($vo["confirm"]) == "1"): echo ($vo["confirmmoney"]); endif; ?>
				</td>
				<td>
					<?php if(($vo["used"]) == "0"): ?><span style="color:red;"><b>未使用</b></span><?php else: ?><span style="color:green;"><b>已使用</b></span><?php endif; ?>
				</td>
				<td>
				<?php if(($vo["confirm"]) == "0"): ?><a href="/hg/index.php?s=/Home/Specialother/edit/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Specialotherinex" width="640" height="320"><span><b>[修改]</b></span></a>
					<a href="/hg/index.php?s=/Home/Specialother/delete/id/<?php echo ($vo["id"]); ?>/navTabId/Specialotherindex" target="ajaxTodo" title="确定要删除吗?"><span><b>[删除]</b></span></a>
				<?php else: ?>
				<a href="/hg/index.php?s=/Home/Specialother/view/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Incomeview" width="640" height="480"><span><b>[查看详情]</b></span></a><?php endif; ?>
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