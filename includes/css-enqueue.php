<?php
/*
Loading All CSS Stylesheets
------------------------------------------------------------------- */
function dubstrap_css_loader() {
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css', false ,'3.2.0', 'all' );
	wp_enqueue_style('fontawesome', get_template_directory_uri().'/assets/css/font-awesome.min.css', false ,'3.2.1', 'all' );
	
//	wp_enqueue_style('bootstrap-responsive', get_template_directory_uri().'/assets/css/bootstrap-responsive.min.css', false ,'2.3', 'all' );
//	wp_enqueue_style('docs', get_template_directory_uri().'/assets/css/docs.css', false ,'1.0', 'all' );
	wp_enqueue_style('jquery-tweet', get_template_directory_uri().'/assets/css/jquery.tweet.css', false ,'1.0', 'all' );
	wp_enqueue_style('prettyphoto', get_template_directory_uri().'/assets/css/prettyPhoto.css', false ,'1.0', 'all' );
//	wp_enqueue_style('color', get_template_directory_uri().'/assets/css/colors/'. get_option('dubstrap_themecolor') .'.css', true, 'all' );
	/* Morvi CSS Start */
	wp_enqueue_style('camera', get_template_directory_uri().'/assets/css/camera/camera.css', false ,'1.0', 'all' );
	wp_enqueue_style('flexslider', get_template_directory_uri().'/assets/css/flexslider/flexslider.css', false ,'1.0', 'all' );
	wp_enqueue_style('grid', get_template_directory_uri().'/assets/css/grid.css', false ,'1.0', 'all' );
	wp_enqueue_style('page-loader', get_template_directory_uri().'/assets/css/page-loader.css', false ,'1.0', 'all' );
	//wp_enqueue_style('shortcode', get_template_directory_uri().'/assets/css/shortcode.css', false ,'1.0', 'all' );
	//wp_enqueue_style('color', get_template_directory_uri().'/assets/css/colors/blue.css', false ,'1.0', 'all' );
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'dubstrap_css_loader');

?>