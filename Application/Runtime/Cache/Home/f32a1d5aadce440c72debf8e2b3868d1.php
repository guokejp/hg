<?php if (!defined('THINK_PATH')) exit();?><script>
function zwbgetadd($a){
    var input5=Number($('#zwb'+$a+5).val());
    var input6=Number($('#zwb'+$a+6).val());
    var input7=Number($('#zwb'+$a+7).val());
    var input8=Number($('#zwb'+$a+8).val());
    var input10=Number($('#zwb'+$a+10).val());
    var input11=Number($('#zwb'+$a+11).val());
    var input13=Number($('#zwb'+$a+13).val());
    var input14=Number($('#zwb'+$a+14).val());
    $('#zwb'+$a+2).val((input5+input6+input7+input8+input13+input14).toFixed(2));
    $('#zwb'+$a+3).val((input5+input6+input7+input8+input10+input11).toFixed(2));
    $('#zwb'+$a+4).val((input5+input6+input7+input8).toFixed(2));
    $('#zwb'+$a+9).val((input10+input11).toFixed(2));
    $('#zwb'+$a+12).val((input13+input14).toFixed(2));
}
</script>
<style type="text/css">
    .tableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
    <form method="post" autocomplete="off" action="/hg/index.php?s=/Home/Zhixingwuxiang/budgetaddinsert/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <h4 style="margin-left:300px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">“五项费用”控制额度录入表（单位：万元）</h4>
    <div style="width:1200px;margin-left:10px">
        <div>
            <div style="float:left">
                <p>填报年份:</p>
            </div>
            <div style="float:left">
                <input style="width:50px" class="required digits input1" type="text" name="year" value=<?php echo date("Y");?>>
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
                <input type="text" name="aa[0]" class="number tableinput" id="zwba2" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[1]" class="number tableinput" id="zwba3" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[2]" class="number tableinput" id="zwba4" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[3]" class="number tableinput" id="zwba5" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[4]" class="number tableinput" id="zwba6" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[5]" class="number tableinput" id="zwba7" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[6]" class="number tableinput" id="zwba8" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[7]" class="number tableinput" id="zwba9" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[8]" class="number tableinput" id="zwba10" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[9]" class="number tableinput" id="zwba11" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[10]" class="number tableinput" id="zwba12" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[11]" class="number tableinput" id="zwba13" onkeyup="zwbgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[12]" class="number tableinput" id="zwba14" onkeyup="zwbgetadd('a')">
            </td>
        </tr>
        <tr>
            <td height="28">公务接待费</td>
            <td>
                <input type="text" name="bb[0]" class="number tableinput" id="zwbb2" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[1]" class="number tableinput" id="zwbb3" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[2]" class="number tableinput" id="zwbb4" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[3]" class="number tableinput" id="zwbb5" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[4]" class="number tableinput" id="zwbb6" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[5]" class="number tableinput" id="zwbb7" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[6]" class="number tableinput" id="zwbb8" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[7]" class="number tableinput" id="zwbb9" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[8]" class="number tableinput" id="zwbb10" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[9]" class="number tableinput" id="zwbb11" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[10]" class="number tableinput" id="zwbb12" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[11]" class="number tableinput" id="zwbb13" onkeyup="zwbgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[12]" class="number tableinput" id="zwbb14" onkeyup="zwbgetadd('b')">
            </td>
        </tr>
        <tr class="changcolor">
            <td height="28">因公出国费</td>
            <td>
                <input type="text" name="cc[0]" class="number tableinput" id="zwbc2" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[1]" class="number tableinput" id="zwbc3" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[2]" class="number tableinput" id="zwbc4" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[3]" class="number tableinput" id="zwbc5" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[4]" class="number tableinput" id="zwbc6" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[5]" class="number tableinput" id="zwbc7" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[6]" class="number tableinput" id="zwbc8" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[7]" class="number tableinput" id="zwbc9" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[8]" class="number tableinput" id="zwbc10" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[9]" class="number tableinput" id="zwbc11" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[10]" class="number tableinput" id="zwbc12" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[11]" class="number tableinput" id="zwbc13" onkeyup="zwbgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[12]" class="number tableinput" id="zwbc14" onkeyup="zwbgetadd('c')">
            </td>
        </tr>
        <tr>
            <td height="28">培训费</td>
            <td>
                <input type="text" name="dd[0]" class="number tableinput" id="zwbd2" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[1]" class="number tableinput" id="zwbd3" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[2]" class="number tableinput" id="zwbd4" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[3]" class="number tableinput" id="zwbd5" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[4]" class="number tableinput" id="zwbd6" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[5]" class="number tableinput" id="zwbd7" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[6]" class="number tableinput" id="zwbd8" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[7]" class="number tableinput" id="zwbd9" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[8]" class="number tableinput" id="zwbd10" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[9]" class="number tableinput" id="zwbd11" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[10]" class="number tableinput" id="zwbd12" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[11]" class="number tableinput" id="zwbd13" onkeyup="zwbgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[12]" class="number tableinput" id="zwbd14" onkeyup="zwbgetadd('d')">
            </td>
        </tr>
        <tr class="changcolor">
            <td height="28">会议费</td>
            <td>
                <input type="text" name="ee[0]" class="number tableinput" id="zwbe2" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[1]" class="number tableinput" id="zwbe3" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[2]" class="number tableinput" id="zwbe4" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[3]" class="number tableinput" id="zwbe5" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[4]" class="number tableinput" id="zwbe6" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[5]" class="number tableinput" id="zwbe7" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[6]" class="number tableinput" id="zwbe8" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[7]" class="number tableinput" id="zwbe9" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[8]" class="number tableinput" id="zwbe10" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[9]" class="number tableinput" id="zwbe11" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[10]" class="number tableinput" id="zwbe12" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[11]" class="number tableinput" id="zwbe13" onkeyup="zwbgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[12]" class="number tableinput" id="zwbe14" onkeyup="zwbgetadd('e')">
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