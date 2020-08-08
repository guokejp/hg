<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
$(function(){
	$('#changecat').click(function(){
		$('#ifchange').show();
		$('#change_p').attr('name','pcat');
		$('#change_p').addClass('required');
	})
	$('#change_p').change(function(){
		var pcat=$('#change_p').find('option:selected').val();
		$.ajax({
			url:"/hg/index.php?s=/Home/Bill/get_c_catgroy",
			type:'post',
			datatype:'json',
			data:{pcat:pcat},
			success:function(data){
				if (data) {
					$('#change_c').show();
					$('#change_c').attr('name','ccat');
					$('#change_c').addClass('required');
					$('#change_c').find('option').remove();
					$('#change_c').append("<option value=''>请选择</option>");
					for (var i = 0; i < data.length; i++) {
						$('#change_c').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
					}
				}else{
					$('#change_c').removeAttr('name');
					$('#change_c').removeClass('required');
					$('#change_c').find('option').remove();
					$('#change_c').hide();
				}
				
			},
			error:function(){
				alertMsg.error('错误');
			}
		});
	})
	$('#unchangecat').click(function(){
		$('#ifchange').hide();
		$('#change_p').removeAttr('name');
		$('#change_c').removeAttr('name');
		$('#change_p').removeClass('required');
		$('#change_c').removeClass('required');

	})
	$('#catpass').change(function(){
		var ispass=$('#catpass').find('option:selected').val();
		if (ispass=='2') {
			$('#comfirmmoney').removeClass('required');
			$('#comfirmmoney').hide();
		}else if (ispass=='1') {
			$('#comfirmmoney').addClass('required');
			$('#comfirmmoney').show();
		}
	})
})
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Bill/allow/navTabId/Billaudit/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
		<input type="hidden" name="chestaid" value="<?php echo session(C('ADMIN_AUTH_ID'));?>">
		<dl>
			<dt>报销单号：</dt>
			<dd>
				<input type="text"  value="<?php echo ($data["orderid"]); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>费用类型</dt>
			<dd><input type="text"  value="<?php echo (showbilltype($data["type"])); ?>" readonly="readonly" class="required" /></dd>
		</dl>
		<dl>
			<dt>项目名称：</dt>
			<dd>
				<input type="text"  value="<?php switch($data["type"]): case "0": echo ($data["categoryname"]); break;?>
						<?php case "1": echo ($data["conferencename"]); break;?>
						<?php case "2": echo ($data["trainname"]); break;?>
						<?php case "3": echo ($data["specialname"]); break;?>
						<?php case "4": echo ($data["oncebudgetname"]); break; endswitch;?>
				" readonly="readonly" class="required" />
				<input type="button" id="changecat" value="更改">
				<input type="button" id="unchangecat" value="取消">
			</dd>
		</dl>
		<dl id="ifchange" style="display: none">
			<dt>更改：</dt>
			<dd>
				<select id="change_p">
					<option value="">请选择</option>
					<?php if(is_array($pcat)): foreach($pcat as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				</select>
				<select id="change_c">
					<option value="">请选择</option>
				</select>
			</dd>
		</dl>
		<!-- 差旅费详情 -->
		<?php if(($data["is_cailv"]) == "1"): ?><div>
			<dl>
				<dt>属于差旅费 ：</dt>
				<dd>
					<input type="checkbox" checked="true" onclick="return false;"/>
				</dd>
			</dl>
			<dl>
				<dt style="color: red">目的地：</dt>
				<dd>
					<input type="text" class="required" readonly="readonly" value="<?php echo ($data["cailv_info"]["place"]); ?>" />
				</dd>
			</dl>
			<dl>
				<dt style="color: red">出差天数：</dt>
				<dd>
					<input type="text" class="required number" readonly="readonly" value="<?php echo ($data["cailv_info"]["day"]); ?>" />
				</dd>
			</dl>
			<dl>
				<dt style="color: red">出差类型：</dt>
				<dd>
					<?php switch($data["cailv_info"]["type"]): case "1": ?>会议<?php break;?>
					    <?php case "2": ?>培训<?php break;?>
					    <?php case "3": ?>其它<?php break;?>
					    <?php default: ?>未定义<?php endswitch;?>
				</dd>
			</dl>
			<dl style="height: 35px;">
				<dt style="color: red">出差人员：</dt>
				<dd>
					<textarea class="required" style="width:100%;" readonly="readonly"><?php echo ($data["cailv_info"]["people"]); ?></textarea>
				</dd>
			</dl>
		</div><?php endif; ?>
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
		<dl>
			<dt>报销金额：</dt>
			<dd>
				<input type="text"  name="billmoney" readonly="readonly" class="required number" value="<?php echo ($data["money"]); ?>" />
			</dd>
		</dl>
		<dl style="height:36px;">
			<dt>报销事由：</dt>
			<dd>
				<textarea class="required" name="remark" style="width:100%;"><?php echo ($data["remark"]); ?></textarea>
			</dd>
		</dl>
		<div class="divider"></div>
		<dl>
			<dt>核批金额：</dt>
			<dd>
				<input type="text" id='comfirmmoney' name="confirm" class="required number" value="<?php echo ($data["money"]); ?>" max="<?php echo ($data["money"]); ?>"/>
			</dd>
		</dl>
		<dl>
			<dt>是否通过：</dt>
			<dd>
				<select name="status" class="combox required" id="catpass">
					<option value="1">通过</option>
					<option value="2">拒绝</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>核批意见：</dt>
			<dd>
				<textarea class="required" name="cremark" style="width:100%;">同意。</textarea>
			</dd>
		</dl>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">确定</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>