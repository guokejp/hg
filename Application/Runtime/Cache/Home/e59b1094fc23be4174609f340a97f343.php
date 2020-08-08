<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	function addtrainchange(){
			var $moneyl1jk=$("#addtrain").find("option:selected").attr("money");
			var $addtrainstaging=$("#addtrain").find("option:selected").attr("staging");
			$("#addtrainmoney").val($moneyl1jk);
			$("#addtrainstaging").val($addtrainstaging);
			$("#addtrainmoney1").attr("max",$moneyl1jk);
			$("#addtrainmoney1").attr("value","");
	}
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Bill/insert/navTabId/Billindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="type" value="2">
		<input type="hidden" name="termid" value="<?php echo session(C('TERM_ID'));?>">
		<input type="hidden" name="unitid" value="<?php echo session(C('ADMIN_AUTH_UNITID'));?>">
		<dl>
			<dt>报销单号：</dt>
			<dd>
				<input type="text" name="orderid" value="<?php echo ($orderid); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>报销培训：</dt>
			<dd>
				<select name="projectid" id="addtrain" class="combox required" onchange="addtrainchange()">
					<option staging="" money="" value="">请选择培训计划</option>
					<?php if(is_array($trainlist)): foreach($trainlist as $key=>$vo): ?><option staging="<?php echo ($vo["staging"]); ?>" money="<?php echo ($vo["money"]); ?>" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>培训剩余期数：</dt>
			<dd>
				<input id="addtrainstaging" type="text" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>培训预算金额：</dt>
			<dd>
				<input id="addtrainmoney" type="text" readonly="readonly" class="required" />
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
				<input type="text" autocomplete="off" name="money" id="addtrainmoney1" class="required number" />
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