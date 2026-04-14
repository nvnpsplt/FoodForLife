<?php
namespace FoodForLife\Addons\Elementor\Builder\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Product_Countdown extends Widget_Base {
	use \FoodForLife\Addons\Elementor\Builder\Traits\Product_Id_Trait;

	public function get_name() {
		return 'foodforlife-product-countdown';
	}

	public function get_title() {
		return esc_html__( '[FoodForLife] Product Countdown', 'foodforlife-addons' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_categories() {
		return ['foodforlife-addons-product'];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'countdown', 'sale', 'product' ];
	}

	/**
	 * Get HTML wrapper class.
	 *
	 * Retrieve the widget container class. Can be used to override the
	 * container class for specific widgets.
	 *
	 * @since 2.0.9
	 * @access protected
	 */
	protected function get_html_wrapper_class() {
		return 'elementor-widget-' . $this->get_name() . ' entry-summary';
	}

	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'      => esc_html__( 'Layout', 'foodforlife-addons' ),
				'type'       => Controls_Manager::SELECT,
				'options'    => [
					'v1'  	=> esc_html__( 'Layout v1', 'foodforlife-addons' ),
					'v2'  => esc_html__( 'Layout v2', 'foodforlife-addons' ),
				],
				'default'    => 'v1',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'foodforlife-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Hurry Up! Sale ends in:', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'margin',
			[
				'label'      => __( 'Margin', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'.single-product.single-product-elementor div.product {{WRAPPER}} .ffl-countdown-single-product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl.single-product.single-product-elementor div.product {{WRAPPER}} .ffl-countdown-single-product' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'max_width',
			[
				'label' => __( 'Max Width', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .ffl-countdown-single-product' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ffl-countdown-single-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .ffl-countdown-single-product' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .ffl-countdown-single-product' => '--ffl-rounded-xs: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .ffl-countdown-single-product' => '--ffl-rounded-xs: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ffl-countdown-single-product' => 'border-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .ffl-product-countdown__text .ffl-countdown-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ffl-product-countdown__text .ffl-countdown-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_spacing',
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
					'{{WRAPPER}} .ffl-product-countdown__text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_icon',
			[
				'label'     => esc_html__( 'Icon', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Size', 'foodforlife-addons' ),
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
					'{{WRAPPER}} .ffl-product-countdown__text .foodforlife-svg-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ffl-product-countdown__text .foodforlife-svg-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
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
					'{{WRAPPER}} .ffl-product-countdown__text .foodforlife-svg-icon' => 'margin-inline-end: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .ffl-product-countdown__text .foodforlife-svg-icon' => 'margin-inline-start: {{SIZE}}{{UNIT}}; margin-inline-end: 0;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_timer_style',
			[
				'label' => esc_html__( 'Timer', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'timer_typography',
				'selector' => '{{WRAPPER}} .ffl-countdown-single-product .foodforlife-countdown',
			]
		);

		$this->add_control(
			'timer_color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ffl-countdown-single-product .foodforlife-countdown' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timer_spacing',
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
					'{{WRAPPER}} .ffl-countdown-single-product .foodforlife-countdown .divider' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_digits',
			[
				'label'     => esc_html__( 'Digits', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'digits_min_width',
			[
				'label' => __( 'Min Width', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .ffl-countdown-single-product .foodforlife-countdown .digits' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_days',
			[
				'label'     => esc_html__( 'Days', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'days_spacing',
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
					'{{WRAPPER}} .ffl-countdown-single-product .foodforlife-countdown .days .digits' => 'margin-inline-end: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .ffl-countdown-single-product .foodforlife-countdown .days .digits' => 'margin-inline-start: {{SIZE}}{{UNIT}}; margin-inline-end: 0;',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		global $product;
		$product = $this->get_product();

		if ( ! $product ) {
			return;
		}

		$icon = '<span class="ffl-countdown-icon"></span>';
		$_text = esc_html__( 'Hurry Up! Sale ends in:', 'foodforlife' );

		if( ! empty( $settings['icon']['value'] ) ) {
			$icon = '<span class="foodforlife-svg-icon ffl-countdown-icon__svg">' . \Elementor\Icons_Manager::try_get_icon_html( $settings['icon'], [ 'aria-hidden' => 'true' ] ) . '</span>';
		}

		if( ! empty( $settings['text'] ) ) {
			$_text = esc_html( $settings['text'] );
		}

		$sale = array(
			'weeks'   => esc_html__( 'weeks', 'foodforlife' ),
			'week'    => esc_html__( 'week', 'foodforlife' ),
			'days'    => esc_html__( 'days', 'foodforlife' ),
			'day'     => esc_html__( 'day', 'foodforlife' ),
			'hours'   => esc_html__( 'hours', 'foodforlife' ),
			'hour'    => esc_html__( 'hour', 'foodforlife' ),
			'minutes' => esc_html__( 'mins', 'foodforlife' ),
			'minute'  => esc_html__( 'min', 'foodforlife' ),
			'seconds' => esc_html__( 'secs', 'foodforlife' ),
			'second'  => esc_html__( 'sec', 'foodforlife' ),
		);

		$text = $icon . '<span class="ffl-countdown-text text-dark fw-semibold">' . $_text . '</span>';

		$classes = 'ffl-countdown-single-product d-flex flex-column align-items-start gap-5 mb-20 px-20 py-20 rounded-5';

		if( $settings['layout'] == 'v2' ) {
			$classes = 'ffl-countdown-single-product d-inline-flex flex-column align-items-start justify-content-center gap-7 mb-20 px-20 pt-15 pb-20 rounded-5 layout-v2';
		}

		if ( \FoodForLife\Addons\Elementor\Builder\Helper::is_elementor_editor_mode() ) {
			echo $this->get_countdown_html( $sale, $text, $classes );
		} else {
			if ( 'grouped' == $product->get_type() ) {
				return '';
			}

			if ( 'variable' == $product->get_type() ) {
				$classes .= ' hidden';
			}

			if ( $product->is_on_sale() ) {
				if( \FoodForLife\WooCommerce\Helper::get_product_countdown( $sale, $text, $classes ) ) {
					echo \FoodForLife\WooCommerce\Helper::get_product_countdown( $sale, $text, $classes );
				} else {
					if( $this->check_variation_countdown( $product, $sale, $text ) ) {
						echo '<div class="' . esc_attr( $classes ) . ' hidden"></div>';
					}
				}
			}
		}
	}

	public function get_countdown_html( $sale, $text, $classes ) {
		$current_date = strtotime( current_time( 'Y-m-d H:i:s' ) );
    	$expire = strtotime( '00:00 next monday', $current_date ) - $current_date;
		$days = floor($expire / (60 * 60 * 24));
		$hours = str_pad(floor(($expire % (60 * 60 * 24)) / (60 * 60)), 2, '0', STR_PAD_LEFT);
		$minutes = str_pad(floor(($expire % (60 * 60)) / (60)), 2, '0', STR_PAD_LEFT);
		$seconds = str_pad(floor($expire % 60), 2, '0', STR_PAD_LEFT);

		if ( $text ) {
			$text = '<div class="ffl-product-countdown__text">'. $text .'</div>';
		}

		return sprintf( '<div class="ffl-product-countdown %s">
							%s
							<div class="foodforlife-countdown" data-expire="%s" data-text="%s">
								<span class="days timer">
									<span class="digits">%s</span>
									<span class="text">%s</span>
									<span class="divider">:</span>
								</span>
								<span class="hours timer">
									<span class="digits">%s</span>
									<span class="text">%s</span>
									<span class="divider">:</span>
								</span>
								<span class="minutes timer">
									<span class="digits">%s</span>
									<span class="text">%s</span>
									<span class="divider">:</span>
								</span>
								<span class="seconds timer">
									<span class="digits">%s</span>
									<span class="text">%s</span>
								</span>
							</div>
						</div>',
					! empty( $classes ) ? esc_attr( $classes ) : '',
					$text,
					esc_attr( $expire ),
					esc_attr( wp_json_encode( $sale ) ),
					esc_html( $days ),
					$sale['days'],
					esc_html( $hours ),
					$sale['hours'],
					esc_html( $minutes ),
					$sale['minutes'],
					esc_html( $seconds ),
					$sale['seconds']
				);
	}

	public function check_variation_countdown( $product, $sale, $text ) {
		$bool = null;

		if( ! $product->is_type('variable') ) {
			return $bool;
		}

		$variation_ids = $product->get_visible_children();
		foreach( $variation_ids as $variation_id ) {
			$variation = wc_get_product( $variation_id );
			if ( $variation->is_on_sale() ) {
				$date_on_sale_to  = $variation->get_date_on_sale_to();
				$expire = '';
				if( ! empty( $date_on_sale_to ) ) {
					$now         = strtotime( current_time( 'Y-m-d H:i:s' ) );
					$expire_date = strtotime($date_on_sale_to);
					$expire      = ! empty( $expire_date ) ? $expire_date - $now : -1;
				}

				$expire = apply_filters( 'foodforlife_countdown_product_second', $expire );
				if( ! empty( $expire ) ) {
					$bool = true;
				}
			}
		}

		return $bool;
	}
}
