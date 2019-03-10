<?php get_header(); ?>
<div class="pagebg sh"></div>
<div class="container">
  <h1 class="t_nav">
	<span>这里是标签页，你会看到所有标记为此标签的文章。</span>
	<a href="https://www.runtimego.com" class="n1">网站首页</a><a href="<?php echo get_current_tag_link(); ?>" class="n2"><?php single_tag_title(); ?></a>
  </h1>
  <!--blogsbox begin-->
  <div class="blogsbox">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="blogs" data-scroll-reveal="enter bottom over 1s" >
	  <h3 class="blogtitle"><a href="<?php echo get_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h3>
	  <?php $cate_name = get_post_imagetype() ; ?><!--通过分类名来判断怎样显示文章-->
	  <?php if($cate_name == 'thumbnail') : ?>
		<span class="blogpic"><a href="<?php echo get_permalink(); ?>" title=""><img src="<?php echo catch_that_image(get_the_content(),$out); ?>" alt=""></a></span>
	  <?php elseif($cate_name == 'bigimage') : ?>
		<span class="bigpic"><a href="<?php echo get_permalink(); ?>" title=""><img src="<?php echo catch_that_image(get_the_content(),$out); ?>" alt=""></a></span>
	  <?php elseif($cate_name == 'imagelist') : ?>
		<?php catch_that_image(get_the_content(),$all_images); $count = count($all_images); ?><!--通过文章中的图片数量来判断是否显示图片列表-->
		<?php if($count >= 3) : ?>
		<span class="bplist"><a href="<?php echo get_permalink(); ?>" title="">
		  <?php for($i = 0; $i < 3; ++$i){ ?><!--如果文章中的图片大于3张，则只显示前3张-->
			<li><img src="<?php echo $all_images[$i] ?>" alt=""></li>
		  <?php } ?>
		<?php elseif($count < 3 && $count >= 1) : ?><!--如果文章中的图片小于3张，则不显示图片列表，仍然按照'thumbnail'的方式显示一张缩略图-->
			<span class="blogpic"><a href="<?php echo get_permalink(); ?>" title=""><img src="<?php echo catch_that_image(get_the_content(),$out); ?>" alt=""></a></span>
		<?php else : endif; ?><!--如果没有图片，则直接显示后面的文章-->
		</a></span>
	  <?php else : endif; ?><!--如果没有设置这三种类型中的一种，则不显示图片-->
	  <p class="blogtext"><?php echo wp_trim_words( get_the_content(),85); ?></p>
	  <div class="bloginfo">
		<ul>
		  <li class="author"><a href="#"><?php the_author(); ?></a></li>
		  <li class="lmname"><a href="<?php echo get_cat_link(get_first_cat_name()); ?>"><?php echo get_first_cat_name(); ?></a></li>
		  <li class="timer"><?php the_modified_date('Y-m-d'); ?></li>
		  <li class="view"><span><?php get_post_views(get_the_ID()); ?></span>次阅读</li>
		  <li class="like">99</li>
		</ul>
	  </div>
	</div>
	<?php endwhile; else : ?>
		<p><?php _e('Sorry, no post found.'); ?></p>
	<?php endif; ?>
    
    
    <!--<div class="pagelist">
		<a title="Total record">&nbsp;<b>45</b> </a>&nbsp;&nbsp;&nbsp;<b>1</b>&nbsp;
		<a href="/download/index_2.html">2</a>&nbsp;
		<a href="/download/index_2.html">下一页</a>&nbsp;
		<a href="/download/index_2.html">尾页</a>
	</div>-->
    
  </div>
  <!--blogsbox end-->
  <?php get_sidebar(); ?>
</div>
<?php get_footer();?>
