<?php

/**
 * Styling & General Options Partial
 *
 * @package FoodForLife
 * @since   1.8.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

		// Maintenance
		$settings['maintenance'] = array(
			'maintenance_enable'             => array(
				'type'        => 'toggle',
				'label'       => esc_html__('Enable Maintenance Mode', 'foodforlife'),
				'description' => esc_html__('Put your site into maintenance mode', 'foodforlife'),
				'default'     => false,
			),
			'maintenance_mode'               => array(
				'type'        => 'radio',
				'label'       => esc_html__('Mode', 'foodforlife'),
				'description' => esc_html__('Select the correct mode for your site', 'foodforlife'),
				'tooltip'     => wp_kses_post(sprintf(__('If you are putting your site into maintenance mode for a longer perior of time, you should set this to "Coming Soon". Maintenance will return HTTP 503, Comming Soon will set HTTP to 200. <a href="%s" target="_blank">Learn more</a>', 'foodforlife'), 'https://yoast.com/http-503-site-maintenance-seo/')),
				'default'     => 'maintenance',
				'choices'     => array(
					'maintenance' => esc_html__('Maintenance', 'foodforlife'),
					'coming_soon' => esc_html__('Coming Soon', 'foodforlife'),
				),
				'active_callback' => array(
					array(
						'setting'  => 'maintenance_enable',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'maintenance_page'               => array(
				'type'            => 'dropdown-pages',
				'label'           => esc_html__('Maintenance Page', 'foodforlife'),
				'default'         => 0,
				'active_callback' => array(
					array(
						'setting'  => 'maintenance_enable',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Color Scheme
		$settings['color_scheme'] = array(
			'primary_color_title'  => array(
				'type'  => 'custom',
				'label' => esc_html__( 'Primary Color', 'foodforlife' ),
			),
			'primary_color'        => array(
				'type'            => 'color-palette',
				'choices'         => array(
					'colors' => array(
						'#d0473e',
						'#3357d8',
						'#a62658',
						'#0f855b',
						'#0f8482',
						'#197149',
					),
					'style'  => 'round',
				),
				'active_callback' => array(
					array(
						'setting'  => 'primary_color_custom',
						'operator' => '!=',
						'value'    => true,
					),
				),
			),
			'primary_color_custom' => array(
				'type'      => 'checkbox',
				'label'     => esc_html__( 'Pick my favorite color', 'foodforlife' ),
				'default'   => false,

			),
			'primary_color_custom_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Custom Color', 'foodforlife' ),
				'default'         => '#d0473e',
				'active_callback' => array(
					array(
						'setting'  => 'primary_color_custom',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'primary_text_color'             => array(
				'type'        => 'select',
				'default'     => false,
				'label'       => esc_html__('Text on Primary Color', 'foodforlife'),
				'default'         => 'light',
				'choices'         => array(
					'light' 	=> esc_html__( 'Light', 'foodforlife' ),
					'dark' 	    => esc_html__( 'Dark', 'foodforlife' ),
					'custom'  	=> esc_html__( 'Custom', 'foodforlife' ),
				),
			),
			'primary_text_color_custom'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Custom Color', 'foodforlife' ),
				'default'         => '#fff',
				'active_callback' => array(
					array(
						'setting'  => 'primary_text_color',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'primary_base_color_hr'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'primary_base_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Base Color', 'foodforlife' ),
				'default'         => '',
			),
			'primary_dark_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Dark Color', 'foodforlife' ),
				'default'         => '',
			),
			'primary_link_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Link Color', 'foodforlife' ),
				'default'         => '',
			),
			'primary_link_hover_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Link Hover Color', 'foodforlife' ),
				'default'         => '',
			),
			'product_card_sale_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Sale Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.ffl-price ins',
						'property' => '--ffl-color-price-sale',
					),
					array(
						'element'  => '.price ins',
						'property' => '--ffl-color-price-sale',
					),
				),
			),
		);

		$settings['styling_images'] = array(
			'image_rounded_shape'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Corner Radius', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 			=> esc_html__( 'Round', 'foodforlife' ),
					'square'  	=> esc_html__( 'Square', 'foodforlife' ),
					'custom'  	=> esc_html__( 'Custom', 'foodforlife' ),
				),
			),
			'image_rounded_number'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Number(px)', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'image_rounded_shape',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),

		);

		$settings['styling_buttons'] = array(
			'button_rounded_shape'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Corner Radius', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 			=> esc_html__( 'Circle', 'foodforlife' ),
					'square'  	=> esc_html__( 'Square', 'foodforlife' ),
					'round'  	=> esc_html__( 'Round', 'foodforlife' ),
					'custom'  	=> esc_html__( 'Custom', 'foodforlife' ),
				),
			),
			'button_rounded_number'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Number(px)', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'button_rounded_shape',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'button_eff_hover_bg_disable'       => array(
				'type'            => 'toggle',
				'label'           => esc_html__( 'Disable Hover Effect', 'foodforlife' ),
				'default'         => false,
			),
			'button_custom_hr_1'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'button_solid_dark_headline' => array(
				'type'            => 'headline',
				'label'           => esc_html__( 'Solid Dark', 'foodforlife' ),
			),
			'button_solid_dark_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_solid_dark_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_solid_dark_hover_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_solid_dark_eff_hover_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Effect Background Color Hover', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'button_eff_hover_bg_disable',
						'operator' => '==',
						'value'    => false,
					),
				),
			),
			'button_solid_dark_hover_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_custom_hr_2'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			// Button Light
			'button_solid_light_headline' => array(
				'type'            => 'headline',
				'label'           => esc_html__( 'Solid Light', 'foodforlife' ),
			),
			'button_solid_light_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_solid_light_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_solid_light_hover_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_solid_light_eff_hover_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Effect Background Color Hover', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'button_eff_hover_bg_disable',
						'operator' => '==',
						'value'    => false,
					),
				),
			),
			'button_solid_light_hover_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_custom_hr_3'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			// Button Outline
			'button_outline_headline' => array(
				'type'            => 'headline',
				'label'           => esc_html__( 'Outline', 'foodforlife' ),
			),
			'button_outline_border_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_outline_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_outline_hover_border_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_outline_hover_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_outline_hover_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_custom_hr_4'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			// Button Outline
			'button_outline_dark_headline' => array(
				'type'            => 'headline',
				'label'           => esc_html__( 'Outline Dark', 'foodforlife' ),
			),
			'button_outline_dark_border_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_outline_dark_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_outline_dark_hover_border_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_outline_dark_hover_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_outline_dark_eff_hover_bg_color_select'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Effect Background Color', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 		=> esc_html__( 'Default', 'foodforlife' ),
					'yes'  	=> esc_html__( 'Yes', 'foodforlife' ),
					'no'  	=> esc_html__( 'No', 'foodforlife' ),
				),
			),
			'button_outline_dark_eff_hover_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Effect Background Color Hover', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'button_outline_dark_eff_hover_bg_color_select',
						'operator' => '==',
						'value'    => 'yes',
					),
				),
			),
			'button_outline_dark_hover_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_custom_hr_5'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			// Button Underline
			'button_underline_headline' => array(
				'type'            => 'headline',
				'label'           => esc_html__( 'Underline', 'foodforlife' ),
			),
			'button_underline_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_underline_hover_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color Hover', 'foodforlife' ),
				'default'         => '',
			),
			'button_custom_hr_6'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			// Button Text
			'button_text_headline' => array(
				'type'            => 'headline',
				'label'           => esc_html__( 'Text', 'foodforlife' ),
			),
			'button_text_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color', 'foodforlife' ),
				'default'         => '',
			),
			'button_text_hover_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color Hover', 'foodforlife' ),
				'default'         => '',
			),
		);

		$settings['styling_form_fields'] = array(
			'form_fields_rounded_shape'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Corner Radius', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 			=> esc_html__( 'Circle', 'foodforlife' ),
					'round'  	=> esc_html__( 'Round', 'foodforlife' ),
					'square'  	=> esc_html__( 'Square', 'foodforlife' ),
					'custom'  	=> esc_html__( 'Custom', 'foodforlife' ),
				),
			),
			'form_fields_rounded_number'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Number(px)', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'form_fields_rounded_shape',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'form_fields_custom_hr_1'    => array(
				'type'    => 'custom',
				'default' => '<hr/>',
			),
			'form_fields_bg_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Color', 'foodforlife' ),
				'default'         => '',
			),
			'form_fields_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color', 'foodforlife' ),
				'default'         => '',
			),
			'form_fields_border_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color', 'foodforlife' ),
				'default'         => '',
			),
			'form_fields_hover_border_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Border Color Hover', 'foodforlife' ),
				'default'         => '',
			),
		);

