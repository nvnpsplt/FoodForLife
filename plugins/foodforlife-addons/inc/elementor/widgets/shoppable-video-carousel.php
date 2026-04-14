<?php

namespace FoodForLife\Addons\Elementor\Widgets;

use FoodForLife\Addons\Elementor\Base\Carousel_Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Shoppable Video Carousel widget
 */
class Shoppable_Video_Carousel extends Carousel_Widget_Base {
    use \FoodForLife\Addons\Elementor\Base\Aspect_Ratio_Base;
    use \FoodForLife\Addons\Elementor\Base\Video_Base;
	use \FoodForLife\Addons\Elementor\Base\Button_Base;

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-shoppable-video-carousel';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( '[FoodForLife] Shoppable Video Carousel', 'foodforlife-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel';
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
			'wc-add-to-cart-variation',
			'foodforlife-countdown-widget',
			'foodforlife-elementor-widgets',
			'foodforlife-shoppable-video-widget'
		];
	}

	/**
	 * Styles
	 *
	 * @return void
	 */
	public function get_style_depends() {
		return [
			'foodforlife-elementor-css',
			'foodforlife-countdown-css'
		];
	}

	/**
	 * Register heading widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->content_sections();
		$this->style_sections();
	}

	protected function content_sections() {
		$this->start_controls_section(
			'section_contents',
			[
				'label' => __( 'Contents', 'foodforlife-addons' ),
			]
		);

        $repeater = new \Elementor\Repeater();

		$this->register_video_repeater_controls( $repeater, [] );

        $repeater->add_control(
            'product_id',
            [
                'label'       => __( 'Product', 'foodforlife-addons' ),
                'type'        => 'foodforlife-autocomplete',
                'multiple'    => false,
                'source'      => 'product',
                'sortable'    => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
			'video',
			[
				'label'  => __( 'Video', 'foodforlife-addons' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

        $this->register_aspect_ratio_controls( [], [ 'aspect_ratio_type' => 'vertical' ] );

		$this->add_control(
			'modal_settings_heading',
			[
				'label' => esc_html__( 'Modal Settings', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'modal_mute',
			[
				'label' => esc_html__( 'Mute video Popup', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'foodforlife-addons' ),
				'label_off' => esc_html__( 'No', 'foodforlife-addons' ),
				'return_value' => 'yes',
				'default'   => 'yes',
				'frontend_available' => true,
			]
		);

		$this->register_button_controls(true, esc_html__( 'Button Text on Mobile', 'foodforlife-addons' ), '', esc_html__( 'Shop Now', 'foodforlife-addons' ));

		$this->end_controls_section();

        $this->start_controls_section(
			'section_slider_options',
			[
				'label' => esc_html__( 'Carousel Settings', 'foodforlife-addons' ),
				'type'  => Controls_Manager::SECTION,
			]
		);

		$controls = [
			'slides_to_show'   => 4,
			'slides_to_scroll' => 1,
			'space_between'    => 30,
			'navigation'       => 'both',
			'autoplay'         => '',
			'autoplay_speed'   => 3000,
			'pause_on_hover'   => 'yes',
			'animation_speed'  => 800,
			'infinite'         => '',
			'slidesperview_auto' => ''
		];

		$this->register_carousel_controls($controls);

		$this->end_controls_section();
	}

	protected function style_sections() {
		$this->start_controls_section(
			'section_style',
			[
				'label'     => __( 'Content', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'video_video_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel__video' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-shoppable-video-carousel__video' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'product_gradient_image',
			[
				'label' => __( 'Gradient', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'foodforlife-addons' ),
				'label_on'  => __( 'Show', 'foodforlife-addons' ),
				'default'   => '',
			]
		);

		$this->add_control(
			'gradient_image_popover_toggle',
			[
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label' => esc_html__( 'Background', 'foodforlife-addons' ),
				'label_off' => esc_html__( 'Default', 'foodforlife-addons' ),
				'label_on' => esc_html__( 'Custom', 'foodforlife-addons' ),
				'return_value' => 'yes',
				'condition' => [
					'product_gradient_image' => 'yes',
				],
			]
		);

		$this->start_popover();

		$this->add_control(
			'gradient_image_heading',
			[
				'type'  => Controls_Manager::HEADING,
				'label' => esc_html__( 'Background', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'gradient_image_color_primary',
			[
				'label' => __( 'Color Primary', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel--gradient' => '--ffl-gradient-color-primary: {{VALUE}};',
				],
				'condition' => [
					'product_gradient_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'gradient_image_color_secondary',
			[
				'label' => __( 'Color Secondary', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel--gradient' => '--ffl-gradient-color-secondary: {{VALUE}};',
				],
				'condition' => [
					'product_gradient_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'gradient_image_angle',
			[
				'label' => esc_html__( 'Angle', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel--gradient' => '--ffl-gradient-angle: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'product_gradient_image' => 'yes',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'product_heading',
			[
				'label' => esc_html__( 'Product', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'product_background_color',
			[
				'label'     => __( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel__product' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_color',
			[
				'label'     => __( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .woocommerce-loop-product__title,
					{{WRAPPER}} .foodforlife-shoppable-video-carousel__product-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'product_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel__product' => 'border-start-start-radius: {{TOP}}{{UNIT}}; border-start-end-radius: {{RIGHT}}{{UNIT}}; border-end-end-radius: {{BOTTOM}}{{UNIT}}; border-end-start-radius: {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-shoppable-video-carousel__product' => 'border-start-start-radius: {{TOP}}{{UNIT}}; border-start-end-radius: {{LEFT}}{{UNIT}}; border-end-end-radius: {{BOTTOM}}{{UNIT}}; border-end-start-radius: {{RIGHT}}{{UNIT}};',
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel--filter-color::after' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-shoppable-video-carousel--filter-color::after' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{LEFT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'product_filter_color',
			[
				'label'     => esc_html__( 'Filter', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'foodforlife-addons' ),
				'label_on'  => __( 'Show', 'foodforlife-addons' ),
				'default'	=> '',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'product_filter_color_custom',
			[
				'label'     => __( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel--filter-color' => '--ffl-shoppable-video-filter-color: {{VALUE}};',
				],
				'condition' => [
					'product_filter_color' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'product_filter_blur',
			[
				'label' => __( 'Blur', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					]
				],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel--filter-color' => '--ffl-shoppable-video-filter-blur: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'product_filter_color' => 'yes',
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

		$this->add_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-shoppable-video-carousel__product-thumbnail' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-shoppable-video-carousel__product-thumbnail' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_style',
			[
				'label'     => __( 'Modal Style', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_button_style_controls('light');

		$this->end_controls_section();

        $this->start_controls_section(
			'section_style_carousel',
			[
				'label' => esc_html__( 'Carousel Style', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_carousel_style_controls();

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

        if( empty( $settings['video'] ) ) {
            return;
        }

        $col = $settings['slides_to_show'];
		$col_tablet = ! empty( $settings['slides_to_show_tablet'] ) ? $settings['slides_to_show_tablet'] : $col;
		$col_mobile = ! empty( $settings['slides_to_show_mobile'] ) ? $settings['slides_to_show_mobile'] : $col;

        $this->add_render_attribute( 'container', 'class', [ 'foodforlife-shoppable-video-carousel', 'foodforlife-carousel--elementor', 'swiper' ] );
        $this->add_render_attribute( 'container', 'data-desktop', $col );
		$this->add_render_attribute( 'container', 'data-tablet', $col_tablet );
		$this->add_render_attribute( 'container', 'data-mobile', $col_mobile );
		$this->add_render_attribute( 'container', 'style', $this->render_space_between_style() );
        $this->add_render_attribute( 'container', 'style', $this->render_aspect_ratio_style() );
		$this->render_slidesperview_auto_class_style( 'container' );

        $this->add_render_attribute( 'wrapper', 'class', [ 'foodforlife-shoppable-video-carousel__wrapper', 'swiper-wrapper' ] );
        $this->add_render_attribute( 'item', 'class', [ 'foodforlife-shoppable-video-carousel__item', 'swiper-slide', 'position-relative' ] );
		$this->add_render_attribute( 'item', 'data-toggle', 'modal' );
        $this->add_render_attribute( 'item', 'data-target', 'shoppable-video-modal' );

        $this->add_render_attribute( 'video', 'class', [ 'foodforlife-shoppable-video-carousel__video', 'foodforlife-elementor-video', 'ffl-ratio', 'ffl-image-rounded', 'overflow-hidden', $settings['product_gradient_image'] ? 'foodforlife-shoppable-video-carousel--gradient' : '' ] );
        $this->add_render_attribute( 'product', 'class', [ 'foodforlife-shoppable-video-carousel__product', 'position-absolute', 'start-15', 'end-15', 'bottom-15', 'z-3', 'rounded-5', 'd-flex', 'gap-10', 'align-items-center', $settings['product_filter_color'] ? 'foodforlife-shoppable-video-carousel--filter-color' : '' ] );
		$this->add_render_attribute( 'product', 'data-toggle', 'modal' );
        $this->add_render_attribute( 'product', 'data-target', 'shoppable-video-mobile-modal' );

		$this->add_render_attribute( 'product_thumbnail', 'class', [ 'foodforlife-shoppable-video-carousel__product-thumbnail' ] );
		$this->add_render_attribute( 'product_summary', 'class', [ 'foodforlife-shoppable-video-carousel__product-summary' ] );
		$this->add_render_attribute( 'product_price', 'class', [ 'foodforlife-shoppable-video-carousel__product-price', 'price' ] );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'container' );?>>
            <div <?php echo $this->get_render_attribute_string( 'wrapper' );?>>
                <?php foreach( $settings['video'] as $item ) : ?>
                    <div <?php echo $this->get_render_attribute_string( 'item' );?> data-product_id="<?php echo ! empty( $item['product_id'] ) ? esc_attr( $item['product_id'] ) : ''; ?>">
						<?php if ( $this->has_video( $item ) ) : ?>
							<div <?php echo $this->get_render_attribute_string( 'video' );?>>
								<?php $this->render_video( $item ); ?>
							</div>
						<?php endif; ?>
                        <?php
							$product_id = $item['product_id'];
							$product = wc_get_product( $product_id );
							if ( ! empty( $product ) ):
						?>
							<div <?php echo $this->get_render_attribute_string( 'product' );?> data-product_id="<?php echo ! empty( $item['product_id'] ) ? esc_attr( $item['product_id'] ) : ''; ?>">
								<div <?php echo $this->get_render_attribute_string( 'product_thumbnail' );?>>
									<?php echo $product->get_image('woocommerce_gallery_thumbnail'); ?>
								</div>
								<div <?php echo $this->get_render_attribute_string( 'product_summary' );?>>
									<h2 class="woocommerce-loop-product__title my-0 fs-15 text-light lh-normal">
										<?php echo wp_kses_post( $product->get_title() ); ?>
									</h2>
									<div <?php echo $this->get_render_attribute_string( 'product_price' );?>>
										<?php echo $product->get_price_html(); ?>
									</div>
								</div>
								<?php $this->render_button( '', '', '#', [ 'classes' => 'hidden'] ); ?>
							</div>
						<?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php echo $this->render_pagination(); ?>
            <?php echo '<div class="swiper-arrows">' . $this->render_arrows() . '</div>'; ?>
        </div>
        <?php
        $this->render_shoppable_video_modal();
	}

    public function render_shoppable_video_modal() {
        ?>
        <div class="shoppable-video-modal shoppable-video--modal modal" style="<?php echo $this->render_aspect_ratio_style(); ?>">
            <div class="modal__backdrop"></div>
            <div class="modal__container">
                <div class="modal__wrapper-shopable position-relative bg-light">
                    <a href="#" class="modal__button-close position-absolute z-1 ffl-button ffl-button-icon">
                        <?php echo \FoodForLife\Addons\Helper::get_svg( 'close' ); ?>
                    </a>
                    <div class="modal__shoppable-video single-product woocommerce">
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}