<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	$(function(){
		$('#categorychoose').change(function(){
			var ccat=$('#categorychoose').find('option:selected').val();
			$('#cateprojectid').val(ccat);
			$.ajax({
				url:"/hg/index.php?s=/Home/Bill/get_c_lastmoney",
				type:'post',
				datatype:'json',
				data:{ccat:ccat},
				success:function(data){
					$('#catallowmoney').val(data);
					$('#catinputmoney').attr('max',data);
					//console.log(data);
				},
				error:function(){
					alertMsg.error('错误');
				}
			});
		})
		$('#is_cailv').change(function(){
			if ($('#is_cailv').prop('checked')) {
				$('#addcatbudbillcailv').show();

				$('#add_cailv_place').attr('name','cailv_place');
				$('#add_cailv_daymon').attr('name','cailv_daymon');
				$('#add_cailv_type').attr('name','cailv_type');
				$('#add_cailv_peop').attr('name','cailv_peop');

			}else{
				$('#addcatbudbillcailv').hide();

				$('#add_cailv_place').removeAttr('name');
				$('#add_cailv_daymon').removeAttr('name');
				$('#add_cailv_type').removeAttr('name');
				$('#add_cailv_peop').removeAttr('name');
			}
		})
	});
</script>
<div class="pageContent">
	<form method="post" action="/hg/index.php?s=/Home/Bill/insert/navTabId/Billindex/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<div class="pageFormContent" layoutH="56">
		<input type="hidden" name="type" value="0">
		<input type="hidden" name="termid" value="<?php echo session(C('TERM_ID'));?>">
		<input type="hidden" name="unitid" value="<?php echo session(C('ADMIN_AUTH_UNITID'));?>">

		<input type="hidden" name="projectid" value="<?php echo ($data["categoryid"]); ?>" id='cateprojectid' />
		<dl>
			<dt>报销单号：</dt>
			<dd>
				<input type="text" name="orderid" value="<?php echo ($orderid); ?>" readonly="readonly" class="required" />
			</dd>
		</dl>
		<?php if(($childcat) != ""): ?><dl>
				<dt>费用类型：</dt>
				<dd>
					<input type="text" value="<?php echo ($data["name"]); ?>" readonly="readonly" class="required" />
				</dd>
			</dl>	
		<?php else: ?>
			<dl>
				<dt>费用类型：</dt>
				<dd>
					<input type="text" value="<?php echo ($data["categoryname"]); ?>" readonly="readonly" class="required" />
				</dd>
			</dl><?php endif; ?>
		
		<?php if(($childcat) != ""): ?><dl>
				<dt> 选择项目：</dt>
				<dd>
					<select class="combox required" id="categorychoose">
						<option value="">所有项目</option>
						<?php if(is_array($childcat)): foreach($childcat as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</dd>
			</dl><?php endif; ?>
		<dl>
			<dt>属于差旅费 ：</dt>
			<dd>
				<input type="checkbox" id="is_cailv" name="cailv" value="1" />
			</dd>
		</dl>

		<div id="addcatbudbillcailv" style="display: none">
			<dl>
				<dt style="color: red">目的地：</dt>
				<dd>
					<input type="text"class="required" id='add_cailv_place'/>
				</dd>
			</dl>
			<dl>
				<dt style="color: red">出差天数：</dt>
				<dd>
					<input type="text" class="required number" id='add_cailv_daymon'/>
				</dd>
			</dl>
			<dl>
				<dt style="color: red">出差类型：</dt>
				<dd>
					<select class="combox required" id='add_cailv_type'>
						<option value="1">会议</option>
						<option value="2">培训</option>
						<option value="3">其它</option>
					</select>
				</dd>
			</dl>
			<dl style="height: 35px;">
				<dt style="color: red">出差人员：</dt>
				<dd>
					<textarea id="add_cailv_peop" class="required" style="width:100%;"></textarea>
				</dd>
			</dl>
		</div>

		<dl>
			<dt>可用金额：</dt>
			<dd>
				<input type="text" value="<?php echo ($data["money"]); ?>" readonly="readonly" class="required" id='catallowmoney'/>
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
				<input type="text" autocomplete="off" name="money"  class="required number" max="<?php echo ($data["money"]); ?>" id='catinputmoney' />
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