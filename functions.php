<?php
/*
Author: Dewitech
URL: htp://dewitech.com

*/
// register an action (can be any suitable action)

// Set content width
//if ( ! isset( $content_width ) ) $content_width = 1170;
if ( ! isset( $content_width ) ) $content_width = 750;

function dubstrap_setup() {
	/*
	 * Makes dubstrap available for translation.
	 * Translations can be added to the /lang/ directory.
	 */
	load_theme_textdomain( 'dewitech', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css') );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'audio', 'aside', 'gallery', 'image',  'video'

	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'dewitech' ) );
	register_nav_menu('footer',__( 'Footer Menu' , 'dewitech'));
	
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );
	
}
add_action( 'after_setup_theme', 'dubstrap_setup' );

/* Disable WordPress Admin Bar for all users. */
  //show_admin_bar(false);


/* Slightly Modified Options Framework */
require get_template_directory() . '/admin/index.php';

/* Adds JS and CSS enqueue */

require get_template_directory() . '/includes/css-enqueue.php';
require get_template_directory() . '/includes/js-enqueue.php';
require get_template_directory() . '/includes/thumbnail-size.php';

/* Nav Menu */
function dewitech_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu( 
    	array( 
    		'menu' => '', /* menu name */
    		'menu_class' => 'nav navbar-nav navbar-right',
    		'theme_location' => 'primary', /* where in the theme it's assigned */
    		'container' => 'false', /* container class */
    		'fallback_cb' => '', /* menu fallback */
    		'depth' => '2', /* suppress lower levels for now */
    		'walker' => new dt_bootstrap_navwalker()
    	)
    );
}

function dewitech_footer_nav() {
    wp_nav_menu( 
	array( 	'theme_location' => 'footer',
			'menu'            => '',
			'container'       => 'nav',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => '',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		));
}

function add_menu_root_obj_last_item( $items ) {
	$last 	= 0; 
	foreach ( $items as $key=>$item ) {
		if (  $item->menu_item_parent == 0 ) {
			$items[$key]->menu_last = 0;
			$last = $key;
		}
	}
	
	foreach ( $items as $key=>$item ) {
		if (  $item->menu_item_parent == 0 ) {
			if($last == $key){
				$items[$key]->menu_last = 	1;
			}
		}
	}
	return $items;    
}
add_filter( 'wp_nav_menu_objects', 'add_menu_root_obj_last_item' );



// Menu output mods
class dt_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu\">\n";
	}
	
	public function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0  ) {
			$indent = str_repeat("\t", $depth);
			$output .= "</li>\n";
			if(0 == $depth){
				if(1 === $item->menu_last){
					$output .= $this->add_search_form();
				}
			}
	}
	
	function add_search_form(){
		return '<!-- Search Form -->		
		<li class="search-container">
			<div id="search-form">
				<form method="get" action="'. home_url( '/' ) .'">
					<input name="s" type="text" value="'. get_search_query() .'" class="search-text-box" />
				</form>
			</div>
		</li>';
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			else
				$item_output .= '<a'. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			//$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}





/*
Registering Widget Sections
------------------------------------------------------------------- */
function dubstrap_widgets_init() {
	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'sidebar-blog',
		'before_widget' => '<div id="%1$s" class="widget widget-right %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="headline">',
		'after_title' => '</h3><span class="line"></span><div class="clearfix"></div>',
	));
	
	register_sidebar( array(
		'name' => 'Page Sidebar',
		'id' => 'sidebar-page',
		'before_widget' => '<div id="%1$s" class="widget widget-right %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="headline">',
		'after_title' => '</h3><span class="line"></span><div class="clearfix"></div>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Sidebar Left',
		'id' => 'footer-sidebar-left',
		'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Sidebar Center 1',
		'id' => 'footer-sidebar-center1',
		'before_widget' => '<div id="%1$s" class="widget-footer %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Sidebar Center 2',
		'id' => 'footer-sidebar-center2',
		'before_widget' => '<div id="%1$s" class="widget-footer %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Sidebar Right',
		'id' => 'footer-sidebar-right',
		'before_widget' => '<div id="%1$s" class="widget-footer %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));


}
add_action( 'init', 'dubstrap_widgets_init' );
function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
   }  
}  


