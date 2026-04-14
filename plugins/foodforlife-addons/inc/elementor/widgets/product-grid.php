<?php

namespace FoodForLife\Addons\Elementor\Widgets;

use Elementor\Controls_Manager;
use FoodForLife\Addons\Elementor\Base\Products_Widget_Base;
use \FoodForLife\Addons\Woocommerce\Products_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Product Grid widget
 */
class Product_Grid extends Products_Widget_Base {
	use \FoodForLife\Addons\Elementor\Base\Button_Base;
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-product-grid';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( '[FoodForLife] Products Grid', 'foodforlife-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'foodforlife-addons' ];
	}

	/**
	 * Scripts
	 *
	 * @return void
	 */
	public function get_script_depends() {
		return [
			'foodforlife-product-grid-widget',
		];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->section_content();
		$this->section_style();
	}

	// Tab Content
	protected function section_content() {
		$this->start_controls_section(
			'section_products',
			[ 'label' => esc_html__( 'Products', 'foodforlife-addons' ) ]
		);

		$this->add_control(
			'products_divider',
			[
				'label' => esc_html__( 'Products', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control (
			'columns',
			[
				'label'     => esc_html__( 'Columns', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'1' => esc_html__( '1', 'foodforlife-addons' ),
					'2' => esc_html__( '2', 'foodforlife-addons' ),
					'3' => esc_html__( '3', 'foodforlife-addons' ),
					'4' => esc_html__( '4', 'foodforlife-addons' ),
					'5' => esc_html__( '5', 'foodforlife-addons' ),
					'6' => esc_html__( '6', 'foodforlife-addons' ),
				],
				'default'   => '4',
				'frontend_available' => true,
			]
		);

		$this->register_products_controls( 'all', true );

		$this->add_control(
			'hide_rating',
			[
				'label'     => esc_html__( 'Hide Rating', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Show', 'foodforlife-addons' ),
				'label_on'  => __( 'Hide', 'foodforlife-addons' ),
				'return_value' => 'none',
				'default'      => '',
				'selectors' => [
					'{{WRAPPER}} ul.products li.product .foodforlife-rating' => 'display: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __( 'Pagination', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'foodforlife-addons' ),
				'label_on'  => __( 'Show', 'foodforlife-addons' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label' => __( 'Pagination Type', 'foodforlife-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'infinite' => esc_attr__( 'Infinite Scroll', 'foodforlife-addons' ),
					'loadmore' => esc_attr__( 'Load More', 'foodforlife-addons' ),
				],
				'default' => 'loadmore',
				'condition'   => [
					'pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'pagination_text',
			[
				'label' => __( 'Pagination Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
	}

	// Tab Style
	protected function section_style() {
		$this->start_controls_section(
			'section_style_product',
			[
				'label' => esc_html__( 'Product', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'product_content_padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} ul.products li.product .product-inner' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'product_columns_heading',
			[
				'label' => esc_html__( 'Columns', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'product_columns_spacing',
			[
				'label'        => esc_html__( 'Columns Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} ul.products li.product' => 'padding-inline-start: {{SIZE}}{{UNIT}};padding-inline-end: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.products' => 'margin-inline-start: -{{SIZE}}{{UNIT}};margin-inline-end: -{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'product_rows_spacing',
			[
				'label'        => esc_html__( 'Rows Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} ul.products li.product' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'product_image_heading',
			[
				'label' => esc_html__( 'Product Image', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'product_image_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}' => '--ffl-image-rounded-product-card: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}}' => '--ffl-image-rounded-product-card: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'product_summary_heading',
			[
				'label' => esc_html__( 'Product Summary', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'foodforlife-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'foodforlife-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'foodforlife-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'foodforlife-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors'            => [
					'{{WRAPPER}} ul.products li.product .product-summary' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left'   => 'display: flex; flex-direction: column; text-align: left; align-items: flex-start;',
					'center' => 'display: flex; flex-direction: column; text-align: center; align-items: center;',
					'right'  => 'display: flex; flex-direction: column; text-align: right; align-items: flex-end;',
				],
			]
		);

		$this->add_responsive_control(
			'product_summary_padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} ul.products li.product .product-inner .product-summary' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'product_title_heading',
			[
				'label' => esc_html__( 'Product Title', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'product_title_typography',
				'selector' => '{{WRAPPER}} .woocommerce-loop-product__title a',
			]
		);

		$this->add_control(
			'product_title_color',
			[
				'label'     => __( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-loop-product__title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_title_hover_color',
			[
				'label'     => __( 'Hover Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-loop-product__title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_price_heading',
			[
				'label' => esc_html__( 'Product Price', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'product_price_color',
			[
				'label'     => __( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .price' => 'color: {{VALUE}};',
					'{{WRAPPER}} .price del' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ffl-price-unit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pagination',
			[
				'label' => esc_html__( 'Pagination', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pagination_spacing',
			[
				'label'        => esc_html__( 'Pagination Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->register_button_style_controls( '', 'woocommerce-pagination-button' );

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'foodforlife-product-grid' );

		if ( $settings['columns'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'foodforlife-product-columns--' . $settings['columns'] );
		}

		if ( $settings['columns_tablet'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'foodforlife-product-columns-tablet--' . $settings['columns_tablet'] );
		}

		if ( $settings['columns_mobile'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'foodforlife-product-columns-mobile--' . $settings['columns_mobile'] );
		}

		echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) .'>';
			printf( '%s', self::render_products() );
		echo '</div>';
	}
}