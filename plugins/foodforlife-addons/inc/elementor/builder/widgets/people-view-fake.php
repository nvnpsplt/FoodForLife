<?php
namespace FoodForLife\Addons\Elementor\Builder\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class People_View_Fake extends Widget_Base {
	use \FoodForLife\Addons\Elementor\Builder\Traits\Product_Id_Trait;

	public function get_name() {
		return 'foodforlife-people-view-fake';
	}

	public function get_title() {
		return esc_html__( '[FoodForLife] Counter Live Visitors', 'foodforlife-addons' );
	}

	public function get_icon() {
		return 'eicon-woocommerce';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'people', 'view', 'product' ];
	}

	public function get_categories() {
		return [ 'foodforlife-addons-product' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'People are viewing this right now', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_number',
			[
				'label'     => esc_html__( 'Number', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .foodforlife-people-view__numbers',
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-people-view__numbers' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'number_background_color',
			[
				'label' => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-people-view__numbers' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'number_padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-people-view__numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-people-view__numbers' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'number_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-people-view__numbers' => '--ffl-rounded-xs: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-people-view__numbers' => '--ffl-rounded-xs: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'number_spacing',
			[
				'label' => __( 'Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-people-view__numbers' => 'margin-inline-end: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-people-view__numbers' => 'margin-inline-start: {{SIZE}}{{UNIT}}; margin-inline-end: 0;',
				],
			]
		);

		$this->add_control(
			'heading_text',
			[
				'label'     => esc_html__( 'Text', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .foodforlife-people-view__text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-people-view__text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		global $product;

		$product = $this->get_product();

		if ( ! $product ) {
			return;
		}

		add_filter( 'foodforlife_people_view_fake_text', [ $this, 'foodforlife_get_text' ] );
		do_action('foodforlife_people_view_fake_elementor');
		remove_filter( 'foodforlife_people_view_fake_text', [ $this, 'foodforlife_get_text' ] );
	}

	public function foodforlife_get_text( $text ) {
		$settings = $this->get_settings_for_display();

		if( ! empty( $settings['text'] ) ) {
			return esc_html( $settings['text'] );
		}

		return $text;
    }
}
