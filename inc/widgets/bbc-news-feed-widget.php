<?php 

class BBC_News_Feed extends WP_Widget {
	
	function BBC_News_Feed() {
		$widget_opts = array( 'description' => __('Use this widget is to show the BBC news feed.') );
		parent::WP_Widget(false, 'BBC News Feed', $widget_opts);
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
		$context = stream_context_create(array(
			'http' => array(
			'header'  => "Authorization: Basic " . base64_encode("globalnewslimitedthirdparties:Gnl3rdParties")
			)
		));
		$xml_content = file_get_contents('http://news5.thdo.bbc.co.uk/syndication/feeds/newsonline_world_edition/business/rss091.xml', false, $context);
		$xml = new SimpleXmlElement($xml_content);
		echo $args['before_widget'];
		?>
		<header class="header">
			<h2 class="ir title"><?php _e("BBC News", 'mjr_talent'); ?></h2>
			<div class="inner">
				<h4><?php _e("Top Business Stories", 'mjr_talent'); ?></h4>
			</div>
		</header>
		<?php if(!empty($xml)): ?>
		<div class="posts">
			<ul class="posts-list">
			<?php $i = 0; ?>
			<?php foreach($xml->channel->item as $item): ?>
				<?php if($i < 5): ?>
				<li class="dark-grey-bg">
					<h5 class="title">
						<a href="<?php echo $item->guid; ?>" class="yellow">
							<?php echo $item->title; ?>
						</a>
					</h5>
				</li>
				<?php endif; ?>
				<?php $i++; ?>
			<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<footer class="footer">
			<h4><a href="http://www.bbc.co.uk/news" class="white"><?php _e("Read More on BBC News", 'mjr_talent'); ?></a></h4>
		</footer>
		<?php
		echo $args['after_widget'];
	}
}

register_widget('BBC_News_Feed');



?>
