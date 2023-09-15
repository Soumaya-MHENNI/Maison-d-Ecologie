<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Xoxo_Settings {

	public function __construct() 
	{
		add_action('admin_menu', array($this, 'admin_menu'), 5);
	}
	
	public function admin_menu()
	{
		 // Add menu item for settings page
		$page_title 	= esc_html__('Xoxo', XOXO_TEXT_DOMAIN);
		$menu_title 	= esc_html__('Xoxo', XOXO_TEXT_DOMAIN);
		$capability 	= 'manage_options';
		$menu_slug 		= 'xoxo-core';
		$callback 		= [$this, "welcome_page"];
		$icon_url 		= 'dashicons-flag';
		$position 		= 90;
		$menu			= add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_url, $position);
		
		add_action( 'admin_print_styles-' . $menu, array($this,'admin_css') );
		add_action( 'admin_print_scripts-' . $menu, array($this,'admin_js') );
	}
	
	public static function welcome_page(){
		include_once ( plugin_dir_path( __FILE__ ) . '/welcome.php');
	}
	public function admin_css() {
		wp_enqueue_style('magnific-popup', XOXO_PLUGIN_URL . 'inc/settings/assets/css/magnific-popup.css', array(), XOXO_PLUGIN_VERSION, 'all');
		wp_enqueue_style('frenify-welcome-css', XOXO_PLUGIN_URL . 'inc/settings/assets/css/style.css', array(), XOXO_PLUGIN_VERSION, 'all');
	}
	public function admin_js() {
		wp_enqueue_script('magnific-popup', XOXO_PLUGIN_URL . 'inc/settings/assets/js/magnific-popup.js', array('jquery'), XOXO_PLUGIN_VERSION, FALSE);
		wp_enqueue_script('frenify-welcome-js', XOXO_PLUGIN_URL . 'inc/settings/assets/js/init.js', array('jquery'), XOXO_PLUGIN_VERSION, FALSE);
	}
	
}
new Xoxo_Settings();