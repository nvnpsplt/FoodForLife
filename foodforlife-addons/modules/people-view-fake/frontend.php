<?php

namespace FoodForLife\Addons\Modules\People_View_Fake;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Frontend {

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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'woocommerce_single_product_summary', array( $this, 'people_view_fake' ), 22 );
		add_action( 'foodforlife_people_view_fake_elementor', array( $this, 'people_view_fake' ), 15 );
	}

	/**
	 * Enqueue scripts
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		if ( ! is_singular( 'product' ) && ! is_singular( 'foodforlife_builder' ) ) {
			return;
		}

		$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'foodforlife-people-view', FOODFORLIFE_ADDONS_URL . 'modules/people-view-fake/assets/people-view-fake' . $debug . '.css', array(), FOODFORLIFE_ADDONS_VER );
		wp_enqueue_script('foodforlife-people-view', FOODFORLIFE_ADDONS_URL . 'modules/people-view-fake/assets/people-view-fake' . $debug . '.js',  array('jquery'), FOODFORLIFE_ADDONS_VER, array('strategy' => 'defer') );
		$datas = array(
			'interval' => get_option( 'foodforlife_people_view_fake_interval', 6000 ),
			'from'     => get_option( 'foodforlife_people_view_fake_random_numbers_from', 1 ),
			'to'       => get_option( 'foodforlife_people_view_fake_random_numbers_to', 100 ),
		);

		wp_localize_script(
			'foodforlife-people-view', 'foodforlifePVF', $datas
		);
	}

	/**
	 * Get people view fake
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function people_view_fake() {
		$from 	= get_option( 'foodforlife_people_view_fake_random_numbers_from', 1 );
		$to   	= get_option( 'foodforlife_people_view_fake_random_numbers_to', 100 );
		?>
			<div class="foodforlife-people-view d-flex align-items-center gap-10">
				<span class="foodforlife-people-view__icon">
					<?php echo \FoodForLife\Addons\Helper::get_svg( 'eye' ); ?>
				</span>
				<span class="foodforlife-people-view__text text-dark"><span class="foodforlife-people-view__numbers"><?php echo rand( $from, $to ); ?></span><?php echo apply_filters( 'foodforlife_people_view_fake_text', esc_html__( 'people are viewing this right now', 'foodforlife-addons' ) );?></span>
			</div>
		<?php
	}
}