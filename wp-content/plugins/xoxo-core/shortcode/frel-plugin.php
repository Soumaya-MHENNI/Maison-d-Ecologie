<?php

namespace Frel;

// Exit if accessed directly. 
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Main Plugin Class
class Frel_Plugin
{
	
	
    // Constructor
    public function __construct()
    {
        //$this->add_actions();
    }
    
    
	// Add Actions
    private function add_actions()
    {
		
		
		// Add New Elementor Categories
        add_action( 'elementor/init', array( $this, 'add_elementor_category' ), 999 );
        // Register Widget Scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'register_widget_scripts' ) );
        // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'register_widget_styles' ) );
        // Register New Widgets
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ), 10 );
		
		add_action( 'elementor/editor/before_enqueue_scripts', function() {
			wp_enqueue_style( 'frel_elementor_css', XOXO_PLUGIN_URL . 'assets/css/elementor.css', false, XOXO_PLUGIN_VERSION, 'all' );
		});
		
		
		
		
		// posts shortcode -> "ajax grid" layout
		add_action( 'wp_ajax_nopriv_xoxo_fn_cs_ajax_grid_filter_posts', 'xoxo_fn_cs_ajax_grid_filter_posts' );
		add_action( 'wp_ajax_xoxo_fn_cs_ajax_grid_filter_posts', 'xoxo_fn_cs_ajax_grid_filter_posts' );
		
		
		// posts shortcode -> "fixed col" layout
		add_action( 'wp_ajax_nopriv_xoxo_fn_cs_ajax_fixed_col_posts', 'xoxo_fn_cs_ajax_fixed_col_posts' );
		add_action( 'wp_ajax_xoxo_fn_cs_ajax_fixed_col_posts', 'xoxo_fn_cs_ajax_fixed_col_posts' );
		
		
		// posts shortcode -> "parallax classic" layout
		add_action( 'wp_ajax_nopriv_xoxo_fn_cs_ajax_parallax_classic_posts', 'xoxo_fn_cs_ajax_parallax_classic_posts' );
		add_action( 'wp_ajax_xoxo_fn_cs_ajax_parallax_classic_posts', 'xoxo_fn_cs_ajax_parallax_classic_posts' );
		
		
		
		// posts triple shortcode 
		add_action( 'wp_ajax_nopriv_xoxo_fn_cs_ajax_get_last_posts_by_category', 'xoxo_fn_cs_ajax_get_last_posts_by_category' );
		add_action( 'wp_ajax_xoxo_fn_cs_ajax_get_last_posts_by_category', 'xoxo_fn_cs_ajax_get_last_posts_by_category' );
    }
	
	
	
    // Add New Categories to Elementor
    public function add_elementor_category()
    {
        \Elementor\Plugin::instance()->elements_manager->add_category( 'frel-elements', array(
            'title' => __( 'Frel Elements', 'xoxo-core' ),
        ), 1 );
    }
    
    // Register Widget Scripts
    public function register_widget_scripts()
    {
		wp_enqueue_script( 'marquee', plugins_url( 'assets/js/marquee.js', __FILE__ ), array( 'jquery' ), XOXO_PLUGIN_VERSION, TRUE );
		
		wp_enqueue_script( 'frel_init', XOXO_PLUGIN_URL . 'assets/js/init.js', array( 'jquery' ), XOXO_PLUGIN_VERSION, TRUE );
		

		
    }
	
    // Register Widget Styles
    public function register_widget_styles()
    {
		wp_enqueue_style( 'frel_style', XOXO_PLUGIN_URL . 'assets/css/style.css', false, XOXO_PLUGIN_VERSION, 'all' );
    }
    
	
    // Register New Widgets
    public function register_widgets()
    {
        $this->include_widgets();
		$this->include_widget_outputs();
		
		
		// register DEPRECATED widgets 
        $this->include_deprecated_widgets();
    }
    
	
    // Include DEPRECATED Widgets
    private function include_deprecated_widgets()
    {
		foreach(glob(plugin_dir_path( __FILE__ ) . '/widgets/deprecated/*.php' ) as $file ){
			$this->include_widget( $file );
		}
    }
	
    // Include RAW Widgets
    private function include_raw_widgets()
    {
		foreach(glob(plugin_dir_path( __FILE__ ) . '/widgets/raw/*.php' ) as $file ){
			$this->include_widget( $file );
		}
		
    }
	
	
    // Include Widgets
    private function include_widgets()
    {
		foreach(glob(plugin_dir_path( __FILE__ ) . '/widgets/*.php' ) as $file ){
			$this->include_widget( $file );
		}
		
    }
	
	
	// Include and Load Widget
    private function include_widget($file)
    {
		
		$base  = basename( str_replace( '.php', '', $file ) );
		$class = ucwords( str_replace( '-', ' ', $base ) );
		$class = str_replace( ' ', '_', $class );
		$class = sprintf( 'Frel\Widgets\%s', $class );
		
		require_once $file; // include widget php file
		
		if ( class_exists( $class ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new $class ); // load widget class
		}
		
    }
	
	
	// call to widget outputs
	private function include_widget_outputs()
    {
		foreach(glob(plugin_dir_path( __FILE__ ) . '/widgets/output/*.php' ) as $file ){
			require_once $file;
		}
    }
	
	

}