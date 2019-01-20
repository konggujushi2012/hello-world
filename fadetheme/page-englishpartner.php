<?php get_header(); ?>
<article>
	<div class="article-content">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<p><?php the_content(); ?></p>
		<?php endwhile; else : ?>
			<p><?php _e('Sorry, no page found.'); ?></p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</article>
<?php get_footer(); ?>
