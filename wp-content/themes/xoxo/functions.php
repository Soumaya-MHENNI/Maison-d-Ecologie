<?php

	add_action( 'after_setup_theme', 'xoxo_fn_setup', 50 );

	function xoxo_fn_setup(){

		// REGISTER THEME MENU
		if(function_exists('register_nav_menus')){
			register_nav_menus(array('main_menu' 	=> esc_html__('Main Menu','xoxo')));
			register_nav_menus(array('footer_menu' 	=> esc_html__('Footer Menu','xoxo')));
			register_nav_menus(array('mobile_menu' 	=> esc_html__('Mobile Menu','xoxo')));
		}

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_action( 'wp_enqueue_scripts', 'xoxo_fn_scripts', 100 ); 
		add_action( 'wp_enqueue_scripts', 'xoxo_fn_styles', 100 );
		add_action( 'wp_enqueue_scripts', 'xoxo_fn_inline_styles', 150 );
		add_action( 'admin_enqueue_scripts', 'xoxo_fn_admin_scripts' );

		// Actions
		add_action( 'tgmpa_register', 'xoxo_fn_register_required_plugins' );

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		
		
		add_theme_support( 'post-formats', array('video','audio','gallery','image','link','quote','status') );

		set_post_thumbnail_size( 300, 300, true );		

		//Load Translation Text Domain
		load_theme_textdomain( 'xoxo', get_template_directory() . '/languages' );





		// Firing Title Tag Function
		xoxo_fn_theme_slug_setup();

		add_filter(	'widget_tag_cloud_args', 'xoxo_fn_tag_cloud_args');

		if ( ! isset( $content_width ) ) $content_width = 1200;

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'wp_list_comments' );

		add_editor_style() ;

		
		
		// search ajax 
		add_action( 'wp_ajax_nopriv_xoxo_fn_ajax_search', 'xoxo_fn_ajax_search' );
		add_action( 'wp_ajax_xoxo_fn_ajax_search', 'xoxo_fn_ajax_search' );

		// prev post ajax
		add_action( 'wp_ajax_nopriv_xoxo_fn_get_prev_post', 'xoxo_fn_get_prev_post' );
		add_action( 'wp_ajax_xoxo_fn_get_prev_post', 'xoxo_fn_get_prev_post' );
		
		
		// CONSTANT
		$my_theme 		= wp_get_theme( 'xoxo' );
		$version		= '1.0.0';
		if ( $my_theme->exists() ){
			$version 	= (string)$my_theme->get( 'Version' );
		}
		$version		= 'rel_'.$version;
		define('XOXO_VERSION', $version);
		define('XOXO_THEME_URL', get_template_directory_uri());
		
		
		
		
		
		/* ------------------------------------------------------------------------ */
		/*  Inlcudes
		/* ------------------------------------------------------------------------ */
		include_once( get_template_directory().'/inc/xoxo_fn_media_to_category.php'); 		// Custom Function
		include_once( get_template_directory().'/inc/xoxo_fn_functions.php'); 				// Custom Functions
		include_once( get_template_directory().'/inc/xoxo_fn_googlefonts.php'); 			// Google Fonts Init
		include_once( get_template_directory().'/inc/xoxo_fn_css.php'); 					// Inline CSS
		include_once( get_template_directory().'/inc/xoxo_fn_sidebars.php'); 				// Widget Area
		include_once( get_template_directory().'/inc/xoxo_fn_pagination.php'); 				// Pagination

}







