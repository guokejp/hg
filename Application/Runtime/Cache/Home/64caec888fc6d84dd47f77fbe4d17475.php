<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	$(function(){
		var aucatset="<?php echo isset($_POST['cat_catid'])?>";
		if (aucatset=='1') {
			$('#type_cat').show();
			$('#type_cat').find('select').attr('name','cat_catid');
		}else{
			$('#type_cat').hide();
			$('#type_cat').find('select').removeAttr('name');
		}
		var auspeset="<?php echo isset($_POST['spe_proid'])?>";
		if (auspeset=='1') {
			$('#type_spe').show();
			$('#type_spe').find('select').attr('name','spe_proid');
		}else{
			$('#type_spe').hide();
			$('#type_spe').find('select').removeAttr('name');
		}

		$('#auchty').change(function(){
			var type=$('#auchty').find('option:selected').val();
			if (type=='0') {
				$('#type_cat').show();
				$('#type_cat').find('select').attr('name','cat_catid');
				
				$('#type_spe').hide();
				$('#type_spe').find('select').removeAttr('name');
			}else if(type=='3'){
				$('#type_spe').show();
				$('#type_spe').find('select').attr('name','spe_proid');
				var year=$('#billauterm').find('option:selected').html();
				$.ajax({
					url:"/hg/index.php?s=/Home/Bill/ajax_getspecial",
					type:'post',
					data:{year:year},
					datatype:'json',
					success:function(data){
						if (data) {
							$('#type_spe').find('option').remove();
							$('#type_spe').find('select').append("<option value=''>所有专项</option>");
							for (var i = 0; i < data.length; i++) {
								$('#type_spe').find('select').append("<option value="+data[i]["id"]+">"+data[i]["html"]+data[i]["name"]+"</option>");
							}
						}
					},
					error:function(data){
						alert('错误');
					},
				});
				$('#type_cat').hide();
				$('#type_cat').find('select').removeAttr('name');
			}else{
				$('#type_cat').hide();
				$('#type_cat').find('select').removeAttr('name');

				$('#type_spe').hide();
				$('#type_spe').find('select').removeAttr('name');
			}
		})
	})
