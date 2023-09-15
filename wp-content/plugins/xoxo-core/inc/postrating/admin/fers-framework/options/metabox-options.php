<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Metabox of the POST
// Set a unique slug-like ID
//
$fers_prefix_post_opts = '_fers_prefix_post_options';

//
// Create a metabox
//
FERS::createMetabox(
	$fers_prefix_post_opts,
	array(
		'title'        => __( 'Frenify Rating', 'xoxo-core' ),
		'post_type'    => 'post',
		'show_restore' => false,
		'class'        => 'wpgper--metabox-wrap',
	)
);

//
// Create a section
//
FERS::createSection(
	$fers_prefix_post_opts,
	array(
		'fields' => array(

			array(
				'id'       => 'fers-score-shows',
				'type'     => 'switcher',
				'title'    => __( 'Enable/Disable', 'xoxo-core' ),
				'subtitle' => __( 'Enable or disable rating on this post.', 'xoxo-core' ),
				'default'  => false,
			),

			array(
				'id'         => 'fers-score-title',
				'type'       => 'text',
				'title'      => __( 'Title / Product Name', 'xoxo-core' ),
				'subtitle'   => __( 'Set an editorial rating title for this post.', 'xoxo-core' ),
				'default'    => '',
				'dependency' => array( 'fers-score-shows', '==', 1 ),
			),

			array(
				'id'         => 'fers-score-overview',
				'type'       => 'wp_editor',
				'title'      => __( 'Overview', 'xoxo-core' ),
				'subtitle'   => __( 'Give a general review or summary of the product.', 'xoxo-core' ),
				'dependency' => array( 'fers-score-shows', '==', 1 ),
			),

			array(
				'type'       => 'heading',
				'content'    => __( 'Categories', 'xoxo-core' ),
				'dependency' => array( 'fers-score-shows', '==', 1 ),
			),

			array(
				'id'           => 'fers-editorial-rating',
				'type'         => 'repeater',
				'title'        => __( 'Editorial Rating', 'xoxo-core' ),
				'subtitle'     => __( 'Set your product rating category & rate for this post. Use \'Add More\' button to create more.<br>Score Calculation: Total sum of each point / total rating category.', 'xoxo-core' ),
				'button_title' => 'Add More',
				'fields'       => array(

					array(
						'id'    => 'fers-editorial-rating-category-name',
						'title' => __( 'Category Name', 'xoxo-core' ),
						'type'  => 'text',
					),
					array(
						'id'    => 'fers-editorial-rating-category-rate',
						'title' => __( 'Category Rate', 'xoxo-core' ),
						'type'  => 'slider',
						'min'   => 0,
						'max'   => 100,
					),

				),
				'default'      => array(
					array(
						'fers-editorial-rating-category-name' => 'Features Rate',
						'fers-editorial-rating-category-rate' => 77,
					),
				),
				'dependency'   => array( 'fers-score-shows', '==', 1 ),
			),
	
			array(
				'type'       => 'heading',
				'content'    => __( 'PROS & CONS', 'xoxo-core' ),
				'dependency' => array( 'fers-score-shows', '==', 1 ),
			),

			array(
				'id'         => 'fers-pros-cons-shows',
				'type'       => 'switcher',
				'title'      => __( 'Show/Hide Pros-Cons On This Post.', 'xoxo-core' ),
				'subtitle'   => __( 'Show or hide Pros-Cons on this post.', 'xoxo-core' ),
				'default'    => true,
				'dependency' => array( 'fers-score-shows', '==', 1 ),
			),

			array(
				'id'           => 'fers-pros',
				'type'         => 'repeater',
				'title'        => __( 'Advantages List (Pros)', 'xoxo-core' ),
				'subtitle'     => __( 'Set advantage list for this post. Use \'Add More\' button to create more.', 'xoxo-core' ),
				'button_title' => 'Add More',
				'fields'       => array(

					array(
						'id'   => 'fers-pros-list',
						'type' => 'text',
					),

				),
				'default'      => array(
					array(
						'fers-pros-list' => 'Advantage Sample 1',
					),
				),
				'dependency'   => array( 'fers-score-shows|fers-pros-cons-shows', '==|==', 'true|true' ),
			),

			array(
				'id'           => 'fers-cons',
				'type'         => 'repeater',
				'title'        => __( 'Disadvantages List (Cons)', 'xoxo-core' ),
				'subtitle'     => __( 'Set disadvantages list for this post. Use \'Add More\' button to create more.', 'xoxo-core' ),
				'button_title' => 'Add More',
				'fields'       => array(

					array(
						'id'   => 'fers-cons-list',
						'type' => 'text',
					),

				),
				'default'      => array(
					array(
						'fers-cons-list' => 'Disadvantage Sample 1',
					),
				),
				'dependency'   => array( 'fers-score-shows|fers-pros-cons-shows', '==|==', 'true|true' ),
			),

			array(
				'type'       => 'heading',
				'content'    => __( 'Shortcode', 'xoxo-core' ),
				'dependency' => array( 'fers-score-shows', '==', 'true' ),
			),

			array(
				'type'       => 'shortcode',
				'title'      => 'Shortcode',
				'class'      => 'wpgp--shortcode-field',
				'dependency' => array( 'fers-score-shows', '==', 'true' ),
			),

		),
	)
);
