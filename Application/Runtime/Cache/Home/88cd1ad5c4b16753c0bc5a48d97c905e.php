<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Placard/insert/navTabId/Placardindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<dl class="nowrap">
				<dt>标题：</dt>
				<dd><input autocomplete="off" name="title" class="required" style="width:80%"type="text" /><span><input type="checkbox" value="1" name="highlight">[高亮]</span><span><input value="1" name="bold" type="checkbox">[加粗]</span></dd>
			</dl>
			<div class="divider"></div>
			<dl class="nowrap">
				<dt>正文：</dt>
				<dd><textarea name="content" class="editor" style="width:100%;height:300px;" ></textarea></dd>
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