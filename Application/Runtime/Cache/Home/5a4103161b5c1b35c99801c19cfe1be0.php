<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Catbudget/allow/navTabId/Applybudaudit/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
			<dl>
				<dt>项目：</dt>
				<dd><input style="width:100%" type="text" size="30" value="<?php echo ($data["categoryname"]); ?>" readonly /></dd>
			</dl>
			<dl>
				<dt>部门：</dt>
				<dd><input style="width:100%" type="text" size="30" value="<?php echo ($data["sectionname"]); ?>" readonly /></dd>
			</dl>
			<dl>
				<dt>当期余额：</dt>
				<dd><input style="width:100%" class="number" type="text" size="30" value="<?php echo ($data["money"]); ?>" readonly /></dd>
			</dl>
			<table width="100%" class="list">
				<thead>
					<tr>
						<th width="80">时间</th>
						<th width="100">操作人</th>
						<th>操作</th>
						<th width="100">报销单号</th>
						<th width="100">金额</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
						<td><?php echo (date("Y-m-d",$vo["timestamp"])); ?></td>
						<td><?php echo ($vo["staffname"]); ?></td>
						<td><?php echo (showcatlog($vo["type"])); ?></td>
						<td><?php echo ($vo["orderid"]); ?></td>
						<td><?php echo (showcatlogtype($vo["type"])); echo ($vo["money"]); ?></td>
					</tr><?php endforeach; endif; ?>
				</tbody>
			</table>
			<div class="divider">divider</div>
		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>