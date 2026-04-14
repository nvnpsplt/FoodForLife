<?php
namespace FoodForLife\Addons\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use FoodForLife\Addons\Elementor\Base\Products_Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Look Book Products
 */
class Lookbook_Products extends Products_Widget_Base {
	use \FoodForLife\Addons\Elementor\Base\Button_Base;

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-lookbook-products';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( '[FoodForLife] Lookbook Products', 'foodforlife-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-hotspot';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['foodforlife-addons'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'lookbook', 'products', 'product', 'foodforlife-addons' ];
	}

	public function get_script_depends() {
		return [
			'foodforlife-products-carousel-widget',
			'imagesLoaded',
		];
	}

	/**
	 * Styles
	 *
	 * @return void
	 */
	public function get_style_depends() {
		return [
			'foodforlife-elementor-css'
		];
	}

	/**
	 * Register the widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls() {
	   	$this->start_controls_section(
			'section_lookbook',
			[ 'label' => __( 'Lookbook', 'foodforlife-addons' ) ]
		);

		$this->add_responsive_control(
			'image',
			[
				'label'    => __( 'Image', 'foodforlife-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => wc_placeholder_img_src(),
				],
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label' => __( 'Sub Title', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is the sub title', 'foodforlife-addons' ),
				'placeholder' => __( 'Enter your sub title', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is the title', 'foodforlife-addons' ),
				'placeholder' => __( 'Enter your title', 'foodforlife-addons' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'product_ids',
			[
				'label'       => esc_html__( 'Product', 'foodforlife-addons' ),
				'placeholder' => esc_html__( 'Click here and start typing...', 'foodforlife-addons' ),
				'type'        => 'foodforlife-autocomplete',
				'default'     => '',
				'label_block' => true,
				'multiple'    => false,
				'source'      => 'product',
				'sortable'    => true,
			]
		);

        $repeater->add_responsive_control(
            'product_items_position_x',
            [
                'label'      => esc_html__( 'Point Position X', 'foodforlife-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 30,
                ],
                'size_units' => [ '%', 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'product_items_position_y',
            [
                'label'      => esc_html__( 'Point Position Y', 'foodforlife-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 30,
                ],
                'size_units' => [ '%', 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'lookbook_products',
			[
				'label' => esc_html__( 'Products', 'foodforlife-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'lookbook_image_heading',
			[
				'label' => esc_html__( 'Image Product', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->register_aspect_ratio_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_products_carousel',
			[
				'label' => __( 'Carousel Settings', 'foodforlife-addons' ),
			]
		);

		$controls = [
			'slides_to_show'   => 2,
			'slides_to_scroll' => 1,
			'space_between'    => 20,
			'navigation'       => '',
			'autoplay'         => '',
			'autoplay_speed'   => 3000,
			'pause_on_hover'   => 'yes',
			'animation_speed'  => 800,
			'infinite'         => '',
		];

		$this->register_carousel_controls( $controls );

		$this->add_control(
			'reveal_on_scroll',
			[
				'label'       => __( 'Reveal on Scroll ( Mobile )', 'foodforlife-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'foodforlife-addons' ),
				'label_on'  => __( 'On', 'foodforlife-addons' ),
				'frontend_available' => true,
				'prefix_class' => 'swiper-reveal-on-scroll--',
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'section_style_content',
			[
				'label'     => __( 'Content', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'gap',
			[
				'label'     => __( 'Gap', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-products' => '--col-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_lookbook_heading',
			[
				'label' => esc_html__( 'Image', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_aspect_ratio_type',
			[
				'label'   => esc_html__( 'Aspect Ratio', 'foodforlife-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''       => esc_html__( 'Default', 'foodforlife-addons' ),
					'square' => esc_html__( 'Square', 'foodforlife-addons' ),
					'custom' => esc_html__( 'Custom', 'foodforlife-addons' ),
				],
				'default' => '',
			]
		);

        $this->add_responsive_control(
			'image_aspect_ratio',
			[
				'label'       => esc_html__( 'Aspect ratio (Eg: 3:4)', 'foodforlife-addons' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Images will be cropped to aspect ratio', 'foodforlife-addons' ),
				'default'     => '',
				'label_block' => false,
                'condition' => [ 'image_aspect_ratio_type' => 'custom' ],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'     => __( 'Width', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-products' => '--col-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'     => __( 'Height', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'vh', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-products__image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumbnail_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-lookbook-products__image' => 'border-start-start-radius: {{TOP}}{{UNIT}}; border-start-end-radius: {{RIGHT}}{{UNIT}}; border-end-end-radius: {{BOTTOM}}{{UNIT}}; border-end-start-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'summary_heading',
			[
				'label' => esc_html__( 'Summary', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'summary_background_color',
			[
				'label'      => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-lookbook-products__summary' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'summary_padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-lookbook-products__summary' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'summary_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-lookbook-products__summary' => 'border-start-start-radius: {{TOP}}{{UNIT}}; border-start-end-radius: {{RIGHT}}{{UNIT}}; border-end-end-radius: {{BOTTOM}}{{UNIT}}; border-end-start-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'subtitle_heading',
			[
				'label' => esc_html__( 'Subtitle', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'      => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-lookbook-products__subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .foodforlife-lookbook-products__subtitle',
			]
		);

		$this->add_responsive_control(
			'subtitle_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-products__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Title', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'      => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-lookbook-products__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .foodforlife-lookbook-products__title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-products__title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'product_heading',
			[
				'label' => esc_html__( 'Product', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'type_product_on_mobile',
			[
				'label'   => esc_html__( 'Type Product on Mobile', 'foodforlife-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'foodforlife-addons' ),
					'horizontal' => esc_html__( 'Horizontal', 'foodforlife-addons' ),
				],
			]
		);

		$this->add_responsive_control(
			'product_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-lookbook-products__products.product--horizontal .product-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-lookbook-products__products.product--horizontal .product-inner' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'product_border',
				'selector' => '{{WRAPPER}} .foodforlife-lookbook-products__products.product--horizontal .product-inner',
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

		$this->add_responsive_control(
			'product_image_padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} ul.products li.product .product-thumbnail' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'product_price_typography',
				'selector' => '{{WRAPPER}} .price',
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

		$this->add_control(
			'product_attribute_heading',
			[
				'label' => esc_html__( 'Product Attribute', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'product_attribute_border_hover_color',
			[
				'label'     => __( 'Border Hover Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ul.products li.product .product-variation-items .product-variation-item:hover,
					ul.products li.product .product-variation-items .product-variation-item.selected' => '--ffl-border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_attribute_border_color',
			[
				'label'     => __( 'Border Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ul.products li.product .product-variation-items .product-variation-item' => '--ffl-border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_carousel',
			[
				'label' => esc_html__( 'Carousel Settings', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_carousel_style_controls();

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$product_ids = [];
		$hotspots = [];

		$col = $settings['slides_to_show'];
		$col_tablet = ! empty( $settings['slides_to_show_tablet'] ) ? $settings['slides_to_show_tablet'] : $col;
		$col_mobile = ! empty( $settings['slides_to_show_mobile'] ) ? $settings['slides_to_show_mobile'] : $col_tablet;

		if( empty( $settings['lookbook_products'] ) ) {
			return;
		}

		foreach( $settings['lookbook_products'] as $key => $hotspot ) {
			$product = wc_get_product( $hotspot['product_ids'] );
			if( ! empty( $product ) && $product->is_visible() ) {
				$product_ids[] = $hotspot['product_ids'];

				if( ! empty( $hotspot['product_ids'] ) ) {
					$hotspots[] = sprintf('<div class="foodforlife-lookbook-products__hotspot d-inline-flex align-items-center justify-content-center foodforlife-button-hotspot--animation rounded-100 position-absolute z-2 elementor-repeater-item-%s" data-product_id="%s" data-index="%s">%s</div>',
									$hotspot['_id'],
									$hotspot['product_ids'],
									esc_attr( $key ),
									\FoodForLife\Addons\Helper::get_svg( 'icon-lookbook-plus', 'ui', [ 'class' => 'ffl-button ffl-button-light ffl-button-icon' ] )
								);
				}
			}
		}

		$this->add_render_attribute( 'wraper', 'class', [ 'foodforlife-lookbook-products', 'd-flex', 'align-items-md-center',  'flex-column', 'flex-md-row', 'w-100' ] );
		$this->add_render_attribute( 'thumbnail', 'class', [ 'foodforlife-lookbook-products__thumbnail', 'position-relative', 'column-md-custom' ] );
		$this->add_render_attribute( 'thumbnail', 'style', $this->render_aspect_ratio_style() );
		$this->add_render_attribute( 'image', 'class', [ 'foodforlife-lookbook-products__image', 'position-relative', 'foodforlife-elementor-video', 'ffl-ratio', 'ffl-image-rounded', 'overflow-hidden', 'h-100' ] );
		$this->add_render_attribute( 'image', 'style', $this->custom_render_aspect_ratio_style() );
		$this->add_render_attribute( 'summary', 'class', [ 'foodforlife-lookbook-products__summary', 'd-flex', 'flex-column', 'align-items-center', 'justify-content-center', 'column-md-custom-remaining', 'px-40', 'py-30', 'rounded-10' ] );

		$this->add_render_attribute( 'subtitle', 'class', [ 'foodforlife-lookbook-products__subtitle', 'text-center', 'fw-bold', 'fs-14', 'text-uppercase', 'text-dark' ] );
		$this->add_render_attribute( 'title', 'class', [ 'foodforlife-lookbook-products__title', 'text-center', 'heading-letter-spacing', 'mt-0', 'mb-33' ] );

		$this->add_render_attribute( 'products', 'class', [ 'foodforlife-lookbook-products__products', 'foodforlife-products-carousel', 'foodforlife-carousel--elementor', 'w-100', ! empty( $settings['type_product_on_mobile'] ) && 'horizontal' === $settings['type_product_on_mobile'] ? 'product--horizontal' : '' ] );
		$this->add_render_attribute( 'swiper', 'class', [ 'swiper', 'product-swiper--elementor' ] );
		$this->add_render_attribute( 'swiper', 'data-desktop', $col );
		$this->add_render_attribute( 'swiper', 'data-tablet', $col_tablet );
		$this->add_render_attribute( 'swiper', 'data-mobile', $col_mobile );
		$this->add_render_attribute( 'swiper', 'style', $this->render_space_between_style() );

		?>
		<div <?php echo $this->get_render_attribute_string( 'wraper' );?>>
			<div <?php echo $this->get_render_attribute_string( 'thumbnail' );?>>
				<div <?php echo $this->get_render_attribute_string( 'image' );?>>
					<?php if ( ! empty( $settings['image']['url'] ) ) :
							$args = [];
							$args['image'] = $settings['image'];
							$args['image_size'] = 'full';
							echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $args ) );
						?>
					<?php endif; ?>
				</div>
				<?php echo ! empty( $hotspots ) ? implode( '', $hotspots ) : ''; ?>
			</div>
			<div <?php echo $this->get_render_attribute_string( 'summary' );?>>
				<?php if( ! empty( $settings['sub_title'] ) ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'subtitle' );?>>
						<?php echo wp_kses_post( $settings['sub_title'] ); ?>
					</div>
				<?php endif; ?>
				<?php if( ! empty( $settings['title'] ) ) : ?>
					<h2 <?php echo $this->get_render_attribute_string( 'title' );?>>
						<?php echo wp_kses_post( $settings['title'] ); ?>
					</h2>
				<?php endif; ?>
				<?php if( ! empty( $product_ids ) ) : ?>
				<div <?php echo $this->get_render_attribute_string( 'products' );?>>
					<div <?php echo $this->get_render_attribute_string( 'swiper' );?>>
						<?php
							$args = [
								'type'    => 'custom_products',
								'ids'     => implode( ',', $product_ids ),
								'columns' => 2,
							];
							echo $this->render_products( $args );
							echo $this->render_arrows();
							echo $this->render_pagination();
						?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render aspect ratio style
	 *
	 * @return void
	 */
    protected function custom_render_aspect_ratio_style( $style = '', $aspect_ratio = 1, $mobile = false, $iframe = false ) {
		$settings = $this->get_settings_for_display();
	
		if ( ! empty( $settings['image_aspect_ratio_type'] ) ) {
			$ratio = $this->calculate_aspect_ratio(
				$settings['image_aspect_ratio_type'],
				$settings['image_aspect_ratio'] ?? ''
			);

			if ( $ratio ) {
				$aspect_ratio = $ratio;
				$style .= '--ffl-ratio-percent: ' . round( 100 / $aspect_ratio ) . '%;';
			}
		}

		if ( ! empty( $settings['image_aspect_ratio_type_tablet'] ) ) {
			$ratio = $this->calculate_aspect_ratio(
				$settings['image_aspect_ratio_type_tablet'],
				$settings['image_aspect_ratio_tablet'] ?? ''
			);

			if ( $ratio ) {
				$aspect_ratio = $ratio;
				$style .= '--ffl-ratio-percent-tablet: ' . round( 100 / $aspect_ratio ) . '%;';
			}
		}

		if ( ! empty( $settings['image_aspect_ratio_type_mobile'] ) ) {
			$ratio = $this->calculate_aspect_ratio(
				$settings['image_aspect_ratio_type_mobile'],
				$settings['image_aspect_ratio_mobile'] ?? ''
			);

			if ( $ratio ) {
				$aspect_ratio = $ratio;
				$style .= '--ffl-ratio-percent-mobile: ' . round( 100 / $aspect_ratio ) . '%;';
			}
		}


		if( $iframe ) {
			$width = 325;

			if ( $settings['image_aspect_ratio_type'] == 'custom' && ! empty( $settings['image_aspect_ratio'] ) ) {
				if ( ! is_numeric( $settings['image_aspect_ratio'] ) ) {
					$cropping_split = explode( ':', $settings['image_aspect_ratio'] );
					$width = max( 1, (float) current( $cropping_split ) );
				}
			}

			$style .= ' --ffl-ratio-iframe-min-width: ' . $width . 'px;';
			$style .= ' --ffl-item-iframe-width: ' . $width . ';';
			$style .= ' --ffl-item-iframe-width-origin: ' . $width . ';';
		}

		return $style;
    }

	protected function calculate_aspect_ratio( $type, $value = '' ) {
		switch ( $type ) {
			case 'vertical':
				return 0.7488888888888889;
			case 'horizontal':
				return 1.9857142857142858;
			case 'square':
				return 1;
			case 'custom':
				if ( ! empty( $value ) ) {
					if ( ! is_numeric( $value ) ) {
						$cropping_split = explode( ':', $value );
						$width = max( 1, (float) current( $cropping_split ) );
						$height = max( 1, (float) end( $cropping_split ) );
						return floatval( $width / $height );
					}
					return (float) $value;
				}
				break;
		}
		return null;
	}
}