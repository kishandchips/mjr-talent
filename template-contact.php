<?php
/*
Template Name: Contact
*/
get_header(); ?>
<div id="template-contact" class="clearfix">
	<div class="inner">
		<div id="content" class="clearfix">
		<?php if(have_posts()): ?>
		<?php while (have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>
		</div>
	</div>
</div><!-- #front-page -->
<?php get_footer(); ?>	