<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

 namespace FoodForLife\Addons\Elementor\Modules\Shoppable_Images;

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
			'FoodForLife\Addons\Elementor\Modules\Shoppable_Images\Settings'           => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/modules/shoppable-images/settings.php',
			'FoodForLife\Addons\Elementor\Modules\Shoppable_Images\Post_Type'          => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/modules/shoppable-images/post-type.php',
			'FoodForLife\Addons\Elementor\Modules\Shoppable_Images\Elementor_Settings' => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/modules/shoppable-images/elementor-settings.php',
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
		if( is_admin() ) {
			\FoodForLife\Addons\Elementor\Modules\Shoppable_Images\Settings::instance();

			if( class_exists('Elementor\Core\Base\Module') ) {
				\FoodForLife\Addons\Elementor\Modules\Shoppable_Images\Elementor_Settings::instance();
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
		if( get_option('foodforlife_shoppable_images_enable', 'yes') == 'yes' ) {
			\FoodForLife\Addons\Elementor\Modules\Shoppable_Images\Post_Type::instance();
		}
	}
}
