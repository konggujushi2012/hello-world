<?php get_header(); ?>
<article> 
  <!--banner begin-->
 <div class="picsbox"> 
  <div class="banner">
    <div id="banner" class="fader">
	  <?php $query = get_banner_posts(); ?>
	  <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
		<li class="slide" ><a href="<?php echo get_permalink(); ?>" target="_blank"><img src="<?php echo catch_that_image(get_the_content(),$out); ?>"><span class="imginfo"><?php the_title(); ?></span></a></li>
	  <?php endwhile; else : ?>
		<p><?php _e('Sorry, no page found.'); ?></p>
	  <?php endif; wp_reset_postdata();//必须要加上此句重置查询 ?>
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
	<?php $query = get_topright_posts(); ?>
	<?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
		<li> <a href="<?php echo get_permalink(); ?>" target="_blank"> <i><img src="<?php echo catch_that_image(get_the_content(),$out); ?>"></i>
		<h2><?php the_title(); ?></h2>
		<span><?php echo get_first_cat_name(); ?></span> </a> </li>
	<?php endwhile; else : ?>
		<p><?php _e('Sorry, no page found.'); ?></p>
	<?php endif; wp_reset_postdata();//必须要加上此句重置查询 ?>
  </div>
  </div>
  <div class="blank"></div>
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
    
  </div>
  <!--blogsbox end-->
  <?php get_sidebar(); ?>
</article>
<?php get_footer(); ?>
