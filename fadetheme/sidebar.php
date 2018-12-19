<div class="sidebar">
    <div class="tuijian">
      <h2 class="hometitle">推荐文章</h2>
      <ul class="tjpic">
	  <?php $query = get_recommend_top_post(); ?>
	  <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
		<i><img src="<?php echo catch_that_image(get_the_content(),$out); ?>"></i>
		<p><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
	  <?php endwhile; else : ?>
		<p><?php _e('Sorry, no page found.'); ?></p>
	  <?php endif; wp_reset_postdata();//必须要加上此句重置查询 ?>
      </ul>
      <ul class="sidenews">
	  <?php $query = get_recommend_posts(); ?>
	  <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
		<li> <i><img src="<?php echo catch_that_image(get_the_content(),$out); ?>"></i>
          <p><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
          <span>2018-05-13</span>
		</li>
	  <?php endwhile; else : ?>
		<p><?php _e('Sorry, no page found.'); ?></p>
	  <?php endif; wp_reset_postdata();//必须要加上此句重置查询 ?>
      </ul>
    </div>
    <div class="cloud">
      <h2 class="hometitle">标签云</h2>
      <ul>
	  <?php $tags = get_pre_count_tags(12); ?>
	  <?php foreach($tags as $tag) {?>
		<a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
	  <?php } ?>
      </ul>
    </div>
    <div class="links">
      <h2 class="hometitle">友情链接</h2>
      <ul>
        <li><a href="#" target="_blank">微信公众号：说好英语</a></li>
		<li class="wx"><img src="<?php bloginfo('template_directory'); ?>/images/wx.jpg"></li>
      </ul>
    </div>
    <!--<div class="guanzhu" id="follow-us">
      <h2 class="hometitle">关注我们 么么哒！</h2>
      <ul>
        <li class="sina"><a href="/" target="_blank"><span>新浪微博</span>杨青博客</a></li>
        <li class="tencent"><a href="/" target="_blank"><span>腾讯微博</span>杨青博客</a></li>
        <li class="qq"><a href="/" target="_blank"><span>QQ号</span>476847113</a></li>
        <li class="email"><a href="/" target="_blank"><span>邮箱帐号</span>dancesmiling@qq.com</a></li>
        <li class="wxgzh"><a href="/" target="_blank"><span>微信号</span>yangqq_1987</a></li>
        <li class="wx"><img src="<?php bloginfo('template_directory'); ?>/images/wx.jpg"></li>
      </ul>
    </div>-->
  </div>