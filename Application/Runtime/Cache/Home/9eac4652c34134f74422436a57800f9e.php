<?php if (!defined('THINK_PATH')) exit();?>
<div>
	<div layoutH="0" style="float:left; display:block; overflow:auto; width:20%; border:solid 1px #CCC; line-height:21px;">
	    <ul class="tree treeFolder">
			<li><a href="#">成都海关</a>
				<ul>
					<?php if(is_array($unitlist)): foreach($unitlist as $key=>$vo): ?><li><a href="/hg/index.php?s=/Home/Section/index/unitid/<?php echo ($vo["id"]); ?>"  target="navtab" rel="Sectionindex"><?php if(($vo["id"]) == $_GET['unitid']): ?><b><?php echo ($vo["name"]); ?></b><?php else: echo ($vo["name"]); endif; ?></a></li><?php endforeach; endif; ?>
				</ul>
			</li>
	     </ul>
	</div>
</div>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<?php if(empty($_GET['unitid'])): else: ?>
			<li><a class="add" href="/hg/index.php?s=/Home/Section/add/unitid/<?php echo ($_GET['unitid']); ?>" target="dialog" rel="Sectionadd"><span>添加部门</span></a></li>
			<li><a class="delete" href="/hg/index.php?s=/Home/Section/delete/id/{item_id}/navTabId/Sectionindex" target="ajaxTodo" title="确定要删除吗?"><span>删除部门</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Section/edit/id/{item_id}" target="dialog" rel="Sectionedit"><span>修改部门名称</span></a></li><?php endif; ?>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="77">
		<thead>
			<tr>
				<th>部门名称</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["name"]); ?></td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
</div>