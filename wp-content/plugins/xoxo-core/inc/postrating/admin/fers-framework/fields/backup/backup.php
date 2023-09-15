<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'FERS_Field_backup' ) ) {
  class FERS_Field_backup extends FERS_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'fers_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'fers-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="fers_import_data" class="fers-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary fers-confirm fers-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'xoxo-core' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="fers-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary fers-export" target="_blank">'. esc_html__( 'Export & Download', 'xoxo-core' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="fers_transient[reset]" value="reset" class="button fers-warning-primary fers-confirm fers-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'xoxo-core' ) .'</button>';

      echo $this->field_after();

    }

  }
}
