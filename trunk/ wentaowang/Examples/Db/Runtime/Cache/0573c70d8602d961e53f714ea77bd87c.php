<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ThinkPHP示例：数据查询</title>
<link rel='stylesheet' type='text/css' href='__PUBLIC__/Css/common.css'>
 </head>
 <script language="JavaScript">
 <!--
	function showTrace(){
		document.getElementById('trace_info').innerHTML = document.getElementById('think_page_trace').innerHTML;
		document.getElementById('think_page_trace').innerHTML = '';
	}
 //-->
 </script>
 <body onload="showTrace()">
 <div class="main">
 <h2>ThinkPHP示例之：数据查询</h2>
  数据查询包括普通查询、组合查询、统计查询、定位查询、动态查询和SQL查询。<br/>
<div class="result" style="font-weight:normal">
普通列表查询结果：<br/>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><?php echo ($v["id"]); ?>--<?php echo ($v["title"]); ?><br/><?php endforeach; endif; else: echo "" ;endif; ?>
<hr>
带条件查询结果：<br/>
<?php echo ($vo["title"]); ?>
<hr>
组合查询结果：<br/>
<?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><?php echo ($v["title"]); ?><br/><?php endforeach; endif; else: echo "" ;endif; ?>
<hr>
动态查询结果：<br/>
<?php echo ($vo2["title"]); ?>
</div>
<div id="trace_info"></div>
 <table cellpadding=2 cellspacing=2>
 <tr>
 <td></td>
	<td>示例源码<br/>控制器IndexAction类<br/><?php highlight_file(LIB_PATH.'Action/IndexAction.class.php'); ?></td>
 </tr>
 </table>
</div>
 </body>
</html>