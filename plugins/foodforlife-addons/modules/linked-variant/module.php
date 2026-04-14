<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Linked_Variant;

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
			'FoodForLife\Addons\Modules\Linked_Variant\Post_Type' => FOODFORLIFE_ADDONS_DIR . 'modules/linked-variant/post-type.php',
			'FoodForLife\Addons\Modules\Linked_Variant\Meta_Box'  => FOODFORLIFE_ADDONS_DIR . 'modules/linked-variant/meta-box.php',
			'FoodForLife\Addons\Modules\Linked_Variant\Frontend'  => FOODFORLIFE_ADDONS_DIR . 'modules/linked-variant/frontend.php',
			'FoodForLife\Addons\Modules\Linked_Variant\Settings'  => FOODFORLIFE_ADDONS_DIR . 'modules/linked-variant/settings.php',
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
			\FoodForLife\Addons\Modules\Linked_Variant\Settings::instance();
			if ( get_option( 'foodforlife_linked_variant' ) == 'yes' ) {
				\FoodForLife\Addons\Modules\Linked_Variant\Meta_Box::instance();
			}
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
		if ( get_option( 'foodforlife_linked_variant' ) == 'yes' ) {
			\FoodForLife\Addons\Modules\Linked_Variant\Post_Type::instance();
			\FoodForLife\Addons\Modules\Linked_Variant\Frontend::instance();
		}

	}

}
