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
class Frel_Latest_Episodes extends Widget_Base {

	public function get_name() {
		return 'frel-latest-episodes';
	}

	public function get_title() {
		return __( 'Latest Episodes', 'xoxo-core' );
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
				'default' => esc_html__( 'Latest Episodes', 'xoxo-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'see_all_text',
			[
				'label' => esc_html__( 'See All Text', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'See All', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'see_all_url',
			[
				'label' => esc_html__( 'See All URL', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'view_text',
			[
				'label' => esc_html__( 'View Episode Text', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View Episode', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'post_number',
			[
				'label' => __( 'Post Number', 'xoxo-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 9999,
						'step' => 1,
					]
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
	}


	protected function render() {
		$settings 		= $this->get_settings();
		$post_number 	= $settings['post_number']['size'];
		
		$html = Frel_Helper::frel_open_wrap();
		$query_args = array(
			'post_type' 			=> "frenify-episode",
			'post_status' 			=> "publish",
			'posts_per_page' 		=> $post_number,
			'ignore_sticky_posts' 	=> true,
		);
		$loop = new \WP_Query($query_args);
		
		$playIcon = xoxo_fn_getSVG_theme('play');
		$arrowIcon = xoxo_fn_getSVG_theme('arrow');
		$read_more_text = $settings['view_text'];
		$list 	= '';
		if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
			$audioURL 	 	= '';
			$episodeID 		= get_the_ID();
			if(function_exists('rwmb_meta')){
				if(isset(get_post_meta($episodeID)['xoxo_fn_episode_local_audio_url'])){
					$audioURL = get_post_meta($episodeID, 'xoxo_fn_episode_local_audio_url', true);
				}
			}
			if($audioURL != ''){
				
				$podcastID = '';
				if(function_exists('rwmb_meta')){
					if(isset(get_post_meta($episodeID)['xoxo_fn_episode_podcast'])){
						$podcastID = get_post_meta($episodeID, 'xoxo_fn_episode_podcast', true);
					}
				}
				
				$podcastInfo = '';
				$img_2 = '';
				if($podcastID != ''){
					$podcastThumbnailURL = get_the_post_thumbnail_url($podcastID,'thumbnail');
					if($podcastThumbnailURL == ''){
						$img_2 = '<div class="img_holder hidden_img">'.mb_substr(get_the_title($podcastID),0,1).'</div>';
					}else{
						$img_2 = '<div class="img_holder hidden_img" data-bg-img="'.$podcastThumbnailURL.'"></div>';
					}
					$podcastTitleHolder = '<div class="title_holder"><h3><a href="'.get_the_permalink($podcastID).'">'.get_the_title($podcastID).'</a></h3>'.xoxo_fn_podcast_metas($podcastID,'',false).'</div>';
					$podcastInfo = '<div class="podcast_hover">'.$img_2.$podcastTitleHolder.'</div>';
				}
				
				
				$episodeThumbnailURL = get_the_post_thumbnail_url($episodeID,'thumbnail');
				if($episodeThumbnailURL == ''){
					$img = '<div class="img_holder hidden_on_mobile">'.mb_substr(get_the_title(),0,1).'</div>';
				}else{
					$img = '<div class="img_holder hidden_on_mobile" data-bg-img="'.$episodeThumbnailURL.'"></div>';
				}

				$list .= '<li><div class="latest_episode__item fn__mp3_item"><div class="item_left">'.$img.$img_2.$podcastInfo.'</div><div class="item_right"><div class="ei_in"><a href="#" class="xoxo_fn_audio_button" data-mp3="'.$audioURL.'"><span class="iconn">'.$playIcon.'</span></a><div class="title_holder"><h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>'.xoxo_fn_episode_metas($episodeID,false).'</div><div class="read_more"><a href="'.get_the_permalink().'"><span class="text">'.$read_more_text.'</span><span class="icon"><span class="arrow">'.$arrowIcon.'</span><span class="triple"></span></span></a></div></div></div></div></li>';
			}
				
		endwhile; endif; wp_reset_postdata();
		
		$html .= '<div class="fn_cs_latest_episodes">';

			$html .= '<div class="fn__title_holder">';
				$html .= '<div class="left_title"><h3>'.$settings['title'].'</h3></div>';
				$html .= '<div class="lines"><span class="raleway"><span></span><span></span><span></span><span></span><span></span></span></div>';
				$html .= '<div class="right_title">';
					$html .= '<div class="see_all"><a href="'.$settings['see_all_url'].'">'.$settings['see_all_text'].'</a></div>';
				$html .= '</div>';
			$html .= '</div>';

			$html .= '<div class="posts"><ul>'.$list.'</ul></div>';
		$html .= '</div>';

			
		
		
		$html .= Frel_Helper::frel_close_wrap();
		echo $html;
	}

}
