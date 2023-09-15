<?php

namespace Frel;

// Exit if accessed directly. 
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Helper Class
class Frel_Helper
{
	
	public static function frel_open_wrap($container = ''){
		$html = '<div class="cons_w_wrapper">';
		if($container == 'container'){$html .= '<div class="container">';}
		return $html;
	}
	public static function frel_close_wrap($container = ''){
		$html = '</div>';
		if($container == 'container'){$html .= '</div>';}
		return $html;
	}

	public static function getAllParentCategories( $taxonomy, $number = 0 ) {
		$post_categories = array();
		
		$get_categories = get_categories('hide_empty=1%parent=0&number='. $number.'&orderby=name&order=ASC&taxonomy=' . $taxonomy);
		if( ! is_wp_error( $get_categories ) ) {
			if( $get_categories && is_array($get_categories) ) {
				foreach ( $get_categories as $cat ) {
					if( property_exists( $cat, 'slug' ) && 	property_exists( $cat, 'name' ) ) {
						$post_categories[$cat->slug] = $cat->name;
					}
				}
			}
			return $post_categories;
		}
		return array();
	}

	public static function getAllCategories( $taxonomy, $key = 'slug' ) {
		$post_categories = array();
		
		$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);
		if( ! is_wp_error( $get_categories ) ) {
			if( $get_categories && is_array($get_categories) ) {
				foreach ( $get_categories as $cat ) {
					if( property_exists( $cat, 'slug' ) && 	property_exists( $cat, 'name' ) ) {
						
						if($key == 'id'){
							$post_categories[$cat->term_id] = $cat->name;
						}else{
							$post_categories[$cat->slug] = $cat->name;
						}
					}
				}
			}
			return $post_categories;
		}
		return array();
	}
	
	
	public static function getAllPortfolioItems(){
		$query_args = array(
			'post_type' 			=> 'frenify-project',
			'posts_per_page' 		=> -1,
			'post_status' 			=> 'publish',
		);
		
		$loop = new \WP_Query($query_args);
		
		$array = array();

		foreach ( $loop->posts as $fn_post ) {
			setup_postdata( $fn_post );
			$post_id 			= $fn_post->ID;
			$post_title			= $fn_post->post_title;
			$array[$post_id] 	= '(ID: '.$post_id.') '. $post_title;
			wp_reset_postdata();
		}
		return $array;
	}
	
	public static function frenify_icons(){
		$arr = [	
					'mp3-soundcloud'				=> __( 'SoundCloud', 'xoxo-core' ),
					'mp3-spotify'					=> __( 'Spotify', 'xoxo-core' ),
					'mp3-google-podcast'			=> __( 'Google Podcasts', 'xoxo-core' ),
					'mp3-apple-podcast'				=> __( 'Apple Podcasts', 'xoxo-core' ),
					'mp3-mixcloud'					=> __( 'Mixcloud', 'xoxo-core' ),
				];
		ksort($arr);
		return $arr;
	}
	
	
	public static function getAllNavigations(){
		$menus = get_registered_nav_menus();
		$array = array();

		foreach ( $menus as $location => $description ) {
			$array[$location] 	= $description;
		}
		return $array;
	}
	
	
	public static function getAllBlogPosts(){
		$query_args = array(
			'post_type' 			=> 'post',
			'posts_per_page' 		=> -1,
			'post_status' 			=> 'publish',
		);
		
		$loop = new \WP_Query($query_args);
		
		$array = array();

		foreach ( $loop->posts as $fn_post ) {
			setup_postdata( $fn_post );
			$post_id 			= $fn_post->ID;
			$post_title			= $fn_post->post_title;
			$array[$post_id] 	= '(ID: '.$post_id.') '. $post_title;
			wp_reset_postdata();
		}
		return $array;
	}
	
	
	public static function getAllPodcasts(){
		$query_args = array(
			'post_type' 			=> 'frenify-podcast',
			'posts_per_page' 		=> -1,
			'post_status' 			=> 'publish',
		);
		
		$loop = new \WP_Query($query_args);
		
		$array = array();

		foreach ( $loop->posts as $fn_post ) {
			setup_postdata( $fn_post );
			$post_id 			= $fn_post->ID;
			$post_title			= $fn_post->post_title;
			$array[$post_id] 	= '(ID: '.$post_id.') '. $post_title;
			wp_reset_postdata();
		}
		return $array;
	}
	
	
	public static function getAllAuthors(){
		$users = get_users();
		$array = array();
		foreach ($users as $user) {
			$userID = $user->ID;
		   	$array[$userID] = '(ID: '.$userID.') '. $user->display_name . ' ( '.count_user_posts($userID).' )';
		}
		return $array;
	}
	
	
	public static function getAllBlogTags(){
		
		$tags = get_tags();
		$array = array();
		foreach ( $tags as $tag ) {
			$termID = $tag->term_id;
			$termName = $tag->name;
			$array[$termID] = '(ID: '.$termID.') '. $termName;
		}
		return $array;
	}

	
}
