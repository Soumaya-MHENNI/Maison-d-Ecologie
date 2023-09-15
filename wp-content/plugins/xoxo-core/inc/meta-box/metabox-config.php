<?php
if ( defined( 'ABSPATH' ) && ! defined( 'RWMB_VER' ) ) {
	require_once dirname( __FILE__ ) . '/inc/loader.php';
	$loader = new RWMB_Loader();
	$loader->init();
}

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign




function metaboxes_container(){
	$prefix = 'xoxo_fn_';
	global $meta_boxes, $xoxo_fn_option;
	$meta_boxes = array();

	/* ----------------------------------------------------- */
	//  Page Options
	/* ----------------------------------------------------- */
	$meta_boxes[] = array(
		'id' => 'page_main_options',
		'title' => esc_html__('Page Options', 'xoxo-core'),
		'pages' => array( 'page' ),
		'context' => 'normal',	
		'priority' => 'high',

		// List of meta fields
		'fields' => array(

			array(
				'name'		=> esc_html__('Page Options', 'xoxo-core'),
				'type'		=> 'heading',
			),
			array(
				'name'		=> esc_html__('Page Style', 'xoxo-core'),
				'id'		=> $prefix . "page_style",
				'type'		=> 'select',
				'options'	=> array(
					'ffull'		=> esc_html__('Full Width', 'xoxo-core'),
					'full'		=> esc_html__('Contained', 'xoxo-core'),
					'ws'		=> esc_html__('Sidebar', 'xoxo-core'),

				),
				'multiple'	=> false,
				'std'		=> array( 'full' )
			),
			array(
				'name'			=> esc_html__('Page Title', 'xoxo-core'),
				'id'			=> $prefix . "page_title",
				'type'			=> 'select',
				'options'		=> array(
					'enable'	=> esc_html__('Enable', 'xoxo-core'),
					'disable'	=> esc_html__('Disable', 'xoxo-core'),

				),
				'multiple'	=> false,
				'std'		=> array( 'enable' )
			),
			
			array(
				'name'		=> esc_html__('Blog Page Options', 'xoxo-core'),
				'type'		=> 'heading',
			),
			array(
				'name'		=> esc_html__('Blog Page Style', 'xoxo-core'),
				'id'		=> $prefix . "blogpage_style",
				'type'		=> 'select',
				'options'	=> array(
					'classic'		=> esc_html__('Classic', 'xoxo-core'),
					'masonry'		=> esc_html__('Masonry', 'xoxo-core'),

				),
				'multiple'	=> false,
				'std'		=> array( 'classic' )
			),
			array(
				'name'		=> esc_html__('Blog Page Featured Posts', 'xoxo-core'),
				'id'		=> $prefix . "blogpage_featured",
				'type'		=> 'select',
				'options'	=> array(
					'enable'		=> esc_html__('Enabled', 'xoxo-core'),
					'disable'		=> esc_html__('Disabled', 'xoxo-core'),

				),
				'multiple'	=> false,
				'std'		=> array( 'disable' )
			),
		)
	);
	
	
	
	
	
	

	

/* ----------------------------------------------------- */
//  Video Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-video',
	'title' => esc_html__('Video Options', 'xoxo-core'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		
		array( 
				"name" 		=> esc_html__('Embeded Code', 'xoxo-core'),
				"desc" 		=> esc_html__('You can include embeded code here. (Youtube, Vimeo, Dailymotion, ....)', 'xoxo-core'),
				"id" 		=> $prefix."video_embed",
				"type"		=> "textarea",
				"std" 		=> ''
			),
	)
);

/* ----------------------------------------------------- */
//  Status Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-status',
	'title' => esc_html__('Status Options', 'xoxo-core'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		
		array( 
				"name" 		=> esc_html__('Enter Status', 'xoxo-core'),
				"desc" 		=> esc_html__('You can enter your status here.', 'xoxo-core'),
				"id" 		=> $prefix."status",
				"type"		=> "textarea",
				"std" 		=> ''
			),
	)
);

