<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	$(function(){
		$('#c_spe').find('option').remove();
		$('#c_spe').find('select').append("<option value=''>请选择</option>");
		var pcat=$('#p_spe').find('option:selected').val();
		$.ajax({
			url:"/hg/index.php?s=/Home/Spebudget/get_c_spe",
			type:'post',
			data:{pid:pcat},
			datatype:'json',
			success:function(data){
				if (data) {
					$('#c_spe').show();
					$('#c_spe').find('option').remove();
					$('#c_spe').find('select').append("<option value=''>请选择</option>");
					for (var i = 0; i < data.length; i++) {
						$('#c_spe').find('select').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
					}
				}
			},
			error:function(data){
				alert('错误');
			},
		});

		$('#spebuyear').change(function(){
			$('#p_spe').find('option').remove();
			$('#p_spe').hide();
			var year=$('#spebuyear').find('option:selected').val();
			$.ajax({
				url:"/hg/index.php?s=/Home/Spebudget/get_p_spe",
				type:'post',
				data:{year:year},
				datatype:'json',
				success:function(data){
					if (data) {
						$('#p_spe').show();
						$('#p_spe').find('option').remove();
						$('#p_spe').append("<option value=''>请选择</option>");
						for (var i = 0; i < data.length; i++) {
							$('#p_spe').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
						}
					}
				},
				error:function(data){
					alert('错误');
				},
			});
		})

		$('#p_spe').change(function(){
			$('#c_spe').find('option').remove();
			$('#c_spe').hide();
			var pcat=$('#p_spe').find('option:selected').val();
			$.ajax({
				url:"/hg/index.php?s=/Home/Spebudget/get_c_spe",
				type:'post',
				data:{pid:pcat},
				datatype:'json',
				success:function(data){
					if (data) {
						$('#c_spe').show();
						$('#c_spe').find('option').remove();
						$('#c_spe').find('select').append("<option value=''>请选择</option>");
						for (var i = 0; i < data.length; i++) {
							$('#c_spe').find('select').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
						}
					}
				},
				error:function(data){
					alert('错误');
				},
			});
		})
	})
</script>
<form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Spebudget/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" action="/hg/index.php?s=/Home/Spebudget/index" onsubmit="return navTabSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					专项名称:<input type="text" name="name" value="<?php echo ($_POST['name']); ?>"/>
				</td>
				<td>
					<select class="combox" name="sectionid">
						<option value="">所有部门</option>
						<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['sectionid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td>年份：</td>
				<td>
					<select class="combox" name="year" id='spebuyear'>
						<?php if(is_array($pyear)): foreach($pyear as $key=>$vo): ?><option value="<?php echo ($vo["year"]); ?>" <?php if(($vo["year"]) == $_POST['year']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["year"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td>专项：</td>
				<td>
					<select class="" name="pspe" id='p_spe'>
						<option value="">请选择</option>
						<?php if(is_array($pspe)): foreach($pspe as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['pspe']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td id='c_spe'>
					<select name="cspe">
						<option value="">请选择</option>
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
			<li><a class="add" href="/hg/index.php?s=/Home/Spebudget/add" target="dialog" rel="Specialadd" width='700' height='400'><span>添加预算</span></a></li>
			<li><a class="delete" href="/hg/index.php?s=/Home/Spebudget/delete/id/{item_id}/navTabId/Spebudgetindex" target="ajaxTodo" title="确定要删除吗?"><span>删除专项</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Spebudget/edit/id/{item_id}" target="dialog" rel="Specialedit"><span>修改信息</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Spebudget/spelogdata/id/{item_id}" target="dialog" rel="Specialspelogdata" width='950' height='600'><span>查看详情</span></a></li>
			<li><a class="add" href="/hg/index.php?s=/Home/Spebudget/spebud_look" target="_blank"><span>查看专项单</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="114">
		<thead>
			<tr>
				<th width="40">ID</th>
				<th width="160">专项管理部门</th>
				<th>专项名称</th>
				<th width="100">专项核批年份</th>
				<th width="80">政府预算</th>
				<th width="80">初始定额</th>
				<th width="100">预算金额</th>
				<th width="100">剩余金额</th>
				<th width="100">已审核报销单</th>
				<th width="100">未审核报销单</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["sectionname"]); ?></td>
				<td><?php echo ($vo["specialname"]); ?></td>
				<td><?php echo ($vo["year"]); ?></td>
				<td><?php echo (showprocurement($vo["gov"])); ?></td>
				<td><?php echo ($vo["firstallmoney"]); ?></td>
				<td><?php echo ($vo["total"]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
				<td>
					<a class="add" href="/hg/index.php?s=/Home/Spebudget/getcheck/way/be_cvheck/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Spebudgetbe_cvheck" width="1000" height="550"><span style="color: blue"><?php echo ($vo["ched_amon"]); ?></span></a>
				</td>
				<td>
					<a class="add" href="/hg/index.php?s=/Home/Spebudget/getcheck/way/no_cvheck/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Spebudgetbe_cvheck" width="1000" height="550"><span style="color: red"><?php echo ($vo["noched_amon"]); ?></span></a>
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