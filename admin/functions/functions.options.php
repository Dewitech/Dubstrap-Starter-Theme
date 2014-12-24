<?php
add_action('init','of_options');

if (!function_exists('of_options')){
	function of_options() {
	
		/* Access the WordPress Categories via an Array */
		/* $of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, __("All", 'dewitech')); */    
	       
		
         

		 
		/* Access the WordPress Pages via an Array */
		/* $of_pages                       = array();
		$of_pages_obj           = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
			$of_pages[$of_page->post_name] = $of_page->post_title; }
		$of_pages_tmp           = array_unshift($of_pages, __("Select a page:", 'dewitech'));  */ 

		

		
	
	
	
		
		
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 	  => "placebo", //REQUIRED!
				"block_banner"  => __("Banner", 'dewitech'),
				"block_page_content"  => __("Page Content", 'dewitech'),
				"block_news_list"  => __("News List", 'dewitech'),
				"block_news_slider"  => __("News Slider", 'dewitech')
			), 
			"enabled" => array (
				"placebo"     => "placebo", //REQUIRED!
				"block_latest_post"  => __("Latest Blog Posts", 'dewitech'),
				
				
			),
		);
           
  

		$font_options = get_google_font();

		
		
	
	

		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/assets/bg-img/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/assets/bg-img/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		/* //More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");  */
		
		
		
		
		
		
		
		
		
		

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

/* = Main Settings
********************************************************************/							
$of_options[] = array( 	"name" 		=> __("General", 'dewitech'),
						"class"     => "general",
						"type" 		=> "heading"
				);		
$of_options[] = array( 	"name" 		=> __("Logo",'dewitech'),
						"desc" 		=> __("Upload your Logo. Or paste the image link.",'dewitech'),
						"id" 		=> "logo",
						"std" 		=> get_template_directory_uri()."/assets/img/logo.png",
						"type" 		=> "media"
				);
$of_options[] = array( 	"name" 		=> __("Favicon",'dewitech'),
						"desc" 		=> __("Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",'dewitech'),
						"id" 		=> "custom_favicon",
						"std" 		=> '',
						"type" 		=> "media"
				);

				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "scrooltop_introduction",
						"std" 		=> "<h3>".__('Scrool to Top Button Options', 'dewitech')."</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
						
$of_options[] = array( 	"name" 		=> "Enable Scrool to Top Button",
						"desc" 		=> "Select this if you wish to enable Scroll to Top Button",
						"id" 		=> "scrooltop_switch",
						"std" 		=> 0,
						"folds"		=> 1,
						"type" 		=> "switch"
				); 
$of_options[] = array( 	"name" 		=> "Scroll Position",
						"desc" 		=> "Choose where you would put the scroll key up",
						"id" 		=> "scroll_position",
						"fold"		=> "scrooltop_switch",
						"std" 		=> "right",
						"type" 		=> "select",
						"options" 	=> array(
										'right'	=> 'Right',
										'left'	=> 'Left'
										)
				);
					
$of_options[] = array( 	"name" 		=> "Fixed Topmenu?",
						"desc" 		=> "",
						"id" 		=> "fixed_topmenu",
						"std" 		=> 0,
						"folds"		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "pageloader_introduction",
						"std" 		=> "<h3>".__('Pageloader Options', 'dewitech')."</h3>",
						"icon" 		=> true,
						"type" 		=> "info");					
$of_options[] = array( 	"name" 		=> "Enable page loader",
						"desc" 		=> "Select this if you wish to enable Scroll to Top Button",
						"id" 		=> "pageloader_switch",
						"std" 		=> 0,
						"folds"		=> 1,
						"type" 		=> "switch"
				); 
$of_options[] = array( 	"name" 		=> "Scroll Position",
						"desc" 		=> "Choose one",
						"id" 		=> "pageloader_item",
						"fold"		=> "pageloader_switch",
						"std" 		=> "1",
						"type" 		=> "select2",
						"options" 	=> array(
										'1'	=> 'Windows 8 (default)',
										'2'	=> 'Image Loading',
										'3'	=> 'bubblingG',
										'4'	=> 'fountainG',
										'5'	=> 'loaderZ'
										)
				);
									
$url_layout_style =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Layout Style",
						"desc" 		=> "Choose your layout style",
						"id" 		=> "layout_style",
						"std" 		=> "boxed",
						"type" 		=> "images",
						"options" 	=> array(
							'wide' 	=> $url_layout_style . 'wide.png',
							'boxed' 	=> $url_layout_style . 'boxed.png'
				)
			);				
				
$of_options[] = array( "name"		=> __("Footer Copyright Text", 'dewitech'),
						"desc"		=> __("Write your own copyright text here. You can use the following shortcodes in your footer text: [copyright] [site-name] [the-year]", 'dewitech'),
						"id"		=> "footer_text",
						"std"		=> get_bloginfo("name"),
						"type"		=> "textarea" );

						
	

				





