<?php

namespace FoodForLife\Addons\Modules\Checkout_Limit;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Settings  {

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
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'checkout_limit_section' ), 20, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'checkout_limit_settings' ), 20, 2 );
	}

	/**
	 * Free Shipping Bar section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function checkout_limit_section( $sections ) {
		$sections['checkout_limit'] = esc_html__( 'Checkout Countdown', 'foodforlife-addons' );

		return $sections;
	}

	/**
	 * Adds settings to product display settings
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings
	 * @param string $section
	 *
	 * @return array
	 */
	public function checkout_limit_settings( $settings, $section ) {
		if ( 'checkout_limit' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_checkout_limit_options',
				'title' => esc_html__( 'Checkout Countdown', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_checkout_limit',
				'title'   => esc_html__( 'Checkout Countdown', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable Checkout Countdown', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'no',
			);

			$settings[] = array(
				'name'    => esc_html__( 'Countdown Time (seconds)', 'foodforlife-addons' ),
				'id'      => 'foodforlife_checkout_limit_time',
				'type'    => 'number',
				'class'   => 'foodforlife_checkout_limit_time',
				'custom_attributes' => array(
					'min'  => 0,
				),
				'default' => '120',
			);

			$settings[] = array(
				'name'    => esc_html__( 'Action on Countdown Completion', 'foodforlife-addons' ),
				'id'      => 'foodforlife_checkout_limit_action',
				'default' => '',
				'class'   => 'foodforlife_checkout_limit_action wc-enhanced-select',
				'type'    => 'select',
				'options' => array(
					''           => esc_html__( 'No Action', 'foodforlife-addons' ),
					'empty_cart' => esc_html__( 'Empty Cart', 'foodforlife-addons' ),
				),
			);

			$settings[] = array(
				'name'    => esc_html__( 'Wait time before empty cart (seconds)', 'foodforlife-addons' ),
				'id'      => 'foodforlife_checkout_limit_empty_cart_time',
				'type'    => 'number',
				'class'   => 'foodforlife_checkout_limit_empty_cart_time',
				'custom_attributes' => array(
					'min'  => 3,
					'step' => 1,
				),
				'default' => '3',
			);

			$settings[] = array(
				'name'    => esc_html__( 'Display On', 'foodforlife-addons' ),
				'id'      => 'foodforlife_checkout_limit_display_on',
				'type'    => 'multiselect',
				'class'   => 'wc-enhanced-select foodforlife_checkout_limit_display_on',
				'options' => array(
					'minicart' => esc_html__( 'Mini Cart', 'foodforlife-addons' ),
					'cart'     => esc_html__( 'Cart Page', 'foodforlife-addons' ),
					'checkout' => esc_html__( 'Checkout Page', 'foodforlife-addons' ),
				),
				'default' => array( 'minicart', 'cart' ),
			);

			$settings[] = array(
				'name'    => esc_html__( 'Mini Cart Countdown Text', 'foodforlife-addons' ),
				'id'      => 'foodforlife_checkout_limit_countdown_text_mini_cart',
				'type'    => 'textarea',
				'class'   => 'foodforlife_checkout_limit_countdown_text_mini_cart',
				'custom_attributes' => array(
					'rows' => 3,
				),
				'default' => '',
				'placeholder' => esc_html__( 'Products are limited, checkout within {time}', 'foodforlife-addons' ),
			);

			$settings[] = array(
				'name'    => esc_html__( 'Cart Page Countdown Text', 'foodforlife-addons' ),
				'id'      => 'foodforlife_checkout_limit_countdown_text_cart_page',
				'type'    => 'textarea',
				'class'   => 'foodforlife_checkout_limit_countdown_text_cart_page',
				'custom_attributes' => array(
					'rows' => 3,
				),
				'default' => '',
				'placeholder' => esc_html__( 'Products are limited, checkout within {time}', 'foodforlife-addons' ),
			);

			$settings[] = array(
				'name'    => esc_html__( 'Checkout Page Countdown Text', 'foodforlife-addons' ),
				'id'      => 'foodforlife_checkout_limit_countdown_text_checkout_page',
				'type'    => 'textarea',
				'class'   => 'foodforlife_checkout_limit_countdown_text_checkout_page',
				'custom_attributes' => array(
					'rows' => 3,
				),
				'default' => '',
				'placeholder' => esc_html__( 'Products are limited, checkout within {time}', 'foodforlife-addons' ),
			);

			$settings[] = array(
				'id'   => 'foodforlife_checkout_limit_options',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}
}