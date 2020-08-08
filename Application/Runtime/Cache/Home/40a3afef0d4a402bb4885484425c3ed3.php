<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Bill/insert/navTabId/Billindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<fieldset>
			<legend>非政府采购类报销</legend>
			<?php if(is_array($categorylist)): foreach($categorylist as $key=>$vo): ?><a href="/hg/index.php?s=/Home/Bill/add/categoryid/<?php echo ($vo["id"]); ?>" target="dialog" rel="Billadd"><span><b>[<?php echo ($vo["name"]); ?>]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>
			<br><br><br>
				<a href="/hg/index.php?s=/Home/Bill/add/categoryid/conference" target="dialog" rel="Billadd"><span><b>[会议费]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/hg/index.php?s=/Home/Bill/add/categoryid/train" target="dialog" rel="Billadd"><span><b>[培训费]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/hg/index.php?s=/Home/Bill/add/categoryid/special" target="dialog" rel="Billadd"><span><b>[专项]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- 				<a href="/hg/index.php?s=/Home/Bill/add/categoryid/contract" target="dialog" rel="Billadd"><span><b>[政府预算]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
		</fieldset><br><br><br><br>
		<fieldset>
			<legend>政府采购类报销</legend>
				<a href="/hg/index.php?s=/Home/Bill/add/categoryid/contract/isother/0" target="dialog" rel="Billadd"><span><b>[专项]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/hg/index.php?s=/Home/Bill/add/categoryid/contract/isother/1" target="dialog" rel="Billadd"><span><b>[其它]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- 				<a href="/hg/index.php?s=/Home/Bill/add/categoryid/contract" target="dialog" rel="Billadd"><span><b>[政府预算]</b></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
		</fieldset>
		</div>
		<div class="formBar">
			<ul>
			</ul>
		</div>
	</form>
</div>