/* ----------------------------------------------------------------------------------- */
/*  ENQUEUE STYLES AND SCRIPTS
/* ----------------------------------------------------------------------------------- */
	function xoxo_fn_scripts() {
		wp_enqueue_script('modernizr-custom', get_template_directory_uri() . '/framework/js/modernizr.custom.js', array('jquery'), XOXO_VERSION, FALSE);
		wp_enqueue_script('magnific.popup', get_template_directory_uri() . '/framework/js/magnific.popup.js', array('jquery'), XOXO_VERSION, TRUE);
		wp_enqueue_script('isotope', get_template_directory_uri() . '/framework/js/isotope.js', array('jquery'), XOXO_VERSION, TRUE);
		wp_enqueue_script('swiper', get_template_directory_uri() . '/framework/js/swiper.js', array('jquery'), XOXO_VERSION, TRUE);
		wp_enqueue_script('xoxo-fn-init', get_template_directory_uri() . '/framework/js/init.js', array('jquery'), XOXO_VERSION, TRUE);
		
		wp_localize_script(
			'xoxo-fn-init',
			'XoxoAjaxObject',
			array( 
				'ajax_url' 			=> admin_url( 'admin-ajax.php' ),
				'siteurl'			=> home_url(),
				'nonce'				=> wp_create_nonce('xoxo-secure'),
			)
		);
		
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	}
	
	function xoxo_fn_admin_scripts() {
		wp_enqueue_script('xoxo-fn-widget-upload', get_template_directory_uri() . '/framework/js/widget.upload.js', array('jquery'), XOXO_VERSION, FALSE);
		wp_enqueue_style('xoxo-fn-fontello', get_template_directory_uri().'/framework/css/fontello.css', array(), XOXO_VERSION, 'all');
		wp_enqueue_style('xoxo-fn-admin-style', get_template_directory_uri().'/framework/css/admin.style.css', array(), XOXO_VERSION, 'all');
	}

	function xoxo_fn_styles(){
		wp_enqueue_style('xoxo-fn-font-url', xoxo_fn_font_url(), array(), null );
		wp_enqueue_style('xoxo-fn-base', get_template_directory_uri().'/framework/css/base.css', array(), XOXO_VERSION, 'all');
		wp_enqueue_style('magnific.popup', get_template_directory_uri().'/framework/css/magnific.popup.css', array(), XOXO_VERSION, 'all');
		wp_enqueue_style('swiper', get_template_directory_uri().'/framework/css/swiper.css', array(), XOXO_VERSION, 'all');
		wp_enqueue_style('xoxo-fn-fontello', get_template_directory_uri().'/framework/css/fontello.css', array(), XOXO_VERSION, 'all');
		wp_enqueue_style('xoxo-fn-widgets', get_template_directory_uri().'/framework/css/widgets.css', array(), XOXO_VERSION, 'all');
		wp_enqueue_style('xoxo-fn-stylesheet', get_stylesheet_uri(), array(), XOXO_VERSION, 'all' ); // Main Stylesheet
	}





/* ----------------------------------------------------------------------------------- */
/*  Title tag: works WordPress v4.1 and above
/* ----------------------------------------------------------------------------------- */
	function xoxo_fn_theme_slug_setup() {
		add_theme_support( 'title-tag' );
	}
/* ----------------------------------------------------------------------------------- */
/*  Tagcloud widget
/* ----------------------------------------------------------------------------------- */
	
	function xoxo_fn_tag_cloud_args($args)
	{
		
		$my_args = array('smallest' => 14, 'largest' => 14, 'unit'=>'px', 'orderby'=>'count', 'order'=>'DESC' );
		$args = wp_parse_args( $args, $my_args );
		return $args;
	}

	
/*-----------------------------------------------------------------------------------*/
/*	TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/

require_once get_template_directory().'/plugin/class-tgm-plugin-activation.php';

function xoxo_fn_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Xoxo Core', // The plugin name.
			'slug'               => 'xoxo-core', // The plugin slug (typically the folder name).
			'source'             => 'https://frenify.net/envato/frenify/wp/xoxo/files/xoxo-core.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		// will be added in next updates as integration
//		array(
//			'name'               => 'Elementor', // The plugin name.
//			'slug'               => 'elementor', // The plugin slug (typically the folder name).
//			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
//			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
//			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
//			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
//			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
//		),
//		array(
//			'name'               => 'Contact Form 7', // The plugin name.
//			'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
//			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
//			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
//			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
//			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
//			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
//		),
		array(
			'name'               => 'Redux Vendor Support', // The plugin name.
			'slug'               => 'redux-vendor-support-master', // The plugin slug (typically the folder name).
			'source'             => 'https://github.com/reduxframework/redux-vendor-support/archive/master.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Categorify', // The plugin name.
			'slug'               => 'categorify', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'xoxo',          	 	 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}



?>