<?php

/**
 * Plugin Name: Top Articles
 * Description: A widget that show top news by comments
 * Version: 1.0
 * Author: Frenify
 * Author URI: http://themeforest.net/user/frenify
 *
 */


/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Xoxo_Top_Artilces extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'xoxo_top_articles', // Base ID
			esc_html__( 'Frenify Top Articles', 'xoxo-core' ), // Name
			array( 'description' => esc_html__( 'Top Articles', 'xoxo-core' ), ) // Args
		);
		
		add_action( 'widgets_init', function() {
            register_widget( 'Xoxo_Top_Artilces' );
        });
	}
	

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		global $post;
		
		$title		= '';
		$count		= 3;
		$layout		= 'alpha';
				
		
		/* Our variables from the widget settings. */
		if ( !empty( $instance[ 'title' ] ) ) { 
			$title 	= $instance[ 'title' ];
		}
		$title 		= apply_filters(esc_html__('Popular Posts', 'xoxo-core'), $title );
		
		if ( !empty( $instance[ 'count' ] ) ) {$count = $instance[ 'count' ];}
		if ( !empty( $instance[ 'layout' ] ) ) {$layout = $instance[ 'layout' ];}
		
		$count = (int)$count;
		if($count < 1){
			$count = 1;
		}
		
		
		/* Before widget (defined by themes). */
		echo wp_kses_post($before_widget);
		if ( $title ) {
			echo wp_kses_post($before_title . $title . $after_title); 
		}
		
		$query_args = array(
			'post_type' 			=> 'post',
			'posts_per_page' 		=> $count,
			'post_status' 			=> 'publish',
			'orderby' 				=> 'comment_count',
//			'orderby' 				=> 'rand',
			'order' 				=> 'DESC',
			'post__not_in'			=> get_option( 'sticky_posts' ),
//    'meta_query' => array(
//        array(
//         'key' => '_thumbnail_id',
//         'compare' => 'EXISTS'
//        ),
//    )
		);
		
		
		$arrow = '<span class="arrow">'.xoxo_fn_getSVG_theme('arrow2').'</span>';
		$loop = new \WP_Query($query_args);
		$list = '';
		if($layout == 'alpha'){
			$list = '<div class="xoxo_fn_widget_articles"><ul>';
			foreach ( $loop->posts as $key => $fn_post ) {
				setup_postdata( $fn_post );
				$post_id 			= $fn_post->ID;
				$post_permalink 	= get_permalink($post_id);
				$post_title			= $fn_post->post_title;
				$title 				= '<h3 class="fn_title">'.$post_title.'</h3>';
				$count				= get_comments_number( $post_id );
				$commentCount		= sprintf( _n( '%s Comment', '%s Comments', $count, 'xoxo-core' ), number_format_i18n( $count ) );

				$post_time			= '<p class="fn_date"><span class="post_date">'. get_the_time(get_option('date_format'), $post_id) .'</span><span class="comment_count">'.$commentCount.'</span></p>';
				$myKey				= '<span class="count"><span>'.($key + 1).'</span></span>';
				$list .= '<li><div class="item"><a class="full_link" href="'.$post_permalink.'"></a>'.$title.$post_time.$arrow.$myKey.'</div></li>';
				wp_reset_postdata();
			}
			$list .= '</ul></div>';
		}else if($layout == 'beta'){
			$list = '<div class="xoxo_fn_widget_beta_articles">';
			foreach ( $loop->posts as $key => $fn_post ) {
				setup_postdata( $fn_post );
				$post_id 			= $fn_post->ID;
				$post_permalink 	= get_permalink($post_id);
				$post_title			= $fn_post->post_title;
				$title 				= '<h3 class="fn_title"><a href="'.$post_permalink.'">'.$post_title.'</a></h3>';
				if($key == 0){
					$image = '';
					$imageURL = get_the_post_thumbnail_url($post_id,'full');
					if($imageURL != ''){
						$image = '<div class="item_img"><a class="full_link" href="'.$post_permalink.'"></a><img src="'.$imageURL.'" /></div>';
					}
					$list .= '<div class="top_article">'.$image.$title.'<div class="t_rail"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div></div>';
				}else{
					$image = '';
					$imageURL = get_the_post_thumbnail_url($post_id,'thumbnail');
					if($imageURL != ''){
						$image = '<div class="item_img" data-bg-img="'.$imageURL.'"></div>';
					}
					$list .= '<div class="bottom_article"><a class="full_link" href="'.$post_permalink.'"></a>'.$image.$title.'</div>';
				}
				
				wp_reset_postdata();
			}
			$list .= '</div>';
		}
		
		echo $list; ?>
            
		<?php 
		/* After widget (defined by themes). */
		echo wp_kses_post($after_widget);
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = array();
 
        $instance['title'] 			= ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['count'] 			= ( !empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
        $instance['layout'] 		= ( !empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : '';
 
        return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		/* Set up some default widget settings. */
		$title 			= ! empty( $instance['title'] ) ? $instance['title'] : esc_html__('Popular Posts', 'xoxo-core');
		$count 			= ! empty( $instance['count'] ) ? $instance['count'] : 3;
		$layout 		= ! empty( $instance['layout'] ) ? $instance['layout'] : 'alpha';
		
		$alphaSelect = $betaSelect = '';
		if($layout == 'alpha'){$alphaSelect = 'selected';}
		else if($layout == 'beta'){$betaSelect = 'selected';}
		?>
		<p class="xoxo_fn_social_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'layout' )); ?>"><?php esc_html_e('Layout', 'xoxo-core'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'layout' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>">
				<option <?php echo esc_attr($alphaSelect);?> value="alpha"><?php esc_html_e('Alpha', 'xoxo-core'); ?></option>
				<option <?php echo esc_attr($betaSelect);?> value="beta"><?php esc_html_e('Beta', 'xoxo-core'); ?></option>
			</select>
		</p>
		<p class="xoxo_fn_social_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($title); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_social_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php esc_html_e('Post Count:', 'xoxo-core'); ?></label>
			<input min="1" type="number" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($count); ?>" class="xoxo_fn_width100" />
		</p>

	<?php
	}
}

$my_widget = new Xoxo_Top_Artilces();