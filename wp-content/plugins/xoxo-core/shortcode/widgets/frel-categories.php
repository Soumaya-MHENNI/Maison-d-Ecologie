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
class Frel_Categories extends Widget_Base {

	public function get_name() {
		return 'frel-categories';
	}

	public function get_title() {
		return __( 'Categories', 'xoxo-core' );
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
			'section1',
			[
				'label' => __( 'Content', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'layout',
			[
				'label' 		=> __( 'Layout', 'xoxo-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'alpha',
				'options' 		=> [
					'alpha'  	=> __( 'Alpha', 'xoxo-core' ),
				],
			]
		);
		
		$this->add_control(
			'items_type',
			[
				'label' => __( 'Items Type', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'category',
				'options' => [
					'category'  => __( 'Category', 'xoxo-core' ),
					'tag'  		=> __( 'Tag', 'xoxo-core' ),
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'xoxo-core' ),
			]
		);
		
		$this->add_control(
			'items_number',
			[
				'label' => __( 'Items Number', 'xoxo-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 9999,
						'step' => 1,
					]
				],
			]
		);
		
		
		
		$this->add_control(
			'inc_cats',
			[
			 	'label'	 		=> __( 'Include Categories', 'xoxo-core' ),
			 	'description'	=> __( 'Select category(s) to include', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllCategories('category','id'),
				'condition' => [
					'items_type' => 'category',
				]
			]
		);
		
		
		$this->add_control(
			'exc_cats',
			[
			 	'label'	 		=> __( 'Exclude Categories', 'xoxo-core' ),
			 	'description'	=> __( 'Select category(s) to exclude', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllCategories('category','id'),
				'condition' => [
					'items_type' => 'category',
				]
			]
		);
		
		$this->add_control(
			'inc_tags',
			[
			 	'label'	 		=> __( 'Include Tags', 'xoxo-core' ),
			 	'description'	=> __( 'Select tag(s) to include', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllBlogTags(),
				'condition' => [
					'items_type' => 'tag',
				]
			]
		);
		
		$this->add_control(
			'exc_tags',
			[
			 	'label'	 		=> __( 'Exclude Tags', 'xoxo-core' ),
			 	'description'	=> __( 'Select tag(s) to exclude', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllBlogTags(),
				'condition' => [
					'items_type' => 'tag',
				]
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section2',
			[
				'label' => __( 'Coloring', 'xoxo-core' ),
			]
		);
		
		
		
		$this->end_controls_section();
		
		
	}


	protected function render() {

		$settings 			= $this->get_settings();
		$layout				= $settings['layout'];
		$items_type			= $settings['items_type'];
		$items_number		= $settings['items_number']['size'];
		
		if($items_type == 'category'){
			
			$args = array();
			
			$inc_cats = $settings['inc_cats'];
			$exc_cats = $settings['exc_cats'];
			if(!empty($inc_cats)){
				$args['include'] = $inc_cats;
			}
			if(!empty($exc_cats)){
				$args['exclude'] = $exc_cats;
			}
			$args['number'] = $items_number;
			
			$categories = get_categories($args);
			
		}
		/***********************************************************************************/
		/* RENDER STARTS */
		$html		 	= Frel_Helper::frel_open_wrap();
		
		if($layout == 'alpha'){
			$list = '';
			$article_text_p = esc_html__('Articles','xoxo-core');
			$article_text_s = esc_html__('Article','xoxo-core');
			if(!empty($categories)){
				foreach($categories as $term){
					$name        	= $term->name;
					$term_count		= $term->count;
					$cat_link    	= get_term_link( $term->slug, 'category' );
					$cat_id 		= $term->term_id;
					$image_id 		= get_term_meta ( $cat_id, 'category-image-id', true );
					$image 			= wp_get_attachment_image_url ( $image_id, 'thumbnail' );
					if($image == ''){
						$image = '<span class="letter_img">'.mb_substr($name, 0, 1).'</span>';
					}else{
						$image = '<span class="image" data-bg-img="'.$image.'"></span>';
					}
					if($term_count > 1){
						$article_text = $article_text_p;
					}else{
						$article_text = $article_text_s;
					}
					$image = '<span class="img">'.$image.'</span>';
					$list .= '<div class="swiper-slide"><div class="category__item">'.$image.'<a class="full_link" href="'.$cat_link.'"></a><span class="cat_title"><span>'.$name.'</span></span><span class="cat_count"><span class="text">'.$article_text.'</span><span class="count">'.$term_count.'</span></div></div>';
				}
			}
			
			if($list != ''){
				$html .= '<div class="fn_cs_category_alpha">';
				$html .= '<div class="swiper-container"><div class="swiper-wrapper">';
				$html .= $list;
				$html .= '</div></div>';
				$html .= '<div class="vert_text"><span class="top_triangle"></span><span class="bottom_triangle"></span><span class="text">Categories</span><div>';
				$html .= '</div>';
			}
		}
		
		
		
		
		/***********************************************************************************/
		/* RENDER ENDS */
		$html .= Frel_Helper::frel_close_wrap();
		echo $html;
	}

}
