<?php

namespace FoodForLife\Addons\Elementor\Widgets;

use FoodForLife\Addons\Elementor\Base\Products_Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Images Hotspot Carousel widget
 */
class Lookbook_Carousel extends Products_Widget_Base {
	use \FoodForLife\Addons\Elementor\Base\Aspect_Ratio_Base;

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-lookbook-carousel';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( '[FoodForLife] Lookbook Carousel', 'foodforlife-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nested-carousel';
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
			'foodforlife-elementor-widgets'
		];
	}

	public function get_style_depends() {
		return [
			'foodforlife-lookbook-carousel-css'
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
		$this->section_content();
		$this->section_style();
	}

	// Tab Content
	protected function section_content() {
		$this->section_content_slides();
		$this->section_slider_options();
	}

	protected function section_content_slides() {
		$control = apply_filters( 'foodforlife_lookbook_carousel_section_number', 4 );
		for ( $i = 1; $i <= $control; $i ++ ) {
			$this->start_controls_section(
				'section_contents_' . $i,
				[
					'label' => __( 'Carousel Item', 'foodforlife-addons' ) . ' ' . $i,
				]
			);

			$default_url = '';
			if( $i == 1 || $i == 2 ) {
				$default_url = \Elementor\Utils::get_placeholder_image_src();
			}

			$this->add_responsive_control(
				'image_'. $i,
				[
					'label'     => __( 'Image', 'foodforlife-addons' ),
					'type'      => Controls_Manager::MEDIA,
					'default' => [
						'url' => $default_url,
					],
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'product_items_ids',
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

			$repeater->add_control(
				'point_popover_toggle',
				[
					'label' => esc_html__( 'Point', 'foodforlife-addons' ),
					'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
					'label_off' => esc_html__( 'Default', 'foodforlife-addons' ),
					'label_on' => esc_html__( 'Custom', 'foodforlife-addons' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$repeater->start_popover();

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
						'size' => 30 + $i * 10,
					],
					'size_units' => [ '%', 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .foodforlife-lookbook-carousel .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
						'.rtl {{WRAPPER}} .foodforlife-lookbook-carousel .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
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
						'size' => 30 + $i * 10,
					],
					'size_units' => [ '%', 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .foodforlife-lookbook-carousel .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$repeater->end_popover();

			$repeater->add_control(
				'content_popover_toggle',
				[
					'label' => esc_html__( 'Content', 'foodforlife-addons' ),
					'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
					'label_off' => esc_html__( 'Default', 'foodforlife-addons' ),
					'label_on' => esc_html__( 'Custom', 'foodforlife-addons' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$repeater->start_popover();

			$repeater->add_responsive_control(
				'product_content_vertical_position',
				[
					'label'                => esc_html__( 'Vertical Position', 'foodforlife-addons' ),
					'type'                 => Controls_Manager::CHOOSE,
					'label_block'          => false,
					'options'              => [
						'top'   => [
							'title' => esc_html__( 'Left', 'foodforlife-addons' ),
							'icon'  => 'eicon-v-align-top',
						],
						'bottom'  => [
							'title' => esc_html__( 'Right', 'foodforlife-addons' ),
							'icon'  => 'eicon-v-align-bottom',
						],
					],
					'default' => 'bottom'
				]
			);

			$repeater->add_responsive_control(
				'product_content_items_position',
				[
					'label'                => esc_html__( 'Content Position', 'foodforlife-addons' ),
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
						'custom'  => [
							'title' => esc_html__( 'Custom', 'foodforlife-addons' ),
							'icon'  => 'eicon-pencil',
						],
					],
					'selectors'            => [
						'{{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}} .foodforlife-lookbook-carousel__product-inner' => '{{VALUE}}',
					],
					'selectors_dictionary' => [
						'left'   => 'left: 0; right: auto; transform: translateX(0);',
						'center' => 'left: 50%; transform: translateX(-50%); right: auto;',
						'right'  => 'right: 0; left: auto; transform: translateX(0);',
					],
				]
			);

			$repeater->add_responsive_control(
				'product_content_items_position_custom',
				[
					'label'      => esc_html__( 'Content Position Custom', 'foodforlife-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min' => - 1000,
							'max' => 1000,
						],
					],
					'default'    => [],
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}} .foodforlife-lookbook-carousel__product-inner' => 'left: {{SIZE}}{{UNIT}}; transform: translateX(0);',
						'.rtl {{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}} .foodforlife-lookbook-carousel__product-inner' => 'right: {{SIZE}}{{UNIT}}; left: auto; transform: translateX(0);',
					],
					'condition' => [
						'product_content_items_position' => 'custom',
					],
				]
			);

			$repeater->add_responsive_control(
				'product_arrow_items_position',
				[
					'label'                => esc_html__( 'Arrow Position', 'foodforlife-addons' ),
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
						'custom'  => [
							'title' => esc_html__( 'Custom', 'foodforlife-addons' ),
							'icon'  => 'eicon-pencil',
						],
					],
					'selectors'            => [
						'{{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}} .foodforlife-lookbook-carousel__product-inner:after' => '{{VALUE}}',
					],
					'selectors_dictionary' => [
						'left'   => 'left: 5px; right: auto; transform: translateX(0) translateY(-100%);',
						'center' => 'left: 50%; transform: translateX(-50%) translateY(-100%); right: auto;',
						'right'  => 'right: 20px; left: auto; transform: translateX(0) translateY(-100%);',
					],
					'condition' => [
						'product_content_vertical_position' => 'bottom',
					],
				]
			);

			$repeater->add_responsive_control(
				'product_arrow_items_position_custom',
				[
					'label'      => esc_html__( 'Arrow Position Custom', 'foodforlife-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min' => - 1000,
							'max' => 1000,
						],
					],
					'default'    => [],
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}} .foodforlife-lookbook-carousel__product-inner:after' => 'left: {{SIZE}}{{UNIT}}; transform: translateX(0) translateY(-100%);',
						'.rtl {{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}} .foodforlife-lookbook-carousel__product-inner:after' => 'right: {{SIZE}}{{UNIT}}; left: auto; transform: translateX(0) translateY(-100%);',
					],
					'condition' => [
						'product_arrow_items_position' => 'custom',
						'product_content_vertical_position' => 'bottom',
					],
				]
			);

			$repeater->add_responsive_control(
				'product_arrow_items_position_vertical',
				[
					'label'                => esc_html__( 'Arrow Position', 'foodforlife-addons' ),
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
						'custom'  => [
							'title' => esc_html__( 'Custom', 'foodforlife-addons' ),
							'icon'  => 'eicon-pencil',
						],
					],
					'selectors'            => [
						'{{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}}.foodforlife-lookbook-carousel__position-top .foodforlife-lookbook-carousel__product-inner:after' => '{{VALUE}}',
					],
					'selectors_dictionary' => [
						'left'   => 'left: 5px; right: auto; transform: translateX(0) translateY(100%) rotate(180deg);',
						'center' => 'left: 50%; transform: translate(-50%) translateY(100%) rotate(180deg); right: auto;',
						'right'  => 'right: 20px; left: auto; transform: translateX(0) translateY(100%) rotate(180deg);',
					],
					'condition' => [
						'product_content_vertical_position' => 'top',
					],
				]
			);

			$repeater->add_responsive_control(
				'product_arrow_items_position_custom_vertical',
				[
					'label'      => esc_html__( 'Arrow Position Custom', 'foodforlife-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min' => - 1000,
							'max' => 1000,
						],
					],
					'default'    => [],
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}}.foodforlife-lookbook-carousel__position-top .foodforlife-lookbook-carousel__product-inner:after' => 'left: {{SIZE}}{{UNIT}}; transform: translateX(0) translateY(100%) rotate(180deg);',
						'.rtl {{WRAPPER}} .foodforlife-lookbook-carousel__item-'. $i . ' {{CURRENT_ITEM}}.foodforlife-lookbook-carousel__position-top .foodforlife-lookbook-carousel__product-inner:after' => 'right: {{SIZE}}{{UNIT}}; left: auto; transform: translateX(0) translateY(100%) rotate(180deg);',
					],
					'condition' => [
						'product_arrow_items_position' => 'custom',
						'product_content_vertical_position' => 'top',
					],
				]
			);

			$repeater->end_popover();

			$this->add_control(
				'items_'. $i,
				[
					'label' => esc_html__( 'Hotspot items', 'foodforlife-addons' ),
					'type'       => Controls_Manager::REPEATER,
					'show_label' => true,
					'fields'     => $repeater->get_controls(),
					'default'    => [],
				]
			);

			$this->end_controls_section();
		}
	}

	protected function section_slider_options() {
		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => esc_html__( 'Carousel Options', 'foodforlife-addons' ),
				'type'  => Controls_Manager::SECTION,
			]
		);

		$controls = [
			'slides_to_show'   => 1,
			'slides_to_scroll' => 1,
			'space_between'    => 0,
			'navigation'       => 'arrows',
			'autoplay'         => '',
			'autoplay_speed'   => 3000,
			'pause_on_hover'   => 'yes',
			'animation_speed'  => 800,
			'infinite'         => '',
		];

		$this->register_carousel_controls($controls);

		$this->add_responsive_control(
			'slidesperview_auto',
			[
				'label' => __( 'Slides Per View Auto', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'foodforlife-addons' ),
				'label_on'  => __( 'On', 'foodforlife-addons' ),
				'default'   => '',
				'responsive' => true,
				'frontend_available' => true,
				'prefix_class' => 'foodforlife%s-slidesperview-auto--'
			]
		);

		$this->end_controls_section();
	}

	// Tab Style
	protected function section_style() {
		$this->section_style_content();
		$this->section_style_carousel();
	}

	protected function section_style_content() {
		$this->start_controls_section(
			'section_style',
			[
				'label'     => __( 'Contents', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_heading',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_image_heading',
			[
				'label'     => esc_html__( 'Image', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_aspect_ratio_controls();

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}}' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_dots_heading',
			[
				'label'     => esc_html__( 'Dots', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
			'style_tabs_dots'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'item_dots_bgcolor',
			[
				'label'     => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__button' => '--ffl-button-bg-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_dots_color',
			[
				'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__button' => '--ffl-button-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_dots_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__button' => '--ffl-button-border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'item_dots_bgcolor_hover',
			[
				'label'     => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__button' => '--ffl-button-bg-color-hover: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_dots_color_hover',
			[
				'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__button' => '--ffl-button-color-hover: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_dots_border_color_hover',
			[
				'label'     => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__button' => '--ffl-button-border-color-hover: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_active_tab',
			[
				'label' => esc_html__( 'Active', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'item_dots_bgcolor_active',
			[
				'label'     => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product.active .foodforlife-lookbook-carousel__button' => '--ffl-button-bg-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_dots_color_active',
			[
				'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product.active .foodforlife-lookbook-carousel__button' => '--ffl-button-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_dots_border_color_active',
			[
				'label'     => esc_html__( 'Border Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product.active .foodforlife-lookbook-carousel__button' => '--ffl-button-border-color: {{VALUE}}',
				],
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
			'item_image_heading',
			[
				'label'     => esc_html__( 'Image', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'item_image_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product-image' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-lookbook-carousel__product-image' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_image_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product-inner' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'item_title_heading',
			[
				'label'     => esc_html__( 'Title', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'selector' => '{{WRAPPER}} .foodforlife-lookbook-carousel__product-title',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_title_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_price_heading',
			[
				'label'     => esc_html__( 'Price', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_price_typography',
				'selector' => '{{WRAPPER}} .foodforlife-lookbook-carousel__product-price',
			]
		);

		$this->add_control(
			'item_price_color',
			[
				'label'     => esc_html__( 'Regular Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_price_color_ins',
			[
				'label'     => esc_html__( 'Sale Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-lookbook-carousel__product-price ins' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_button_heading',
			[
				'label'     => esc_html__( 'Button', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     => __( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-button' => '--ffl-button-bg-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Text Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-button' => '--ffl-button-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => __( 'Border Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .foodforlife-button' => '--ffl-button-border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => __( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-button' => '--ffl-button-bg-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Text Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-button' => '--ffl-button-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-button' => '--ffl-button-border-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_effect_hover_color',
			[
				'label'     => __( 'Background Effect Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-button' => '--ffl-button-eff-bg-color-hover: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function section_style_carousel() {
		$this->start_controls_section(
			'section_style_slider',
			[
				'label' => esc_html__( 'Carousel Style', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_carousel_style_controls();

		$this->add_control(
			'arrows_dots_style_heading',
			[
				'label'     => esc_html__( 'Arrows And Dots', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'arrows_dots_background_color',
			[
				'label'     => esc_html__( 'Background color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-pagination--dots-arrow__wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_dots_padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-pagination--dots-arrow__wrapper' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_dots_border_radius',
			[
				'label'      => __( 'Border radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-pagination--dots-arrow__wrapper' => 'border-start-start-radius: {{TOP}}{{UNIT}}; border-start-end-radius: {{RIGHT}}{{UNIT}}; border-end-end-radius: {{BOTTOM}}{{UNIT}}; border-end-start-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'arrows_dots_tabs'
		);

			$this->start_controls_tab(
				'arrows_dots_tab_arrows',
				[
					'label' => esc_html__( 'Arrows', 'foodforlife-addons' ),
				]
			);

				$this->add_responsive_control(
					'arrows_dots_size_arrows',
					[
						'label'     => esc_html__( 'Size', 'foodforlife-addons' ),
						'type'      => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'vh' ],
						'range'     => [
							'px' => [
								'min' => 0,
								'max' => 1000,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'arrows_dots_spacing_arrows',
					[
						'label'     => esc_html__( 'Spacing', 'foodforlife-addons' ),
						'type'      => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'vh' ],
						'range'     => [
							'px' => [
								'min' => 0,
								'max' => 1000,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-pagination' => 'margin: 0 {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'arrows_dots_color_arrows',
					[
						'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-button' => 'color: {{VALUE}}; opacity: 1;',
						],
					]
				);

				$this->add_control(
					'arrows_dots_disable_color_arrows',
					[
						'label'     => esc_html__( 'Disable Color', 'foodforlife-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-button.swiper-button-disabled' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'arrows_dots_tab_dots',
				[
					'label' => esc_html__( 'Dots', 'foodforlife-addons' ),
				]
			);

				$this->add_responsive_control(
					'arrows_dots_size_dots',
					[
						'label'     => esc_html__( 'Size', 'foodforlife-addons' ),
						'type'      => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'vh' ],
						'range'     => [
							'px' => [
								'min' => 0,
								'max' => 1000,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-pagination-bullets .swiper-pagination-bullet:before' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'arrows_dots_gap_dots',
					[
						'label'     => __( 'Gap', 'foodforlife-addons' ),
						'type'      => Controls_Manager::SLIDER,
						'range'     => [
							'px' => [
								'max' => 50,
								'min' => 0,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-pagination-bullet' => 'margin: 0 {{SIZE}}{{UNIT}}',
						],
					]
				);

				$this->add_control(
					'arrows_dots_color_dots',
					[
						'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-pagination-bullets .swiper-pagination-bullet:before' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'arrows_dots_active_color_dots',
					[
						'label'     => esc_html__( 'Active Color', 'foodforlife-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .swiper-pagination--dots-arrow .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active, .swiper-pagination--dots-arrow .swiper-pagination-bullets .swiper-pagination-bullet:hover' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$random_id = rand();

		$col = $settings['slides_to_show'];
		$col_tablet = ! empty( $settings['slides_to_show_tablet'] ) ? $settings['slides_to_show_tablet'] : $col;
		$col_mobile = ! empty( $settings['slides_to_show_mobile'] ) ? $settings['slides_to_show_mobile'] : $col;

        $this->add_render_attribute( 'wrapper', 'class', [ 'foodforlife-lookbook-carousel', 'foodforlife-carousel--elementor', 'swiper' ] );
		$this->add_render_attribute( 'wrapper', 'data-desktop', $col );
		$this->add_render_attribute( 'wrapper', 'data-tablet', $col_tablet );
		$this->add_render_attribute( 'wrapper', 'data-mobile', $col_mobile );
        $this->add_render_attribute( 'wrapper', 'style', [ $this->render_space_between_style() ] );
		$this->add_render_attribute( 'wrapper', 'style', $this->render_aspect_ratio_style() );
		
		$this->add_render_attribute( 'inner', 'class', [ 'foodforlife-lookbook-carousel__inner', 'd-flex', 'swiper-wrapper'] );
	
		$this->add_render_attribute( 'item', 'class', [ 'foodforlife-lookbook-carousel__item', 'position-relative', 'swiper-slide' ] );

        $this->add_render_attribute( 'image', 'class', [ 'foodforlife-lookbook-carousel__image', 'ffl-ratio' ] );

        $this->add_render_attribute( 'product', 'class', [ 'foodforlife-lookbook-carousel__product', 'position-absolute' ] );
        $this->add_render_attribute( 'product_inner', 'class', [ 'foodforlife-lookbook-carousel__product-inner', 'position-absolute', 'align-items-center', 'py-10', 'px-10', 'd-none', 'd-flex-xl', 'gap-20', 'rounded-5', 'bg-light', 'start-50', 'translate-middle-x', 'z-3', 'hidden' ] );
        $this->add_render_attribute( 'product_summary', 'class', [ 'foodforlife-lookbook-carousel__product-summary' ] );
        $this->add_render_attribute( 'product_image', 'class', [ 'foodforlife-lookbook-carousel__product-image', 'ffl-ratio' ] );
        $this->add_render_attribute( 'product_title', 'class', [ 'foodforlife-lookbook-carousel__product-title' ] );
        $this->add_render_attribute( 'product_price', 'class', [ 'foodforlife-lookbook-carousel__product-price' ] );
    ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'inner' ); ?>>
			<?php $control = apply_filters( 'foodforlife_images_hotspot_carousel_section_number', 4 );
				for ( $i = 1; $i <= $control; $i++ ) :
					if( ! empty( $settings['image_'. $i]['url'] ) ) : ?>
					<div class="foodforlife-lookbook-carousel__item-<?php echo esc_attr( $i ); ?> foodforlife-lookbook-carousel__item position-relative swiper-slide">
						<div <?php echo $this->get_render_attribute_string( 'image' ); ?>>
							<?php
								$image_args = [
									'image'        => ! empty( $settings['image_'. $i] ) ? $settings['image_'. $i] : '',
									'image_tablet' => ! empty( $settings['image_'. $i . '_tablet'] ) ? $settings['image_'. $i . '_tablet'] : '',
									'image_mobile' => ! empty( $settings['image_'. $i . '_mobile'] ) ? $settings['image_'. $i . '_mobile'] : '',
								];
							?>
							<?php echo \FoodForLife\Addons\Helper::get_responsive_image_elementor( $image_args ); ?>
						</div>
					<?php
						foreach( $settings['items_'. $i] as $index => $item ) :
							$attr = [
								'type'           => 'recent_products',
								'orderby'        => 'date',
								'order'          => '',
								'category'       => '',
								'tag'            => '',
								'product_brands' => '',
								'ids'            => $item['product_items_ids'],
								'limit'          => 1,
							];
							$product_ids = self::products_shortcode( $attr );
							$product_ids = ! empty($product_ids) ? $product_ids['ids'] : 0;

							$button_key = $this->get_repeater_setting_key( 'button', 'categories_carousel', $index );
							$this->add_render_attribute( $button_key, 'class', [ 'foodforlife-lookbook-carousel__button', 'ffl-button-light', 'ffl-button-icon', 'position-relative', 'z-1' ] );

							if( ! empty( $product_ids ) ) : ?>
									<div class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> foodforlife-lookbook-carousel__product position-absolute foodforlife-lookbook-carousel__position-<?php echo $item['product_content_vertical_position'] ?>">
										<div <?php echo $this->get_render_attribute_string( 'product_inner' ); ?>>
											<ul class="products">
												<?php \FoodForLife\Addons\Helper::products_list_shortcode_template( $product_ids, [ 'show_rating' => true ] ); ?>
											</ul>
										</div>
										<div class="foodforlife-lookbook-carousel__button-wrapper d-flex align-items-center justify-content-center position-relative">
											<button <?php echo $this->get_render_attribute_string( $button_key ); ?> data-target="lookbook-carousel-modal-<?php echo esc_attr( $random_id ); ?>" data-device="mobile" aria-label="<?php esc_attr_e('Hotpot Button', 'foodforlife-addons') ?>">
												<?php echo \FoodForLife\Addons\Helper::get_svg('plus-mini'); ?>
											</button>
										</div>
									</div>
							<?php endif;
						endforeach; ?>
					</div>
			<?php 	endif;
				endfor; ?>
			</div>
			<?php
			echo '<div class="swiper-arrows">'. $this->render_arrows() .'</div>';
			echo $this->render_pagination(); ?>
        </div>
		<div id="lookbook-carousel-modal-<?php echo esc_attr( $random_id ); ?>" class="lookbook-carousel-modal-<?php echo esc_attr( $random_id ); ?> foodforlife-lookbook-carousel lookbook-carousel-modal modal d-none-xl">
			<div class="modal__backdrop"></div>
			<div class="modal__container">
				<div class="modal__wrapper">
					<a href="#" class="foodforlife-lookbook-carousel__close modal__button-close ffl-button ffl-button-icon ffl-button-light position-absolute top-10 end-10 z-3">
						<?php echo \FoodForLife\Addons\Helper::get_svg( 'close' ); ?>
					</a>
					<div class="modal__content lookbook-carousel-modal-content em-flex em-flex-align-center"></div>
				</div>
			</div>
		</div>
    <?php
	}
}