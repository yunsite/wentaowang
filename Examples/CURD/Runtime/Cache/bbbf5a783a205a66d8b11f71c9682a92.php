<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ThinkPHP示例：CURD操作</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/common.css" />
<script type="text/javascript" src="__PUBLIC__/Js/Base.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/prototype.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/mootools.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Ajax/ThinkAjax.js"></script>
 </head>
 <body><script language="JavaScript">
 <!--

	function add(){
	//alert("__PUBLIC__/Js/Base");
		ThinkAjax.sendForm('form1','__URL__/insert',complete,'result');
		
	}
	function complete(data,status){
		if (status==1)
		{
		 window.setTimeout(function (){window.location.href='__URL__',20000});
		}
	}
 //-->
 </script>
 <div class="main">
 <h2>ThinkPHP示例之：CURD操作 [ 新增数据表单 ] </h2>
    <form id="form1" method='post' action="__URL__/insert">
 <table cellpadding=2 cellspacing=2>
  <tr>
	<td colspan="2"><div id="result" class="none result" style="font-family:微软雅黑,Tahoma;letter-spacing:2px"></div></td>
 </tr>
 <tr>
	<td class="tRight" width="12%">标题：</td>
	<td class="tLeft" ><input type="text" name="title" style="height:23px" class="huge bLeft"> </td>
 </tr>
  <tr>
	<td class="tRight" >邮箱：</td>
	<td class="tLeft" ><input type="text" name="email" style="height:23px" class="huge bLeft"></td>
 </tr>
 <tr>
	<td class="tRight tTop" >内容：</td>
	<td><textarea name="content" class="huge bLeft" rows="8" cols="25"></textarea></td>
 </tr>
 <tr>
	<td><input type="hidden" name="ajax" value="1"></td>
	<td><input type="button" onClick="add()" class="button" value="保 存"> <input type="reset" class="button" value="清 空"></td>
 </tr>
 </table>
   </form>
</div>
 </body>
</html>