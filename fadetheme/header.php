<!doctype html>
<html>
<head>
<meta charset="gbk">
<link id="favicon" href="https://www.runtimego.com/favicon.ico" rel="icon" type="image/x-icon" />
<title><?php if (is_home()||is_search()) { bloginfo('name'); } else{wp_title(''); echo ' | '; bloginfo('name');} ?> </title>
<meta name="keywords" content="丹青的个人博客" />
<meta name="description" content="这是个有点文艺的程序员写的个人博客，丹青。" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="baidu-site-verification" content="DbpTmBOPRv" />
<?php wp_head(); ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?4c665bf0f40aa438244aed4a25f07694";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
<header> 
  <!--menu begin-->
  <div class="menu">
    <nav class="nav" id="topnav">
      <h1 class="logo"><a href="https://www.runtimego.com">三年一班</a></h1>
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
    <h2><a href="https://www.runtimego.com" class="mlogo">三年一班</a><span class="navicon"></span></h2>
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