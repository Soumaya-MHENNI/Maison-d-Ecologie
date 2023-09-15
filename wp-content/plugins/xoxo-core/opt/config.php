<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }



	$query_args = array(
		'post_type' 			=> 'post',
		'posts_per_page' 		=> -1,
		'post_status' 			=> 'publish',
	);

	$loop 						= new \WP_Query($query_args);

	$allPosts = array();

	foreach ( $loop->posts as $key => $fn_post ) {
		setup_postdata( $fn_post );
		$allPosts[$fn_post->ID] 	= '(ID: ' . $fn_post->ID . ') ' . $fn_post->post_title;
		wp_reset_postdata();
	}

    // This is your option name where all the Redux data is stored.
    $opt_name = "xoxo_fn_option";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ) . ' / Version: ' . $theme->get( 'Version' ),
        // Name that appears at the top of your panel
        'display_version'      => 'The theme is developed by <a href="https://frenify.com/" target="_blank">Frenify Team</a>',
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'xoxo_fn_option',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'xoxo-core',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_frenify_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );
    
    Redux::setArgs( $opt_name, $args );


    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::set_help_tab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::set_help_sidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
	$adminURL = '<a href="'.admin_url('options-permalink.php').'">'.esc_html__('Here', 'redux-framework-demo').'</a>';	 
	$permalink_description = __('After changing this, go to following link and click save. '.$adminURL.'', 'redux-framework-demo');

	$langURL = '<a target="_blank" href="https://wpml.org/">'.esc_html__('WPML Multilingual CMS', 'redux-framework-demo').'</a>';	 
	$lang_desc = __('Please, install and set up following plugin: '.$langURL.'', 'redux-framework-demo');
    // -> START Basic Fields



	
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'General', 'redux-framework-demo' ),
	'id'    => 'general',
	'icon'  => 'el el-globe',
	'fields' 	=> array(


		array(
			'id'		=> 'blog_single_title',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Page Title for Blog Single', 'redux-framework-demo'),
			'default'	=> esc_html__('Latest Articles', 'redux-framework-demo'),
		),

		array(
			'id' 		=> 'mcursor_start',
			'type' 		=> 'section',
			'title' 	=> esc_html__('Magic Cursor', 'redux-framework-demo'),
			'indent' 	=> true,
		),

		array(
			'id'		=> 'magic_cursor',
			'type' 		=> 'button_set',
			'title' 	=> esc_html__('Switcher', 'redux-framework-demo'),
			"multi" 	=> true,
			'options' 	=> array(
							'default'  		=> esc_html__('Default', 'redux-framework-demo'), 
							'link' 			=> esc_html__('Link Hover', 'redux-framework-demo'),
							'slider' 		=> esc_html__('Slider (Swiper)', 'redux-framework-demo'),
			),
			'default' 	=> array('default', 'link', 'slider'),			
		),
		array(
			'id'		=> 'mcursor_color',
			'type' 		=> 'color',
			'transparent' => false,
			'title' 	=> esc_html__('Cursor Color', 'redux-framework-demo'),
			'default'   => '#000000',
			'validate' 	=> 'color',
		),

		array(
			'id' 		=> 'mcursor_end',
			'type' 		=> 'section',
			'indent' 	=> false,
		),
		


	)

));
Redux::setSection( $opt_name, array(
		'title' => esc_html__( 'Main Colors', 'redux-framework-demo' ),
		'id'    => 'main_color',
		'icon'  => 'el el-brush ',
		'fields' 	=> array(
		array(
			'id'		=> 'body_bg_color',
			'type' 		=> 'color',
			'transparent' => false,
			'title' 	=> esc_html__('Text Color', 'redux-framework-demo'),
			'default' 	=> '#fff5cf',
			'validate' 	=> 'color',
		),
		array(
			'id'		=> 'main_color_1',
			'type' 		=> 'color',
			'transparent' => false,
			'title' 	=> esc_html__('Main Color #1', 'redux-framework-demo'),
			'default' 	=> '#ffcc00',
			'validate' 	=> 'color',
		),
		array(
			'id'		=> 'main_color_2',
			'type' 		=> 'color',
			'transparent' => false,
			'title' 	=> esc_html__('Main Color #2', 'redux-framework-demo'),
			'default' 	=> '#f16363',
			'validate' 	=> 'color',
		),
		array(
			'id'		=> 'heading_color',
			'type' 		=> 'color',
			'transparent' => false,
			'title' 	=> esc_html__('Heading Regular Color', 'redux-framework-demo'),
			'default' 	=> '#000000',
			'validate' 	=> 'color',
		),
		array(
			'id'		=> 'heading_hover_color',
			'type' 		=> 'color',
			'transparent' => false,
			'title' 	=> esc_html__('Heading Hover Color', 'redux-framework-demo'),
			'default' 	=> '#f16363',
			'validate' 	=> 'color',
		),
		array(
			'id'		=> 'body_color',
			'type' 		=> 'color',
			'transparent' => false,
			'title' 	=> esc_html__('Text Color', 'redux-framework-demo'),
			'default' 	=> '#000000',
			'validate' 	=> 'color',
		),
	)
));

Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Logo', 'redux-framework-demo' ),
	'id'    => 'logo',
	'icon'  => 'el el-puzzle',
	'fields' 	=> array(

		array(
			'id'			=> 'desktop_logo',
			'type' 			=> 'media',
			'url'       	=> true,
			'title' 		=> esc_html__('Desktop Logo', 'redux-framework-demo'),
		),

		array(
			'id'			=> 'retina_logo',
			'type' 			=> 'media',
			'url'      	 	=> true,
			'title' 		=> esc_html__('Desktop Retina Logo', 'redux-framework-demo'),
		),

		array(
			'id'			=> 'mobile_logo',
			'type' 			=> 'media',
			'url'      	 	=> true,
			'title' 		=> esc_html__('Mobile Logo', 'redux-framework-demo'),
		),

		array(
			'id'			=> 'mobile_retina_logo',
			'type' 			=> 'media',
			'url'      	 	=> true,
			'title' 		=> esc_html__('Mobile Retina Logo', 'redux-framework-demo'),
		),

	)
));

Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Desktop Navigation', 'redux-framework-demo' ),
	'id'    => 'desktop_navigation',
	'icon'  => 'el el-laptop',
	'fields' 	=> array(

		array(
			'id' 		=> 'search_switcher',
			'type' 		=> 'button_set',
			'title' 	=> __('Search Switcher', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')), 
			'default' 	=> 'enable'
		),
		array(
			'id'   		=> 'd_n_2',
			'type' 		=> 'divide'
		),

		
		array(
			'id'       => 'social_position',
			'type'     => 'sortable',
			'title'    => __('Social Icons', 'redux-framework-demo'),
			'subtitle' => __('Define and reorder these however you want.', 'redux-framework-demo'),
			'mode'     => 'checkbox',
			'options'  => array(
				'facebook'     		=> __('Facebook', 'redux-framework-demo'),
				'twitter'     		=> __('Twitter', 'redux-framework-demo'),
				'pinterest'     	=> __('Pinterest', 'redux-framework-demo'),
				'linkedin'     		=> __('Linkedin', 'redux-framework-demo'),
				'behance'     		=> __('Behance', 'redux-framework-demo'),
				'vimeo'      		=> __('Vimeo', 'redux-framework-demo'),
				'google'      		=> __('Google', 'redux-framework-demo'),
				'youtube'      		=> __('Youtube', 'redux-framework-demo'),
				'instagram'      	=> __('Instagram', 'redux-framework-demo'),
				'github'      		=> __('Github', 'redux-framework-demo'),
				'flickr'      		=> __('Flickr', 'redux-framework-demo'),
				'dribbble'      	=> __('Dribbble', 'redux-framework-demo'),
				'dropbox'	      	=> __('Dropbox', 'redux-framework-demo'),
				'paypal'	      	=> __('Paypal', 'redux-framework-demo'),
				'picasa'	      	=> __('Picasa', 'redux-framework-demo'),
				'soundcloud'      	=> __('SoundCloud', 'redux-framework-demo'),
				'whatsapp'	      	=> __('Whatsapp', 'redux-framework-demo'),
				'skype'	      		=> __('Skype', 'redux-framework-demo'),
				'slack'	      		=> __('Slack', 'redux-framework-demo'),
				'wechat'	      	=> __('WeChat', 'redux-framework-demo'),
				'icq'	     	 	=> __('ICQ', 'redux-framework-demo'),
				'rocketchat'   	 	=> __('RocketChat', 'redux-framework-demo'),					
				'telegram'	      	=> __('Telegram', 'redux-framework-demo'),
				'vk'		      	=> __('Vkontakte', 'redux-framework-demo'),
			),
			// For checkbox mode
			'default' => array(
				'facebook' => true,
				'twitter' => true,
				'pinterest' => true,
				'linkedin' => true,
				'behance' => true,
				'vimeo' => true,
				'google' => true,
				'youtube' => true,
				'instagram' => true,
				'github' => true,
				'flickr' => true,
				'dribbble' => true,
				'dropbox' => true,
				'paypal' => true,
				'picasa' => true,
				'soundcloud' => true,
				'whatsapp' => true,
				'skype' => true,
				'slack' => true,
				'wechat' => true,
				'icq' => true,
				'rocketchat' => true,
				'telegram' => true,
				'vk' => true,
			),
		),
		array(
			'id'		=> 'facebook_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Facebook URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'twitter_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Twitter URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'pinterest_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Pinterest URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'linkedin_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Linkedin URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'behance_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Behance URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'vimeo_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Vimeo URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'google_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Google URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'youtube_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Youtube URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'instagram_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Instagram URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'github_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Github URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'flickr_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Flickr URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'dribbble_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Dribbble URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'dropbox_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Dropbox URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'paypal_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Paypal URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'picasa_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Picasa URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'soundcloud_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Soundcloud URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'whatsapp_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Whatsapp URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'skype_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Skype URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'slack_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Slack URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'wechat_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Wechat URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'icq_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('ICQ URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'rocketchat_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Rocketchat URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'telegram_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Telegram URL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'vk_helpful',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Vkontakte URL', 'redux-framework-demo'),
		),
	)
));


Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Typography', 'redux-framework-demo' ),
	'id'    => 'typography',
	'icon'  => 'el el-font',
	'fields' 	=> array(
		array(
			'id'		=> 'body_font',
			'type' 		=> 'typography',
			'title' 	=> esc_html__('Body Font', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Specify the body font properties.', 'redux-framework-demo'),
			'google' 	=> true,
			'preview'	=> false,
			'line-height'=>false,
			'color' => false,
			'text-align' => false,
			'default' 	=> array(
				'font-size' 	=> '18px',
				'font-family' 	=> 'Work Sans',
				'font-weight' 	=> '400',
			),
			'output'      => array('body'),
		),
		array(
			'id'		=> 'nav_font',
			'type' 		=> 'typography',
			'title' 	=> esc_html__('Desktop Navigation Font', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Specify the navigation font properties.', 'redux-framework-demo'),
			'google' 	=> true,
			'preview'	=> false,
			'line-height'=>false,
			'color' 	=> false,
			'text-align' => false,
			'default' 	=> array(
				'font-size' 	=> '36px',
				'font-family' 	=> 'Montserrat',
				'font-weight' 	=> '400',
			),
			'output'      => array('.xoxo_fn_nav .nav_menu a'),
		),

		array(
			'id'		=> 'input_font',
			'type' 		=> 'typography',
			'title' 	=> esc_html__('Input Font', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Specify the Input font properties.', 'redux-framework-demo'),
			'google' 	=> true,
			'preview'	=> false,
			'line-height'=>false,
			'color' 	=> false,
			'text-align' => false,
			'default' 	=> array(
				'font-size' 	=> '16px',
				'font-family' 	=> 'Montserrat',
				'font-weight' 	=> '400',
			),
			'output'      => array('input'),
		),
		array(
			'id'		=> 'blockquote_font',
			'type' 		=> 'typography',
			'title' 	=> esc_html__('Blockquote Font', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Specify the blockquote font properties.', 'redux-framework-demo'),
			'google' 	=> true,
			'preview'	=> false,
			'line-height'=>false,
			'color' 	=> false,
			'text-align' => false,
			'default' 	=> array(
				'font-size' 	=> '20px',
				'font-family' 	=> 'Montserrat',
				'font-weight' 	=> '400',
			),
			'output'      => array('input'),
		),
		array(
			'id'		=> 'heading_font',
			'type' 		=> 'typography',
			'title' 	=> esc_html__('Heading Font', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Specify the heading font properties.', 'redux-framework-demo'),
			'google' 	=> true,
			'preview'	=> false,
			'line-height'=>false,
			'color' 	=> false,
			'font-size' => false,
			'text-align' => false,
			'default' 	=> array(
				'font-family' 	=> 'Montserrat',
				'font-weight' 	=> '400',
			),
			'output'      => array('h1,h2,h3,h4,h5,h6'),
		),
	)
));

Redux::setSection( $opt_name, array(
	'title' 	=> esc_html__( 'Reactions/Votes', 'redux-framework-demo' ),
	'id'    	=> 'reactions',
	'icon'  	=> 'el el-smiley',
	'fields' 	=> array(
		array(
			'id' 		=> 'vote_switcher',
			'type' 		=> 'button_set',
			'title' 	=> __('Votes Switcher', 'redux-framework-demo'),
			'options' 	=> array(
				'enable' 		=> esc_html__( 'Enable', 'redux-framework-demo' ),
				'disable' 		=> esc_html__( 'Disable', 'redux-framework-demo' ),
			), 
			'default' 	=> 'disable'
		),
		array(
			'id' 		=> 'reaction_switcher',
			'type' 		=> 'button_set',
			'title' 	=> __('Reaction Switcher', 'redux-framework-demo'),
			'options' 	=> array(
				'enable' 		=> esc_html__( 'Enable', 'redux-framework-demo' ),
				'disable' 		=> esc_html__( 'Disable', 'redux-framework-demo' ),
			), 
			'default' 	=> 'enable'
		),
		array(
			'id'       => 'reactions_default',
			'type'     => 'sortable',
			'title'    => __('Reactions', 'redux-framework-demo'),
			'subtitle' => __('Define and reorder these however you want.', 'redux-framework-demo'),
			'mode'     => 'checkbox',
			'options'  => array(
				'in_love'     		=> __('In Love', 'redux-framework-demo'),
				'happy'     		=> __('Happy', 'redux-framework-demo'),
				'not_sure'     		=> __('Not Sure', 'redux-framework-demo'),
				'omg'     			=> __('OMG', 'redux-framework-demo'),
				'angry'     		=> __('Angry', 'redux-framework-demo'),
				'sad'     			=> __('Sad', 'redux-framework-demo'),
				'lol'     			=> __('Lol', 'redux-framework-demo'),
				'cry'     			=> __('Cry', 'redux-framework-demo'),
				'silly'     		=> __('Silly', 'redux-framework-demo'),
				'crazy'     		=> __('Crazy', 'redux-framework-demo'),
			),
			// For checkbox mode
			'default' => array(
				'in_love' 	=> true,
				'happy' 	=> true,
				'not_sure' 	=> true,
				'omg' 		=> true,
				'angry' 	=> true,
				'sad' 		=> true,
				'lol' 		=> true,
				'cry' 		=> true,
				'silly' 	=> true,
				'crazy' 	=> true,
			),
		),
		array(
			'id'		=> 'reaction_in_love_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('In Love Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: In Love', 'redux-framework-demo'),
			'default' 	=> esc_html__('In Love', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_happy_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Happy Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: Happy', 'redux-framework-demo'),
			'default' 	=> esc_html__('Happy', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_not_sure_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Not Sure Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: Not Sure', 'redux-framework-demo'),
			'default' 	=> esc_html__('Not Sure', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_omg_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('OMG Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: OMG', 'redux-framework-demo'),
			'default' 	=> esc_html__('OMG', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_angry_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Angry Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: Angry', 'redux-framework-demo'),
			'default' 	=> esc_html__('Angry', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_sad_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Sad Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: Sad', 'redux-framework-demo'),
			'default' 	=> esc_html__('Sad', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_lol_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('LOL Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: LOL', 'redux-framework-demo'),
			'default' 	=> esc_html__('LOL', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_cry_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Cry Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: Cry', 'redux-framework-demo'),
			'default' 	=> esc_html__('Cry', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_silly_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Silly Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: Silly', 'redux-framework-demo'),
			'default' 	=> esc_html__('Silly', 'redux-framework-demo'),
		),
		array(
			'id'		=> 'reaction_crazy_text',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Crazy Text', 'redux-framework-demo'),
			'subtitle' 	=> esc_html__('Default Value: Crazy', 'redux-framework-demo'),
			'default' 	=> esc_html__('Crazy', 'redux-framework-demo'),
		),
	
		array(
			'id'          => 'reactions_custom',
			'type'        => 'slides',
			'title'       => esc_html__('Custom Reactions', 'redux-framework-demo'),
			'subtitle'    => esc_html__('Add/Reorder your custom reactions here', 'redux-framework-demo'),
			'placeholder' => array(
				'title' 		=> __( 'Reaction Title' , 'redux-framework-demo' ),
				'description' 	=> __( 'Upload your reaction icon (png).' , 'redux-framework-demo' ),
				'url' 			=> __( 'Reaction ID. Use only english lowercase/uppercase characters (a-z, A-Z) and symbol _. For example: reaction_hot.' , 'redux-framework-demo' )
			),
			'show' => array(
				'title' => true,
				'description' => false,
				'url' => true
			)
		),
	)
));

Redux::setSection( $opt_name, array(
	'title' 	=> esc_html__( 'Blog Single (wp post)', 'redux-framework-demo' ),
	'id'    	=> 'blogsingle',
	'icon'  	=> 'el el-file',
	'fields' 	=> array(
	
	
		array(
			'id' 		=> 'single_gallery_section_start',
			'type' 		=> 'section',
			'title' 	=> esc_html__('Gallery Type', 'redux-framework-demo'),
			'indent' 	=> true,
		),
	
		array(
			'id'        => 'single_gallery_slider_height_l',
			'type'      => 'slider',
			'title'     => esc_html__('Slider Height for laptop (in px)', 'redux-framework-demo'),
			"default"   => 700,
			"min"       => 1,
			"step"      => 1,
			"max"       => 2500,
			'display_value' => 'text'
		),
	
		array(
			'id'        => 'single_gallery_slider_height_m',
			'type'      => 'slider',
			'title'     => esc_html__('Slider Height for mobile (in px)', 'redux-framework-demo'),
			"default"   => 300,
			"min"       => 1,
			"step"      => 1,
			"max"       => 900,
			'display_value' => 'text'
		),
	
		array(
			'id' 		=> 'single_gallery_section_end',
			'type' 		=> 'section',
			'indent' 	=> false,
		),
		
	
	
		array(
			'id' 		=> 'single_sticky_title',
			'type' 		=> 'button_set',
			'title' 	=> __('Post Title Sticky in Single Post', 'redux-framework-demo'),
			'options' 	=> array(
				'enable' 		=> esc_html__( 'Enable', 'redux-framework-demo' ),
				'disable' 		=> esc_html__( 'Disable', 'redux-framework-demo' ),
			), 
			'default' 	=> 'enable'
		),
	
		array(
			'id' 		=> 'single_prevnext__layout',
			'type' 		=> 'button_set',
			'title' 	=> __('Previous/Next Layout', 'redux-framework-demo'),
			'options' 	=> array(
				'classic' 		=> esc_html__( 'Classic', 'redux-framework-demo' ),
//				'sticky' 		=> esc_html__( 'Sticky', 'redux-framework-demo' ),
				'none' 			=> esc_html__( 'None', 'redux-framework-demo' ),
			), 
			'default' 	=> 'classic'
		),
	
		array(
			'id' 		=> 'single_author_information',
			'type' 		=> 'button_set',
			'title' 	=> __('Author Information in Single Page', 'redux-framework-demo'),
			'options' 	=> array(
				'enable' 		=> esc_html__( 'Enable', 'redux-framework-demo' ),
				'disable' 		=> esc_html__( 'Disable', 'redux-framework-demo' ),
			), 
			'default' 	=> 'enable'
		),
	
		array(
			'id' 		=> 'single_comment_action',
			'type' 		=> 'button_set',
			'title' 	=> __('Comment Section', 'redux-framework-demo'),
			'options' 	=> array(
				'open' 			=> esc_html__( 'Open by default', 'redux-framework-demo' ),
				'closed' 		=> esc_html__( 'Closed by default', 'redux-framework-demo' ),
			), 
			'default' 	=> 'closed'
		),
	
		array(
			'id' 		=> 'single_auto_loading_post',
			'type' 		=> 'button_set',
			'title' 	=> __('Autoloading Post Switcher', 'redux-framework-demo'),
			'options' 	=> array(
				'enable' 		=> esc_html__( 'Enable', 'redux-framework-demo' ),
				'disable' 		=> esc_html__( 'Disable', 'redux-framework-demo' ),
			), 
			'default' 	=> 'enable'
		),
		
	)
));

Redux::setSection( $opt_name, array(
	'title' 	=> esc_html__( 'Blog', 'redux-framework-demo' ),
	'id'    	=> 'blogpage',
	'icon'  	=> 'el el-list-alt',
	'fields' 	=> array(
		
		
		array(
			'id' 		=> 'blog_bloglist_layout',
			'type' 		=> 'button_set',
			'title' 	=> __('Blog Page >> List Layout', 'redux-framework-demo'),
			'options' 	=> array(
				'classic' 		=> esc_html__( 'Classic', 'redux-framework-demo' ),
				'masonry' 		=> esc_html__( 'Masonry', 'redux-framework-demo' ),
							), 
			'default' 	=> 'classic'
		),
		
		array(
			'id' 		=> 'blog_category_layout',
			'type' 		=> 'button_set',
			'title' 	=> __('Category Page >> List Layout', 'redux-framework-demo'),
			'options' 	=> array(
				'classic' 		=> esc_html__( 'Classic', 'redux-framework-demo' ),
				'classic_s' 	=> esc_html__( 'Classic with Sidebar', 'redux-framework-demo' ),
				'masonry' 		=> esc_html__( 'Masonry', 'redux-framework-demo' ),
				'masonry_s' 	=> esc_html__( 'Masonry with Sidebar', 'redux-framework-demo' ),
							), 
			'default' 	=> 'classic'
		),
		
		array(
			'id' 		=> 'blog_archive_layout',
			'type' 		=> 'button_set',
			'title' 	=> __('Archive Page >> List Layout', 'redux-framework-demo'),
			'options' 	=> array(
				'classic' 		=> esc_html__( 'Classic', 'redux-framework-demo' ),
				'classic_s' 	=> esc_html__( 'Classic with Sidebar', 'redux-framework-demo' ),
				'masonry' 		=> esc_html__( 'Masonry', 'redux-framework-demo' ),
				'masonry_s' 	=> esc_html__( 'Masonry with Sidebar', 'redux-framework-demo' ),
							), 
			'default' 	=> 'classic'
		),
		
		array(
			'id' 		=> 'blog_author_layout',
			'type' 		=> 'button_set',
			'title' 	=> __('Blog Page >> List Layout', 'redux-framework-demo'),
			'options' 	=> array(
				'classic' 		=> esc_html__( 'Classic', 'redux-framework-demo' ),
				'masonry' 		=> esc_html__( 'Masonry', 'redux-framework-demo' ),
							), 
			'default' 	=> 'classic'
		),
		
		
		array(
			'id'        => 'blog_gap',
			'type'      => 'slider',
			'title'     => esc_html__('Blog Page Gap (in px)', 'redux-framework-demo'),
			"default"   => 60,
			"min"       => 0,
			"step"      => 1,
			"max"       => 200,
			'display_value' => 'text'
		),
	
		array(
			'id' 		=> 'featured_posts_switcher',
			'type' 		=> 'button_set',
			'title' 	=> __('Featured Posts (in blog page) Switcher', 'redux-framework-demo'),
			'options' 	=> array(
				'enable' 		=> esc_html__( 'Enable', 'redux-framework-demo' ),
				'disable' 		=> esc_html__( 'Disable', 'redux-framework-demo' ),
			), 
			'default' 	=> 'enable'
		),
		array(
			'id' 		=> 'featured_posts_type',
			'type' 		=> 'button_set',
			'title' 	=> __('Featured Posts Type', 'redux-framework-demo'),
			'options' 	=> array(
				'random' 		=> esc_html__( 'Random Posts', 'redux-framework-demo' ),
				'custom' 		=> esc_html__( 'Custom Posts', 'redux-framework-demo' ),
//				'trending' 		=> esc_html__( 'Trending Posts', 'redux-framework-demo' ),
			), 
			'default' 	=> 'random'
		),
	
		array(
			'id' 		=> 'featured_posts__count',
			'type' 		=> 'slider',
			'title' 	=> __('Display Posts Count', 'redux-framework-demo'),
			'min'  		=> 1,
			'max'  		=> 999,
			'step' 		=> 1,
			'default' 	=> 3,
			'required' 	=> array(
				array('featured_posts_type','=','random'),
			),
		),
	
		array(
			'id'       		=> 'featured_posts_custom',
			'type'     		=> 'select',
			'multi'     	=> true,
			'placeholder' 	=> esc_html__('Choose Posts', 'redux-framework-demo'),
			'title'			=> esc_html__('Custom Posts', 'redux-framework-demo'),
			'options'  		=> $allPosts,
			'required' 	=> array(
				array('featured_posts_type','=','custom'),
			),
		),
	
		array(
			'id' 		=> 'featured_posts_trending_count',
			'type' 		=> 'slider',
			'title' 	=> __('Trending Posts Last (Last x period)', 'redux-framework-demo'),
			'min'  		=> 1,
			'max'  		=> 999,
			'step' 		=> 1,
			'default' 	=> 1,
			'required' 	=> array(
				array('featured_posts_type','=','trending'),
			),
		),
	
		array(
			'id' 		=> 'featured_posts_trending_type',
			'type' 		=> 'button_set',
			'title' 	=> __('Trending Posts Type', 'redux-framework-demo'),
			'options' 	=> array(
				'day' 		=> esc_html__( 'Days', 'redux-framework-demo' ),
				'week' 		=> esc_html__( 'Weeks', 'redux-framework-demo' ),
				'month' 	=> esc_html__( 'Months', 'redux-framework-demo' ),
				'year' 		=> esc_html__( 'Years', 'redux-framework-demo' ),
							), 
			'default' 	=> 'month',
			'required' 	=> array(
				array('featured_posts_type','=','trending'),
			),
		),
	
	
		array(
			'id' 		=> 'extra_posts__section_start',
			'type' 		=> 'section',
			'title' 	=> esc_html__('Extra Posts List in Blog Page', 'redux-framework-demo'),
			'indent' 	=> true,
		),
	
		array(
			'id' 		=> 'extra_posts__switcher',
			'type' 		=> 'button_set',
			'title' 	=> __('Switcher', 'redux-framework-demo'),
			'options' 	=> array(
				'enable' 		=> esc_html__( 'Enable', 'redux-framework-demo' ),
				'disable' 		=> esc_html__( 'Disable', 'redux-framework-demo' ),
			), 
			'default' 	=> 'enable'
		),
		array(
			'id' 		=> 'extra_posts__type',
			'type' 		=> 'button_set',
			'title' 	=> __('Posts Type', 'redux-framework-demo'),
			'options' 	=> array(
				'random' 		=> esc_html__( 'Random Posts', 'redux-framework-demo' ),
				'custom' 		=> esc_html__( 'Custom Posts', 'redux-framework-demo' ),
				'trending' 		=> esc_html__( 'Trending Posts', 'redux-framework-demo' ),
			), 
			'default' 	=> 'random',
			'required' 	=> array(
				array('extra_posts__switcher','=','enable'),
			),
		),
	
		array(
			'id' 		=> 'extra_posts__count',
			'type' 		=> 'slider',
			'title' 	=> __('Posts Count', 'redux-framework-demo'),
			'min'  		=> 1,
			'max'  		=> 999,
			'step' 		=> 1,
			'default' 	=> 3,
			'required' 	=> array(
				array('extra_posts__type','!=','custom'),
				array('extra_posts__switcher','=','enable'),
			),
		),
	
		array(
			'id'       		=> 'extra_posts__custom',
			'type'     		=> 'select',
			'multi'     	=> true,
			'placeholder' 	=> esc_html__('Choose Posts', 'redux-framework-demo'),
			'title'			=> esc_html__('Custom Posts', 'redux-framework-demo'),
			'options'  		=> $allPosts,
			'required' 	=> array(
				array('extra_posts__type','=','custom'),
				array('extra_posts__switcher','=','enable'),
			),
		),
	
		array(
			'id' 		=> 'extra_posts__trending_count',
			'type' 		=> 'slider',
			'title' 	=> __('Trending Posts Last (Last x period)', 'redux-framework-demo'),
			'min'  		=> 1,
			'max'  		=> 999,
			'step' 		=> 1,
			'default' 	=> 1,
			'required' 	=> array(
				array('extra_posts__type','=','trending'),
				array('extra_posts__switcher','=','enable'),
			),
		),
	
		array(
			'id' 		=> 'extra_posts__trending_type',
			'type' 		=> 'button_set',
			'title' 	=> __('Trending Posts Type', 'redux-framework-demo'),
			'options' 	=> array(
				'day' 		=> esc_html__( 'Days', 'redux-framework-demo' ),
				'week' 		=> esc_html__( 'Weeks', 'redux-framework-demo' ),
				'month' 	=> esc_html__( 'Months', 'redux-framework-demo' ),
				'year' 		=> esc_html__( 'Years', 'redux-framework-demo' ),
							), 
			'default' 	=> 'month',
			'required' 	=> array(
				array('extra_posts__type','=','trending'),
				array('extra_posts__switcher','=','enable'),
			),
		),
		array(
			'id' 		=> 'extra_posts__section_end',
			'type' 		=> 'section',
			'indent' 	=> false,
		),
	)
));


Redux::setSection( $opt_name, array(
	'title' 	=> __( 'Footer', 'redux-framework-demo' ),
	'id'    	=> 'footer',
	'icon'  	=> 'el el-road',
	'fields' 	=> array(
	
		
		array(
			'id' 		=> 'footer_subscribe_switcher',
			'type' 		=> 'button_set',
			'title' 	=> __('Subscribe Switcher', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')), 
			'default' 	=> 'disable'
		),
	
	
		array(
			'id'		=> 'footer_subscribe_shortocde',
			'type' 		=> 'textarea',
			'title' 	=> esc_html__('Subscribe Form Shortcode', 'redux-framework-demo'),
			'required' 	=> array(
				array('footer_subscribe_switcher','=','enable'),
			),
		),
		
		array(
			'id' 		=> 'totop_switcher',
			'type' 		=> 'button_set',
			'title' 	=> __('Totop Switcher', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')), 
			'default' 	=> 'enable'
		),
	
	
		array(
			'id'		=> 'footer__copyright',
			'type' 		=> 'textarea',
			'title' 	=> esc_html__('Footer Copyright', 'redux-framework-demo'),
			'default'	=> '© [current_year] <a href="https://frenify.com/" target="_blank">Frenify</a>, All Rights Reserved.',
		),
		
	)
));


Redux::setSection( $opt_name, array(
	'title' => __( 'Share Options', 'redux-framework-demo' ),
	'id'    => 'sharebox',
	'icon'  => 'el el-share-alt',
	'fields' 	=> array(  
		array(
			'id' 		=> 'share_facebook',
			'type' 		=> 'button_set',
			'title' 	=> __('Facebook', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')), 
			'default' 	=> 'enable'
		),
		array(
			'id' 		=> 'share_twitter',
			'type' 		=> 'button_set',
			'title' 	=> __('Twitter', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')), 
			'default' 	=> 'enable'
		),
		array(
			'id' 		=> 'share_pinterest',
			'type' 		=> 'button_set',
			'title' 	=> __('Pinterest', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
			'default' 	=> 'enable'
		),
		array(
			'id' 		=> 'share_linkedin',
			'type' 		=> 'button_set',
			'title' 	=> __('Linkedin', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
			'default' 	=> 'disable'
		),
		array(
			'id' 		=> 'share_email',
			'type' 		=> 'button_set',
			'title' 	=> __('Email', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
			'default' 	=> 'disable'
		),
		array(
			'id' 		=> 'share_vk',
			'type' 		=> 'button_set',
			'title' 	=> __('Vkontakte', 'redux-framework-demo'),
			'options' 	=> array(
							'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
							'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
			'default' 	=> 'enable'
		),
	)
));
  
	
	
	
//Redux::setSection( $opt_name, array(
//	'title' => esc_html__( 'Translation', 'redux-framework-demo' ),
//	'id'    => 'translation',
//	'icon'  => 'el el-pencil',
//	'fields' 	=> array(
//		array(
//			'id' 		=> 'translation_type',
//			'type' 		=> 'button_set',
//			'title' 	=> __('Type', 'redux-framework-demo'),
//			'subtitle' 	=> __('We will periodically add new words gradually.', 'redux-framework-demo'),
//			'options' 	=> array(
//							'translator'  		=> esc_html__('Translator', 'redux-framework-demo'), 
//							'mannual' 			=> esc_html__('Mannual', 'redux-framework-demo')),
//			'default' 	=> 'translator'
//		),
//		array(
//			'id'		=> 't_404',
//			'type' 		=> 'textarea',
//			'title' 	=> esc_html__('404', 'redux-framework-demo'),
//			'default'	=> esc_html__('404', 'redux-framework-demo'),
//			'required' 	=> array(
//				array('translation_type','=','mannual'),
//			),
//		),
//	)
//)); 
	
	
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Custom CSS', 'redux-framework-demo' ),
	'id'    => 'css',
	'icon'  => 'el el-css',
	'fields' 	=> array(
		array(
			'id'       => 'custom_css',
			'type'     => 'ace_editor',
			'title'    => __('Custom CSS', 'redux-framework-demo'),
			'subtitle' => __('Paste your CSS code here.', 'redux-framework-demo'),
			'mode'     => 'css',
			'theme'    => 'monokai',
		),
	)
)); 
	

$seo_tags = array(	'span' 	=> 'span', 
					'p' 	=> 'p',		
					'h1' 	=> 'H1',		
					'h2' 	=> 'H2',		
					'h3' 	=> 'H3',		
					'h4' 	=> 'H4',		
					'h5' 	=> 'H5',		
					'h6' 	=> 'H6');


Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'SEO', 'redux-framework-demo' ),
	'id'    => 'seo',
	'icon'  => 'el el-signal',
	'fields' 	=> array(


		array(
			'id' 		=> 'seo_page_section_start',
			'type' 		=> 'section',
			'title' 	=> esc_html__('Pages HTML Tags', 'redux-framework-demo'),
			'indent' 	=> true,
		),

			array(
				'id'		=> 'seo_page_title',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Page Title', 'redux-framework-demo'),
				'default' 	=> 'h3',
				'options' 	=> $seo_tags
			),

			array(
				'id'		=> 'seo_404_number',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('404 Page: 404 Text', 'redux-framework-demo'),
				'default' 	=> 'h2',
				'options' 	=> $seo_tags
			),

			array(
				'id'		=> 'seo_404_not_found',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('404 Page: Not Found Text', 'redux-framework-demo'),
				'default' 	=> 'h3',
				'options' 	=> $seo_tags
			),

			array(
				'id'		=> 'seo_404_desc',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('404 Page: Description', 'redux-framework-demo'),
				'default' 	=> 'p',
				'options' 	=> $seo_tags
			),

		array(
			'id' 		=> 'seo_page_section_end',
			'type' 		=> 'section',
			'indent' 	=> false,
		),

	)
));
