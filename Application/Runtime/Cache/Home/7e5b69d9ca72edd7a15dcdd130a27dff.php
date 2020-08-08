<?php if (!defined('THINK_PATH')) exit();?><script>
	function set($obj){
		var money=$('#'+$obj+'special').find("option:selected").attr($obj+'money');
		$('#'+$obj+'specialmoney').val(money);
		var sectionid=$('#'+$obj+'special').find("option:selected").attr($obj+'sectionid');
		$('#specialbudgetsectionid').val(sectionid);
		$('#checkaddmoneydata').attr('max',money);
	}

	function check($obj){
		if($("#"+$obj).attr("checked")){
			$('#'+$obj+'tpl').show();
			$('.'+$obj+'css').addClass('required');
		}else{
			$('#'+$obj+'tpl').hide();
			$('.'+$obj+'css').removeClass('required');
		}

	}
	function choosetype($obj){
		if ($obj=='true') {
			$('#special'+$obj).addClass('required');
			$('#specialfalse').removeClass('required');

			$('#special'+$obj+'type').show();
			$('#specialfalsetype').hide();
			$('.'+$obj+'css').addClass('required');
			$('.falsecss').removeClass('required');
		}else{
			$('#special'+$obj).addClass('required');
			$('#specialtrue').removeClass('required');

			$('#special'+$obj+'type').show();
			$('#specialtruetype').hide();
			$('.'+$obj+'css').addClass('required');
			$('.truecss').removeClass('required');
		}

	}
	function checkaddmoney(){
		if ($('#specialtrue').attr('checked')) {
			var money=$('#sp-special').find('option:selected').attr('sp-money');

			var projectmoney=Number($('#projecttpl').find('input').val());
			var goodsmoney=Number($('#goodstpl').find('input').val());
			var servicemoney=Number($('#servicetpl').find('input').val());

			var addmoney=projectmoney+goodsmoney+servicemoney;
			if (addmoney>money) {
				alert('总数不能大于'+money);
			}
		}else if($('#specialfalse').attr('checked')){
			var money=$('#ot-special').find('option:selected').attr('ot-money');

			var projectmoney=Number($('#projecttpl').find('input').val());
			var goodsmoney=Number($('#goodstpl').find('input').val());
			var servicemoney=Number($('#servicetpl').find('input').val());

			var addmoney=projectmoney+goodsmoney+servicemoney;
			if (addmoney>money) {
				alert('总数不能大于'+money);
			}
		}
	}
	$(function(){
		$('#sp-chooseyear').change(function(){
			var year=$('#sp-chooseyear').find('option:selected').val();
			$.ajax({
				url:'/hg/index.php?s=/Home/Contract/get_spe_bud',
				type:'post',
				datatype:'json',
				data:{year:year},
				success:function(data){
					$('#sp-special').find('option').remove();
					$('#sp-special').append("<option value=''>请选择</option>");
					for (var i = 0; i < data.length; i++) {
						$('#sp-special').append("<option sp-sectionid="+data[i]['sectionid']+" sp-money="+data[i]['total']+" value="+data[i]["id"]+">"+data[i]["specialname"]+"&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;"+data[i]["sectionname"]+"</option>");
					}
					},
				error:function(){
					alertMsg.error('错误');
				}
			})
		})
	})
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Contract/insert/navTabId/Contractindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<input type="hidden" name="staffid" value="<?php echo session(C('ADMIN_AUTH_ID'));?>" />
			<input type="hidden" id="specialbudgetsectionid" name="sectionid" class="required">
			<dl class="nowrap">
				<dt>资金来源</dt>
				<dd>
					<label><input id="specialtrue" class="required" type="radio" name="isother" value="0" onclick="choosetype('true')" />专项</label>
					<label><input id="specialfalse" class="required" type="radio" name="isother" value="1" onclick="choosetype('false')" />其它</label>
				</dd>
			</dl>

			<div id="specialtruetype" style="display:none">
				<dl class="nowrap">
					<dt>专项年份</dt>
					<dd>
						<select id="sp-chooseyear" class="combox">
							<option value="">请选择</option>
							<?php if(is_array($year)): foreach($year as $key=>$vo): ?><option value="<?php echo ($vo["year"]); ?>"><?php echo ($vo["year"]); ?></option><?php endforeach; endif; ?>
						</select>
					</dd>
				</dl>
				<dl class="nowrap">
					<dt>专项预算</dt>
					<dd>
						<select name="sp-specialid" id="sp-special" onchange="set('sp-')">
							<option sp-sectionid="" sp-money="" value="">请选择专项预算</option>
						</select>
					</dd>
				</dl>
				
				<dl class="nowrap">
					<dt>预算可用金额：</dt>
					<dd>
						<input type="text" id='sp-specialmoney' name="sp-total" readonly="readonly" class="truecss" />
					</dd>
				</dl>
			</div>

			<div id="specialfalsetype" style="display:none">
				<dl class="nowrap">
					<dt>其它预算</dt>
					<dd>
						<select name="ot-specialid" id="ot-special" class="combox" onchange="set('ot-')">
							<option ot-sectionid="" ot-money="" value="">请选择预算项目</option>
							<?php if(is_array($specialotherlist)): foreach($specialotherlist as $key=>$vo): ?><option ot-sectionid="<?php echo ($vo["sectionid"]); ?>" ot-money="<?php echo ($vo["confirmmoney"]); ?>" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($vo["sectionname"]); ?></option><?php endforeach; endif; ?>
						</select>
					</dd>
				</dl>
				<dl class="nowrap">
					<dt>预算可用金额：</dt>
					<dd>
						<input type="text" id='ot-specialmoney' name="ot-total" readonly="readonly" class="falsecss" />
					</dd>
				</dl>
			</div>

			<dl class="nowrap">
				<dt>项目名称：</dt>
				<dd><input name="name" class="required" style="width:100%" type="text" /></dd>
			</dl>
			<dl class="nowrap" >
				<dt>采购方式：</dt>
				<dd>
					<select name="procurement" class="required combox">
						<option selected="selected" value="1">市场比价</option>
						<option value="2">集中采购</option>
						<option value="3">服务合同续签</option>
						<option value="4">内外网同时征集比选</option>
						<option value="5">内外网征集比选</option>
						<option value="6">商场直购</option>
						<option value="7">公开招标</option>
					</select>
				</dd>
			</dl>
			<dl class="nowrap">
				<dt>申请人：</dt>
				<dd>
					<input type="text" value="<?php echo session(C('ADMIN_AUTH_NAME'));?>" readonly="readonly" class="required" />
				</dd>
			</dl>
			<dl class="nowrap">
				<dt>合同类目</dt>
				<dd>
					<label><input id="project" checked="checked" type="checkbox" name="project" value="1" onclick="check('project')" />工程</label>
					<label><input id="goods" type="checkbox" name="goods" value="1" onclick="check('goods')" />货物</label>
					<label><input id="service" type="checkbox" name="service" value="1" onclick="check('service')" />服务</label>
				</dd>
			</dl>
	<fieldset id="projecttpl">
		<legend><span style="color:green">工程</span></legend>
		<dl>
			<dt>工程预算金额：</dt>
			<dd>
				<input type="text"  name="projectmoney" class="number required projectcss" onkeyup="checkaddmoney()"/>
			</dd>
		</dl>
		<dl class="nowrap">
			<dt>说明：</dt>
			<dd>
				<textarea class="required projectcss" name="projectremark" style="width:100%;height:60px;" ></textarea>
			</dd>
		</dl>
	</fieldset>
	<fieldset id="goodstpl" style="display:none">
		<legend><span style="color:green">货物</span></legend>
		<dl>
			<dt>货物预算金额：</dt>
			<dd>
				<input type="text"  name="goodsmoney" class="number  goodscss" onkeyup="checkaddmoney()"/>
			</dd>
		</dl>
		<dl class="nowrap">
			<dt>说明：</dt>
			<dd>
				<textarea class=" goodscss" name="goodsremark" style="width:100%;height:60px;" ></textarea>
			</dd>
		</dl>
	</fieldset>
	<fieldset id="servicetpl" style="display:none">
		<legend><span style="color:green">服务</span></legend>
		<dl>
			<dt>服务预算金额：</dt>
			<dd>
				<input type="text" name="servicemoney" class="number servicecss" onkeyup="checkaddmoney()"/>
			</dd>
		</dl>
		<dl class="nowrap">
			<dt>说明：</dt>
			<dd>
				<textarea class=" servicecss" name="serviceremark" style="width:100%;height:60px;" ></textarea>
			</dd>
		</dl>
	</fieldset>
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