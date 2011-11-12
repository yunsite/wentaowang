<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 </head>
 <form method='post' action="__URL__/insert">
 <table cellpadding=2 cellspacing=2>
 <tr>
	<td class="tRight" width="12%">用户名：</td>
	<td class="tLeft" ><input type="text" name="user_name" style="height:23px" class="large bLeft"></td>
 </tr>
  <tr>
	<td class="tRight" >邮箱：</td>
	<td class="tLeft" ><input type="text" name="email" style="height:23px" class="large bLeft"></td>
 </tr>
 <tr>
	<td class="tRight tTop" >密码：</td>
	<td class="tLeft" ><input type="text" name="password" style="height:23px" class="large bLeft"></td>
 </tr>

 <tr>
	<td></td>
	<td><input type="submit" class="button" value="提 交"> <input type="reset" class="button" value="清 空"></td>
 </tr>
 
 </form>
 <tr>
 <td></td>
	<td><hr></td>
 </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
	  <td></td>
		<td style="border-bottom:1px dotted silver"><?php echo ($vo["user_name"]); ?> <span style="color:gray">[<?php echo ($vo["email"]); ?> <?php echo (date('Y-m-d H:i:s',$vo["create_time"])); ?>]</span></td>
	  </tr>
	  <tr >
	  <td></td>
		<td><div class="content"><?php echo (nl2br($vo["content"])); ?></div></td>
	  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  <tr>
 	<td></td><td><p class="sabrosus"><?php echo ($page); ?></p></td>
 </tr>
  </html>