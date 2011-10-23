<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<div id="mainWrapper">
<div id="content" class="content">
<div id="innerContent">
<div class="announce">
<div class="announce-content" style="height:45px"><H4>[ <?php echo ($categoryName); ?> ] 下面的日志<span style="font-weight:normal"> [ <?php echo ($count); ?> ] </span></H4></div>
</div>
<div class="article-top"><div class="pages">共<?php echo ($page); ?></div></div>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="textbox-list">
<div class="textbox-list-title"><IMG SRC="../Public/images/icon_point2.gif" WIDTH="13" HEIGHT="13" BORDER="0" ALT="" align="absmiddle"> <A HREF="__URL__/show/id/<?php echo ($vo["id"]); ?>"><?php echo (ubb($vo["title"])); ?></A> <?php echo (toDate($vo["cTime"],'Y-m-d')); ?> </div><div class="textbox-author">  [ <A HREF="__URL__/<?php echo ($vo["id"]); ?>#reply"> <?php echo ($vo["commentCount"]); ?></A> | <?php echo ($vo["readCount"]); ?>  ]</div></div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="article-bottom"><div class="pages">共<?php echo ($page); ?></div></div>
 </div>

</div>

<div id="sidebar" class="sidebar">
<div id="innerSidebar">
  <div id="panelSearch" class="panel">
	<H5 >日志分类</H5><div class="panel-content">
  <ul>
  <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><IMG SRC="../Public/images/folder.gif" WIDTH="18" HEIGHT="18" BORDER="0" ALT="" align="absmiddle"> <A HREF="__APP__/Blog/category/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></A> <span >(<?php echo (getCategoryBlogCount($vo["id"])); ?>)</span><?php endforeach; endif; else: echo "" ;endif; ?></ul></div>
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
	<H5 >日志归档</H5> 	<div class="panel-content">
  <ul><?php if(is_array($monthList)): $i = 0; $__LIST__ = $monthList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$date): ++$i;$mod = ($i % 2 )?><li> <IMG SRC="../Public/images/icon_quote.gif" WIDTH="11" HEIGHT="11" BORDER="0" ALT="" align="absmiddle"> <A HREF="__APP__/blog/<?php echo ($date['year']); ?>/<?php echo ($date['month']); ?>"><?php echo (toDate($date['show'],'Y年m月')); ?></A><?php endforeach; endif; else: echo "" ;endif; ?></ul></div>
</div>
</div>
</div>

</div> <!-- 版权信息区域 -->
<div id="footer" class="footer" >
    <div id="innerFooter">Powered by ThinkPHP <?php echo constant("THINK_VERSION");?>| Template designed by <a target="_blank" href="http://www.topthink.com.cn">TopThink</a></div>
</div>
</body>
</html>