/* ----------------------------------------------------- */
//  Audio Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-audio',
	'title' => esc_html__('Audio Options', 'xoxo-core'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
				'name'		=> esc_html__('Embeded Code', 'xoxo-core'),
				'desc'		=> esc_html__('You can include embeded code here. (Soundcloud etc.)', 'xoxo-core'),
				'id'		=> $prefix . 'audio_embed',
				'type'		=> 'textarea',
				'std'		=> ''
		)
	)
);

/* ----------------------------------------------------- */
//  Gallery Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-gallery',
	'title' => esc_html__('Gallery Options', 'xoxo-core'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Gallery Images', 'xoxo-core'),
			'desc'		=> esc_html__('Upload images. In order to upload more images, use "Ctrl + Click"', 'xoxo-core'),
			'id'		=> $prefix . 'postgallery',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 100,
		),
	)
);

/* ----------------------------------------------------- */
//  Link Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-link',
	'title' => esc_html__('Link Options', 'xoxo-core'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Link URL',
			'desc'		=> esc_html__('Please input the URL for your link. I.e. http://www.exampledomain.com', 'xoxo-core'),
			'desc'		=> esc_html__('Please input the URL for your link. I.e. http://www.exampledomain.com', 'xoxo-core'),
			'id'		=> $prefix . 'link',
			'type'		=> 'text'	
		)
	)
);


/* ----------------------------------------------------- */
//  Quote Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-quote',
	'title' => esc_html__('Quote Options', 'xoxo-core'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Quote Content', 'xoxo-core'),
			'desc'		=> esc_html__('Please type the text for your quote here.', 'xoxo-core'),
			'id'		=> $prefix . 'quote',
			'type'		=> 'textarea'
		),
		array(
			'name'		=> esc_html__('Quote Author', 'xoxo-core'),
			'desc'		=> esc_html__('Please type the text for your author here.', 'xoxo-core'),
			'id'		=> $prefix . 'quote_author',
			'type'		=> 'text'
		),
	)
);


/* ----------------------------------------------------- */
//  Image Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-image',
	'title' => esc_html__('Image Options', 'xoxo-core'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Please, use "Featured Image" section to attach image.', 'xoxo-core'),
			'desc'		=> '',
			'id'		=> $prefix . 'image',
			'type'		=> 'heading'
		)	
	)
);
	/* ----------------------------------------------------- */
	//  Post Options
	/* ----------------------------------------------------- */

	$meta_boxes[] = array(
		'id' 		=> 'frenify-postoption',
		'title' 	=> esc_html__('Post Options', 'xoxo-core'),
		'pages' 	=> array( 'post' ),
		'context' 	=> 'normal',
		'priority' 	=> 'high',

		// List of meta fields
		'fields' => array(


			array(
				'name'		=> esc_html__('Page Options', 'xoxo-core'),
				'type'		=> 'heading',
			),

			array(
				'name'		=> esc_html__('Page Style', 'xoxo-core'),
				'id'		=> $prefix . "page_style",
				'type'		=> 'select',
				'options'	=> array(
					'full'		=> esc_html__('Full Width', 'xoxo-core'),
					'contained'	=> esc_html__('Contained', 'xoxo-core'),
					'ws'		=> esc_html__('Sidebar', 'xoxo-core'),

				),
				'multiple'	=> false,
				'std'		=> array( 'full' )
			),

//			array(
//				'name'			=> esc_html__('Page Sidebar', 'xoxo-core'),
//				'id'			=> $prefix . "page_sidebar",
//				'type'			=> 'sidebar',
//				'multiple'		=> false,
//				'field_type' 	=> 'select',
//			),
		)
	);


	
	
	return $meta_boxes;
}


/**************************************************************************/
/*********************								***********************/
/********************* 		META BOX REGISTERING 	***********************/
/*********************								***********************/
/**************************************************************************/

/**
 * Register meta boxes
 *
 * @return void
 */
function xoxo_fn_register_meta_boxes()
{
	$meta_boxes = metaboxes_container();

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'xoxo_fn_register_meta_boxes' );