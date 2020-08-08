<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
    .zautableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
  <form rel="pageForm" onsubmit="return navTabSearch(this);" action="/hg/index.php?s=/Home/Zhixingwuxiang/looktype1" method="post">
    <h4 style="margin-left:300px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">"五项专用"按科目查询（单位：万元）</h4>
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
                <p>查询单位:</p>
            </div>
            <div style="float:left">
                <select name="postunitid">
                        <option value="all">全关区</option>
                    <?php if(is_array($unit)): $i = 0; $__LIST__ = $unit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$unit): $mod = ($i % 2 );++$i;?><option value="<?php echo ($unit["id"]); ?>" <?php if(($unit["id"]) == $_POST['postunitid']): ?>selected='selected'<?php endif; ?>><?php echo ($unit["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
    </form>

    <table width="1308" border="1" style="border-collapse:collapse;margin-left:10px;clear:both">
        <tr>
            <td width="120" height="55" rowspan="2" align="center" valign="middle">资金项目</td>
            <td colspan="3" align="center" valign="middle">全年控制额度</td>
            <td colspan="3" align="center" valign="middle">实际支出</td>
            <td colspan="3" align="center" valign="middle">执行率</td>
            <td colspan="3" align="center" valign="middle">期末余额</td>
        </tr>
        <tr>
          <td>财政</td>
          <td>非财政</td>
          <td>小计</td>
          <td width="70" align="center" valign="middle">财政</td>
          <td width="70" align="center" valign="middle">非财政</td>
          <td width="70" align="center" valign="middle">小计</td>
            <td width="70" align="center" valign="middle">财政</td>
            <td width="70" align="center" valign="middle">非财政</td>
            <td align="center" valign="middle">小计</td>
            <td width="70" align="center" valign="middle">财政</td>
            <td width="70" align="center" valign="middle">非财政</td>
            <td width="70" align="center" valign="middle">小计</td>
        </tr>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr height="25" valign="middle">
                <td width="70"><?php echo ($data["kemuname"]); ?></td>
                <td width="70"><?php echo ($data["budget_caizheng"]); ?></td>
                <td width="70"><?php echo ($data["budget_ncaizheng"]); ?></td>
                <td width="70"><?php echo ($data["budget_add"]); ?></td>
                <td width="70"><?php echo ($data["use_caizheng"]); ?></td>
                <td width="70"><?php echo ($data["use_ncaizheng"]); ?></td>
                <td width="70"><?php echo ($data["use_add"]); ?></td>
                <td width="70" class="changcolor"><?php echo ($data["lv_caizheng"]); ?></td>
                <td width="70" class="changcolor"><?php echo ($data["lv_ncaizheng"]); ?></td>
                <td width="70" class="changcolor"><?php echo ($data["lv_add"]); ?></td>
                <td width="70"><?php echo ($data["yu_caizheng"]); ?></td>
                <td width="70"><?php echo ($data["yu_ncaizheng"]); ?></td>
                <td width="70"><?php echo ($data["yu_add"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>