<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Train/update/navTabId/Trainindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
			<dl>
				<dt>会议年度</dt>
				<dd><input class="required"  type="text" value="<?php echo session(C('TERM_NAME'));?>" readonly="readonly" /></dd>
			</dl>
			<dl>
				<dt>培训班名称</dt>
				<dd><input autocomplete="off" name="name" class="required" style="width:100%" value="<?php echo ($data["name"]); ?>" type="text" /></dd>
			</dl>
			<dl style="height:100px">
				<dt>培训内容</dt>
				<dd><textarea name="remark"  class="required" style="width:384px;height:100px" ><?php echo ($data["remark"]); ?></textarea></dd>
			</dl>
			<dl>
				<dt>期数</dt>
				<dd><input autocomplete="off" name="staging" class="required digits" type="text" value="<?php echo ($data["staging"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>人数</dt>
				<dd><input autocomplete="off" name="number" class="required digits" type="text" value="<?php echo ($data["number"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>地点</dt>
				<dd><input autocomplete="off" name="place" class="required" style="width:100%" type="text" value="<?php echo ($data["place"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>培训天数（单位：天）</dt>
				<dd><input autocomplete="off" name="duration" class="required number" type="text" value="<?php echo ($data["duration"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>所需经费（单位：元）</dt>
				<dd><input autocomplete="off" name="money" class="required number" type="text" value="<?php echo ($data["money"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>经费来源</dt>
				<dd><input autocomplete="off" name="origin" class="required" type="text" value="<?php echo ($data["origin"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>会议部门</dt>
				<dd>
				<select name="sectionid" class="combox required">
					<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option <?php if(($data["sectionid"]) == $vo["id"]): ?>selected="selected"<?php endif; ?> value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				</select></dd>
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