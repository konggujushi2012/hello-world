<?php get_header(); ?>
<div class="mainContent">
    <aside>
      <div class="avatar">
        <a href="#" ><span>青轻飞扬</span></a>
      </div>
      <section class="topspaceinfo">
        <h1>执子之手，与子偕老</h1>
        <p>于千万人之中，我遇见了我所遇见的人....</p>
      </section>
      <div class="userinfo"> 
        <p class="q-fans"> 粉丝：<a href="/" target="_blank">167</a></p> 
        <p class="btns"><a href="/" target="_blank" >私信</a><a href="/" target="_blank">相册</a><a href="/" target="_blank">存档</a></p>   
      </div>
      <section class="newpic">
         <h2>最新照片</h2>
         <ul>
           <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/01.jpg"></a></li>
           <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/02.jpg"></a></li>
           <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/03.jpg"></a></li>
           <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/04.jpg"></a></li>
           <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/05.jpg"></a></li>
           <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/06.jpg"></a></li>
           <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/07.jpg"></a></li>
           <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/08.jpg"></a></li>
         </ul>
      </section>
      <section class="taglist">
         <h2>全部标签</h2>
         <ul>
           <li><a href="/">青空</a></li>
           <li><a href="/">情感聊吧</a></li>
           <li><a href="/">study</a></li>
           <li><a href="/">青青唠叨</a></li>
        </ul>
      </section>
    </aside>
    <div class="blogitem">
	  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
      <article>
        <h2 class="title"><a href="/"><?php the_title(); ?></a></h2>
        <ul class="text">
          <?php the_content(); ?>
        </ul>
        <div class="textfoot">
          <a href="/">阅读全文</a><a href="/">评论</a><a href="/">转载</a>
        </div>
      </article> 
	  <?php endwhile; else : ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	  <?php endif; ?>
      <div class="pages"><span>1</span><a href="/" hidefocus="">2</a><a href="/" hidefocus="">3</a><a href="/" class="next">下一页&gt;&gt;</a></div>
    </div>
 </div>
<?php get_footer(); ?>