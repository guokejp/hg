<?php if (!defined('THINK_PATH')) exit();?><script>
function zwugetadd($a){
    var input5=Number($('#zwu'+$a+5).val());
    var input6=Number($('#zwu'+$a+6).val());
    var input7=Number($('#zwu'+$a+7).val());
    var input8=Number($('#zwu'+$a+8).val());
    var input10=Number($('#zwu'+$a+10).val());
    var input11=Number($('#zwu'+$a+11).val());
    var input13=Number($('#zwu'+$a+13).val());
    var input14=Number($('#zwu'+$a+14).val());
    $('#zwu'+$a+2).val((input5+input6+input7+input8+input13+input14).toFixed(2));
    $('#zwu'+$a+3).val((input5+input6+input7+input8+input10+input11).toFixed(2));
    $('#zwu'+$a+4).val((input5+input6+input7+input8).toFixed(2));
    $('#zwu'+$a+9).val((input10+input11).toFixed(2));
    $('#zwu'+$a+12).val((input13+input14).toFixed(2));
}
</script>
<style type="text/css">
    .tableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
    <form method="post" autocomplete="off" action="/hg/index.php?s=/Home/Zhixingwuxiang/useaddinsert/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <h4 style="margin-left:300px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">“五项费用”支出录入表（单位：万元）</h4>
    <div style="width:1200px;margin-left:10px">
       <div>
            <div style="float:left">
                <p>填报年份:</p>
            </div>
            <div style="float:left">
                <select name="year">
                    <?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$year): $mod = ($i % 2 );++$i;?><option value="<?php echo ($year["year"]); ?>"><?php echo ($year["year"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div>
            <div style="float:left;margin-left:20px;">
                <p>填报月份:</p>
            </div>
            <div style="float:left">
                <select name="month" class="required">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
        </div>
        <div style="margin-left:30px;float:left">
            <div style="float:left">
                <p>填报单位:<b><?php echo session(C('ADMIN_AUTH_UNITNAME'));?></b></p>
            </div>
        </div>
    </div>
    <table width="1270" border="1" style="border-collapse:collapse;margin-left:10px;clear:both">
        <tr>
            <td width="90" rowspan="4" align="center" valign="middle">项目</td>
            <td height="19" colspan="13" align="center" valign="middle">控制额度数</td>
        </tr>
        <tr>
            <td width="70" rowspan="3" align="center" valign="middle">总合计</td>
            <td height="20" colspan="9" align="center" valign="middle">控制套帐</td>
            <td colspan="3" align="center" valign="middle">地方套帐</td>
        </tr>
        <tr>
            <td width="70" rowspan="2">经费套帐合计</td>
            <td height="20" colspan="5" align="center" valign="middle">财政</td>
            <td colspan="3" align="center" valign="middle">非财政</td>
            <td width="70" rowspan="2">地方套帐支出合计</td>
            <td width="70" rowspan="2">地方</td>
            <td width="70" rowspan="2">转移支付</td>
        </tr>
        <tr>
            <td width="70" height="20" align="center" valign="middle">小计</td>
            <td width="70" align="center" valign="middle">行政运行</td>
            <td width="70">缉私办案</td>
            <td width="70">收费业务</td>
            <td width="70">其它</td>
            <td width="70">小计</td>
            <td width="70">其它收支</td>
            <td width="70">地方专项</td>
        </tr>
        
        <tr class="changcolor">
            <td height="28">公务车运行维护费</td>
            <td>
                <input type="text" name="aa[0]" class="number tableinput" id="zwua2" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[1]" class="number tableinput" id="zwua3" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[2]" class="number tableinput" id="zwua4" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[3]" class="number tableinput" id="zwua5" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[4]" class="number tableinput" id="zwua6" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[5]" class="number tableinput" id="zwua7" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[6]" class="number tableinput" id="zwua8" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[7]" class="number tableinput" id="zwua9" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[8]" class="number tableinput" id="zwua10" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[9]" class="number tableinput" id="zwua11" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[10]" class="number tableinput" id="zwua12" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[11]" class="number tableinput" id="zwua13" onkeyup="zwugetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[12]" class="number tableinput" id="zwua14" onkeyup="zwugetadd('a')">
            </td>
        </tr>
        <tr>
            <td height="28">公务接待费</td>
            <td>
                <input type="text" name="bb[0]" class="number tableinput" id="zwub2" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[1]" class="number tableinput" id="zwub3" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[2]" class="number tableinput" id="zwub4" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[3]" class="number tableinput" id="zwub5" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[4]" class="number tableinput" id="zwub6" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[5]" class="number tableinput" id="zwub7" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[6]" class="number tableinput" id="zwub8" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[7]" class="number tableinput" id="zwub9" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[8]" class="number tableinput" id="zwub10" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[9]" class="number tableinput" id="zwub11" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[10]" class="number tableinput" id="zwub12" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[11]" class="number tableinput" id="zwub13" onkeyup="zwugetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[12]" class="number tableinput" id="zwub14" onkeyup="zwugetadd('b')">
            </td>
        </tr>
        <tr class="changcolor">
            <td height="28">因公出国费</td>
            <td>
                <input type="text" name="cc[0]" class="number tableinput" id="zwuc2" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[1]" class="number tableinput" id="zwuc3" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[2]" class="number tableinput" id="zwuc4" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[3]" class="number tableinput" id="zwuc5" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[4]" class="number tableinput" id="zwuc6" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[5]" class="number tableinput" id="zwuc7" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[6]" class="number tableinput" id="zwuc8" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[7]" class="number tableinput" id="zwuc9" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[8]" class="number tableinput" id="zwuc10" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[9]" class="number tableinput" id="zwuc11" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[10]" class="number tableinput" id="zwuc12" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[11]" class="number tableinput" id="zwuc13" onkeyup="zwugetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[12]" class="number tableinput" id="zwuc14" onkeyup="zwugetadd('c')">
            </td>
        </tr>
        <tr>
            <td height="28">培训费</td>
            <td>
                <input type="text" name="dd[0]" class="number tableinput" id="zwud2" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[1]" class="number tableinput" id="zwud3" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[2]" class="number tableinput" id="zwud4" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[3]" class="number tableinput" id="zwud5" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[4]" class="number tableinput" id="zwud6" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[5]" class="number tableinput" id="zwud7" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[6]" class="number tableinput" id="zwud8" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[7]" class="number tableinput" id="zwud9" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[8]" class="number tableinput" id="zwud10" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[9]" class="number tableinput" id="zwud11" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[10]" class="number tableinput" id="zwud12" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[11]" class="number tableinput" id="zwud13" onkeyup="zwugetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[12]" class="number tableinput" id="zwud14" onkeyup="zwugetadd('d')">
            </td>
        </tr>
        <tr class="changcolor">
            <td height="28">会议费</td>
            <td>
                <input type="text" name="ee[0]" class="number tableinput" id="zwue2" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[1]" class="number tableinput" id="zwue3" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[2]" class="number tableinput" id="zwue4" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[3]" class="number tableinput" id="zwue5" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[4]" class="number tableinput" id="zwue6" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[5]" class="number tableinput" id="zwue7" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[6]" class="number tableinput" id="zwue8" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[7]" class="number tableinput" id="zwue9" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[8]" class="number tableinput" id="zwue10" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[9]" class="number tableinput" id="zwue11" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[10]" class="number tableinput" id="zwue12" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[11]" class="number tableinput" id="zwue13" onkeyup="zwugetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[12]" class="number tableinput" id="zwue14" onkeyup="zwugetadd('e')">
            </td>
        </tr>
    </table>
    <div class="formBar">
        <ul style="float:left;margin-left:970px;">
            <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
            <li><div class="button"><div class="buttonContent"><button type="button" class="close">关闭</button></div></div></li>
        </ul>
    </div>
    </form>
</div>