<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'FERS_Field_icon' ) ) {
  class FERS_Field_icon extends FERS_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'xoxo-core' ),
        'remove_title' => esc_html__( 'Remove Icon', 'xoxo-core' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'fers_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="fers-icon-select">';
      echo '<span class="fers-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary fers-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button fers-warning-primary fers-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="hidden" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="fers-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( 'FERS_Field_icon', 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( 'FERS_Field_icon', 'add_footer_modal_icon' ) );
    }

    public static function add_footer_modal_icon() {
    ?>
      <div id="fers-modal-icon" class="fers-modal fers-modal-icon hidden">
        <div class="fers-modal-table">
          <div class="fers-modal-table-cell">
            <div class="fers-modal-overlay"></div>
            <div class="fers-modal-inner">
              <div class="fers-modal-title">
                <?php esc_html_e( 'Add Icon', 'xoxo-core' ); ?>
                <div class="fers-modal-close fers-icon-close"></div>
              </div>
              <div class="fers-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'xoxo-core' ); ?>" class="fers-icon-search" />
              </div>
              <div class="fers-modal-content">
                <div class="fers-modal-loading"><div class="fers-loading"></div></div>
                <div class="fers-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
