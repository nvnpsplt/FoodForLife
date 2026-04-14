<?php
/**
 * FoodForLife Addons init
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FoodForLife
 */

namespace FoodForLife;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * FoodForLife Addons init
 *
 * @since 1.0.0
 */
class Addons {

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
		add_action( 'plugins_loaded', array( $this, 'load_templates' ) );
	}

	/**
	 * Load Templates
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function load_templates() {
		$this->includes();
		spl_autoload_register( '\FoodForLife\Addons\Auto_Loader::load' );

		$this->add_actions();

		add_shortcode( 'foodforlife_year', array( __CLASS__, 'year' ) );
	}

	/**
	 * Includes files
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function includes() {
		// Auto Loader
		require_once FOODFORLIFE_ADDONS_DIR . 'autoloader.php';
		\FoodForLife\Addons\Auto_Loader::register( [
			'FoodForLife\Addons\Helper'                    => FOODFORLIFE_ADDONS_DIR . 'inc/helper.php',
			'FoodForLife\Addons\Importer'                  => FOODFORLIFE_ADDONS_DIR . 'inc/backend/importer.php',
			'FoodForLife\Addons\Page_Header'               => FOODFORLIFE_ADDONS_DIR . 'inc/backend/page-header.php',
			'FoodForLife\Addons\Single_Post'               => FOODFORLIFE_ADDONS_DIR . 'inc/backend/single-post.php',
			'FoodForLife\Addons\Theme_Settings'            => FOODFORLIFE_ADDONS_DIR . 'inc/backend/theme-settings.php',
			'FoodForLife\Addons\Widgets'                   => FOODFORLIFE_ADDONS_DIR . 'inc/widgets/widgets.php',
			'FoodForLife\Addons\Elementor'                 => FOODFORLIFE_ADDONS_DIR . 'inc/elementor/elementor.php',
			'FoodForLife\Addons\Modules'                   => FOODFORLIFE_ADDONS_DIR . 'modules/modules.php',
			'FoodForLife\Addons\WooCommerce\Products_Base' => FOODFORLIFE_ADDONS_DIR . 'inc/woocommerce/products-base.php',
		] );
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function add_actions() {
		// Before init action.
		do_action( 'before_foodforlife_init' );


		\FoodForLife\Addons\Theme_Settings::instance();
		if( is_admin() ) {
			\FoodForLife\Addons\Importer::instance();
			\FoodForLife\Addons\Page_Header::instance();
			\FoodForLife\Addons\Single_Post::instance();
		}
		\FoodForLife\Addons\Widgets::instance();
		if( class_exists('WooCommerce')  ) {
			\FoodForLife\Addons\Modules::instance();
		}
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			\FoodForLife\Addons\Elementor::instance();
		}

		// Init action.
		do_action( 'after_foodforlife_init' );
	}

	/**
	 * Display current year
	 *
	 * @return void
	 */
	public static function year() {
		return date('Y');
	}
}
