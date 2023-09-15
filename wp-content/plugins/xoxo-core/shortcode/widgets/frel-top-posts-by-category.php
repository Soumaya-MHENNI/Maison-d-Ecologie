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
class Frel_Top_Posts_By_Category extends Widget_Base {

	public function get_name() {
		return 'frel-top-posts-by-category';
	}

	public function get_title() {
		return __( 'Top Posts by Category', 'xoxo-core' );
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
				'default' => esc_html__( 'Top Posts', 'xoxo-core' ),
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
			'post_number',
			[
				'label' => __( 'Post Number', 'xoxo-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 999,
						'step' => 1,
					]
				],
			]
		);
		
		$this->add_control(
            'cat_list',
            [
                'label' => esc_html__( 'Category List', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'all' 			=> esc_html__( 'Parent Categories', 'xoxo-core' ),
                    'specific' 		=> esc_html__( 'Specific Categories', 'xoxo-core' ),
				],
                'default' => 'all',
            ]
        );
		
		$this->add_control(
			'cat_number',
			[
				'label' => __( 'Categories Count', 'xoxo-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 7,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 9999,
						'step' => 1,
					]
				],
				'condition' => [
					'cat_list' => 'all',
				]
			]
		);
		
		$this->add_control(
			'inc_cats',
			[
			 	'label'	 		=> __( 'Include Categories', 'xoxo-core' ),
			 	'description'	=> __( 'Select category(s) to include', 'xoxo-core' ),
			 	'type' 			=> \Elementor\Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllParentCategories('category'),
				'condition' => [
					'cat_list' => 'specific',
				]
			]
		);
		
		
		$this->end_controls_section();
		
		
	}


	protected function render() {
		$settings 		= $this->get_settings();
		$cat_list		= $settings['cat_list'];
		$post_number 	= $settings['post_number']['size'];
		$cat_number 	= $settings['cat_number']['size'];
		
		$html = Frel_Helper::frel_open_wrap();
		
		$categoryList = '<div class="cat_list"><ul>';
		if($cat_list == 'all'){
			$categories = Frel_Helper::getAllParentCategories('category',$cat_number);
			if(!empty($categories)){
				$i = 0;
				foreach($categories as $slug => $catName){
					$i++;
					$selected = '';
					if($i == 1){
						$activeCategory = array($slug,$catName);
						$selected = 'selected';
					}
					$categoryList .= '<li><a href="#" data-count="'.$post_number.'" data-layout="top_post" data-id="'.$slug.'" class="'.$selected.'" data-link="'.get_term_link( $slug, 'category' ).'"><span><span class="text">'.$catName.'</span><span class="suffix">//</span></span></a></li>';
				}
			}
		}else{
			$cf_include = $settings['inc_cats'];
			if ( ! empty ( $cf_include ) ) {
				$i = 0;
				foreach($cf_include as $slug){
					$i++;
					$catName = get_term_by( 'slug', $slug, 'category' )->name;
					$selected = '';
					if($i == 1){
						$activeCategory = array($slug,$catName);
						$selected = 'selected';
					}
					$categoryList .= '<li><a href="#" data-count="'.$post_number.'" data-layout="top_post" data-id="'.$slug.'" class="'.$selected.'" data-link="'.get_term_link( $slug, 'category' ).'"><span><span class="text">'.$catName.'</span><span class="suffix">//</span></span></a></li>';
				}
			}
		}
		$categoryList .= '</ul></div>';
		
		if(isset($activeCategory)){
			$slug = $activeCategory[0];
			$postList = xoxo_fn_cs_posts_top($slug,$post_number);
			


			$html .= '<div class="fn_cs_posts_top fn_cs_posts__ajax">';

				$html .= '<div class="fn__title_holder">';
					$html .= '<div class="left_title"><h3>'.$settings['title'].'</h3></div>';
					$html .= '<div class="lines"><span class="raleway"><span></span><span></span><span></span><span></span><span></span></span></div>';
					if(1){
						$html .= '<div class="right_title">';
							$html .= '<div class="see_all"><a href="'.get_term_link( $activeCategory[0], 'category' ).'">'.$settings['see_all_text'].'</a></div>';
							$html .= '<div class="cat_list_holder"><a class="active" href="#"><span class="text">'.$activeCategory[1].'</span><span class="icon"><span></span></span><span class="preloader"></span></a>'.$categoryList.'</div>';
						$html .= '</div>';
					}
				$html .= '</div>';

				$html .= '<div class="posts">'.$postList.'</div>';
			$html .= '</div>';
		}

			
		
		
		$html .= Frel_Helper::frel_close_wrap();
		echo $html;
	}

}
