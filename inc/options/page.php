<?php

/**
 * Page Options Partial
 *
 * @package FoodForLife
 * @since   1.8.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

		// Page Header.
		$settings['page_header'] = array(
			'page_header' => array(
				'type'        => 'toggle',
				'default'     => true,
				'label'       => esc_html__('Enable Page Header', 'foodforlife'),
				'description' => esc_html__('Enable to show a page header for the page below the site header', 'foodforlife'),
			),
			'page_header_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'page_header_els' => array(
				'type'     => 'multicheck',
				'label'    => esc_html__('Elements', 'foodforlife'),
				'default'  => array( 'title' ),
				'choices'  => array(
					'title'      => esc_html__('Title', 'foodforlife'),
					'breadcrumb' => esc_html__('BreadCrumb', 'foodforlife'),
					'description' => esc_html__('Description', 'foodforlife'),
				),
				'description'     => esc_html__('Select which elements you want to show.', 'foodforlife'),
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'page_header_description_lines'                      => array(
				'type'            => 'number',
				'label'           => esc_html__('Description Number Lines', 'foodforlife'),
				'default'         => 5,
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'page_header_els',
						'operator' => 'in',
						'value'    => 'description',
					),
				),
			),
			'page_header_hr_1' => array(
				'type'            => 'custom',
				'default'         => '<hr/><h3>' . esc_html__('Custom', 'foodforlife') . '</h3>',
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'page_header_background_image'          => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Background Image', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'page_header_background_overlay' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Overlay', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--page::before',
						'property' => 'background-color',
					),
				),
			),
			'page_header_title_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Title Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'page_header_els',
						'operator' => 'in',
						'value'    => 'title',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--page .page-header__title',
						'property' => 'color',
					),
				),
			),
			'page_header_breadcrumb_link_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Breadcrumb Link Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'page_header_els',
						'operator' => 'in',
						'value'    => 'breadcrumb',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--page .site-breadcrumb',
						'property' => '--ffl-site-breadcrumb-link-color',
					),
				),
			),
			'page_header_breadcrumb_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Breadcrumb Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'page_header_els',
						'operator' => 'in',
						'value'    => 'breadcrumb',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--page .site-breadcrumb',
						'property' => '--ffl-site-breadcrumb-color',
					),
				),
			),
			'page_header_description_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Description Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'page_header_els',
						'operator' => 'in',
						'value'    => 'description',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--page .page-header__description',
						'property' => 'color',
					),
				),
			),
			'page_header_padding_top' => array(
				'type'      => 'slider',
				'label'     => esc_html__('Padding Top', 'foodforlife'),
				'transport' => 'postMessage',
				'choices'   => array(
					'min' => 0,
					'max' => 500,
				),
				'default'    => [
                    'desktop' => 80,
                    'tablet'  => 80,
                    'mobile'  => 60,
                ],
				'output'         => array(
                    array(
                        'element'  => '.page-header',
                        'property' => '--ffl-page-header-padding-top',
                        'units'    => 'px',
                        'media_query' => [
                            'desktop' => '@media (min-width: 1200px)',
                            'tablet'  => is_customize_preview() ? '@media (min-width: 699px) and (max-width: 1199px)' : '@media (min-width: 768px) and (max-width: 1199px)',
                            'mobile'  => '@media (max-width: 767px)',
                        ],
                    ),
                ),
				'responsive' => true,
				'active_callback' => array(
					array(
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
			'page_header_padding_bottom' => array(
				'type'      => 'slider',
				'label'     => esc_html__('Padding Bottom', 'foodforlife'),
				'transport' => 'postMessage',
				'default'    => [
                    'desktop' => 10,
                    'tablet'  => 10,
                    'mobile'  => 10,
                ],
                'responsive' => true,
                'choices'   => array(
                    'min' => 0,
                    'max' => 500,
                ),
                'output'         => array(
                    array(
                        'element'  => '.page-header',
                        'property' => '--ffl-page-header-padding-bottom',
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
						'setting'  => 'page_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);
