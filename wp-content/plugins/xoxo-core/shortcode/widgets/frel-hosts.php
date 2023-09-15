<?php
namespace Frel\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Frel\Frel_Helper;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Frel Site Title
 */
class Frel_Hosts extends Widget_Base {

	public function get_name() {
		return 'frel-hosts';
	}

	public function get_title() {
		return __( 'Hosts', 'xoxo-core' );
	}

	public function get_icon() {
		return 'eicon-image-box frenifyicon-elementor';
	}

	public function get_categories() {
		return [ 'frel-elements' ];
	}
	
	public function get_keywords() {
        return [
            'frenify',
            'xoxo-core'
        ];
    }

	protected function register_controls() {
		
		
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'xoxo-core' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Meet Hosts', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'layout',
			[
				'label' 		=> __( 'Layout', 'xoxo-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'carousel',
				'options' 		=> [
					'carousel'			=> __( 'Carousel', 'xoxo-core' ),
					'listed'			=> __( 'Listed Posts', 'xoxo-core' ),
				],
			]
		);
		$this->end_controls_section();
		
		
	}


	protected function render() {
		$settings 		= $this->get_settings();
		$layout			= $settings['layout'];
		
		$html = Frel_Helper::frel_open_wrap();
		$args = array(
			'post_type' 		=> 'frenify-episode',  
			'post_status' 		=> 'publish',  
			'posts_per_page' 	=> -1,
			'meta_key'			=> 'xoxo_fn_episode_host',
			'orderby'			=> 'date'
		);

		$loop	= new \WP_Query($args);
		
		$hosts = array();
		
		if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); 
			$hosts = array_merge($hosts, get_post_meta(get_the_id(),'xoxo_fn_episode_host',false)); 
		endwhile; endif;wp_reset_query();
		
		$hosts = array_unique($hosts);
		
		$list = '';
		$thumb = '<img src="'.XOXO_CORE_SHORTCODE_URL.'assets/img/thumb-square.jpg" alt="" />';
		$wing = xoxo_fn_getSVG_theme('wing');
		
		$slideStart = $slideEnd = $slideButtons = $sliderStart = $sliderEnd = '';
		if($layout == 'carousel'){
			$slideStart = '<div class="swiper-slide">';
			$slideEnd = '</div>';
			$arrow = xoxo_fn_getSVG_theme('arrow2');
			$slideButtons = '<div class="slider__buttons"><a href="#" class="slider_nav prev"><span class="circle"></span><span class="icon">'.$arrow.'</span><span class="circle"></span></a><a href="#" class="slider_nav next"><span class="circle"></span><span class="icon">'.$arrow.'</span><span class="circle"></span></a></div>';
			$sliderStart = '<div class="swiper-container"><div class="swiper-wrapper">';
			$sliderEnd = '</div></div>';
		}else{
			$slideStart = '<li class="list_item">';
			$slideEnd = '</li>';
			$sliderStart = '<ul class="list_items">';
			$sliderEnd = '</ul>';
		}
		if(!empty($hosts)){
			foreach($hosts as $userID){
				$social				= xoxo_fn_get_user_social($userID);
				$name 				= esc_html( get_the_author_meta( 'xoxo_fn_user_name', $userID ) );
				$imageURL			= esc_url( get_the_author_meta( 'xoxo_fn_user_image', $userID ) );

				if($name == ''){	
					$firstName 		= get_user_meta( $userID, 'first_name', true );
					$lastName 		= get_user_meta( $userID, 'last_name', true );
					$name 			= $firstName . ' ' . $lastName;
					if($firstName == ''){
						$name 		= get_user_meta( $userID, 'nickname', true );
					}
				}
				if($imageURL == ''){
					$imageURL		= get_avatar_url( $userID );
				}
				$image			= '<div class="abs_img" data-fn-bg-img="'.$imageURL.'"></div>';
				$title 			= '<h3 class="fn_title">'.$name.'</h3>';
				
				$list  .= $slideStart.'<div class="host__item">';
					$list  .= '<div class="info_img">'.$thumb.$image.'</div>';
					$list  .= '<div class="title_holder">'.$title.$social.'</div>'.$wing;
				$list .= '</div>'.$slideEnd;
			}
		}
		
		
		$html .= '<div class="fn_cs_hosts layout_'.$layout.'">';

			$html .= '<div class="fn__title_holder">';
				$html .= '<div class="left_title"><h3>'.$settings['title'].'</h3></div>';
				$html .= '<div class="lines"><span class="raleway"><span></span><span></span><span></span><span></span><span></span></span></div>';
				$html .= '<div class="right_title">';
					$html .= $slideButtons;
				$html .= '</div>';
			$html .= '</div>';

			$html .= '<div class="posts">'.$sliderStart.$list.$sliderEnd.'</div>';
		
		$html .= '</div>';
		
		$html .= Frel_Helper::frel_close_wrap();
		echo $html;
	}

}
