<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	function catbudgetsum(){
		$catbudgetmoney=$('#catbudgetmoney').val();
		$catbudgetchange=$('#catbudgetchange').val();
		if($catbudgetchange ==""){
			alertMsg.warn('调整金额为空！');
			return false;
		}
		$operate=$('input:radio[name=operate]:checked').val();
		if($operate==1){
			$catbudgettotal=$catbudgetmoney*1+$catbudgetchange*1;
		}else{
			$catbudgettotal=$catbudgetmoney*1-$catbudgetchange*1;
		}
		if($catbudgettotal < 0){
			alertMsg.warn('不能这样，调整过后小于0了！');
			return false;
		}
		$('#catbudgettotal').val($catbudgettotal);
	}

	function catbudgetchangefun(){
		$('#catbudgettotal').val('');
	}
</script>

<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Catbudget/update/navTabId/Catbudgetindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
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
			<dt>当前预算金额</dt>
			<dd>
				<input type="text" id="catbudgetmoney" value="<?php echo ($data["money"]); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<div class="divider"></div>
		<dl>
			<dt>调整预算：</dt>
			<dd>
				<span><input type="radio" onclick="catbudgetchangefun()" name="operate"  checked="checked" value="1"/>增加</span>
				<span><input type="radio" onclick="catbudgetchangefun()" name="operate"  value="0"/>减少</span>
			</dd>
		</dl>
		<dl>
			<dt>调整金额：</dt>
			<dd>
				<input type="text" id="catbudgetchange" onfocus="catbudgetchangefun()" name="money" class="required number" />
			</dd>
		</dl>
		<dl>
			<dt>调整后金额</dt>
			<dd><input id="catbudgettotal" name="total" class="reqiured number" value="" type="text" readonly="readonly"><input type="button" onclick="catbudgetsum()" value="计算"></dd>
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