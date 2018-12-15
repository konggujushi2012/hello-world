<!doctype html>
<html>
<head>
<meta charset="gbk">
<title><?php wp_title(); ?></title>
<meta name="keywords" content="个人博客,杨青个人博客,个人博客模板,杨青" />
<meta name="description" content="杨青个人博客，是一个站在web前端设计之路的女程序员个人网站，提供个人博客模板免费资源下载的个人原创网站。" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body>
<header> 
  <!--menu begin-->
  <div class="menu">
    <nav class="nav" id="topnav">
      <h1 class="logo"><a href="http://www.yangqq.com">三年一班</a></h1>
	  <?php 
		$defaults = array(
			'container' => false,
			'theme_location' => 'primary-menu',
			'items_wrap'  => '%3$s'
		);
		wp_nav_menu($defaults);
	  ?>
      <!--search begin-->
      <div id="search_bar" class="search_bar">
        <form  id="searchform" action="[!--news.url--]e/search/index.php" method="post" name="searchform">
          <input class="input" placeholder="想搜点什么呢..." type="text" name="keyboard" id="keyboard">
          <input type="hidden" name="show" value="title" />
          <input type="hidden" name="tempid" value="1" />
          <input type="hidden" name="tbname" value="news">
          <input type="hidden" name="Submit" value="搜索" />
          <span class="search_ico"></span>
        </form>
      </div>
      <!--search end--> 
    </nav>
  </div>
  <!--menu end--> 
  <!--mnav begin-->
  <div id="mnav">
    <h2><a href="http://www.yangqq.com" class="mlogo">三年一班</a><span class="navicon"></span></h2>
    <dl class="list_dl">
      <?php 
		$defaults = array(
			'container' => false,
			'theme_location' => 'primary-menu',
			'items_wrap'  => '%3$s'
		);
		wp_nav_menu($defaults);
	  ?>
    </dl>
  </div>
  <!--mnav end--> 
</header>