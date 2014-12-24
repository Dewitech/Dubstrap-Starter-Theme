<?php
/*
Loading all JS Script Files
------------------------------------------------------------------- */

function dubstrap_js_loader() {
    wp_enqueue_script('bootstrapjs', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), true );
	
	/* popup comment */
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
    
}
add_action('wp_footer', 'dubstrap_js_loader');

?>