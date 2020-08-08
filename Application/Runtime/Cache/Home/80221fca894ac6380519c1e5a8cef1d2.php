<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	$("#pspech").change(function(){
		var pspcid=$('#pspech').find('option:selected').val();
		$.ajax({
			url:"/hg/index.php?s=/Home/Spebudget/get_c_spe",
			type:'post',
			data:{pid:pspcid},
			datatype:'json',
			success:function(data){
				if (data) {
					$('#cspech').show();
					$('#cspech').find('option').remove();
					for (var i = 0; i < data.length; i++) {
						$('#cspech').find('select').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
					}
				}else{
					$('#cspech').hide();
					$('#cspech').find('option').remove();
				}
				
			},
			error:function(){
				alertMsg.error('错误');

			}
		});
	})
	$('#spebuaddyear').change(function(){
			$('#pspech').find('option').remove();
			$('#pspech').hide();
			var year=$('#spebuaddyear').find('option:selected').val();
			$.ajax({
				url:"/hg/index.php?s=/Home/Spebudget/get_p_spe",
				type:'post',
				data:{year:year},
				datatype:'json',
				success:function(data){
					if (data) {
						$('#pspech').show();
						$('#pspech').find('option').remove();
						$('#pspech').append("<option value=''>请选择</option>");
						for (var i = 0; i < data.length; i++) {
							$('#pspech').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
						}
					}
				},
				error:function(data){
					alert('错误');
				},
			});
		})
	function speaddDl(){
		$str=	'<dl style="width: 600px">'+
				'<dt style="width: 100px">专项管理部门：</dt>'+
				'<dd style="width: 170px"><select name="sectionid[]" class="required"><option value="">请选择</option><?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?></select></dd>'+
				'<dt style="width: 70px">初始定额:</dt>'+
				'<dd style="width: 170px"><input autocomplete="off" name="money[]" class="required number" type="text" /></dd>'+
				'<dt style="width: 20px"><a title="删除本行" onclick="spedelDl(this)" class="btnDel" style="float:right">删除</a></dt>'+
				'</dl>';
		$("#spedl").after($str);

	}

	function spedelDl(obj){
		$(obj).parents("dl").remove();
		return false;
	}
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Spebudget/insert/navTabId/Spebudgetindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
<!-- 			<input type="hidden" name="termid" value="<?php echo session(C('TERM_ID'));?>"> -->
			<input type="hidden" name="unitid" value="<?php echo session(C('ADMIN_AUTH_UNITID'));?>">
			<dl>
				<dt>专项年份：</dt>
				<dd>
					<select class="combox required" name="pspeid" id='spebuaddyear'>
						<?php if(is_array($pyear)): foreach($pyear as $key=>$vo): ?><option value="<?php echo ($vo["year"]); ?>"><?php echo ($vo["year"]); ?></option><?php endforeach; endif; ?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>专项名称：</dt>
				<dd>
					<select class="required" name="pspeid" id='pspech'>
						<option value="">请选择</option>
						<?php if(is_array($pspe)): foreach($pspe as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</dd>
			</dl>
			<dl id='cspech'>
				<dt>&nbsp</dt>
				<dd>
					<select class="" name="cspeid">
						<option value="">请选择</option>
					</select>
				</dd>
			</dl>
			<dl>
				<dd>
					<a class="button" href="javascript:;" onclick="speaddDl()"><span>添加更多</span></a>
				</dd>
			</dl>
			<dl style="width: 600px" id="spedl">
				<dt style="width: 100px">专项管理部门：</dt>
				<dd style="width: 170px">
					<select name="sectionid[]" class="required">
						<option value="">请选择</option>
						<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</dd>
				<dt style="width: 70px">初始定额:</dt>
				<dd style="width: 170px">
					<input autocomplete="off" name="money[]" class="required number" type="text" />
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