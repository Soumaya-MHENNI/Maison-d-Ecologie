<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://frenify.com/
 * @since      1.0.0
 *
 * @package    Frenify_Editorial_Rating
 * @subpackage Frenify_Editorial_Rating/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Frenify_Editorial_Rating
 * @subpackage Frenify_Editorial_Rating/admin
 * @author     Forhad Hossain <need@forhad.net>
 */
class Frenify_Editorial_Rating_Admin {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	public function enqueue_styles() {


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/average-score-admin.css', array(), $this->version, 'all' );

	}


	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/average-score-admin.js', array( 'jquery' ), $this->version, false );

	}

}
