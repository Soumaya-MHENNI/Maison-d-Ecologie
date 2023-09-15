<?php



if( ! class_exists( 'XOXO_Frenify_Custom_Post' ) ) {
	class XOXO_Frenify_Custom_Post {

		function __construct() {
			// podcast
//			add_action( 'init', array( $this, 'podcast_init' ) );
//			add_action( 'init', array( $this, 'podcast_taxonomy_init' ) );
			
			// episode
//			add_action( 'init', array( $this, 'episode_init' ) );
		}

		
		
		function podcast_init() {
			
			global $xoxo_fn_option;
			
			$project_slug = 'podcast';
			if(isset($xoxo_fn_option['podcast_slug']) && $xoxo_fn_option['podcast_slug'] != ''){
				$project_slug = $xoxo_fn_option['podcast_slug'];
			}
			
			
			$labels = array(
				'name'					=> esc_html__( 'Podcast Items', 'xoxo-core' ),
				'singular_name'			=> esc_html__( 'Podcast Item', 'xoxo-core' ),
				'menu_name'				=> esc_html__( 'Podcast Items', 'xoxo-core' ),
				'name_admin_bar' 		=> esc_html__( 'Podcast Items', 'xoxo-core' ),
				'add_new'				=> esc_html__( 'Add New', 'xoxo-core' ),
				'add_new_item'			=> esc_html__( 'Add New Podcast Item', 'xoxo-core' ),
				'edit_item' 			=> esc_html__( 'Edit Podcast Item', 'xoxo-core' ),
				'new_item' 				=> esc_html__( 'New Podcast Item', 'xoxo-core' ),
				'view_item' 			=> esc_html__( 'View Podcast Item', 'xoxo-core' ),
				'search_items' 			=> esc_html__( 'Search Podcast Items', 'xoxo-core' ),
				'not_found' 			=> esc_html__( 'No Podcast posts found', 'xoxo-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Podcast posts found in trash', 'xoxo-core' ),
				'all_items' 			=> esc_html__( 'Podcast Items', 'xoxo-core' )
			);
		
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-megaphone',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $project_slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'editor', 'thumbnail' )
			);
		
			register_post_type( 'frenify-podcast', $args );
		}
		
		function podcast_taxonomy_init() {
			
			global $xoxo_fn_option;
			
			$slug = 'podcast-cat';
			if(isset($xoxo_fn_option['podcast_cat_slug']) && $xoxo_fn_option['podcast_cat_slug'] != ''){
				$slug = $xoxo_fn_option['podcast_cat_slug'];
			}
		
			$labels = array(
				'name'							=> esc_html__( 'Podcast Categories', 'xoxo-core' ),
				'singular_name'					=> esc_html__( 'Podcast Category', 'xoxo-core' ),
				'menu_name'						=> esc_html__( 'Podcast Categories', 'xoxo-core' ),
				'edit_item'						=> esc_html__( 'Edit Category', 'xoxo-core' ),
				'update_item'					=> esc_html__( 'Update Category', 'xoxo-core' ),
				'add_new_item'					=> esc_html__( 'Add New Category', 'xoxo-core' ),
				'new_item_name'					=> esc_html__( 'New Category Name', 'xoxo-core' ),
				'parent_item'					=> esc_html__( 'Parent Category', 'xoxo-core' ),
				'parent_item_colon'				=> esc_html__( 'Parent Category:', 'xoxo-core' ),
				'all_items'						=> esc_html__( 'All Categories', 'xoxo-core' ),
				'search_items'					=> esc_html__( 'Search Categories', 'xoxo-core' ),
				'popular_items'					=> esc_html__( 'Popular Categories', 'xoxo-core' ),
				'separate_items_with_commas'	=> esc_html__( 'Separate Categoriess with commas', 'xoxo-core' ),
				'add_or_remove_items'			=> esc_html__( 'Add or remove Categories', 'xoxo-core' ),
				'choose_from_most_used'			=> esc_html__( 'Choose from the most used Categories', 'xoxo-core' ),
				'not_found'						=> esc_html__( 'No Categories found', 'xoxo-core' )
			);
		

			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'show_ui' 			=> true,
				'show_in_nav_menus'	=> true,
				'show_admin_column'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true,
				'query_var'			=> true,
				'rewrite'			=> array( 'slug' => $slug, 'with_front' => false, 'hierarchical' => true )
			);
			
			register_taxonomy( 'podcast_category', 'frenify-podcast', $args );
			
			
		}
		
		
		

		
		
		function episode_init() {
			
			global $xoxo_fn_option;
			
			$project_slug = 'episode';
			if(isset($xoxo_fn_option['episode_slug']) && $xoxo_fn_option['episode_slug'] != ''){
				$project_slug = $xoxo_fn_option['episode_slug'];
			}
			
			
			$labels = array(
				'name'					=> esc_html__( 'Episode Items', 'xoxo-core' ),
				'singular_name'			=> esc_html__( 'Episode Item', 'xoxo-core' ),
				'menu_name'				=> esc_html__( 'Episode Items', 'xoxo-core' ),
				'name_admin_bar' 		=> esc_html__( 'Episode Items', 'xoxo-core' ),
				'add_new'				=> esc_html__( 'Add New', 'xoxo-core' ),
				'add_new_item'			=> esc_html__( 'Add New Episode Item', 'xoxo-core' ),
				'edit_item' 			=> esc_html__( 'Edit Episode Item', 'xoxo-core' ),
				'new_item' 				=> esc_html__( 'New Episode Item', 'xoxo-core' ),
				'view_item' 			=> esc_html__( 'View Episode Item', 'xoxo-core' ),
				'search_items' 			=> esc_html__( 'Search Episode Items', 'xoxo-core' ),
				'not_found' 			=> esc_html__( 'No Episode posts found', 'xoxo-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Episode posts found in trash', 'xoxo-core' ),
				'all_items' 			=> esc_html__( 'Episode Items', 'xoxo-core' )
			);
		
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-format-audio',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $project_slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'editor', 'thumbnail' )
			);
		
			register_post_type( 'frenify-episode', $args );
		}
		
	
		
	}

	$xoxo_fn_custompost = new XOXO_Frenify_Custom_Post();
}