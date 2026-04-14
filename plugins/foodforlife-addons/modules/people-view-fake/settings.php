<?php

namespace FoodForLife\Addons\Modules\People_View_Fake;

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
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'people_view_fake_section' ), 20, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'people_view_fake_settings' ), 20, 2 );
	}

	/**
	 * Free Shipping Bar section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function people_view_fake_section( $sections ) {
		$sections['people_view_fake'] = esc_html__( 'Counter live visitors', 'foodforlife-addons' );

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
	public function people_view_fake_settings( $settings, $section ) {
		if ( 'people_view_fake' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_people_view_fake_options',
				'title' => esc_html__( 'Counter live visitors', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_people_view_fake',
				'title'   => esc_html__( 'Counter live visitors', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable Counter live visitors', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'no',
			);

			$settings[] = array(
				'name'    => esc_html__( 'How often to update the number of users in the product? (milliseconds)', 'foodforlife-addons' ),
				'id'      => 'foodforlife_people_view_fake_interval',
				'type'    => 'number',
				'custom_attributes' => array(
					'min'  => 0,
				),
				'default' => '6000',
			);

			$settings[] = array(
				'name'    => esc_html__( 'Random Numbers From', 'foodforlife-addons' ),
				'id'      => 'foodforlife_people_view_fake_random_numbers_from',
				'type'    => 'number',
				'custom_attributes' => array(
					'min'  => 0,
				),
				'default' => '1',
			);

			$settings[] = array(
				'name'    => esc_html__( 'Random Numbers To', 'foodforlife-addons' ),
				'id'      => 'foodforlife_people_view_fake_random_numbers_to',
				'type'    => 'number',
				'custom_attributes' => array(
					'min'  => 1,
				),
				'default' => '100',
			);

			$settings[] = array(
				'id'   => 'foodforlife_people_view_fake_options',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}
}