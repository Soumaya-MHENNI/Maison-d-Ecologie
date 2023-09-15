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
class Frel_Nav extends Widget_Base {

	public function get_name() {
		return 'frel-nav';
	}

	public function get_title() {
		return __( 'Navigation', 'xoxo-core' );
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
			'nav',
			[
				 'label'	 	=> __( 'Select Navigation', 'xoxo-core' ),
				 'type' 		=> Controls_Manager::SELECT2,
				 'multiple'	 	=> false,
				 'label_block'	=> true,
				 'options' 		=> Frel_Helper::getAllNavigations(),
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
		$nav = $settings['nav'];
		
		$html  = Frel_Helper::frel_open_wrap();
		$html .= '<div class="fn_cs_nav">';
		$arrow = '<div class="iconn">'.xoxo_fn_getSVG_theme('arrow-curly').'</div>';
		
		if($nav != ''){
			if(has_nav_menu($nav)){
				$menu = wp_nav_menu( array('theme_location'  => $nav,'menu_class' => 'navv', 'echo' => false, 'link_before' => '<span><span>', 'link_after' => '</span>'.xoxo_fn_getSVG_theme('star').'<span class="suffix">//</span></span>') );
				$html .= '<div class="container"><div class="nav_wrap">'.$menu.$arrow.'</div></div>';
			}
		}else{
			$html .= '<p>'.esc_html__('Select a menu to display this shortcode', 'xoxo-core') .'</p>';
		}
		
		$html .= '</div>';
		$html .= Frel_Helper::frel_close_wrap();
		
		echo $html;
		
	}

}
