<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
    .zabtableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
    <form method="post" autocomplete="off" action="/hg/index.php?s=/Home/Zhixingadmin/budgetsave/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <h4 style="margin-left:300px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">预算修改表—行政（单位：万元）</h4>
    <div style="width:1200px;margin-left:10px">
        <div>
            <div style="float:left">
                <p>填报年份:<b><?php echo ($overlookdata["year"]); ?></b></p>
            </div>
        </div>
        <div style="margin-left:30px;float:left">
            <div style="float:left">
                <p>填报单位:<b><?php echo session(C('ADMIN_AUTH_UNITNAME'));?></b></p>
            </div>
        </div>
    </div>
    <table width="1000" border="1" style="border-collapse:collapse;margin-left:10px;clear:both">
        <tr>
            <td width='250' height="60" rowspan="3" align="center" valign="middle">资金科目</td>
            <td colspan="4" align="center" valign="middle">收入预算</td>
            <td colspan="3" align="center" valign="middle">支出预算</td>
        </tr>
        <tr>
            <td colspan="2" align="center" valign="middle">上年结转</td>
            <td colspan="2" align="center" valign="middle">当年收入预算</td>
            <td colspan="2" align="center" valign="middle">结转资金支出预算</td>
            <td width='65' align="center" valign="middle">当年收入支出预算</td>
        </tr>
        <tr>
            <td width='65' align="center" valign="middle">小计</td>
            <td width='65' align="center" valign="middle">其中：两年前形成的结转</td>
            <td width='65' align="center" valign="middle">二下数</td>
            <td width='65' align="center" valign="middle">调整数</td>
            <td width='65' align="center" valign="middle">小计</td>
            <td width='65' align="center" valign="middle">其中：两年前形成的结转</td>
            <td align="center" valign="middle">&nbsp;</td>
        </tr>
        
        <input type="hidden" name="overlook_id" value="<?php echo ($overlookdata["id"]); ?>">
        <?php if(is_array($moneydata)): $i = 0; $__LIST__ = $moneydata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$money): $mod = ($i % 2 );++$i;?><input type="hidden" name="aa[<?php echo ($money["name_id"]); ?>][overlook_id]" value="<?php echo ($overlookdata["id"]); ?>">
            <input type="hidden" name="aa[<?php echo ($money["name_id"]); ?>][name_id]" value="<?php echo ($money["name_id"]); ?>">
            <tr>
                <td height="25"><?php echo ($money["name"]); ?></td>
                <td>
                    <input type="text" class="number zabtableinput" name="aa[<?php echo ($money["name_id"]); ?>][inlastadd]" value="<?php echo ($money["inlastadd"]); ?>">
                </td>
                <td>
                    <input type="text" class="number zabtableinput" name="aa[<?php echo ($money["name_id"]); ?>][intwolastadd]" value="<?php echo ($money["intwolastadd"]); ?>">
                </td>
                <td>
                    <input type="text" class="number zabtableinput" name="aa[<?php echo ($money["name_id"]); ?>][inthiserxia]" value="<?php echo ($money["inthiserxia"]); ?>">
                </td>
                <td>
                    <input type="text" class="number zabtableinput" name="aa[<?php echo ($money["name_id"]); ?>][inthistiaozheng]" value="<?php echo ($money["inthistiaozheng"]); ?>">
                </td>
                <td>
                    <input type="text" class="number zabtableinput" name="aa[<?php echo ($money["name_id"]); ?>][outjiezhuanadd]" value="<?php echo ($money["outjiezhuanadd"]); ?>">
                </td>
                <td>
                    <input type="text" class="number zabtableinput" name="aa[<?php echo ($money["name_id"]); ?>][outjiezhuantwolast]" value="<?php echo ($money["outjiezhuantwolast"]); ?>">
                </td>
                <td>
                    <input type="text" class="number zabtableinput" name="aa[<?php echo ($money["name_id"]); ?>][outthisinoutbudget]" value="<?php echo ($money["outthisinoutbudget"]); ?>">
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        
        
       
    </table>
    
    <div class="formBar">
<ul style="float:left;margin-left:960px;">
            <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
            <li><div class="button"><div class="buttonContent"><button type="button" class="close">关闭</button></div></div></li>
      </ul>
    </div>
    </form>
</div>