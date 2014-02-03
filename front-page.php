<?php get_header(); ?>
<div id="front-page" class="clearfix">
	<div id="book">
		<div class="top"></div>
		<?php if(have_posts()): ?>
		<?php while (have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>
		<div class="bottom"></div>
	</div><!-- #book -->
	<div class="magazines hide-on-mobile"></div>
</div><!-- #front-page -->
<?php get_footer(); ?>