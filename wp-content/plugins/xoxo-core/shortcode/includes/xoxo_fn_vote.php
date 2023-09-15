<?php
/*
Name: XoxoVote
Description: Custom Vote for Posts
Author: Frenify
Author URI: http://themeforest.net/user/frenify
*/


class XoxoVote {
	
	 function __construct()   {	
        add_action('wp_ajax_xoxo_fn_vote', array(&$this, 'ajax'));
		add_action('wp_ajax_nopriv_xoxo_fn_vote', array(&$this, 'ajax'));
	}
	
	
	
	function ajax($postID) {
		
		//  -- update
		if( isset($_POST['ID']) ) {
			$postID 	= sanitize_text_field($_POST['ID']);
			$voteAction = '';
			if( isset($_POST['voteAction']) ) {
				$voteAction = sanitize_text_field($_POST['voteAction']);
			}
			echo wp_kses($this->actions($postID, 'update', $voteAction), 'post');
		}
		
		//  -- get
		else {
			echo wp_kses($this->actions($postID), 'post');
		}
		
		exit;
	}
	
	function has_up($postID){
		$has_up = false;
		if(isset($_COOKIE['xoxo_fn_vote_up_'.$postID])){
			if($_COOKIE['xoxo_fn_vote_up_'.$postID] != 0){
				$has_up = true;
			}
		}
		return $has_up;
	}
	
	function has_down($postID){
		$has_down = false;
		if(isset($_COOKIE['xoxo_fn_vote_down_'.$postID])){
			if($_COOKIE['xoxo_fn_vote_down_'.$postID] != 0){
				$has_down = true;
			}
		}
		return $has_down;
	}
	
	
	function actions($postID, $action = 'get', $voteAction = '') 
	{
		if(!is_numeric($postID)) return;
		if($voteAction == 'up'){ 
			$count__up 	= (int)get_post_meta($postID, '_xoxo_fn_vote_up', true);
			$count__down = (int)get_post_meta($postID, '_xoxo_fn_vote_down', true);
			
			$has_up = $this->has_up($postID);
			$has_down = $this->has_down($postID);
			
			
			if(!$has_down){
				if(!$has_up){
					$count__up++;
					$difference = '+1';
				}
			}else{
				$count__up++;
				$count__down--;
				$difference = '+2';
			}
			setcookie('xoxo_fn_vote_up_'. $postID, $postID, time()*20, '/');
			setcookie('xoxo_fn_vote_down_'.$postID, 0, time()*20, '/');
			update_post_meta($postID, '_xoxo_fn_vote_up', $count__up);
			update_post_meta($postID, '_xoxo_fn_vote_down', $count__down);
		}else if($voteAction == 'down'){
			$count__up 	= (int)get_post_meta($postID, '_xoxo_fn_vote_up', true);
			$count__down = (int)get_post_meta($postID, '_xoxo_fn_vote_down', true);
			
			$has_up = $this->has_up($postID);
			$has_down = $this->has_down($postID);
			
			if(!$has_up){
				if(!$has_down){
					$count__down++;
					$difference = '-1';
				}
			}else{
				$count__up--;
				$count__down++;
				$difference = '-2';
			}
			setcookie('xoxo_fn_vote_down_'. $postID, $postID, time()*20, '/');
			setcookie('xoxo_fn_vote_up_'.$postID, 0, time()*20, '/');
			update_post_meta($postID, '_xoxo_fn_vote_down', $count__down);
			update_post_meta($postID, '_xoxo_fn_vote_up', $count__up);
		}else{
			$count__up = get_post_meta($postID, '_xoxo_fn_vote_up', true);
			if( !$count__up ){
				$count__up = 0;
				add_post_meta($postID, '_xoxo_fn_vote_up', $count__up, true);
			}
			
			$count__down = get_post_meta($postID, '_xoxo_fn_vote_down', true);
			if( !$count__down ){
				$count__down = 0;
				add_post_meta($postID, '_xoxo_fn_vote_down', $count__down, true);
			}
			
			$count__up = (int)$count__up;
			$count__down = (int)$count__down;
			return array('up' => $count__up,'down' => $count__down);
		}
		
		$count__result = (int)($count__up-$count__down);
		$count__votes = (int)($count__down+$count__up);
		$result__text = sprintf( esc_html__('%1$d People voted this article. %2$d Upvotes - %3$d Downvotes. ', 'xoxo-core'), $count__votes, $count__up, $count__down );

		$buffyArray = array(
			'result__text' 		=> $result__text,
			'count__result' 	=> $count__result,
			'difference' 		=> $difference,
		);
		
		if ( 'update' === $action ){
			die(json_encode($buffyArray));
		}
	}


	function add_like($postID) {
		global $xoxo_fn_option;
		if(isset($xoxo_fn_option['vote_switcher']) && $xoxo_fn_option['vote_switcher'] == 'enable'){
			$get_vars = $this->actions($postID);
			$count__up = (int)$get_vars['up'];
			$count__down = (int)$get_vars['down'];


			$has_up = $this->has_up($postID);
			$has_down = $this->has_down($postID);

			$extra_class = '';
			if($has_up){$extra_class = 'up_action';}
			if($has_down){$extra_class = 'down_action';}

			$count__result = (int)($count__up-$count__down);
			$count__votes = (int)($count__down+$count__up);

			$result__text = sprintf( esc_html__('%1$d People voted this article. %2$d Upvotes - %3$d Downvotes. ', 'xoxo-core'), $count__votes, $count__up, $count__down );


			$html = '<div class="xoxo_fn_votes '.$extra_class.'" data-id="'.$postID.'">';

				$html .= '<div class="vote_top">';
					$html .= '<a class="xoxo_fn_vote_up vote_btn" href="#"><span>'.esc_html__('Upvote','xoxo-core').'</span></a>';
					$html .= '<span class="result_vote"><span class="count">'.$count__result.'</span><span class="text">'.esc_html__('Points','xoxo-core').'</span><span class="action"></span></span>';
					$html .= '<a class="xoxo_fn_vote_down vote_btn" href="#"><span>'.esc_html__('Downvote','xoxo-core').'</span></a>';
				$html .= '</div>';

				$html .= '<div class="vote_info">'.$result__text.'</div>';

			$html .= '</div>';

			return $html;
		}
		return '';
	}
	
}


global $xoxo_fn_vote;
$xoxo_fn_vote = new XoxoVote();

// main function 
function xoxo_fn_vote($postID, $return = '') {
	global $xoxo_fn_vote;
	
	if($return == 'return') {
		return wp_kses($xoxo_fn_vote->add_like($postID), 'post'); 
	} else {
		echo wp_kses($xoxo_fn_vote->add_like($postID), 'post'); 
	}
} 
?>
