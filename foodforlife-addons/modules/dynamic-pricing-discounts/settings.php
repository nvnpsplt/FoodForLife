<?php

namespace FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts;

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
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'dynamic_pricing_discounts_section' ), 20, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'dynamic_pricing_discounts_settings' ), 20, 2 );
	}

	/**
	 * Dynamic Pricing & Discounts section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function dynamic_pricing_discounts_section( $sections ) {
		$sections['foodforlife_dynamic_pricing_discounts'] = esc_html__( 'Dynamic Pricing & Discounts', 'foodforlife-addons' );

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
	public function dynamic_pricing_discounts_settings( $settings, $section ) {
		if ( 'foodforlife_dynamic_pricing_discounts' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_dynamic_pricing_discounts_options',
				'title' => esc_html__( 'Dynamic Pricing & Discounts', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_dynamic_pricing_discounts',
				'title'   => esc_html__( 'Dynamic Pricing & Discounts', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable Dynamic Pricing & Discounts', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'no',
			);

			if( apply_filters( 'foodforlife_dynamic_pricing_discounts_position_elementor', true ) ) {
				$settings[] = array(
					'name'    => esc_html__( 'Position', 'foodforlife-addons' ),
					'id'      => 'foodforlife_dynamic_pricing_discounts_position',
					'default' => 'above',
					'class'   => 'wc-enhanced-select dynamic-pricing-discount-position',
					'type'    => 'select',
					'options' => array(
						'above' => esc_html__( 'Above Add to Cart button', 'foodforlife-addons' ),
						'below' => esc_html__( 'Below Add to Cart button', 'foodforlife-addons' ),
					),
				);
			}

			$settings[] = array(
				'id'   => 'foodforlife_dynamic_pricing_discounts_options',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}

}