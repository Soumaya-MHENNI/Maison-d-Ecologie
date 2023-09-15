<?php

/* ------------------------------------------------------------------------ */
/* Define Sidebars */
/* ------------------------------------------------------------------------ */

add_action( 'widgets_init', 'xoxo_fn_widgets_init', 1000 );

function xoxo_fn_widgets_init() {
	if (function_exists('register_sidebar')) {
		$xoxo_fn_option = xoxo_fn_theme_option();
		/* ------------------------------------------------------------------------ */
		/* Footer Sidebar
		/* ------------------------------------------------------------------------ */

//		if(isset($xoxo_fn_option['footer_bottom_widget_switch']) && $xoxo_fn_option['footer_bottom_widget_switch'] === 'enable' ){
			
			register_sidebar(array(
				'name' => 'Footer Bottom Widget',
				'id'   => 'footer-bottom-widget',
				'description'   => esc_html__('This is widget for footer (bottom).', 'xoxo'),
				'before_widget' => '<div id="%1$s" class="widget_block clearfix %2$s"><div>',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="wid-title"><span class="text">',
				'after_title'   => '</span><span class="icon"></span></div>'
			));

//		}

		/* ------------------------------------------------------------------------ */
		/* Main Sidebar
		/* ------------------------------------------------------------------------ */
		register_sidebar(array(
			'name' 			=> 'Main Sidebar',
			'id'   			=> 'main-sidebar',
			'description'   => esc_html__('These are widgets for the sidebar.', 'xoxo'),
			'before_widget' => '<div id="%1$s" class="widget_block clear %2$s"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="wid-title"><span class="text">',
			'after_title'   => '</span><span class="icon"></span></div>'
		));
	}
}

    
?>