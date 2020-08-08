<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
    .zautableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
    <form rel="pageForm" onsubmit="return navTabSearch(this);" action="/hg/index.php?s=/Home/Zhixingadmin/looktype2" method="post">
    <h4 style="margin-left:300px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">预算执行行政表按单位查询（单位：万元）</h4>
    <div style="width:1200px;margin-left:10px">
        <div>
            <div style="float:left">
                <p>填报年份:</p>
            </div>
            <div style="float:left">
                <select name="postyear">
                        <option value="">请选择年份</option>
                    <?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$year): $mod = ($i % 2 );++$i;?><option value="<?php echo ($year["year"]); ?>" <?php if(($year["year"]) == $_POST['postyear']): ?>selected='selected'<?php endif; ?>><?php echo ($year["year"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div>
            <div style="float:left;margin-left:20px;">
                <p>填报月份:</p>
            </div>
            <div style="float:left">
                <select name="postmonth" class="required">
                    <option value="1" <?php if(($_POST['postmonth']) == "1"): ?>selected='selected'<?php endif; ?>>1</option>
                    <option value="2" <?php if(($_POST['postmonth']) == "2"): ?>selected='selected'<?php endif; ?>>2</option>
                    <option value="3" <?php if(($_POST['postmonth']) == "3"): ?>selected='selected'<?php endif; ?>>3</option>
                    <option value="4" <?php if(($_POST['postmonth']) == "4"): ?>selected='selected'<?php endif; ?>>4</option>
                    <option value="5" <?php if(($_POST['postmonth']) == "5"): ?>selected='selected'<?php endif; ?>>5</option>
                    <option value="6" <?php if(($_POST['postmonth']) == "6"): ?>selected='selected'<?php endif; ?>>6</option>
                    <option value="7" <?php if(($_POST['postmonth']) == "7"): ?>selected='selected'<?php endif; ?>>7</option>
                    <option value="8" <?php if(($_POST['postmonth']) == "8"): ?>selected='selected'<?php endif; ?>>8</option>
                    <option value="9" <?php if(($_POST['postmonth']) == "9"): ?>selected='selected'<?php endif; ?>>9</option>
                    <option value="10" <?php if(($_POST['postmonth']) == "10"): ?>selected='selected'<?php endif; ?>>10</option>
                    <option value="11" <?php if(($_POST['postmonth']) == "11"): ?>selected='selected'<?php endif; ?>>11</option>
                    <option value="12" <?php if(($_POST['postmonth']) == "12"): ?>selected='selected'<?php endif; ?>>12</option>
                </select>
            </div>
        </div>
        <div>
            <div style="float:left">
                <p>查询科目:</p>
            </div>
            <div style="float:left">
                <select name="postnameid">
                    <?php if(is_array($adminname)): $i = 0; $__LIST__ = $adminname;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adminname): $mod = ($i % 2 );++$i;?><option value="<?php echo ($adminname["id"]); ?>" <?php if(($adminname["id"]) == $_POST['postnameid']): ?>selected='selected'<?php endif; ?>><?php echo ($adminname["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
    </form>

    <table width="900" border="1" style="border-collapse:collapse;margin-left:10px;clear:both">
        <tr>
            <td height="55" rowspan="2" align="center" valign="middle">单位</td>
            <td rowspan="2" align="center" valign="middle">全年收入预算</td>
            <td rowspan="2" align="center" valign="middle">全年支出预算</td>
            <td colspan="2" align="center" valign="middle">当期累计实际收入</td>
            <td colspan="2" align="center" valign="middle">当期累计实际支出</td>
            <td colspan="2" align="center" valign="middle">结转金额</td>
        </tr>
        <tr>
            <td align="center" valign="middle">金额</td>
            <td align="center" valign="middle">执行率</td>
            <td align="center" valign="middle">金额</td>
            <td align="center" valign="middle">执行率</td>
            <td align="center" valign="middle">期末结转</td>
            <td align="center" valign="middle">当期结转</td>
        </tr>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                <td width="90" height="25" valign="middle"><?php echo ($list["unitname"]); ?></td>
                <td width="90"><?php echo ($list["budget_yearin"]); ?></td>
                <td width="90"><?php echo ($list["budget_yearout"]); ?></td>
                <td width="90"><?php echo ($list["use_monthinadd"]); ?></td>
                <td width="90" class="changcolor"><?php echo ($list["inzhixinglv"]); ?></td>
                <td width="90"><?php echo ($list["use_monthout"]); ?></td>
                <td width="90" class="changcolor"><?php echo ($list["outzhixinglv"]); ?></td>
                <td width="90"><?php echo ($list["qimojiezhuan"]); ?></td>
                <td width="90"><?php echo ($list["dangqijiezhuan"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php if(is_array($adddata)): $i = 0; $__LIST__ = $adddata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adddata): $mod = ($i % 2 );++$i;?><tr>
                <td width="90" height="25" valign="middle"><?php echo ($adddata["unitname"]); ?></td>
                <td width="90"><?php echo ($adddata["budget_yearin"]); ?></td>
                <td width="90"><?php echo ($adddata["budget_yearout"]); ?></td>
                <td width="90"><?php echo ($adddata["use_monthinadd"]); ?></td>
                <td width="90" class="changcolor"><?php echo ($adddata["inzhixinglv"]); ?></td>
                <td width="90"><?php echo ($adddata["use_monthout"]); ?></td>
                <td width="90" class="changcolor"><?php echo ($adddata["outzhixinglv"]); ?></td>
                <td width="90"><?php echo ($adddata["qimojiezhuan"]); ?></td>
                <td width="90"><?php echo ($adddata["dangqijiezhuan"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>


</div>