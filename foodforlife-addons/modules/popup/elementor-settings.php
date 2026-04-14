<?php
namespace FoodForLife\Addons\Modules\Popup;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Base\Module;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Core\DocumentTypes\PageBase as PageBase;

class Elementor_Settings extends Module {
	/**
	 * Get module name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'display-settings';
	}

	/**
	 * Module constructor.
	 */
	public function __construct() {
		add_action( 'elementor/documents/register_controls', [ $this, 'register_display_controls' ] );
		add_action( 'elementor/document/after_save', [ $this, 'sync_settings_from_elementor' ], 10, 2 );
	}


	/**
	 * Register display controls.
	 *
	 * @param object $document
	 */
	public function register_display_controls( $document ) {
		if ( ! $document instanceof PageBase ) {
			return;
		}

		$post_type = get_post_type( $document->get_main_id() );

		if ( 'foodforlife_popup' != $post_type ) {
			return;
		}

		add_action('elementor/element/after_section_end', [ $this, 'update_controls' ]);

		$this->register_popup_content( $document );
		$this->register_popup_style( $document );

	}

	/**
	 * Register template controls of display.
	 *
	 * @param object $document
	 */
	protected function register_popup_content( $document ) {
		$document->start_controls_section(
			'section_display',
			[
				'label' => __( 'Popup Settings', 'foodforlife-addons' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		$document->add_control(
			'popup_display',
			[
				'label'        => esc_html__( 'Display', 'foodforlife-addons' ),
				'type'         => Controls_Manager::HEADING,
				'default'      => '',
			]
		);

		$document->add_control(
			'enable_popup',
			[
				'label'        => esc_html__( 'Enable Popup', 'foodforlife-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',

			]
		);

		$document->add_control(
			'popup_display_type',
			[
				'label'       => esc_html__( 'Display Type', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'popup' => esc_html__( 'Popup', 'foodforlife-addons' ),
					'slide' => esc_html__( 'Slide-in Panel', 'foodforlife-addons' ),
				],
				'default'     => 'popup',
			]
		);

		$document->add_control(
			'popup_position',
			[
				'label'       => esc_html__( 'Position', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'center' => esc_html__( 'Center', 'foodforlife-addons' ),
					'left-bottom'      	=> esc_html__( 'Left Bottom', 'foodforlife-addons' ),
					'right-bottom'      => esc_html__( 'Right Bottom', 'foodforlife-addons' ),
					'left-top'      	=> esc_html__( 'Left Top', 'foodforlife-addons' ),
					'right-top'      	=> esc_html__( 'Right Top', 'foodforlife-addons' ),
				],
				'default'     => 'center',
				'condition' => [
					'popup_display_type' => 'popup',
				],
			]
		);

		$document->add_control(
			'popup_frequency',
			[
				'label'        => esc_html__( 'Frequency', 'foodforlife-addons' ),
				'type'         => Controls_Manager::NUMBER,
				'description' => esc_html__('Hide the popup for this many days when the close icon is clicked', 'foodforlife-addons' ),
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 1,

			]
		);

		$document->add_control(
			'popup_triggers',
			[
				'label'        => esc_html__( 'Triggers', 'foodforlife-addons' ),
				'type'         => Controls_Manager::HEADING,
				'default'      => '',
				'separator' => 'before',

			]
		);

		$document->add_control(
			'popup_visible',
			[
				'label'       => esc_html__( 'Visible', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'loaded' 		=> esc_html__( 'After page loads', 'foodforlife-addons' ),
					'delayed'      	=> esc_html__( 'Wait for seconds', 'foodforlife-addons' ),
					'exit'      	=> esc_html__( 'Exit Intent', 'foodforlife-addons' ),
				],
				'default'     => 'loaded',
			]
		);

		$document->add_control(
			'popup_seconds',
			[
				'label'       => esc_html__( 'Seconds', 'foodforlife-addons' ),
				'type'         => Controls_Manager::NUMBER,
				'description' => esc_html__('The time before the popup is displayed, after the page loaded', 'foodforlife-addons' ),
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 5,
				'conditions' => [
					'terms' => [
						[
							'name' => 'popup_visible',
							'operator' => '==',
							'value' => 'delayed'
						],
					]
				]
			]
		);

		$document->add_control(
			'popup_targeting',
			[
				'label'        => esc_html__( 'Targeting', 'foodforlife-addons' ),
				'type'         => Controls_Manager::HEADING,
				'default'      => '',
				'separator' => 'before',

			]
		);

		$pages = get_pages();
		foreach( $pages as $page ) {
			$page_options[$page->ID] = $page->post_title;
		}
		$document->add_control(
			'popup_include_pages',
			[
				'label'       => esc_html__( 'Include Pages', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $page_options,
				'default'     => '',
				'multiple' => true,
			]
		);

		$document->add_control(
			'popup_exclude_pages',
			[
				'label'       => esc_html__( 'Exclude Pages', 'foodforlife-addons' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $page_options,
				'default'     => '',
				'multiple' => true,
			]
		);

		$document->end_controls_section();

	}

	/**
	 * Register template controls of display.
	 *
	 * @param object $document
	 */
	protected function register_popup_style( $document ) {
		$document->start_controls_section(
			'popup_style',
			[
				'label' => esc_html__( 'Popup Style', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$document->add_control(
			'popup_background_color',
			[
				'label'     => __( 'Background Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.foodforlife-popup-' . get_the_ID() . ' .foodforlife-popup__wrapper' => 'background-color: {{VALUE}};',
					'body.single-foodforlife_popup.postid-' . get_the_ID() .' .foodforlife-popup__wrapper .elementor-section-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$document->add_control(
			'popup_width',
			[
				'label' => esc_html__( 'Width', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1170,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vw' ],
				'default' => [
					'size' => 690,
				],
				'selectors' => [
					'.foodforlife-popup-' . get_the_ID() => '--ffl-modal-content-width: {{SIZE}}{{UNIT}};',
					'body.single-foodforlife_popup.postid-' . get_the_ID() .' .foodforlife-popup__wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$document->add_control(
			'popup_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [],
				'selectors'  => [
					'.foodforlife-popup-' . get_the_ID() => '--ffl-modal-content-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.single-foodforlife_popup.postid-' . get_the_ID() .' .foodforlife-popup__wrapper .elementor-section-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$document->add_control(
			'popup_close_heading',
			[
				'label' => __( 'Close', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$document->add_control(
			'popup_close_size',
			[
				'label' => esc_html__( 'Size', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'size_units' => [ 'px' ],
				'default' => [],
				'selectors' => [
					'.foodforlife-popup-' . get_the_ID() . ' .foodforlife-popup__close' => 'font-size: {{SIZE}}{{UNIT}};',
					'body.single-foodforlife_popup.postid-' . get_the_ID() .' .foodforlife-popup__close' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$document->add_control(
			'popup_close_position_top',
			[
				'label' => esc_html__( 'Position Top', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'default' => [],
				'selectors' => [
					'.foodforlife-popup-' . get_the_ID() . ' .foodforlife-popup__close' => 'top: {{SIZE}}{{UNIT}};',
					'body.single-foodforlife_popup.postid-' . get_the_ID() .' .foodforlife-popup__close' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$document->add_control(
			'popup_close_position_right',
			[
				'label' => esc_html__( 'Position Right', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'default' => [],
				'selectors' => [
					'.foodforlife-popup-' . get_the_ID() . ' .foodforlife-popup__close' => 'right: {{SIZE}}{{UNIT}};',
					'body.single-foodforlife_popup.postid-' . get_the_ID() .' .foodforlife-popup__close' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$document->add_control(
			'popup_close_color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.foodforlife-popup-' . get_the_ID() . ' .foodforlife-popup__close' => 'color: {{VALUE}};',
					'body.single-foodforlife_popup.postid-' . get_the_ID() .' .foodforlife-popup__close' => 'color: {{VALUE}};',
				],
			]
		);

		$document->add_control(
			'popup_close_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.foodforlife-popup-' . get_the_ID() . ' .foodforlife-popup__close:hover' => 'color: {{VALUE}};',
					'body.single-foodforlife_popup.postid-' . get_the_ID() .' .foodforlife-popup__close:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$document->end_controls_section();

	}

	/**
	 * @param $element    Controls_Stack
	 */
	public function update_controls( $document ) {
		$document->remove_control( 'hide_title' );
		$document->remove_control( 'section_page_style' );
	}

	/**
	 * Map element settings to theme settings.
	 *
	 * @param \Elementor\Core\Base\Document $document
	 * @param array $data
	 */
	public function sync_settings_from_elementor( $document, $data ) {
		if ( ! isset( $data['settings'] ) ) {
			return;
		}

		$post_id  = $document->get_main_id();
		$settings = $this->get_settings_map();

		foreach ( $settings as $elementor_setting => $theme_setting ) {
			if ( isset( $data['settings'][ $elementor_setting ] ) ) {
				$value = $data['settings'][ $elementor_setting ];
			} else {
				$control = $document->get_controls( $elementor_setting );
				$value = isset( $control['default'] ) ? $control['default'] : '';
			}
			if ( $theme_setting == 'enable_popup' ) {
				$value = empty($value) ? 'no' : 'yes';
			}

			if ( $theme_setting == 'popup_include_pages' ) {
				$value = empty($value) ? '0' : $value;
			}

			update_post_meta( $post_id, $theme_setting, $value );
		}
	}

		/**
	 * Get the array of mapping setting names.
	 *
	 * @return array
	 */
	protected function get_settings_map() {
		return [
			'enable_popup'                => 'enable_popup',
			'popup_include_pages'         => 'popup_include_pages',
			'popup_exclude_pages'         => 'popup_exclude_pages',
		];
	}

}