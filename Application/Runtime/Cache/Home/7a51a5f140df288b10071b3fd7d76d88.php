<?php if (!defined('THINK_PATH')) exit();?><script style="text/javascript">
	$(function(){
		$('.tabsPageContent').mousemove(function(){
			$('.lib').find('b').parents('.plib').find('a:eq(0)').trigger("click");
		});
	});
</script>
<form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Catbudget/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div>
	<div layoutH="0" style="float:left; display:block; overflow:auto; width:20%; border:solid 1px #CCC; line-height:21px;">
	    <ul class="tree treeFolder collapse">
	    	<?php if(is_array($categorylist)): foreach($categorylist as $key=>$vo): ?><li class="plib"><a <?php if(($vo['child']) == ""): ?>href="/hg/index.php?s=/Home/Catbudget/index/categoryid/<?php echo ($vo["id"]); ?>/once/<?php echo ($vo["once"]); ?>" target="navtab" rel="Catbudgetindex"<?php endif; ?> ><?php echo ($vo["name"]); ?></a>
					<?php if(($vo['child']) != ""): ?><ul>
							<?php if(is_array($vo['child'])): foreach($vo['child'] as $key=>$vo): ?><li class="lib"><a href="/hg/index.php?s=/Home/Catbudget/index/categoryid/<?php echo ($vo["id"]); ?>/once/<?php echo ($vo["once"]); ?>" target="navtab" rel="Catbudgetindex"><?php if(($vo["id"]) == $_GET['categoryid']): ?><b><?php echo ($vo["name"]); ?></b><?php else: echo ($vo["name"]); endif; ?></a></li><?php endforeach; endif; ?>
						</ul><?php endif; ?>
				</li><?php endforeach; endif; ?>
	     </ul>
	</div>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<?php if(empty($_GET['categoryid'])): else: ?>
			<li><a class="add" href="/hg/index.php?s=/Home/Catbudget/add/categoryid/<?php echo ($_GET['categoryid']); ?>" target="dialog" rel="Catbudgetadd"><span>初始化预算</span></a></li>
			<li><a class="delete" href="/hg/index.php?s=/Home/Catbudget/delete/id/{item_id}/navTabId/Catbudgetindex" target="ajaxTodo" title="确定要删除吗?"><span>删除预算</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Catbudget/edit/id/{item_id}" target="dialog" rel="Catbudgetedit"><span>调整预算</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Catbudget/view/id/{item_id}" target="dialog" rel="Catbudgetview" width="850" height="550"><span>查看明细</span></a></li><?php endif; ?>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="77">
		<thead>
			<tr>
				<th>部门名称</th>
				<th width="100">当期余额</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["sectionname"]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
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