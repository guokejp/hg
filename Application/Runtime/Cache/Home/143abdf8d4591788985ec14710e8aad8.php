<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Spebudget/update/navTabId/Spebudgetindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
			<input type="hidden" name="moneyfirstall" value="<?php echo ($data["firstallmoney"]); ?>">
			<input type="hidden" name="moneytotal" value="<?php echo ($data["total"]); ?>">
			<input type="hidden" name="moneymoney" value="<?php echo ($data["money"]); ?>">

			<?php if(($data["firstallmoney"]) == $data["total"]): ?><dl>
				<dt>专项管理部门：</dt>
				<dd>
				<select name="sectionid" class="required combox">
					<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option <?php if(($vo["id"]) == $data["sectionid"]): ?>selected="selected"<?php endif; ?> value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				</select>
				</dd>
			</dl><?php endif; ?>
			
			<?php if(($data["firstallmoney"]) == $data["total"]): endif; ?>
			<dl>
				<dt>初始定额</dt>
				<dd>
					<input autocomplete="off" name="firstallmoney" class="required number" value="<?php echo ($data["firstallmoney"]); ?>" type="text" />
				</dd>
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