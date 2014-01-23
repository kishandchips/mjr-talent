<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package mjr_talent
 * @since mjr_talent 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/style.css" />
    
    <script> 
        var themeUrl = '<?php bloginfo( 'template_url' ); ?>';
        var baseUrl = '<?php bloginfo( 'url' ); ?>';
        var currUrl = '<?php echo get_permalink( $post->ID ); ?>';
    </script>
    
    <script type="text/javascript" src="http://fast.fonts.com/jsapi/ad71349d-242d-4acf-9f85-b0cf59eebf03.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/modernizr.min.js"></script>
    <script data-main="<?php echo get_template_directory_uri(); ?>/js/main" src="<?php echo get_template_directory_uri(); ?>/js/libs/require.js"></script>
    <script>
    requirejs.config({
        baseUrl: '<?php echo get_template_directory_uri(); ?>/js/',
        packages: [
            {
                name: 'jquery',
                location: 'libs/',
                main: 'jquery.min'
            },
            {
                name: 'jquery.scroller',
                location: 'plugins/',
                main: 'jquery.scroller'
            },
            {
                name: 'jquery.easing',
                location: 'plugins/',
                main: 'jquery.easing'
            },
            {
                name: 'jquery.sticky-float',
                location: 'plugins/',
                main: 'jquery.sticky-float'
            },
            {
                name: 'jquery.animate-in-view',
                location: 'plugins/',
                main: 'jquery.animate-in-view'
            },
            {
                name: 'jquery.animate-css-rotate-scale',
                location: 'plugins/',
                main: 'jquery.animate-css-rotate-scale'
            },
            {
                name: 'jquery.queryloader2',
                location: 'plugins/',
                main: 'jquery.queryloader2'
            }
        ]
    });
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="tortilla" class="site-wrapper <?php if(!isset($_SESSION['intro'])) echo 'hide'; ?>">
        <?php do_action( 'before' ); ?>
        <?php if(!isset($_SESSION['intro']) && $_SESSION['intro'] != 'true'): ?>
        <div id="intro">
            <div class="content container">
                <div class="span four logo-container">
                    <a href="<?php bloginfo('url'); ?>" class="logo ir"><?php _e("MaJoR Talent", 'major_talent'); ?></a>
                </div>
                <div class="span five push-one">
                    <h2 class="avenir-black title uppercase"><?php _e("The essential black book for all your celebrity talent needs.", 'major_talent'); ?></h2>
                    <p>
                        <a class="enter-btn white italic"><?php _e("Enter Site", 'major_talent'); ?></a>
                    </p>
                </div>
            </div>
            <div class="overlay"></div>
        </div>
        <?php $_SESSION['intro'] = 'true'; ?>
        <?php endif; ?>
        <div class="inner clearfix">
            <header id="header" class="site-header" role="banner">
                <div class="top">
                    <div class="inner">
                        <a href="<?php bloginfo('url'); ?>" class="logo ir"><?php _e("MaJoR Talent", 'major_talent'); ?></a>
                    </div>
                </div>
                <div class="floating">     
                    <h1 class="logo-container">
                        <a href="<?php bloginfo('url') ?>" class="logo ir"><?php _e("Major Talent", 'major_talent'); ?></a>
                    </h1> 
                    <div class="container-navigation">
                        <nav role="navigation" id="main-navigation">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'clearfix', 'container' => false ) ); ?>
                        </nav><!-- .site-navigation .main-navigation -->
                    </div>
                </div>   
        		<div class="bottom"></div>
            </header><!-- #header .site-header -->

            <div id="main" class="site-main container">
                <div class="top">
                    <div class="inner">   
                        <a class="toggle-header-btn">
                            <span class="icon-bar"></span>   
                            <span class="icon-bar"></span>   
                            <span class="icon-bar"></span>              
                        </a>
                        <a href="<?php bloginfo('url'); ?>" class="logo ir"><?php _e("MaJoR Talent", 'major_talent'); ?></a>
                    </div>
                </div>
