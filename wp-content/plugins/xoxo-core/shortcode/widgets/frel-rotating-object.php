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
class Frel_Rotating_Object extends Widget_Base {

	public function get_name() {
		return 'frel-rotating-object';
	}

	public function get_title() {
		return __( 'Rotating Image/Text', 'xoxo-core' );
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
			'type',
			[
				'label' 		=> __( 'Type', 'xoxo-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'full_slider',
				'options' 		=> [
					'image'  		=> __( 'Image', 'xoxo-core' ),
					'text'  		=> __( 'Text', 'xoxo-core' ),
				],
			]
		);
		
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Upload Icon', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'type'	=> 'image'
				]
			]
		);
		
		$this->add_control(
			'text',
			[
				'label' 		=> __( 'Text', 'xoxo-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default' 		=> 'About Me &#9679; About Me &#9679; About Me &#9679; ',
				'condition' => [
					'type'	=> 'text'
				]
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
		$settings = $this->get_settings();
		$type = $settings['type'];
		$text = $settings['text'];
		$image = $settings['image']['url'];
		
		$html  = Frel_Helper::frel_open_wrap();
		$html .= '<div class="fn_cs_rotating_object type_'.$type.'">';
		if($type == 'text'){
			$id = 'frenify_'.uniqid();
			$html .= xoxo_fn_getSVG_theme('star');
			$html .= '<svg viewBox="0 0 100 100" width="100" height="100">
						  <defs>
							<path id="'.$id.'"
							  d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0"/></defs>
							  <text font-size="17"><textPath xlink:href="#'.$id.'">'.$text.'</textPath></text>
						</svg>';
		}else{
			$html .= '<img src="'.XOXO_CORE_SHORTCODE_URL.'assets/img/thumb-square.jpg" alt="" />';
			$html .= '<div class="img" data-bg-img="'.$image.'"></div>';
		}
		
		
		$html .= '</div>';
		$html .= Frel_Helper::frel_close_wrap();
		
		echo $html;
		
	}

}
