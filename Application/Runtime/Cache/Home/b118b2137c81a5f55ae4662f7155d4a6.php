<?php if (!defined('THINK_PATH')) exit();?><script>
function zqigetadd(){
    var input2=Number($('#zqi'+2).val());
    var input3=Number($('#zqi'+3).val());
    var input4=Number($('#zqi'+4).val());
    var input5=Number($('#zqi'+5).val());
    var input7=Number($('#zqi'+7).val());
    var input8=Number($('#zqi'+8).val());
    var input10=Number($('#zqi'+10).val());
    var input11=Number($('#zqi'+11).val());
    $('#zqi'+1).html((input2+input3+input4+input5).toFixed(2));
    $('#zqi'+6).html((input7+input8).toFixed(2));
    $('#zqi'+9).html((input10+input11).toFixed(2));
    $('#zqi'+13).html((input7-input10).toFixed(2));
    $('#zqi'+14).html((input8-input11).toFixed(2));
    $('#zqi'+12).html((input7+input8-input10-input11).toFixed(2));
}
</script>
<style type="text/css">
    .tableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
    <form method="post" autocomplete="off" action="/hg/index.php?s=/Home/Zhixingqiye/useaddinsert/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <h4 style="margin-left:300px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">经济实体收入支出情况表（单位：万元）</h4>
    <div style="width:1200px;margin-left:10px">
       <div>
            <div style="float:left">
                <p>填报年份:</p>
            </div>
            <div style="float:left">
                <input style="width:50px" class="required digits input1" minlength="4" maxlength="4" type="text" name="year" value=<?php echo date("Y");?>>
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
                <p>填报单位</p>
            </div>
            <div style="float:left">
                <select name="sectionname">
                    <option value="服务中心">服务中心</option>
                    <option value="数据分中心">数据分中心</option>
                </select>
            </div>
        </div>
    </div>
    <table width="1300" border="1" style="border-collapse:collapse;margin-left:10px;clear:both">
        <tr>
          <td height="20" colspan="5" align="center" valign="middle">上年所有者权益</td>
            <td height="20" colspan="3" align="center" valign="middle">收入</td>
            <td height="20" colspan="3" align="center" valign="middle">支出</td>
            <td height="20" colspan="3" align="center" valign="middle">收支结余</td>
        </tr>
        <tr>
          <td width="70" align="center" valign="middle">合计</td>
          <td width="70" align="center" valign="middle">实收资本</td>
          <td width="70" align="center" valign="middle">资本公积</td>
            <td width="70" align="center" valign="middle">盈余公积</td>
            <td width="70" height="20" align="center" valign="middle">未分配利润</td>
            <td width="70" height="20" align="center" valign="middle">合计</td>
            <td width="70" height="20" align="center" valign="middle">主营业务收入</td>
            <td width="70" height="20" align="center" valign="middle">其它业务收入</td>
            <td width="70" height="20" align="center" valign="middle">合计</td>
            <td width="70" align="center" valign="middle">主营业务支出</td>
            <td width="70" align="center" valign="middle">其它业务支出</td>
            <td width="70" align="center" valign="middle">合计</td>
            <td width="70" align="center" valign="middle">主营业务结余</td>
            <td width="70" align="center" valign="middle">其它业务结余</td>
        </tr>
        <tr class="changcolor">
            <td height="25" id="zqi1" >&nbsp;</td>
            <td>
                <input type="text" name="aa[lastshishou]" class="number tableinput" id="zqi2" onkeyup="zqigetadd()">
            </td>
            <td>
                <input type="text" name="aa[lastgongji]" class="number tableinput" id="zqi3" onkeyup="zqigetadd()">
            </td>
            <td>
                <input type="text" name="aa[lastyingyu]" class="number tableinput" id="zqi4" onkeyup="zqigetadd()">
            </td>
            <td>
                <input type="text" name="aa[lastwei]" class="number tableinput" id="zqi5" onkeyup="zqigetadd()">
            </td>
            <td id="zqi6">&nbsp;</td>
            <td>
                <input type="text" name="aa[inzhuying]" class="number tableinput" id="zqi7" onkeyup="zqigetadd()">
            </td >
            <td>
                <input type="text" name="aa[inother]" class="number tableinput" id="zqi8" onkeyup="zqigetadd()">
            </td>
            <td id="zqi9">&nbsp;</td>
            <td>
                <input type="text" name="aa[outzhuying]" class="number tableinput" id="zqi10" onkeyup="zqigetadd()">
            </td>
            <td>
                <input type="text" name="aa[outother]" class="number tableinput" id="zqi11" onkeyup="zqigetadd()">
            </td>
            <td id="zqi12">&nbsp;</td>
            <td id="zqi13">&nbsp;</td>
            <td id="zqi14">&nbsp;</td>
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