</script>
<form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Bill/audit">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" action="/hg/index.php?s=/Home/Bill/audit" onsubmit="return navTabSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					单号:<input type="text" name="orderid" value="<?php echo ($_POST['orderid']); ?>"/>
				</td>
				<td>部门：</td>
				<td>
					<select class="combox" name="sectionid">
						<option value="">所有部门</option>
						<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['sectionid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td>财务账期：</td>
				<td>
					<select class="combox" name="termid" id="billauterm">
						<?php if(is_array($termlist)): foreach($termlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(empty($_POST['termid'])): if(($vo["id"]) == $_SESSION['c143a55a53523bd3d3b85d5ab0bd92c4']): ?>selected="selected"<?php endif; else: if(($vo["id"]) == $_POST['termid']): ?>selected="selected"<?php endif; endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td>费用类型：</td>
				<td>
					<select class="combox" name="type" id="auchty">
						<option value="">请选择</option>
						<option value="0" <?php if(($_POST['type']) == "0"): ?>selected='true'<?php endif; ?> >包干</option>
						<option value="1" <?php if(($_POST['type']) == "1"): ?>selected='true'<?php endif; ?> >会议</option>
						<option value="2" <?php if(($_POST['type']) == "2"): ?>selected='true'<?php endif; ?> >培训</option>
						<option value="3" <?php if(($_POST['type']) == "3"): ?>selected='true'<?php endif; ?> >专项</option>
						<option value="4" <?php if(($_POST['type']) == "4"): ?>selected='true'<?php endif; ?> >一次性包干</option>
						<option value="5" <?php if(($_POST['type']) == "5"): ?>selected='true'<?php endif; ?> >采购</option>
					</select>
				</td>
				<td id="type_cat" style="display: none">
					<select>
						<option value="">所有包干</option>
						<?php if(is_array($catlist)): foreach($catlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['cat_catid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["html"]); echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td id="type_spe" style="display: none">
					<select>
						<option value="">所有专项</option>
						<?php if(is_array($spelist)): foreach($spelist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['spe_proid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["html"]); echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td>状态：</td>
				<td>
					<select class="combox" name="statu">
						<option value="">请选择</option>
						<option value="0" <?php if(($_POST['status']) == "0"): ?>selected='true'<?php endif; ?> >等待审批</option>
						<option value="1" <?php if(($_POST['status']) == "1"): ?>selected='true'<?php endif; ?> >审批通过</option>
						<option value="2" <?php if(($_POST['status']) == "2"): ?>selected='true'<?php endif; ?> >审批拒绝</option>
					</select>
				</td>
				<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a title="确实要通过这些申请?" class="add" href="/hg/index.php?s=/Home/Bill/allcheck/navTabId/Billaudit" target="selectedTodo" rel="billallcheck[]"><span>批量审批</span></a></li>
			<?php if(($_SESSION['a33b0950bd33a719b997e7c07a28ccb4']) == "1"): ?><li><a class="edit" href="/hg/index.php?s=/Home/Bill/adminedit/id/{item_id}" target="dialog" rel="Billadminedit" width="550" height="420"><span>修改报销单</span></a></li><?php endif; ?>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="87">
		<thead>
			<tr>
				<th width="22"><input type="checkbox" group="billallcheck[]" class="checkboxCtrl"></th>
				<th width="30">ID</th>
				<th width="180">报销单号</th>
				<th width="80">费用类型</th>
				<th width="100">部门</th>
				<th >项目名称</th>
				<th width="80">录入人</th>
				<th width="80">申请人</th>
				<th width="100">申请金额</th>
				<th width="80">审核状态</th>
				<th width="80">核批金额</th>
				<th width="80">审核人</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><input name="billallcheck[]" value="<?php echo ($vo["id"]); ?>" type="checkbox"></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["orderid"]); ?></td>
				<td><?php echo (showbilltype($vo["type"])); ?></td>
				<td><?php echo ($vo["sectionname"]); ?></td>
				<td>
					<?php switch($vo["type"]): case "0": echo ($vo["categoryname"]); break;?>
						<?php case "1": echo ($vo["conferencename"]); break;?>
						<?php case "2": echo ($vo["trainname"]); break;?>
						<?php case "3": echo ($vo["specialname"]); break;?>
						<?php case "4": echo ($vo["oncebudgetname"]); break;?>
						<?php case "5": echo ($vo["contractname"]); break; endswitch;?>
				</td>
				<td><?php echo ($vo["instaffname"]); ?></td>
				<td><?php echo ($vo["staffname"]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
				<td>
					<?php if($vo["status"] == 0): ?><span style="color:grey;"><b>等待审核</b></span>
					<?php elseif($vo["status"] == 1): ?><span style="color:green;"><b>审核通过</b></span>
					<?php else: ?><span style="color:red;"><b>审核拒绝</b></span><?php endif; ?>
				</td>
				<td>
					<?php if(($vo["status"]) != "0"): echo ($vo["confirm"]); endif; ?>
				</td>
				<td><?php echo ($vo["chestaffname"]); ?></td>
				<td>
					<a href="/hg/index.php?s=/Home/Bill/view/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Billview" width="640" height="480"><span><b>[详情]</b></span></a>
					<?php if(($vo["status"]) == "0"): ?><a href="/hg/index.php?s=/Home/Bill/check/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Billcheck" width="640" height="480"><span><b>[审核]</b></span></a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
		<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option <?php if(($numPerPage) == "10"): ?>selected="selected"<?php endif; ?> value="10">10</option>
				<option <?php if(($numPerPage) == "20"): ?>selected="selected"<?php endif; ?> value="20">20</option>
				<option <?php if(($numPerPage) == "50"): ?>selected="selected"<?php endif; ?> value="50">50</option>
				<option <?php if(($numPerPage) == "100"): ?>selected="selected"<?php endif; ?> value="100">100</option>
			</select>
			<span>条，共<?php echo ($totalCount); ?>条</span>
		</div>
		
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>

	</div>
</div>