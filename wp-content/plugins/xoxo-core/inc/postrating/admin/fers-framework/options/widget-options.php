<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Create a widget : Editorial Rating.
//
FERS::createWidget(
	'fers_editorial_rating_widget',
	array(
		'title'       => __( 'Editorial Rating', 'xoxo-core' ),
		'classname'   => 'fers-widget-editorial-rating',
		'description' => __( 'This widget from Editorial Rating plugin.', 'xoxo-core' ),
		'fields'      => array(

			array(
				'id'      => 'fers-widget-title',
				'type'    => 'text',
				'title'   => __( 'Title', 'xoxo-core' ),
				'default' => 'Editorial Rating',
			),
			array(
				'id'      => 'fers-widget-show-img',
				'type'    => 'switcher',
				'title'   => __( 'Show/Hide Product Image.', 'xoxo-core' ),
				'default' => false,
			),
			array(
				'id'      => 'fers-widget-show-score',
				'type'    => 'switcher',
				'title'   => __( 'Show/Hide Score Bars.', 'xoxo-core' ),
				'default' => true,
			),
			array(
				'id'      => 'fers-widget-show-pros-cons',
				'type'    => 'switcher',
				'title'   => __( 'Show/Hide Pros Cons.', 'xoxo-core' ),
				'default' => false,
			),
			array(
				'id'      => 'fers-widget-show-button',
				'type'    => 'switcher',
				'title'   => __( 'Show/Hide Button.', 'xoxo-core' ),
				'default' => true,
			),
			array(
				'id'      => 'fers-widget-sticky',
				'type'    => 'switcher',
				'title'   => __( 'Off/On Sticky Mode.', 'xoxo-core' ),
				'default' => false,
			),
			array(
				'id'         => 'fers-sticky-min-width',
				'type'       => 'number',
				'title'      => __( 'Stop sticky on mobile/tab size.', 'xoxo-core' ),
				'default'    => '922',
				'after'      => __( '(min-width: 922px)', 'xoxo-core' ),
				'dependency' => array( 'fers-widget-sticky', '==', true ),
			),
			array(
				'id'         => 'fers-widget-disable-sticky-footer',
				'type'       => 'switcher',
				'title'      => __( 'Disable sticky on footer tuch.', 'xoxo-core' ),
				'default'    => false,
				'dependency' => array( 'fers-widget-sticky', '==', true ),
			),
			array(
				'id'         => 'fers-widget-mobile-show',
				'type'       => 'switcher',
				'title'      => __( 'Show/Hide This Widget on Mobile/Tab.', 'xoxo-core' ),
				'text_on'    => 'Show',
				'text_off'   => 'Hide',
				'text_width' => 75,
				'default'    => false,
			),
			array(
				'id'         => 'fers-widget-min-width',
				'type'       => 'number',
				'title'      => __( 'Hide this widget on mobile/tab size.', 'xoxo-core' ),
				'default'    => '922',
				'after'      => __( '(min-width: 922px)', 'xoxo-core' ),
				'dependency' => array( 'fers-widget-mobile-show', '==', true ),
			),

		),
	)
);

