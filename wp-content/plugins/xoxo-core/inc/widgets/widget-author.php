<?php

/**
 * Plugin Name: Author
 * Description: A widget that show Author Information
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
class Xoxo_Author extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'Xoxo_Author', // Base ID
			esc_html__( 'Frenify Author', 'xoxo-core' ), // Name
			array( 'description' => esc_html__( 'Frenify Author', 'xoxo-core' ), ) // Args
		);
		
		add_action( 'widgets_init', function() {
            register_widget( 'Xoxo_Author' );
        });
	}
	

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		global $post;
		
		$title		= '';
		$userID		= '';
				
		
		/* Our variables from the widget settings. */
		if ( !empty( $instance[ 'title' ] ) ) { 
			$title 	= $instance[ 'title' ];
		}
		$title 		= apply_filters(esc_html__('About Me', 'xoxo-core'), $title );
		
		if ( !empty( $instance[ 'author' ] ) ) {$userID = $instance[ 'author' ];}
		
		
		
		
		/* Before widget (defined by themes). */
		echo wp_kses_post($before_widget);
		if ( $title ) {
			echo wp_kses_post($before_title . $title . $after_title); 
		}
		
		$list = '';
		
		if($userID != ''){
			$authorURL 	 		= get_author_posts_url($userID);
			$social				= xoxo_fn_get_user_social($userID);
			$name 				= esc_html( get_the_author_meta( 'xoxo_fn_user_name', $userID ) );
			$description		= esc_html( get_the_author_meta( 'xoxo_fn_user_desc', $userID ) );
			$imageURL			= esc_url( get_the_author_meta( 'xoxo_fn_user_image', $userID ) );

			if($name == ''){	
				$firstName 		= get_user_meta( $userID, 'first_name', true );
				$lastName 		= get_user_meta( $userID, 'last_name', true );
				$name 			= $firstName . ' ' . $lastName;
				if($firstName == ''){
					$name 		= get_user_meta( $userID, 'nickname', true );
				}
			}
			if($description == ''){
				$description 	= get_user_meta( $userID, 'description', true );
			}
			if($imageURL == ''){
				$imageURL		= get_avatar_url( $userID );
			}

			$image			= '<div class="abs_img"></div>';




			$title 			= '<h3 class="fn_title"><a href="'.esc_url($authorURL).'">'.$name.'</a></h3>';
			$description	= '<p class="fn_desc">'.$description.'</p>';
			$leftTop		= '<div class="author_top">'.$title.$description.'</div>';
			$leftBottom		= '<div class="author_bottom">'.$social.'</div>';
			$list  .= '<div class="info_img" data-bg-img="'.$imageURL.'"><a class="full_link" href="'.esc_url($authorURL).'"></a>'.$image.'</div>';
			$list  .= '<div class="info_desc">'.$leftTop.$leftBottom.'</div>';
		}
		
		?>
           	<div class="xoxo_fn_widget_author">
				<?php echo wp_kses_post($list); ?>
            </div>
            
		<?php 
		/* After widget (defined by themes). */
		echo wp_kses_post($after_widget);
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = array();
 
        $instance['title'] 	= ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['author'] 	= ( !empty( $new_instance['author'] ) ) ? strip_tags( $new_instance['author'] ) : '';
 
        return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		/* Set up some default widget settings. */
		$title 	= ! empty( $instance['title'] ) ? $instance['title'] : esc_html__('About Me', 'xoxo-core');
		$author 	= ! empty( $instance['author'] ) ? $instance['author'] : '';
		$users = get_users();
		$authorHTML = '<option value="">Select</option>';
		foreach ($users as $user) 
		{
			$selected = '';
			if($author == $user->ID){
				$selected = 'selected';
			}
			$authorHTML .= '<option '.$selected.' value="'.$user->ID.'">'.$user->display_name.'</option>';
		}
		?>
		<p class="xoxo_fn_social_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($title); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_social_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'author' )); ?>"><?php esc_html_e('Author:', 'xoxo-core'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'author' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>">
				<?php echo $authorHTML; ?>
			</select>
		</p>

	<?php
	}
}

$my_widget = new Xoxo_Author();