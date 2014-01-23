<?php get_header(); ?>
<div class="a-z-ofcelebs">
    <span>A-Z</span>
    OF CELEBS
</div>
<div id="page" class="clearfix">
	<div class="inner">
		<div id="content" class="clearfix">
		<?php if(have_posts()): ?>
		<?php while (have_posts() ) : the_post(); ?>
				<div class="top-content clearfix">
					<div class="span eight center">
						<h1 class="title cooper-black"><?php the_title(); ?></h1>
					</div>
				</div>
				<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>
		</div>
	</div>
</div><!-- #front-page -->
<?php get_footer(); ?>	