<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Income/insert/navTabId/Catbudgetindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<fieldset>
			<legend>请选择预算类型</legend>
			<?php if(is_array($categorylist)): foreach($categorylist as $key=>$vo): ?><a href="/hg/index.php?s=/Home/Income/add/categoryid/<?php echo ($vo["id"]); ?>/" target="dialog" rel="Incomeadd"><span><b>[<?php echo ($vo["name"]); ?>]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>
		</fieldset>
		</div>
		<div class="formBar">
			<ul>
			</ul>
		</div>
	</form>
</div>