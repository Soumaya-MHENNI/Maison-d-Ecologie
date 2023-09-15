<?php
/*
Name: XoxoReactions
Description: Custom Reactions for Posts
Author: Frenify
Author URI: https://frenify.com/
*/


class XoxoReactions {
	
	 function __construct()   {	
        add_action('wp_ajax_xoxo_fn_reactions', array(&$this, 'ajax'));
		add_action('wp_ajax_nopriv_xoxo_fn_reactions', array(&$this, 'ajax'));
	}
	
	
	
	function ajax($postID) {
		
		//  -- update
		if( isset($_POST['ID']) ) {
			$postID 			= sanitize_text_field($_POST['ID']);
			$reaction_slug 		= '';
			if( isset($_POST['ajax_action']) ) {
				$reaction_slug 	= sanitize_text_field($_POST['ajax_action']);
			}
			echo wp_kses($this->actions($postID, 'update', $reaction_slug), 'post');
		}
		
		//  -- get
		else {
			echo wp_kses($this->actions($postID), 'post');
		}
		
		exit;
	}
	
	function is_active($postID,$reaction_slug){
		$is_active = false;
		if(isset($_COOKIE['xoxo_fn_reaction_'.$reaction_slug.'_'.$postID])){
			if($_COOKIE['xoxo_fn_reaction_'.$reaction_slug.'_'.$postID] != 0){
				$is_active = true;
			}
		}
		return $is_active;
	}
	
	
	function actions($postID, $action = 'get', $reaction_slug = '') 
	{
		if(!is_numeric($postID)) return;
		
		if($reaction_slug != ''){
			$count = (int)get_post_meta($postID, '_xoxo_fn_reaction_'.$reaction_slug, true);
			$is_active = $this->is_active($postID,$reaction_slug);
			
			if($is_active){
				$count--;
				setcookie('xoxo_fn_reaction_'.$reaction_slug.'_'. $postID, 0, time()*20, '/');
			}else{
				$count++;
				setcookie('xoxo_fn_reaction_'.$reaction_slug.'_'. $postID, $postID, time()*20, '/');
			}
			update_post_meta($postID, '_xoxo_fn_reaction_'.$reaction_slug, $count);
		}
		
		$ajax_action = $is_active == true ? 'remove': 'add';

		$buffyArray = array(
			'count' 		=> $count,
			'reaction' 		=> $reaction_slug,
			'ajax_action' 	=> $ajax_action,
		);
		
		if ( 'update' === $action ){
			die(json_encode($buffyArray));
		}
	}

	
	function get_count($postID, $reaction_slug){
		$count = get_post_meta($postID, '_xoxo_fn_reaction_'.$reaction_slug, true);
		if( !$count ){
			add_post_meta($postID, '_xoxo_fn_reaction_'.$reaction_slug, 0, true);
		}
		return (int)$count;
	}

	function add_reactions($postID) {
		global $xoxo_fn_option;
		if(isset($xoxo_fn_option['reaction_switcher']) && $xoxo_fn_option['reaction_switcher'] == 'enable'){
			$list = '';

			if(isset($xoxo_fn_option['reactions_default'])){
				foreach($xoxo_fn_option['reactions_default'] as $reaction_slug => $position){
					if($position == 1){
						$count = $this->get_count($postID,$reaction_slug);
						$is_active = $this->is_active($postID,$reaction_slug) == true ? 'active' : '';

						$list .= '<a class="xoxo_fn_reaction_btn '.$is_active.'" data-action="'.$reaction_slug.'" href="#" data-id="'.$postID.'">';
							$list .= '<span class="icon"><img src="'.esc_url(XOXO_ASSETS_URL).'svg/reactions/'.$reaction_slug.'.png" alt="" /></span>';
							$list .= '<span class="count">'.$count.'</span>';
							$list .= '<span class="text">'.$xoxo_fn_option['reaction_'.$reaction_slug.'_text'].'</span>';
						$list .= '</a>';
					}
				}
			}

			if(isset($xoxo_fn_option['reactions_custom'])){
				foreach($xoxo_fn_option['reactions_custom'] as $item){
					$reaction_slug = $item['url'];
					if($reaction_slug != ''){
						$reaction_slug = preg_replace("/[^A-Za-z0-9_]/", "", $reaction_slug);
						$reaction_slug = 'custom__'.$reaction_slug;
						$count = $this->get_count($postID,$reaction_slug);
						$is_active = $this->is_active($postID,$reaction_slug) == true ? 'active' : '';

						$list .= '<a class="xoxo_fn_reaction_btn '.$is_active.'" data-action="'.$reaction_slug.'" href="#" data-id="'.$postID.'">';
							$list .= '<span class="icon"><img src="'.$item['image'].'" alt="" /></span>';
							$list .= '<span class="count">'.$count.'</span>';
							$list .= '<span class="text">'.$item['title'].'</span>';
						$list .= '</a>';
					}
				}
			}



			$html = '<div class="xoxo_fn_reactions">';

				$html .= '<div class="reactions_list">';

					$html .= $list;

				$html .= '</div>';

			$html .= '</div>';

			return $html;
		}
		return '';
	}
	
}


global $xoxo_fn_reactions;
$xoxo_fn_reactions = new XoxoReactions();

// main function 
function xoxo_fn_reactions($postID, $return = '') {
	global $xoxo_fn_reactions;
	
	if($return == 'return') {
		return wp_kses($xoxo_fn_reactions->add_reactions($postID), 'post'); 
	} else {
		echo wp_kses($xoxo_fn_reactions->add_reactions($postID), 'post'); 
	}
} 
?>
