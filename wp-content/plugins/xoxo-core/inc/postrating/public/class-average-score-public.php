<?php

class Frenify_Editorial_Rating_Public {

	
	private $plugin_name;

	
	private $version;

	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {

		wp_register_style( $this->plugin_name . '-widget', plugin_dir_url( __FILE__ ) . 'css/average-score-public-widget.css', array(), $this->version, 'all' );
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/average-score-public.css', array(), $this->version, 'all' );

	}


	public function enqueue_scripts() {
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/average-score-public.js', array( 'jquery' ), $this->version, false );

	}

}

function frenify_getSVG($name = '', $class = ''){
	return '<img class="fn__svg '.$class.'" src="'.XOXO_PLUGIN_URL . 'inc/postrating/public/svg/'.$name.'.svg" alt="svg" />';
}