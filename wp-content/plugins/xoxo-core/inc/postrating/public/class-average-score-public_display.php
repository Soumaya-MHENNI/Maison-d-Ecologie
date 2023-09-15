<?php

/**
 * The public-facing display of the plugin.
 *
 * @link       https://frenify.com/
 * @since      1.0.0
 *
 * @package    Frenify_Editorial_Rating
 * @subpackage Frenify_Editorial_Rating/public
 */

/**
 * The public-facing display of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Frenify_Editorial_Rating
 * @subpackage Frenify_Editorial_Rating/public
 * @author     Forhad Hossain <need@forhad.net>
 */
class Frenify_Editorial_Rating_Public_Display {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * A shortcode for this plugin.
	 *
	 * @since   2.0.0
	 * @param   string $atts attribute of this shortcode.
	 */
	public function fers_shortcode_execute( $atts ) {

		$fers_post_id = intval( $atts['id'] );

		$fers_meta_values          = get_post_meta( $fers_post_id, '_fers_prefix_post_options', true );
		$is_fers_score_shows       = isset( $fers_meta_values['fers-score-shows'] ) ? $fers_meta_values['fers-score-shows'] : '';
		$fers_score_title          = isset( $fers_meta_values['fers-score-title'] ) ? $fers_meta_values['fers-score-title'] : '';
		$fers_score_overview       = isset( $fers_meta_values['fers-score-overview'] ) ? $fers_meta_values['fers-score-overview'] : '';
		$fers_product_image_url    = isset( $fers_meta_values['fers-product-image']['url'] ) ? $fers_meta_values['fers-product-image']['url'] : '';
		$fers_product_image_alt    = isset( $fers_meta_values['fers-product-image']['alt'] ) ? $fers_meta_values['fers-product-image']['alt'] : '';
		$fers_editorial_rating     = isset( $fers_meta_values['fers-editorial-rating'] ) ? $fers_meta_values['fers-editorial-rating'] : '';
		$fers_bar_animation        = isset( $fers_meta_values['fers-bar-animation'] ) ? $fers_meta_values['fers-bar-animation'] : '';
		$is_fers_pros_cons_shows   = isset( $fers_meta_values['fers-pros-cons-shows'] ) ? $fers_meta_values['fers-pros-cons-shows'] : '';
		$fers_fers_pros            = isset( $fers_meta_values['fers-pros'] ) ? $fers_meta_values['fers-pros'] : '';
		$fers_fers_cons            = isset( $fers_meta_values['fers-cons'] ) ? $fers_meta_values['fers-cons'] : '';
		$fers_product_btn_txt      = isset( $fers_meta_values['fers-product-btn']['fers-product-btn-text'] ) ? $fers_meta_values['fers-product-btn']['fers-product-btn-text'] : '';
		$fers_product_btn_url      = isset( $fers_meta_values['fers-product-btn']['fers-product-btn-link'] ) ? $fers_meta_values['fers-product-btn']['fers-product-btn-link'] : '';
		$fers_product_btn_target   = isset( $fers_meta_values['fers-product-btn']['fers-product-btn-target'] ) ? $fers_meta_values['fers-product-btn']['fers-product-btn-target'] : '';
		$fers_product_btn_nofollow = isset( $fers_meta_values['fers-product-btn']['fers-product-btn-nofollow'] ) ? $fers_meta_values['fers-product-btn']['fers-product-btn-nofollow'] : '';

		$output = '';
		
		if ( is_single() && $is_fers_score_shows ) {

			ob_start();

			wp_enqueue_style( $this->plugin_name );

			// Get the score.
			$fers_i            = 0;
			$fers_total_rating = 0;
			foreach ( $fers_editorial_rating as $fers_editorial_rating_key => $fers_editorial_rating_value ) {
				$fers_total_rating += round( $fers_editorial_rating_value['fers-editorial-rating-category-rate'] );
				$fers_i++;
			}
			$fers_total_rating_math       = $fers_total_rating / $fers_i;
			$fers_total_rating_math_round = number_format( $fers_total_rating_math, 1 );
			
			
			
			
			$output .= '<div class="fers--wrap">';
				$output .= '<div class="fers--rating-wrap">';
				
					$output .= '<h3 class="fers--rating-title">'.esc_html($fers_score_title).'</h3>';
					$output .= '<div class="fers--rating-box">';
						$output .= '<div class="fers--rating-box-top">';
							// TOTAL SCORE
							$output .= '<div class="fers--overall-score-box">';
								$output .= '<span class="fers--overall-score">' . $fers_total_rating_math_round . '</span>';
								$output .= '<span class="fers--rating-text">'.esc_html__('Overall', 'xoxo-core').'</span>';
							$output .= '</div>';
							// CATEGORIES
							$output .= '<div class="fers--rating-categories">';
							foreach ( $fers_editorial_rating as $fers_editorial_rating_key => $fers_editorial_rating_value ) {
								$output .= '<div class="fers--rating-detail">
												<span class="fers--rating-name">' . $fers_editorial_rating_value['fers-editorial-rating-category-name'] . '</span>
												<span class="fers--rating-rate"><strong>' . round( $fers_editorial_rating_value['fers-editorial-rating-category-rate'] ) . '</strong></span>
											</div>
											<div class="fers--rating-meter">	
												<span class="fers--rating-bar" style="width: ' . round( $fers_editorial_rating_value['fers-editorial-rating-category-rate'] ) . '%"></span>
											</div>';
							}
							$output .= '</div>';
						$output .= '</div>';
					// OVERVIEW
					if ( $fers_score_overview ) {
						$output .= '<div class="fers--rating-box-bottom">';
							$output .= '<span class="fers-score-overview-title">'.esc_html__('The Summary', 'xoxo-core').'</span>';
							$output .= '<div class="fers-score-overview">' . $fers_score_overview . '</div>';
						$output .= '</div>';
					}
					$output .= '</div>';
			
				$output .= '</div>';
				
			if ( $is_fers_pros_cons_shows && (!empty($fers_fers_pros) || !empty($fers_fers_cons)) ) {
				$output .= '<div class="fers--pros-cons-wrap">';
					
					$output .= '<div class="fers--title-wrap">';
						$output .= '<h3 class="fers--pros-title">'.esc_html__('Pros', 'xoxo-core').'</h3>';
						$output .= '<h3 class="fers--cons-title">'.esc_html__('Cons', 'xoxo-core').'</h3>';
					$output .= '</div>';
				
				
					$output .= '<div class="fers--boxes">';
				
					// PROS
					$output .= '<div class="fers--pros-box">';
						$output .= '<span class="fers--icon-wrap">'.frenify_getSVG('like').'</span>';
						$output .= '<ul class="fers--pros-list">';
						foreach ( $fers_fers_pros as $fers_fers_pros_key => $fers_fers_pros_value ) {
							$output .= '<li>' . $fers_fers_pros_value['fers-pros-list'] . '</li>';
						}
						$output .= '</ul>';
					$output .= '</div>';
				
					// CONS
					$output .= '<div class="fers--cons-box">';
						$output .= '<span class="fers--icon-wrap">'.frenify_getSVG('dislike').'</span>';
						$output .= '<ul class="fers--cons-list">';
						foreach ( $fers_fers_cons as $fers_fers_cons_key => $fers_fers_cons_value ) {
							$output .= '<li></span>' . $fers_fers_cons_value['fers-cons-list'] . '</li>';
						}
						$output .= '</ul>';
					$output .= '</div>';
				
				
					$output .= '</div>';
				
				$output .= '</div>';
			}
			$output .= '</div>';
			echo $output;
			return ob_get_clean();
		}
		
		echo $output;	
	}

