<?php
namespace Frel\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Frel\Frel_Helper;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Frel Site Title
 */
class Frel_Link extends Widget_Base {

	public function get_name() {
		return 'frel-link';
	}

	public function get_title() {
		return __( 'Link', 'xoxo-core' );
	}

	public function get_icon() {
		return 'eicon-editor-underline frenifyicon-elementor';
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
			'section1',
			[
				'label' => __( 'Content', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'link_text',
			[
				'label' 		=> __( 'Link Text', 'xoxo-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default'	 	=> __( 'Learn More', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'link_url',
			[
				'label' 		=> __( 'Link URL', 'xoxo-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default'	 	=> '#',
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_colors',
			[
				'label' => __( 'Colors', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'xoxo-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .fn__maintitle' => 'color: {{VALUE}};',
				],
				'default' => '#fff',
			]
		);
		
		$this->end_controls_section();

	}




	protected function render() {
		$settings 		= $this->get_settings();
		$link_url		= $settings['link_url'];
		$link_text		= $settings['link_text'];
		$arrow			= xoxo_fn_getSVG_theme('arrow2');
		$html  = Frel_Helper::frel_open_wrap();
			$html .= '<div class="fn_cs_link"><a class="big_arrow" href="'.$link_url.'"><span class="text">'.$link_text.'</span><span class="icon">'.$arrow.'</span></a></div>';
		$html .= Frel_Helper::frel_close_wrap();
		
		echo $html;
		
	}

}
