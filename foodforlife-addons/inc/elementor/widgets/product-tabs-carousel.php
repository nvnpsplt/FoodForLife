<?php

namespace FoodForLife\Addons\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use FoodForLife\Addons\Elementor\Base\Carousel_Widget_Base;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Product Tabs Carousel widget
 */
class Product_Tabs_Carousel extends Carousel_Widget_Base {
    use \FoodForLife\Addons\Woocommerce\Products_Base;
	use \FoodForLife\Addons\Elementor\Base\Button_Base;

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-product-tabs-carousel';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( '[FoodForLife] Product Tabs Carousel', 'foodforlife-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-product-tabs';
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
			'foodforlife-product-tabs-widget'
		];
	}

	/**
	 * Style
	 *
	 * @return void
	 */
	public function get_style_depends() {
		return [ 'foodforlife-product-tabs-css' ];
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
			[ 'label' => esc_html__( 'Product Tabs', 'foodforlife-addons' ) ]
		);

		$this->add_control(
			'heading_title',
			[
				'label'       => esc_html__( 'Heading', 'foodforlife-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_title_size',
			[
				'label' => __( 'HTML Tag', 'foodforlife-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Total Products', 'foodforlife-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
				'min'     => 1,
				'max'     => 50,
				'step'    => 1,
			]
		);

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Heading', 'foodforlife-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'This is heading', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'products',
			[
				'label'     => esc_html__( 'Product', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'recent_products'       => esc_html__( 'Recent', 'foodforlife-addons' ),
					'featured_products'     => esc_html__( 'Featured', 'foodforlife-addons' ),
					'best_selling_products' => esc_html__( 'Best Selling', 'foodforlife-addons' ),
					'top_rated_products'    => esc_html__( 'Top Rated', 'foodforlife-addons' ),
					'sale_products'         => esc_html__( 'On Sale', 'foodforlife-addons' ),
					'custom_products'       => esc_html__( 'Custom', 'foodforlife-addons' ),
				],
				'default'   => 'recent_products',
				'toggle'    => false,
			]
		);

		$repeater->add_control(
			'orderby',
			[
				'label'     => esc_html__( 'Order By', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options' => $this->get_options_product_orderby(),
				'condition' => [
					'products' => ['featured_products', 'sale_products', 'custom_products']
				],
				'default'   => 'date',
			]
		);

		$repeater->add_control(
			'order',
			[
				'label'     => esc_html__( 'Order', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''     => esc_html__( 'Default', 'foodforlife-addons' ),
					'asc'  => esc_html__( 'Ascending', 'foodforlife-addons' ),
					'desc' => esc_html__( 'Descending', 'foodforlife-addons' ),
				],
				'condition' => [
					'products' => ['featured_products', 'sale_products', 'custom_products'],
					'orderby!' => ['rand'],
				],
				'default'   => '',
			]
		);

		$repeater->add_control(
			'ids',
			[
				'label' => __( 'Products', 'foodforlife-addons' ),
				'type' => 'foodforlife-autocomplete',
				'placeholder' => esc_html__( 'Click here and start typing...', 'foodforlife-addons' ),
				'default' => '',
				'multiple'    => true,
				'source'      => 'product',
				'sortable'    => true,
				'label_block' => true,
				'condition' => [
					'products' => ['custom_products']
				],
			]
		);

		$repeater->add_control(
			'product_cat',
			[
				'label'       => esc_html__( 'Product Categories', 'foodforlife-addons' ),
				'placeholder' => esc_html__( 'Click here and start typing...', 'foodforlife-addons' ),
				'type'        => 'foodforlife-autocomplete',
				'default'     => '',
				'label_block' => true,
				'multiple'    => true,
				'source'      => 'product_cat',
				'sortable'    => true,
				'condition' => [
					'products!' => ['custom_products']
				],
			]
		);

		$repeater->add_control(
			'product_tag',
			[
				'label'       => esc_html__( 'Product Tags', 'foodforlife-addons' ),
				'placeholder' => esc_html__( 'Click here and start typing...', 'foodforlife-addons' ),
				'type'        => 'foodforlife-autocomplete',
				'default'     => '',
				'label_block' => true,
				'multiple'    => true,
				'source'      => 'product_tag',
				'sortable'    => true,
				'condition' => [
					'products!' => ['custom_products']
				],
			]
		);

		$repeater->add_control(
			'product_brand',
			[
				'label'       => esc_html__( 'Product Brands', 'foodforlife-addons' ),
				'placeholder' => esc_html__( 'Click here and start typing...', 'foodforlife-addons' ),
				'type'        => 'foodforlife-autocomplete',
				'default'     => '',
				'label_block' => true,
				'multiple'    => true,
				'source'      => 'product_brand',
				'sortable'    => true,
				'condition' => [
					'products!' => ['custom_products']
				],
			]
		);

        $this->add_control(
			'tabs',
			[
				'label'         => '',
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => [
					[
						'heading' => esc_html__( 'Best seller', 'foodforlife-addons' ),
						'products'  => 'best_selling_products'
					],
					[
						'heading' => esc_html__( 'New arrivals', 'foodforlife-addons' ),
						'products'  => 'recent_products'
					],
					[
						'heading' => esc_html__( 'On Sale', 'foodforlife-addons' ),
						'products'  => 'sale_products'
					]
				],
				'title_field'   => '{{{ heading }}}',
				'prevent_empty' => false,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'foodforlife-addons' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => '',
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => esc_html__( 'Button Link', 'foodforlife-addons' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'foodforlife-addons' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'       => esc_html__( 'Button Icon', 'foodforlife-addons' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				]
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'section_products_carousel',
			[
				'label' => __( 'Carousel Settings', 'foodforlife-addons' ),
			]
		);

		$controls = [
			'slides_rows'	   => 1,
			'slides_to_show'   => 4,
			'slides_to_scroll' => 1,
			'space_between'    => 30,
			'navigation'       => '',
			'autoplay'         => '',
			'autoplay_speed'   => 3000,
			'pause_on_hover'   => 'yes',
			'animation_speed'  => 800,
			'infinite'         => '',
			'slidesperview_auto' => '',
		];

		$this->register_carousel_controls( $controls );

		$this->end_controls_section();
	}

	// Tab Style
	protected function section_style() {
		$this->start_controls_section(
			'section_style_heading',
			[
				'label' => esc_html__( 'Heading', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'heading_tabs_gap',
			[
				'label'     => __( 'Spacing between title and tabs', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 500,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs-carousel__heading-tabs' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'            => [
					'heading_title!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'heading_horizontal_position',
			[
				'label'                => esc_html__( 'Horizontal Position', 'foodforlife-addons' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'left'   => [
						'title' => esc_html__( 'Left', 'foodforlife-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'foodforlife-addons' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'foodforlife-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors'            => [
					'{{WRAPPER}} .foodforlife-product-tabs-carousel__heading' => 'justify-content: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'left'   => 'flex-start',
					'center' => 'center',
					'right'  => 'flex-end',
				],
				'condition'            => [
					'heading_title' => '',
				],
			]
		);

		$this->add_control(
			'_heading_horizontal_position',
			[
				'label'                => esc_html__( 'Horizontal Position', 'foodforlife-addons' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'left'   => [
						'title' => esc_html__( 'Left', 'foodforlife-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'foodforlife-addons' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'foodforlife-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
					'spacebetween' => [
						'title' => esc_html__( 'Space Between', 'foodforlife-addons' ),
						'icon'  => 'eicon-justify-space-between-h',
					],
				],
				'default'              => 'center',
				'selectors'            => [
					'{{WRAPPER}} .foodforlife-product-tabs-carousel__heading-tabs' => 'justify-content: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'left'   => 'flex-start',
					'center' => 'center',
					'right'  => 'flex-end',
					'spacebetween' => 'space-between',
				],
				'condition'            => [
					'heading_title!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'heading_gap',
			[
				'label'     => __( 'Gap', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 500,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs-carousel__heading' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_spacing',
			[
				'label'     => __( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 200,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs-carousel__heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'            => [
					'heading_title' => '',
				],
			]
		);

		$this->add_responsive_control(
			'_heading_spacing',
			[
				'label'     => __( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 200,
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs-carousel__heading-tabs' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .foodforlife-product-tabs-carousel__heading' => 'margin-bottom: 0;',
				],
				'condition'            => [
					'heading_title!' => '',
				],
			]
		);

		$this->register_button_style_controls( '', 'foodforlife-product-tabs__heading-button', 'hb' );

		$this->add_control(
			'hb_active_heading',
			[
				'label' => esc_html__( 'Button Active', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'hb_active_tabs_button_style' );

		$this->start_controls_tab(
			'hb_active_tab_button_normal',
			[
				'label' => __( 'Normal', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'hb_active_button_background_color',
			[
				'label'     => __( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs__heading-button.active' => '--ffl-button-bg-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hb_active_button_text_color',
			[
				'label'     => __( 'Text Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs__heading-button.active' => '--ffl-button-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hb_active_button_border_color',
			[
				'label'     => __( 'Border Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs__heading-button.active' => '--ffl-button-border-color: {{VALUE}};',
				],
				'condition' => [
					'hb_button_style' => [ 'outline-dark', 'outline', 'subtle' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hb_active_tab_button_hover',
			[
				'label' => __( 'Hover', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'hb_active_button_background_hover_color',
			[
				'label'     => __( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs__heading-button.active' => '--ffl-button-bg-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hb_active_hover_color',
			[
				'label'     => __( 'Text Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs__heading-button.active' => '--ffl-button-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hb_active_button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs__heading-button.active' => '--ffl-button-border-color-hover: {{VALUE}};',
				],
				'condition' => [
					'hb_button_style' => [ 'outline-dark', 'outline', 'subtle' ],
				],
			]
		);

		$this->add_control(
			'hb_active_button_background_effect_hover_color',
			[
				'label'     => __( 'Background Effect Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-product-tabs__heading-button.active' => '--ffl-button-eff-bg-color-hover: {{VALUE}};',
				],
				'condition' => [
					'button_style' => ['', 'light', 'outline-dark']
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_product_style',
			[
				'label'     => __( 'Product', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
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

		$this->add_control(
			'product_item_background_color',
			[
				'label'     => __( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ul.products li.product .product-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'product_item_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} ul.products li.product .product-inner' => 'border-start-start-radius: {{TOP}}{{UNIT}}; border-start-end-radius: {{RIGHT}}{{UNIT}}; border-end-end-radius: {{BOTTOM}}{{UNIT}}; border-end-start-radius: {{LEFT}}{{UNIT}};',
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

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'product_summary_border',
				'label' => esc_html__( 'Border', 'foodforlife-addons' ),
				'selector' => '{{WRAPPER}} ul.products li.product .product-summary',
			]
		);

		$this->add_responsive_control(
			'product_summary_margin',
			[
				'label'      => __( 'Margin', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} ul.products li.product .product-summary' => 'margin-top: {{TOP}}{{UNIT}}; margin-inline-end: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}}; margin-inline-start: {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} ul.products li.product .product-summary' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_button_style_controls();

		$this->end_controls_section();

        $this->start_controls_section(
			'section_style',
			[
				'label'     => __( 'Carousel Settings', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
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

        $query_args = [];

		$col = $settings['slides_to_show'];
		$col_tablet = ! empty( $settings['slides_to_show_tablet'] ) ? $settings['slides_to_show_tablet'] : $col;
		$col_mobile = ! empty( $settings['slides_to_show_mobile'] ) ? $settings['slides_to_show_mobile'] : $col;

        $this->add_render_attribute( 'wrapper', 'class', 'foodforlife-product-tabs-carousel', 'foodforlife-product-tabs' );

		if ( ! empty( $settings['heading_title'] ) ) {
        	$this->add_render_attribute( 'heading', 'class', [ 'foodforlife-product-tabs-carousel__heading', 'foodforlife-product-tabs__heading', 'd-flex', 'flex-nowrap', 'flex-wrap-md', 'align-items-center', 'justify-content-center', 'gap-15' ] );
		} else {
        	$this->add_render_attribute( 'heading', 'class', [ 'foodforlife-product-tabs-carousel__heading', 'foodforlife-product-tabs__heading', 'd-flex', 'flex-nowrap', 'flex-wrap-md', 'align-items-center', 'justify-content-center', 'gap-15', 'mb-40' ] );
		}

        $this->add_render_attribute( 'items', 'class', [ 'foodforlife-product-tabs-carousel__items', 'foodforlife-product-tabs__items', 'position-relative', intval($settings['slides_rows']) > 1 ? 'has-rows-carousel' : '' ] );
        $this->add_render_attribute( 'item', 'class', [ 'foodforlife-product-tabs-carousel__item', 'foodforlife-product-tabs__item', 'foodforlife-carousel--elementor', 'active' ] );
        $this->add_render_attribute( 'item', 'data-panel', '1' );
		$this->add_render_attribute( 'swiper', 'class', 'swiper' );
		$this->add_render_attribute( 'swiper', 'data-desktop', $col );
		$this->add_render_attribute( 'swiper', 'data-tablet', $col_tablet );
		$this->add_render_attribute( 'swiper', 'data-mobile', $col_mobile );
		$this->add_render_attribute( 'swiper', 'style', $this->render_space_between_style() );
		$this->render_slidesperview_auto_class_style( 'swiper' );

		$this->add_render_attribute( 'swiper_original', 'class', ['swiper-original', 'hidden'] );
		$this->add_render_attribute( 'swiper_original', 'data-desktop', $col );
		$this->add_render_attribute( 'swiper_original', 'data-tablet', $col_tablet );
		$this->add_render_attribute( 'swiper_original', 'data-mobile', $col_mobile );
		$this->add_render_attribute( 'swiper_original', 'style', $this->render_space_between_style() );
		$this->render_slidesperview_auto_class_style( 'swiper_original' );

        $this->add_render_attribute( 'loading', 'class', [ 'foodforlife-product-tabs-carousel__loading', 'foodforlife-product-tabs__loading', 'position-absolute', 'ffl-loading-spin' ] );

        echo '<div '. $this->get_render_attribute_string( 'wrapper' ) . '>';
			if ( ! empty( $settings['heading_title'] ) ) :
				$class_heading = $settings['_heading_horizontal_position'] == 'spacebetween' ? 'flex-xl-row align-items-center' : '';
			echo '<div class="foodforlife-product-tabs-carousel__heading-tabs d-flex flex-column '. esc_attr( $class_heading ) .'">';
				echo '<'. esc_attr( $settings['heading_title_size'] ) .' class="my-0 heading-letter-spacing">'. wp_kses_post( do_shortcode($settings['heading_title']) ) .'</'.esc_attr( $settings['heading_title_size'] ).'>';
			endif;
				echo '<div '. $this->get_render_attribute_string( 'heading' ) . '>';
						$a = 1;
						foreach( $settings['tabs'] as $key => $tab ):
							if( ! empty( $tab['heading'] ) ) :
								$attr = [
									'type'           => $tab['products'],
									'orderby'        => $tab['orderby'],
									'order'          => $tab['order'],
									'category'       => $tab['product_cat'],
									'tag'            => $tab['product_tag'],
									'product_brands' => $tab['product_brand'],
									'ids'            => $tab['ids'],
									'per_page'       => $settings['limit'],
									'columns'        => $settings['slides_to_show'],
									'swiper'         => true,
								];

								$tab_key = $this->get_repeater_setting_key( 'tab', 'products_tab', $key );

								$this->add_render_attribute( $tab_key, [ 'data-target' => $a, 'data-atts' => json_encode( $attr ) ] );
								$this->add_render_attribute( $tab_key, 'class', [ 'foodforlife-product-tabs-carousel__heading-button', 'foodforlife-product-tabs__heading-button', 'foodforlife-button', 'ffl-button', ! empty( $settings['hb_button_style'] ) ? ' ffl-button-'  . $settings['hb_button_style'] : 'ffl-button-default' ] );

								if ( 1 === $a ) {
									$this->add_render_attribute( $tab_key, 'class', 'active' );
									$query_args = $attr;
								}

								?>
								<span <?php echo $this->get_render_attribute_string( $tab_key ); ?>><?php echo wp_kses_post( $tab['heading'] ); ?></span>
								<?php
							endif;
						$a++;
						endforeach;
						$this->render_button();
				echo '</div>';
				if ( ! empty( $settings['heading_title'] ) ) :
			echo '</div>';
			endif;
        ?>
            <div <?php echo $this->get_render_attribute_string( 'items' ) ?>>
                <div <?php echo $this->get_render_attribute_string( 'loading' ) ?>></div>
                <div <?php echo $this->get_render_attribute_string( 'item' ) ?>>
					<div <?php echo $this->get_render_attribute_string( 'swiper' ) ?>>
						<?php echo $this->render_products( $query_args ); ?>
					</div>
                </div>
                <div class="navigation-original hidden">
					<?php echo '<div class="swiper-arrows">' . $this->render_arrows('arrow-primary') . '</div>'; ?>
				    <?php echo $this->render_pagination(); ?>
                </div>
				<div <?php echo $this->get_render_attribute_string( 'swiper_original' ) ?>></div>
            </div>
        <?php
        echo '</div>';
	}

	/**
	 * Render button for shortcode.
	 *
	 */
	protected function render_button( $repeater = '', $index = '', $button_link = '', $args = [] ) {
		$settings 	= $this->get_settings_for_display();

		$repeater 	= ! empty( $repeater ) ? $repeater : $this->get_settings_for_display();
		if ( ! empty( $index ) ) {
			$button_key = $this->get_repeater_setting_key( 'button', 'button_index', $index );
			$text_key   = $this->get_repeater_setting_key( 'text', 'button_index', $index );
		} else {
			$button_key = 'button';
			$text_key   = 'text';
		}

		if ( empty( $args['no_text'] ) && empty( $repeater['button_text'] ) ) {
			return;
		}

		$is_new   	= Icons_Manager::is_migration_allowed();

		$button_link = ! empty( $button_link ) ? $button_link : $repeater['button_link'];

		if ( ! empty( $button_link['url'] ) ) {
			$this->add_link_attributes( $button_key, $button_link );
			$this->add_render_attribute( $button_key, 'class', 'foodforlife-button-link' );
		} elseif ( ! empty( $button_link ) ) {
			$this->add_render_attribute( $button_key, 'href', $button_link);
		}

		$this->add_render_attribute( $button_key, 'class', 'foodforlife-button' );

		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( $button_key, 'id', $settings['button_css_id'] );
		}

		if ( isset( $repeater['button_text_classes'] ) ) {
			$this->add_render_attribute( $text_key, 'class', $repeater['button_text_classes'] );
		}

		$classes = 'ffl-button foodforlife-product-tabs__heading-button';
		$classes .= ! empty( $repeater['button_classes'] ) ? $repeater['button_classes'] : '';
		$classes .= ! empty( $settings['button_style'] ) ? ' ffl-button-'  . $settings['button_style'] : '';
		$classes .= empty( $args['no_text'] ) && ! empty( $settings['button_style'] ) && in_array( $settings['button_style'], ['', 'light', 'outline-dark'] ) ? ' px-30 ffl-button-hover-effect' : '';

		if( ! empty( $args['classes'] ) ) {
			$classes .= ' ' . $args['classes'];
		}

		if( ! empty( $args['no_text'] ) ) {
			$classes .= ' ffl-button-icon';
		}

		$this->add_render_attribute( $button_key, 'class', $classes );

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'foodforlife-button-content-wrapper',
			],
			'icon-align'      => [
				'class' => [
					'foodforlife-svg-icon',
				],
			],
			$text_key            => [
				'class' => 'foodforlife-button-text',
			],
		] );

		$icon_default = ! empty( $args['icon_default'] ) ? $args['icon_default'] : '';

		$this->add_inline_editing_attributes( $text_key, 'none' );
		$button_text =  empty( $args['no_text'] ) ? sprintf('<span %s>%s</span>', $this->get_render_attribute_string( $text_key ), $repeater['button_text']) : '';
		$aria_label = ! empty( $args['aria_label'] ) ? $args['aria_label'] : '';
		if( empty( $aria_label ) ) {
			$aria_label = ! empty( $repeater['button_text'] ) ? esc_html__( 'Link for', 'foodforlife-addons' ) . ' ' . $repeater['button_text'] : esc_html__( 'View more', 'foodforlife-addons' );
		}
		
		?>
		<a <?php echo $this->get_render_attribute_string( $button_key ); ?> aria-label="<?php echo esc_attr( $aria_label ); ?>">
			<?php echo $button_text; ?>
			<?php if ( ! empty( $settings['button_icon']['value'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
					<?php if ( $is_new ) :
						Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
					endif; ?>
				</span>
			<?php else : ?>
				<?php echo $icon_default; ?>
			<?php endif; ?>
		</a>
		<?php
	}
}