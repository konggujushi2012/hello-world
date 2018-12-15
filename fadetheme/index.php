<?php get_header(); ?>
<article> 
  <!--banner begin-->
 <div class="picsbox"> 
  <div class="banner">
    <div id="banner" class="fader">
	  <?php $query = get_banner_posts(); ?>
	  <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
		<li class="slide" ><a href="/" target="_blank"><img src="<?php echo catch_that_image(get_the_content(),$out); ?>"><span class="imginfo"><?php the_title(); ?></span></a></li>
	  <?php endwhile; else : ?>
		<p><?php _e('Sorry, no page found.'); ?></p>
	  <?php endif; wp_reset_postdata();//必须要加上此句重置查询 ?>
      <!--<li class="slide" ><a href="/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/banner01.jpg"><span class="imginfo">别让这些闹心的套路，毁了你的网页设计!</span></a></li>
      <li class="slide" ><a href="/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/banner02.jpg"><span class="imginfo">网页中图片属性固定宽度，如何用js改变大小</span></a></li>
      <li class="slide" ><a href="/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/banner03.jpg"><span class="imginfo">个人博客，属于我的小世界！</span></a></li>
	  <li class="slide" ><a href="/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/banner02.jpg"><span class="imginfo">网页中图片属性固定宽度，如何用js改变大小</span></a></li>
	  <li class="slide" ><a href="/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/banner03.jpg"><span class="imginfo">个人博客，属于我的小世界！</span></a></li>-->
      <div class="fader_controls">
        <div class="page prev" data-target="prev">&lsaquo;</div>
        <div class="page next" data-target="next">&rsaquo;</div>
        <ul class="pager_list">
        </ul>
      </div>
    </div>
  </div>
  <!--banner end-->
  <div class="toppic">
    <li> <a href="/" target="_blank"> <i><img src="<?php bloginfo('template_directory'); ?>/images/toppic01.jpg"></i>
      <h2>别让这些闹心的套路，毁了你的网页设计!</h2>
      <span>学无止境</span> </a> </li>
    <li> <a href="/" target="_blank"> <i><img src="<?php bloginfo('template_directory'); ?>/images/zd01.jpg"></i>
      <h2>个人博客，属于我的小世界！</h2>
      <span>学无止境</span> </a> </li>
  </div>
  </div>
  <div class="blank"></div>
  <!--blogsbox begin-->
  <div class="blogsbox">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="blogs" data-scroll-reveal="enter bottom over 1s" >
	  <h3 class="blogtitle"><a href="/" target="_blank"><?php the_title(); ?></a></h3>
	  <?php $cate_name = get_post_imagetype() ; ?><!--通过分类名来判断怎样显示文章-->
	  <?php if($cate_name == 'thumbnail') : ?>
		<span class="blogpic"><a href="/" title=""><img src="<?php echo catch_that_image(get_the_content(),$out); ?>" alt=""></a></span>
	  <?php elseif($cate_name == 'bigimage') : ?>
		<span class="bigpic"><a href="/" title=""><img src="<?php echo catch_that_image(get_the_content(),$out); ?>" alt=""></a></span>
	  <?php elseif($cate_name == 'imagelist') : ?>
		<?php catch_that_image(get_the_content(),$all_images); $count = count($all_images); ?><!--通过文章中的图片数量来判断是否显示图片列表-->
		<?php if($count >= 3) : ?>
		<span class="bplist"><a href="/" title="">
		  <?php for($i = 0; $i < 3; ++$i){ ?><!--如果文章中的图片大于3张，则只显示前3张-->
			<li><img src="<?php echo $all_images[$i] ?>" alt=""></li>
		  <?php } ?>
		<?php elseif($count < 3 && $count >= 1) : ?><!--如果文章中的图片小于3张，则不显示图片列表，仍然按照'thumbnail'的方式显示一张缩略图-->
			<span class="blogpic"><a href="/" title=""><img src="<?php echo catch_that_image(get_the_content(),$out); ?>" alt=""></a></span>
		<?php else : endif; ?><!--如果没有图片，则直接显示后面的文章-->
		</a></span>
	  <?php else : endif; ?><!--如果没有设置这三种类型中的一种，则不显示图片-->
	  <p class="blogtext"><?php echo wp_trim_words( get_the_content(),85); ?></p>
	  <div class="bloginfo">
		<ul>
		  <li class="author"><a href="/"><?php the_author(); ?></a></li>
		  <li class="lmname"><a href="/">学无止境</a></li>
		  <li class="timer"><?php the_modified_date('Y-m-d'); ?></li>
		  <li class="view"><span>34567</span>已阅读</li>
		  <li class="like">9999</li>
		</ul>
	  </div>
	</div>
	<?php endwhile; else : ?>
		<p><?php _e('Sorry, no page found.'); ?></p>
	<?php endif; ?>
    
  </div>
  <!--blogsbox end-->
  <?php get_sidebar(); ?>
</article>
<?php get_footer(); ?>
