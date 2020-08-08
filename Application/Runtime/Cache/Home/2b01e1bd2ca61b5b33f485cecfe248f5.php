<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
$(function(){
	$('#spech_year').change(function(){
		var year=$('#spech_year').find('option:selected').val();
		$.ajax({
			url:"/hg/index.php?s=/Home/Bill/get_p_special",
			type:'post',
			datatype:'json',
			data:{year:year},
			success:function(data){
				$('#spech_p').find('option').remove();
				$('#spech_p').append("<option value=''>请选择</option>");
				for (var i = 0; i < data.length; i++) {
					$('#spech_p').append("<option name="+data[i]['money']+" value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
				}
			},
			error:function(){
				alertMsg.error('错误');
			}
		});
	})
	$('#spech_p').change(function(){
		var pspe=$('#spech_p').find('option:selected').val();
		$.ajax({
			url:"/hg/index.php?s=/Home/Bill/get_c_special",
			type:'post',
			datatype:'json',
			data:{pspe:pspe},
			success:function(data){
				if (data.child=='1') {
					$('#spech_c').show();
					$('#spech_c').attr('name','cspe');
					$('#spech_c').addClass('required');
					$('#spech_c').find('option').remove();
					$('#spech_c').append("<option value=''>请选择</option>");
					for (var i = 0; i < data['list'].length; i++) {
						$('#spech_c').append("<option name="+data['list'][i]['money']+" value="+data['list'][i]["id"]+">"+data['list'][i]["specialname"]+"</option>");
					}
				}else{
					$('#spech_c').hide();
					$('#spech_c').removeAttr('name');
					$('#spech_c').removeClass('required');

					var money=$('#spech_p').find('option:selected').attr('name');
					$('#addspecialmoney').val(money);
					$('#addspecialmoney1').attr('MAX',money);
				}
			},
			error:function(){
				alertMsg.error('错误');
			}
		});
	})
	$('#spech_c').change(function(){
		var money=$('#spech_c').find('option:selected').attr('name');
		$('#addspecialmoney').val(money);
		$('#addspecialmoney1').attr('MAX',money);
	})
})
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Bill/insert/navTabId/Billindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="type" value="3">
		<input type="hidden" name="termid" value="<?php echo session(C('TERM_ID'));?>">
		<input type="hidden" name="unitid" value="<?php echo session(C('ADMIN_AUTH_UNITID'));?>">
		<dl>
			<dt>报销单号：</dt>
			<dd>
				<input type="text" name="orderid" value="<?php echo ($orderid); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>专项年份：</dt>
			<dd>
				<select id="spech_year" class="required combox">
					<option value="">请选择</option>
					<?php if(is_array($year)): foreach($year as $key=>$vo): ?><option value="<?php echo ($vo["year"]); ?>"><?php echo ($vo["year"]); ?></option><?php endforeach; endif; ?>
				</select>
			</dd>
		</dl>
		<dl style="width: 450px">
			<dt>报销专项：</dt>
			<dd style="width: 300px">
				<select name="pspe" id="spech_p">
					<option value="">请选择</option>
					
				</select>
				<select id="spech_c" style="display: none">
					<option value="">请选择</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>专项预算金额：</dt>
			<dd>
				<input id="addspecialmoney" type="text" value="" readonly="readonly" class="required" />
			</dd>
		</dl>
		<script type="text/javascript">
	$(function(){
		$('#chstaff').click(function(){
			$('#secselect').show();
			$('#secselect').addClass('required');
			$('#secselect').attr('name','sectionid');
			$('#secinput_hide').removeAttr('name');
			$('#secinput_hide').removeClass('required');
			$('#secinput').hide();

			$('#stainput').hide();
			$('#stainput_hide').removeAttr('name');
			$('#stainput_hide').removeClass('required');
			$('#stacselect').show();
			$('#stacselect').attr('name','staffid');
			$('#stacselect').addClass('required');
			$('#stacselect').find('option').remove();
		})
		$('#secselect').change(function(){
			var scid=$('#secselect').find('option:selected').val();
			$('#stacselect').find('option').remove();
			$.ajax({
				url:'/hg/index.php?s=/Home/Bill/getstaff',
				type:'post',
				data:{'sectionid':scid},
				dataType:'json',
				success:function(data){
					if (data) {
						$('#stainput').hide();
						$('#stainput_hide').removeAttr('name');
						$('#stainput_hide').removeClass('required');
						$('#stacselect').show();
						$('#stacselect').attr('name','staffid');
						$('#stacselect').addClass('required');
						$('#stacselect').append("<option value=''>请选择</option>");
						for (var i = 0; i < data.length; i++) {
							$('#stacselect').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
						}
					}
				},
				error:function(){
					alertMsg.error('错误');
				}
			})
		})
		$('#unchstaff').click(function(){
			$('#secselect').hide();
			$('#secselect').removeClass('required');
			$('#secselect').removeAttr('name');
			$('#secinput_hide').attr('name','sectionid');
			$('#secinput_hide').addClass('required');
			$('#secinput').show();

			$('#stainput').show();
			$('#stainput_hide').attr('name','staffid');
			$('#stainput_hide').addClass('required');
			$('#stacselect').hide();
			$('#stacselect').removeAttr('name');
			$('#stacselect').removeClass('required');
		})
	})
</script>
<input type="hidden" name="instaid" value="<?php echo session(C('ADMIN_AUTH_ID'));?>">
<dl style="width:550px">
	<dt>部门：</dt>
	<dd style="width:400px">
		<input id='secinput' type="text" value="<?php echo session(C('ADMIN_AUTH_SECTIONNAME'));?>" readonly='true'/>

		<input id='secinput_hide' type="hidden" name="sectionid" value="<?php echo session(C('ADMIN_AUTH_SECTIONID'));?>" class='required' />
		
		<select id="secselect" style="display: none;">
			<option value="">请选择</option>
			<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
		</select>

		<input type="button" style="float: left" id="chstaff" value="更改">
		<input type="button" style="float: left" id="unchstaff" value="取消">
	</dd>
</dl>
<dl>
	<dt>申请人：</dt>
	<dd>
		<input id='stainput' type="text" value="<?php echo session(C('ADMIN_AUTH_NAME'));?>" readonly='true' />

		<input id="stainput_hide" type="hidden" name="staffid" value="<?php echo session(C('ADMIN_AUTH_ID'));?>" class='required' />

		<select id="stacselect" style="display: none;">
			
		</select>

	</dd>
</dl>
		<dl>
			<dt>报销金额：</dt>
			<dd>
				<input type="text" autocomplete="off" name="money" id="addspecialmoney1" class="required number" />
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