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
class Frel_Buttons extends Widget_Base {

	public function get_name() {
		return 'frel-buttons';
	}

	public function get_title() {
		return __( 'Buttons', 'xoxo-core' );
	}

	public function get_icon() {
		return 'eicon-dual-button frenifyicon-elementor';
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
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'btn_text',
			[
				'label' 		=> __( 'Button Text', 'xoxo-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default'	 	=> __( 'Button', 'xoxo-core' ),
				'placeholder' 	=> __( 'Type your button text here', 'xoxo-core' ),
			]
		);
		
		$repeater->add_control(
			'btn_url',
			[
				'label' 		=> __( 'Button URL', 'xoxo-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default'	 	=> '#',
				'placeholder' 	=> __( 'Type your button URL here', 'xoxo-core' ),
			]
		);
		$repeater->add_control(
			'icon_type',
			[
				'label' 		=> __( 'Icon Type', 'xoxo-core' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'none',
				'label_block'	=> true,
				'options' => [
					'frenify_icons' 				=> __( 'Frenify Icons', 'xoxo-core' ),
					'elementor_icons' 				=> __( 'Elementor Icons', 'xoxo-core' ),
					'custom_icon' 					=> __( 'Custom Icon (media)', 'xoxo-core' ),
					'none' 							=> __( 'None', 'xoxo-core' ),
				],
			]
		);
		$repeater->add_control(
			'frenify_icons',
			[
				'label' 		=> __( 'Frenify Icons', 'xoxo-core' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'birthday-1',
				'label_block'	=> true,
				
				'options' 		=> Frel_Helper::frenify_icons(),
			]
		);
		$repeater->add_control(
			'elementor_icons',
			[
				'label' => __( 'Elementor Icons', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'custom_icon',
			[
				'label' => esc_html__( 'Upload Icon', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'button_list',
			[
				'label' 		=> __( 'List', 'xoxo-core' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'btn_text' 				=> __( 'Soundcloud', 'xoxo-core' ),
						'btn_url' 				=> 'https://soundcloud.com/',
						'icon_type' 			=> 'frenify_icons',
						'frenify_icons' 		=> 'mp3-soundcloud',
					],
					[
						'btn_text' 				=> __( 'Spotify', 'xoxo-core' ),
						'btn_url' 				=> 'https://open.spotify.com/',
						'icon_type' 			=> 'frenify_icons',
						'frenify_icons' 		=> 'mp3-spotify',
					],
					[
						'btn_text' 				=> __( 'Google Podcasts', 'xoxo-core' ),
						'btn_url' 				=> 'https://podcasts.google.com/',
						'icon_type' 			=> 'frenify_icons',
						'frenify_icons' 		=> 'mp3-google-podcast',
					],
					[
						'btn_text' 				=> __( 'Apple Podcasts', 'xoxo-core' ),
						'btn_url' 				=> 'https://www.apple.com/apple-podcasts/',
						'icon_type' 			=> 'frenify_icons',
						'frenify_icons' 		=> 'mp3-apple-podcast',
					],
					[
						'btn_text' 				=> __( 'Mixcloud', 'xoxo-core' ),
						'btn_url' 				=> 'https://www.mixcloud.com/',
						'icon_type' 			=> 'frenify_icons',
						'frenify_icons' 		=> 'mp3-mixcloud',
					],
				],
				'title_field' => '{{{ btn_text }}}',
			]
		);
		
		$this->add_control(
			'alignment',
			[
				'label' => __( 'Text Align', 'xoxo-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'xoxo-core' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'xoxo-core' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'xoxo-core' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'toggle' => false,
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => __( 'Color', 'xoxo-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .xoxo_fn_button' => 'color: {{VALUE}};border-color: {{VALUE}};',
				],
				'default' => '#000',
			]
		);
		
		$this->add_control(
			'bgcolor',
			[
				'label' => __( 'Regular Background Color', 'xoxo-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .xoxo_fn_button:after' => 'background-color: {{VALUE}};',
				],
				'default' => '#fff',
			]
		);
		
		$this->add_control(
			'hbgcolor',
			[
				'label' => __( 'Hover Background Color', 'xoxo-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .xoxo_fn_button' => 'background-color: {{VALUE}};',
				],
				'default' => 'var(--mc1)',
			]
		);
		
		$this->end_controls_section();

	}




	protected function render() {
		$settings 		= $this->get_settings();
		$list 			= $settings['button_list'];
		$alignment 		= $settings['alignment'];
		
		$output = '';
		if ( $list ) {
			foreach ( $list as $item ) {
				$icon_type = $item['icon_type'];
				$has_icon = $icon = '';
				if($icon_type == 'frenify_icons'){
					$has_icon = 'has_icon';
					$icon .= '<span class="icon">'.xoxo_fn_getSVG_core($item['frenify_icons']).'</span>';
				}else if($icon_type == 'elementor_icons'){
					$has_icon = 'has_icon';
					$icon .= '<span class="icon">';
					ob_start();
					\Elementor\Icons_Manager::render_icon( $item['elementor_icons'], [ 'aria-hidden' => 'true' ] );
					$out1 = ob_get_contents();
					ob_end_clean();
					$icon .= $out1;
					$icon .= '</span>';
				}else if($icon_type == 'custom_icon'){
					$has_icon = 'has_icon';
					$icon .= '<span class="icon custom_icon">';
					$icon .= '<img src="'.$item['custom_icon']['url'].'" alt="" />';
					$icon .= '</span>';
				}
				$output .= '<a class="xoxo_fn_button '.$has_icon.'" target="_blank" href="'.$item['btn_url'].'"><span class="text">'.$item['btn_text'].'</span>'.$icon.'</a>';
			}
		}

		$html  = Frel_Helper::frel_open_wrap();
			$html .= '<div class="fn_cs_buttons" data-align="'.$alignment.'">'.$output.'</div>';
		$html .= Frel_Helper::frel_close_wrap();
		
		
		echo $html;
		
	}

}
