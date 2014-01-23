<?php
/*
Template Name: Testimonials
*/
get_header(); ?>
<div id="testimonials" class="clearfix">
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
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
		<ul class="items clearfix">
			<?php
			     $query = new WP_Query(array('post_type' => 'testimonial'));
			     while ($query->have_posts()) : $query->the_post();
			 ?>
			<?php $postcount++;
			$new_class = ( ($postcount % 2) == 0 ) ? "right" : "left"; ?>
			<li class="item <?php echo $new_class ?>">
				<div class="bubble">
					<div class="inner">
						<?php the_field("content"); ?>
					</div> 
				</div>
				<span><?php the_title(); ?></span>
			</li>
			<?php endwhile; // end of the loop. ?>
		
		</ul>
	</div>
</div><!-- #front-page -->
<?php get_footer(); ?>	