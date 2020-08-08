<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	function addcontractchange(){
			var contractid=$('#addcontract').find("option:selected").val();
			if(contractid == ""){
				return false;
			}else{
				$.ajax({
					url:'/hg/index.php?s=/Home/Bill/contractsub',
					data:{
						contractid:contractid
					},
					type:'post',
					cache:false,
					dataType:'json',
					success:function(data) { 
						//console.log(data);
						$("#more").find("option").remove();
						$("#more").append("<option value=''>请选择项目</option>");
						for (var i = 0; i < data.length; i++) {
							$("#more").append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
						};
				    },
				    error : function() {
				    	//view("异常！");
				    	alert("异常！");    
				    }
				});
			}
	}
	function addcontractqishuchange(){
			var contractmoneyid=$('#more').find("option:selected").val();
			//console.log(contractmoneyid);
			if(contractmoneyid == ""){
				return false;
			}else{
				$.ajax({
					url:'/hg/index.php?s=/Home/Bill/contractqishusub',
					data:{
						contractmoneyid:contractmoneyid
					},
					type:'post',
					cache:false,
					dataType:'json',
					success:function(data) { 
						//console.log(data['ht']);
						//console.log(data['ht'].length);
						$("#moreqishu").find("option").remove();
						$("#moreqishu").append("<option value=''>请选择期数</option>");
						for (var i = 1; i <= 6; i++) {
							if (data['ht'][i]['money']!=0) {
								if (data['ht'][i]['status']==0) {
									$("#moreqishu").append("<option money="+data['ht'][i]['money']+"\ value="+i+">"+data["ht"][i]["name"]+"</option>");
								};
							};
						};
						var qishu=$('#moreqishu').find("option:selected").attr("money");
						
			    },
			    error : function() {
			    	//view("异常！");
			    	alert("异常！");    
			    }
				});
			}
	}
	function addcontractqishumoneychange(){
		var money=$('#moreqishu').find("option:selected").attr("money");
		$('#addcontractmoney1').val(money);
	}
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Bill/insert/navTabId/Billindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="type" value="5">
		<input type="hidden" name="termid" value="<?php echo session(C('TERM_ID'));?>">
		<input type="hidden" name="unitid" value="<?php echo session(C('ADMIN_AUTH_UNITID'));?>">
		<dl>
			<dt>报销单号：</dt>
			<dd>
				<input type="text" name="orderid" value="<?php echo ($orderid); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<dl>
			<dt>采购合同名称：</dt>
			<dd>
				<select name="projectid" id="addcontract" class="required" onchange="addcontractchange()">
					<option value="">请选择合同</option>
					<?php if(is_array($contractlist)): foreach($contractlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</dd>
		</dl>
		<dl>
			<dt>报销项目：</dt>
			<dd>
				<select name="contractmoneyid" id="more" class="required" onchange="addcontractqishuchange()">
					
				</select>
			</dd>
		</dl>
		<dl>
			<dt>报销期数：</dt>
			<dd>
				<select name="contractmoneyqishuid" id="moreqishu" class="required" onchange="addcontractqishumoneychange()">
					
					
				</select>
			</dd>
		</dl>
		<dl>
			<dt>部门：</dt>
			<dd>
				<input type="text" value="<?php echo session(C('ADMIN_AUTH_SECTIONNAME'));?>" readonly='true'/>

			</dd>
		</dl>
		<dl>
			<dt>申请人：</dt>
			<dd>
				<input type="text" value="<?php echo session(C('ADMIN_AUTH_NAME'));?>" readonly='true' />
			</dd>
		</dl>
		<dl>
			<dt>报销金额：</dt>
			<dd>
				<input type="text" autocomplete="off" name="money" id="addcontractmoney1" readonly="readonly" class="required number" />
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