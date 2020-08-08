<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Bill/update/navTabId/Billindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
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
						<?php case "4": echo ($data["oncebudgetname"]); break;?>
						<?php case "5": echo ($vo["contractname"]); break; endswitch;?>
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
				<input type="text" value="<?php echo ($data["staffname"]); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<?php if(($data["once"]) == "0"): ?><dl>
			<dt>申请事项</dt>
			<dd>
				<input type="text"  style="width:100%" readonly="readonly" class="required" value="<?php echo ($data["name"]); ?>">
			</dd>
		</dl><?php endif; ?>
		<dl>
			<dt>预算金额：</dt>
			<dd>
				<input type="text" readonly="readonly" class="required number" value="<?php echo ($data["money"]); ?>" />
			</dd>
		</dl>
		<dl style="height:36px;">
			<dt>申请事由：</dt>
			<dd>
				<textarea class="required" readonly="readonly" style="width:100%;"><?php echo ($data["remark"]); ?></textarea>
			</dd>
		</dl>
		<div class="divider"></div>
		<dl>
			<dt>申请状态：</dt>
			<dd>
				<?php if($data["status"] == 0): ?><span style="color:grey;"><b>等待审核</b></span>
				<?php elseif($data["status"] == 1): ?><span style="color:green;"><b>审核通过</b></span>
				<?php else: ?><span style="color:red;"><b>审核拒绝</b></span><?php endif; ?>
			</dd>
		</dl>
		<?php if(($data["status"]) == "1"): ?><dl>
			<dt>核批金额：</dt>
			<dd>
				<input type="text" readonly="readonly" class="required number" value="<?php echo ($data["confirm"]); ?>" />
			</dd>
		</dl><?php endif; ?>
		<dl>
			<dt>审批意见：</dt>
			<dd>
				<textarea class="required" readonly="readonly" style="width:100%;"><?php echo ($data["cremark"]); ?></textarea>
			</dd>
		</dl>
		</div>
		<div class="formBar">
			<ul>
			</ul>
		</div>
	</form>
</div>