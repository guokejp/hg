<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Section/insert/navTabId/Sectionindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<input type="hidden" name="unitid" value="<?php echo ($_GET['unitid']); ?>">
			<dl>
				<dt>部门名称</dt>
				<dd><input autocomplete="off" name="name" class="required" style="width:100%" type="text" /></dd>
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