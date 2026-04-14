<?php
/**
 * Load and register widgets
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons;
/**
 * FoodForLife theme init
 */
class Widgets {

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
		// Include plugin files
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}


	/**
	 * Register widgets
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function register_widgets() {
		$this->includes();
		$this->add_actions();
	}

	/**
	 * Include Files
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function includes() {
		\FoodForLife\Addons\Auto_Loader::register( [
			'FoodForLife\Addons\Widgets\Recent_Posts_Widget' => FOODFORLIFE_ADDONS_DIR . 'inc/widgets/recent-posts.php',
			'FoodForLife\Addons\Widgets\Social_Links'        => FOODFORLIFE_ADDONS_DIR . 'inc/widgets/socials.php',
			'FoodForLife\Addons\Widgets\Products_List'      => FOODFORLIFE_ADDONS_DIR . 'inc/widgets/products-list.php',
		] );
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function add_actions() {
		register_widget( new \FoodForLife\Addons\Widgets\Recent_Posts_Widget() );
		register_widget( new \FoodForLife\Addons\Widgets\Social_Links() );
		register_widget( new \FoodForLife\Addons\Widgets\Products_List() );
	}

}