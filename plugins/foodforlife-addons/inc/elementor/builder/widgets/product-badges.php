<?php
namespace FoodForLife\Addons\Elementor\Builder\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Product_Badges extends Widget_Base {
	use \FoodForLife\Addons\Elementor\Builder\Traits\Product_Id_Trait;

	public function get_name() {
		return 'foodforlife-product-badges';
	}

	public function get_title() {
		return esc_html__( '[FoodForLife] Product Badges', 'foodforlife-addons' );
	}

	public function get_icon() {
		return 'eicon-woocommerce';
	}

	public function get_categories() {
		return ['foodforlife-addons-product'];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'badges', 'product' ];
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
			'section_badges',
			[
				'label' => esc_html__( 'Product Badges', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'badges_sale',
			[
				'label'       => esc_html__( 'Sale Badge', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'badges_sale_type',
			[
				'label' => esc_html__( 'Type', 'foodforlife-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'percent',
				'options' => [
					'percent' => esc_html__( 'Percentage', 'foodforlife-addons' ),
					'text'    => esc_html__( 'Text', 'foodforlife-addons' ),
				],
				'condition' => [
					'badges_sale' => 'yes'
				]
			]
		);

		$this->add_control(
			'badges_sale_text',
			[
				'label' => __( 'Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Sale', 'foodforlife' ),
				'label_block' => true,
				'condition' => [
					'badges_sale' => 'yes',
					'badges_sale_type' => 'text',
				]
			]
		);

		$this->add_control(
			'badges_new',
			[
				'label'       => esc_html__( 'New Badge', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'badges_new_text',
			[
				'label' => __( 'Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'New', 'foodforlife' ),
				'label_block' => true,
				'condition' => [
					'badges_new' => 'yes',
				]
			]
		);

		$this->add_control(
			'badges_featured',
			[
				'label'       => esc_html__( 'Featured Badge', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'badges_featured_text',
			[
				'label' => __( 'Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Hot', 'foodforlife' ),
				'label_block' => true,
				'condition' => [
					'badges_featured' => 'yes',
				]
			]
		);

		$this->add_control(
			'badges_stock',
			[
				'label'       => esc_html__( 'Stock Badge', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'badges_soldout_text',
			[
				'label' => __( 'Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Sold out', 'foodforlife' ),
				'label_block' => true,
				'condition' => [
					'badges_stock' => 'yes',
				]
			]
		);

		$this->add_control(
			'badges_pre_order',
			[
				'label'       => esc_html__( 'Pre Order Badge', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Product Badges', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label' => __( 'Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .woocommerce-badges--single .woocommerce-badge' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge' => '--ffl-rounded-xs: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .woocommerce-badges--single .woocommerce-badge' => '--ffl-rounded-xs: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sale_heading',
			[
				'label' => esc_html__( 'Sale', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sale_color',
			[
				'label' => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.onsale' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sale_background_color',
			[
				'label' => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.onsale' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sale_border_color',
			[
				'label' => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.onsale' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'new_heading',
			[
				'label' => esc_html__( 'New', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'new_color',
			[
				'label' => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.new' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'new_background_color',
			[
				'label' => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.new' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'new_border_color',
			[
				'label' => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.new' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_heading',
			[
				'label' => esc_html__( 'Featured', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'featured_color',
			[
				'label' => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.featured' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_background_color',
			[
				'label' => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.featured' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'featured_border_color',
			[
				'label' => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.featured' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'in_stock_heading',
			[
				'label' => esc_html__( 'In Stock', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'in_stock_color',
			[
				'label' => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.in-stock' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'in_stock_background_color',
			[
				'label' => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.in-stock' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'in_stock_border_color',
			[
				'label' => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.in-stock' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sold_out_heading',
			[
				'label' => esc_html__( 'Sold Out', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sold_out_color',
			[
				'label' => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.sold-out' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sold_out_background_color',
			[
				'label' => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.sold-out' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sold_out_border_color',
			[
				'label' => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.sold-out' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pre_order_heading',
			[
				'label' => esc_html__( 'Pre-Order', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pre_order_color',
			[
				'label' => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.pre-order' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pre_order_background_color',
			[
				'label' => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.pre-order' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pre_order_border_color',
			[
				'label' => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-badges--single .woocommerce-badge.pre-order' => 'border-color: {{VALUE}};',
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

		if( ! class_exists( '\FoodForLife\WooCommerce\Badges' ) ) {
			return;
		}

		$args = $this->get_badges_args( $settings );

		if( $product->is_type('variable') ) {
			add_filter( 'woocommerce_available_variation', array( $this, 'data_variation_badges' ), 10, 3 );
		}

		if ( \FoodForLife\Addons\Elementor\Builder\Helper::is_elementor_editor_mode() ) {
			$this->get_badges();
		} else {
			if( ! empty( \FoodForLife\WooCommerce\Badges::get_badges( $product, $args ) ) ) {
				\FoodForLife\WooCommerce\Badges::single_badges( $product, $args );
			}
		}
	}

	public function get_badges_args( $settings ) {
		$args = [
			'badges_sale'           => $settings['badges_sale'],
			'badges_sale_type'      => $settings['badges_sale_type'],
			'badges_new'            => $settings['badges_new'],
			'badges_featured'       => $settings['badges_featured'],
			'badges_in_stock'		=> false,
			'badges_soldout'		=> false,
			'badges_pre_order'		=> false,
			'is_single'	            => true,
			'badges_sale_countdown' => false,
		];

		if( ! empty($settings['badges_sale_text'] ) ) {
			$args['badges_sale_text'] = $settings['badges_sale_text'];
		}

		if( ! empty($settings['badges_new_text'] ) ) {
			$args['badges_new_text'] = $settings['badges_new_text'];
		}

		if( ! empty($settings['badges_featured_text'] ) ) {
			$args['badges_featured_text'] = $settings['badges_featured_text'];
		}

		if( ! empty( $settings['badges_stock'] ) ) {
			$args['badges_in_stock'] = true;
			$args['badges_soldout'] = true;

			if( ! empty($settings['badges_soldout_text'] ) ) {
				$args['badges_soldout_text'] = $settings['badges_soldout_text'];
			}
		}

		if( ! empty( $settings['badges_pre_order'] ) ) {
			$args['badges_pre_order'] = true;
		}

		return $args;
	}

	public function data_variation_badges( $data, $parent, $variation ) {
		$settings = $this->get_settings_for_display();
		$args = $this->get_badges_args( $settings );
		ob_start();
		\FoodForLife\WooCommerce\Badges::single_badges( $variation, $args );
		$badges_html = ob_get_clean();
		$data['badges_html'] = esc_html($badges_html);
		return $data;
	}

	public function get_badges() {
		$settings = $this->get_settings_for_display();
		?>
		<span class="woocommerce-badges woocommerce-badges--single">
			<?php if( $settings['badges_sale'] ) : ?>
				<span class="onsale woocommerce-badge">
					<?php if( $settings['badges_sale_type'] == 'text' ) : ?>
						<?php
							if( ! empty($settings['badges_sale_text'] ) ) {
								echo esc_html( $settings['badges_sale_text'] );
							} else {
								esc_html_e( 'Sale', 'foodforlife' );
							}
						?>
					<?php else : ?>
						<?php esc_html_e( '20%', 'foodforlife' ); ?>
					<?php endif; ?>
				</span>
			<?php endif; ?>
			<?php if( $settings['badges_new'] ) : ?>
				<span class="new woocommerce-badge">
					<?php
						if( ! empty($settings['badges_new_text'] ) ) {
							echo esc_html( $settings['badges_new_text'] );
						} else {
							esc_html_e( 'New', 'foodforlife' );
						}
					?>
				</span>
			<?php endif; ?>
			<?php if( $settings['badges_featured'] ) : ?>
				<span class="featured woocommerce-badge">
					<?php
						if( ! empty($settings['badges_featured_text'] ) ) {
							echo esc_html( $settings['badges_featured_text'] );
						} else {
							esc_html_e( 'Hot', 'foodforlife' );
						}
					?>
				</span>
			<?php endif; ?>
			<?php if( $settings['badges_stock'] ) : ?>
				<div class="stock-badge"><p class="stock in-stock woocommerce-badge"><?php esc_html_e( 'In Stock', 'foodforlife' ); ?></p></div>
				<div class="stock-badge"><p class="stock sold-out woocommerce-badge">
					<?php
						if( ! empty($settings['badges_soldout_text'] ) ) {
							echo esc_html( $settings['badges_soldout_text'] );
						} else {
							esc_html_e( 'Sold out', 'foodforlife' );
						}
					?>
				</p></div>
			<?php endif; ?>
			<?php if( $settings['badges_pre_order'] ) : ?>
				<div class="stock-badge"><p class="pre-order woocommerce-badge"><?php esc_html_e( 'Pre-Order', 'foodforlife' ); ?></p></div>
			<?php endif; ?>
		</span>
		<?php
	}
}