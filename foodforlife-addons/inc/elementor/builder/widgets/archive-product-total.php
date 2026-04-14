<?php
namespace FoodForLife\Addons\Elementor\Builder\Widgets;

use FoodForLife\Addons\Elementor\Builder\Current_Query_Renderer;
use FoodForLife\Addons\Elementor\Builder\Products_Renderer;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Archive_Product_Total extends Widget_Base {

	public function get_name() {
		return 'foodforlife-archive-product-total';
	}

	public function get_title() {
		return esc_html__( '[FoodForLife] Product Archive Total', 'foodforlife-addons' );
	}

	public function get_icon() {
		return 'eicon-woocommerce';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'archive', 'product', 'total' ];
	}

	public function get_categories() {
		return [ 'foodforlife-addons-archive-product' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'foodforlife-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'       => esc_html__( 'Alignment', 'foodforlife-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => esc_html__( 'Left', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'foodforlife-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'     => '',
				'selectors'   => [
					'{{WRAPPER}} .catalog-toolbar__result-count' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .catalog-toolbar__result-count',
			]
		);

		$this->add_control(
			'color',
			[
				'label' => esc_html__( 'Color', 'foodforlife-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .catalog-toolbar__result-count' => 'color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		?>
		<div class="catalog-toolbar__result-count"><?php echo esc_html__( 'There are ', 'foodforlife' ) . wc_get_loop_prop( 'total' ) . esc_html__( ' results in total', 'foodforlife' ); ?></div>
		<?php
	}
}