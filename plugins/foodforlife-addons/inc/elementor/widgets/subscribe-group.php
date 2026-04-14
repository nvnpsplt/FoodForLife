<?php
namespace FoodForLife\Addons\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Subscribe_Group extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'foodforlife-subscribe-group';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( '[FoodForLife] Subscribe Group', 'foodforlife-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['foodforlife-addons'];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'subscribe box', 'subscribe group', 'form', 'currency', 'language', 'foodforlife-addons' ];
	}

	/**
	 * Scripts
	 *
	 * @return void
	 */
	public function get_script_depends() {
		return [
			'foodforlife-subscribe-form-widget',
		];
	}

	/**
	 * Styles
	 *
	 * @return void
	 */
	public function get_style_depends() {
		return [
			'foodforlife-elementor-css',
		];
	}
	/**
	 * Register the widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->content_sections();
		$this->style_sections();
	}

	protected function content_sections() {
		// Content
		$this->start_controls_section(
			'section_subscribe_box',
			[ 'label' => __( 'Subscribe Box', 'foodforlife-addons' ) ]
		);

		$this->add_control(
			'type',
			[
				'label' => esc_html__( 'Type', 'foodforlife-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'mailchimp'  => esc_html__( 'Mailchimp', 'foodforlife-addons' ),
					'shortcode' => esc_html__( 'Use Shortcode', 'foodforlife-addons' ),
				],
				'default' => 'mailchimp',
			]
		);

		$this->add_control(
			'form',
			[
				'label'   => esc_html__( 'Mailchimp Form', 'foodforlife-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_contact_form(),
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'operator' => '==',
							'value' => 'mailchimp'
						],
					],
				],
			]
		);

		$this->add_control(
			'form_shortcode',
			[
				'label' => __( 'Enter your shortcode', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'placeholder' => '[gallery id="123" size="medium"]',
				'conditions' => [
					'terms' => [
						[
							'name' => 'type',
							'operator' => '==',
							'value' => 'shortcode'
						],
					],
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'Title HTML Tag', 'foodforlife-addons' ),
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
				'default' => 'h4',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
			]
		);

		$this->add_control(
			'after_description',
			[
				'label' => __( 'After Description', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
			]
		);

		$this->end_controls_section();

	}

	protected function style_sections() {
		$this->start_controls_section(
			'style_content',
			[
				'label'     => __( 'Content', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'toggle_menu',
			[
				'label'        => __( 'Toggle Menu on Mobile', 'foodforlife-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_off'    => __( 'Off', 'foodforlife-addons' ),
				'label_on'     => __( 'On', 'foodforlife-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Arrow Icon', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'toggle_menu' => 'yes',
				],
			]
		);

		$this->add_control(
			'style_icons',
			[
				'label' => __( 'Icon Normal', 'foodforlife-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [],
				'condition' => [
					'toggle_menu' => 'yes',
				],
			]
		);

		$this->add_control(
			'style_icons_active',
			[
				'label' => __( 'Icon Active', 'foodforlife-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [],
				'condition' => [
					'toggle_menu' => 'yes',
					'style_icons[value]!' => '',
				],
			]
		);

		$this->add_control(
			'style_form',
			[
				'label' => __( 'Form', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'form_type',
				[
				'label' => esc_html__( 'Type', 'foodforlife-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__( 'Row', 'foodforlife-addons' ),
						'icon' => 'eicon-arrow-right',
					],
					'column' => [
						'title' => esc_html__( 'Column', 'foodforlife-addons' ),
						'icon' => 'eicon-arrow-down',
					],
				],
				'default' => 'row',
			]
		);

		$this->add_control(
			'style_input',
			[
				'label' => __( 'Input', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'input_bgcolor',
			[
				'label' => __( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content' => '--ffl-input-bg-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' => __( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content' => '--ffl-input-color: {{VALUE}}; --ffl-input-placeholder-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label' => __( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content' => '--ffl-input-border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_hover',
			[
				'label' => __( 'Border Color Hover', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content,
					{{WRAPPER}} .foodforlife-subscribe-box__content .mc4wp-form-row.focused' => '--ffl-input-border-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}' => '--ffl-input-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}}' => '--ffl-input-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_spacing_right',
			[
				'label'     => esc_html__( 'Spacing Right', 'foodforlife-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__type-row input[type="email"]' => 'padding-inline-end: {{SIZE}}{{UNIT}}',
					'.rtl {{WRAPPER}} .foodforlife-subscribe-box__type-row input[type="email"]' => 'padding-inline-start: {{SIZE}}{{UNIT}}; padding-inline-end: var(--ffl-input-padding-x)',
				],
				'condition'   => [
					'form_type' => 'row',
				],
			]
		);

		$this->add_control(
			'button_heading',
			[
				'label' => esc_html__( 'Button', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content' => '--ffl-button-bg-color: {{VALUE}}; --ffl-button-bg-color-hover: {{VALUE}}; --ffl-button-border-color: {{VALUE}}; --ffl-button-border-color-hover: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content' => '--ffl-button-color: {{VALUE}}; --ffl-button-color-hover: {{VALUE}};',
				],
			]
		);

    	$this->add_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}' => '--ffl-button-rounded: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.rtl {{WRAPPER}}' => '--ffl-button-rounded: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'style_message',
			[
				'label' => __( 'Message', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'message_error_color',
			[
				'label' => __( 'Error Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content .mc4wp-response .mc4wp-error' => 'color: {{VALUE}};',
					'{{WRAPPER}} .foodforlife-subscribe-box__content .mc4wp-response .mc4wp-error a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'message_success_color',
			[
				'label' => __( 'Success Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content .mc4wp-response .mc4wp-success' => 'color: {{VALUE}};',
					'{{WRAPPER}} .foodforlife-subscribe-box__content .mc4wp-response .mc4wp-success a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'style_title',
			[
				'label' => __( 'Title', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .foodforlife-subscribe-box__title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'style_description',
			[
				'label' => __( 'Description', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .foodforlife-subscribe-box__description',
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'style_after_description',
			[
				'label' => __( 'After Description', 'foodforlife-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'after_description_color',
			[
				'label' => __( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__after-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'after_description_color_link',
			[
				'label' => __( 'Color Link', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__after-description a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'after_description_typography',
				'selector' => '{{WRAPPER}} .foodforlife-subscribe-box__after-description',
			]
		);

		$this->add_responsive_control(
			'after_description_spacing',
			[
				'label' => __( 'Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__after-description' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', [ 'foodforlife-subscribe-box', 'foodforlife-subscribe-group', 'foodforlife-subscribe-box__type-' . $settings['form_type'] ] );
		$this->add_render_attribute( 'content', 'class', [ 'foodforlife-subscribe-box__content' ] );
		$this->add_render_attribute( 'title', 'class', [ 'foodforlife-subscribe-box__title', 'fw-semibold', 'mt-0', 'mb-20', 'mb-md-25', 'h6' ] );
		$this->add_render_attribute( 'description', 'class', [ 'foodforlife-subscribe-box__description', 'mb-25' ] );
		$this->add_render_attribute( 'after_description', 'class', [ 'foodforlife-subscribe-box__after-description', 'mt-15' ] );

		if ( $settings['toggle_menu'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper', 'class', [ 'foodforlife-toggle-mobile__wrapper' ] );
			$this->add_render_attribute( 'content', 'class', [ 'foodforlife-toggle-mobile__content' ] );
			$this->add_render_attribute( 'title', 'class', [ 'foodforlife-toggle-mobile__title', 'd-flex', 'align-items-center', 'justify-content-between', 'position-relative' ] );
		}

		$output = sprintf(
			'<div class="foodforlife-subscribe-box__content">%s</div>',
			do_shortcode( '[mc4wp_form id="' . esc_attr( $settings['form'] ) . '"]' ),
		);
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $settings['title'] ) : ?>
				<<?php echo $settings['title_size']; ?> <?php echo $this->get_render_attribute_string( 'title' ); ?>>
					<?php echo $settings['title']; ?>
					<?php if ( $settings['toggle_menu'] == 'yes' ) : ?>
						<?php
							if ( ! empty( $settings['style_icons']['value'] ) ) {
								$collapse_icon = '<span class="foodforlife-svg-icon foodforlife-subscribe-box__icon foodforlife-subscribe-box__icon-default hidden-md hidden-lg hidden-xl">';
								$collapse_icon .= $this->get_icon_html( $settings['style_icons'], [ 'aria-hidden' => 'true' ] );
								$collapse_icon .= '</span>';

								if ( ! empty( $settings['style_icons_active']['value'] ) ) {
									$collapse_icon .= '<span class="foodforlife-svg-icon foodforlife-subscribe-box__icon foodforlife-subscribe-box__icon-active hidden-md hidden-lg hidden-xl">';
									$collapse_icon .= $this->get_icon_html( $settings['style_icons_active'], [ 'aria-hidden' => 'true' ] );
									$collapse_icon .= '</span>';
								}
							} else {
								$collapse_icon = '<span class="ffl-collapse-icon"></span>';
							}

							echo $collapse_icon;
						?>
					<?php endif; ?>
				</<?php echo $settings['title_size']; ?>>
			<?php endif; ?>
			<div <?php echo $this->get_render_attribute_string( 'content' ); ?>>
				<?php if ( $settings['description'] ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></div>
				<?php endif; ?>
				<?php
					if( $settings['type'] == 'mailchimp' ) {
						echo sprintf(
							'<div class="foodforlife-subscribe-box__content">%s</div>',
							do_shortcode( '[mc4wp_form id="' . esc_attr( $settings['form'] ) . '"]' ),
						);
					} else {
						echo do_shortcode(  $settings['form_shortcode'] );
					}
				?>
				<?php if ( $settings['after_description'] ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'after_description' ); ?>><?php echo $settings['after_description']; ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Get Contact Form
	 */
	protected function get_contact_form() {
		$mail_forms    = get_posts( array(
			'post_type'      => 'mc4wp-form',
			'posts_per_page' => apply_filters( 'foodforlife_addons_mc4wp_forms_query_limit', 100 ),
			'post_status'    => 'publish',
		) );
		$mail_form_ids = array(
			'' => esc_html__( 'Select Form', 'foodforlife-addons' ),
		);
		foreach ( $mail_forms as $form ) {
			$mail_form_ids[$form->ID] = $form->post_title;
		}

		return $mail_form_ids;
	}

	/**
	 * @param array $icon
	 * @param array $attributes
	 * @param $tag
	 * @return bool|mixed|string
	 */
	function get_icon_html( array $icon, array $attributes, $tag = 'i' ) {
		/**
		 * When the library value is svg it means that it's a SVG media attachment uploaded by the user.
		 * Otherwise, it's the name of the font family that the icon belongs to.
		 */
		if ( 'svg' === $icon['library'] ) {
			$output = Icons_Manager::render_uploaded_svg_icon( $icon['value'] );
		} else {
			$output = Icons_Manager::render_font_icon( $icon, $attributes, $tag );
		}
		return $output;
	}
}