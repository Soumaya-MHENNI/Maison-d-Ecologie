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
class Frel_Posts extends Widget_Base {

	public function get_name() {
		return 'frel-posts';
	}

	public function get_title() {
		return __( 'Posts', 'xoxo-core' );
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
            'posts',
            'post',
            'custom posts',
            'custom post',
            'blog posts',
            'blog post',
            'portfolio posts',
            'portfolio post',
            'portfolio single',
            'projects',
            'project',
            'project posts',
            'project post',
            'project single',
            'xoxo-core'
        ];
    }

	protected function register_controls() {
		$timeOptions = array();
		$timeIntervalMinute = 10;
		$timeAllMinutes = 1440;
		$timeIntervalCount = $timeAllMinutes / $timeIntervalMinute;
		for($i = 0; $i < $timeIntervalCount; $i++){
			$minutes = $i * $timeIntervalMinute;
			$ii = $minutes % 60;
			$hh = intdiv($minutes , 60);
			if($hh < 10){$hh = '0'.$hh;}
			if($ii < 10){$ii = '0'.$ii;}
			$timeOptions[$minutes] = $hh .':'. $ii;
		}
		$timeOptions[$timeAllMinutes-1] = '23:59';
		
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
				'default' 		=> 'full_slider',
				'options' 		=> [
					'full_slider'  		=> __( 'Full Slider', 'xoxo-core' ),
					'ajax_grid'  		=> __( 'Ajax Grid', 'xoxo-core' ),
					'listed'  			=> __( 'Listed Posts', 'xoxo-core' ),
					'fixed_col'			=> __( 'Fixed Column', 'xoxo-core' ),
					'carousel'			=> __( 'Carousel', 'xoxo-core' ),
					'parallax_classic'	=> __( 'Parallax Classic', 'xoxo-core' ),
					'parallax_zigzag'	=> __( 'Parallax Zigzag', 'xoxo-core' ),
					'ticker'			=> __( 'Tickers', 'xoxo-core' ),
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
			'parallax_classic_ppp',
			[
				'label' 		=> __( 'Posts Per Page', 'xoxo-core' ),
				'description' 	=> __( 'Default value: 6', 'xoxo-core' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 1,
						'max' => 9999,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'condition' => [
					'layout' => 'parallax_classic',
				]
			]
		);
		$this->add_control(
			'fixed_col_ppp',
			[
				'label' 		=> __( 'Posts Per Page', 'xoxo-core' ),
				'description' 	=> __( 'Default value: 12', 'xoxo-core' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 1,
						'max' => 9999,
						'step' => 6,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'condition' => [
					'layout' => 'fixed_col',
				]
			]
		);
		
		$this->add_control(
			'ajax_grid_ppp',
			[
				'label' 		=> __( 'Posts Per Page', 'xoxo-core' ),
				'description' 	=> __( 'Default value: 10', 'xoxo-core' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 1,
						'max' => 9999,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'condition' => [
					'layout' => 'ajax_grid',
				]
			]
		);
		
		$this->add_control(
			'blog_post_number',
			[
				'label' => __( 'Post Number', 'xoxo-core' ),
				'description' 	=> __( '-1 to get all posts', 'xoxo-core' ),
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
            'blog_post_offset',
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
			'blog_post_include',
			[
				 'label'	 	=> __( 'Include Posts', 'xoxo-core' ),
				 'type' 		=> Controls_Manager::SELECT2,
				 'multiple'	 	=> true,
				 'label_block'	=> true,
				 'options' 		=> Frel_Helper::getAllBlogPosts(),
				 'condition' => [
					'bpo_posts__switcher' => 'yes',
				]
			]
		);
		
		
		$this->add_control(
			'blog_post_exclude',
			[
				 'label'	 	=> __( 'Exclude Posts', 'xoxo-core' ),
				 'type' 		=> Controls_Manager::SELECT2,
				 'multiple'	 	=> true,
				 'label_block'	=> true,
				 'options' 		=> Frel_Helper::getAllBlogPosts(),
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
			'blog_post_in_categories',
			[
			 	'label'	 		=> __( 'Include Categories', 'xoxo-core' ),
			 	'description'	=> __( 'Select category(s) to include', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllCategories('category'),
				'condition' => [
					'bpo_categories__switcher' => 'yes',
				]
			]
		);
		
		
		$this->add_control(
			'blog_post_ex_categories',
			[
			 	'label'	 		=> __( 'Exclude Categories', 'xoxo-core' ),
			 	'description'	=> __( 'Select category(s) to exclude', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllCategories('category'),
				'condition' => [
					'bpo_categories__switcher' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'bpo_authors',
			[
				'label' => esc_html__( 'Author Parameters', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'bpo_author__switcher',
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
			'blog_post_in_author',
			[
			 	'label'	 		=> __( 'Include Author', 'xoxo-core' ),
			 	'description'	=> __( 'Select author(s) to include', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllAuthors(),
				'condition' => [
					'bpo_author__switcher' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'blog_post_ex_author',
			[
			 	'label'	 		=> __( 'Exclude Author', 'xoxo-core' ),
			 	'description'	=> __( 'Select author(s) to exclude', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllAuthors(),
				'condition' => [
					'bpo_author__switcher' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'bpo_tags',
			[
				'label' => esc_html__( 'Tag Parameters', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'bpo_tag__switcher',
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
			'blog_post_in_tag',
			[
			 	'label'	 		=> __( 'Include Tags', 'xoxo-core' ),
			 	'description'	=> __( 'Select tag(s) to include', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllBlogTags(),
				'condition' => [
					'bpo_tag__switcher' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'blog_post_ex_tag',
			[
			 	'label'	 		=> __( 'Exclude Tags', 'xoxo-core' ),
			 	'description'	=> __( 'Select tag(s) to exclude', 'xoxo-core' ),
			 	'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
			 	'label_block'	=> true,
				'options' 		=> Frel_Helper::getAllBlogTags(),
				'condition' => [
					'bpo_tag__switcher' => 'yes',
				]
			]
		);
		
		
		$this->add_control(
			'bpo_search',
			[
				'label' => esc_html__( 'Search Parameters', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'bpo_search__switcher',
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
			'blog_post_search',
			[
				'label' => esc_html__( 'Keyword search', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'bpo_search__switcher' => 'yes',
				]
			]
		);
		
		
		
		
		$this->add_control(
			'bpo_comment',
			[
				'label' => esc_html__( 'Comment Parameters', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'bpo_comment__switcher',
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
			'blog_post_comment_count',
			[
				'label' => esc_html__( 'Comment Count', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
				'default' => 0,
				'condition' => [
					'bpo_comment__switcher' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'blog_post_comment_compare',
			[
				'label' => esc_html__( 'Comment Compare', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '>=',
				'options' => [
					'='  => '=',
					'!='  => '!=',
					'>'  => '>',
					'>='  => '>=',
					'<'  => '<',
					'<='  => '<=',
				],
				'condition' => [
					'bpo_comment__switcher' => 'yes',
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
            'blog_post_order',
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
            'blog_post_orderby',
            [
                'label' => esc_html__( 'Post Orderby', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'select' 			=> esc_html__( 'Select Option', 'xoxo-core' ),
                    'ID' 				=> esc_html__( 'Order by post id', 'xoxo-core' ),
                    'popular' 			=> esc_html__( 'Order by page views / popularity', 'xoxo-core' ),
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
			'date_filter_section',
			[
				'label' => __( 'Date/Time Query', 'xoxo-core' ),
			]
		);
		
		
		$this->add_control(
			'bpo_date_query',
			[
				'label' => esc_html__( 'Date Query', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		
		$this->add_control(
			'bpo_date__switcher',
			[
				'label' => esc_html__( 'Apply Filter', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'xoxo-core' ),
				'label_off' => esc_html__( 'No', 'xoxo-core' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
            'bpod_type',
            [
                'label' => esc_html__( 'Filter Type', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' 					=> esc_html__( 'Select', 'xoxo-core' ),
                    'range' 			=> esc_html__( 'Range', 'xoxo-core' ),
                    'period' 			=> esc_html__( 'Period', 'xoxo-core' ),
                    'last' 				=> esc_html__( 'Last', 'xoxo-core' ),
                    'before' 			=> esc_html__( 'Before', 'xoxo-core' ),
                    'after' 			=> esc_html__( 'After', 'xoxo-core' ),
                    'date' 				=> esc_html__( 'Date', 'xoxo-core' ),
                    'year' 				=> esc_html__( 'Year', 'xoxo-core' ),
                    'month' 			=> esc_html__( 'Month', 'xoxo-core' ),
                    'day' 				=> esc_html__( 'Day', 'xoxo-core' ),
                    'week' 				=> esc_html__( 'Week', 'xoxo-core' ),
                    'week_days' 		=> esc_html__( 'Days of the week', 'xoxo-core' ),
                ],
                'default' => '',
            ]
        );
		
		/* Range */
		$repeater->add_control(
            'bpod_range',
            [
                'label' => esc_html__( 'Range', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'today' 		=> esc_html__( 'Today', 'xoxo-core' ),
                    'yesterday' 	=> esc_html__( 'Yesterday', 'xoxo-core' ),
                    'this_week' 	=> esc_html__( 'This Week', 'xoxo-core' ),
                    'last_week' 	=> esc_html__( 'Last Week', 'xoxo-core' ),
                    'this_month' 	=> esc_html__( 'This Month', 'xoxo-core' ),
                    'last_month' 	=> esc_html__( 'Last Month', 'xoxo-core' ),
                    'this_year' 	=> esc_html__( 'This Year', 'xoxo-core' ),
                    'last_year' 	=> esc_html__( 'Last Year', 'xoxo-core' ),
                    'last_7d' 		=> esc_html__( 'Last 7 Days', 'xoxo-core' ),
                    'last_30d' 		=> esc_html__( 'Last 30 Days', 'xoxo-core' ),
                    'last_60d' 		=> esc_html__( 'Last 60 Days', 'xoxo-core' ),
                    'last_90d' 		=> esc_html__( 'Last 90 Days', 'xoxo-core' ),
                    'last_365d' 	=> esc_html__( 'Last 365 Days', 'xoxo-core' ),
                ],
                'default' => 'this_month',
				'label_block'	=> true,
				'condition' => [
					'bpod_type' => 'range',
				]
            ]
        );
		
		/* Period */
		$repeater->add_control(
			'bpod_from',
			[
				'label' => esc_html__( 'From', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false
				],
				'condition' => [
					'bpod_type' => 'period',
				]
			]
		);
		$repeater->add_control(
			'bpod_to',
			[
				'label' => esc_html__( 'To', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false
				],
				'condition' => [
					'bpod_type' => 'period',
				]
			]
		);
		
		/* Last */
		$repeater->add_control(
            'bpod_last_count',
            [
                'label' 	=> esc_html__( 'Count', 'xoxo-core' ),
                'type' 		=> Controls_Manager::NUMBER,
                'default' 	=> 1,
				'min'		=> 1,
				'condition' => [
					'bpod_type' => 'last',
				]
            ]
        );
		
		$repeater->add_control(
            'bpod_last_type',
            [
                'label' => esc_html__( 'Type', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'days' 			=> esc_html__( 'Days', 'xoxo-core' ),
                    'weeks' 		=> esc_html__( 'Weeks', 'xoxo-core' ),
                    'months' 		=> esc_html__( 'Months', 'xoxo-core' ),
                    'years' 		=> esc_html__( 'Years', 'xoxo-core' ),
                ],
                'default' 		=> 'days',
				'label_block'	=> true,
				'condition' => [
					'bpod_type' => 'last',
				]
            ]
        );
		
		/* Before */
		$repeater->add_control(
			'bpod_before',
			[
				'label' => esc_html__( 'Select Date', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false
				],
				'condition' => [
					'bpod_type' => 'before',
				]
			]
		);
		
		/* After */
		$repeater->add_control(
			'bpod_after',
			[
				'label' => esc_html__( 'Select Date', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false
				],
				'condition' => [
					'bpod_type' => 'after',
				]
			]
		);
		
		/* Date */
		$repeater->add_control(
			'bpod_date',
			[
				'label' => esc_html__( 'Select Date', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false
				],
				'condition' => [
					'bpod_type' => 'date',
				]
			]
		);
		
		/* Year */
		$repeater->add_control(
			'bpod_year',
			[
				'label' 	=> esc_html__( 'Year', 'xoxo-core' ),
                'type' 		=> Controls_Manager::NUMBER,
                'default' 	=> date( 'Y' ),
				'min'		=> 0,
				'max'		=> 3000,
				'condition' => [
					'bpod_type' => 'year',
				]
			]
		);
		
		/* Month */
		$repeater->add_control(
			'bpod_month',
			[
				'label'			=> esc_html__( 'Month', 'xoxo-core' ),
                'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
                'options' => [
                    1 		=> esc_html__( 'January', 'xoxo-core' ),
                    2 		=> esc_html__( 'February', 'xoxo-core' ),
                    3 		=> esc_html__( 'March', 'xoxo-core' ),
                    4 		=> esc_html__( 'April', 'xoxo-core' ),
                    5 		=> esc_html__( 'May', 'xoxo-core' ),
                    6 		=> esc_html__( 'June', 'xoxo-core' ),
                    7 		=> esc_html__( 'July', 'xoxo-core' ),
                    8 		=> esc_html__( 'August', 'xoxo-core' ),
                    9 		=> esc_html__( 'September', 'xoxo-core' ),
                    10 		=> esc_html__( 'October', 'xoxo-core' ),
                    11 		=> esc_html__( 'November', 'xoxo-core' ),
                    12 		=> esc_html__( 'December', 'xoxo-core' ),
                ],
				'condition' => [
					'bpod_type' => 'month',
				]
			]
		);
		
		/* Day */
		$repeater->add_control(
			'bpod_day',
			[
				'label' => esc_html__( 'Day', 'xoxo-core' ),
                'type' 		=> Controls_Manager::NUMBER,
                'default' 	=> date( 'd' ),
				'min'		=> 0,
				'max'		=> 31,
				'condition' => [
					'bpod_type' => 'day',
				]
			]
		);
		
		/* Week */
		$repeater->add_control(
			'bpod_week',
			[
				'label' => esc_html__( 'Week', 'xoxo-core' ),
                'type' 		=> Controls_Manager::NUMBER,
                'default' 	=> date( 'w' ),
				'min'		=> 0,
				'max'		=> 53,
				'condition' => [
					'bpod_type' => 'week',
				]
			]
		);
		
		/* Days of the week */
		$repeater->add_control(
			'bpod_week_days',
			[
				'label'	 		=> esc_html__( 'Days of the week', 'xoxo-core' ),
                'type' 			=> Controls_Manager::SELECT2,
			 	'multiple'	 	=> true,
                'options' => [
                    2 		=> esc_html__( 'Monday', 'xoxo-core' ),
                    3 		=> esc_html__( 'Tuesday', 'xoxo-core' ),
                    4 		=> esc_html__( 'Wednesday', 'xoxo-core' ),
                    5 		=> esc_html__( 'Thursday', 'xoxo-core' ),
                    6 		=> esc_html__( 'Friday', 'xoxo-core' ),
                    7 		=> esc_html__( 'Saturday', 'xoxo-core' ),
                    1 		=> esc_html__( 'Sunday', 'xoxo-core' ),
                ],
				'condition' => [
					'bpod_type' => 'week_days',
				]
			]
		);
		
		
		$this->add_control(
			'bpod_list',
			[
				'label' => __( 'Date Conditions', 'xoxo-core' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ bpod_type }}}',
				'condition' => [
					'bpo_date__switcher' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'bpo_time_query',
			[
				'label' => esc_html__( 'Time Query', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'bpo_time__switcher',
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
			'bpot_from',
			[
				'label' => esc_html__( 'From', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => $timeOptions,
				'default' => 480,
				'condition' => [
					'bpo_time__switcher' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'bpot_to',
			[
				'label' => esc_html__( 'To', 'xoxo-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => $timeOptions,
				'default' => 1020,
				'condition' => [
					'bpo_time__switcher' => 'yes',
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
		
		$this->add_control(
			'ajax_grid_filter__more',
			[
				'label' => __( 'Filter', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => 'ajax_grid',
					'ajax_grid_filter' => 'yes',
				]
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'options_section',
			[
				'label' => __( 'Options', 'xoxo-core' ),
			]
		);
		
		
		$this->add_control(
			'ticker_top_text',
			  [
				'label'       	=> __( 'Top Text', 'xoxo-core' ),
				'type'        	=> Controls_Manager::TEXT,
				'default' 		=> __( 'News Ticker', 'xoxo-core' ),
				'label_block'	=> true,
				'condition' 	=> [
					'layout' => 'ticker',
				]
			  ]
		);
		
		
		$this->add_control(
			'ticker_speed',
			[
				'label' 	=> esc_html__( 'Animation Speed (in seconds)', 'xoxo-core' ),
				'type' 		=> \Elementor\Controls_Manager::NUMBER,
				'min' 		=> 1,
				'max' 		=> 100,
				'step' 		=> 1,
				'default' 	=> 17,
				'condition' 	=> [
					'layout' => 'ticker',
				]
			]
		);
		
		
		
		
		$this->add_control(
			'ajax_grid_load_more_text',
			  [
				'label'       	=> __( 'Load More Text', 'xoxo-core' ),
				'type'        	=> Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Load More', 'xoxo-core' ),
				'default' 		=> __( 'Load More', 'xoxo-core' ),
				'label_block'	=> true,
				'condition' 	=> [
					'layout' => 'ajax_grid',
				]
			  ]
		);
		$this->add_responsive_control(
			'ajax_grid_ratio',
			[
				'label' => __( 'Image Ratio', 'xoxo-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1.1,
				],
				'tablet_default' => [
					'size' => '',
				],
				'mobile_default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 3,
						'step' => 0.01,
					],
				],
				'condition' => [
					'layout' => ['ajax_grid'],
				]
			]
		);
		
		$this->add_control(
			'ajax_grid_gutter',
			[
				'label' 		=> __( 'Gutter', 'xoxo-core' ),
				'description' 	=> __( 'In px. Default value: 4', 'xoxo-core' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .fn_cs_posts_ajax_grid .main_left_wing,{{WRAPPER}} .fn_cs_posts_ajax_grid .title_left_wing' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fn_cs_posts_ajax_grid .fn_posts ul li' => 'padding-left: {{SIZE}}{{UNIT}};margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fn_cs_posts_ajax_grid .fn_posts ul' => 'margin-left: -{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'ajax_grid',
				]
			]
		);
		
		$this->add_control(
			'listed_header_switcher',
			[
				'label' => esc_html__( 'Header Switcher', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'xoxo-core' ),
				'label_off' => esc_html__( 'No', 'xoxo-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => 'listed',
				]
			]
		);
		$this->add_control(
			'listed_left_title',
			  [
				'label'       	=> __( 'Left Title', 'xoxo-core' ),
				'type'        	=> Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Left More', 'xoxo-core' ),
				'default' 		=> __( 'Latest Posts', 'xoxo-core' ),
				'label_block'	=> true,
				'condition' 	=> [
					'layout' => 'listed',
					'listed_header_switcher' => 'yes',
				]
			  ]
		);
		
		$this->add_control(
			'listed_link_switcher',
			[
				'label' => esc_html__( 'Link Switcher', 'xoxo-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'xoxo-core' ),
				'label_off' => esc_html__( 'No', 'xoxo-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => 'listed',
					'listed_header_switcher' => 'yes',
				]
			]
		);
		$this->add_control(
			'listed_link_text',
			  [
				'label'       	=> __( 'Link Text', 'xoxo-core' ),
				'type'        	=> Controls_Manager::TEXT,
				'default' 		=> __( 'See All', 'xoxo-core' ),
				'label_block'	=> true,
				'condition' 	=> [
					'layout' => 'listed',
					'listed_link_switcher' => 'yes',
					'listed_header_switcher' => 'yes',
				]
			  ]
		);
		$this->add_control(
			'listed_link_url',
			  [
				'label'       	=> __( 'Link URL', 'xoxo-core' ),
				'type'        	=> Controls_Manager::TEXT,
				'default' 		=> '#',
				'label_block'	=> true,
				'condition' 	=> [
					'layout' => 'listed',
					'listed_link_switcher' => 'yes',
					'listed_header_switcher' => 'yes',
				]
			  ]
		);
		
		
		$this->end_controls_section();
		
		
	}


	protected function render() {
		$settings 			= $this->get_settings();
		$layout				= $settings['layout'];
		$ratio			 	= (int)(($settings['ajax_grid_ratio']['size'] - 1)*100) / 100;
		
		// Post Number
		$post_number 	= $settings['blog_post_number']['size'];

		$query_args = array(
			'post_type' 			=> "post",
			'post_status' 			=> "publish",
			'ignore_sticky_posts' 	=> true,
		);



		// Post Parameters
		$post_filter	= $settings['bpo_posts__switcher'];
		if($post_filter == 'yes'){
			$query_args['post__in'] = $settings['blog_post_include'];
			$query_args['post__not_in'] = $settings['blog_post_exclude'];
		}

		// Category Paramters
		$category_filter = $settings['bpo_categories__switcher'];
		if($category_filter == 'yes'){
			$cf_include = $settings['blog_post_in_categories'];
			$cf_exclude = $settings['blog_post_ex_categories'];

			if ( ! empty ( $cf_exclude ) ) {

				$query_args['tax_query'] = array(
					array(
						'taxonomy'	=> 'category', 
						'field'	 	=> 'slug',
						'terms'		=> $cf_exclude,
						'operator'	=> 'NOT IN'
					)
				);

				if ( ! empty ( $cf_include ) ) {
					$query_args['tax_query']['relation'] = 'AND';
					$query_args['tax_query'][] = array(
						'taxonomy'	=> 'category',
						'field'		=> 'slug',
						'terms'		=> $cf_include,
						'operator'	=> 'IN'
					);
				}		

			} else {
				if ( ! empty ( $cf_include ) ) {
					$query_args['tax_query'] = array(
						array(
							'taxonomy' 	=> 'category',
							'field' 	=> 'slug',
							'terms' 	=> $cf_include,
							'operator'	=> 'IN'
						)
					);
				}
			}
		}

		// Author Parameters
		$author_filter	= $settings['bpo_author__switcher'];
		if($author_filter == 'yes'){
			$af_include = $settings['blog_post_in_author'];
			$af_exclude = $settings['blog_post_ex_author'];
			$query_args['author__in'] = $af_include;
			$query_args['author__not_in'] = $af_exclude;
		}

		// Tag Parameters
		$tag_filter	= $settings['bpo_tag__switcher'];
		if($tag_filter == 'yes'){
			$tf_include = $settings['blog_post_in_tag'];
			$tf_exclude = $settings['blog_post_ex_tag'];
			$query_args['tag__in'] 	= $tf_include;
			$query_args['tag__not_in'] = $tf_exclude;
		}

		// Search Parameters
		$search_filter	= $settings['bpo_search__switcher'];
		if($search_filter == 'yes'){
			$sf_text = $settings['blog_post_search'];
			$query_args['s'] = esc_html($sf_text);
		}

		// Comment Parameters
		$comment_filter	= $settings['bpo_comment__switcher'];
		if($comment_filter == 'yes'){
			$cf_count = $settings['blog_post_comment_count'];
			$cf_compare = $settings['blog_post_comment_compare'];
			$query_args['comment_count'] = array('value' => (int)$cf_count, 'compare' => $cf_compare);
		}

		// Order Parameters
		$order_filter = $settings['bpo_order__switcher'];
		if($order_filter == 'yes'){
			$of_order = $settings['blog_post_order'];
			$of_orderby = $settings['blog_post_orderby'];
			if($of_orderby === 'select'){$of_orderby = '';}
			$query_args['order'] = $of_order;
			if($of_orderby == 'popular'){
				$query_args['orderby'] = 'meta_value_num';
				$query_args['meta_key'] = 'xoxo_post_views_count';
			}else{
				$query_args['orderby'] = $of_orderby;
			}
		}

		$dateTimeArray = array();
		// Date Query
		$date_filter = $settings['bpo_date__switcher'];
		if($date_filter == 'yes' && !empty($settings['bpod_list'])){
			$date_filters = $settings['bpod_list'];

			foreach($date_filters as $filter){
				$type = $filter['bpod_type'];
				if($type == 'range'){
					$range = $filter['bpod_range'];
					if($range == 'today'){
						$today = getdate();
						$dateTimeArray[] = array(
							'year'  => $today['year'],
							'month' => $today['mon'],
							'day'   => $today['mday'],
						);
					}else if($range == 'yesterday'){
						$date = strtotime("-1 days");
						$dateTimeArray[] = array(
							'year'  => date('Y',$date),
							'month' => date('m',$date),
							'day'   => date('d',$date),
						);
					}else if($range == 'this_week'){
						$dateTimeArray[] = array(
							'year' => date( 'Y' ),
							'week' => date( 'W' ),
						);
					}else if($range == 'last_week'){
						$date = strtotime("last week");
						$dateTimeArray[] = array(
							'year' => date( 'Y', $date ),
							'week' => date( 'W', $date ),
						);
					}else if($range == 'this_month'){
						$dateTimeArray[] = array(
							'year' => date( 'Y' ),
							'month' => date( 'm' ),
						);
					}else if($range == 'last_month'){
						$date = strtotime("-1 month");
						$dateTimeArray[] = array(
							'year' => date( 'Y', $date ),
							'month' => date( 'm', $date ),
						);
					}else if($range == 'this_year'){
						$dateTimeArray[] = array(
							'year' => date( 'Y' )
						);
					}else if($range == 'last_year'){
						$dateTimeArray[] = array(
							'year' => date("Y", strtotime("-1 year"))
						);
					}else if($range == 'last_7d'){
						$date = strtotime("-7 days");
						$dateTimeArray[] = array(
							'after' => [
								'year' => date("Y", $date),
								'month' => date("m", $date),
								'day' => date("d", $date),
							]
						);
					}else if($range == 'last_30d'){
						$date = strtotime("-30 days");
						$dateTimeArray[] = array(
							'after' => [
								'year' => date("Y", $date),
								'month' => date("m", $date),
								'day' => date("d", $date),
							]
						);
					}else if($range == 'last_60d'){
						$date = strtotime("-60 days");
						$dateTimeArray[] = array(
							'after' => [
								'year' => date("Y", $date),
								'month' => date("m", $date),
								'day' => date("d", $date),
							]
						);
					}else if($range == 'last_90d'){
						$date = strtotime("-90 days");
						$dateTimeArray[] = array(
							'after' => [
								'year' => date("Y", $date),
								'month' => date("m", $date),
								'day' => date("d", $date),
							]
						);
					}else if($range == 'last_365d'){
						$date = strtotime("-365 days");
						$dateTimeArray[] = array(
							'after' => [
								'year' => date("Y", $date),
								'month' => date("m", $date),
								'day' => date("d", $date),
							]
						);
					}
				}else if($type == 'period'){
					$from = strtotime($filter['bpod_from']);
					$to = strtotime($filter['bpod_to']);
					if($to > $from){
						$dateTimeArray[] = array(
							'after' => [
								'year' => date("Y", $from),
								'month' => date("m", $from),
								'day' => date("d", $from),
							]
						);
						$dateTimeArray[] = array(
							'before' => [
								'year' => date("Y", $to),
								'month' => date("m", $to),
								'day' => date("d", $to),
							]
						);
					}
				}else if($type == 'last'){
					$last_count = $filter['bpod_last_count'];
					$last_type = $filter['bpod_last_type'];
					$date = strtotime("-".(int)$last_count." ".$last_type);
					$dateTimeArray[] = array(
						'after' => [
							'year' => date("Y", $date),
							'month' => date("m", $date),
							'day' => date("d", $date),
						]
					);
				}else if($type == 'before'){
					$date = strtotime($filter['bpod_before']);
					$dateTimeArray[] = array(
						'before' => [
							'year' => date("Y", $date),
							'month' => date("m", $date),
							'day' => date("d", $date),
						]
					);
				}else if($type == 'after'){
					$date = strtotime($filter['bpod_after']);
					$dateTimeArray[] = array(
						'after' => [
							'year' => date("Y", $date),
							'month' => date("m", $date),
							'day' => date("d", $date),
						]
					);
				}else if($type == 'date'){
					$date = strtotime($filter['bpod_date']);
					$dateTimeArray[] = array(
						'before' => [
							'year' => date("Y", $date),
							'month' => date("m", $date),
							'day' => date("d", $date),
						]
					);
				}else if($type == 'year'){
					$year = $filter['bpod_year'];
					if($year > 0){
						$dateTimeArray[] = array(
							'year' => $year,
						);
					}
				}else if($type == 'month'){
					$month = $filter['bpod_month'];
					if($month > 0){
						$dateTimeArray[] = array(
							'month' => $month,
						);
					}
				}else if($type == 'day'){
					$day = $filter['bpod_day'];
					if($day > 0){
						$dateTimeArray[] = array(
							'day' => $day,
						);
					}
				}else if($type == 'week'){
					$week = $filter['bpod_week'];
					if($week > 0){
						$dateTimeArray[] = array(
							'week' => $week,
						);
					}
				}else if($type == 'week_days'){
					$wdays = $filter['bpod_week_days'];
					$dateTimeArray[] = array(
						'dayofweek' => $wdays,
						'compare' => 'IN',
					);
				}
			}
		}



		// Time Query
		$time_filter = $settings['bpo_time__switcher'];
		if($time_filter == 'yes' && !empty($settings['bpot_list'])){

			$from 	= $settings['bpot_from'];
			$to 	= $settings['bpot_to'];
			$dateTimeArray[] = array(
				'hour' => intdiv($from , 60),
				'minute' => $from % 60,
				'compare' => '>='
			);
			$dateTimeArray[] = array(
				'hour' => intdiv($to , 60),
				'minute' => $to % 60,
				'second' => $to % 60,
				'compare' => '<='
			);
		}
		if(!empty($dateTimeArray)){
			$query_args['date_query'] = $dateTimeArray;
		}

		// !! Warning !! please use it at the end of wordpress query
		// Offset loop
		$post_offset 	= $settings['blog_post_offset'];
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

		if($layout == 'ajax_grid'){
			$query_args['posts_per_page'] = $post_number;
			$loop2 = new \WP_Query($query_args);
			$all_posts_count = count($loop2->posts);
			$query_args['posts_per_page'] = $settings['ajax_grid_ppp']['size'];
			$loop = new \WP_Query($query_args);
			$specified_posts_count = count($loop->posts);

			// special for ajax
			$query_args['ajax__all_count'] = $all_posts_count;
			$query_args['ajax__ratio'] = $ratio;
		}else if($layout == 'fixed_col'){
			$ppp = $settings['fixed_col_ppp']['size'];
			$query_args['posts_per_page'] = $post_number;
			$loop2 = new \WP_Query($query_args);
			$all_posts_count = count($loop2->posts);

			$query_args['posts_per_page'] = $ppp;
			// special for ajax
			$query_args['ajax__all_count'] = $all_posts_count;
			
			$paged = 1;
			if(isset($_GET['page_number'])){
				$paged = (int)sanitize_text_field($_GET['page_number']);
			}
			if(is_int($paged)){
				$query_args['paged'] = $paged;
			}
			
		}else if($layout == 'parallax_classic' || $layout == 'parallax_zigzag'){
			$ppp = $settings['parallax_classic_ppp']['size'];
			$query_args['posts_per_page'] = $post_number;
			$loop2 = new \WP_Query($query_args);
			$all_posts_count = count($loop2->posts);

			$query_args['posts_per_page'] = $ppp;
			// special for ajax
			$query_args['ajax__all_count'] = $all_posts_count;
			
			$paged = 1;
			if(isset($_GET['page_number'])){
				$paged = (int)sanitize_text_field($_GET['page_number']);
			}
			if(is_int($paged)){
				$query_args['paged'] = $paged;
			}
			
		}else{
			$query_args['posts_per_page'] = $post_number;
			$loop = new \WP_Query($query_args);
		}
			
		/***********************************************************************************/
		/* RENDER STARTS */
		$html		 	= Frel_Helper::frel_open_wrap();
		
		
		$xxxxx 	= xoxo_fn_getSVG_theme('xxxxx');
		$arrow	= xoxo_fn_getSVG_theme('arrow');
		$read_text = esc_html__('Read More', 'xoxo-core');
		
		if($layout == 'full_slider'){
			$list = '';
			if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
				$postID				= get_the_ID();
				$permalink 			= get_permalink();
				$postImage			= get_the_post_thumbnail_url($postID, 'full');
				$postTitle			= get_the_title();

				$postTitle = '<div class="title"><h3><a href="'.$permalink.'">'.$postTitle.'</a></h3></div>';
				$categories = xoxo_fn_get_categories($postID, 'single', 'post', 1);
				$metas = xoxo_fn_metas($postID,'search');
				$titleHolder = '<div class="title_holder">'.$categories.$postTitle.$metas.'</div>';

				$list .= '<div class="swiper-slide"><div class="item"><a class="full_link" href="'.$permalink.'"></a><div class="bg_overlay"></div><div class="abs_img" data-bg-img="'.$postImage.'"></div>'.$titleHolder.'</div></div>';
			endwhile; endif; wp_reset_postdata();
			$arrow = xoxo_fn_getSVG_theme('arrow2');
			$html .= '<div class="fn_cs_post_slider"><div class="swiper-container"><div class="swiper-wrapper">'.$list.'</div></div>
						<a href="#" class="slider_nav prev">
							<span class="circle"></span>
							<span class="icon">'.$arrow.'</span>
							<span class="circle"></span>
						</a>
						<a href="#" class="slider_nav next">
							<span class="circle"></span>
							<span class="icon">'.$arrow.'</span>
							<span class="circle"></span>
						</a>
					</div>';
		}else if($layout == 'carousel'){
			$list = '';
			if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
				$postID				= get_the_ID();
				$permalink 			= get_permalink();
				$postImage			= get_the_post_thumbnail_url($postID, 'full');
				$imageURL = $postTitle = '';
				$permalink			= get_the_permalink();
				$title				= get_the_title();
				if($title !== ''){
					$postTitle 	= '<h3 class="fn__maintitle"><a href="'.$permalink.'">'.$title.'</a></h3>';
				}
				$img_holder = '<div class="blog__image">'.xoxo_fn_get_categories(	$postID, 'single', 'post', 1, '').'<div class="abs_img" data-bg-img="'.$postImage.'"><a href="'.$permalink.'"></a>'.$xxxxx.'</div></div>';
				$read_more = '<div class="read_more second third"><a href="'.$permalink.'"><span class="text">'.$read_text.'</span><span class="icon"><span class="arrow">'.$arrow.'</span><span class="triple"></span></span></a></div>';
				$title_holder = '<div class="title_holder"><div class="title_meta">'.$postTitle.xoxo_fn_metas($postID,'search').'</div>'.$read_more.'</div>';
				$list .= '<div class="swiper-slide"><div class="item">'.$img_holder.$title_holder.'</div></div>';
			endwhile; endif; wp_reset_postdata();
			$arrow = xoxo_fn_getSVG_theme('arrow2');
			$wave = xoxo_fn_getSVG_theme('wave');
			$navv = '<div class="slider__nav"><span class="wave1 wave"><span>'.$wave.'</span></span><span class="wave2 wave"><span>'.$wave.'</span></span><a href="#" class="slider_nav prev"><span class="circle"></span><span class="icon">'.$arrow.'</span><span class="circle"></span></a><a href="#" class="slider_nav next"><span class="circle"></span><span class="icon">'.$arrow.'</span><span class="circle"></span></a></div>';
			$html .= '<div class="fn_cs_post_carousel"><div class="swiper-container"><div class="swiper-wrapper">'.$list.'</div></div>'.$navv.'</div>';
		}else if($layout == 'ajax_grid'){
			$html .= '<div class="fn_cs_posts_ajax_grid">';
			$list  = '<div class="fn_posts"><ul>';
			$list .= xoxo_fn_ajaxgridpost_items($query_args);
			$list .= '</ul></div>';
			$html .= $list;
			

			if($all_posts_count > $specified_posts_count){
				$html .= '<div class="fn_ajax_more">';
					$html .= '<span class="preloader"></span>';
					$html .= '<a href="#"></a>';
					$html .= '<span class="text">'.$settings['ajax_grid_load_more_text'].'</span>';
				$html .= '</div>';
				$html .= '<script>var XoxoArguments = '. json_encode($query_args) .';</script>';
			}
			$html .= '</div>';
		}else if($layout == 'listed'){
			$list 	= '';
			if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
				$loopPostID			= get_the_ID();
				$mediaID 			= get_post_thumbnail_id( $loopPostID );
				$src 				= wp_get_attachment_image_src( $mediaID, 'full');
				$imageURL = $img_holder = $readSecond = $postTitle = '';
				$has_image			= 0;
				if(isset($src[0])){$imageURL = $src[0];}
				if($imageURL != ''){$has_image = 1;}
				$permalink			= get_the_permalink();
				$title				= get_the_title();
				if($title !== ''){
					$postTitle 	= '<h3 class="fn__maintitle"><a href="'.$permalink.'">'.$title.'</a></h3>';
				}
				if($has_image == 1){
					$readSecond = 'second';
					$img_holder = '<div class="blog__image">'.xoxo_fn_get_categories(	$loopPostID, 'single', 'post', 1, '').'<div class="abs_img" data-bg-img="'.$imageURL.'">'.$xxxxx.'</div></div>';
				}
				$title_holder = '<div class="title_holder">'.$postTitle.xoxo_fn_metas($loopPostID,'search').'<div class="read_more '.$readSecond.'"><a href="'.$permalink.'"><span class="text">'.$read_text.'</span><span class="icon"><span class="arrow">'.$arrow.'</span><span class="triple"></span></span></a></div></div>';
				$list .= '<li><div class="related__item" data-has-img="'.$has_image.'">'.$img_holder.$title_holder.'</div></li>';
			endwhile; endif; wp_reset_postdata();
			
			$html .= '<div class="fn_cs_posts_listed">';
			
				// top title holder
				if($settings['listed_header_switcher'] == 'yes'){
					$html .= '<div class="fn__title_holder">';
						$html .= '<div class="left_title"><h3>'.$settings['listed_left_title'].'</h3></div>';
						$html .= '<div class="lines"><span class="raleway"><span></span><span></span><span></span><span></span><span></span></span></div>';
						if($settings['listed_link_switcher'] == 'yes'){
							$html .= '<div class="right_title">';
								$html .= '<div class="see_all"><a href="'.$settings['listed_link_url'].'">'.$settings['listed_link_text'].'</a></div>';
							$html .= '</div>';
						}
					$html .= '</div>';
				}
					
				
			
				$html .= '<div class="fn_posts"><ul>'.$list.'</ul></div>';
			
			$html .= '</div>';
		}else if($layout == 'fixed_col'){
			$html .= '<div class="fn_cs_posts_fixed_col">';
			
				
			$html .= xoxo_fn_fixedcolpost_items($query_args,$paged);
			
			$html .= '<script>var XoxoArgumentsFixedCol = '. json_encode($query_args) .';</script>';
			
			$html .= '</div>';
		}else if($layout == 'parallax_classic' || $layout == 'parallax_zigzag'){
			$html .= '<div class="fn_cs_posts_parallax_classic '.$layout.'">';
			
				
			$html .= xoxo_fn_parallaxclassicpost_items($query_args,$paged);
			
			$html .= '<script>var XoxoArgumentsParallaxClassic = '. json_encode($query_args) .';</script>';
			
			$html .= '</div>';
		}else if($layout == 'ticker'){
			$icon = xoxo_fn_getSVG_theme('wave2');
			$list = '';
			if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
				$postID				= get_the_ID();
				$permalink 			= get_permalink();
				$permalink			= get_the_permalink();
				$title				= get_the_title() != '' ? get_the_title() : esc_html__('(no title)','xoxo-core');
				$postTitle 			= '<h3 class="fn__maintitle"><a href="'.$permalink.'">'.$title.'</a></h3>';
			
				$list .= '<div class="ti_news">'.$postTitle.$icon.'</div>';
			endwhile; endif; wp_reset_postdata();
			if($list != ''){
				$topText = '';
				if($settings['ticker_top_text'] != ''){
					$topText = '<div class="tick_cap">'.$settings['ticker_top_text'].'</div>';
				}
				$html .= '<div class="fn_cs_posts_ticker">'.$topText.'<div class="tn_wrapper"><div class="TickerNews"><div class="ti_wrapper"><div class="ti_slide"><div class="marquee" data-speed="'.$settings['ticker_speed'].'">'. $list . '</div></div></div></div></div></div>';
			}
		}
		
		
		
		
		/***********************************************************************************/
		/* RENDER ENDS */
		$html .= Frel_Helper::frel_close_wrap();
		echo $html;
	}

}
