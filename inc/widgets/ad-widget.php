<?php 

class Ad extends WP_Widget {
	
	function Ad() {
		parent::WP_Widget(false, 'Ad');
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
		if (!isset($_SERVER['HTTP_COUNTRY']) || $_SERVER['HTTP_COUNTRY'] != "us") :
		echo $args['before_widget'];
		?>
	    <div id="bbccom_mpu" class="bbccom_display_none ad-mpu show-on-desktop">
		    <script type="text/javascript">
		    if(typeof BBC != 'undefined' && typeof BBC.adverts != 'undefined'){
	        	BBC.adverts.write("mpu");
				BBC.adverts.show('mpu');
	        }
		    </script>
	    </div>
		<?php 
		echo $args['after_widget'];
		endif;
	}
}

register_widget('Ad');
?>