<?php 

class Profiles extends WP_Widget {
	
	function Profiles() {
		parent::WP_Widget(false, 'Profiles');
	}
	function form($instance) {
		
		// $title = (isset($instance['title'])) ? esc_attr($instance['title']) : '';  
  		// echo '<p><label>';
		// echo _e('Title:').'<input class="widefat" name="'. $this->get_field_name('title').'" type="text" value="'. $title.'" />';
  		// echo '</label></p>';
	}
	function update($new_instance, $old_instance){
		return $new_instance;
	}
	
	function widget($args, $instance) {
		//$args['title'] = $instance['title'];
		global $episode;
		if(isset($episode)):
			$clips = get_field('clips', $episode->ID);
			$profiles = array();
			if($clips){
				$profile_ids = array();
				foreach($clips as $clip){
					if( isset($clip->ID) ){
						$clips_profiles = get_field('profiles', $clip->ID);
						if($clips_profiles){
							foreach($clips_profiles as $clips_profile){
								if(!in_array($clips_profile->ID, $profile_ids)){
									$profiles[] = $clips_profile;
									$profile_ids[] = $clips_profile->ID;
								}
							}
						}
					}
				}
			}

			if($profiles):
				echo $args['before_widget'];
			?>
				<header class="widget-header">
					<h3 class="blue title"><?php _e("Profiles", 'mjr_talent'); ?></h3>
				</header>
				<div class="profiles">
					<ul>
						<?php 
						global $post;
						foreach($profiles as $post):
							setup_postdata($post);		
						?>
						<li class="profile post clearfix" data-id="<?php echo get_the_ID(); ?>" data-url="<?php echo $post->post_name; ?>">
							<a class="read-more-btn arrow-down-btn clearfix">
								<div class="span alpha three image">
									<span class="thumbnail">
										<?php the_post_thumbnail('thumbnail', array('class' => 'scale')); ?>
									</span>
								</div>
								<header class="span alpha seven header">
									<h4 class="title yellow"><?php the_title(); ?></h4>
									<div class="excerpt summary">
										<h6 class="no-margin white"><?php echo get_the_excerpt(); ?></h6>
									</div>
								</header>
							</a>
							<div class="clearfix hide more">
								<div class="content push-three alpha">
									<?php the_content(); ?>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
		<?php  
			echo $args['after_widget'];
		endif;
	}
}

register_widget('Profiles');
?>