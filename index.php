<?php get_header(); ?>
<div id="index" class="clearfix">
	<div class="inner span eight center">
		<header class="index-header header">
			<h1 class="title cooper-black"><?php _e("News", 'major_talent'); ?>
		</header>
		<div id="posts" class="clearfix">
		<?php if(have_posts()): ?>
		<?php while (have_posts() ) : the_post(); ?>
				<div class="post clearfix">
					<a href="<?php the_permalink(); ?>">
						<?php if(has_post_thumbnail()): ?>
						<?php the_post_thumbnail('medium');?>
						<?php else:?>
						<img src="http://lorempixel.com/800/380/" class="scale"/>
						<?php endif; ?>
					</a>
					<div class="content clearfix">
						<div class="inner span eight push-one">
							<header class="header">
								<div class="post-meta avenir-medium small"><?php the_category(', '); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php the_time(get_option('date_format')); ?></div>
								<h2 class="title avenir-black text-left"><?php the_title(); ?></h1>
							</header>
							<div class="excerpt">
								<?php the_content(); ?>
							</div>
							<p class="big italic">
								<a href="<?php the_permalink(); ?>"><?php _e("Read the full story &raquo;", 'major_talent'); ?></a>
							</p>
						</div>
					</div>
				</div>
		<?php endwhile; ?>
		<?php else: ?>
			<header class="index-header clearfix">
				<h1><?php _e("Error 404 - Not Found", 'mjr_talent'); ?></h1>
			</header>
			<div class="content">
				<h4><?php _e("This might have been because:", 'mjr_talent');?></h4>
				<p><?php _e("You typed the web address incorrectly, or the page you are looking for may have been moved, updated or deleted.", 'mjr_talent');?></p>
	
				<h3><?php _e("Please try the <a href=\"".get_bloginfo('url')."\">MaJoR Talent</a> homepage to find what you are looking for.", 'mjr_talent');?></h3>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div><!-- #front-page -->
<?php get_footer(); ?>	