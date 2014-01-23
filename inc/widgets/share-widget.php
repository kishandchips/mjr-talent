<?php 

class Share extends WP_Widget {
	
	function Share() {
		parent::WP_Widget(false, 'Share');
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
		echo $args['before_widget'];
	?>
		<div class="bbc-st bbc-st-full">
		    <a href="/modules/sharetools/share?url=<?php echo urlencode(get_permalink()); ?>&appId=gnlchangingfortunes">Share this page</a>
		</div>
	<?php 
		echo $args['after_widget'];
	}
}

register_widget('Share');
?>