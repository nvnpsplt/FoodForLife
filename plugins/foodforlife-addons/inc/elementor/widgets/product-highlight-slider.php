<?php

namespace FoodForLife\Addons\Elementor\Widgets;
use FoodForLife\Addons\Elementor\Base\Products_Widget_Base;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Icon Box widget
 */
class Product_Highlight_Slider extends Products_Widget_Base {
	use \FoodForLife\Addons\Elementor\Base\Aspect_Ratio_Base;

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-product-highlight-slider';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( '[FoodForLife] Product Highlight Slider', 'foodforlife-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['foodforlife-addons'];
	}

	public function get_style_depends(): array {
		return [ 'foodforlife-elementor-css' ];
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
		$this->section_products_settings_controls();
	}

	// Tab Style
	protected function section_style() {
		$this->section_content_style_controls();
		$this->section_heading_style_controls();
		$this->section_carousel_style_controls();
	}

	protected function section_products_settings_controls() {
		$this->start_controls_section(
			'section_products',
			[ 'label' => esc_html__( 'Products', 'foodforlife-addons' ) ]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_responsive_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'foodforlife-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => wc_placeholder_img_src(),
				],
			]
		);

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

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Products', 'foodforlife-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
			]
		);

		$this->add_control(
			'heading_divider',
			[
				'label' => esc_html__( 'Heading', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label'       => esc_html__( 'Sub Title', 'foodforlife-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'This is sub title', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'foodforlife-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'This is title', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'This is description', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'carousel_divider',
			[
				'label' => esc_html__( 'Carousel', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'foodforlife-addons' ),
				'label_on'  => __( 'On', 'foodforlife-addons' ),
				'default'   => '',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'   => __( 'Autoplay Speed', 'foodforlife-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3000,
				'min'     => 100,
				'step'    => 100,
				'frontend_available' => true,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'   => __( 'Pause on Hover', 'foodforlife-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'foodforlife-addons' ),
				'label_on'  => __( 'On', 'foodforlife-addons' ),
				'default'   => 'yes',
				'frontend_available' => true,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label'       => __( 'Animation Speed', 'foodforlife-addons' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 800,
				'min'         => 100,
				'step'        => 50,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'       => __( 'Infinite Loop', 'foodforlife-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'foodforlife-addons' ),
				'label_on'  => __( 'On', 'foodforlife-addons' ),
				'default'   => '',
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}

	protected function section_content_style_controls() {
		// Content Style
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'gap',
			[
				'label' => __( 'Gap', 'foodforlife-addons' ),
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
					'{{WRAPPER}} .foodforlife-product-highlight-slider' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'image_heading',
			[
				'label' => esc_html__( 'Image', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_aspect_ratio_controls( [], [ 'aspect_ratio_type' => 'horizontal' ] );

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-product-highlight-slider__image' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-product-highlight-slider__image' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
			'product_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-highlight-slider__content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'product_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-product-highlight-slider__content' => 'border-start-start-radius: {{TOP}}{{UNIT}}; border-start-end-radius: {{RIGHT}}{{UNIT}}; border-end-end-radius: {{BOTTOM}}{{UNIT}}; border-end-start-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function section_heading_style_controls() {
		// Heading Tab Style
		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_heading_settings' );

		$this->start_controls_tab( 'heading_title', [ 'label' => esc_html__( 'Title', 'foodforlife-addons' ) ] );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_style_title',
				'selector' => '{{WRAPPER}} .foodforlife-product-highlight-slider__title',
			]
		);

		$this->add_control(
			'heading_style_title_color',
			[
				'label'     => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-highlight-slider__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_style_title_spacing',
			[
				'label'     => __( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-highlight-slider__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'heading_subtitle', [ 'label' => esc_html__( 'Sub Title', 'foodforlife-addons' ) ] );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_style_subtitle',
				'selector' => '{{WRAPPER}} foodforlife-product-highlight-slider__sub-title',
			]
		);

		$this->add_control(
			'heading_style_subtitle_color',
			[
				'label'     => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} foodforlife-product-highlight-slider__sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_style_subtitle_spacing',
			[
				'label'     => __( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-highlight-slider__sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'heading_description', [ 'label' => esc_html__( 'Description', 'foodforlife-addons' ) ] );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_style_description',
				'selector' => '{{WRAPPER}} foodforlife-product-highlight-slider__description',
			]
		);

		$this->add_control(
			'heading_style_description_color',
			[
				'label'     => esc_html__( 'Text Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} foodforlife-product-highlight-slider__description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_style_description_spacing',
			[
				'label'     => __( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-highlight-slider__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function section_carousel_style_controls() {
		$this->start_controls_section(
			'section_carousel_style',
			[
				'label' => __( 'Carousel Settings', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_carousel_dots_style_controls();

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', [ 'foodforlife-product-highlight-slider', 'd-flex', 'flex-column', 'flex-md-row', 'gap-20' ] );
		$this->add_render_attribute( 'image', 'class', [ 'foodforlife-product-highlight-slider__image', 'swiper', 'column-custom' ] );
		$this->add_render_attribute( 'image', 'style', $this->render_aspect_ratio_style() );
		$this->add_render_attribute( 'image-wrapper', 'class', [ 'foodforlife-product-highlight-slider__image-wrapper', 'swiper-wrapper' ] );
		$this->add_render_attribute( 'content', 'class', [ 'foodforlife-product-highlight-slider__content', 'd-flex', 'flex-column', 'justify-content-center', 'column-custom', 'rounded-10', 'py-30', 'px-20' ] );
		$this->add_render_attribute( 'inner', 'class', [ 'foodforlife-product-highlight-slider__inner' ] );
		$this->add_render_attribute( 'heading', 'class', [ 'foodforlife-product-highlight-slider__heading', 'text-center' ] );
		$this->add_render_attribute( 'title', 'class', [ 'foodforlife-product-highlight-slider__title', 'fw-semibold', 'heading-letter-spacing', 'text-dark', 'mb-3' ] );
		$this->add_render_attribute( 'sub-title', 'class', [ 'foodforlife-product-highlight-slider__sub-title', 'fs-12', 'fw-semibold', 'text-uppercase', 'text-dark', 'mb-3' ] );
		$this->add_render_attribute( 'description', 'class', [ 'foodforlife-product-highlight-slider__description', 'mb-33' ] );
		$this->add_render_attribute( 'product', 'class', [ 'foodforlife-product-highlight-slider__product', 'w-100', 'swiper', 'navigation-class-dots', 'navigation-class--tabletdots', 'navigation-class--mobiledots' ] );
		$this->add_render_attribute( 'product-wrapper', 'class', [ 'foodforlife-product-highlight-slider__product-wrapper', 'swiper-wrapper' ] );

		echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) .'>';
			echo '<div ' . $this->get_render_attribute_string( 'image' ) .'>';
				echo '<div ' . $this->get_render_attribute_string( 'image-wrapper' ) .'>';
					foreach( $settings['items'] as $index => $image ) {
						if ( empty( $image['image']['url'] ) ) {
							return;
						}

						$image_key  = $this->get_repeater_setting_key( 'image', 'product_highlight', $index );
						$this->add_render_attribute( $image_key, 'class', [ 'foodforlife-product-highlight-slider__image-item', 'swiper-slide', 'ffl-ratio' ] );
						$image_args = [
							'image'        => ! empty( $image['image'] ) ? $image['image'] : '',
							'image_tablet' => ! empty( $image['image_tablet'] ) ? $image['image_tablet'] : '',
							'image_mobile' => ! empty( $image['image_mobile'] ) ? $image['image_mobile'] : '',
						];

						echo '<div ' . $this->get_render_attribute_string( $image_key ) .'>';
						echo \FoodForLife\Addons\Helper::get_responsive_image_elementor( $image_args );
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';
			echo '<div ' . $this->get_render_attribute_string( 'content' ) .'>';
			echo '<div ' . $this->get_render_attribute_string( 'inner' ) .'>';
				echo '<div ' . $this->get_render_attribute_string( 'heading' ) .'>';
					if ( $settings['sub_title'] ) {
						echo '<div ' . $this->get_render_attribute_string( 'sub-title' ) .'>';
						echo wp_kses_post( $settings['sub_title'] );
						echo '</div>';
					}
					if ( $settings['title'] ) {
						echo '<div ' . $this->get_render_attribute_string( 'title' ) .'>';
						echo wp_kses_post( $settings['title'] );
						echo '</div>';
					}
					if ( $settings['description'] ) {
						echo '<div ' . $this->get_render_attribute_string( 'description' ) .'>';
						echo wp_kses_post( $settings['description'] );
						echo '</div>';
						}
					echo '</div>';
					echo '<div ' . $this->get_render_attribute_string( 'product' ) .'>';
						echo '<div ' . $this->get_render_attribute_string( 'product-wrapper' ) .'>';
						foreach( $settings['items'] as $index => $product ) {
							$product_id    = $product[ "product_ids" ];

							if ( empty($product_id) ) {
								continue;
							}
							$product = wc_get_product( $product_id );

							if ( empty($product) ) {
								continue;
							}


							$product_key  = $this->get_repeater_setting_key( 'product_item', 'product_highlight', $index );
							$product_inner_key  = $this->get_repeater_setting_key( 'product_inner', 'product_highlight', $index );
							$product_image  = $this->get_repeater_setting_key( 'product_image', 'product_highlight', $index );
							$product_title  = $this->get_repeater_setting_key( 'product_title', 'product_highlight', $index );
							$product_price  = $this->get_repeater_setting_key( 'product_price', 'product_highlight', $index );

							$this->add_render_attribute( $product_key, 'class', [ 'foodforlife-product-highlight-slider__product-item', 'swiper-slide', ] );
							$this->add_render_attribute( $product_inner_key, 'class', [ 'foodforlife-product-highlight-slider__product-inner', 'rounded-10', 'd-flex', 'flex-column', 'flex-md-row', 'align-items-center', 'gap-10', 'bg-light', 'px-20', 'py-20', 'px-md-30', 'py-md-10' ] );
							$this->add_render_attribute( $product_image, 'class', [ 'foodforlife-product-highlight-slider__product-image', 'ffl-image-rounded', 'position-relative', 'overflow-hidden', 'ffl-hover-zoom', 'ffl-hover-effect', 'ffl-ratio', 'product-thumbnails--fadein', 'flex-shrink-0' ] );
							$this->add_render_attribute( $product_image, 'href', get_permalink( $product_id ) );
							$this->add_render_attribute( $product_title, 'class', [ 'foodforlife-product-highlight-slider__product-title', 'fw-semibold' ] );
							$this->add_render_attribute( $product_price, 'class', [ 'foodforlife-product-highlight-slider__product-price', 'ffl-price', 'flex-1', 'justify-content-end' ] );
							$this->add_render_attribute( $product_image, 'aria-label', esc_html__( 'Link for product', 'foodforlife-addons' ) . ' ' . $product->get_name() );

							echo '<div ' . $this->get_render_attribute_string( $product_key ) .'>';
								echo '<div ' . $this->get_render_attribute_string( $product_inner_key ) .'>';
									echo '<a ' . $this->get_render_attribute_string( $product_image ) .'>';
										echo wp_get_attachment_image( $product->get_image_id(), 'thumbnail' );
									echo '</a>';
									echo '<div ' . $this->get_render_attribute_string( $product_title ) .'>';
										echo '<a href="'. esc_url( get_permalink( $product_id ) ) .'" aria-label="'. esc_html( $product->get_name() ) .'">';
											echo $product->get_name();
										echo '</a>';
									echo '</div>';
									echo '<div ' . $this->get_render_attribute_string( $product_price ) .'>';
										echo wp_kses_post( $product->get_price_html() );
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
						echo '</div>';
						echo $this->render_pagination();
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
}