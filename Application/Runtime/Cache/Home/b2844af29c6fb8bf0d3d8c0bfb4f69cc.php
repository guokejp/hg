<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	function speaddTr(){
		$str=	'<dl>'+
				'<dt>类目名称</dt>'+
				'<dd><input type="text" name="name[]" class="required" style="width:80%"><a title="删除本行" onclick="spedelTr(this)" class="btnDel" style="float:right">删除</a></dd>'+
				'</dl>';
		$("#spedlk").after($str);

	}

	function spedelTr(obj){
		$(obj).parents("dl").remove();
		return false;
	}
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Special/insert/navTabId/Specialindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<?php if(($data["pid"]) == "0"): ?><input type="hidden" name="unitid" value="<?php echo session(C('ADMIN_AUTH_UNITID'));?>">
				<dl>
					<dt>上级目录：</dt>
					<dd><?php echo ($data["name"]); ?></dd>

					<input type="hidden" name="pid" value="<?php echo ($data["id"]); ?>">
					<input type="hidden" name="gov" value="<?php echo ($data["gov"]); ?>">
					<input type="hidden" name="level" value="<?php echo ($data["level"]); ?>">
					<input type="hidden" name="year" value="<?php echo ($data["year"]); ?>">
					<!-- <input type="hidden" name="bx_ord" value="<?php echo ($data["bx_ord"]); ?>"> -->
				</dl>
				<dl id="spedlk">
					<a class="button" href="javascript:;" onclick="speaddTr()"><span>添加更多</span></a>
				</dl>

				<dl>
					<dt>类目名称：</dt>
					<dd><input autocomplete="off" name="name[]" class="required" style="width:80%" type="text" /></dd>
				</dl><?php endif; ?>
			
			<?php if(($data["pid"]) != "0"): ?><input type="hidden" name="unitid" value="<?php echo session(C('ADMIN_AUTH_UNITID'));?>">
				<dl>
					<dt>专项核批年费：</dt>
					<dd>
						<select name="year" class="required combox">
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2010"): ?>selected="selected"<?php endif; ?> value="2010">2010</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2011"): ?>selected="selected"<?php endif; ?> value="2011">2011</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2012"): ?>selected="selected"<?php endif; ?> value="2012">2012</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2013"): ?>selected="selected"<?php endif; ?> value="2013">2013</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2014"): ?>selected="selected"<?php endif; ?> value="2014">2014</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2015"): ?>selected="selected"<?php endif; ?> value="2015">2015</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2016"): ?>selected="selected"<?php endif; ?> value="2016">2016</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2017"): ?>selected="selected"<?php endif; ?> value="2017">2017</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2018"): ?>selected="selected"<?php endif; ?> value="2018">2018</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2019"): ?>selected="selected"<?php endif; ?> value="2019">2019</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2020"): ?>selected="selected"<?php endif; ?> value="2020">2020</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2021"): ?>selected="selected"<?php endif; ?> value="2021">2021</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2022"): ?>selected="selected"<?php endif; ?> value="2022">2022</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2023"): ?>selected="selected"<?php endif; ?> value="2023">2023</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2024"): ?>selected="selected"<?php endif; ?> value="2024">2024</option>
							<option <?php if(($_SESSION['6937233cbc12d295feae0712d607a371']) == "2025"): ?>selected="selected"<?php endif; ?> value="2025">2025</option>
						</select>
					</dd>
				</dl>

				<dl>
					<input type="hidden" name="pid" value="0">
					<dt>类目名称：</dt>
					<dd><input autocomplete="off" name="name" class="required" style="width:100%" type="text" /></dd>
				</dl>
				<dl>
					<dt>政府预算：</dt>
					<dd>
						<select name="gov" class="required combox">
							<option value="">请选择</option>
							<option value="1">是</option>
							<option value="0">否</option>
						</select>
					</dd>
				</dl>
				<!-- <dl>
					<dt>报销单前缀：</dt>
					<dd><input maxlength="5" name="bx_ord"  class="required" type="text" /></dd>
				</dl> --><?php endif; ?>
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