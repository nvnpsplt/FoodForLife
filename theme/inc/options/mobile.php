<?php

/**
 * Mobile Options Partial
 *
 * @package FoodForLife
 * @since   1.8.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

		$settings['topbar_mobile'] = array(
			'mobile_topbar' => array(
				'type'      => 'toggle',
				'label'     => esc_html__( 'Topbar', 'foodforlife' ),
				'description' => esc_html__( 'Display topbar on mobile', 'foodforlife' ),
				'default'   => false,
			),
			'mobile_topbar_breakpoint' => array(
				'type'      => 'slider',
				'label'       => esc_html__( 'Breakpoint (px)', 'foodforlife' ),
				'description' => esc_html__( 'Set a breakpoint where the mobile navigation bar displays.', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '1024',
				'choices'   => array(
					'min' => 375,
					'max' => 1199,
				),
				'active_callback' => array(
					array(
						'setting'  => 'mobile_topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'mobile_topbar_section' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Topbar Items', 'foodforlife' ),
				'default'   => 'left',
				'choices' => array(
					'left'   => esc_html__( 'Keep left items', 'foodforlife' ),
					'right'  => esc_html__( 'Keep right items', 'foodforlife' ),
					'all'    => esc_html__( 'Keep all items', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'mobile_topbar',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Header Mobile
		$settings['header_mobile_layout'] = array(
			'header_mobile_breakpoint' => array(
				'type'      => 'slider',
				'label'       => esc_html__( 'Breakpoint (px)', 'foodforlife' ),
				'description' => esc_html__( 'Set a breakpoint where the mobile header displays and the desktop header is hidden.', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '1199',
				'choices'   => array(
					'min' => 991,
					'max' => 1199,
				),
			),
			'header_mobile_present_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'header_mobile_present' => array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Present', 'foodforlife' ),
				'description' => esc_html__( 'Select a prebuilt header or build your own', 'foodforlife' ),
				'default'     => 'prebuild',
				'choices'     => array(
					'prebuild' => esc_html__( 'Use pre-build header', 'foodforlife' ),
					'custom'   => esc_html__( 'Build my own', 'foodforlife' ),
				),
			),
			'header_mobile_prebuild_search'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Search', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_mobile_prebuild_account'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Account', 'foodforlife' ),
				'default'     => false,
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_mobile_prebuild_wishlist'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Wishlist', 'foodforlife' ),
				'default'     => false,
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_mobile_prebuild_compare'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Compare', 'foodforlife' ),
				'default'     => false,
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_mobile_prebuild_cart'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Header Cart', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'prebuild',
					),
				),
			),
			'header_mobile_main_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'header_mobile_icon_auto_width'            => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Auto Icon Width', 'foodforlife' ),
				'default'     => false,
			),
			'header_mobile_main_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Header Main Height', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '64',
				'choices'   => array(
					'min' => 30,
					'max' => 500,
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header__mobile .header-mobile-main',
						'property' => 'height',
						'units'    => 'px',
					),
				),
			),
			'header_mobile_bottom_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'header_mobile_bottom_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Header Bottom Height', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '60',
				'choices'   => array(
					'min' => 30,
					'max' => 500,
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header__mobile .header-mobile-bottom',
						'property' => 'height',
						'units'    => 'px',
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
		);

		// Header sticky settings.
		$settings['header_mobile_sticky'] = array(
			'header_mobile_sticky'        => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Sticky Header', 'foodforlife' ),
				'default'         => false,
			),
			'header_mobile_sticky_el'   => array(
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
						'setting'  => 'header_mobile_sticky',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'header_mobile_sticky_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'header_mobile_sticky_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Header Main Height', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '64',
				'choices'   => array(
					'min' => 30,
					'max' => 200,
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_sticky',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'header_mobile_sticky_el',
						'operator' => '!==',
						'value'    => 'header_bottom',
					),
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header__mobile.minimized .header-mobile-main, .site-header__mobile.headroom--not-top .header-mobile-main',
						'property' => 'height',
						'units'    => 'px',
					),
					array(
						'element'  => '.site-header__mobile.minimized .header-mobile-sticky + .header-mobile-bottom, .site-header__mobile.headroom--not-top .header-mobile-sticky + .header-mobile-bottom',
						'property' => 'top',
						'units'    => 'px',
					),
				),
			),
			'header_mobile_sticky_bottom_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Header Bottom Height', 'foodforlife' ),
				'transport' => 'postMessage',
				'default'   => '60',
				'choices'   => array(
					'min' => 30,
					'max' => 200,
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_sticky',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'header_mobile_sticky_el',
						'operator' => '!==',
						'value'    => 'header_main',
					),
				),
				'js_vars'   => array(
					array(
						'element'  => '.site-header__mobile.minimized .header-mobile-bottom, .site-header__mobile.headroom--not-top .header-mobile-bottom',
						'property' => 'height',
						'units'    => 'px',
					),
				),
			),
		);

		// Header main settings.
		$settings['header_mobile_main'] = array(
			'header_mobile_main_left'   => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Left Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the left side of header mobile main', 'foodforlife' ),
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
						'choices' => $this->header_mobile_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_mobile_main_left' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Mobile::instance(), 'render' ),
					),
				),
			),
			'header_mobile_main_center' => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Center Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items at the center of header mobile main', 'foodforlife' ),
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
						'choices' => $this->header_mobile_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_mobile_main_center' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Mobile::instance(), 'render' ),
					),
				),
			),
			'header_mobile_main_right'  => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Right Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the right of header mobile main', 'foodforlife' ),
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
						'choices' => $this->header_mobile_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_mobile_main_right' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Mobile::instance(), 'render' ),
					),
				),
			),
		);

		// Header bottom settings.
		$settings['header_mobile_bottom'] = array(
			'header_mobile_bottom_left'   => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Left Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the left side of header mobile bottom', 'foodforlife' ),
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
						'choices' => $this->header_mobile_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_mobile_bottom_left' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Mobile::instance(), 'render' ),
					),
				),
			),
			'header_mobile_bottom_center' => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Center Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items at the center of header mobile bottom', 'foodforlife' ),
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
						'choices' => $this->header_mobile_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_mobile_bottom_center' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Mobile::instance(), 'render' ),
					),
				),
			),
			'header_mobile_bottom_right'  => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Right Items', 'foodforlife' ),
				'description'     => esc_html__( 'Control items on the right of header mobile bottom', 'foodforlife' ),
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
						'choices' => $this->header_mobile_items_option(),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				'partial_refresh' => array(
					'header_mobile_bottom_right' => array(
						'selector'        => '#site-header',
						'render_callback' => array( \FoodForLife\Header\Mobile::instance(), 'render' ),
					),
				),
			),
		);

		$settings['header_mobile_background'] = array(
			'header_mobile_background_heading_1'    => array(
				'type'    => 'custom',
				'default' => '<h2>'. esc_html__( 'Header Main', 'foodforlife' ) .'</h2>',
			),
			'header_mobile_main_background_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__mobile .header-mobile-main',
						'property' => 'background-color',
					),
				),
			),
			'header_mobile_main_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .header-mobile-main',
						'property' => '--ffl-color-dark',
					),
					array(
						'element'  => 'body:not(.header-transparent) .header-mobile-main',
						'property' => '--ffl-header-color',
					),
					array(
						'element'  => 'body:not(.header-transparent) .header-mobile-main',
						'property' => 'color',
					),
				),
			),
			'header_mobile_main_border_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .header-mobile-main',
						'property' => '--ffl-header-mobile-main-border-color',
					),
				),
			),
			'header_mobile_main_shadow_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Box Shadow Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__mobile .header-mobile-main',
						'property' => '--ffl-header-mobile-main-shadow-color',
					),
				),
			),
			'header_mobile_background_heading_2'    => array(
				'type'    => 'custom',
				'default' => '<hr/><h2>'. esc_html__( 'Header Bottom', 'foodforlife' ) .'</h2>',
			),
			'header_mobile_bottom_background_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__mobile .header-mobile-bottom',
						'property' => 'background-color',
					),
				),
			),
			'header_mobile_bottom_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .header-mobile-bottom',
						'property' => '--ffl-color-dark',
					),
					array(
						'element'  => 'body:not(.header-transparent) .header-mobile-bottom',
						'property' => '--ffl-header-color',
					),
					array(
						'element'  => 'body:not(.header-transparent) .header-mobile-bottom',
						'property' => 'color',
					),
				),
			),
			'header_mobile_bottom_border_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color', 'foodforlife' ),
				'default'         => '',
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .header-mobile-bottom',
						'property' => '--ffl-header-mobile-bottom-border-color',
					),
				),
			),
			'header_mobile_bottom_shadow_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Box Shadow Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'js_vars'   => array(
					array(
						'element'  => 'body:not(.header-transparent) .site-header__mobile .header-mobile-bottom',
						'property' => '--ffl-header-mobile-bottom-shadow-color',
					),
				),
			),
		);

		// Header mobile menu.
		$settings['header_mobile_elements'] = array(
			'mobile_logo_type'      => array(
				'type'    => 'radio',
				'label'   => esc_html__( 'Logo Type', 'foodforlife' ),
				'default' => 'default',
				'choices' => array(
					'default' => esc_html__( 'Default', 'foodforlife' ),
					'image' => esc_html__( 'Image', 'foodforlife' ),
					'text'  => esc_html__( 'Text', 'foodforlife' ),
					'svg'   => esc_html__( 'SVG', 'foodforlife' ),
				),
			),
			'mobile_logo_text'      => array(
				'type'            => 'text',
				'label'           => esc_html__( 'Logo Text', 'foodforlife' ),
				'default'         => 'FoodForLife',
				'active_callback' => array(
					array(
						'setting'  => 'mobile_logo_type',
						'operator' => '==',
						'value'    => 'text',
					),
				),
			),
			'mobile_logo_svg'       => array(
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
						'setting'  => 'mobile_logo_type',
						'operator' => '==',
						'value'    => 'svg',
					),
				),
			),
			'mobile_logo_image'   => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Logo', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'mobile_logo_type',
						'operator' => '==',
						'value'    => 'image',
					),
				),
			),
			'mobile_logo_image_light'   => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Logo Light', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'mobile_logo_type',
						'operator' => '==',
						'value'    => 'image',
					),
				),
			),
			'mobile_logo_dimension' => array(
				'type'            => 'dimensions',
				'label'           => esc_html__( 'Logo Dimension', 'foodforlife' ),
				'default'         => array(
					'width'  => '',
					'height' => '',
				),
				'active_callback' => array(
					array(
						'setting'  => 'logo_type',
						'operator' => '!=',
						'value'    => 'text',
					),
				),
			),
			'mobile_header_hamburger_menu_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'mobile_header_hamburger_menu_text'      => array(
				'type'            => 'text',
				'label'           => esc_html__( 'Hamburger Menu Text', 'foodforlife' ),
				'default'         => '',
			),
			'mobile_header_account_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'mobile_header_wishlist_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'header_mobile_wishlist_display' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Wishlist Display', 'foodforlife' ),
				'default'         => 'icon',
				'choices'         => array(
					'icon'   => esc_html__( 'Icon Only', 'foodforlife' ),
					'icon-text'  => esc_html__( 'Icon & Text', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'mobile_header_compare_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'header_mobile_compare_display' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Compare Display', 'foodforlife' ),
				'default'         => 'icon',
				'choices'         => array(
					'icon'   => esc_html__( 'Icon Only', 'foodforlife' ),
					'icon-text'  => esc_html__( 'Icon & Text', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'mobile_header_custom_html_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'header_mobile_custom_html'       => array(
				'type'            => 'textarea',
				'label'           => esc_html__( 'Custom HTML', 'foodforlife' ),
				'description'     => esc_html__( 'Paste your HTML here', 'foodforlife' ),
				'active_callback' => array(
					array(
						'setting'  => 'header_mobile_present',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
		);


		// Mobile Product Catalog
		$settings['mobile_product_catalog'] = array(
			'mobile_product_catalog_heading_1'     => array(
				'type'    => 'custom',
				'default' => '<h2>'. esc_html__( 'Product Grid', 'foodforlife' ) .'</h2>',
			),
			'mobile_product_columns'     => array(
				'label'   => esc_html__( 'Product Columns', 'foodforlife' ),
				'type'    => 'select',
				'default' => '2',
				'choices' => array(
					'1' => esc_html__( '1 Column', 'foodforlife' ),
					'2' => esc_html__( '2 Columns', 'foodforlife' ),
				),
			),
		);

		// Mobile Product Card
		$settings['mobile_product_card'] = array(
			'mobile_product_card_featured_icons'        => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Always Show Featured Icons', 'foodforlife' ),
				'default'         => true,
			),
			'mobile_product_card_atc'        => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Show Add To Cart Button', 'foodforlife' ),
				'default'         => false,
				'active_callback' => array(
					array(
						'setting'  => 'product_card_layout',
						'operator' => '!==',
						'value'    => '2',
					),
				),
			),
			'mobile_product_card_wishlist' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Wishlist button', 'foodforlife' ),
				'default' => true,
			),
			// REMOVED: Compare button — feature disabled.
			// 'mobile_product_card_compare' => array(
			// 	'type'    => 'toggle',
			// 	'label'   => esc_html__( 'Compare button', 'foodforlife' ),
			// 	'default' => false,
			// ),
			// REMOVED: Quick View button — feature disabled.
			// 'mobile_product_card_quick_view' => array(
			// 	'type'    => 'toggle',
			// 	'label'   => esc_html__( 'Quick View button', 'foodforlife' ),
			// 	'default' => false,
			// ),
		);

		// Mobile Single Product
		$settings['mobile_single_product'] = array(
			'mobile_single_product_gallery_arrows' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Show Gallery Arrows', 'foodforlife' ),
				'default' => false,
				'active_callback' => array(
					array(
						'setting'  => 'product_gallery_layout',
						'operator' => 'in',
						'value'    => array( '', 'bottom-thumbnails', 'hidden-thumbnails' ),
					),
				),
			),
			'mobile_single_product_slides_per_view_auto_hr' => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'mobile_single_product_slides_per_view_auto' => array(
				'type'    => 'multicheck',
				'label'   => esc_html__( 'Slides Per View Auto', 'foodforlife' ),
				'default' => [],
				'choices' => array(
					'related'         => esc_html__( 'Related', 'foodforlife' ),
					'upsells'         => esc_html__( 'Upsells', 'foodforlife' ),
					'recently_viewed' => esc_html__( 'Recently Viewed', 'foodforlife' ),
				),
			),
		);
