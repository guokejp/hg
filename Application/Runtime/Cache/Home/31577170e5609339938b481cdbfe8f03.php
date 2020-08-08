<?php if (!defined('THINK_PATH')) exit();?><script>
function zshegetadd(){
    var input1=Number($('#zshe'+1).val());
    var input3=Number($('#zshe'+3).val());
    var input4=Number($('#zshe'+4).val());
    var input6=Number($('#zshe'+6).val());
    var input7=Number($('#zshe'+7).val());
    $('#zshe'+2).html((input3+input4).toFixed(2));
    $('#zshe'+5).html((input6+input7).toFixed(2));
    $('#zshe'+8).html((input1+input3+input4-input6-input7).toFixed(2));
}
</script>
<style type="text/css">
    .tableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
    <form method="post" autocomplete="off" action="/hg/index.php?s=/Home/Zhixingshetuan/useaddinsert/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <h4 style="margin-left:300px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">事业单位收入支出情况表（单位：万元）</h4>
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
    <table width="1000" border="1" style="border-collapse:collapse;margin-left:10px;clear:both">
        <tr>
            <td width="70" rowspan="2" align="center" valign="middle">上年结余</td>
            <td height="20" colspan="3" align="center" valign="middle">收入</td>
            <td height="20" colspan="3" align="center" valign="middle">支出</td>
            <td width="70" rowspan="2" align="center" valign="middle">本年结余</td>
        </tr>
        <tr>
          <td width="70" height="20" align="center" valign="middle">合计</td>
            <td width="70" height="20" align="center" valign="middle">会费收入</td>
            <td width="70" height="20" align="center" valign="middle">业务收入</td>
            <td width="70" height="20" align="center" valign="middle">合计</td>
            <td width="70" align="center" valign="middle">业务支出</td>
            <td width="70" align="center" valign="middle">管理费用</td>
        </tr>
        <tr class="changcolor">
            <td height="28">
                <input type="text" name="aa[lastadd]" class="number tableinput" id="zshe1" onkeyup="zshegetadd()">
            </td>
            <td id="zshe2">
               &nbsp
            </td>
            <td>
                <input type="text" name="aa[inhuifei]" class="number tableinput" id="zshe3" onkeyup="zshegetadd()">
            </td >
            <td>
                <input type="text" name="aa[inyewu]" class="number tableinput" id="zshe4" onkeyup="zshegetadd()">
            </td>
            <td id="zshe5">
                &nbsp
            </td>
            <td>
                <input type="text" name="aa[outyewu]" class="number tableinput" id="zshe6" onkeyup="zshegetadd()">
            </td>
            <td>
                <input type="text" name="aa[outguanli]" class="number tableinput" id="zshe7" onkeyup="zshegetadd()">
            </td>
            <td id="zshe8">
                &nbsp
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