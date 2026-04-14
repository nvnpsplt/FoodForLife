<?php

/**
 * Header Options Partial
 *
 * @package FoodForLife
 * @since   1.8.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

		$settings['header_top'] = array(
			'topbar'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Topbar', 'foodforlife' ),
				'description' => esc_html__( 'Display a bar on the top', 'foodforlife' ),
				'default'     => false,
				'priority' => 5,
			),
			'topbar_fullwidth'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Topbar Full Width', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 5,
			),
			'topbar_custom_hr_1'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 10,
			),
			'topbar_left'       => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Left Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the left side of the topbar', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'item',
				),
				'fields'          => array(
					'item' => array(
						'type'    => 'select',
						'choices' => $this->topbar_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 15,
			),
			'topbar_right'      => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Right Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the right side of the topbar', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'item',
				),
				'fields'          => array(
					'item' => array(
						'type'    => 'select',
						'choices' => $this->topbar_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 25,
			),
			'topbar_custom_hr_2'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 30,
			),
			'topbar_slides'       => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Slides Item', 'foodforlife' ),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Slide', 'foodforlife' ),
					'field' => 'text',
				),
				'fields'          => array(
					'text' => array(
						'type'    => 'textarea',
						'label'   => esc_html__( 'Text', 'foodforlife' ),
						'sanitize_callback' => 'FoodForLife\Icon::sanitize_svg',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 35,
			),
			'topbar_custom_heading_3'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 40,
			),
			'topbar_menu'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Menu Item', 'foodforlife' ),
				'default'         => '',
				'choices'         => $this->get_menus(),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 40,
			),
			'topbar_custom_html'       => array(
				'type'            => 'textarea',
				'label'           => esc_html__( 'Custom HTML', 'foodforlife' ),
				'description'     => esc_html__( 'Paste your HTML here', 'foodforlife' ),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 43,
			),
			'topbar_custom_heading_4'    => array(
				'type'    => 'custom',
				'default' => '<hr/><h2>'. esc_html__( 'Topbar Background', 'foodforlife' ) .'</h2>',
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 45,
			),
			'topbar_background_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Background Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.topbar',
						'property' => '--ffl-background-color',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 60,
			),
			'topbar_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.topbar',
						'property' => '--ffl-text-color',
					),
					array(
						'element'  => '.topbar-slides .swiper .swiper-button-text',
						'property' => '--ffl-arrow-color',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 65,
			),
			'topbar_hover_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Hover Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.topbar',
						'property' => '--ffl-text-hover-color',
					),
					array(
						'element'  => '.topbar-slides .swiper .swiper-button-text',
						'property' => '--ffl-arrow-color-hover',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 65,
			),
			'topbar_border_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Border Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.topbar',
						'property' => '--ffl-topbar-border-color',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'topbar_border',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 65,
			),
			'topbar_custom_heading_5'    => array(
				'type'    => 'custom',
				'default' => '<hr/><h2>'. esc_html__( 'Topbar Style', 'foodforlife' ) .'</h2>',
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 70,
			),
			'topbar_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__('Height', 'foodforlife'),
				'transport' => 'postMessage',
				'default'    => [
					'desktop' => 42,
					'tablet'  => 42,
					'mobile'  => 42,
				],
				'responsive' => true,
				'choices'   => array(
					'min' => 0,
					'max' => 200,
				),
				'output'         => array(
					array(
						'element'  => '.topbar',
						'property' => 'height',
						'units'    => 'px',
						'media_query' => [
							'desktop' => '@media (min-width: 1200px)',
							'tablet'  => is_customize_preview() ? '@media (min-width: 699px) and (max-width: 1199px)' : '@media (min-width: 768px) and (max-width: 1199px)',
							'mobile'  => '@media (max-width: 767px)',
						],
					),
					array(
						'element'  => '.topbar .topbar-items',
						'property' => 'line-height',
						'units'    => 'px',
						'media_query' => [
							'desktop' => '@media (min-width: 1200px)',
							'tablet'  => is_customize_preview() ? '@media (min-width: 699px) and (max-width: 1199px)' : '@media (min-width: 768px) and (max-width: 1199px)',
							'mobile'  => '@media (max-width: 767px)',
						],
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 70,
			),
			'topbar_border'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Border', 'foodforlife' ),
				'default'     => false,
				'priority' 	=> 75,
				'active_callback' => array(
					array(
						'setting'  => 'topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Header layout settings.
		$settings['header_layout'] = array(
			'header_present' => array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Present', 'foodforlife' ),
				'description' => esc_html__( 'Select a prebuilt header or build your own', 'foodforlife' ),
				'default'     => 'prebuild',
				'choices'     => array(
					'prebuild' => esc_html__( 'Use pre-build header', 'foodforlife' ),
					'custom'   => esc_html__( 'Build my own', 'foodforlife' ),
				),
			),
			'header_version' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Prebuilt Header', 'foodforlife' ),
				'description'     => esc_html__( 'Select a prebuilt header present', 'foodforlife' ),
				'default'         => 'v2',
				'choices'         => array(
					'v1'  => esc_html__( 'Header V1', 'foodforlife' ),
					'v2'  => esc_html__( 'Header V2', 'foodforlife' ),
					'v3'  => esc_html__( 'Header V3', 'foodforlife' ),
					'v4'  => esc_html__( 'Header V4', 'foodforlife' ),
					'v5'  => esc_html__( 'Header V5', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_fullwidth'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Full Width', 'foodforlife' ),
				'default'     => true,
			),
			'header_element'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'header_prebuild_currency'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Currency', 'foodforlife' ),
				'default'     => false,
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_prebuild_search'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Search', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_prebuild_account'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Account', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_prebuild_wishlist'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Wishlist', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_prebuild_compare'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Compare', 'foodforlife' ),
				'default'     => false,
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_prebuild_cart'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Cart', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
		);

		// Header main settings.
		$settings['header_main'] = array(
			'header_main_left'   => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Left Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the left side of header main', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'item',
				),
				'fields'          => array(
					'item' => array(
						'type'    => 'select',
						'choices' => $this->header_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_main_left' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Main::instance(), 'render' ),
					),
				),
				'priority' => 10,
			),
			'header_main_center' => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Center Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items at the center of header main', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'item',
				),
				'fields'          => array(
					'item' => array(
						'type'    => 'select',
						'choices' => $this->header_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_main_center' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Main::instance(), 'render' ),
					),
				),
				'priority' => 15,
			),
			'header_main_right'  => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Right Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the right of header main', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'item',
				),
				'fields'          => array(
					'item' => array(
						'type'    => 'select',
						'choices' => $this->header_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_main_right' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Main::instance(), 'render' ),
					),
				),
				'priority' => 20,
			),
			'header_main_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'priority' => 25,
			),
			'header_main_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Height', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '70',
				'choices'   => array(
					'min' => 50,
					'max' => 500,
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header__desktop .header-main',
						'property' => 'height',
						'units'    => 'px',
					),
				),
				'priority' => 30,
			),
			'header_main_divider'        => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Divider', 'foodforlife' ),
				'default'         => true,
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'priority' => 35,
			),
		);

		// Header bottom settings.
		$settings['header_bottom'] = array(
			'header_bottom_left'   => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Left Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the left side of header bottom', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'item',
				),
				'fields'          => array(
					'item' => array(
						'type'    => 'select',
						'choices' => $this->header_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_bottom_left' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Main::instance(), 'render' ),
					),
				),
				'priority' => 10,
			),
			'header_bottom_center' => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Center Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items at the center of header bottom', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'item',
				),
				'fields'          => array(
					'item' => array(
						'type'    => 'select',
						'choices' => $this->header_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_bottom_center' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Main::instance(), 'render' ),
					),
				),
				'priority' => 15,
			),
			'header_bottom_right'  => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Right Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the right of header bottom', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'item',
				),
				'fields'          => array(
					'item' => array(
						'type'    => 'select',
						'choices' => $this->header_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_bottom_right' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Main::instance(), 'render' ),
					),
				),
				'priority' => 20,
			),
			'header_bottom_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'priority' => 25,
			),
			'header_bottom_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Height', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '60',
				'choices'   => array(
					'min' => 30,
					'max' => 500,
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header__desktop .header-bottom',
						'property' => 'height',
						'units'    => 'px',
					),
				),
				'priority' => 30,
			),
			'header_bottom_divider'        => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Divider', 'foodforlife' ),
				'default'         => true,
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'priority' => 35,
			),
		);

		// Header sticky settings.
		$settings['header_sticky'] = array(
			'header_sticky'        => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Sticky Header', 'foodforlife' ),
				'default'         => false,
			),
			'header_sticky_on'   => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Sticky On', 'foodforlife' ),
				'default'         => 'down',
				'choices'         => array(
					'down' => esc_html__( 'Scroll Down', 'foodforlife' ),
					'up'   => esc_html__( 'Scroll Up', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_sticky',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'header_sticky_el'   => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Sticky Header Section', 'foodforlife' ),
				'default'         => 'header_main',
				'choices'         => array(
					'header_main'   => esc_html__('Header Main', 'foodforlife'),
					'header_bottom' => esc_html__('Header Bottom', 'foodforlife'),
					'both'          => esc_html__('Both', 'foodforlife'),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_sticky',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'header_sticky_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'header_sticky_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Header Main Height', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '85',
				'choices'   => array(
					'min' => 30,
					'max' => 400,
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_sticky',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'header_sticky_el',
						'operator' => '!==',
						'value'    => 'header_bottom',
					),
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header__desktop.minimized .header-main, .site-header__desktop.headroom--not-top .header-main',
						'property' => 'height',
						'units'    => 'px',
					),
					array(
						'element'  => '.site-header__desktop.minimized .header-sticky + .header-bottom, .site-header__desktop.headroom--not-top .header-sticky + .header-bottom',
						'property' => 'top',
						'units'    => 'px',
					),
				),
			),
			'header_sticky_bottom_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Header Bottom Height', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '64',
				'choices'   => array(
					'min' => 30,
					'max' => 400,
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_sticky',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'header_sticky_el',
						'operator' => '!==',
						'value'    => 'header_main',
					),
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header__desktop.minimized .header-bottom, .site-header__desktop.headroom--not-top .header-bottom',
						'property' => 'height',
						'units'    => 'px',
					),
				),
			),
		);

		$settings['header_background'] = array(
			'header_background_heading_1'    => array(
				'type'    => 'custom',
				'default' => '<h2>'. esc_html__( 'Header Main', 'foodforlife' ) .'</h2>',
			),
			'header_main_background_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-main',
						'property' => 'background-color',
					),
				),
			),
			'header_main_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-main',
						'property' => '--ffl-header-color',
					),
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-main',
						'property' => 'color',
					),
				),
			),
			'header_main_border_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-main',
						'property' => '--ffl-header-main-border-color',
					),
				),
			),
			'header_main_shadow_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Box Shadow Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-main',
						'property' => '--ffl-header-main-shadow-color',
					),
				),
			),
			'header_background_heading_2'    => array(
				'type'    => 'custom',
				'default' => '<hr/><h2>'. esc_html__( 'Header Bottom', 'foodforlife' ) .'</h2>',
			),
			'header_bottom_background_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-bottom',
						'property' => 'background-color',
					),
				),
			),
			'header_bottom_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-bottom',
						'property' => '--ffl-header-color',
					),
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-bottom',
						'property' => 'color',
					),
				),
			),
			'header_bottom_border_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-bottom',
						'property' => '--ffl-header-bottom-border-color',
					),
				),
			),
			'header_bottom_shadow_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Box Shadow Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__desktop .header-bottom',
						'property' => '--ffl-header-bottom-shadow-color',
					),
				),
			),
			'header_background_heading_3'    => array(
				'type'    => 'custom',
				'default' => '<hr/><h2>'. esc_html__( 'Header Counter', 'foodforlife' ) .'</h2>',
			),
			'header_counter_background_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Background Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.header-counter',
						'property' => '--ffl-color-primary',
					),
				),
			),
			'header_counter_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.header-counter',
						'property' => '--ffl-text-color-on-primary',
					),
				),
			),
		);


		// Campaign bar.
		$settings['header_campaign'] = array(
			'campaign_bar' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Campaign Bar', 'foodforlife' ),
				'description' => esc_html__( 'Display a bar before the site header.', 'foodforlife' ),
				'default'     => false,
				'priority' => 0,
			),
			'campaign_bar_type'                 => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Type', 'foodforlife' ),
				'default'     => 'countdown',
				'choices'     => array(
					'countdown'   => esc_html__('Countdown', 'foodforlife'),
					'slides' 	=> esc_html__('Slides', 'foodforlife'),
				),
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 10,
			),
			'campaign_bar_width' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Width', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '550',
				'choices'   => array(
					'min' => 100,
					'max' => 2000,
				),
				'js_vars'   => array(
					array(
						'element'  => '.campaign-bar-type--slides',
						'property' => '--ffl-campaign-bar-width',
						'units'    => 'px',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'campaign_bar_type',
						'operator' => '==',
						'value'    => 'slides',
					),
				),
			),
			'campaign_items_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 20,
			),
			'campaign_items'       => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Campaign Items', 'foodforlife' ),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Campaign', 'foodforlife' ),
					'field' => 'text',
				),
				'fields'          => array(
					'text' => array(
						'type'    => 'textarea',
						'label'   => esc_html__( 'Text', 'foodforlife' ),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'campaign_bar_type',
						'operator' => '==',
						'value'    => 'slides',
					),
				),
				'priority' => 25,
			),
			'campaign_image'           => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Image Before Text', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'campaign_bar_type',
						'operator' => '==',
						'value'    => 'countdown',
					),
				),
				'priority' => 30,
			),
			'campaign_text'       => array(
				'type'            => 'textarea',
				'label'           => esc_html__( 'Text', 'foodforlife' ),
				'description'     => esc_html__( 'Paste text of your campaign here', 'foodforlife' ),
				'output'          => array(
					array(
						'element' => '.campaign-bar',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'campaign_bar_type',
						'operator' => '==',
						'value'    => 'countdown',
					),
				),
				'priority' => 35,
			),
			'campaign_date'       => array(
				'type'            => 'date',
				'label'           => esc_html__( 'Date', 'foodforlife' ),
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'campaign_bar_type',
						'operator' => '==',
						'value'    => 'countdown',
					),
				),
				'priority' => 40,
			),
			'campaign_custom_heading'    => array(
				'type'    => 'custom',
				'default' => '<hr/><h2>'. esc_html__( 'Campaign Background', 'foodforlife' ) .'</h2>',
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 55,
			),
			'campaign_background_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Background Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.campaign-bar',
						'property' => '--ffl-campaign-background',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 60,
			),
			'campaign_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.campaign-bar',
						'property' => '--ffl-campaign-text-color',
					),
					array(
						'element'  => '.campaign-bar-type--slides .swiper .swiper-button-text',
						'property' => '--ffl-arrow-color',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 65,
			),
			'campaign_hover_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Hover Color', 'foodforlife' ),
				'default'   => '',
				'transport' => 'postMessage',
				'js_vars'   => array(
					array(
						'element'  => '.campaign-bar__close',
						'property' => '--ffl-button-color-hover',
					),
					array(
						'element'  => '.campaign-bar-type--slides .swiper .swiper-button-text',
						'property' => '--ffl-arrow-color-hover',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'campaign_bar',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 65,
			),
		);

		// Logo.
		$settings['header_logo'] = array(
			'logo_type'      => array(
				'type'    => 'radio',
				'label'   => esc_html__( 'Logo Type', 'foodforlife' ),
				'default' => 'image',
				'choices' => array(
					'image' => esc_html__( 'Image', 'foodforlife' ),
					'text'  => esc_html__( 'Text', 'foodforlife' ),
					'svg'   => esc_html__( 'SVG', 'foodforlife' ),
				),
			),
			'logo_text'      => array(
				'type'            => 'text',
				'label'           => esc_html__( 'Logo Text', 'foodforlife' ),
				'default'         => 'FoodForLife',
				'active_callback' => array(
					array(
						'setting'  => 'logo_type',
						'operator' => '==',
						'value'    => 'text',
					),
				),
			),
			'logo_svg'       => array(
				'type'            => 'textarea',
				'label'           => esc_html__( 'Logo SVG', 'foodforlife' ),
				'description'     => esc_html__( 'Paste SVG code of your logo here', 'foodforlife' ),
				'sanitize_callback' => 'FoodForLife\Icon::sanitize_svg',
				'output'          => array(
					array(
						'element' => '.site-header .header-logo',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'logo_type',
						'operator' => '==',
						'value'    => 'svg',
					),
				),
			),
			'logo'           => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Logo', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'logo_type',
						'operator' => '==',
						'value'    => 'image',
					),
				),
			),
			'logo_light'           => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Logo Light', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'logo_type',
						'operator' => '==',
						'value'    => 'image',
					),
				),
			),
			'logo_dimension' => array(
				'type'            => 'dimensions',
				'label'           => esc_html__( 'Logo Dimension', 'foodforlife' ),
				'default'         => array(
					'width'  => 'auto',
					'height' => 'auto',
				),
				'active_callback' => array(
					array(
						'setting'  => 'logo_type',
						'operator' => '!=',
						'value'    => 'text',
					),
				),
			),
		);

		// Header account.
		$settings['header_account'] = array(
			'account_icon_svg'         => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Icon SVG code', 'foodforlife' ),
				'sanitize_callback' => '\FoodForLife\Icon::sanitize_svg',
			),
			'header_signin_icon_behaviour' => array(
				'type'            => 'radio',
				'label'           => esc_html__( 'Sign in Icon Behaviour', 'foodforlife' ),
				'default'         => 'popup',
				'choices'         => array(
					'popup'   => esc_html__( 'Open the account popup', 'foodforlife' ),
					'page'  => esc_html__( 'Open the account page', 'foodforlife' ),
				),
			),
			'header_account_display' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Account Display', 'foodforlife' ),
				'default'         => 'icon',
				'choices'         => array(
					'icon'   => esc_html__( 'Icon Only', 'foodforlife' ),
					'icon-text'  => esc_html__( 'Icon & Text', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'header_account_size' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Icon Size', 'foodforlife' ),
				'default'         => 'medium',
				'choices'         => array(
					'medium'   => esc_html__( 'Medium', 'foodforlife' ),
					'large'  => esc_html__( 'Large', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
		);

		// Header wishlist.
		$settings['header_wishlist'] = array(
			'wishlist_icon_svg'         => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Icon SVG code', 'foodforlife' ),
				'sanitize_callback' => '\FoodForLife\Icon::sanitize_svg',
			),
			'wishlist_icon_svg_filled'         => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Icon SVG code (when added to wishlist)', 'foodforlife' ),
				'sanitize_callback' => '\FoodForLife\Icon::sanitize_svg',
			),
			'header_wishlist_size' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Icon Size', 'foodforlife' ),
				'default'         => 'medium',
				'choices'         => array(
					'medium'   => esc_html__( 'Medium', 'foodforlife' ),
					'large'  => esc_html__( 'Large', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
		);

		// Header wishlist.
		$settings['header_compare'] = array(
			'header_compare_size' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Icon Size', 'foodforlife' ),
				'default'         => 'medium',
				'choices'         => array(
					'medium'   => esc_html__( 'Medium', 'foodforlife' ),
					'large'  => esc_html__( 'Large', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
		);

		// Header cart.
		$settings['header_cart'] = array(
			'cart_icon_behaviour' => array(
				'type'            => 'radio',
				'label'           => esc_html__( 'Cart Icon Behaviour', 'foodforlife' ),
				'default'         => 'popup',
				'choices'         => array(
					'popup'   => esc_html__( 'Open the cart popup', 'foodforlife' ),
					'page'  => esc_html__( 'Open the cart page', 'foodforlife' ),
				),
			),
			'cart_icon_source'      => array(
				'type'    => 'radio',
				'label'   => esc_html__( 'Cart Icon', 'foodforlife' ),
				'default' => 'icon',
				'choices' => array(
					'icon'  => esc_attr__( 'Built-in Icon', 'foodforlife' ),
					'svg'   => esc_attr__( 'SVG Code', 'foodforlife' ),
				),
			),
			'cart_icon'             => array(
				'type'    => 'radio-image',
				'default' => '',
				'choices' => array(
					''   	=> get_template_directory_uri() . '/assets/svg/shopping-bag.svg',
					'shopping-bag-2' 	=> get_template_directory_uri() . '/assets/svg/shopping-bag-2.svg',
					'shopping-cart'  	=> get_template_directory_uri() . '/assets/svg/shopping-cart.svg',
					'shopping-cart-2'  	=> get_template_directory_uri() . '/assets/svg/shopping-cart-2.svg',
					'shopping-cart-3'  	=> get_template_directory_uri() . '/assets/svg/shopping-cart-3.svg',
				),
				'active_callback' => array(
					array(
						'setting'  => 'cart_icon_source',
						'operator' => '==',
						'value'    => 'icon',
					),
				),
			),
			'cart_icon_svg'         => array(
				'type'              => 'textarea',
				'description'       => esc_html__( 'Icon SVG code', 'foodforlife' ),
				'sanitize_callback' => '\FoodForLife\Icon::sanitize_svg',
				'active_callback'   => array(
					array(
						'setting'  => 'cart_icon_source',
						'operator' => '==',
						'value'    => 'svg',
					),
				),
			),
			'cart_icon_svg_size' => array(
				'type'      => 'slider',
				'label'     => esc_html__('Size', 'foodforlife'),
				'transport' => 'postMessage',
				'default'    => 24,
				'choices'   => array(
					'min' => 0,
					'max' => 50,
				),
				'output'         => array(
					array(
						'element'  => '.header-cart__icon .foodforlife-svg-icon--custom-cart, ul.products li.product .product-loop-button .foodforlife-svg-icon.foodforlife-svg-icon--custom-cart',
						'property' => 'font-size',
						'units'    => 'px',
					),
				),
				'active_callback'   => array(
					array(
						'setting'  => 'cart_icon_source',
						'operator' => '==',
						'value'    => 'svg',
					),
				),
			),
			'cart_hr_1'          => array(
				'type'    => 'custom',
				'section' => 'header_cart',
				'default' => '<hr>',
			),
			'header_cart_display' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Display', 'foodforlife' ),
				'default'         => 'icon',
				'choices'         => array(
					'icon'   => esc_html__( 'Icon Only', 'foodforlife' ),
					'icon-text'  => esc_html__( 'Icon & Text', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'header_cart_size' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Icon Size', 'foodforlife' ),
				'default'         => 'medium',
				'choices'         => array(
					'medium'   => esc_html__( 'Medium', 'foodforlife' ),
					'large'  => esc_html__( 'Large', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'mini_cart_products'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Recommended Products', 'foodforlife' ),
				'description'     => esc_html__( 'Display recommended products on the mini cart', 'foodforlife' ),
				'default'         => 'recent_products',
				'choices'         => array(
					'none'                  => esc_html__( 'None', 'foodforlife' ),
					'best_selling_products' => esc_html__( 'Best selling products', 'foodforlife' ),
					'featured_products'     => esc_html__( 'Featured products', 'foodforlife' ),
					'recent_products'       => esc_html__( 'Recent products', 'foodforlife' ),
					'sale_products'         => esc_html__( 'Sale products', 'foodforlife' ),
					'top_rated_products'    => esc_html__( 'Top rated products', 'foodforlife' ),
					'crosssells_products'   => esc_html__( 'Cross-sells products', 'foodforlife' ),

				),
			),
			'mini_cart_products_limit' => array(
				'type'            => 'number',
				'description'     => esc_html__( 'Number of products', 'foodforlife' ),
				'default'         => 4,
			),
			'mini_cart_products_layout'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Recommended Products Layout', 'foodforlife' ),
				'default'         => 'sidebar',
				'choices'         => array(
					'sidebar' 	=> esc_html__( 'Sidebar List', 'foodforlife' ),
					'carousel' 	=> esc_html__( 'Carousel', 'foodforlife' ),
				),
			),
			'cart_hr_2'          => array(
				'type'    => 'custom',
				'section' => 'header_cart',
				'default' => '<hr>',
			),
			'cart_note_enable' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Enable cart note', 'foodforlife' ),
				'default'     => true,
			),
			'cart_discount_enable' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Enable cart discount', 'foodforlife' ),
				'default'     => true,
			),
			'cart_estimate_enable' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Enable cart estimate', 'foodforlife' ),
				'default'     => true,
			),
		);

		// Header search.
		$settings['header_search'] = array(
			'header_search_layout' => array(
				'type'     => 'select',
				'label'    => esc_html__('Layout', 'foodforlife'),
				'default'  => 'icon',
				'choices'  => array(
					'icon'     => __( 'Icon', 'foodforlife' ),
					'form'     => __( 'Form', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'priority' => 5
			),
			'header_search_form_width' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Search Field Width', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '',
				'choices'   => array(
					'min' => 0,
					'max' => 1000,
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header .header-search__field',
						'property' => 'width',
						'units'    => 'px',
					),
				),
				'active_callback' => function() {
					return ! $this->display_header_search_option();
				},
				'priority' => 5
			),
			'header_search_type' => array(
				'type'     => 'select',
				'label'    => esc_html__('Type', 'foodforlife'),
				'default'  => 'popup',
				'choices'  => array(
					'popup'       => __( 'Popup', 'foodforlife' ),
					'sidebar'     => __( 'Sidebar', 'foodforlife' ),
				),
				'priority' => 5
			),
			'header_search_hr_1'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'priority' => 10
			),
			'header_search_trending' => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Trending', 'foodforlife' ),
				'description'     => esc_html__( 'Display a list of links in the search modal', 'foodforlife' ),
				'default'         => false,
				'priority' => 15
			),
			'header_search_links'       => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Links', 'foodforlife' ),
				'description'     => esc_html__( 'Add custom links of the trending searches', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => array(),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Link', 'foodforlife' ),
					'field' => 'text',
				),
				'fields'          => array(
					'text' => array(
						'type'  => 'text',
						'label' => esc_html__( 'Text', 'foodforlife' ),
					),
					'url'  => array(
						'type'  => 'text',
						'label' => esc_html__( 'URL', 'foodforlife' ),
					),
				),
				'priority' => 20
			),
			'header_search_hr_5'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'priority' => 25
			),
			'header_search_products' => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Products', 'foodforlife' ),
				'description'     => esc_html__( 'Display a products list before searching', 'foodforlife' ),
				'default'         => false,
				'priority' => 30
			),
			'header_search_products_type' => array(
				'type'     => 'select',
				'label'    => esc_html__('Type', 'foodforlife'),
				'default'  => 'recent_products',
				'choices'  => array(
					'recent_products'       => __( 'Recent Products', 'foodforlife' ),
					'featured_products'     => __( 'Featured Products', 'foodforlife' ),
					'sale_products'         => __( 'Sale Products', 'foodforlife' ),
					'best_selling_products' => __( 'Best Selling Products', 'foodforlife' ),
					'top_rated_products'    => __( 'Top Rated Products', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_search_products',
						'operator' => '==',
						'value'    => '1',
					),
				),
				'priority' => 35
			),
			'header_search_product_limit'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Limit', 'foodforlife' ),
				'default'         => '10',
				'active_callback' => array(
					array(
						'setting'  => 'header_search_products',
						'operator' => '==',
						'value'    => '1',
					),
				),
				'priority' => 40
			),
		);

		// Product Categories
		$settings['header_product_categories'] = array(
			'header_sidebar_categories' => array(
				'type'        	=> 'toggle',
				'default'     	=> '',
				'label'         => esc_html__( 'Sidebar Categories', 'foodforlife' ),
				'description'   => esc_html__( 'Enable this option to display the category sidebar on desktop screens.', 'foodforlife' ),
			),
			'header_sidebar_categories_action' => array(
				'type'        	=> 'select',
				'default'     	=> 'hover',
				'label'         => esc_html__( 'Menu Trigger', 'foodforlife' ),
				'description'   => esc_html__( 'Select the action to display the category sidebar.', 'foodforlife' ),
				'choices'       => array(
					'hover' => esc_html__( 'Hover', 'foodforlife' ),
					'click' => esc_html__( 'Click', 'foodforlife' ),
				)
			),
		);

		// Custom HTML
		$settings['header_custom_html'] = array(
			'header_custom_html'       => array(
				'type'            => 'textarea',
				'label'           => esc_html__( 'Custom HTML', 'foodforlife' ),
				'description'     => esc_html__( 'Paste your HTML here', 'foodforlife' ),
			),
		);

		// Hambuger menu
		$settings['header_mobile_menu'] = array(
			'header_mobile_menu_els' => array(
				'type'     => 'multicheck',
				'label'    => esc_html__('Mobile Menu Elements', 'foodforlife'),
				'default'  => array( 'primary-menu', 'custom-menu' ),
				'choices'  => array(
					'primary-menu' 		=> esc_html__('Primary Menu', 'foodforlife'),
					'custom-menu' 		=> esc_html__('Custom Menu', 'foodforlife'),
					'category-menu' 	=> esc_html__('Category Menu', 'foodforlife'),
					'currency' 			=> esc_html__('Currency', 'foodforlife'),
					'language' 			=> esc_html__('Language', 'foodforlife'),
				),
				'description'     => esc_html__('Select which elements you want to show.', 'foodforlife'),
			),
			'header_mobile_menu_primary_menu'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Primary Menu', 'foodforlife' ),
				'default'         => '',
				'choices'         => $this->get_menus(),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_menu_els',
						'operator' => 'contains',
						'value'    => 'primary-menu',
					),
				),
			),
			'header_mobile_menu_custom_menu'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Custom Menu', 'foodforlife' ),
				'default'         => '',
				'choices'         => $this->get_menus(),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_menu_els',
						'operator' => 'contains',
						'value'    => 'custom-menu',
					),
				),
			),
			'header_mobile_menu_category_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'header_mobile_menu_category_menu'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Category Menu', 'foodforlife' ),
				'default'         => '',
				'choices'         => $this->get_menus(),
			),
			'header_mobile_menu_open_primary_submenus_on_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'header_mobile_menu_open_primary_submenus_on' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Open Submenu Items on', 'foodforlife' ),
				'default'         => 'all',
				'choices'         => array(
					'all'   => esc_html__( 'Title & Icon click', 'foodforlife' ),
					'icon'  => esc_html__( 'Icon click', 'foodforlife' ),
				),
			),
		);

