<?php

/**
 * Typography Options Partial
 *
 * @package FoodForLife
 * @since   1.8.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

		// Typography
		// Typography - body.
		$settings['typo_main'] = array(
			'typo_body'                      => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Body', 'foodforlife' ),
				'description' => esc_html__( 'Customize the body font', 'foodforlife' ),
				'default'     => array(
					'font-family' => 'Instrument Sans',
					'variant'     => 'regular',
					'font-size'   => '15px',
					'line-height' => '1.6',
					'color'       => '#444',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing'  => '',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => 'body',
					),
				),
			),
		);

		$settings['typo_font_family'] = array(
			'typo_font_family'     => array(
				'type'        => 'toggle',
				'default'     => true,
				'label'       => esc_html__('Instrument Sans Font', 'foodforlife'),
				'description' => esc_html__('Enable this option to load Instrument Sans Font', 'foodforlife'),
			),
		);


		// Typography - headings.
		$settings['typo_headings'] = array(
			'typo_heading'                        => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Heading', 'foodforlife' ),
				'description' => esc_html__( 'Customize the Heading font', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => 'regular',
					'line-height'    => '1.2',
					'color'          => '#111',
					'text-transform' => 'none',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing'  => '',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
				array(
						'element' => 'h1,h2,h3,h4,h5,h6',
					),
				),
			),
			'typo_heading_hr_1'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'typo_h1'                        => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Heading 1', 'foodforlife' ),
				'default'     => array(
					'font-size'      => '40px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => 'h1, .h1',
					),
				),
			),
			'typo_heading_hr_2'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'typo_h2'                        => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Heading 2', 'foodforlife' ),
				'default'     => array(
					'font-size'      => '36px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
				array(
						'element' => 'h2, .h2',
					),
				),
			),
			'typo_heading_hr_3'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'typo_h3'                        => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Heading 3', 'foodforlife' ),
				'default'     => array(
					'font-size'      => '30px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => 'h3, .h3',
					),
				),
			),
			'typo_heading_hr_4'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'typo_h4'                        => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Heading 4', 'foodforlife' ),
				'default'     => array(
					'font-size'      => '26px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => 'h4, .h4',
					),
				),
			),
			'typo_heading_hr_5'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'typo_h5'                        => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Heading 5', 'foodforlife' ),
				'default'     => array(
					'font-size'      => '18px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => 'h5, .h5',
					),
				),
			),
			'typo_heading_hr_6'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'typo_h6'                        => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Heading 6', 'foodforlife' ),
				'default'     => array(
					'font-size'      => '16px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => 'h6, .h6',
					),
				),
			),
		);

		// Typography - header primary menu.
		$settings['typo_header_logo'] = array(
			'logo_font'      => array(
				'type'            => 'typography',
				'label'           => esc_html__( 'Logo Font', 'foodforlife' ),
				'default'         => array(
					'font-family'    => '',
					'variant'		 => '',
					'font-size'      => '',
					'letter-spacing' => '',
					'subsets'        => array( 'latin-ext' ),
					'text-transform' => 'none',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'output'          => array(
					array(
						'element' => '.site-header .header-logo__text',
					),
				),
			),
		);

		// Typography - header primary menu.
		$settings['typo_header_menu_primary'] = array(
			'typo_menu'                      => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Menu', 'foodforlife' ),
				'description' => esc_html__( 'Customize the menu font', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => '600',
					'font-size'      => '15px',
					'line-height' 	 => '1.6667',
					'text-transform' => 'none',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => '.primary-navigation .nav-menu > li > a',
					),
				),
			),
			'typo_submenu'                   => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Sub-Menu', 'foodforlife' ),
				'description' => esc_html__( 'Customize the sub-menu font', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => 'regular',
					'font-size'      => '15px',
					'line-height' 	 => '1.6667',
					'text-transform' => 'none',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => '.primary-navigation li .menu-item > a, .primary-navigation li .menu-item--widget > a, .primary-navigation .mega-menu ul.mega-menu__column .menu-item--widget-heading a, .primary-navigation li .menu-item > span, .primary-navigation li .menu-item > h6',
					),
				),
			),
		);

		$settings['typo_page'] = array(
			'typo_page_title'              => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Page Title', 'foodforlife' ),
				'description' => esc_html__( 'Customize the page title font', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => '600',
					'font-size'      => '36px',
					'line-height'    => '',
					'text-transform' => 'none',
					'color'          => '#111',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '-1.224px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => '.page-header--page .page-header__title',
					),
				),
			),
		);

		// Typography - posts.
		$settings['typo_posts'] = array(
			'typo_blog_header_title'              => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Blog Header Title', 'foodforlife' ),
				'description' => esc_html__( 'Customize the font of blog header', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => '600',
					'font-size'      => '36px',
					'line-height'    => '',
					'text-transform' => 'none',
					'color'          => '#111',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '-1.224px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => '.page-header--blog .page-header__title',
					),
				),
			),
			'typo_blog_post_title'              => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Blog Post Title', 'foodforlife' ),
				'description' => esc_html__( 'Customize the font of blog post title', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => '600',
					'font-size'      => '20px',
					'line-height'    => '',
					'text-transform' => 'none',
					'color'          => '#111',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '-0.68px',
				),
				'choices'   => $this->customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => '.single-post .hentry .entry-header .entry-title',
					),
				),
			),
		);