/* = Contact */	 	
$of_options[] = array( 	"name"      => __("Contact  Map", 'dewitech'),
						"class"      => "contactmap",
						"type"      => "heading"
				);	
$of_options[] = array( 	"name" 		=> "Address",
						"desc" 		=> "",
						"id" 		=> "contact_address",
						"std" 		=> "",
						"type" 		=> "text"
				);						
$of_options[] = array( 	"name" 		=> "Province State City",
						"desc" 		=> "",
						"id" 		=> "contact_city",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Country",
						"desc" 		=> "",
						"id" 		=> "contact_country",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Email",
						"desc" 		=> "",
						"id" 		=> "contact_email",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "URL",
						"desc" 		=> "",
						"id" 		=> "contact_site",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Phone",
						"desc" 		=> "",
						"id" 		=> "contact_phone",
						"std" 		=> "",
						"type" 		=> "text"
				);	
$of_options[] = array( 	"name" 		=> "Mobile",
						"desc" 		=> "",
						"id" 		=> "contact_mobile",
						"std" 		=> "",
						"type" 		=> "text"
				);	
$of_options[] = array(	"name"		=> "Contact Map",
						"desc"		=> "",
						"id"		=> "contact_map_infi",
						"std"		=> "<h3>".__("Contact Map", 'dewitech')."</h3>",
						"icon"		=> true,
						"type"		=> "info"
				);

$of_options[] = array( 	"name" 		=> "Map Type",
						"desc" 		=> "",
						"id" 		=> "contact_map_type",
						"std" 		=> "ROADMAP",
						"type" 		=> "select",
						"options" 	=> array(
											'ROADMAP'	=> 'ROADMAP',
											'SATELLITE'	=> 'SATELLITE',
											'HYBRID'	=> 'HYBRID',
											'TERRAIN'	=> 'TERRAIN'
										)
				);				

$of_options[] = array( 	"name" 		=> "Scrollable",
						"desc" 		=> "",
						"id" 		=> "contact_map_scrollable",
						"std" 		=> 0,
						"folds"		=> 1,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Map Zoom Level",
						"desc" 		=> "",
						"id" 		=> "contact_map_zoom",
						"std" 		=> "6",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "21",
						"type" 		=> "sliderui" 				
				);
$of_options[] = array( 	"name" 		=> "Icon (Marker)",
						"desc" 		=> "",
						"id" 		=> "contact_map_marker_icon",
						"std" 		=> '',
						"type" 		=> "media"
				);
$of_options[] = array( 	"name" 		=> "Map Content",
						"desc" 		=> "",
						"id" 		=> "contact_map_content",
						"std" 		=> "",
						"type" 		=> "textarea"
				);


	

						



/* = Social Media 
================================================================================================= */	
$of_options[] = array( 	"name" 		=> "Social Links",
						"class"     => "sociallinks",
						"type" 		=> "heading"
				);
					
