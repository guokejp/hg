<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Bill/update/navTabId/Billindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
		<input type="hidden" name="oldmoney" value="<?php echo ($data["money"]); ?>" class="required number" />
		<dl>
			<dt>报销单号：</dt>
			<dd>
				<input type="text"  value="<?php echo ($data["orderid"]); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>费用类型</dt>
			<dd><input type="text"  value="<?php echo (showbilltype($data["type"])); ?>" readonly="readonly" class="required" /></dd>
		</dl>
		<dl>
			<dt>项目名称：</dt>
			<dd>
				<input type="text"  value="<?php switch($data["type"]): case "0": echo ($data["categoryname"]); break;?>
						<?php case "1": echo ($data["conferencename"]); break;?>
						<?php case "2": echo ($data["trainname"]); break;?>
						<?php case "3": echo ($data["specialname"]); break;?>
						<?php case "4": echo ($data["oncebudgetname"]); break; endswitch;?>
				" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>部门：</dt>
			<dd>
				<input type="text" value="<?php echo ($data["sectionname"]); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>申请人：</dt>
			<dd>
				<input type="text" value="<?php echo session(C('ADMIN_AUTH_NAME'));?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>报销金额：</dt>
			<dd>
				<input type="text" autocomplete="off" name="money" value="<?php echo ($data["money"]); ?>" class="required number" />
			</dd>
		</dl>
		<dl>
			<dt>申请事由：</dt>
			<dd>
				<textarea name="remark" class="required" style="width:100%;"><?php echo ($data["remark"]); ?></textarea>
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