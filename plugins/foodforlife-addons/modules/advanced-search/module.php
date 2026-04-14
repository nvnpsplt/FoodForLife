<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Advanced_Search;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Addons Modules
 */
class Module {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	private static $instance;


	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		$this->includes();
		$this->actions();
		add_action('admin_init', array( $this, 'settings'));
	}

	/**
	 * Includes files
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function includes() {
		\FoodForLife\Addons\Auto_Loader::register( [
			'FoodForLife\Addons\Modules\Advanced_Search\Settings'        => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-search/settings.php',
			'FoodForLife\Addons\Modules\Advanced_Search\AJAX_Search'        => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-search/ajax-search.php',
			'FoodForLife\Addons\Modules\Advanced_Search\Posts'        => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-search/posts.php',
			'FoodForLife\Addons\Modules\Advanced_Search\Taxonomies'        => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-search/taxonomies.php',
			'FoodForLife\Addons\Modules\Advanced_Search\Catalog'        => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-search/catalog.php',
		] );
	}

	/**
	 * Settings
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function settings() {
		if ( is_admin() ) {
			\FoodForLife\Addons\Modules\Advanced_Search\Settings::instance();
		}
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function actions() {
		if ( get_option( 'foodforlife_ajax_search', 'yes' ) == 'yes' ) {
			\FoodForLife\Addons\Modules\Advanced_Search\AJAX_Search::instance();
		}

		\FoodForLife\Addons\Modules\Advanced_Search\Catalog::instance();
	}

}
