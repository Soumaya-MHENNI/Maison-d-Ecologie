<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: group
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'FERS_Field_group' ) ) {
  class FERS_Field_group extends FERS_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'max'                    => 0,
        'min'                    => 0,
        'fields'                 => array(),
        'button_title'           => esc_html__( 'Add New', 'xoxo-core' ),
        'accordion_title_prefix' => '',
        'accordion_title_number' => false,
        'accordion_title_auto'   => true,
      ) );

      $title_prefix = ( ! empty( $args['accordion_title_prefix'] ) ) ? $args['accordion_title_prefix'] : '';
      $title_number = ( ! empty( $args['accordion_title_number'] ) ) ? true : false;
      $title_auto   = ( ! empty( $args['accordion_title_auto'] ) ) ? true : false;

      if ( preg_match( '/'. preg_quote( '['. $this->field['id'] .']' ) .'/', $this->unique ) ) {

        echo '<div class="fers-notice fers-notice-danger">'. esc_html__( 'Error: Field ID conflict.', 'xoxo-core' ) .'</div>';

      } else {

        echo $this->field_before();

        echo '<div class="fers-cloneable-item fers-cloneable-hidden" data-depend-id="'. esc_attr( $this->field['id'] ) .'">';

          echo '<div class="fers-cloneable-helper">';
          echo '<i class="fers-cloneable-sort fas fa-arrows-alt"></i>';
          echo '<i class="fers-cloneable-clone far fa-clone"></i>';
          echo '<i class="fers-cloneable-remove fers-confirm fas fa-times" data-confirm="'. esc_html__( 'Are you sure to delete this item?', 'xoxo-core' ) .'"></i>';
          echo '</div>';

          echo '<h4 class="fers-cloneable-title">';
          echo '<span class="fers-cloneable-text">';
          echo ( $title_number ) ? '<span class="fers-cloneable-title-number"></span>' : '';
          echo ( $title_prefix ) ? '<span class="fers-cloneable-title-prefix">'. esc_attr( $title_prefix ) .'</span>' : '';
          echo ( $title_auto ) ? '<span class="fers-cloneable-value"><span class="fers-cloneable-placeholder"></span></span>' : '';
          echo '</span>';
          echo '</h4>';

          echo '<div class="fers-cloneable-content">';
          foreach ( $this->field['fields'] as $field ) {

            $field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
            $field_unique  = ( ! empty( $this->unique ) ) ? $this->unique .'['. $this->field['id'] .'][0]' : $this->field['id'] .'[0]';

            FERS::field( $field, $field_default, '___'. $field_unique, 'field/group' );

          }
          echo '</div>';

        echo '</div>';

        echo '<div class="fers-cloneable-wrapper fers-data-wrapper" data-title-number="'. esc_attr( $title_number ) .'" data-field-id="['. esc_attr( $this->field['id'] ) .']" data-max="'. esc_attr( $args['max'] ) .'" data-min="'. esc_attr( $args['min'] ) .'">';

        if ( ! empty( $this->value ) ) {

          $num = 0;

          foreach ( $this->value as $value ) {

            $first_id    = ( isset( $this->field['fields'][0]['id'] ) ) ? $this->field['fields'][0]['id'] : '';
            $first_value = ( isset( $value[$first_id] ) ) ? $value[$first_id] : '';
            $first_value = ( is_array( $first_value ) ) ? reset( $first_value ) : $first_value;

            echo '<div class="fers-cloneable-item">';

              echo '<div class="fers-cloneable-helper">';
              echo '<i class="fers-cloneable-sort fas fa-arrows-alt"></i>';
              echo '<i class="fers-cloneable-clone far fa-clone"></i>';
              echo '<i class="fers-cloneable-remove fers-confirm fas fa-times" data-confirm="'. esc_html__( 'Are you sure to delete this item?', 'xoxo-core' ) .'"></i>';
              echo '</div>';

              echo '<h4 class="fers-cloneable-title">';
              echo '<span class="fers-cloneable-text">';
              echo ( $title_number ) ? '<span class="fers-cloneable-title-number">'. esc_attr( $num+1 ) .'.</span>' : '';
              echo ( $title_prefix ) ? '<span class="fers-cloneable-title-prefix">'. esc_attr( $title_prefix ) .'</span>' : '';
              echo ( $title_auto ) ? '<span class="fers-cloneable-value">' . esc_attr( $first_value ) .'</span>' : '';
              echo '</span>';
              echo '</h4>';

              echo '<div class="fers-cloneable-content">';

              foreach ( $this->field['fields'] as $field ) {

                $field_unique = ( ! empty( $this->unique ) ) ? $this->unique .'['. $this->field['id'] .']['. $num .']' : $this->field['id'] .'['. $num .']';
                $field_value  = ( isset( $field['id'] ) && isset( $value[$field['id']] ) ) ? $value[$field['id']] : '';

                FERS::field( $field, $field_value, $field_unique, 'field/group' );

              }

              echo '</div>';

            echo '</div>';

            $num++;

          }

        }

        echo '</div>';

        echo '<div class="fers-cloneable-alert fers-cloneable-max">'. esc_html__( 'You cannot add more.', 'xoxo-core' ) .'</div>';
        echo '<div class="fers-cloneable-alert fers-cloneable-min">'. esc_html__( 'You cannot remove more.', 'xoxo-core' ) .'</div>';
        echo '<a href="#" class="button button-primary fers-cloneable-add">'. $args['button_title'] .'</a>';

        echo $this->field_after();

      }

    }

    public function enqueue() {

      if ( ! wp_script_is( 'jquery-ui-accordion' ) ) {
        wp_enqueue_script( 'jquery-ui-accordion' );
      }

      if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
        wp_enqueue_script( 'jquery-ui-sortable' );
      }

    }

  }
}