	/**
	 * Schema JSON data for this plugin.
	 *
	 * @since   2.1.0
	 * @param   string $atts attribute of this shortcode.
	 */
	public function fers_enqueue_json_schema() {

		$fers_meta_values       = get_post_meta( get_the_ID(), '_fers_prefix_post_options', true );
		$is_fers_score_shows    = isset( $fers_meta_values['fers-score-shows'] ) ? $fers_meta_values['fers-score-shows'] : '';
		$fers_score_title       = isset( $fers_meta_values['fers-score-title'] ) ? $fers_meta_values['fers-score-title'] : '';
		$fers_score_overview    = isset( $fers_meta_values['fers-score-overview'] ) ? $fers_meta_values['fers-score-overview'] : '';
		$fers_editorial_rating  = isset( $fers_meta_values['fers-editorial-rating'] ) ? $fers_meta_values['fers-editorial-rating'] : '';
		$fers_product_image_url = isset( $fers_meta_values['fers-product-image']['url'] ) ? $fers_meta_values['fers-product-image']['url'] : '';

		if ( is_single() && $is_fers_score_shows ) {

			// Get the author name.
			$fers_get_post = get_post();
			setup_postdata( $fers_get_post );
			$fers_author_name = get_the_author();

			// Get the score.
			$fers_i            = 0;
			$fers_total_rating = 0;
			foreach ( $fers_editorial_rating as $fers_editorial_rating_key => $fers_editorial_rating_value ) {
				$fers_total_rating += round( $fers_editorial_rating_value['fers-editorial-rating-category-rate'] );
				$fers_i++;
			}
			$fers_total_rating_math       = $fers_total_rating / $fers_i;
			$fers_total_rating_math_round = number_format( $fers_total_rating_math, 1 );
			?>


			<script type="application/ld+json">
			{
				"@context": "https://schema.org/",
				"@type":"Review",
				"name":"<?php echo $fers_score_title; ?>",
				<?php
				if ( ! empty( $fers_product_image_url ) ) {
					echo '"image": "' . $fers_product_image_url . '",';
				}
				?>

				"datePublished":" <?php echo get_the_date('Y-m-d') . ' ' . get_the_time('H:i:s'); ?>",
				"dateModified":"<?php echo get_the_modified_date('Y-m-d') . ' ' . get_post_modified_time('H:i:s'); ?>",
				"reviewBody":"<?php echo strip_tags( $fers_score_overview ); ?>",
				"reviewRating":{
					"@type":"Rating",
					"worstRating":"1",
					"bestRating":"10",
					"ratingValue":<?php echo $fers_total_rating_math_round; ?>
				},
				"author":{
					"@type":"Person",
					"name":"<?php echo $fers_author_name; ?>"
				},
				"itemReviewed":{
					"@type":"Product",
					"name":"<?php echo $fers_score_title; ?>",
					"aggregateRating":{
					"@type":"AggregateRating",
					"worstRating":"1",
					"bestRating":"10",
					"ratingValue":<?php echo $fers_total_rating_math_round; ?>,
					"reviewCount":"1"
					}
				}
			}
			</script>
			<?php

		} // IF is_single() && $is_fers_score_shows.
	}

}
