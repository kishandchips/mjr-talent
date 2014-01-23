<?php

add_shortcode( 'base_url', 'base_url_handler' );
function base_url_handler( $atts ) {
	return get_bloginfo('url');
}

add_shortcode( 'uploads_url', 'uploads_url_handler' );
function uploads_url_handler( $atts ) {
	$uploads_dir = wp_upload_dir();
	return $uploads_dir['baseurl'];
}

add_shortcode('span', 'span_handler');
function span_handler( $atts, $content = null ) {
	extract(shortcode_atts(array(
	   'width' => '',
	   'class' => '',
	   'style' => '',
	), $atts));
	$widths = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');
	$span_width = $widths[intval($width) - 1];
	return '<div class="span '.$span_width.' '. $class.'" style="'.$style.'">'. apply_filters('shortcode_out_filter', do_shortcode($content)) . '</div>';
}

add_shortcode('one_half', 'one_half_handler');
function one_half_handler( $atts, $content = null ) {
	return '<div class="span five">'. apply_filters('shortcode_out_filter', do_shortcode($content)) . '</div>';
}

add_shortcode('one_third', 'one_third');
function one_third( $atts, $content = null ) {
	return '<div class="span three">' . apply_filters('shortcode_out_filter', do_shortcode($content)) . '</div>';
}

add_shortcode('padding', 'padding_handler');
function padding_handler( $atts, $content = null ) {
	return '<div class="padding">' . apply_filters('shortcode_out_filter', do_shortcode($content)) . '</div>';
}

add_shortcode('container', 'container_handler');
function container_handler( $atts, $content = null ) {
	return '<div class="container">' . apply_filters('shortcode_out_filter', do_shortcode($content)) . '</div>';
}

add_shortcode('row', 'row_handler');
function row_handler($atts, $content = null) {
	extract(shortcode_atts(array(
       'class' => '',
       'style' => ''
	), $atts));
	return '<div class="row clearfix '. $class.'" style="'.$style.'">'. apply_filters('shortcode_out_filter', do_shortcode($content)) .'</div>';
}

add_shortcode('top_content', 'top_content_handler');
function top_content_handler($atts, $content = null) {
	return '<div class="top-content clearfix"><div class="inner center span eight">'. apply_filters('shortcode_out_filter', do_shortcode($content)) .'</div></div>';
}


