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
<script language="javascript">
	
	 //重载验证码
	function fleshVerify(){
		var timenow = new Date().getTime();
		document.getElementById('verifyImg').src='__URL__/verify/'+timenow;  
	}
	
	function Madd(){

	//	ThinkAjax.sendForm('form1','__URL__/Madd',,'result');
	}
	function win(){

		window.open('__PUBLIC__/html/win.html');
	
	}
	function collect(){
	
		ThinkAjax.sendForm('form1','__URL__/collect',,'result');
	
	}
	
	function complete(data,status){
		if (status==1)
		{
		// 提示信息
		$('list').innerHTML = '<span style="color:blue">'+data+'你好!</span>';
		}
	}
	
</script>

<div>
 <tr>
	  <td></td><a href="#">购物车</a>
		<image src="__PUBLIC__/Images/<?php echo ($list["pic_name"]); ?>">
		<td style="border-bottom:1px dotted silver">书名：<?php echo ($list["book_name"]); ?></a></td> 
		<td><span style="color:gray">作者：<?php echo ($list["author"]); ?></span></td>
		<td><span style="color:gray">isbn：<?php echo ($list["isbn"]); ?></span></td>
		<td><span style="color:gray">内容简介：<?php echo ($list["plot_summary"]); ?></span></td><td>
		<span style="color:gray">作者简介：<?php echo ($list["author_summary"]); ?></span></td>
		<a href="#" onClick="win()" >想读</a><a href="#">在读</a><a href="#">读过</a>
		<div id="result"></div><a  name="<?php echo ($list["author"]); ?>" href="#" onClick="collect()" >收藏</a><a href="#">购买</a>
	
	<form name="message" method="post" action="__URL__/Madd">
		<table cellpadding=2 cellspacing=2><h2>对书进行评价</h2>
		<tr>
				<td class="tRight" width="12%">评论内容：</td>
				<td class="tLeft" ><textarea name="message" id="message" rows="5" cols="13"></textarea></td>
		</tr>
		 <tr>
			<td class="tRight tTop" >验证码：</td>
			<td><input name="verify" type="text" style="height:23px; width:60px;"  />&nbsp;<a href="javascript:fleshVerify()"><img id="verifyImg" SRC="__URL__/verify/" BORDER="0" ALT="" align="absmiddle"></a>&nbsp;<a href="javascript:fleshVerify()">刷新验证码</a></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" class="button" value="提 交"> <input type="reset" class="button" value="清 空"></td>
		</tr>
	 
	</form>
	
	<?php if(is_array($message)): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
	
		<td><?php echo ($vo["user_id"]); ?></td><td><?php echo ($vo["message"]); ?><td><a href="#">有用</a><a href="#">没用</a>
	
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>

</tr>	
</div>
<div>
<td>所有权归lben所有</td>
</div>
</body>
</html>