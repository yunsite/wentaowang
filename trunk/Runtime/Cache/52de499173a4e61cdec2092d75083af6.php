<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<script type="text/javascript" src="__PUBLIC__/Js/Base.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/prototype.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/mootools.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Ajax/ThinkAjax.js"></script>

</head>
<body>
<div>
<td>
<td><a href="__URL__">我的收藏</a></td>
<td><a>我的订单</a></td>
<td><a>我读过的书</a></td>
<td><a>我正在读的书</a></td>
<td><a>我读过的书</a></td>
</div>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
	  <td></td>
		<td style="border-bottom:1px dotted silver">书名：<a href="__APP__/product/index?product=<?php echo ($vo["book_id"]); ?>"><?php echo ($vo["book_name"]); ?></a></td> 
		<td><span style="color:gray">作者：<?php echo ($vo["author"]); ?></span></td>
		<td><span style="color:gray">isbn：<?php echo ($vo["isbn"]); ?></span></td>
		<td><span style="color:gray">内容简介：<?php echo ($vo["plot_summary"]); ?></span></td><td>
		<span style="color:gray">作者简介：<?php echo ($vo["author_summary"]); ?></span></td>
	  </tr>
	  <tr >
	  <td></td>
		<td><div class="content"><?php echo ($page); ?></div></td>
	  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
<div>
<td>所有权归lben所有</td>
</div>
</body>
</html>