<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="/hg/index.php?s=/Home/Wageshg/index">
	<input type="hidden" name="status" value="${param.status}">
	<input type="hidden" name="keywords" value="${param.keywords}" />
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
	<input type="hidden" name="orderField" value="${param.orderField}" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="/hg/index.php?s=/Home/Wageshg/index" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
		<div class="searchBar">
			<table class="searchContent">
				<tr>
				<td>
					<p>
						<label>工资月份：</label>
						<select name="year" class="required">
							<?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$year): $mod = ($i % 2 );++$i;?><option value="<?php echo ($year["year"]); ?>" <?php if(($year["year"]) == $_POST['year']): ?>selected='selected'<?php endif; ?>><?php echo ($year["year"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						
					</p>
				</td>
				<td>
					<P>
						姓名:
						<input type="text" name="name" class="textInput readonly" value="<?php echo ($_POST['name']); ?>">
					</P>
				</td>
				<td>
					<p>
					<label>部门：</label>
					<select name="section" class="required">
					<option value="">所有部门</option>
						<?php if(is_array($sectionlist)): $i = 0; $__LIST__ = $sectionlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($i % 2 );++$i;?><option value="<?php echo ($section["section"]); ?>" <?php if(($section["section"]) == $_POST['section']): ?>selected='selected'<?php endif; ?>><?php echo ($section["section"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					
					</p>
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
			<li class=""><a class="edit" href="<?php echo U('Wageshg/insert');?>" target="dwzImport" targettype="navTab" title="实要导出这些记录吗?"><span>导入工资</span></a></li>
			<li class="line">line</li>
			<li><a class="add" href="<?php echo U('Wageshg/make',array('navTabId'=>'Wageshgindex'));?>" target="ajaxTodo" title="确定要生成本月工资吗?"><span>生成本月工资</span></a></li>
			<li class="line">line</li>
			<li class="line">line</li>
			<li><a class="add" href="<?php echo U('Wageshg/add');?>"  width="900" height="550" target="dialog"><span>添加工资</span></a></li>
			<li><a class="edit" href="<?php echo U('Wageshg/edit',array('id'=>'{itemid}'));?>"  width="900" height="520" target="dialog"><span>修改工资</span></a></li>
			<li><a class="delete"  href="/hg/index.php?s=/Home/Wageshg/delete/id/{itemid}/navTabId/Wageshgindex" target="ajaxTodo" title="确定删除这项工资吗?"><span>删除工资</span></a></li>
			<li class="line">line</li>
			<li class="line">line</li>
			<li class=""><a class="delete" href="<?php echo U('Wageshg/expUser');?>" target="dwzExport" targettype="navTab" title="实要导出这些记录吗?"><span>导出本月工资单</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>
	
	<table class="table" width="250%" layoutH="82">
		<thead>
			<tr align="center">
				<th style="width:2%;text-align:center">ID</th>
				<th style="width:3%;text-align:center">序号</th>
				<th style="width:3%;text-align:center">部门</th>
				<th style="width:3%;text-align:center">姓名</th>
				<th style="width:5%;text-align:center">卡号</th>
				<th style="width:3%;text-align:center">职务工资</th>
				<th style="width:3%;text-align:center">级别工资</th>
				<th style="width:3%;text-align:center">工作性补贴</th>							
				<th style="width:3%;text-align:center">生活补贴</th>
				<th style="width:3%;text-align:center">海关津贴</th>	
				<th style="width:3%;text-align:center">审计人员补贴</th>
				<th style="width:3%;text-align:center">机要保密津贴</th>
				<th style="width:3%;text-align:center">生活、电话补贴</th>							
				<th style="width:3%;text-align:center">移动通信补贴</th>
				<th style="width:3%;text-align:center">公务电话费</th>
				<th style="width:3%;text-align:center">独生子女费</th>
				<th style="width:3%;text-align:center">应发合计</th>
				<th style="width:3%;text-align:center">所得税扣除医疗保险</th>							
				<th style="width:3%;text-align:center">所得税扣除公积金</th>
				<th style="width:3%;text-align:center">所得税扣除独生子女费</th>
				<th style="width:3%;text-align:center">所得税扣除移动电话座机费</th>
				<th style="width:3%;text-align:center">所得税扣除其他扣款</th>	
				<th style="width:3%;text-align:center">应缴税所得额</th>	
				<th style="width:3%;text-align:center">个人所得税</th>	
				<th style="width:3%;text-align:center">房租</th>
				<th style="width:3%;text-align:center">应扣合计</th>
				<th style="width:3%;text-align:center">实发数</th>	
				<th style="width:5%;text-align:center">时间</th>					
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr target="itemid" rel="<?php echo ($list["id"]); ?>" align="center">
					<td style="widtd:2%;text-align:center"><?php echo ($list["id"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["num"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["section"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["name"]); ?></td>
					<td style="widtd:5%;text-align:center"><?php echo ($list["card"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["job_wages"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["level_wages"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["job_subsidies"]); ?></td>							
					<td style="widtd:3%;text-align:center"><?php echo ($list["life_subsidies"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["haiguan_subsidies"]); ?></td>	
					<td style="widtd:3%;text-align:center"><?php echo ($list["audit_subsidies"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["secret_subsidies"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["lifephone_subsidies"]); ?></td>	
					<td style="widtd:3%;text-align:center"><?php echo ($list["phone_subsidies"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["officialphone"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["onechild"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["giveadd"]); ?></td>							
					<td style="widtd:3%;text-align:center"><?php echo ($list["de_medicalinsurance"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["de_gongjijing"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["de_onechild"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["de_phone"]); ?></td>	
					<td style="widtd:3%;text-align:center"><?php echo ($list["de_other"]); ?></td>	
					<td style="widtd:3%;text-align:center"><?php echo ($list["de_taxadd"]); ?></td>	
					<td style="widtd:3%;text-align:center"><?php echo ($list["individualtax"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["rent"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["deduct_add"]); ?></td>
					<td style="widtd:3%;text-align:center"><?php echo ($list["wages"]); ?></td>
					<td style="widtd:5%;text-align:center"><?php echo ($list["year"]); ?></td>						
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<!--	<div class="panelBar">
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

	</div>-->
</div>