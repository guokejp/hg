<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	$(function(){
		$('#incomecheckchoose').change(function(){
			var sta=$('#incomecheckchoose').find('option:selected').val();
			if (sta=='1') {
				$('#incomecheckpass').show();
				$('#incomecheckpass').find('input').addClass('required');
				$('#incomecheckpass').find('input').attr('name','confirm');
			}else{
				$('#incomecheckpass').hide();
				$('#incomecheckpass').find('input').removeClass('required');
				$('#incomecheckpass').find('input').removeAttr('name','confirm');
			}
		});
	})
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Income/allow/navTabId/Incomeaudit/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
		<dl>
			<dt>预算单号：</dt>
			<dd>
				<input type="text"  value="<?php echo ($data["orderid"]); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>费用类型：</dt>
			<dd>
				<input type="text" value="<?php echo ($data["categoryname"]); ?>" readonly="readonly" class="required" />
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
				<input type="text" style="width:100%" readonly="readonly" class="required" value="<?php echo ($data["name"]); ?>">
			</dd>
		</dl><?php endif; ?>
		<dl>
			<dt>预算金额：</dt>
			<dd>
				<input type="text"  readonly="readonly" class="required number" value="<?php echo ($data["money"]); ?>" />
			</dd>
		</dl>
		<dl style="height:36px;">
			<dt>申请事由：</dt>
			<dd>
				<textarea class="required" readonly="readonly" style="width:100%;"><?php echo ($data["remark"]); ?></textarea>
			</dd>
		</dl>
		<dl>
			<dt>审批结果：</dt>
			<dd>
				<select name="status" class="required combox" id='incomecheckchoose'>
					<option value="">请选择</option>
					<option value="1">通过</option>
					<option value="2">拒绝</option>
				</select>
			</dd>
		</dl>
		<div class="divider"></div>
		<dl id="incomecheckpass" style="display: none">
			<dt>预算金额：</dt>
			<dd>
				<input type="text"  name="confirm" class="required number" value="<?php echo ($data["money"]); ?>" max="<?php echo ($data["money"]); ?>"/>
			</dd>
		</dl>
		<dl>
			<dt>审批意见：</dt>
			<dd>
				<textarea class="required" name="cremark" style="width:100%;"></textarea>
			</dd>
		</dl>

		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">审批通过</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>