//
// Front-end display of widget : Editorial Rating.
// Attention: This function named considering above widget base id.
//
if ( ! function_exists( 'fers_editorial_rating_widget' ) ) {
	function fers_editorial_rating_widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		/**
		 * Get Post Meta From Metabox.
		 */
		$fers_meta_values    = get_post_meta( get_the_ID(), '_fers_prefix_post_options', true );
		$is_fers_score_shows = isset( $fers_meta_values['fers-score-shows'] ) ? $fers_meta_values['fers-score-shows'] : '';
		$fers_widget_disable_sticky_footer = ( '0' !== $instance['fers-widget-disable-sticky-footer'] ) ? ' data-stickyDisable=true' : '';

		// Condition to prevent null value.
		if ( is_single() && $is_fers_score_shows ) {

			// Enqueue the styles.
			wp_enqueue_style( 'fers_editorial_rating-widget' );
			if ( '0' !== $instance['fers-widget-sticky'] ) {

				wp_enqueue_script( 'fers_editorial_rating' );
			}

			$fers_sticky_min_width  = isset( $instance['fers-sticky-min-width'] ) ? $instance['fers-sticky-min-width'] : '922';
			$fers_widget_min_width  = isset( $instance['fers-widget-min-width'] ) ? $instance['fers-widget-min-width'] : '922';
			$fers_product_image_url = isset( $fers_meta_values['fers-product-image']['url'] ) ? $fers_meta_values['fers-product-image']['url'] : '';
			$fers_product_image_alt = isset( $fers_meta_values['fers-product-image']['alt'] ) ? $fers_meta_values['fers-product-image']['alt'] : '';
			$fers_editorial_rating  = isset( $fers_meta_values['fers-editorial-rating'] ) ? $fers_meta_values['fers-editorial-rating'] : '';
			$fers_i = 0;
			foreach ( $fers_editorial_rating as $fers_editorial_rating_key => $fers_editorial_rating_value ) {
				$fers_total_rating += $fers_editorial_rating_value['fers-editorial-rating-category-rate'];
				$fers_i++;
			}
			$fers_total_rating_math       = $fers_total_rating / $fers_i;
			$fers_total_rating_math_round = number_format( $fers_total_rating_math, 1 );
			$fers_fers_pros               = isset( $fers_meta_values['fers-pros'] ) ? $fers_meta_values['fers-pros'] : '';
			$fers_fers_cons               = isset( $fers_meta_values['fers-cons'] ) ? $fers_meta_values['fers-cons'] : '';
			$fers_product_btn_txt         = isset( $fers_meta_values['fers-product-btn']['fers-product-btn-text'] ) ? $fers_meta_values['fers-product-btn']['fers-product-btn-text'] : '';
			$fers_product_btn_url         = isset( $fers_meta_values['fers-product-btn']['fers-product-btn-link'] ) ? $fers_meta_values['fers-product-btn']['fers-product-btn-link'] : '';
			$fers_product_btn_target      = isset( $fers_meta_values['fers-product-btn']['fers-product-btn-target'] ) ? $fers_meta_values['fers-product-btn']['fers-product-btn-target'] : '';
			$fers_product_btn_nofollow    = isset( $fers_meta_values['fers-product-btn']['fers-product-btn-nofollow'] ) ? $fers_meta_values['fers-product-btn']['fers-product-btn-nofollow'] : '';

			if ( '0' !== $instance['fers-widget-mobile-show'] ) {

				echo '<style>@media (max-width: ' . $fers_widget_min_width . 'px) {.fers-widget-editorial-rating {display: none !important;}}</style>';
			}

			echo '<div id="fers--editorial-rating" class="fers--rating-widget-wrap" data-stickyhideon="' . $fers_sticky_min_width . '"' . $fers_widget_disable_sticky_footer . '>
				<div class="fers--rating-widget-header">
					<span class="fers--rating-widget-title">' . esc_html( $instance['fers-widget-title'] ) . '</span>
					<strong><span class="fers--rating-widget-score">' . esc_html( $fers_total_rating_math_round ) . '</span></strong>
				</div>';

			if ( '0' !== $instance['fers-widget-show-img'] ) {

				if ( $fers_product_image_url ) {

					echo '<figure class="fers--product-img">
						<img src="' . $fers_product_image_url . '" alt="' . $fers_product_image_alt . '">
					</figure>';
				}
			}

			// Score Bars.
			if ( '0' !== $instance['fers-widget-show-score'] ) {

				echo '<div class="fers--rating-categories">';
				foreach ( $fers_editorial_rating as $fers_editorial_rating_key => $fers_editorial_rating_value ) {

					echo '<div class="fers--rating-detail">
						<span class="fers--rating-name">' . esc_html( $fers_editorial_rating_value['fers-editorial-rating-category-name'] ) . '</span>
						<strong>
							<span class="fers--rating-rate">' . esc_html( $fers_editorial_rating_value['fers-editorial-rating-category-rate'] ) . '</span>
						</strong>
					</div>
					<div class="fers--rating-meter">	
						<span class="fers--rating-bar" style="width: ' . esc_html( $fers_editorial_rating_value['fers-editorial-rating-category-rate'] ) . '0%"></span>
					</div>';
				}
				echo '</div>';
			}

			// Pros-Cons Wrap.
			if ( '0' !== $instance['fers-widget-show-pros-cons'] ) {

				echo '<div class="fers--pros-cons-wrap">
						<div class="fers--pros-wrap">
							<span class="fers--pros-title">PROS</span>
							<ul class="fers--pros-list">';
							foreach ( $fers_fers_pros as $fers_fers_pros_key => $fers_fers_pros_value ) {

								echo '<li><span class="icon-checkmark"></span>' . esc_html( $fers_fers_pros_value['fers-pros-list'] ) . '</li>';
							}
							echo '</ul>
							<span class="fers--title-cons"></span>
						</div>
						<div class="fers--cons-wrap">
							<span class="fers--cons-title">CONS</span>
							<ul class="fers--cons-list">';
							foreach ( $fers_fers_cons as $fers_fers_cons_key => $fers_fers_cons_value ) {

								echo '<li><span class="icon-cross"></span>' . esc_html( $fers_fers_cons_value['fers-cons-list'] ) . '</li>';
							}
							echo '</ul>
						</div>
					</div>';
			}

			// Button.
			if ( '0' !== $instance['fers-widget-show-button'] ) {

				echo '<div class="fers--rating-widget-btn-wrap"><a href="' . esc_attr( $fers_product_btn_url ) . '" class="fers--product-link" target="' . ( '1' !== $fers_product_btn_target ? '_self' : '_blank' ) . '"' . ( '1' === $fers_product_btn_nofollow ? ' rel="nofollow"' : '' ) . '>' . esc_html( $fers_product_btn_txt ) . '</a></div>';
			}

			echo '</div>'; // fers--rating-widget-wrap.

		} // if ( is_single() && $is_fers_score_shows )

		echo $args['after_widget'];
	}
}
