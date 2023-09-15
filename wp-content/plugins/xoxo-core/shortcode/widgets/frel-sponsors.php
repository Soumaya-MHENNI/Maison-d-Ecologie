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
class Frel_Sponsors extends Widget_Base {

	public function get_name() {
		return 'frel-sponsors';
	}

	public function get_title() {
		return __( 'Sponsors', 'xoxo-core' );
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
            'partners',
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
				'default' => esc_html__( 'Our Sponsors', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'link_text',
			[
				'label' => esc_html__( 'Link Text', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Become a Sponsor', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'link_url',
			[
				'label' => esc_html__( 'Link URL', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '#',
			]
		);
		
		
		$this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Sponsors', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
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
		$gallery		= $settings['gallery'];
		$layout			= $settings['layout'];
		
		$html = Frel_Helper::frel_open_wrap();

		$slideStart = $slideEnd = $slideButtons = $sliderStart = $sliderEnd = '';
		if($layout == 'carousel'){
			$slideStart = '<div class="swiper-slide">';
			$slideEnd = '</div>';
			$arrow = xoxo_fn_getSVG_theme('arrow2');
			$slideButtons = '<div class="slider__buttons"><a href="#" class="slider_nav prev"><span class="circle"></span><span class="icon">'.$arrow.'</span><span class="circle"></span></a><a href="#" class="slider_nav next"><span class="circle"></span><span class="icon">'.$arrow.'</span><span class="circle"></span></a></div>';
			$sliderStart = '<div class="swiper-container"><div class="swiper-wrapper">';
			$sliderEnd = '</div></div>';
		}
		$html .= '<div class="fn_cs_sponsor layout_'.$layout.'">';

			$html .= '<div class="fn__title_holder">';
				$html .= '<div class="left_title"><h3>'.$settings['title'].'</h3></div>';
				$html .= '<div class="lines"><span class="raleway"><span></span><span></span><span></span><span></span><span></span></span></div>';
				$html .= '<div class="right_title">';
					$html .= '<div class="see_all"><a href="'.$settings['link_url'].'">'.$settings['link_text'].'</a></div>';
					$html .= $slideButtons;
				$html .= '</div>';
			$html .= '</div>';
			
		
			$list = '';
			if(!empty($gallery)){
				foreach($gallery as $gal){
					$list .= $slideStart.'<div class="sponsor__item"><img src="'.$gal['url'].'" /></div>'.$slideEnd;
				}
			}

			$html .= '<div class="posts">'.$sliderStart.$list.$sliderEnd.'</div>';
		$html .= '</div>';

			
		
		
		$html .= Frel_Helper::frel_close_wrap();
		echo $html;
	}

}
