<?php
/*
Plugin Name: Xoxo Core
Plugin URI: https://themeforest.net/item/xoxo-blog-magazine-wordpress-theme/42858298
Description: Xoxo Core Plugin for Xoxo Theme
Version: 1.0.1
Author: Frenify
Author URI: https://themeforest.net/user/frenify
*/


define ( 'XOXO_PLUGIN_URL', plugin_dir_url(__FILE__) );
define ( 'XOXO_CORE_SHORTCODE_URL', XOXO_PLUGIN_URL . 'shortcode/');
define ( 'XOXO_PLUGIN_VERSION', '1.0.1'); 
define ( 'XOXO_ASSETS_URL', XOXO_PLUGIN_URL . 'shortcode/assets/');
define ( 'XOXO_TEXT_DOMAIN', 'xoxo-core' );



// Custom Meta tags for Sharing

add_action('wp_head', 'xoxo_fn_open_graph_meta');

function xoxo_fn_open_graph_meta(){
	global $post, $xoxo_fn_option;
	
	// enable or disable via theme options
	if(isset($xoxo_fn_option['open_graph_meta']) && $xoxo_fn_option['open_graph_meta'] == 'enable'){
	
		$image = '';
		if(isset($post)){
			if (has_post_thumbnail( $post->ID ) ) {
				$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$image = esc_attr( $thumbnail_src[0] );
		}}?>

		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:site_name" content="<?php echo esc_html(get_bloginfo( 'name' )); ?>" />
		<meta property="og:description" content="<?php echo xoxo_fn_excerpt(12); ?>" />

		<?php if ( $image != '' ) { ?>
			<meta property="og:image" content="<?php echo esc_url($image); ?>" />
		<?php }
	}
}
add_action( 'init', 'translation' );
// Load text domain
function translation() 
{
	load_plugin_textdomain( 'xoxo-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
/*----------------------------------------------------------------------------*
 * Plugins
 *----------------------------------------------------------------------------*/

if (!class_exists('ReduxFramework') && file_exists(plugin_dir_path(__FILE__) . '/optionpanel/framework.php'))
{
	require_once ('optionpanel/framework.php');

}

if (!isset($redux_demo) && file_exists(plugin_dir_path(__FILE__) . '/opt/config.php'))
{
	require_once ('opt/config.php');

}

// Load Theme Options Panel

include_once(plugin_dir_path( __FILE__ ) . 'shortcode/frel-core.php');


include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-author.php');				// Load Widgets
include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-followers.php');			// Load Widgets
include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-social.php');				// Load Widgets
include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-top-articles.php');			// Load Widgets
include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-custom-categories.php');	// Load Widgets


add_filter( 'plugin_row_meta', 'xoxo_core_fn_plugin_row_meta', 10, 2 );

function xoxo_core_fn_plugin_row_meta( $plugin_meta, $plugin_file ) {
	if ( 'xoxo-core/xoxo-core.php' === $plugin_file ) {
		$row_meta = [
			'docs' 		=> '<a href="https://frenify.net/envato/frenify/wp/neoh/docs" target="_blank">Docs</a>',
			'faq' 		=> '<a href="https://frenify.net/envato/frenify/wp/neoh/docs/#faq" target="_blank">FAQs</a>',
			'changelog' => '<a href="https://frenify.net/envato/frenify/wp/neoh/docs/#changelog" target="_blank">Changelog</a>',
		];

		$plugin_meta = array_merge( $plugin_meta, $row_meta );
	}
	return $plugin_meta;
}


add_action('plugins_loaded', 'xoxo_fn_plugin_setup');

function xoxo_fn_plugin_setup(){

	// Load Meta Boxes
	include_once(plugin_dir_path( __FILE__ ) . 'inc/meta-box/metabox-config.php');

	// Call to Custom Post types and Functions
	include_once(plugin_dir_path( __FILE__ ) . 'inc/frenify-custompost.php');

	// Call to Custom Functions
	include_once(plugin_dir_path( __FILE__ ) . 'inc/frenify_custom_functions.php');

	// Call to Demo Import
	include_once(plugin_dir_path( __FILE__ ) . 'inc/demoimport/one-click-demo-import.php');
	include_once(plugin_dir_path( __FILE__ ) . 'inc/demoimport/demo-list.php');

	// Call Settings
	include_once(plugin_dir_path( __FILE__ ) . 'inc/settings/settings.php');

}


