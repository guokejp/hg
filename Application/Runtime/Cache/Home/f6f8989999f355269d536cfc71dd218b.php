<?php if (!defined('THINK_PATH')) exit();?><script>
function zabgetadd($a){
    var input5=Number($('#zab'+$a+5).val());
    var input6=Number($('#zab'+$a+6).val());
    var input8=Number($('#zab'+$a+8).val());
    var input9=Number($('#zab'+$a+9).val());
    var input11=Number($('#zab'+$a+11).val());
    var input12=Number($('#zab'+$a+12).val());
    var input13=Number($('#zab'+$a+13).val());
    $('#zab'+$a+4).val((input5+input8+input9).toFixed(2));
    $('#zab'+$a+7).val((input8+input9).toFixed(2));
    $('#zab'+$a+10).val((input11+input13).toFixed(2));
}
$(".zabtableinput").keyup(function() {
    var la5=Number($('#zaba5').val());
    var la6=Number($('#zaba6').val());
    var la8=Number($('#zaba8').val());
    var la9=Number($('#zaba9').val());
    var la11=Number($('#zaba11').val());
    var la12=Number($('#zaba12').val());
    var la13=Number($('#zaba13').val());
    var la7=Number(la8+la9);
    var la4=Number(la5+la8+la9);
    var la10=Number(la11+la13);  

    var lb5=Number($('#zabb5').val());
    var lb6=Number($('#zabb6').val());
    var lb8=Number($('#zabb8').val());
    var lb9=Number($('#zabb9').val());
    var lb11=Number($('#zabb11').val());
    var lb12=Number($('#zabb12').val());
    var lb13=Number($('#zabb13').val());
    var lb7=Number(lb8+lb9);
    var lb4=Number(lb5+lb8+lb9);
    var lb10=Number(lb11+lb13);  

    var lc5=Number($('#zabc5').val());
    var lc6=Number($('#zabc6').val());
    var lc8=Number($('#zabc8').val());
    var lc9=Number($('#zabc9').val());
    var lc11=Number($('#zabc11').val());
    var lc12=Number($('#zabc12').val());
    var lc13=Number($('#zabc13').val());
    var lc7=Number(lc8+lc9);
    var lc4=Number(lc5+lc8+lc9);
    var lc10=Number(lc11+lc13);

    var ld5=Number($('#zabd5').val());
    var ld6=Number($('#zabd6').val());
    var ld8=Number($('#zabd8').val());
    var ld9=Number($('#zabd9').val());
    var ld11=Number($('#zabd11').val());
    var ld12=Number($('#zabd12').val());
    var ld13=Number($('#zabd13').val());
    var ld7=Number(ld8+ld9);
    var ld4=Number(ld5+ld8+ld9);
    var ld10=Number(ld11+ld13);

    var le5=Number($('#zabe5').val());
    var le6=Number($('#zabe6').val());
    var le8=Number($('#zabe8').val());
    var le9=Number($('#zabe9').val());
    var le11=Number($('#zabe11').val());
    var le12=Number($('#zabe12').val());
    var le13=Number($('#zabe13').val());
    var le7=Number(le8+le9);
    var le4=Number(le5+le8+le9);
    var le10=Number(le11+le13);

    var lf5=Number($('#zabf5').val());
    var lf6=Number($('#zabf6').val());
    var lf8=Number($('#zabf8').val());
    var lf9=Number($('#zabf9').val());
    var lf11=Number($('#zabf11').val());
    var lf12=Number($('#zabf12').val());
    var lf13=Number($('#zabf13').val());
    var lf7=Number(lf8+lf9);
    var lf4=Number(lf5+lf8+lf9);
    var lf10=Number(lf11+lf13);

    var lg5=Number($('#zabg5').val());
    var lg6=Number($('#zabg6').val());
    var lg8=Number($('#zabg8').val());
    var lg9=Number($('#zabg9').val());
    var lg11=Number($('#zabg11').val());
    var lg12=Number($('#zabg12').val());
    var lg13=Number($('#zabg13').val());
    var lg7=Number(lg8+lg9);
    var lg4=Number(lg5+lg8+lg9);
    var lg10=Number(lg11+lg13);

    var lh5=Number($('#zabh5').val());
    var lh6=Number($('#zabh6').val());
    var lh8=Number($('#zabh8').val());
    var lh9=Number($('#zabh9').val());
    var lh11=Number($('#zabh11').val());
    var lh12=Number($('#zabh12').val());
    var lh13=Number($('#zabh13').val());
    var lh7=Number(lh8+lh9);
    var lh4=Number(lh5+lh8+lh9);
    var lh10=Number(lh11+lh13);

    var li5=Number($('#zabi5').val());
    var li6=Number($('#zabi6').val());
    var li8=Number($('#zabi8').val());
    var li9=Number($('#zabi9').val());
    var li11=Number($('#zabi11').val());
    var li12=Number($('#zabi12').val());
    var li13=Number($('#zabi13').val());
    var li7=Number(li8+li9);
    var li4=Number(li5+li8+li9);
    var li10=Number(li11+li13);

    var lj5=Number($('#zabj5').val());
    var lj6=Number($('#zabj6').val());
    var lj8=Number($('#zabj8').val());
    var lj9=Number($('#zabj9').val());
    var lj11=Number($('#zabj11').val());
    var lj12=Number($('#zabj12').val());
    var lj13=Number($('#zabj13').val());
    var lj7=Number(lj8+lj9);
    var lj4=Number(lj5+lj8+lj9);
    var lj10=Number(lj11+lj13);

    var lk5=Number($('#zabk5').val());
    var lk6=Number($('#zabk6').val());
    var lk8=Number($('#zabk8').val());
    var lk9=Number($('#zabk9').val());
    var lk11=Number($('#zabk11').val());
    var lk12=Number($('#zabk12').val());
    var lk13=Number($('#zabk13').val());
    var lk7=Number(lk8+lk9);
    var lk4=Number(lk5+lk8+lk9);
    var lk10=Number(lk11+lk13);

    var ll5=Number($('#zabl5').val());
    var ll6=Number($('#zabl6').val());
    var ll8=Number($('#zabl8').val());
    var ll9=Number($('#zabl9').val());
    var ll11=Number($('#zabl11').val());
    var ll12=Number($('#zabl12').val());
    var ll13=Number($('#zabl13').val());
    var ll7=Number(ll8+ll9);
    var ll4=Number(ll5+ll8+ll9);
    var ll10=Number(ll11+ll13);

    var lm5=Number($('#zabm5').val());
    var lm6=Number($('#zabm6').val());
    var lm8=Number($('#zabm8').val());
    var lm9=Number($('#zabm9').val());
    var lm11=Number($('#zabm11').val());
    var lm12=Number($('#zabm12').val());
    var lm13=Number($('#zabm13').val());
    var lm7=Number(lm8+lm9);
    var lm4=Number(lm5+lm8+lm9);
    var lm10=Number(lm11+lm13);

    var ln5=Number($('#zabn5').val());
    var ln6=Number($('#zabn6').val());
    var ln8=Number($('#zabn8').val());
    var ln9=Number($('#zabn9').val());
    var ln11=Number($('#zabn11').val());
    var ln12=Number($('#zabn12').val());
    var ln13=Number($('#zabn13').val());
    var ln7=Number(ln8+ln9);
    var ln4=Number(ln5+ln8+ln9);
    var ln10=Number(ln11+ln13);
    $('#zabo5').val((la5+lb5+lc5+ld5+le5+lf5+lg5+lh5+li5+lj5+lk5+ll5+lm5+ln5).toFixed(2));
    $('#zabo6').val((la6+lb6+lc6+ld6+le6+lf6+lg6+lh6+li6+lj6+lk6+ll6+lm6+ln6).toFixed(2));
    $('#zabo8').val((la8+lb8+lc8+ld8+le8+lf8+lg8+lh8+li8+lj8+lk8+ll8+lm8+ln8).toFixed(2));
    $('#zabo9').val((la9+lb9+lc9+ld9+le9+lf9+lg9+lh9+li9+lj9+lk9+ll9+lm9+ln9).toFixed(2));
    $('#zabo11').val((la11+lb11+lc11+ld11+le11+lf11+lg11+lh11+li11+lj11+lk11+ll11+lm11+ln11).toFixed(2));
    $('#zabo12').val((la12+lb12+lc12+ld12+le12+lf12+lg12+lh12+li12+lj12+lk12+ll12+lm12+ln12).toFixed(2));
    $('#zabo13').val((la13+lb13+lc13+ld13+le13+lf13+lg13+lh13+li13+lj13+lk13+ll13+lm13+ln13).toFixed(2));
    $('#zabo4').val((la4+lb4+lc4+ld4+le4+lf4+lg4+lh4+li4+lj4+lk4+ll4+lm4+ln4).toFixed(2));
    $('#zabo7').val((la7+lb7+lc7+ld7+le7+lf7+lg7+lh7+li7+lj7+lk7+ll7+lm7+ln7).toFixed(2));
    $('#zabo10').val((la10+lb10+lc10+ld10+le10+lf10+lg10+lh10+li10+lj10+lk10+ll10+lm10+ln10).toFixed(2));

    var lp5=Number($('#zabp5').val());
    var lp6=Number($('#zabp6').val());
    var lp8=Number($('#zabp8').val());
    var lp9=Number($('#zabp9').val());
    var lp11=Number($('#zabp11').val());
    var lp12=Number($('#zabp12').val());
    var lp13=Number($('#zabp13').val());
    var lp7=Number(lp8+lp9);
    var lp4=Number(lp5+lp8+lp9);
    var lp10=Number(lp11+lp13);

    var lq5=Number($('#zabq5').val());
    var lq6=Number($('#zabq6').val());
    var lq8=Number($('#zabq8').val());
    var lq9=Number($('#zabq9').val());
    var lq11=Number($('#zabq11').val());
    var lq12=Number($('#zabq12').val());
    var lq13=Number($('#zabq13').val());
    var lq7=Number(lq8+lq9);
    var lq4=Number(lq5+lq8+lq9);
    var lq10=Number(lq11+lq13);

    var lr5=Number($('#zabr5').val());
    var lr6=Number($('#zabr6').val());
    var lr8=Number($('#zabr8').val());
    var lr9=Number($('#zabr9').val());
    var lr11=Number($('#zabr11').val());
    var lr12=Number($('#zabr12').val());
    var lr13=Number($('#zabr13').val());
    var lr7=Number(lr8+lr9);
    var lr4=Number(lr5+lr8+lr9);
    var lr10=Number(lr11+lr13);

    var ls5=Number($('#zabs5').val());
    var ls6=Number($('#zabs6').val());
    var ls8=Number($('#zabs8').val());
    var ls9=Number($('#zabs9').val());
    var ls11=Number($('#zabs11').val());
    var ls12=Number($('#zabs12').val());
    var ls13=Number($('#zabs13').val());
    var ls7=Number(ls8+ls9);
    var ls4=Number(ls5+ls8+ls9);
    var ls10=Number(ls11+ls13);

    var lt5=Number($('#zabt5').val());
    var lt6=Number($('#zabt6').val());
    var lt8=Number($('#zabt8').val());
    var lt9=Number($('#zabt9').val());
    var lt11=Number($('#zabt11').val());
    var lt12=Number($('#zabt12').val());
    var lt13=Number($('#zabt13').val());
    var lt7=Number(lt8+lt9);
    var lt4=Number(lt5+lt8+lt9);
    var lt10=Number(lt11+lt13);

    var lu5=Number($('#zabu5').val());
    var lu6=Number($('#zabu6').val());
    var lu8=Number($('#zabu8').val());
    var lu9=Number($('#zabu9').val());
    var lu11=Number($('#zabu11').val());
    var lu12=Number($('#zabu12').val());
    var lu13=Number($('#zabu13').val());
    var lu7=Number(lu8+lu9);
    var lu4=Number(lu5+lu8+lu9);
    var lu10=Number(lu11+lu13);

    var lv5=Number($('#zabv5').val());
    var lv6=Number($('#zabv6').val());
    var lv8=Number($('#zabv8').val());
    var lv9=Number($('#zabv9').val());
    var lv11=Number($('#zabv11').val());
    var lv12=Number($('#zabv12').val());
    var lv13=Number($('#zabv13').val());
    var lv7=Number(lv8+lv9);
    var lv4=Number(lv5+lv8+lv9);
    var lv10=Number(lv11+lv13);
    $('#zabw5').val((lp5+lq5+lr5+ls5+lt5+lu5+lv5).toFixed(2));
    $('#zabw6').val((lp6+lq6+lr6+ls6+lt6+lu6+lv6).toFixed(2));
    $('#zabw8').val((lp8+lq8+lr8+ls8+lt8+lu8+lv8).toFixed(2));
    $('#zabw9').val((lp9+lq9+lr9+ls9+lt9+lu9+lv9).toFixed(2));
    $('#zabw11').val((lp11+lq11+lr11+ls11+lt11+lu11+lv11).toFixed(2));
    $('#zabw12').val((lp12+lq12+lr12+ls12+lt12+lu12+lv12).toFixed(2));
    $('#zabw13').val((lp13+lq13+lr13+ls13+lt13+lu13+lv13).toFixed(2));
    $('#zabw4').val((lp4+lq4+lr4+ls4+lt4+lu4+lv4).toFixed(2));
    $('#zabw7').val((lp7+lq7+lr7+ls7+lt7+lu7+lv7).toFixed(2));
    $('#zabw10').val((lp10+lq10+lr10+ls10+lt10+lu10+lv10).toFixed(2));
})


