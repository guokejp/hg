<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Income/insert/navTabId/Incomeindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="termid" value="<?php echo session(C('TERM_ID'));?>" />
		<input type="hidden" name="sectionid" value="<?php echo session(C('ADMIN_AUTH_SECTIONID'));?>" />
		<input type="hidden" name="staffid" value="<?php echo session(C('ADMIN_AUTH_ID'));?>" />
		<input type="hidden" name="unitid" value="<?php echo session(C(ADMIN_AUTH_UNITID));?>">
		
		<input type="hidden" name="once" value="<?php echo ($data["once"]); ?>">
		<dl>
			<dt>预算单号：</dt>
			<dd>
				<input type="text"  name="orderid" value="<?php echo ($orderid); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>

		<?php if($data["have_child"] == 0): ?><dl>
				<dt>费用类型：</dt>
				<dd>
					<input type="hidden" name="categoryid" value="<?php echo ($data["child"]["id"]); ?>">
					<input type="text" value="<?php echo ($data["child"]["name"]); ?>" readonly="readonly" class="required" />
				</dd>
			</dl>
		<?php elseif($data["have_child"] == 1): ?>
			<dl>
				<dt>费用类型：</dt>
				<dd>
					<select class="combox required" name="categoryid">
						<option value="">所有项目</option>
						<?php if(is_array($data['child'])): foreach($data['child'] as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</dd>
			</dl><?php endif; ?>
		<dl>
			<dt>部门：</dt>
			<dd>
				<input type="text" value="<?php echo session(C('ADMIN_AUTH_SECTIONNAME'));?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>申请人：</dt>
			<dd>
				<input type="text" value="<?php echo session(C('ADMIN_AUTH_NAME'));?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>预算金额：</dt>
			<dd>
				<input type="text" name="money" class="required number" />
			</dd>
		</dl>
		<dl>
			<dt>申请事由：</dt>
			<dd>
				<textarea name="remark" class="required" style="width:100%;"></textarea>
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