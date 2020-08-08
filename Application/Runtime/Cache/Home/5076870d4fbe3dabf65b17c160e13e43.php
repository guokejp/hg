<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	function cateaddTr(){
		$str=	'<dl>'+
				'<dt>类目名称</dt>'+
				'<dd><input type="text" name="name[]" class="required" style="width:80%"><a title="删除本行" onclick="catedelTr(this)" class="btnDel" style="float:right">删除</a></dd>'+
				'</dl>';
		$("#dlk").after($str);

	}

	function catedelTr(obj){
		$(obj).parents("dl").remove();
		return false;
	}
	
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Category/insert/navTabId/Categoryindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<?php if(($data["pid"]) == "0"): ?><dl>
					<dt>上级目录：</dt>
					<dd><?php echo ($data["name"]); ?></dd>

					<input type="hidden" name="pid" value="<?php echo ($data["id"]); ?>">
					<input type="hidden" name="once" value="<?php echo ($data["once"]); ?>">
					<input type="hidden" name="level" value="<?php echo ($data["level"]); ?>">
					<input type="hidden" name="bx_ord" value="<?php echo ($data["bx_ord"]); ?>">
				</dl>
				<dl id="dlk">
					<a class="button" href="javascript:;" onclick="cateaddTr()"><span>添加更多</span></a>
				</dl>

				<dl>
					<dt>类目名称：</dt>
					<dd><input autocomplete="off" name="name[]" class="required" style="width:80%" type="text" /></dd>
				</dl><?php endif; ?>
			
			<?php if(($data["pid"]) != "0"): ?><dl>
					<input type="hidden" name="pid" value="0">
					<dt>类目名称：</dt>
					<dd><input autocomplete="off" name="name" class="required" style="width:100%" type="text" /></dd>
				</dl>
				<dl>
					<dt>多次报销：</dt>
					<dd>
						<select name="once" class="required combox">
							<option value="">请选择</option>
							<option value="1">是</option>
							<option value="0">否</option>
						</select>
					</dd>
				</dl>
				<dl>
					<dt>报销单前缀：</dt>
					<dd><input maxlength="5" name="bx_ord" id="inpbx_ord" class="required lettersonly" type="text" /></dd>
				</dl><?php endif; ?>
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