</script>
<style type="text/css">
    .zabtableinput{width:92%;height:100%;border-width: 0px;background-color:#F3F3FA; }
    .changcolor{background-color:#E6E6F2;}
</style>
<div class="pageContent" layoutH="0" >
    <form method="post" autocomplete="off" action="/hg/index.php?s=/Home/Zhixingadmin/budgetaddinsert/callbackType/closeCurrent" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <h4 style="margin-left:350px;margin-bottom:0px;font-size:1.7em;letter-spacing:10px">预算录入表—行政（单位：万元）</h4>
    <div style="width:1200px;margin-left:10px">
        <div>
            <div style="float:left">
                <p>填报年份:</p>
            </div>
            <div style="float:left">
                <input style="width:50px" class="required digits input1" minlength="4" maxlength="4" type="text" name="year" value=<?php echo date("Y");?>>
            </div>
        </div>
        <div style="margin-left:30px;float:left">
            <div style="float:left">
                <p>填报单位:<b><?php echo session(C('ADMIN_AUTH_UNITNAME'));?></b></p>
            </div>
        </div>
    </div>
    <table width="1100" border="1" style="border-collapse:collapse;margin-left:10px;clear:both">
        <tr>
            <td width="60" rowspan="3" align="center" valign="middle">资金科目</td>
            <td width="60" height="25">&nbsp;</td>
            <td width="50">&nbsp;</td>
            <td colspan="6" align="center" valign="middle">收入预算</td>
            <td colspan="4" align="center" valign="middle">支出预算</td>
        </tr>
        <tr>
            <td height="40">&nbsp;</td>
            <td>&nbsp;</td>
            <td width="70" rowspan="2" align="center" valign="middle">收入预算合计</td>
            <td colspan="2" align="center" valign="middle">上年结转</td>
            <td colspan="3" align="center" valign="middle">当年收入预算</td>
            <td width="70" rowspan="2" align="center" valign="middle">支出预算合计</td>
            <td colspan="2" align="center" valign="middle">结转资金支出预算</td>
            <td width="70" align="center" valign="middle">当年收入支出预算</td>
        </tr>
        <tr>
            <td height="30" align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
            <td width="70" align="center" valign="middle">小计</td>
            <td width="70" align="center" valign="middle">其中：两年前形成的结转</td>
            <td width="70" align="center" valign="middle">小计</td>
            <td width="70" align="center" valign="middle">二下数</td>
            <td width="70" align="center" valign="middle">调整数</td>
            <td width="70" align="center" valign="middle">小计</td>
            <td width="70" align="center" valign="middle">其中：两年前形成的结转</td>
            <td align="center" valign="middle">&nbsp;</td>
        </tr>
        
        <tr>
            <td rowspan="3" align="center" valign="middle">行政运行</td>
            <td rowspan="2">定员定额</td>
            <td height="25">人员经费</td>
            <td>
                <input type="text" name="aa[0]" class="number zabtableinput" id="zaba4" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[1]" class="number zabtableinput" id="zaba5" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[2]" class="number zabtableinput" id="zaba6" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[3]" class="number zabtableinput" id="zaba7" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[4]" class="number zabtableinput" id="zaba8" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[5]" class="number zabtableinput" id="zaba9" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[6]" class="number zabtableinput" id="zaba10" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[7]" class="number zabtableinput" id="zaba11" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[8]" class="number zabtableinput" id="zaba12" onkeyup="zabgetadd('a')">
            </td>
            <td>
                <input type="text" name="aa[9]" class="number zabtableinput" id="zaba13" onkeyup="zabgetadd('a')">
            </td>
        </tr>
        <tr>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="bb[0]" class="number zabtableinput" id="zabb4" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[1]" class="number zabtableinput" id="zabb5" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[2]" class="number zabtableinput" id="zabb6" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[3]" class="number zabtableinput" id="zabb7" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[4]" class="number zabtableinput" id="zabb8" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[5]" class="number zabtableinput" id="zabb9" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[6]" class="number zabtableinput" id="zabb10" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[7]" class="number zabtableinput" id="zabb11" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[8]" class="number zabtableinput" id="zabb12" onkeyup="zabgetadd('b')">
            </td>
            <td>
                <input type="text" name="bb[9]" class="number zabtableinput" id="zabb13" onkeyup="zabgetadd('b')">
            </td>
        </tr>
        <tr>
            <td>定项</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="cc[0]" class="number zabtableinput" id="zabc4" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[1]" class="number zabtableinput" id="zabc5" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[2]" class="number zabtableinput" id="zabc6" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[3]" class="number zabtableinput" id="zabc7" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[4]" class="number zabtableinput" id="zabc8" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[5]" class="number zabtableinput" id="zabc9" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[6]" class="number zabtableinput" id="zabc10" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[7]" class="number zabtableinput" id="zabc11" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[8]" class="number zabtableinput" id="zabc12" onkeyup="zabgetadd('c')">
            </td>
            <td>
                <input type="text" name="cc[9]" class="number zabtableinput" id="zabc13" onkeyup="zabgetadd('c')">
            </td>
        </tr>
        <tr>
            <td>离退休</td>
            <td>&nbsp;</td>
            <td height="25">人员经费</td>
            <td>
                <input type="text" name="dd[0]" class="number zabtableinput" id="zabd4" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[1]" class="number zabtableinput" id="zabd5" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[2]" class="number zabtableinput" id="zabd6" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[3]" class="number zabtableinput" id="zabd7" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[4]" class="number zabtableinput" id="zabd8" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[5]" class="number zabtableinput" id="zabd9" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[6]" class="number zabtableinput" id="zabd10" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[7]" class="number zabtableinput" id="zabd11" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[8]" class="number zabtableinput" id="zabd12" onkeyup="zabgetadd('d')">
            </td>
            <td>
                <input type="text" name="dd[9]" class="number zabtableinput" id="zabd13" onkeyup="zabgetadd('d')">
            </td>
        </tr>
        <tr>
            <td>住房公积金</td>
            <td>&nbsp;</td>
            <td height="25">人员经费</td>
            <td>
                <input type="text" name="ee[0]" class="number zabtableinput" id="zabe4" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[1]" class="number zabtableinput" id="zabe5" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[2]" class="number zabtableinput" id="zabe6" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[3]" class="number zabtableinput" id="zabe7" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[4]" class="number zabtableinput" id="zabe8" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[5]" class="number zabtableinput" id="zabe9" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[6]" class="number zabtableinput" id="zabe10" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[7]" class="number zabtableinput" id="zabe11" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[8]" class="number zabtableinput" id="zabe12" onkeyup="zabgetadd('e')">
            </td>
            <td>
                <input type="text" name="ee[9]" class="number zabtableinput" id="zabe13" onkeyup="zabgetadd('e')">
            </td>
        </tr>
        <tr>
            <td>购房补贴</td>
            <td>&nbsp;</td>
            <td height="25">人员经费</td>
            <td>
                <input type="text" name="ff[0]" class="number zabtableinput" id="zabf4" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[1]" class="number zabtableinput" id="zabf5" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[2]" class="number zabtableinput" id="zabf6" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[3]" class="number zabtableinput" id="zabf7" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[4]" class="number zabtableinput" id="zabf8" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[5]" class="number zabtableinput" id="zabf9" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[6]" class="number zabtableinput" id="zabf10" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[7]" class="number zabtableinput" id="zabf11" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[8]" class="number zabtableinput" id="zabf12" onkeyup="zabgetadd('f')">
            </td>
            <td>
                <input type="text" name="ff[9]" class="number zabtableinput" id="zabf13" onkeyup="zabgetadd('f')">
            </td>
        </tr>
        <tr>
            <td>一般行政事务</td>
            <td>中央财政专项</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="gg[0]" class="number zabtableinput" id="zabg4" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[1]" class="number zabtableinput" id="zabg5" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[2]" class="number zabtableinput" id="zabg6" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[3]" class="number zabtableinput" id="zabg7" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[4]" class="number zabtableinput" id="zabg8" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[5]" class="number zabtableinput" id="zabg9" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[6]" class="number zabtableinput" id="zabg10" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[7]" class="number zabtableinput" id="zabg11" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[8]" class="number zabtableinput" id="zabg12" onkeyup="zabgetadd('g')">
            </td>
            <td>
                <input type="text" name="gg[9]" class="number zabtableinput" id="zabg13" onkeyup="zabgetadd('g')">
            </td>
        </tr>
        <tr>
            <td rowspan="2">缉私办案费</td>
            <td>定员定额</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="hh[0]" class="number zabtableinput" id="zabh4" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[1]" class="number zabtableinput" id="zabh5" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[2]" class="number zabtableinput" id="zabh6" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[3]" class="number zabtableinput" id="zabh7" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[4]" class="number zabtableinput" id="zabh8" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[5]" class="number zabtableinput" id="zabh9" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[6]" class="number zabtableinput" id="zabh10" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[7]" class="number zabtableinput" id="zabh11" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[8]" class="number zabtableinput" id="zabh12" onkeyup="zabgetadd('h')">
            </td>
            <td>
                <input type="text" name="hh[9]" class="number zabtableinput" id="zabh13" onkeyup="zabgetadd('h')">
            </td>
        </tr>
        <tr>
            <td>单项</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="ii[0]" class="number zabtableinput" id="zabi4" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[1]" class="number zabtableinput" id="zabi5" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[2]" class="number zabtableinput" id="zabi6" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[3]" class="number zabtableinput" id="zabi7" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[4]" class="number zabtableinput" id="zabi8" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[5]" class="number zabtableinput" id="zabi9" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[6]" class="number zabtableinput" id="zabi10" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[7]" class="number zabtableinput" id="zabi11" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[8]" class="number zabtableinput" id="zabi12" onkeyup="zabgetadd('i')">
            </td>
            <td>
                <input type="text" name="ii[9]" class="number zabtableinput" id="zabi13" onkeyup="zabgetadd('i')">
            </td>
        </tr>
        <tr>
            <td rowspan="2">收费业务费</td>
            <td>定员定额</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="jj[0]" class="number zabtableinput" id="zabj4" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[1]" class="number zabtableinput" id="zabj5" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[2]" class="number zabtableinput" id="zabj6" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[3]" class="number zabtableinput" id="zabj7" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[4]" class="number zabtableinput" id="zabj8" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[5]" class="number zabtableinput" id="zabj9" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[6]" class="number zabtableinput" id="zabj10" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[7]" class="number zabtableinput" id="zabj11" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[8]" class="number zabtableinput" id="zabj12" onkeyup="zabgetadd('j')">
            </td>
            <td>
                <input type="text" name="jj[9]" class="number zabtableinput" id="zabj13" onkeyup="zabgetadd('j')">
            </td>
        </tr>
        <tr>
            <td>单项</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="kk[0]" class="number zabtableinput" id="zabk4" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[1]" class="number zabtableinput" id="zabk5" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[2]" class="number zabtableinput" id="zabk6" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[3]" class="number zabtableinput" id="zabk7" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[4]" class="number zabtableinput" id="zabk8" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[5]" class="number zabtableinput" id="zabk9" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[6]" class="number zabtableinput" id="zabk10" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[7]" class="number zabtableinput" id="zabk11" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[8]" class="number zabtableinput" id="zabk12" onkeyup="zabgetadd('k')">
            </td>
            <td>
                <input type="text" name="kk[9]" class="number zabtableinput" id="zabk13" onkeyup="zabgetadd('k')">
            </td>
        </tr>
        <tr>
            <td>金关工程</td>
            <td>&nbsp;</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="ll[0]" class="number zabtableinput" id="zabl4" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[1]" class="number zabtableinput" id="zabl5" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[2]" class="number zabtableinput" id="zabl6" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[3]" class="number zabtableinput" id="zabl7" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[4]" class="number zabtableinput" id="zabl8" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[5]" class="number zabtableinput" id="zabl9" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[6]" class="number zabtableinput" id="zabl10" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[7]" class="number zabtableinput" id="zabl11" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[8]" class="number zabtableinput" id="zabl12" onkeyup="zabgetadd('l')">
            </td>
            <td>
                <input type="text" name="ll[9]" class="number zabtableinput" id="zabl13" onkeyup="zabgetadd('l')">
            </td>
        </tr>
        <tr>
            <td>政府基金</td>
            <td>&nbsp;</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="mm[0]" class="number zabtableinput" id="zabm4" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[1]" class="number zabtableinput" id="zabm5" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[2]" class="number zabtableinput" id="zabm6" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[3]" class="number zabtableinput" id="zabm7" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[4]" class="number zabtableinput" id="zabm8" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[5]" class="number zabtableinput" id="zabm9" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[6]" class="number zabtableinput" id="zabm10" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[7]" class="number zabtableinput" id="zabm11" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[8]" class="number zabtableinput" id="zabm12" onkeyup="zabgetadd('m')">
            </td>
            <td>
                <input type="text" name="mm[9]" class="number zabtableinput" id="zabm13" onkeyup="zabgetadd('m')">
            </td>
        </tr>
        <tr>
            <td>其它</td>
            <td>&nbsp;</td>
            <td height="25">日常公用</td>
            <td>
                <input type="text" name="nn[0]" class="number zabtableinput" id="zabn4" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[1]" class="number zabtableinput" id="zabn5" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[2]" class="number zabtableinput" id="zabn6" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[3]" class="number zabtableinput" id="zabn7" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[4]" class="number zabtableinput" id="zabn8" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[5]" class="number zabtableinput" id="zabn9" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[6]" class="number zabtableinput" id="zabn10" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[7]" class="number zabtableinput" id="zabn11" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[8]" class="number zabtableinput" id="zabn12" onkeyup="zabgetadd('n')">
            </td>
            <td>
                <input type="text" name="nn[9]" class="number zabtableinput" id="zabn13" onkeyup="zabgetadd('n')">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" valign="middle">财政资金合计</td>
            <td height="25">&nbsp;</td>
            <td>
                <input type="text" name="oo[0]" class="number zabtableinput" id="zabo4" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[1]" class="number zabtableinput" id="zabo5" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[2]" class="number zabtableinput" id="zabo6" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[3]" class="number zabtableinput" id="zabo7" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[4]" class="number zabtableinput" id="zabo8" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[5]" class="number zabtableinput" id="zabo9" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[6]" class="number zabtableinput" id="zabo10" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[7]" class="number zabtableinput" id="zabo11" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[8]" class="number zabtableinput" id="zabo12" onkeyup="zabgetadd('o')">
            </td>
            <td>
                <input type="text" name="oo[9]" class="number zabtableinput" id="zabo13" onkeyup="zabgetadd('o')">
            </td>
        </tr>
        <tr>
            <td rowspan="4">海关套帐-其它资金</td>
            <td rowspan="2">一般行政事务专项</td>
            <td height="25">人员经费</td>
            <td>
                <input type="text" name="pp[0]" class="number zabtableinput" id="zabp4" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[1]" class="number zabtableinput" id="zabp5" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[2]" class="number zabtableinput" id="zabp6" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[3]" class="number zabtableinput" id="zabp7" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[4]" class="number zabtableinput" id="zabp8" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[5]" class="number zabtableinput" id="zabp9" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[6]" class="number zabtableinput" id="zabp10" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[7]" class="number zabtableinput" id="zabp11" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[8]" class="number zabtableinput" id="zabp12" onkeyup="zabgetadd('p')">
            </td>
            <td>
                <input type="text" name="pp[9]" class="number zabtableinput" id="zabp13" onkeyup="zabgetadd('p')">
            </td>
        </tr>
        <tr>
            <td height="25">公用经费</td>
            <td>
                <input type="text" name="qq[0]" class="number zabtableinput" id="zabq4" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[1]" class="number zabtableinput" id="zabq5" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[2]" class="number zabtableinput" id="zabq6" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[3]" class="number zabtableinput" id="zabq7" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[4]" class="number zabtableinput" id="zabq8" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[5]" class="number zabtableinput" id="zabq9" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[6]" class="number zabtableinput" id="zabq10" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[7]" class="number zabtableinput" id="zabq11" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[8]" class="number zabtableinput" id="zabq12" onkeyup="zabgetadd('q')">
            </td>
            <td>
                <input type="text" name="qq[9]" class="number zabtableinput" id="zabq13" onkeyup="zabgetadd('q')">
            </td>
        </tr>
        <tr>
            <td rowspan="2">其它收支</td>
            <td height="25">人员经费</td>
            <td>
                <input type="text" name="rr[0]" class="number zabtableinput" id="zabr4" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[1]" class="number zabtableinput" id="zabr5" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[2]" class="number zabtableinput" id="zabr6" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[3]" class="number zabtableinput" id="zabr7" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[4]" class="number zabtableinput" id="zabr8" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[5]" class="number zabtableinput" id="zabr9" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[6]" class="number zabtableinput" id="zabr10" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[7]" class="number zabtableinput" id="zabr11" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[8]" class="number zabtableinput" id="zabr12" onkeyup="zabgetadd('r')">
            </td>
            <td>
                <input type="text" name="rr[9]" class="number zabtableinput" id="zabr13" onkeyup="zabgetadd('r')">
            </td>
        </tr>
        <tr>
            <td height="25">公用经费</td>
            <td>
                <input type="text" name="ss[0]" class="number zabtableinput" id="zabs4" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[1]" class="number zabtableinput" id="zabs5" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[2]" class="number zabtableinput" id="zabs6" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[3]" class="number zabtableinput" id="zabs7" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[4]" class="number zabtableinput" id="zabs8" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[5]" class="number zabtableinput" id="zabs9" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[6]" class="number zabtableinput" id="zabs10" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[7]" class="number zabtableinput" id="zabs11" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[8]" class="number zabtableinput" id="zabs12" onkeyup="zabgetadd('s')">
            </td>
            <td>
                <input type="text" name="ss[9]" class="number zabtableinput" id="zabs13" onkeyup="zabgetadd('s')">
            </td>
        </tr>
        <tr>
            <td rowspan="3">地方罚没账套-其它资金</td>
            <td rowspan="2">地方套帐-地方罚没</td>
            <td height="25">人员经费</td>
            <td>
                <input type="text" name="tt[0]" class="number zabtableinput" id="zabt4" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[1]" class="number zabtableinput" id="zabt5" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[2]" class="number zabtableinput" id="zabt6" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[3]" class="number zabtableinput" id="zabt7" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[4]" class="number zabtableinput" id="zabt8" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[5]" class="number zabtableinput" id="zabt9" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[6]" class="number zabtableinput" id="zabt10" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[7]" class="number zabtableinput" id="zabt11" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[8]" class="number zabtableinput" id="zabt12" onkeyup="zabgetadd('t')">
            </td>
            <td>
                <input type="text" name="tt[9]" class="number zabtableinput" id="zabt13" onkeyup="zabgetadd('t')">
            </td>
        </tr>
        <tr>
            <td height="25">公用经费</td>
            <td>
                <input type="text" name="uu[0]" class="number zabtableinput" id="zabu4" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[1]" class="number zabtableinput" id="zabu5" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[2]" class="number zabtableinput" id="zabu6" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[3]" class="number zabtableinput" id="zabu7" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[4]" class="number zabtableinput" id="zabu8" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[5]" class="number zabtableinput" id="zabu9" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[6]" class="number zabtableinput" id="zabu10" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[7]" class="number zabtableinput" id="zabu11" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[8]" class="number zabtableinput" id="zabu12" onkeyup="zabgetadd('u')">
            </td>
            <td>
                <input type="text" name="uu[9]" class="number zabtableinput" id="zabu13" onkeyup="zabgetadd('u')">
            </td>
        </tr>
        <tr>
            <td>中央转移支付</td>
            <td height="25">公用经费</td>
            <td>
                <input type="text" name="vv[0]" class="number zabtableinput" id="zabv4" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[1]" class="number zabtableinput" id="zabv5" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[2]" class="number zabtableinput" id="zabv6" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[3]" class="number zabtableinput" id="zabv7" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[4]" class="number zabtableinput" id="zabv8" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[5]" class="number zabtableinput" id="zabv9" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[6]" class="number zabtableinput" id="zabv10" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[7]" class="number zabtableinput" id="zabv11" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[8]" class="number zabtableinput" id="zabv12" onkeyup="zabgetadd('v')">
            </td>
            <td>
                <input type="text" name="vv[9]" class="number zabtableinput" id="zabv13" onkeyup="zabgetadd('v')">
            </td>
        </tr>
        <tr>
            <td height="21" colspan="2" align="center" valign="middle">其它资金合计</td>
            <td height="25">&nbsp;</td>
            <td>
                <input type="text" name="ww[0]" class="number zabtableinput" id="zabw4" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[1]" class="number zabtableinput" id="zabw5" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[2]" class="number zabtableinput" id="zabw6" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[3]" class="number zabtableinput" id="zabw7" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[4]" class="number zabtableinput" id="zabw8" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[5]" class="number zabtableinput" id="zabw9" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[6]" class="number zabtableinput" id="zabw10" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[7]" class="number zabtableinput" id="zabw11" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[8]" class="number zabtableinput" id="zabw12" onkeyup="zabgetadd('w')">
            </td>
            <td>
                <input type="text" name="ww[9]" class="number zabtableinput" id="zabw13" onkeyup="zabgetadd('w')">
            </td>
        </tr>
    </table>
    
    <div class="formBar">
        <ul style="float:left;margin-left:960px;">
            <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
            <li><div class="button"><div class="buttonContent"><button type="button" class="close">关闭</button></div></div></li>
        </ul>
    </div>
    </form>
</div>