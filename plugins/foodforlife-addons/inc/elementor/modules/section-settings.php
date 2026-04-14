<?php
namespace FoodForLife\Addons\Elementor\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Base\Module;
use Elementor\Controls_Manager;

class Section_Settings extends Module {
	/**
	 * Get module name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'section-settings';
	}

	/**
	 * Module constructor.
	 */
	public function __construct() {
		add_action( 'elementor/element/container/section_layout_container/after_section_end', [ $this, 'register_controls' ] );
		add_action( 'elementor/element/container/section_layout_container/before_section_end', [ $this, 'add_new_controls' ] );
	}


	/**
	 * @param $element    Controls_Stack
	 */
	public function add_new_controls( $element ) {

	}

	/**
	 * @param $element    Controls_Stack
	 */
	public function register_controls( $element ) {
		$element->start_controls_section(
			'section_foodforlife_container_spacing',
			[
				'label' => __( 'Parent Container', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
			]
		);

		$element->add_responsive_control(
			'foodforlife_container_spacing',
			[
				'label' => esc_html__( 'Content Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'description' => esc_html__( 'Sets the default spacing left and right of the content area. Default is 50px', 'foodforlife-addons' ),
				'selectors' => [
					'{{WRAPPER}} .e-con-inner' => '--ffl-container-spacing: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$element->end_controls_section();

		$element->start_controls_section(
			'section_responsive_layout_container',
			[
				'label' => __( 'Responsive Columns', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
				'condition'   => [
					'container_type' => 'flex',
				],
			]
		);

		$element->add_control(
			'tablet_column_alignment',
			[
				'label' => esc_html__( 'Tablet Columns', 'foodforlife-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' 		=> esc_html__( 'Default', 'foodforlife-addons' ),
					'column_xxxs' 	=> esc_html__( '4.5 columns', 'foodforlife-addons' ),
					'column_xxs' 	=> esc_html__( '3.5 columns', 'foodforlife-addons' ),
					'column_xs' 	=> esc_html__( '2.5 columns', 'foodforlife-addons' ),
					'column_sm' 	=> esc_html__( '2 columns', 'foodforlife-addons' ),
					'column_md' 	=> esc_html__( '1.5 columns', 'foodforlife-addons' ),
					'column_lg' 	=> esc_html__( '1 column', 'foodforlife-addons' ),
				],
				'default' => 'default',
				'selectors_dictionary' => [
					'column_xxxs' => '22',
					'column_xxs' => '30',
					'column_xs'  => '40',
					'column_sm'  => '50',
					'column_md'  => '75',
					'column_lg'  => '100',
				],
				'prefix_class' => 'foodforlife-responsive-column foodforlife-tablet-column--',
				'description' => esc_html__('This control will affect the parent container only.', 'foodforlife-addons'),
				'condition'   => [
					'container_type' => 'flex',
				],
			]
		);

		$element->add_control(
			'mobile_column_alignment',
			[
				'label' => esc_html__( 'Mobile Columns', 'foodforlife-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' 		=> esc_html__( 'Default', 'foodforlife-addons' ),
					'column_xxs' 	=> esc_html__( '3.5 columns', 'foodforlife-addons' ),
					'column_xs' 	=> esc_html__( '2.5 columns', 'foodforlife-addons' ),
					'column_sm' 	=> esc_html__( '2 columns', 'foodforlife-addons' ),
					'column_md' 	=> esc_html__( '1.5 columns', 'foodforlife-addons' ),
					'column_lg' 	=> esc_html__( '1 column', 'foodforlife-addons' ),
				],
				'default' => 'default',
				'selectors_dictionary' => [
					'column_xxs' => '30',
					'column_xs'  => '40',
					'column_sm'  => '50',
					'column_md'  => '75',
					'column_lg'  => '100',
				],
				'prefix_class' => 'foodforlife-responsive-column foodforlife-mobile-column--',
				'description' => esc_html__('This control will affect the parent container only.', 'foodforlife-addons'),
				'condition'   => [
					'container_type' => 'flex',
				],
			]
		);

		$element->end_controls_section();

		if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			$element->start_controls_section(
				'section_foodforlife_sticky_motion',
				[
					'label' => __( 'Sticky Motion', 'foodforlife-addons' ),
					'tab' => Controls_Manager::TAB_LAYOUT,
				]
			);

			$element->add_responsive_control(
				'sticky_motion',
				[
					'label' => esc_html__( 'Sticky', 'foodforlife-addons' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'var(--position)' => esc_html__( 'None', 'foodforlife-addons' ),
						'sticky'          => esc_html__( 'Sticky', 'foodforlife-addons' ),
					],
					'default' => 'var(--position)',
					'selectors' => [
						'{{WRAPPER}}.foodforlife-motion--sticky' => 'position: {{VALUE}};',
					],
					'prefix_class' => 'foodforlife-responsive-column foodforlife-motion--',
					'description' => esc_html__('This control will affect the parent container only.', 'foodforlife-addons'),
				]
			);

			$element->add_responsive_control(
				'sticky_motion_spacing',
				[
					'label' => esc_html__( 'Top', 'foodforlife-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em'],
					'default' => [
						'size' => 0,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}}.foodforlife-motion--sticky' => 'top: {{SIZE}}{{UNIT}}',
					],
					'condition'   => [
						'sticky_motion' => 'sticky',
					],
				]
			);

			$element->end_controls_section();
		}
	}
}