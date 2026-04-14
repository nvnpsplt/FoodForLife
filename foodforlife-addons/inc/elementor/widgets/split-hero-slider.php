<?php

namespace FoodForLife\Addons\Elementor\Widgets;

use FoodForLife\Addons\Elementor\Base\Carousel_Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Stroke;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Split Hero Slider widget
 */
class Split_Hero_Slider extends Carousel_Widget_Base {
	use \FoodForLife\Addons\Elementor\Base\Aspect_Ratio_Base;
	use \FoodForLife\Addons\Elementor\Base\Button_Base;

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-split-hero-slider';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( '[FoodForLife] Split Hero Slider', 'foodforlife-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-slider';
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
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'split hero slider', 'slider', 'hero slider', 'foodforlife-addons' ];
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

	/**
	 * Get style dependencies.
	 *
	 *
	 * @return array Widget style dependencies.
	 */
	public function get_style_depends(): array {
		return [ 'foodforlife-slides-css' ];
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
		$this->section_content_slides();
		$this->section_slider_options();
	}

	protected function section_content_slides() {
		$this->start_controls_section(
			'section_slides',
			[
				'label' => esc_html__( 'Slides', 'foodforlife-addons' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( 'slides_repeater' );


		$repeater->start_controls_tab( 'text_content', [ 'label' => esc_html__( 'Content', 'foodforlife-addons' ) ] );

		$repeater->add_responsive_control(
			'banner_background_img',
			[
				'label'    => __( 'Image', 'foodforlife-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => wc_placeholder_img_src(),
				],
			]
		);

		$repeater->add_control(
			'before_title',
			[
				'label'       => esc_html__( 'Before Title', 'foodforlife-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'foodforlife-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Slide Title', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'foodforlife-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
			]
		);

		$repeater->add_control(
			'button_heading',
			[
				'label' => esc_html__( 'Button', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->register_button_repeater_controls($repeater);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'style', [ 'label' => esc_html__( 'Style', 'foodforlife-addons' ) ] );

		$repeater->add_control(
			'custom_style',
			[
				'label'       => esc_html__( 'Custom', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Set custom style that will only affect this specific slide.', 'foodforlife-addons' ),
			]
		);

		$repeater->add_responsive_control(
			'custom_slides_horizontal_position',
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
				'default'     => '',
				'selectors'            => [
					'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__slide' => 'justify-content: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'left'   => 'flex-start',
					'center' => 'center',
					'right'  => 'flex-end',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'custom_slides_vertical_position',
			[
				'label'                => esc_html__( 'Vertical Position', 'foodforlife-addons' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'top'   => [
						'title' => esc_html__( 'Top', 'foodforlife-addons' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'foodforlife-addons' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom'  => [
						'title' => esc_html__( 'Bottom', 'foodforlife-addons' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'     => '',
				'selectors'            => [
					'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__slide' => 'align-items: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top'   => 'flex-start',
					'middle' => 'center',
					'bottom'  => 'flex-end',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'custom_slides_text_align',
			[
				'label'       => esc_html__( 'Text Align', 'foodforlife-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'start'   => [
						'title' => esc_html__( 'Left', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'  => [
						'title' => esc_html__( 'Right', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__slide' => 'text-align: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'content_heading_name',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'content_custom_bg_color',
			[
				'label'      => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'title_heading_name',
			[
				'label' => esc_html__( 'Title', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'title_custom_color',
			[
				'label'      => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__title' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_custom_text_stroke',
				'selector' => '{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__title',
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'desc_heading_name',
			[
				'label' => esc_html__( 'Description', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'content_custom_color',
			[
				'label'      => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__description' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				]
			]
		);

		$repeater->add_control(
			'custom_button_options',
			[
				'label'        => __( 'Button', 'foodforlife-addons' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'foodforlife-addons' ),
				'label_on'     => __( 'Custom', 'foodforlife-addons' ),
				'return_value' => 'yes',
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->start_popover();

		$repeater->add_control(
			'custom_button_style_normal_heading',
			[
				'label' => esc_html__( 'Normal', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'custom_button_background_color',
			[
				'label'      => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__button' => 'background-color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'custom_button_color',
			[
				'label'      => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__button' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'custom_button_border_color',
			[
				'label' => __( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__button' => 'border-color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'custom_button_style_hover_heading',
			[
				'label' => esc_html__( 'Hover', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

			$repeater->add_control(
				'custom_button_hover_background_color',
				[
					'label' => __( 'Background Color', 'foodforlife-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__button:hover' => 'background-color: {{VALUE}};',
					],
					'conditions' => [
						'terms' => [
							[
								'name'  => 'custom_style',
								'value' => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'custom_button_hover_color',
				[
					'label' => __( 'Color', 'foodforlife-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__button:hover' => 'color: {{VALUE}};',
					],
					'conditions' => [
						'terms' => [
							[
								'name'  => 'custom_style',
								'value' => 'yes',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'custom_button_hover_border_color',
				[
					'label' => __( 'Border Color', 'foodforlife-addons' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .foodforlife-split-hero-slider {{CURRENT_ITEM}} .foodforlife-split-hero-slider__button:hover' => 'border-color: {{VALUE}};',
					],
					'conditions' => [
						'terms' => [
							[
								'name'  => 'custom_style',
								'value' => 'yes',
							],
						],
					],
				]
			);

		$repeater->end_popover();

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label'      => esc_html__( 'Slides', 'foodforlife-addons' ),
				'type'       => Controls_Manager::REPEATER,
				'show_label' => true,
				'fields'     => $repeater->get_controls(),
				'default'    => [
					[
						'before_title' => esc_html__( 'Before Title', 'foodforlife-addons' ),
						'title'        => esc_html__( 'Slide 1 Title', 'foodforlife-addons' ),
						'description'  => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'foodforlife-addons' ),
						'button_text'  => esc_html__( 'Click Here', 'foodforlife-addons' ),
					],
					[
						'before_title' => esc_html__( 'Before Title', 'foodforlife-addons' ),
						'title'        => esc_html__( 'Slide 2 Title', 'foodforlife-addons' ),
						'description'  => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'foodforlife-addons' ),
						'button_text'  => esc_html__( 'Click Here', 'foodforlife-addons' ),
					],
					[
						'before_title' => esc_html__( 'Before Title', 'foodforlife-addons' ),
						'title'        => esc_html__( 'Slide 3 Title', 'foodforlife-addons' ),
						'description'  => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'foodforlife-addons' ),
						'button_text'  => esc_html__( 'Click Here', 'foodforlife-addons' ),
					],
				],
			]
		);

		$this->register_aspect_ratio_controls( [], [ 'aspect_ratio_type' => '' ] );

		$this->end_controls_section();
	}

	protected function section_slider_options() {
		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => esc_html__( 'Slider Options', 'foodforlife-addons' ),
				'type'  => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'effect',
			[
				'label'   => esc_html__( 'Effect', 'foodforlife-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'fade'   	 => esc_html__( 'Fade', 'foodforlife-addons' ),
					'slide' 	 => esc_html__( 'Slide', 'foodforlife-addons' ),
				],
				'default' => 'slide',
				'toggle'  => false,
				'frontend_available' => true,
			]
		);

		$controls = [
			'slides_to_show'   => 1,
			'slides_to_scroll' => 1,
			'navigation'       => 'dots',
			'autoplay'         => '',
			'autoplay_speed'   => 3000,
			'pause_on_hover'   => 'yes',
			'animation_speed'  => 800,
			'infinite'         => '',
		];

		$this->register_carousel_controls($controls);

		$this->end_controls_section();
	}

	// Tab Style
	protected function section_style() {
		$this->section_style_content();
		$this->section_style_button();
		$this->section_style_carousel();
	}

	// Els
	protected function section_style_title() {
		$this->add_control(
			'heading_title',
			[
				'label'     => esc_html__( 'Title', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'      => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__title',
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
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
	}

	protected function section_style_before_title() {
		$this->add_control(
			'heading_before_title',
			[
				'label'     => esc_html__( 'Before Title', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'before_title_color',
			[
				'label'      => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__before-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'before_title_typography',
				'selector' => '{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__before-title',
			]
		);


		$this->add_responsive_control(
			'before_title_background_color',
			[
				'label'      => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__before-title' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'before_title_padding',
			[
				'label'      => esc_html__( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__before-title' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'before_title_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__before-title' => 'border-start-start-radius: {{TOP}}{{UNIT}}; border-start-end-radius: {{RIGHT}}{{UNIT}}; border-end-end-radius: {{BOTTOM}}{{UNIT}}; border-end-start-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'before_title_spacing',
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
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__before-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
	}

	protected function section_style_desc() {
		// Description
		$this->add_control(
			'heading_description',
			[
				'label'     => esc_html__( 'Description', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__description' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__description',
			]
		);

		$this->add_responsive_control(
			'description_spacing',
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
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_padding',
			[
				'label'      => esc_html__( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide .foodforlife-split-hero-slider__description' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	protected function section_style_content() {
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slides_content_width',
			[
				'label'      => esc_html__( 'Width', 'foodforlife-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1900,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_content_horizontal_position',
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
				'default'     => '',
				'selectors'            => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide' => 'justify-content: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'left'   => 'flex-start',
					'center' => 'center',
					'right'  => 'flex-end',
				],
			]
		);

		$this->add_responsive_control(
			'slides_content_vertical_position',
			[
				'label'                => esc_html__( 'Vertical Position', 'foodforlife-addons' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'top'   => [
						'title' => esc_html__( 'Top', 'foodforlife-addons' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'foodforlife-addons' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom'  => [
						'title' => esc_html__( 'Bottom', 'foodforlife-addons' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'     => '',
				'selectors'            => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide' => 'align-items: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top'   => 'flex-start',
					'middle' => 'center',
					'bottom'  => 'flex-end',
				],
			]
		);

		$this->add_responsive_control(
			'slides_content_text_align',
			[
				'label'       => esc_html__( 'Text Align', 'foodforlife-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'start'   => [
						'title' => esc_html__( 'Left', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'  => [
						'title' => esc_html__( 'Right', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__slide' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'slides_content_background_color',
			[
				'label'      => esc_html__( 'Background Color', 'foodforlife-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'slides_content_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-split-hero-slider' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->section_style_before_title();

		$this->section_style_title();

		$this->section_style_desc();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_images',
			[
				'label' => esc_html__( 'Images', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slides_images_width',
			[
				'label'      => esc_html__( 'Width', 'foodforlife-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1900,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__images' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_images_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-split-hero-slider__images' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-split-hero-slider__images' => '--ffl-image-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function section_style_button() {
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_button_style_controls();

		$this->end_controls_section();
	}

	protected function section_style_carousel() {
		$this->start_controls_section(
			'section_style_slider',
			[
				'label' => esc_html__( 'Slider Options', 'foodforlife-addons' ),
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

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		$this->add_render_attribute( 'images', 'class', [ 'foodforlife-split-hero-slider__images', 'ffl-image-rounded', 'ffl-ratio', 'ffl-ratio-mobile', 'w-50-md' ] );
		$this->add_render_attribute( 'images', 'style', $this->render_aspect_ratio_style() );

		$this->add_render_attribute( 'wrapper', 'class', [ 'foodforlife-split-hero-slider', 'foodforlife-carousel--elementor', 'foodforlife-carousel--background', 'rounded-15', 'swiper', 'w-50-md', 'w-100' ] );
		$this->add_render_attribute( 'wrapper', 'style', $this->render_aspect_ratio_style() );

		$this->add_render_attribute( 'inner', 'class', [ 'foodforlife-split-hero-slider__inner', 'swiper-wrapper' ] );

		$this->add_render_attribute( 'slide', 'class', [ 'foodforlife-split-hero-slider__slide', 'd-flex', 'flex-column', 'justify-content-center', 'align-items-center', 'text-center', 'h-100', 'px-20', 'py-30' ] );

		$this->add_render_attribute( 'before_title', 'class', [ 'foodforlife-split-hero-slider__before-title', 'mb-15', 'text-dark', 'fs-12', 'fw-semibold', 'text-uppercase', 'lh-normal' ] );
		$this->add_render_attribute( 'title', 'class', [ 'foodforlife-split-hero-slider__title', 'mt-0', 'mb-24', 'text-dark', 'fw-semibold', 'lh-normal', 'heading-letter-spacing' ] );
		$this->add_render_attribute( 'description', 'class', [ 'foodforlife-split-hero-slider__description', 'fs-15', 'text-base', 'mb-xl-50', 'mb-33' ] );

		if ( ! empty( $settings['slides_content_background_color'] ) ) {
			$this->add_render_attribute( 'slide', 'class', [ 'foodforlife-slide__content-background' ] );
		}
	?>
	<div class="d-flex gap-20 flex-column flex-md-row-reverse">
		<div <?php echo $this->get_render_attribute_string( 'images' ); ?>>
			<?php foreach ( $settings['slides'] as $index => $slide ) { ?>
				<div class="foodforlife-split-hero-slider__image slide-<?php echo esc_attr( $index ); ?> <?php echo esc_attr( $index == 0 ? 'active' : '' ); ?>">
					<?php if( ! empty( $slide['banner_background_img'] ) && ! empty( $slide['banner_background_img']['url'] ) ) { ?>
						<?php $image_args = [
							'image'        => ! empty( $slide['banner_background_img'] ) ? $slide['banner_background_img'] : '',
							'image_tablet' => ! empty( $slide['banner_background_img_tablet'] ) ? $slide['banner_background_img_tablet'] : '',
							'image_mobile' => ! empty( $slide['banner_background_img_mobile'] ) ? $slide['banner_background_img_mobile'] : '',
						];
						echo \FoodForLife\Addons\Helper::get_responsive_image_elementor( $image_args );
					} ?>
				</div>
			<?php } ?>
		</div>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'inner' ); ?>>
			<?php
				foreach ( $settings['slides'] as $index => $slide ) {
				?>
					<div class="elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?> foodforlife-split-hero-slider__item swiper-slide" data-slide="slide-<?php echo esc_attr( $index ); ?>" data-background-color="<?php echo esc_attr( $slide['content_custom_bg_color'] ); ?>">
						<div <?php echo $this->get_render_attribute_string( 'slide' ); ?>>
							<?php if ( $slide['before_title'] ) : ?>
								<div <?php echo $this->get_render_attribute_string( 'before_title' ); ?>><?php echo wp_kses_post( $slide['before_title'] ); ?></div>
							<?php endif; ?>

							<?php if ( $slide['title'] ) : ?>
								<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $slide['title'] ); ?></h2>
							<?php endif; ?>

							<?php if ( $slide['description'] ) : ?>
								<div <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( $slide['description'] ); ?></div>
							<?php endif; ?>

							<?php
								$slide['button_style'] = $settings['button_style'];
								$slide['button_classes'] = ' foodforlife-split-hero-slider__button';
								$this->render_button( $slide, $index );
							?>
						</div>
					</div>
				<?php
				}
			?>
			</div>
			<div class="swiper-arrows">
				<?php echo $this->render_arrows(); ?>
			</div>
			<?php
				echo $this->render_pagination();
			?>
		</div>
	</div>
	<?php
	}
}