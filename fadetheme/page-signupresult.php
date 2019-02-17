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
<article>
	<div class="article-content">
		<p></p>
		<?php if(isset($_GET['result'])){ $result = $_GET['result'];} ?>
		<?php if($result == 0) : ?>
		<p style="text-align: center;">报名成功，感谢您的参与。有任何问题，请咨询微信公众号：<strong>说好英语</strong></p>
		<?php elseif($result == 1) : ?>
		<p style="text-align: center;">该微信号已经报名，请勿重复报名。有任何问题，请咨询微信公众号：<strong>说好英语</strong></p>
		<?php elseif($result == 2) : ?>
		<p style="text-align: center;">报名失败，详细原因，请咨询微信公众号：<strong>说好英语</strong></p>
		<?php else : endif; ?>
		<p>&nbsp;</p>
		<p>
			<a href="<?php bloginfo('template_directory'); ?>/images/wx.jpg"><img class="aligncenter size-medium wp-image-75" src="<?php bloginfo('template_directory'); ?>/images/wx.jpg" alt="" width="300" height="300" sizes="(max-width: 300px) 100vw, 300px">
			</a>
		</p>
		<p>&nbsp;</p>
		<p></p>
	</div>
</article>
<?php get_footer(); ?>