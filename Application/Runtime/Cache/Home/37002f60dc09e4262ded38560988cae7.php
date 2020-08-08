<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
	$(function(){
		$('#c_catrepch').find('option').remove();
		var pcat=$('#p_catrepch').find('option:selected').val();
		$.ajax({
			url:"/hg/index.php?s=/Home/Catbudget/get_c_cat",
			type:'post',
			data:{pid:pcat},
			datatype:'json',
			success:function(data){
				if (data) {
					$('#c_catrepch').show();
					$('#c_catrepch').find('option').remove();
					$('#c_catrepch').find('select').append("<option value=''>请选择</option>");
					for (var i = 0; i < data.length; i++) {
						$('#c_catrepch').find('select').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
					}
				}
			},
			error:function(data){
				alertMsg.error('错误');
			},
		});

		$('#p_catrepch').change(function(){
			$('#c_catrepch').find('option').remove();
			$('#c_catrepch').hide();
			var pcat=$('#p_catrepch').find('option:selected').val();
			$.ajax({
				url:"/hg/index.php?s=/Home/Catbudget/get_c_cat",
				type:'post',
				data:{pid:pcat},
				datatype:'json',
				success:function(data){
					if (data) {
						$('#c_catrepch').show();
						$('#c_catrepch').find('option').remove();
						$('#c_catrepch').find('select').append("<option value=''>请选择</option>");
						for (var i = 0; i < data.length; i++) {
							$('#c_catrepch').find('select').append("<option value="+data[i]["id"]+">"+data[i]["name"]+"</option>");
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
<form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Catbudget/report">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" action="/hg/index.php?s=/Home/Catbudget/report" onsubmit="return navTabSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					培训班名称：<input type="text" name="name" value="<?php echo ($_POST['name']); ?>"/>
				</td>
				<td>部门：</td>
				<td>
					<select class="combox" name="sectionid">
						<option value="">所有部门</option>
						<?php if(is_array($sectionlist)): foreach($sectionlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['sectionid']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td>包干：</td>
				<td>
					<select class="combox" name="pcat" id='p_catrepch'>
						<option value="">请选择</option>
						<?php if(is_array($pcat)): foreach($pcat as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_POST['pcat']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
				<td id='c_catrepch'>
					<select name="ccat">
						
					</select>
				</td>

				<td>财务账期：</td>
				<td>
					<select class="combox" name="termid">
						<?php if(is_array($termlist)): foreach($termlist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if(empty($_POST['termid'])): if(($vo["id"]) == $_SESSION['DFHGFf3456DJ']): ?>selected="selected"<?php endif; else: if(($vo["id"]) == $_POST['termid']): ?>selected="selected"<?php endif; endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
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
			<li><a class="add" href="/hg/index.php?s=/Home/Catbudget/view/id/{item_id}" target="dialog" rel="Catbudgetview" width="850" height="550"><span>详情查看</span></a></li>
			<li><a class="edit" href="/hg/index.php?s=/Home/Catbudget/get_cailv"  target="navtab" rel="Catbudgetget_cailv"><span>查看差旅单</span></a></li>
			<li><a class="add" href="/hg/index.php?s=/Home/Catbudget/catbud_look" target="_blank"><span>查看包干详情</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="85">
		<thead>
			<tr>
				<th width="120">部门</th>
				<th>科目</th>
				<th width="100">期初定额</th>
				<th width="100">调整</th>
				<th width="100">已用</th>
				<th width="100">结余</th>
				<th width="100">已审核报销单</th>
				<th width="100">未审核报销单</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
				<td><?php echo ($vo["sectionname"]); ?></td>
				<td><?php echo ($vo["categoryname"]); ?></td>
				<td><?php echo ($vo["first"]); ?></td>
				<td><?php echo ($vo["adjustment"]); ?></td>
				<td><?php echo ($vo["used"]); ?></td>
				<td><?php echo ($vo["money"]); ?></td>
				<td>
					<a class="add" href="/hg/index.php?s=/Home/Catbudget/getcheck/way/be_cvheck/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Catbudgetbe_cvheck" width="1000" height="550"><span style="color: blue"><?php echo ($vo["ched_amon"]); ?></span></a>
				</td>
				<td>
					<a class="add" href="/hg/index.php?s=/Home/Catbudget/getcheck/way/no_cvheck/id/<?php echo ($vo["id"]); ?>" target="dialog" rel="Catbudgetbe_cvheck" width="1000" height="550"><span style="color: red"><?php echo ($vo["noched_amon"]); ?></span></a>
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