<?php
/**
 * mjr_talent functions and definitions
 *
 * @package mjr_talent
 * @since mjr_talent 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since mjr_talent 1.0
 */


if ( ! function_exists( 'mjr_talent_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since mjr_talent 1.0
 */


function mjr_talent_setup() {
	
	add_filter('shortcode_out_filter', 'clear_autop');
	function clear_autop($content){
	    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

	    if ( substr( $content, 0, 4 ) == '' )
	        $content = substr( $content, 4 );

	    if ( substr( $content, -3, 3 ) == '' )
	        $content = substr( $content, 0, -3 );

		$content = str_replace( array( '<p></p>' ), '', $content );
	    $content = str_replace( array( '<p>  </p>' ), '', $content );

	    return $content;
	}

	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 99);
	add_filter( 'the_content', 'shortcode_unautop',100 );	

	require( get_template_directory() . '/inc/shortcodes.php' );

	require( get_template_directory() . '/inc/options.php' );

add_action('init', 'set_custom_post_types');

if(!function_exists('set_custom_post_types')) {
	function set_custom_post_types(){
		require( get_template_directory() . '/inc/custom_post_type.php' );

	   	$testimonials = new Custom_Post_Type( 'Testimonial', 
	 		array(
	 			'rewrite' => array( 'with_front' => false, 'slug' => 'testimonials' ),
	 			'capability_type' => 'post',
	 		 	'publicly_queryable' => true,
	   			'has_archive' => true, 
	    		'hierarchical' => true,
	    		'exclude_from_search' => false,
	    		'menu_position' => null,
	    		'supports' => array('title', 'thumbnail', 'editor'),
	    		'plural' => 'Testimonials'
	   		)
	   	);	   		   	

	 	// global $wp_rewrite;
		// $wp_rewrite->flush_rules();
}}	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on mjr_talent, use a find and replace
	 * to change 'mjr_talent' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mjr_talent', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mjr_talent' )
	) );

	add_image_size( 'crop_large', 670, 370, true);
	add_image_size( 'crop_medium', 300, 200, true);
	add_image_size( 'crop_small', 210, 120, true);

	//add_filter('jpeg_quality', function($arg){return 100;});

	/**
	 * Add support for the Aside Post Formats
	 */
	//add_theme_support( 'post-formats', array( 'gallery' ) );

	add_filter('excerpt_more', 'new_excerpt_more');

	function new_excerpt_more($more) {
		return '';
	}

	add_filter('widget_text', 'do_shortcode');

   	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

	function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
	}

   	// $episode = new Custom_Post_Type( 'Episode',
   	// 	array(
   	// 		'rewrite' => array( 'slug' => 'episodes'),
    // 		'capability_type' => 'post',
    // 		'has_archive' => true, 
    // 		'hierarchical' => false,
    // 		'menu_position' => null,
    // 		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
    // 		'show_in_nav_menus' => true
   	// 	)
   	// );
   	

  	//global $wp_rewrite; 
	//$wp_rewrite->flush_rewrite_rules();

	add_filter('gform_tabindex', create_function("", "return false;"));

}
endif; // mjr_talent_setup

add_action( 'after_setup_theme', 'mjr_talent_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since mjr_talent 1.0
 */
function mjr_talent_widgets_init() {
	// register_sidebar( array(
	// 	'name' => __( 'Default Sidebar', 'mjr_talent' ),
	// 	'id' => 'default',
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 	'after_widget' => '</aside>',
	// 	'before_title' => '<h3>',
	// 	'after_title' => '</h3>',
	// ) );
}
add_action( 'widgets_init', 'mjr_talent_widgets_init' );



if ( ! function_exists( 'get_top_level_category' )) {
	function get_top_level_category($id){
		$category = get_category($id);
		$parent_category = NULL;
		if($category->category_parent != 0){
			$parent_category = get_top_level_category($category->category_parent );
		} else {
			$parent_category = get_category($category->cat_ID);
		}
		return $parent_category;
	}
}

if ( ! function_exists( 'get_sub_category' )) {
	function get_sub_category($id){
		$sub_categories = get_categories( array('child_of' => $id, 'hierarchical' => false, 'orderby' => 'count'));
		foreach($sub_categories as $sub_category){
			if(has_category($sub_category->term_id)){
				$category = $sub_category;
			}
		}

		return $category;
	}
}

function get_the_adjacent_fukn_post($adjacent, $post_type = 'post', $category = array(), $post_parent = 0){
	global $post;
	$args = array( 
		'post_type' => $post_type,
		'order' => 'ASC', 
		'posts_per_page' => -1,
		'category__in' => $category,
		'post_parent' => $post_parent
	);
	
	$curr_post = $post;
	$new_post = NULL;
	$custom_query = new WP_Query($args);
	$posts = $custom_query->get_posts();
	$total_posts = count($posts);
	$i = 0;
	foreach($posts as $a_post) {
		if($a_post->ID == $curr_post->ID){
			if($adjacent == 'next'){
				$new_i = ($i + 1 >= $total_posts) ? 0 : $i + 1; 
				$new_post = $posts[$new_i];	
			} else {
				$new_i = ($i - 1 <= 0) ? $total_posts - 1 : $i - 1; 
				$new_post = $posts[$new_i];	
			}
			break;	
		}
		$i++;
	}
	
	return $new_post;
}

function get_mjr_talent_option($option){
	$options = get_option('mjr_talent_theme_options');
	return $options[$option];
}

if ( ! function_exists( 'array_insert' )) {
	function array_insert(&$array,$element,$position=null) {
		if (count($array) == 0) {
			$array[] = $element;
		} elseif (is_numeric($position) && $position < 0) {
			if((count($array)+position) < 0) {
				$array = array_insert($array,$element,0);
			} else {
				$array[count($array)+$position] = $element;
			}
		} else if (is_numeric($position) && isset($array[$position])) {
			$part1 = array_slice($array,0,$position,true);
			$part2 = array_slice($array,$position,null,true);
			$array = array_merge($part1,array($position=>$element),$part2);
			foreach($array as $key=>$item) {
				if (is_null($item)) {
					unset($array[$key]);
				}
			}
		} else if (is_null($position)) {
			$array[] = $element;
		} else if (!isset($array[$position])) {
			$array[$position] = $element;
		}
		$array = array_merge($array);
		return $array;
	}
}


function paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => 1,
		'current' => $current,
		'show_all' => true,
		'type' => 'list',
		'next_text' => '&raquo;',
		'prev_text' => '&laquo;'
		);
	
	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	
	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo paginate_links( $pagination );
}

function add_body_class( $classes )
{
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_body_class' );






