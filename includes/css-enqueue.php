<?php
/*
Loading All CSS Stylesheets
------------------------------------------------------------------- */
function dubstrap_css_loader() {
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css', false ,'3.3.1', 'all' );
	wp_enqueue_style('fontawesome', get_template_directory_uri().'/assets/css/font-awesome.min.css', false ,'3.2.1', 'all' );
	wp_enqueue_style('prettyphoto', get_template_directory_uri().'/assets/css/prettyPhoto.css', false ,'1.0', 'all' );
}
add_action('wp_enqueue_scripts', 'dubstrap_css_loader');

?>