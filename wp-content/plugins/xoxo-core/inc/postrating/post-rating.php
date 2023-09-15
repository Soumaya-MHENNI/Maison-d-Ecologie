<?php



/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-average-score.php';

/**
 * Calling The Framework.
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/fers-framework/classes/setup.class.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/fers-framework/options/metabox-options.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/fers-framework/options/widget-options.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Frenify_Editorial_Rating() {

	$plugin = new Frenify_Editorial_Rating();
	$plugin->run();

}
run_Frenify_Editorial_Rating();
