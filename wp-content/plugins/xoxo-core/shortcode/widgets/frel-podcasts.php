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
class Frel_Podcasts extends Widget_Base {

	public function get_name() {
		return 'frel-podcasts';
	}

	public function get_title() {
		return __( 'Podcasts', 'xoxo-core' );
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
		
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Latest Podcasts', 'xoxo-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'view_text',
			[
				'label' => esc_html__( 'Read More Text', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View All Episodes', 'xoxo-core' ),
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
		
		$this->add_control(
            'post_offset',
            [
                'label' 	=> esc_html__( 'Post Offset', 'xoxo-core' ),
                'type' 		=> Controls_Manager::NUMBER,
                'default' 	=> 0,
				'min'		=> 0,
            ]
        );
		
		$this->add_control(
			'bpo_posts',
			[
				'label' => esc_html__( 'Post Parameters', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'bpo_posts__switcher',
			[
				'label' => esc_html__( 'Apply Filter', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'xoxo-core' ),
				'label_off' => esc_html__( 'No', 'xoxo-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$this->add_control(
			'post_include',
			[
				 'label'	 	=> __( 'Include Posts', 'xoxo-core' ),
				 'type' 		=> Controls_Manager::SELECT2,
				 'multiple'	 	=> true,
				 'label_block'	=> true,
				 'options' 		=> Frel_Helper::getAllPodcasts(),
				 'condition' => [
					'bpo_posts__switcher' => 'yes',
				]
			]
		);
		
		
		$this->add_control(
			'post_exclude',
			[
				 'label'	 	=> __( 'Exclude Posts', 'xoxo-core' ),
				 'type' 		=> Controls_Manager::SELECT2,
				 'multiple'	 	=> true,
				 'label_block'	=> true,
				 'options' 		=> Frel_Helper::getAllPodcasts(),
				 'condition' => [
					'bpo_posts__switcher' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'bpo_categories',
			[
				'label' => esc_html__( 'Category Parameters', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'bpo_categories__switcher',
			[
				'label' => esc_html__( 'Apply Filter', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'xoxo-core' ),
				'label_off' => esc_html__( 'No', 'xoxo-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		
		$this->add_control(
			'post_in_categories',
			[
			 	'label'	 		=> __( 'Include Categories', 'xoxo-core' ),
			 	'description'	=> __( 'Select category(s) to include', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllCategories('podcast_category'),
				'condition' => [
					'bpo_categories__switcher' => 'yes',
				]
			]
		);
		
		
		$this->add_control(
			'post_ex_categories',
			[
			 	'label'	 		=> __( 'Exclude Categories', 'xoxo-core' ),
			 	'description'	=> __( 'Select category(s) to exclude', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllCategories('podcast_category'),
				'condition' => [
					'bpo_categories__switcher' => 'yes',
				]
			]
		);
		
		
		$this->add_control(
			'bpo_order',
			[
				'label' => esc_html__( 'Order Parameters', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'bpo_order__switcher',
			[
				'label' => esc_html__( 'Apply Filter', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'xoxo-core' ),
				'label_off' => esc_html__( 'No', 'xoxo-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$this->add_control(
            'post_order',
            [
                'label' => esc_html__( 'Post Order', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'xoxo-core' ),
                    'desc' 	=> esc_html__( 'Descending', 'xoxo-core' )
                ],
                'default' => 'desc',
				'condition' => [
					'bpo_order__switcher' => 'yes',
				]

            ]
        );
		
		$this->add_control(
            'post_orderby',
            [
                'label' => esc_html__( 'Post Orderby', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'select' 			=> esc_html__( 'Select Option', 'xoxo-core' ),
                    'ID' 				=> esc_html__( 'Order by post id', 'xoxo-core' ),
                    'author' 			=> esc_html__( 'Order by author', 'xoxo-core' ),
                    'title' 			=> esc_html__( 'Order by title', 'xoxo-core' ),
                    'name' 				=> esc_html__( 'Order by post name', 'xoxo-core' ),
                    'date' 				=> esc_html__( 'Order by date', 'xoxo-core' ),
                    'modified' 			=> esc_html__( 'Order by last modified date', 'xoxo-core' ),
                    'rand' 				=> esc_html__( 'Random order', 'xoxo-core' ),
                    'comment_count' 	=> esc_html__( 'Order by number of comments', 'xoxo-core' ),
                    'menu_order' 		=> esc_html__( 'Order by Page Order', 'xoxo-core' ),
				],
                'default' => 'select',
				'condition' => [
					'bpo_order__switcher' => 'yes',
				]

            ]
        );
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_episodes',
			[
				'label' => __( 'Episodes', 'xoxo-core' ),
			]
		);
		
		
		$this->add_control(
			'episode_number',
			[
				'label' => __( 'Episode Count', 'xoxo-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 3,
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
		
		
		$this->add_control(
			'episode_order__switcher',
			[
				'label' => esc_html__( 'Apply Filter', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'xoxo-core' ),
				'label_off' => esc_html__( 'No', 'xoxo-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$this->add_control(
            'episode_order',
            [
                'label' => esc_html__( 'Post Order', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'xoxo-core' ),
                    'desc' 	=> esc_html__( 'Descending', 'xoxo-core' )
                ],
                'default' => 'desc',
				'condition' => [
					'episode_order__switcher' => 'yes',
				]

            ]
        );
		
		$this->add_control(
            'episode_orderby',
            [
                'label' => esc_html__( 'Post Orderby', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'select' 			=> esc_html__( 'Select Option', 'xoxo-core' ),
                    'ID' 				=> esc_html__( 'Order by post id', 'xoxo-core' ),
                    'author' 			=> esc_html__( 'Order by author', 'xoxo-core' ),
                    'title' 			=> esc_html__( 'Order by title', 'xoxo-core' ),
                    'name' 				=> esc_html__( 'Order by post name', 'xoxo-core' ),
                    'date' 				=> esc_html__( 'Order by date', 'xoxo-core' ),
                    'modified' 			=> esc_html__( 'Order by last modified date', 'xoxo-core' ),
                    'rand' 				=> esc_html__( 'Random order', 'xoxo-core' ),
                    'comment_count' 	=> esc_html__( 'Order by number of comments', 'xoxo-core' ),
                    'menu_order' 		=> esc_html__( 'Order by Page Order', 'xoxo-core' ),
				],
                'default' => 'select',
				'condition' => [
					'episode_order__switcher' => 'yes',
				]

            ]
        );
		
		
		$this->end_controls_section();
		
		
	}


	protected function render() {
		$settings 		= $this->get_settings();
		$post_number 	= $settings['post_number']['size'];
		$layout 		= $settings['layout'];
		
		$html = Frel_Helper::frel_open_wrap();
		$query_args = array(
			'post_type' 			=> "frenify-podcast",
			'post_status' 			=> "publish",
			'posts_per_page' 		=> $post_number,
			'ignore_sticky_posts' 	=> true,
		);
		
		// Post Parameters
		$post_filter	= $settings['bpo_posts__switcher'];
		if($post_filter == 'yes'){
			$query_args['post__in'] = $settings['post_include'];
			$query_args['post__not_in'] = $settings['post_exclude'];
		}
		
		// Category Paramters
		$category_filter = $settings['bpo_categories__switcher'];
		if($category_filter == 'yes'){
			$cf_include = $settings['post_in_categories'];
			$cf_exclude = $settings['post_ex_categories'];

			if ( ! empty ( $cf_exclude ) ) {

				$query_args['tax_query'] = array(
					array(
						'taxonomy'	=> 'podcast_category', 
						'field'	 	=> 'slug',
						'terms'		=> $cf_exclude,
						'operator'	=> 'NOT IN'
					)
				);

				if ( ! empty ( $cf_include ) ) {
					$query_args['tax_query']['relation'] = 'AND';
					$query_args['tax_query'][] = array(
						'taxonomy'	=> 'podcast_category',
						'field'		=> 'slug',
						'terms'		=> $cf_include,
						'operator'	=> 'IN'
					);
				}		

			} else {
				if ( ! empty ( $cf_include ) ) {
					$query_args['tax_query'] = array(
						array(
							'taxonomy' 	=> 'podcast_category',
							'field' 	=> 'slug',
							'terms' 	=> $cf_include,
							'operator'	=> 'IN'
						)
					);
				}
			}
		}
		
		
		// Order Parameters
		$order_filter = $settings['bpo_order__switcher'];
		if($order_filter == 'yes'){
			$of_order = $settings['post_order'];
			$of_orderby = $settings['post_orderby'];
			if($of_orderby === 'select'){$of_orderby = '';}
			$query_args['order'] = $of_order;
			$query_args['orderby'] = $of_orderby;
		}
		
		// !! Warning !! please use it at the end of wordpress query
		// Offset loop
		$post_offset 	= $settings['post_offset'];
		if($post_offset > 0){
			$query_args['posts_per_page'] = (int)$post_offset;
			$offset_query = new \WP_Query($query_args);
			$post__not_in = array();

			if ($offset_query->have_posts()) : while ($offset_query->have_posts()) : $offset_query->the_post();
				$post__not_in[] = get_the_ID();
			endwhile; endif; wp_reset_postdata();
			if(isset($query_args['post__not_in'])){
				$query_args['post__not_in'] = array_merge($query_args['post__not_in'], $post__not_in); 
			}else{
				$query_args['post__not_in'] = $post__not_in;
			}
		}
		
		$loop = new \WP_Query($query_args);
		
		$playIcon = xoxo_fn_getSVG_theme('play');
		$arrowIcon = xoxo_fn_getSVG_theme('arrow');
		$xxxxx = xoxo_fn_getSVG_theme('xxxxx');
		$microphoneIcon = '<span class="icon">'.xoxo_fn_getSVG_theme('microphone').'</span>';
		$read_more_text = $settings['view_text'];
		$list 	= '';
		if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
			$podcastID 				= get_the_ID();
			$podcastTitle			= get_the_title();
			$podcastPermalink 		= get_the_permalink();
			$podcastMeta			= xoxo_fn_podcast_metas($podcastID,'',false);
			$podcastThumbnailURL 	= get_the_post_thumbnail_url($podcastID,'full');
			$podcastReadMore		= '<div class="read_more"><a href="'.$podcastPermalink.'"><span class="text">'.$read_more_text.'</span><span class="icon"><span class="arrow">'.$arrowIcon.'</span><span class="triple"></span></span></a></div>';
			$podcastCategory 		= xoxo_fn_get_categories($podcastID, 'single', 'frenify-podcast', 1, '');
		
		
			// get episodes
			$args = array(
				'post_type' 		=> 'frenify-episode',  
				'post_status' 		=> 'publish',  
				'posts_per_page' 	=> $settings['episode_number']['size'],
				'meta_key'			=> 'xoxo_fn_episode_podcast',
				'meta_value'		=> $podcastID,
			);
			// Order Parameters
			$episode_order_filter = $settings['episode_order__switcher'];
			if($episode_order_filter == 'yes'){
				$episode_order = $settings['episode_order'];
				$episode_orderby = $settings['episode_orderby'];
				if($episode_orderby === 'select'){$episode_orderby = '';}
				$args['order'] = $episode_order;
				$args['orderby'] = $episode_orderby;
			}
			$loopEpisode = new \WP_Query($args);
			$episodes = '';
			if ($loopEpisode->have_posts()) : while ($loopEpisode->have_posts()) : $loopEpisode->the_post();
			$episodeID = get_the_ID();
			$audioURL = '';
			if(function_exists('rwmb_meta')){
				if(isset(get_post_meta($episodeID)['xoxo_fn_episode_local_audio_url'])){
					$audioURL = get_post_meta($episodeID, 'xoxo_fn_episode_local_audio_url', true);
				}
			}
			if($audioURL != ''){
				$episodes .= '<div class="fn__mp3_item item"><a href="#" class="xoxo_fn_audio_button" data-mp3="'.$audioURL.'"><span class="iconn">'.$playIcon.'</span></a><div class="title_holder"><h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>'.xoxo_fn_episode_metas($episodeID,false).'</div></div>';
			}
			
			endwhile; endif; wp_reset_query();
		
			if($episodes != ''){
				$episodes = '<div class="episode_list">'.$episodes.'</div>';
			}
			
			$podcastImage = '';
			if($podcastThumbnailURL != ''){
				$podcastImage = '<div class="blog__image">'.$podcastCategory.'<a class="full_link" href="'.$podcastPermalink.'"></a><div class="abs_img" data-bg-img="'.$podcastThumbnailURL.'"></div>'.$xxxxx.'</div>';
			}
		
			$titleHolder = '<div class="p_title_holder"><h3><a href="'.$podcastPermalink.'">'.$podcastTitle.'</a></h3>'.$podcastMeta.$microphoneIcon.'</div>';
			
			if($layout == 'carousel'){
				$list .= '<div class="swiper-slide">';
			}
		
			$list .= '<div class="podcast_listed__item">'.$titleHolder.$podcastImage.'<div class="item_bottom">'.$episodes.$podcastReadMore.'</div></div>';
			
			if($layout == 'carousel'){
				$list .= '</div>';
			}
		
				
		endwhile; endif; wp_reset_query();
		
		$html .= '<div class="fn_cs_podcast_listed layout_'.$layout.'">';

			$html .= '<div class="fn__title_holder">';
				$html .= '<div class="left_title"><h3>'.$settings['title'].'</h3></div>';
				$html .= '<div class="lines"><span class="raleway"><span></span><span></span><span></span><span></span><span></span></span></div>';
				$html .= '<div class="right_title">';
					$html .= '<div class="see_all"><a href="'.$settings['see_all_url'].'">'.$settings['see_all_text'].'</a></div>';
					if($layout == 'carousel'){
						$arrow = xoxo_fn_getSVG_theme('arrow2');
						$html .= '<div class="slider__buttons"><a href="#" class="slider_nav prev">
									<span class="circle"></span>
									<span class="icon">'.$arrow.'</span>
									<span class="circle"></span>
								</a>
								<a href="#" class="slider_nav next">
									<span class="circle"></span>
									<span class="icon">'.$arrow.'</span>
									<span class="circle"></span>
								</a></div>';
					}
				$html .= '</div>';
			$html .= '</div>';

			$html .= '<div class="posts">';
				if($layout == 'carousel'){
					$html .= '<div class="swiper-container"><div class="swiper-wrapper">';
				}

				$html .= $list;

				if($layout == 'carousel'){
					$html .= '</div></div>';
				}
			$html .= '</div>';
		
		$html .= '</div>';

			
		
		
		$html .= Frel_Helper::frel_close_wrap();
		echo $html;
	}

}
