<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blog By ThinkPHP <?php echo (THINK_VERSION); ?></title>
<link href="../Public/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../Public/js/common.js" /></script>
<script type="text/javascript" src="__PUBLIC__/Js/Base.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/prototype.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/mootools.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Ajax/ThinkAjax.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/UbbEditor.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Form/CheckForm.js"></script>
<script language="JavaScript">
<!--
//指定当前组模块URL地址
var URL = '__URL__';
var APP	 =	 '__APP__';
var PUBLIC = '__PUBLIC__';
ThinkAjax.updateTip = '<IMG SRC="../Public/images/loading2.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="loading..." align="absmiddle"> 数据处理中...';
//-->
</script>
</head>

<body>
<div id="header">
    <div id="innerHeader">
      <div id="blogLogo"></div>
      <div class="blog-header">
        <div class="blog-title"><IMG SRC="../Public/images/logo.png"  style="border:1px solid gray" BORDER="0" ALT="" align="absmiddle"> <a href="http://thinkphp.cn">ThinkPHP</a></div>
        <div class="blog-desc">PHP最佳实践框架  [ Blog示例程序]</div>
      </div>
      <div id="menu">
        <ul>
        <li><a href="__APP__">日志首页</a></li>
        <li><a href="__APP__/Blog/add">撰写日志</a></li>
        <li><a href="http://thinkphp.cn">官方网站</a></li>
        </ul>
      </div>
    </div>
</div>

<!--中间部分-->

<div id="mainWrapper">
<div id="content" class="content">
<div id="innerContent">

  <div class="announce text" style="border:1px solid silver;padding:5px;font-size:14px;">
  	<H4 style="color:#FF3300"><IMG SRC="../Public/images/wav.gif" WIDTH="18" HEIGHT="18" BORDER="0" ALT="" align="absmiddle"> 简单的BLOG示例</H4>
    本示例Blog基于ThinkPHP1.0.0实现，包括日志的新增、修改、列表、统计、评论、标签、归档、上传附件和删除等功能，涵盖了新版ThinkPHP的路由功能、内置模板引擎标签的使用、视图模型、文本字段、AJAX操作、前置和后置操作、自动验证、自动填充、分页功能、查询语言、统计查询、动态查询、自动时间戳记录、CURD操作、触发器、默认模块设置、页面Trace、浏览器缓存、Action缓存、静态缓存、操作重定向、文件上传（批量上传、AJAX上传）、验证码等知识点的实现，可以作为入门ThinkPHP的绝佳示例。<P>请按照下面步骤操作，增加分类、添加日志、增加评论。
 </div>
<div class="article-top"><div class="view-mode">浏览模式: <a href="?mode=normal">普通</a> | <a href="?mode=list">列表</a></div><div class="pages"><?php echo ($page); ?></div></div>
<?php switch($mode): ?><?php case "list":  ?><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="textbox-list">
<div class="textbox-list-title"><IMG SRC="../Public/images/icon_point2.gif" WIDTH="13" HEIGHT="13" BORDER="0" ALT="" align="absmiddle"> [ <A HREF="__APP__/Blog/category/id/<?php echo ($vo["categoryId"]); ?>"><?php echo ($vo["category"]); ?> </A> ] <A HREF="__URL__/show/id/<?php echo ($vo["id"]); ?>"><?php echo (ubb($vo["title"])); ?></A> <?php echo (toDate($vo["cTime"],'Y-m-d')); ?> </div><div class="textbox-author"> [ <A HREF="__URL__/show/id/<?php echo ($vo["id"]); ?>#reply"> <?php echo ($vo["commentCount"]); ?></A> | <?php echo ($vo["readCount"]); ?>  ]</div></div><?php endforeach; endif; else: echo "" ;endif; ?><?php break;?>
<?php default: ?>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div id="blog_<?php echo ($vo["id"]); ?>">
<div class="textbox-title"><H4><IMG SRC="../Public/images/icon_point2.gif" WIDTH="13" HEIGHT="13" BORDER="0" ALT="" align="absmiddle"> <A HREF="__URL__/show/id/<?php echo ($vo["id"]); ?>"><?php echo (ubb($vo["title"])); ?></A> </H4><div class="textbox-label">[ <?php echo (toDate($vo["cTime"],'Y-m-d H:i:s')); ?>  | <A HREF="__APP__/Blog/category/id/<?php echo ($vo["categoryId"]); ?>"><?php echo ($vo["category"]); ?> </A>] </div></div>
<div class="textbox-content"><?php echo ($vo["content"]); ?></div>
<div class="textbox-bottom"> [ 管理：<A HREF="__URL__/edit/id/<?php echo ($vo["id"]); ?>">编辑</A> <A HREF="javascript:delBlog(<?php echo ($vo["id"]); ?>)">删除</A> ]   关键词: <?php echo (showTags($vo["tags"])); ?> | <A HREF="__URL__/show/id/<?php echo ($vo["id"]); ?>#reply">评论: <?php echo ($vo["commentCount"]); ?></A> | 浏览: <?php echo ($vo["readCount"]); ?></div><P>
</div><?php endforeach; endif; else: echo "" ;endif; ?><?php endswitch;?>
<div class="article-bottom"><div class="pages"><?php echo ($page); ?></div></div>
</div>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function addCategory(){
		ThinkAjax.send('__APP__/Category/insert','ajax=1&title='+$F('categoryName'),addComplete);
	}
	function addComplete(data,status){
		if (status==1)
		{
		$('category').innerHTML += '<li id="category_'+data.id+'"><IMG SRC="../Public/images/folder.gif" WIDTH="18" HEIGHT="18" BORDER="0" ALT="" align="absmiddle"><A HREF="__APP__/Category/'+data.id+'">'+data.title+'</A> <span >(0)</span><IMG SRC="../Public/images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" style="cursor:pointer" ALT="" onclick="delCategory('+data.id+')" align="absmiddle">';
		}
	}
	function delCategory(id){
		ThinkAjax.send('__APP__/Category/delete/','ajax=1&id='+id,delComplete);
	}
	function delComplete(data,status){
		if (status==1)
		{
			$('category_'+data).style.display = 'none';
		}
	}
