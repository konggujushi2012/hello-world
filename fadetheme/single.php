<?php get_header(); ?>
<article>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<h1 class="t_nav"><span>您现在的位置是：首页 > <?php echo get_first_cat_name(); ?></span>
		<a href="https://www.runtimego.com" class="n1">网站首页</a>
		<a href="<?php echo get_cat_link(get_first_cat_name()); ?>" class="n2"><?php echo get_first_cat_name(); ?></a>
	</h1>
	  <div class="infosbox">
		<div class="newsview">
		  <h3 class="news_title"><?php the_title(); ?></h3>
		  <div class="bloginfo">
			<ul>
			  <li class="author"><a href="#"><?php the_author(); ?></a></li>
			  <li class="lmname"><a href="<?php echo get_cat_link(get_first_cat_name()); ?>"><?php echo get_first_cat_name(); ?></a></li>
			  <li class="timer"><?php the_modified_date('Y-m-d'); ?></li>
			  <li class="view">567已阅读</li>
			  <li class="like">99</li>
			</ul>
		  </div>
		  <!--<div class="tags"><a href="/" target="_blank">个人博客</a> &nbsp; <a href="/" target="_blank">小世界</a></div>-->
		  <!--<div class="news_about"><strong>简介</strong><?php echo get_the_excerpt(); ?></div>-->
		  <hr /><br />
		  <div class="news_con">
			<?php the_content(); ?>
			&nbsp; </div>
		</div>
		<div class="share">
		  <p class="diggit"><a href="JavaScript:makeRequest('/e/public/digg/?classid=3&amp;id=19&amp;dotop=1&amp;doajax=1&amp;ajaxarea=diggnum','EchoReturnedText','GET','');"> 很赞哦！ </a>(<b id="diggnum"><script type="text/javascript" src="/e/public/ViewClick/?classid=2&id=20&down=5"></script>13</b>)</p>
		  <p class="dasbox"><a href="javascript:void(0)" onClick="dashangToggle()" class="dashang" title="打赏，支持一下">打赏本站</a></p>
		  <div class="hide_box"></div>
		  <div class="shang_box"> <a class="shang_close" href="javascript:void(0)" onclick="dashangToggle()" title="关闭">关闭</a>
			<div class="shang_tit">
			  <p>感谢您的支持，我会继续努力的!</p>
			</div>
			<div class="shang_payimg"> <img src="images/alipayimg.jpg" alt="扫码支持" title="扫一扫"> </div>
			<div class="pay_explain">扫码打赏，你说多少就多少</div>
			<div class="shang_payselect">
			  <div class="pay_item checked" data-id="alipay"> <span class="radiobox"></span> <span class="pay_logo"><img src="images/alipay.jpg" alt="支付宝"></span> </div>
			  <div class="pay_item" data-id="weipay"> <span class="radiobox"></span> <span class="pay_logo"><img src="images/wechat.jpg" alt="微信"></span> </div>
			</div>
			<script type="text/javascript">
		$(function(){
			$(".pay_item").click(function(){
				$(this).addClass('checked').siblings('.pay_item').removeClass('checked');
				var dataid=$(this).attr('data-id');
				$(".shang_payimg img").attr("src","images/"+dataid+"img.jpg");
				$("#shang_pay_txt").text(dataid=="alipay"?"支付宝":"微信");
			});
		});
		function dashangToggle(){
			$(".hide_box").fadeToggle();
			$(".shang_box").fadeToggle();
		}
		</script> 
		  </div>
		</div>
		<div class="nextinfo">
		  <p><?php previous_post_link('上一篇: %link', '%title', 'TRUE'); ?></p>
		  <p><?php next_post_link('下一篇: %link', '%title', TRUE); ?></p>
		</div>
		<div class="news_pl">
		  <h2>文章评论</h2>
		  <ul>
			<div class="gbko"> </div>
		  </ul>
		</div>
	  </div>
	  <?php get_sidebar(); ?>
	<?php endwhile; else : ?>
		<p><?php _e('Sorry, no page found.'); ?></p>
	<?php endif; ?>
	
</article>
<?php get_footer(); ?>