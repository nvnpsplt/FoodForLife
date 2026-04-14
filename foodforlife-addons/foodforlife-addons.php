<?php
/**
 * Plugin Name: FoodForLife Addons
 * Plugin URI: http://resilbyte.com/plugins/foodforlife-addons.zip
 * Description: Extra elements for Elementor. It was built for FoodForLife theme.
 * Version: 1.8.0
 * Author: ResilByte
 * Author URI: http://resilbyte.com
 * License: GPL2+
 * Text Domain: foodforlife-addons
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! defined( 'FOODFORLIFE_ADDONS_VER' ) ) {
	define( 'FOODFORLIFE_ADDONS_VER', '1.7.0' );
}

if ( ! defined( 'FOODFORLIFE_ADDONS_DIR' ) ) {
	define( 'FOODFORLIFE_ADDONS_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'FOODFORLIFE_ADDONS_URL' ) ) {
	define( 'FOODFORLIFE_ADDONS_URL', plugin_dir_url( __FILE__ ) );
}

require_once FOODFORLIFE_ADDONS_DIR . 'vendors/kirki/kirki.php';

require_once FOODFORLIFE_ADDONS_DIR . 'plugin.php';

\FoodForLife\Addons::instance();