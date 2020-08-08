<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
    .tableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
    <form rel="pageForm" onsubmit="return navTabSearch(this);" action="/hg/index.php?s=/Home/Zhixingshiye/look" method="post">
    <h4 style="margin-left:300px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">事业单位收入支出情况表（单位：万元）</h4>
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
    </div>
    <div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
    </form>
    <table width="1100" border="1" style="border-collapse:collapse;margin-left:10px;clear:both">
        <tr>
            <td width="70" rowspan="2" align="center" valign="middle">单位</td>
            <td height="20" colspan="3" align="center" valign="middle">上年结余</td>
            <td height="20" colspan="3" align="center" valign="middle">收入</td>
            <td height="20" colspan="3" align="center" valign="middle">支出</td>
            <td height="20" colspan="3" align="center" valign="middle">收支结余</td>
        </tr>
        <tr>
          <td width="70" align="center" valign="middle">合计</td>
            <td width="70" align="center" valign="middle">事业基金</td>
            <td width="70" height="20" align="center" valign="middle">专用基金</td>
            <td width="70" height="20" align="center" valign="middle">合计</td>
            <td width="70" height="20" align="center" valign="middle">事业收入</td>
            <td width="70" height="20" align="center" valign="middle">经营收入</td>
            <td width="70" height="20" align="center" valign="middle">合计</td>
            <td width="70" align="center" valign="middle">事业支出</td>
            <td width="70" align="center" valign="middle">经营支出</td>
            <td width="70" align="center" valign="middle">合计</td>
            <td width="70" align="center" valign="middle">事业结余</td>
            <td width="70" align="center" valign="middle">经营结余</td>
        </tr>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr class="changcolor">
                <td height="25"><?php echo ($data["sectionname"]); ?></td>
                <td height="25"><?php echo ($data["lastadd"]); ?></td>
                <td height="25"><?php echo ($data["lastshiye"]); ?></td>
                <td height="25"><?php echo ($data["lastzhuanyong"]); ?></td>
                <td height="25"><?php echo ($data["inadd"]); ?></td>
                <td height="25"><?php echo ($data["inshiye"]); ?></td >
                <td height="25"><?php echo ($data["injingying"]); ?></td>
                <td height="25"><?php echo ($data["outadd"]); ?></td>
                <td height="25"><?php echo ($data["outshiye"]); ?></td>
                <td height="25"><?php echo ($data["outjingying"]); ?></td>
                <td height="25"><?php echo ($data["inoutadd"]); ?></td>
                <td height="25"><?php echo ($data["inoutshiye"]); ?></td>
                <td height="25"><?php echo ($data["inoutjingying"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>