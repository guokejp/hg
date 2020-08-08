<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	function conferencesum(){
		var conferencenumber=$('#conferencenumber').val();
		if(conferencenumber ==""){
			alertMsg.warn('请填写会议人数！');
			return;
		}
		var conferenceduration=$('#conferenceduration').val();
		if(conferenceduration ==""){
			alertMsg.warn('请填写会议时长！');
			return;
		}
		var conferenceaverage=$('#conferenceaverage').val();
		if(conferenceaverage ==""){
			alertMsg.warn('请填写人均预算！');
			return;
		}
		var conferencebasemoney=$('#conferencebasemoney').val();
		if(conferencebasemoney ==""){
			alertMsg.warn('请填写基础预算金额，为空请填写0!');
			return;
		}
		var conferencesum=conferencenumber*conferenceduration*conferenceaverage+Number(conferencebasemoney);
		$('#conferencemoney').val(conferencesum);
	}
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Conference/update/navTabId/Conferenceindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
			<dl>
				<dt>会议年度</dt>
				<dd><input class="required"  type="text" value="<?php echo session(C('TERM_NAME'));?>" readonly="readonly" /></dd>
			</dl>
			<dl>
				<dt>会议名称</dt>
				<dd><input autocomplete="off" name="name" class="required" style="width:100%" type="text" value="<?php echo ($data["name"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>会议类别</dt>
				<dd>
				<select name="type" class="combox required">
					<option <?php if(($data["type"]) == "1"): ?>selected="selected"<?php endif; ?>value="1">一类</option>
					<option <?php if(($data["type"]) == "2"): ?>selected="selected"<?php endif; ?>value="2">二类</option>
					<option <?php if(($data["type"]) == "3"): ?>selected="selected"<?php endif; ?>value="3">三类</option>
					<option <?php if(($data["type"]) == "4"): ?>selected="selected"<?php endif; ?>value="4">四类</option>
				</select>
				</dd>
			</dl>
			<dl>
				<dt>参会人数</dt>
				<dd><input autocomplete="off" id="conferencenumber" name="number" class="required digits" type="text" value="<?php echo ($data["number"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>会议时间</dt>
				<dd>
				<select name="month" class="combox required">
					<option <?php if(($data["month"]) == "1"): ?>selected="selected"<?php endif; ?>value="1">一月</option>
					<option <?php if(($data["month"]) == "2"): ?>selected="selected"<?php endif; ?>value="2">二月</option>
					<option <?php if(($data["month"]) == "3"): ?>selected="selected"<?php endif; ?>value="3">三月</option>
					<option <?php if(($data["month"]) == "4"): ?>selected="selected"<?php endif; ?>value="4">四月</option>
					<option <?php if(($data["month"]) == "5"): ?>selected="selected"<?php endif; ?>value="5">五月</option>
					<option <?php if(($data["month"]) == "6"): ?>selected="selected"<?php endif; ?>value="6">六月</option>
					<option <?php if(($data["month"]) == "7"): ?>selected="selected"<?php endif; ?>value="7">七月</option>
					<option <?php if(($data["month"]) == "8"): ?>selected="selected"<?php endif; ?>value="8">八月</option>
					<option <?php if(($data["month"]) == "9"): ?>selected="selected"<?php endif; ?>value="9">九月</option>
					<option <?php if(($data["month"]) == "10"): ?>selected="selected"<?php endif; ?>value="10">十月</option>
					<option <?php if(($data["month"]) == "11"): ?>selected="selected"<?php endif; ?>value="11">十一月</option>
					<option <?php if(($data["month"]) == "12"): ?>selected="selected"<?php endif; ?>value="12">十二月</option>
				</select>
				</dd>
			</dl>
			<dl>
				<dt>会议时长（单位：天）</dt>
				<dd><input autocomplete="off" id="conferenceduration" name="duration" class="required number" type="text" value="<?php echo ($data["duration"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>人均预算（单位：元）</dt>
				<dd><input autocomplete="off" id="conferenceaverage" name="average" class="required number" type="text" value="<?php echo ($data["average"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>基础预算</dt>
				<dd><input autocomplete="off" id="conferencebasemoney" name="basemoney" class="required number" type="text" value="<?php echo ($data["basemoney"]); ?>" /></dd>
			</dl>
			<dl>
				<dt>会议部门</dt>
				<dd>
				<select name="sectionid" class="combox required">
					<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option <?php if(($data["sectionid"]) == $vo["id"]): ?>selected="selected"<?php endif; ?> value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				</select></dd>
			</dl>
			<dl>
				<dt>计划总金额</dt>
				<dd><input id="conferencemoney" name="money" class="reqiured number" value="" type="text" readonly="readonly"><input type="button" onclick="conferencesum()" value="计算"></dd>
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