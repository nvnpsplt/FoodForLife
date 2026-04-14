<?php
namespace FoodForLife\Addons\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;

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
class Subscribe_Box extends Widget_Base {
  /**
   * Retrieve the widget name.
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'foodforlife-subscribe-box';
  }

  /**
   * Retrieve the widget title.
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __( '[FoodForLife] Subscribe Box', 'foodforlife-addons' );
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
    return [ 'subscribe box', 'form', 'foodforlife-addons' ];
  }

  public function get_script_depends(): array {
		return [ 'foodforlife-subscribe-form-widget' ];
	}

	public function get_style_depends() {
		return [ 'foodforlife-elementor-css' ];
	}

  /**
   * Register the widget controls.
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @access protected
   */
  protected function register_controls() {
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

    $this->end_controls_section();

    $this->start_controls_section(
			'style_content',
			[
				'label'     => __( 'Form', 'foodforlife-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
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
				'default' => 'column',
			]
		);

    $this->add_responsive_control(
		'alignments',
		[
			'label'       => esc_html__( 'Alignments', 'foodforlife-addons' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'flex-start'   => [
					'title' => esc_html__( 'Left', 'foodforlife-addons' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'foodforlife-addons' ),
					'icon'  => 'eicon-text-align-center',
				],
				'flex-end'  => [
					'title' => esc_html__( 'Right', 'foodforlife-addons' ),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'default'     => '',
			'selectors'   => [
				'{{WRAPPER}} .foodforlife-subscribe-box__type-row .foodforlife-subscribe-box__content .mc4wp-form-fields' => 'justify-content: {{VALUE}}',
			],
			'condition'   => [
				'form_type' => 'row',
			],
		]
	);

	$this->add_responsive_control(
		'content_gap',
		[
			'label'     => esc_html__( 'Gap', 'foodforlife-addons' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .foodforlife-subscribe-box__type-row .foodforlife-subscribe-box__content .mc4wp-form-fields' => 'gap: {{SIZE}}{{UNIT}}',
			],
			'condition'   => [
				'form_type' => 'row',
			],
		]
	);

    $this->add_control(
			'input_heading',
			[
				'label' => esc_html__( 'Input', 'foodforlife-addons' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

    $this->add_responsive_control(
			'input_width',
			[
				'label'      => esc_html__( 'Container Width', 'foodforlife-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1900,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content .mc4wp-form-row' => 'max-width: {{SIZE}}{{UNIT}};',
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
		'input_spacing_bottom',
		[
			'label'     => esc_html__( 'Spacing Bottom', 'foodforlife-addons' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .foodforlife-subscribe-box__type-column input[type="email"]' => 'margin-bottom: {{SIZE}}{{UNIT}}',
			],
			'condition'   => [
				'form_type' => 'column',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name'     => 'input_typography',
			'selector' => '{{WRAPPER}} .foodforlife-subscribe-box__content [type="email"], {{WRAPPER}} .foodforlife-subscribe-box__content .mc4wp-form-row label',
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
		'input_backdrop_filter',
		[
			'label'     => esc_html__( 'Backdrop Filter', 'foodforlife-addons' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .foodforlife-subscribe-box__content [type="email"]' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
			],
		]
	);

	$this->add_control(
		'input_bordercolor',
		[
			'label' => __( 'Border Color', 'foodforlife-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .foodforlife-subscribe-box__content' => '--ffl-input-border-color: {{VALUE}};',
			],
		]
	);

	$this->add_control(
		'input_hover_bordercolor',
		[
			'label' => __( 'Hover Border Color', 'foodforlife-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .foodforlife-subscribe-box__content, {{WRAPPER}} .foodforlife-subscribe-box__content .mc4wp-form-row.focused' => '--ffl-input-border-color-hover: {{VALUE}};',
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

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]',
			]
		);

    $this->add_control(
			'button_color',
			[
				'label' => __( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]' => '--ffl-button-color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'button_bgcolor',
			[
				'label' => __( 'Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]' => '--ffl-button-bg-color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'button_bordercolor',
			[
				'label' => __( 'Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]' => '--ffl-button-border-color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Hover Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]' => '--ffl-button-color-hover: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'button_hover_bgcolor',
			[
				'label' => __( 'Hover Background Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]' => '--ffl-button-bg-color-hover: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'button_hover_bordercolor',
			[
				'label' => __( 'Hover Border Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]' => '--ffl-button-border-color-hover: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'button_background_effect_hover_color',
			[
				'label'     => __( 'Hover Background Effect Color', 'foodforlife-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]' => '--ffl-button-eff-bg-color-hover: {{VALUE}};',
				],
			]
		);

    $this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'foodforlife-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .foodforlife-subscribe-box__content [type="submit"]' => 'padding-top: {{TOP}}{{UNIT}}; padding-inline-end: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-inline-start: {{LEFT}}{{UNIT}};',
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

    $this->end_controls_section();
  }

  /**
   * Render widget output on the frontend.
   * Written in PHP and used to generate the final HTML.
   */
  protected function render() {
    $settings = $this->get_settings_for_display();

    $classes = [
      'foodforlife-subscribe-box',
      'foodforlife-subscribe-box__type-' . esc_attr( $settings['form_type'] ),
    ];

    $this->add_render_attribute( 'wrapper', 'class', $classes );

    $output = sprintf(
      '<div class="foodforlife-subscribe-box__content">%s</div>',
      do_shortcode( '[mc4wp_form id="' . esc_attr( $settings['form'] ) . '"]' ),
    );
    ?>
    <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
      <?php
      if( $settings['type'] == 'mailchimp' ) {
        echo $output;
      } else {
        echo do_shortcode(  $settings['form_shortcode'] );
      }
      ?>
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
}