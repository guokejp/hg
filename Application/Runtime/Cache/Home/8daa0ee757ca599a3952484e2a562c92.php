<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Catbudget/insert/navTabId/Catbudgetindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
				<dl>
					<dt>部门</dt>
					<dd>预算金额</dd>
				</dl>
			<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><input type="hidden" name="termid[<?php echo ($key); ?>]" value="<?php echo session(C('TERM_ID'));?>">
				<input type="hidden" name="unitid[<?php echo ($key); ?>]" value="<?php echo session(C('ADMIN_AUTH_UNITID'));?>">
				<input type="hidden" name="sectionid[<?php echo ($key); ?>]" value="<?php echo ($vo["id"]); ?>">
				<input type="hidden" name="staffid[<?php echo ($key); ?>]" value="<?php echo session(C('ADMIN_AUTH_ID'));?>">
				<input type="hidden" name="categoryid[<?php echo ($key); ?>]" value="<?php echo ($_GET['categoryid']); ?>">
				<dl>
					<dt><?php echo ($vo["name"]); ?></dt>
					<dd><input autocomplete="off" name="money[<?php echo ($key); ?>]" class="number" style="width:50%" type="text" /></dd>
				</dl><?php endforeach; endif; ?>
			<dl>
				<dt>提示：</dt>
				<dd>此处仅显示无该项预算的部门，已经有该项预算的部门请使用预算调整功能</dd>
			</dl>
		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>