// Numeric Page Navi
function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
		
	echo $before.'<ul class="pagination">'."";
	if ($paged > 1) {
		$first_page_text = "<";
		echo '<li class="prev"><a href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
	}
		
	$prevposts = get_previous_posts_link('Previous');
	if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
	else { echo '<li class="disabled"><a href="#">Previous</a></li>'; }
	
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('Next');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = ">";
		echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
	}
	echo '</ul>'.$after."";
}

/* add by mastra */

# filter tag cloud to same Size
if(!function_exists('_tag_cloud_args')){
	function _tag_cloud_args() {
		$args = array( 
			//'format'=>'array', 
			'smallest' => 14, 
			'largest' => 14, 
			'unit' => "px",
			//'separator' => ""
		);
		return $args;
	}
	add_filter('widget_tag_cloud_args', '_tag_cloud_args');
}


# CUSTOM LENGTH THE EXCERPT
if(!function_exists('custom_excerpt_length')){
	function custom_excerpt_length( $length ) {
		return 40;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
}


# CUSTOM MORE THE EXCERPT
if(!function_exists('new_excerpt_more')){
	function new_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more');
}

# SOCIAL MEDIA ICON
/* show social icon */
if(!function_exists('dt_social')){
	function dt_social($class='social'){
		global $smof_data;

		$social = array(
					's_facebook' 	=> array('Facebook','icon-facebook','fa-facebook'),
					's_twitter'		=> array('Twitter','icon-twitter','fa-twitter'),
					's_linkedin'	=> array('Linkedin','icon-linkedin','fa-linkedin'),
					's_skype'		=> array('Skype','icon-skype','fa-skype'),
					's_dribbble'	=> array('Dribbble','icon-dribbble','fa-dribbble'),
					's_googleplus'	=> array('Circle G+','icon-google-plus','fa-google-plus-square'),
					's_pinterest'	=> array('Pinterest','icon-pinterest','fa-pinterest'),
					's_flickr'		=> array('Flickr','icon-flickr','fa-flickr'),
					's_youtube'		=> array('YouTube','icon-youtube','fa-youtube'),
					's_vimeo'		=> array('Vimeo','icon-vimeo','fa-vimeo-square'),
					's_dropbox'		=> array('Dropbox','icon-dropbox','fa-dropbox'),
					's_github'		=> array('Github','icon-github','fa-github'),
					's_tumblr'		=> array('Tumblr','icon-tumblr','fa-tumblr'),
					's_instagram'	=> array('Instagram','icon-instagram','fa-instagram'),
				);
				
		$output = '<ul class="'.$class.'">';
		
		foreach($social as $key=>$val){
		
		
			if(isset($smof_data[$key])){
				$link_socmed = trim($smof_data[$key]);
				$link_socmed = str_replace(' ','',$link_socmed);
				if(!empty($link_socmed)){ 
				
					$class 	 = 'social-'.str_replace('-','_', $val[1]);
					$output .= '<li>';	
					$output .= '<a class="'.$class.'" href="' . esc_url($smof_data[$key]) . '" data-toggle="tooltip" data-placement="top" title="' . $val[0] . '"><i class="fa ' . $val[2] . '"></i></a>';	
					$output .= '</li>';	
				}
			}
		}	
		
		$output .= '</ul>';						

		return $output;
	}
}


if(!function_exists('dt_paging_nav')){
	function dt_paging_nav($pages = '', $range = 4) { 	
		$prev = get_previous_posts_link('PREV');
		$next = get_next_posts_link('NEXT');
		
		
		$showitems = ($range * 2)+1; 
	 
		global $paged;
		if(empty($paged)) $paged = 1;
	 
		if($pages == ''){
			 global $wp_query;
			 $pages = $wp_query->max_num_pages;
			 if(!$pages){
				 $pages = 1;
			 }
		 }  

				
		if(1 != $pages){
			echo '<nav class="text-center">';
			echo '<ul class="pagination">';
			if(!empty($prev)){
				echo '<li>'.$prev.'</li>';
			}

			for ($i=1; $i <= $pages; $i++){
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					 echo ($paged == $i)? "<li class=\"disabled\"><a href=\"#\">".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
				}
			}
	 
			if(!empty($next)){
				echo '<li>'.$next.'</li>';
			}
			 echo '</ul>';
			 echo '</nav>';
		 }
	}
}


