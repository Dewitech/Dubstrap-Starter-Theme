<?php global $smof_data; ?><!doctype html>  
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">		
	<title><?php if ( !is_front_page() ) { echo wp_title( ' ', true, 'left' ); echo ' | '; }
		echo bloginfo( 'name' ); echo ' - '; bloginfo( 'description', 'display' );  ?> </title>	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	
	<!-- media-queries.js (fallback) -->
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
	<![endif]-->

	<!-- html5.js -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	
	<?php /*
	<!-- Custom Typography -->
	<link href='http://fonts.googleapis.com/css?family=<?php echo get_option('dt_heading'); ?>' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=<?php echo get_option('dt_navfont'); ?>' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=<?php echo get_option('dt_par'); ?>' rel='stylesheet' type='text/css'>
	<?php require get_template_directory() . '/includes/style.php';?>  */ ?>
</head>