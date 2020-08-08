<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Bill/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/hg/index.php?s=/Home/Bill/add" target="dialog" rel="Billadd" width="640" height="480"><span>新建报销单</span></a></li>
<!-- 			<li><a class="delete" href="/hg/index.php?s=/Home/Bill/delete/id/{item_id}/navTabId/Unitindex" target="ajaxTodo" title="确定要删除吗?"><span>删除单位</span></a></li> -->
			<li><a class="edit" href="/hg/index.php?s=/Home/Bill/edit/id/{item_id}" target="dialog" rel="Billedit" width="550" height="420"><span>修改报销单</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="77">
		<thead>
			<tr>
				<th width="60">ID</th>
				<th width="180">报销单号</th>
				<th width="80">费用类型</th>
				<th >项目名称</th>
				<th width="80">录入人</th>
				<th width="80">申请人</th>
				<th width="100">申请金额</th>
				<th width="80">审核状态</th>
				<th width="80">审核人</th>
				<th width="100">核批金额</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["orderid"]); ?></td>
				<td><?php echo (showbilltype($vo["type"])); ?></td>
				<td>
					<?php switch($vo["type"]): case "0": echo ($vo["categoryname"]); break;?>
						<?php case "1": echo ($vo["conferencename"]); break;?>
						<?php case "2": echo ($vo["trainname"]); break;?>
						<?php case "3": echo ($vo["specialname"]); break;?>
						<?php case "4": echo ($vo["oncebudgetname"]); break;?>
						<?php case "5": echo ($vo["contractname"]); break; endswitch;?>
				</td>
				<td><?php echo ($vo["instaffname"]); ?></td>
				<td><?php echo ($vo["staffname"]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
				<td>
					<?php if($vo["status"] == 0): ?><span style="color:grey;"><b>等待审核</b></span>
					<?php elseif($vo["status"] == 1): ?><span style="color:green;"><b>审核通过</b></span>
					<?php else: ?><span style="color:red;"><b>审核拒绝</b></span><?php endif; ?>
				</td>
				<td><?php echo ($vo["chestaffname"]); ?></td>
				<td><?php if(($vo["status"]) != "0"): echo ($vo["confirm"]); endif; ?></td>
				<td>
				<?php if(($vo["status"]) == "0"): ?><!-- <a href="/hg/index.php?s=/Home/Bill/edit/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Billadd" width="640" height="480"><span><b>[修改]</b></span></a> -->
					<a href="/hg/index.php?s=/Home/Bill/delete/id/<?php echo ($vo["id"]); ?>/navTabId/Billindex" target="ajaxTodo" title="确定要删除吗?"><span><b>[删除]</b></span></a>
				<?php else: ?>
				<a href="/hg/index.php?s=/Home/Bill/view/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Billview" width="640" height="480"><span><b>[查看详情]</b></span></a><?php endif; ?>
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