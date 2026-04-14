<?php
namespace FoodForLife\Addons\Elementor\Builder\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Recent_Sales_Count extends Widget_Base {
	use \FoodForLife\Addons\Elementor\Builder\Traits\Product_Id_Trait;

	public function get_name() {
		return 'foodforlife-recent-sales-count';
	}

	public function get_title() {
		return esc_html__( '[FoodForLife] Recent Sales Count', 'foodforlife-addons' );
	}

	public function get_icon() {
		return 'eicon-woocommerce';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'recent', 'sales', 'count', 'product' ];
	}

	public function get_categories() {
		return [ 'foodforlife-addons-product' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'foodforlife-addons' ),
			]
		);

		$this->add_control(
			'hours',
			[
				'label' => esc_html__( 'Hours', 'foodforlife-addons' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 12,
				'step' => 1,
				'default' => 7,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'foodforlife-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'foodforlife-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '[number] sold in last [hours] hours.', 'foodforlife-addons' ),
				'description' => __( '[number] - Show number. <br/>Eg: [number] sold in last [hours] hours.', 'foodforlife-addons' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_text',
			[
				'label'     => esc_html__( 'Text', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .foodforlife-recent-sales-count__text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-recent-sales-count__text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_icon',
			[
				'label'     => esc_html__( 'Icon', 'foodforlife-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Size', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-recent-sales-count__icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodforlife-recent-sales-count__icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'foodforlife-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'default' => [],
				'selectors' => [
					'{{WRAPPER}} .foodforlife-recent-sales-count__icon' => 'margin-inline-end: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .foodforlife-recent-sales-count__icon' => 'margin-inline-start: {{SIZE}}{{UNIT}}; margin-inline-end: 0;',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		global $product;

		$product = $this->get_product();

		if ( ! $product ) {
			return;
		}

		if ( \FoodForLife\Addons\Elementor\Builder\Helper::is_elementor_editor_mode() ) {
			?>
			<div class="foodforlife-recent-sales-count">
				<?php
				if( ! empty( $settings['icon']['value'] ) ) {
					echo '<span class="foodforlife-svg-icon foodforlife-recent-sales-count__icon foodforlife-svg-icon--thunder">' . \Elementor\Icons_Manager::try_get_icon_html( $settings['icon'], [ 'aria-hidden' => 'true' ] ) . '</span>';
				} else {
					echo \FoodForLife\Addons\Helper::get_svg( 'fire', 'ui', 'class=foodforlife-recent-sales-count__icon' );
				}
				?>
				<span class="foodforlife-recent-sales-count__text">
					<?php
					if( ! empty( $settings['text'] ) ) {
						echo str_replace( [ '[number]', '[hours]' ], [ '<span class="foodforlife-recent-sales-count__numbers">' . rand( 0, 100 ) . '</span>', $settings['hours'] ], $settings['text'] );
					} else {
						printf(
							__( '%s sold in last %s hours.', 'foodforlife-addons' ),
							'<span class="foodforlife-recent-sales-count__numbers">' . rand( 0, 100 ) . '</span>',
							$settings['hours']
						);
					}
					?>
				</span>
			</div>
			<?php
		} else {
			add_filter( 'foodforlife_recent_sales_count_icon', [ $this, 'foodforlife_get_icon'] );
			add_filter( 'foodforlife_recent_sales_count_text', [ $this, 'foodforlife_get_text'], 10, 33 );
			add_filter( 'foodforlife_recent_sales_hours', [ $this, 'foodforlife_get_hours'], 10 );
			do_action( 'foodforlife_recent_sales_count_elementor' );
			remove_filter( 'foodforlife_recent_sales_count_icon', [ $this, 'foodforlife_get_icon'] );
			remove_filter( 'foodforlife_recent_sales_count_text', [ $this, 'foodforlife_get_text'], 10, 3 );
			remove_filter( 'foodforlife_recent_sales_hours', [ $this, 'foodforlife_get_hours'], 10 );
		}
	}

	public function foodforlife_get_icon( $icon ) {
		$settings = $this->get_settings_for_display();

		if( ! empty( $settings['icon']['value'] ) ) {
        	return '<span class="foodforlife-svg-icon foodforlife-recent-sales-count__icon foodforlife-svg-icon--fire">' . \Elementor\Icons_Manager::try_get_icon_html( $settings['icon'], [ 'aria-hidden' => 'true' ] ) . '</span>';
		}

		return $icon;
    }

	public function foodforlife_get_text( $text, $html_number, $hours ) {
		$settings = $this->get_settings_for_display();

		if( ! empty( $settings['text'] ) ) {
			return str_replace( [ '[number]', '[hours]' ], [ $html_number, $settings['hours'] ], $settings['text'] );
		}

		return $text;
    }

	public function foodforlife_get_hours() {
		$settings = $this->get_settings_for_display();

		return $settings['hours'];
    }
}