$of_options[] = array( 	"name" 		=> "doc",
						"desc" 		=> "",
						"id" 		=> "s_introduction",
						"std" 		=> "Please put your full social media link.<br />
										for example : <code> https://www.facebook.com/username</code><br />
										leave empty to remove it from your site.",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
$of_options[] = array( 	"name" 		=> "Facebook",
						"desc" 		=> "Place url of your facebook page/profile",
						"id" 		=> "s_facebook",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Twitter",
						"desc" 		=> "Place url of your Twitter profile",
						"id" 		=> "s_twitter",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "LinkedIn",
						"desc" 		=> "Place url of your LinkedIn profile",
						"id" 		=> "s_linkedin",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Skype",
						"desc" 		=> "Place url of your Skype profile",
						"id" 		=> "s_skype",
						"std" 		=> "",
						"type" 		=> "text"
				);		
$of_options[] = array( 	"name" 		=> "Dribbble",
						"desc" 		=> "Place url of your facebook page/profile",
						"id" 		=> "s_dribbble",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Google+",
						"desc" 		=> "Place url of your Google+ profile",
						"id" 		=> "s_googleplus",
						"std" 		=> "",
						"type" 		=> "text"
				);	
$of_options[] = array( 	"name" 		=> "Pinterest",
						"desc" 		=> "Place url of your Pinterest profile",
						"id" 		=> "s_pinterest",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Flickr",
						"desc" 		=> "Place url of your Flickr album",
						"id" 		=> "s_flickr",
						"std" 		=> "",
						"type" 		=> "text"
				);	
$of_options[] = array( 	"name" 		=> "YouTube",
						"desc" 		=> "Place url of your Dribbble profile",
						"id" 		=> "s_youtube",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Vimeo",
						"desc" 		=> "Place url of your Vimeo profile",
						"id" 		=> "s_vimeo",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Dropbox",
						"desc" 		=> "Place url of your Dropbox profile",
						"id" 		=> "s_dropbox",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Github",
						"desc" 		=> "Place url of your Github profile",
						"id" 		=> "s_github",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Tumblr",
						"desc" 		=> "Place url of your Tumblr profile",
						"id" 		=> "s_tumblr",
						"std" 		=> "",
						"type" 		=> "text"
				);			
$of_options[] = array( 	"name" 		=> "Instagram",
						"desc" 		=> "Place url of your Instagram profile",
						"id" 		=> "s_instagram",
						"std" 		=> "",
						"type" 		=> "text"
				);



						
									
								
					

						
/* 									
================================================================================================= */	
          
$of_options[] = array( "name"       => __("Basic Styling", 'dewitech'),
						"class"     => "basicstyling",
					    "type"     	=> "heading"
				);
$of_options[] = array(	"name"		=> "Theme Skin",
						"desc"		=> "",
						"id"		=> "info_theme_skin",
						"std"		=> "<h3>".__("Theme Skin", 'dewitech')."</h3>",
						"icon"		=> true,
						"type"		=> "info"); 
						
$of_options[] = array(  "name"		=> __("Theme Skin Stylesheet", 'dewitech'),
					    "desc"		=> __("Note* changes made in options panel will override this stylesheet. Example: Colors set in typography.", 'virtue'),
      					"id"		=> "skin_stylesheet",
      					"std"		=> "none",
      					"type"		=> "select",
      					"options"	=> array(
							'none' => 'None',
							'pink' => 'Pink',
							'blue' => 'Blue',
							'DarkSlateGray' => 'DarkSlateGray',
							'green' => 'Green',
							'orange' => 'Orange',
							'red' => 'Red',
							'yellow' => 'Yellow',
						) );
$of_options[] = array(	"name"		=> "Body Background",
						"desc"		=> "",
						"id"		=> "info_body_background",
						"std"		=> "<h3>".__("Body Background", 'dewitech')."</h3>",
						"icon"		=> true,
						"type"		=> "info"); 						
$of_options[] = array( 	"name" 		=> __("Custom background?", 'dewitech'),
						"desc" 		=> "",
						"id" 		=> "custom_background_switch",
						"std" 		=> 0,
						"folds"		=> 1,
						"type" 		=> "switch" );	
						
$of_options[] = array(  "name"      => __("Color", 'dewitech'),
      					"desc"      => __("", 'dewitech'),
      					"id"        => "background_color",
      					"std"       => "",
						"fold"		=> "custom_background_switch",
      					"type"      => "color");
						
$of_options[] = array( 	"name" 		=> __('Image <small style="color:#bbb;font-size:80%!important">(Pattern)</small>','dewitech'),
						"desc" 		=> __("Select a preset background image for the body background.",'dewitech'),
						"id" 		=> "background_image",
						'fold'		=> 'custom_background_switch',
						"std" 		=> $bg_images_url."bg0.png",
						"type" 		=> "tiles",
						"options" 	=> $bg_images,
				);

$of_options[] = array( 	"name" 		=> "Custom",
						"desc" 		=> "Upload your background custom. Or paste the image link.",
						"id" 		=> "background_image_custom",
						'fold'		=> "custom_background_switch",
						"std" 		=> '',
						"type" 		=> "media"
				);						 


					
/* 	= Typography					
================================================================================================= */		                        
$of_options[] = array(  "name"            => __("Typography", 'dewitech'),
						"class"     => "typography",
					    "type"     	=> "heading"
				);

						
						
/* = Advanced Settings
================================================================================================= */	
$of_options[] = array( 	"name" 		=> __("Advanced Settings", 'dewitech'),
						"class"     => "advancedsettings",
					    "type"     	=> "heading"
				);
						
$of_options[] = array(	"name"		=> "CSS Info",
						"desc"		=> "",
						"id"		=> "info_CSS",
						"std"		=> "<h3>".__("Custom CSS", 'dewitech')."</h3>",
						"icon"		=> true,
						"type"		=> "info");
						
$of_options[] = array(  "name"		=> "",
                        "desc"		=> __("Quickly add some CSS to your theme by adding it to this block.", 'dewitech'),
                        "id"		=> "custom_css",
                        "std"		=> "",
                        "type"		=> "textarea");
						
$of_options[] = array(	"name"		=> "Script Info",
						"desc"		=> "",
						"id"		=> "info_JS",
						"std"		=> "<h3>".__("Custom Script", 'dewitech')."</h3>",
						"icon"		=> true,
						"type"		=> "info");
						
$of_options[] = array(  "name"		=> "",
                        "desc"		=> __("Quickly add some Script to your theme by adding it to this block.", 'dewitech'),
                        "id"		=> "custom_script",
                        "std"		=> "",
                        "type"		=> "textarea");

				

				

				
				
				
/* = Backup Options
================================================================================================= */	
$of_options[] = array( 	"name" 		=> __("Backup Options", 'dewitech'),
						"class"     => "backupoptions",
					    "type"     	=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> __("Backup and Restore Options", 'dewitech'),
				"id" 		      => "of_backup",
				"std" 		=> "",
				"type" 		=> "backup",
				"desc" 		=> __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'dewitech'),
				);





				
	}  /* End function: of_options() */
}  /* End chack if function exists: of_options() */