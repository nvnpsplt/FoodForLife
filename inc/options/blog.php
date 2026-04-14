<?php

/**
 * Blog Options Partial
 *
 * @package FoodForLife
 * @since   1.8.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

		$settings['post_card'] = array(
			'image_rounded_shape_post_card'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Corner Radius', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 			=> esc_html__( 'Default', 'foodforlife' ),
					'square'  	=> esc_html__( 'Square', 'foodforlife' ),
					'custom'  	=> esc_html__( 'Custom', 'foodforlife' ),
				),
			),
			'image_rounded_number_post_card'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Number(px)', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'image_rounded_shape_post_card',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),

		);

		// Blog Header.
		$settings['blog_header'] = array(
			'blog_header' => array(
				'type'        => 'toggle',
				'default'     => true,
				'label'       => esc_html__('Enable Blog Header', 'foodforlife'),
				'description' => esc_html__('Enable to show a blog header for the page below the site header', 'foodforlife'),
			),
			'blog_header_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'blog_header_els' => array(
				'type'     => 'multicheck',
				'label'    => esc_html__('Elements', 'foodforlife'),
				'default'  => array( 'breadcrumb', 'title' ),
				'choices'  => array(
					'breadcrumb'  => esc_html__('BreadCrumb', 'foodforlife'),
					'title'       => esc_html__('Title', 'foodforlife'),
					'description' => esc_html__('Description', 'foodforlife'),
				),
				'description'     => esc_html__('Select which elements you want to show.', 'foodforlife'),
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'blog_header_description_lines'                      => array(
				'type'            => 'number',
				'label'           => esc_html__('Description Number Lines', 'foodforlife'),
				'default'         => 5,
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'blog_header_els',
						'operator' => 'in',
						'value'    => 'description',
					),
				),
			),
			'blog_header_hr_1' => array(
				'type'            => 'custom',
				'default'         => '<hr/><h3>' . esc_html__('Custom', 'foodforlife') . '</h3>',
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'blog_header_background_image'          => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Background Image', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'blog_header_background_overlay' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Overlay', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--blog .page-header__image::before',
						'property' => 'background-color',
					),
				),
			),
			'blog_header_title_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Title Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'blog_header_els',
						'operator' => 'in',
						'value'    => 'title',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--blog .page-header__title',
						'property' => 'color',
					),
				),
			),
			'blog_header_breadcrumb_link_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Breadcrumb Link Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'blog_header_els',
						'operator' => 'in',
						'value'    => 'breadcrumb',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--blog .site-breadcrumb',
						'property' => '--ffl-site-breadcrumb-link-color',
					),
				),
			),
			'blog_header_breadcrumb_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Breadcrumb Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'blog_header_els',
						'operator' => 'in',
						'value'    => 'breadcrumb',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--blog .site-breadcrumb',
						'property' => '--ffl-site-breadcrumb-color',
					),
				),
			),
			'blog_header_description_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Description Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'blog_header_els',
						'operator' => 'in',
						'value'    => 'description',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--blog .page-header__description',
						'property' => 'color',
					),
				),
			),
			'blog_header_padding_top' => array(
				'type'      => 'slider',
				'label'     => esc_html__('Padding Top', 'foodforlife'),
				'transport' => 'postMessage',
				'default'    => [
					'desktop' => 80,
					'tablet'  => 80,
					'mobile'  => 60,
				],
				'responsive' => true,
				'choices'   => array(
					'min' => 0,
					'max' => 500,
				),
				'output'         => array(
					array(
						'element'  => '.page-header.page-header--blog',
						'property' => '--ffl-page-header-padding-top',
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
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
			'blog_header_padding_bottom' => array(
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
						'element'  => '.page-header.page-header--blog',
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
						'setting'  => 'blog_header',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);

		// Blog.
		$settings['blog_page'] = array(
			'blog_layout'    => array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Layout', 'foodforlife' ),
				'default'     => 'list',
				'choices'     => array(
					'grid'          => esc_html__('Grid', 'foodforlife'),
					'list'          => esc_html__('List', 'foodforlife'),
				),
			),
			'blog_columns'    => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Columns', 'foodforlife' ),
				'default'     => '2',
				'choices'     => array(
					'2' => esc_html__('2 Columns', 'foodforlife'),
					'3' => esc_html__('3 Columns', 'foodforlife'),
					'4' => esc_html__('4 Columns', 'foodforlife'),
				),
				'active_callback' => array(
					array(
						'setting'  => 'blog_layout',
						'operator' => '==',
						'value'    => 'grid',
					),
				),
			),
			'blog_sidebar'    => array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Sidebar', 'foodforlife' ),
				'default'     => 'sidebar-content',
				'choices'     => array(
					'no-sidebar'      => esc_html__('No Sidebar', 'foodforlife'),
					'sidebar-content' => esc_html__('Left Sidebar', 'foodforlife'),
					'content-sidebar' => esc_html__('Right Sidebar', 'foodforlife'),
				),
				'active_callback' => array(
					array(
						'setting'  => 'blog_columns',
						'operator' => '!==',
						'value'    => '3',
					),
					array(
						'setting'  => 'blog_columns',
						'operator' => '!==',
						'value'    => '4',
					),
				),
			),
			'blog_hr'  => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'blog_pagination' => array(
				'type'    => 'radio',
				'label'   => esc_html__( 'Pagination Type', 'foodforlife' ),
				'default' => 'numeric',
				'choices' => array(
					'numeric'  => esc_attr__( 'Numeric', 'foodforlife' ),
					'infinite' => esc_attr__( 'Infinite Scroll', 'foodforlife' ),
					'loadmore' => esc_attr__( 'Load More', 'foodforlife' ),
				),
			),
			'blog_pagination_ajax_url_change' => array(
				'type'            => 'checkbox',
				'label'           => esc_html__( 'Change the URL after page loaded', 'foodforlife' ),
				'default'         => true,
				'active_callback' => array(
					array(
						'setting'  => 'blog_pagination',
						'operator' => '!=',
						'value'    => 'numeric',
					),
				),
			),
		);

		// Blog single.
		$settings['blog_single'] = array(
			'single_post_header_els' => array(
				'type'     => 'multicheck',
				'label'    => esc_html__('Post Header Elements', 'foodforlife'),
				'default'  => array( 'breadcrumb' ),
				'choices'  => array(
					'breadcrumb'     => esc_html__('BreadCrumb', 'foodforlife'),
				),
				'description'     => esc_html__('Select which elements you want to show.', 'foodforlife'),
			),
			'single_post_image_rounded_shape_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'post_featured_image'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Featured Image', 'foodforlife' ),
				'description' => esc_html__( 'Enable featured image.', 'foodforlife' ),
				'default'     => true,
			),
			'image_rounded_shape_featured_post'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Featured Image Corner Radius', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 			=> esc_html__( 'Default', 'foodforlife' ),
					'square'  	=> esc_html__( 'Square', 'foodforlife' ),
					'custom'  	=> esc_html__( 'Custom', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'post_featured_image',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'image_rounded_number_featured_post'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Number(px)', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'image_rounded_shape_featured_post',
						'operator' => '==',
						'value'    => 'custom',
					),
					array(
						'setting'  => 'post_featured_image',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'single_post_sidebar_hr'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'post_sidebar'                 => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Post Sidebar', 'foodforlife' ),
				'description' => esc_html__( 'The layout of single posts', 'foodforlife' ),
				'default'     => 'no-sidebar',
				'choices'     => array(
					'no-sidebar'      => esc_html__('No Sidebar', 'foodforlife'),
					'content-sidebar' => esc_html__('Right Sidebar', 'foodforlife'),
					'sidebar-content' => esc_html__('Left Sidebar', 'foodforlife'),
				),
			),
			'post_sharing'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Post Sharing', 'foodforlife' ),
				'description' => esc_html__( 'Enable post sharing.', 'foodforlife' ),
				'default'     => false,
			),
			'post_navigation'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Post Navigation', 'foodforlife' ),
				'description' => esc_html__( 'Display the next and previous posts', 'foodforlife' ),
				'default'     => true,
			),
			'posts_related_custom'     => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'posts_related'   => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Related Posts', 'foodforlife' ),
				'description' => esc_html__( 'Display related posts', 'foodforlife' ),
				'default'     => true,
			),
			'posts_related_number'                      => array(
				'type'            => 'number',
				'label'           => esc_html__('Posts Numbers', 'foodforlife'),
				'default'         => 5,
			),
			'posts_related_spacing'                      => array(
				'type'            => 'number',
				'label'           => esc_html__('Posts Spacing', 'foodforlife'),
				'default'         => 30,
			),
		);

		// Back To Top.
		$settings['backtotop'] = array(
			'backtotop'    => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Back To Top', 'foodforlife' ),
				'description' => esc_html__( 'Check this to show back to top.', 'foodforlife' ),
				'default'     => true,
			),
		);

		// Share socials
		$settings['share_socials'] = array(
			'post_sharing_socials' => array(
				'type'            => 'sortable',
				'description'     => esc_html__( 'Select social media for sharing posts/products', 'foodforlife' ),
				'default'         => array(
					'twitter',
					'facebook',
					'pinterest',
					'instagram',
				),
				'choices'         => array(
					'facebook'    => esc_html__( 'Facebook', 'foodforlife' ),
					'twitter'     => esc_html__( 'Twitter', 'foodforlife' ),
					'googleplus'  => esc_html__( 'Google Plus', 'foodforlife' ),
					'pinterest'   => esc_html__( 'Pinterest', 'foodforlife' ),
					'tumblr'      => esc_html__( 'Tumblr', 'foodforlife' ),
					'reddit'      => esc_html__( 'Reddit', 'foodforlife' ),
					'linkedin'    => esc_html__( 'Linkedin', 'foodforlife' ),
					'stumbleupon' => esc_html__( 'StumbleUpon', 'foodforlife' ),
					'digg'        => esc_html__( 'Digg', 'foodforlife' ),
					'telegram'    => esc_html__( 'Telegram', 'foodforlife' ),
					'whatsapp'    => esc_html__( 'WhatsApp', 'foodforlife' ),
					'vk'          => esc_html__( 'VK', 'foodforlife' ),
					'email'       => esc_html__( 'Email', 'foodforlife' ),
					'instagram'   => esc_html__( 'Instagram', 'foodforlife' ),
				),
			),
			'post_sharing_whatsapp_number' => array(
				'type'        => 'text',
				'description' => esc_html__( 'WhatsApp Phone Number', 'foodforlife' ),
				'active_callback' => array(
					array(
						'setting'  => 'post_sharing_socials',
						'operator' => 'contains',
						'value'    => 'whatsapp',
					),
				),
			),
		);