if(!function_exists('wy_custom_post_column')){
	function wy_custom_post_column( $column, $post_id ) {
		switch ( $column ) {
			case 'image' :
				if ( has_post_thumbnail() ) {
					the_post_thumbnail(array(50,50));
				}else{
					echo '<div style="width:50px;height:40px;background:#eee;color:#ccc;text-align:center;line-height:12px;padding-top:10px;">No Image</div>';
				}
			break;
		}
	}
	add_action( 'manage_post_posts_custom_column' , 'wy_custom_post_column', 10, 2 );
} 

if(!function_exists('wy_set_custom_edit_post_columns')){
	function wy_set_custom_edit_post_columns($columns) {
		$new_columns = array();
		$new_columns['cb'] = $columns['cb'];
		$new_columns['image'] = __( 'Image', 'dewitech' );
		
		foreach($columns as $key=>$val){
			 $new_columns[$key] =$val;
		}
		return $new_columns;
	}
	add_filter( 'manage_edit-post_columns', 'wy_set_custom_edit_post_columns' );
}

/* = Show feature image on post list
*****************************************************************/
if(!function_exists('_wy_add_style_custom_list_table')){
	function _wy_add_style_custom_list_table(){
		?><style type="text/css" media="all">.column-image{width:50px}</style><?php
	}
	add_action('admin_head', '_wy_add_style_custom_list_table');
}


/* = Show Custom CSS from theme options
*******************************************************************/
if(!function_exists('wy_custom_css')){
	function wy_custom_css(){
		global $smof_data;
		/* Custom  CSS */
		if(!empty($smof_data['custom_css'])) {
			echo '<style type="text/css" media="all">'.$smof_data['custom_css'].'</style>'."\n";
		}
	}
	add_action( 'wp_head', 'wy_custom_css' ,999);
}


/* = Show Custom Script from theme options
*******************************************************************/
if(!function_exists('wy_custom_script')){
	function wy_custom_script(){
		global $smof_data;
		/* Custom Tracking Code */
		if(!empty($smof_data['custom_script'])) {
			echo "<!-- Begin Custom Script --> \n". $smof_data['custom_script'] . "\n<!-- End Custom Script -->\n"; 	
		}
	}
	add_action( 'wp_footer', 'wy_custom_script' ,999);
}


/* = Custom favicon
*******************************************************************/
if(!function_exists('wy_favicon')){
	function wy_favicon(){
		global $smof_data;
		if(!empty($smof_data['custom_favicon'])){ 
			?><link rel="shortcut icon" href="<?php echo $smof_data['custom_favicon']; ?>" /><?php 
		} 
	}
	add_action( 'wp_head', 'wy_favicon' );
}


/* = Custom Body Class
*****************************************************************/
function dt_body_class( $classes ) {
	global $smof_data;
	
	if(isset($smof_data['layout_style']) && ('boxed' == trim($smof_data['layout_style'])))
		$classes[] = 'boxed';
	
	return $classes;
}
add_filter( 'body_class', 'dt_body_class' );




/* = Comments list
************************************************************/
if(!function_exists('dt_comments')){
	function dt_comments($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<div class="comment-author image-polaroid">
				<?php echo get_avatar($comment,$size='125'); ?>
				<!--<img alt="avatar" class="img-circle" src="http://placehold.it/480&text=Client+2">-->
			</div>
			<div class="comment-body">
				<div class="comment-meta">
					<span class="meta-name"><a href="#"><?php printf(__('%s','dewitech'), get_comment_author_link()) ?></a></span>
					<span class="meta-date"><?php comment_time('F j, Y ');?> at <?php comment_time('H:i a'); ?></span>
					<div class="reply">
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
				</div>
				<?php comment_text() ?>
			</div>
		<?php 
		
		/* </li> is added  automatically */
		
	} // don't remove this bracket! 
}
