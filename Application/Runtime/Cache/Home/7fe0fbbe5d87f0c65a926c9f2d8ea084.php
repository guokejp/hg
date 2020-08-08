<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Income/audit">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" action="/hg/index.php?s=/Home/Income/audit" onsubmit="return navTabSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>费用类型：</td>
				<td>
					<select class="combox" name="categoryid">
						<option value="">所有项目</option>
						<?php if(is_array($categorylist)): foreach($categorylist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['categoryid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
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
	<table class="table" width="100%" layoutH="87">
		<thead>
			<tr>
				<th width="60">ID</th>
				<th width="180">预算单号</th>
				<th width="80">项目类型</th>
				<th width="100">部门</th>
				<th >项目名称</th>
				<th width="80">申请人</th>
				<th width="100">申请金额</th>
				<th width="80">审核状态</th>
				<th width="100">核批金额</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["orderid"]); ?></td>
				<td><?php echo ($vo["categoryname"]); ?></td>
				<td><?php echo ($vo["sectionname"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["staffname"]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
				<td>
					<?php if($vo["status"] == 0): ?><span style="color:grey;"><b>等待审核</b>
					<?php elseif($vo["status"] == 1): ?><span style="color:green;"><b>审核通过</b></span>
					<?php elseif($vo["status"] == 2): ?><span style="color:red;"><b>审核拒绝</b></span><?php endif; ?>
				</td>
				<td>
					<?php if(($vo["status"]) != "0"): echo ($vo["confirm"]); endif; ?>
				</td>
				<td>
					<a href="/hg/index.php?s=/Home/Income/view/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Incomeview" width="640" height="480"><span><b>[详情]</b></span></a>
					<?php if(($vo["status"]) == "0"): ?><a href="/hg/index.php?s=/Home/Income/check/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Incomecheck" width="640" height="480"><span><b>[审核]</b></span></a><?php endif; ?>
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