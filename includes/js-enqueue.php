<?php
/*
Loading all JS Script Files
------------------------------------------------------------------- */

function dubstrap_js_loader() {
    wp_enqueue_script('less', get_template_directory_uri().'/assets/js/less-1.4.1.min.js', array('jquery'), true );
    wp_enqueue_script('bootstrapjs', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), true );
    wp_enqueue_script('tweetjs', get_template_directory_uri().'/assets/js/jquery.tweet.js', array('jquery'), true );
    wp_enqueue_script('prettyphotojs', get_template_directory_uri().'/assets/js/jquery.prettyPhoto.js', array('jquery'), true );
    
	wp_enqueue_script('scriptjs', get_template_directory_uri().'/assets/js/script.js', array('jquery'), true );
	wp_enqueue_script('fluidvids', get_template_directory_uri().'/assets/js/fluidvids.min.js', array('jquery'), true );
	/* Morvi JS Start */
	wp_enqueue_script('camerajs', get_template_directory_uri().'/assets/js/morvi/camera/camera.js', array('jquery'), true );
	wp_enqueue_script('quicksandjs', get_template_directory_uri().'/assets/js/morvi/filterable/jquery.quicksand.js', array('jquery'), true );
	wp_enqueue_script('flexsliderjs', get_template_directory_uri().'/assets/js/morvi/flexslider/jquery.flexslider.js', array('jquery'), true );
	wp_enqueue_script('mainflexjs', get_template_directory_uri().'/assets/js/morvi/flexslider/main.js', array('jquery'), true );
	wp_enqueue_script('appearjs', get_template_directory_uri().'/assets/js/morvi/appear.js', array('jquery'), true );
	wp_enqueue_script('jqueryeasingjs', get_template_directory_uri().'/assets/js/morvi/jquery.easing.min.js', array('jquery'), true );
	wp_enqueue_script('parallaxjs', get_template_directory_uri().'/assets/js/morvi/jquery.parallax-1.1.3.js', array('jquery'), true );
	wp_enqueue_script('jqueryuijs', get_template_directory_uri().'/assets/js/morvi/jquery-ui.js', array('jquery'), true );
	wp_enqueue_script('classie', get_template_directory_uri().'/assets/js/morvi/navbar/classie.js', array('jquery'), true );
	wp_enqueue_script('cbpAnimatedHeader', get_template_directory_uri().'/assets/js/morvi/navbar/cbpAnimatedHeader.js', array('jquery'), true );
	wp_enqueue_script('mainjs', get_template_directory_uri().'/assets/js/morvi/main.js', array('jquery'), true );
	wp_enqueue_script('modernizrjs', get_template_directory_uri().'/assets/js/morvi/modernizr.custom.js', array('jquery'), true );
	wp_enqueue_script('shortcodejs', get_template_directory_uri().'/assets/js/morvi/shortcode.js', array('jquery'), true );
	wp_enqueue_script('jquery.sticky', get_template_directory_uri().'/assets/js/jquery.sticky.js', array('jquery'), true );
	
	/* popup comment */
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
    
}
add_action('wp_footer', 'dubstrap_js_loader');

?>