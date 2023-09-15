<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: shortcode
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'FERS_Field_shortcode' ) ) {

	class FERS_Field_shortcode extends FERS_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {

			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			// Get the Post ID.
			$post_id = get_the_ID();

			echo ( ! empty( $post_id ) ) ? '<div class="wper--shortcode-field-wrap"><code title="Click to select the Shortcode">[frenify-rating id="' . $post_id . '"]</code></div>' : '';
		}
	}
}
