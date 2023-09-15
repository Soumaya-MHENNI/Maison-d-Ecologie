<?php

/**
 * Plugin Name: Followers Widget
 * Description: A widget that show followers icons
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
class Xoxo_Followers extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'xoxo_followers', // Base ID
			esc_html__( 'Frenify Followers', 'xoxo-core' ), // Name
			array( 'description' => esc_html__( 'Followers Icons', 'xoxo-core' ), ) // Args
		);
		
		add_action( 'widgets_init', function() {
            register_widget( 'Xoxo_Followers' );
        });
	}
	

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		global $post;
		
		$title					= '';
		
		$facebook				= '';
		$facebook__count		= '';
		$facebook__subtitle		= '';
		$twitter				= '';
		$twitter__count			= '';
		$twitter__subtitle		= '';
		$pinterest				= '';
		$pinterest__count		= '';
		$pinterest__subtitle	= '';
		$linkedin				= '';
		$linkedin__count		= '';
		$linkedin__subtitle		= '';
		$behance				= '';
		$behance__count			= '';
		$behance__subtitle		= '';
		$vimeo					= '';
		$vimeo__count			= '';
		$vimeo__subtitle		= '';
		$google					= '';
		$google__count			= '';
		$google__subtitle		= '';
		$youtube				= '';
		$youtube__count			= '';
		$youtube__subtitle		= '';
		$instagram				= '';
		$instagram__count		= '';
		$instagram__subtitle	= '';
		$github					= '';
		$github__count			= '';
		$github__subtitle		= '';
		$flickr					= '';
		$flickr__count			= '';
		$flickr__subtitle		= '';
		$dribbble				= '';
		$dribbble__count		= '';
		$dribbble__subtitle		= '';
		$dropbox				= '';
		$dropbox__count			= '';
		$dropbox__subtitle		= '';
		$paypal					= '';
		$paypal__count			= '';
		$paypal__subtitle		= '';
		$picasa					= '';
		$picasa__count			= '';
		$picasa__subtitle		= '';
		$soundcloud				= '';
		$soundcloud__count		= '';
		$soundcloud__subtitle	= '';
		$whatsapp				= '';
		$whatsapp__count		= '';
		$whatsapp__subtitle		= '';
		$skype					= '';
		$skype__count			= '';
		$skype__subtitle		= '';
		$slack					= '';
		$slack__count			= '';
		$slack__subtitle		= '';
		$wechat					= '';
		$wechat__count			= '';
		$wechat__subtitle		= '';
		$icq					= '';
		$icq__count				= '';
		$icq__subtitle			= '';
		$rocketchat				= '';
		$rocketchat__count		= '';
		$rocketchat__subtitle	= '';
		$telegram				= '';
		$telegram__count		= '';
		$telegram__subtitle		= '';
		$vkontakte				= '';
		$vkontakte__count		= '';
		$vkontakte__subtitle	= '';
		$rss					= '';
		$rss__count				= '';
		$rss__subtitle			= '';
				
		
		/* Our variables from the widget settings. */
		if ( !empty( $instance[ 'title' ] ) ) { 
			$title 			= $instance[ 'title' ];
		}
		$title 		= apply_filters(esc_html__('Followers', 'xoxo-core'), $title );
		
		
		if ( !empty( $instance[ 'facebook' ] ) ) {$facebook 						= $instance[ 'facebook' ];}
		if ( !empty( $instance[ 'facebook__count' ] ) ) {$facebook__count 			= $instance[ 'facebook__count' ];}
		if ( !empty( $instance[ 'facebook__subtitle' ] ) ) {$facebook__subtitle 	= $instance[ 'facebook__subtitle' ];}
		if ( !empty( $instance[ 'twitter' ] ) ) {$twitter 							= $instance[ 'twitter' ];}
		if ( !empty( $instance[ 'twitter__count' ] ) ) {$twitter__count 			= $instance[ 'twitter__count' ];}
		if ( !empty( $instance[ 'twitter__subtitle' ] ) ) {$twitter__subtitle 		= $instance[ 'twitter__subtitle' ];}
		if ( !empty( $instance[ 'pinterest' ] ) ) {$pinterest 						= $instance[ 'pinterest' ];}
		if ( !empty( $instance[ 'pinterest__count' ] ) ) {$pinterest__count 		= $instance[ 'pinterest__count' ];}
		if ( !empty( $instance[ 'pinterest__subtitle' ] ) ) {$pinterest__subtitle 	= $instance[ 'pinterest__subtitle' ];}
		if ( !empty( $instance[ 'linkedin' ] ) ) {$linkedin 						= $instance[ 'linkedin' ];}
		if ( !empty( $instance[ 'linkedin__count' ] ) ) {$linkedin__count 			= $instance[ 'linkedin__count' ];}
		if ( !empty( $instance[ 'linkedin__subtitle' ] ) ) {$linkedin__subtitle 	= $instance[ 'linkedin__subtitle' ];}
		if ( !empty( $instance[ 'behance' ] ) ) {$behance 							= $instance[ 'behance' ];}
		if ( !empty( $instance[ 'behance__count' ] ) ) {$behance__count 			= $instance[ 'behance__count' ];}
		if ( !empty( $instance[ 'behance__subtitle' ] ) ) {$behance__subtitle 		= $instance[ 'behance__subtitle' ];}
		if ( !empty( $instance[ 'vimeo' ] ) ) {$vimeo 								= $instance[ 'vimeo' ];}
		if ( !empty( $instance[ 'vimeo__count' ] ) ) {$vimeo__count 				= $instance[ 'vimeo__count' ];}
		if ( !empty( $instance[ 'vimeo__subtitle' ] ) ) {$vimeo__subtitle 			= $instance[ 'vimeo__subtitle' ];}
		if ( !empty( $instance[ 'google' ] ) ) {$google 							= $instance[ 'google' ];}
		if ( !empty( $instance[ 'google__count' ] ) ) {$google__count 				= $instance[ 'google__count' ];}
		if ( !empty( $instance[ 'google__subtitle' ] ) ) {$google__subtitle 		= $instance[ 'google__subtitle' ];}
		if ( !empty( $instance[ 'youtube' ] ) ) {$youtube 							= $instance[ 'youtube' ];}
		if ( !empty( $instance[ 'youtube__count' ] ) ) {$youtube__count 			= $instance[ 'youtube__count' ];}
		if ( !empty( $instance[ 'youtube__subtitle' ] ) ) {$youtube__subtitle 		= $instance[ 'youtube__subtitle' ];}
		if ( !empty( $instance[ 'instagram' ] ) ) {$instagram 						= $instance[ 'instagram' ];}
		if ( !empty( $instance[ 'instagram__count' ] ) ) {$instagram__count 		= $instance[ 'instagram__count' ];}
		if ( !empty( $instance[ 'instagram__subtitle' ] ) ) {$instagram__subtitle 	= $instance[ 'instagram__subtitle' ];}
		if ( !empty( $instance[ 'github' ] ) ) {$github 							= $instance[ 'github' ];}
		if ( !empty( $instance[ 'github__count' ] ) ) {$github__count 				= $instance[ 'github__count' ];}
		if ( !empty( $instance[ 'github__subtitle' ] ) ) {$github__subtitle 		= $instance[ 'github__subtitle' ];}
		if ( !empty( $instance[ 'flickr' ] ) ) {$flickr 							= $instance[ 'flickr' ];}
		if ( !empty( $instance[ 'flickr__count' ] ) ) {$flickr__count 				= $instance[ 'flickr__count' ];}
		if ( !empty( $instance[ 'flickr__subtitle' ] ) ) {$flickr__subtitle 		= $instance[ 'flickr__subtitle' ];}
		if ( !empty( $instance[ 'dribbble' ] ) ) {$dribbble 						= $instance[ 'dribbble' ];}
		if ( !empty( $instance[ 'dribbble__count' ] ) ) {$dribbble__count 			= $instance[ 'dribbble__count' ];}
		if ( !empty( $instance[ 'dribbble__subtitle' ] ) ) {$dribbble__subtitle 	= $instance[ 'dribbble__subtitle' ];}
		if ( !empty( $instance[ 'dropbox' ] ) ) {$dropbox 							= $instance[ 'dropbox' ];}
		if ( !empty( $instance[ 'dropbox__count' ] ) ) {$dropbox__count 			= $instance[ 'dropbox__count' ];}
		if ( !empty( $instance[ 'dropbox__subtitle' ] ) ) {$dropbox__subtitle 		= $instance[ 'dropbox__subtitle' ];}
		if ( !empty( $instance[ 'paypal' ] ) ) {$paypal 							= $instance[ 'paypal' ];}
		if ( !empty( $instance[ 'paypal__count' ] ) ) {$paypal__count 				= $instance[ 'paypal__count' ];}
		if ( !empty( $instance[ 'paypal__subtitle' ] ) ) {$paypa__subtitlel 		= $instance[ 'paypal__subtitle' ];}
		if ( !empty( $instance[ 'picasa' ] ) ) {$picasa 							= $instance[ 'picasa' ];}
		if ( !empty( $instance[ 'picasa__count' ] ) ) {$picasa__count 				= $instance[ 'picasa__count' ];}
		if ( !empty( $instance[ 'picasa__subtitle' ] ) ) {$picasa__subtitle 		= $instance[ 'picasa__subtitle' ];}
		if ( !empty( $instance[ 'soundcloud' ] ) ) {$soundcloud 					= $instance[ 'soundcloud' ];}
		if ( !empty( $instance[ 'soundcloud__count' ] ) ) {$soundcloud__count 		= $instance[ 'soundcloud__count' ];}
		if ( !empty( $instance[ 'soundcloud__subtitle' ] ) ) {$soundcloud__subtitle = $instance[ 'soundcloud__subtitle' ];}
		if ( !empty( $instance[ 'whatsapp' ] ) ) {$whatsapp 						= $instance[ 'whatsapp' ];}
		if ( !empty( $instance[ 'whatsapp__count' ] ) ) {$whatsapp__count 			= $instance[ 'whatsapp__count' ];}
		if ( !empty( $instance[ 'whatsapp__subtitle' ] ) ) {$whatsapp__subtitle 	= $instance[ 'whatsapp__subtitle' ];}
		if ( !empty( $instance[ 'skype' ] ) ) {$skype 								= $instance[ 'skype' ];}
		if ( !empty( $instance[ 'skype__count' ] ) ) {$skype__count 				= $instance[ 'skype__count' ];}
		if ( !empty( $instance[ 'skype__subtitle' ] ) ) {$skype__subtitle 			= $instance[ 'skype__subtitle' ];}
		if ( !empty( $instance[ 'slack' ] ) ) {$slack 								= $instance[ 'slack' ];}
		if ( !empty( $instance[ 'slack__count' ] ) ) {$slack__count 				= $instance[ 'slack__count' ];}
		if ( !empty( $instance[ 'slack__subtitle' ] ) ) {$slack__subtitle 			= $instance[ 'slack__subtitle' ];}
		if ( !empty( $instance[ 'wechat' ] ) ) {$wechat 							= $instance[ 'wechat' ];}
		if ( !empty( $instance[ 'wechat__count' ] ) ) {$wechat__count 				= $instance[ 'wechat__count' ];}
		if ( !empty( $instance[ 'wechat__subtitle' ] ) ) {$wechat__subtitle 		= $instance[ 'wechat__subtitle' ];}
		if ( !empty( $instance[ 'icq' ] ) ) {$icq 									= $instance[ 'icq' ];}
		if ( !empty( $instance[ 'icq__count' ] ) ) {$icq__count 					= $instance[ 'icq__count' ];}
		if ( !empty( $instance[ 'icq__subtitle' ] ) ) {$icq__subtitle 				= $instance[ 'icq__subtitle' ];}
		if ( !empty( $instance[ 'rocketchat' ] ) ) {$rocketchat 					= $instance[ 'rocketchat' ];}
		if ( !empty( $instance[ 'rocketchat__count' ] ) ) {$rocketchat__count 		= $instance[ 'rocketchat__count' ];}
		if ( !empty( $instance[ 'rocketchat__subtitle' ] ) ) {$rocketchat__subtitle = $instance[ 'rocketchat__subtitle' ];}
		if ( !empty( $instance[ 'telegram' ] ) ) {$telegram 						= $instance[ 'telegram' ];}
		if ( !empty( $instance[ 'telegram__count' ] ) ) {$telegram__count 			= $instance[ 'telegram__count' ];}
		if ( !empty( $instance[ 'telegram__subtitle' ] ) ) {$telegram__subtitle 	= $instance[ 'telegram__subtitle' ];}
		if ( !empty( $instance[ 'vkontakte' ] ) ) {$vkontakte 						= $instance[ 'vkontakte' ];}
		if ( !empty( $instance[ 'vkontakte__count' ] ) ) {$vkontakte__count 		= $instance[ 'vkontakte__count' ];}
		if ( !empty( $instance[ 'vkontakte__subtitle' ] ) ) {$vkontakte__subtitle 	= $instance[ 'vkontakte__subtitle' ];}
		if ( !empty( $instance[ 'rss' ] ) ) {$rss 									= $instance[ 'rss' ];}
		if ( !empty( $instance[ 'rss__count' ] ) ) {$rss__count 					= $instance[ 'rss__count' ];}
		if ( !empty( $instance[ 'rss__subtitle' ] ) ) {$rss__subtitle 				= $instance[ 'rss__subtitle' ];}
		
		$facebook_icon 		= '<i class="fn-icon-facebook"></i>';
		$twitter_icon 		= '<i class="fn-icon-twitter"></i>';
		$pinterest_icon 	= '<i class="fn-icon-pinterest"></i>';
		$linkedin_icon 		= '<i class="fn-icon-linkedin"></i>';
		$behance_icon 		= '<i class="fn-icon-behance"></i>';
		$vimeo_icon 		= '<i class="fn-icon-vimeo-1"></i>';
		$google_icon 		= '<i class="fn-icon-gplus"></i>';
		$youtube_icon 		= '<i class="fn-icon-youtube-play"></i>';
		$instagram_icon 	= '<i class="fn-icon-instagram"></i>';
		$github_icon 		= '<i class="fn-icon-github"></i>';
		$flickr_icon 		= '<i class="fn-icon-flickr"></i>';
		$dribbble_icon 		= '<i class="fn-icon-dribbble"></i>';
		$dropbox_icon 		= '<i class="fn-icon-dropbox"></i>';
		$paypal_icon 		= '<i class="fn-icon-paypal"></i>';
		$picasa_icon 		= '<i class="fn-icon-picasa"></i>';
		$soundcloud_icon 	= '<i class="fn-icon-soundcloud"></i>';
		$whatsapp_icon 		= '<i class="fn-icon-whatsapp"></i>';
		$skype_icon 		= '<i class="fn-icon-skype"></i>';
		$slack_icon 		= '<i class="fn-icon-slack"></i>';
		$wechat_icon 		= '<i class="fn-icon-wechat"></i>';
		$icq_icon 			= '<i class="fn-icon-icq"></i>';
		$rocketchat_icon 	= '<i class="fn-icon-rocket"></i>';
		$telegram_icon 		= '<i class="fn-icon-telegram"></i>';
		$vkontakte_icon 	= '<i class="fn-icon-vkontakte"></i>';
		$rss_icon		 	= '<i class="fn-icon-rss"></i>';
		
		
		/* Before widget (defined by themes). */
		echo wp_kses_post($before_widget);
		if ( $title ) {
			echo wp_kses_post($before_title . $title . $after_title); 
		}
		?>
           	<div class="xoxo_fn_widget_followers">
				<ul>
					<?php
						if($facebook != ''){
							echo '<li><div class="item"><a href="'.$facebook.'"></a><span class="icon">'.$facebook_icon.'</span><span class="count">'.$facebook__count.'</span><span class="subtitle">'.$facebook__subtitle.'</span></a></div></li>';
						}
						if($twitter != ''){
							echo '<li><div class="item"><a href="'.$twitter.'"></a><span class="icon">'.$twitter_icon.'</span><span class="count">'.$twitter__count.'</span><span class="subtitle">'.$twitter__subtitle.'</span></a></div></li>';
						}
						if($pinterest != ''){
							echo '<li><div class="item"><a href="'.$pinterest.'"></a><span class="icon">'.$pinterest_icon.'</span><span class="count">'.$pinterest__count.'</span><span class="subtitle">'.$pinterest__subtitle.'</span></a></div></li>';
						}
						if($linkedin != ''){
							echo '<li><div class="item"><a href="'.$linkedin.'"></a><span class="icon">'.$linkedin_icon.'</span><span class="count">'.$linkedin__count.'</span><span class="subtitle">'.$linkedin__subtitle.'</span></a></div></li>';
						}
						if($behance != ''){
							echo '<li><div class="item"><a href="'.$behance.'"></a><span class="icon">'.$behance_icon.'</span><span class="count">'.$behance__count.'</span><span class="subtitle">'.$behance__subtitle.'</span></a></div></li>';
						}
						if($vimeo != ''){
							echo '<li><div class="item"><a href="'.$vimeo.'"></a><span class="icon">'.$vimeo_icon.'</span><span class="count">'.$vimeo__count.'</span><span class="subtitle">'.$vimeo__subtitle.'</span></a></div></li>';
						}
						if($google != ''){
							echo '<li><div class="item"><a href="'.$google.'"></a><span class="icon">'.$google_icon.'</span><span class="count">'.$google__count.'</span><span class="subtitle">'.$google__subtitle.'</span></a></div></li>';
						}
						if($youtube != ''){
							echo '<li><div class="item"><a href="'.$youtube.'"></a><span class="icon">'.$youtube_icon.'</span><span class="count">'.$youtube__count.'</span><span class="subtitle">'.$youtube__subtitle.'</span></a></div></li>';
						}
						if($instagram != ''){
							echo '<li><div class="item"><a href="'.$instagram.'"></a><span class="icon">'.$instagram_icon.'</span><span class="count">'.$instagram__count.'</span><span class="subtitle">'.$instagram__subtitle.'</span></a></div></li>';
						}
						if($github != ''){
							echo '<li><div class="item"><a href="'.$github.'"></a><span class="icon">'.$github_icon.'</span><span class="count">'.$github__count.'</span><span class="subtitle">'.$github__subtitle.'</span></a></div></li>';
						}
						if($flickr != ''){
							echo '<li><div class="item"><a href="'.$flickr.'"></a><span class="icon">'.$flickr_icon.'</span><span class="count">'.$flickr__count.'</span><span class="subtitle">'.$flickr__subtitle.'</span></a></div></li>';
						}
						if($dribbble != ''){
							echo '<li><div class="item"><a href="'.$dribbble.'"></a><span class="icon">'.$dribbble_icon.'</span><span class="count">'.$dribbble__count.'</span><span class="subtitle">'.$dribbble__subtitle.'</span></a></div></li>';
						}
						if($dropbox != ''){
							echo '<li><div class="item"><a href="'.$dropbox.'"></a><span class="icon">'.$dropbox_icon.'</span><span class="count">'.$dropbox__count.'</span><span class="subtitle">'.$dropbox__subtitle.'</span></a></div></li>';
						}
						if($paypal != ''){
							echo '<li><div class="item"><a href="'.$paypal.'"></a><span class="icon">'.$paypal_icon.'</span><span class="count">'.$paypal__count.'</span><span class="subtitle">'.$paypal__subtitle.'</span></a></div></li>';
						}
						if($picasa != ''){
							echo '<li><div class="item"><a href="'.$picasa.'"></a><span class="icon">'.$picasa_icon.'</span><span class="count">'.$picasa__count.'</span><span class="subtitle">'.$picasa__subtitle.'</span></a></div></li>';
						}
						if($soundcloud != ''){
							echo '<li><div class="item"><a href="'.$soundcloud.'"></a><span class="icon">'.$soundcloud_icon.'</span><span class="count">'.$soundcloud__count.'</span><span class="subtitle">'.$soundcloud__subtitle.'</span></a></div></li>';
						}
						if($whatsapp != ''){
							echo '<li><div class="item"><a href="'.$whatsapp.'"></a><span class="icon">'.$whatsapp_icon.'</span><span class="count">'.$whatsapp__count.'</span><span class="subtitle">'.$whatsapp__subtitle.'</span></a></div></li>';
						}
						if($skype != ''){
							echo '<li><div class="item"><a href="'.$skype.'"></a><span class="icon">'.$skype_icon.'</span><span class="count">'.$skype__count.'</span><span class="subtitle">'.$skype__subtitle.'</span></a></div></li>';
						}
						if($slack != ''){
							echo '<li><div class="item"><a href="'.$slack.'"></a><span class="icon">'.$slack_icon.'</span><span class="count">'.$slack__count.'</span><span class="subtitle">'.$slack__subtitle.'</span></a></div></li>';
						}
						if($rocketchat != ''){
							echo '<li><div class="item"><a href="'.$rocketchat.'"></a><span class="icon">'.$rocketchat_icon.'</span><span class="count">'.$rocketchat__count.'</span><span class="subtitle">'.$rocketchat__subtitle.'</span></a></div></li>';
						}
						if($telegram != ''){
							echo '<li><div class="item"><a href="'.$telegram.'"></a><span class="icon">'.$telegram_icon.'</span><span class="count">'.$telegram__count.'</span><span class="subtitle">'.$telegram__subtitle.'</span></a></div></li>';
						}
						if($vkontakte != ''){
							echo '<li><div class="item"><a href="'.$vkontakte.'"></a><span class="icon">'.$vkontakte_icon.'</span><span class="count">'.$vkontakte__count.'</span><span class="subtitle">'.$vkontakte__subtitle.'</span></a></div></li>';
						}
						if($rss != ''){
							echo '<li><div class="item"><a href="'.$rss.'"></a><span class="icon">'.$rss_icon.'</span><span class="count">'.$rss__count.'</span><span class="subtitle">'.$rss__subtitle.'</span></a></div></li>';
						}
					?>
				</ul>
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
 
        $instance['title'] 					= ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['facebook'] 				= ( !empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['facebook__count'] 		= ( !empty( $new_instance['facebook__count'] ) ) ? strip_tags( $new_instance['facebook__count'] ) : '';
        $instance['facebook__subtitle'] 	= ( !empty( $new_instance['facebook__subtitle'] ) ) ? strip_tags( $new_instance['facebook__subtitle'] ) : '';
        $instance['twitter'] 				= ( !empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['twitter__count'] 		= ( !empty( $new_instance['twitter__count'] ) ) ? strip_tags( $new_instance['twitter__count'] ) : '';
        $instance['twitter__subtitle'] 		= ( !empty( $new_instance['twitter__subtitle'] ) ) ? strip_tags( $new_instance['twitter__subtitle'] ) : '';
        $instance['pinterest'] 				= ( !empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : '';
        $instance['pinterest__count'] 		= ( !empty( $new_instance['pinterest__count'] ) ) ? strip_tags( $new_instance['pinterest__count'] ) : '';
        $instance['pinterest__subtitle'] 	= ( !empty( $new_instance['pinterest__subtitle'] ) ) ? strip_tags( $new_instance['pinterest__subtitle'] ) : '';
        $instance['linkedin'] 				= ( !empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
        $instance['linkedin__count'] 		= ( !empty( $new_instance['linkedin__count'] ) ) ? strip_tags( $new_instance['linkedin__count'] ) : '';
        $instance['linkedin__subtitle'] 	= ( !empty( $new_instance['linkedin__subtitle'] ) ) ? strip_tags( $new_instance['linkedin__subtitle'] ) : '';
        $instance['behance'] 				= ( !empty( $new_instance['behance'] ) ) ? strip_tags( $new_instance['behance'] ) : '';
        $instance['behance__count'] 		= ( !empty( $new_instance['behance__count'] ) ) ? strip_tags( $new_instance['behance__count'] ) : '';
        $instance['behance__subtitle'] 		= ( !empty( $new_instance['behance__subtitle'] ) ) ? strip_tags( $new_instance['behance__subtitle'] ) : '';
        $instance['vimeo'] 					= ( !empty( $new_instance['vimeo'] ) ) ? strip_tags( $new_instance['vimeo'] ) : '';
        $instance['vimeo__count'] 			= ( !empty( $new_instance['vimeo__count'] ) ) ? strip_tags( $new_instance['vimeo__count'] ) : '';
        $instance['vimeo__subtitle'] 		= ( !empty( $new_instance['vimeo__subtitle'] ) ) ? strip_tags( $new_instance['vimeo__subtitle'] ) : '';
        $instance['google'] 				= ( !empty( $new_instance['google'] ) ) ? strip_tags( $new_instance['google'] ) : '';
        $instance['google__count'] 			= ( !empty( $new_instance['google__count'] ) ) ? strip_tags( $new_instance['google__count'] ) : '';
        $instance['google__subtitle'] 		= ( !empty( $new_instance['google__subtitle'] ) ) ? strip_tags( $new_instance['google__subtitle'] ) : '';
        $instance['youtube'] 				= ( !empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
        $instance['youtube__count'] 		= ( !empty( $new_instance['youtube__count'] ) ) ? strip_tags( $new_instance['youtube__count'] ) : '';
        $instance['youtube__subtitle'] 		= ( !empty( $new_instance['youtube__subtitle'] ) ) ? strip_tags( $new_instance['youtube__subtitle'] ) : '';
        $instance['instagram'] 				= ( !empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        $instance['instagram__count'] 		= ( !empty( $new_instance['instagram__count'] ) ) ? strip_tags( $new_instance['instagram__count'] ) : '';
        $instance['instagram__subtitle'] 	= ( !empty( $new_instance['instagram__subtitle'] ) ) ? strip_tags( $new_instance['instagram__subtitle'] ) : '';
        $instance['github'] 				= ( !empty( $new_instance['github'] ) ) ? strip_tags( $new_instance['github'] ) : '';
        $instance['github__count'] 			= ( !empty( $new_instance['github__count'] ) ) ? strip_tags( $new_instance['github__count'] ) : '';
        $instance['github__subtitle'] 		= ( !empty( $new_instance['github__subtitle'] ) ) ? strip_tags( $new_instance['github__subtitle'] ) : '';
        $instance['flickr'] 				= ( !empty( $new_instance['flickr'] ) ) ? strip_tags( $new_instance['flickr'] ) : '';
        $instance['flickr__count'] 			= ( !empty( $new_instance['flickr__count'] ) ) ? strip_tags( $new_instance['flickr__count'] ) : '';
        $instance['flickr__subtitle'] 		= ( !empty( $new_instance['flickr__subtitle'] ) ) ? strip_tags( $new_instance['flickr__subtitle'] ) : '';
        $instance['dribbble'] 				= ( !empty( $new_instance['dribbble'] ) ) ? strip_tags( $new_instance['dribbble'] ) : '';
        $instance['dribbble'] 				= ( !empty( $new_instance['dribbble__count'] ) ) ? strip_tags( $new_instance['dribbble__count'] ) : '';
        $instance['dribbble__subtitle'] 	= ( !empty( $new_instance['dribbble__subtitle'] ) ) ? strip_tags( $new_instance['dribbble__subtitle'] ) : '';
        $instance['dropbox'] 				= ( !empty( $new_instance['dropbox'] ) ) ? strip_tags( $new_instance['dropbox'] ) : '';
        $instance['dropbox__count'] 		= ( !empty( $new_instance['dropbox__count'] ) ) ? strip_tags( $new_instance['dropbox__count'] ) : '';
        $instance['dropbox__subtitle'] 		= ( !empty( $new_instance['dropbox__subtitle'] ) ) ? strip_tags( $new_instance['dropbox__subtitle'] ) : '';
        $instance['picasa'] 				= ( !empty( $new_instance['picasa'] ) ) ? strip_tags( $new_instance['picasa'] ) : '';
        $instance['picasa__count'] 			= ( !empty( $new_instance['picasa__count'] ) ) ? strip_tags( $new_instance['picasa__count'] ) : '';
        $instance['picasa__subtitle'] 		= ( !empty( $new_instance['picasa__subtitle'] ) ) ? strip_tags( $new_instance['picasa__subtitle'] ) : '';
        $instance['soundcloud'] 			= ( !empty( $new_instance['soundcloud'] ) ) ? strip_tags( $new_instance['soundcloud'] ) : '';
        $instance['soundcloud__count'] 		= ( !empty( $new_instance['soundcloud__count'] ) ) ? strip_tags( $new_instance['soundcloud__count'] ) : '';
        $instance['soundcloud__subtitle'] 	= ( !empty( $new_instance['soundcloud__subtitle'] ) ) ? strip_tags( $new_instance['soundcloud__subtitle'] ) : '';
        $instance['whatsapp'] 				= ( !empty( $new_instance['whatsapp'] ) ) ? strip_tags( $new_instance['whatsapp'] ) : '';
        $instance['whatsapp__count'] 		= ( !empty( $new_instance['whatsapp__count'] ) ) ? strip_tags( $new_instance['whatsapp__count'] ) : '';
        $instance['whatsapp__subtitle'] 	= ( !empty( $new_instance['whatsapp__subtitle'] ) ) ? strip_tags( $new_instance['whatsapp__subtitle'] ) : '';
        $instance['skype'] 					= ( !empty( $new_instance['skype'] ) ) ? strip_tags( $new_instance['skype'] ) : '';
        $instance['skype__count'] 			= ( !empty( $new_instance['skype__count'] ) ) ? strip_tags( $new_instance['skype__count'] ) : '';
        $instance['skype__subtitle'] 		= ( !empty( $new_instance['skype__subtitle'] ) ) ? strip_tags( $new_instance['skype__subtitle'] ) : '';
        $instance['slack'] 					= ( !empty( $new_instance['slack'] ) ) ? strip_tags( $new_instance['slack'] ) : '';
        $instance['slack__count'] 			= ( !empty( $new_instance['slack__count'] ) ) ? strip_tags( $new_instance['slack__count'] ) : '';
        $instance['slack__subtitle'] 		= ( !empty( $new_instance['slack__subtitle'] ) ) ? strip_tags( $new_instance['slack__subtitle'] ) : '';
        $instance['wechat'] 				= ( !empty( $new_instance['wechat'] ) ) ? strip_tags( $new_instance['wechat'] ) : '';
        $instance['wechat__count'] 			= ( !empty( $new_instance['wechat__count'] ) ) ? strip_tags( $new_instance['wechat__count'] ) : '';
        $instance['wechat__subtitle'] 		= ( !empty( $new_instance['wechat__subtitle'] ) ) ? strip_tags( $new_instance['wechat__subtitle'] ) : '';
        $instance['icq'] 					= ( !empty( $new_instance['icq'] ) ) ? strip_tags( $new_instance['icq'] ) : '';
        $instance['icq__count'] 			= ( !empty( $new_instance['icq__count'] ) ) ? strip_tags( $new_instance['icq__count'] ) : '';
        $instance['icq__subtitle'] 			= ( !empty( $new_instance['icq__subtitle'] ) ) ? strip_tags( $new_instance['icq__subtitle'] ) : '';
        $instance['rocketchat'] 			= ( !empty( $new_instance['rocketchat'] ) ) ? strip_tags( $new_instance['rocketchat'] ) : '';
        $instance['rocketchat__count'] 		= ( !empty( $new_instance['rocketchat__count'] ) ) ? strip_tags( $new_instance['rocketchat__count'] ) : '';
        $instance['rocketchat__subtitle'] 	= ( !empty( $new_instance['rocketchat__subtitle'] ) ) ? strip_tags( $new_instance['rocketchat__subtitle'] ) : '';
        $instance['telegram'] 				= ( !empty( $new_instance['telegram'] ) ) ? strip_tags( $new_instance['telegram'] ) : '';
        $instance['telegram__count'] 		= ( !empty( $new_instance['telegram__count'] ) ) ? strip_tags( $new_instance['telegram__count'] ) : '';
        $instance['telegram__subtitle'] 	= ( !empty( $new_instance['telegram__subtitle'] ) ) ? strip_tags( $new_instance['telegram__subtitle'] ) : '';
        $instance['vkontakte'] 				= ( !empty( $new_instance['vkontakte'] ) ) ? strip_tags( $new_instance['vkontakte'] ) : '';
        $instance['vkontakte__count'] 		= ( !empty( $new_instance['vkontakte__count'] ) ) ? strip_tags( $new_instance['vkontakte__count'] ) : '';
        $instance['vkontakte__subtitle'] 	= ( !empty( $new_instance['vkontakte__subtitle'] ) ) ? strip_tags( $new_instance['vkontakte__subtitle'] ) : '';
        $instance['rss'] 					= ( !empty( $new_instance['rss'] ) ) ? strip_tags( $new_instance['rss'] ) : '';
        $instance['rss__count'] 			= ( !empty( $new_instance['rss__count'] ) ) ? strip_tags( $new_instance['rss__count'] ) : '';
        $instance['rss__subtitle'] 			= ( !empty( $new_instance['rss__subtitle'] ) ) ? strip_tags( $new_instance['rss__subtitle'] ) : '';
 
        return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		/* Set up some default widget settings. */
		$title 					= ! empty( $instance['title'] ) ? $instance['title'] : esc_html__('Follow Us', 'xoxo-core');
		
		$facebook 				= ! empty( $instance['facebook'] ) ? $instance['facebook'] : '#';
		$facebook__count 		= ! empty( $instance['facebook__count'] ) ? $instance['facebook__count'] : '9,368';
		$facebook__subtitle 	= ! empty( $instance['facebook__subtitle'] ) ? $instance['facebook__subtitle'] : esc_html__('Facebook', 'xoxo-core');
		
		$twitter 				= ! empty( $instance['twitter'] ) ? $instance['twitter'] : '#';
		$twitter__count 		= ! empty( $instance['twitter__count'] ) ? $instance['twitter__count'] : '17,055';
		$twitter__subtitle 		= ! empty( $instance['twitter__subtitle'] ) ? $instance['twitter__subtitle'] : esc_html__('Twitter', 'xoxo-core');
		
		$pinterest 				= ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '#';
		$pinterest__count 		= ! empty( $instance['pinterest__count'] ) ? $instance['pinterest__count'] : '13,542';
		$pinterest__subtitle 	= ! empty( $instance['pinterest__subtitle'] ) ? $instance['pinterest__subtitle'] : esc_html__('Pinterest', 'xoxo-core');
		
		$linkedin 				= ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
		$linkedin__count 		= ! empty( $instance['linkedin__count'] ) ? $instance['linkedin__count'] : '';
		$linkedin__subtitle 	= ! empty( $instance['linkedin__subtitle'] ) ? $instance['linkedin__subtitle'] : '';
		
		$behance 				= ! empty( $instance['behance'] ) ? $instance['behance'] : '';
		$behance__count 		= ! empty( $instance['behance__count'] ) ? $instance['behance__count'] : '';
		$behance__subtitle 		= ! empty( $instance['behance__subtitle'] ) ? $instance['behance__subtitle'] : '';
		
		$vimeo 					= ! empty( $instance['vimeo'] ) ? $instance['vimeo'] : '';
		$vimeo__count 			= ! empty( $instance['vimeo__count'] ) ? $instance['vimeo__count'] : '';
		$vimeo__subtitle 		= ! empty( $instance['vimeo__subtitle'] ) ? $instance['vimeo__subtitle'] : '';
		
		$google 				= ! empty( $instance['google'] ) ? $instance['google'] : '';
		$google__count 			= ! empty( $instance['google__count'] ) ? $instance['google__count'] : '';
		$google__subtitle 		= ! empty( $instance['google__subtitle'] ) ? $instance['google__subtitle'] : '';
		
		$youtube 				= ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
		$youtube__count 		= ! empty( $instance['youtube__count'] ) ? $instance['youtube__count'] : '';
		$youtube__subtitle 		= ! empty( $instance['youtube__subtitle'] ) ? $instance['youtube__subtitle'] : '';
		
		$instagram 				= ! empty( $instance['instagram'] ) ? $instance['instagram'] : '#';
		$instagram__count 		= ! empty( $instance['instagram__count'] ) ? $instance['instagram__count'] : '22,893';
		$instagram__subtitle 	= ! empty( $instance['instagram__subtitle'] ) ? $instance['instagram__subtitle'] : esc_html__('Instagram', 'xoxo-core');
		
		$github 				= ! empty( $instance['github'] ) ? $instance['github'] : '';
		$github__count 			= ! empty( $instance['github__count'] ) ? $instance['github__count'] : '';
		$github__subtitle 		= ! empty( $instance['github__subtitle'] ) ? $instance['github__subtitle'] : '';
		
		$flickr 				= ! empty( $instance['flickr'] ) ? $instance['flickr'] : '';
		$flickr__count 			= ! empty( $instance['flickr__count'] ) ? $instance['flickr__count'] : '';
		$flickr__subtitle 		= ! empty( $instance['flickr__subtitle'] ) ? $instance['flickr__subtitle'] : '';
		
		$dribbble 				= ! empty( $instance['dribbble'] ) ? $instance['dribbble'] : '';
		$dribbble__count 		= ! empty( $instance['dribbble__count'] ) ? $instance['dribbble__count'] : '';
		$dribbble__subtitle 	= ! empty( $instance['dribbble__subtitle'] ) ? $instance['dribbble__subtitle'] : '';
		
		$dropbox 				= ! empty( $instance['dropbox'] ) ? $instance['dropbox'] : '';
		$dropbox__count 		= ! empty( $instance['dropbox__count'] ) ? $instance['dropbox__count'] : '';
		$dropbox__subtitle 		= ! empty( $instance['dropbox__subtitle'] ) ? $instance['dropbox__subtitle'] : '';
		
		$paypal 				= ! empty( $instance['paypal'] ) ? $instance['paypal'] : '';
		$paypal__count 			= ! empty( $instance['paypal__count'] ) ? $instance['paypal__count'] : '';
		$paypal__subtitle 		= ! empty( $instance['paypal__subtitle'] ) ? $instance['paypal__subtitle'] : '';
		
		$picasa 				= ! empty( $instance['picasa'] ) ? $instance['picasa'] : '';
		$picasa__count 			= ! empty( $instance['picasa__count'] ) ? $instance['picasa__count'] : '';
		$picasa__subtitle 		= ! empty( $instance['picasa__subtitle'] ) ? $instance['picasa__subtitle'] : '';
		
		$soundcloud				= ! empty( $instance['soundcloud'] ) ? $instance['soundcloud'] : '';
		$soundcloud__count		= ! empty( $instance['soundcloud__count'] ) ? $instance['soundcloud__count'] : '';
		$soundcloud__subtitle	= ! empty( $instance['soundcloud__subtitle'] ) ? $instance['soundcloud__subtitle'] : '';
		
		$whatsapp				= ! empty( $instance['whatsapp'] ) ? $instance['whatsapp'] : '';
		$whatsapp__count		= ! empty( $instance['whatsapp__count'] ) ? $instance['whatsapp__count'] : '';
		$whatsapp__subtitle		= ! empty( $instance['whatsapp__subtitle'] ) ? $instance['whatsapp__subtitle'] : '';
		
		$skype					= ! empty( $instance['skype'] ) ? $instance['skype'] : '';
		$skype__count			= ! empty( $instance['skype__count'] ) ? $instance['skype__count'] : '';
		$skype__subtitle		= ! empty( $instance['skype__subtitle'] ) ? $instance['skype__subtitle'] : '';
		
		$slack					= ! empty( $instance['slack'] ) ? $instance['slack'] : '';
		$slack__count			= ! empty( $instance['slack__count'] ) ? $instance['slack__count'] : '';
		$slack__subtitle		= ! empty( $instance['slack__subtitle'] ) ? $instance['slack__subtitle'] : '';
		
		$wechat					= ! empty( $instance['wechat'] ) ? $instance['wechat'] : '';
		$wechat__count			= ! empty( $instance['wechat__count'] ) ? $instance['wechat__count'] : '';
		$wechat__subtitle		= ! empty( $instance['wechat__subtitle'] ) ? $instance['wechat__subtitle'] : '';
		
		$icq					= ! empty( $instance['icq'] ) ? $instance['icq'] : '';
		$icq__count				= ! empty( $instance['icq__count'] ) ? $instance['icq__count'] : '';
		$icq__subtitle			= ! empty( $instance['icq__subtitle'] ) ? $instance['icq__subtitle'] : '';
		
		$rocketchat				= ! empty( $instance['rocketchat'] ) ? $instance['rocketchat'] : '';
		$rocketchat__count		= ! empty( $instance['rocketchat__count'] ) ? $instance['rocketchat__count'] : '';
		$rocketchat__subtitle	= ! empty( $instance['rocketchat__subtitle'] ) ? $instance['rocketchat__subtitle'] : '';
		
		$telegram				= ! empty( $instance['telegram'] ) ? $instance['telegram'] : '';
		$telegram__count		= ! empty( $instance['telegram__count'] ) ? $instance['telegram__count'] : '';
		$telegram__subtitle		= ! empty( $instance['telegram__subtitle'] ) ? $instance['telegram__subtitle'] : '';
		
		$vkontakte				= ! empty( $instance['vkontakte'] ) ? $instance['vkontakte'] : '';
		$vkontakte__count		= ! empty( $instance['vkontakte__count'] ) ? $instance['vkontakte__count'] : '';
		$vkontakte__subtitle	= ! empty( $instance['vkontakte__subtitle'] ) ? $instance['vkontakte__subtitle'] : '';
		
		$rss					= ! empty( $instance['rss'] ) ? $instance['rss'] : '';
		$rss__count				= ! empty( $instance['rss__count'] ) ? $instance['rss__count'] : '';
		$rss__subtitle			= ! empty( $instance['rss__subtitle'] ) ? $instance['rss__subtitle'] : '';
		
		$facebook_icon 		= '<i class="fn-icon-facebook"></i>';
		$twitter_icon 		= '<i class="fn-icon-twitter"></i>';
		$pinterest_icon 	= '<i class="fn-icon-pinterest"></i>';
		$linkedin_icon 		= '<i class="fn-icon-linkedin"></i>';
		$behance_icon 		= '<i class="fn-icon-behance"></i>';
		$vimeo_icon 		= '<i class="fn-icon-vimeo-1"></i>';
		$google_icon 		= '<i class="fn-icon-gplus"></i>';
		$youtube_icon 		= '<i class="fn-icon-youtube-play"></i>';
		$instagram_icon 	= '<i class="fn-icon-instagram"></i>';
		$github_icon 		= '<i class="fn-icon-github"></i>';
		$flickr_icon 		= '<i class="fn-icon-flickr"></i>';
		$dribbble_icon 		= '<i class="fn-icon-dribbble"></i>';
		$dropbox_icon 		= '<i class="fn-icon-dropbox"></i>';
		$paypal_icon 		= '<i class="fn-icon-paypal"></i>';
		$picasa_icon 		= '<i class="fn-icon-picasa"></i>';
		$soundcloud_icon 	= '<i class="fn-icon-soundcloud"></i>';
		$whatsapp_icon 		= '<i class="fn-icon-whatsapp"></i>';
		$skype_icon 		= '<i class="fn-icon-skype"></i>';
		$slack_icon 		= '<i class="fn-icon-slack"></i>';
		$wechat_icon 		= '<i class="fn-icon-wechat"></i>';
		$icq_icon 			= '<i class="fn-icon-icq"></i>';
		$rocketchat_icon 	= '<i class="fn-icon-rocket"></i>';
		$telegram_icon 		= '<i class="fn-icon-telegram"></i>';
		$vkontakte_icon 	= '<i class="fn-icon-vkontakte"></i>';
		$rss_icon		 	= '<i class="fn-icon-rss"></i>';
		
		?>
		<p class="xoxo_widget_divider"></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($title); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $facebook_icon; esc_html_e('Facebook', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" value="<?php echo esc_attr($facebook); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'facebook__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook__count' )); ?>" value="<?php echo esc_attr($facebook__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'facebook__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook__subtitle' )); ?>" value="<?php echo esc_attr($facebook__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $twitter_icon; esc_html_e('Twitter', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" value="<?php echo esc_attr($twitter); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'twitter__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter__count' )); ?>" value="<?php echo esc_attr($twitter__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'twitter__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter__subtitle' )); ?>" value="<?php echo esc_attr($twitter__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $pinterest_icon; esc_html_e('Pinterest', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" value="<?php echo esc_attr($pinterest); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'pinterest__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest__count' )); ?>" value="<?php echo esc_attr($pinterest__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'pinterest__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest__subtitle' )); ?>" value="<?php echo esc_attr($pinterest__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $linkedin_icon; esc_html_e('Linkedin', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" value="<?php echo esc_attr($linkedin); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'linkedin__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin__count' )); ?>" value="<?php echo esc_attr($linkedin__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'linkedin__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin__subtitle' )); ?>" value="<?php echo esc_attr($linkedin__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $behance_icon; esc_html_e('Behance', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'behance' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'behance' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'behance' )); ?>" value="<?php echo esc_attr($behance); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'behance__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'behance__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'behance__count' )); ?>" value="<?php echo esc_attr($behance__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'behance__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'behance__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'behance__subtitle' )); ?>" value="<?php echo esc_attr($behance__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $vimeo_icon; esc_html_e('Vimeo', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'vimeo' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'vimeo' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vimeo' )); ?>" value="<?php echo esc_attr($vimeo); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'vimeo__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'vimeo__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vimeo__count' )); ?>" value="<?php echo esc_attr($vimeo__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'vimeo__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'vimeo__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vimeo__subtitle' )); ?>" value="<?php echo esc_attr($vimeo__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $google_icon; esc_html_e('Google', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'google' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'google' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google' )); ?>" value="<?php echo esc_attr($google); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'google__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'google__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google__count' )); ?>" value="<?php echo esc_attr($google__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'google__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'google__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google__subtitle' )); ?>" value="<?php echo esc_attr($google__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $youtube_icon; esc_html_e('Youtube', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" value="<?php echo esc_attr($youtube); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'youtube__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube__count' )); ?>" value="<?php echo esc_attr($youtube__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'youtube__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube__subtitle' )); ?>" value="<?php echo esc_attr($youtube__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $instagram_icon; esc_html_e('Instagram', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' )); ?>" value="<?php echo esc_attr($instagram); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'instagram__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram__count' )); ?>" value="<?php echo esc_attr($instagram__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'instagram__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram__subtitle' )); ?>" value="<?php echo esc_attr($instagram__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $github_icon; esc_html_e('Github', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'github' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'github' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'github' )); ?>" value="<?php echo esc_attr($github); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'github__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'github__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'github__count' )); ?>" value="<?php echo esc_attr($github__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'github__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'github__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'github__subtitle' )); ?>" value="<?php echo esc_attr($github__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $flickr_icon; esc_html_e('Flickr', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'flickr' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'flickr' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr' )); ?>" value="<?php echo esc_attr($flickr); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'flickr__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'flickr__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr__count' )); ?>" value="<?php echo esc_attr($flickr__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'flickr__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'flickr__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr__subtitle' )); ?>" value="<?php echo esc_attr($flickr__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $dribbble_icon; esc_html_e('Dribbble', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'dribbble' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'dribbble' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbble' )); ?>" value="<?php echo esc_attr($dribbble); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'dribbble__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'dribbble__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbble__count' )); ?>" value="<?php echo esc_attr($dribbble__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'dribbble__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'dribbble__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbble__subtitle' )); ?>" value="<?php echo esc_attr($dribbble__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $dropbox_icon; esc_html_e('Dropbox', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'dropbox' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'dropbox' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dropbox' )); ?>" value="<?php echo esc_attr($dropbox); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'dropbox__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'dropbox__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dropbox__count' )); ?>" value="<?php echo esc_attr($dropbox__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'dropbox__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'dropbox__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dropbox__subtitle' )); ?>" value="<?php echo esc_attr($dropbox__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $paypal_icon; esc_html_e('Paypal', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'paypal' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'paypal' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'paypal' )); ?>" value="<?php echo esc_attr($paypal); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'paypal__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'paypal__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'paypal__count' )); ?>" value="<?php echo esc_attr($paypal__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'paypal__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'paypal__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'paypal__subtitle' )); ?>" value="<?php echo esc_attr($paypal__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $picasa_icon; esc_html_e('Picasa', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'picasa' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'picasa' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'picasa' )); ?>" value="<?php echo esc_attr($picasa); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'picasa__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'picasa__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'picasa__count' )); ?>" value="<?php echo esc_attr($picasa__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'picasa__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'picasa__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'picasa__subtitle' )); ?>" value="<?php echo esc_attr($picasa__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $soundcloud_icon; esc_html_e('Picasa', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'soundcloud' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'soundcloud' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'soundcloud' )); ?>" value="<?php echo esc_attr($soundcloud); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'soundcloud__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'soundcloud__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'soundcloud__count' )); ?>" value="<?php echo esc_attr($soundcloud__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'soundcloud__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'soundcloud__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'soundcloud__subtitle' )); ?>" value="<?php echo esc_attr($soundcloud__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $whatsapp_icon; esc_html_e('Whatsapp', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'whatsapp' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'whatsapp' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'whatsapp' )); ?>" value="<?php echo esc_attr($whatsapp); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'whatsapp__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'whatsapp__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'whatsapp__count' )); ?>" value="<?php echo esc_attr($whatsapp__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'whatsapp__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'whatsapp__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'whatsapp__subtitle' )); ?>" value="<?php echo esc_attr($whatsapp__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $skype_icon; esc_html_e('Skype', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype' )); ?>" value="<?php echo esc_attr($skype); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'skype__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'skype__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype__count' )); ?>" value="<?php echo esc_attr($skype__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'skype__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'skype__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype__subtitle' )); ?>" value="<?php echo esc_attr($skype__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $slack_icon; esc_html_e('Slack', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'slack' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'slack' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'slack' )); ?>" value="<?php echo esc_attr($slack); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'slack__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'slack__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'slack__count' )); ?>" value="<?php echo esc_attr($slack__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'slack__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'slack__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'slack__subtitle' )); ?>" value="<?php echo esc_attr($slack__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $wechat_icon; esc_html_e('Wechat', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'wechat' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'wechat' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'wechat' )); ?>" value="<?php echo esc_attr($wechat); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'wechat__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'wechat__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'wechat__count' )); ?>" value="<?php echo esc_attr($wechat__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'wechat__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'wechat__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'wechat__subtitle' )); ?>" value="<?php echo esc_attr($wechat__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $icq_icon; esc_html_e('ICQ', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'icq' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'icq' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icq' )); ?>" value="<?php echo esc_attr($icq); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'icq__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'icq__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icq__count' )); ?>" value="<?php echo esc_attr($icq__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'icq__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'icq__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icq__subtitle' )); ?>" value="<?php echo esc_attr($icq__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $rocketchat_icon; esc_html_e('Rocketchat', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'rocketchat' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'rocketchat' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rocketchat' )); ?>" value="<?php echo esc_attr($rocketchat); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'rocketchat__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'rocketchat__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rocketchat__count' )); ?>" value="<?php echo esc_attr($rocketchat__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'rocketchat__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'rocketchat__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rocketchat__subtitle' )); ?>" value="<?php echo esc_attr($rocketchat__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $telegram_icon; esc_html_e('Telegram', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'telegram' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'telegram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'telegram' )); ?>" value="<?php echo esc_attr($telegram); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'telegram__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'telegram__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'telegram__count' )); ?>" value="<?php echo esc_attr($telegram__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'telegram__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'telegram__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'telegram__subtitle' )); ?>" value="<?php echo esc_attr($telegram__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $vkontakte_icon; esc_html_e('Vkontakte', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'vkontakte' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'vkontakte' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vkontakte' )); ?>" value="<?php echo esc_attr($vkontakte); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'vkontakte__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'vkontakte__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vkontakte__count' )); ?>" value="<?php echo esc_attr($vkontakte__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'vkontakte__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'vkontakte__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vkontakte__subtitle' )); ?>" value="<?php echo esc_attr($vkontakte__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		
		
		<p class="xoxo_widget_divider"><?php echo $rss_icon; esc_html_e('RSS', 'xoxo-core'); ?></p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'rss' )); ?>"><?php esc_html_e('URL', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'rss' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rss' )); ?>" value="<?php echo esc_attr($rss); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'rss__count' )); ?>"><?php esc_html_e('Count', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'rss__count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rss__count' )); ?>" value="<?php echo esc_attr($rss__count); ?>" class="xoxo_fn_width100" />
		</p>
		<p class="xoxo_fn_followers_paragraph">
			<label for="<?php echo esc_attr($this->get_field_id( 'rss__subtitle' )); ?>"><?php esc_html_e('Subtitle', 'xoxo-core'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'rss__subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rss__subtitle' )); ?>" value="<?php echo esc_attr($rss__subtitle); ?>" class="xoxo_fn_width100" />
		</p>
		

	<?php
	}
}

$my_widget = new Xoxo_Followers();