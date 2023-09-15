<?php

function frenify_register_plugins( $plugins ) {
  $theme_plugins = [
//    [ // A WordPress.org plugin repository example.
//      'name'     	=> 'Elementor', // Name of the plugin.
//      'slug'     	=> 'elementor', // Plugin slug - the same as on WordPress.org plugin repository.
//      'required' 	=> true,
//    ],
	[ // A WordPress.org plugin repository example.
      'name'     	=> 'Contact Form 7', // Name of the plugin.
      'slug'     	=> 'contact-form-7', // Plugin slug - the same as on WordPress.org plugin repository.
      'required' 	=> false,
	  'preselected' => true,
    ],
	[ // A WordPress.org plugin repository example.
      'name'     	=> 'Categorify', // Name of the plugin.
      'slug'     	=> 'categorify', // Plugin slug - the same as on WordPress.org plugin repository.
      'required' 	=> true,
	  'preselected' => true,
    ],
    [
      'name'        => 'Redux Vendor Support',
      'slug'        => 'redux-vendor-support-master',  // The slug has to match the extracted folder from the zip.
      'source'      => 'https://github.com/reduxframework/redux-vendor-support/archive/master.zip',
	  'required' 	=> true,
    ],
  ];
 
  return array_merge( $plugins, $theme_plugins );
}
add_filter( 'ocdi/register_plugins', 'frenify_register_plugins' );


// ===============================================================================================================================
// ===============================================================================================================================
// ===============================================================================================================================


function frenify_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
 
    set_theme_mod( 'nav_menu_locations', [
            'main_menu' 	=> $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
            'mobile_menu' 	=> $main_menu->term_id,
            'footer_menu' 	=> $footer_menu->term_id,
        ]
    );
 
    // Assign front page
    $front_page_id = get_page_by_title( 'Home #1' );
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'permalink_structure', '/%postname%/' );
 
}
add_action( 'ocdi/after_import', 'frenify_after_import_setup' );


// ===============================================================================================================================
// ===============================================================================================================================
// ===============================================================================================================================


function frenify_import_files() {
  return [
	[
		'import_file_name'           => 'Main Demo',
		'import_file_url'            => 'https://frenify.net/envato/frenify/wp/xoxo/xml/1/content.xml',
		'import_widget_file_url'     => 'https://frenify.net/envato/frenify/wp/xoxo/xml/1/widgets.json',
		'import_redux'               => [
			[
			  'file_url'    => 'https://frenify.net/envato/frenify/wp/xoxo/xml/1/redux.json',
			  'option_name' => 'xoxo_fn_option',
			],
		],
		'import_preview_image_url'  => 'https://frenify.net/envato/frenify/wp/xoxo/xml/1/image.jpg',
		'preview_url'               => 'https://frenify.net/envato/frenify/wp/xoxo/1/',
		'preview_URI'				=> 'yеs',
	],
  ];
}
add_filter( 'ocdi/import_files', 'frenify_import_files' );


function ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'xoxo-core';
    $default_settings['page_title']  = esc_html__( 'Demo Import Page' , 'one-click-demo-import' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'one-click-demo-import' );
    $default_settings['capability']  = 'manage_options';
    $default_settings['menu_slug']   = 'theme-demo-import';
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'ocdi_plugin_page_setup' );