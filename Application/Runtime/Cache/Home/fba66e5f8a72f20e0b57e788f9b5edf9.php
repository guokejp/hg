<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<div>
<div>
  <h3>部门包干费使用情况</h3>
  <table border="1" cellspacing="0px">
    <tr>
      <th>部门</th>
      <?php if(is_array($p_catgroy)): foreach($p_catgroy as $key=>$vo_cat): ?><th><?php echo ($vo_cat["name"]); ?>包干额</th>
        <th><?php echo ($vo_cat["name"]); ?>支出数</th>
        <th><?php echo ($vo_cat["name"]); ?>结余数</th><?php endforeach; endif; ?>
      
    </tr>
    <?php if(is_array($p_cate_list)): foreach($p_cate_list as $key=>$vo): ?><tr>
        <td><?php echo ($vo["sectionname"]); ?></td>
          <?php if(is_array($vo)): foreach($vo as $key=>$vo_c): if(is_array($vo_c)): ?><td><?php echo ($vo_c["init_money"]); ?></td>
                <td><?php echo ($vo_c["cost"]); ?></td>
                <td><?php echo ($vo_c["money"]); ?></td><?php endif; endforeach; endif; ?>
      </tr><?php endforeach; endif; ?>
  </table>
  <?php if(is_array($c_cate_list)): foreach($c_cate_list as $key=>$vo_cat): ?><br /><br /><br />
    <h3><?php echo ($vo_cat["name"]); ?>使用情况</h3>
    <table border="1" cellspacing="0px">
      <tr>
        <th>项目名称</th>
        <th>上级项目</th>
        <th>包干总额</th>
        <th>支出数</th>
        <th>结余数</th>
        <th>管理部门</th>
      </tr>
      <?php if(is_array($vo_cat)): foreach($vo_cat as $key=>$vo): if(is_array($vo)): ?><tr>
            <td><?php echo ($vo["categoryname"]); ?></td>
            <?php if(!isset($vo['sectionid'])): ?><td>&nbsp</td>
            <?php else: ?>
              <td><?php echo ($vo_cat["name"]); ?></td><?php endif; ?>
            <td><?php echo ($vo["init_money"]); ?></td>
            <td><?php echo ($vo["cost"]); ?></td>
            <td><?php echo ($vo["money"]); ?></td>
            <td><?php echo ($vo["sectionname"]); ?></td>
          </tr><?php endif; endforeach; endif; ?>
    </table><?php endforeach; endif; ?>
  <!-- <h3><?php echo ($c_spe_list["name"]); ?>使用情况</h3>
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
    </table> -->
</div>
</div>
</body>
</html>