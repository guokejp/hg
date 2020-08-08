<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<div>
<div>
  <h3><?php echo ($c_spe_list["name"]); ?>使用情况</h3>
    <table border="1" cellspacing="0px">
      <tr>
        <th>项目名称</th>
        <th>包干总额</th>
        <th>支出数</th>
        <th>结余数</th>
        <th>管理部门</th>
      </tr>
      <?php if(is_array($c_spe_list['budget'])): foreach($c_spe_list['budget'] as $key=>$vo): if(is_array($vo)): ?><tr>
            <td><?php echo ($vo["specialname"]); ?></td>
            <td><?php echo ($vo["firstallmoney"]); ?></td>
            <td><?php echo ($vo["cost"]); ?></td>
            <td><?php echo ($vo["money"]); ?></td>
            <td><?php echo ($vo["sectionname"]); ?></td>
          </tr><?php endif; endforeach; endif; ?>
    </table>
</div>
</div>
</body>
</html>