//-->
</SCRIPT>
<div id="sidebar" class="sidebar">
<div id="innerSidebar">
  <div id="panelSearch" class="panel">
  <div id="panelStats" class="panel">
  <h5>统计数据</h5>
  <div class="panel-content">
	创建日期：<span style="color:#CC9933"><?php echo (toDate($beginTime,'Y-m-d')); ?></span><BR>
	日志总数：<span style="color:#CC9933"><?php echo ($blogCount); ?></span><BR>
	阅读总数：<span style="color:#6699FF"><?php echo ($readCount); ?></span><BR>
	评论总数：<span style="color:#FF9900"><?php echo ($commentCount); ?></span> <BR>
  </div>
  </div>
	<H5 >日志分类 </H5><div class="panel-content">
  <ul id="category">
  <li><div class="fLeft" ><INPUT TYPE="text" id="categoryName" class="text" NAME="name"></div><INPUT TYPE="button" value="增 加" class="submit hMargin small" onclick="addCategory()"><br style="clear:both;float:auto"/></li><?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li id="category_<?php echo ($vo["id"]); ?>"><IMG SRC="../Public/images/folder.gif" WIDTH="18" HEIGHT="18" BORDER="0" ALT="" align="absmiddle"><A HREF="__APP__/Blog/category/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></A> <span >(<?php echo (getCategoryBlogCount($vo["id"])); ?>)</span> <IMG SRC="../Public/images/del.gif" style="cursor:pointer" WIDTH="20" HEIGHT="20" BORDER="0" ALT="" onclick="delCategory(<?php echo ($vo["id"]); ?>)" align="absmiddle"></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div>
</div>
  <div id="panelSearch" class="panel">
<H5 >最新日志</H5><div class="panel-content">
  <ul><?php if(is_array($lastArticles)): $i = 0; $__LIST__ = $lastArticles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><IMG SRC="../Public/images/icon_ctb.gif" WIDTH="11" HEIGHT="11" BORDER="0" ALT="" align="absmiddle"> <A HREF="__APP__/Blog/show/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>"><?php echo (getShortTitle($vo["title"])); ?></A> <sup style="color:silver;font-size:12px"> [<span style="color:#3366CC"><?php echo ($vo["readCount"]); ?></span> |<span style="color:#FF6600"> <?php echo ($vo["commentCount"]); ?></span>]</sup><?php endforeach; endif; else: echo "" ;endif; ?></ul></div>
</div>

  <div id="panelSearch" class="panel">
<H5 >最新评论</H5><div class="panel-content">
  <ul><?php if(is_array($lastComments)): $i = 0; $__LIST__ = $lastComments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><IMG SRC="../Public/images/Comment.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT="" align="absmiddle"> <A HREF="mailto:<?php echo ($vo["email"]); ?>"> <span style="color:#3366CC"><?php echo ($vo["author"]); ?></span></A>：<A HREF="__APP__/blog/<?php echo ($vo["recordId"]); ?>#<?php echo ($vo["id"]); ?>" title=""><?php echo (getShortTitle(strip_tags(ubb($vo["content"])))); ?></A><?php endforeach; endif; else: echo "" ;endif; ?></ul></div>
</div>

  <div id="panelSearch" class="panel">
<H5 >标签云集 [ <A HREF="__URL__/tag/">更多</A> ]</H5>
<div class="panel-content">
  <ul><li>
<?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><A HREF="__APP__/Blog/tag/name/<?php echo (urlencode($vo["name"])); ?>"><span style="font-size:<?php echo (getTitleSize($vo["count"])); ?>;color:<?php echo (rand_color($vo["id"])); ?>"><?php echo ($vo["name"]); ?></span></A>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?></ul></div>
</div>

  <div id="panelSearch" class="panel">
	<H5 >日志归档</H5> 	<div class="panel-content">
  <ul><?php if(is_array($monthList)): $i = 0; $__LIST__ = $monthList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$date): ++$i;$mod = ($i % 2 )?><li> <IMG SRC="../Public/images/icon_quote.gif" WIDTH="11" HEIGHT="11" BORDER="0" ALT="" align="absmiddle"> <A HREF="__APP__/blog/<?php echo ($date['year']); ?>/<?php echo ($date['month']); ?>"><?php echo (toDate($date['show'],'Y年m月')); ?></A><?php endforeach; endif; else: echo "" ;endif; ?></ul></div>
</div>
</div>
</div>



</div>

<!-- 版权信息区域 -->
<div id="footer" class="footer" >
    <div id="innerFooter">Powered by ThinkPHP <?php echo constant("THINK_VERSION");?>| Template designed by <a target="_blank" href="http://www.topthink.com.cn">TopThink</a></div>
</div>
</body>
</html>